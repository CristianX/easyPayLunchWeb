<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QR2Controller extends Controller
{
    public function qr(){
    	return view('QR/index');
    }
}
