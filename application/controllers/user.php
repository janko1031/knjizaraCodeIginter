<?php


class User extends  User_Secure_Controller
{


    public function __construct()
    {
        parent::__construct();

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

    }


  
   
   function prikaziKorpu()
   {
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
      "cena"=>$this->user_model->vrati_UkCenu($this->user->id),

      ));
}   
      function profil()
      {

    $this->load->view('template', array(

       "folder" => "app",
       "page" => "profil",
       'user' => $this->user,
    
       "title" => "Profil korisnika: ".$this->user->username,
       "broj" => $this->broj,                

       ));
      }   
     function prikaziKatalog()
    {
       $this->load->model('knjiga_model');
       $this->load->view('template', array(
       "folder" => "app",
        'user' => $this->user,
           "page" => "katalog",
       "knjige"=>$this->knjiga_model->vratiKnjige(),

       "username" => $this->user->username,
       "title" => "Katalog knjiga",
       "broj" => $this->broj,


       ));
      }   
      function ubaciUKorpu()
      {
       $this->load->model('korpa_model');
       $this->korpa_model->dodajUKorpu($this->user->id);
       redirect('app/prikaziKorpu', 'refresh');
      }   
       function izbaciIzKorpe()
       {
       $this->load->model('korpa_model');
       $this->korpa_model->izbaciIzKorpe($this->user->id);
       redirect('app/prikaziKorpu', 'refresh');
      }   
      function isprazniKorpu()
       {
       $this->load->model('korpa_model');
       $this->korpa_model->isprazniKorpu($this->user->id);
       redirect('app/prikaziKorpu', 'refresh');
      }   
    }
?>
