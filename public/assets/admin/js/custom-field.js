$('.add-groupfield-btn').click(function(){
    $('.gf-modal').css('display', 'flex');
    add_groupfield_action();
});

$('.close-modal').click(function(){
    clear_customfield();
});

$(document).on('click', '.add-field-btn', function(){
    $group = $(this).data('group');
    $('.gf-modal').css('display', 'flex');
    add_field_action($group);
});

$(document).on('click', '.delete-gf-btn', function(){
    $('.group-field[data-group="'+$(this).data('group')+'"]').remove();
});

$(document).on('click', '.field-delete-btn', function(){
    $('.form-group[data-field="'+$(this).data('field')+'"]').remove();
});

$(document).on('click', '.gf-toggle', function(){
    $(this).toggleClass('gf-close');
    $('.group-field[data-group="'+$(this).data('group')+'"] .gf-body').slideToggle();
});

$('.add-customfield-btn').click(function(){

    if($(this).attr('data-role') == 'addgroup'){
        if($('#new_groupfield_name').val() != ''){
            $group = $('#new_groupfield_name').val();
            add_field_action($group);
        }else{
            $('#err_new_groupfield_name').text('Missing group field name');
        }
    }
    
    if($(this).attr('data-role') == 'addfield'){
        if($('#new_field_name').val()){
            $group = $(this).attr('data-group').replace(/[^a-zA-Z0-9]+/g,'_');
            $field = $('#new_field_name').val().replace(/[^a-zA-Z0-9]+/g,'_');
            $field_type = $('#new_field_type').val();
            console.log($group);
            console.log($field);
            console.log($field_type);
            insert_customfield($group, $field, $field_type);
            clear_customfield();
        }
        if( $('#new_field_name').val()=='' && !$(this).hasClass('add-to-groupfield')){
            $('#err_new_field_name').text('Missing field name');
        }
        if( $('#new_field_name').val() == '' ){
            $(this).removeClass('add-to-groupfield');
        }
    }
});

function add_field_action($group){
    $('.add-customfield-btn').text('Add');
    $('.add-customfield-btn').attr('data-role', 'addfield');
    $('.add-customfield-btn').attr('data-group', $group);
    $('.gf-modal .modal-title').text('New field to group ['+$group+']');
    $('#add-groupfield-form').hide();
    $('#add-field-form').show();
    $('#new_field_name').focus();
}

function add_groupfield_action(){
    $('.add-customfield-btn').text('Next');
    $('.add-customfield-btn').addClass('add-to-groupfield');
    $('.add-customfield-btn').attr('data-role', 'addgroup');
    $('.gf-modal .modal-title').text('New Group Field');
    $('#add-groupfield-form').show();
    $('#new_groupfield_name').focus();
}

function clear_customfield(){
    $('.gf-modal').hide();
    $('#add-field-form').hide();
    $('#add-groupfield-form').hide();
    $('.add-customfield-btn').removeClass('add-to-group')
    $('.add-customfield-btn').removeAttr('data-role');
    $('.add-customfield-btn').removeAttr('data-group');
    $('.add-customfield-btn').removeAttr('data-field');
    $('.gf-modal .modal-title').text('');
    $('#err_new_field_name').text('');
    $('#err_new_groupfield_name').text('');
    $('#new_groupfield_name').val('');
    $('#new_field_name').val('');
    $('#new_field_type').val('text');
}

$('#new_field_name').keyup(function(){
    $('#err_new_field_name').text('');
});

$('#new_groupfield_name').keyup(function(){
    $('#err_new_groupfield_name').text('');
});

function insert_customfield($group, $field, $field_type){

    var $group_label = $group.replace(/[^a-zA-Z0-9]+/g,' ');
    var $field_name = $group+'['+$field+']';
    var $field_label = $field.replace(/[^a-zA-Z0-9]+/g,' ');
    var $input_data = $field_name+'[data]';
    var $input_type = $field_name+'[type]';
    var $NewCustomField = '';
    
    if($('.group-field[data-group="'+$group+'"]').length){
        $NewCustomField = create_field_html($field, $field_name, $field_label, $input_data, $input_type);
        console.log($NewCustomField);        
        // insert new field to the end of the groupfield
        $('.group-field[data-group="'+$group+'"] .gf-body').append($NewCustomField);        

    }else{
        $NewCustomField = create_group_html($group, $group_label, $field, $field_name, $field_label, $input_data, $input_type);
        console.log($NewCustomField);
        $('#theCustomField').append($NewCustomField);
    }

    // Add class for next add field action not alert error
    $('.add-customfield-btn').addClass('add-to-groupfield');
    
    // render new editor with tinymce
    if( $field_type == 'editor' ){
        var editorId = '#'+$field;
        tinymce.init(window.voyagerTinyMCE.getConfig({selector: editorId, min_height: 200}));
    }
    if( $field_type == 'img' ){
        $('#'+$field+'_lfm').filemanager('image');
    }
}

function create_group_html($group, $group_label, $field, $field_name, $field_label, $input_data, $input_type){
    
    $html = '';

    $html += '<div class="group-field" data-group="'+$group+'">';
        $html += '<div class="group-field-head">';
            $html += '<h2 class="gf-title">'+$group_label+'</h2>';
            $html += '<div class="group-action-btn">';
                $html += '<a class="btn btn-primary add-field-btn" data-group="'+$group+'"><i class="voyager-plus"></i> Add field</a>&nbsp;';
                $html += '<a class="btn btn-danger delete-gf-btn" data-group="'+$group+'"><i class="voyager-trash"></i> Delete group</a>';
            $html += '</div>';
            $html += '<a class="gf-toggle" data-group="'+$group+'"><i class="voyager-angle-up"></i></a>';
        $html += '</div>';
        $html += '<div class="row row-no-gutters gf-body">';
            $html += create_field_html($field, $field_name, $field_label, $input_data, $input_type);
        $html += '</div>';
    $html += '</div>';
    
    return $html;
}

function create_field_html($field, $field_name, $field_label, $input_data, $input_type){

    $html = '';
    $html += '<div class="form-group col-md-12" data-field="'+$field_name+'">';
        $html += '<div class="single-field-head">';
            $html +='<div class="field-label">';
                $html += '<span>'+$field_label+'</span>&nbsp;<code>['+$group+']['+$field+']</code>';
            $html += '</div>';
            $html += '<a class="btn btn-sm btn-default field-delete-btn" data-field="'+$field_name+'"><i class="voyager-trash"></i></a>';
        $html += '</div>';
        $html += '<input type="hidden" name="'+$input_type+'" value="'+$field_type+'"></input>';
    
        if($field_type == 'text'){
            $html += '<input class="form-control" type="text" name="'+$input_data+'" value="">';
        }
        if( $field_type == 'editor' ){
            $html += '<textarea id="'+$field+'" class="form-control richTextBox newRTB" name="'+$input_data+'"></textarea>';
        }
        if( $field_type == 'img' ){
            $html += '<div class="input-group">';
                $html += '<span class="input-group-btn">';
                    $html += '<a id="'+$field+'_lfm" data-input="'+$field+'_data_input" data-preview="'+$field+'_preview" class="btn btn-primary text-white sta-lfm-browse-btn" style="margin-top: 0px !important;" onclick="filemanager(image)"><i class="fa fa-picture-o"></i>&nbsp;Browse</a>';
                    $html += '<a id="'+$field+'_upload_button" data-input="'+$field+'_data_input" data-preview="'+$field+'_preview" class="btn btn-primary text-white sta-lfm-upload-btn" style="margin-top: 0px !important;">Upload file</a>';                    
                $html += '</span>';
                $html += '<input id="'+$field+'_data_input" class="form-control" type="text" name="'+$input_data+'" value="">';
            $html += '</div>';
            $html += '<div id="'+$field+'_preview" class="image-preview"></div>';            
        }
        if( $field_type == 'button' ){
            $html += '<div class="field-type-button">';
                $html += '<input class="form-control" type="text" name="'+$input_data+'[btn_txt]" placeholder="Button text" value="">';
                $html += '<input class="form-control" type="text" name="'+$input_data+'[btn_url]" placeholder="http://example.com" value="">';
                $html += '<select name="'+$input_data+'[btn_target]" class="form-control">'
                    $html += '<option value="self" selected>Follow link</option>';
                    $html += '<option value="_blank">Open link in new tab</option>';
                $html += '</select>';
            $html += '</div>';
        }

    $html += '</div>';

    return $html;
}
