<html>
<?php 
    session_start();
    require("procesos/connection.php");  
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
<!--CAMPOS A EDITAR-->
    <div class="row">
      <form class="col s12" method="post" name="registro" action="envreg.php">
        <div class="row">
            <div class="input-field col s4">
              <i class="material-icons prefix">account_circle</i>
              <input id="icon_prefix" type="text" class="validate" name="nickname" maxlength="20">
              <label for="icon_prefix">Nickname</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">vpn_key</i>
              <input id="icon_prefix" type="password" class="validate" name="password" maxlength="20">
              <label for="icon_prefix">Password</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">vpn_key</i>
              <input id="icon_prefix" type="password" class="validate" name="confirmar" maxlength="20">
              <label for="icon_prefix">Confirmar Password</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">perm_identity</i>
              <input id="icon_prefix" type="text" class="validate" name="nombre" maxlength="20">
              <label for="icon_prefix">Nombre</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">perm_identity</i>
              <input id="icon_prefix" type="text" class="validate" name="apellidos" maxlength="20">
              <label for="icon_prefix">Apellidos</label>
            </div>
            <div class="input-field col s4">
              <i class="material-icons prefix">phone</i>
              <input id="icon_prefix" type="text" class="validate" name="telefono" maxlength="10">
              <label for="icon_prefix">Télefono</label>
            </div>
        </div>
<!--BD CATALOGO DE PAIS-CIUDAD-->
          <div class="input-field col s4">
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
                echo "<option value='".$fila['ID']."'>".$fila['Nombre']."</option>";
            }   
             echo "</select>";
               ?>
<!--CIUDADES-->
             <label>Ciudad:</label>
             </div>
          <br><br>
          <p>           
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
<!--BOTONES-->
     <div class ="row">
       <div class="input-field col s2">
         <a class="waves-effect waves-light btn" >Habilitar</a>
       </div>
       <div class="input-field col s2">
         <a class="waves-effect waves-light btn" >Aceptar</a>
       </div>
       <div class="input-field col s2">
         <a class="waves-effect waves-light btn" >Cancelar</a>
        </div>
      </div>
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