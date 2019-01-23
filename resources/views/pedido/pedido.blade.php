@extends('adminlte::page')

@section('title', 'Pedidos')


@section('content')


  <section class="content-header">
     <h1>
       Tablero
       <small>Pedidos de {{ Auth::user()->name }}</small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Pedidos de {{ Auth::user()->name }}</li>
     </ol>
   </section>
 </br></br>


       <!-- /.box-header -->

         <table id="example1" class="table table-bordered table-striped">
           <thead>
           <tr>
             <th>Descripción</th>
             <th>Estado</th>
             <th>Imagen</th>
             <th>Nombre</th>

             <th>Acción</th>

           </tr>
           </thead>
           <tbody>
           @foreach ($all_subject as $pedido)
           <tr>
             <td>{{$pedido['descripcion']}}</td>
             <td>{{$pedido['estado']}}</td>
             <td><img src="{{$pedido['imagen']}}" style="width:50px; height:50px;"></td>
             <td>{{$pedido['nombre']}}</td>
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


  <!--<body>

    <div id="app"></div>

  </body>

  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>-->





@stop
