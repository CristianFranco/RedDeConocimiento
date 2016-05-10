<html>
<?php 
    session_start(); 
    
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
    <div class="row">
      <div class="col s12">This div is 12-columns wide</div>
      <div class="col s6">This div is 6-columns wide</div>
      <div class="col s6">This div is 6-columns wide</div>
    </div>      
    <h1>Editar Perfil</h1>
 <form action"" method="post" class="" name="editar_Perfil">
        <label>Nickname:</label>
        <input type="text" name="nickname" size="30" maxlength="20">
         &nbsp; &nbsp;
        <label>Password:</label>
        <input type="password" name="pass" size="30" maxlength="10">
         &nbsp; &nbsp;
        <label>Email: &nbsp; &nbsp;  &nbsp;</label>
        <input type="tex" name="email" size="30" maxlength="30">
        <br><br>
        <label>Télefono: &nbsp;</label>
        <input type="tex" name="telefono" size="30" maxlength="10">
         &nbsp; &nbsp;
        <label>Nombre: &nbsp;</label>
        <input type="tex" name="nombre" size="30" maxlength="20">
         &nbsp; &nbsp;
        <label>Apellidos:</label>
        <input type="tex" name="apellidos" size="30" maxlength="30">
        <br><br>
        <label>Pais:&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</label>
        <select name="pais" id="paises">
            <option>Seleccionar</option>   
        </select>
         &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;        
        <label>Ciudad:</label>
        <select name="ciudades" id="ciudades">
            <option>Seleccionar</option>            
        </select>
        <input type="submit" style="Position:Absolute; left:63%; top:20%" value="Aceptar"/>
        <input type="submit" style="Position:Absolute; left:68%; top:20%" value="Cancelar"/>
</form>
    <script>
    $("#paises").on("focus",function(e){
        $.ajax({
                url: "getPaises.php"
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
                url: "getCiudades.php"
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
</body>
    
</html>