<html lang="en">
<?php
 session_start();
 echo $_SESSION["idUsuario"];
 
 if (isset ($_POST['idGrupo']) )
{
     //si existe
      $_SESSION["idGrupo"]=$_POST['idGrupo'];
     //echo  $_SESSION["idGrupo"];
}
else
{
    //sino existe
}

 
//echo $_SESSION["id_usuario"];
?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Publicacion</title>
        <!-- Bootstrap-- Materialize -->


        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-2.1.0.min.js" integrity="sha256-8oQ1OnzE2X9v4gpRVRMb1DWHoPHJilbur1LP9ykQ9H0=" crossorigin="anonymous"></script>
        <script src="../frameworks/js/jquery.mobile-1.4.5.min.js"></script>
        <script>
            var idEstilo = <?php if(isset($_SESSION['idUsuario'])) echo $_SESSION['idUsuario']; else echo 0; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../frameworks/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../frameworks/css/materialize.min.css">

        <!---->
    </head>

    <body>
        <div class="container">

            <form class="">
                <div class="row">
                    <div class="input-field col s6 offset-s3">
                        <input id="titulo" type="text" class="validate">
                        <label for="titulo">Titulo</label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="input-field col s6 offset-s3">
                        <textarea id="comment" class="materialize-textarea"></textarea>
                        <label for="comment">Descripcion</label>
                    </div>
                </div>
                <div class="row" id="tags">

                    <div class="input-field col s4 offset-s3">
                        <input id="etiqueta0" type="text">
                        <label for="icon-prefix">Tag(s)</label>
                    </div>

                    <div class="input-field col s3">
                        <button type="button" class="waves-effect waves-light btn" onclick="agregartag()" id="btag">
                            <i class="material-icons">add</i>
                        </button>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col s4 offset-s4">
                        <label for="first_name">Seleccione el tipo de archivos a subir</label>
                    </div>
                </div>


                <div class="row">
                    <div class="col s6 offset-s3">
                        <div class="btn-group col s12">
                            <button type="button" class="waves-effect waves-light btn" onclick="cambiararchivo()" id="barchivos">
                                <span class="glyphicon glyphicon-paperclip " aria-hidden="true"></span></button>
                            <button type="button" class="waves-effect waves-light btn" onclick="cambiarimagen()" id="bimagenes">
                                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>
                            <button type="button" class="waves-effect waves-light btn" onclick="cambiarvideo()" id="bvideo">
                                <span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span>
                            </button>
                            <button type="button" class="waves-effect waves-light btn" onclick="cambiaraudio()" id="baudio">
                                <span class="glyphicon glyphicon-music" aria-hidden="true"></span></button>
                        </div>
                    </div>
                </div>
                <br>
                <br>

                <div class="row">
                    <!-- <label class="control-label col-sm-1" for="publicacion">Arrastre sus archivos</label>-->
                    <div class="col s5 offset-s3" id="archivos">
                        <input type="file" multiple="true" name="archivos1" id="archivos1">
                        <img src="../IMG/iconos/arrastrar.png">
                    </div>
                    <div class="col s2 ">

                    </div>
                </div>

                <div class="row" style="display:none" id="divmarchivos">
                    <div class="col s10 offset-s2 " id="marchivos">
                    </div>
                </div>
                <div class="row">
                    <div class="col s4 offset-s4">
                        <button type="submit" class="btn btn-success" id="publicar">Publicar</button>
                        <button type="submit" class="btn btn-success" id="publicar">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
    <script src="../frameworks/js/materialize.min.js"></script>
    <script>
        var textoDesc = "<?=$filaPub['Descripcion']?>";
        var palabras = textoDesc.split(/(\s+)/);
    </script>
    <script src="../JS/publicacion.js"></script>
    <script src="../JS/header.js"></script>
    <script src="../frameworks/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../JS/pract04.js"></script>

</html>