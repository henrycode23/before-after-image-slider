<?php wp_enqueue_media(); ?>

<style>
#btn-after {
  letter-spacing: 1px;
}
#frmAddSlider {
  margin-top: 50px;
}
.form-group {
  margin-bottom: 100px;
}
</style>

<form action="javascript:void(0)" id="frmAddSlider">
  <div class="form-group">
    <input type="button" id="btn-before" class="btn btn-info" value="Before Image">
    <span id="show-before"></span>
    <input type="hidden" id="before_image" name="before_image">
  </div>
  <div class="form-group">
    <input type="button" id="btn-after" class="btn btn-success" value="After Image">
    <span id="show-after"></span>
    <input type="hidden" id="after_image" name="after_image">
  </div>
  <div class="form-group"> 
    <button type="submit" class="btn btn-primary">Add Slider</button>
  </div>
</form>