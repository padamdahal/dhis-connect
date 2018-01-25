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

		if($data != null){
			foreach($data as $content){
				$template = $this->CI->template_reader->get_template($template);
				$html = str_replace("{title}", $content['c_title'], $template);
				$html = str_replace("{body}", $content['c_content'], $html);
				if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
					$html = str_replace("{image}", base_url().'public/uploads/images/'.$content['m_filename'], $html);
				}else{
					// Remove the image part from the template
					$html = $this->remove_section($html,'<!--image-->','<!--/image-->');		
				}
				$return .= $html;
			}
			return $return;
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
						$html = $this->remove_section($html,'<!--readmore-->','<!--/readmore-->');		
						
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
					$html = $this->remove_section($html,'<!--image-->','<!--/image-->');		

					// Continue with the template
					$html = str_replace("{title}", $child['c_title'], $html);
					if($overview_mode == 0){
						// Remove the readmore part from the template
						$html = $this->remove_section($html,'<!--readmore-->','<!--/readmore-->');		
						
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
		return $children;
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
		return str_replace($content, $c, $template);
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
		
		return str_replace($content, $c, $template);
	}
	/*
	public function prepare_widgets($widget,$template){
		if($widget != null){
			// Get the template part
			$tmp = $this->CI->template_reader->get_template($template);
			$child = $this->extract_part($tmp,'content');
			
			if($widget['w_display_title'] == 1){
				$html = str_replace("{title}", $widget['w_title'], $tmp);
			}else{
				$html = $this->remove_section($html,'<!--title-->','<!--/title-->');
			}
			
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html = str_replace("{image}", thumbs_url($widget['m_filename']), $html);
			}else{
				$html = $this->remove_section($html,'<!--image-->','<!--/image-->');
			}

			if($widget['w_display_content'] == 1){
				$content_id = $widget['w_content'];
				$type = $widget['w_type'];
				$item_count = ($widget['w_child_count']>0) ? $widget['w_child_count'] : null;
				$contents = null;
				
				// Check if category id is set and retrive contents by category
				if($content_id != null && $content_id != 0){
					$model_method = 'content_by_'.$type;
					$contents = $this->CI->main_model->$model_method($content_id,$item_count);
				}else{
					$contents = null;
				}
								
				$html3 = '';
				
				if($contents != null){
					foreach($contents as $content){
						if($widget['w_display_child_title']){
							$html2 = str_replace("{title}", $content['c_title'], $child);
						}else{
							$html2 = $this->remove_section($child,'<!--title-->','<!--/title-->');
						}
						
						if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
							$html2 = str_replace("{image}", thumbs_url($content['m_filename']), $html2);
						}else{
							$html2 = $this->remove_section($html2,'<!--image-->','<!--/image-->');
						}
						
						if($widget['w_display_child_content']){
							if($widget['w_child_count'] != 0 && strlen($content['c_content']) > $widget['w_child_count']){
								//$html2 = str_replace("{body}", substr($content['c_content'],0,$widget['w_child_count']), $html2);
								$html2 = str_replace("{body}", $content['c_content'], $html2);
								$html2 = str_replace("{readmore}", create_link($content['c_seo_name']), $html2);
							}else{
								$html2 = str_replace("{body}", $content['c_content'], $html2);
								// Remove the body part from the template
								$html2 = $this->remove_section($html2,'<!--readmore-->','<!--/readmore-->');
							}
						}else{
							$html2 = $this->remove_section($html2,'<!--content-->','<!--/content-->');
						}
						$html3 .= $html2;
					}
				}else{
					$html3 = null;
				}
				$child = $this->extract_part($html,'content');
				$html = str_replace($child, $html3, $html);
			}else{
				//$html = $this->remove_section($html,'<!--body-->','<!--/body-->');
				$html = $this->remove_section($html,'<!--content-->','<!--/content-->');
			}
		}else{
			$html = 'No widget created.';
		}
		return $this->trim_html($html);
	}
	*/
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
						$html = $this->remove_section($html,'<!--image-->','<!--/image-->');
					}
					if($content['c_content'] != null && $content['c_content'] != ''){
						if(strlen($content['c_content']) > $length){
							$html = str_replace("{body}", substr($content['c_content'],0,$length), $html);
							$html = str_replace("{readmore}", create_link($content['c_seo_name']), $html);
						}else{
							$html = str_replace("{body}", $content['c_content'], $html);
							if($this->extract_part($tmp,'readmore') != null){
								// Remove the body part from the template
								$html = $this->remove_section($html,'<!--readmore-->','<!--/readmore-->');
							}else{
								$html = str_replace("{readmore}", '#', $html);
							}
						}
					}else{
						$html = $this->remove_section($html,'<!--body-->','<!--/body-->');
					}
					$c .= $html;
				}
			$child = $this->extract_part($tmp,'content');
			$html = str_replace($child, $c, $tmp);
		return $this->trim_html($html);
	}
	/*
	protected function gallery_widget($widget,$template){
		$content = '';
		$media = $this->CI->main_model->gallery($widget['w_child_count']);

		if($media){
			// Get the template part
			$template = $this->CI->template_reader->get_template($template);
			$child = $this->extract_part($template,'child');
			
			if($widget['w_display_title'] == 1){
				$html = str_replace("{title}", $widget['w_title'], $template);
			}else{
				// Remove the title part from the template
				$html = $this->remove_section($template,'<!--title-->','<!--/title-->');
			}
			
			if($widget['w_display_image'] == 1){
				$html = str_replace("{image}", $widget['m_filename'], $html);
			}else{
				// Remove the title part from the template
				$html = $this->remove_section($html,'<!--image-->','<!--/image-->');
			}
			
			foreach($media as $items){
				if($child != null){
					$thumbnail = thumbs_url($items['m_filename']);
					$id = $items['m_id'];
					$title = $items['m_title'];
					$link = create_link('public/uploads/images/'.$items['m_filename']);
				
					$html2 = str_replace("{media_thumbnail}", $thumbnail, $child);
					$html2 = str_replace("{media_id}", $id, $html2);
					$html2 = str_replace("{media_title}", $title, $html2);
					$html2 = str_replace("{media_link}", $link, $html2);
				
					$content .= $html2;
				}
			}
			
			$html = str_replace($child, $content, $html);
		}else{
			$html = "No Photos!";
		}
		return $this->trim_html($html);
	}
	
	protected function text_widget($widget,$template){
		$html = '';
		if($widget != null){
			// Get the template part
			$template = $this->CI->template_reader->get_template($template);
			$child = $this->extract_part($template,'child');
			
			if($widget['w_display_title'] == 1){
				$html = str_replace("{title}", $widget['w_title'], $template);
			}else{
				/// Remove the title part from the template
				$html = $this->remove_section($html,'<!--title-->','<!--/title-->');
			}
			
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html = str_replace("{image}", base_url().'public/uploads/thumbs/'.$widget['m_filename'], $html);
			}else{
				// Remove the image part from the template
				$html = $this->remove_section($html,'<!--image-->','<!--/image-->');
			}
			if($widget['w_display_content'] == 1){
				$html = str_replace("{body}", $widget['w_text'], $html);
			}else{
				// Remove the body part from the template
				$html = $this->remove_section($html,'<!--body-->','<!--/body-->');
			}
		}else{
			$html = 'No widget created.';
		}
		return $this->trim_html($html);
	}

	public function prepare_media_widget($media,$template){
		$html = '';
		$content = null;
		// Get the template part
		$template = $this->CI->template_reader->get_template($template);
		foreach($media as $items){
			$media_thumbnail = thumbs_url($items['m_filename']);
			$media_id = $items['m_id'];
			$media_title = $items['m_title'];
			$media_link = create_link('public/uploads/images/'.$items['m_filename']);
			$html = str_replace("{thumbnail}", $media_thumbnail, $template);
			$html = str_replace("{id}", $media_id, $html);
			$html = str_replace("{title}", $media_title, $html);
			$html = str_replace("{link}", $media_link, $html);
			$content .= $html;
		}
		return $this->trim_html($content);
	}*/
	/*
	protected function category_widget($widget,$template){
		$html = '';
		if($widget != null){
			// Get the template part
			$tmp = $this->CI->template_reader->get_template($template);
			$child = $this->extract_part($tmp,'child');
			
			if($widget['w_display_title'] == 1){
				$html = str_replace("{title}", $widget['w_title'], $tmp);
			}else{
				$html = $this->remove_section($html,'<!--title-->','<!--/title-->');
			}
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html = str_replace("{image}", thumbs_url($widget['m_filename']), $html);
			}else{
				$html = $this->remove_section($html,'<!--image-->','<!--/image-->');
			}

			if($widget['w_display_content'] == 1){
				$cat_id = $widget['cat_id'];
				$num_of_items = ($widget['w_child_count']>0) ? $widget['w_child_count'] : null;
				$contents = $this->CI->main_model->contents_by_category($cat_id,$num_of_items);
				$html3 = '';
				
				if($contents != null){
					foreach($contents as $content){
						if($widget['w_display_child_title']){
							$html2 = str_replace("{title}", $content['c_title'], $child);
						}else{
							$html2 = $this->remove_section($child,'<!--title-->','<!--/title-->');
						}
						
						if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
							$html2 = str_replace("{image}", thumbs_url($content['m_filename']), $html2);
						}else{
							$html2 = $this->remove_section($html2,'<!--image-->','<!--/image-->');
						}
						
						if($widget['w_display_child_content']){
							if($widget['w_child_count'] != 0 && strlen($content['c_content']) > $widget['w_child_count']){
								//$html2 = str_replace("{body}", substr($content['c_content'],0,$widget['w_child_count']), $html2);
								$html2 = str_replace("{body}", $content['c_content'], $html2);
								$html2 = str_replace("{readmore}", create_link($content['c_seo_name']), $html2);
							}else{
								$html2 = str_replace("{body}", $content['c_content'], $html2);
								// Remove the body part from the template
								$html2 = $this->remove_section($html2,'<!--readmore-->','<!--/readmore-->');
							}
						}else{
							$html2 = $this->remove_section($html2,'<!--body-->','<!--/body-->');
						}
						$html3 .= $html2;
					}
					$child = $this->extract_part($html,'child');
					$html = str_replace($child, $html3, $html);
				}
			}else{
				$html = $this->remove_section($html,'<!--body-->','<!--/body-->');
				$html = $this->remove_section($html,'<!--child-->','<!--/child-->');
			}
		}else{
			$html = 'No widget created.';
		}
		return $this->trim_html($html);
	}
	
	protected function content_widget($widget,$template){
		$html = '';
		if($widget != null){
			// Get the template part
			$tmp = $this->CI->template_reader->get_template($template);
			$child = $this->extract_part($tmp,'child');
			
			if($widget['w_display_title'] == 1){
				$html = str_replace("{title}", $widget['w_title'], $tmp);
			}else{
				// Remove the title part from the template
				$html = $this->remove_section($tmp,'<!--title-->','<!--/title-->');
			}
			
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html = str_replace("{image}", base_url().'public/uploads/thumbs/'.$widget['m_filename'], $html);
			}else{
				// Remove the image part from the template
				$html = $this->remove_section($html,'<!--image-->','<!--/image-->');
			}
						
			if($widget['w_display_content'] == 1){
				$content = $this->CI->main_model->content('about-us');
				$content = $content[0];
				$html2 = '';
				if($content != null){
					
					if($widget['w_display_child_title']){
						$html2 = str_replace("{title}", $content['c_title'], $child);
					}else{
						$html2 = $this->remove_section($child,'<!--title-->','<!--/title-->');
					}
					
					if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
						$html2 = str_replace("{image}", base_url().'public/uploads/thumbs/'.$content['m_filename'], $html2);
					}else{
						$html2 = $this->remove_section($html2,'<!--image-->','<!--/image-->');
					}
					
					if($widget['w_display_child_content']){
						if($widget['w_child_count']!= 0 && strlen($content['c_content']) > $content['c_content_length']){
							$html2 = str_replace("{body}", substr($content['c_content'],0,$widget['w_child_count']), $html2);
							$html2 = str_replace("{readmore}", create_link($content['c_seo_name']), $html2);
						}else{
							$html2 = str_replace("{body}", $content['c_content'], $html2);
							// Remove the readmore part from the template
							$html2 = $this->remove_section($html2,'<!--readmore-->','<!--/readmore-->');
						}
					}else{
						$html2 = $this->remove_section($html2,'<!--body-->','<!--/body-->');
					}
					$child = $child = $this->extract_part($html,'child');
					$html = str_replace($child, $html2, $html);
				}
			}else{
				$html = $this->remove_section($html,'<!--body-->','<!--/body-->');
				$html = $this->remove_section($html,'<!--child-->','<!--/child-->');
			}
		}else{
			$html = 'No widget created.';
		}
		return $this->trim_html($html);
	}
	*/
	// Function replaces the substring identified by the start and end parameters
	protected function remove_section($string, $start, $end) {
		$html = null;
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
		// Replace the content with null
		//$html = substr($string,$start,$end-$start);
		return $html;
	}

	// Function cleans the html by removing the template identifiers
	protected function trim_html($html){
		return preg_replace('/'.preg_quote('<!--').'.*?'.preg_quote('-->').'/', null, $html);
	}
	
}