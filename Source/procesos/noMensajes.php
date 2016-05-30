<?php
    session_start();
    if(isset($_SESSION["idUsuario"])){
        require('connection.php');
        $connection=connect();
        //$idSession=1;
        $idSession=$_SESSION["idUsuario"];
        $query="SELECT count(*) as Cuenta
                FROM MandaMsn MM
                WHERE MM.idUsuario1='$idSession' AND MM.visto=1;";
        $result=$connection->query($query);
        $row=$result->fetch_array(MYSQLI_ASSOC);
        $noMensajes=$row["Cuenta"];
        echo "$noMensajes";
    }
?>