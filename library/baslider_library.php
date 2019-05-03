<?php
if( $_REQUEST['param'] == 'save_slider' ){
  $wpdb->insert( baslider_table(), array(
    'before_image' => $_REQUEST['before_image'],
    'after_image' => $_REQUEST['after_image']
  ) );
  echo json_encode( array('status' => 1, 'message' => 'Slider created successfully') );
}