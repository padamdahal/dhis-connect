<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_formhandler {

	protected $CI;
	
	/* Constructor */
	public function __construct($rules = array()){
		$this->CI =& get_instance();
	}
	public function processform($formname){
		/* 	The method passes the request to the appropriate method.
			It is required to create the method as per the form action url
			For example if form action url is 'www.example.com/processform/contactus'
			protected 'contactus' method should exist in this class.
		*/
		if($formname !=""){
			$this->$formname();
		}
	}
	
	protected function feedback(){
		$return_value = array();
		$status = 0;
		$message = null;
		
		// Load form validation library
		$this->CI->load->library('form_validation');	
		$this->CI->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('captchacode', 'Captcha', 'required');

		if($this->CI->form_validation->run() == FALSE){
			$message = "Validation failed, please fill all fields and try again.";
		}else{
			session_start();
			if($this->CI->input->post('captchacode') == $_SESSION['captcha_code']){
				$data['f_sender_name'] = $this->CI->input->post('name');
				$data['f_sender_email'] = $this->CI->input->post('email');
				$data['f_message'] = $this->CI->input->post('message');
				date_default_timezone_set('Asia/Katmandu');
				$data['f_date'] = date('Y-m-d');
				
				if ($this->CI->db->insert('feedbacks',$data)) {
					$status = 1;
					$message = 'Feedback received. Thank you.';
				}else{
					$status = 0;
					$message = 'Unable to save your Feedback.';
				}
			}else{
				$status = 0;
				$message = 'Please enter the text shown in the image correctly.';
			}
		}
		array_push($return_value,array('status'=>$status,'message'=>$message));
		echo json_encode($return_value);
	}
	
	protected function rumorreport(){
		$return_value = array();
		$status = 0;
		$email = '';
		
		// Load form validation library
		$this->CI->load->library('form_validation');	
		$this->CI->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('vdc', 'VDC', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('ward', 'Ward No', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->CI->form_validation->set_rules('captchacode', 'Captcha', 'required');

		if($this->CI->form_validation->run() == FALSE){
			$message = "Validation failed. \nPlease fill all fields and try again.";
		}else{
			session_start();
			if($this->CI->input->post('captchacode') == $_SESSION['captcha_code']){
				$data['report_sender_name'] = $this->CI->input->post('name');
				$data['report_sender_email'] = $this->CI->input->post('email');
				$data['report_type'] = $this->CI->input->post('type');
				$data['report_authenticity'] = $this->CI->input->post('authenticity');
				$data['report_district'] = $this->CI->input->post('district');
				$data['report_vdc'] = $this->CI->input->post('vdc');
				$data['report_ward'] = $this->CI->input->post('ward');
				$data['report_death'] = $this->CI->input->post('death');
				$data['report_description'] = $this->CI->input->post('discription');
				
				date_default_timezone_set('Asia/Katmandu');
				$data['report_date'] = date('Y-m-d');
				
				if ($this->CI->db->insert('reports',$data)) {
					$status = 1;
					$message = 'Report received. Thank you.';
				}else{
					$status = 0;
					$message = 'Unable to save your report.';
				}
			}else{
				$status = 0;
				$message = 'Please enter the text shown in the image correctly.';
			}
		}
		array_push($return_value,array('status'=>$status,'message'=>$message));
		echo json_encode($return_value);
	}
}