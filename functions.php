<?php
require_once (TEMPLATEPATH . "/widgets.php");
require_once (TEMPLATEPATH . "/metabox.php");

function fossgrafis_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>		
	<li id="li-comment-<?php comment_ID() ?>">		
		
		<div class="comment <?php echo get_comment_type(); ?>" id="comment-<?php comment_ID() ?>">						
			
			<?php echo get_avatar($comment,'60',get_bloginfo('template_url').'/images/default_avatar.png'); ?>			
   	   			
   	   		<h5><?php comment_author_link(); ?></h5>
			<span class="date"><?php comment_date(); ?></span>
				
			<?php if ($comment->comment_approved == '0') : ?>
				<p><span class="message"><?php _e('Your comment is awaiting moderation.', 'themetrust'); ?></span></p>
			<?php endif; ?>
				
			<?php comment_text() ?>				
				
			<?php
			if(get_comment_type() != "trackback")
				comment_reply_link(array_merge( $args, array('add_below' => 'comment','reply_text' => '<span>'. __('Reply', 'themetrust') .'</span>', 'login_text' => '<span>'. __('Log in to reply', 'themetrust') .'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'])))
			
			?>
				
		</div><!-- end comment -->
			
<?php
}

function tombol_foss($a) {
	extract(shortcode_atts(array(
		'label' 	=> 'Button Text',
		'id' 	=> '1',
		'url'	=> '',
		'target' => '_parent',
		'size'	=> '',
		'ptag'	=> false
	), $a));
	
	$link = $url ? $url : get_permalink($id);	
	
	if($ptag) :
		return  wpautop('<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>');
	else :
		return '<a href="'.$link.'" target="'.$target.'" class="button '.$size.'">'.$label.'</a>';
	endif;
	
}
add_shortcode('button', 'tombol_foss');

register_nav_menus(array(
	"utama" => "Menu Utama Paling Atas"
));

$args = array(
	'width'         => 375,
	'height'        => 125,
	'default-image' => get_template_directory_uri() . '/images/logo.png',
);
add_theme_support( 'custom-header', $args );
add_theme_support( 'post-thumbnails' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'projects',
		array(
			'labels' => array(
				'name' => __( 'Projects' ),
				'singular_name' => __( 'Projects' )
			),
			'description' => 'Kumpulan Projek',
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'projects'),
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks','comments','post-formats', 'page-attributes', 'revisions')
		)
	);
	register_taxonomy('portfolio','projects',array(
		'label' => 'Portofolios',
		'labels' => array(
			'name' => __('Portofolios'),
			'singular_name' => __("Postofolio")
		),
		'public' => true,
		'hierarchical' => true,
		'rewrite' => array('slug' => 'portofolio')
	));
}


//sidebars
register_sidebar(array(
	'name' => __("Sidebar Kanan"),
	'id' => "sidebar-kanan",
	'description' => "Sidebar ini akan muncul pada bagian kanan tema",
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));
register_sidebar(array(
	'name' => __("Single Kanan"),
	'id' => "single-kanan",
	'description' => "Sidebar ini akan muncul pada kanan tulisan",
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));
register_sidebar(array(
	'name' => __("Search Sidebar"),
	'id' => "searchside",
	'description' => "Tampil di Hasil Search Konten",
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));
register_sidebar(array(
	'name' => __("Footer Home"),
	'id' => "footer1",
	'description' => "Footer Halaman Utama",
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));



//excerpt
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');


//contact method
function fossgrafis_contact( $contactmethods ) {
  $contactmethods['twitter'] = 'Twitter';
  $contactmethods['facebook'] = 'Facebook';
  $contactmethods['linkedin'] = 'Linkedin';
  $contactmethods['google_profile'] = 'Google Profile';
  return $contactmethods;
}
add_filter('user_contactmethods','fossgrafis_contact',10,1);

?>