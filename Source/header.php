<nav class="principal">
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">Cognitus</a>
        <a id="mobileButton" href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">

            <li class="col s2">
                <!--<i class="material-icons left">search</i>-->

                <div class="input-field col s1">

                    <input id="cajaBuscar" type="text" class="validate white black-text" style="margin-left:25px;width:200px;height:30px;" placeholder="Buscar">

                </div>
                <a href="#" id="busquedaA" class="" style="display:none;">
                    <div style="width:250px;" class=" center-align">
                        Busqueda Avanzada
                    </div>
                </a>


            </li>
            <li>
                <i class="material-icons right" id="buscar">search</i>
            </li>
            <li><a href="index.php" class="tooltipped" data-tooltip="Ir a inicio"><i class="material-icons ">home</i></a></li>
            <!-- Si no está logeado-->
            <?php if(!isset($_SESSION['idUsuario'])){ ?>
                <li><a id="loginBoton" href="#login" class="modal-trigger">Iniciar Sesión</a></li>
                <li><a href="registro.php" id="click">Registrarse</a></li>


                <!--- Si está logeado-->
                <?php } else{ ?>
                    <li><a href="sass.html" class="tooltipped" data-tooltip="Publicar"><i class="material-icons " >note_add</i></a></li>
                    <li><a href="creaGrupo.php" class="tooltipped" data-tooltip="Crear grupo"><i class="material-icons">group_add</i></a></li>
                    <li><a href="inbox.php" class="tooltipped" data-tooltip="Bandeja de entrada"><i class="material-icons left">message</i><span id="inb"></span></a></li>
                    <li>
                        <ul id="perfilDropDown" class="dropdown-content">
                            <li><a href="editarPerfil.php">Editar Perfil</a></li>
                            <li><a href="personalizar.php">Personalizar</a></li>
                            <li class="divider"></li>
                            <li><a href="procesos/salir.php">Salir</a></li>
                        </ul>
                        <ul id="perfilDropDown2" class="dropdown-content">
                            <li><a href="editarPerfil.php">Editar Perfil</a></li>
                            <li><a href="personalizar.php">Personalizar</a></li>
                            <li class="divider"></li>
                            <li><a href="procesos/salir.php">Salir</a></li>
                        </ul>
                        <a id="dropdown-button-normal" class="dropdown-button" href="#!" data-activates="perfilDropDown">Bienvenido 
                            <?=$_SESSION['nickname']?><i class="material-icons right">arrow_drop_down</i></a>

                    </li>
                    <?php } ?>
        </ul>
        <ul class="side-nav principal" id="mobile-navbar">

            <li>
                <div class="input-field">
                    <i class="material-icons prefix black-text">search</i>
                    <input id="cajaBuscar2" type="text" class="validate white black-text" placeholder="Buscar" width="25px">
                    <label for="cajaBuscar2 black"></label>
                </div>
            </li>
            <li><a href="index.php"><i class="material-icons left">home</i>Inicio</a></li>
            <li>
                <a href="#" id="busquedaA">
                        Busqueda Avanzada
                </a>
            </li>

            <!-- Si no está logeado-->
            <?php if(!isset($_SESSION['idUsuario'])){ ?>
                <li><a id="loginBoton" href="#login" class="modal-trigger">Iniciar Sesión</a></li>
                <li><a href="registro.php" id="click">Registrarse</a></li>


                <!--- Si está logeado-->
                <?php } else{ ?>
                    <li><a href="sass.html"><i class="material-icons left">note_add</i>Publicar</a></li>
                    <li><a href="creaGrupo.php"><i class="material-icons left">group_add</i>Crear Grupo</a></li>
                    <li><a href="inbox.php"><i class="material-icons left">message</i>Inbox</a></li>
                    <li>
                        <a id="dropdown-button-mobile" class="dropdown-button" href="#!" data-activates="perfilDropDown2">Bienvenido 
                            <?=$_SESSION['nickname']?><i class="material-icons right">arrow_drop_down</i></a>
                        </a>
                    </li>
                    <?php } ?>
        </ul>
    </div>
</nav>

<div id="login" class="modal ">
    <form action="" id="formLogin" class="">
        <div class="secundario">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h5 class="center-align principal">Iniciar Sesión</h5>

                        <div class="input-field col s12">
                            <i class="material-icons prefix icoP">account_circle</i>
                            <input id="usuario" type="text" class="validate inpP">
                            <label for="usuario" class="icoP">Usuario</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix icoP">vpn_key</i>
                            <input id="pass" type="password" class="validate inpP">
                            <label for="pass" class="icoP">Contraseña</label>
                        </div>

                    </div>
                    <div id="loginMsn" class="card-panel red darken-1 col s12 center-align white-text" style="visibility:hidden;"></div>

                </div>
            </div>

        </div>
        <div class="modal-footer secundario">
            <div class="secundario">
                
               <button id="iniciar" class="btn waves-effect principal" type="submit" name="action">Iniciar
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
<?php
    if(isset($_SESSION["idUsuario"])){
?>
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(e){ 
            $.ajax({
                url:"procesos/noMensajes.php"
                , success: function (data) {
                    if(data!=0){
                        $('#inb').html("<span class='new badge secundario'>"+data+"</span>");
                    }else{
                        $('#inb').html("<span></span>");
                    }
                }
            });
        },1000);
      });
</script>
<?php
                                     }
?>
