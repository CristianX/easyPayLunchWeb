@extends('adminlte::page')

@section('title', 'AdminLte')


@section('content_header')
   <h3><strong><center>Productos del Establecimiento</center></strong></h3>
@stop


@section('content')


<div class="box">
    <div class="box-header">
      <h3 class="box-title"><strong>EASY PAY LUNCH</strong></h3>
      <p>      </p>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-plus"></span> Nuevo Producto</button>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th><center>Nombre</center></th>
         
          <th><center>Precio</center></th>
          <th><center>Disponibilidad</center></th>
          <th><center>Categoria</center></th>
          <th><center>Imagen</center></th>
          <th><center>Acción</center></th>

        </tr>
        </thead>
        <tbody >
            @foreach ($all_subject as $producto)
        <tr>
          <td><center>{{$producto['nombre']}}</center></td>
          <td><center>{{$producto['precio']}}</center></td>
          <td><center>{{$producto['disponibilidad']}}</center></td>
          <td><center>{{$producto['categoria']}}</center></td>
          <td><center><img src="{{$producto['imagen']}}" style="height: 70px; width: 70px;"></center></td>
          
         <td> <button type="button" data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="{{$producto['idProducto']}}"><span class="fa fa-fw fa-trash"></span></button> |
           <button  type="button" class="btn btn-success updateData" data-id= "{{$producto['idProducto']}}" data-toggle="modal" data-target="#update-modal"><span class="glyphicon glyphicon-pencil"></span></button></td>
         
        </tr>
        @endforeach
       
        </tbody>
        
      </table>
    </div>
    

 <div class="modal fade" id="modal-default">
      <div class="modal-dialog" style="width:35%;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar Nuevo Producto</h4>
          </div>
          <form method="post" action="" id="addproducto" name="addproductos">
          <div class="modal-body">

              
        <div class="form-group">
            <label for="Nombre" class="col-md-12 col-form-label">Nombre</label>
                <div class="col-md-12">
                    <input id="Nombre" type="text" class="form-control" placeholder="Ingrese el nombre del producto" name="Nombre" value="" >
                </div>
        </div>
         <br>
         <br><br>
        <div class="form-group">
            <label for="Precio" class="col-md-12 col-form-label">Precio</label>

            <div class="col-md-12">
            <input id="Precio" type="number" class="form-control" name="Precio"  value="">
            </div>
        </div>
        <br><br/><br/>

        <div class="form-group">
          <label for="Disponibilidad" class="col-md-12 col-form-label"> Disponibilidad</label>
            <div class="col-md-12">
            <input type="radio" name="Disponibilidad" value="True" checked> Disponible<br>
            <input type="radio" name="Disponibilidad" value="False">No Disponible<br>
             
            </div>
                            
        </div>
        <br><br/><br/>
         <div class="form-group">
          <label for="Categoria" class="col-md-12 col-form-label"> Categoria</label>
            <div class="col-md-12">
             <select class="form-control"  name="Categoria" id="Categoria">
                <option>Seleccione la Categoria</option>

                @foreach($all_categorias as $categoria)
                <option>{{$categoria['nombre']}} </option>
                @endforeach

            </select>
           </div>
                            
        </div>
        <br>
        <br/><br/>
                           
        <div class="form-group" align="center">
         <p>Agregar Imagen del Producto</p>
        <div>
                           
        <input type="file" name="fichero2"  id="fichero2" >
        </div>
        <br>
        <br>           
        <div class="hidden" id="progresoproducto">
        <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="barra-de-producto"   style="width:0%">
                 <span class="sr-only">70% Complete</span>
        </div>
        </div>
        </div>
       </div>
            <br>

  
                       
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cerrar</button>
            <button type="button"  class="btn btn-success"  id="agregarProducto">Guardar Cambios</button>
          </div>

        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>




<!-- Delete Model -->
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

<!-- Update Model -->
<form action="" method="POST" class="Producto-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:35%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Actualizar Producto</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="updateBody">
                    
                </div>
                   <div class="form-group" align="center">
                 <p>Agregar Imagen del Producto</p>
                <div>
                                   
                <input type="file" name="ficheroact"  id="ficheroact" >
                </div>
                <br>
                <br>           
                <div class="hidden" id="progresoact">
                <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="barra-de-act"   style="width:0%">
                         <span class="sr-only">70% Complete</span>
                </div>
                </div>
                </div>
               </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success waves-effect waves-light updateProducto">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</form>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase.js"></script>
<script src="{{asset('js/cargarimagenesproducto.js') }}"></script>



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

   
    var values = $("#addproducto").serializeArray();

    var Nombre = values[0].value;
    var Precio  = values[1].value;
    var Disponibilidad=values[2].value;
    var Categoria=values[3].value;
    var Url_Image=self.image_url;
    
    var id= firebase.database().ref().child('producto').push().key;

        
    var ref=firebase.database().ref('Establecimiento/sdbhsdbvjnwihb/producto/'+id);
    ref.set({
         idProducto:id,
         nombre:Nombre,
         precio:Precio,
         disponibilidad:Disponibilidad,
         categoria:Categoria,
         imagen:Url_Image,

    })

    
    // Reassign lastID value
    
    $("#addproducto input").val("");
  document.location.href="{{URL::to('productos')}}";
  
});





</script>

<script>

// Remove Data
// Update Data
var updateID = 0;
$('body').on('click', '.updateData', function() {
    updateID = $(this).attr('data-id');
    console.log('valor id:',updateID);
    firebase.database().ref('Establecimiento/sdbhsdbvjnwihb/producto/' + updateID).on('value', function(snapshot) {
        var values = snapshot.val();
        var updateData = '<div class="form-group">\
                 <div class="col-md-12">\
                    <input id="id" type="hidden" class="form-control" name="id" value="'+values.idProducto+'" required autofocus>\
                </div>\
                <label for="Nombre" class="col-md-12 col-form-label">Nombre</label>\
                <div class="col-md-12">\
                    <input id="Nombre" type="text" class="form-control" name="Nombre" value="'+values.nombre+'" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="Precio" class="col-md-12 col-form-label">Precio</label>\
                <div class="col-md-12">\
                    <input id="Precio" type="text" class="form-control" name="Precio" value="'+values.precio+'" required autofocus>\
                </div>\
            </div>\
             <div class="form-group">\
                <label for="Disponibilidad" class="col-md-12 col-form-label">Disponibilidad</label>\
                <div class="col-md-12">\
                    <input type="radio"  id="Disponibilidad" name="Disponibilidad" value="'+values.disponibilidad.checked+'"> Disponible<br>\
                    <input type="radio"  id="Disponibilidad" name="Disponibilidad" value="False">No Disponible<br>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="Categoria" class="col-md-12 col-form-label">Categoria</label>\
                <div class="col-md-12">\
                    <select class="form-control"  name="categoria" id="categoria">\
                    <option>'+values.categoria+'</option>\
                    <option>Snacks</option>\
                    <option>cocteles</option>\
                    <option>bebidas</option>\
                    </select>\
                </div>\
            </div>\
            <div class="form-group">\
                <div class="col-md-12">\
                    <input id="imagen" type="hidden" class="form-control" name="imagen" value="'+values.imagen+'" required autofocus>\
                </div>\
            </div>';
            $('#updateBody').html(updateData);
    });
});
$('.updateProducto').on('click', function() {
    var values = $(".Producto-update-record-model").serializeArray();
    var postData = {
        Id:values[0].value,
        Nombre : values[1].value,
        Precio : values[2].value,
        Disponibilidad:values[3].value,
        Imagen : values[4].value,
    };
    var updates = {};
    updates['Establecimiento/sdbhsdbvjnwihb/producto/' + updateID] = postData;
    firebase.database().ref().update(updates);
    
    $("#update-modal").modal('hide');

document.location.href="{{URL::to('productos')}}";
});

// eliminar datos
$("body").on('click', '.removeData', function() {
    var id = $(this).attr('data-id');
    $('body').find('.Producto-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    console.log('id1:'+id);
});
$('.deleteMatchRecord').on('click', function(){
    var values = $(".Producto-remove-record-model").serializeArray();
    var id = values[0].value;
    firebase.database().ref('Establecimiento/sdbhsdbvjnwihb/producto/' + id).remove();
    console.log(id);
    $('body').find('.Producto-remove-record-model').find( "input" ).remove();
    $("#remove-modal").modal('hide');
document.location.href="{{URL::to('productos')}}";
});
$('.remove-data-from-delete-form').click(function() {
    $('body').find('.Producto-remove-record-model').find( "input" ).remove();
});
 //document.location.href="{{URL::to('productos')}}";
</script>




@stop