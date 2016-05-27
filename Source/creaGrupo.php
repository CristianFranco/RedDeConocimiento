<!DOCTYPE html>
<?php 
    session_start();
    require("procesos/connection.php");
    $conexion = connect();
    
?>

<html>
<head>
	<title>
		Red de conocimiento
	</title>

	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="../frameworks/css/materialize.min.css">

        <!--Import jQuery before materialize.js-->
        <script src="https://code.jquery.com/jquery-2.1.0.min.js" integrity="sha256-8oQ1OnzE2X9v4gpRVRMb1DWHoPHJilbur1LP9ykQ9H0=" crossorigin="anonymous"></script>

        <script>
            var idEstilo = <?php if(isset($_SESSION['idUsuario'])) echo $_SESSION['idUsuario']; else echo 0; ?>;
        </script>
        <link rel="stylesheet" type="text/css" href="../CSS/style.css">

</head>
<body>

 <header>
            <?php require("header.php") ?>
        </header>
        <main>

	<div class="container">
		<div class="row">
			<div class="col m12">
				<form id="formId">
					<div class="input-field" >
						<label class="icoP" for="nombre">Nombre de Grupo:</label>
						<input class="inpP" type="text" id="nombre" name="nombre" required="">
					</div>

					<div class="input-field" >
						<label class="icoP" for="desc">Descripción de grupo:</label>
						<input class="inpP" type="text" id="desc" name="desc">
					</div>
<div class="input-field col s12">
<i class="material-icons prefix">language</i>
					<select  name='conocimiento' id='conocimiento'>
						<?php 
							$queryTags="select * from AreaConocimiento;";
						    $result = $conexion ->query($queryTags);
						    $extraido = mysqli_fetch_array($result);
						     while($extraido != NULL){
						        echo "<option value='".$extraido["idAreaConocimiento"]."'>".$extraido["Nombre"]."</option>";
						        $extraido = mysqli_fetch_array($result);
						     }
						?>
					</select>
					<label>Area de conocimiento:</label>
					</div>

					<input type="submit" name="sendRequest" class="btn"></input>
					<?php echo "<input type='text' id='idUsr' name='idUsr' value='".$_SESSION['idUsuario']."' hidden></input>"; ?>

				</form>
			</div>
		</div>
	</div>

	</main>
	<?php require("footer.php");?>
    <script src="../frameworks/js/materialize.min.js"></script>
        <script src="../JS/crearGrupos.js"></script>

    <script type="text/javascript">
    	
    	$(document).ready(function() {
    $('select').material_select();
  });
    </script>
</body>
</html>