<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('sms_model');

		// today
		$this->today = date(DATE_ISO8601);
		$this->todayString = str_replace('+', '.', $this->today);

		// Container for events;
		$this->events = [];
	}

	public function sendSMS($to, $message){
		// Send SMS to patient
		$api_url = $this->config->item('sms_send_url').
		http_build_query(array(
			'token' => $this->config->item('sms_token'),
			'from'  => $this->config->item('sms_number'),
			'to'    => $to,
			'text'  => $message)
		);

		$smsGatewayResponse = @file_get_contents($api_url);
		$responseArray = json_decode($smsGatewayResponse, true);
		return $responseArray;
	}

	public function composeAndSendMessage($template, $data){
		if($data && count($data) > 0){
			if($template == 'geneXpert'){
				$messageText = 'Dear '.$data['patientName'].', तपाइको  खकार परिक्षणको नतिजा :  '. ($data['result'] != 'ERROR') ? $data['result'].' रिपोर्ट लिन पाल्नुहोला':'NA'.'   पुनः खकार परिक्षण गराउन अनुरोध छ ।';
				$responseArray = $this->sendSMS($data['patientContact'], $messageText);
				if($responseArray['response_code'] == 200){
					$this->logSentMessage($data['patientContact'], $messageText, $data['lastUpdated'],200);
				}
				if($data['result'] == 'Rif Resistance DETECTED' || $data['result'] == 'ERROR'){
					$messageText_program = '**Rif Resistance Alert**'."\r\n".'Patient Id: '.$data['patientId']."\r\n".'Patient Name: '. $data['patientName']."\r\n".'Xpert Result: '. $data['result'];
					$this->sendSMS($data['ouContact'], $messageText_program);
				}
			}
			if($template == 'culture'){
				$messageText = 'खकार कल्चर परिक्षणको नतिजा :  '. $data['result'].' ,  रिपोर्ट लिन पाल्नुहोला ।';
				$responseArray = $this->sendSMS($data['patientContact'], $messageText);
				if($responseArray['response_code'] == 200){
					$this->logSentMessage($data['patientContact'], $messageText, $data['lastUpdated'], 200);
				}

				if($data['result'] != 'Negative'){
					$messageText_program = "**Culture Positive Alert**\r\nPatient Id:".$data['patientId']."\r\nPatient Name: ". $data['patientName']."\r\n Culture Result: ". $data['result'];
					$this->sendSMS($data['ouContact'], $messageText_program);
				}
			}

			if($template == 'DST'){
				$messageText = 'औषधि प्रतिरोध परिक्षणको नतिजा : '. $data['result'].' ,  रिपोर्ट लिन पाल्नुहोला ।';
				$responseArray = $this->sendSMS($data['patientContact'], $messageText);
				if($responseArray['response_code'] == 200){
					$this->logSentMessage($data['patientContact'], $messageText, $data['lastUpdated'], 200);
				}

				if($data['result'] != 'Negative'){
					$messageText_program = "**DST Result Alert**\r\n Patient Id:".$data['patientId']."\r\n Patient Name: ". $data['patientName']."\r\nDST Pattern: ". $data['result'];
					$this->sendSMS($data['ouContact'], $messageText_program);
				}
			}
		}
	}

	public function logSentMessage($to, $messageText, $lastUpdated, $server_response){
		// if SMS success, log to database
		$data = array('sms_log_date' => $this->today,
			'name' => 'NA',
			'contact' => $to,
			'message_text' => $messageText,
			'last_updated' => $lastUpdated,
			'server_response' => $server_response
		);
		$this->sms_model->add('sms_log', $data);
	}

	public function getLastLoggedDate(){
		$orderby = array('sms_log_date', 'DESC');
		$contents = $this->sms_model->getLastLog(null, 'sms_log', null, null, $orderby);
		if(count($contents)){
			$last_log = $contents[0]['last_updated'];
		}else{
			$last_log = '0000-00-00 00:00:00';
		}
		return $last_log;
	}

	public function getEventsFromDHIS(){
		// Parameters for url
		$startDate = substr($this->today,0,10);
		$endDate = $startDate;
		$orgUnit = 'cCTQiGkKcTk'; 	// For all organization Units, Nepal
		$ouMode = 'DESCENDANTS';	// Ou Mode
		$program = 'KROMcNPTGR6';	// Laboratory System

		// URL to fetch all event rows from the DHIS2 server
		$url = $this->config->item('dhis_url') . 'events/eventRows.json?';
		$url = $url . 'orgUnit=' . $orgUnit;
		$url = $url . '&ouMode=' . $ouMode;
		$url = $url . '&program=' . $program;
		$url = $url . '&startDate=' . $startDate . '&endDate=' . $endDate;

		// Get the data from the DHIS2 server
		$data = $this->sms_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $url);
		//exit($url);
		return $data;
	}

	public function getEventDetailFromDHIS($event){
		// URL to fetch all event rows from the DHIS2 server
		$url = $this->config->item('dhis_url') . 'events/'.$event.'.json';

		// Get the data from the DHIS2 server
		$data = $this->sms_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $url);
		return $data;
	}

	public function getTrackedEntityInstanceDetail($trackedEntityId){
		// URL to fetch all event rows from the DHIS2 server
		$url = $this->config->item('dhis_url') . 'trackedEntityInstances/'.$trackedEntityId.'.json';

		// Get the data from the DHIS2 server
		$data = $this->sms_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $url);
		return $data;
	}

	public function index(){
		$thisHost = gethostname();
		echo $thisHost;

		// get last logged date time
		$last_log = $this->getLastLoggedDate();

		// Get todays events from DHIS server
		$eventData = $this->getEventsFromDHIS();
		//print_r($eventData);
		if($eventData){
			foreach($eventData['eventRows'] as $event){
				$ev = [];
				$ev['eventId'] = $event['event'];
				$attributes = $this->getTrackedEntityInstanceDetail($event['trackedEntityInstance']);

				foreach($attributes['attributes'] as $attribute){
					if($attribute['displayName'] == 'Patient ID'){
						$ev['patientId'] = $attribute['value'];
					}
					if($attribute['displayName'] == 'Patient Name'){
						$ev['patientName'] = $attribute['value'];
					}
					if($attribute['displayName'] == 'Contact Number'){
						$ev['patientContact'] = $attribute['value'];
					}
				}

				$urlForOuContact = $this->config->item('dhis_url') . 'organisationUnits/'.$event['trackedEntityInstanceOrgUnit'].'.json';
				$ouContact = $this->sms_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $urlForOuContact);
				$ev['ouContact'] = $ouContact['phoneNumber'];

				array_push($this->events, $ev);
			}
		}

		// Process the events for sms
		if($this->events){

			foreach($this->events as $event){
				$eventDetail = $this->getEventDetailFromDHIS($event['eventId']);
				$data = [];

				if($eventDetail['programStage'] == 'YECy5jC9Sre' && $eventDetail['status'] == 'COMPLETED'){
					//print_r($eventDetail['dataValues']);
					//echo "<hr>";
					$dstIds = Array('WHdClLOPDlz','CF5IeX7useA','UKUSA82yQWM','UVX31s9jSI9','jGPzdNCz2sf','ClZFWDOwLFW','cVn6SM0U0uj');
					$dstNames = ['S','Lfx','INH','Cm','R','Km','E'];
					$dstPattern = '';
					foreach($eventDetail['dataValues'] as $dataValue){
						if($dataValue['dataElement'] == 'z6si2S5SmSe'){
							$smsTemplate = 'geneXpert';
							$data['patientName'] = $event['patientName'];
							$data['patientId'] = $event['patientId'];
							$data['patientContact'] = $event['patientContact'];
							$data['ouContact'] = $event['ouContact'];
							$data['lastUpdated'] = $dataValue['lastUpdated'];
							$data['result'] = $dataValue['value'];
							$lastUpdated = new DateTime($dataValue['lastUpdated']);
							$dateLast = new DateTime($last_log);
							if($data['result'] && ($dateLast->getTimestamp() < $lastUpdated->getTimestamp())){
								$this->composeAndSendMessage($smsTemplate,$data);
								//echo 'Gx : '.$data['result'];
							}
						}

						if($dataValue['dataElement'] == 'OM2oc1ksXyL'){
							$smsTemplate = 'culture';
							$data['lastUpdated'] = $dataValue['lastUpdated'];
							$data['patientName'] = $event['patientName'];
							$data['patientId'] = $event['patientId'];
							$data['patientContact'] = $event['patientContact'];
							$data['ouContact'] = $event['ouContact'];
							$data['result'] = $dataValue['value'];
							$lastUpdated = new DateTime($dataValue['lastUpdated']);
							$dateLast = new DateTime($last_log);
							if($data['result'] && ($dateLast->getTimestamp() < $lastUpdated->getTimestamp())){
								$this->composeAndSendMessage($smsTemplate,$data);
								//echo 'Culture : '.$data['result'];
							}
						}

						if($dataValue['dataElement'] == 'WHdClLOPDlz' || $dataValue['dataElement'] == 'CF5IeX7useA' || $dataValue['dataElement'] == 'UKUSA82yQWM' || $dataValue['dataElement'] == 'UVX31s9jSI9' || $dataValue['dataElement'] == 'jGPzdNCz2sf' || $dataValue['dataElement'] == 'ClZFWDOwLFW' || $dataValue['dataElement'] == 'cVn6SM0U0uj'){
							if($dataValue['value'] == 'R'){
								$index = array_search($dataValue['dataElement'], $dstIds);
								$dstPattern .= $dstNames[$index].'+';
							}
						}
					}

					if($dstPattern != '' || $dstPattern != null){
						$smsTemplate = 'DST';
						$data['lastUpdated'] = $dataValue['lastUpdated'];
						$data['patientName'] = $event['patientName'];
						$data['patientId'] = $event['patientId'];
						$data['patientContact'] = $event['patientContact'];
						$data['ouContact'] = $event['ouContact'];
						$data['result'] = $dstPattern;
						$lastUpdated = new DateTime($dataValue['lastUpdated']);
						$dateLast = new DateTime($last_log);
						if($data['result'] && ($dateLast->getTimestamp() < $lastUpdated->getTimestamp())){
							$this->composeAndSendMessage($smsTemplate, $data);
							//echo 'DST : '.$dstPattern;
						}
					}
				}
			}
		}
	}
}
