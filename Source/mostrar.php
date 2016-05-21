<?php 
    //Inicio de sesión
    session_start();
    //Parámetros de sesión
    $idUsr=1;//$_SESSION["idUsuario"];
    $acceso=1;//$_SESSION['tipo'];
    
    //Parámetros externos
    $idPub=1;//$_POST['idPub']
    $uid=1;//$_POST['']
    $tipo="usuario";//$_POST['tipo']
    //Conexión y query's a la BD
    require("procesos/connection.php");
    $connection=connect();
    if($tipo=="grupo"){
        //OBTIENE LOS DATOS DEL GRUPO DE LA BASE DE DATOS Y LAS PUBLICACIONES DE ESTE
    $sql="SELECT idGrupo, Grupo.Nombre as NomGrupo, Grupo.Descripcion as descrip, AreaConocimiento.Nombre, AreaConocimiento.Descripcion FROM RCO.Grupo inner join  RCO.AreaConocimiento on  Grupo.IdAreaDeConocimiento=AreaConocimiento.idAreaConocimiento and Grupo.idGrupo=$uid;";
    $result=$connection->query($sql);
    $n=0;
     while($fila=$result->fetch_assoc()){
                        $usuario[$n]=$fila;
                        $n++;
                    }
        $sql2="SELECT 
        Usuario.Nickname,
        Fecha,
        Titulo,
        Publicacion.Descripcion as descrip,
        Grupo.Nombre,
        Grupo.Descripcion
    FROM
        Publicacion,
        Publica,
        Grupo,
        Usuario
    WHERE
        Usuario.idUsuario = Publica.idUsuario
            AND Publicacion.idPublicacion = Publica.idPublicacion
            AND Grupo.idGrupo = Publica.idGrupo
            AND Grupo.idGrupo=$uid;";
        $result2=$connection->query($sql2);
         $n=0;
        $publicacion=null;
         while($fila=$result2->fetch_assoc()){
                            $publicacion[$n]=$fila;
                            $n++;
                        }
    }else{
        //OBTIENE LOS DATOS DEL USUARIO DE LA BASE DE DATOS Y SUS PUBLICACIONES
    $sql="SELECT idUsuario, Nickname,Email,Telefono,Nombre,Apellidos FROM Usuario where idUsuario like $uid;";
    $result=$connection->query($sql);
    $n=0;
     while($fila=$result->fetch_assoc()){
                        $usuario[$n]=$fila;
                        $n++;
                    }
    $sql2="SELECT
    Usuario.Nickname,
    Fecha,
    Titulo,
    Publicacion.Descripcion as descrip,
    Grupo.Nombre,
    Grupo.Descripcion
FROM
    Publicacion,
    Publica,
    Grupo,
    Usuario
WHERE
    Usuario.idUsuario = Publica.idUsuario
        AND Publicacion.idPublicacion = Publica.idPublicacion
        AND Grupo.idGrupo = Publica.idGrupo
        AND Usuario.idUsuario=$uid;";
    $result2=$connection->query($sql2);
     $n=0;
    $publicacion=null;
     while($fila=$result2->fetch_assoc()){
                        $publicacion[$n]=$fila;
                        $n++;
                    }
    $sql3="SELECT idUsuario, idPublicacion, Comentario from  RCO.Comenta where idUsuario=$uid order by idPublicacion desc LIMIT 10;";
    $result3=$connection->query($sql3);
    $n=0;
    $comentarios=null;
    while($fila=$result3->fetch_assoc()){
        $comentarios[$n]=$fila;
        $n++;
    }
    }
?>


    <!DOCTYPE html>
    <html lang="es">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Publicacion</title>

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    </head>

    <body>
        <!-- Header -->
        <header>
            <?php require("header.php")?>
        </header>

        <!--Contenido de la página principal de @usuario -->
        <div class="row">
        </div>
        <div class="container">
            <?php
            
            if($tipo=="usuario"){
            $n;
            for($n=0;$n<count($result);$n++){
            echo "<div class=\"row\">
                <div>
                  <div class=\"card blue darken-1\">
                    <div class=\"card-content white-text \">
                      <span class=\"card-title\">".$usuario[$n]['Nickname']."</span>
                      <p>".$usuario[$n]['Nombre']." ". $usuario[$n]['Apellidos']."
                      <br>Correo: ".$usuario[$n]['Email']." 
                      <br>No. Telefónico: ". $usuario[$n]['Telefono']."
                      </p>
                    </div>
                  </div>
                </div>
              </div>";
            }
            echo "<div class=\"row\">
                <div>
                  <div class=\"card grey lighten-5\">
                    <div class=\"card-content grey-text\">
                      <span class=\"card-title\">Ultimos comentarios</span>";
            if($comentarios!=null){
            $n;
            for($n=0;$n<count($result);$n++){
            echo "<p>".$comentarios[n]['Comentario']."</p>";
                } 
            }else{
                echo "<p>".$usuario[0]['Nickname']." no ha realizado comentarios recientemente</p>";
            }
                echo "</div>
                  </div>
                </div>
              </div>";
            }else{
             $n;
            for($n=0;$n<count($result);$n++){
            echo "<div class=\"row\">
                <div>
                  <div class=\"card blue darken-1\">
                    <div class=\"card-content white-text \">
                      <span class=\"card-title\">".$usuario[$n]['NomGrupo']."</span>
                      <p>".$usuario[$n]['descrip']."
                      <br>Area de Conocimiento: ".$usuario[$n]['Nombre']."
                      <br>Descripción: ".$usuario[$n]['Descripcion']."
                      </p>
                    </div>
                  </div>
                </div>
              </div>";
            }   
            }
            if($publicacion!=null){
            for($n=0;$n<count($result2);$n++){
            echo "<div class=\"row\">
                <div>
                  <div class=\"card blue lighten-5\">
                    <div class=\"card-content \">
                      <span class=\"card-title\">".$publicacion[$n]['Nickname']." publicó ".$publicacion[$n]['Titulo']."</span>
                      <p>El ".$publicacion[$n]['Fecha']." 
                      <br>Descripcion: ".$publicacion[$n]['descrip']." 
                      <br>Nombre Grupo: ". $publicacion[$n]['Nombre']."
                      <br>Descripcion: ". $publicacion[$n]['Descripcion']."
                      </p>
                    </div>
                    <div class=\"card-action\">
                      <a href=\"#\">Ver Publicación</a>
                      <a href=\"#\">Ver Grupo</a>
                    </div>
                  </div>
                </div>
              </div>";
            }
            }else{
                echo "<div class=\"row\">
                <div>
                  <div class=\"card blue lighten-5\">
                    <div class=\"card-content \">
                      <span class=\"card-title\">".$publicacion[0]['Nickname']." no cuenta con publicaciones.</span>
                    </div>
                    <div class=\"card-action\">
                      <a href=\"#\">Ver Publicación</a>
                      <a href=\"#\">Ver Grupo</a>
                    </div>
                  </div>
                </div>
              </div>";
            }
            ?>
        </div>
        
        <div class="row">

        </div>

        <?php require("footer.php");?>


            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>

    </body>

    </html>