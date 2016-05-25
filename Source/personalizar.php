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
            var estado = <?php if(isset($_SESSION['idUsuario'])) echo "true";else echo "false"; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <!--Import jQuery before materialize.js-->

    </head>

    <body>

        <!-- Header -->
        <header>
            <?php require("header.php")?>
        </header>

        <!--Contenido de la publicación -->
        <br>
        <div class="container secundario">
            <div class="row">
                <div class="col s12">
                    <h3>Personalizar</h3>
                </div>

                <div class="col s12">
                    <div class="input-field">
                        <select>
                            <option value="1">Default</option>
                            <option value="2">Rojo</option>
                            <option value="3">Verde</option>
                            <option value="3">Negro</option>
                        </select>
                        <label>Tema Actual</label>
                    </div>
                    <a class="waves-effect waves-light btn"><i class="material-icons">save</i></a>
                    <a class="waves-effect waves-light btn"><i class="material-icons">close</i></a>
                    <a class="waves-effect waves-light btn"><i class="material-icons">visibility</i></a>
                </div>
                <div class="col s12">
                    <table class="bordered">
                        <thead>
                            <tr>
                                <th data-field="id">Activada</th>
                                <th data-field="name">Propiedad</th>
                                <th data-field="price">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" id="bcFondo" />
                                    <label for="bcPrincipal"></label>
                                </td>
                                <td>Color de Fondo</td>
                                <td>
                                    <input type="color">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" id="bcPrincipal" />
                                    <label for="bcPrincipal"></label>
                                </td>
                                <td>Color Principal</td>
                                <td>
                                    <input type="color">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" id="bcSecundario" />
                                    <label for="bcSecundario"></label>
                                </td>
                                <td>Color Secundario</td>
                                <td>
                                    <input type="color">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" id="tcPrincipal" />
                                    <label for="tcPrincipal"></label>
                                </td>
                                <td>Color de Texto Principal</td>
                                <td>
                                    <input type="color">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" id="tcSecundario" />
                                    <label for="tcSecundario"></label>
                                </td>
                                <td>Color de Texto Secundario</td>
                                <td>
                                    <input type="color">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" id="fuente" />
                                    <label for="fuente"></label>
                                </td>
                                <td>Fuente</td>
                                <td>
                                    <select>
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                    </select>
                                    <label>Materialize Select</label>

                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" id="tamFuente" />
                                    <label for="tamFuente"></label>
                                </td>
                                <td>Tamaño Fuente</td>
                                <td>
                                    <select>
                                        <option value="80">80%</option>
                                        <option value="90">90%</option>
                                        <option value="100" selected>100%</option>
                                        <option value="110">110%</option>
                                        <option value="120">120%</option>
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

        <?php require("footer.php");?>


            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
            <script>
                var estilo = {};
                estilo['default'] = {
                    bcFondo: ""
                    , bcPrincipal: ""
                    , bcSecundario: ""
                    , tcPrincipal: ""
                    , tcSecundario: ""
                    , fuente: ""
                    , tamFuente: ""
                };
                estilo['rojo'] = {
                    bcFondo: ""
                    , bcPrincipal: ""
                    , bcSecundario: ""
                    , tcPrincipa: ""
                    , tcSecundario: ""
                    , fuente: ""
                    , tamFuente: ""
                };
                estilo['verde'] = {
                    bcFondo: ""
                    , bcPrincipal: ""
                    , bcSecundario: ""
                    , tcPrincipa: ""
                    , tcSecundario: ""
                    , fuente: ""
                    , tamFuente: ""
                };
                estilo['negro'] = {
                    bcFondo: ""
                    , bcPrincipal: ""
                    , bcSecundario: ""
                    , tcPrincipa: ""
                    , tcSecundario: ""
                    , fuente: ""
                    , tamFuente: ""
                };

                $(document).ready(function () {
                    $('select').material_select();
                });
            </script>
            <script src="../JS/personalizar.js"></script>

    </body>

    </html>