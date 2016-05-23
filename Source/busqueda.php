<!DOCTYPE html>
<html lang = "es">
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
<body >
<?php 
    session_start();
?>

 		<header>
            <?php require("header.php")?>
        </header>
        <main>
	<div class="container secundario">
		<form action="./resultadosDeBusqueda.php" method="POST" id='subFor'>
			<div class="input-field" >
				<label for="nombre">Busqueda por nombre de grupo o persona:</label>
				<input type="text" id="nombre" name="nombre" ></input>
			</div>

			<div class="input-field" >
			<label for="area">Busqueda por area de conocimiento:</label>
				<input type="text" id="area" name="area"></input>
			</div>
			<p>
			      <input name="group1" type="radio" value = "1" id="and" checked />
			      <label for="and">Grupos que contengan el tipo de publicación</label>
			    </p>
			    <p>
			      <input name="group1" type="radio" id="or" value = "2" />
			      <label for="or">Grupos o publicaciones</label>
			    </p>
			<div class="input-field" >
			<label for="tags">Busqueda por contenido de publicaciones:</label>
				<input type="text" id="tags"  name="tags"></input>
			</div>

			
			<button class="btn waves-effect waves-light blue darken-3 col s6 " type="submit" name="action">Buscar
                <i class="material-icons right">search</i>
            </button>
		</form>
	</div>
	</main>
        <?php require("footer.php");?>
    <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>
</body>
