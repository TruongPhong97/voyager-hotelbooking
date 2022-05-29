<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site.title') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/pagebuilder/pagebuilder.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/pagebuilder/preset.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/pagebuilder/shell.css') }}">

    <script src="{{asset('assets/admin/js/jquery.3.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pagebuilder/main.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pagebuilder/plugins.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pagebuilder/pb-plugin.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pagebuilder/pb-custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.9.2/ckeditor.js"></script>
  </head>

  <body>

    {{-- Toast Alert --}}
    <div id="snackbar">Success!</div>

    {{-- The builder --}}
    <div id="gjs"></div>

  </body>

  <script type="text/javascript">
  
    function toast(message) {
        $("#snackbar").addClass("show");
        $("#snackbar").html(message);
        let $snackbar = $("#snackbar");
        setTimeout(function(){ $snackbar.removeClass("show"); }, 3000);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var images = [];

    var editor = grapesjs.init({
        avoidInlineStyle: 1,
        height: '100%',
        container : '#gjs',
        fromElement: 1,
        showOffsets: 1,
        assetManager: {
            storageType: '',
            storeOnChange: true,
            storeAfterUpload: true,
            upload: "{{url('assets/img/pagebuilder')}}", //for temporary storage
            assets: [],
            uploadFile: function(e) {
                // $(".request-loader").addClass("show");
                var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
                var formData = new FormData();
                for (var i in files) {
                    formData.append('files[]', files[i]) //containing all the selected images from local
                }

                $.ajax({
                    url: "{{route('pagebuilder.upload')}}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    crossDomain: true,
                    dataType: 'json',
                    mimeType: "multipart/form-data",
                    processData: false,
                    success: function(result) {
                        // $(".request-loader").removeClass("show");
                        $("#snackbar").css("background-color", "#5cb85c");
                        toast("Image uploaded successfully");
                        editor.AssetManager.add(result['data']); //adding images to asset
                    },
                    error: (error) => {
                        console.log((error));
                    }
                });
            },
        },
        selectorManager: { componentFirst: true },
        styleManager: { clearProperties: 1 },
        domComponents: { storeWrapper: 1 },
        plugins: [
          'grapesjs-lory-slider',
          'grapesjs-tabs',
          'grapesjs-custom-code',
          'grapesjs-touch',
          'grapesjs-parser-postcss',
          'grapesjs-tui-image-editor',
          'grapesjs-typed',
          'grapesjs-style-bg',
          'gjs-preset-webpage',
          'gjs-plugin-ckeditor',
          'gjs-component-countdown'
        ],
        pluginsOpts: {
          'grapesjs-lory-slider': {
            sliderBlock: {
              category: 'Extra'
            }
          },
          'gjs-plugin-ckeditor': {
            position: 'center',
            options: {
              extraPlugins: 'sharedspace,justify,colorbutton,panelbutton,font,bidi'
            }
          },
          'grapesjs-tabs': {
            tabsBlock: {
              category: 'Extra'
            }
          },
          'grapesjs-typed': {
            block: {
              category: 'Extra',
              content: {
                type: 'typed',
                'type-speed': 40,
                strings: [
                  'Text row one',
                  'Text row two',
                  'Text row three',
                ],
              }
            }
          },
        }          
    });

    editor.setComponents({!! $components !!});
    editor.setStyle({!! $style !!});

    editor.on('asset:remove', (asset) => {
        // $(".request-loader").addClass('show');
        let fd = new FormData();
        fd.append('path', asset.id);
        $.ajax({
            url: "{{route('pagebuilder.remove')}}",
            type: 'POST',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data) {
                $(".request-loader").removeClass('show');
                $("#snackbar").css("background-color", "#5cb85c");
                toast('Image removed successfully!');
                // console.log(data);
                // $('iframe').contents().find('.request-loader').remove();
            }
        });
    });

    editor.I18n.addMessages({
        en: {
            styleManager: {
                properties: {
                    'background-repeat': 'Repeat',
                    'background-position': 'Position',
                    'background-attachment': 'Attachment',
                    'background-size': 'Size',
                }
            },
        }
    });

    var pn = editor.Panels;
    var modal = editor.Modal;
    var cmdm = editor.Commands;
    cmdm.add('canvas-clear', function() {
        if(confirm('Areeee you sure to clean the canvas?')) {
            var comps = editor.DomComponents.clear();
            setTimeout(function(){ localStorage.clear()}, 0)
        }
    });
    cmdm.add('set-device-desktop', {
        run: function(ed) { ed.setDevice('Desktop') },
        stop: function() {},
    });
    cmdm.add('set-device-tablet', {
        run: function(ed) { ed.setDevice('Tablet') },
        stop: function() {},
    });
    cmdm.add('set-device-mobile', {
        run: function(ed) { ed.setDevice('Mobile portrait') },
        stop: function() {},
    });

     // Add info command
    var mdlClass = 'gjs-mdl-dialog-sm';
    var infoContainer = document.getElementById('info-panel');
    cmdm.add('open-info', function() {
        var mdlDialog = document.querySelector('.gjs-mdl-dialog');
        mdlDialog.className += ' ' + mdlClass;
        infoContainer.style.display = 'block';
        modal.setTitle('About this demo');
        modal.setContent(infoContainer);
        modal.open();
        modal.getModel().once('change:open', function() {
            mdlDialog.className = mdlDialog.className.replace(mdlClass, '');
        })
    });

    pn.addButton('options', {
        id: 'open-info',
        className: 'fa fa-question-circle',
        command: function() { editor.runCommand('open-info') },
        attributes: {
          'title': 'About',
          'data-tooltip-pos': 'bottom',
        },
    });

    // Add and beautify tooltips
    [
        ['sw-visibility', 'Show Borders'],
        ['preview', 'Preview'],
        ['fullscreen', 'Fullscreen'],
        ['export-template', 'Export'],
        ['undo', 'Undo'],
        ['redo', 'Redo'],
        ['gjs-open-import-webpage', 'Import'],
        ['canvas-clear', 'Clear canvas']
    ].forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
    });

    [
        ['open-sm', 'Style Manager'],
        ['open-layers', 'Layers'],
        ['open-blocks', 'Blocks']
    ].forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title: item[1], 'data-tooltip-pos': 'bottom'});
    });

    var titles = document.querySelectorAll('*[title]');

    for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim(): '';
        if(!title)
        break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
    }

    // Show borders by default
    pn.getButton('options', 'sw-visibility').set('active', 1);

    // add save button in button panel
    var pnm = editor.Panels;
    pnm.addButton(
        'options',
        [
            {
                id: 'save-database',
                className: 'fa fa-floppy-o',
                command: 'save-database',
                attributes: {
                    title: 'Save to database'
                }
            }
        ]
    );

    // save content to database
    cmdm.add('save-database', {
        run: function (em, sender) {
            // $(".request-loader").addClass("show");
            sender.set('active', true);
            
            var components = JSON.stringify(editor.getComponents());
            var styles = JSON.stringify(editor.getStyle());
            
            var html = editor.getHtml();
            var css = editor.getCss();
            
            let fd = new FormData();
            // fd.append('type', "{{request()->input('type')}}");
            fd.append('id', "{{request()->page_id}}");
            fd.append('components', components);
            fd.append('styles', styles);
            fd.append('html', html);
            fd.append('css', css);

            $.ajax({
                url: "{{route('pagebuilder.save')}}",
                method: 'POST',
                data: fd,
                contentType: false,
                // contentType: 'json',
                processData: false,
                success: function(data) {
                    // $(".request-loader").removeClass("show");
                    $("#snackbar").css("background-color", "#5cb85c");
                    toast('Content updated successfully!');
                    console.log(data);
                },
                error: (error) => {
                     console.log((error));
                }
            });
        },
    });

  </script>

</html>
