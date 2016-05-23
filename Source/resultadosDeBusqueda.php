<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Red de conocimiento</title>
		        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

		        		<script src="../JS/Redirect/jquery.redirect.js"></script>

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
   </head>
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

		<div class="container">
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
		<script type="text/javascript" src="../JS/listaUsuarioScript.js"></script>
		 <?php require("footer.php");?>

	</body>
</html>