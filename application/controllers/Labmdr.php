<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Labmdr extends CI_Controller {
	public function __construct(){
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->library('common');
		$this->load->model('labmdr_model');
	}

	public function Index(){
		
		$thisHost = gethostname();
		echo $thisHost;
		exit('This is Lab MDR connector');
		// today
		$today = date(DATE_ISO8601);
		$todayString = str_replace('+', '.', $today);
			
		// Parameters for url
		$startDate = substr($today,0,10);
		$endDate = $startDate;
		$orgUnit = 'cCTQiGkKcTk';
		$ouMode = 'DESCENDANTS';
		$programs = array('P7BAWJSUqWU','EXlWmwMJ0yb','cW5MJSdbCi3');
		
		foreach($programs as $program){
			$prog = '';
			if($program == 'P7BAWJSUqWU'){
				$prog = 'MDR TB';
			}
			if($program == 'EXlWmwMJ0yb'){
				$prog = 'Pre-XDR TB';
			}
			
			if($program == 'cW5MJSdbCi3'){
				$prog = 'XDR TB';
			}
			
			$url = $this->config->item('dhis_url');
			$url = $url . 'events/eventRows.json?';
			$url = $url . 'orgUnit=' . $orgUnit;
			$url = $url . '&ouMode=' . $ouMode;
			$url = $url . '&program=' . $program;
			$url = $url . '&startDate=' . $startDate . '&endDate=' . $endDate;
			$url = $url . '&eventStatus=COMPLETED';
			
			$data = $this->scheduler_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $url);
			
			if($data){
				foreach($data['eventRows'] as $event){
					$dueDate;
					$data = [];
					
					if($event['programStage'] == 'bhfgOA6XMEe' || $event['programStage'] == 'haOirmIwSmx' 
						|| $event['programStage'] == 'Mxajcqf5R71'){
						// Schedule new monthly monitoring event after 30 days
						$dueDate = date('Y-m-d', strtotime($today . " + 30 day"));
						$data['program'] = $event['program'];
						$data['orgUnit'] = $event['trackedEntityInstanceOrgUnit'];
						$data['dueDate'] = $dueDate;
						$data['status'] = 'SCHEDULE';
						$data['programStage'] = $event['programStage'];
						$data['trackedEntityInstance'] = $event['trackedEntityInstance'];
						$json = json_encode($data);
						
						// Send the data to server
						$result = $this->scheduler_model->sendDataToDHIS($json);
						print_r($result);
					}
					
					// for scheduling treatment phases
					if($event['programStage'] == 'Ez5zLH91IxC' || $event['programStage'] == 'fHYCyAhGV9Y' || $event['programStage'] == 'yAB0TSv40PN'){
						if(isset($event['dataValues'])){
							foreach($event['dataValues'] as $dataValue){
								if($program == 'P7BAWJSUqWU'){
									// For MDR schedule event after 4 months
									$dueDate = date('Y-m-d', strtotime($today . " + 120 day"));
								}else if($program == 'EXlWmwMJ0yb' || $program == 'cW5MJSdbCi3'){
									// For Pre-XDR and XDR Schedule event after 6 months
									$dueDate = date('Y-m-d', strtotime($today . " + 180 day"));
								}
								if($dataValue['dataElement'] == 'APGif7oMCDy' && ($dataValue['value'] == 'Intensive_Phase_I' || $dataValue['value'] == 'Intensive_Phase_II')){
									$data['program'] = $event['program'];
									$data['orgUnit'] = $event['trackedEntityInstanceOrgUnit'];
									$data['dueDate'] = $dueDate;
									$data['status'] = 'SCHEDULE';
									$data['programStage'] = $event['programStage'];
									$data['trackedEntityInstance'] = $event['trackedEntityInstance'];
									$json = json_encode($data);
									
									// Send the data to server
									$result = $this->scheduler_model->sendDataToDHIS($json);
									break;
								}
							}
						}
					}
					
					// Transfer in/out
					if($event['programStage'] == 'yHnQt4YpoTe' || $event['programStage'] == 'am0YeaD7vX4' || $event['programStage'] == 'U2sUl41wXL7'){
						$transferedToOu = '';
						$transferedToOuContact = '';
						$transferedFromOuContact = '';
						if(isset($event['dataValues'])){
							foreach($event['dataValues'] as $dataValue){
								if($dataValue['dataElement'] == 'YGQsaihcId6' && $dataValue['value'] == 'Out'){
									foreach($event['dataValues'] as $dataValue){
										if($dataValue['dataElement'] == 'yflfZ1gs7px'){
											$transferedToOu = $dataValue['value'];
											// Get the contact Number of the transferred Out
											$url = $this->config->item('dhis_url');
											$url = $url . 'organisationUnits/'.$transferedToOu.'.json';
											$ouData = $this->scheduler_model->getDataFromDHIS($this->config->item('dhis_username'), $this->config->item('dhis_password'), $url);
											$transferedToOuContact = explode(',',$ouData['phoneNumber'])[0];
											//echo $transferedToOuContact;
											break;
										}
									}
									// Send SMS
									$patientId = '';
									$patientName = '';
									foreach($event['attributes'] as $att){
										if($att['attribute'] == 'EVQtOacM08c'){
											$patientId = $att['value'];
										}
										if($att['attribute'] == 'k7m345VFe92'){
											$patientName = $att['value'];
										}
									}
									$message = 'A '.$prog.' patient transferred to your facility, ID: '.$patientId.' Name: '.$patientName;
									
									// Send SMS to health worker
									$api_url = $this->config->item('sms_send_url').
									http_build_query(array(
										'token' => $this->config->item('sms_token'),
										'from'  => $this->config->item('sms_number'),
										'to'    => $transferedToOuContact,
										'text'  => $message)
									);
									$smsGatewayResponse_patient = file_get_contents($api_url);
									$responseArray = json_decode($smsGatewayResponse_patient,true);									
									// End Send SMS
									break;
								}else if($dataValue['dataElement'] == 'YGQsaihcId6' && $dataValue['value'] == 'In'){
									foreach($event['dataValues'] as $dataValue){
										if($dataValue['dataElement'] == 'yflfZ1gs7px'){
											$transferedFromOu = $dataValue['value'];					
											break;
										}
									}
								}
								
							}
						}
					}
				}
			}else{
				exit(0);
			}
		}
	}
}
