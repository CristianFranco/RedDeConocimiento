<?php
session_start();
?>
<!DOCTYPE html>
<html>
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

	
	<body>
	<header>
            <?php require("header.php")?>
        </header>
		<?php
     
     $nombre = $_POST['nombre'];
     $area = $_POST['area'];
     $tag = $_POST['tags'];
      echo "	<input type='text' name='nombre' id='nombre' value='".$nombre."' hidden='false'>";
     echo "	<input type='text' name='area' id='area' value='".$area."' hidden='false'>";
    echo "	<input type='text' name='tag' id='tag' value='".$tag."' hidden='false'>";
    
	?>
		<main>
		<div class="container secundario">
		<div class="row">
		<div class="col s12">
			<ul class="tabs">
				<li class="tab col s6"><a href="#grupo">Grupos</a></li>
				<li class="tab col s6"><a href="#persona">Personas</a></li>

			</ul>
				<div class="col s12" id="grupo">
					<table id = "tabla" class="bordered hoverable responsive-table">
								
					</table>
				</div>
				<div class="col s12" id="persona">
					<table id = "tablaPersona" class="bordered hoverable responsive-table">
								
					</table>
				</div>
				</div>
			</div>
		</div>

      </div> 
      </main>
        <?php require("footer.php");?>
    <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>
		<script type="text/javascript" src="../JS/listaUsuarioScript.js"></script>
		 

	</body>
</html>