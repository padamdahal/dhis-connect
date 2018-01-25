<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smsauto extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('common');
		//$this->load->model('smsauto_model');
		// today
		$this->today = date(DATE_ISO8601);
		$this->todayString = str_replace('+', '.', $this->today);
		// Container for events;
		$this->events = [];
	}
	
	public function index(){
		exit('www');
	}
}
