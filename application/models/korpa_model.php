<?php
class Korpa_model extends CI_Model
    {
    	var $user_id ;
        var $knjiga_id ;
        

        public function __construct()
        {
            parent::__construct();
        }

        function isEmpty($user_id)
    	 { 
        $data = array(
          'user_id' => $user_id ,
          'status_kupovine' => 0,
        ); 
    	   $result= $this->db->get_where('korpa', $data)->result();
    	
    	   if(empty($result)){
    	   	return true;
    	   }
    	   else return false;
    	 }


        function isprazniKorpu($user_id)
    	 {
        $this->load->library('form_validation');
       // $id_knjige = $this->input->post('id_knjige');
        $data = array(
          'user_id' => $user_id ,
         'status_kupovine' => 0 ,
         
         );
          $this->load->model('knjiga_model');

  
           $this->db->select('*');
           $this->db->from('korpa');
           $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
           $this->db->where($data);

          $query = $this->db->get();      

          foreach ($query->result() as $row) {

            $this->knjiga_model->povecajKolicinu($row->id_knjige);  
          }

          $this->db->where($data);
          $this->db->delete('korpa');          
           
         
          redirect('user/prikaziKorpu', 'refresh');      

    	}

      function dodajUKorpu($user_id)
    	{
        $this->load->library('form_validation');
        $id_knjige = $this->input->post('id_knjige');
        $data = array(
          'user_id' => $user_id ,
         'knjiga_id' => $id_knjige ,
         
         );

        $this->db->insert('korpa', $data);

        $this->load->model('knjiga_model');
        $this->knjiga_model->smanjiKolicinu($id_knjige);         
  
         
         redirect('user/prikaziKatalog', 'refresh');        


    }
    function izbaciIzKorpe($user_id)
    {
        $this->load->library('form_validation');
        $id_knjige = $this->input->post('id_knjige');
        $data = array(
          'user_id' => $user_id ,
         'knjiga_id' => $id_knjige ,
         
         );
        $this->db->where($data);
        $this->db->limit(1);
        $this->db->delete('korpa'); 

        $this->load->model('knjiga_model');
        $this->knjiga_model->povecajKolicinu($id_knjige);  
           
         
         redirect('user/prikaziKorpu', 'refresh');        


    }

    function promeniStatusKnjige($user_id){
      $data = array(
          'status_kupovine' => 1,
      );
      
        $this->db->where('user_id', $user_id);
        $this->db->update('korpa', $data);
      
    }

    function vratiNarucene(){

        $data = array(
         
         'status_kupovine' => 1 ,
         
         );
         

  
           $this->db->select('*');
           $this->db->from('korpa');
           $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
           $this->db->join('users', 'korpa.user_id = users.id', 'left');


           $this->db->where($data);

          $query = $this->db->get();      
          return $query->result();

    }
    function vrati_UkCenu()
    {
         $data = array(
         
          'status_kupovine' => 1,
        );    
        $cena=0;
        $this->db->select('cena');
        $this->db->from('korpa');

        $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
        $this->db->where($data); 
        $query = $this->db->get();
        foreach ($query->result() as $result) {
            $cena+=$result->cena;
        }
        return $cena;

    }
      
}
?>
