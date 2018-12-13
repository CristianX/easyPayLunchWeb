<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class PromocionController extends Controller
{
    public function index(){

    	$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/firebaseService.json');
        $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://easy-pay-lunch.firebaseio.com/')
        ->create();

        $database = $firebase->getDatabase();

        

        $ref = $database->getReference('Establecimiento/sdbhsdbvjnwihb/promocion');

        $subjects = $ref->getValue();
         
         
       
        foreach($subjects as $subject){

            $all_subject[] = $subject;
            
        }

        //return json_encode($all_subject);
       return view('promocion.index', compact('all_subject'));
        
    }

   
}
