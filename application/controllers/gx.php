<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gx extends CI_Controller {
	
	public function __construct(){
		parent::__construct(); 
		$this->load->helper('url');
		$this->load->model('gx_model');
	}

	public function index(){
		$string = $_SERVER['QUERY_STRING'];
		//print_r($string);

		$segs = explode("\n",$string);
		print_r($segs);
		echo '<br/>';
		$out = array();       
        //get delimiting characters
        if (substr($segs[0],0,3) != 'MSH') {
            $out['ERROR'][0] = 'Invalid HL7 Message.';
            $out['ERROR'][1] = 'Must start with MSH';
            return $out;
            exit;
        }

        $delbarpos = strpos($segs[0],'|',4);  //looks for the closing bar of the delimiting characters
        $delchar = substr($segs[0],4,($delbarpos - 4));

        define('FLD_SEP', substr($delchar,0,1));
        define('SFLD_SEP', substr($delchar,1,1));
        define('REP_SEP', substr($delchar,2,1));
        define('ESC_CHAR', substr($delchar,3,1));

        foreach($segs as $fseg) {
            $segments = explode('|',$fseg);
            $segname = $segments[0];
            $i = 0;
            foreach ($segments as $seg) {
				if (strpos($seg,FLD_SEP) == false) {
					$out[$segname][$i] = $seg;
                }else {
                    $j=0;
                    $sf = explode(FLD_SEP,$seg);
                    foreach($sf as $f) {
						$out[$segname][$i][$j] = $f;
                        $j++;
                    }
				}
				$i++;
			}
        }
		//define('PT_NAME',$out['PID'][5][0],true);
		print_r($out);
		//return $out;
	}
	
	
/****** Single Result Assay 
MSH|^~\&|GeneXpert PC^GeneXpert^Dx4.6a.5_Demo||LIS||20141027171453||ORU^R32^ORU_R30|URM‐/TvGUlUA‐
01|P|2.5
PID|1||||^^^^
ORC|RE|1|||||||20060124131136
OBR|1|||GBS TC|||||||||||||||||||||F
TQ1|||||||20060124131136|20060124142551|R
OBX|1|ST|&GBS TC&GBS Clinical Trial&4||NEGATIVE^||||||F|||||^Teresa Boswell||~~~~700844~
SPM|1|03594r^||ORH|||||||P
**********************/
}