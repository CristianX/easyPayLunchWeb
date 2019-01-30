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

    $user = Auth::user();
    $id = $user->name;

    $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
    $firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
    ->create();

    $database = $firebase->getDatabase();

    $ref = $database->getReference('establecimiento/'.$id.'/interaccionUsuario');
    $subjects = $ref->getValue();

    foreach($subjects as $subject){

        $all_subject[] = $subject;
    }
   return view('pedido', compact('all_subject'));

  }
}
