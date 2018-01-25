<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Control_lib {

	protected $CI;
	
	/* Constructor */
	public function __construct($rules = array()){
		$this->CI =& get_instance();
	}
	
	public function prepare_contents($items){
		$listitems = '';
		foreach($items as $items){
			if($items['c_isactive'] == 1){
				$link = base_url().'admin/contents/deactivate/'.$items['c_id'];
				$color = 'lightgreen';
				$text = '<img src="'.images_url('x.png').'"/>';
				$title = 'Deactivate this content.';
			}else{
				$link = base_url().'admin/contents/activate/'.$items['c_id'];
				$color = 'red';
				$text = '<img src="'.images_url('check.png').'"/>';
				$title = 'Activate this content.';
			}
			$listitems .= '<tr id="content_'.$items['c_id'].'">
				<td class="title">'.$items['c_title'].'</td>
				<td class="content">'.substr($items['c_content'],0,150).'...
					<p>
						<a style="margin-right:5px;padding:5px 10px;" class="btn btn-success" id="edit_contents" href="'.base_url().'admin/contents/viewchildren/'.$items['c_id'].'">
							<img src="'.images_url('eye.png').'"
						</a>
						<a style="margin-right:5px;padding:5px 10px;" class="btn btn-success" id="edit_contents" href="'.base_url().'admin/contents/updateform/'.$items['c_id'].'">
							<img src="'.images_url('pencil.png').'"
						</a>
						<a style="margin-right:5px;padding:5px 10px;" title="Remove content" rel="content_'.$items['c_id'].'" class="btn btn-success content_action" href="'.base_url().'admin/contents/remove/'.$items['c_id'].'">
							<img src="'.images_url('trash.png').'"/>
						</a>
						<!--a class="btn btn-success content_action" style="background:'.$color.'" href="'.$link.'" title="'.$title.'"><img src="'.images_url('eye.png').'"/></a-->
					</p>
				</td>
			</tr>';
		}
		return $listitems;
	}
	
	public function prepare_feedbacks($items){
		$listitems = '';
		foreach($items as $item){
			$listitems .= '<tr id="feedback_'.$item['f_id'].'">
				<td class="title">'.$item['f_sender_name'].'</td>
				<td class="content">'.$item['f_message'].'
					<p>
						<a style="margin-right:5px;padding:5px 10px;" class="btn btn-success" id="edit_contents" href="'.base_url().'admin/feedback/view/'.$item['f_id'].'">
							<img src="'.images_url('eye.png').'"/>
						</a>
					</p>
				</td>
			</tr>';
		}
		return $listitems;
	}
	
	
	
	public function prepare_feedback_detail($items){
		$listitems = '';
		if($items != null){
			$listitems = '<div id="feedback_'.$items['f_id'].'">
				<div class="content">'.$items['f_message'].'</div>
				<div class="title">From :'.$items['f_sender_name'].'</div>
				<div class="title">Date :'.$items['f_date'].'</div>
			</div>';

			return $listitems;
		}
	}
	
	
	
	
	
	public function prepare_admins($items){
		$listitems = '';
		foreach($items as $items){
			$listitems .= '<tr>
				<td>'.$items['a_name'].'</td>
				<td>'.$items['a_username'].'</td>
				<td>'.$items['a_email'].'</td>
				<td>'.$items['a_createddate'].'</td>
				<td>';
				if($items['a_username'] != 'admin'){
					if($this->CI->session_array['id'] == 1){
					$listitems .='
						<a class="btn btn-success content_action" title="Delete Admin" href="'.base_url().'admin/admins/delete/'.$items['a_id'].'"><img src="'.images_url('trash.png').'"/></a>
						<a class="btn btn-success content_action" title="Reset Password" href="'.base_url().'admin/admins/passreset/'.$items['a_id'].'"><img src="'.images_url('reload.png').'"/></a>';
					}else{
						$listitems .= "NA";
					}
				}
				$listitems .= '</td>
			</tr>';
		}
		return $listitems;
	
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
	
	
	
	
	
	public function prepare_media_list_admin($data){
		$return_value = '';
		if($data){
			foreach($data as $items){
				$return_value .= '<div id="media_'.$items['m_id'].'" class="left photo-block" style="position:relative;float:left;margin:2px 5px 2px 0;border:1px solid #999;">
					<div class="admin-media-action-links">
						<a class="admin-media-description" href="'.base_url().'admin/media/description/'.$items['m_id'].'"><img src="'.images_url('pencil.png').'"/></a>
						<a class="media-del-btn" rel="media_'.$items['m_id'].'" href="'.base_url().'admin/media/remove/'.$items['m_id'].'"><img src="'.images_url('trash.png').'"/></a>
					</div>
					<img width="148" src="'.base_url().'public/uploads/thumbs/'.$items['m_filename'].'" />
				</div>';
			}
		}else{
			$return_value = "No Photos!";
		}
		return $return_value;
	}
	
	
	
	
	
	public function prepare_media_selecton_list($data){
		$return_value = '';
		if($data){
			foreach($data as $items){
				$return_value .= '<div class="left photo-block" style="position:relative;float:left;margin:2px 5px 2px 0;border:1px solid #999;">
					<div class="admin-media-action-links">
						<a class="media-selector" id="'.$items['m_id'].'" href="'.base_url().'public/uploads/thumbs/'.$items['m_filename'].'">
							<img src="'.images_url('check.png').'"/>
						</a>
					</div>
					<img width="145" src="'.base_url().'public/uploads/thumbs/'.$items['m_filename'].'" />
				</div>';
			}
		}else{
			$return_value = "No Photos!";
		}
		return $return_value;
	}
	
	
	
	
	
	
	public function prepare_attachment_list($data){
		$return_value = '';
		if($data){
			foreach($data as $items){
				$return_value .= '<div id="attachment_'.$items['attachment_id'].'" style="width:auto;position:relative;float:left;margin:0 5px 5px 0;border:1px solid #ececec;padding:5px;border-radius:3px">
					<div class="category-name" style="position:relative;float:left;">
						<a href="'.base_url().'public/uploads/attachments/'.$items['attachment_file'].'">'.$items['attachment_title'].'</a>
					</div>
					<div class="action" style="margin-left:20px;position:relative;float:right;">
						<a class="cat-del-btn" style="padding:4px;" title="Remove Attachment" rel="attachment_'.$items['attachment_id'].'" href="'.base_url().'admin/contents/remove_attachment/'.$items['attachment_id'].'">
							<img src="'.images_url('trash.png').'"/>
						</a>
					</div>
					<div style="clear:both"></div>
				</div>';
			}
		}else{
			$return_value = "No Attachments";
		}
		return $return_value;
	}
	
	public function prepare_categories_list($data){
		$return_value = '';
		if($data){
			foreach($data as $items){
				$return_value .= '<div id="category_'.$items['cat_id'].'" style="width:auto;position:relative;float:left;margin:0 5px 5px 0;border:1px solid #ececec;padding:5px;border-radius:3px">
					<div class="category-name" style="position:relative;float:left;">'.$items['cat_name'].'</div>
					<div class="action" style="margin-left:20px;position:relative;float:right;">
						<a style="padding:4px;" href="'.base_url().'admin/categories/edit/'.$items['cat_id'].'">
							<img src="'.images_url('pencil.png').'"/>
						</a>
						<a class="cat-del-btn" style="padding:4px;" title="Remove category" rel="category_'.$items['cat_id'].'" href="'.base_url().'admin/categories/remove/'.$items['cat_id'].'">
							<img src="'.images_url('trash.png').'"/>
						</a>
					</div>
					<div style="clear:both"></div>
				</div>';
			}
		}else{
			$return_value = "No categories!";
		}
		return $return_value;
	}
}