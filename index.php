<?php get_header(); ?>

<div class="outer outermain">
	<div class="inner">
    	<div class="mainbar">
    		<div class="dafpost">
           		<h3>Latest Tutorial</h3>
                <ul class="content">
       			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        		query_posts(array('category_name' => 'tutorial', 'posts_per_page' => 6, 'paged' => $paged));
					if (have_posts()) :
					while (have_posts()):
						the_post();
						
						$categories = get_the_category();
						$output = array();
						
						if($categories){
							foreach($categories as $category) {
								array_push($output, '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>');
							}
						}
						
						echo '<li class="list">';
							$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium');
							echo '<div class="cat">' . implode(', ', $output) . '</div>';
							echo '<a href="' . get_permalink() . '"><div class="img"><img src="' . $imgsrc[0] . '"></div></a>';
							echo '<a href="' . get_permalink() . '"><h4>' . get_the_title() . '</h4></a>';
							echo '<div class="excerpt">' , get_the_excerpt() . '</div>';
						echo '</li>';
					endwhile;
				endif;
           		wp_reset_query();
				?>
                </ul>
                <div class="pagination">
                <?php
				$big = 999999999; // need an unlikely integer
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'prev_text' => '«',
					'next_text' => '»'
				) );
				?>
                </div>
        	</div>
        </div>
        
        <?php get_sidebar(); ?>
        
    </div>
</div>

<?php get_footer(); ?>