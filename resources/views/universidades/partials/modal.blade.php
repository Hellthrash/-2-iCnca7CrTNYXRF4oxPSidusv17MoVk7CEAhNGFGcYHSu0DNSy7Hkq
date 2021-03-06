<!-- Modal -->
<div class="modal fade" id="modal_campus_universidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            {!! Form::open(['url'=>'universidades/store', 'method'=>'POST','id'=>'holamundo'])!!}
            <div class="modal-body">
                @include('partials.errorAjax')
                <div class="form-group">

                    {!!  Form::label('nombre', ' Nombre del campus ');!!}
                    {!! Form::text('nombre',null,array('class' => 'form-control','placeholder'=>'Ej: Isla Teja'));!!}
                </div>  
                <div class="form-group">

                    {!!  Form::label('telefono', ' Ń° Telefónico ');!!}
                    {!! Form::text('telefono',null,array('class' => 'form-control','placeholder'=>'Ej:+560632222222'));!!}
                </div>  
                <div class="form-group">

                    {!!  Form::label('fax', ' Nombre N° fax ');!!}
                    {!! Form::text('fax',null,array('class' => 'form-control','placeholder'=>'Ej: +560632222222'));!!}
                </div>  
                <div class="form-group">

                    {!!  Form::label('sitio_web', ' sitio web del campus ');!!}
                    {!! Form::text('sitio_web',null,array('class' => 'form-control','placeholder'=>'Ej: www.uach.cl'));!!}
                </div>  

                <div class="form-group">
                    {!!  Form::label('ciudad', ' Nombre de la ciudad ')!!}
                    {!!  Form::select('ciudad', [null=>'Seleccione ciudad'],null,array('class' => 'form-control putaputa'))!!}
                </div>
                <div class="form-group">

                    {!!  Form::label('direccion', ' Dirección ');!!}
                    {!! Form::text('direccion',null,array('class' => 'form-control','placeholder'=>'Ej: Esmeralda #232'));!!}
                </div>  

                {!!Form::hidden('getURL', url('ciudades/pais-by-continente'),array('id'=>'getURL'));!!}
                {!!Form::hidden('getToken', csrf_token(),array('id'=>'getToken'));!!}
                {!!Form::hidden('universidad', $idUniversidad,array('id'=>'universidad'));!!}
          

            </div>
            {!!Form::close()!!}

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnAdd">Guardar Campus</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->