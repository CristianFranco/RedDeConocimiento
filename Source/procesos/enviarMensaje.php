<?php
header('Content-Type: application/json');
    session_start();
    require("connection.php");
    $connection=connect();
    
    //Parámetros POST
    $idUsuario=1;//$_SESSION['idUsuario'];
    $mensaje=$_POST['mensaje'];
    $asunto=$_POST['asunto'];
    $destinatarios=$_POST["destinatarios"];
 

    for($x=0;$x<count($destinatarios);$x++){
        $query="INSERT INTO MandaMsn(idUsuario,idUsuario1,Mensaje,Fecha,Asunto,Visto,mostrar)VALUES('$idUsuario','$destinatarios[$x]','$mensaje','2016-05-21 18:28:58','$asunto',0,1);";
        $connection->query($query);
    }
    $respuesta=array("estado"=>true);
   
    echo json_encode($respuesta);

?>