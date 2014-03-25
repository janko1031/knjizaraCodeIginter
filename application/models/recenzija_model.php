
<?php
class Recenzija_model extends CI_Model
{

	public function proscena_ocena($id){
		

		$this->load->model('knjiga_model');
		$recenzije = $this->knjiga_model->vrati_recenzije($id);

		$broj=0;
		$uk=0;
		
		foreach ($recenzije as $result) {
			$uk+=$result->ocena;
			$broj++;
		}
		if (!empty($result)) {
			return $uk/$broj; 
		}
		$uk=0;
		if (empty($result)) {
			return "Nema ocenu";
		}
		
	}
	public  function dodaj_recenziju($user){


		$recenzija = new Recenzija_model;
		$recenzija->opis = $this->input->post('opis');
		$recenzija->ocena = $this->input->post('ocena');
		$recenzija->knjiga_id = $this->input->post('id_knjige');
		$recenzija->user_id =$user;

		$this->db->insert('recenzije', $recenzija); 
		


	}
	public  function ocenjena_knjiga($user,$knjiga){//proverava da li je knjiga vec ocenjena, korisnik moze samo jednom da oceni istu knjigu
		$ocenjenja=false;

		$this->db->select('*');
		$this->db->from('recenzije');
		$this->db->where('knjiga_id', $knjiga);
		$results = $this->db->get()->result();

		if (empty($result)) {        	
			$ocenjenja=false;
		}
		foreach ($results as $result) {
			if ($result->user_id==$user) {
				$ocenjenja= true;
				break;
			}
		}		
		return $ocenjenja;
	}
	public  function izbrisi_recenziju($userId){

		$this->db->where('user_id', $userId);
		$this->db->delete('recenzije'); 

	}

	


}
?>