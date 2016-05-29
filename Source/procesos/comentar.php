<?php
    session_start();
    //require("class.phpmailer.php");
    header('Content-Type: application/json');
    require("connection.php");
    //require("class.smtp.php");
    //Sacaremos los nombres de usuario registrados para ver que no se repitan
    $idUsr=$_SESSION['idUsuario'];
    $idPub=$_POST['idPub'];
    $comentario=$_POST['comentario'];
    $connection=connect();
    $res=array("estado"=>true);
    $fecha=date("Y-m-d G:i:s");
    $query="insert into Comenta values($idUsr,$idPub,'$comentario',0,'$fecha');";
    $result=$connection -> query($query);
    
    
    /*while($row=$result->fetch_array(MYSQLI_ASSOC)){*/
        

     echo json_encode($res);   
     
        
?>