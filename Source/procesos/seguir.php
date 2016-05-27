<?php
require("connection.php");
$connection=connect();
$uid=$_POST['uid'];
$seguidor=$_POST['seguidor'];
$seguir="INSERT INTO `RCO`.`Sigue` (`idUsuario`, `idUsuarioSeguidor`, `Notificar`) VALUES ($uid, $seguidor, 1);";
$result4=$connection->query($seguir);
echo $seguir;
echo $result4;

header("Location: ../index.php");

?>