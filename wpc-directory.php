<?php

/*
Plugin Name: WPB Custom Extension
Plugin URI: https://www.ahmedimran.net/
Description: An extension for Visual Composer that display image and title with link option
Author: Ahmed Imran
Version: 1.0.0
Author URI: https://www.ahmedimran.net/
*/


// If this file is called directly, abort

if ( ! defined( 'ABSPATH' ) ) {
     die ('Silly human what are you doing here');
}


// Before VC Init

add_action( 'vc_before_init', 'wpc_vc_before_init_actions' );

function wpc_vc_before_init_actions() {

// Require new custom Element

include( plugin_dir_path( __FILE__ ) . 'vc-directory-element.php');

}

// Link directory stylesheet

function wpc_community_directory_scripts() {
    wp_enqueue_style( 'wpc_community_directory_stylesheet',  plugin_dir_url( __FILE__ ) . 'styling/directory-styling.css' );
}
add_action( 'wp_enqueue_scripts', 'wpc_community_directory_scripts' );
