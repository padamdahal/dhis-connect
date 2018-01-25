<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
if( ! function_exists('upload_media')){
	function upload_media($relation, $id){
		$CI =& get_instance();
		$upload_dir = FCPATH.'/uploads/images/';
		$thumb_dir = FCPATH.'/uploads/thumbs/';
		$urls = array();
		if (isset($_POST['liteUploader_id']) && $_POST['liteUploader_id'] == 'fileUpload2') {
			foreach ($_FILES['fileUpload2']['error'] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$uploadedUrl = $upload_dir . $_FILES['fileUpload2']['name'][$key];
					move_uploaded_file( $_FILES['fileUpload2']['tmp_name'][$key], $uploadedUrl);
					$urls[] = $uploadedUrl;
				}
			}
			$message = 'Successfully Uploaded File(s) From Second Upload Input';
		}
		echo json_encode(array('message' => $message, 'urls' => $urls,));
		return $CI->config->base_url().'uploads/thumbs/'.$filename;
	}
}

//exit;
