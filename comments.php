
<?php // Do not delete these lines
	if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('Enter your password to view comments.', 'fossgrafis_comment'); ?></p>

			<?php
			return;
		}
	}
?>
<?php if(have_comments() || 'open' == $post->comment_status) : ?> <div id="commentBox" class="roundedBox"> <?php endif; ?>
<?php if(have_comments()) : ?>	

<div id="comments" class="">

	<?php if (!empty($comments)) : ?>

	<?php $comments_count = count($comments); ?>
	<h2><?php echo $comments_count; ?> <?php if($comments_count==1) : _e('Comment', 'fossgrafis_comment'); else : _e('Comments', 'fossgrafis_comment'); endif; ?></h2>

	<?php endif; ?>

	<?php if(!empty($comments)) : ?>
					
	<ol id="commentslist" class="clearfix">
	    <?php wp_list_comments('callback=fossgrafis_comment'); ?>
	</ol>
	
	<div class="pagination clearfix">
		<?php paginate_comments_links(); ?> 
	</div>
	
	<?php endif; ?>
	
	

</div><!-- end comments -->

<?php endif; // endif comments ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="commentForm" class="clear">

	<div id="respond">

	<h3><?php comment_form_title( __('Leave a Reply', 'fossgrafis_comment'), __('Leave a Reply to %s', 'fossgrafis_comment') ); ?></h3>	

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'fossgrafis_comment'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" >

	<?php if ( is_user_logged_in() ) : ?>

	<p><?php printf(__('Logged in as %s', 'fossgrafis_comment'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Log out of this account', 'fossgrafis_comment') ?>" ><?php _e('Log out &raquo;', 'fossgrafis_comment'); ?></a></p>

	<?php else : ?>

	<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="32" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
	<label for="author"><?php _e('Name', 'fossgrafis_comment'); ?> <?php if ($req) _e('(required)', 'fossgrafis_comment'); ?></label></p>

	<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="32" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
	<label for="email"><?php _e('Email', 'fossgrafis_comment'); ?> <?php if ($req) _e('(required)', 'fossgrafis_comment'); ?></label></p>

	<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="32" tabindex="3" />
	<label for="url"><?php _e('Website', 'fossgrafis_comment'); ?> </label></p>

	<?php endif; ?>

	<p><textarea name="comment" id="comment" cols="55" rows="12" tabindex="4"></textarea></p>
	
	<p>
	<input name="submit" type="submit" class="button" id="submit" tabindex="5" value="<?php echo esc_attr(__('Submit Comment', 'fossgrafis_comment')); ?>" /> <?php cancel_comment_reply_link(__('Cancel Reply', 'fossgrafis_comment')); ?>
	<?php comment_id_fields(); ?>
	</p>	
	
	<?php do_action('comment_form', $post->ID); ?>

	</form>

	<?php endif; // If registration required and not logged in ?>
	</div>

</div><!-- end commentform -->

<?php endif; // if you delete this the sky will fall on your head ?>

<?php if(have_comments() || 'open' == $post->comment_status) : ?> </div> <?php endif; ?>
