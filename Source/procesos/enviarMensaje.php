<?php
header('Content-Type: application/json');
    session_start();
    require("connection.php");
    $connection=connect();
    
    //Parámetros POST
    $idUsuario=$_SESSION['idUsuario'];
    $mensaje=$_POST['mensaje'];
    $asunto=$_POST['asunto'];
    $destinatarios=$_POST["destinatarios"];
 

    for($x=0;$x<count($destinatarios);$x++){
        $query="INSERT INTO MandaMsn(idUsuario,idUsuario1,Mensaje,Fecha,Asunto,Visto,mostrar)VALUES('$idUsuario','$destinatarios[$x]','$mensaje',now(),'$asunto',1,1);";
        $connection->query($query);
    }
    $respuesta=array("estado"=>true);
   
    echo json_encode($respuesta);

?>