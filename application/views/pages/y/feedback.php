		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-8">
						<h4>Feedback to EDCD</h4>
						<p>Please provide your valuable feedback to improve our service delivery.</p>
						<form class="form-horizontal" action="<?php echo base_url().'processform/feedback';?>" method="post" id="feedback-form">
						  <fieldset>
							<div class="form-group">
							  <label for="inputEmail" class="col-lg-2 control-label">Your Name</label>
							  <div class="col-lg-10">
								<input name = "name" class="form-control" id="inputEmail" placeholder="Your Name" type="text">
							  </div>
							</div>
							<div class="form-group">
							  <label for="inputEmail" class="col-lg-2 control-label">Your Email</label>
							  <div class="col-lg-10">
								<input name = "email" class="form-control" id="inputEmail" placeholder="Your Email" type="text">
							  </div>
							</div>
							
							<div class="form-group">
							  <label for="textArea" class="col-lg-2 control-label">Message</label>
							  <div class="col-lg-10">
								<textarea name = "message" class="form-control" rows="10" id="textArea"></textarea>
							  </div>
							</div>
							
							<div class="form-group">
							  <label for="textArea" class="col-lg-2 control-label">&nbsp;</label>
							  <div class="col-lg-10">
								<img src="<?php echo $captcha;?>"/><br />
								<input name = "captchacode" class="form-control" id="inputEmail" name="captchacode" type="text">
								<span class="help-block">Enter the text shwon in the image.</span>
							  </div>
							</div>
							
							<div class="form-group">
							  <div class="col-lg-10 col-lg-offset-2">
								<button type="submit" id="submit-button" class="btn btn-primary">Submit</button>
								<button type="reset" class="btn btn-default">Cancel</button>
							  </div>
							</div>
						  </fieldset>
						</form>
                    </div>
					<div class="col-lg-4" style="padding-bottom:10px;">
						<?php include_once('includes/sidebar-right.php');?>
					</div>
				</div>
			</div>
			
			<div class="bs-docs-section">
				<?php include_once('includes/sidebar-bottom.php');?>
			</div>