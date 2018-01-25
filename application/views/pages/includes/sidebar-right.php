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
											<a href="<?php echo create_link('emergency/'.$item['c_seo_name']);?>">
												<?php echo $item['c_title'];?>
											</a>
										</p>
									</div>
									<?php }?>
								</div>
							</div>              
						</div>
						
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">News and Events</h3>
								</div>
								<div class="panel-body">
									<?php $list = category('news',5);;?>
									<?php foreach($list as $item){;?>
									<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
										<p class="message-main" style="font-weight:bold">
											<a href="<?php echo create_link('news/'.$item['c_seo_name']);?>">
												<?php echo $item['c_title'];?>
											</a>
											<small><?php echo 'Published:'.$item['c_createdate'];?></small>
										</p>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
						
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