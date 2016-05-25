<!DOCTYPE html>
<html lang="es">
<?php 
    session_start();
    require("procesos/connection.php"); 
    
    $Uid= 1;
    $connection = connect();
    $sql = "SELECT u.Nickname, u.Password, u.Telefono, u.Nombre, u.Apellidos, u.Descripcion, c.CodigoPais,u.idCiudad from Usuario u,Ciudad c WHERE u.idUsuario = $Uid and u.idCiudad=c.ID;";
    $result = $connection -> query($sql);
    $usuario = $result -> fetch_assoc();
?>
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
        <link rel="stylesheet" href="../frameworks/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-2.1.0.min.js" integrity="sha256-8oQ1OnzE2X9v4gpRVRMb1DWHoPHJilbur1LP9ykQ9H0=" crossorigin="anonymous"></script>
        
        <script>
            var estado = <?php if(isset($_SESSION['idUsuario'])) echo "true";else echo "false"; ?>;
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
    <h1>Editar Perfil</h1>
    <?php
        /*echo $usuario ['Nickname'];
        echo $password ['Password'];
        echo $conf_pass ['Password'];
        echo $nombre ['Nombre'];
        echo $usuario ['Apellidos'];
        echo $telefono ['telefono'];
        echo $descripcion ['descripcion'];*/
        
    ?>
<!--CAMPOS A EDITAR-->
    <div class="row">
      <form class="col s12" method="post" name="registro" action="envreg.php">
        <div class="row">
            <div class="input-field col m4">
              <i class="material-icons prefix">account_circle</i>
              <input id="nickname" type="text" class="validate" pattern="[A-Za-z0-9 ]{6,15}" title="Mínimo 6 caracteres, máximo 15 caracteres" name="nickname" required value="<?php echo $usuario ['Nickname'];?>" disabled>
              <label for="nickname">Nickname</label>
            </div>
            <div class="input-field col m4">
              <i class="material-icons prefix">vpn_key</i>
              <input id="password" type="password" class="validate" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Al menos 8 caracteres con un número, una mayúscula y minúscula" name="password" required value="<?php echo $usuario ['Password'];?>" disabled>
              <label for="password">Password</label>
            </div>
            <div class="input-field col m4">
              <i class="material-icons prefix">vpn_key</i>
              <input id="conf_pass" type="password" class="validate"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Al menos 8 caracteres con un número, una mayúscula y minúscula" name="conf_pass" required disabled>
              <label for="conf_pass">Confirmar Password</label>
            </div>
            <div class="input-field col m4">
              <i class="material-icons prefix">perm_identity</i>
              <input id="nombre" type="text" class="validate" pattern="[A-Za-z ]{6,15}" title="Introduce tu nombre verdadero" name="nombre" required value="<?php echo $usuario ['Nombre'];?>" disabled>
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field col m4">
              <i class="material-icons prefix">perm_identity</i>
              <input id="apellidos" type="text" class="validate" pattern="[A-Za-z ]{6,20}" title="Introduce tus apellidos" name="apellidos" required value="<?php echo $usuario ['Apellidos'];?>" disabled>
              <label for="apellidos">Apellidos</label>
            </div>
            <div class="input-field col m4">
              <i class="material-icons prefix">phone</i>
              <input id="telefono" type="text" class="validate" pattern="[0-9]{10,20}" title="Introduce solo datos númericos (lada + télefono)" name="telefono" required value="<?php echo $usuario ['Telefono'];?>" disabled>
              <label for="telefono">Télefono</label>
            </div>
        </div>
          <div class="input-field col m4">
              <i class="material-icons prefix">assignment</i>
              <input id="descripcion" type="text" class="validate" pattern="[A-Za-z0-9 ]{10,30}" title="Introduce una breve descripción de ti " name="descripcion" required value="<?php echo $usuario ['Descripcion'];?>" disabled>
              <label for="descripcion">Descripción</label>
            </div>
<!--BD CATALOGO DE PAIS-CIUDAD-->
          <div class="input-field col m4">
            <i class="material-icons prefix">location_on</i>
             <?php
              $query='Select * From Pais order by Nombre ASC;';
              $connection=connect();
              $result=$connection -> query($query);
               echo "<select disabled  name='pais' id='paises'>";   
               while($fila=$result->fetch_array(MYSQLI_ASSOC))
               {
                echo "<option value='".$fila['Codigo']."'";
                if($usuario['CodigoPais']==$fila['Codigo'])
                    echo "selected";
                echo ">".$fila['Nombre']."</option>";
               }   
              echo "</select>";
            ?>
<!--Ciudades-->
           <label>Pais:</label>
           </div>
             <div class="input-field col m4">
              <i class="material-icons prefix">location_on</i>
               <?php
                $afg="AFG";
                $pais=$usuario['CodigoPais'];
                $query="Select * From Ciudad where CodigoPais='$pais' order by Nombre ASC;";
                $connection=connect();
                $result=$connection -> query($query);
                echo "<select disabled name='ciudades' id='ciudades'>";   
                while($fila=$result->fetch_array(MYSQLI_ASSOC)){
                    if($usuario['idCiudad']==$fila['ID']){
                echo"<option value='".$fila['ID']."' selected>".$fila['Nombre']."</option>";
                    }else
                echo "<option value='".$fila['ID']."'>".$fila['Nombre']."</option>";
            }   
             echo "</select>";
               ?>
<!--CIUDADES-->
             <label>Ciudad:</label>
             </div>
          <br><br>
          <p>  
<!--BOTONES-->   
              <div class="row">
              <form class="col m12" method="post" name="registro" action="envreg.php">
              <div class="input-field col m2"> 
                  <a class="waves-effect waves-light btn" id="habilitar" type="button" name="action">Habilitar</a>
              </div>
              <div class="input-field col m2">
                  <a class="waves-effect waves-light btn" id="aceptar" type="submit" name="action">Aceptar</a>
              </div>
              <div class="input-field col m2">
                  <a class="waves-effect waves-light btn" id="cancelar" type="button" name="action">Cancelar</a>
              </div>
              </form>
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
                            $("#ciudades").append('<option value="' + result[x].Id + '">' + result[x].Nombre + '</option>');
                        }
                        $('select').material_select()
                        console.log(result[0].Id + " " + result[0].Nombre);
                    }
                });

            })
//HABILITAR CAMPOS
            $("#habilitar").on("click",function(e){
              //  $("#nickname").removeAttr("disabled");
               /* $("#password").removeAttr("disabled");
                $("#conf_pass").removeAttr("disabled");
                $("#nombre").removeAttr("disabled");
                $("#apellidos").removeAttr("disabled");
                $("#telefono").removeAttr("disabled");
                $("#descripcion").removeAttr("disabled");
                $("#paises").removeAttr("disabled");*/
                $("input").removeAttr("disabled");
                $('#paises').removeAttr('disabled');
                $('#ciudades').removeAttr('disabled');
                $('select').material_select();
            });
//CANCELAR
            $("#cancelar").on("click",function(e){
               window.location="editarPerfil.php"; 
            });
        </script>          

        <script>
            $(document).ready(function () {
                $('select').material_select();
            });
        </script>
    </body>
</html> 