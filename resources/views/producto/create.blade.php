@extends('adminlte::page')
@section('title', 'AdminLte')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="container" align="center">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                           <h3> <strong>Agregar Productos</strong></h3>
                        </div>
                    </div>
                </div>

                <div align="center" class="card-body" style="width:400px">
                    <form id="addProducto" class="" method="POST" action="{{url('ProductoController@agregarproductos')}}">
                        <div class="form-group">
                            <label for="Nombre" class="col-md-12 col-form-label">Nombre</label>

                            <div class="col-md-12">
                                <input id="Nombre" type="text" class="form-control" name="Nombre" value="" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Precio" class="col-md-12 col-form-label">Precio</label>

                            <div class="col-md-12">
                                <input id="Precio" type="text" class="form-control" name="Precio" value="" required autofocus>
                        </div>
                        </div>

                        

                        <div id="div_file">
                           <p id="texto"> Add Archivo</p> 
                        <input type="file" name="fichero" value="" id="fichero" >
                        </div>
                        <br>

                    <div class="hidden" id="progreso">
                        <div class="progress">
                          <div class="progress-bar" role="progressbar" aria-valuenow="0"
                          aria-valuemin="0" aria-valuemax="100" id="barra-de-progreso" style="width:0%">
                            <span class="sr-only">70% Complete</span>
                          </div>
                        </div>
                    </div>


                         <br>
                        <div class="form-group" align="center">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="button" class="btn btn-primary btn-block desabled" id="agregarProducto">
                                    Agregar
                                </button>

                               
                            </div>
                            
                        </div>


                    </form>
                    <br>
                    <br/>

                   <a href="{{url('/productos')}}"><button class="btn btn-success"> Cancelar</button></a>
                </div>
            </div>
        </div>
       
    </div>
</div>

<form action="" method="POST" class="Producto-remove-record-model">
    <div id="remove-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Eliminar Producto</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>Esta seguro que desea eliminar el producto?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light deleteMatchRecord">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase.js"></script>
<script src="{{asset('js/cargarimagenes.js') }}"></script>

<script>


// Add Data
$('#agregarProducto').on('click', function(){

   var id=firebase.database().ref().child('Establecimiento/jbuywbeijwnvkj/food_station/producto/').push().key;
   console.log(id);
    var values = $("#addProducto").serializeArray();

    var Nombre = values[0].value;
    var Precio  = values[1].value;
    var Url_Image=self.image_url;
    var Id=id;
    

    firebase.database().ref('Establecimiento/jbuywbeijwnvkj/food_station/producto').push({
        
        nombre: Nombre,
        precio: Precio,
        urlImagen:Url_Image,

        id:Id,

    });
    
    // Reassign lastID value
    
    $("#addProducto input").val("");
  

  
});


</script>
@stop