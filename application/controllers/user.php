<?php

class User extends User_Secure_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('url');
        $this->load->library('gcharts');
    }

    function prikaziKorpu() {
        $this->load->model('user_model');

        $this->load->model('korpa_model');
        $this->load->view('template', array(
            "folder" => "app",
            "page" => "korpa",
            'user' => $this->user,
            "prazna" => $this->korpa_model->isEmpty($this->user->id),
            "title" => "Korpa",
            "knjige" => $this->user_model->vrati_knjigeKorisnika($this->user->id),
            "broj" => $this->broj,
            "cena" => $this->user_model->vrati_UkCenu($this->user->id),
        ));
    }

  


    function prikaziKatalog() {
        $this->load->model('knjiga_model');
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "user/prikaziKatalog/";
        $config['total_rows'] = $this->knjiga_model->broj_rezultata();
        $config['per_page'] = 8;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);

        
        $links = $this->pagination->create_links();


        $this->load->view('template_safilterom', array(
            "folder" => "app",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $this->knjiga_model->vrati_podatke_za_katalog($config["per_page"], $page),
            "title" => "Katalog knjiga",
            "broj" => $this->broj,
            "val"=>" din",
            "imaFilter" => true,
            "links" => $links,
        ));
    }

    function ubaciUKorpu() {
        $is_ajax = $this->input->post('ajax');

        $this->load->model('korpa_model');
        $this->korpa_model->dodajUKorpu($this->user->id);
        $broj = $this->user_model->vrati_brojKnjiga($this->user->id);
        echo $this->broj + 1;
// redirect('app/prikaziKorpu', 'refresh');
    }

    function izbaciIzKorpe() {
        $this->load->model('korpa_model');
        $this->korpa_model->izbaciIzKorpe($this->user->id);
        redirect('app/prikaziKorpu', 'refresh');
    }

    function isprazniKorpu() {
        $this->load->model('korpa_model');

         $this->load->model('user_model');
   
            $user_id = $this->user->id;

        $knjige=$this->user_model->vrati_knjigeKorisnika($user_id);
        $this->korpa_model->isprazniKorpu($this->user->id, $knjige);
        redirect('user/prikaziKorpu', 'refresh');
    }

    function prikazi_knjigu($id) {
        $this->load->model('knjiga_model');
        $this->load->model('recenzija_model');
        $knjige = $this->knjiga_model->vrati_knjigu($id);
        $naziv = "";
        foreach ($knjige as $knjiga) {
            $zanr = $knjiga->zanr;
            $autor = $knjiga->autor;
            $naziv = $knjiga->naziv;
            $cena = $knjiga->cena;
        }

        $this->load->view('template', array(
            "folder" => "app",
            "page" => "knjiga",
            "user" => $this->user,
            "knjige" => $knjige,
            "slicne" => $this->knjiga_model->vrati_slicneKnjige($id, $zanr, $autor),
            "recenzije" => $this->knjiga_model->vrati_recenzije($id),
            "ocena" => $this->recenzija_model->proscena_ocena($id),
            "ocenjena" => $this->recenzija_model->ocenjena_knjiga($this->user->id, $id),
            "title" => $naziv,
            "broj" => $this->broj,
        ));
    }

    function napisi_recenziju() {
        $recenzija = $this->input->post('id_knjige');

        $this->load->model('recenzija_model');
        $this->recenzija_model->dodaj_recenziju($this->user->id);
        $url = 'user/prikazi_knjigu/' . $recenzija;
        redirect($url, 'refresh');
    }

    function izbrisi_recenziju() {
        $recenzija = $this->input->post('id_knjige');
        $url = 'user/prikazi_knjigu/' . $recenzija;
        $this->load->model('recenzija_model');
        $this->recenzija_model->izbrisi_recenziju($this->user->id);
        redirect($url, 'refresh');
    }

   

    function prikaziCenu() {
        $this->load->model('knjiga_model');



        $this->load->view('template_safilterom', array(
            "folder" => "app",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $this->knjiga_model->pretraziPoCeni(),
            "title" => "Katalog knjiga",
            "broj" => $this->broj,
            "val" =>"din",

            "links" => "",
        ));
    }

    function prikaziRezultatePretrage($offset = 0) {
        $this->load->model('knjiga_model');
        $keyword = $this->input->post('poljePretrage');
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "user/prikaziRezultatePretrage/";
        $config['total_rows'] = $this->knjiga_model->brojRezultataPretrage($keyword);
        $config['per_page'] = 8;
        $config['uri_segment'] = 3;
        $offset = (int) $offset;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);


        $links = $this->pagination->create_links();

        $knjige = $this->knjiga_model->pretrazi($keyword, $offset);
        if (empty($keyword)) {
            $knjige = array();
            $links = "";
        }
        $this->load->view('template_safilterom', array(
            "folder" => "app",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $knjige,
            "keyword" => $this->input->post('poljePretrage'),
            "title" => "Pretraga knjiga",
            "broj" => $this->broj,
             "val" =>"din",

            "links" => $links,
        ));
    }

    function prikaziPoZanru() {
        $this->load->model('knjiga_model');
        $zanr = $this->input->post('zanrSelect');
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "user/prikaziPoZanru/";
        $config['total_rows'] = $this->knjiga_model->brojPoZanru($zanr);
        $config['per_page'] = 8;


        $this->pagination->initialize($config);


        $links = $this->pagination->create_links();

        $knjige = $this->knjiga_model->filtrirajPoZanru($zanr);
        /* if(is_null($zanr)) {
          $knjige= array ();
          } */
        $this->load->view('template_safilterom', array(
            "folder" => "app",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $knjige,
            "keyword" => $this->input->post('poljePretrage'),
            "title" => "Knjige Å¾anra: " . $zanr,
            "zanr" => $zanr,
            "broj" => $this->broj,
             "val" =>"din",
            "links" => "",
        ));
    }

    public function prikaziStatistiku() {
        $this->load->model('knjiga_model');
        $this->gcharts->load('PieChart');
        $zanrovi = $this->knjiga_model->vratiSveZanrove();

        $slice1 = $this->knjiga_model->vratiProdajuPoZanru(1);
        $slice2 = $this->knjiga_model->vratiProdajuPoZanru(2);
        $slice3 = $this->knjiga_model->vratiProdajuPoZanru(3);
        $slice4 = $this->knjiga_model->vratiProdajuPoZanru(4);
        $slice5 = $this->knjiga_model->vratiProdajuPoZanru(5);
        $slice6 = $this->knjiga_model->vratiProdajuPoZanru(6);
        $slice7 = $this->knjiga_model->vratiProdajuPoZanru(7);
        $slice8 = $this->knjiga_model->vratiProdajuPoZanru(8);
        $this->gcharts->DataTable('ProdajaZanr')
                ->addColumn('string', 'Foods', 'food')
                ->addColumn('string', 'Amount', 'amount');

        foreach ($zanrovi as $zanr) {
            $this->gcharts->DataTable('ProdajaZanr')
                    ->addRow(array($zanr->nazivZanra, $this->knjiga_model->vratiProdajuPoZanru($zanr->zanr_id)));
        }


        $config = array(
            'title' => 'Prikaz dijagrama prodatih količina odredjenog žanra:',
            'is3D' => TRUE
        );

        $this->gcharts->PieChart('ProdajaZanr')->setConfig($config);

//UDEO U PRODAJI IZDAVACA

        $this->gcharts->load('DonutChart');



        $this->gcharts->DataTable('Izdavac')
                ->addColumn('string', 'Izdavac', 'izdavac')
                ->addColumn('string', 'Kolicina', 'kolicina')
                ->addRow(array('Evro-Giunti', $this->knjiga_model->vratiProdajuIzdavaca('Evro-Giunti')))
                ->addRow(array('Laguna', $this->knjiga_model->vratiProdajuIzdavaca('Laguna')))
                ->addRow(array('Vulkan izdavaštvo', $this->knjiga_model->vratiProdajuIzdavaca('Vulkan izdavaštvo')))
                ->addRow(array('Mikro knjiga', $this->knjiga_model->vratiProdajuIzdavaca('Mikro knjiga')));

        $config = array(
            'title' => 'Udeo izdavača u prodaji knjižare:',
            'pieHole' => .4
        );
        $this->gcharts->DonutChart('Izdavac')->setConfig($config);



//PRIHODI EVRO

        $this->gcharts->load('ColumnChart');

        $this->gcharts->DataTable('Prihodi')
                ->addColumn('string', 'Godine', 'class')
                ->addColumn('number', '2011', 'erasers')
                ->addColumn('number', '2012', 'pencils')
                ->addColumn('number', '2013', 'markers')
                ->addColumn('number', '2014', 'erasers')
                ->addRow(array(
                    'Prihod od prodaje',
                    $this->knjiga_model->vratiPrihodPoGodinama('2011-1-1', '2011-12-31', 'Evro-Giunti'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2012-1-1', '2012-12-31', 'Evro-Giunti'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2013-1-1', '2013-12-31', 'Evro-Giunti'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2014-1-1', '2014-12-31', 'Evro-Giunti'),
        ));

        $config = array(
            'title' => 'Godišnji prihodi izdavaža Evro-Giunti'
        );

        $this->gcharts->ColumnChart('Prihodi')->setConfig($config);



//PRIHODI LAGUNA
        $this->gcharts->load('ColumnChart');

        $this->gcharts->DataTable('PrihodiLaguna')
                ->addColumn('string', 'Godine', 'class')
                ->addColumn('number', '2011', 'erasers')
                ->addColumn('number', '2012', 'pencils')
                ->addColumn('number', '2013', 'markers')
                ->addColumn('number', '2014', 'erasers')
                ->addRow(array(
                    'Prihod od prodaje',
                    $this->knjiga_model->vratiPrihodPoGodinama('2011-1-1', '2011-12-31', 'Laguna'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2012-1-1', '2012-12-31', 'Laguna'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2013-1-1', '2013-12-31', 'Laguna'),
                    $this->knjiga_model->vratiPrihodPoGodinama('2014-1-1', '2014-12-31', 'Laguna'),
        ));

        $config = array(
            'title' => 'Godisnji prihodi izdavača Laguna'
        );

        $this->gcharts->ColumnChart('PrihodiLaguna')->setConfig($config);

        $this->load->view('template'
                , array("folder" => "admin",
            "user" => $this->user,
            "broj" => $this->broj,
            "title" => "Statistike prodaje",
            "page" => "prikazStatistike.php",
        ));
    }

    public function konverzija() {
        $this->load->model('knjiga_model');

        $knjige = $this->knjiga_model->vrati_knjigu($this->input->post('id_knjige'));
        foreach ($knjige as $knjiga) {
            $cena = $knjiga->cena;
        }
        $api_id = 'd37b8c26b98c147ff683fc04550a143e'; // Vaš API ID
        $url = 'http://api.kursna-lista.info/' . $api_id . '/konvertor/rsd/eur/' . $cena;
        $content = file_get_contents($url);

        if (empty($content)) {
            die('Greška u preuzimanju podataka');
        }

        $data = json_decode($content, true);



        if ($data['status'] == 'ok') {
            $novaCena = " Cena knjige u evrima: " . round($data['result']['value'], 2) . " €";
            echo $novaCena;
        } else {
            echo $novaCena = "Došlo je do greške: " . $data['code'] . " - " . $data['msg'];
        }
    }

    public function vratiDnevniKurs() {
        $today = getdate();

        $d = $today['mday'];
        $m = $today['mon'];
        $y = $today['year'];
        $datum = "$d.$m.$y";

        $api_id = 'd37b8c26b98c147ff683fc04550a143e'; // Vaš API ID
        $url = 'http://api.kursna-lista.info/' . $api_id . '/kl_na_dan/' . $datum;

        $content = file_get_contents($url);

        if (empty($content)) {
            die('Greška u preuzimanju podataka');
        }

        $data = json_decode($content, true);



        if ($data['status'] == 'ok') {
            $kurs = $data['result']['eur']['sre'];
            return $kurs;
        } else {
            return $novaCena = "Došlo je do greške: " . $data['code'] . " - " . $data['msg'];
        }
    }

    public function vratiKnjigeSaPArametrom($valuta, $limit, $start) {
        if ($valuta == 1) {

            $this->db->select('*');
            $this->db->from('slike');
            $this->db->limit($limit, $start);
            $this->db->join('knjige', 'slike.knjiga_id = knjige.id_knjige', 'left');
            $this->db->order_by("br_strana", "desc");
            $query = $this->db->get();

            return $query->result();
        }
        if ($valuta == 2) {
            $this->db->select('*');
            $this->db->select('knjige.cena/' . $this->vratiDnevniKurs() . ' as cena', false);
            $this->db->from('knjige');

            $this->db->limit($limit, $start);
            $this->db->join('slike', 'knjige.id_knjige = slike.knjiga_id', 'left');
            $this->db->order_by("br_strana", "desc");
            $query = $this->db->get();

            return $query->result();
        }
    }

    function prikaziKatalogValuta() {

        $this->load->model('knjiga_model');
        $this->load->library('pagination');
        $valuta = $this->input->post('valuta');
        if ($valuta == 2) {
            $val = " €";
        } else {
            $val = " din";
        }

        $config['base_url'] = base_url() . "user/prikaziKatalogValuta/";
        $config['total_rows'] = $this->knjiga_model->broj_rezultata();
        $config['per_page'] = 8;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);


        $links = $this->pagination->create_links();


        $this->load->view('template_safilterom', array(
        "folder" => "app",
        "user" => $this->user,
        "page" => "katalog",
        "knjige" => $this->vratiKnjigeSaPArametrom($valuta, $config["per_page"], $page),
        "title" => "Katalog knjiga",
        "broj" => $this->broj,
        "val" =>$val,
        "imaFilter" => true,
        "links" => $links,
        ));
    }
    function kupi_knjige() {


    $this->load->model('porudzbina_model');
    $this->load->model('korpa_model');    
    $this->load->model('user_model');
   
    $user_id = $this->user->id;

    $knjige=$this->user_model->vrati_knjigeKorisnika($user_id);
    $this->porudzbina_model->dodajPorudzbinu($user_id, $knjige);
    $this->korpa_model->isprazniKorpu($user_id, $knjige);

   

        redirect('user/prikaziKupovineKorisnika', 'refresh');
    }
    function prikaziKupovineKorisnika() {
        $this->load->model('porudzbina_model');
       
      $this->load->view('template', array(
            "folder" => "app",
            "page" => "profilKupovine",
            'user' => $this->user,
            "title" => "Pregled istorije naručivanja",
            "porudzbine" => $this->porudzbina_model->vratiPorudzbineKorisnika($this->user->id),
            "kupljene" => $this->porudzbina_model->vratiOdobrenePorduzbine($this->user->id),
            
            "broj" => $this->broj,
           
            ));


       
    }
 function prikaziPorudzbinu($id_porudzbine) {
        $this->load->model('porudzbina_model');
        $p1= $this->porudzbina_model->vratiPorudzbinu($id_porudzbine);
        $ispis;
        $title;
        foreach ($p1 as $p) {
         if ( $p->status==0) {
           $ispis="porudžbine";
            $title="Detaljni prikaz poruzdbine" ;
         }
         if ( $p->status==1) {
            $ispis="kupovine";
         $title="Detaljni prikaz kupovine" ;
     }

        }
        $this->load->view('template', array(
            "folder" => "app",
            "page" => "prikazPorudzbine",
            'user' => $this->user,
            "title" =>  $title,
            "stavke" => $this->porudzbina_model->vratiStavkePorudzbine($id_porudzbine),
            "porudzbina" => $this->porudzbina_model->vratiPorudzbinu($id_porudzbine),
             "cenaPorudzbine" => $this->porudzbina_model->vrati_cenu_porudzbine($id_porudzbine),
              "id_porudzbine" => $id_porudzbine,
            "broj" => $this->broj,
            "ispis"=>$ispis
           
            ));

}
}


?>
