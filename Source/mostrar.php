<?php 
    //Inicio de sesión
    session_start();
    //Parámetros de sesión
    $idUsr=1;//$_SESSION["idUsuario"];
    $acceso=1;//$_SESSION['tipo'];
    $uid=null;
    $tipo=null;
    $bandera=false; //la publicación fue echa en un grupo
    //Parámetros externos
    $idPub=1;//$_POST['idPub']
    $uid=$_POST['uid'];
    $tipo=$_POST['tipo'];
    //Conexión y query's a la BD
    require("procesos/connection.php");
    $connection=connect();
    if($tipo=="grupo"){
            //OBTIENE LOS DATOS DEL GRUPO DE LA BASE DE DATOS Y LAS PUBLICACIONES DE ESTE
            //OBTIENE LOS DATOS DEL GRUPO
        $check="SELECT idUsuario, idGrupo, Estado, Notificar FROM RCO.Usuario_Grupo where idUsuario=$idUsr;";
        $result4=$connection->query($check);
        $n=0;
        $admin;
         while($fila=$result4->fetch_assoc()){
                            $admin[$n]=$fila;
                            $n++;
                        }
        
        $sql="SELECT idGrupo, Grupo.Nombre as NomGrupo, Grupo.Descripcion as descrip, AreaConocimiento.Nombre, AreaConocimiento.Descripcion FROM RCO.Grupo inner join  RCO.AreaConocimiento on  Grupo.IdAreaDeConocimiento=AreaConocimiento.idAreaConocimiento and Grupo.idGrupo=$uid;";
        $result=$connection->query($sql);
        $n=0;
         while($fila=$result->fetch_assoc()){
                            $usuario[$n]=$fila;
                            $n++;
                        }
            //OBTIENE LAS PUBLICACIONES QUE SE HAN HECHO EN ESTE GRUPO
            $sql2="SELECT 
            Publicacion.idPublicacion,
            Usuario.Nickname,
            Fecha,
            Titulo,
            Publicacion.Descripcion as descrip,
            Grupo.Nombre,
            Grupo.Descripcion,
            Grupo.idGrupo
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
        //OBTIENE LOS USUARIOS DENTRO DEL GRUPO
        $sql3="SELECT 
    Usuario.idUsuario, Usuario.Nickname FROM Usuario_Grupo, Usuario, Grupo WHERE Usuario_Grupo.idGrupo = Grupo.idGrupo
     AND Usuario_Grupo.idUsuario = Usuario.idUsuario AND Usuario_Grupo.idGrupo = 1 AND Usuario_Grupo.Estado in (1,2) LIMIT 10;";
        $result3=$connection->query($sql3);
        $n=0;
        $miembros=null;
        while($fila=$result3->fetch_assoc()){
            $miembros[$n]=$fila;
            $n++;
        }
    }else{
        //OBTIENE LOS DATOS DEL USUARIO DE LA BASE DE DATOS Y SUS PUBLICACIONES
        //OBTIENE LOS DATOS DEL USUARIO
        $sql="SELECT idUsuario, Nickname,Email,Telefono,Nombre,Apellidos FROM Usuario where idUsuario like $uid;";
        $result=$connection->query($sql);
        $n=0;
         while($fila=$result->fetch_assoc()){
                            $usuario[$n]=$fila;
                            $n++;
                        }
        //OBTIENE LAS PUBLICACIONES DEL USUARIO
        $sql2="SELECT
                    Publicacion.idPublicacion,
                    Usuario.Nickname,
                    Fecha,
                    Titulo,
                    Publicacion.Descripcion as descrip,
                    Grupo.Nombre,
                    Grupo.Descripcion,
                    Grupo.idGrupo
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
            if($result2==null){
                $sql2="SELECT DISTINCT
                            Publicacion.idPublicacion,
                            Usuario.Nickname,
                            Fecha,
                            Titulo,
                            Publicacion.Descripcion AS descrip
                        FROM
                            Publicacion,
                            Publica,
                            Grupo,
                            Usuario
                        WHERE
                            Usuario.idUsuario = Publica.idUsuario
                                AND Publicacion.idPublicacion = Publica.idPublicacion
                                AND Usuario.idUsuario = $uid;";  
                $result2=$connection->query($sql2);
                $bandera=true;//publicación hecha sin grupo
            }
         $n=0;
        $publicacion=null;
         while($fila=$result2->fetch_assoc()){
                            $publicacion[$n]=$fila;
                            $n++;
                        }

        //OBTIENE LOS COMENTARIOS QUE HA REALIZADO EL USUARIO ULTIMAMENTE
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
        <link rel="stylesheet" href="../frameworks/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-2.1.0.min.js" integrity="sha256-8oQ1OnzE2X9v4gpRVRMb1DWHoPHJilbur1LP9ykQ9H0=" crossorigin="anonymous"></script>
        
        <script>
            var idEstilo = <?php if(isset($_SESSION['idUsuario'])) echo $_SESSION['idUsuario']; else echo 0; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
    <body>
        <!-- Header -->
        <header>
            <?php require("header.php")?>
        </header>

        <!--Contenido de la página principal de @usuario -->
        <main>
        
        
        <div class="container">
            <?php
            // SI SE BUSCA UN USUARIO SE REALIZA EL SIGUIETE CODIGO
            if($tipo=="usuario"){
            $n;
            for($n=0;$n<count($result);$n++){
            //SE IMPRIMEN LOS DATOS DEL USUARIO DENTRO DE UNA TARJETA
            echo "<div class=\"row \">
                <div>
                  <div class=\"card\">
                    <div class=\"card-content principal\">
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
            //SE IMIPRIMEN LOS COMENTARIOS DEL USUARIO DENTRO DE UNA SOLA TARJETA
            echo "<div class=\"row\">
                <div>
                  <div class=\"card \">
                    <div class=\"card-content secundario\">
                      <span class=\"card-title\">Ultimos comentarios</span>";
            //SI EXISTE COMENTARIOS LOS IMPRIME
            if($comentarios!=null){
            $n;
            for($n=0;$n<=count($result3);$n++){
            echo "<p>".$comentarios[$n]['Comentario']."</p><form method=\"POST\">
                            <input type=\"hidden\" name=\"uid\" value=\"".$comentarios[$n]['idPublicacion']."\"> 
                          <input class=\"btn icoP\" type=\"submit\" formaction=\"mostrar.php\" value=\"Ver Usuario\">
                        </form>";
                } 
            }else{
                //SI NO IMPRIME LO SIGUIENTE
                echo "<p>".$usuario[0]['Nickname']." no ha realizado comentarios recientemente</p>";
            }
                echo "</div>
                  </div>
                </div>
              </div>";
                
            //SI SE BUSCA UN GRUPO SE REALIZA EL SIGUIENTE CÓDIGO    
            }else{
             $n;
            //SE MUESTRAN LOS DATOS DEL GRUPO EN UNA TARJETA AZUL OBSCURO
            for($n=0;$n<count($result);$n++){
                echo "<div class=\"row\">
                <div>
                  <div class=\"card\">
                    <div class=\"card-content principal \">
                      <span class=\"card-title\">".$usuario[$n]['NomGrupo']."</span>
                      <p>".$usuario[$n]['descrip']."
                      <br>Area de Conocimiento: ".$usuario[$n]['Nombre']."
                      <br>Descripción: ".$usuario[$n]['Descripcion']."
                      </p>";
                         //si es el admin del grupo se imprime la opción de eliminarl el grupo
                       if($admin[$n]['idUsuario']==$idUsr and $admin[$n]['Estado']==2){
                      echo "<form method=\"POST\">
                            <input type=\"hidden\" name=\"idGrupo\" value=\"".$admin[$n]['idGrupo']."\"> 
                          <input class=\"btn\" type=\"submit\" formaction=\"borrarGrupo.php\" value=\"Eliminar Grupo\">
                        </form>";
                        }
                    echo "</div>
                  </div>
                </div>
              </div>";
              
            }
           
              
                
                //imprime los miembros del grupo en una tarjeta blanca
             echo "<div class=\"row\">
            <div>
              <div class=\"card\">
                <div class=\"card-content secundario\">
                  <span class=\"card-title\">Miembros del Grupo</span>";
            //SI EXISTEN MIEMBROS EN EL GRUPO LOS IMPRIME EN LA TARJETA
            if($miembros!=null){
            for($n=0;$n<=count($result3);$n++){
            echo "<p>".$miembros[$n]['Nickname']."<form method=\"POST\">
                            <input type=\"hidden\" name=\"tipo\" value=\"usuario\" />
                            <input type=\"hidden\" name=\"uid\" value=\"".$miembros[$n]['idUsuario']."\"> 
                          <input class=\"btn\" type=\"submit\" formaction=\"mostrar.php\" value=\"Ver Usuario\">
                        </form></p>";
                }
            //SI NO, IMPRIME LO SIGUIENTE
            }else{
                echo "<p>".$usuario[0]['NomGrupo']." no tiene miembros aún</p>";
            }
                echo "</div>
                  </div>
                </div>
              </div>";
                
            }
           //IMPRIME LA PUBLICACION YA SEA DE UN USUARIO O DE UN GRUPO
            if($publicacion!=null){
                if($bandera==false){
                for($n=0;$n<count($result2);$n++){
                echo "<div class=\"row\">
                    <div>
                      <div class=\"card \">
                        <div class=\"card-content secundario\">
                          <span class=\"card-title\">".$publicacion[$n]['Nickname']." publicó ".$publicacion[$n]['Titulo']."</span>
                          <p>El ".$publicacion[$n]['Fecha']." 
                          <br>Descripcion: ".$publicacion[$n]['descrip']." 
                          <br>Nombre Grupo: ". $publicacion[$n]['Nombre']."
                          <br>Descripcion: ". $publicacion[$n]['Descripcion']."
                          </p>
                        </div>
                        <div class=\"card-action\">
                        <form method=\"POST\">
                            <input type=\"hidden\" name=\"tipo\" value=\"grupo\" />
                            <input type=\"hidden\" name=\"idPublicacion\" value=\"".$publicacion[$n]['idPublicacion']."\">
                            <input type=\"hidden\" name=\"uid\" value=\"".$publicacion[$n]['idGrupo']."\"> 
                          <input class=\"btn\" type=\"submit\" formaction=\"publicacion.php\" value=\"Ver Publicación\">
                          <input class=\"btn\" type=\"submit\" formaction=\"mostrar.php\" value=\"Ver Grupo\">
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>";
                }
                }else{
                    for($n=0;$n<count($result2);$n++){
                    echo "<div class=\"row\">
                        <div>
                          <div class=\"card \">
                            <div class=\"card-content secundario\">
                              <span class=\"card-title\">".$publicacion[$n]['Nickname']." publicó ".$publicacion[$n]['Titulo']."</span>
                              <p>El ".$publicacion[$n]['Fecha']." 
                              <br>Descripcion: ".$publicacion[$n]['descrip']." 
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
                }
            }else{
                //SI NO SE TIENEN PUBLICACIONES ENTONCES SE MUESTRA LO SIGUIENTE
                echo "<div class=\"row\">
                <div>
                  <div class=\"card blue \">
                    <div class=\"card-content secundario \">
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
            </main>
        <?php require("footer.php");?>
    <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>

    </body>

    </html>