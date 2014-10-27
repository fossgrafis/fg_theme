<?php get_header('single'); ?>
	
<div class="outer outermain">
	<div class="inner">
    	<div class="searchlist mainbar">
        	<div class="dafpost">
            	<?php
				$post_count = $wp_query->post_count;
				echo '<h3>' . $post_count . ' tulisan ';
				?>
                <?php global $post; if(is_archive() && have_posts()) :

				if (is_category()) :
					echo 'dengan kategori "';
					single_cat_title();
				elseif( is_tag() ) :
					echo 'dengan label "';
					single_tag_title();
				elseif (is_day()) : ?>
                	arsip tanggal "<?php the_time('j M Y');
				elseif (is_month()) : ?>
					arsip bulan "<?php the_time('F Y');
				elseif (is_year()) : ?>
					arsip tahun "<?php the_time('Y');
				elseif (isset($_GET['paged']) && !empty($_GET['paged'])) : ?>
					arsip<?php
				elseif ( is_author()) :
					$current_author = $wp_query->get_queried_object();
					echo 'dari "' . $current_author->display_name;
				endif;
				elseif (isset($_GET['s'])):
					echo 'yang memuat kata "' . $_GET['s'];
				endif;
				?>"</h3>
            	<div class="content">
        <?php
			$c=0;
			
			
			while (have_posts()) : the_post();
						
						$categories = get_the_category();
						$output = array();
						
						if($categories){
							foreach($categories as $category) {
								array_push($output, '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>');
							}
						}
						
						echo '<div class="list slist">';
							$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium');
							echo '<div class="cat">' . implode(', ', $output) . '</div>';
							echo '<div class="img"><img src="' . $imgsrc[0] . '"/></div>';
							echo '<div class="searchd">';
							echo '<h4><a href="' . get_permalink() . '">' . get_the_title() . '</a></h4>';
							echo '<div class="meta">' . ' Oleh ';
								the_author_posts_link();
								echo ', ';
								the_time( 'j M Y' );
								echo ' di ';
								the_category(', ');
							echo '</div>';
							echo '<div class="excerpt">' , get_the_excerpt() . '</div>';
							echo '</div>';
						echo '</div>';
			
			endwhile;
		?>
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
        </div>
       	<?php get_sidebar('search'); ?>
    </div>
</div>
	
<?php get_footer(); ?>