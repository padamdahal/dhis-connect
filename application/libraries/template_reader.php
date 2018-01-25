<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_template_reader{
	protected $template_file;
	
	/* Constructor */
	public function __construct($rules = array()){
		//$this->CI =& get_instance();
		$this->template_file = FCPATH.'public/pages/template.php';
	}
		
    public function get_template($section){
        if(file_exists($this->template_file)){
            $f = fopen($this->template_file,"r");
            $template = fread($f,filesize($this->template_file));
            fclose($f);
            if(!empty($section)){
                    $start_section = "<!--".$section."-->";
                    $end_section = "<!--/".$section."-->";

                    $start_pos = strpos($template,$start_section);
                    $end_pos = strpos($template,$end_section)+strlen($end_section);

                    if(!($start_pos===false) && !($end_pos===false)){
                        $template = substr($template,$start_pos,$end_pos-$start_pos);
                    }else{
						$template = null;// = "Template marker definition error.";
					}					
            }else{
                $template = "Template section not specified.";
            }
        }else{
            $template = 'Template file Not found';
        }
        return $template;
    }
}
?>