<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
    {
    	parent::__construct();
    	
    }
	public function index()
	{
		if($this->session->userdata('logged_in') =='1'){
			redirect('admin');
		}elseif($this->session->userdata('logged_in') =='2'){
			redirect('recruiter');
		}
		//$this->load->view('includes/header');
		$this->load->view('login');
		//$this->load->view('includes/footer');
	}
	public function login_auth()
	{
		$this->load->model('login_model');
		$user = $this->login_model->GetUser( $_POST['userEmail'] );
        $auth =$this->login_model->wp_check_password($_POST['userEmail'],md5($_POST['password']));
      //  echo $this->db->last_query();
      //  exit();
        if ($auth)
        {
             
            $sessionData = array (
                'username'      =>  $user['name'],
                'userId'        =>  $user['id'],
                'meta_value'    => $user['name'],
                'logged_in'     =>  $auth
            );
            $this->session->set_userdata( $sessionData );
            $this->session->set_flashdata('success', 'Logged in successfully');
            if($auth == '1'){
            	redirect('admin');
            }elseif($auth == '2'){
            	redirect('recruiter');
            }
			
        }else{
        	$this->session->set_flashdata('error', 'Please enter correct Username/Password');
			redirect('login');
        }
	}
	public function logout() 
    {
        session_destroy();
        redirect( base_url('login') );
    }

}
