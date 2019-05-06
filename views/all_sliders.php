<?php
    global $wpdb;
    $all_slider = $wpdb->get_results(
        $wpdb->prepare(
          "SELECT * FROM ".baslider_table()." ORDER BY id DESC", ""
        )
    );

    // print_r($all_slider);
?>

<style>
img {
  width: 100px;
  height: 100px;
}
</style>

<h2>My Slider List</h2>
<table id="my-book" class="display" style="width:100%">
  <thead>
      <tr>
          <th>Sr No.</th>
          <th>Before Image</th>
          <th>After Image</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
    <?php
      if( count($all_slider) > 0 ){
        $serial_number_init = 1;
        foreach( $all_slider as $key => $value ){
          // access wp_users table via wp_my_students table column user_login_id
          $userdetails = get_userdata( $value->user_login_id );
    ?>
          <tr>
            <td><?php echo $serial_number_init++; ?></td>
            <td><img src="<?php echo $value->before_image; ?>" alt=""></td>
            <td><img src="<?php echo $value->after_image; ?>" alt=""></td>
            
            <td>
              <button class="btn btn-primary">Update</button>
              <button class="btn btn-danger">Delete</button>
            </td>
          </tr>
    <?php
        }
      }
    ?>
  </tbody>
</table>