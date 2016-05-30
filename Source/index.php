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
            var idEstilo = <?= isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : 0 ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
        <script src="../JS/main-script-1.0.js"></script>
        <style>
            #back-to-top {
                position: fixed;
                bottom: 40px;
                right: 40px;
                z-index: 9999;
                text-align: center;
                line-height: 30px;
                /*background: #f5f5f5;
                color: #444;
                cursor: pointer;
                /*border: 0;
                /*border-radius: 2px;*/
                /*text-decoration: none;*/
                transition: opacity 0.2s ease-out;
                opacity: 0;
            }
            #back-to-top:hover {
                background: #e9ebec;
            }
            #back-to-top.show {
                opacity: 1;
            }
            #content {
                height: 2000px;
            }
        </style>
    </head>
    <body >
        <header>
            <?php require("header.php") ?>
        </header>

        <main>
            <div class="container">
                <?php
                if ($loggueado) {
                    echo "<div class=\"row \">
                        <div>
                          <div class=\"card\">
                            <div class=\"card-content principal\">
                              <span class=\"card-title\">Bienvenido " . $_SESSION['nickname'] . "</span>
                              <p>" . $_SESSION['nombre'] . " " . $_SESSION['apellidos'] . "
                              <br>Correo: " . $_SESSION['email'] . " 
                              <br>No. Telefónico: " . $_SESSION['telefono'] . "
                              <a href=javascript:irUsuario(" . $_SESSION['idUsuario'] . ") class=right>Mostrar resumen</a>
                                </p>
                                </div>
                          </div>
                        </div>
                      </div>";
                }
                ?>
                <div class="row center">
                    <div class="col s12 m12 l12">
                        <div class="btn-block">
                            <?php if ($loggueado) { ?>
                                <button onclick="cargarGrupos('mios')" class="btn btn-large waves-effect z-depth-2">Mis Grupos</button>
                            <?php } ?>
                            <button onclick="cargarGrupos('todos')" class="btn btn-large waves-effect z-depth-2">Últimos Grupos </button>
                            <button onclick="cargarPublicaciones()" class="btn  btn-large waves-effect z-depth-2">Publicaciones</button>
                            <?php if ($loggueado) { ?>
                                <button onclick="cargarSeguidores()" class="btn btn-large waves-effect z-depth-2">Seguidores</button>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="row ">

                    <div  id="contenido">

                    </div>
                </div>
            </div>
        </main>

        <!--a href="#" id="back-to-top" title="Back to top">&uarr;</a-->
        <a href="#" id="back-to-top" title="Ir hacia arriba" class="btn-floating btn-large waves-effect waves-light principal"><i class="material-icons">navigation</i></a>
  
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
        <script>
            if ($('#back-to-top').length) {
                var scrollTrigger = 100, // px
                        backToTop = function () {
                            var scrollTop = $(window).scrollTop();
                            if (scrollTop > scrollTrigger) {
                                $('#back-to-top').addClass('show');
                            } else {
                                $('#back-to-top').removeClass('show');
                            }
                        };
                backToTop();
                $(window).on('scroll', function () {
                    backToTop();
                });
                $('#back-to-top').on('click', function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 700);
                });
            }
        </script>
    </body>
