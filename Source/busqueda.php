<!DOCTYPE html>
<html lang = "es">
<head>
	<meta charset="UFT-8">
	 <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body >
<?php 
    session_start();
?>

 		<header>
            <?php require("header.php")?>
        </header>
	<div class="container">
		<form action="./procesos/AlgoritmoBusqueda.php" method="POST" id='subFor'>
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

        <?php require("footer.php");?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js"></script>
</body>
