@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
    <div class="container">
        <div class="row">
            <h1 class="display-3">Pedidos</h1>
        </div>
    </div>
@stop

@section('content')

         <table id="example1" class="table table-bordered table-striped">
           <thead>
           <tr>
             <th>Estado</th>
             <th>Usuario</th>
             <th>Detalles</th>

           </tr>
           </thead>
           <tbody>
           @foreach ($all_subject as $pedido)
           <tr>
             <td>{{$pedido['estado']}}</td>
             <td>{{$pedido['usuario']}}</td>
             <td><button type="input" class="btn btn-link" data-toggle="modal" data-target="#modal-default">
                 <span>ver</span>
               </button></td>

           </tr>
           @endforeach
           </tbody>
         </table>

@stop
