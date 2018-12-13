<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrPagoController extends Controller
{
    public function qr(){
    	return view('QR/qr');
    }
	
}
