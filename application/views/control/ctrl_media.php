		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
                    </div>
                </div><!-- /.row -->

                <div class="row">
					<div class="col-lg-12">
						<div class="file-container" style="padding:5px 0 0 0;position:relative;width:100%;border:1px solid #d7d7d7;background:#ececec;clear:both;">
							<span id="status" style="position:relative;float:left;padding:5px;font-weight:bold;">Select media files</span>
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
									script: $("#fileUpload2").attr("rel"),rules:{allowedFileTypes:'image/jpeg,image/png,image/gif'}
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
                    <div class="col-lg-12" id="media_list" style="margin-top:15px;">
						<?php echo $this->media_list;?>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->