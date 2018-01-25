	<div class="container-fluid" style="background:#222;overflow:hidden;padding:0;border-bottom:2px solid #222">
		<ul class="rslides" id="banner">
			<li><img class="img-responsive" src="<?php echo images_url('banner_image_1.jpg');?>" alt=""></li>
			<li><img class="img-responsive" src="<?php echo images_url('banner_image_2.jpg');?>" alt=""></li>
			<li><img class="img-responsive" src="<?php echo images_url('banner_image_3.jpg');?>" alt=""></li>
		</ul>
		
		<!--ul>
			<li><img class="img-responsive" src="<?php echo images_url('banner_image_1.jpg');?>" width="100%"></li>
			<li><img class="img-responsive" src="<?php echo images_url('banner_image_2.jpg');?>" width="100%"></li>
			<li><img class="img-responsive" src="<?php echo images_url('banner_image_3.jpg');?>" width="100%"></li>
		</ul-->
	</div>
	
	<div class="container-fluid" style="background:#efefef;height:100px;">
		<div class="container">
			<div class="row" >
				<div class="col-lg-12" style="text-align:center;padding-top:15px;">				
					<h3>Development through Information Technology!</h3>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid full-width" style="padding-top:25px;padding-bottom:25px;">
		<div class="container">
			<div class="row" >
				<div class="col-md-4" style="overflow:hidden;/*background:#e8fcfe;border:1px solid #81e4ed;*/border-top:1px solid #81e4ed;;border-left:none;height:280px;">
					<div class="col-inner" style="padding:0 10px;">
						<?php $content = content('content-management-system');?>
						<h3><img src="<?php echo images_url('pen_icon.png');?>"/> <?php echo $content['c_title'];?></h3>
						<p style="font-size:16px;text-align:justify"><?php echo substr($content['c_content'],0,300);?></p>
						<p style="font-size:16px;">
							<a href="<?php echo $content['c_seo_name'];?>">More &raquo;</a>
						</p>
					</div>
				</div>
				<div class="col-md-4" style="overflow:hidden;border-top:1px solid #81e4ed;height:280px;">
					<div class="col-inner" style="padding:0 10px;">
						<?php $content = content('health-information-system');?>
						<h3><img src="<?php echo images_url('layer_icon.png');?>"/> <?php echo $content['c_title'];?></h3>
						<p style="font-size:16px;text-align:justify"><?php echo substr($content['c_content'],0,300);?></p>
						<p style="font-size:16px;">
							<a href="<?php echo $content['c_seo_name'];?>">More &raquo;</a>
						</p>
					</div>
				</div>
				<div class="col-md-4" style="overflow:hidden;background:#e8fcfe;border: 1px solid #81e4ed;border-top:none;border-right:none;height:280px;">
					<div class="col-inner" style="padding:0 10px;">
						<h3><img src="<?php echo images_url('pen_icon.png');?>"/> Leave a Message</h3>
						Email : <br/><input style="width:100%" type="text"/><br/>
						Message: <br/><textarea style="width:100%"></textarea><br/>
						<div class="btn btn-primary" style="width:100%">Submit</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid full-width" style="background:#222;">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12" style="margin-bottom:5px;padding-right:10px;color:#fff;">
					<div class="col-lg-12">
						<h4>ABOUT US <small>know us better</small></h4>
					</div>
					<div class="col-lg-12">
						<?php $content = content('evainformatics-intro');?>
						<p><?php echo $content['c_content'];?></p>
						<p style="font-size:16px;">
							<a href="<?php echo $content['c_seo_name'];?>">Read More &raquo;</a>
						</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12" style="margin-bottom:5px;padding-right:10px;color:#fff;">
					<div class="col-lg-12">
						<h4>CONTACT US <small>get in touch</small></h4>
					</div>
					<div class="col-lg-12">
						<?php $content = content('contact-info');?>
						<p><?php echo $content['c_content'];?></p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12" style="margin-bottom:5px;padding-right:10px;color:#fff;">
					<div class="col-lg-12">
						<h4>FIND US <small>connect with us</small></h4>
					</div>
					<div class="col-lg-12">
						<a href="#"><img src="<?php echo images_url('facebook.png');?>"/></a>
						<a href="#"><img src="<?php echo images_url('skype_icon.png');?>"/></a>
						<a href="#"><img src="<?php echo images_url('linkedin_icon.png');?>"/></a>
						<a href="#"><img src="<?php echo images_url('sharethis_icon.png');?>"/></a>
						<a href="#"><img src="<?php echo images_url('pinterest_icon.png');?>"/></a>
						<a href="#"><img src="<?php echo images_url('dribbble_icon.png');?>"/></a>
					</div>
				</div>
			</div>
		</div>
	</div>