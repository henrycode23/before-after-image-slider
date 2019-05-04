jQuery(document).ready(function(){


  //==================== Image Upload Single and Shows to Frontend ====================

  jQuery('#btn-before').on('click',function(){
    var imageBefore = wp.media({
      title: 'Upload Before image for BASlider',
      multiple: false
    }).open().on('select', function(){
      var uploadedBeforeImage = imageBefore.state().get('selection').first();
      var getBeforeImage = uploadedBeforeImage.toJSON().url;
      jQuery('#show-before').html('<img src="'+getBeforeImage+'" style="height:100px; width:100px;">');
      jQuery('#before_image').val(getBeforeImage);
    });
  });

  jQuery('#btn-after').on('click',function(){
    var imageAfter = wp.media({
      title: 'Upload After image for BASlider',
      multiple: false
    }).open().on('select', function(){
      var uploadedAfterImage = imageAfter.state().get('selection').first();
      var getAfterImage = uploadedAfterImage.toJSON().url;
      jQuery('#show-after').html('<img src="'+getAfterImage+'" style="height:100px; width:100px;">');
      jQuery('#after_image').val(getAfterImage);
    });
  });



  //==================== Book AJAX Requests, Post Data to DB ====================
  jQuery('#frmAddSlider').validate({
    submitHandler:function(){
      var postdata = 'action=basliderlibrary&param=save_slider&' + jQuery('#frmAddSlider').serialize();
      jQuery.post(basliderajaxurl, postdata, function(response){
        var data = jQuery.parseJSON(response);
        if( data.status == 1 ){
          jQuery.notifyBar({ 
            cssClass:'success', 
            html:data.message 
          }); 
        }else{

        }
      });
    }
  });

});