<?php
class Knjiga_model extends CI_Model
    {

       /*var $naziv ;
       var $autor ;
       var $zanr ;
       var $godina ;
       var $izdavac;
       var $opis ;
       var $br_strana;
       var $cena ;
       var $kolicina ;
*/


        public function __construct()
        {
            parent::__construct();
        }


        
          function vratiKnjige()
        {
        return $this->db->get('knjige')->result();// vraca sve knjige

        }
       


          function vratiKolicinu($id)
        {
        	$this->db->select('kolicina'); 
   				$this->db->from('knjige');   
   				$this->db->where('id_knjige', $id);
    			$row= $this->db->get()->result();
    			foreach ($row as $kol) {
              $kolicina= $kol->kolicina;
            }    
            return $kolicina;//vraca broj dostupnih knjiga na skladistu

        }
         function povecajKolicinu($id_knjige)
        {
        //$id_knjige = $this->input->post('id_knjige');
       
        $kolicina=$this->knjiga_model->vratiKolicinu($id_knjige);    //vraca broj dostupnih knjiga na skladistu
        
        $kolicina+=1;
        $data = array(
               'kolicina' => $kolicina,               
            );

        $this->db->where('id_knjige', $id_knjige);//azurira polje kolicina u tabeli knjige
        $this->db->update('knjige', $data); 
       }
        function smanjiKolicinu($id_knjige)
        {
         // $id_knjige = $this->input->post('id_knjige');
          $kolicina=$this->knjiga_model->vratiKolicinu($id_knjige);    
        
        $kolicina-=1;
        $data = array(
               'kolicina' => $kolicina,               
            );

        $this->db->where('id_knjige', $id_knjige);
        $this->db->update('knjige', $data ); 
       }
       function dodajknjigu()
        {

        $knjiga = new Knjiga_model;
        $knjiga->naziv = $this->input->post('naziv');
        $knjiga->autor = $this->input->post('autor');
        $knjiga->zanr = $this->input->post('zanr');
        $knjiga->godina_izdanja = $this->input->post('godina_izdanja');
        $knjiga->izdavac = $this->input->post('izdavac');
        $knjiga->opis = $this->input->post('opis');
        $knjiga->br_strana = $this->input->post('br_strana');
        $knjiga->cena = $this->input->post('cena');
        $knjiga->kolicina = $this->input->post('kolicina');
        

        $this->db->insert('knjige', $knjiga); 
        }


          function dodajSliku()
        {

        $naziv = $this->input->post('naziv');
        $query = $this->db->get_where('knjige', array('naziv' => $naziv), 1)->result();
        foreach ($query as $row) {
           $id_knjige =$row->id_knjige;
        }
 
        $config['upload_path'] = './assets/img/knjige/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width']  = '1368';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data = array('data' => $this->upload->display_errors()); 

            $this->load->view('admin/uspesan_upload_slike', $data);
        }
        else
        {         
              
                                                              //$this->upload->display_errors() je niz pravimo jos jedan niz $data
                                                             //koji ima jedan clan, a taj clan je niz.
                                                            
      
         $data = array('data' => $this->upload->data());// prva opcija dva foreacha
            foreach ($data as $array){             
               
                 $img_name = $array['file_name'];                
             
            }
              /*$data1= $this->upload->data();  // opcija DVA
              
                 $img = $data1['file_name'];    */            
             
                    $this->db->set('img_name', $img_name);
                    $this->db->set('knjiga_id', $id_knjige);
                    $this->db->insert('slike');
           
           $this->load->view('admin/uspesan_upload_slike',$data);
        }
      }

      function vrati_podatke_za_katalog(){
        $this->db->select('*');
        $this->db->from('slike');
        $this->db->join('knjige', 'slike.knjiga_id = knjige.id_knjige', 'right');

        $query = $this->db->get();

        return $query->result();
      }
       function vrati_knjigu($id){
        $this->db->select('*');
        $this->db->from('knjige');
        $this->db->join('slike', 'slike.knjiga_id = knjige.id_knjige', 'left');
        $this->db->where('id_knjige', $id);
        $query = $this->db->get();

        return $query->result();
      }

       function vrati_slicneKnjige($id,$zanr,$autor){
       
      
        $this->db->select('*');
        $this->db->from('knjige');
        $this->db->join('slike', 'slike.knjiga_id = knjige.id_knjige', 'left');
        $this->db->where('id_knjige', $id);
        $this->db->like('zanr', $zanr);
        $this->db->or_like('autor', $autor);
        //$this->db->not_like('naziv', $naziv);

        $this->db->limit(6); 
        $query = $this->db->get();

        return $query->result();
      }

   
    function vrati_recenzije($id){

        $this->db->select('recenzije.*,users.*');
        $this->db->from('recenzije');
        $this->db->join('knjige', 'recenzije.knjiga_id = knjige.id_knjige', 'left');
        $this->db->join('users', 'recenzije.user_id = users.id', 'left');
        $this->db->where('id_knjige', $id);
        $query = $this->db->get();

        return $query->result();
      }
       
}
?>
