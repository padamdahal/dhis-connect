		<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
                    </div>
                </div><!-- /.row -->
                <div class="row">
					<form role="form" id="<?php echo $this->formid;?>" method="post" action="<?php echo $this->url;?>">
						<div class="col-lg-6">
                            <div class="form-groups required" style="margin-bottom:10px;">
                                <label>Content Title</label>
								<input type="hidden" class="form-control" name="m_id" id="m_id" value="<?php echo $this->widget_detail['m_id'];?>">
								<input type="hidden" class="form-control" name="w_id" value="<?php echo $this->widget_detail['w_id'];?>">
                                <input type="text" class="form-control" name="w_title" value="<?php echo $this->widget_detail['w_title'];?>" required>
                            </div>
							
							<div class="form-groups required"  style="margin-bottom:10px;">
                                <label>Widget Type</label>
                                <div>
									<?php echo $this->types;?>
								</div>
                            </div>
							
							<!--div class="form-groups required"  style="margin-bottom:10px;">
                                <label>Select Template</label>
                                <div>
									<?php //echo $this->templates;?>
								</div>
                            </div-->
							
							<div class="form-groups required" style="margin-bottom:10px;">
                                <div class="checkbox">
									<label><input type="checkbox" name="w_isactive" <?php echo $this->isactive;?>>Active</label><br />
								</div>
                            </div>                        
						</div>
						<div class="col-lg-6">
							<div class="form-groups required" style="border:1px solid #ececec; margin-bottom:10px;">
                                <div class="image" style="margin:5px;">
									<label>Media <a href="#" id="select_featured_image">Select/Change</a>&nbsp;<a href="#" id="remove_featured_image">Remove</a></label><br/>
									<img id="featuredimg" width="100" src="<?php echo base_url().'public/uploads/thumbs/'.$this->widget_detail['m_filename'];?>" />
								</div>
                            </div>
							<div class="form-group category" style="display:none">
                                <label>Select categories</label>
                                <div>
									<?php echo $this->categories;?>
								</div>
                            </div>
							<div class="form-group content"  style="margin-bottom:10px;">
                                <label>Select Content</label>
                                <div>
									<?php echo $this->content;?>
								</div>
                            </div>
							<div class="form-group text" style="display:none">
                                <label>Text</label>
                                <textarea class="form-control" name="c_content" id="c_content"><?php echo $this->widget_detail['w_text'];?></textarea>
                            </div>
							
						</div>
						<div class="col-lg-12">
                            <div class="form-groups required" style="margin-bottom:10px;">
                                <label>Content count</label>
                                <input type="text" class="form-control" style="width:100px;" name="w_child_count" value="<?php echo $this->widget_detail['w_child_count'];?>" required>
                            </div>
							
							<div class="form-groups required" style="margin-bottom:10px;">
                                <div class="checkbox">
									<label><input type="checkbox" name="w_display_image" <?php echo $this->displayimage;?>>Display Featured Image</label><br />
								</div>
                            </div>
							
							<div class="form-groups required" style="margin-bottom:10px;">
                                <div class="checkbox">
									<label><input type="checkbox" name="w_display_title" <?php echo $this->displaytitle;?>>Display Title</label><br />
								</div>
                            </div>
							
							<div class="form-groups required" style="margin-bottom:10px;">
                                <div class="checkbox">
									<label><input type="checkbox" name="w_display_content" <?php echo $this->displaycontent;?>>Display Content</label><br />
								</div>
                            </div>
							
							<div class="form-groups required" style="margin-bottom:10px;">
                                <div class="checkbox">
									<label><input type="checkbox" name="w_display_child_title" <?php echo $this->displaychildtitle;?>>Display Child Title</label><br />
								</div>
                            </div>
							
							<div class="form-groups required" style="margin-bottom:10px;">
                                <div class="checkbox">
									<label><input type="checkbox" name="w_display_child_content" <?php echo $this->displaychildcontent;?>>Display Child Content</label><br />
								</div>
                            </div>
						</div>
						<div style="clear:both"></div>
						<div class="form-groups required">
							<button type="submit" class="btn btn-success" style="padding:10px 20px;color:#000" onclick="nicEditors.findEditor('c_content').saveContent();">Submit</button>
						</div>
					</form>
                </div><!-- /.row -->
				
				<div class="row" id="dialog-form" title="Media" style="display:none;">
                    <div class="col-lg-12">
                        <p id="media_list">Loading...</p>
                    </div>
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
							var type = $('.type option:selected').html();
							$('.'+type).fadeIn('slow');
							
							$(document).on('change', '.type', function(e) {
								e.preventDefault();
								$('.form-group').css('display','none');//fadeOut('slow');
								var type = $('.type option:selected').html();
								$('.'+type).fadeIn('slow');
							});
						});
					</script>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->