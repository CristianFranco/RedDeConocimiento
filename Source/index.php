<?php
session_start();
$loggueado = isset($_SESSION["idUsuario"]);
?>
<!DOCTYPE html>
<html lang = "es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Red de conocimiento</title>

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="../frameworks/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-2.1.0.min.js" integrity="sha256-8oQ1OnzE2X9v4gpRVRMb1DWHoPHJilbur1LP9ykQ9H0=" crossorigin="anonymous"></script>

        <script>
            var idEstilo = <?php echo isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 0; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
        <script src="../JS/main-script-1.0.js"></script>
    </head>
    <body >
        <header>
            <?php require("header.php") ?>
        </header>

        <main>
            <div class="container">


                <div class="row secundario">  
                    
                    <p class="flow-text">I am Flow Text <button onclick="window.location.href='inbox.php'" class="btn right" >asd</button></p>
                    <p class="flow-text">I am Flow Text <button class="btn right" >asd</button></p>
                    <p class="flow-text">I am Flow Text <button class="btn right" >asd</button></p>
                    <p class="flow-text">I am Flow Text <button class="btn right" >asd</button></p>
                </div>
                    
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <div class="btn-block">
                            <?php if ($loggueado) { ?>
                                <button onclick="cargarGrupos('mios')" class="btn btn-large waves-effect z-depth-2">Mis Grupos</button>
                            <?php } ?>
                            <button onclick="cargarGrupos('todos')" class="btn btn-large waves-effect z-depth-2">Últimos Grupos </button>
                            <button onclick="cargarPublicaciones()" class="btn  btn-large waves-effect z-depth-2">Publicaciones</button>
                        </div>
                    </div>
                </div>
                <div class="row ">

                    <div  id="contenido">

                    </div>

                </div>
            </div>
        </main>

        <?php require("footer.php"); ?>
        <script src="../frameworks/js/materialize.min.js"></script>
        <script src="../JS/header.js"></script>
        <script>
<?php if ($loggueado) { ?>
                                    cargarGrupos('mios');
<?php } else { ?>
                                    cargarGrupos('todos');
<?php } ?>
        </script>
    </body>
