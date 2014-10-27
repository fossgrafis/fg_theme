<ul class="sidebar">
	<li class="widget thumbnail">
    	<div class="content">
        <?php
			$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium');
			echo '<img src="' . $imgsrc[0] . '"/>';
		?>
        </div>
    </li>

    <li class="widget tutdetail">
    <div class="wrap">
		<h3>Tutorial Details</h3>
		<ul class="content">
			<li><strong>Program:</strong> <?php echo get_post_meta($post->ID, 'Program', true); ?> </li>
			<li><strong>Level:</strong> <?php echo get_post_meta($post->ID, 'Level', true); ?> </li>
			<li><strong>Estimated Completion Time:</strong> <?php echo get_post_meta($post->ID, 'Estimated Completion Time', true); ?> </li>
		</ul>
        
		<h3>Download Source Files</h3>
		<ul class="content">
			<li> <?php 
				$avail = get_post_meta($post->ID, 'Download Source Files', true);
				if (!in_array(strtolower($avail), array('available', 'not available', ''))) {
					echo '<a href="' . $avail . '" class="button"> Download </a>';
				} else {
					echo $avail;
				}
			?> </li>
		</ul>
    </div>
    </li>
    <div class="widget authorinfo">
    	<h3>Info Penulis</h3>
        <div class="content">
        	<div class="userphoto">
            	<?php echo get_avatar(get_the_author_id()); ?>
            </div>
            <div class="bio">
            	<div class="name">
                	<?php echo '<a rel="nofollow" href="'.get_author_posts_url(get_the_author_meta( 'ID' )) .'">' . get_the_author_meta('display_name') . '</a>'; ?>
                </div>
                <div class="numpost">
                	<?php echo '&ndash; <a rel="author" href="'. get_author_posts_url(get_the_author_meta( 'ID' )) .'">'. get_the_author_posts() .'</a> posts'; ?>
                </div>
                <div class="sosmed">
                <?php
					$email = get_the_author_meta('email');
					$twitter = get_the_author_meta( 'twitter' );
					$facebook = get_the_author_meta( 'facebook' );
					$linkedin = get_the_author_meta( 'linkedin' );
					$google_profile = get_the_author_meta( 'google_profile' );
					
					if ($email) {
						$display_email = '<a title="Email" rel="me nofollow" href="mailto:' . $email . '" target="_blank"><img src="http://afief.net/email.png" /></a>';
					}
					if($google_profile){
						$display_google_profile='<a title="My Google +" rel="me nofollow" href="' . esc_url($google_profile) . '" target="_blank"><img src="http://c.dryicons.com/images/icon_sets/socialize_part_5_icons_set/png/32x32/google_plus.png" /></a>';
					}
					if($linkedin){
						$display_linkedin_profile='<a title="My linkedin" rel="me nofollow" href="' . esc_url($linkedin) . '" target="_blank"><img src="http://c.dryicons.com/images/icon_sets/socialize_part_2_icons_set/png/32x32/linkedin.png" /></a>';
					}
					if($facebook){
						$display_facebook_profile='<a title="My facebook" rel="me nofollow" href="' . esc_url($facebook) . '" target="_blank"><img src="http://a.dryicons.com/images/icon_sets/socialize_icons_set/png/32x32/facebook.png" /></a>';
					}
					if($twitter){	
						$display_twitter_profile='<a title="My Twitter" rel="me nofollow" href="' . esc_url($twitter) . '" target="_blank"><img src="http://b.dryicons.com/images/icon_sets/socialize_part_5_icons_set/png/32x32/twitter.png" /></a>';
					}
					echo $display_email.$display_google_profile.$display_linkedin_profile.$display_facebook_profile.$display_twitter_profile;
				?>
                </div>
            </div>
            <div class="description">
           	<?php
				echo get_the_author_description();
			?>
            </div>
        </div>
    </div>

    <?php if (!dynamic_sidebar('single-kanan')) : endif; ?>
</ul>