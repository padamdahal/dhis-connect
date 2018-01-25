		<?php if(!defined('BASEPATH')) exit('Resource doesn\'t exists.');?>
		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="section-title" style="margin-bottom:15px;padding-bottom:10px;border-bottom:1px dotted #d7d7d7"><?php echo $heading;?></h4>
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