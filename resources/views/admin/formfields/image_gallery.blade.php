<div id="{{ $row->field }}" class="image-gallery">
	<div id="{{ $row->field }}_preview" class="gallery-container" data-inputfield="{{ $row->field }}_data_input">
		@if(isset($dataTypeContent->{$row->field}))
			@php
				$images = explode(',', $dataTypeContent->{$row->field});
			@endphp

			@foreach ($images as $image)
				<div class="gallery-item">
					<span data-src="{{ filter_var($image, FILTER_VALIDATE_URL) ? $image : Voyager::image( $image ) }}">X</span>
					<img src="{{ filter_var($image, FILTER_VALIDATE_URL) ? $image : Voyager::image( $image ) }}" />
				</div>
			@endforeach
		@endif
		<div class="add-to-gallery">
			<a id="{{ $row->field }}_lfm" data-input="{{ $row->field }}_data_input" data-preview="{{ $row->field }}_preview" class="btn btn-primary text-white addToGalleryBtn">+</a>
		</div>
	</div>
</div>
<input type="hidden" id="{{ $row->field }}_data_input" name="{{ $row->field }}" value="{{ $dataTypeContent->{$row->field} ?? '' }}">

@push('javascript')
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
	<script>

		var input = $('#' + $('.gallery-container').data('inputfield'));
		var newGalleryOrder = [];

		$('.gallery-container').sortable({
			cancel: ".add-to-gallery",
			update: function(event, ui){

				// var newGalleryOrder = [];
				var gallery = $('.gallery-container .gallery-item img');

				gallery.each(function(){
					newGalleryOrder.push($(this).attr('src'));
				});

				newGalleryOrder = newGalleryOrder.join(',');
				input.val(newGalleryOrder);
			}
		});

		$('.gallery-container').on('click', '.gallery-item span', function(){
			
			// remove deleted img url
			var newImgUrls = input.val().replace( $(this).data('src'), '' );

			// remove remaining comma
			newImgUrls = newImgUrls.replace(',,',',');

			// remove the first comma remaining
			if( newImgUrls.slice(0,1) === ',' ){
				newImgUrls = newImgUrls.substr(1);
			}

			// remove the last comma remaining
			if( newImgUrls.slice(-1) === ',' ){
				newImgUrls = newImgUrls.substr(0, newImgUrls.length - 1);
			}

			// set value
			input.val(newImgUrls);

			$(this).parent().remove();
		});
	</script>
@endpush
