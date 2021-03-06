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
        <link rel="stylesheet" href="../frameworks/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-2.1.0.min.js" integrity="sha256-8oQ1OnzE2X9v4gpRVRMb1DWHoPHJilbur1LP9ykQ9H0=" crossorigin="anonymous"></script>
        <script>
            var idEstilo = <?php if(isset($_SESSION['idUsuario'])) echo $_SESSION['idUsuario']; else echo 0; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>

    <body>
        <header>
            <?php require("header.php")?>
        </header>
        <main>

            <div class="container secundario">
                <h4>Registro de Datos</h4>
                <div class="row">
                    <form id="formRegistro" class="col s12" method="post" name="registro" action="./procesos/procReg.php">
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="icoP material-icons prefix">account_circle</i>
                                    <input id="icon_prefix" type="text" class="validate inpP" name="nombre" pattern="[A-Za-z ]{2,15}"  title="Mínimo 6 caracteres, máximo 15 caracteres" required>
                                <label class="icoP" for="icon_prefix">Nombre</label>
                                
                            </div>
                            <div class="input-field col s6">
                                <i class="icoP material-icons prefix">account_circle</i>
                                <input id="icon_prefix" type="text" class="validate inpP" name="apell" pattern="[A-Za-z ]{6,15}" title="Mínimo 6 caracteres, máximo 15 caracteres" required>
                                <label  class="icoP" for="icon_prefix">Apellido</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s7">
                                <i class="icoP material-icons prefix">email</i>
                                <input id="icon_prefix" type="email" class="validate inpP" name="email" pattern="[a-zA-Z0-9._@- ]{12,*}" title="debe ser mail@dominio.com, solo acepta caracteres especiales (.-_@ )" required>
                                <label class="icoP" for="icon_prefix">Email</label>
                            </div>
                            <div class="input-field col s5">
                                <i class="icoP material-icons prefix">phone</i>
                                <input id="icon_prefix" type="text" class="validate inpP" name="tel" pattern="[0-9 ]{10,20}" title="Introduce solo datos númericos (lada + télefono)" require>
                                <label class="icoP" for="icon_prefix">Teléfono</label>
                            </div>
                        </div>
                         <div class="row">
                        <div class="input-field col s6">
                            <i class="icoP material-icons prefix">location_on</i>
                            <?php
                     $query='Select * From Pais order by Nombre ASC;';
                     $connection=connect();
                     $result=$connection -> query($query);
                     echo "<select name='pais' id='paises'>";   
                     while($fila=$result->fetch_array(MYSQLI_ASSOC)){
                         echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
                     }   
                    echo "</select>";
                 ?>
                            <label class="icoP">País:</label>
                        </div>
                        <div class="input-field col s6">
                        <i class="icoP  material-icons prefix">location_on</i>
                        <?php
                        //$afg="AFG";
                        $query="Select * From Ciudad where CodigoPais='AFG' order by Nombre ASC;";
                        $connection=connect();
                        $result=$connection -> query($query);
                        echo "<select name='ciudad' id='ciudades'>";   
                        while($fila=$result->fetch_array(MYSQLI_ASSOC)){
                            echo "<option value='".$fila['ID']."'>".$fila['Nombre']."</option>";
                        }   
                        echo "</select>";
                    ?>
                                <label class="icoP">Ciudad:</label>
                        </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="icoP material-icons prefix">assignment_ind</i>
                                <input id="icon_prefix" type="text" class="validate inpP " name="nkname" pattern="[A-Za-z0-9._- ]{6,15}" title="Mínimo 6 caracteres, máximo 15 caracteres" required>
                                <label class="icoP" for="icon_prefix">NickName</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <i class="icoP material-icons prefix">vpn_key</i>
                                <input id="icon_prefix" type="password" class="validate inpP " name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Al menos 8 caracteres con un número, una mayúscula y minúscula" required onchange="form.confpass.pattern = this.value;">
                                <label class="icoP"  for="icon_prefix">Contraseña</label>
                            </div>
                            <div class="input-field col s6">
                                <i class="icoP material-icons prefix">vpn_key</i>
                                <input id="icon_prefix" type="password" class="validate inpP " name="confpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Al menos 8 caracteres con un número, una mayúscula y minúscula, Debe ser igual al campo contraseña" required>
                                <label class="icoP" for="icon_prefix">Confirmar Contraseña</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="icoP material-icons prefix">list</i>
                                <textarea id="icon_prefix" class="materialize-textarea  inpP " name="desc" pattern="[a-ZA-Z0-9,.-_ ]$" title="Puede mencionar alguna descripcion de usted o dejarla en blanco"></textarea>
                                <label class="icoP" for="icon_prefix">Descripción</label>
                            </div>
                        </div>

                        <div align="right">
                            <button type="button" class="waves-effect waves-light btn" name="regresar" onClick="location.href='index.php'">Regresar
                                <i class="material-icons left">reply</i>
                            </button>
                            <button id="enviarRegistro" class="waves-effect waves-light btn" type="submit" name="enviar">Registrar
                                <i class="material-icons right">forward</i>
                            </button>
                        </div>

                    </form>


                </div>
            </div>
        </main>
         <?php require("footer.php");?>
            <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>
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
                $("#formRegistro").submit(function (e) {
                    e.preventDefault();
                    var postData = $(this).serializeArray();
                    $.ajax({
                        url: "procesos/procReg.php"
                        , type: "POST"
                        , data: postData
                        ,dataType:'json'
                        , success: function (data, textStatus, jqXHR) {
                            console.log(data);
                            if(data.estado==false){
                                 Materialize.toast(String(data.msg), 4000);
                            }else{
                                Materialize.toast("Se envío un correo de confirmación a tu dirección de email",4000);
                                Materialize.toast("Se redireccionará a la página principal.",4000);
                                Materialize.toast("Gracias por su registro!!!",4000);
                                setTimeout(function(e){
                                    window.location="index.php";
                                },4000);
                            }
                           // data: return data from server
                        }
                    });

                });
            </script>
            <script>
                $(document).ready(function () {
                    $('select').material_select();
                });
            </script>
    </body>

    </html>