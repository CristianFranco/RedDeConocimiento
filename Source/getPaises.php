<?php
 session_start();
 require("connection.php");
    $connection=connect();
//    $idPais="AFG";
    $query="Select * From RCO.Pais;";
    $result=$connection -> query($query);
    $paises=array();
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        $pais=array("Id"=>$row['Codigo'],"Nombre"=>$row['Nombre']);
        array_push($paises,$pais);
    }
    echo json_encode($paises);
?>