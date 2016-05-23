<?php 
    //Inicio de sesión
    session_start();
    //Parámetros de sesión
    $idUsr=1;//$_SESSION["idUsuario"];
    $acceso=1;//$_SESSION['tipo'];
    
    //Parámetros externos
    $idPub=1;//$_POST['idPub']

    //Conexión y query's a la BD
    require("procesos/connection.php");
    $connection=connect();
    $queryPub="SELECT * FROM Publicacion where idPublicacion=$idPub;";
    $resPub=$connection->query($queryPub);
    $filaPub=$resPub->fetch_array(MYSQLI_ASSOC);
    $fecha = $filaPub['Fecha'];
    $dt = new DateTime($fecha);


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
        <script src="../frameworks/js/jquery.mobile-1.4.5.min.js"></script>
        <script>
            var estado = <?php if(isset($_SESSION['idUsuario'])) echo "true";else echo "false"; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>

    <body>
        <!-- Header -->
        <header>
            <?php require("header.php")?>
        </header>

        <!--Contenido de la publicación -->
        <div class="container">
            <div class="row">
                <!-- Titulo de la puclicación -->
                <div class="col s12 m8">
                    <h4><?=$filaPub['Titulo']?></h4>
                </div>
                <div class="col s12 m4">
                    <h5><?=$dt->format('Y-m-d')?>
                    <i class="material-icons yellow-text text-accent-3">star</i>
                    <i class="material-icons yellow-text text-accent-3">star</i>
                    <i class="material-icons yellow-text text-accent-3">star</i>
                    <i class="material-icons yellow-text text-accent-3">star</i>
                    <i class="material-icons yellow-text text-accent-3">star</i>
                    </h5>
                </div>
                <!-- Menú de la publicación-->

                <nav class="col s12 principal">

                    <div class=" nav-wrapper ">
                        <a id="mobilePubButton" href="#" data-activates="mobilePub" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul id="navPub " class="left hide-on-med-and-down ">
                            <li><a href="" id="pubDescButton"><i class="material-icons left" >info</i>&nbsp;</a>

                            </li>
                            <li><a href="" id="pubImgButton">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">photo_camera</i>    
                        </a></li>
                            <li><a href="" id="pubVidButton">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">videocam<!--movie--></i>    
                        </a></li>
                            <li><a href="" id="pubAudButton">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">audiotrack</i> 
                        </a></li>
                            <li><a href="" id="pubDocButton">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">description</i> 
                        </a></li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">book</i> 
                        </a></li>
                            <li><a href="" id="pubComButton">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">sms</i> 
                        </a></li>
                        </ul>
                        <ul class="side-nav" id="mobilePub">
                            <li><a href="#"><i class="material-icons left" >info</i>&nbsp;</a>

                            </li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">photo_camera</i>    
                        </a></li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">videocam<!--movie--></i>    
                        </a></li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">audiotrack</i> 
                        </a></li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">description</i> 
                        </a></li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">book</i> 
                        </a></li>
                            <li><a href="# ">
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">sms</i> 
                        </a></li>
                        </ul>
                    </div>
                </nav>

                <div id="pubDesc" class="col s12 grey lighten-2 " style="min-height:65vh; ">
                    <p>
                    </p>

                </div>
                <div id="pubImg" class="col s12 grey lighten-2 " style="min-height:65vh; ">
                    <video width="400" controls>
                        <source src="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" type="video/mp4">
                    </video>

                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" target="_blank">Ver en pantalla completa en una nueva ventana</a>.
                    <br>
                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" download>Descargar</a>.


                </div>
                <div id="pubVid" class="col s12 grey lighten-2 " style="min-height:65vh; ">
                    <video width="400" controls>
                        <source src="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" type="video/mp4">
                    </video>

                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" target="_blank">Ver en pantalla completa en una nueva ventana</a>.
                    <br>
                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" download>Descargar</a>.


                </div>
                <div id="pubAud" class="col s12 grey lighten-2 " style="min-height:65vh; ">
                    <video width="400" controls>
                        <source src="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" type="video/mp4">
                    </video>

                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" target="_blank">Ver en pantalla completa en una nueva ventana</a>.
                    <br>
                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" download>Descargar</a>.


                </div>
                <div id="pubDoc" class="col s12 grey lighten-2 " style="min-height:65vh; ">
                    <video width="400" controls>
                        <source src="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" type="video/mp4">
                    </video>

                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" target="_blank">Ver en pantalla completa en una nueva ventana</a>.
                    <br>
                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" download>Descargar</a>.


                </div>
                <div id="pubCom" class="col s12 grey lighten-2 " style="min-height:65vh; ">
                    <video width="400" controls>
                        <source src="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" type="video/mp4">
                    </video>

                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" target="_blank">Ver en pantalla completa en una nueva ventana</a>.
                    <br>
                    <a href="../publicaciones/Kamisama%20Onegai%20-Kamisama%20Hajimemashita%20(Ending)%20(Kurama%20Version)%20(with%20Lyrics)%20(720p).mp4" download>Descargar</a>.


                </div>
                <!-- Controles de navegación -->
                <div id="controles " class="col s12 grey lighten-1 " style="height:5vh; ">
                    <div class="center-align ">
                        <i class="material-icons ">first_page</i>
                        <i class="material-icons ">keyboard_arrow_left</i>
                        <span>1 2 3 4</span>
                        <i class="material-icons ">keyboard_arrow_right</i>
                        <i class="material-icons ">last_page</i>

                    </div>
                </div>
            </div>
        </div>
        <div class="row ">

        </div>

        <?php require("footer.php ");?>


            <!-- Compiled and minified JavaScript -->
            <script src="../frameworks/js/materialize.min.js"></script>
            <script>
                var textoDesc = "<?=$filaPub['Descripcion']?>";
                var palabras = textoDesc.split(/(\s+)/);
            </script>
            <script src="../JS/publicacion.js"></script>
            <script src="../JS/header.js"></script>

    </body>

    </html>