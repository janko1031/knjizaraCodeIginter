<?php
class Porudzbina_model extends CI_Model
{


  public function __construct()
  {
    parent::__construct();
  }

  /* ------------------------- USERS ------------------------- */


  function dodajPorudzbinu($user_id,$knjige){

    $porudzbina = new Porudzbina_model;

    $porudzbina->user_id =  $user_id;


    $this->db->insert('porudzbina', $porudzbina);
    $porudzbina_id= $this->db->insert_id() ;
    foreach ($knjige as $knjiga) {
      $porudzbina = array(

        'porudzbina_id' =>$porudzbina_id ,
        'knjiga_id' =>$knjiga->id_knjige ,
        ); 
      $this->db->insert('stavka_porudzbine', $porudzbina);
    }



  }
  function odobriPorudzbinu($porudzbina_id){

    $porudzbina = new Porudzbina_model;
    $data = array(
        'status' =>1 ,
       
        ); 
    $this->db->where('id_porudzbine', $porudzbina_id);
    $this->db->update('porudzbina', $data);
  }

}

?>
