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
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
            //var estado = ;}
            var idEstilo = <?php if(isset($_SESSION['idUsuario'])) echo $_SESSION['idUsuario']; else echo 0; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" href="../CSS/style.css">
        <!--Import jQuery before materialize.js-->

    </head>

    <body>

        <!-- Header -->
        <header>
            <?php require("header.php")?>
        </header>

        <!--Contenido de la publicación -->
        <br>
        <main>
            <div class="container secundario">
                <div class="row">
                    <div class="col s12">
                        <h3>Personalizar</h3>
                    </div>

                    <div class="col s12">
                        <div class="input-field">
                            <select id="selectEstilo">
                                <option value="Default">Default</option>
                                <option value="Negro">Negro</option>
                                <option value="Personalizado">Personalizado</option>

                            </select>
                            <label>Tema Actual</label>
                        </div>
                        <a id="guardarEstilo" class="principal waves-effect waves-light btn "><i class="material-icons">save</i></a>
                        <a class="principal waves-effect waves-light btn"><i class="material-icons">close</i></a>
                        <a class="principal waves-effect waves-light btn"><i class="material-icons">visibility</i></a>
                    </div>
                    <div id="tablaEstilos" class="col s12">
                        <table class="bordered">
                            <thead>
                                <tr>
                                    <th data-field="name">Propiedad</th>
                                    <th data-field="price">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Color de Fondo</td>
                                    <td>
                                        <input id="colorFondo" type="color">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Color Principal</td>
                                    <td>
                                        <input id="colorPrincipal" type="color">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Color Secundario</td>
                                    <td>
                                        <input id="colorSecundario" type="color">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Color de Texto Principal</td>
                                    <td>
                                        <input id="textoPrincipal" type="color">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Color de Texto Secundario</td>
                                    <td>
                                        <input id="textoSecundario" type="color">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Fuente</td>
                                    <td>
                                        <select id="fuente">
                                            <option value="Arial">Arial</option>
                                            <option value="Calibri">Calibri</option>
                                            <option value="Chiller">Chiller</option>
                                            <option value="Impact">Impact</option>
                                        </select>
                                        <label>Materialize Select</label>

                                    </td>
                                </tr>
                                <tr>
                                    <td>Tamaño Fuente</td>
                                    <td>
                                        <select id="tamañoFuente">
                                            <option value="98%">98%</option>
                                            <option value="99%">99%</option>
                                            <option value="100%" selected>100%</option>
                                            <option value="101%">101%</option>
                                            <option value="102%">102%</option>
                                            <option value="103%">103%</option>
                                            <option value="104%">104%</option>
                                            <option value="105%">105%</option>
                                        </select>
                                        <label>Materialize Select</label>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>
        </main>
        <?php require("footer.php");?>


            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('select').material_select();
                });
            </script>
            <script src="../JS/personalizar.js"></script>
            <script src="../JS/header.js"></script>

    </body>

    </html>