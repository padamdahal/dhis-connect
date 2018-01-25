				<div class="row">
					<div class="col-lg-4">
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">EDCD in Social Media</h3>
								</div>
								<div class="panel-body">
									<div class="fb-page" data-href="https://www.facebook.com/edcdnepal" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
										<div class="fb-xfbml-parse-ignore">
											<blockquote cite="https://www.facebook.com/edcdnepal">
												<a href="https://www.facebook.com/edcdnepal">Epidemiology and Disease Control Division</a>
											</blockquote>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Information Systems</h3>
								</div>
								<div class="panel-body">
									<?php $list = category('is link',5);;?>
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
					<div class="col-lg-4">
						<div class="bs-component">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">Important Links</h3>
								</div>
								<div class="panel-body">
									<?php $list = category('links',5);;?>
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