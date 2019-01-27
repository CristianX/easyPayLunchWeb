@extends('adminlte::page')

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    

<script type="text/javascript">
  $('.timepicker').datetimepicker({
      format: 'HH:mm:ss'
  });
  var input = $('.timepicker').datetimepicker({
      autoclose: false,
      twelvehour: false,
      default: '14:20:00'
  });
  $('#check-minutes').click(function(e){
      e.stopPropagation();
      input.datetimepicker('show').datetimepicker('toggleView', 'minutes');
  });
</script>

<br>
<div class="container">
  <div class="row">
      <h1 class="display-3">DETALLE ESTABLECIMIENTO</h1>
      <button type="button" class="btn btn-primary btn-link" data-toggle="modal" 
                      data-target="#modalEditar">Editar</button>
  </div>
</div>
<br>

<div class="container">    
  @foreach ($informacion as $informacionEstablecimiento => $value)
      <!--<p>{{$informacionEstablecimiento}}</p>-->
      <div class="row table-row">
          <div class="col-sm-6">
              <h3>Informacion Establecimiento</h3>
              <div class="container">
                  <fieldset class="form-group">
                      <label for="nombre" class="bmd-label-floating" id="nombreLabel">Nombre:</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" value="{{$value['nombre']}}">
                      <span class="bmd-help">Campo Obligatorio*</span>
                  </fieldset>
                  <fieldset class="form-group">
                      <label for="descripcion" class="bmd-label-floating" id="descripcionLabel">Descripcion:</label>
                      <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$value['descripcion']}}">
                      <span class="bmd-help">Campo Obligatorio*</span>
                  </fieldset>
                  <fieldset class="form-group">
                      <label for="email" class="bmd-label-floating" id="emailLabel">Correo Electronico:</label>
                      <input type="email" class="form-control" id="email" name="email" value="{{$value['correoElectronico']}}">
                      <span class="bmd-help">Campo Obligatorio*</span>
                  </fieldset>
                  <fieldset class="form-group">
                      <label for="telefono" class="bmd-label-floating" id="telefonoLabel">Telefono:</label>
                      <input type="email" class="form-control" id="telefono" name="telefono" value="{{$value['telefono']}}">
                      <span class="bmd-help">Campo Obligatorio*</span>
                  </fieldset>
              </div>
          </div>
          <div class="col-sm-4" style="align-items: center; align=center; valign=center; text-align: center;">
              <img class="card-img-top" src="{{$value['imagen']}}" style="height: 250px; width: 250px; border-radius: 50%;" alt="imagen establecimiento">
              <button type="button" class="btn btn-secondary btn-link" data-dismiss="modal">Cambiar Imagen</button>
          </div>
      </div>
      <hr/>
      <div class="row table-row">
              <h3>Datos Atencion</h3>
              <div class="container">
                  <div class="row">
                      <fieldset class="form-group col-sm-2">
                          <label for="diaDe" class="bmd-label-floating" id="diaLabelDe">De:</label>
                          <select class="form-control" id="diaDe" name="diaDe">
                              <option>{{$value['atencion']['dia']}}</option>
                              <option>---------</option>
                              <option>Lunes</option>
                              <option>Martes</option>
                              <option>Miércoles</option>
                              <option>Jueves</option>
                              <option>Viernes</option>
                              <option>Sábado</option>
                              <option>Domingo</option>
                          </select>
                      </fieldset>
                      <fieldset class="form-group col-sm-2">
                          <label for="diaA" class="bmd-label-floating" id="diaLabelA">a:</label>
                          <select class="form-control" id="diaA" name="diaA">
                              <option>{{$value['atencion']['dia']}}</option>
                              <option>---------</option>
                              <option>Lunes</option>
                              <option>Martes</option>
                              <option>Miércoles</option>
                              <option>Jueves</option>
                              <option>Viernes</option>
                              <option>Sábado</option>
                              <option>Domingo</option>
                          </select>
                      </fieldset>
                      <fieldset class="input-field form-group col-sm-3">
                          <label for="horaA" class="bmd-label-floating" id="horaALabel">Abrimos a las:</label>
                          <input id="horaA" name="horaA" class="timepicker form-control" data-default="14:20:00" type="time">
                      </fieldset>
                      
                      <fieldset class="form-group col-sm-3">
                          <label for="horaC" class="bmd-label-floating" id="horaCLabel">Cerramos a las:</label>
                          <input id="horaC" name="horaC" class="timepicker form-control" data-default="14:20:00" type="time">
                      </fieldset>
                      <!--<fieldset class="form-group col-sm-2">
                          <label for="horario" class="bmd-label-floating" id="horarioLabel">Horario:</label>
                          <input type="text" class="form-control" id="horario" name="horario" value="{{$value['atencion']['horario']}}">
                      </fieldset>-->
                      <fieldset class="form-group col-sm-2">
                          <label id="disponibilidadLabel">Disponibilidad:</label>
                          <!--<input type="text" class="form-control" id="disponibilidad" name="disponibilidad" value="{{$value['atencion']['disponibilidad']}}">-->
                          <div class="switch" style="text-align: right;">
                              <label>
                                  <input type="checkbox" id="estado" name="estado" >{{$value['atencion']['disponibilidad']}}
                              </label>
                          </div>
                      </fieldset>
                      
                  </div>
              </div>
      </div>
      <!--<p>Estado: {{$value['estado']}}</p> si no esta activo no se debera editar la info, porque no se ha pagado-->
      <hr/>
      <div class="row table-row">
          <h3>Detalles Establecimiento</h3>
          <div class="container">
              <div class="row">
                  <p>Tags:</p>
                  <br>
                  <div class="card-columns">
                      @foreach ($value['tag'] as $tagEstablecimiento => $tags)
                          <p>{{$tags}}</p>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  @endforeach
</div>

<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title display-4" id="nombreEstablecimientoCard">-----------</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form name="f1" id="f1" method="post" action="">
          <fieldset class="form-group">
              <label for="nombre" class="bmd-label-floating" id="textoNombre" style="color: #222222"></label>
              <input type="text" class="form-control" name="nombre" id="nombre">
              <span class="bmd-help">Campo Obligatorio*</span>
          </fieldset>
          <fieldset class="form-group">
              <label for="descripcion" class="bmd-label-floating" id="textoDescripcion" style="color: #222222"></label>
              <input type="text" class="form-control" id="descripcion" name="descripcion">
              <span class="bmd-help">Campo Obligatorio*</span>
          </fieldset>
          <input type="hidden" id="id_establecimiento" name="id_establecimiento">
          <div class="switch" style="text-align: right;">
              <label>
                  <input type="checkbox" id="estado" name="estado">Estado
              </label>
          </div>
          <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-success" form="f1">Guardar Cambios</button>
    </div>
  </div>
</div>
</div>
@stop