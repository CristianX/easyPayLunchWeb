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
                <th>Pedido</th>
                <th>Detalle</th>
           </tr>
        </thead>
        <tbody>
           @foreach ($lista_pedidos as $id_pedido => $pedido)
            <tr>
                <td>{{$pedido['estado']}}</td>
                <form method="get" action="{{action('DetallePedidoControlador@verDetalle')}}">
                    <td>
                        <label >{{$id_pedido}}</label>
                        <input name="pedido" type="hidden" value="{{$id_pedido}}"/>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-link" >ver</button>
                    </td>
                </form>
            </tr>
           @endforeach
        </tbody>
    </table>
@stop
