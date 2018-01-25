<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Eva Informatics Pvt. Ltd.</title>
    <link href="<?php echo css_url('bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo css_url('css.css');?>" rel="stylesheet">
	<link href="<?php echo css_url('responsiveslides.css');?>" rel="stylesheet">
	
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script src="<?php echo scripts_url('jquery.js');?>"></script>
	<script src="<?php echo scripts_url('responsiveslides.min.js');?>"></script>
	<script type="text/javascript">
		$(function () {
			$("#banner").responsiveSlides({
				speed: 3000
			});
		});
	</script>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed" role="navigation" style="padding:20px 0;margin-bottom:0;border:none;border-radius:0;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="position:relative;float:left;width:100px;overflow:hidden">
					<img class="img-responsive" src="<?php echo images_url('logo.png');?>" style="width:85px;"/>
				</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav" style="font-size:16px;font-weight:bold;">
					<?php $menuitems = nav_menu();?>
                    <li><a href="<?php echo create_link('');?>" class="userlinks"><span class="glyphicon glyphicon-home"></span></a></li>
					<?php foreach($menuitems as $item){
							if(has_children($item['c_id'])){?>
							<li>
							<a href="#" class="dropdown-toggle userlinks" aria-expanded="false" data-toggle="dropdown" id="<?php echo $item['c_id'];?>">
								<?php echo $item['c_title'];?><span class="caret"></span>
							</a>
							<ul class="dropdown-menu" aria-labelledby="<?php echo $item['c_id'];?>" style="background:#000;color:#fff;font-size:16px; font-weight:bold;border-radius:0 4px 4px 4px;">
						<?php $children = get_children($item['c_id'])?>
						<?php foreach($children as $child){?>
							<li>
								<a href="<?php echo create_link($item['c_seo_name'].'/'.$child['c_seo_name']);?>"><?php echo $child['c_title'];?></a>
							</li>
						<?php } ?>
						</ul>
						<?php }else{?>
						<li><a href="<?php echo create_link($item['c_seo_name']);?>"  class="userlinks"><?php echo $item['c_title'];?></a></li>
						<?php }}?>
                </ul>
				<ul class="nav navbar-nav navbar-right">
					
                </ul>
            </div>
        </div>
    </nav>