<?php

session_start();
include_once 'connection.php';
$conn = connect();
$a = isset($_SESSION['idUsuario'])?1:0;
$where_usuario = $_GET['tipo']==='mios'?' AND ug.idUsuario='.$_SESSION['idUsuario']:'';
$area=filter_input(INPUT_GET,'area');
$categoria = ($area!=='todos')?' AND g.IdAreaDeConocimiento='.$area:'';
$query = <<<END
SELECT DISTINCT g.Nombre NombreGrupo
	,g.Descripcion
	,ac.Nombre AreaConocimiento
        ,ac.Descripcion DescAreaConocimiento
	,g.idGrupo
        ,g.IdAreaDeConocimiento
FROM Grupo g,
	Usuario u,
	Usuario_Grupo ug, 
	AreaConocimiento ac 
WHERE g.idGrupo = ug.idGrupo
        $where_usuario
        $categoria
        AND ug.idUsuario=u.idUsuario
        AND g.IdAreaDeConocimiento=ac.idAreaConocimiento
        LIMIT 10
END;

$result = $conn->query($query);
$response = ["grupos"=>[],"areas"=>[]];
while ($row = mysqli_fetch_assoc($result)) {
    $response["grupos"][] = $row;
}

$result2 = $conn->query('select idAreaConocimiento, Nombre from AreaConocimiento');
while ($row = mysqli_fetch_assoc($result2)) {
    $response["areas"][$row['idAreaConocimiento']]= $row['Nombre'];
}
if($area!=='todos'){
    $response['area_elegida']=$response["areas"][$area];
}else{
    $response['area_elegida']='todos';
}
header('Content-type: application/json');
echo json_encode($response);
