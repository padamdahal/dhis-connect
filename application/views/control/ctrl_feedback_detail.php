		<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
                    </div>
                </div><!-- /.row -->
				<div class="row">
					<div class="col-lg-8">
						<?php echo $this->content;?>
					</div>
					<div class="col-lg-4">
						<div class="form-group" style="border:1px solid #ececec;padding:10px;">
							<div class="form-group">
								<a class="btn btn-default" id="markread" title="Mark as read." style="background:lightgreen;padding:5px 10px;" href="<?php echo ($this->f_id)? base_url().'control/feedback/markread/'.$this->f_id:null;?>">Mark as Read</a>
								<a class="btn btn-default remove" rel="feedback_<?php echo $this->f_id;?>" style="background:#F67373;padding:5px 10px;" href="<?php echo ($this->f_id)?base_url().'control/feedback/delete/'.$this->f_id:null;?>">Delete</a>
							</div>
						</div>
						<div class="form-group" style="border:1px solid #ececec;padding:10px;">
							<div class="form-group">
								<input style="height:30px;margin-top:3px;width:320px;" type="text" name="email" id="email"/>
								<a class="btn btn-default" id="forward" style="background:lightgreen;padding:5px 10px;margin-top:10px;" href="<?php echo ($this->f_id)?base_url().'control/feedback/forward/'.$this->f_id:null;?>">Forward</a>
							</div>
						</div>
						<div style="clear:both"></div>	
					</div>
				</div><!-- /.row -->
				
				<div class="row">
                    <div class="col-lg-12" id="dialog-form" title="Media" style="display:none;">
                        <p id="media_list">Loading...</p>
                    </div>
                </div><!-- /.row -->
				
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->