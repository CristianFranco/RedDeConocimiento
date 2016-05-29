<?php

    
     session_start();
     require('connection.php');
     $conexion = connect();
     $queryTags="select * from Etiqueta;";
     $result = $conexion ->query($queryTags);
	 $extraido = mysqli_fetch_array($result);

//busquedaGen

     $nombre = $_POST['nombre'];
     $area = $_POST['area'];
     $tag = $_POST['tags'];
   //  $radios = $_POST['group1'];
	 $tags = array();
     $ids = array();
	 $idsAcepted = array();
     $idsAceptedArea = array();
     $hashMap = array();
     $cont = 0;

     if($nombre == ""){
        $nombre = "°|¬";
     }
     while($extraido != NULL){
        $tags[$cont]=$extraido["Nombre"];
        $ids[$cont++] = $extraido["idEtiqueta"];
    	$extraido = mysqli_fetch_array($result);
     }
    $idsAcepted = getArray($cont, $tag, $tags, $ids);
    $queryTags="select * from AreaConocimiento;";
     $result = $conexion ->query($queryTags);
     $extraido = mysqli_fetch_array($result);
    $cont2 = 0;
     while($extraido != NULL){
        $tags[$cont2]=$extraido["Nombre"];
        $ids[$cont2++] = $extraido["idAreaConocimiento"];
        $hashMap[$extraido["idAreaConocimiento"]] = $extraido["Nombre"];
        $extraido = mysqli_fetch_array($result);
     }

     $idsAceptedArea = getArray($cont2, $area, $tags, $ids);
     $str = "(";

     $cont = $cont -1;
     for($i=0;$i<sizeof($idsAcepted);$i++){
            $str = $i + 1 === sizeof($idsAcepted) ? $str."".$idsAcepted[$i].") " : $str."".$idsAcepted[$i].", "  ;
     }
     $str2 = "(";     
     $cont2 = $cont2 -1;
     for($i=0;$i<sizeof($idsAceptedArea);$i++){
            $str2 = $i + 1 === sizeof($idsAceptedArea) ? $str2."".$idsAceptedArea[$i].") " : $str2."".$idsAceptedArea[$i].", "  ;
     }
     if(sizeof($idsAceptedArea) === 0){
        $str2 = $str2."0)";  
     }
     if(sizeof($idsAcepted) === 0){
        $str = $str."0)";  
     }
     $finalQuery = "select DISTINCT  Grupo.* from Grupo,Publicacion, Publicacion_Etiqueta, Publica, Etiqueta
        where   
        LOWER(Grupo.Nombre) like LOWER('%".$nombre."%') or
        Grupo.IdAreaDeConocimiento in ".$str2." or
        (
        Etiqueta.idEtiqueta in ".$str." and
        Publicacion_Etiqueta.idEtiqueta = Etiqueta.idEtiqueta and
        Publicacion.idPublicacion = Publicacion_Etiqueta.idPublicacion and
        Publica.idPublicacion = Publicacion.idPublicacion and
        Publica.idGrupo = Grupo.idGrupo) ;";

    $finalQuery2 = "select distinct Usuario.* from Usuario, Publica, Publicacion_Etiqueta,Etiqueta, Publicacion
         where LOWER(Usuario.Nickname) like LOWER('%".$nombre."%')
        or (
        Etiqueta.idEtiqueta in ".$str." and
        Publica.idUsuario = Usuario.idUsuario and
        Publicacion_Etiqueta.idEtiqueta = Etiqueta.idEtiqueta and
        Publicacion_Etiqueta.idPublicacion = Publicacion.idPublicacion and
        Publica.idPublicacion = Publicacion.idPublicacion
        );";

    $result = $conexion ->query($finalQuery);
    $extraido = mysqli_fetch_array($result);
    $contFinal = 0;
    $grupoUsuarios = array();
     while($extraido != NULL){
        $queryCount = "select count(*) as cont from Usuario_Grupo where idGrupo =".$extraido["idGrupo"].";";
        $rest2 = $conexion ->query($queryCount);
        $extraido2 = mysqli_fetch_array($rest2);
        $con = 0;
        if($extraido2 != NULL){
            $con = $extraido2["cont"];
        }

        $registro=array("Id"=>$extraido["idGrupo"],"Nombre"=>$extraido["Nombre"], "Tipo" => 1, "seguidores" => $con,"area"=>
            $hashMap[$extraido["IdAreaDeConocimiento"]]);
        array_push($grupoUsuarios,$registro);
        $extraido = mysqli_fetch_array($result);
     }

     $result = $conexion ->query($finalQuery2);
    $extraido = mysqli_fetch_array($result);
    $contFinal = 0;
     while($extraido != NULL){
        $queryCount = "select count(*) as cont from Sigue where idUsuario = ".$extraido["idUsuario"].";";
        $rest2 = $conexion ->query($queryCount);
        $extraido2 = mysqli_fetch_array($rest2);
        $con = 0;
        if($extraido2 != NULL){
            $con = $extraido2["cont"];
        }
    
        $registro=array("Id"=>$extraido["idUsuario"],"Nombre"=>$extraido["Nickname"], "Tipo" => 2, "seguidores" => $con,"area"=>"null");
        array_push($grupoUsuarios,$registro);
        $extraido = mysqli_fetch_array($result);
     }



     echo json_encode($grupoUsuarios);

     function getArray($cont2, $area, $tags, $ids) {
         $porcent = 0;
     $acum = 0;
     $aux = 0;
     $cont12 = 0;
      $idsAcepted = array();
      if($area === ""){
        return $idsAcepted;
      }
     $tag2= array();
     $tag2 = explode(" ",$area);
     for($x=0;$x<sizeof($tag2) ; $x++){
         for( $i = 0 ; $i < $cont2 ; $i++){
            $myContAux = 0;
            if(sizeof($tags[$i]) >= sizeof($tag2[$x])){
                $myContAux = sizeof($tag2[$x]);
            }else{
                $myContAux = sizeof($tags[$i]);
            }
            for($j = 0 ; $j<$myContAux; $j++){
                $aux = sizeof($tag2[$x]);
                if(strtoupper ($tags[$i][$j]) == strtoupper ($tag2[$x][$j]) ){
                    $acum++;
                }
            }
            if($acum *100 / $aux >= 80){                
                $idsAcepted[$cont12++] = $ids[$i];
            }
            $acum = 0;
         }
     }
 
  
    return $idsAcepted;
}


    ?>
