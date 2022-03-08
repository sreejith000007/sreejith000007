<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('/css/toastr.min.css') }}">
    <link rel="stylesheet" href="https://grapesjs.com/stylesheets/grapes.min.css?v0.17.26">
    <link rel="stylesheet" href="https://grapesjs.com/stylesheets/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="{{ asset('css/tooltip.css') }}">
    <link rel="stylesheet" href="https://grapesjs.com/stylesheets/grapesjs-plugin-filestack.css">
    <link rel="stylesheet" href="https://grapesjs.com/stylesheets/demos.css?v3">
    <link href="https://unpkg.com/grapick/dist/grapick.min.css" rel="stylesheet">
    <link href="{{ asset('css/grapesjs-component-code-editor.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/grapesjs-rte-extensions.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('/js/toastr.min.js') }}"></script>
    <script src="https://grapesjs.com/js/grapes.min.js?v0.17.26"></script>
    <script src="https://grapesjs.com/js/grapesjs-preset-webpage.min.js?v0.1.11"></script>
    <script src="{{ asset('/js/grapesjs-custom-code.min.js') }}"></script>
    <script src="{{ asset('/js/grapesjs-style-bg.min.js') }}"></script>
    <script src="{{ asset('/js/grapesjs-component-code-editor.min.js') }}"></script>
    <script src="{{ asset('/js/grapesjs-plugin-export.min.js') }}"></script>
    <script src="{{ asset('/js/grapesjs-blocks-flexbox.min.js') }}"></script>
    <script src='https://cdn.ckeditor.com/4.6.2/full/ckeditor.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('/js/grapesjs-rte-extensions.min.js') }}"></script>
    {{-- toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src="{{ asset('/js/grapesjs-plugin-forms.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

<body>
    <div id="gjs" style="height: 100%; min-height: 700px; overflow: hidden">
        <?php
        echo $content . "\n";
        echo '<style>' . "\n";
        echo $style . "\n";
        echo '</style>' . "\n";
        ?>

    </div>
    <script>
        var editor = grapesjs.init({
            avoidInlineStyle: 1,
            allowScripts: 1,
            height: '100%',
            container: '#gjs',
            fromElement: 1,
            storageManager: 1,
            forceClass: true,
            //pageManager: true,
            showOffsets: 1,
            storageType: '',
            storeOnChange: true,
            storeAfterUpload: true,
            mediaCondition: 'min-width', // default is `max-width`
            canvas: {
                styles: [

                    'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css',
                    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',


                ],
                scripts: [
                    'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
                    'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',
                    'https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js',
                    'https://cdn.ckeditor.com/4.6.2/full/ckeditor.js',

                ],
            },


            assetManager: {
                storageType: '',
                storeOnChange: true,
                storeAfterUpload: true,
                upload: 'img', //for temporary storage
                uploadName: 'files',
                multiUpload: true,
                uploadFile: function(e) {
                    var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
                    var formData = new FormData();
                    for (var i in files) {
                        formData.append('file-' + i, files[
                            i]); //containing all the selected images from local
                    }
                    $.ajax({
                        url: 'upImage.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        crossDomain: true,
                        dataType: 'json',
                        mimeType: "multipart/form-data",
                        processData: false,
                        success: function(result) {
                            var myJSON = [];
                            $.each(result['data'], function(key, value) {
                                myJSON[key] = value;
                            });
                            var images = myJSON;
                            editor.AssetManager.add(
                                images); //adding images to asset manager of GrapesJS
                        }
                    });
                }
            },



            // Set initial device as Mobile


            components: '<div class="txt-red">Hello world!</div>',
            style: '.txt-red{color: red}',
            // Default configurations
            storageManager: {
                id: 'gjs-', // Prefix identifier that will be used on parameters
                type: 'remote', //type: 'local', type: 'remote',Type of the storage
                autosave: false, // Store data automatically
                autoload: true, // Autoload stored data on init
                //urlStore: 'store.php?id=',
                //urlLoad: 'load.php?id=',
                contentTypeJson: false,
                storeComponents: true,
                storeStyles: true,
                storeHtml: true,
                storeCss: true,
                autorender: true,
                forceClass: false,
                dragMode: 'absolute',
            },
            deviceManager: {
                devices: [{
                        name: 'Desktop',
                        width: '', // default size
                    }, {
                        name: 'Mobile',
                        width: '320px', // this value will be used on canvas width
                        widthMedia: '480px', // this value will be used in CSS @media
                    },
                    {
                        name: 'Tablet',
                        width: '768px', // this value will be used on canvas width
                        widthMedia: '810px', // this value will be used in CSS @media
                    },
                    {
                        name: 'Samsung',
                        width: '320px', // this value will be used on canvas width
                        widthMedia: '480px', // this value will be used in CSS @media
                    },
                    {
                        name: 'Iphone',
                        width: '320px', // this value will be used on canvas width
                        widthMedia: '480px', // this value will be used in CSS @media
                    }
                ]
            },
            panels: {
                defaults: [
                    // ...
                    {
                        id: 'panel-devices',
                        el: '.panel__devices',
                        buttons: [{
                                id: 'device-desktop',
                                label: 'D',
                                command: 'set-device-desktop',
                                active: true,
                                togglable: false,
                            }, {
                                id: 'device-mobile',
                                label: 'M',
                                command: 'set-device-mobile',
                                togglable: false,
                            },
                            {
                                id: 'device-tablet',
                                label: 'T',
                                command: 'set-device-tablet',
                                togglable: false,
                            },
                            {
                                id: 'device-samsung',
                                label: 'S',
                                command: 'set-device-samsung',
                                togglable: false,
                            },
                            {
                                id: 'device-iphone',
                                label: 'I',
                                command: 'set-device-iphone',
                                togglable: false,
                            }
                        ],
                    }
                ]
            },

            styleManager: {
                clearProperties: 1
            },
            plugins: [
                'grapesjs-custom-code',
                'gjs-preset-webpage',
                'grapesjs-component-code-editor',
                'grapesjs-plugin-export',
                'grapesjs-rte-extensions',
                'grapesjs-plugin-forms',

            ],
            pluginsOpts: {
            'grapesjs-plugin-forms': {/* ...options */},
                'grapesjs-plugin-export': {
                    btnLabel: '<i class="fa fa-download" aria-hidden="true"></i>',
                    root: {
                        css: {
                            'style.css': editor => editor.getCss(),
                            'custom.css': editor => "<style></style>",
                            img: async editor => {
                                const images = await readImgsCSS(editor);
                                return images;
                            },
                        },
                        img: async editor => {
                            const images = await readImgs(editor);
                            return images;
                        },

                        'index.html': editor => `
                        <head>                        
                            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">                            
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"> 
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
                            <link rel="stylesheet" href="./css/style.css">
                            <script src='https://cdn.ckeditor.com/4.6.2/full/ckeditor.js'><\/script>  
                            <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js'><\/script>                         
		                </head>
	                    <body>
                        ${editor.getHtml()}
                        </body>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'><\/script>
                        <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js'><\/script>
                        <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js'><\/script>
               `
                    }
                },
                'grapesjs-component-code-editor': {
                    panelId: 'views-container'
                },
                'grapesjs-custom-code': {
                    blockLabel: 'Custom code',
                    category: 'Extra',
                    droppable: false,
                    modalTitle: 'Insert your code',
                    buttonLabel: 'Save'
                },
                'gjs-preset-webpage': {
                    modalImportTitle: 'Import Template',
                    modalImportLabel: '<div style="margin-bottom: 10px; font-size: 13px;">Paste here your HTML/CSS and click Import</div>',
                    modalImportContent: function(editor) {
                        return editor.getHtml() + '<style>' + editor.getCss() + '</style>';
                    },
                    filestackOpts: null, //{ key: 'AYmqZc2e8RLGLE7TGkX3Hz' },
                    aviaryOpts: false,
                    blocksBasicOpts: {
                        flexGrid: 1
                    },
                    customStyleManager: [{
                        name: 'General',
                        buildProps: ['float', 'display', 'position', 'top', 'right', 'left', 'bottom'],
                        properties: [{
                                name: 'Alignment',
                                property: 'float',
                                type: 'radio',
                                defaults: 'none',
                                list: [{
                                        value: 'none',
                                        className: 'fa fa-times'
                                    },
                                    {
                                        value: 'left',
                                        className: 'fa fa-align-left'
                                    },
                                    {
                                        value: 'right',
                                        className: 'fa fa-align-right'
                                    }
                                ]
                            },
                            {
                                property: 'position',
                                type: 'select'
                            }
                        ]
                    }, {
                        name: 'Dimension',
                        open: false,
                        buildProps: ['width', 'flex-width', 'height', 'max-width', 'min-height',
                            'margin', 'padding'
                        ],
                        properties: [{
                            id: 'flex-width',
                            type: 'integer',
                            name: 'Width',
                            units: ['px', '%'],
                            property: 'flex-basis',
                            toRequire: 1
                        }, {
                            property: 'margin',
                            properties: [{
                                    name: 'Top',
                                    property: 'margin-top'
                                },
                                {
                                    name: 'Right',
                                    property: 'margin-right'
                                },
                                {
                                    name: 'Bottom',
                                    property: 'margin-bottom'
                                },
                                {
                                    name: 'Left',
                                    property: 'margin-left'
                                }
                            ]
                        }, {
                            property: 'padding',
                            properties: [{
                                    name: 'Top',
                                    property: 'padding-top'
                                },
                                {
                                    name: 'Right',
                                    property: 'padding-right'
                                },
                                {
                                    name: 'Bottom',
                                    property: 'padding-bottom'
                                },
                                {
                                    name: 'Left',
                                    property: 'padding-left'
                                }
                            ]
                        }]
                    }, {
                        name: 'Typography',
                        open: false,
                        buildProps: ['font-family', 'font-size', 'font-weight', 'letter-spacing',
                            'color', 'line-height', 'text-align', 'text-decoration', 'text-shadow'
                        ],
                        properties: [{
                                name: 'Font',
                                property: 'font-family'
                            },
                            {
                                name: 'Weight',
                                property: 'font-weight'
                            },
                            {
                                name: 'overlay',
                                property: ''
                            },
                            {
                                name: 'Font color',
                                property: 'color'
                            },
                            {
                                property: 'text-align',
                                type: 'radio',
                                defaults: 'left',
                                list: [{
                                        value: 'left',
                                        name: 'Left',
                                        className: 'fa fa-align-left'
                                    },
                                    {
                                        value: 'center',
                                        name: 'Center',
                                        className: 'fa fa-align-center'
                                    },
                                    {
                                        value: 'right',
                                        name: 'Right',
                                        className: 'fa fa-align-right'
                                    },
                                    {
                                        value: 'justify',
                                        name: 'Justify',
                                        className: 'fa fa-align-justify'
                                    }
                                ]
                            },

                            {
                                property: 'text-decoration',
                                type: 'radio',
                                defaults: 'none',
                                list: [{
                                        value: 'none',
                                        name: 'None',
                                        className: 'fa fa-times'
                                    },
                                    {
                                        value: 'underline',
                                        name: 'underline',
                                        className: 'fa fa-underline'
                                    },
                                    {
                                        value: 'line-through',
                                        name: 'Line-through',
                                        className: 'fa fa-strikethrough'
                                    }
                                ]
                            }, {
                                property: 'text-shadow',
                                properties: [{
                                        name: 'X position',
                                        property: 'text-shadow-h'
                                    },
                                    {
                                        name: 'Y position',
                                        property: 'text-shadow-v'
                                    },
                                    {
                                        name: 'Blur',
                                        property: 'text-shadow-blur'
                                    },
                                    {
                                        name: 'Color',
                                        property: 'text-shadow-color'
                                    }
                                ]
                            }
                        ]
                    }, {
                        name: 'Decorations',
                        open: false,
                        buildProps: ['opacity', 'background-color', 'border-radius', 'border',
                            'box-shadow', 'background'
                        ],
                        properties: [{
                            type: 'slider',
                            property: 'opacity',
                            defaults: 1,
                            step: 0.01,
                            max: 1,
                            min: 0
                        }, {
                            property: 'border-radius',
                            properties: [{
                                    name: 'Top',
                                    property: 'border-top-left-radius'
                                },
                                {
                                    name: 'Right',
                                    property: 'border-top-right-radius'
                                },
                                {
                                    name: 'Bottom',
                                    property: 'border-bottom-left-radius'
                                },
                                {
                                    name: 'Left',
                                    property: 'border-bottom-right-radius'
                                }
                            ]
                        }, {
                            property: 'box-shadow',
                            properties: [{
                                    name: 'X position',
                                    property: 'box-shadow-h'
                                },
                                {
                                    name: 'Y position',
                                    property: 'box-shadow-v'
                                },
                                {
                                    name: 'Blur',
                                    property: 'box-shadow-blur'
                                },
                                {
                                    name: 'Spread',
                                    property: 'box-shadow-spread'
                                },
                                {
                                    name: 'Color',
                                    property: 'box-shadow-color'
                                },
                                {
                                    name: 'Shadow type',
                                    property: 'box-shadow-type'
                                }
                            ]
                        }, {
                            property: 'background',
                            properties: [{
                                    name: 'Image',
                                    property: 'background-image'
                                },
                                {
                                    name: 'Repeat',
                                    property: 'background-repeat'
                                },
                                {
                                    name: 'Position',
                                    property: 'background-position'
                                },
                                {
                                    name: 'Attachment',
                                    property: 'background-attachment'
                                },
                                {
                                    name: 'Size',
                                    property: 'background-size'
                                }
                            ]
                        }]
                    }, {
                        name: 'Extra',
                        open: false,
                        buildProps: ['transition', 'perspective', 'transform'],
                        properties: [{
                            property: 'transition',
                            properties: [{
                                    name: 'Property',
                                    property: 'transition-property'
                                },
                                {
                                    name: 'Duration',
                                    property: 'transition-duration'
                                },
                                {
                                    name: 'Easing',
                                    property: 'transition-timing-function'
                                }
                            ]
                        }, {
                            property: 'transform',
                            properties: [{
                                    name: 'Rotate X',
                                    property: 'transform-rotate-x'
                                },
                                {
                                    name: 'Rotate Y',
                                    property: 'transform-rotate-y'
                                },
                                {
                                    name: 'Rotate Z',
                                    property: 'transform-rotate-z'
                                },
                                {
                                    name: 'Scale X',
                                    property: 'transform-scale-x'
                                },
                                {
                                    name: 'Scale Y',
                                    property: 'transform-scale-y'
                                },
                                {
                                    name: 'Scale Z',
                                    property: 'transform-scale-z'
                                }
                            ]
                        }]
                    }, {
                        name: 'Flex',
                        open: false,
                        properties: [{
                            name: 'Flex Container',
                            property: 'display',
                            type: 'select',
                            defaults: 'block',
                            list: [{
                                    value: 'block',
                                    name: 'Disable'
                                },
                                {
                                    value: 'flex',
                                    name: 'Enable'
                                }
                            ]
                        }, {
                            name: 'Flex Parent',
                            property: 'label-parent-flex',
                            type: 'integer'
                        }, {
                            name: 'Direction',
                            property: 'flex-direction',
                            type: 'radio',
                            defaults: 'row',
                            list: [{
                                value: 'row',
                                name: 'Row',
                                className: 'icons-flex icon-dir-row',
                                title: 'Row',
                            }, {
                                value: 'row-reverse',
                                name: 'Row reverse',
                                className: 'icons-flex icon-dir-row-rev',
                                title: 'Row reverse',
                            }, {
                                value: 'column',
                                name: 'Column',
                                title: 'Column',
                                className: 'icons-flex icon-dir-col'
                            }, {
                                value: 'column-reverse',
                                name: 'Column reverse',
                                title: 'Column reverse',
                                className: 'icons-flex icon-dir-col-rev'
                            }]
                        }, {
                            name: 'Justify',
                            property: 'justify-content',
                            type: 'radio',
                            defaults: 'flex-start',
                            list: [{
                                value: 'flex-start',
                                className: 'icons-flex icon-just-start',
                                title: 'Start'
                            }, {
                                value: 'flex-end',
                                className: 'icons-flex icon-just-end',
                                title: 'End'
                            }, {
                                value: 'space-between',
                                className: 'icons-flex icon-just-sp-bet',
                                title: 'Space between'
                            }, {
                                value: 'space-around',
                                className: 'icons-flex icon-just-sp-ar',
                                title: 'Space around'
                            }, {
                                value: 'center',
                                className: 'icons-flex icon-just-sp-cent',
                                title: 'Center'
                            }]
                        }, {
                            name: 'Align',
                            property: 'align-items',
                            type: 'radio',
                            defaults: 'center',
                            list: [{
                                value: 'flex-start',
                                title: 'Start',
                                className: 'icons-flex icon-al-start'
                            }, {
                                value: 'flex-end',
                                title: 'End',
                                className: 'icons-flex icon-al-end'
                            }, {
                                value: 'stretch',
                                title: 'Stretch',
                                className: 'icons-flex icon-al-str'
                            }, {
                                value: 'center',
                                title: 'Center',
                                className: 'icons-flex icon-al-center'
                            }]
                        }, {
                            name: 'Flex Children',
                            property: 'label-parent-flex',
                            type: 'integer'
                        }, {
                            name: 'Order',
                            property: 'order',
                            type: 'integer',
                            defaults: 0,
                            min: 0
                        }, {
                            name: 'Flex',
                            property: 'flex',
                            type: 'composite',
                            properties: [{
                                name: 'Grow',
                                property: 'flex-grow',
                                type: 'integer',
                                defaults: 0,
                                min: 0
                            }, {
                                name: 'Shrink',
                                property: 'flex-shrink',
                                type: 'integer',
                                defaults: 0,
                                min: 0
                            }, {
                                name: 'Basis',
                                property: 'flex-basis',
                                type: 'integer',
                                units: ['px', '%', ''],
                                unit: '',
                                defaults: 'auto'
                            }]
                        }, {
                            name: 'Align',
                            property: 'align-self',
                            type: 'radio',
                            defaults: 'auto',
                            list: [{
                                value: 'auto',
                                name: 'Auto'
                            }, {
                                value: 'flex-start',
                                title: 'Start',
                                className: 'icons-flex icon-al-start'
                            }, {
                                value: 'flex-end',
                                title: 'End',
                                className: 'icons-flex icon-al-end'
                            }, {
                                value: 'stretch',
                                title: 'Stretch',
                                className: 'icons-flex icon-al-str'
                            }, {
                                value: 'center',
                                title: 'Center',
                                className: 'icons-flex icon-al-center'
                            }]
                        }]
                    }]
                }
            }
        });
        editor.Commands.add('set-device-desktop', {
            run: editor => editor.setDevice('Desktop')
        });
        editor.Commands.add('set-device-mobile', {
            run: editor => editor.setDevice('Mobile')
        });
        editor.Commands.add('set-device-tablet', {
            run: editor => editor.setDevice('Tablet')
        });
        editor.Commands.add('set-device-samsung', {
            run: editor => editor.setDevice('Samsung')
        });
        editor.Commands.add('set-device-iphone', {
            run: editor => editor.setDevice('Iphone')
        });
        editor.on('change:device', () => console.log('Current device: ', editor.getDevice()));
        var pn = editor.Panels;
        var modal = editor.Modal;
        var cmdm = editor.Commands;

        const panelViews = pn.addPanel({
            id: "views"
        });

        panelViews.get("buttons").add([{
            attributes: {
                title: "Open Code"
            },
            className: "fa fa-file-code-o",
            command: "open-code",
            togglable: false, //do not close when button is clicked again
            id: "open-code"
        }]);


        cmdm.add('canvas-clear', function() {
            if (confirm('Are you sure to clean the canvas?')) {
                var comps = editor.DomComponents.clear();
                setTimeout(function() {
                    localStorage.clear();
                }, 0);
            }
        });



        // Store DB
        cmdm.add('save-database', {
            run: function(em, sender) {
                sender.set('active', true);
                saveContent();
            }
        });

        cmdm.add('close-form', {
            run: function(em, sender) {
                sender.set('active', true);
                history.back();
            }
        });

        pn.addButton('options', [{
            id: 'save-database',
            className: 'fa fa-floppy-o',
            command: 'save-database',
            attributes: {
                title: 'Save page',
                'data-tooltip-pos': 'bottom'
            }
        }]);

        pn.addButton('options', [{
            id: 'close-form',
            className: 'fa fa-times',
            command: 'close-form',
            attributes: {
                title: 'Close Form',
                'data-tooltip-pos': 'bottom'
            }
        }]);
       


        var origWarn = console.warn;
        toastr.options = {
            closeButton: true,
            preventDuplicates: true,
            showDuration: 250,
            hideDuration: 150
        };
        console.warn = function(msg) {
            if (msg.indexOf('[undefined]') == -1) {
                toastr.warning(msg);
            }
            origWarn(msg);
        };
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
        ]
        .forEach(function(item) {
            pn.getButton('options', item[0]).set('attributes', {
                title: item[1],
                'data-tooltip-pos': 'bottom'
            });
        });
        [
            ['open-sm', 'Style Manager'],
            ['open-layers', 'Layers'],
            ['open-blocks', 'Blocks']
        ]
        .forEach(function(item) {
            pn.getButton('views', item[0]).set('attributes', {
                title: item[1],
                'data-tooltip-pos': 'bottom'
            });
        });
        var titles = document.querySelectorAll('*[title]');
        for (var i = 0; i < titles.length; i++) {
            var el = titles[i];
            var title = el.getAttribute('title');
            title = title ? title.trim() : '';
            if (!title)
                break;
            el.setAttribute('data-tooltip', title);
            el.setAttribute('title', '');
        }

        // Show borders by default
        pn.getButton('options', 'sw-visibility').set('active', 1);

        function saveContent() {
            var content = editor.getHtml();
            var style = editor.getCss();
            let _token = $('meta[name="csrf-token"]').attr('content');
            // Get edit field value
            $.ajax({
                url: "/admin/save-form",
                type: 'post',
                data: {
                    content: content,
                    style: style,
                    _token: _token
                }
            }).done(function(rsp) {
                toastr.success("Form Created Successfully");
            });
        }
    </script>
</body>