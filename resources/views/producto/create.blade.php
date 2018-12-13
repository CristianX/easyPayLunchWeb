@extends('adminlte::page')
@section('title', 'AdminLte')

@section('content_header')
    @stop

@section('content')
<div align="center">
<div class="container" >
    <div class="row">
       <div class="col-md-3">
       </div>
        <div class="col-md-6" >
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <center><h2>Agregar Nuevo Producto</h2></center>
                  </div>
                  <div class="panel-body" align="center">
                
                    <form  action="{{URL::to('/producto')}}" id="addProducto" class="" name="addproductos" method="post" >
                        
                        <div class="form-group">
                            <label for="Nombre" class="col-md-3 col-form-label">Nombre</label>

                            <div class="col-md-8">
                                <input id="Nombre" type="text" class="form-control" placeholder="Ingrese el nombre del producto" name="Nombre" value="" >
                            </div>
                        </div>
                        <br>
                        <br><br>
                        <div class="form-group">
                            <label for="Precio" class="col-md-3 col-form-label">Precio</label>

                            <div class="col-md-8">
                                <input id="Precio" type="number" class="form-control" name="Precio"  value="">
                        </div>
                        </div>
                        <br>
                        <br>

                        <div class="form-group">
                            <label for="Disponibilidad" class="col-md-3 col-form-label"> Disponibilidad</label>
                            <div class="col-md-8">
                                <input type="text" id="Disponibilidad" class="form-control"  placeholder="Ingrese la disponibilidad del producto" name="Disponibilidad" value="" >
                            </div>
                            
                        </div>
                        <br>
                        <br>
                           
                        <div class="form-group">
                            <p>Agregar Imagen del Producto</p>
                        <div id="div_file" >
                           
                        <input type="file" name="fichero"  id="fichero" >
                        </div>
                         <br>
                         <br>

                        
                            <div class="hidden" id="progreso">
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                  aria-valuemin="0" aria-valuemax="100" id="barra-de-progreso"   style="width:0%">
                                    <span class="sr-only">70% Complete</span>
                                  </div>
                                </div>
                            </div>
                        </div>
                         <br>
                        <div class="form-group" align="center">
                            
                                <button type="button" class="btn btn-primary" id="agregarProducto" >
                                    Agregar
                                </button>
                                 <a href="{{url('/producto')}}" class="btn btn-success"> Cancelar</a>
                
                            
                        </div>


                    </form>
                    <br>
                    <br/>

                   
                
            </div>
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

<script type="text/javascript">
    
var agregarProducto = document.getElementById("agregarProducto");
agregarProducto.disabled = true;
var Nombre = document.addproductos.Nombre;
var Precio = document.addproductos.Precio;
var Disponibilidad=document.addproductos.Disponibilidad;

Nombre.onkeyup = Precio.onkeyup =Disponibilidad.onkeyup=activarBoton;

function activarBoton() {
    if(verificar()) {
        agregarProducto.disabled=false
    }
    else {
        agregarProducto.disabled=true
    }
}

function verificar() {
    if( Nombre.value=="" )
        return false;
    if( Precio.value=="" )
        return false;
    if( Disponibilidad.value=="" )
        return false;
    
    return true;
}


</script>

<script>
// Add Data
$('#agregarProducto').on('click', function(){

   
    var values = $("#addProducto").serializeArray();

    var Nombre = values[0].value;
    var Precio  = values[1].value;
    var Disponibilidad=values[2].value;
    var Url_Image=self.image_url;
    
    var id= firebase.database().ref().child('producto').push().key;

        
    var ref=firebase.database().ref('Establecimiento/food_station/Producto/'+id);
    ref.set({
         Id:id,
         Nombre:Nombre,
         Precio:Precio,
         Disponibilidad:Disponibilidad,
         Imagen:Url_Image,

    })

    
    // Reassign lastID value
    
    $("#addProducto input").val("");
  document.location.href="{{URL::to('producto')}}";
  
});





</script>
@stop