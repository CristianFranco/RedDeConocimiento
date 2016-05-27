<?php 
    //Inicio de sesión
    session_start();
    //Parámetros de sesión
    $idUsuario=1;//$_SESSION['idUsuario'];
    $idDest=0;
    if(isset($_GET['idDest']))
        $idDest=$_GET['idDest'];
    $asunto="";
    if(isset($_GET['asunto']))
        $asunto=$_GET['asunto'];
   
        

    //Conexión y query's a la BD
    require("procesos/connection.php");
    $connection=connect();
    $queryPub="SELECT * FROM Sigue s ,Usuario u WHERE u.idUsuario=s.idUsuarioSeguidor and s.idUsuario=$idUsuario;";
    $resPub=$connection->query($queryPub);
    

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
    </head>

    <body>

        <header>
            <?php require("header.php")?>
        </header>
        <main>


            <form class="col s12" id="formMensaje" method="POST">
                <div class="container secundario">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="icoP material-icons prefix">account_circle</i>
                            <input id="asunto" type="text" class="inpP validate" name="asunto" value="<?=$asunto?>">
                            <label class="icoP" for="icon_prefix">Asunto</label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col s12">
                            <a class="waves-effect waves-light btn modal-trigger principal" href="#modalAgregar">Agregar</a>
                        </div>
                    </div>
                    <div class="row" id="para">
                        <h5>Para:</h5>
                    </div>
                </div>
                <br>
                <div class="container secundario">
                    <div class="row">
                        <div class="input-field col s12">
                            <textarea id="mensaje" class="inpP materialize-textarea" name="mensaje"></textarea>
                            <label class="icoP" for="mensaje">Contenido</label>
                        </div>
                    </div>

                    <div id="modalAgregar" class="modal">
                        <div class="modal-content">
                            <table>

                                <thead>
                                    <tr>
                                        <th data-field="id">Estado</th>
                                        <th data-field="name">Nickname</th>
                                        <th data-field="price">Nombre</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while($filaPub=$resPub->fetch_array(MYSQLI_ASSOC)){ ?>
                                        <tr>
                                            <td>
                                                <p>
                                                    <input type="checkbox" id="checkbox_<?=$filaPub['idUsuarioSeguidor']?>" onclick="checar(<?=$filaPub['idUsuarioSeguidor']?>)" <?php if($idDest==$filaPub[ 'idUsuarioSeguidor']) echo "checked";?>/>
                                                    <label for="checkbox_<?=$filaPub['idUsuarioSeguidor']?>"></label>
                                                </p>
                                            </td>
                                            <td id="nickname_<?=$filaPub['idUsuarioSeguidor']?>">
                                                <?=$filaPub['Nickname']?>
                                            </td>
                                            <td id="nombre_<?=$filaPub['idUsuarioSeguidor']?>">
                                                <?=$filaPub['Nombre']?>
                                            </td>
                                        </tr>
                                        <?php }?>

                                </tbody>

                            </table>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                        </div>
                    </div>
                    <div class="row">
                        <button id="enviarMensaje" class="btn waves-effect waves-light" type="submit" name="action">Enviar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>

        </main>
        <?php require("footer.php");?>

            <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>
            <script>
                var dest = [];

                function agregarDest(val) {
                    if (val != 0) {
                        dest[val] = val;
                        $("#para").append('<a onclick="eliminar(' + val + ')"  class="principal label waves-effect waves-light btn" id="para_' + val + '">' + $("#nickname_" + val).text() + '<i class="material-icons left">close</i></a>');
                    }
                }

                function checar(val) {
                    if ($("#checkbox_" + val).is(":checked")) {
                        agregarDest(val);

                    } else {
                        eliminar(val);
                    }

                }
                agregarDest(<?=$idDest?>);
                $("#formMensaje").submit(function (e) {
                    e.preventDefault();
                    //alert("enviando infor");
                    var data = new FormData(this);
                    //data.append("mensaje", "s");
                    //data.append("asunto", "s");
                    dest.forEach(function (element, index, array) {
                        data.append('destinatarios[]', element);
                    });
                    /*
                                        $.ajax({
                                            url: "procesos/enviarMensaje.php"
                                            , method: "POST"
                                            , data: data
                                            , dataType: "JSON"
                                            , success: function (result) {
                                                alert(result);
                                            }
                                        });*/
                    var solicitud = new XMLHttpRequest();
                    solicitud.onreadystatechange = function () {
                        if (solicitud.readyState == 4 && solicitud.status == 200) {
                            Materialize.toast('Mensaje Enviado!', 4000)
                        }
                    };
                    solicitud.open("POST", "procesos/enviarMensaje.php", true);
                    solicitud.send(data);


                });

                function eliminar(val) {
                    delete dest[val];
                    $("#para_" + val).remove();
                    $("#checkbox_" + val).removeAttr('checked');
                }
            </script>
    </body>