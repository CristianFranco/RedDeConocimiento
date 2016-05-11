<!DOCTYPE html>
<html lang = "es">
<head>
	<meta charset="UFT-8">
	<link rel="shortcut icon" href="img/logoTab.jpg"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="css/imagenCss.css">



</head>
<body >

<form action="AlgoritmoBusqueda.php" method="post" id='subFor'>
		<div class="form-group" >
			<label for="nombre">Busqueda por nombre de grupo o persona:</label>
			<input type="text" id="nombre" class="form-control" placeholder="Nombre:" ></input>
		</div>

		<div class="form-group">
			<label for="email">Busqueda por campo de conocimiento:</label>
			<input type="email" id="email" class="form-control" placeholder="Email:" ></input>
		</div>

		<div class="form-group">
			<label for="asunto">Busqueda por tipo de publicaciones:</label>
			<input type="text" id="tag_publi" name = "tag_publi" class="form-control" placeholder="Tag:" required></input>
		</div>
		
		<button class="btn btn-primary">Enviar</button>
	</form>

<script type="text/javascript" src="https://code.jquery.com/jquery-latest.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</body>
