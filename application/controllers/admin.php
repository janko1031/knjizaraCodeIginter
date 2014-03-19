<?php


class Admin extends  User_Secure_Controller
{


    public function __construct()
    {
        parent::__construct('admin');
        if (!$this->ion_auth->is_admin())
        {
            $this->lang->load('errors');
            show_error($this->lang->line('no_privilegies'));
        }
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');

    }

    public function show_user(){

      $this->load->view('template', array(
        "folder" => "app",
        "page" => "create_user",
        "title" => "Kreiranje novog korisnika",
        "user" => $this->user,
        
        "groups"=>$this->ion_auth->groups()->result(),
        "broj" => $this->broj,

        ));
  }
  function new_user()
  {
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
    {
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

    if ($this->form_validation->run())
    {

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = strtolower($this->input->post('email'));
        $additional_data = array(
            'first_name' => $this->input->post('firstname'),
            'last_name' => $this->input->post('lastname'),
            $idGroup = $this->input->post('user-group'), 
            'countries_id' => '1'
            );
        $groups= array( "groups_id" => $this->input->post('user-group'));

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

function prikazi_sveKorisnike()

{
    $this->load->model('admin_model');
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
    {
        redirect('auth', 'refresh');
    }

    $this->load->view('template', array(
       "folder" => "app",
       "page" => "korisnici",
       "broj" => $this->broj,
       'user' => $this->user,

       "users" => $this->admin_model->get_all_users(),

       "title" => "Svi korisnici",

       ));
}
function prikazi_adminPanel()

{
    $this->load->model('admin_model');
    if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
    {
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
function prikazi_uploadSlike()

{
  $this->load->view('template', array(
   "folder" => "admin",
   "page" => "upload_slike",
   "broj" => $this->broj,
   "user" => $this->user,
   "title" => "Upload slike",

   ));
}
function uploaduj_sliku()

{
    $config['upload_path'] = './assets/img/knjige/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $data = array('data' => $this->upload->display_errors());

            $this->load->view('admin/uspesan_upload_slike', $data);
        }
        else
        {
            $data = array('data' => $this->upload->data());



            foreach ($data as $item => $value):
                if($item=="file_name"){
                    static $img = $value;
                    static $id = "1";

                    
                }
                $this->db->set('img_name', $img);
                    $this->db->set('knjiga_id', $id);
                    $this->db->insert('slike');
            endforeach;
                
            

            $this->load->view('admin/uspesan_upload_slike',$data);
        }


  }


}
?>
