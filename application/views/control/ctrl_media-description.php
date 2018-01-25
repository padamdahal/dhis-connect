		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
                    </div>
                </div><!-- /.row -->
                <div class="row">
					<div class="col-lg-6">
						<img width="400" src="<?php echo base_url().'public/uploads/images/'.$this->media_detail['m_filename'];?>"/>
					</div>
                    <div class="col-lg-6" id="media_list">
						<form role="form" id="media-description-form" method="post" action="<?php echo $this->submit_url;?>">
                            <div class="form-group">
                                <label>Title</label>
								<input type="hidden" class="form-control" name="m_id" id="m_id" value="<?php echo $this->media_detail['m_id'];?>">
                                <input type="text" class="form-control" name="m_title" value="<?php echo $this->media_detail['m_title'];?>">
                            </div>
							<div class="form-group">
								<label>Description</label>
								<input class="form-control" name="m_description" value="<?php echo $this->media_detail['m_description'];?>">
                            </div>
							<div class="form-group">
								<label>Include in Banner</label>
								<div class="checkbox">
									<label><input type="checkbox" name="m_isbanner" <?php echo $this->isbanner;?>>Include in Banner</label><br />
									<label><input type="checkbox" name="m_exclude" <?php echo $this->exclude;?>>Exclude from Gallery</label><br />
								</div>
                            </div>
							<div style="clear:both"></div>
							<div class="form-group">
								<button type="submit" class="btn btn-default">Update</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->