<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Publicacion</title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

    <style>
        html,
        body {
            height: 100%;
        }
    </style>


</head>

<body>
    <header>
        <?php require("header.php")?>
    </header>

    <!--Contenido de la publicación -->

    <div class="row">
        <nav class="col s10 offset-s1 blue darken-4">
            <div class="nav-wrapper ">
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <li class="active"><a href="#">Descripción</a></li>
                    <li><a href="#">Imgenes</a></li>
                    <li><a href="#">Videos</a></li>
                    <li><a href="#">Audios</a></li>
                    <li><a href="#">Documentos</a></li>
                    <li><a href="#">Referencias</a></li>
                    <li><a href="#">Comentarios</a></li>
                </ul>
            </div>
        </nav>

        <div class="col s10 offset-s1 grey lighten-2" style="height:70vh;">
            <div class="valign-wrapper">
                <h5 class="valign">This should be vertically aligned</h5>
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