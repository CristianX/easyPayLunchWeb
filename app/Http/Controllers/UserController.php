<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Image;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class UserController extends Controller
{
    //

    //funcion para el perfil de usuario
    public function profile(){

      $user = Auth::user();
      $id = $user->name;

      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();
        $database = $firebase->getDatabase();
       
        $ref = $database->getReference('establecimiento/'.$id.'/informacion');
        $informacion[$id] = $ref->getValue();

      return view('usuario.profile', compact('informacion') );

    }

    //funcion para actualizar el avatar(imagen) del usuario
    public function update_avatar(Request $request){

      if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300, 300)->save(public_path('/dist/img/' . $filename));

        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
      }

      return view('usuario.profile', array('user' => Auth::user()) );
    }

}
