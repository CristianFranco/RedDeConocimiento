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
            $row=resInicio->fetch_results();
        }
        else{//error
            
            
        }
    }
    else{//redireccionar a index.php
        
    }



?>