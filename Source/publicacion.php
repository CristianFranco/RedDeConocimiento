<?php 
    //Inicio de sesión
    session_start();
    //Parámetros de sesión
    $idUsr=1;//$_SESSION["idUsuario"];
    $acceso=1;//$_SESSION['tipo'];
    
    //Parámetros externos
    $idPub=1;//$_POST['idPub']

    //Conexión y query's a la BD
    require("connection.php");
    $connection=connect();
    $queryPub="SELECT * FROM ";
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

        <!--Contenido de la publicación -->

        <div class="row">
            <!-- Titulo de la puclicación -->
            <div class="col s10 offset-s1">
                <h5>Título publicación</h5>
            </div>
            <!-- Menú de la publicación-->

            <nav class="col s10 offset-s1 blue darken-4">

                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="left hide-on-med-and-down">
                        <li class="active">
                            <a href="#">
                                <i class="material-icons prefix">info</i>
                            </a>
                        </li>
                        <li class="active"><a href="#">
                            (<span class="badge">4</span>)
                            <i class="material-icons left">photo_camera</i>    
                        </a></li>
                        <li><a href="#">
                            (<span class="badge">4</span>)
                            <i class="material-icons left">videocam<!--movie--></i>    
                        </a></li>
                        <li><a href="#">
                            (<span class="badge">4</span>)
                            <i class="material-icons left">audiotrack</i> 
                        </a></li>
                        <li><a href="#">
                            (<span class="badge">4</span>)
                            <i class="material-icons left">description</i> 
                        </a></li>
                        <li><a href="#">
                            (<span class="badge">4</span>)
                            <i class="material-icons left">book</i> 
                        </a></li>
                        <li><a href="#">
                            (<span class="badge">4</span>)
                            <i class="material-icons left">sms</i> 
                        </a></li>
                    </ul>
                </div>
            </nav>

            <div id="pubDesc" class="col s10 offset-s1 grey lighten-2" style="height:65vh;">

            </div>
            <!-- Controles de navegación -->
            <div id="controles" class="col s10 offset-s1 grey lighten-1" style="height:5vh;">
                <div class="center-align">
                    <i class="material-icons">first_page</i>
                    <i class="material-icons">keyboard_arrow_left</i>
                    <span>1 2 3 4</span>
                    <i class="material-icons">keyboard_arrow_right</i>
                    <i class="material-icons">last_page</i>

                </div>
            </div>
        </div>

        <div class="row">

        </div>

        <?php require("footer.php");?>


            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>

    </body>

    </html>