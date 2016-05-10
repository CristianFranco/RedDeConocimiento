<?php 
    session_start(); 
    
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
        <div class="input-field col s8">
          <i class="material-icons prefix">account_circle</i>
          <input id="icon_prefix" type="text" class="validate" name="nombre">
          <label for="icon_prefix">Nombre</label>
        </div>
     <br><br>
        <label>Apellido:</label>
        <input type="tex" name="apell" size="60" maxlength="45">
        <br><br>
        <label>Email:</label>
        <input type="tex" name="email" size="60" maxlength="45">
        <br><br>
        <label>Telefono:</label>
        <input type="tex" name="tel" size="60" maxlength="45">
        <br><br>
     <div  class="input-field col s6">
     <select name="pais" id="paises">
            <option disabled selected>Seleccionar Pais...</option>   
      </select>
         <label>Pais:</label>
     </div>
        <label>Ciudad:</label>
        <select name="ciudades" id="ciudades">
            <option>Seleccionar Ciudad...</option>
        </select>
         <br><br>
        <label>NickName:</label>
        <input type="tex" name="nickname" size="60" maxlength="45">
        <br><br>
        <label>Contrase&ntilde;a:</label>
        <input type="password" name="pass" size="60" maxlength="45">
        <br><br>
        <label>Confirmar Contrase&ntilde;a:</label>
        <input type="password" name="confpass" size="60" maxlength="32">
      <br><br>
        <input type="submit"  name="enviar" value="Registrarse">
     </div>
</form>
    
</div>
<script>
    $("#paises").on("focus",function(e){
        $.ajax({
                url: "procesos/getPaises.php"
                , method: "POST"
                , dataType: "JSON"
                , success: function (result) {
                    $("#paises").empty();
                    for(var x=0;x<result.length;x++){
                        $("#paises").append('<option value="'+result[x].Id+'">'+result[x].Nombre+'</select>');
                    }
                    console.log(result[0].Id+" "+result[0].Nombre);
                }
    });
    })
    $("#paises").on("change",function(e){
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
                    for(var x=0;x<result.length;x++){
                        $("#ciudades").append('<option value="'+result[x].Id+'">'+result[x].Nombre+'</select>');
                    }
                    console.log(result[0].Id+" "+result[0].Nombre);
                }
            });
                    
    })
</script>
     <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</body>
</html>