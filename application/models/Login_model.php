<?php
class Login_model extends CI_Model 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function getEmailData () 
    {
       $query = $this->db->get('survey_message');

        if ( $query->num_rows() )
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function GetUser( $emailId )
    {
        $query = "SELECT * FROM `cs_users`   WHERE email = '" . $emailId . "'"; 

        $result = $this->db->query( $query );
        
        if($result->num_rows() > 0)
        {
            return $result->result_array()[0];
        }else{
            return FALSE;     
        }

    }
    public function wp_check_password($email, $password){

        $this->db->where('status', '1');
        $this->db->where('email', $email);
        $this->db->where('password', $password);

        $result = $this->db->get('cs_users');
        //echo $this->db->last_query();
        if($result->num_rows() == 1){
            return $result->row(0)->type;
        } else {
            return false;
        }
    }

}