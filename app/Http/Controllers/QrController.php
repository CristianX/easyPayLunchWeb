<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QrController extends Controller
{
    public function makeQR(){

    	$file=public_path('qr.png');
    	return \QRCode::text ('QR Code Generator for Laravel')->setOutfile($file) -> png ();  

    }
    public function vcard()
    {
    	// Personal Information
    $firstName = 'Alex';
    $lastName = 'Reyes';
    $title = 'Mr.';
    $email = 'aoreyes@espe.edu.ec';
    
    // Addresses
    $homeAddress = [
        'type' => 'home',
        'pref' => true,
        'street' => '123 my street st',
        'city' => 'Latacunga',
        'state' => 'LV',
        'country' => 'Ecuador',
        'zip' => '12345-678'
    ];
    $wordAddress = [
       'type' => 'work',
       'pref' => false,
       'street' => '123 my work street st',
       'city' => 'Latacunga',
       'state' => 'LV',
       'country' => 'Ecuador',
       'zip' => '12345-678'
    ];
    
    $addresses = [$homeAddress, $wordAddress];
    
    // Phones
    $workPhone = [
        'type' => 'work',
        'number' => '001 555-1234',
        'cellPhone' => false
    ];
    $homePhone = [
        'type' => 'home',
        'number' => '001 555-4321',
        'cellPhone' => false
    ];
    $cellPhone = [
        'type' => 'work',
        'number' => '001 9999-8888',
        'cellPhone' => true
    ];
    
    $phones = [$workPhone, $homePhone, $cellPhone];
    
    return \QRCode::vcard($firstName, $lastName, $title, $email, $addresses, $phones)
                
                ->setErrorCorrectionLevel('H')
                ->setSize(3)
                ->setMargin(10)
                ->svg();

    }
}
