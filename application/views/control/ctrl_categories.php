		<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" id="<?php echo $this->formid;?>" method="post" action="<?php echo $this->url;?>">
                            <div class="form-group">
                                <label>Category Name</label>
								<input type="hidden" class="form-control" name="cat_id" value="<?php echo $this->category_detail['cat_id'];?>">
                                <input type="text" class="form-control" name="cat_name" value="<?php echo $this->category_detail['cat_name'];?>" required>
                            </div>
							<div style="clear:both"></div>
							<div class="form-group">
								<button type="submit" class="btn btn-default" style="padding:10px 20px;">Submit</button>
                            </div>
                        </form>
						 <form role="form" id="<?php echo $this->formid;?>" method="post" action="<?php echo $this->gropuurl;?>">
							 <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" class="form-control" name="cat_name" value="<?php echo $this->category_detail['cat_groupname'];?>" required>
                            </div>
							<div style="clear:both"></div>
							<div class="form-group">
								<button type="submit" class="btn btn-default" style="padding:10px 20px;">Submit</button>
                            </div>
                        </form>
                    </div>
					<div class="col-lg-6" id="categories">
						<div class="col-lg-12">
							<h5>Categories</h5>
							<?php echo $this->category_list;?>
						</div>
						
						<div class="col-lg-12">
							<h5>Category Groups</h5>
							<?php echo $this->category_group;?>
						</div>
                    </div>
                </div><!-- /.row -->				
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->