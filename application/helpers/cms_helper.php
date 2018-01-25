<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('nav_menu')){
	function nav_menu(){
		$CI =& get_instance();
		$list = $CI->main_model->nav_menu();
		return $list;
	}
}

if( ! function_exists('has_children')){
	function has_children($c_id){
		$CI =& get_instance();
		$result = $CI->main_model->has_children($c_id);
		return $result;
	}
}

if( ! function_exists('get_children')){
	function get_children($c_id){
		$CI =& get_instance();
		$result = $CI->main_model->get_children($c_id);
		return $result;
	}
}

if( ! function_exists('content')){
	function content($seo_name){
		$CI =& get_instance();
		$list = $CI->main_model->content($seo_name);
		return $list;
	}
}

if(!function_exists('category')){
	function category($cat_name,$num_of_items){
		$CI =& get_instance();
		$list = $CI->main_model->contents_by_category($cat_name,$num_of_items);
		return $list;
	}
}

if(!function_exists('get_attachments')){
	function get_attachments($seo_name){
		$CI =& get_instance();
		$list = $CI->main_model->get_attachments($seo_name);
		return $list;
	}
}



if( ! function_exists('widget')){
	function widget($widget_key,$template){
		$CI =& get_instance();
		$widget = $CI->main_model->widget($widget_key);
		if($widget != null){
			$html = $CI->preparehtml->prepare_widgets($widget[0],$template);
		}else{
			$html = 'Widget : '.$widget_key.' not defined!';
		}
		return $html;
	}
}

if( ! function_exists('gallery')){
	function gallery($template = null,$perpage = null){
		$html = null;
		if($template == null){
			$html = 'No template parameter set for the gallery!';
		}else{
			$CI =& get_instance();
			$gallery = $CI->main_model->gallery();
			if($gallery != null){
				$html = $CI->preparehtml->prepare_media_list($gallery,$template,$perpage);
			}else{
				$html = 'No Items!';
			}
			return $html;
		}
	}
}

if( ! function_exists('media')){
	function media($media_id = null,$template = null){
		$html = null;
		if($template == null){
			$html = 'No template parameter set for the gallery!';
		}else{
			$CI =& get_instance();
			$media = $CI->main_model->media($media_id);
			if($media != null){
				$html = $CI->preparehtml->prepare_media_list($media,$template,null);
			}else{
				$html = 'No Items!';
			}
			return $html;
		}
	}
}
	
if(!function_exists('content')){
	function content($c_seo_name, $length = null, $template = null){
		$CI =& get_instance();
		$content = $CI->main_model->content_by_seo($c_seo_name);
		if($content != null){
			$html = $CI->preparehtml->prepare_widget($content,$length,$template);
		}else{
			$html = 'Content couldn\'t be retrived!';
		}
		return $html;
	}
}

if(!function_exists('html')){
	function html($content, $tpl){
		$CI =& get_instance();
		if($content != null){
			$html = '';
			foreach($content as $child){
				$temp = str_replace('{title}',$child['c_title'],$tpl);
				$href = create_link($child['c_seo_name']);
				$temp = str_replace('{href}',$href,$temp);
				$html .= $temp;
			}
		}else{
			$html = null;
		}
		echo $html;
	}
}