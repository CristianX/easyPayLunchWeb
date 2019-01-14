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



  <body>

    <div id="app"></div>

  </body>

  <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>

@stop
