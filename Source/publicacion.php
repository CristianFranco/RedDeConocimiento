<?php 
    //Inicio de sesión
    session_start();
    //Parámetros de sesión
    $idUsr=1;//$_SESSION["idUsuario"];
    $acceso=1;//$_SESSION['tipo'];
    
    //Parámetros externos
    $idPub=1;//$_POST['idPub']

    //Conexión y query's a la BD
    require("procesos/connection.php");
    $connection=connect();
    $queryPub="SELECT * FROM Publicacion where idPublicacion=$idPub;";
    $resPub=$connection->query($queryPub);
    $filaPub=$resPub->fetch_array(MYSQLI_ASSOC);
    $fecha = $filaPub['Fecha'];
    $dt = new DateTime($fecha);
//->num_rows;

    $query="select * from Elemento where Tipo=1 and idPublicacion=$idPub ;";
//1 archivo, 2 images, 3 video y 4 audio
    $documentos=$connection->query($query);
    $nDocumentos=$documentos->num_rows;
    
    $query="select * from Elemento where Tipo=2 and idPublicacion=$idPub ;";
    $imagenes=$connection->query($query);
    $nImagenes=$imagenes->num_rows;
    
    $query="select * from Elemento where Tipo=3 and idPublicacion=$idPub ;";
    $videos=$connection->query($query);
    $nVideos=$videos->num_rows;

    $query="select * from Elemento where Tipo=4 and idPublicacion=$idPub ;";
    $audios=$connection->query($query);
    $nAudios=$audios->num_rows;

    $query="select * from Usuario u,Comenta c where c.idPublicacion=$idPub and u.idUsuario=c.idUsuario order by c.Fecha";
    $comentarios=$connection->query($query);
   $numRows=$comentarios->num_rows;

    $query="select Puntaje from Califica where idUsuario=$idUsr and idPublicacion=$idPub";
    $calificacion=$connection->query($query);
    $estrellas=$calificacion->fetch_array(MYSQLI_ASSOC);
    
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
        <link rel="stylesheet" href="../CSS/swiper.min.css">

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
        <!-- Header -->
        <header>
            <?php require("header.php")?>
        </header>
        
        <!--Contenido de la publicación -->
        <div class="container">
            <div class="row">
                <!-- Titulo de la puclicación -->
                <div class="col s12 m6">
                    <h5><?=$filaPub['Titulo']?></h5>
                </div>
                <div class="col s6 m3">
                   <?=$filaPub['Puntaje']?>/5.00
                    <div class="my-rating"></div>
                    
                </div>
                <div class="col s6 m3 right-align">
                    <h5><?=$dt->format('Y-m-d')?>
                   
                   
                    </h5>
                    
                </div>
                
                <!-- Menú de la publicación-->

                <nav class="col s12 principal">

                    <div class=" nav-wrapper ">
                        <a id="mobilePubButton" href="#" data-activates="mobilePub" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul id="navPub " class="left hide-on-med-and-down ">
                            <li><a id="pubDescButton"><i class="material-icons left" >info</i>&nbsp;</a>

                            </li>
                            <li><a id="pubImgButton">
                            (<?=$nImagenes?>)
                            <i class="material-icons left ">photo_camera</i>    
                        </a></li>
                            <li><a id="pubVidButton">
                            (<?=$nVideos?>)
                            <i class="material-icons left ">videocam<!--movie--></i>    
                        </a></li>
                            <li><a id="pubAudButton">
                            (<?=$nAudios?>)
                            <i class="material-icons left ">audiotrack</i> 
                        </a></li>
                            <li><a id="pubDocButton">
                            (<?=$nDocumentos?>)
                            <i class="material-icons left ">description</i> 
                        </a></li>
                            <li><a id="pubComButton">
                            (<?=$numRows?>)
                            <i class="material-icons left ">sms</i> 
                        </a></li>
                        <li>
                            <a href="#comentar" class="modal-trigger waves-effect waves-light btn secundario">Comentar</a>
                        </li>
                        </ul>
                        <ul class="side-nav" id="mobilePub">
                            <li><a href="#"><i class="material-icons left" >info</i>&nbsp;</a>

                            </li>
                            <li><a>
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">photo_camera</i>    
                        </a></li>
                            <li><a>
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">videocam<!--movie--></i>    
                        </a></li>
                            <li><a>
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">audiotrack</i> 
                        </a></li>
                            <li><a>
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">description</i> 
                        </a></li>¿
                            <li><a>
                            (<span class="badge ">4</span>)
                            <i class="material-icons left ">sms</i> 
                        </a></li>
                        </ul>
                    </div>
                </nav>

            </div>
            <div class="swiper-container row secundario" id="pubDesc" >
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                       <h5>Abstract</h5>
                        <p>hola</p>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="swiper-container row secundario" id="pubImg" >
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php while($fila=$imagenes->fetch_array(MYSQLI_ASSOC)){?>
                    <div class="swiper-slide">
                       <h5>Imagenes</h5>
                        <p><?=$fila['Descripcion']?></p>
                        <img src="../publicaciones/<?=$idPub?>/<?=$fila['Directorio']?>" alt="Smiley face" height="60%" width="100%">
                        
                    </div>
                    <?php } ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="swiper-container row secundario" id="pubVid" >
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    
                    <?php while($fila=$videos->fetch_array(MYSQLI_ASSOC)){ ?>
                    <div class="swiper-slide">
                       <h5>Videos</h5>
                        <p><?=$fila['Descripcion']?></p>
                        <video  src="../publicaciones/<?=$idPub?>/<?=$fila['Directorio']?>" alt="Smiley face" height="60%" width="100%" controls>
                    </div>
                    <?php } ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="swiper-container row secundario" id="pubAud">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php while($fila=$audios->fetch_array(MYSQLI_ASSOC)){?>
                    <div class="swiper-slide">
                       <h5>Audios</h5>
                        <p><?=$fila['Descripcion']?></p>
                    </div>
                    <?php } ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="swiper-container row secundario" id="pubDoc" >
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php while($fila=$documentos->fetch_array(MYSQLI_ASSOC)){?>
                    <div class="swiper-slide">
                       <h5>Documentos</h5>
                        <p><?=$fila['Descripcion']?></p>
                    </div>
                    <?php } ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="swiper-container secundario row" id="pubCom" >
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                   
                    <!-- Slides -->
                    <?php 
                        $contador=0;
                        $contador2=1;
                        
                    ?>
                    <?php while($fila=$comentarios->fetch_array(MYSQLI_ASSOC)){?>
                        <?php if($contador==0){?>
                            <div class="swiper-slide">
                           
                            <h5>Comentarios</h5>
                        <?php }?>
                          
                               <div class="principal col m6" >
                                    <?=$fila['Nickname']?>
                                </div>
                                <div class="principal col m6 right-align" >
                                    <?=$fila['Fecha']?>
                                </div>
                                <div class=" secundario col s12">
                                    <?=$fila['Comentario']?>
                                </div>
                          
                        <?php if($contador2++==$numRows || $contador>1){ ?>
                            </div>
                        <?php $contador=-1;}?>
                    <?php $contador++;} ?>
                 
                
          
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>

<div id="comentar" class="modal ">
    <form action="" id="formLogin" class="">
        <div class="secundario">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h5 class="center-align principal">Comentar</h5>

                        <div class="input-field col s12">
                          <textarea id="textarea1" class="materialize-textarea inpP"></textarea>
                          <label for="textarea1" class="icoP">Comentario</label>
                        </div>

                    </div>
                    <div id="loginMsn" class="card-panel red darken-1 col s12 center-align white-text" style="visibility:hidden;"></div>

                </div>
            </div>

        </div>
        <div class="modal-footer secundario ">
            <div class="secundario center-align">
                
               <button id="iniciar" class="btn waves-effect principal" type="submit" name="action">Comentar
                <i class="material-icons right">send</i>
              </button>
               <button  class="btn waves-effect principal modal-action modal-close" type="submit" name="action">Cancelar
                <i class="material-icons right">close</i>
              </button>
                <!-- <input type="submit" id="iniciar" class="waves-effect btn secundario" value="Iniciar"></input>
                <input type="button" href="" class=" modal-action modal-close waves-effect btn  secundario" value="Cancelar"></input>-->
            </div>
        </div>
    </form>
</div>

        <?php require("footer.php ");?>


            <!-- Compiled and minified JavaScript -->
            <script src="../frameworks/js/materialize.min.js"></script>
            <script src="../JS/header.js"></script>
            <script>
                var textoDesc = "<?=$filaPub['Descripcion']?>";
                var palabras = textoDesc.split(/(\s+)/);
            </script>
            <script src="../JS/publicacion.js"></script>
            <script src="../JS/swiper.jquery.min.js"></script>
            <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
            <script src="../JS/Estrellas/jquery.star-rating-svg.js"></script>
            <script>
            $(".my-rating").starRating({
                initialRating: <?php if(isset($estrellas['Puntaje']))
                    echo $estrellas['Puntaje'];
                    else
                        echo 0;
                ?>,
                starSize: 25,
                disableAfterRate: false,
                onHover: function(currentIndex, currentRating, $el){
                  $('.live-rating').text(currentIndex);
                },
                onLeave: function(currentIndex, currentRating, $el){
                  $('.live-rating').text(currentRating);
                },
                callback: function(currentRating, $el){
                alert('rated ', currentRating);
                console.log('DOM element ', $el);
                     $.ajax({
                        url: "procesos/calificacion.php"
                        , type: "POST"
                        , data: {calificacion:currentRating,idPub:"<?=$idPub?>"}
                        ,dataType:'json'
                        , success: function (data, textStatus, jqXHR) {
                            console.log(data);
                           
                           // data: return data from server
                        }
                    });
                
                }
            });
            </script>
            <link rel="stylesheet" type="text/css" href="../CSS/star-rating-svg.css">
            
    </body>

    </html>