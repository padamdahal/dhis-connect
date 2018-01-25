<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Genexpertsms extends CI_Controller {
	public function __construct(){
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->model('genexpertsms_model');
	}

	public function index(){
		// Check if the request is from localhost
		$client_ip = $this->common->get_client_ip();
		$whitelist = array('127.0.0.1', '::1');
		
		if(!in_array($client_ip, $whitelist)){
			die('Not allowed');
		}
		
		// get last logged date time
		$orderby = array('genexpertsms_log_date', 'DESC');
		$contents = $this->genexpertsms_model->getLastLog(null, 'genexpertsms_log', null, null, $orderby);
		if(count($contents)){
			$last_log = $contents[0]['last_updated'];
		}else{
			$last_log = null;
		}
			
		// today
		$today = date(DATE_ISO8601);
		$todayString = str_replace('+', '.', $today);
			
		// Parameters for url
		$startDate = substr($today,0,10);
		$endDate = $startDate;
		$orgUnit = 'cCTQiGkKcTk';
		$ouMode = 'DESCENDANTS';
		$program = 'KROMcNPTGR6';
			
		$url = $this->config->item('dhis_url') . 'events/eventRows.json?';
		$url = $url . 'orgUnit=' . $orgUnit;
		$url = $url . '&ouMode=' . $ouMode;
		$url = $url . '&program=' . $program;
		$url = $url . '&startDate=' . $startDate . '&endDate=' . $endDate;
			
		$data = $this->genexpertsms_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $url);
			
		// Populate the information of sms receivers
		$this->data = [];
		if($data){
			foreach($data['eventRows'] as $event){
				$data = [];
				if($event['programStage'] == 'YECy5jC9Sre'){
					foreach($event['dataValues'] as $dataValue){
						if($dataValue['dataElement'] == 'z6si2S5SmSe'){
							$lastUpdated = new DateTime($dataValue['lastUpdated']);
							if($last_log != null){
								$dateLast = new DateTime($last_log);
								if($dateLast->getTimestamp() < $lastUpdated->getTimestamp()){
									$data['lastUpdated'] = $dataValue['lastUpdated'];
									$data['result'] = $dataValue['value'];
								}
							}else{
								$data['lastUpdated'] = $dataValue['lastUpdated'];
								$data['result'] = $dataValue['value'];
							}
						}
					}
					if(isset($data['result'])){
						$data['eventDate'] = $event['eventDate'];
						foreach($event['attributes'] as $attribute){
							if($attribute['displayName'] == 'Patient Name'){
								$data['patientName'] = $attribute['value'];
							}
								
							if($attribute['displayName'] == 'Contact Number'){
								$data['patientContact'] = $attribute['value'];
							}
						}
						$urlForOuContact = $this->config->item('dhis_url') . 'organisationUnits/'.$event['trackedEntityInstanceOrgUnit'].'.json';
						$ouContact = $this->genexpertsms_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $urlForOuContact);
						$data['ouContact'] = $ouContact['phoneNumber'];
						array_push($this->data, $data);
					}
				}
			}
		}else{
			die('No data returned by DHIS2 server.');
		}
			
		if($this->data && count($this->data) > 0){
			foreach($this->data as $dt){
				$patientName = (isset($dt['patientName'])) ? $dt['patientName']:'NA';
				$patientContact = (isset($dt['patientContact'])) ? $dt['patientContact']:'NA';
				$lastUpdated = (isset($dt['lastUpdated'])) ? $dt['lastUpdated']:'NA';
				$gxResult = (isset($dt['result'])) ? $dt['result']:'NA';
				$messageText_patient = 'Dear '.$patientName.', तपाइको  खकार जाँचको नतिजा :  '. $gxResult.'   रिपोर्ट लिन पाल्नुहोला';
				$messageText_program = 'Expert Result for program focal persons:<br/> Patient'. $patientName.'<br/>Xpert Result: '. $gxResult;
					
				//if($gxResult == 'Rif Resistance DETECTED'){
					// Send SMS to patient
					$api_url = $this->config->item('sms_send_url').
					http_build_query(array(
						'token' => $this->config->item('sms_token'),
						'from'  => $this->config->item('sms_number'),
						'to'    => $patientContact,
						'text'  => $messageText_patient)
					);
					$smsGatewayResponse_patient = file_get_contents($api_url);
					$responseArray = json_decode($smsGatewayResponse_patient,true);
				//}	
				if($responseArray['response_code'] == 200){				
					// if SMS success store the information
					$data = array('genexpertsms_log_date' => $today,
						'patient_name' => $patientName,
						'patient_contact' => $patientContact,
						'message_text' => $messageText_patient,
						'last_updated' => $lastUpdated,
						'server_response' => $smsGatewayResponse_patient
					);
					$this->genexpertsms_model->add('genexpertsms_log', $data);
				}else{
					//error log
				}
				if($gxResult == 'Rif Resistance DETECTED'){	
					// Send SMS to program focal points
					$api_url = $this->config->item('sms_send_url').
					http_build_query(array(
						'token' => $this->config->item('sms_token'),
						'from'  => $this->config->item('sms_number'),
						'to'    => $dt['ouContact'],
						'text'  => $messageText_program)
					);
					$smsGatewayResponse_program = file_get_contents($api_url);
					$responseArray_program = json_decode($smsGatewayResponse_program,true);
				}
 				if($gxResult == 'ERROR'){
                                        // Send SMS to program focal points
                                        $api_url = $this->config->item('sms_send_url').
                                        http_build_query(array(
                                                'token' => $this->config->item('sms_token'),
                                                'from'  => $this->config->item('sms_number'),
                                                'to'    => $dt['ouContact'],
                                                'text'  => $messageText_program)
                                        );
                                        $smsGatewayResponse_program = file_get_contents($api_url);
                                        $responseArray_program = json_decode($smsGatewayResponse_program,true);
                                }
			}
		}
	}
}
