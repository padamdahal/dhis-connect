	<div class="container-fluid fading-slider" style="background:#efefef;overflow:hidden;padding:10px 0;">
		<div class="container">
			<div class="row">
				<h3><img src="<?php echo images_url('screen_icon.png');?>"/> Showcase</h3>
			</div>
		</div>
	</div>
	
	<div class="container-fluid full-width" style="padding-top:25px;padding-bottom:25px;">
		<div class="container">
			<div class="row">
				<div class="col-md-9" style="overflow:hidden;/*border-top:1px solid #81e4ed;*/">
					<div class="col-inner" style="padding:0 10px;">
						<?php $content = content('web-services');?>
						<p style="padding-top:5px;"><?php echo $content['c_content'];?></p>
					</div>
				</div>
				<div class="col-md-3" style="overflow:hidden;">
					<div class="col-sm-12">
						<div class="col-inner" style="background:#e8fcfe;border-bottom:1px solid #81e4ed;padding:5px 10px;">
							<?php $children = get_children($content['c_id']);?>
							<?php foreach($children as $child){?>
								<h4>Related</h4>
								<a href="<?php echo create_link('content-management-system/'.$child['c_seo_name']);?>"><?php echo $child['c_title'];?></a>
							<?php }?>
						</div>
					</div>
					<div class="col-sm-12" style="">
						<div class="col-inner" style="background:#e8fcfe;border-bottom:1px solid #81e4ed;padding:5px 0 0 10px;">
							<h4>SERVICES</h4>
							<?php $content = content('content-management-system');?>
							<h4>
								<a href="<?php echo $content['c_seo_name'];?>">
									<img src="<?php echo images_url('pen_icon.png');?>" width="20"/> <?php echo $content['c_title'];?>
								</a>
							</h4>
								
							
							<?php $content = content('health-information-system');?>
							<h4>
								<a href="<?php echo $content['c_seo_name'];?>">
									<img src="<?php echo images_url('layer_icon.png');?>" width="20"/> <?php echo $content['c_title'];?>
								</a>
							</h4>
							
							<?php $content = content('openmrs-customization');?>
							<h4>
								<a href="<?php echo $content['c_seo_name'];?>">
									<img src="<?php echo images_url('screen_icon.png');?>" width="20"/> <?php echo $content['c_title'];?>
								</a>
							</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>