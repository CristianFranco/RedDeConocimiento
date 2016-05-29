<?php

session_start();
include_once 'connection.php';
$conn = connect();
$a = isset($_SESSION['idUsuario'])?1:0;
$where_usuario = $_GET['tipo']==='mios'?' AND ug.idUsuario='.$_SESSION['idUsuario']:'';
$query = <<<END
SELECT DISTINCT g.Nombre NombreGrupo
	,g.Descripcion
	,ac.Nombre AreaConocimiento
        ,ac.Descripcion DescAreaConocimiento
	,g.idGrupo
FROM Grupo g,
	Usuario u,
	Usuario_Grupo ug, 
	AreaConocimiento ac 
WHERE g.idGrupo = ug.idGrupo
        AND ug.idUsuario=u.idUsuario
	AND g.IdAreaDeConocimiento=ac.idAreaConocimiento
        $where_usuario
        LIMIT 10
END;

$result = $conn->query($query);
$response = ["grupos"=>[]];
while ($row = mysqli_fetch_assoc($result)) {
    $response["grupos"][] = $row;
}
$response["Query"] = $query;
$response ["Autor:"] = "Isaac";
$response["Tipo"]=$_GET["tipo"];
header('Content-type: application/json');
echo json_encode($response);
