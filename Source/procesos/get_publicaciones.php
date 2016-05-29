<?php
session_start();
include_once 'connection.php';
$conn = connect();
$query = <<<END
select Publicacion.*, Grupo.Nombre NombreGrupo, Usuario.Nombre Autor , Grupo.idGrupo 
    from Publicacion 
	join Publica on Publica.idPublicacion=Publicacion.idPublicacion
	join Usuario on Usuario.idUsuario=Publica.idUsuario
	left join Grupo on Publica.idGrupo=Grupo.idGrupo
END;

$result = $conn->query($query);
$response = ["publicaciones"=>[]];
while ($row = mysqli_fetch_assoc($result)) {
    $response["publicaciones"][] = $row;
}
$response["Query"] = $query;
$response ["Autor:"] = "Isaac";
header('Content-type: application/json');
echo json_encode($response);