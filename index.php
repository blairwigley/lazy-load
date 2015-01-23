<?php 
defined('ABSPATH') or die("..");
    /*
    Plugin Name: Blair's Lazyload
    Plugin URI: http://www.optimising.com.au
    Description: Changes all images to use MooTools lazyload. Built upon 
    Author: Blair Wigley
    Version: 1.0
    Author URI: https://www.optimising.com.au 
    */


// add lazyload to images
function lazyload_change ($content)
{   global $post;
    $pattern = "/\<img (.*).*src=\"(.*\.jpg|gif|png|svg)\"(.*)\/?\>/";
    $replacement = '<img $1data-src="$2" src="//cdnjs.cloudflare.com/ajax/libs/galleriffic/2.0.1/css/loader.gif"$3/>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

add_filter('the_content', 'lazyload_change', 12);

add_filter('get_comment_text', 'lazyload_change');


//register and enqueue scripts
function lazyload_scripts() {
	if (!is_admin()){
		wp_register_script('mootools', '//ajax.googleapis.com/ajax/libs/mootools/1.3.2/mootools.js', array(), null, 'all' );
		wp_enqueue_script( 'mootools' );

		wp_register_script('lazyload-script', plugin_dir_url( __FILE__ ) . 'inc/js/LazyLoad.js' , array(), null, 'all' );
		wp_enqueue_script( 'lazyload-script' );

		wp_register_script('init-script', plugin_dir_url( __FILE__ ) . 'inc/js/script.js' , array(), null, 'all' );
		wp_enqueue_script( 'init-script' );

	}
}

add_action( 'wp_enqueue_scripts', 'lazyload_scripts' );

?>