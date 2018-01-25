		<?php if(!defined('BASEPATH')) exit('Resource doesn\'t exists.');?>
		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="section-title">Report a Rumor</h4>
						<p>Please report any rumors regarding the public concern in your locality. This will help us to take an immediate repsponse.</p>
						<p></p>
						<form class="form-horizontal" action="<?php echo base_url().'processform/rumorreport';?>" method="post" id="rumor-form">
						  <fieldset>
							<div class="form-group">
							  <label for="select" class="col-lg-2 control-label">Rumor Type</label>
							  <div class="col-lg-4">
								<select name="rumor_type" class="form-control" id="select">
								  <option selected="selected" value="Disease Outbreak">Disease Outbreak</option>
								  <option value="Natural Disaster">Natural Disaster</option>
								  <option value="Other Emergency">Other Emergency</option>
								</select>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-2 control-label">Authenticity</label>
							  <div class="col-lg-10">
								  <label style="font-weight:normal"><input name="authenticity" id="authenticity1" value="rumor" checked="checked" type="radio"> Rumor</label>
								  &nbsp;&nbsp;&nbsp;<label style="font-weight:normal"><input name="authenticity" id="authenticity2" value="confirmed" type="radio"> Confirmed</label>
							  </div>
							</div>
							<div class="form-group">
							  <label for="inputEmail" class="col-lg-2 control-label">Location</label>
							  <div class="col-lg-2">
								<input name="district" class="form-control" id="district" placeholder="District" type="text">
							  </div>
							  <div class="col-lg-2">
								<input name="vdc" class="form-control" id="vdc" placeholder="VDC Name" type="text">
							  </div>
							  <div class="col-lg-2">
								<input name="ward" class="form-control" id="ward" placeholder="Ward" type="text">
							  </div>
							</div>
							<div class="form-group">
							  <label for="death" class="col-lg-2 control-label">Death</label>
							  <div class="col-lg-2">
								<input name = "death" class="form-control" id="death" placeholder="Death till date" value="0" type="text" min="0" max="1000">
							  </div>
							</div>
							<div class="form-group">
							  <label for="textArea" class="col-lg-2 control-label">Description</label>
							  <div class="col-lg-10">
								<textarea name="description" class="form-control" rows="3" id="textArea"></textarea>
								<span class="help-block">A short description of the rumor.</span>
							  </div>
							</div>
							<br/>
							<div class="form-group">
							  <label for="death" class="col-lg-2 control-label">Your Name</label>
							  <div class="col-lg-8">
								<input name = "name" class="form-control" id="death" placeholder="Your Name">
							  </div>
							</div>
							<div class="form-group">
							  <label for="death" class="col-lg-2 control-label">Your Email</label>
							  <div class="col-lg-8">
								<input name = "email" class="form-control" id="death" placeholder="Your Email">
							  </div>
							</div>
							<div class="form-group">
							  <label for="textArea" class="col-lg-2 control-label">&nbsp;</label>
							  <div class="col-lg-4">
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