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
    $this->load->library('pagination');

    $config['base_url'] = base_url() ."user/prikaziKatalog/";
    $config['total_rows'] = $this->knjiga_model->broj_rezultata(); 
    $config['per_page'] = 8;
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    $this->pagination->initialize($config);


    $links= $this->pagination->create_links();


    $this->load->view('template_safilterom', array(
      "folder" => "app",
      "user" => $this->user,
      "page" => "katalog",
      "knjige" => $this->knjiga_model->vrati_podatke_za_katalog($config["per_page"], $page),
      "title" => "Katalog knjiga",
      "broj" => $this->broj,
      "imaFilter"=>true,
      "links"=>$links,
      ));
  } 

  function ubaciUKorpu()
  {
    $is_ajax=$this->input->post('ajax');

    $this->load->model('korpa_model');
    $this->korpa_model->dodajUKorpu($this->user->id);
      // redirect('app/prikaziKorpu', 'refresh');
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
 function prikazi_knjigu($id)
 {
   $this->load->model('knjiga_model');
   $this->load->model('recenzija_model');
   $knjige = $this->knjiga_model->vrati_knjigu($id);

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
   "slicne" => $this->knjiga_model->vrati_slicneKnjige($id,$zanr,$autor),
   "recenzije" => $this->knjiga_model->vrati_recenzije($id),
   "ocena" => $this->recenzija_model->proscena_ocena($id),
   "ocenjena" => $this->recenzija_model->ocenjena_knjiga($this->user->id,$id),

   "title" => "Prikaz knjige",
   "broj" => $this->broj,                

   ));
}
function napisi_recenziju()

{
  $recenzija = $this->input->post('id_knjige');

  $this->load->model('recenzija_model');
  $this->recenzija_model->dodaj_recenziju($this->user->id);
  $url='user/prikazi_knjigu/'.$recenzija;
  redirect( $url, 'refresh');
}  

function izbrisi_recenziju()
{
  $recenzija = $this->input->post('id_knjige');
  $url='user/prikazi_knjigu/'.$recenzija;
  $this->load->model('recenzija_model');
  $this->recenzija_model->izbrisi_recenziju($this->user->id);
  redirect($url, 'refresh');
}   

function naruciKnjigu(){
  $this->load->model('korpa_model');
  $this->korpa_model->promeniStatusKnjige($this->user->id);
  redirect('user/prikaziKorpu', 'refresh');
}
function prikaziCenu()
{
  $this->load->model('knjiga_model');



  $this->load->view('template_safilterom', array(
    "folder" => "app",
    "user" => $this->user,
    "page" => "katalog",
    "knjige" => $this->knjiga_model->pretraziPoCeni(),
    "title" => "Katalog knjiga",
    "broj" => $this->broj,
    "links"=>"",
    ));
}


function prikaziRezultatePretrage( $offset=0)
{
  $this->load->model('knjiga_model');
  $keyword=$this->input->post('poljePretrage') ;
  $this->load->library('pagination');

  $config['base_url'] = base_url() ."user/prikaziRezultatePretrage/";
  $config['total_rows'] = $this->knjiga_model->brojRezultataPretrage($keyword); 
  $config['per_page'] = 8;
     $config['uri_segment']    = 3;
  $offset = (int) $offset;
  $page= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
  $this->pagination->initialize($config);


  $links= $this->pagination->create_links();

  $knjige=$this->knjiga_model->pretrazi($keyword, $offset);
  if(empty($keyword)) {
    $knjige= array ();
    $links="";
  }
  $this->load->view('template_safilterom', array(
    "folder" => "app",
    "user" => $this->user,
    "page" => "katalog",
    "knjige" => $knjige,
    "keyword"=>$this->input->post('poljePretrage') ,
    "title" => "Pretraga knjiga",
    "broj" => $this->broj,
    "links"=>$links,
    ));
} 

function prikaziPoZanru()
{
  $this->load->model('knjiga_model');
  $zanr=$this->input->post('zanrSelect') ;
  $this->load->library('pagination');

  $config['base_url'] = base_url() ."user/prikaziPoZanru/";
  $config['total_rows'] = $this->knjiga_model->brojPoZanru($zanr); 
  $config['per_page'] = 8;


  $this->pagination->initialize($config);


  $links= $this->pagination->create_links();

  $knjige=$this->knjiga_model->filtrirajPoZanru($zanr);
 /* if(is_null($zanr)) {
    $knjige= array ();
  }*/
  $this->load->view('template_safilterom', array(
    "folder" => "app",
    "user" => $this->user,
    "page" => "katalog",
    "knjige" => $knjige,
    "keyword"=>$this->input->post('poljePretrage') ,
    "title" => "Knjige žanra: ".$zanr,
    "zanr" => $zanr,
    "broj" => $this->broj,
    "links"=>"",
    ));
} 

}
?>
