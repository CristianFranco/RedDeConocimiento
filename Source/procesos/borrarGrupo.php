<?php
require("connection.php");
$connection=connect();
$idGrupo=$_POST['idGrupo'];
$delete="DELETE FROM Grupo
WHERE Grupo.idGrupo=$idGrupo;";
$result4=$connection->query($delete);
header("Location: ../index.php");

?>