		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-2 col-md-2" style="padding-bottom:10px;">
						<h4 class="section-title">Browse by type</h4>
						<?php echo $navigation;?>
					</div>
					<div class="col-lg-6 col-md-6" style="margin-bottom:10px;">
						<h4 class="section-title" style="margin-bottom:15px;"><?php echo $heading;?></h4>						
						<?php echo $content;?>
						<?php echo $attachments;?>
						<div class="clearfix"></div>
                    </div>
					<div class="col-lg-4 col-md-4" style="padding-bottom:10px;">
						<?php include_once('includes/sidebar-right.php');?>
					</div>
				</div>
			</div>
			
			<div class="bs-docs-section">
				<?php include_once('includes/sidebar-bottom.php');?>
			</div>