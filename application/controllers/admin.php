<?php

class Admin extends User_Secure_Controller {

    public function __construct() {
        parent::__construct('admin');
        if (!$this->ion_auth->is_admin()) {
            $this->lang->load('errors');
            show_error($this->lang->line('no_privilegies'));
        }
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function show_user() {

        $this->load->view('template', array(
            "folder" => "admin",
            "page" => "create_user",
            "title" => "Kreiranje novog korisnika",
            "user" => $this->user,
            "groups" => $this->ion_auth->groups()->result(),
            "broj" => $this->broj,
            ));
    }

    function new_user() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'First name...', 'required|min_length[2]');
        $this->form_validation->set_rules('lastname', 'Last name...', 'required');
        $this->form_validation->set_rules('username', 'Username...', 'required|min_length[5]|max_length[100]');
        $this->form_validation->set_rules('password', 'Password...', 'required|min_length[6]|max_length[12]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Repeat password...', 'required');
        //  $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        //  $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
        $this->form_validation->set_rules('email', 'Email...', 'required|valid_email');

        if ($this->form_validation->run()) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = strtolower($this->input->post('email'));
            $additional_data = array(
                'first_name' => $this->input->post('firstname'),
                'last_name' => $this->input->post('lastname'),
                $idGroup = $this->input->post('user-group'),
                'countries_id' => '1'
                );
            $groups = array("groups_id" => $this->input->post('user-group'));

            $this->ion_auth->register($username, $password, $email, $additional_data, $groups);

            redirect('auth/index', 'refresh');
        }

        $this->load->view('template', array(
            "folder" => "app",
            "page" => "create_user",
            "broj" => $this->broj,
            "user" => $this->ion_auth->user()->row(),
            "username" => $this->ion_auth->user()->row()->username,
            "title" => "New User",
            "groups" => $this->ion_auth_model->groups()->result(),
            ));
    }

    function prikazi_sveKorisnike() {
        $this->load->model('admin_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $this->load->view('template', array(
            "folder" => "admin",
            "page" => "spisakKorisnika",
            "broj" => $this->broj,
            'user' => $this->user,
            "users" => $this->admin_model->get_all_users(),
            "title" => "Administracija korisnika",
            ));
    }

    function prikazi_adminPanel() {
        $this->load->model('admin_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $this->load->view('template', array(
            "folder" => "admin",
            "page" => "admin_panel",
            "broj" => $this->broj,
            "users" => $this->admin_model->get_all_users(),
            'user' => $this->user,
            "title" => "Admin panel",
            ));
    }

    function prikazi_uploadSlike() {
        $this->load->view('template', array(
            "folder" => "admin",
            "page" => "upload_slike",
            "broj" => $this->broj,
            "user" => $this->user,
            "title" => "Upload slike",
            ));
    }

    function uploaduj_sliku() {
        $config['upload_path'] = './assets/img/knjige/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['max_width'] = '1440';
        $config['max_height'] = '1000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $data = array('data' => $this->upload->display_errors());

            $this->load->view('admin/uspesan_upload_slike', $data);
        } else {


            //$this->upload->display_errors() je niz pravimo jos jedan niz $data
            //koji ima jedan clan, a taj clan je niz.

            $id_knjige = "1";
            $data = array('data' => $this->upload->data()); // prva opcija dva foreacha
            foreach ($data as $array) {

                $img_name = $array['file_name'];
            }
            /* $data1= $this->upload->data();  // opcija DVA

            $img = $data1['file_name']; */

            $this->db->set('img_name', $img_name);
            $this->db->set('knjiga_id', $id_knjige);
            $this->db->insert('slike');

            $this->load->view('admin/uspesan_upload_slike', $data);
        }
    }

    function prikazi_unosKnjige() {
        $this->load->view('template', array(
            "folder" => "admin",
            "page" => "unos_knjige",
            "broj" => $this->broj,
            "user" => $this->user,
            "title" => "Unos nove knjige",
            ));
    }

    function unesi_knjigu() {

        $this->load->model('knjiga_model');
        $this->knjiga_model->dodajknjigu();
        $this->knjiga_model->dodajSliku();
        redirect('user/prikaziKatalog', 'refresh');
    }

    function prikazi_Porudzbine() {


        $this->load->model('korpa_model');
        $this->load->view('template', array(
            "folder" => "admin",
            "page" => "narucene_knjige",
            'user' => $this->user,
            "title" => "Adminsitracija porudžbina",
            "porudzbine" => $this->korpa_model->vratiPorudzbine(),
            "broj" => $this->broj,
           
            ));
    }

    function odobri_kupovinu() {

        $user_id = $this->input->post('user_id');
        $knjiga_id = $this->input->post('id_knjige');

        $this->load->model('narudzbina_model');
        $this->narudzbina_model->odobri_knjigu($user_id, $knjiga_id);
        $this->load->model('korpa_model');
        $this->korpa_model->izbrisiIzKorpe($user_id, $knjiga_id);
        $this->load->model('knjiga_model');
        $this->load->model('user_model');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'knjizaraatlantis@gmail.com';
        $config['smtp_pass'] = 'knjizaraatlant213';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);
        $title = "Odobrena kupovina";

        $knjiga = $this->knjiga_model->vrati_knjigu($knjiga_id);
        $korisnik = $this->user_model->vratiKorisnika($user_id);
        foreach ($knjiga as $k) {
            $naziv = $k->naziv;
        }
        foreach ($korisnik as $k) {
            $user = $k->first_name;
            $email = $k->email;
        }
        $title = "Odobrena kupovina: " . $naziv;
        $message = $user . ', vaša kupovina je odobrena.';
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('knjizaraatlantis91@gmail.com'); // change it to yours
        $mejl = $email;
        $this->email->to($mejl); // change it to yours
        $this->email->subject($title);
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }


        redirect('admin/prikazi_naruceneKnjige', 'refresh');
    }

    function odobri_SveKnjige() {

        $this->load->model('narudzbina_model');
        $this->load->model('korpa_model');


        $this->load->model('knjiga_model');
        $this->load->model('user_model');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user'] = 'knjizaraatlantis@gmail.com';
        $config['smtp_pass'] = 'knjizaraatlant213';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'text'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);


        $naruceneKnjige = $this->korpa_model->vratiNarucene();
        foreach ($naruceneKnjige as $narucenaKnjiga) {

            $this->narudzbina_model->odobri_knjigu($narucenaKnjiga->user_id, $narucenaKnjiga->knjiga_id);

            $this->korpa_model->izbrisiIzKorpe($narucenaKnjiga->user_id, $narucenaKnjiga->knjiga_id);

            //slanje mejlova
            $title = "Odobrena kupovina: " . $narucenaKnjiga->naziv;
            $message = $narucenaKnjiga->first_name . ', vaša kupovina je odobrena.';
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('knjizaraatlantis91@gmail.com'); // change it to yours
            $mejl = $narucenaKnjiga->email;
            $this->email->to($mejl); // change it to yours
            $this->email->subject($title);
            $this->email->message($message);
            if ($this->email->send()) {
                echo 'Email sent.';
            } else {
                show_error($this->email->print_debugger());
            }
        }






        redirect('admin/prikazi_naruceneKnjige', 'refresh');
    }

    public function prikazi_editUsera($id) {
      $this->load->model('user_model');


      $this->load->view('template', array(
        "folder" => "admin",
        "page" => "izmenaKorisnika",
        "title" => "Izmena korisnika",
        "user" => $this->user,
        "editUser"=>$this->user_model->vratiKorisnika($id),
        "groups" => $this->ion_auth->groups()->result(),
        "broj" => $this->broj,
        ));
  }

  function edit_user($id) {


    if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() )) {
        redirect('auth', 'refresh');
    }

    $data = array(
        'first_name' => $this->input->post('firstname'),
        'last_name' => $this->input->post('lastname'),
        'username' => $this->input->post('username'),
        'email' => $this->input->post('email'),
        );



    $this->ion_auth->update($id, $data);



    $this->load->model('admin_model');

    $this->load->view('template', array(
        "folder" => "admin",
        "page" => "spisakKorisnika",
        "broj" => $this->broj,
        'user' => $this->user,
        "users" => $this->admin_model->get_all_users(),
        "title" => "Svi korisnici",
        ));
}
function izmeniStatus($id) {   



    $add=1;
    $remove=2;
    if ( $this->ion_auth->is_admin($id)) {
      $add=2;
      $remove=1;
  }    
  $this->ion_auth->remove_from_group($remove, $id);

  $this->ion_auth->add_to_group($add, $id);

  redirect('admin/prikazi_sveKorisnike', 'refresh');

}
function izbrisiKorisnika($id) {

    $this->ion_auth->delete_user($id);
    redirect('admin/prikazi_sveKorisnike', 'refresh');

}

function odobriPorudzbinu($id_porudzbine) {
        $this->load->model('porudzbina_model');
        $this->porudzbina_model->odobriPorudzbinu($id_porudzbine);
        redirect('admin/prikazi_Porudzbine', 'refresh');

}

}

?>
