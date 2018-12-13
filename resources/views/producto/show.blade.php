@extends('adminlte::page')

@section('title', 'AdminLte')


@section('content_header')
    <h1>Productos</h1>
@stop


@section('content')

<div class="container">
        <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">

         <div class="form-group">
		<label>NOMBRE PRODUCTO</label>
		<p>{{$productos['nombre']}}</p>
	   </div>
       </div>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
	<div class="form-group">
		<label>PRECIO</label>

		<p>{{$producto['nombre']}}</p>


	</div>
</div>
<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
	<div class="form-group">
		<label>IMAGEN</label>

			<p><img src="{{$producto['urlImagen']}}" style="height: 70px; width: 70px;"></p>

	</div>
</div>

</div>


  <hr>

</div>









@stop