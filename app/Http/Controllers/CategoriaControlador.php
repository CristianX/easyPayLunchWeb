<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class CategoriaControlador extends Controller
{        

    public function listarCategoria(){
        $user = Auth::user();
        $id = $user->name;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference('establecimiento/'.$id."/categoria");
        $datos= false;
        try{
            $id_categoria = $ref->getChildKeys();
            $datos = true;
            foreach($id_categoria as $idC){
                $ref2 = $database->getReference('establecimiento/'.$id.'/categoria/'.$idC);
                $lista_categorias[$idC] = $ref2->getValue();
            }
            return view("categoria", compact('lista_categorias', 'datos'));
        }catch(\Exception $e){
            return view("categoria", compact('lista_categorias', 'datos'));
        }
    }

    public function actualizarCategoria(Request $request){
        $user = Auth::user();
        $id = $user->name;
        try{
            $idC = $request->input('id_categoria');
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
            $ref = $database->getReference('establecimiento/'.$id.'/categoria/'.$idC);

            $actualizacion["nombre"] = $request->input('nombre');
            $actualizacion["descripcion"] = $request->input('descripcion');
            $actualizacion["disponibilidad"] = $estado;
            $actualizacion["imagen"] = "http://www.tucmag.net/wp-content/uploads/2017/09/Bojack-e1409246704757-700x700.jpeg";
            
            $ref -> update($actualizacion);

            return back();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function registrarCategoria(Request $request){
        $user = Auth::user();
        $id = $user->name;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
        $ref = $database 
        ->getReference('establecimiento/'.$id.'/categoria')
        ->push(['nombre' => "jojo"]);
        $id_C = $ref->getKey();

        $ref2 = $database->getReference('establecimiento/'.$id.'/categoria/'.$id_C);

        $estado = $request->input('disponibilidad');
        if($request->input('disponibilidad')=='on'){
            $estado = 'Disponible';
        }else{
            $estado = 'No Disponible';
        }

        $actualizacion["nombre"] = $request->input('nombre');
        $actualizacion["descripcion"] = $request->input('descripcion');
        $actualizacion["disponibilidad"] = $estado;
        $actualizacion["imagen"] = "http://www.tucmag.net/wp-content/uploads/2017/09/Bojack-e1409246704757-700x700.jpeg";

        $ref2 -> update($actualizacion);

        return back();
    }

    
}