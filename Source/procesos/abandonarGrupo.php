<?php
require("connection.php");
$connection=connect();
$idGrupo=$_POST['idGrupo'];
$seguidor=$_POST['seguidor'];
$delete="DELETE FROM Usuario_Grupo
WHERE idGrupo=$idGrupo and idUsuario=$seguidor;";
$result4=$connection->query($delete);
header("Locataion:../index.php");

?>