<ul id="perfilDropDown" class="dropdown-content">
    <li><a href="#!">Editar Perfil</a></li>
    <li><a href="#!">Personalizar</a></li>
    <li class="divider"></li>
    <li><a href="procesos/salir.php">Salir</a></li>
</ul>
<nav class="principal">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">RedConocimiento</a>
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
                <a href=""><i class="material-icons right">search</i></a>
            </li>
            <li><a href="badges.html"><i class="material-icons">home</i></a></li>
            <!-- Si no está logeado-->
            <?php if(!isset($_SESSION['idUsuario'])){ ?>
                <li><a id="loginBoton" href="#login" class="modal-trigger">Iniciar Sesión</a></li>
                <li><a href="" id="click">Registrarse</a></li>


                <!--- Si está logeado-->
                <?php } else{ ?>
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html"><i class="material-icons">message</i></a></li>
                    <li>
                        <a class="dropdown-button" href="#!" data-activates="perfilDropDown">Bienvenido 
                            <?=$_SESSION['nickname']?><i class="material-icons right">arrow_drop_down</i></a>
                        </a>
                    </li>
                    <?php } ?>
        </ul>
        <ul class="side-nav" id="mobile-navbar">

            <li>
                <div class="input-field">
                    <i class="material-icons prefix black-text">search</i>
                    <input id="cajaBuscar2" type="text" class="validate white black-text" placeholder="Buscar">
                    <label for="cajaBuscar2 black"></label>
                </div>
            </li>
            <li><a href="badges.html"><i class="material-icons left">home</i>Inicio</a></li>
            <li>
                <a href="#" id="busquedaA">
                        Busqueda Avanzada
                </a>
            </li>

            <!-- Si no está logeado-->
            <?php if(!isset($_SESSION['idUsuario'])){ ?>
                <li><a id="loginBoton" href="#login" class="modal-trigger">Iniciar Sesión</a></li>
                <li><a href="" id="click">Registrarse</a></li>


                <!--- Si está logeado-->
                <?php } else{ ?>
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html"><i class="material-icons">message</i></a></li>
                    <li>
                        <a class="dropdown-button" href="#!" data-activates="perfilDropDown">Bienvenido 
                            <?=$_SESSION['nickname']?><i class="material-icons right">arrow_drop_down</i></a>
                        </a>
                    </li>
                    <?php } ?>
        </ul>
    </div>
</nav>

<div id="login" class="modal ">
    <form action="" id="formLogin" class="">
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h5 class="center-align principal">Iniciar Sesión</h5>

                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="usuario" type="text" class="validate">
                            <label for="usuario">Usuario</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input id="pass" type="password" class="validate">
                            <label for="pass">Contraseña</label>
                        </div>

                    </div>
                    <div id="loginMsn" class="card-panel red darken-1 col s12 center-align white-text" style="display:none"></div>

                </div>
            </div>

        </div>
        <div class="modal-footer principal">
            <div class="principal">
                <input type="submit" id="iniciar" class="waves-effect btn" value="Iniciar"></input>
                <a href="#!" class=" modal-action modal-close btn">Cancelar</a>
            </div>
        </div>
    </form>
</div>