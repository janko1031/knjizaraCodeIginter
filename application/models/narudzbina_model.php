<?php
class Narudzbina_model extends CI_Model
    {


        public function __construct()
        {
            parent::__construct();
        }

/* ------------------------- USERS ------------------------- */
       
        
      function odobri_knjigu($user_id,$knjiga_id){
         
          $narudzbina = new Narudzbina_model;
         
        $narudzbina->user_id =  $user_id;
        $narudzbina->knjiga_id = $knjiga_id;
        $this->db->insert('kupljene_knjige', $narudzbina); 

        
      }

            }

?>
