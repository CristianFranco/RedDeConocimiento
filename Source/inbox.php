
<?php
    session_start();
    //if(isset($_SESSION["idUsuario"])){
        require('procesos/connection.php');
        $connection=connect();
        $idSession=1;
        //$idSession=$_SESSION["idUsuario"];
        $mensajes=array();
        $query="SELECT MM.ID, U.Nickname, MM.Asunto, MM.Mensaje, MM.Visto, MM.Fecha
                FROM Usuario U, MandaMsn MM
                WHERE MM.idUsuario='$idSession' AND MM.mostrar=1 AND MM.idUsuario1=U.idUsuario
                ORDER BY MM.Fecha;";
        $result=$connection->query($query);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
            $mensaje=array("ID"=>$row["ID"],"Nombre"=>$row["Nickname"],"Asunto"=>$row["Asunto"],"Mensaje"=>$row["Mensaje"],"Fecha"=>$row["Fecha"],"Visto"=>$row["Visto"]);
            array_push($mensajes,$mensaje);
        }
        $JSON=json_encode($mensajes);
        setcookie("Mensajes",$JSON);
?>
<!DOCTYPE html>
<html lang="es">
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
        <link type="text/css" rel="stylesheet" href="../CSS/table.css">
   
    </head>
    
        

    <body>
       <header>
        <?php
            require('header.php');
        ?>
        </header>
        <main>
        <div class="container secundario">
            <div class="row">
                <div style="background-color: #eeeeee;" class="col s12 m12 valign-wrapper">
                    <!--<div class="card-panel grey lighten-4">-->
                    <div class="col s2 m2">
                        <a class="col s12 m12 btn waves-effect waves-light principal" onclick="reloadPage();"><i class="material-icons">replay</i></a>
                    </div>
                    <div class="input-field col s6 m6">
                        <i class="material-icons prefix">search</i>
                        <!--<span>-->
                        <input id="icon_prefix" data-delay='50' data-position='top' data-tooltip='Buscar en Bandeja' type="text" class="validate tooltipped" onkeydown="enter(this,event);">
                        <label for="icon_prefix">Buscar</label>
                        <!--</span>-->
                    </div>

                    <div class="col s2 m2">
                        <a class="col s12 m12 btn waves-effect waves-light right-align principal disabled" id="prev"><i class="material-icons">skip_previous</i></a>
                    </div>
                    <div class="col s2 m2">
                        <a class="col s12 m12 btn waves-effect waves-light right-align principal" id="next"><i class="material-icons">skip_next</i></a>
                    </div>
                    <!--</div>-->
                </div>
                <div class="col s3 m3">
                    <a class="col s12 m12 waves-effect waves-light btn-large red accent-4" onclick="redactar();">Redactar</a>
                    <br>
                    <br>
                    <a style="font-size:13px;" id="marcar" class="col s12 m12 waves-effect waves-light btn-large principal">Marcar&nbsp;Todo&nbsp;Como&nbsp;Leido</a>
                    <br>
                    <br>
                    <a id="vaciar" class="col s12 m12 waves-effect waves-light btn-large principal" >Vaciar&nbsp;Bandeja</a>
                    <br>
                    <br>
                    <a class="col s12 m12 waves-effect waves-light btn-large principal" id="bandeja">Mensajes&nbsp;Enviados</a>
                </div>
                <div style="height: 453px;" class="col s9 m9" id="tabla">
                </div>
            </div>
            <div id="elimina" style="height: 25%;" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>¿Eliminar Mensaje?</h4>
                    <p>¿Estás seguro que deseas eliminar este mensaje? Si estás de acuerdo pulsa el botón aceptar, en caso contrario, pulsa el boton cancelar.</p>
                </div>
                <div class="modal-footer">
                    <a id="elimAc" class="modal-action waves-effect waves-green btn-flat ">Aceptar</a>
                    <a class="modal-action modal-close waves-effect waves-red btn-flat ">Cancelar</a>
                </div>
            </div>
            <div id="reporta" style="height: 30%;" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>¿Reportar Mensaje?</h4>
                    <p>¿Estás seguro que deseas reportar este mensaje?</p>
                    <p>Al reportar este mensaje, enviaremos un mensaje a quien envió el mensaje, indicandole que su mensaje fue reportado, además de penalizarlo. Si estás de acuerdo pulsa el botón aceptar, en caso contrario, pulsa el boton cancelar.</p>
                </div>
                <div class="modal-footer">
                    <a id="reporAc" class="modal-action waves-effect waves-green btn-flat ">Aceptar</a>
                    <a class="modal-action modal-close waves-effect waves-red btn-flat ">Cancelar</a>
                </div>
            </div>
            <div id="mensaje" class="modal modal-fixed-footer">
                
            </div>
        </div>
        </main>
        <?php
            require('footer.php');
        ?>
        
        <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>
       <script type="text/javascript" src="../JS/inboxFunctions.js"></script>
    </body>

</html>
<?php
    /*}else{
        header('location: index.php');
    }*/
?>