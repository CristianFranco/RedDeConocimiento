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
            var idEstilo = <?php if(isset($_SESSION['idUsuario'])) echo $_SESSION['idUsuario']; else echo 0; ?>;
        </script>
        <script src="../JS/cargarPreferencias.js"></script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    </head>
<body >
<?php 
    session_start();
?>

 		<header>
            <?php require("header.php") ?>
        </header>
        <main>

	<div class="container secundario">

	<div class="row">
		<div class="col s10"></div>
			<div class="col s1 offset-s11">
	        			<a href="#modal" class="material-icons modal-trigger">live_help</a>
	        </div>
        </div>

        <div class="modal" id ="modal">
        	<div class="container">
        	<br>
        	<h4> Esta informacion para que compreda mejor el uso de la busqueda avanzada</h4>
        	<br><br>
<ul style="list-style-type:square">
        	<li>&#8226; En el campo de Busqueda o persona busca las personas que contengan las palabras especificadas.</li>
        	<br><br>

        	<li>&#8226; La busqueda por area de conocimiento es para traer los grupos los cuales se encuentran en esa area de conociemiento.</li>

        	<br><br>
        	<li>&#8226; La busqueda por contendio de publicaciones trae los grupos que contienen publicaciones de ese contenido y los usuarios que han publicado ese tipo de publicaciones.</li>
<br><br>
        	<li>&#8226; Al tener activada la opcion de Grupos que contengan el tipo de publicación trae los grupos que se encuentren en un area de conocimiento y que contengan los contenidos de publicaciones que se especifica.</li>
<br><br>
        	<li>&#8226; Al tener activada la opcion Grupos o publicaciones trae los grupos que se encuentren en esa area de conocimiento y tambien los grupos que contengan publicaciones por busqueda de contenido.</li>
<br>
</ul>
<div class="row">
<div class= "col s2 offset-s10">
        	<div class="action-bar">
        		<a href="#" class="btn-flat modal-action modal-close">Entendido</a>
        	</div>
        </div>
        </div>
        	</div>
        </div>

		<form action="./resultadosDeBusqueda.php" method="POST" id='subFor'>
			<div class="input-field" >
				<label class="icoP" for="nombre">Busqueda por nombre de grupo o persona:</label>
				<input class="inpP" type="text" id="nombre" name="nombre" ></input>
			</div>

			<div class="input-field" >
			<label class="icoP" for="area">Busqueda por area de conocimiento:</label>
				<input class="inpP" type="text" id="area" name="area"></input>
			</div>
			<p>
			      <input class="icoP" name="group1" type="radio" value = "1" id="and" checked />
			      <label class="icoP" for="and">Grupos que contengan el tipo de publicación</label>
			    </p>
			    <p>
			      <input class="principal" name="group1" type="radio" id="or" value = "2" />
			      <label class="icoP" for="or">Grupos o publicaciones</label>
			    </p>
			<div class="input-field" >
			<label class="icoP" for="tags">Busqueda por contenido de publicaciones:</label>
				<input class="inpP" type="text" id="tags"  name="tags"></input>
			</div>

			<button class="btn waves-effect waves-light blue darken-3 col s6 " type="submit" name="action">Buscar
                <i class="material-icons right">search</i>
            </button>
		</form>
	</div>
	</main>
        <?php require("footer.php");?>
    <script src="../frameworks/js/materialize.min.js"></script>
    <script type="text/javascript" src="../JS/header.js"></script>
            <script type="text/javascript">
            	$(document).ready(function(){
            		$(".modal-trigger").leanModal();
            	});
            </script>
</body>
