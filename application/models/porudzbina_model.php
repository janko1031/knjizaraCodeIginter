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
  function vratiSvePorudzbine() {
         $data = array(
            'status' => 0,
        );
        $this->db->select('*');
        $this->db->from('porudzbina');
         $this->db->where($data);
        $this->db->join('users', 'porudzbina.user_id = users.id', 'left');
       /* $this->db->join('stavka_porudzbine', 'stavka_porudzbine.porudzbina_id = porudzbina.id_porudzbine', 'left');
        $this->db->join('knjige', 'knjige.id_knjige = stavka_porudzbine.knjiga_id', 'left');
*/
        $query = $this->db->get();
        return $query->result();
    }

     function vratiStavkePorudzbine($id_porudzbine) {
         $data = array(
            'porudzbina_id' => $id_porudzbine,
        );
        $this->db->select('*');
        $this->db->from('stavka_porudzbine');
        $this->db->where($data); 
        $this->db->join('knjige', 'knjige.id_knjige = stavka_porudzbine.knjiga_id', 'left');   
        $this->db->join('slike', 'slike.knjiga_id = knjige.id_knjige', 'left');
  
        $query = $this->db->get();
        return    $query->result();;
    }
    function vratiPorudzbinu($id_porudzbine) {
         $data = array(
            'id_porudzbine' => $id_porudzbine,
        );
        $this->db->select('*');
        $this->db->from('porudzbina');
        $this->db->where($data); 
        $this->db->join('users', 'porudzbina.user_id = users.id', 'left');
        $query = $this->db->get();
        return    $query->result();;
    }

      function vrati_cenu_porudzbine($id_porudzbine) {
         $data = array(
            'porudzbina_id' => $id_porudzbine,
        );
        $cena = 0;
        $this->db->select('cena');
        $this->db->from('stavka_porudzbine');
        $this->db->where($data); 
        $this->db->join('knjige', 'knjige.id_knjige = stavka_porudzbine.knjiga_id', 'left');   
        $query = $this->db->get();
        foreach ($query->result() as $result) {
            $cena+=$result->cena;
        }
        return $cena;
    }
    function vratiPorudzbineKorisnika($user_id) {
         $data = array(
            'user_id' => $user_id,
            'status' => 0,
        );
        $this->db->select('*');
        $this->db->from('porudzbina');
        $this->db->where($data); 
         $query = $this->db->get();
        return    $query->result();
    }
     function vratiOdobrenePorduzbine($user_id) {
         $data = array(
            'user_id' => $user_id,
            'status' => 1,
        );
        $this->db->select('*');
        $this->db->from('porudzbina');
        $this->db->where($data);        

        $query = $this->db->get();
        return    $query->result();
    }

    function vratiKnjigePorudzbine($porudzbina_id){
      
      $data = array(
            'porudzbina_id' => $porudzbina_id,          
        );
        $this->db->select('*');
        $this->db->from('stavka_porudzbine');
        $this->db->where($data); 
        $this->db->join('knjige', 'knjige.id_knjige = stavka_porudzbine.knjiga_id', 'left');
        $this->db->join('slike', 'slike.knjiga_id = knjige.id_knjige', 'left');
    }
   
}

?>
