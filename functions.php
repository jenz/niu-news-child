<?php
/**
 * Set Parent/Child Styles
 *
 */ 
add_action( 'wp_enqueue_scripts', 'niu_child_theme_enqueue_styles' );
function niu_child_theme_enqueue_styles() {
 	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );   
 	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css?v'.time(), array('gridbox-stylesheet' ), wp_get_theme()->get('Version'));
}

/**
 * Add in the Favicon
 *
 */ 
add_action( 'wp_head', 'niu_child_theme_favicon' );
function niu_child_theme_favicon() {
    echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('wpurl').'/favicon.ico" />';
}

/**
 * Set the footer text to always have the correct year
 *
 */ 
add_filter( 'gridbox_footer_text', 'niu_child_theme_copyright_update' );
function niu_child_theme_copyright_update() {
	echo 'Copyright &copy; '.date('Y').' Board of Trustees of Northern Illinois University. All rights reserved.';
}


/**
 * Display featured post thumbnails in WordPress feeds
 * @param $content (string)
*/
add_filter( 'the_excerpt_rss', 'niu_child_theme_custom_feed_with_image' );
add_filter( 'the_content_feed', 'niu_child_theme_custom_feed_with_image' );
function niu_child_theme_custom_feed_with_image( $content ) {
    global $post;
    if( has_post_thumbnail( $post->ID ) ) {
        $content = '<p class="post-thumbnail">' . get_the_post_thumbnail( $post->ID, 'thumbnail' ) . '</p>' . $content;
    }
    return $content;
}

/**
 * Remove the "Category:" from the archive title
 *
*/
add_filter('get_the_archive_title_prefix','__return_false');