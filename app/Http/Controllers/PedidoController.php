<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use App\Http\Controllers\Controller;
use Auth;

class PedidoController extends Controller
{
    public function listarPedidos(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $user = Auth::user();
        $id = $user->name;
        $database = $firebase->getDatabase();
        $ref = $database->getReference('establecimiento/'.$id.'/interaccionUsuario');
        $datos = False;
        try{
            $id_pedidos = $ref->getChildKeys();
            $datos = True;
            foreach($id_pedidos as $idP){
                $ref2 = $database->getReference('establecimiento/'.$id.'/interaccionUsuario/'.$idP);
                $lista_pedidos[$idP] = $ref2->getValue();
            }
            return view('pedido', compact('lista_pedidos', 'datos'));
        }catch(\Exception $e){
            return view("pedido", compact('lista_pedidos', 'datos'));
        }
    }

}
