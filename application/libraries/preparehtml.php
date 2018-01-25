<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_preparehtml {
	protected $CI;
	
	/* Constructor */
	public function __construct($rules = array()){
		$this->CI =& get_instance();
		$this->CI->load->library('template_reader');
	}
	
	public function prepare_no_content(){
		return  '<div class="not_found">Nothing found...</div>';
	}
	
	public function prepare_content($data, $template = 'content'){
		$html = null;
		$return = null;
		$template = $this->CI->template_reader->get_template($template);
		
		if($data != null){
			foreach($data as $content){
				$html = str_replace("{title}", $content['c_title'], $template);
				$html = str_replace("{id}", $content['c_seo_name'], $html);
				$html = str_replace("{body}", $content['c_content'], $html);
				if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
					$html = str_replace("{image}", base_url().'public/uploads/images/'.$content['m_filename'], $html);
				}else{
					// Remove the image part from the template
					$html = $this->remove_section($html,'image');		
				}
				$return .= $html;
			}
			return $this->trim_html($return);
		}
	}
	
	public function prepare_message($data, $template = 'content'){
		$html = null;
		$return = null;

		if($data != null){
			foreach($data as $content){
				$template = $this->CI->template_reader->get_template($template);
				$html = str_replace("{title}", $content['c_title'], $template);
				$html = str_replace("{id}", $content['c_seo_name'], $html);
				$html = str_replace("{body}", substr($content['c_content'],0,500).'...', $html);
				if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
					$html = str_replace("{image}", base_url().'public/uploads/images/'.$content['m_filename'], $html);
				}else{
					// Remove the image part from the template
					$html = $this->remove_section($html,'image');		
				}
				$return .= $html;
			}
			return $this->trim_html($return);
		}
	}
		
	public function prepare_child_content($data, $template = 'child'){
		$html = '';
		$children = null;
		$template = null;
		if($data != null){
			foreach($data as $child){
				$overview_mode = $child['c_showinoverviewmode'];
				$show_image = $child['c_showfeaturedimage'];
				
				// Get the template part
				$template = $this->CI->template_reader->get_template($template);
				
				if($show_image == 1 && $child['m_filename'] != null) {
					// Set the title part
					$html = str_replace("{title}", $child['c_title'], $template);
					if($overview_mode == 0){
						// Remove the readmore part from the template
						$html = $this->remove_section($html,'readmore');		
						
						// Continue with the template
						$html = str_replace("{body}", $child['c_content'], $html);
						$html = str_replace("{image}", base_url().'public/uploads/images/'.$child['m_filename'], $html);
					}else{
						$html = str_replace("{image}", base_url().'public/uploads/thumbs/'.$child['m_filename'], $html);
						if(strlen($child['c_content']) > $child['c_content_length']){
							$html = str_replace("{body}", substr($child['c_content'],0,$child['c_content_length']), $html);
							$html = str_replace("{readmore}", create_link($child['c_seo_name']), $html);
						}else{
							$html = str_replace("{body}", $child['c_content'], $html);
						}
					}
				}else{
					// Remove the image part from the template
					$html = $this->remove_section($html,'image');		

					// Continue with the template
					$html = str_replace("{title}", $child['c_title'], $html);
					if($overview_mode == 0){
						// Remove the readmore part from the template
						$html = $this->remove_section($html,'readmore');		
						
						// Continue with the template
						$html = str_replace("{body}", $child['c_content'], $html);
						$html = str_replace("{image}", base_url().'public/uploads/images/'.$child['m_filename'], $html);
						$html = str_replace("{readmore}", create_link($child['c_seo_name']), $html);
					}else{
						if(strlen($child['c_content']) > $child['c_content_length']){
							$html = str_replace("{body}", substr($child['c_content'],0,$child['c_content_length']), $html);
							$html = str_replace("{readmore}", create_link($child['c_seo_name']), $html);
						}else{
							$html = str_replace("{body}", $child['c_content'], $html);
							$html = str_replace("{readmore}", create_link($child['c_seo_name']), $html);
						}
					}
				}
				$children .= $html;
			}
		}
		exit($children);
		return $this->trim_html($children);
	}
	
	public function prepare_navigation($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				$html .= '<div class="navigation_item" style="padding:5px 0;border-bottom:1px solid #ececec;">
				<a href="#'.$child['c_seo_name'].'" >'.$child['c_title'].' &raquo;</a></div>';
			}
		}
		return $this->trim_html($html);
	}
	
	public function prepare_listitems($data,$prefix=null){
		$html = '';
		if($data != null){
			foreach($data as $child){
				if($prefix!= null){
					$href = create_link($prefix.'/'.$child['value'].'.html');
				}else{
					$href = create_link($child['value'].'.html');
				}
				$html .= '<li><a href="'.$href.'">'.$child['title'].'</a></li>';
			}
		}
		return $this->trim_html($html);
	}
	
	public function prepare_resourcelist($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				
				$href = create_link('publications/detail/'.$child['c_id'].'/'.$child['c_seo_name'].'.html');
				if($child['m_filename'] != null){
					$image = photos_url($child['m_filename']);
				}else{
					$image = photos_url('icon-bulletin.png');
				}
				$html .= '<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
							<img src="'.$image.'" width="70" height="80" style="position:relative;float:left;margin:0 10px 10px 0;"/>
							<p class="message-main" style="font-weight:bold">
								<a href="'.$href.'">'.$child['c_title'].'</a>
							</p>
							<p><small>'.substr($child['c_content'],0,100).'</small></p>
						</div>';
			}
		}
		return $this->trim_html($html);
	}
	
	public function prepare_list($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				
				$href = create_link('publications/detail/'.$child['c_id'].'/'.$child['c_seo_name'].'.html');
				if($child['m_filename'] != null){
					$image = photos_url($child['m_filename']);
				}else{
					$image = photos_url('icon-bulletin.png');
				}
				$html .= '<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
							<img src="'.$image.'" width="70" height="80" style="position:relative;float:left;margin:0 10px 10px 0;"/>
							<p class="message-main" style="font-weight:bold">
								<a href="'.$href.'">'.$child['c_title'].'</a>
							</p>
							<p><small>'.substr($child['c_content'],0,100).'</small></p>
						</div>';
			}
		}
		return $this->trim_html($html);
	}
	
	// Attachment List
	public function prepare_attachmentlist($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				$href = create_link('public/uploads/attachments/'.$child['attachment_file']);
				$html .= '<li><a href="'.$href.'">'.$child['attachment_title'].'</a></li>';
			}
		}
		return $this->trim_html($html);
	}
	
	
	
	
	public function prepare_islinkitems($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				$html .= '<div class="news-item" style="padding:5px 0">
							<a target="_blank" href="'.strip_tags($child['c_content']).'">'.$child['c_title'].'</a>
						</div>';
			}
		}
		return $this->trim_html($html);
	}
	
	public function prepare_newsitems($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				$html .='<div class="news-item" style="border-bottom:1px dotted #eee;">
							<h5 style="margin-bottom:0"><a href="'.create_link('mediacenter/detail/'.$child['c_id'].'/'.$child['c_seo_name']).'">'.$child['c_title'].'</a></h5>
							<p style="color:#999;">Published: '.$child['c_createdate'].'</p>
						</div>';
			}
		}
		return $this->trim_html($html);
	}
	
	public function prepare_emergencyitems($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				$html .= '<div class="news-item" style="border-bottom:1px dotted #eee;">
							<h5 style="font-weight:bold"><a href="'.create_link('emergency/'.$child['c_seo_name']).'">'.$child['c_title'].'</a></h5>
							<p>'.$child['c_content'].'</p>
						</div>';
			}
		}
		return $this->trim_html($html);
	}
	
	public function prepare_slideshow($items){
		$c = '';
		// Get the template part
		$template = $this->CI->template_reader->get_template('slideshow-item');
		$content = $this->extract_part($template,'content');
		foreach($items as $item){
			$src = base_url().'public/uploads/images/'.$item['m_filename'];
			$html = str_replace("{image}", $src, $content);
			$html = str_replace("{title}", $item['m_title'], $html);
			$html = str_replace("{description}", $item['m_description'], $html);
			$c .= $html;
		}
		return $this->trim_html(str_replace($content, $c, $template));
	}
	
	public function prepare_media_list($data,$template,$perpage){
		$c = '';
		if($data){
			// Get the template part
			$template = $this->CI->template_reader->get_template($template);
			$content = $this->extract_part($template,'content');
			foreach($data as $items){
				$media_thumbnail = thumbs_url($items['m_filename']);
				$media_id = $items['m_id'];
				$media_title = $items['m_title'];
				$media_description = $items['m_description'];
				$media_link = create_link('public/uploads/images/'.$items['m_filename']);
				$html = str_replace("{thumbnail}", $media_thumbnail, $content);
				$html = str_replace("{id}", $media_id, $html);
				$html = str_replace("{title}", $media_title, $html);
				$html = str_replace("{description}", $media_description, $html);
				$html = str_replace("{link}", $media_link, $html);
				$c .= $html;
			}
		}else{
			$content = "No Photos!";
		}
		return $this->trim_html(str_replace($content, $c, $template));
	}
	
	public function prepare_widget($data,$length,$template){
		// Get the template part
		$tmp = $this->CI->template_reader->get_template($template);
		$child = $this->extract_part($tmp,'content');
		$c = null;
		foreach($data as $content){
			$html = str_replace("{title}", $content['c_title'], $child);
			if($content['m_filename'] != null){
				$html = str_replace("{image}", thumbs_url($content['m_filename']), $html);
			}else{
				$html = $this->remove_section($html,'image');
			}
					
			if($content['c_content'] != null && $content['c_content'] != ''){
				if(strlen($content['c_content']) > $length){
					$html = str_replace("{body}", substr($content['c_content'],0,$length), $html);
					$html = str_replace("{readmore}", create_link($content['c_seo_name']), $html);
				}else{
					$html = str_replace("{body}", $content['c_content'], $html);
					if($this->extract_part($tmp,'readmore') != null){
						// Remove the body part from the template
						$html = $this->remove_section($html,'readmore');
					}else{
						$html = str_replace("{readmore}", '#', $html);
					}
				}
				// Replace the meta information in the template
				$meta = $this->CI->main_model->content_meta($content['c_id']);
				if($meta != null){
					foreach($meta as $m){
						$html = str_replace("{".$m['meta_name']."}", $m['meta_value'], $html);
					}
				}
			}else{
				$html = $this->remove_section($html,'body');
			}
			$c .= $html;
		}
		$child = $this->extract_part($tmp,'content');
		$html = str_replace($child, $c, $tmp);
		return $this->trim_html($html);
	}
	
	// Function replaces the substring identified by the start and end parameters
	protected function remove_section($string, $part) {
		$html = null;
		$start = '<!--'.$part.'-->';
		$end = '<!--/'.$part.'-->';
		// Get the starting position
		$pos = strpos($string, $start);
		if($pos === false){
			$html = $string;
		}else{
			$start = $pos;
		
			// Get the ending position
			$pos = strpos($string, $end);
			if($pos === false){
				$html = 'Template marker not closed properly.';
			}else{
				$end = $pos + strlen($end);
				// Replace the content with null
				$html = str_replace(substr($string,$start,$end-$start),null,$string);
			}
		}
		return $html;
	}

	// Function extracts the substring identified by the start and end parameters
	protected function extract_part($html, $part) {
		$start = '<!--'.$part.'-->';
		$end = '<!--/'.$part.'-->';
		// Get the starting position
		$pos = strpos($html, $start);
		$start = $pos;
		
		// Get the ending position
		$pos = strpos($html, $end);
		$end = $pos + strlen($end);
		
		if(!($start===false) && !($end===false)){
			$html = substr($html,$start,$end-$start);
		}else{
			$html = null;
		}
		return $html;
	}

	// Function cleans the html by removing the template identifiers
	protected function trim_html($html){
		return preg_replace('/'.preg_quote('<!--').'.*?'.preg_quote('-->').'/', null, $html);
	}
	
}