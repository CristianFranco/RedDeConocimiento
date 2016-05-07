<?php

session_start();
    require('connection.php');
     $conexion = connect();
     $queryTags="select * from Etiqueta;";
     $result = $conexion ->query($queryTags);
	 $extraido = mysqli_fetch_array($result);

	 $tags = array();
	 $cont = 0;
     while($extraido != NULL){
        $tags[$cont++]=$extraido["Nombre"];
        echo "".$tags[$cont -1]."<br>";
        
    	$extraido = mysqli_fetch_array($result);
     }
    ?>