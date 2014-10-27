<ul class="sidebar">
<li id="search-3" class="widget widget_search"><form role="search" method="get" id="searchform" class="searchform" action="<?php echo get_home_url(); ?>">
				<div>
					<label class="screen-reader-text" for="s">Search for:</label>
					<input type="text" value="" name="s" id="s">
					<input type="submit" id="searchsubmit" value="Search">
				</div>
			</form></li>
            
   	<li class="widget activity" id="recentactivity">
		<h3>Recent Activity</h3>
   			<div class="content">
       	<?php
		query_posts(array('post_type' => 'projects', 'order' => 'DSC', 'posts_per_page' => -1 ));
		if (have_posts()) :
			while (have_posts()):
				the_post();
				echo '<a href="' . get_permalink() . '" class="list">';
					$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium');
					echo '<div class="img"><img src="' . $imgsrc[0] . '"></div>';
					echo '<h4>' . get_the_title() . '</h4>';
				echo '</a>';
			endwhile;
		endif;
		wp_reset_query();
		?>
        </div>
   	</li>
    
    <script language="javascript">
		$(document).ready(function(e) {
			var lebar = $("#recentactivity").height();
			var mheight = {width: '570px'};
			
			function buka() {
				$("#recentactivity").animate({maxHeight: lebar + 'px'}, 300);
			}
			function tutup() {
				$("#recentactivity").animate({maxHeight: '570px'}, 300);
			}
			
            $("#recentactivity").css("max-height", "570px");
			$("#recentactivity").bind("mouseenter", buka);
			$("#recentactivity").bind("mouseleave", tutup);
		});
	</script>
    <?php if (!dynamic_sidebar('sidebar-kanan')) : endif; ?>
</ul>