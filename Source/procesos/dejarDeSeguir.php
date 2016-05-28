<?php
require("connection.php");
$connection=connect();
$uid=$_POST['uid'];
$seguidor=$_POST['seguidor'];
$delete="DELETE FROM Sigue
WHERE Sigue.idUsuario=$uid AND Sigue.idUsuarioSeguidor=$seguidor;";
$result4=$connection->query($delete);
header("../index.php");
//** COMPROBAR QUE FUNCIONE EL QUERY
?>