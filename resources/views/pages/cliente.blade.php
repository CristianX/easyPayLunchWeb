@extends('adminlte::page')


@section('title', 'Clientes')


@section('content_header')
    <h1>Tablero</h1>
@stop


@section('content')


<div class="box">
    <div class="box-header">
      <h3 class="box-title">Clientes Registrados <div class="box-body"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Correo</th>
          <th>Dirección</th>

          <th>Acción</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($all_subject as $cliente)
        <tr>
          <td>{{$cliente['correoElectronico']}}</td>
          <td>{{$cliente['direccion']}}</td>
          <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">
              <span class="fa fa-fw fa-trash"></span>
            </button></td>
         
        </tr>
        @endforeach
        </tbody>
        <!--<tfoot>
        <tr>
          <th>Rendering engine</th>
          <th>Browser</th>
          <th>Platform(s)</th>
          <th>Engine version</th>
          <th>CSS grade</th>
        </tr>
        </tfoot>-->
      </table>
    </div>
    <!-- /.box-body -->
 



    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Eliminar Cliente</h4>
          </div>
          <form method="post" action="">
          <div class="modal-body">

              {!! csrf_field() !!}  <!-- token para las vistas modales -->
  
              Desea Eliminar el usuario? 

          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger" onclick="clientes/1/eliminar"><span class="fa fa-fw fa-trash"></span></button>
          </div>

        </form>

        

        

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    




@stop


