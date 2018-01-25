			<footer>
				<div class="row" style="background:#d7d7d7;padding:10px 5px;border-bottom:2px solid #178ACC">
					<div class="col-lg-12">
						<ul class="list-unstyled">
							<li class="pull-right">&copy Epidemiology and Disease Control Division - 2015</li>
							<li><a href="#top">Back to Top</a></li>
							<li style="margin-right:30px;"><a href="#">Sitemap</a></li>
							<li><?php echo $this->visitor_count;?></li>
						</ul>
					</div>
				</div>
			</footer>
		</div>
		<script src="<?php echo scripts_url('jquery-1.js');?>"></script>
		<script src="<?php echo scripts_url('bootstrap.js');?>"></script>
		<script src="<?php echo scripts_url('jquery.scrollbox.js')?>"></script>
		<script src="<?php echo scripts_url('custom.js')?>"></script>
		<script>
			$(function () {
				$('#demo1').scrollbox();
				});
  </script>
	</div>
</body>
</html>