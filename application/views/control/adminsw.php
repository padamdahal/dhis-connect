<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" id="addeditform" method="post" action="<?php echo $this->url;?>">
                            <div class="form-group">
                                <label>Content Title</label>
								<input type="hidden" class="form-control" name="c_id" value="<?php echo $this->content_detail['c_id'];?>">
                                <input class="form-control" name="c_title" value="<?php echo $this->content_detail['c_title'];?>">
                            </div>
							<div class="form-group">
                                <label>Content Group</label>
                                <div class="form-group">
									<?php echo $this->groups;?>
								</div>
                            </div>
							<div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" name="c_content"><?php echo $this->content_detail['c_content'];?></textarea>
                            </div>
							<div class="form-group">
                                <div class="checkbox">
									<label><input type="checkbox" name="c_showasmenu" <?php echo $this->showasmenu;?>>Show as menu</label>
								</div>
                            </div>
							<div class="form-group">
                                <label>Menu Title</label>
                                <input class="form-control" name="c_menutitle"  value="<?php echo $this->content_detail['c_menutitle'];?>">
                            </div>			
							<div class="form-group">
                                <label>Parent/Child of</label>
                                <div class="form-group">
									<?php echo $this->parents;?>
								</div>
                            </div>
							<div class="form-group">
                                <div class="checkbox">
									<label><input type="checkbox" name="c_isactive" <?php echo $this->isactive;?>>Active</label>
								</div>
                            </div>
							<div class="form-group">
                                <div class="checkbox">
									<label><input type="checkbox" name="c_showinoverviewmode" <?php echo $this->showinoverviewmode;?>>Show in overview mode</label>
									<label><input type="checkbox" name="c_showimageinoverview" <?php echo $this->showimageinoverview;?>>Show image in overview mode</label>
								</div>
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->