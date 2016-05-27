<?php
  session_start();  
  require("connection.php");
    $connection=connect();
    
    //Parámetros POST
    $nickname=$_POST ['nickname'];
    $password=$_POST ['password'];
    //$confirmar=$_POST ['confirmar'];
    $nombre=$_POST ['nombre'];
    $apellidos=$_POST ['apellidos'];
    $telefono=$_POST ['telefono'];
    $descripcion=$_POST ['descripcion'];
    $pais=$_POST ['pais'];
    $ciudad=$_POST['ciudad'];
    
    $query="INSERT INTO Usuario (Nickname,Password,Telefono,Nombre,Apellidos,idCiudad,Descripcion) VALUES ('".$nickname."','".$pass."','".$telefono."','".$nombre."','".$apellidos."',".$ciudad.",'".$descripcion."');";

?>
