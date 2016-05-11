<?php

     session_start();
     require('connection.php');
     $conexion = connect();
     $queryTags="select * from Etiqueta;";
     $result = $conexion ->query($queryTags);
	 $extraido = mysqli_fetch_array($result);
     $tag = $_POST['tag_publi'];
	 $tags = array();
     $ids = array();
	 $idsAcepted = array();

     $cont = 0;
     while($extraido != NULL){
        $tags[$cont]=$extraido["Nombre"];
        $ids[$cont++] = $extraido["idEtiqueta"];
        echo "".$tags[$cont -1]."<br>";
    	$extraido = mysqli_fetch_array($result);
     }

     $porcent = 0;
     $acum = 0;
     $aux = 0;
     $cont1 = 0;

     for( $i = 0 ; $i < $cont ; $i++){
        for($j = 0 ; $j<sizeof($tags[$i]) || $j<sizeof($tag); $j++){
            $aux = sizeof($tags[$i]);
            if(strtoupper ($tags[$i][$j]) == strtoupper ($tag[$j]) ){
                $acum++;
            }
        }
        if($acum *100 / $aux >= 80){
            $idsAcepted[$cont1++] = $ids[$i];
            echo $tags[$i]."<br>";
        }
        $acum = 0;
     }


    ?>