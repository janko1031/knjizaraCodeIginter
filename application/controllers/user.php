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
          "user" => $this->user,
          "page" => "katalog",
          "knjige" => $this->knjiga_model->vrati_podatke_za_katalog(),
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

       function prikazi_knjigu()
      {
         $this->load->model('knjiga_model');
            $this->load->model('recenzija_model');
         $knjige = $this->knjiga_model->vrati_knjigu(6);
           
          foreach ($knjige as $knjiga) {
            $zanr=$knjiga->zanr;
            $autor=$knjiga->autor;
           // $naziv=$knjiga->naziv;
          }

         $this->load->view('template', array(

           "folder" => "app",
           "page" => "knjiga",
           "user" => $this->user,
           "knjige" => $knjige,
           "slicne" => $this->knjiga_model->vrati_slicneKnjige(6,$zanr,$autor),
           "recenzije" => $this->knjiga_model->vrati_recenzije(6),
           "ocena" => $this->recenzija_model->proscena_ocena(6),
           "ocenjena" => $this->recenzija_model->ocenjena_knjiga($this->user->id,6),

           "title" => "Prikaz knjige",
           "broj" => $this->broj,                

       ));
      }
    function ostaviRecenziju()
  {
    $this->load->model('recenzija_model');
    $this->recenzija_model->dodaj_recenziju($this->user->id,6);
    redirect('user/prikazi_knjigu', 'refresh');
  }  

  function izbrisi_recenziju()
  {
    $this->load->model('recenzija_model');
    $this->recenzija_model->izbrisi_recenziju($this->user->id,6);
    redirect('user/prikazi_knjigu', 'refresh');
  }   
    }
?>
