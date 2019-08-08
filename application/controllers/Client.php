<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	$this->load->model('common_model');
    	$this->load->helper('common');

    }
	public function survey($field,$uid)
	{
		$submited =$this->common_model->get_data_row('survey_rating','u_id',$uid);
        if($submited->u_id != $uid){
			$this->load->view('clients/survey');
        }else{
        	$this->session->set_flashdata('success', 'You are submitted already survey form');
            redirect(base_url() . 'client/end');
        } 
	}
	public function saveReviews() 
    {
        $userId = $this->input->post('user_id');
        $form_type = $this->input->post('form_type');
        $interaction = $this->input->post('interaction');
        $submited =$this->common_model->get_data_row('survey_rating','u_id',$userId);
        if($submited->id == $userId){
        	$this->session->set_flashdata('success', 'You are submitted already survey form');
            redirect(base_url() . 'client/end');
        }else{
	        if($this->input->post('submit') == 'Skip'){
	            $data = array (
	                "u_id"       =>  $userId,
	                "date"   =>  date('Y-m-d h:i:sa'),
	                'type' => 'skip',
	                'interaction' =>$interaction,
	                "status"        =>  1
	            );
	            $result = $this->common_model->insert_record($data,'survey_rating');
	        }else{

		        if ( $form_type == 'satisfaction' ) 
		        {
		            for ( $i = 0; $i < sizeof( $_POST['message'] ); $i++ ) 
		            {
		                // Common Helper function
		                $ratingPercentage = getRatingPercentage( $_POST['rating'][$i] );
		                $data = array (
		                    "sur_id"     =>  !empty( $_POST['message'][$i] ) ? $_POST['message'][$i] : NULL,
		                    "u_id"       =>  $userId,
		                    "rating_id"     =>  !empty( $_POST['rating'][$i] ) ? $_POST['rating'][$i] : NULL,
		                    'interaction' =>$interaction,
		                    "description"   =>  !empty( $_POST['description'] ) ? $_POST['description'] : NULL,
		                    "rating_perc"   =>  2,
		                    "date"   =>  date('Y-m-d h:i:sa'),
		                    'type' => $form_type,
		                    "status"        =>  1
		                );
		                $result = $this->common_model->insert_record($data,'survey_rating');
		            }
		               
		           
			    }else{
		        	// Common Helper function
		            $data = array (
		                "u_id"       =>  $userId,
		                "unsatisfac_feedback"     =>  !empty( $_POST['unstatisfactory_feedback'][$i] ) ? $_POST['unstatisfactory_feedback'][$i] : NULL,
		                
		                "description"   =>  !empty( $_POST['description'] ) ? $_POST['description'] : NULL,
		                "date"   =>  date('Y-m-d h:i:sa'),
		                'interaction' =>$interaction,
		                "status"        =>  1
		            );
		            $result = $this->common_model->insert_record($data,'survey_rating');
		        }
	        }
	        if ( $result )
	        {
	            $this->session->set_flashdata('success', 'Survey Completed - Thank you very much for participating in this survey which will help us make improvements.');
	        	redirect(base_url() . 'client/end');
	        }
	    }
    }
    public function end()
	{
       	$this->load->view('clients/end_survey');
	}
}
