
<!DOCTYPE html>
    <html lang="es">
<head>
     <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Confirmacion</title>

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
    <!--estilo para centrar div -->
    <style>
    .centrar
	{
		position: absolute;
		/*nos posicionamos en el centro del navegador*/
		top:50%;
		left:50%;
		/*determinamos una anchura*/
		width:900px;
		/*indicamos que el margen izquierdo, es la mitad de la anchura*/
		margin-left:-450px;
		/*determinamos una altura*/
		height:300px;
		/*indicamos que el margen superior, es la mitad de la altura*/
		margin-top:-135px;
		padding:5px;
	}
	</style>
   
    </head>
<body>
    <header>
            <?php require("header.php")?>
  </header>
    <main>
    <div class="centrar">
        <div class="container secundario">
            <?php
                //session_start();
                $usr=$_GET['IdUsr'];
                //echo $usr;
                //echo "<br/>";
                $codig=$_GET['confirmacion'];
                //echo $codig;
                require("procesos/connection.php");
                $connection=connect();
                $query="UPDATE Usuario SET Estado=1 WHERE IdUsuario='".$usr."' AND CodigoAc=".$codig.";";
                if($connection -> query($query)){
                    echo "<h4 class='icoP'>Su cuenta de la red de conocimiento ha sido activada con exito.....</h4>";
                    echo"</br><h4 class='icoP'>Espere mientras se redirecciona a la pagina principal</h4>";
                }
            ?>
        </div>
    </div>
    </main>
    <?php require("footer.php");?>
    <script src="../frameworks/js/materialize.min.js"></script>
    <script src="../JS/header.js"></script>
    <script>
    setTimeout(function(e){
        window.location="index.php";
    },7000);
    </script>
    </body>
</html>