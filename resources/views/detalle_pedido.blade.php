@extends('adminlte::page')

@section('title', 'Detalle Pedido')

@section('content_header')
    <div class="container">
        <div class="row">
            <h1 class="display-3">Detalle Pedido</h1>
        </div>
    </div>
@stop

@section('content')
    
    <form>
        <div class="container">
            <div class="row">
                <div class="table-row">
                    <div class="col-sm-5">
                        <div class="container">
                            <h4><b>usuario</b></h4> 
                            <div class="table-row">
                                <div class="col-sm-2">
                                    <img class="card-img-top" src="{{$informacion_usuario['foto']}}" style="height: 100px; width: 100px; border-radius: 50px 50px 50px 50px; " alt="imagen usuario">
                                </div>
                                <div class="col-sm-2">
                                    <h4><a>{{$informacion_usuario['nombre']}}</a></h4>
                                    <p>{{$informacion_usuario['mail']}}</p>
                                    <p>{{$informacion_usuario['telefono']}}</p>
                                </div>
                            </div>
                        </div>
                        
                        <hr/>
                        <p>SERVICION A DOMICILIO</p>
                        <div class="container">
                            <h4><b>transporte</b></h4> 
                            <div class="table-row">
                                <div class="col-sm-2">
                                    <img class="card-img-top" src="https://media.metrolatam.com/2018/08/07/5994e2516f417-3254f76cca9cb30b4205067593f41a8d-1200x600.jpg" style="height: 100px; width: 100px; border-radius: 50px 50px 50px 50px; " alt="imagen usuario">
                                </div>
                                <div class="col-sm-2">
                                    <h4><a>Juan el Taxista</a></h4>
                                    <p>jojo@jojo.com</p>
                                    <p>+5930000000000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="box">
                            <div class="box-body">
                                @foreach($producto_pedido as $idP => $pedido )
                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a>{{$pedido['nombre']}}</a><br>
                                                @foreach($pedido['etiqueta'] as $tag)
                                                    <span>{{$tag}}</span>
                                                @endforeach
                                            </div>
                                            <span class="col-sm-2">Precio ${{$pedido['precio']}}</span>
                                            <span class="col-sm-2" id="{{$idP}}">Cantidad {{$pedido['cantidad']}}</span>
                                            <span class="col-sm-2" id="{{$idP}}resultado">Subtotal ${{$pedido['precio'] * $pedido['cantidad']}}</span>
                                        </div>
                                        <br><br>
                                        <input id="subtotal" value= "{{$total = $total  + $pedido['precio'] * $pedido['cantidad']}}" type="hidden"/>
                                    </form>
                                @endforeach
                                <hr>
                                <form method="get" action="{{action('DetallePedidoControlador@actulizarPedido')}}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <h4><a id="total">Total: {{$total}}</a></h4>
                                        </div>
                                        <div class="col-sm-4">
                                            <input name="id_pedido" value= "{{$id_pedido}}" type="hidden"/>
                                            <input name="estado" value= "confirmado" type="hidden"/>
                                            @if($estado ==='consulta')
                                                <button type="submit" class="btn btn-primary" disabled>Enviar Información</button>
                                            @else
                                                <button type="submit" class="btn btn-primary">Enviar Información</button>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            @if($estado ==='consulta')
                                                <button type="submit" class="btn btn-success">Confirmar</button>
                                            @else
                                                <button type="submit" class="btn btn-success" disabled>Confirmar</button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div> 
                    <div class="col-sm-2">
                    </div> 
                </div>
            </div>
        </div>
    </form>
    <script>
        function myfunction(id, precio) {
            var x = document.getElementById(id).value;
            document.getElementById(id+"resultado").innerHTML = "Subtotal: $" + x*precio;
        };
    </script>
@stop