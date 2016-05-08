<?php
    session_start();
    require("connection.php");
    $connection=connect();
    $idPais="AFG";
//    $idPais=$_POST['idPais'];
    $query="select * from Ciudad where CodigoPais='$idPais'";
    $result=$connection -> query($query);
    $ciudades=array();
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        $ciudad=array("Id"=>$row['ID'],"Nombre"=>$row['Nombre']);
        array_push($ciudades,$ciudad);
    }
    echo json_encode($ciudades);
?>