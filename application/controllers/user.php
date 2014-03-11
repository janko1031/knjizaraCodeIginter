<?php


class User extends  User_Secure_Controller
{


    public function __construct()
    {
        parent::__construct('admin');

        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

    }


    
    public function show_user(){

       $this->load->view('template', array(
        "folder" => "app",
        "page" => "create_user",
        "title" => "Kreiranje novog korisnika",
        "user" => $this->user,
        "username" => $this->user->username,
        "groups"=>$this->ion_auth->groups()->result(),
        "broj" => $this->broj,

        ));
   }
   
   function prikaziKorpu()
   {
    $this->load->model('user_model');
    $this->load->view('template', array(
      "folder" => "app",

      "page" => "korpa",
      'user' => $this->user,
      "username" => $this->ion_auth->user()->row()->username,
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
       "username" => $this->user->row()->username,
       "title" => "Profil korisnika: ".$this->user->row()->username,
       "broj" => $this->broj,                

       ));
      }   
     function prikaziKatalog()
    {
       $this->load->model('knjiga_model');
       $this->load->view('template', array(
       "folder" => "app",

       "page" => "katalog",
       "knjige"=>$this->knjiga_model->vratiKnjige(),

       "username" => $this->ion_auth->user()->row()->username,
       "title" => "Katalog knjiga",
       "broj" => $this->broj,


       ));
      }   
      function ubaciUKorpu()
      {
       $this->load->model('user_model');
       $this->user_model->dodajUKorpu($this->user->id);
       redirect('app/prikaziKorpu', 'refresh');
      }   
       function izbaciIzKorpe()
       {
       $this->load->model('user_model');
       $this->user_model->izbaciIzKorpe($this->user->id);
       redirect('app/prikaziKorpu', 'refresh');
      }   
    }
?>
