<?php

class Korpa_model extends CI_Model {

    var $user_id;
    var $knjiga_id;

    public function __construct() {
        parent::__construct();
    }

    function isEmpty($user_id) {
        $data = array(
            'user_id' => $user_id,
            
        );
        $result = $this->db->get_where('korpa', $data)->result();

        if (empty($result)) {
            return true;
        } else
            return false;
    }

    

    function dodajUKorpu($user_id) {
        $this->load->library('form_validation');
        $id_knjige = $this->input->post('id_knjige');
        $data = array(
            'user_id' => $user_id,
            'knjiga_id' => $id_knjige,
        );

        $this->db->insert('korpa', $data);

        $this->load->model('knjiga_model');
        $this->knjiga_model->smanjiKolicinu($id_knjige);


        //redirect('user/prikaziKatalog', 'refresh');        
    }

    function izbaciIzKorpe($user_id) {
        $this->load->library('form_validation');
        $id_knjige = $this->input->post('id_knjige');

        $data = array(
            'user_id' => $user_id,
            'knjiga_id' => $id_knjige,
        );
        $this->db->where($data);
        $this->db->limit(1);
        $this->db->delete('korpa');

        $this->load->model('knjiga_model');
        $this->knjiga_model->povecajKolicinu($id_knjige);


        redirect('user/prikaziKorpu', 'refresh');
    }

    function promeniStatusKnjige($user_id) {
        $data = array(
            'status_kupovine' => 1,
        );

        $this->db->where('user_id', $user_id);
        $this->db->update('korpa', $data);
    }
     function isprazniKorpu($user_id, $knjige) {
        $this->load->library('form_validation');
        $id_knjige = $this->input->post('id_knjige');
        foreach ($knjige as $knjiga) {
           $data = array(
            'user_id' => $user_id,
            'knjiga_id' => $knjiga->id_knjige ,
        );
        $this->db->where($data);
        $this->db->delete('korpa');

        $this->load->model('knjiga_model');
        $this->knjiga_model->povecajKolicinu($knjiga->id_knjige);
        }
       

    }
  
    function vrati_UkCenu() {
        
        $cena = 0;
        $this->db->select('cena');
        $this->db->from('korpa');

        $this->db->join('knjige', 'korpa.knjiga_id = knjige.id_knjige', 'left');
        $query = $this->db->get();
        foreach ($query->result() as $result) {
            $cena+=$result->cena;
        }
        return $cena;
    }

    function izbrisiIzKorpe($user_id, $knjiga_id) {
        $this->load->library('form_validation');
        $data = array(
            'user_id' => $user_id,
            'knjiga_id' => $knjiga_id,
        );
        $this->db->where($data);
        $this->db->limit(1);
        $this->db->delete('korpa');
    }

}

?>
