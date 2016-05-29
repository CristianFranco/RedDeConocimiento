<?php 
	 session_start();
     require('connection.php');
     $conexion = connect();
     $nombre = $_POST['nombre'];
     $desc = $_POST['desc'];
     $idUser = $_POST['idUsr'];
     $conociminetoId = $_POST['conocimiento'];
     $grupo = array(); 
     $query="insert into Grupo (Nombre, Descripcion, IdAreaDeConocimiento) values ('".$nombre."','".$desc."',".$conociminetoId.");";
       if($conexion -> query($query)){
       		$queryTags="select idGrupo from Grupo where nombre = \"".$nombre."\" and Descripcion = '".$desc."' and IdAreaDeConocimiento = ".$conociminetoId.";";
     		$result = $conexion ->query($queryTags);
     		$extraido = mysqli_fetch_array($result);
		     while($extraido != NULL){
		        $query2 = "insert into Usuario_Grupo
		         (idUsuario, idGrupo, Estado, Notificar) values (".$idUser.",".$extraido["idGrupo"].",2,0);";
		         if($conexion -> query($query2)){
		         	$registro=array("Id"=>$extraido["idGrupo"],"success" => true);
        			array_push($grupo,$registro);
		         }else{
		         	$registro=array("Id"=>1,"success" => false);
        			array_push($grupo,$registro);
		         }
		         $extraido = mysqli_fetch_array($result);
		     }
       }else{
       		$registro=array("Id"=>1,"success" => false);
        	array_push($grupo,$registro);
       }
       echo json_encode($grupo);
       

?>