<?php
/**
* @package Before After Image Slider
*/
/*
Plugin Name: Before After Image Slider
Plugin URI: https://facebook.com/jackhenry.sadang
Description: This is my own wordpress plugin. Before and After Image Slider with CRUD shortcode functionality.
Version: 1.0.0
Author: Jack Henry Sadang
Author URI: https://facebook.com/jackhenry.sadang
License: GPLv2 or later
Text Domain: custom-plugin
*/

define( 'BASLIDER_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'BASLIBER_DIR_URL', plugin_dir_url( __FILE__ ) );

function baslider_custom_menu(){
  add_menu_page( 
    'Before and After Image Slider', // page title
    'BASlider', // menu title
    'manage_options', // capability
    'baslider', // menu slug
    'baslider_admin', // callable view func
    'dashicons-admin-page',
    3
  );
  add_submenu_page( 'baslider', 'Add New', 'Add New', 'manage_options', 'baslider', 'add_new_slider' );
  add_submenu_page( 'baslider', 'All Sliders', 'All Sliders', 'manage_options', 'baslider-all-sliders', 'all_sliders' );
}
add_action( 'admin_menu', 'baslider_custom_menu' );



function baslider_admin(){
  
}
function add_new_slider(){
  include_once BASLIDER_DIR_PATH. '/views/add_new.php';
}
function all_sliders(){
  include_once BASLIDER_DIR_PATH. '/views/all_sliders.php';
}