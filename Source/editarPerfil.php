<html>
<?php 
    session_start(); 
    
?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
</head>
<body>
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
</body>
</html>