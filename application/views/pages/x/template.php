<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--content-->
	<!--title--><h4 id="{id}">{title}</h4><!--/title-->
	<!--content-->
		<p>
			<!--image-->
				<img style="position:relative;float:left;margin:0 10px 5px 0" src="{image}"/>
			<!--/image-->{body}
		</p>
	<!--/content-->
<!--/content-->

<!--organization-->
	<!--title-->
		<h4 id="{id}">{title}</h4>
	<!--/title-->
	<!--content-->
		<p>
			<!--image-->
				<img class="img-responsive" src="{image}"/>
			<!--/image-->{body}
		</p>
	<!--/content-->
<!--/organization-->

<!--message-->
	<!--title--><h4 id="{id}">{title}</h4><!--/title-->
	<!--content-->
		<div style="position:relative;float:left;width:100%;border-bottom:1px solid #ececec;margin-bottom:10px;">
			<!--image-->
				<img src="{image}" width="100" height="100" style="position:relative;float:left;margin:0 10px 10px 0;"/>
			<!--/image--><p class="message-main" style="font-weight:bold">{body}</p>
		</div>
	<!--/content-->
<!--/message-->


<!--child-->
	<!--title--><h4>{title}</h4><!--/title-->
	<!--content--><p><!--image--><div class="child_image"><img src="{image}"/></div><!--/image-->{body}</p><!--/content-->
	<!--readmore--><a href="{readmore}">Read More</a><!--/readmore-->
<!--/child-->

<!--slideshow-item-->
	<!--content-->
	<div class="slide">
		<img src="{image}" class="loaded" style="text-align:center;position:relative;"/>
		<span>{title}</span>
		<span>{description}</span>
	</div>
	<!--/content-->
<!--/slideshow-item-->

<!--mygallery-->
	<h1>Glimpses</h1>
	<!--content-->
		<div class="left photo-block" style="position:relative;float:left;margin:3px 5px 2px 0;border:none;">
			<a class="fancybox" id="{id}" rel="gallery" title="{title}" href="{link}" style="">
				<img width="148" src="{thumbnail}" />
			</a>
		</div>
	<!--/content-->
<!--/mygallery-->

<!--wgallery-->
	<h1>Gallery</h1>
	<!--content-->
		<div class="left photo-block" style="position:relative;float:left;margin:3px 5px 2px 0;border:none;">
			<a class="fancybox" id="{id}" rel="gallery" title="{title}" href="{link}" style="">
				<img width="90" src="{thumbnail}" />
			</a>
		</div>
	<!--/content-->
<!--/wgallery-->

<!--media-->
	<h1>My Media</h1>
	<!--content-->
	<div class="left photo-block" style="position:relative;float:left;margin:3px 5px 2px 0;border:none;">
		<a class="fancybox" id="{id}" rel="gallery" title="{title}" href="{link}" style="">
			<img width="148" src="{thumbnail}" />
		</a><span>{title}</span><span>{description}</span>
	</div>
<!--/content-->
<!--/media-->

<!--content-widget-->
<div class="content_widget">
	<!--title--><h2 style="font-sie:15px;color:lightgreen">{title}</h2><!--/title-->
	<!--image><div class="image"><img style="width:200px;" src="{image}" /></div><!--/image-->
	<!--body--><div class="body"><!--image--><img style="width:200px;" src="{image}" /><!--/image-->{body}<!--readmore--><br><a href="{readmore}">Read more</a><!--/readmore--></div><!--/body-->
</div>
<!--/content-widget-->

<!--mywidget-->
<div class="widget-wraper">
	<!--title-->
		<div class="widget_title">{title}</div>
	<!--/title-->
	
	<!--image-->
		<div class="widget-image"><img src="{image}"/></div>
	<!--/image-->
	
	<div class="widget-content">
		<!--content-->
			<div class="left photo-block" style="position:relative;float:left;margin:3px 5px 2px 0;border:none;">
				<a class="fancybox" id="{media_id}" rel="gallery" title="{media_title}" href="{media_link}" style="">
					<img width="100" src="{media_thumbnail}" />
				</a>
			</div>
		<!--/content-->
	</div>
</div>
<!--/mywidget-->

<!--mycatwidget-->
		<!--content-->
			<div class="child_contents">
				<!--image--><div class="child_image"><img src="{image}"/></div><!--/image-->
				<div class="child_body">
					<!--title--><h3>{title}</h3><span>{price}</span><!--/title-->
					<!--body--><p>{body}<!--readmore--><br><a href="{readmore}">Continue Reading</a><!--/readmore--></p><!--/body-->
				</div>
			</div>
		<!--/content-->
<!--/mycatwidget-->

<!--mycatwidget1-->
		<!--content-->
			<div class="child_contents">
				<!--image--><div class="child_image"><img src="{image}"/></div><!--/image-->
				<div class="child_body">
					<!--title--><h3>{title}</h3><!--/title-->
					<!--body--><p>{body}<!--readmore--><br><a href="{readmore}">Continue Reading</a><!--/readmore--></p><!--/body-->
				</div>
			</div>
		<!--/content-->
<!--/mycatwidget1-->

<!--testimonials-->
		<!--content-->
			<div class="child_contents">
				<!--title--><h3>{title}</h3><!--/title-->
				<!--image--><div class="child_image" style="width:100px;height:100px;border-radius:50px;overflow:hidden;"><img width="100" src="{image}"/>{author}</div><!--/image-->
				{author}
				<div class="child_body">
					<!--body--><p>{body}<!--readmore--><br><a href="{readmore}">Continue Reading</a><!--/readmore--></p><!--/body-->
				</div>
			</div>
		<!--/content-->
<!--/testimonials-->

<!--serviceswidget-->
	<div class="child_container">
		<!--content-->
			<div class="child_contents">
				<!--image--><div class="child_image" style="position:relative;float:left;width:50px"><img width="50" src="{image}"/></div><!--/image-->
				<!--div class="child_body" style="position:relative;float:left;margin-left:15px;margin-top:15px;"-->
					<!--title--><h3 style="position:relative;float:left;margin-left:15px;margin-top:15px;">{title}</h3><!--/title-->
					
				<!--/div-->
				<div style="clear:both"></div>
			</div>
		<!--/content-->
	</div>
<!--/serviceswidget-->