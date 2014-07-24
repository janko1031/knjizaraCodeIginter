<?php

class Katalog extends User_Secure_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->helper('url');
    }

    function prikazi_katalog() {
        $this->load->model('knjiga_model');
        $this->load->library('pagination');

        $config['base_url'] = base_url() . "katalog/prikazi_katalog/";
        $config['total_rows'] = $this->knjiga_model->broj_rezultata();
        $config['per_page'] = 8;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $this->pagination->initialize($config);


        $links = $this->pagination->create_links();


        $this->load->view('template_safilterom', array(
            "folder" => "user",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $this->knjiga_model->vrati_podatke_za_katalog($config["per_page"], $page),
            "title" => "Katalog knjiga",
            "broj" => $this->broj,
            "val" => " din",
            "imaFilter" => true,
            "links" => $links,
        ));
    }

    function filtriraj_poCeni() {
        $this->load->model('knjiga_model');

        $this->load->view('template_safilterom', array(
            "folder" => "app",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $this->knjiga_model->pretraziPoCeni(),
            "title" => "Katalog knjiga",
            "broj" => $this->broj,
            "val" => "din",
            "links" => "",
        ));
    }

    function prikazi_rezultatePretrage($offset = 0) {
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
            "folder" => "user",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $knjige,
            "keyword" => $this->input->post('poljePretrage'),
            "title" => "Pretraga knjiga",
            "broj" => $this->broj,
            "val" => "din",
            "links" => $links,
        ));
    }

    function prikazi_poZanru() {
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
            "folder" => "user",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $knjige,
            "keyword" => $this->input->post('poljePretrage'),
            "title" => "Knjige Å¾anra: " . $zanr,
            "zanr" => $zanr,
            "broj" => $this->broj,
            "val" => "din",
            "links" => "",
        ));
    }

    public function konverzija($id_knjige) {
        $this->load->model('knjiga_model');

        $knjige = $this->knjiga_model->vrati_knjigu($id_knjige);
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

    public function vrati_dnevniKurs() {
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

    public function vrati_knjigeSaParametrom($valuta, $limit, $start) {
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
            $this->db->select('knjige.cena/' . $this->vrati_dnevniKurs() . ' as cena', false);
            $this->db->from('knjige');

            $this->db->limit($limit, $start);
            $this->db->join('slike', 'knjige.id_knjige = slike.knjiga_id', 'left');
            $this->db->order_by("br_strana", "desc");
            $query = $this->db->get();

            return $query->result();
        }
    }

    function prikazi_katalogValute() {

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
            "folder" => "user",
            "user" => $this->user,
            "page" => "katalog",
            "knjige" => $this->vrati_knjigeSaParametrom($valuta, $config["per_page"], $page),
            "title" => "Katalog knjiga",
            "broj" => $this->broj,
            "val" => $val,
            "imaFilter" => true,
            "links" => $links,
        ));
    }

}

?>