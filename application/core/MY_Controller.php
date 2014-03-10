<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

   class User_Controler extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
           
            $this->load->library('ion_auth');
                $this->load->helper('form');
        }

    }

    class User_Secure_Controller extends User_Controler
    {

        protected $user;
        protected   $broj  ;

        public function __construct($model_name = 'developer')
        {
            parent::__construct();
            $this->load->model('user_model');

            if (!$this->ion_auth->logged_in())
            {
                redirect('login');
            } 
            $this->user = $this->ion_auth->user()->row(); 
            $this->broj=$this->user_model->vrati_brojKnjiga($this->user->id);
        }
    }


?>
