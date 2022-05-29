(function( $ ){

  /**
   * Filemanager Stand Alone Button Function
   * @param type string image|file
   * @param options
   */
  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url
        target_input.val('').val(file_path).trigger('change');

        // clear previous preview
        target_preview.html('');

        // set or change the preview image src
        items.forEach(function (item) {
          target_preview.append(
            $('<img>').css('height', '5rem').attr('src', item.thumb_url)
          );
        });

        // trigger change event
        target_preview.trigger('change');
      };
      return false;
    });
  }

  /**
   * Filemanager Add Image To Gallery Function
   * @param type string image|file
   * @param options
   */
  $.fn.addToGallery = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (items) {
        var file_path = items.map(function (item) {
          return item.url;
        }).join(',');

        // add new image urls to previous image urls
        if(target_input.val()){
          file_path += ',' + target_input.val();
        }
        // set the value of the desired input to image urls
        target_input.val('').val(file_path).trigger('change');

        // set or change the preview image src
        items.forEach(function (item) {
          target_preview.prepend('<div class="gallery-item"><span data-src="'+item.thumb_url+'">X</span><img src="'+item.thumb_url+'" /></div>');
        });

        // trigger change event
        target_preview.trigger('change');
      };
      return false;
    });
  }

  /**
  * Run stand alone button function on custom button
  */
  $('a.sta-lfm-browse-btn').filemanager('image');

  /**
  * Run add to gallery function on custom button
  */
  $('.addToGalleryBtn').addToGallery('image');

  var $input = '';
  var $img_preview = '';
  $('.sta-lfm-upload-btn').each(function(){
    $(this).click(function(){
      $input = $('#'+$(this).attr('data-input'));
      $img_preview = $('#'+$(this).attr('data-preview'));
      $('#choose_file').trigger('click');
    })
  });

  $('#choose_file').change(function(){
    $('#single_upload').submit();
    var file = window.location.origin+'/uploads/'+$(this).val().match(/[-_\w]+[.][\w]+$/i)[0];
    console.log(file);
    $(this).val('');
    $input.val(file);
    $img_preview.delay(1500).html('<img src="'+file+'" style="max-height: 200px;" />');
    $input = '';
    $img_preview = '';
  });

})(jQuery);
