		<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $title;?></h1>
                    </div>
                </div><!-- /.row -->
				<form role="form" id="<?php echo $formid;?>" method="post" action="<?php echo $submit_url;?>">
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label>Content Title</label>
								<input type="hidden" class="form-control" name="m_id" id="m_id" value="<?php echo $m_id;?>">
								<input type="hidden" class="form-control" name="c_id" value="<?php echo $c_id;?>">
								<input type="text" class="form-control" name="c_title" value="<?php echo $c_title;?>" required>
							</div>
							<div class="form-group">
								<label>Content</label>
								<textarea class="form-control" name="c_content" id="c_content"><?php echo $c_content;?></textarea>
							</div>
							
							<div class="form-group">
								<label>Attachments</label>
								<div>
									<?php echo $attachments;?>
								</div>
								<div class="file-container" style="padding:5px 0 0 0;position:relative;width:100%;border:1px solid #d7d7d7;background:#ececec;clear:both;">
									<span id="status" style="position:relative;float:left;padding:5px;font-weight:bold;">Select files</span>
									<input style="position:relative;float:left;display:block;height:30px;overflow:hidden;color:#ececec;" type="file" name="fileUpload2[]" id="fileUpload2" class="fileUpload" 
									rel="<?php echo $this->upload_link;?>" multiple="multiple" />
									<div style="clear:both"></div>
									<div style="height:5px;width:0;background:lightgreen;margin-top:5px;" id="uploadprogress"></div>
									<div style="clear:both"></div>
								</div>
								<div id="display"></div><div id="previews"></div>
								<script src="<?php echo ctrl_scripts_url('jquery.liteuploader.min.js');?>"></script>
								<script type="text/javascript">
									$(document).ready(function(){
										$('.fileUpload').liteUploader({
											script: $("#fileUpload2").attr("rel"),rules:{allowedFileTypes:null}
										}).on('lu:errors',function (e,errors){
											$.each(errors, function (i, error){
												if (error.errors.length > 0){
													$('#display').html('Error occured');
												}
											});
										}).on('lu:before', function (e, files) {
											$('#display').html('');
										}).on('lu:progress', function (e, percentage){
											$('#uploadprogress').css('width', percentage+'%');
										}).on('lu:success', function (e, response){
											var response = $.parseJSON(response);
											$('#uploadprogress').css('width', '0');
											$('#status').html('+ Select files');
											$('#media_list').load('<?php echo base_url().'control/media/list';?>');
										});
									});
								</script>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group" style="border:1px solid #ececec;padding:10px;">
								<div class="form-group">
									<button style="padding:10px 25px;background:lightgreen" type="submit" class="btn btn-default" onclick="nicEditors.findEditor('c_content').saveContent();">Save</button>
									<a class="btn btn-default" style="background:#F67373;padding:10px 25px;" href="<?php echo ($c_id)?base_url().'control/contents/clean/'.$c_id:null;?>">Delete</a>
								</div>
							</div>
							<div class="form-group" style="border:1px solid #ececec;padding-left:15px;padding-right:15px;">
								<div class="form-group">
									<label>Content Category  <!--a href="<?php echo base_url().'control/categories/list';?>" style="margin-left:10px;">
										<img src="<?php echo ctrl_images_url('plus.png');?>"/> Add Category</a-->
									</label>
									<div class="form-group">
										<?php echo $this->categories;?>
									</div>
								</div>
								<div class="form-group">
									<label>Parent/Child of</label>
									<div class="form-group">
										<?php echo $this->parents;?>
									</div>
								</div>
								<!--div class="form-group">
									<label>Select Template</label>
									<div class="form-group">
										<?php //echo $this->templates;?>
									</div>
								</div-->
							</div>
							<div class="form-group" style="border:1px solid #ececec;padding-left:15px;">
								<div class="checkbox">
									<label><input type="checkbox" name="c_isactive" <?php echo $isactive;?>>Published</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="c_showasmenu" <?php echo $showasmenu;?>>Display as menu</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="c_ishome" <?php echo $ishome;?>>Display in Home Page</label>
								</div>
								<div class="checkbox">
									<label><input type="checkbox" name="c_showinoverviewmode" <?php echo $showinoverviewmode;?>>Overview Mode</label><br/>
									<label><input class="form-control" name="c_content_length"  placeholder="Length of the content" value="<?php echo $c_content_length;?>"></label><br />
									<label><input type="checkbox" name="c_showfeaturedimage" <?php echo $showfeaturedimage;?>>Show featured image</label>
								</div>
							</div>
							<div class="form-group" style="border:1px solid #ececec">
								<div class="image" style="margin:5px;">
									<label>Featured Image <a href="#" id="select_featured_image">Select/Change</a>&nbsp;<a href="#" id="remove_featured_image">Remove</a></label><br/>
									<img id="featuredimg" width="100" src="<?php echo base_url().'public/uploads/thumbs/'.$featured_image;?>" />
								</div>
							</div>
							
						</div>
						<div class="form-group" style="width:50%;float:left;">
							
						</div>
						<div style="clear:both"></div>		
					</div><!-- /.row -->
				</form>
				<div class="row">
					<script type="text/javascript">
						$(function(){
							$("#media_list").load('<?php echo base_url().'control/contents/mediaselectionlist';?>');
							$(document).on('click', '.media-selector', function(e) {
								e.preventDefault();
								var value = $(this).attr("id");
								var newurl = $(this).attr("href");
								// the hidden control to set the value
								$('#m_id').val(value);
								$('#featuredimg').attr("src",newurl);
								var dialog = $( "#dialog-form" ).dialog({autoOpen: false,height: 500,width: 670,modal: true,});
								dialog.dialog('close');
							});
							$(document).on('click', '#remove_featured_image', function(e) {
								e.preventDefault();
								// the hidden control to set the value
								$('#m_id').val(null);
								$('#featuredimg').attr("src",null);
							});
						});
				</script>
                    <div class="col-lg-12" id="dialog-form" title="Media" style="display:none;">
                        <p id="media_list">Loading...</p>
                    </div>
                </div><!-- /.row -->
				
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->