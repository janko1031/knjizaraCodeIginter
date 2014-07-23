<?php

class Kupovina extends User_Secure_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('gcharts');
    }

    function prikazi_porudzbinu($id_porudzbine) {
        $this->load->model('porudzbina_model');
        $p1 = $this->porudzbina_model->vratiPorudzbinu($id_porudzbine);
        $ispis;
        $title;
        foreach ($p1 as $p) {
            if ($p->status == 0) {
                $ispis = "porudžbine";
                $title = "Detaljni prikaz poruzdbine";
            }
            if ($p->status == 1) {
                $ispis = "kupovine";
                $title = "Detaljni prikaz kupovine";
            }
        }
        $this->load->view('template', array(
            "folder" => "user",
            "page" => "prikaz_porudzbine",
            'user' => $this->user,
            "title" => $title,
            "stavke" => $this->porudzbina_model->vratiStavkePorudzbine($id_porudzbine),
            "porudzbina" => $this->porudzbina_model->vratiPorudzbinu($id_porudzbine),
            "cenaPorudzbine" => $this->porudzbina_model->vrati_cenu_porudzbine($id_porudzbine),
            "id_porudzbine" => $id_porudzbine,
            "broj" => $this->broj,
            "ispis" => $ispis
        ));
    }

    function prikazi_kupovineKorisnika() {
        $this->load->model('porudzbina_model');

        $this->load->view('template', array(
            "folder" => "user",
            "page" => "kupovine_korisnika",
            'user' => $this->user,
            "title" => "Pregled istorije naručivanja",
            "porudzbine" => $this->porudzbina_model->vratiPorudzbineKorisnika($this->user->id),
            "kupljene" => $this->porudzbina_model->vratiOdobrenePorduzbine($this->user->id),
            "broj" => $this->broj,
        ));
    }

    function kupi_knjige() {


        $this->load->model('porudzbina_model');
        $this->load->model('korpa_model');
        $this->load->model('user_model');

        $user_id = $this->user->id;

        $knjige = $this->user_model->vrati_knjigeKorisnika($user_id);
        $this->porudzbina_model->dodajPorudzbinu($user_id, $knjige);
        $this->korpa_model->isprazniKorpu($user_id, $knjige);



        redirect('kupovina/prikazi_kupovineKorisnika', 'refresh');
    }

}

?>