<?php

session_start();
/* Traer lista de seguidores */
$querySeguidores = "select * from Sigue s join Usuario u on u.idUsuario=s.idUsuarioSeguidor  where s.idUsuario=".$_SESSION['idUsuario'];

/* Traer lista de personas a las que sigue */
$querySiguiendo = "select * from Sigue s join Usuario u on u.idUsuario=s.idUsuario  where s.idUsuarioSeguidor=". $_SESSION['idUsuario'];
include_once 'connection.php';
$conn = connect();
$response = [ "seguidores" => [], "seguidos" => []];
$result = $conn->query($querySeguidores);

while ($row = mysqli_fetch_assoc($result)) {
    $response["seguidores"][] = $row;
}
$result2 = $conn->query($querySiguiendo);
while ($row = mysqli_fetch_assoc($result2)) {
    $response["seguidos"][] = $row;
}
header('Content-type: application/json');
echo json_encode($response);
