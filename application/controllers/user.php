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

    function profil() {

        $this->load->view('template', array(
            "folder" => "app",
            "page" => "profil",
            'user' => $this->user,
            "title" => "Profil korisnika: " . $this->user->username,
            "broj" => $this->broj,
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
            "imaFilter" => true,
            "links" => $links,
        ));
    }

    function ubaciUKorpu() {
        $is_ajax = $this->input->post('ajax');

        $this->load->model('korpa_model');
        $this->korpa_model->dodajUKorpu($this->user->id);
        // redirect('app/prikaziKorpu', 'refresh');
    }

    function izbaciIzKorpe() {
        $this->load->model('korpa_model');
        $this->korpa_model->izbaciIzKorpe($this->user->id);
        redirect('app/prikaziKorpu', 'refresh');
    }

    function isprazniKorpu() {
        $this->load->model('korpa_model');
        $this->korpa_model->isprazniKorpu($this->user->id);
        redirect('app/prikaziKorpu', 'refresh');
    }

    function prikazi_knjigu($id) {
        $this->load->model('knjiga_model');
        $this->load->model('recenzija_model');
        $knjige = $this->knjiga_model->vrati_knjigu($id);
 $naziv="";
        foreach ($knjige as $knjiga) {
            $zanr = $knjiga->zanr;
            $autor = $knjiga->autor;
            $naziv=$knjiga->naziv;
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

    function naruciKnjigu() {
        $this->load->model('korpa_model');
        $this->korpa_model->promeniStatusKnjige($this->user->id);
        redirect('user/prikaziKorpu', 'refresh');
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
                , array("folder" => "app",
            "user" => $this->user,
            "broj" => $this->broj,
            "title" => "Statistike prodaje",
            "page" => "prikazStatistike.php",
        ));
    }

}

?>
