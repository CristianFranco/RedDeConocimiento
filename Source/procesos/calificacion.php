<?php
    session_start();
    //require("class.phpmailer.php");
    header('Content-Type: application/json');
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $idUsr=$_SESSION['idUsuario'];
    $idPub=$_POST['idPub'];
    $cal=$_POST['calificacion'];
    $connection=connect();
    $res=array("estado"=>$idPub);
    $query="select * from Califica where idPublicacion=$idPub and idUsuario=$idUsr;";
    $result=$connection -> query($query);
    if($result->num_rows==0){
        $query="insert into Califica values($idPub,$idUsr,$cal)";
        $connection->query($query);
    }
    else{
        $query="update Califica set Puntaje=$cal where idUsuario=$idUsr and idPublicacion=$idPub;";
        $connection->query($query);
    }
    $query="SELECT avg(c.Puntaje) as promedio FROM Califica c where c.idPublicacion=$idPub;";
    $result=$connection -> query($query);
    $row=$result->fetch_array(MYSQLI_ASSOC);
    $prom=$row['promedio'];
    $query="update Publicacion set Puntaje=$prom where idPublicacion=$idPub;";
    $result=$connection -> query($query);
    /*while($row=$result->fetch_array(MYSQLI_ASSOC)){*/
        

    $res=array("resultado"=>$prom);
     echo json_encode($res);   
     
        
?>