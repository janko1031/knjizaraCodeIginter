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

    	$result= $this->db->get_where('korpa', array('user_id' => $user_id))->result(0);
    	
    	if(empty($result)){
    		return true;
    	}
    	else return false;
    	}
        function isprazniKorpu($user_id)
    	{
        $this->load->library('form_validation');
        $id_knjige = $this->input->post('id_knjige');
        $data = array(
          'user_id' => $user_id ,
        // 'knjiga_id' => $knjiga ,
         
         );
        $this->db->where($data);
        $this->db->delete('korpa'); 

        $this->load->model('knjiga_model');
        $this->knjiga_model->povecajKolicinu($id_knjige);  
           
         
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
      
}
?>
