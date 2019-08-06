<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruiter extends CI_Controller {

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
		$this->load->view('includes/header');
		$this->load->view('recruiter/survey_form');
	}
	public function submit_survey ()
    {   
    	$email =$this->input->post('candidate_email');
        // check user for unsubscribed
        $unsubscribed =$this->common_model->get_data_row('submited_survey','email',$email);
        print_r($unsubscribed);
        if ($unsubscribed->unsubscribed !='1') 
        {
            
	        $data = array(
	            'poc' => $this->input->post('poc'),
	            'requirement' => $this->input->post('requirment'),
	            'client_name' => $this->input->post('client_company'),
	            'email' => $email,
	        );
	        
	        $emailAddressExistance = $this->common_model->insert_record($data,'submited_survey');
             
            $config = Array(
              'protocol'    => 'mail',
              'smtp_host'   => 'mail.microagility.com',
              'smtp_port'   => 587,
              'smtp_user'   => 'sbukhari@microagility.com', // change it to yours
              'smtp_pass'   => 'STep37$$', // change it to yours
              'mailtype'    => 'html',
              'charset'     => 'iso-8859-1',
              'wordwrap'    => TRUE
            );
            $this->load->library('email', $config);
            $firstName = explode(' ', $this->input->post('poc') );
            $body_data = array(
                'user_id'               =>  $emailAddressExistance,
                'candidate_name'        =>  $firstName[0],
                'candidate_email'       =>  $email,
                'review_id' => $emailAddressExistance
            );
            
            $this->email->from('care@microagility.com', 'MicroAgility');

            $this->email->to($email);

            $this->email->subject('How was your recent working experience with MicroAgility?');

            $this->email->message($this->emailBody( $body_data ));

            if ( $this->email->send() )
            {
            	$this->session->set_flashdata('success', 'Email sent successfully');
            	 redirect($this->agent->referrer());
            }else{
               // show_error($this->email->print_debugger());
                $this->session->set_flashdata('error', $this->email->print_debugger());
                redirect($this->agent->referrer());
            }           
        }
        else
        {
        	$this->session->set_flashdata('error', 'The user has unsubscribed his survey');
            redirect($this->agent->referrer());
        }
    }
    public function emailBody( $bodyData ) 
    {
      
        
        
        if ( !empty ( $bodyData['user_id'] ) ) 
        {
            // $this->debug($bodyData);
            $output = '<!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <title>Document</title>
                        </head>
                        <body>
                            <table cellspacing="0" cellpadding="0" width="700px" bgcolor="#fff"  style="margin: auto;font-family: Myriad Pro;">
                                <tr>
                                    <td>
                                        <table cellspacing="0" cellpadding="10" width="100%">
                                            <tr>
                                                <td style="width:10%"></td>
                                                <td style="width:60%" class="logo" cellpadding="10px;"><a href="#"><img src="http://www.microagility.com/wp-content/uploads/2016/10/MA-logo.png" alt=""></a></td>
                                                <td style="width:20%;" valign="bottom"><p style="margin: 0; color: #201d62;text-align: right;font-size: 20px;font-family: Arial, Helvetica, sans-serif;">Survey</p></td>
                                                <td style="width:10%"></td>
                                            </tr>
                                        </table>
                                        <table cellspacing="0" cellpadding="10" width="100%" bgcolor="#1f1b4f">
                                            <tr>
                                                <td style="width:10%"></td>
                                                <td style=" width:80%;"><h4 style="color:#fff;margin: 0;font-family: Arial, Helvetica, sans-serif;">How was your recent working experience with MicroAgility?</h4></td>
                                                <td style="width:10%"></td>
                                            </tr>
                                        </table>
                                        <table cellspacing="0" cellpadding="10" width="100%">
                                            <tr>
                                                <td style="width:10%"></td>
                                                <td style="width:40%"><p style="font-size: 18px;font-family: Arial, Helvetica, sans-serif;">
                                                    Hi ' . $bodyData['candidate_name'] . ',
                                                </p>
                                                    <p style="font-size: 18px;font-family: Arial, Helvetica, sans-serif;">We appreciate you giving us the opportunity to serve you and your organization. As part of our ongoing effort to provide better services and support, we would like to request your feedback via a short online survey. We are always striving to make our process better.  Please select a suitable option from the list and complete the survey. Thank you for your feedback, we greatly appreciate your time. </p>
                                                   
                                                    
                                                </td>
                                                <td style="width:40%" valign="top">
                                                    <table cellspacing="0" cellpadding="10" width="100%">
                                                        <tr>
                                                            <td>
                                                                <p style="margin: 0; text-align: center;font-size: 18px;font-family: Arial, Helvetica, sans-serif;color: #201d62;">How satisfied is your company with the placement(s) / Service(s)?</p>
                                                            </td>
                                                        </tr>';
          

			$output .= '<tr>
			    <td style="background: #f7f7ff;border-top:2px solid #fff;line-height:3px;" height="10">
			        <a style="text-align:center; font-weight:600;font-size: 16px; font-family: Arial, Helvetica, sans-serif;color:#666561;" href="' . base_url('survey/rating/').'Very satisfied/' . $bodyData['user_id'].'/'.$bodyData['review_id'].' " style="color:#666561;  font-weight:600;font-size:16px;text-decoration: none;font-family: Arial, Helvetica, sans-serif;"><p style="margin: 0;color:#666561; font-weight:600;text-align: center;font-family: Arial, Helvetica, sans-serif; font-size:16px;">Very satisfied</p></a>
			    </td>
			</tr>';
			$output .= '<tr>
			    <td style="background: #f7f7ff;border-top:2px solid #fff;line-height:3px;" height="10">
			        <a style="text-align:center; font-weight:600;font-size: 16px; font-family: Arial, Helvetica, sans-serif;color:#666561;" href="' . base_url('survey/rating/').'Satisfied/' . $bodyData['user_id'].'/'.$bodyData['review_id'].' " style="color:#666561;  font-weight:600;font-size:16px;text-decoration: none;font-family: Arial, Helvetica, sans-serif;"><p style="margin: 0;color:#666561; font-weight:600;text-align: center;font-family: Arial, Helvetica, sans-serif; font-size:16px;">Satisfied</p></a>
			    </td>
			</tr>';
			$output .= '<tr>
			    <td style="background: #f7f7ff;border-top:2px solid #fff;line-height:3px;" height="10">
			        <a style="text-align:center; font-weight:600;font-size: 16px; font-family: Arial, Helvetica, sans-serif;color:#666561;" href="' . base_url('survey/rating/').'Neutral/' . $bodyData['user_id'].'/'.$bodyData['review_id'].' " style="color:#666561;  font-weight:600;font-size:16px;text-decoration: none;font-family: Arial, Helvetica, sans-serif;"><p style="margin: 0;color:#666561; font-weight:600;text-align: center;font-family: Arial, Helvetica, sans-serif; font-size:16px;">Neutral</p></a>
			    </td>
			</tr>';
			$output .= '<tr>
			    <td style="background: #f7f7ff;border-top:2px solid #fff;line-height:3px;" height="10">
			        <a style="text-align:center; font-weight:600;font-size: 16px; font-family: Arial, Helvetica, sans-serif;color:#666561;" href="' . base_url('survey/rating/').'Dissatisfied/' . $bodyData['user_id'].'/'.$bodyData['review_id'].' " style="color:#666561;  font-weight:600;font-size:16px;text-decoration: none;font-family: Arial, Helvetica, sans-serif;"><p style="margin: 0;color:#666561; font-weight:600;text-align: center;font-family: Arial, Helvetica, sans-serif; font-size:16px;">Dissatisfied</p></a>
			    </td>
			</tr>';
			$output .= '<tr>
			    <td style="background: #f7f7ff;border-top:2px solid #fff;line-height:3px;" height="10">
			        <a style="text-align:center; font-weight:600;font-size: 16px; font-family: Arial, Helvetica, sans-serif;color:#666561;" href="' . base_url('survey/rating/').'Very dissatisfied/' . $bodyData['user_id'].'/'.$bodyData['review_id'].' " style="color:#666561;  font-weight:600;font-size:16px;text-decoration: none;font-family: Arial, Helvetica, sans-serif;"><p style="margin: 0;color:#666561; font-weight:600;text-align: center;font-family: Arial, Helvetica, sans-serif; font-size:16px;">Very dissatisfied</p></a>
			    </td>
			</tr>';
                                                    
            $output .=  '                           </table>
                                                </td>
                                                <td style="width:10%"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <table  cellspacing="0" cellpadding="0" width="100%" bgcolor="#fff"  style="margin: auto;font-family: Arial, Helvetica, sans-serif;">
                            <tr>
                                  <td align="center">
                                      <p style="text-align: center;font-size: 18px; font-family: Arial, Helvetica, sans-serif;">
                                        Be a part of our journey from good to great! We always look forward to your suggestions. Get in Touch with us at.
                                      </p>
                                  </td>
                              </tr>
                            </table>
                              <table  height="20px" bgcolor="#fff">
                                <tr>
                                    <td></td>
                                </tr>
                              </table>
                          <table align="center" cellspacing="0" cellpadding="0" width="600px" bgcolor="#fff"  style="margin: auto;font-family: Arial, Helvetica, sans-serif;">
                            
                              <tr>

                                <td ></td>
                                <td style="width:25px">
                                     <a target="_blank" href="https://www.facebook.com/microagility "><img src="http://www.microagility.com/wp-content/uploads/2016/08/fb.png" height="26px"></a> 
                                </td>  
                                <td style="width:100px">
                                    <span style="text-align: center;font-size: 18px; font-family: Arial, Helvetica, sans-serif;color:#0f0f59">Facebook</span>
                                </td> 
                               <td style="width:25px"> 
                                  <a target="_blank" href="https://twitter.com/MicroAgility"><img src="http://www.microagility.com/wp-content/uploads/2016/08/twitter.png" height="26px"></a>
                                </td>
                                <td style="width:70px">
                                     <span style="text-align: center;font-size: 18px; font-family: Arial, Helvetica, sans-serif;color:#0f0f59">Twitter</span>
                                </td> 
                                <td style="width:25px">
                                  <a target="_blank" href="https://www.linkedin.com/company/microagility"><img src="http://www.microagility.com/wp-content/uploads/2016/08/in.png" height="26px"></a>
                                </td> 
                                <td style="width:70px">
                                    <span style="text-align: center;font-size: 18px; font-family: Arial, Helvetica, sans-serif;color:#0f0f59">linkedin</span>
                                </td> 
                                    
                                <td style="width:25px"> 
                                     <a target="_blank" href="http://www.microagility.com"><img src="http://www.microagility.com/wp-content/uploads/2016/08/map.png" height="26px"> </a>
                                </td> 
                                <td style="width:70px">
                                    <a target="_blank" href="http://www.microagility.com" style="text-decoration:none; color:#0f0f59">www.MicroAgility.com </a>
                                </td>
                                    
                              </tr>
                            </table>
                           <table  height="5px" bgcolor="#fff">
                                <tr>
                                    <td></td>
                                </tr>
                              </table>
                             <table  cellspacing="0" cellpadding="0" width="100%" bgcolor="#fff"  style="margin: auto;font-family: Arial, Helvetica, sans-serif;">
                            <tr>
                                  <td valign="bottom" height="20">
                                      <p style="text-align: center;font-size: 14px; font-family: Arial, Helvetica, sans-serif;color:#999">
                                         if you do not wish to receive such surveys from us in the future, you can <a href="' . base_url('unsubscribe/') . $bodyData['user_id'] . '" style="text-decoration:none; color:#0f0f59" target="_blank">unsubscribe</a> from the feedback services.
                                      </p>
                                  </td>
                              </tr>
                            </table>
                        </body>
                        </html>';
        }
        else
        {
            $output = 'Error: Failed to send email.';
            return $output;
        }
        return $output;
    }

}
