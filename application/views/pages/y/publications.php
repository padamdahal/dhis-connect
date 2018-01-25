		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-2" style="padding-bottom:10px;">
						<h4 class="section-title">Browse by Type</h4>
						<?php echo $navigation;?>
					</div>
					<div class="col-lg-6">
						<h4 class="section-title"><?php echo $heading;?></h4>
						<?php echo $latest;?>
						<?php echo $content;?>
						<?php echo $attachments;?>
                    </div>
					<div class="col-lg-4" style="padding-bottom:10px;">
						<?php include_once('includes/sidebar-right.php');?>
					</div>
				</div>
			</div>
			
			<div class="bs-docs-section">
				<?php include_once('includes/sidebar-bottom.php');?>
			</div>