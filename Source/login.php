<?php 
    //Inicio de sesión
    session_start();
    //Parámetros externos
    //$urlAnterior=$_POST['url'];

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
        <br>
        <div class="row">
            <div class="col s8 m6 l4 offset-s2 offset-m3 offset-l4">
                <div class="col s12 blue darken-4 white-text">
                    <h5 class="center-align">Inicio de Sesión</h5>
                </div>
                <!-- Formulario de inicio de sesión-->

                <div id="pubDesc" class="col s12 grey lighten-2" style="height:45vh;">
                    <br>
                    <form>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="last_name" type="text" class="validate">
                                <label for="last_name">Usuario:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate">
                                <label for="password">Contraseña:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves-effect waves-light blue darken-3 col s6 " type="submit" name="action">Cancelar
                                    <i class="material-icons right"></i>
                                </button>
                                <button class="btn waves-effect waves-light blue darken-3 col s6 " type="submit" name="action">Entrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                        </div>
                    </form>
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