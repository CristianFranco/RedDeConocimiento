<html>
<?php 
    session_start(); 
    
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
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
        <?php
            $conn = mysql_connect('107.180.58.59','adminRCO','StrUsr94?'); 
            $consulta_pais='SELECT * FROM RCO.Pais;';
            $result=mysql_query($consulta_pais,$conn);
            //echo $result;
            echo "<select name='pais' id='paises'>";
            while($fila=mysql_fetch_array($result)){
            echo "<option value='".$fila['Codigo']."'>".$fila['Nombre']."</option>";
            }   
            echo "</select>";
        ?>
        <br><br>
        <label>Ciudad:</label>
        <select name="ciudades" id="ciudades">
            
            
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
</form>

<script>
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