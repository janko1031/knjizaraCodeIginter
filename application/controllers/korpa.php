<?php

class Korpa extends User_Secure_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('gcharts');
    }

    function prikazi_korpu() {
        $this->load->model('user_model');

        $this->load->model('korpa_model');
        $this->load->view('template', array(
            "folder" => "user",
            "page" => "korpa",
            'user' => $this->user,
            "prazna" => $this->korpa_model->isEmpty($this->user->id),
            "title" => "Korpa korsnika",
            "knjige" => $this->user_model->vrati_knjigeKorisnika($this->user->id),
            "broj" => $this->broj,
            "cena" => $this->user_model->vrati_UkCenu($this->user->id),
        ));
    }

    function ubaci_uKorpu($id) {
        $is_ajax = $this->input->post('ajax');

        $this->load->model('korpa_model');
        $this->korpa_model->dodajUKorpu($this->user->id,$id);
        $broj = $this->user_model->vrati_brojKnjiga($this->user->id);
        echo $this->broj + 1;
    }

    function izbaci_izKorpe() {
        $this->load->model('korpa_model');
        $this->korpa_model->izbaciIzKorpe($this->user->id);
        redirect('korpa/prikazi_korpu', 'refresh');
    }

    function isprazni_korpu() {
        $this->load->model('korpa_model');

        $this->load->model('user_model');

        $user_id = $this->user->id;

        $knjige = $this->user_model->vrati_knjigeKorisnika($user_id);
        $this->korpa_model->isprazniKorpu($this->user->id, $knjige);
        redirect('korpa/prikazi_korpu', 'refresh');
    }

}

?>