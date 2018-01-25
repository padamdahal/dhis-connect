<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class CI_upload {
	protected $NN;
	
	public function __construct($rules = array()){
		$this->NN =& get_instance();
	}
	
	public function start_upload($user_id){
		//log_message('debug', "upload started");
		$upload_dir = FCPATH.'uploads/images/';
		$thumb_dir = FCPATH.'uploads/thumbs/';
		$upload_url = base_url().'uploads/images/';
		$thumb_url = base_url().'uploads/thumbs/';
		$urls = array();
		if(isset($_POST['liteUploader_id']) && $_POST['liteUploader_id'] == 'fileUpload2'){
			// Load the imagelibrary
			$this->NN->load->library('imagelibrary');
			foreach ($_FILES['fileUpload2']['error'] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					
					$newfile = substr("abcdefghijklmnopqrstuvwxyz", mt_rand(0,25),1).substr(md5(time()),1).'.'.end((explode(".", $_FILES['fileUpload2']['name'][$key])));
					$uploadedUrl = $upload_dir.$newfile;
					// Move uploaded file with new name to uploads/images directory
					$move_status = move_uploaded_file( $_FILES['fileUpload2']['tmp_name'][$key], $uploadedUrl);
					if($move_status){
						// Resize the uploaded image to given dimensions
						$this->NN->imagelibrary->load($uploadedUrl)->best_fit(2000, 2000)->save($uploadedUrl);
						// Generate the thumbnail with cropping if necessary
						$this->NN->imagelibrary->load($uploadedUrl)->thumbnail(250, 250)->save($thumb_dir.$newfile);
						// Add Image information to the database
						$data['m_filename'] = $newfile;
						$data['m_type'] = 'image';
						$data['m_uploaddate'] = date('Y-m-d H:m:s');
						$data['m_uploadby'] = $user_id;
						
						if($this->NN->db->insert('media',$data)){
							
							$response = 1;
							$message = "Upload successful.";
							// urls to return to the uploader
							array_push($urls, $thumb_url.$newfile);
						}else{
							$response = 0;
							$message = "Unable to update database.";
						}
					}else{
						$response = 0;
						$message = 'Unable to move uploaded files to the server.';
					}
				}else{
					$response = 0;
					$message = 'Error uploading file(s).';
				}
			}
		}else{
			$response = 0;
			$message = 'No file selected!';
		}
		echo json_encode(array('response' => $response,'message' => $message,'urls' => $urls));
	}
	
	public function attachment_upload($user_id,$c_id = null){
		//log_message('debug', "upload started");
		$upload_dir = FCPATH.'uploads/attachments/';
		$upload_url = base_url().'uploads/attachments/';
		$urls = array();
		if(isset($_POST['liteUploader_id']) && $_POST['liteUploader_id'] == 'fileUpload2'){
			// Load the imagelibrary
			foreach ($_FILES['fileUpload2']['error'] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$newfile = round(microtime(true)).'.'.end((explode(".", $_FILES['fileUpload2']['name'][$key])));
					
					$uploadedUrl = $upload_dir.$newfile;
					
					// Move uploaded file with new name to uploads/images directory
					$move_status = move_uploaded_file( $_FILES['fileUpload2']['tmp_name'][$key], $uploadedUrl);
					if($move_status){
						// Add file information to the database
						$data['attachment_file'] = $newfile;
						$data['attachment_uploaddate'] = date('Y-m-d H:m:s');
						$data['attachment_uploadby'] = $user_id;
						
						if($c_id == null){
							// Get the max id of contents
							$this->NN->db->select_max('c_id');
							$query = $this->NN->db->get('contents');
							$result = $query->result_array();
							$data['c_id'] = $result[0]['c_id']+1;
						}else{
							$data['c_id'] = $c_id;
						}
						
						$filename = explode(".", $_FILES['fileUpload2']['name'][$key]);
						$data['attachment_title'] = $filename[0];

						if($this->NN->db->insert('content_attachments',$data)){
							$response = 1;
							$message = "Upload successful.";
							//array_push($urls, $upload_url.$newfile);
						}else{
							$response = 0;
							$message = "Unable to update database.";
						}
					}else{
						$response = 0;
						$message = 'Unable to move uploaded files to the server.';
					}
				}else{
					$response = 0;
					$message = 'Error uploading file(s).';
				}
			}
		}else{
			$response = 0;
			$message = 'No file selected!';
		}
		echo json_encode(array('response' => $response,'message' => $message,'urls' => $urls));
	}
}