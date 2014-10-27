<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
    
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>"/>
    <script language="javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/nivo-slider/jquery.nivo.slider.pack.js"></script>
    
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body>
	<div class="outer outerheader">
    	<header class="inner">
        	<h1><?php bloginfo('title'); ?></h1>
            <h2><?php bloginfo('description'); ?></h2>
        	<div class="logo">
            	<a href="<?php echo home_url(); ?>"><img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /></a>
                <div class="sharehead">
         	  	 	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
                    <div style="width: 75px; overflow:hidden; display:inline-block">
                    	<g:plusone></g:plusone>
                    </div>
					<div class="fb-like" data-href="https://www.facebook.com/fossgrafis" data-width="450" data-layout="button_count" data-show-faces="false" data-send="true"></div>
                    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="http://fossgrafis.com" data-via="fossgrafis" data-text="Belajar Aplikasi Grafis Opensource di">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            	</div>
            </div>
        </header>
	</div>     
    <div class="outerf head2 headsingle">
        <div class="slider inner">
        	<div class="menuutama">
				<?php wp_nav_menu( array( 'theme_location' => 'utama', 'menu_class' => 'nav-menu' ) ); ?>
			</div> 
        </div>
	</div>      