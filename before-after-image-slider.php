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

// ========== Constants ==========
if( !defined('ABSPATH') ) 
  exit;
if( !defined('BASLIDER_DIR_PATH') ) 
  define( 'BASLIDER_DIR_PATH', plugin_dir_path( __FILE__ ) );
if( !defined('BASLIDER_DIR_URL') )
  define( 'BASLIDER_DIR_URL', plugins_url(). "/before-after-image-slider" );



// ========== Assets ==========
function baslider_assets(){
  $slug = '';
  $page_includes = array( 'baslider', 'baslider-all-sliders');
  $current_page = $_GET['page'];

  if( empty($current_page) ){
    $actual_link = 'http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]';

    if( preg_match('/admin.php?page=baslider/', $actual_link) ){
      $current_page = 'baslider';
    }
  }

  if( in_array($current_page, $page_includes) ){
    wp_enqueue_style( 'bootstrap', BASLIDER_DIR_URL. '/assets/css/bootstrap.css', '' );
    wp_enqueue_style( 'datatable', BASLIDER_DIR_URL. '/assets/css/datatables.min.css', '' );
    wp_enqueue_style( 'notifybar', BASLIDER_DIR_URL. '/assets/css/jquery.notifyBar.css', '' );
    wp_enqueue_style( 'style', BASLIDER_DIR_URL. '/assets/css/style.css', '' );
  
    wp_enqueue_script( 'bootstrap.js', BASLIDER_DIR_URL. '/assets/js/bootstrap.js', '', true );
    wp_enqueue_script( 'datatables.min.js', BASLIDER_DIR_URL. '/assets/js/datatables.min.js', '', true );
    wp_enqueue_script( 'jquery.notifyBar.js', BASLIDER_DIR_URL. '/assets/js/jquery.notifyBar.js', '', true );
    wp_enqueue_script( 'validate.min.js', BASLIDER_DIR_URL. '/assets/js/jquery.validate.min.js', '', true );
    wp_enqueue_script( 'script.js', BASLIDER_DIR_URL. '/assets/js/script.js', '', true );
    wp_localize_script( 'script.js', 'basliderajaxurl', admin_url('admin-ajax.php') );
  }
}
add_action( 'init', 'baslider_assets' );



// ========== Menus  ==========
function baslider_custom_menu(){
  add_menu_page( 'Before and After Image Slider', 'BASlider', 'manage_options', 'baslider', 'baslider_admin', 'dashicons-admin-page', 3 );
  add_submenu_page( 'baslider', 'Add New', 'Add New', 'manage_options', 'baslider', 'add_new_slider' );
  add_submenu_page( 'baslider', 'All Sliders', 'All Sliders', 'manage_options', 'baslider-all-sliders', 'all_sliders' );
}
add_action( 'admin_menu', 'baslider_custom_menu' );



// ========== Views ==========
function baslider_admin(){}
function add_new_slider(){
  include_once BASLIDER_DIR_PATH. '/views/add_new.php';
}
function all_sliders(){
  include_once BASLIDER_DIR_PATH. '/views/all_sliders.php';
}



// ========== Auto Generate Tables ==========
function baslider_table(){
  global $wpdb;
  return $wpdb->prefix. 'basliders'; // wp_basliders
}

function baslider_generate_table(){
  global $wpdb;
  require_once ABSPATH. 'wp-admin/includes/upgrade.php';

  $sql = "CREATE TABLE `". baslider_table() ."` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `before_image` text NOT NULL,
    `after_image` text NOT NULL,
    `shortcode` text NOT NULL,
    PRIMARY KEY (`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
  dbDelta( $sql );
}
register_activation_hook( __FILE__, 'baslider_generate_table' );



// ========== Auto Drop Tables ==========
function baslider_drop_table(){
  global $wpdb;
  $wpdb->query("DROP TABLE IF EXISTS " . baslider_table());
}
register_deactivation_hook( __FILE__, 'baslider_drop_table' );



//==================== AJAX Requests Handler for Adding Book ====================
add_action( 'wp_ajax_basliderlibrary', 'baslider_ajax_handler' );
function baslider_ajax_handler(){
  global $wpdb;
  include_once BASLIDER_DIR_PATH.'/library/baslider_library.php';
  wp_die();
}