<?php
    session_start();
    //require("class.phpmailer.php");
    header('Content-Type: application/json');
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $idUsr=$_SESSION['idUsuario'];
    $idPub=$_POST['idPub'];
    $offset=$_POST['offset'];
    $connection=connect();
    $query="select * from Comenta c,Usuario u where c.idPublicacion=$idPub and c.idUsuario=u.idUsuario order by Fecha asc LIMIT 10000  OFFSET $offset;";
    $result=$connection->query($query);
    $rows=array();
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
       $temp=array("comentario"=>$row['Comentario'],"fecha"=>$row['Fecha'],"nickname"=>$row['Nickname']);
        array_push($rows,$temp);
    }
    /*
    
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        array_push($rows,$row['Fecha']);
    }
        */
    $res=array("estado"=>true,"comentarios"=>$rows);
     echo json_encode($res);   
     
        
?>