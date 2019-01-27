@extends('adminlte::page')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    
    <style>
        .chip {
            display: inline-block;
            padding: 0 25px;
            height: 32px;
            text-align: center;
            font-size: 16px;
            line-height: 32px;
            border-radius: 25px;
            background-color: #f1f1f1;
        }
        .card-text{
            font-size: 16px;
        }
        .card-title{
            font-size: 22px;
            text-align: center;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 5px;
        }

        .card:hover {
            box-shadow: 0 16px 32px 0 rgba(0,0,0,0.2);
        }
        .container {
            padding: 2px 16px;
        }
    </style>

@section('title', 'Categorias')
@section('content_header')
    <div class="container">
        <div class="row">
            <h1 class="display-3">Categorias</h1>
            <button type="button" class="btn btn-primary rounded-circle" style="height: 50px; width: 50px;" data-toggle="modal" 
                            data-target="#modalCrear">+</button>
        </div>
    </div>
@stop
@section('content')
    <div class="card-columns">  
        @if($datos)
            @foreach ($lista_categorias as $categoria => $value)
                <div class="card">
                    <img class="card-img-top" src="{{$value['imagen']}}" style="height: 150px; width:100%; border-radius: 5px 5px 0 0; " alt="imagen establecimiento">
                    <div class="card-body">
                        <p class="card-title"></p>
                        <h4><b>{{$value['nombre']}}</b></h4> 
                        <br>
                        <p class="card-text">{{$value['descripcion']}}</p>
                        <hr>
                        <input type="hidden" id="id_categoria" value={{$categoria}}>
                        <a class="btn btn-primary" data-toggle="modal" data-target="#modalEditar"
                            onclick="actualizarCategoria('{{$categoria}}',
                            '{{$value['nombre']}}',
                            '{{$value['descripcion']}}',
                            '{{$value['imagen']}}', 
                            '{{$value['disponibilidad']}}');">
                            Ver Detalles
                        </a>
                    </div> 
                </div>
                <hr>
            @endforeach

        @else
            <p>No posee categorias registradas</p>
        @endif
    </div>

    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4">Registar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="f2" id="f2" method="get" action="{{action('CategoriaControlador@registrarCategoria')}}">
                    <div class="row table-row">
                        <div class="col-sm-7">
                            <fieldset class="form-group">
                                <label for="nombre" class="bmd-label-floating" >Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                <span class="bmd-help">Campo Obligatorio*</span>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="descripcion" class="bmd-label-floating">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                                <span class="bmd-help">Campo Obligatorio*</span>
                            </fieldset>
                            <div class="switch" style="text-align: right;">
                                <label>
                                    <input type="checkbox" id="disponibilidad" name="disponibilidad">Disponibilidad
                                </label>
                            </div>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <img class="card-img-top" src="" style="height: 150px; width: 150px;" alt="imagen categoria">
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen" lang="es">
                                <label class="custom-file-label" for="customFileLang"></label>
                            </div>
                        </div>  
                    </div>        
                    
                </form>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="f2">Registar</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title display-4" id="nombreCategoriaCard">-----------</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="f1" id="f1" method="post" action="{{action('CategoriaControlador@actualizarCategoria')}}">
                    <div class="row table-row">
                        <div class="col-sm-7">
                            <fieldset class="form-group">
                                <label for="nombre" class="bmd-label-floating" id="textoNombre" style="text-color: #222222">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre">
                                <span class="bmd-help">Campo Obligatorio*</span>
                            </fieldset>
                            <fieldset class="form-group">
                                <label for="descripcion" class="bmd-label-floating" id="textoDescripcion" style="color: #222222">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                                <span class="bmd-help">Campo Obligatorio*</span>
                            </fieldset>
                            <div class="switch" style="text-align: right;">
                                <label>
                                    <input type="checkbox" id="disponibilidad" name="disponibilidad">Disponibilidad
                                </label>
                            </div>
                            <input type="hidden" id="id_categoria" name="id_categoria">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                        </div>
                        <div class="col-sm-4">
                            <br>
                            <img class="card-img-top" id="img" name="img" src="" style="height: 150px; width: 150px;" alt="imagen categoria">
                            <br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen" name="imagen" lang="es">
                                <label class="custom-file-label" for="customFileLang"></label>
                            </div>
                        </div>  
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success" form="f1">Guardar Cambios</button>
            </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function actualizarCategoria(id, nombre, descripcion,imagen, disponibilidad) {
            var nombreC_ = document.getElementById('nombreCategoriaCard');
            $(nombreC_).text(nombre)
            document.f1.id_categoria.value = id
            document.f1.nombre.value = nombre
            document.f1.descripcion.value = descripcion
            document.f1.img.src = imagen
            document.f1.imagen.value = imagen
            document.f1.disponibilidad.value = disponibilidad
        }
    </script>
@stop
