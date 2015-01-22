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