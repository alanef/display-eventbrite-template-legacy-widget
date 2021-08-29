<?php

/*
Plugin Name: Display Eventbrite Legacy Widget Template & CSS
Plugin URI: https://github.com/alanef/display-eventbrite-template-legacy-widget
Description: Legcay Widget as prior to v 3.0 of Display Eventbrite
Version: 1.1
Author: alan
Author URI: https://fullworks.net
License: GPL2

No warranty, no unpaid support


*/

if ( ! defined( 'WPINC' ) ) {
	die;
}
add_filter( 'widget-for-eventbrite-api_template_paths', function ( $file_paths ) {
	$file_paths[40] = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'templates';

	return $file_paths;
}, 90 );

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'wfea-legacy-widget-style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
	}
);
