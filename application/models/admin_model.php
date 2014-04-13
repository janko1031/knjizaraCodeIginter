<?php
class Admin_model extends CI_Model
    {


        public function __construct()
        {
            parent::__construct();
        }

/* ------------------------- USERS ------------------------- */
        function get_all_users()
        {
            return $this->db->get('users')->result();
        }
        
        function remove_user()
        {
            $user_id = $this->input->post('user_id');
            $this->db->delete('users', array('id' => $user_id));       
        }
      

            }

?>
