<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $meta_title;?></title>
	<meta name="keywords" content="<?php echo $meta_keywords;?>">
	<meta name="description" content="<?php echo $meta_description;?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google-site-verification" content="8llts6LJ5tjuF79q1_e7btykTKVD7S17kCVT0C1rLg0" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo images_url('favicon.ico');?>">
    <link rel="stylesheet" href="<?php echo css_url('bootstrap.css');?>" media="screen">
    <link rel="stylesheet" href="<?php echo css_url('custom.css');?>">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
    <![endif]-->
    <script src="assets/ga.txt" async="" type="text/javascript"></script><script>

     var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-23019901-1']);
      _gaq.push(['_setDomainName', "bootswatch.com"]);
        _gaq.push(['_setAllowLinker', true]);
      _gaq.push(['_trackPageview']);

     (function() {
       var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
       ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
     })();
    </script>
  </head>
  <body style="background:#efefef;padding-top:0;">
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1377128482501199";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
	<div class="container main-container">
		<div class="container">
			<div class="page-header" style="margin:0">
				<div class="row">
					<div class="col-lg-10 col-md-10 col-sm-10" style="border:none">
						<div style="position:relative;float:left;">
							<img height="80" src="<?php echo images_url('gon_logo.jpe');?>"/>
						</div>
						<div class="header_title">
							<span>Government of Nepal</span><br/>
							<span>Ministry of Health and Population</span><br/>
							<span>Department of Health Services</span><br/>
							<span class="edcd">Epidemiology and Disease Control Division</span>
						</div>
						<img height="60" style="margin-top:10px;margin-left:40px;" src="<?php echo images_url('nepal_flag.gif');?>"/>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2" style="float:right;border:none">
						<!--a href="<?php echo create_link('report-a-rumor');?>" class="report_rumor_btn" title="Report any rumor of public concern in your location">Report Rumor</a-->
					</div>
				</div>
			</div>
		</div>
		<div class="navbar navbar-default" style="margin-left:0">
			<div class="navbar-header">
			  <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav">
					<?php $menuitems = nav_menu();?>
					<li style="margin-left:0"><a href="<?php echo create_link('');?>">Home</a></li>
						<?php foreach($menuitems as $item){
							if(has_children($item['c_id'])){?>
							<li class="dropdown">
							<a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" id="<?php echo $item['c_id'];?>">
								<?php echo $item['c_title'];?><span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="<?php echo $item['c_id'];?>">
						<?php $children = get_children($item['c_id'])?>
						<?php foreach($children as $child){?>
							<li style="margin-left:0"><a href="<?php echo create_link($child['c_seo_name']);?>"><?php echo $child['c_title'];?></a></li>
						<?php } ?>
						</ul>
						<?php }else{?>
						<li style="margin-left:0"><a href="<?php echo create_link($item['c_seo_name']);?>"><?php echo $item['c_title'];?></a></li>
						<?php }}?>
						
					
					<!--li class="dropdown">
						<a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" id="about">About Us <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="about">
							<li><a href="<?php //echo create_link('about-us/introduction');?>">Introduction</a></li>
							<li><a href="<?php //echo create_link('about-us/organization');?>">Organization Structure</a></li>
							<li><a href="<?php //echo create_link('about-us/external-development-partners');?>">External Development Partners</a></li>
							<li><a href="<?php //echo create_link('about-us/people');?>">People</a></li>
							<li><a href="<?php //echo create_link('about-us/contact-and-location');?>">Contact & Location</a></li>
							<li><a href="<?php //echo create_link('feedback');?>">Feedback</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#" id="sections">Sections <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="sections">
							<?php //echo $sections;?>
						</ul>
					</li>
					<li><a href="<?php //echo create_link('mediacenter');?>">Media Center</a></li>
					<li><a href="<?php //echo create_link('publications');?>">Publications</a></li>
					<li><a href="<?php //echo create_link('resources');?>">Resources</a></li>
					<li><a href="<?php //echo create_link('noticeboard');?>">Notice Board</a></li-->
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<style type="text/css">
						#___gcse_0{
							background:#fff;
							margin:11px 20px 0 15px;
						}
						#gsc-i-id1{
							border:none;
							font-size:14px;
							padding:5px;
							width:200px;
						}
						input.gsc-search-button{
							color: #fff;
							background: #178ACC;
							font-weight: bold;
							border: 1px solid #ececec;
							height:25px;
							transition: background-color 0.5s ease;
						}
						input.gsc-search-button:hover{
							color: #FFF;
							background: #5AB8ED ;
						}
					</style>
					<script>
						(function() {
							var cx = '013681463942213451880:ptxdvxgahoq';
							var gcse = document.createElement('script');
							gcse.type = 'text/javascript';
							gcse.async = true;
							gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//cse.google.com/cse.js?cx=' + cx;
							var s = document.getElementsByTagName('script')[0];
							s.parentNode.insertBefore(gcse, s);
						})();
					</script>
					<gcse:searchbox-only resultsUrl="<?php echo base_url().'search/result';?>"></gcse:searchbox-only>
						<!--form style="margin:12px 20px 0 15px;background-color:#fff" method="get" action="<?php echo base_url().'search';?>">
							<input name = "q" type="text" placeholder="Search..." style="height:30px;margin-right:0;padding:5px;border:none;"/>
							<input style="float:right;" class="search_btn" type="submit" value="Search"/>
						</form-->
					</li>
				</ul>
			</div>
		</div>
		<div class="alert alert-dismissible alert-danger" style="border-radius:0;margin:0 0 5px 0;">
            <!--button type="button" class="close" data-dismiss="alert">×</button-->
			<style>
				.scroll-text {
					height: 20px;
					overflow: hidden;
				}
				.scroll-text ul {
					list-style:none;
					overflow: hidden;
				}
				.search_btn{
					color: #fff;
					background: #178ACC;
					font-weight: bold;
					border: 1px solid #ececec;
					height:30px;
					transition: background-color 0.5s ease;
				}
 
				.search_btn:hover {
					color: #FFF;
					background: #5AB8ED ;
					}
					
			</style>
			<div style="position:relative;float:left;color:red;font-weight:bold">Alerts &raquo;</div>
			<div id="demo1" class="scroll-text">
			  <ul style="margin:0">
				<?php echo $alerts;?>
			  </ul>
			</div>
        </div>