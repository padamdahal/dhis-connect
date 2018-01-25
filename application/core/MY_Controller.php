<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Controller extends CI_controller {
	public $data = array();
	
	public function __construct(){
		parent::__construct();
		// Set default timezone to Asia/Kathmandu
		date_default_timezone_set('Asia/Katmandu');
		
		$this->load->model('main_model');
		$this->load->library('common');
		$this->load->library('user_agent');
		$this->load->helper('url');
		
		$title = $this->main_model->get('s_value', 'settings', null, 's_name = "site_title"');
		$this->data['site_title'] = $title[0]['s_value'];
		
		$main_message = $this->main_model->get('s_value', 'settings', null, 's_name = "site_main_message"');
		$this->data['main_message'] = $main_message[0]['s_value'];
		
		$tagline = $this->main_model->get('s_value', 'settings', null, 's_name = "site_tagline"');
		$this->data['tagline'] = $tagline[0]['s_value'];
		
		// Check if request is from mobile
		if ($this->agent->is_mobile() || $this->agent->is_robot()) {
			$this->is_mobile = true;
		}else{
			$this->is_mobile = false;
		}
		
		
		// Count the visit		
		$session_array = $this->session->userdata('logged_in');

		// Count the visitor
		if($this->session->userdata('unique_sess_id') == null){
			if(!$this->agent->is_robot() && $session_array['scope'] != 'admin'){
				$this->session->set_userdata('unique_sess_id', $this->session->userdata('session_id'));
				// Do the unique count
				$log_data['ss_is_unique'] = 1;
				$log_data['ss_url'] = base_url().uri_string();
				$log_data['ss_visitor_ip'] = $this->common->get_client_ip();
				$log_data['ss_useragent'] = $this->session->userdata('user_agent');
				$log_data['ss_session_var'] = $this->session->userdata('session_id');
				$log_data['ss_datetime'] = date("Y-m-d H:i:s");
				$this->main_model->save_data('site_stats',$log_data);
			}
		}else{
		
		}
		
		// For list of News
		$select = 'COUNT(*) AS count';
		$from = 'site_stats';
		$join = null;
		$where = "ss_is_unique = 1";
		$orderby = null;
		$limit = null;
		$count = $this->main_model->get($select, $from, $join, $where, $orderby, $limit);
		$this->visitor_count = null;
		$count_arr = str_split($count[0]['count']+500);
		$array = array(0,0,0);
		foreach($count_arr as $char){
			array_push($array, $char);
		}
		foreach($array as $char){
			$this->visitor_count .= '<span class="visit_counter_num" style="box-shadow: 1px 1px 5px rgba(0,0,0,0.5);border-radius:10px;font-weight:bold;color:#999;background:#fff;margin-right:2px;padding:3px;">'.$char.'</span>';
		}
		$this->visitor_count .= '<span class="visit_counter_txt" style="text-shadow: 1px 1px 3px #000;color:#fff;padding:3px;font-weight:bold;"> total visits &amp; counting...</span>';
	}
	
	public function update_content_status($id){
		$session_array = $this->session->userdata('logged_in');
		if(!$this->agent->is_robot() && $session_array['scope'] != 'admin'){
			$log_data['c_id'] = $id;
			$log_data['cs_visitor_ip'] = $this->common->get_client_ip();
			$log_data['cs_user_agent'] = $this->session->userdata('user_agent');
			$log_data['cs_datetime'] = date("Y-m-d H:i:s");
			$this->main_model->save_data('content_stats',$log_data);
		}
	}
}