<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PedidoController extends Controller
{
  public function index(){



      //return json_encode($all_subject);
     return view('pedido.pedido');








  }
}
