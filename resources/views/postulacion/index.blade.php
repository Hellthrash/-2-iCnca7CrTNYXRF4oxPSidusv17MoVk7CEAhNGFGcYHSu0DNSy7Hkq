@extends('layout.app')

@section('Dashboard') Postulación @endsection

@section('content')
    @include('DocumentoIdentidad.modal_documento_identidad')
    <div id="wizard">
        <div id="message"></div>
        <h3>Datos personales</h3>
        <section data-mode="async" data-ajax="true" data-url="{{url('postulacion/create-or-edit')}}">



        </section>
        <h3>Estudios actuales</h3>
       
        <section data-mode="async" data-ajax="true" data-url="{{url('estudo-actual/create-or-edit')}}">
  
        </section>
        <h3>Información de intercambio</h3>
        <section data-mode="async" data-ajax="true" data-url="{{url('prepostulacionuniversidad/create-or-edit')}}">
            
              
        </section>
        <h3>Declaración</h3>
        <section data-mode="async" data-ajax="true" data-url="{{url('declaracion/create-or-edit')}}">


        </section>
    </div>


@endsection

@section('breadcrumbs')
{!! Breadcrumbs::render('home') !!}
@endsection



@section('scripts')
    {!! Html::Script('plugins/jquery-steps/js/jquery.steps.js')!!}
    {!! Html::Script('plugins/bootstrap/js/bootstrap-select.js')!!}
    {!! Html::Script('js/datepicker-es.js')!!}
    {!! Html::Script('js/function_financiamiento.js')!!}
    {!! Html::Script('js/function_documento_identidad.js')!!}

    <script>
        $(document).on('ready',function() {
            initDocumentoIdentidad();
    

            $("#wizard").steps({
                headerTag: "h3",
                bodyTag: "section",
          
                startIndex:3,

                transitionEffect: "slideLeft",
                /* Labels */
                labels: {
                    cancel: "Cancelar",
                    current: "current step:",
                    pagination: "Pagination",
                    finish: "Finalizar",
                    next: "Siguiente",
                    previous: "Anterior",
                    loading: "Cargando ..."
                },
                onContentLoaded:function (event, currentIndex) {

                    switch (currentIndex) {
                        case 0:
                        //alert($('#wizard #id_postulante').val() != '');
                            if($('#wizard #id_postulante').val() != ''){
                                $('#wizard #spamAddDocumento').show();


                            }
                            if($('#wizard input#tipo_estudio_1').attr('checked') === 'checked'){
                            
                                $('#tipo_estudio_1').addClass('1check');
                            }
                            if($('#wizard input#tipo_estudio_2').attr('checked') === 'checked'){
                                $('#div_titulo_profesional').show('slide',1000);
                                $('#tipo_estudio_1').removeClass('1check');
                            }

                            if($('#wizard input#procedencia_2').attr('checked') == 'checked')

                            {
                                $('#procedencia_2').addClass('1check');

                                if($('#wizard input#tipo_estudio_1').attr('checked') === 'checked'){
                                    $('#preUach').show('slide',1000);
                                }
                                
                            }

                            break;
                        case 1:

        
                           
                         
                            if($('#procedencia').val() === 'UACH'){
                                $('#preUachEstudio').show('slide',1000);
                                $('#infoExtraEstudioUACH').show('slide',1000);
                                selectByTabs("section#wizard-p-1",'#campus_sede','#_token','#getUrlFacultadByCampus','#facultad');
                                selectByTabs("section#wizard-p-1",'#facultad','#_token','#getUrlCarreraByFacultad','#carrera');


                                if($('section#wizard-p-1 #continente').val() != ''){
                                    
                                    selectByTabsSinAccion("section#wizard-p-1",'#_token','#getUrlPaisByContinente','#pais',$('section#wizard-p-1 #continente').val(),$('section#wizard-p-1 #pais_id').val());
                                    selectByTabsSinAccion("section#wizard-p-1",'#_token','#getCampusByPais','#campus_sede',$('section#wizard-p-1 #pais_id').val(),$('section#wizard-p-1 #campus_sede_id').val());
                                    selectByTabsSinAccion("section#wizard-p-1",'#_token','#getUrlFacultadByCampus','#facultad',$('section#wizard-p-1 #campus_sede').val(),$('section#wizard-p-1 #facultad_id').val());
                                    selectByTabsSinAccion("section#wizard-p-1",'#_token','#getUrlCarreraByFacultad','#carrera',$('section#wizard-p-1 #facultad').val(),$('section#wizard-p-1 #carrera_id').val());

                                }

                                $('section#wizard-p-1').on('change','#carrera',function(){
                                  
                                    var idCarrera = $(this).val();
                                    $.ajax({
                                      // En data puedes utilizar un objeto JSON, un array o un query string
                                        data: {_token: $('#_token').val() , id:idCarrera},
                                        async : false,
                                         
                                        //Cambiar a type: POST si necesario
                                        type: 'get',
                                        // Formato de datos que se espera en la respuesta
                                        dataType: "json",
                                        // URL a la que se enviará la solicitud Ajax
                                        url:$('#getUrlDirectorCarrera').val() ,
                                        success : function(json) {   
                                            
                                            $('section#wizard-p-1 #director').val(json.director);
                                            $('section#wizard-p-1 #email').val(json.email);
                                            
                                        },

                                        error : function(xhr, status) {
                                            alert(status);
                                      
                                        },                   

                                    });
                                });

                            }
                            else{
                          

                                $('#select_uach_estudio').css('display','none');
                                $('#infoExtraEstudioNOUACH').show('slide');
                                $('#preNoUachEstudio').show('slide');

                                if($('section#wizard-p-1 #continente').val() != ''){
                                    selectByTabsSinAccion("section#wizard-p-1",'#_token','#getUrlPaisByContinente','#pais',$('section#wizard-p-1 #continente').val(),$('section#wizard-p-1 #pais_id').val());
                                    selectByTabsSinAccion("section#wizard-p-1",'#_token','#getCampusByPais','#campus_sede',$('section#wizard-p-1 #pais_id').val(),$('section#wizard-p-1 #campus_sede_id').val());
                                    var idCampusSede = $('section#wizard-p-1 #campus_sede_id').val();
                                    $.ajax({
                                      // En data puedes utilizar un objeto JSON, un array o un query string
                                        data: {_token: $('#_token').val() , idCampusSede:idCampusSede},
                                        async : false,
                                         
                                        //Cambiar a type: POST si necesario
                                        type: 'post',
                                        // Formato de datos que se espera en la respuesta
                                        dataType: "json",
                                        // URL a la que se enviará la solicitud Ajax
                                        url:$('#getUrlCoordinadorCampus').val() ,
                                        success : function(json) {   
                                            
                                            $('div#infoExtraEstudioNOUACH #nombre_encargado').val(json.nombre_encargado);
                                            $('div#infoExtraEstudioNOUACH #email').val(json.email);
                                            $('div#infoExtraEstudioNOUACH #telefono').val(json.telefono);

                                            
                                        },

                                        error : function(xhr, status) {
                                            alert(status);
                                      
                                        },                   

                                    });

                            
                                }
                                $('section#wizard-p-1').on('change','#campus_sede',function(){
                              
                                    var idCampusSede = $(this).val();
                                    $.ajax({
                                      // En data puedes utilizar un objeto JSON, un array o un query string
                                        data: {_token: $('#_token').val() , idCampusSede:idCampusSede},
                                        async : false,
                                         
                                        //Cambiar a type: POST si necesario
                                        type: 'post',
                                        // Formato de datos que se espera en la respuesta
                                        dataType: "json",
                                        // URL a la que se enviará la solicitud Ajax
                                        url:$('#getUrlCoordinadorCampus').val() ,
                                        success : function(json) {   
                                            
                                            $('div#infoExtraEstudioNOUACH #nombre_encargado').val(json.nombre_encargado);
                                            $('div#infoExtraEstudioNOUACH #email').val(json.email);
                                            $('div#infoExtraEstudioNOUACH #telefono').val(json.telefono);

                                            
                                        },

                                        error : function(xhr, status) {
                                            alert(status);
                                      
                                        },                   

                                    });
                                });
                            }

                        case 2:
                            if($('section#wizard-p-2 #continente').val() != ''){

                                selectByTabsSinAccion("section#wizard-p-2",'#_token','#getUrlPaisByContinente','#pais',$('section#wizard-p-2 #continente').val(),$('section#wizard-p-2 #pais_id').val());
                                selectByTabsSinAccion("section#wizard-p-2",'#_token','#getCampusByPais','#campus_sede',$('section#wizard-p-2 #pais_id').val(),$('section#wizard-p-2 #campus_sede_id').val());
                                selectByTabsSinAccion("section#wizard-p-2",'#_token','#getUrlFacultadByCampus','#facultad',$('section#wizard-p-2 #campus_sede').val(),$('section#wizard-p-2 #facultad_id').val());
                                selectByTabsSinAccion("section#wizard-p-2",'#_token','#getUrlCarreraByFacultad','#carrera',$('section#wizard-p-2 #facultad').val(),$('section#wizard-p-2 #carrera_id').val());
                                    
                            }

                    }
          

                    
                },
                onFinishing:function (event, currentIndex) {


                    var data = $(".current").find('input,select,textarea,.tEstudioInput_').serialize();
                    var url  = $(".current").find('#form-postulacion-active').attr('action');
             


                       
                    var respuestaAjax = $.ajax({
                          // En data puedes utilizar un objeto JSON, un array o un query string
                            data: data,
                            async : false,
                             
                            //Cambiar a type: POST si necesario
                            type: $(".current").find('#form-postulacion-active').attr('method'),
                            // Formato de datos que se espera en la respuesta
                            dataType: "json",
                            // URL a la que se enviará la solicitud Ajax
                            url:url ,
                            success : function(json) {   
                                //alert("ho");
                                $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button>'+json.message+'</div>');
                               // $("html, body").animate({ scrollTop: 0 }, 600);
                         
                                
                            },

                            error : function(xhr, status) {
                                var html = '<div class="alert alert-danger fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button><p> Porfavor corregir los siguientes errores:</p>';
                                for(var key in xhr.responseJSON)
                                {
                                    html += "<li>" + xhr.responseJSON[key][0] + "</li>";
                                }
                                $('#message').html(html+'</div>');
                                //$("html, body").animate({ scrollTop: 0 }, 600);
                          
                            },
                            
               

                        });

                    if(respuestaAjax.status == 200){
          


                        return true;
                    }
                    else{

                        return false;

                    }
                      
                    
                },
                onStepChanging:function (event, currentIndex, newIndex) { 
                    

                    var data = $(".current").find('input,select,textarea,.tEstudioInput_').serialize();
                    var url  = $(".current").find('#form-postulacion-active').attr('action');
                    if (currentIndex < newIndex){


                       
                        var respuestaAjax = $.ajax({
                              // En data puedes utilizar un objeto JSON, un array o un query string
                                data: data,
                                async : false,
                                 
                                //Cambiar a type: POST si necesario
                                type: $(".current").find('#form-postulacion-active').attr('method'),
                                // Formato de datos que se espera en la respuesta
                                dataType: "json",
                                // URL a la que se enviará la solicitud Ajax
                                url:url ,
                                success : function(json) {   
                                    //alert("ho");
                                    $('#message').html('<div class="alert alert-success fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button>'+json.message+'</div>');
                                   // $("html, body").animate({ scrollTop: 0 }, 600);
                             
                                    
                                },

                                error : function(xhr, status) {
                                    var html = '<div class="alert alert-danger fade in"><button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button><p> Porfavor corregir los siguientes errores:</p>';
                                    for(var key in xhr.responseJSON)
                                    {
                                        html += "<li>" + xhr.responseJSON[key][0] + "</li>";
                                    }
                                    $('#message').html(html+'</div>');
                                    //$("html, body").animate({ scrollTop: 0 }, 600);
                              
                                },
                                
                   

                            });

                        if(respuestaAjax.status == 200){
              


                            return true;
                        }
                        else{

                            return false;

                        }
                      
                    }
                   
                    else{return true;}                              
                }   
            });

    $('section#wizard-p-2').on('click',' #FinanciamientoDDList',function(){

    $(this).dropSelect();
    });

            //##################################### ACIONES DE LA PESTAÑA 1################################
            $('section#wizard-p-0').on('focus','#fecha_nacimiento',function(){
                $( this ).datepicker({

                    showButtonPanel: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    showAnim: 'drop',
                    yearRange: '1989:2000'

                });

            });
            $('section#wizard-p-0').on('click','#open_modal_documento_identidad',function(){
                $('#modal_documento_identidad').modal('show');
               

            });
            $('#wizard').on('change','input[name=tipo_estudio]',function(){
                        
                if($(this).val()==='Postgrado'){
                    $('#div_titulo_profesional').show('slide',1000);
                    $('#tipo_estudio_1').removeClass('1check');
                        $('#preUach').hide('slide',1000);

                   
      

                }
                else{

                    $('#div_titulo_profesional').hide('slide',1000);
                    $('#tipo_estudio_1').addClass('1check');
                    if($('#procedencia_2').attr('class') ==='1check'){

                        $('#preUach').show('slide',1000);

                    }



                }
            });
            $('#wizard').on('change','input[name=procedencia]',function(){
                if($(this).val()==='UACH'){

                    $('#procedencia_2').addClass('1check');
                    if($('#tipo_estudio_1').attr('class') ==='1check'){

                        $('#preUach').show('slide',1000);
                        
                    }
                }
                else{

                    $('#preUach').hide('slide',1000);
                    $('#procedencia_2').removeClass('1check');



                }
            });
            selectByTabs("section#wizard-p-0",'#continente','#_token','#getUrlPaisByContinente','#pais');
            selectByTabs("section#wizard-p-0",'#pais','#_token','#getUrCiudadContinente','.ciudad');
            
            selectByTabs("section#wizard-p-1",'#continente','#_token','#getUrlPaisByContinente','#pais');   
            selectByTabs("section#wizard-p-1",'#pais','#_token','#getCampusByPais','#campus_sede');

            selectByTabs("section#wizard-p-2",'#continente','#_token','#getUrlPaisByContinente','#pais');   
            selectByTabs("section#wizard-p-2",'#pais','#_token','#getCampusByPais','#campus_sede');
            selectByTabs("section#wizard-p-2",'#campus_sede','#_token','#getUrlFacultadByCampus','#facultad');
            selectByTabs("section#wizard-p-2",'#facultad','#_token','#getUrlCarreraByFacultad','#carrera');
            $('section#wizard-p-2').on('focus','#desde',function(){

               $( this ).datepicker({

                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 3,
                    dateFormat: 'yy-mm-dd',
                    
                    onClose: function( selectedDate ) {
                        $( "#hasta" ).datepicker( "option", "minDate", selectedDate );
                    }

                });
            })


            $('section#wizard-p-2').on('focus','#hasta',function(){

               $( this ).datepicker({

                    defaultDate: "+1w",
                    changeMonth: true,
                    dateFormat: 'yy-mm-dd',
                    numberOfMonths: 3,
                    onClose: function( selectedDate ) {
                        $( "#desde" ).datepicker( "option", "maxDate", selectedDate );
                    }

                });
            })
 

 

            $('section#wizard-p-3').on('focus','#fecha_matricula',function(){
                $( this ).datepicker({

                    showButtonPanel: true,
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    showAnim: 'drop',
                    yearRange: '2016:2025'

                });

            });


         

       
     
        }); 
    </script>
   
@endsection


@section('styles')
    {!! Html::Style('plugins/jquery-steps/css/jquery.steps.css')!!}
    {!! Html::Style('plugins/bootstrap/css/bootstrap-select.css')!!}



@endsection
