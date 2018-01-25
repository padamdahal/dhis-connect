		<?php if(!defined('BASEPATH')) exit('Resource doesn\'t exists.');?>
		<div class="container">
			<div class="page-header" style="margin-top:10px;border-bottom:1px solid #ececec;">
				<div class="row">
					<div class="col-lg-8">
						<h4 class="section-title"><?php echo 'Search Results';?></h4>
						<script>
							(function() {
							  var cx = 'YOUR_ENGINE_ID';
							  var gcse = document.createElement('script');
							  gcse.type = 'text/javascript';
							  gcse.async = true;
							  gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
								  '//cse.google.com/cse.js?cx=' + cx;
							  var s = document.getElementsByTagName('script')[0];
							  s.parentNode.insertBefore(gcse, s);
							})();
						</script>
						<gcse:searchresults-only></gcse:searchresults-only>						
                    </div>
										
					<div class="col-lg-4" style="padding-bottom:10px;">
						<?php include_once('includes/sidebar-right.php');?>
					</div>
				</div>
			</div>
			<div class="bs-docs-section">
				<?php include_once('includes/sidebar-bottom.php');?>
			</div>