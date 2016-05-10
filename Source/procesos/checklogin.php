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