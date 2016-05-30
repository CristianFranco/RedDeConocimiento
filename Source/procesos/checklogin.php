<?php
    session_start();
    require("connection.php");
    $connection=connect();
    
    //Parámetros POST
    $usuario=$_POST['usuario'];
    $pass=$_POST['pass'];

    $respuesta=array();
    if(isset($usuario)&&isset($pass)){
        $qryInicio="select * from Usuario where Nickname='$usuario' and Password='$pass'";
        if($resInicio=$connection->query($qryInicio)){
            if($fila=$resInicio->fetch_array(MYSQLI_ASSOC)){
                $respuesta=array("estado"=>true);
                $_SESSION['idUsuario']=$fila['idUsuario'];
                $_SESSION['nickname']=$fila['Nickname'];
                $_SESSION['nombre']=$fila['Nombre'];
                $_SESSION['email']=$fila['Email'];
                $_SESSION['apellidos']=$fila['Apellidos'];
                $_SESSION['descripcion']=$fila['Descripcion'];
            }
            else
                $respuesta=array("estado"=>false,"msn"=>("Usuario y/o contraseña erronea"));
        }
        else{//error
            $respuesta=array("estado"=>false,"msn"=>"Problemas con el servidor intentelo más tarde");
            
        }
    }
    else{//redireccionar a index.php
        header('index.php');
    }

    echo json_encode($respuesta);

?>