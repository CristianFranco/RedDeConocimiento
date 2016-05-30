<?php
    session_start();
    //require("class.phpmailer.php");
    header('Content-Type: application/json');
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $idPub=$_GET['idPub'];
    $connection=connect();
    $query="delete from Publicacion_Etiqueta where idPublicacion=$idPub;";
    $result=$connection->query($query);
    $query="delete from Elemento where idPublicacion=$idPub;";
    $result=$connection->query($query);
    $query="delete from Publica where idPublicacion=$idPub;";
    $result=$connection->query($query);
    $query="delete from Comenta where idPublicacion=$idPub;";
    $result=$connection->query($query);
    $query="delete from Califica where idPublicacion=$idPub;";
    $result=$connection->query($query);
    $query="delete from Publicacion where idPublicacion=$idPub;";
    $result=$connection->query($query);
    echo $idPub;
    
    /*
    
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        array_push($rows,$row['Fecha']);
    }
        */
    //$res=array("estado"=>true);
     header("Location: ../index.php");
        
?>