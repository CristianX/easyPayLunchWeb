<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ClienteController extends Controller
{

   /* public function __constructor(){

        protected $database;
        protected $dbname = 'Usuario';

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $this->database = $firebase->getDatabase();
    }

    public get function(int $userID = NULL){

        if(empty($userID) || !isset($userID)) {return FALSE; }

        if($this->database->getReference(this->dbname)->getSnapshot()->hasChild($userID)){
            return $this->database->getReference($this->dbname)->getChild($userID)->getValue();
        }else{
            return FALSE;
        }

    }

    public function insert(array $data){

        if(empty($userID) || !isset($userID)) {return FALSE; }


        foreach($data as $key=> $value){

            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }

        return TRUE;

    }

    public function delete(int $userID){

        if(empty($userID) || !isset($userID)) {return FALSE; }

        if($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){

            $this->database->getReference($this->dbname)->getChild($userID)->remove();

            return TRUE;

        } else{

            return FALSE;
        }


    }*/

    public function index(){

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

        $ref = $database->getReference('usuario/');
        $subjects = $ref->getValue();

        foreach($subjects as $subject){

            $all_subject[] = $subject;
        }

        //return json_encode($all_subject);
       return view('pages.cliente', compact('all_subject'));
        



         



    }


    public function addCliente(Request $request){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        /*$newPost = $database
        ->getReference('Establecimiento/jbuywbeijwnvkj/food_station/cliente')
        ->push([
        'imagen' => 'B)' ,
        'mail' => 'thecristianx@hotmail.com',
        'nombre' => "Cristian X. Tapia",
        'tokenUser' => '8tr452'
        ]);
        echo '<pre>';
        print_r($newPost->getvalue());*/

        $ref = $database->getReference('usuario/');

        $imagenCliente = $request->imagenCliente;  //->imagenCliente es el nombre que llevan los inputText de la vista
        $nombreCliente = $request->nombreCliente;
        $correoCliente = $request->correoCliente;
        $tokenCliente = $request->tokenCliente;

        $key = $ref->push()->getKey();


        $ref->getChild($key)->set([
            'Imagen' => $imagenCliente,
            'Mail' => $correoCliente,
            'Nombre'=>$nombreCliente,
            'TokenUser' => $tokenCliente
        ]);

        $subjects = $ref->getValue();

        foreach($subjects as $subject){

            $all_subject[] = $subject;
        }

        return view('pages.cliente', compact('all_subject'));
    }

    public function editar(int $id){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        $ref = $database-> getReference("usuario");



        //obteniendo id
        $data = $ref->orderByChild("IdUsuario")->equalTo($id)->getValue();
        
        foreach($data as $subject){

            $all_subject[] = $subject;
        }

        return json_encode($all_subject);


    }


    public function eliminar (int $id){

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        $ref = $database-> getReference("usuario");

        $ref->getChild($id)->remove();

        $subjects = $ref->getValue();


        foreach($subjects as $subject){

            $all_subject[] = $subject;
        }

        return view('pages.cliente', compact('all_subject'));
    }

    


    
}
