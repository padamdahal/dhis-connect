		<?php if(!defined('BASEPATH')) exit('Resource doesn\'t exists.');?>
		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-8 col-md-7 col-sm-6" style="padding-bottom:10px;">
						
						<?php $content = content('welcome-to-edcd');?>
						<h4 id="<?php echo $content['c_seo_name'];?>"><?php echo $content['c_title'];?></h4>
						<p>
							<img style="position:relative;float:left;margin:0 10px 5px 0" src="<?php echo photos_url($content['m_filename']);?>"/>
							<?php echo $content['c_content'];?>
						</p>
						
						<ul class="nav nav-tabs">
							<li class="active"><a href="#vision" data-toggle="tab">Vision</a></li>
							<li><a href="#mission" data-toggle="tab">Mission</a></li>
							<li><a href="#objectives" data-toggle="tab">Objectives</a></li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade active in" id="vision">
								<p>
									<?php
										$content = content('vision');
										echo $content['c_content'];
									?>
									
								</p>
							</div>
							<div class="tab-pane fade" id="mission">
								<p>
									<?php
										$content = content('mission');
										echo $content['c_content'];
									?>
								</p>
							</div>
							<div class="tab-pane fade" id="objectives">
								<p>
									<?php
										$content = content('objectives-of-edcd');
										echo $content['c_content'];
									?>
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-5 col-sm-6">
						<?php
							$content = content('message-from-director');
						?>
						<h4 id="{id}"><?php echo $content['c_title'];?></h4>
						<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
							<img src="<?php echo photos_url($content['m_filename']);?>" width="100" height="100" style="position:relative;float:left;margin:0 10px 10px 0;"/>
							<p class="message-main" style="font-weight:bold"><?php echo substr($content['c_content'],0,1300);?></p>
						</div>
						<div>
							<p>
								<a href="<?php echo create_link('message-from-director');?>">More &raquo;</a>
							</p>
						</div>	
                    </div>
				</div>
			</div>
			
			<div class="bs-docs-section">
				<div class="row">
					<div class="col-lg-4">
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Resources</h3>
								</div>
								<div class="panel-body">
									<?php $list = category('manual',5);?>
									<?php foreach($list as $item){;?>
									<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
										<img src="<?php echo photos_url($item['m_filename']);?>" width="70" height="80" style="position:relative;float:left;margin:0 10px 10px 0;"/>
										<p class="message-main" style="font-weight:bold">
											<a href="<?php echo create_link('resources/'.$item['c_seo_name']);?>">
												<?php echo $item['c_title'];?>
											</a>
										</p>
										<p>
											<small><?php echo substr($item['c_content'],0,100);?></small>
										</p>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">News & Events</h3>
								</div>
								<div class="panel-body">
									<?php $list = category('news',5);;?>
									<?php foreach($list as $item){;?>
									<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
										<p class="message-main" style="font-weight:bold">
											<a href="<?php echo create_link($item['c_seo_name']);?>">
												<?php echo $item['c_title'];?>
											</a>
											<small><?php echo 'Published:'.$item['c_createdate'];?></small>
										</p>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Outbreaks &amp; Emergencies</h3>
								</div>
								<div class="panel-body">
									<?php $list = category('emergency',5);;?>
									<?php foreach($list as $item){;?>
									<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
										<p class="message-main" style="font-weight:bold">
											<a href="<?php echo create_link($item['c_seo_name']);?>">
												<?php echo $item['c_title'];?>
											</a>
										</p>
									</div>
									<?php }?>
								</div>
							</div>              
						</div>
					</div>
				</div>
			</div> 
			<div class="bs-docs-section">
				<div class="row">
				  <div class="col-lg-6">
					<div class="bs-component">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Statistics</h3>
							</div>
							<div class="panel-body">
								<a href="http://edcd.local/map/all">Statistics Map</a> | <a href="http://edcd.local/map/specific">Disease Specific Map</a>
							</div>
						</div>
					</div>
				  </div>
				  <div class="col-lg-6">
					<div class="bs-component">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title">Latest EWARS Bullitens</h3>
							</div>
							<div class="panel-body">
								<?php $list = category('bulletins',2);?>
									<?php foreach($list as $item){;?>
									<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
										<img src="<?php echo photos_url($item['m_filename']);?>" width="70" height="80" style="position:relative;float:left;margin:0 10px 10px 0;"/>
										<p class="message-main" style="font-weight:bold">
											<a href="<?php echo create_link($item['c_seo_name']);?>">
												<?php echo $item['c_title'];?>
											</a>
										</p>
										<p>
											<small><?php echo substr($item['c_content'],0,100);?></small>
										</p>
									</div>
									<?php }?>
							</div>
						</div>
					</div>
				  </div>
				</div>
			</div>
			<div class="bs-docs-section">
				<?php include_once('includes/sidebar-bottom.php');?>
			</div>