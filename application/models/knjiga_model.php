<?php
class Knjiga_model extends CI_Model
    {


        public function __construct()
        {
            parent::__construct();
        }


        
          function vratiKnjige()
        {return $this->db->get('knjige')->result();
        }
       
            }

?>
