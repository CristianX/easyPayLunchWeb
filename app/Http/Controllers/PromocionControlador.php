<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class PromocionControlador extends Controller
{
    public function listarPromocion(){
        $user = Auth::user();
        $id = $user->name;
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
        $ref = $database->getReference('establecimiento/'.$id."/promocion");
        $datos = False;
        try{
            $id_promociones = $ref->getChildKeys();
            $datos = true;
            foreach($id_promociones as $idP){
                $ref2 = $database->getReference('establecimiento/'.$id.'/promocion/'.$idP);
                $lista_promociones[$idP] = $ref2->getValue();
            }
    
            return view("promocion", compact('lista_promociones', 'datos'));
        }catch(\Exception $e){
            return view("promocion", compact('lista_promociones', 'datos'));
        }
    }

    public function registrarPromocion(Request $request){
        $user = Auth::user();
        $id = $user->name;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
        $ref = $database 
        ->getReference('establecimiento/'.$id.'/promocion')
        ->push(['nombre' => "jojo"]);
        $id_P = $ref->getKey();

        $ref2 = $database->getReference('establecimiento/'.$id.'/promocion/'.$id_P);

        $estado = $request->input('disponibilidad');
        if($request->input('disponibilidad')=='on'){
            $estado = 'Disponible';
        }else{
            $estado = 'No Disponible';
        }

        $actualizacion["nombre"] = $request->input('nombre');
        $actualizacion["dia"] = $request->input('dia');
        $actualizacion["tipo"] = $request->input('tipo');
        $actualizacion["descripcion"] = $request->input('descripcion');
        $actualizacion["precio"] = $request->input('precio');
        $actualizacion["disponibilidad"] = $estado;
        $actualizacion["imagen"] = "https://vignette.wikia.nocookie.net/new-fantendo/images/8/86/Hamburguesa.png/revision/latest?cb=20160326024725&path-prefix=es";
        $actualizacion["etiqueta"] = explode( ',', $request->input('etiqueta') );

        $ref2 -> update($actualizacion);

        return back();
    }
   
    public function actualizarPromocion(Request $request){
        $user = Auth::user();
        $id = $user->name;
        try{
            $idP = $request->input('id_promocion');
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
            $ref = $database->getReference('establecimiento/'.$id.'/promocion/'.$idP);

            $actualizacion["nombre"] = $request->input('nombre');
            $actualizacion["dia"] = $request->input('dia');
            $actualizacion["tipo"] = $request->input('tipo');
            $actualizacion["descripcion"] = $request->input('descripcion');
            $actualizacion["precio"] = $request->input('precio');
            $actualizacion["disponibilidad"] = $estado;
            $actualizacion["imagen"] = "http://www.tucmag.net/wp-content/uploads/2017/09/Bojack-e1409246704757-700x700.jpeg";
            $actualizacion["etiqueta"] = explode( ',', $request->input('etiqueta') );
            
            $ref -> update($actualizacion);

            return back();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
