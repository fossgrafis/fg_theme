<?php

class Foss_Recent_Posts extends WP_Widget {

	function Foss_Recent_Posts() {
		global $Foss_theme_name, $Foss_version, $options;
		$widget_ops = array('classname' => 'Foss_recent_posts', 'description' => __('Display recent posts from any category.', 'fossgrafis'));
		$this->WP_Widget('Foss_recent_posts', $Foss_theme_name.' '.__('Recent Posts', 'fossgrafis'), $widget_ops);
	}

	function widget($args, $instance) {
	
		global $Foss_theme_name, $options;
	
		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent Posts' : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 10 )
			$number = 10;
			
		$rp_cat = $instance['rp_cat'];
		$show_post = $instance['show_post'];		 

		$r = new WP_Query(array('cat' => $rp_cat, 'showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1));
		if ($r->have_posts()) :
?>		
	
		<?php if($show_post == "true") :?>
			
			<?php $before_widget = str_replace('class="', 'class="oneHalf ' , $before_widget); ?>
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
		
			<?php $Foss_feed = $rp_cat ? get_category_feed_link($rp_cat, '') : Foss_get_option('Foss_rss'); ?>
			
		
				<?php $i=1;  while ($r->have_posts()) : $r->the_post(); ?>
				<?php if($i==1) :?>
				<div class="firstPost">					
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a>
					<span class="meta"><?php the_time(get_option('date_format')); ?> </span>
					<?php the_excerpt(); ?>					
				</div>
				<?php else : ?>	
				<div class="secondaryPost">					
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a>
					<span class="meta"><?php the_time(get_option('date_format')); ?> </span>
				</div>
				
				<?php endif; ?>
				<?php $i++; endwhile; ?>					
			<?php echo $after_widget; ?>
						
		<?php else : ?>
			
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>
		
			<?php $Foss_feed = $rp_cat ? get_category_feed_link($rp_cat, '') : Foss_get_option('Foss_rss'); ?>
			
		
			<ul class="widgetList">
				<?php  while ($r->have_posts()) : $r->the_post(); ?>
				<li>					
					<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a>
					<span class="meta"><?php the_time(get_option('date_format')); ?> </span>
				</li>
				<?php endwhile; ?>
			</ul>
				
			<?php echo $after_widget; ?>
		
		<?php endif; ?>
<?php
			wp_reset_query();  
		endif;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['rp_cat'] = $new_instance['rp_cat'];
		$instance['show_post'] = $new_instance['show_post'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Recent Posts';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
			
		if (isset($instance['rp_cat'])) :	
			$rp_cat = $instance['rp_cat'];
		endif;
		
		
		if (isset($instance['show_post'])) :	
			$show_post = $instance['show_post'];
		endif;
		

		$pn_categories_obj = get_categories('hide_empty=0');
		$pn_categories = array(); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'fossgrafis'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('rp_cat'); ?>"><?php _e('Category', 'fossgrafis'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('rp_cat'); ?>" name="<?php echo $this->get_field_name('rp_cat'); ?>">
			<option value=""><?php _e('All', 'fossgrafis'); ?></option>
			<?php foreach ($pn_categories_obj as $pn_cat) {				
				echo '<option value="'.$pn_cat->cat_ID.'" '.selected($pn_cat->cat_ID, $rp_cat).'>'.$pn_cat->cat_name.'</option>';
			} ?>
		</select></p>
		
		<p><input id="<?php echo $this->get_field_id('show_post'); ?>" name="<?php echo $this->get_field_name('show_post'); ?>" type="checkbox" value="true" <?php if(isset($show_post) && $show_post=="true") echo "checked"; ?>/>
		<label for="<?php echo $this->get_field_id('show_post'); ?>"><?php _e('Show latest post', 'fossgrafis'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'fossgrafis'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('10 max', 'fossgrafis'); ?></small></p>
<?php
	}
}

class Foss_Author extends WP_Widget {

	function Foss_Author() {
		// Instantiate the parent object
		parent::__construct( false, 'Foss Author' );
	}

	function widget( $args, $instance ) {
		// Widget output
		extract($args);
		
		echo '<div class="authorlist">';
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Authors' : $instance['title']);
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo '<ul class="content">';
			$usersau = get_users('role=author');
			$usersad = get_users('role=administrator');
			$users = array_merge($usersad, $usersau);
			foreach ($users as $user) {
				if (count_user_posts($user->ID) > 0)
				echo '<li><a href="' . get_author_posts_url($user->ID) . '" title="' . $user->first_name . ' ' . $user->last_name . ' - ' . count_user_posts($user->ID) . ' Postingan">' . get_avatar($user->ID, 96) . '</a></li>';
			}
        echo '</ul>';
		echo $after_widget;
		echo '</div>';
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$title = isset($instance['title']) ? esc_attr($instance['title']) : 'Authors'; ?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'fossgrafis'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
	}
}


function foss_register_widget() {
	register_widget('Foss_Recent_Posts');
	register_widget('Foss_Author');
}
add_action('widgets_init', 'foss_register_widget');