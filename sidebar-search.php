<ul class="sidebar search">
	<?php if (is_author()) : ?>
    
    <div class="widget authorinfo">
    	<h3>Info Penulis</h3>
        <div class="content">
        	<div class="userphoto">
            
            	<?php
				$current_author = $wp_query->get_queried_object();
                echo get_avatar($current_author->ID); ?>
            </div>
            <div class="bio">
            	<div class="name">
                	<?php echo '<a rel="nofollow" href="'.get_author_posts_url($current_author->ID) .'">' . $current_author->display_name . '</a>'; ?>
                </div>
                <div class="numpost">
                	<?php echo '&ndash; <a rel="author" href="'. get_author_posts_url($current_author->ID) .'">'. count_user_posts($current_author->ID) .'</a> posts'; ?>
                </div>
                <div class="sosmed">
                <?php
					$email = $current_author->user_email;
					$twitter = $current_author->twitter;
					$facebook = $current_author->facebook;
					$linkedin = $current_author->linkedin;
					$google_profile = $current_author->google_profile;
					
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
				echo get_the_author_meta('description', $current_author->ID);
			?>
            </div>
        </div>
    </div>
    
	<?php endif;
	?>
	<?php if (!dynamic_sidebar('searchside')) : endif; ?>

</ul>