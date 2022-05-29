<div class="input-group">
	<span class="input-group-btn">
		<a id="{{ $row->field }}_lfm" data-input="{{ $row->field }}_data_input" data-preview="{{ $row->field }}_preview" class="btn btn-primary text-white sta-lfm-browse-btn" style="margin-top: 0px !important;">
			<i class="fa fa-picture-o"></i> Browse
		</a>
		<a id="{{ $row->field }}_upload_button" data-input="{{ $row->field }}_data_input" data-preview="{{ $row->field }}_preview" class="btn btn-primary text-white sta-lfm-upload-btn" style="margin-top: 0px !important;">
			Upload file
		</a>
	</span>
	<input id="{{ $row->field }}_data_input" class="form-control" type="text" name="{{ $row->field }}" value="{{ $dataTypeContent->{$row->field} ?? '' }}">
</div>
<div id="{{ $row->field }}_preview" class="sta-image-preview" style="margin-top: 10px;"">
	@if(isset($dataTypeContent->{$row->field}))
        <img src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image( $dataTypeContent->{$row->field} ) }}" style="max-height: 200px" />
    @endif
</div>

{{-- @once
	@push('javascript')
		<script type="text/javascript" src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
		<script>

			$('a.sta-lfm-browse-btn').filemanager('image');

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
				var file = '{{ url('') }}//storage/uploads/'+$(this).val().match(/[-_\w]+[.][\w]+$/i)[0];
				$(this).val('');
				$input.val(file);
				$img_preview.delay(1500).html('<img src="'+file+'" style="max-height: 200px;" />');
				$input = '';
				$img_preview = '';
			});

		</script>
	@endpush
@endonce --}}
