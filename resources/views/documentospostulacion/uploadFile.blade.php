@extends('intranet.app')

@section('Dashboard') Departamentos @endsection

@section('content')
<!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
                <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb"><i class="fa fa-angle-right"></i> Porfavor adjuntar los siguientes documentos</h4>
                      <form class="form-horizontal style-form" method="get">
                       
<input id="input-706" name="documentosAdjuntos[]" type="file" multiple=true class="file-loading">
                      </form>
                  </div>
                </div><!-- col-lg-12-->         
            </div><!-- /row -->
 
{!!Form::hidden('_token', csrf_token(),array('id'=>'_token'));!!}
{!!Form::hidden('getUrlFiles', url('docs/all-files'),array('id'=>'getUrlFiles'));!!}



@endsection
@section('styles')

    {!! Html::Style('plugins/bootstrap-fileinput/css/fileinput.css')!!}

@endsection


@section('scripts')

    {!! Html::Script('plugins/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js')!!}
    {!! Html::Script('plugins/bootstrap-fileinput/js/fileinput.js')!!}
    {!! Html::Script('plugins/bootstrap-fileinput/js/fileinput_locale_es.js')!!}


  <script type="text/javascript">

  function myCallback(result) {
        if(result){

            console.log("hoa");
        }
        else{

            console.log('pero');
        }
    }

    function foo(callback) {
        $.ajax({
            type: 'post',
            url:$('#getUrlFiles').val() ,
            async : false,
            data:{_token: $('#_token').val()},
            dataType: "json",
            success: myCallback,
            error: function (xhr, status, err) {
                return "error asdfasdf ";
            }
        })
    }
    function getFiles(inicialCaption,inicialTag) {

        var filesHeader = '<div class="file-preview-other-frame">'+
                                '<div class="file-preview-other">'+
                                    '<span class="file-icon-4x">';

        var filesFooter =           '</span>'+
                                '</div>'+
                            '</div>';






        var result = '';
        $.ajax({
            type: 'GET',
            async:false,
            url: $('#getUrlFiles').val(),
            dataType: "json",
            success: function (json) {

                $.each(json, function(index, subCatObj){
                    result = result +  filesHeader+'<a href="/documentos/'+subCatObj.path+'"><i class="fa fa-file-pdf-o text-danger"></i></a>'+filesFooter;
                    inicialCaption.push({
                        'caption'  : subCatObj.nombre,
                        'width':'120px',
                        'url': 'file-destroy',
                        'key':subCatObj.id,
                        'extra': {'_token':$('#_token').val()},
                    });

                    inicialTag.push({
                        '{TAG_VALUE}': subCatObj.nombre, 
                        '{TAG_CSS_NEW}': 'hide', 
                        '{TAG_CSS_INIT}': ''});

                    if(index != json.length-1){

                        result = result + '*$$*';
                    }

                });
            
             
            
             
            },
            error: function (xhr, status, err) {

            }
        });
       
        return result;

    }

    $(document).on('ready',function(){

// custom footer template for the scenario
// the custom tags are in braces
    var footerTemplate = '<div class="file-thumbnail-footer">\n' +
    '   <div style="margin:5px 0">\n' +
    '<select  class="kv-input kv-new form-control input-sm {TAG_CSS_NEW}" name="" id="">'+
                       '<option value="">Seleccione documento</option>'+
                       '<option value="1">Documento1</option>'+
                       '<option value="2">Documento2</option>'+
                       '<option value="3">Documento3</option>'+
                       '<option value="4">Documento4</option>'+
                       '<option value="5">Documento5</option>'+
                  ' </select>\n'+
    '       <input class="kv-input kv-init form-control input-sm {TAG_CSS_INIT}" value="{TAG_VALUE}" disabled placeholder="Enter caption...">\n' +
    '   </div>\n' +
    '   {actions}\n' +
    '</div>';







        var inicialTag = [];
        var initCaption = [];
      $('#input-706').fileinput({
                    uploadUrl: ' storage-files',
                    uploadAsync: false,
                    minFileCount: 1,
                    maxFileCount: 5,
                    language:'es',
                    allowedFileExtensions:['pdf'],
                    overwriteInitial: false,
                    layoutTemplates: {footer: footerTemplate,
                        
                    },
                    previewFileIcon: '<i class="fa fa-file"></i>',
                    previewFileType:'pdf',
                    allowedPreviewTypes: null, 
                    previewFileIconSettings: {
                        'jpg': '<i class="fa fa-file-photo-o text-warning"></i>',
                        'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
                    },

                    previewThumbTags: {
                        '{TAG_VALUE}': '',        // no value
                        '{TAG_CSS_NEW}': '',      // new thumbnail input
                        '{TAG_CSS_INIT}': 'hide'  // hide the initial input
                    },

                    initialPreview: getFiles(initCaption,inicialTag),

                    initialPreviewConfig: initCaption,
                    
                    initialPreviewThumbTags:inicialTag,
                    //uploadExtraData:{_token:$('#_token').val()}
                    uploadExtraData:function(previewId, index) {  // callback example
                        var out = {}, key, i = 0; j = 0;
                        out['index'] = index;
                        $('.kv-input:visible').each(function() {
                            $el = $(this);
                            if($el.hasClass('kv-new')){

                                key  ='new_' + j;
                                j++;
                            }
                            else{
                                key  ='init_' + i;
                                i++;

                            }
                            //key = $el.hasClass('kv-new') ? 'new_' + j : 'init_' + i;
                            out[key] = $el.val();
                        });
                        console.log(out);
                        out['_token'] = $('#_token').val();
                        return out;
                    }

                    });

    });
  </script>
@endsection