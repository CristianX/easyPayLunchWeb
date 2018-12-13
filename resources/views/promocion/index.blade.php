@extends('adminlte::page')

@section('title', 'AdminLte')


@section('content_header')
    <h3><strong><center>Oferta de Promociones</center></strong></h3>
@stop

@section('content')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Easy Pay Lunch</h3>
      <p>      </p>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><span class="glyphicon glyphicon-plus"></span> Nueva Promocion</button>
     
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th><center>Nombre</center></th>
          <th><center>Descripcion</center></th>
           <th><center>Tipo</center></th>
          <th><center>Dia</center></th>
          <th><center>Imagen</center></th>
          <th><center>Accion</center></th>
        </tr>
        </thead>
        <tbody >
            @foreach ($all_subject as $promocion)
        <tr>
          <td><center>{{$promocion['nombre']}}</center></td>
          <td><center>{{$promocion['descripcion']}}</center></td>
          <td><center>{{$promocion['tipo']}}</center></td>
          <td><center>{{$promocion['dia']}}</center></td>
          <td><center><img src="{{$promocion['imagen']}}" style="height: 70px; width: 70px;"></center></td>
          
          <td> <button type="button" data-toggle="modal" data-target="#remove-modal" class="btn btn-danger removeData" data-id="{{$promocion['idPromocion']}}"><span class="fa fa-fw fa-trash"></span></button> |
           <button  type="button" class="btn btn-success updateData" data-id= "{{$promocion['idPromocion']}}" data-toggle="modal" data-target="#update-modal"><span class="glyphicon glyphicon-pencil"></span></button></td>

           
         
        </tr>
        @endforeach
       
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->



    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agregar Nueva Promocion</h4>
          </div>
          <form method="post" action="" id="addpromocion" name="addpromociones">
          <div class="modal-body">

              <!-- token para las vistas modales -->
  
                      <div class="form-group">
                          <label for="Nombre" class="col-md-12 col-form-label">Nombre</label>
                            <div class="col-md-12">
                                <input id="Nombre" type="text" class="form-control" placeholder="Ingrese el nombre de la promocion" name="Nombre" value="" >
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <div class="form-group">
                           
                            <label for="Descripcion" class="col-md-12 col-form-label">Descripcion</label>
                            <div class="col-md-12">
                                <input id="Descripcion" type="text" class="form-control" name="Descripcion"  placeholder="Ingrese la descripcion"  value="">
                        </div>
                        </div>
                        
                        <br/>
                        <br/>
                        <br/>

                        <div class="form-group">
                            <label for="Tipo" class="col-md-12 col-form-label">Seleecione el tipo de Promocion</label>
                            <div class="col-md-12">
                                <select class="form-control"  name="Tipo" id="Tipo">
                                    <option>Normal</option>
                                    <option>Especial</option>
                                </select>
                            </div>
                            
                        </div>
                       

                        <br/>
                        <br/>
                        <br/>

                        <div class="form-group">
                           <label for="Dia" class="col-md-12 col-form-label">Dia</label>
                            <div class="col-md-12">
                                <input type="text" id="Dia" class="form-control"  placeholder="Ingrese el dia de Promocion" name="Dia" value="" >
                            </div>
                            
                        </div>
                         <br/>
                        <br/>
                        <br/>
                          
                      
                        <div class="form-group" align="center">
                            <p>Agregar Imagen de la Promocion</p>

                        <div id="div_file" >
                           
                        <input type="file" name="fichero"  id="fichero" >
                        </div>
                        <br/>
                        <br/>        
                            <div class="hidden" id="progreso" >
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                  aria-valuemin="0" aria-valuemax="100" id="barra-de-progreso"   style="width:0%">
                                    <span class="sr-only">70% Complete</span>
                                  </div>
                                </div>
                            </div>
                        </div>
          </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-default waves-effect remove-data-from-delete-form" data-dismiss="modal">Cerrar</button>
            <button type="button"  class="btn btn-success"  id="agregarpromocion">Guardar Cambios</button>
          </div>

        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

<!-- Delete Model -->
<form action="" method="POST" class="Promocion-remove-record-model">
    <div id="remove-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:35%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Eliminar Promocion</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>Esta seguro que desea eliminar esta Promocion?</h4>
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

<form action="" method="POST" class="Promocion-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:25%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title" id="custom-width-modalLabel">Actualizar Producto</h4>
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body" id="updateBody">
                    
                </div>
                

                  <div class="form-group" align="center">
                            <p>Cambiar Imagen de la Promocion</p>

                        <div>
                           
                        <input type="file" name="fichero1"  id="fichero1" >
                        </div>
                        <br/>
                        <br/>        
                            <div class="hidden" id="progresopro" >
                                <div class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                  aria-valuemin="0" aria-valuemax="100" id="barra-de-promocion"   style="width:0%">
                                    <span class="sr-only">70% Complete</span>
                                  </div>
                                </div>
                            </div>
                        </div>
                

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect update-data-from-delete-form" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success waves-effect waves-light updatePromocion">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
</form>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.6/firebase.js"></script>
<script src="{{asset('js/cargarimagenes.js') }}"></script>




<script type="text/javascript">
    
var agregarpromocion = document.getElementById("agregarpromocion");
agregarpromocion.disabled = true;
var Nombre = document.addpromociones.Nombre;
var Descripcion = document.addpromociones.Descripcion;
var Dia=document.addpromociones.Dia;

Nombre.onkeyup = Descripcion.onkeyup =Dia.onkeyup=activarBoton;

function activarBoton() {
    if(verificar()) {
        agregarpromocion.disabled=false
    }
    else {
        agregarpromocion.disabled=true
    }
}

function verificar() {
    if( Nombre.value=="" )
        return false;
    if( Descripcion.value=="" )
        return false;
    if( Dia.value=="" )
        return false;
    
    return true;
}


</script>


<script>
  $('#agregarpromocion').on('click', function(){

   
    var values = $("#addpromocion").serializeArray();

    var Nombre = values[0].value;
    var Descripcion  = values[1].value;
    var Tipo=values[2].value;
    var Dia=values[3].value;
    var Url_Image=self.image_url;
    
    var id= firebase.database().ref().child('promocion').push().key;

        
    var ref=firebase.database().ref('Establecimiento/sdbhsdbvjnwihb/promocion/'+id);
    ref.set({
         
         nombre:Nombre,
         descripcion:Descripcion,
         tipo:Tipo,
         dia:Dia,
         idPromocion:id,
         imagen:Url_Image,

    })

    
    // Reassign lastID value
    
    $("#addpromocion input").val("");
    document.location.href="{{URL::to('promociones')}}";
  });
  
</script>

<!-- script para  actualizar los datos con vistas modales -->
<script>
 

  var updateID = 0;
$('body').on('click', '.updateData', function() {
    updateID = $(this).attr('data-id');
    console.log('valor id:',updateID);
    firebase.database().ref('Establecimiento/sdbhsdbvjnwihb/promocion/' + updateID).on('value', function(snapshot) {
        var values = snapshot.val();
        var updateData = '<div class="form-group">\
                 <div class="col-md-12">\
                    <input id="idPromocion" type="hidden" class="form-control" name="idPromocion" value="'+values.idPromocion+'" required autofocus>\
                </div>\
                <label for="nombre" class="col-md-12 col-form-label">nombre</label>\
                <div class="col-md-12">\
                    <input id="nombre" type="text" class="form-control" name="nombre" value="'+values.nombre+'" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="descripcion" class="col-md-12 col-form-label">Descripcion</label>\
                <div class="col-md-12">\
                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="'+values.descripcion+'" required autofocus>\
                </div>\
            </div>\
             <div class="form-group">\
                <label for="tipo" class="col-md-12 col-form-label">Tipo</label>\
                <div class="col-md-12">\
                    <select class="form-control"  name="tipo" id="tipo">\
                    <option>'+values.tipo+'</option>\
                    <option>Normal</option>\
                    <option>Especial</option>\
                    </select>\
                </div>\
            </div>\
             <div class="form-group">\
                <label for="dia" class="col-md-12 col-form-label">Dia</label>\
                <div class="col-md-12">\
                    <input id="dia" type="text" class="form-control" name="dia" value="'+values.dia+'" required autofocus>\
                </div>\
            </div>\
            <div class="form-group">\
                <label for="imagen" class="col-md-12 col-form-label">Imagen</label>\
                <div class="col-md-12">\
                <td> <img src="'+values.imagen+'" style="height: 70px; width: 70px;"></td>\
                </div>\
                <br/>\
                </diV>\
                <div class="col-md-12">\
                    <input id="Url_Image" type="hidden" class="form-control" name="Imagen" value="'+values.imagen+'" required autofocus>\
                </div>\
            </div>'
            $('#updateBody').html(updateData);
    });
});
$('.updatePromocion').on('click', function() {
    var values = $(".Promocion-update-record-model").serializeArray();
    var imagen=self.image_url;
    if (self.aux=='funciona'){
    var postData = {
        idPromocion:values[0].value,
        nombre : values[1].value,
        descripcion : values[2].value,
        tipo:values[3].value,
        dia:values[4].value,
        imagen :imagen,

    };
   }else{
    var postData={
       idPromocion:values[0].value,
        nombre : values[1].value,
        descripcion : values[2].value,
        tipo:values[3].value,
        dia:values[4].value,
        imagen :values[5].value,
      };
    }
    console.log('imagen:',self.image_url)
    var updates = {};
    updates['Establecimiento/sdbhsdbvjnwihb/promocion/' + updateID] = postData;
    firebase.database().ref().update(updates);
    
    $("#update-modal").modal('hide');

document.location.href="{{URL::to('promociones')}}";
});

// ELIMINAR REGISTROS
$("body").on('click', '.removeData', function() {
    var id = $(this).attr('data-id');
    $('body').find('.Promocion-remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
    console.log('id1:'+id);
});
$('.deleteMatchRecord').on('click', function(){
    var values = $(".Promocion-remove-record-model").serializeArray();
    var id = values[0].value;
    firebase.database().ref('Establecimiento/sdbhsdbvjnwihb/promocion/' + id).remove();
    console.log(id);
    $('body').find('.Promocion-remove-record-model').find( "input" ).remove();
    $("#remove-modal").modal('hide');

  document.location.href="{{URL::to('promociones')}}";

});
$('.remove-data-from-delete-form').click(function() {
    $('body').find('.Promocion-remove-record-model').find( "input" ).remove();
});
 


</script>
 @stop