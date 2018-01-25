<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Map of Nepal</title>
	 <script type="text/javascript"  src="<?php echo scripts_url('map/jquery.min.js');?>"></script>
    <script type="text/javascript"  src="<?php echo scripts_url('map/d3/d3.min.js');?>"></script>
    <script type="text/javascript"  src="<?php echo scripts_url('map/topojson.v1.min.js');?>"></script>
    <link href="<?php echo css_url('map_style.css');?>" media="screen" rel="stylesheet" type="text/css">
  </head>
 <body>
  <div id="tooltip" class="hidden">
    <p><strong id ="heading"></strong></p>
    <p><span id="area"></span></p>
	<p><span id="population"></span></p>
  </div>
  <h1>Nepal</h1>
  <script type ="text/javascript" src ="<?php echo scripts_url('map/mymap.js');?>"></script>
 </body>
</html>
