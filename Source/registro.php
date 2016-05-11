<?php 
    session_start();
    require("procesos/connection.php");
    
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Registro</title>

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>


    </head>

    <body>

        <h2>Registro de Datos</h2>
        <div class="row">
            <form class="col s12" method="post" name="registro" action="envreg.php">
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" class="validate" name="nombre">
                        <label for="icon_prefix">Nombre</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" class="validate" name="apell">
                        <label for="icon_prefix">Apellido</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <i class="material-icons prefix">email</i>
                        <input id="icon_prefix" type="text" class="validate" name="email">
                        <label for="icon_prefix">Email</label>
                    </div>
                    <div class="input-field col s5">
                        <i class="material-icons prefix">phone</i>
                        <input id="icon_prefix" type="text" class="validate" name="tel">
                        <label for="icon_prefix">Telefono</label>
                    </div>
                </div>
                 <div class="input-field col s6">
                 <i class="material-icons prefix">location_on</i>
                    <?php
            $query='Select * From Pais order by Nombre ASC;';
            $connection=connect();
            $result=$connection -> query($query);
            echo "<select  name='pais' id='paises'>";   
            while($fila=$result->fetch_array(MYSQLI_ASSOC)){
            echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
            }   
            echo "</select>";
        ?>
                        <label>Pais:</label>
                </div>
                <div class="input-field col s6">
                    <i class="material-icons prefix">location_on</i>
                    <?php
                        $afg="AFG";
                        $query="Select * From Ciudad where CodigoPais='AFG' order by Nombre ASC;";
                        $connection=connect();
                        $result=$connection -> query($query);
                        echo "<select  name='ciudades' id='ciudades'>";   
                        while($fila=$result->fetch_array(MYSQLI_ASSOC)){
                        echo "<option value='".$fila['ID']."'>".$fila['Nombre']."</option>";
            }   
            echo "</select>";
        ?>
                    <label>Ciudad:</label>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input id="icon_prefix" type="text" class="validate" name="nkname">
                        <label for="icon_prefix">NickName</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="icon_prefix" type="password" class="validate" name="pass">
                        <label for="icon_prefix">Contraseña</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s7">
                        <i class="material-icons prefix">vpn_key</i>
                        <input id="icon_prefix" type="password" class="validate" name="confpass">
                        <label for="icon_prefix">Confirmar Contraseña</label>
                    </div>

                </div>
               

            </form>

        </div>
        <script>
            $("#paises").on("change", function (e) {
                console.log($("#paises").val());
                $.ajax({
                    url: "procesos/getCiudades.php"
                    , method: "POST"
                    , data: {
                        idPais: $("#paises").val()
                    }
                    , dataType: "JSON"
                    , success: function (result) {

                        $("#ciudades").empty();
                        for (var x = 0; x < result.length; x++) {
                            $("#ciudades").append('<option value="' + result[x].Id + '">' + result[x].Nombre + '</select>');
                        }
                        $('select').material_select()
                        console.log(result[0].Id + " " + result[0].Nombre);
                    }
                });

            })
        </script>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js">
        </script>
        <script>
            $(document).ready(function () {
                $('select').material_select();
            });
        </script>
    </body>

    </html>