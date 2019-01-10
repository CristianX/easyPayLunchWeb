<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Image;

class UserController extends Controller
{
    //

    //funcion para el perfil de usuario
    public function profile(){

      return view('usuario.profile', array('user' => Auth::user()) );

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
