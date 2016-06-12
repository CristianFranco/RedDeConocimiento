<?php 
session_start();
require('connection.php');
$idusuario=$_SESSION['idUsuario'];
if (isset ($_POST['etiqueta']) ){
                   //etiquetas
    $idpublicacion='';//obtener ultima publicacion
    $connection = connect();
      $query = ("SELECT MAX(idPublicacion) as id FROM Publicacion");
   $result = $connection -> query($query);
    if ($result->num_rows > 0) { 
    $row = $result->fetch_assoc();
       $idpublicacion=$row['id']; 
       disconnect($connection);
    }
    //comprobar si ya existe
    $nombreetiqueta=$_POST['etiqueta'];
    $connection = connect();
      $query = ("SELECT idEtiqueta as id FROM Etiqueta where Nombre='$nombreetiqueta'");
   $result = $connection -> query($query);
    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $idetiqueta=$row['id']; 
        $connection = connect();
        $query = "INSERT INTO Publicacion_Etiqueta(idEtiqueta,idPublicacion) VALUES ('$idetiqueta','$idpublicacion')"; 
         $result = $connection -> query($query);
         disconnect($connection);
    }
    //si no existe
    else{
         $connection = connect();
         $query = "INSERT INTO Etiqueta(Nombre) VALUES ('$nombreetiqueta')"; 
         $result = $connection -> query($query);
         disconnect($connection);
         $connection = connect();
         $query = ("SELECT MAX(idEtiqueta) as id FROM Etiqueta");
         $result = $connection -> query($query);
         if ($result->num_rows > 0) { 
             $row = $result->fetch_assoc();
             $idetiqueta=$row['id']; 
             disconnect($connection);
             $connection = connect();
             $query = ("SELECT MAX(idPublicacion) as id FROM Publicacion");
             $result = $connection -> query($query);
             if ($result->num_rows > 0) { 
                 $row = $result->fetch_assoc();
                 $idpublicacion=$row['id']; 
                 $connection = connect();
                 $query = "INSERT INTO Publicacion_Etiqueta(idEtiqueta,idPublicacion) VALUES ('$idetiqueta','$idpublicacion')"; 
                 $result = $connection -> query($query);
                disconnect($connection);
              }
              
             
          }
    }
               }

//Datos del archivo 
$nombre_archivo = $_FILES['archivo']['name']; 
$tipo_archivo = $_FILES['archivo']['type']; 
$tamano_archivo = $_FILES['archivo']['size']; 
//$idpublicacion=1000;
 if($_POST['numero']==777)
 {
     
     $titulo=$_POST['titulo'];
     $descripcion=$_POST['descripcion'];
     $connection = connect();
     $datetime = date("Y-m-d");
     $query = "INSERT INTO Publicacion(Fecha,Tipo,Titulo,Descripcion,Reporte) VALUES (now(),0,'$titulo','$descripcion',0)"; 
     $result = $connection -> query($query);
     disconnect($connection);
     $connection = connect();
     $query = ("SELECT MAX(idPublicacion) as id FROM Publicacion");
     $result = $connection -> query($query);
     if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            $idpublicacion=$row['id']; 
            $dir= "../../publicaciones/".$row['id'];
            $dirmake = mkdir("$dir", 0777);             
            $connection = connect();
              if (isset ($_SESSION['idGrupo']) ){
                  $idGrupo=$_SESSION['idGrupo']; 
                  
                  $query = "INSERT INTO Publica(idPublicacion,idUsuario,idGrupo) VALUES ($idpublicacion,$idusuario,$idGrupo)";
               }
              else {
                   $query = "INSERT INTO Publica(idPublicacion,idUsuario,idGrupo) VALUES ($idpublicacion,$idusuario,null)";
                   }
   
     $result = $connection -> query($query);
     disconnect($connection);
        //echo $row.length;
}
    disconnect($connection);

 }
else if($_POST['numero']<777 && !isset ($_POST['etiqueta'])){
    
     $descripcion=$_POST['descripcion'];
    
     
  switch ($_POST['tipo']) {
      case 'archivo':
          $tipo=1;
          break;
      case 'imagen':
              $tipo=2;
              break;
     case 'video':
               $tipo=3;
               break;
     case 'audio':
            $tipo=4;
            break;          
      
      default:
          
          break;
  }
  $connection = connect();
      $query = ("SELECT MAX(idPublicacion) as id FROM Publicacion");
   $result = $connection -> query($query);
    if ($result->num_rows > 0) { 
    $row = $result->fetch_assoc();
       $idpublicacion=$row['id']; 
       disconnect($connection);
  $connection = connect();
    $query = "INSERT INTO Elemento(idPublicacion,Tipo,Directorio,Descripcion) VALUES ('$idpublicacion','$tipo','$nombre_archivo','$descripcion')"; 
    $result = $connection -> query($query);
    disconnect($connection);
    
     $destino="../../publicaciones/".$row['id']."/".$nombre_archivo;   //Directorio  destino  del  archivo  en  el servidor
if (move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)){ 
echo "El archivo ha sido cargado correctamente."; 

}else{ 
echo "Error en la carga del archivo."; 
}  
   }      //echo $row.length;
    
    
   
    
    
}
    
?>