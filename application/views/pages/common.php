	<div class="container-fluid fading-slider" style="background:#efefef;overflow:hidden;padding:10px 0;">
		<div class="container">
			<div class="row">
				<h3><img src="<?php echo images_url('layer_icon.png');?>"/> <?php echo $content['c_title'];?></h3>
			</div>
		</div>
	</div>
	
	<div class="container-fluid full-width" style="padding-top:25px;padding-bottom:25px;">
		<div class="container">
			<div class="row">
				<div class="col-md-9" style="overflow:hidden;/*border-top:1px solid #81e4ed;*/">
					<div class="col-inner" style="padding:0 10px;">
						<p style="padding-top:5px;"><?php echo $content['c_content'];?></p>
					</div>
				</div>
				<div class="col-md-3" style="overflow:hidden;">
					<div class="col-sm-12">
						<div class="col-inner" style="background:#e8fcfe;border-bottom:1px solid #81e4ed;padding:5px 10px;">
							<h4>Related</h4>
							<?php
								$tpl = '<a href="{href}">{title}</a><br/>';
								html($children,$tpl);
							?>
						</div>
					</div>
					<!--div class="col-sm-12" style="">
						<div class="col-inner" style="background:#e8fcfe;border-bottom:1px solid #81e4ed;padding:5px 0 0 10px;">
							<h4>SERVICES</h4>
							<h4>
								<a href="#"><img src="" width="20"/></a>
							</h4>
							<h4>
								<a href="#"></a>
							</h4>
							<h4>
								<a href="#"></a>
							</h4>
						</div>
					</div-->
				</div>
			</div>
		</div>
	</div>