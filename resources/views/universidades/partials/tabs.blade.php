@section('styles')

@endsection


    
    <div class="form-group">
        {!!  Form::label('continente', ' Nombre Continente ')!!}
        {!!  Form::select('continente', [null=>'Seleccione un continente']+$continentes,null,array('class' => 'form-control'))!!}
    </div>


    <div class="form-group">
        {!!  Form::label('pais', ' Nombre país ')!!}
        {!!  Form::select('pais', [null=>'Seleccione un país'],null,array('class' => 'form-control'))!!}
    </div>

    <div class="form-group">
        {!!  Form::label('nombre_universidad', ' Nombre de la Universidad');!!}
        {!! Form::text('nombre_universidad',null,array('class' => 'form-control','placeholder'=>'Ej: Universidad Austral de Chile'));!!}
    </div>  
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">

                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                      @include('universidades.partials.fields')
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    </div>
