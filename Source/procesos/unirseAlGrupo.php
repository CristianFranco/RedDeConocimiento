<?php
require("connection.php");
$connection=connect();
$idGrupo=$_POST['idGrupo'];
$seguidor=$_POST['seguidor'];
$seguir="INSERT INTO `RCO`.`Usuario_Grupo` (`idUsuario`,`idGrupo`,
`Estado`,`Notificar`)
VALUES ($seguidor,$idGrupo,1,1);";
$result4=$connection->query($seguir);

header("Location: ../index.php");

?>