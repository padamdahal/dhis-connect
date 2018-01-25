<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_gallery{

	protected $CI;
	
	public function __construct($rules = array()){
		$this->CI =& get_instance();
	}
	
	public function preparegallery($what){
		$medialist = $this->media_list();
		echo $medialist;			
	}
	
	public function media_list(){
		// List the contents
		$select = null;
		$from = 'media m';
		$join = null;
		$where = 'm.m_active = 1 AND m.m_exclude is null';
		$orderby = array("m_uploaddate", "DESC");
		$media = $this->CI->main_model->get($select, $from, $join, $where, $orderby);
		$this->CI->load->library('preparehtml');
		$media_list = $this->CI->preparehtml->prepare_media_list($media);
		return $media_list;
	}
	
	public function media_list_ajax(){
		$medialist = $this->media_list();
		echo $medialist;
	}
}