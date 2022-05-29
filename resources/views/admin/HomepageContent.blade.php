@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', 'Edit Homepage Content')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-browser"></i>
        @lang('Homepage Content')
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="{{ route('homepage.content.update') }}" method="POST" enctype="multipart/form-data">
                        <!-- CSRF TOKEN -->
                        @csrf
                        @method('PUT')

                        {{-- Panel Body Start --}}
                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Custom Field List Start --}}
                            <div id="theCustomField">

                                {{-- Group Fields Loop Start --}}
                                @foreach ($data as $groupfield => $fields)
                                    <div class="group-field" data-group="{{$groupfield}}">

                                        <div class="group-field-head">
                                            <h2 class="gf-title">{{str_replace('_', ' ', $groupfield)}}</h2>
                                            <div class="group-action-btn">
                                                <a class="btn btn-primary add-field-btn" data-group="{{$groupfield}}"><i class="voyager-plus"></i> Add field</a>
                                                <a class="btn btn-danger delete-gf-btn" data-group="{{$groupfield}}"><i class="voyager-trash"></i> Delete group</a>
                                            </div>
                                            <a class="gf-toggle" data-group="{{$groupfield}}"><i class="voyager-angle-up"></i></a>
                                        </div>

                                        <div class="row row-no-gutters gf-body">
                                            {{-- The Field Loop Start --}}
                                            @foreach ($fields as $field => $content)
                                                <div class="form-group col-md-12" data-field="{{$groupfield}}[{{$field}}]">
                                                    <div class="single-field-head">
                                                        <div class="field-label">
                                                            <span>{{str_replace('_', ' ', $field)}}</span>&nbsp;<code>[{{$groupfield}}][{{$field}}]</code>
                                                        </div>
                                                        <a class="btn btn-sm btn-default field-delete-btn" data-field="{{$groupfield}}[{{$field}}]"><i class="voyager-trash"></i></a>
                                                    </div>

                                                    <input type="hidden" name="{{$groupfield}}[{{$field}}][type]" value="{{ $content['type'] }}">

                                                    @if($content['type'] == 'text')
                                                        <input class="form-control" type="text" name="{{$groupfield}}[{{$field}}][data]" value="{{$content['data']}}">
                                                    @endif

                                                    @if($content['type'] == 'editor')
                                                        <textarea class="form-control richTextBox" name="{{$groupfield}}[{{$field}}][data]"">
                                                            {!! $content['data'] !!}
                                                        </textarea>
                                                    @endif

                                                    @if($content['type'] == 'img')
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <a id="{{$field}}_lfm" data-input="{{$field}}_data_input" data-preview="{{$field}}_preview" class="btn btn-primary text-white sta-lfm-browse-btn" style="margin-top: 0px !important;">
                                                                    <i class="fa fa-picture-o"></i> Browse
                                                                </a>
                                                                <a id="{{$field}}_upload_button" data-input="{{$field}}_data_input" data-preview="{{$field}}_preview" class="btn btn-primary text-white sta-lfm-upload-btn" style="margin-top: 0px !important;">
                                                                    Upload file
                                                                </a>
                                                            </span>
                                                            <input id="{{$field}}_data_input" class="form-control" type="text" name="{{$groupfield}}[{{$field}}][data]" value="{{$content['data']}}">
                                                        </div>
                                                        <div id="{{$field}}_preview" class="sta-image-preview">
                                                            @if ($content['data'])
                                                                <img src="{{$content['data']}}">
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if($content['type'] == 'button')
                                                        <div class="field-type-button">
                                                            <input class="form-control" type="text" name="{{$groupfield}}[{{$field}}][data][btn_txt]" placeholder="Button text" value="{{$content['data']['btn_txt']}}">
                                                            <input class="form-control" type="text" name="{{$groupfield}}[{{$field}}][data][btn_url]" placeholder="http://example.com" value="{{$content['data']['btn_url']}}">
                                                            <select name="{{$groupfield}}[{{$field}}][data][btn_target]" class="form-control">
                                                                <option value="self" @if($content['data']['btn_target'] == 'self') selected @endif>Follow button link</option>
                                                                <option value="_blank" @if($content['data']['btn_target'] == '_blank') selected @endif>Open link in new tab</option>
                                                            </select>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach                                    
                                            {{-- The Field Loop End --}}
                                        </div>
                                    </div>
                                @endforeach
                                {{-- Group Fields Loop End --}}
                            
                            </div>
                            {{-- Custom Field List End --}}
                            
                        </div>
                        {{-- Panel Body End --}}

                        <a class="btn btn-primary add-groupfield-btn"><i class="voyager-plus"></i>Add New Group</a>

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>
                    <!-- form end -->

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="pages">
                        {{ csrf_field() }}
                    </form>

                    <form id="single_upload" action="{{ route('uploadFile') }}" target="form_target" method="post" enctype="multipart/form-data" hidden="hidden">
                        <input name="image" id="choose_file" type="file">
                        <input type="hidden" name="type_slug" id="type_slug" value="pages">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal gf-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center">Add field to <span class="gf-to-add"></span></h4>
                </div>

                <div id="add-field-form" style="display: none">
                    <div class="form-group col-md-12">
                        <label>Field name</label>
                        <br>
                        <span id="err_new_field_name" class="error"></span>
                        <input type="text" id="new_field_name" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Field type</label>
                        <select id="new_field_type" class="form-control">
                            <option value="text">Text</option>
                            <option value="editor">Editor</option>
                            <option value="img">Image</option>
                            <option value="button">Button</option>
                        </select>
                    </div>
                </div>

                <div id="add-groupfield-form" style="display: none">
                    <div class="form-group col-md-12">
                        <label>Group Field Name</label>
                        <br>
                        <span id="err_new_groupfield_name" class="error"></span>
                        <input type="text" id="new_groupfield_name" class="form-control">
                    </div>
                </div>

                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-default close-modal">Cancel</button>
                    <button type="button" class="btn btn-primary add-customfield-btn">Add</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection
    
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/homepage-content.css') }}">
@endpush
    
@once
    @push('javascript')
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script type="text/javascript" src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/admin/js/custom-field.js') }}"></script>
        <script>
        $(document).ready(function() {

            $('#theCustomField').sortable({
                cancel: ".gf-body"
            });

            // Custom TinyMCE Config
            var additionalConfig = {
                selector: '.richTextBox',
                min_height: 200,
                // file_browser_callback : function(field_name, url, type, win) {
                //     var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                //     var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                //     var cmsURL = '/laravel-filemanager?field_name=' + field_name;
                //     if (type == 'image') {
                //     cmsURL = cmsURL + "&type=Images";
                //     } else {
                //     cmsURL = cmsURL + "&type=Files";
                //     }

                //     tinyMCE.activeEditor.windowManager.open({
                //         file : cmsURL,
                //         title : 'Filemanager',
                //         width : x * 0.8,
                //         height : y * 0.8,
                //         resizable : "yes",
                //         close_previous : "no"
                //     });
                // }
            }
            $.extend(additionalConfig, {!! json_encode($options->tinymceOptions ?? '{}') !!});
            tinymce.init(window.voyagerTinyMCE.getConfig(additionalConfig));
        });

        // Custom "LaravelFilemanager - stand-alone-button" script
        $('a.sta-lfm-browse-btn').filemanager('image');

        var $input = '';
        var $img_preview = '';
        // $('.sta-lfm-upload-btn').each(function(){
        $(document).on('click', '.sta-lfm-upload-btn', function(){
            // $(this).click(function(){
                $input = $('#'+$(this).attr('data-input'));
                $img_preview = $('#'+$(this).attr('data-preview'));
                $('#choose_file').trigger('click');
            // });
        });

        $('#choose_file').change(function(){
            $('#single_upload').submit();
            var file = '{{ url('') }}//storage/uploads/'+$(this).val().match(/[-_\w]+[.][\w]+$/i)[0];
            $(this).val('');
            $input.val(file);
            $img_preview.delay(1500).html('<img src="'+file+'" />');
            $input = '';
            $img_preview = '';
        });
        
        </script>
    @endpush
@endonce
