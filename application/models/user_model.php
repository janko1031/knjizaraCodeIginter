<?php
class User_model extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }



    function vrati_knjigeKorisnika($user_id)
    {
        $this->db->select('*');
        $this->db->from('korpa');

        $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
        $this->db->where('user_id', $user_id); 
        $query = $this->db->get();
        return $query->result();
    }
    function vrati_brojKnjiga($user_id)
    {
        $this->db->select('*');
        $this->db->from('korpa');

        $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
        $this->db->where('user_id', $user_id); 
        return $this->db->count_all_results();
    }
    function vrati_UkCenu($user_id)
    {
        $cena=0;
        $this->db->select('cena');
        $this->db->from('korpa');

        $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
        $this->db->where('user_id', $user_id); 
        $query = $this->db->get();
        foreach ($query->result() as $result) {
            $cena+=$result->cena;
        }
        return $cena;

    }
    function dodajUKorpu($user_id)
    {
        $this->load->library('form_validation');
        $knjiga = $this->input->post('id_knjige');
        $data = array(
          'user_id' => $user_id ,
         'knjiga_id' => $knjiga ,
         
         );

        $this->db->insert('korpa', $data);     
         
         redirect('user/prikaziKatalog', 'refresh');
        


    }
    function izbaciIzKorpe($user_id)
    {
        $this->load->library('form_validation');
        $knjiga = $this->input->post('id_knjige');
        $data = array(
          'user_id' => $user_id ,
         'knjiga_id' => $knjiga ,
         
         );
        $this->db->where($data);
        $this->db->limit(1);
        $this->db->delete('korpa'); 
        
           
         
         redirect('user/prikaziKorpu', 'refresh');
        


    }





}

?>
