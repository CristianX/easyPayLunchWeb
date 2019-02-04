<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Http\Controllers\Controller;
use Auth;

class DetallePedidoControlador extends Controller
{
    public function verDetalle(Request $request){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $user = Auth::user();
        $id = $user->name;
        $database = $firebase->getDatabase();
        $id_pedido = $request->input('pedido');

        $ref = $database->getReference('establecimiento/'.$id.'/interaccionUsuario/'.$id_pedido);
        $informacion_pedido = $ref->getValue();
        $usuario = $informacion_pedido['usuario'];
        $estado = $informacion_pedido['estado'];
        $ref = $database->getReference('usuarios/'.$usuario);
        $informacion_usuario = $ref->getValue();
        $cont = 0;
        foreach($informacion_pedido['detalle'] as $subject){
            $id_pedidos[] = $subject['identificador']; 
            $cant_pedidos[$cont] = $subject['cantidad']; 
            $cont = $cont + 1; 
        }
        
        foreach($id_pedidos as $idP){  
            try{
                $ref1 = $database->getReference('establecimiento/'.$id.'/producto/'.$idP);
                $ref2 = $database->getReference('establecimiento/'.$id.'/promocion/'.$idP);
                if($ref1->getValue()){
                    $producto[$idP] = $ref1->getValue();
                }else{
                    if($ref2->getValue()){
                        $producto[$idP] = $ref2->getValue();
                    }
                }
            }catch(\Exception $e){
                return print_r($e->getMessage());
            }
        }
        $cont = 0;
        foreach($producto as $valor => $data){
            $producto_pedido[$valor]['nombre'] = $data['nombre'];
            $producto_pedido[$valor]['precio'] = $data['precio'];
            $producto_pedido[$valor]['cantidad'] = $cant_pedidos[$cont];
            $producto_pedido[$valor]['etiqueta'] = $data['etiqueta'];
            $cont = $cont+1;
        }

        $total = 0;
        return view('detalle_pedido', compact('producto_pedido', 'informacion_usuario', 'total', 'id_pedido', 'estado'));
    }

    public function actulizarPedido(Request $request){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
            $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
            ->create();
        $database = $firebase->getDatabase();
        $user = Auth::user();
        $id = $user->name;
        try{
            $idP = $request->input('id_pedido');
            $ref = $database->getReference('establecimiento/'.$id.'/interaccionUsuario/'.$idP);

            $actualizacion["estado"] = $request->input('estado');
            
            $ref -> update($actualizacion);

            return back();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

}
