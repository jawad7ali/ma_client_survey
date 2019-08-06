<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	$this->load->model('common_model');
    }
	public function survey($field,$uid,$rev_id)
	{
		$unsub =$this->common_model->get_row_on_two_condition('submited_survey','id',$uid,'submitted','1','yes');
		if ( $uid != $unsub){
			
			$this->load->view('clients/survey');

        }else{
        	$this->session->set_flashdata('success', 'You are submitted already survey form');
            redirect(base_url() . 'survey/end/'.$uid.'');
        } 
	}
	public function saveReviews() 
    {
        $reviewId = $this->uri->segment(4);
        $userId = $this->uri->segment(5);
        $candidate_name = $this->uri->segment(6);

        // $this->debug( $candidate_name );

        if ( $reviewId < 4 ) 
        {
            for ( $i = 0; $i < sizeof( $_POST['message'] ); $i++ ) 
            {
                // Common Helper function
                $ratingPercentage = getRatingPercentage( $_POST['rating'][$i] );
                $data = array (
                    "sur_id"     =>  !empty( $_POST['message'][$i] ) ? $_POST['message'][$i] : NULL,
                    "u_id"       =>  $userId,
                    "rating_id"     =>  !empty( $_POST['rating'][$i] ) ? $_POST['rating'][$i] : NULL,
                    //"reviewid"     =>  $reviewId,
                    "description"   =>  !empty( $_POST['description'] ) ? $_POST['description'] : NULL,
                    "rating_perc"   =>  $ratingPercentage,
                    "date"   =>  date('Y-m-d h:i:sa'),
                    "status"        =>  1
                );
                $result = $this->common_model->insert_record($data,'survey_rating');
            }
            $uemail = $this->email_mdl->getuseremail($userId);
            $this->email_mdl->updatepending_srusers($userId);
            $this->email_mdl->updatepending(urldecode($candidate_name),$uemail->user_email);
            // echo $this->db->last_query();  
            // exit();
            if ( $result )
            {
                echo json_encode( array ( 'status' => $data['STATUS'], 'message' => 'Record updated successfully' ) );
            }
        }
        else
        {
            $data = array (
                    "USER_ID"       =>  $userId,
                    "REVIEW_ID"     =>  $reviewId,
                    'CANDIDATE_NAME'    =>  $candidate_name,
                    "DESCRIPTION"   =>  !empty( $_POST['description'] ) ? $_POST['description'] : NULL,
                    "UNSATISFACTORY_FEEDBACK" => !empty( $_POST['unstatisfactory_feedback'] ) ? $_POST['unstatisfactory_feedback'] : NULL,
                    "E_DATE_TIME"   =>  date('Y-m-d h:i:sa'),
                    "STATUS"        =>  1
            );


            $result = $this->email_mdl->saveReview($data);
            $uemail = $this->email_mdl->getuseremail($userId);
            $this->email_mdl->updatepending_srusers($userId);
            $this->email_mdl->updatepending($candidate_name,$uemail->user_email);
            
            if ( $result )
            {
                echo json_encode( array ( 'status' => $data['STATUS'], 'message' => 'Record updated successfully' ) );
            }
        }
    }
}
