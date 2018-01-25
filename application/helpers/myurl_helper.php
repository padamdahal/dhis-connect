<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('base_url')){
	function base_url(){
		$CI =& get_instance();
		return $CI->config->base_url();
	}
}

if( ! function_exists('thumbs_url')){
	function thumbs_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'public/uploads/thumbs/'.$filename;
	}
}

if( ! function_exists('avatar_url')){
	function avatar_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'uploads/thumbs/avatars/'.$filename;
	}
}

if( ! function_exists('avatar_b_url')){
	function avatar_b_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'uploads/images/avatars/'.$filename;
	}
}

if( ! function_exists('photos_url')){
	function photos_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'public/uploads/images/'.$filename;
	}
}

if( ! function_exists('css_url')){
	function css_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'static/site/css/'.$filename;
	}
}

if( ! function_exists('ctrl_css_url')){
	function ctrl_css_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'static/admin/css/'.$filename;
	}
}

if( ! function_exists('images_url')){
	function images_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'static/site/images/'.$filename;
	}
}

if( ! function_exists('ctrl_images_url')){
	function ctrl_images_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'static/admin/images/'.$filename;
	}
}

if( ! function_exists('scripts_url')){
	function scripts_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'static/site/js/'.$filename;
	}
}

if( ! function_exists('ctrl_scripts_url')){
	function ctrl_scripts_url($filename){
		$CI =& get_instance();
		return $CI->config->base_url().'static/admin/js/'.$filename;
	}
}

if( ! function_exists('create_link')){
	function create_link($link){
		$CI =& get_instance();
		return $CI->config->base_url().$link;
	}
}