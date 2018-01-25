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
    <!--link href="<?php echo ctrl_css_url('plugins/morris.css');?>" rel="stylesheet" type="text/css" -->
	<link href="<?php echo ctrl_css_url('jquery-ui.css');?>" rel="stylesheet" type="text/css">
	<!-- scripts -->
	<script src="<?php echo ctrl_scripts_url('jquery.1.11.1.min.js');?>" type="text/javascript"></script>
	<script src="<?php echo ctrl_scripts_url('jquery-ui.js');?>" type="text/javascript"></script>
	<script src="<?php echo ctrl_scripts_url('scripts.js');?>" type="text/javascript"></script>
	<script src="<?php echo ctrl_scripts_url('jquery.dataTables.min.js');?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo ctrl_scripts_url('nicEdit.js');?>"></script>
	<script type="text/javascript">
		bkLib.onDomLoaded(function(){
			nicEditors.allTextAreas();
		});
</script>
	<style>
		/* UI dialog customization */
		.ui-dialog{
			border-radius:10px;
			-webkit-box-shadow: 1px 2px 15px rgba(0,0,0,.5);
			-moz-box-shadow: 1px 2px 5px rgba(0,0,0,.5);
			box-shadow: 1px 2px 5px rgba(0,0,0,.5);
			border: 10px solid rgba(0, 0, 0, .5);
			-webkit-background-clip: padding-box; /* for Safari */
			background-clip: padding-box; /* for IE9+, Firefox 4+, Opera, Chrome */
		}
		.ui-dialog-titlebar{
			background:none;
			border:none;
			padding-left-value:0;
			border-bottom:1px solid #d7d7d7;
			border-radius:0;
		}
		.ui-widget-overlay{
			z-index:999999;
		}
		.ui-dialog-title{
			margin-left:0;
			padding-left:0;
		}
		.ui-dialog .ui-dialog-titlebar-close{
			content:"x";
		}
		/* end UI dialog customization */
	</style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background:#fff;">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url().'admin';?>"><?php echo $this->site_title;?> - Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome! Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url().'admin/admins/changepass/'.$this->session_array['id'];?>">Change Password</a></li>
						<li class="divider"></li>
                        <li><a href="<?php echo base_url().'admin/login/end';?>">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active"><a href="<?php echo base_url().'admin';?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="<?php echo base_url().'admin/settings/show';?>"><i class="fa fa-fw fa-bar-chart-o"></i> Site Settings</a></li>
                    <li><a href="<?php echo base_url().'admin/contents/list';?>"><i class="fa fa-fw fa-table"></i> Contents</a></li>
					<li><a href="<?php echo base_url().'admin/categories/list';?>"><i class="fa fa-fw fa-table"></i> Categories</a></li>
                    <li><a href="<?php echo base_url().'admin/media';?>"><i class="fa fa-fw fa-edit"></i> Media</a></li>
                    <li><a href="<?php echo base_url().'admin/admins/list';?>"><i class="fa fa-fw fa-desktop"></i> Admins</a></li>
					<!--li><a href="<?php echo base_url().'admin/widgets/list';?>"><i class="fa fa-fw fa-desktop"></i> Widgets</a></li-->
					<li><a href="<?php echo base_url().'admin/feedback';?>"><i class="fa fa-fw fa-desktop"></i> Read Feedbacks</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="status" class="center status"></div>