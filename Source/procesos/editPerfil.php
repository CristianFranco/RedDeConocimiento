<?php
  session_start();
    //require("class.phpmailer.php");
    header('Content-Type: application/json');
    //require("class.phpmailer.php");
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $connection=connect();
  
    //Parámetros POST
    $nickname=$_POST ['nickname'];
    $_SESSION['nickname']=$nickname;
    $password=$_POST ['password'];
    //$confirmar=$_POST ['confirmar'];
    $nombre=$_POST ['nombre'];
    $_SESSION['nombre']=$nombre;
    $apellidos=$_POST ['apellidos'];
    $telefono=$_POST ['telefono'];
    $descripcion=$_POST ['descripcion'];
    $pais=$_POST ['pais'];
    $ciudad=$_POST['ciudades'];
    $id=$_SESSION['idUsuario'];
    //$query="UPDATE Usuario SET Estado=1 WHERE IdUsuario='".$usr."' AND CodigoAc=".$codig.";";    
    $query="UPDATE Usuario SET Nickname = '$nickname', Password = '$password', Nombre = '$nombre', Apellidos = '$apellidos',Telefono = '$telefono', Descripcion = '$descripcion', idCiudad = '$ciudad' WHERE idUsuario = '$id'";   
    $res=array();
    if($result=$connection->query($query)){
        $res=array("estado"=>true,"msg"=>$query);
    }else{
        $res=array("estado"=>false,"msg"=>"Nickname repetido");
    }
    //(Nickname,Password,Telefono,Nombre,Apellidos,idCiudad,Descripcion) VALUES ('".$nickname."','".$pass."','".$telefono."','".$nombre."','".$apellidos."',".$ciudad.",'".$descripcion."');";
    echo json_encode($res);
?>
