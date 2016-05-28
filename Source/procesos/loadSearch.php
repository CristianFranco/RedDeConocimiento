<?php
    session_start();
    require('connection.php');
    $connection=connect();
    $idSession=$_SESSION["idUsuario"];
    //$idSession=1;
    $opt=$_GET["opt"];
    $mensajes=array();
    if($opt==0){
        $criteria=$_GET["criteria"];
        $box=$_GET["box"];
        if($box==0){
            $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha, MM.mostrar
                    FROM Usuario U, MandaMsn MM
                    WHERE MM.idUsuario1='$idSession' AND MM.mostrar=1 AND MM.idUsuario=U.idUsuario AND (U.Nickname LIKE '%$criteria%' OR MM.Asunto LIKE '%$criteria%' OR MM.Mensaje LIKE '%$criteria%')
                    ORDER BY MM.Fecha;";
        }else{
            $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha
                    FROM Usuario U, MandaMsn MM
                    WHERE MM.idUsuario='$idSession' AND MM.idUsuario1=U.idUsuario AND (U.Nickname LIKE '%$criteria%' OR MM.Asunto LIKE '%$criteria%' OR MM.Mensaje LIKE '%$criteria%')
                    ORDER BY MM.Fecha;";
        }
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        echo json_encode($mensajes);
    }elseif($opt==1){
        $query="UPDATE MandaMsn
                SET Visto=0
                WHERE MandaMsn.idUsuario1='$idSession'";
        $connection->query($query);
        $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha, MM.mostrar
                FROM Usuario U, MandaMsn MM
                WHERE MM.idUsuario1='$idSession' AND MM.mostrar=1 AND MM.idUsuario=U.idUsuario
                ORDER BY MM.Fecha;";
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        echo json_encode($mensajes);
    }elseif($opt==2){
        $query="UPDATE MandaMsn
                SET mostrar=0
                WHERE MandaMsn.idUsuario1='$idSession'";
        $connection->query($query);
        $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha, MM.mostrar
                FROM Usuario U, MandaMsn MM
                WHERE MM.idUsuario1='$idSession' AND MM.mostrar=1 AND MM.idUsuario=U.idUsuario
                ORDER BY MM.Fecha;";
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        echo json_encode($mensajes);
    }elseif($opt==3){
        $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha
                FROM Usuario U, MandaMsn MM
                WHERE MM.idUsuario='$idSession' AND MM.idUsuario1=U.idUsuario
                ORDER BY MM.Fecha;";
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        echo json_encode($mensajes);
    }elseif($opt==4){
        $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha, MM.mostrar
                FROM Usuario U, MandaMsn MM
                WHERE MM.idUsuario1='$idSession' AND MM.mostrar=1 AND MM.idUsuario=U.idUsuario
                ORDER BY MM.Fecha;";
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        echo json_encode($mensajes);
    }elseif($opt==5){
        $idMsj=$_GET["msjIndex"];
        $msjs=json_decode($_COOKIE["Mensajes"],true);
        $msj=$msjs[$idMsj];
        $query="UPDATE MandaMsn
                SET mostrar=0
                WHERE ID=$msj[ID];";
        $connection->query($query);
        $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha, MM.mostrar
                FROM Usuario U, MandaMsn MM
                WHERE MM.idUsuario1='$idSession' AND MM.mostrar=1 AND MM.idUsuario=U.idUsuario
                ORDER BY MM.Fecha;";
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        echo json_encode($mensajes);
    }
?>