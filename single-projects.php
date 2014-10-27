<?php get_header('single'); ?>

<div class="outer single">
	<div class="inner">
    
    <?php if (have_posts()) : the_post();
		$categories = get_the_category();
		$output = array();
		
		if($categories){
			foreach($categories as $category) {
				array_push($output, '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>');
			}
		} ?>
        <div class="cat">
        	<?php echo implode(', ', array_merge(array('Project'), $output)); ?>
        </div>
    
    	<div class="main">
	   		<h2><?php the_title(); ?></h2>
	      	<div class="meta"><?php _e('Posted by', 'fossgrafis'); ?> <?php the_author_posts_link(); ?> <?php _e('on', 'fossgrafis'); ?> <?php the_time( 'M j, Y' ) ?> <?php _e('in', 'fossgrafis'); ?> <?php the_category(', ') ?> | <a href="<?php comments_link(); ?>">Tulis Komentar</a></div>
	      	<div class="content">
			  <?php the_content(); ?>
              <?php $slideshow_autoplay = get_post_meta($post->ID, "_ttrust_disable_autoplay_value", true);?>				
				<?php $project_notes = get_post_meta($post->ID, "_ttrust_notes_value", true); ?>
				<?php echo wpautop($project_notes); ?>
				
				<?php $project_url = get_post_meta($post->ID, "_ttrust_url_value", true); ?>
				<?php $project_url_label = get_post_meta($post->ID, "_ttrust_url_label_value", true); ?>
				<?php $project_url_label = ($project_url_label!="") ? $project_url_label : __('Visit Site', 'themetrust'); ?>
				<?php if ($project_url) : ?>
					<p><a class="action" href="<?php echo $project_url; ?>"><?php echo $project_url_label; ?></a></p>
				<?php endif; ?>
      		</div>            
        </div>
        <?php get_sidebar('project'); ?>
        <div class="main">
        	<?php comments_template('', true); ?>
        </div>
        
    <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>