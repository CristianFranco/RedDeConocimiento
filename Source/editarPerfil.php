<html>
<?php 
    session_start();
    require("procesos/connection.php"); 
    
    $Uid= 1;
    $connection = connect();
    $sql = "SELECT * from Usuario WHERE idUsuario LIKE $Uid";
    $result = $connection -> query($sql);
    $usuario = $result -> fetch_assoc();
?>
<head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Editar Perfil</title>

        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        
</head>
<body>    
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
            <div class="input-field col s4">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefix" type="text" class="validate" pattern="[A-Za-z0-9 ]{6,15}" title="Mínimo 6 caracteres, máximo 15 caracteres" name="nickname" required value="<?php echo $usuario ['Nickname'];?>">
              <label for="icon_prefix">Nickname</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">vpn_key</i>
              <input id="icon_prefix" type="password" class="validate" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Al menos 8 caracteres con un número, una mayúscula y minúscula" name="password" required value="<?php echo $usuario ['Password'];?>">
              <label for="icon_prefix">Password</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">vpn_key</i>
              <input id="icon_prefix" type="password" class="validate"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Al menos 8 caracteres con un número, una mayúscula y minúscula" name="confirmar" required>
              <label for="icon_prefix">Confirmar Password</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">perm_identity</i>
              <input id="icon_prefix" type="text" class="validate" pattern="[A-Za-z ]{6,15}" title="Introduce tu nombre verdadero" name="nombre" required value="<?php echo $usuario ['Password'];?>">
              <label for="icon_prefix">Nombre</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">perm_identity</i>
              <input id="icon_prefix" type="text" class="validate" pattern="[A-Za-z ]{6,20}" title="Introduce tus apellidos" name="apellidos" required value="<?php echo $usuario ['Nombre'];?>">
              <label for="icon_prefix">Apellidos</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">phone</i>
              <input id="icon_prefix" type="text" class="validate" pattern="[0-9]{10,20}" title="Introduce solo datos númericos (lada + télefono)" name="telefono" required value="<?php echo $usuario ['Telefono'];?>">
              <label for="icon_prefix">Télefono</label>
            </div>
        </div>
          <div class="input-field col s4">
              <i class="material-icons prefix">assignment</i>
              <input id="icon_prefix" type="text" class="validate" pattern="[A-Za-z0-9 ]{10,30}" title="Introduce una breve descripción de ti " name="descripcion" required value="<?php echo $usuario ['Descripcion'];?>">
              <label for="icon_prefix">Descripción</label>
            </div>
<!--BD CATALOGO DE PAIS-CIUDAD-->
          <div class="input-field col s4">
            <i class="material-icons prefix">location_on</i>
             <?php
              $query='Select * From Pais order by Nombre ASC;';
              $connection=connect();
              $result=$connection -> query($query);
               echo "<select  name='pais' id='paises'>";   
               while($fila=$result->fetch_array(MYSQLI_ASSOC))
               {
                echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
               }   
              echo "</select>";
            ?>
<!--PAISES-->
           <label>Pais:</label>
           </div>
             <div class="input-field col s4">
              <i class="material-icons prefix">location_on</i>
               <?php
                $afg="AFG";
                $query="Select * From Ciudad where CodigoPais='AFG' order by Nombre ASC;";
                $connection=connect();
                $result=$connection -> query($query);
                echo "<select  name='ciudades' id='ciudades'>";   
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
              <button class="waves-effect waves-light btn" type="submit" name="action">Habilitar
                <i class="material-icons right">button</i>       
              </button>
               <button class="btn waves-effect waves-light" type="submit" name="action">Aceptar
                <i class="material-icons right">button</i>       
              </button>
               <button class="btn waves-effect waves-light" type="submit" name="action">Cancelar
                <i class="material-icons right">button</i>       
              </button>
              <a class="waves-effect waves-light btn" type="submit" name="action">button</a>
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