<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ProductoController extends Controller
{
    

    
    public function listarproductos(){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        /*$newPost = $database
        ->getReference('Establecimiento/jbuywbeijwnvkj/cliente')
        ->push([
        'imagen' => 'B)' ,
        'mail' => 'thecristianx@hotmail.com',
        'nombre' => "Cristian X. Tapia",
        'tokenUser' => '8tr452'
        ]);
        echo '<pre>';
        print_r($newPost->getvalue());*/

        $ref = $database->getReference('Establecimiento/jbuywbeijwnvkj/food_station/producto');
        $subjects = $ref->getValue();

       
        foreach($subjects as $subject){

            $all_subject[] = $subject;
        }

        //return json_encode($all_subject);
       return view('producto.index', compact('all_subject'));
        

    }

    public function agregarproductos(){

    	return view ('producto/create');
    }

    
}