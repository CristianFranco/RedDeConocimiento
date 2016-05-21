<?php
    require("connection.php");
    $connection=connect();
    
    //Parámetros POST
    $nickname=$_POST ['nickname'];
    $password=$_POST ['password'];
    $confirmar=$_POST ['confirmar'];
    $nombre=$_POST ['nombre'];
    $apellidos=$_POST ['apellidos'];
    $telefono=$_POST ['telefono'];
    $descripcion=$_POST ['descripcion'];
    
    
?>



<?php
    require("connection.php");
    $connection=connect();
    
    //Parámetros POST
    $usuario=$_POST['usuario'];
    $pass=$_POST['pass'];
    $respuesta=new array();
    if(isset($usuario)&&isset($contraseña)){
        $qryInicio="select * from Usuario where Nickname='$usuario' and Password='$pass'";
        $resInicio=$connection->query($query);
        if($resInicio){
            $fila=resInicio->fetch_array(MYSQLI_ASSOC);
            array_push($respuesta,"","","","");
        }
        else{//error
            
            
        }
    }
    else{//redireccionar a index.php
        
    }



?>