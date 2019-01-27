<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ProductoControlador extends Controller
{        

    public function listarProducto(){
        $user = Auth::user();
        $id = $user->name;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference('establecimiento/'.$id."/producto");
        $datos = False;
        try{
            $id_productos = $ref->getChildKeys();
            $datos = true;
            foreach($id_productos as $idP){
                $ref2 = $database->getReference('establecimiento/'.$id.'/producto/'.$idP);
                $lista_productos[$idP] = $ref2->getValue();
            }
    
            return view("producto", compact('lista_productos', 'datos'));
        }catch(\Exception $e){
            return view("producto", compact('lista_productos', 'datos'));
        }
        
    }

    public function actualizarProducto(Request $request){
        $user = Auth::user();
        $id = $user->name;
        try{
            $idP = $request->input('id_producto');
            if($request->input('disponibilidad')=='on'){
                $estado = 'Disponible';
            }else{
                $estado = 'No Disponible';
            }
            $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
            $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
            ->create();
            $database = $firebase->getDatabase();
            $ref = $database->getReference('establecimiento/'.$id.'/producto/'.$idP);

            $actualizacion["nombre"] = $request->input('nombre');
            $actualizacion["descripcion"] = $request->input('descripcion');
            $actualizacion["disponibilidad"] = $estado;
            $actualizacion["precio"] = $request->input('precio');
            $actualizacion["categoria"] = $request->input('categoria');
            $actualizacion["imagen"] = "http://www.tucmag.net/wp-content/uploads/2017/09/Bojack-e1409246704757-700x700.jpeg";
            $actualizacion["etiqueta"] = explode( ',', $request->input('etiqueta') );
            
            $ref -> update($actualizacion);

            return back();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function registrarProducto(Request $request){
        $user = Auth::user();
        $id = $user->name;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
        $ref = $database 
        ->getReference('establecimiento/'.$id.'/producto')
        ->push(['nombre' => "jojo"]);
        $id_P = $ref->getKey();

        $ref2 = $database->getReference('establecimiento/'.$id.'/producto/'.$id_P);

        $estado = $request->input('disponibilidad');
        if($request->input('disponibilidad')=='on'){
            $estado = 'Disponible';
        }else{
            $estado = 'No Disponible';
        }

        $actualizacion["nombre"] = $request->input('nombre');
        $actualizacion["categoria"] = $request->input('categoria');
        $actualizacion["descripcion"] = $request->input('descripcion');
        $actualizacion["precio"] = $request->input('precio');
        $actualizacion["disponibilidad"] = $estado;
        $actualizacion["imagen"] = "http://www.tucmag.net/wp-content/uploads/2017/09/Bojack-e1409246704757-700x700.jpeg";
        $actualizacion["etiqueta"] = explode( ',', $request->input('etiqueta') );

        $ref2 -> update($actualizacion);

        return back();
    }

    
}