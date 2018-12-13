<?php
	//Agregamos la libreria para genera códigos QR
	
	
	//Declaramos una carpeta temporal para guardar la imagenes generadas
	$dir = 'temp/';
	
	//Si no existe la carpeta la creamos
	if (!file_exists($dir))
        mkdir($dir);
	
        //Declaramos la ruta y nombre del archivo a generar
	$filename = $dir.'producto.png';
 
        //Parametros de Condiguración
	
	$tamanio = 10; //Tamaño de Pixel
	$level = 'M'; //Precisión Baja
	$frameSize = 3; //Tamaño en blanco
	$contenido = "5"; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamanio, $frameSize); 
	
        //Mostramos la imagen generada
	echo '<img src="'.$filename.'" />';  
?>