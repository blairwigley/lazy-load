<?php 
defined('ABSPATH') or die("..");
    /*
    Plugin Name: Optimising.com.au Lazyload
    Plugin URI: http://www.optimising.com.au
    Description: Changes all images to use MooTools lazyload. 
    Author: Blair Wigley
    Version: 1.0
    Author URI: https://www.optimising.com.au 
    */


if ( strpos($_SERVER['REQUEST_URI'], 'wp-admin') === false ) {
        add_action('template_redirect','ob_start_lazy_load');    
}


function ob_start_lazy_load() {
    ob_start('lazyload_change');
}


function lazyload_change ($content)
{   
    $content = preg_replace("/img(.*)src=\"(.*\.jpg|gif|svg|png)\"(.*)/im", "img data-src=\"$2\" $1 $3", $content);
    return $content; 
} 

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