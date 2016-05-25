
<html>
<head>
    
    </head>
<body>
<?php
    session_start();
$usr=$_GET['IdUsr'];
 //echo $usr;
    //echo "<br/>";
    $codig=$_GET['confirmacion'];
    //echo $codig;
    require("procesos/connection.php");
    $connection=connect();
    $query="UPDATE Usuario SET Estado=1 WHERE IdUsuario='".$usr."' AND CodigoAc=".$codig.";";
    if($connection -> query($query)){
        echo "Su cuenta de la red de conocimiento ya ha sido activada con exito.....";
        echo"</br>Espere mientras lo redirecciona a la pagina principal";
    }
     
?>  
    </body>
    <script>
    
    setTimeout(function(e){
        window.location="index.php";
    },5000);
    </script>
</html>