@extends('adminlte::page')

@section('title', 'AdminLte')


@section('content_header')
    <h1>Dashboard</h1>
@stop


@section('content')


<div class="box">
    <div class="box-header">
      <h3 class="box-title">Productos Registrados</h3>
      <p>      </p>
      <a href="{{URL::action('ProductoController@agregarproductos')}}"><button class="btn btn-success"> <i class="fas fa-plus-circle"></i> Nuevo Producto</button></a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th><center>Nombre</center></th>
         
          <th><center>Precio</center></th>
          <th><center>Imagen</center></th>

          <th><center>Acción</center></th>

        </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($all_subject as $producto)
        <tr>
          <td><center>{{$producto['nombre']}}</center></td>
          <td><center>{{$producto['precio']}}</center></td>
          <td><center><img src="{{$producto['urlImagen']}}" style="height: 70px; width: 70px;"></center></td>
          
          <td><center><a data-toggle="modal" data-target="#update-modal" class="btn btn-success updateData" data-id=index>Actualizar</a>
                <a data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id=index>Eliminar</a></center></td>
         
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
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Actualizar Producto</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="updateBody">
                    
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
<script src="js/index.js"></script>
<script>

// Remove Data


// Update Data
var updateID = 0;
$('body').on('click', '.updateData', function() {
    updateID = $(this).attr('data-id');
    firebase.database().ref('Establecimiento/jbuywbeijwnvkj/food_station/producto/' + updateID).on('value', function(snapshot) {
        var values = snapshot.val();
        var updateData = '<div class="form-group">\
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
                <label for="Url_Image" class="col-md-12 col-form-label">Url_Image</label>\
                <div class="col-md-12">\
                    <input id="Url_Image" type="text" class="form-control" name="Imagen" value="'+values.urlImagen+'" required autofocus>\
                </div>\
            </div>';

            $('#updateBody').html(updateData);
    });
});

$('.updateProducto').on('click', function() {
    var values = $(".Producto-update-record-model").serializeArray();
    var postData = {
        nombre : values[0].value,
        precio : values[1].value,
        urlImagen : values[2].value,

    };

    var updates = {};
    updates['Establecimiento/jbuywbeijwnvkj/food_station/producto/' + updateID] = postData;

    firebase.database().ref().update(updates);

    $("#update-modal").modal('hide');
});




// eliminar datos

$("body").on('click', '.removeData', function() {
    var id = $(this).attr('data-id');
    $('body').find('.Producto-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');

    console.log('id1'+id);
});

$('.deleteMatchRecord').on('click', function(){
    var values = $(".Producto-remove-record-model").serializeArray();
    var id = values[0].value;
    firebase.database().ref('Establecimiento/jbuywbeijwnvkj/food_station/producto/' + id).remove();
    console.log(id);
    $('body').find('.Producto-remove-record-model').find( "input" ).remove();
    $("#remove-modal").modal('hide');
});
$('.remove-data-from-delete-form').click(function() {
    $('body').find('.Producto-remove-record-model').find( "input" ).remove();
});


</script>




@stop
