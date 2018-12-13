
@extends('adminlte::page')
@section('title', 'AdminLte')

@section('content_header')

    @stop

@section('content')

<div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar Nueva Promocion</h4>
          </div>
          <form method="post" action="{{url('promociones')}}">
          <div class="modal-body">

              {!! csrf_field() !!}  <!-- token para las vistas modales -->
  
              <input type="text" placeholder="Nombre de la Promocion" class="form-control" name="Nombre">
              <input type="text" placeholder="Descripcion de la Promocion" class="form-control" name="Descripcion">
               <select class="form-control"  name="tipo" id="tipo">
                      <option>Normal</option>
                      <option>Especial</option>
               </select>
              <input type="text" placeholder="Dia de Promocion" class="form-control" name="Dia">
              <input type="file" name="fichero"  id="fichero" >
              <div class="hidden" id="progreso">
                  <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="0"
                              aria-valuemin="0" aria-valuemax="100" id="barra-de-progreso"   style="width:0%">
                            <span class="sr-only">70% Complete</span>
                        </div>
                    </div>
                </div>

          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger">Guardar Cambios</button>
          </div>

        </form>

        

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    @stop