		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $this->title;?></h1>
						<a href="<?php echo base_url().'control/widgets/addform';?>">
							<img src="<?php echo ctrl_images_url('plus.png');?>"/> Add Widget
						</a>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-lg-12" id="widget_list" style="margin-top:15px;">
						<?php echo $this->widgets;?>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->