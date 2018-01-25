	<div class="container-fluid full-width" style="background:#222;">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-12" style="margin-bottom:5px;padding-right:10px;color:#fff;">
					<div class="col-lg-12">
						<h4>LEAVE A MESSAGE <small></small></h4>
					</div>
					<div class="col-lg-12">
						Email : <br/><input style="width:100%" type="text"/><br/>
						Message: <br/><textarea style="width:100%"></textarea><br/>
						<div class="btn btn-primary" style="float:right">Submit</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-12" style="margin-bottom:5px;padding-left:10px;color:#fff;">
					<div class="col-lg-12">
						<h4>EXPLORE <small></small></h4>
					</div>
					<div class="col-lg-12">
						<ul style="font-size:16px;font-weight:bold;list-style:none;padding-left:0">
							<?php $menuitems = nav_menu();?>
							<li><a href="<?php echo create_link('');?>" class="userlinks"><span class="glyphicon glyphicon-home"></span></a></li>
							<?php foreach($menuitems as $item){
								if(has_children($item['c_id'])){?>
								<li>
								<a href="#" class="dropdown-toggle userlinks" aria-expanded="false" data-toggle="dropdown" id="<?php echo $item['c_id'];?>">
									<?php echo $item['c_title'];?><span class="caret"></span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="<?php echo $item['c_id'];?>" style="background:#000;color:#fff;font-size:16px; font-weight:bold;border-radius:0 4px 4px 4px;">
							<?php $children = get_children($item['c_id'])?>
							<?php foreach($children as $child){?>
								<li>
									<a href="<?php echo create_link($item['c_seo_name'].'/'.$child['c_seo_name']);?>"><?php echo $child['c_title'];?></a>
								</li>
							<?php } ?>
							</ul>
							<?php }else{?>
							<li><a href="<?php echo create_link($item['c_seo_name']);?>"  class="userlinks"><?php echo $item['c_title'];?></a></li>
							<?php }}?>
						</ul>
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
	
	<div class="container-fluid full-width" style="background:#000;">
		<div class="container">
            <div class="row">
                <div class="col-lg-8">
					<p style="color:#fff;">
						<a href="#">Terms &amp; Conditions</a> 
						<a href="#">Privacy Policy</a>
					</p>
                </div>
				<div class="col-lg-2">
                    <p style="color:#fff;float:right;font-size:10px;">&copy; Eva Informatics Pvt. Ltd. All Rights Reserved 2016</p>
                </div>
				<div class="col-lg-2">
                    <p style="color:#fff;float:right;font-size:10px;">Design: <a href="http://evainformatics.com/content-management-system">freetemplate.com</a><br/>
					Powered By: <a href="http://evainformatics.com/content-management-system">Eva CMS</a></p>
                </div>
            </div>
		</div>
	</div>
    <script src="<?php echo scripts_url('bootstrap.min.js');?>"></script>
</body>
</html>
