<?php
require("procesos/connection.php");
$connection=connect();
$idGrupo=$_POST['idGrupo'];
$delete="DELETE FROM Grupo
WHERE Grupo.idGrupo=$idGrupo;";
$result4=$connection->query($sql);
header("index.php");

?>