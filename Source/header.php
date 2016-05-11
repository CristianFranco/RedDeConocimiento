<nav class="blue darken-3">
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">RedConocimiento</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      
        <ul id="nav-mobile" class="right hide-on-med-and-down">

            <li class="col s2">
                <!--<i class="material-icons left">search</i>-->

                <div class="input-field col s1">
                    <i class="material-icons right">search</i>
                    <input id="cajaBuscar" type="text" class="validate white blue-text text-darken-2" style="margin-left:25px;width:200px;height:30px;" placeholder="Buscar">

                </div>
                <a href="#" id="busquedaA" class="blue darken-2 white" style="display:none;">
                    <div style="width:250px;" class="center-align">
                        Busqueda Avanzada
                    </div>
                </a>


            </li>
            <li><a href="badges.html"><i class="material-icons">home</i></a></li>
            <!-- Si no está logeado-->
            <?php if(!isset($_SESSION['idUsuario'])){ ?>
                <li><a href="collapsible.html"><i class="material-icons">person_add</i></a></li>
                <li><a href="" id="click"><i class="material-icons">exit_to_app</i></a></li>


                <!--- Si está logeado-->
                <?php } else{ ?>
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li>
                        <a href="collapsible.html">
                            <?=$_SESSION['nickname']?>
                        </a>
                    </li>
                    <?php } ?>
        </ul>
        <ul class="side-nav" id="mobile-demo">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">Javascript</a></li>
        <li><a href="mobile.html">Mobile</a></li>
      </ul>
    </div>
</nav>
<script>
 $(".button-collapse").sideNav();
</script>

<script>
    $("#cajaBuscar").focus(function (e) {
        console.log("hola");
        $("#busquedaA").attr('style', 'display:block');
        $("#busquedaA").attr('style', 'position:absolute');
    });
    $("#cajaBuscar").focusout(function (e) {
        console.log("hola");
        $("#busquedaA").attr('style', 'display:none');

    });
</script>