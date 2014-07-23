<?php

class Knjiga extends User_Secure_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('gcharts');
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
            "folder" => "user",
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


}

?>