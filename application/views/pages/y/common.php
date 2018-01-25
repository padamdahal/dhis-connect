		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-2" style="padding-bottom:10px;">
						<h4 class="section-title">Navigation</h4>
						<?php //$children = get_children($param);?>
					</div>
					<div class="col-lg-6">
						<?php $content = content($param);?>
						<h4 id="<?php echo $content['c_seo_name'];?>"><?php echo $content['c_title'];?></h4>
						<p>
							<img style="position:relative;float:left;margin:0 10px 5px 0;width:150px;" src="<?php echo photos_url($content['m_filename']);?>"/>
							<?php echo $content['c_content'];?>
						</p>
						<p>
							<?php $att = get_attachments($param);?>
							<?php foreach($att as $item){;?>
								<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
									<p class="message-main" style="font-weight:bold">
										<a href="<?php echo create_link('public/uploads/attachments/'.$item['attachment_file']);?>">
											<?php echo $item['attachment_title'];?>
										</a>
									</p>
								</div>
							<?php }?>
						</p>
                    </div>
					<div class="col-lg-4" style="padding-bottom:10px;">
						<?php include_once('includes/sidebar-right.php');?>
					</div>
				</div>
			</div>
			
			<div class="bs-docs-section">
				<?php include_once('includes/sidebar-bottom.php');?>
			</div>