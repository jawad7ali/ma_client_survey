<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	$this->load->model('common_model');
    	if($this->session->userdata('logged_in') ==''){
			redirect('login');
		}
    }
	public function index()
	{
		$data['survey_list'] =$this->common_model->get_data('survey_rating','id','desc');
		$this->load->view('includes/header');
		$this->load->view('admin/survey-list',$data);
	}
	public function GetReviewData($id)
    {
    	$survey_list =$this->common_model->get_data_tbl_all('survey_rating','u_id',$id,'id','asc');
    	$user =$this->common_model->get_data_row('submited_survey','id',$survey_list[0]->u_id);
    	$html ='';
    	$totalper ='';
    	foreach ($survey_list as $row) {
    		$title ='';
    		if($row->sur_id == '1'){
    			$title ='Did Professional Recruiter and/or Business Relations Specialist understands your business needs/requirements?';
    		}
    		if($row->sur_id == '2'){
    			$title ='How was the communication throughout this position?';
    		}
    		if($row->sur_id == '3'){
    			$title ='How would you rate the speed of response?';
    		}
    		if($row->sur_id == '4'){
    			$title ='How would you rate the quality of profiles received?';
    		}
    		if($row->sur_id == '5'){
    			$title ='How would you rate how prepared and briefed the candidate appeared at interview?';
    		}
    		if($row->sur_id == '6'){
    			$title ='How do we compare with other consulting companies you have worked in the past?';
    		}
    		if($row->sur_id == '7'){
    			$title ='How likely would you be to recommend MicroAgility, Inc. to friends or colleagues in future?';
    		}
    		$html .=' <div class="survey-point row">
				<div class="col-md-11">
					<span class="num">'.$row->sur_id.'</span>
					<span class="pnt">'.$title.' </span> 
				</div> 
				<div class="col-md-1">
					<div class="percen"> 
				 		<span>'.$row->rating_perc.'%</span>
					</div>
			 	</div> 
			</div>';
			$totalper +=$row->rating_perc;
    	}
    	
        echo json_encode(array('client_name' => $user->client_name,'type' => $survey_list[0]->interaction ,'rating_perc' => $totalper,'html'=>$html,'description' => $survey_list[0]->description,'unsatisfac_feedback' => $survey_list[0]->unsatisfac_feedback ));
    }
}
