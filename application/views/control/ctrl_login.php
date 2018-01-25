<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title><?php echo $this->site_title;?> - Admin</title>
		<link href="<?php echo ctrl_css_url('bootstrap.min.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo ctrl_css_url('sb-admin.css');?>" rel="stylesheet" type="text/css">
		<link href="<?php echo ctrl_css_url('plugins/morris.css');?>" rel="stylesheet" type="text/css">
		<script src="<?php echo ctrl_scripts_url('jquery.1.11.1.min.js');?>" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){						
			// submit the reservation through ajax
			$("#login-form").submit(function(e) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: $(this).attr("action"),
					data: $(this).serialize(),
					dataType: "json",
					beforeSend:function(){
						$('#login-alert').fadeIn('slow');
						$('#login-alert').html('Requesting...');
					}, error: function(data){
						$('#login-alert').html('Unexpected error occured.');
					}, success: function(data){
						if(data[0]['status'] == 1){
							$('#login-alert').html(data[0]['message']);
							$('#login-form')[0].reset();
							window.location.href = data[0]['continue'];
						}else{
							$('#login-alert').html(data[0]['message']);
						}
					}
				});
				$('#login-alert').delay(5000).fadeOut('slow');
				return false;
			});
		});
	</script>
	</head>
	<body>
		<div class="row-fluid">
			<div class="span12 center login-header" style="text-align:center;color:#eee;">
				<h2>Admin Panel</h2>
			</div><!--/span-->
		</div><!--/row-->
		<div class="row-fluid" style="margin:0 auto;">
				<div class="well span5 center login-box" style="width:40%;">
					<div class="alert alert-info" id="admin-login-alert" style="padding:5px;">Please login</div>
					<form class="form-horizontal" id="login-form" action="<?php echo base_url().'admin/login/process';?>" method="post">
						<fieldset>
							<div class="input-prepend" title="Username" data-rel="tooltip" style="margin-bottom:10px;">
								<input autofocus class="input-large span10" name="username" id="username" type="text" value="" placeholder="Username" style="width:100%" />
							</div>
							<div class="clearfix"></div>
							<div class="input-prepend" title="Password" data-rel="tooltip" style="margin-bottom:10px;">
								<input class="input-large span10" name="password" id="password" type="password" value="" placeholder="Password" style="width:100%" />
							</div>
							<div class="clearfix"></div>
							<p class="center span5">
								<button type="submit" class="btn btn-primary" id="submitbutton">Login</button>
								<div id="login-alert"></div>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
	</body>
</html>