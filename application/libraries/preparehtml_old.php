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
	// Generates the html for multiple contents
	public function prepare_contentsss($data){
		$html = '';
		if($data != null){
			foreach($data as $content){
				$html .= '<div class="content">';
				$html .= '<h2>'.$content['c_title'].'</h2>';
				if($content['c_content']!= null){
					if($content['c_showfeaturedimage'] == 1){
						$html .='<div class="featured_image">
							<img src="'.base_url().'public/uploads/images/'.$content['m_filename'].'"/>
						</div>';	
					}	
					$html .= '<p>'.$content['c_content'].'</p>';
				}
				$html .= '</div>';
			}
		}
		return $html;
	}
	
	public function prepare_content($data){
		$html = '';
		if($data != null){
			foreach($data as $content){
				if($content['c_showfeaturedimage'] == 1 && $content['m_filename'] != null){
					$template = $this->CI->template_reader->get_template('content-image');
					$html = str_replace("{content_title}", $content['c_title'], $template);
					$html = str_replace("{content_image}", base_url().'public/uploads/images/'.$content['m_filename'], $html);
					$html = str_replace("{content_body}", $content['c_content'], $html);
				}else{
					$template = $this->CI->template_reader->get_template('content-no-image');
					$html = str_replace("{content_title}", $content['c_title'], $template);
					$html = str_replace("{content_body}", $content['c_content'], $html);
				}
			}
			return $html;
		}
	}
	
	public function prepare_blog_content($data){
		$html = '';
		if($data != null){
			foreach($data as $child){
				$overview_mode = $child['c_showinoverviewmode'];
				$show_image = $child['c_showfeaturedimage'];
				if($show_image == 1 && $child['m_filename'] != null) {
					$html .= '<div class="child_content">';
					$html .= '<div class="child_image">
								<img src="'.base_url().'public/uploads/thumbs/'.$child['m_filename'].'"/>
							</div><!-- child_image -->';
					$html .= '<div class="child_body">
								<h3>'.$child['c_title'].'</h3>';
					if($overview_mode == 0){
						$html .= '<p>'.$child['c_content'].'</p>';
					}else{
						$html .= '<p>'.substr($child['c_content'],0,$child['c_content_length']);
						$html .=' <a href="'.base_url().$child['c_seo_name'].'">Read more</a>';
						$html .= '</p>';
					}
					$html .= '</div><!-- child_body -->
						</div><!-- child_content -->';
				}else{
					$html .= '<div class="child_content">';
					$html .= '<div class="child_body">';
					$html .= '<h3>'.$child['c_title'].'</h3>';
					if($overview_mode == 0){
						$html .= '<p>'.$child['c_content'].'</p>';
					}else{
						$html .= '<p>'.substr($child['c_content'],0,$child['c_content_length']).'</p>';
						$html .=' <a href="'.base_url().$child['c_seo_name'].'">Read more</a>';
					}
					$html .= '</div><!-- child_body -->
						</div><!-- child_content -->';
				}
			}
		}
		$html .= '<div style="clear:both"></div>';
		return $html;
	}
	
	public function prepare_child_content($data,$parent=null){
		$html = '';
		$alt = true;
		if($data != null){
			foreach($data as $child){
				if($alt == true){
					$alt=false;
				}else{
					$alt=true;
				}
				if($alt == true){
					$class = 'alternate';
				}else{
					$class = null;
				}
				$overview_mode = $child['c_showinoverviewmode'];
				$show_image = $child['c_showfeaturedimage'];
				if($show_image == 1 && $child['m_filename'] != null) {
					$html .= '<div class="child_content '.$class.'">';
					$html .= '<div class="child_image">
								<img src="'.base_url().'public/uploads/thumbs/'.$child['m_filename'].'"/>
							</div><!-- child_image -->';
					$html .= '<div class="child_body">
								<h3>'.$child['c_title'].'</h3>';
					if($overview_mode == 0){
						$html .= '<p>'.$child['c_content'].'</p>';
					}elseif($overview_mode == 1 && strlen($child['c_content']) > $child['c_content_length']){
						$html .= '<p>'.substr($child['c_content'],0,$child['c_content_length']);
						$html .=' <a href="'.base_url().$child['c_seo_name'].'">Read more</a>';
						$html .= '</p>';
					}else{
						$html .= '<p>'.$child['c_content'].'</p>';
					}
					$html .= '</div><!-- child_body -->
						</div><!-- child_content -->';
				}else{
					$html .= '<div class="child_content">';
					$html .= '<div class="child_body">';
					$html .= '<h3>'.$child['c_title'].'</h3>';
					if($overview_mode == 0){
						$html .= '<p>'.$child['c_content'].'</p>';
					}elseif($overview_mode == 1 && strlen($child['c_content']) > $child['c_content_length']){
						$html .= '<p>'.substr($child['c_content'],0,$child['c_content_length']).'</p>';
						$html .=' <a href="'.base_url().$child['c_seo_name'].'">Read more</a>';
					}else{
						$html .= '<p>'.$child['c_content'].'</p>';
					}
					$html .= '</div><!-- child_body -->
						</div><!-- child_content -->';
				}
			}
		}
		$html .= '<div style="clear:both"></div>';
		return $html;
	}
	
	public function prepare_slideshow($items){
		$content = '';
		foreach($items as $items){
			$src = base_url().'public/uploads/images/'.$items['m_filename'];
			$content .= '<div class="slide">
							<img src="'.$src.'" class="loaded" style="text-align:center;position:relative;"/>
						</div>';
		}
		return $content;
	}
		
	public function prepare_select($items,$value_col,$text_col,$name,$css_class,$selected){
		$select = '<select class="'.$css_class.'" name="'.$name.'">';
		$select .= '<option value="">---</option>';
		foreach($items as $items){
			if($items[$value_col] == $selected)
				$s = "selected";
			else 
				$s = null;
			$select .= '<option value="'.$items[$value_col].'" '.$s.'>'.$items[$text_col].'</option>';
		}
		$select .= '</select>';
		return $select;
	
	}
	
	/************************ Widgets ********************************/
	public function prepare_widgets($widget){
		$widgets = '';
		if($widget != null){
			$method_to_call = 'prepare_'.$widget['wt_name'].'_widget';
			$widget = $this->$method_to_call($widget);
		}else{
			$widget = null;
		}
		return $widget;
	}
	
	/******************************** PHOTOS ************************/
	public function prepare_media_list($data){
		$return_value = '';
		if($data){
			foreach($data as $items){
				$return_value .= '<div class="left photo-block" style="position:relative;float:left;margin:3px 5px 2px 0;border:none;">
					<a class="fancybox" id="'.$items['m_id'].'" rel="gallery" title="'.$items['m_title'].'" href="'.create_link('public/uploads/images/'.$items['m_filename']).'" style="">
						<img width="148" src="'.base_url().'public/uploads/thumbs/'.$items['m_filename'].'" />
					</a>
				</div>';
			}
		}else{
			$return_value = "No Photos!";
		}
		return $return_value;
	}
	
	protected function prepare_text_widget($widget){
		$html = '';
		if($widget != null){
			$html .= '<div class="widget-text-wraper">';
			if($widget['w_display_title'] == 1){
				$html .= '<div class="widget_title">'.$widget['w_title'].'</div>';
			}
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html .= '<div class="widget-image">
							<img src="'.base_url().'public/uploads/thumbs/'.$widget['m_filename'].'"/>
						</div>';
			}
			if($widget['w_display_content'] == 1){
				$html .= '<div class="widget-content">'.$widget['w_text'].'</div>';
			}
			$html .= '</div>';
		}else{
			$html = 'No widget created.';
		}
		return $html;
	}
	
	protected function prepare_media_widget($widget){
		$html = '';
		if($widget != null){
			$html .= '<div class="widget-image-wraper">';
			if($widget['w_display_title'] == 1){
				$html .= '<div class="widget_title">'.$widget['w_title'].'</div>';
			}
			if($widget['w_display_content'] == 1){
				if($widget['m_filename'] != null){
					$html .= '<div class="widget-image">
							<img src="'.base_url().'public/uploads/thumbs/'.$widget['m_filename'].'"/>;
						</div>';
				
					if($widget['w_display_child_title']){
						$html .= '<div class="widget-image-title">'.$widget['m_title'].'</div>';
					}
					if($widget['w_display_child_content']){
						$html .= '<div class="widget-image-description">'.$widget['m_description'].'</div>';
					}
				}
			}
			$html .= '</div>';
		}else{
			$html = 'No widget created.';
		}
		return $html;
	}
	
	protected function prepare_category_widget($widget){
		$html = '';
		if($widget != null){						
			if($widget['w_display_title'] == 1){
				$html .= '<div class="widget_title">'.$widget['w_title'].'</div>';
			}
			
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html .= '<div class="widget_image">
							<img src="'.base_url().'public/uploads/thumbs/'.$widget['m_filename'].'"/>
						</div>';
			}
						
			if($widget['w_display_content'] == 1){
				$html .= '<div class="widget-childred">';
				$cat_id = $widget['cat_id'];
				$num_of_items = ($widget['w_child_count']>0)?$widget['w_child_count']:null;
				$content = $this->CI->main_model->contents_by_category($cat_id,$num_of_items);
				
				if($content != null){
					foreach($content as $child){						
						$html .= '<div class="child">';
						if($widget['w_display_child_title']){
							$html .= '<div class="child_title">'.$child['c_title'].'</div>';
						}
						if($child['c_showfeaturedimage'] == 1 && $child['m_filename'] != null){
							$html .= '<div class="child_image">
								<img src="'.base_url().'public/uploads/thumbs/'.$child['m_filename'].'"/>
							</div>';
						}
						if($child['c_showinoverviewmode'] == 0){
							$html .= '<div class="child_content">'.$child['c_content'].'</div>';
						}elseif($child['c_showinoverviewmode'] == 1 && strlen($child['c_content']) > $child['c_content_length']){
							$html .= '<div class="child_content">'.substr($child['c_content'],0,$child['c_content_length']).' <a href="#">more</a></div>';
						}else{
							$html .= '<div class="child_content">'.$child['c_content'].'</div>';
						}
					$html .= '</div>';
					}
				}
				$html .= '</div>';
			}
		}else{
			$html .= 'No widget created.';
		}
		return $html;
	}
	
	protected function prepare_content_widget($widget){
		$html = '';
		$c_seo_name = $widget['c_seo_name'];
		$content = $this->CI->main_model->content($cid);
		$content = $content[0];
		
		if($widget != null){
			$html .= '<div class="widget-category-wraper">';
			
			if($widget['w_display_title'] == 1){
				$html .= '<div class="widget_title">'.$widget['w_title'].'</div>';
			}
			
			if($widget['w_display_image'] == 1 && $widget['m_filename'] != null){
				$html .= '<div class="widget_image">
							<img src="'.base_url().'public/uploads/images/'.$widget['m_filename'].'"/>
						</div>';
			}
			
			if($widget['w_display_content'] == 1){
				if($widget['w_display_child_title']){
					$html .= '<div class="child_title">'.$content['c_title'].'</div>';
				}
				if($widget['w_display_child_content']){
					if($widget['w_child_count'] > 0 && strlen($content['c_content']) > $widget['w_child_count']){
						$html .= '<div class="child_content">'.substr($content['c_content'],0,$widget['w_child_count']).' <a href="'.create_link($content['c_seo_name']).'">More</a></div>';
					}else{
						$html .= '<div class="child_content">'.$content['c_content'].'</div>';
					}
				}
			}
			$html .= '</div>';
		}else{
			$html .= 'No widget created.';
		}
		return $html;
	}

	protected function prepare_gallery_widget($widget){
		$html = '';
		$media = $this->CI->main_model->gallery($widget['w_child_count']);
		$gallery = $this->prepare_media_list($media);
		
		if($widget != null){
			$html .= '<div class="widget-gallery-wraper">';
			
			if($widget['w_display_title'] == 1){
				$html .= '<div class="widget_title">'.$widget['w_title'].'</div>';
			}
			
			if($widget['w_display_content'] == 1){
				$html .= '<div class="widget_content">'.$gallery.'</div>';
			}
			$html .= '</div>';
		}else{
			$html .= 'No widget created.';
		}
		return $html;
	}
	
}