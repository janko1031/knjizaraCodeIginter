<?php
class Knjiga_model extends CI_Model
    {


        public function __construct()
        {
            parent::__construct();
        }


        
          function vratiKnjige()
        {return $this->db->get('knjige')->result();// vraca sve knjige

        }
       


          function vratiKolicinu($id)
        {
        	    $this->db->select('kolicina','dostupnost'); 
   				$this->db->from('knjige');   
   				$this->db->where('id_knjige', $id);
    			$row= $this->db->get()->result();
    			foreach ($row as $kol) {
              $kolicina= $kol->kolicina;
            }    
            return $kolicina;//vraca broj dostupnih knjiga na skladistu

        }
         function povecajKolicinu($id)
        {
        $id_knjige = $this->input->post('id_knjige');
       
        $kolicina=$this->knjiga_model->vratiKolicinu($id_knjige);    //vraca broj dostupnih knjiga na skladistu
        
        $kolicina+=1;
        $data = array(
               'kolicina' => $kolicina,               
            );

        $this->db->where('id_knjige', $id_knjige);//azurira polje kolicina u tabeli knjige
        $this->db->update('knjige', $data); 
       }
        function smanjiKolicinu($id)
        {
          $id_knjige = $this->input->post('id_knjige');
          $kolicina=$this->knjiga_model->vratiKolicinu($id_knjige);    
        
        $kolicina-=1;
        $data = array(
               'kolicina' => $kolicina,               
            );

        $this->db->where('id_knjige', $id_knjige);
        $this->db->update('knjige', $data ); 
       }
   }

?>
