<html>
<?php 
    session_start(); 
    
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
    <h2>Registro de Datos</h2>
 <form action"" method="post" class="" name="registro">
        <label>Nombre:</label>
        <input type="text" name="nombre" size="60" maxlength="45">
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
        <label>Pais:</label>
     <select name="pais" id="paises">
            <option>Seleccionar Pais...</option>   
        </select>
        <br><br>
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
        <input type="submit"   value="Registrarse"
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