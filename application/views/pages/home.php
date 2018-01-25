	<div class="container-fluid" style="background:#222;overflow:hidden;padding:0;">
		<!--div class="container">
			<div class="row" >
				<div class="col-lg-12" style="text-align:center;padding-top:15px;"-->
					<ul class="rslides" id="banner">
						<li><img class="img-responsive" src="<?php echo images_url('banner_image_1.jpg');?>" alt=""></li>
						<li><img class="img-responsive" src="<?php echo images_url('banner_image_2.jpg');?>" alt=""></li>
						<li><img class="img-responsive" src="<?php echo images_url('banner_image_3.jpg');?>" alt=""></li>
					</ul>
				<!--/div>
			</div>
		</div-->
	</div>
	
	<div class="container-fluid" style="background:#81e4ed;height:100px;">
		<div class="container">
			<div class="row" >
				<div class="col-lg-12" style="text-align:center;padding-top:15px;">	
					<h3 style="font-family: 'opensans-cond', sans-serif;font-weight: 300;line-height: 1.1em;font-size:40px;">
					Your <strong>satisfaction</strong> is our <span style="color:maroon;font-weight:bold">highest priority :)</span></h3>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid full-width" style="padding-top:25px;padding-bottom:25px;">
		<div class="container">
			<div class="row" >
				<div class="col-md-8" style="overflow:hidden;/*background:#e8fcfe;border:1px solid #81e4ed;border-top:1px solid #81e4ed;border-left:none;*/">
					<div class="col-md-12" style="padding:0 10px;">
						<h2><img src="<?php echo images_url('expertise-icon.png');?>"/> Expertise</h2>
						<div class="col-md-4" style="overflow:hidden;">
							<div class="col-inner" style="margin:0 10px 0 0;">
								<?php $content = content('web-services');?>
								<a href="<?php echo base_url().'expertise/'.$content['c_seo_name'];?>">
									<img class="img-responsive" style="width:100%" src="<?php echo images_url('expertise-web-services.jpg');?>"/>
									<p style="background:#efefef;padding:5px;text-align:justify">
										<?php echo $content['c_title'];?>
									</p>
								</a>
							</div>
						</div>
						<div class="col-md-4" style="overflow:hidden;">
							<div class="col-inner" style="margin:0 10px 0 0;">
								<?php $content = content('health-information-system');?>
								<a href="<?php echo base_url().'expertise/'.$content['c_seo_name'];?>">
									<img class="img-responsive" style="width:100%" src="<?php echo images_url('expertise-his.jpg');?>"/>
									<p style="background:#efefef;padding:5px;text-align:justify">
										<?php echo $content['c_title'];?>
									</p>
								</a>
							</div>
						</div>
						<div class="col-md-4" style="overflow:hidden;">
							<div class="col-inner" style="margin:0 10px 0 0;">
								<?php $content = content('business-it-support');?>
								<a href="<?php echo base_url().'expertise/'.$content['c_seo_name'];?>">
									<img class="img-responsive" style="width:100%" src="<?php echo images_url('expertise-business-it-support.jpg');?>"/>
									<p style="background:#efefef;padding:5px;text-align:justify">
										<?php echo $content['c_title'];?>
									</p>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4" style="overflow:hidden;border-left: 1px solid #81e4ed;min-height:280px;">
					<div class="col-lg-12" style="padding:0 10px;">
						<?php $content = content('about-us');?>
						<h2>
							<img src="<?php echo images_url('about-icon.png');?>"/> About Us <small>know us better</small>
						</h2>
						<p style="font-size:25px;font-family:'opensans-cond';text-align:justify;">
							<?php echo $content['c_content'];?>
						</p>
						<p style="">
							<a href="<?php echo $content['c_seo_name'];?>">Read More &raquo;</a>
						</p>
					</div>
				</div>
			</div>
			
			<div class="row" style="border:1px solid #81e4ed;background:#fff;margin-top:20px;">
				<div class="col-md-12" style="padding:10px;text-align:center">
					<!--h3>Platforms</h3-->
					<a href="#"><img style="border:2px solid #efefef;margin-bottom:5px;" src="<?php echo images_url('dhis2.png');?>" height="50"/></a>
					<a href="#"><img style="border:2px solid #efefef;margin-bottom:5px;" src="<?php echo images_url('openmrs.png');?>" height="50"/></a>
					<a href="#"><img style="border:2px solid #efefef;margin-bottom:5px;" src="<?php echo images_url('openhie.png');?>" height="50"/></a><br/>
					<a href="#"><img style="border:2px solid #efefef;margin-bottom:5px;" src="<?php echo images_url('codeigniter.png');?>" height="50"/></a>	
					<a href="#"><img style="border:2px solid #efefef;margin-bottom:5px;" src="<?php echo images_url('mysql.png');?>" height="50"/></a>
					<a href="#"><img style="border:2px solid #efefef;margin-bottom:5px;" src="<?php echo images_url('php.png');?>" height="50"/></a>	
				</div>
			</div>
			<!--div class="row" style="border:1px solid #81e4ed;background:#fff;margin-top:20px;">
				<div class="col-md-12" style="padding:0 10px;text-align:center">
					<h3>Partners</h3>
					<a href="#"><img src="<?php echo images_url('giz.png');?>"/></a>
					<a href="#"><img src="<?php echo images_url('gon.png');?>"/></a>	
				</div>
				
				<div class="col-md-12" style="padding:0 10px;text-align:center">
					<small>Logos and TradeMark are properties of their respective ogranizations.</small>
				</div>
			</div -->
			
		</div>
	</div>