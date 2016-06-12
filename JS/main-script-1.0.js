/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function cargarSeguidores() {

    $('#contenido').html(
            '<div class="row secundario">                                                              '
            + '<div class="col s12">                                                            '
            + '    <ul class="tabs">                                                          '
            + '        <li class="tab col s6"><a href="#siguiendo" class="icoP">Siguiendo</a></li>  '
            + '        <li class="tab col s6"><a href="#seguidores" class="icoP">Seguidores</a></li>'
            + '    </ul>                                                                       '
            + '    <div class="col s12" id="siguiendo">                                            '
            + '   a </div>                                                                      '
            + '    <div class="col s12" id="seguidores">                                          '
            + '   b </div>                                                                      '
            + '</div>                                                                        '
            );
    $("#siguiendo").html('<div id="cargando1"><h3>Cargando...</h3><br><div class="progress principal"><div class="indeterminate secundario"></div></div></div>');
    $("#seguidor").html('<div id="cargando2"><h3>Cargando...</h3><br><div class="progress principal"><div class="indeterminate secundario"></div></div></div>');
    $.getJSON("procesos/get_seguidores.php",
            function (data) {
                /*$.each(data.seguidores,
                 function (index, s) {
                 llenarUsuarios('seguidores', data.seguidores);
                 });*/

                $("#cargando1").remove();
                $("#cargando2").remove();
                if (data.seguidores.length <= 0) {
                    $("#seguidores").html("Aún no tienes seguidores");
                } else {
                    llenarUsuarios('seguidores', data.seguidores);
                }
                if (data.seguidos.length <= 0) {
                    $("#seguidos").html("Aún no sigues a nadie");
                } else {
                    llenarUsuarios('siguiendo', data.seguidos);
                }
                $('.tooltipped').tooltip({delay: 50});
                $('.modal-trigger').leanModal();
            });
    $('ul.tabs').tabs();
}

function cargarPublicaciones(last_index) {
    $("#contenido").html(
            '<div class="row center">'
            + '   <div class="principal  col s12 m6 offset-m3"><span class="flow-text">Últimas publicaciones</span></div>'
            + ' </div>');
    $("#contenido").append('<div id="cargando"><h3>Cargando...</h3><br><div class="progress principal"><div class="indeterminate secundario"></div></div></div>');
    $.getJSON("procesos/get_publicaciones.php",
            {
                idP: last_index
            },
            function (data) {
                $("#cargando").remove();
                $.each(data.publicaciones,
                        function (index, $publicacion) {
                            var nombreGrupo = '';
                            var botonGrupo = '';
                            if ($publicacion.idGrupo !== null) {
                                nombreGrupo = '<br>Nombre Grupo: ' + $publicacion.NombreGrupo;
                                botonGrupo = '<a class="btn principal right" href="javascript:irGrupo(' + $publicacion.idGrupo + ')">Ver Grupo</a>'
                            }
                            $("#contenido").append(
                                    '<div class="row">'
                                    + '     <div>'
                                    + '       <div class="card ">'
                                    + '         <div class="card-content secundario">'
                                    + '           <span class="card-title">' + $publicacion.Autor + ' publicó:<strong> ' + $publicacion.Titulo + '</strong></span> '
                                    + '           <p>El ' + $publicacion.Fecha.split(' ')[0] + ' a las ' + $publicacion.Fecha.split(' ')[1] + ' hrs.'
                                    //+'           <br>Descripcion: '+$publicacion.['descrip']."                                                        '
                                    + nombreGrupo
                                    + '           <br>Descripcion: ' + $publicacion.Descripcion
                                    + '           </p>'
                                    + '         </div>'
                                    + '         <div class="card-action">  '
                                    + '           <a class="btn principal" href="javascript:irPublicacion(' + $publicacion.idPublicacion + ')">Ver Publicación</a>'
                                    + botonGrupo
                                    + '         </div>                                                                                                    '
                                    + '       </div>                                                                                                      '
                                    + '     </div>                                                                                                        '
                                    + '   </div>                                                                                                          '
                                    );
                        });
                $('.tooltipped').tooltip({delay: 50});
                $('.modal-trigger').leanModal();
            });
}


function cargarGrupos(opciones, area) {
    area = typeof area !== 'undefined' ? area : 'todos';
    var grupos = opciones === 'mios' ? 'Mis grupos' : 'Últimos grupos';
    $("#contenido").html(
            '<div class="row center principal" id="titulosg">'
            + '   <div class="principal col s12 m4 "><span class="flow-text">' + grupos + '</span></div>'
            + ' </div>'

            );
    $("#titulosg").append('<div class="principal col s12 m8" id="areas" ></div>');
    $("#contenido").append('<div id="cargando"><h3>Cargando...</h3><br><div class="progress principal"><div class="indeterminate secundario"></div></div></div>');
    $.getJSON("procesos/getGrupos.php",
            {
                tipo: opciones,
                area: area
            },
            function (data) {
                var i = 0;
                var areaActual = data.area_elegida === 'todos' ? 'Todas las áreas del conocimiento' : data.area_elegida;
                var categorias = "<ul id='dropdown1' class='dropdown-content'>"
                        + "<li><a class='secundario' href=javascript:cargarGrupos('mios')>Todas las áreas</a></li>"
                        + '<li class="divider"></li>';
                $.each(data.areas, function (idArea, nombre) {
                    categorias += ("<li class='secundario'><a href=javascript:cargarGrupos('" + opciones + "'," + idArea + ")>" + nombre + "</a></li>");
                });

                $("#areas").append(categorias
                        + "</ul><a class='dropdown-button btn left principal'  href='#' data-activates='dropdown1'>Filtro: " + areaActual + '<i class="material-icons right">arrow_drop_down</i></a>'
                        );
                $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrain_width: false, // Does not change width of dropdown to that of the activator
                    hover: true, // Activate on hover
                    gutter: 0, // Spacing from edge
                    belowOrigin: false, // Displays dropdown below the button
                    alignment: 'left' // Displays dropdown with edge aligned to the left of button
                }
                );
                $("#cargando").remove();
                $("#contenido").append('<div class="row principal">'
                        + '<ul>'

                        + '</ul><div>');
                if (data.grupos.length > 0) {
                    $.each(data.grupos,
                            function (key, val) {
                                i++;
                                $("#contenido").append(
                                        /** //+'<div>'  
                                         + '<br>Grupo: ' + val.NombreGrupo 
                                         + '<br>Descripcion: ' + val.Descripcion
                                         + '<br>Area de conocimiento: ' + val.AreaConocimiento
                                         + '<br>Descripción área del conocimiento: ' + val.DescAreaConocimiento
                                         //+ '</div>'
                                         + "</div></li>"
                                         *///'<div class="row">'
                                        ' <div class="col s12 m6 ">'
                                        + '   <div class="card principal z-depth-2" >'//"blue-grey darken-1">'
                                        + '     <div class="card-content" >'//white-text">'
                                        + '       <span class="card-title">' + val.NombreGrupo + '</span>'
                                        + '       <p>' + val.Descripcion.substr(0, 100) + '...</p>'
                                        + '     </div>'
                                        + '<div class="card-action">'
                                        + 'Área de conocimiento<br>'
                                        + '<div class="row"><a class="tooltipped waves-effect waves-light modal-trigger left" data-position="bottom" data-delay="50" data-tooltip="Click para más info." href="#modal' + i + '">' + val.AreaConocimiento + '</a>'
                                        + '<a class="right tooltipped" data-tooltip="Click para ir al grupo" href=javascript:irGrupo("' + val.idGrupo + '") > Ir al grupo</a>'
                                        + '</div></div></div></div>'


                                        + '<div id="modal' + i + '" class="modal bottom-sheet">'
                                        + '   <div class="modal-content">'
                                        + '       <h4>' + val.AreaConocimiento + '</h4>'
                                        + '       <p>' + val.DescAreaConocimiento + '</p>'
                                        + '   </div>'
                                        + '   <div class="modal-footer">'
                                        + '       <button class="btn modal-action modal-close waves-effect ">Aceptar</button>'
                                        + '   </div>'
                                        + '</div>');
                            });
                } else {

                    $("#contenido").append('<div class="card secundario">'
                            + '<div class="card-content"><h4>No tienes ningún  grupo aún.</h4><div>'
                            + '<button onclick=window.location.href="creaGrupo.php" class="btn">Crear grupo</button>'
                            + '</div>');
                }
                $('.tooltipped').tooltip({delay: 50});
                $('.modal-trigger').leanModal();
            });


}


function irGrupo(idGrupo) {
    $('<form action="mostrar.php" method=post>'
            + '<input type=hidden name=tipo value=grupo>'
            + '<input type=hidden name=uid value=' + idGrupo + '>'
            + '</form>').submit();
}

function irPublicacion(idP) {
    $('<form action="publicacion.php" method=post>'
            + '<input type=hidden name=idPub value=' + idP + '>'
            + '</form>').submit();
}

function irUsuario(idU) {
    $('<form action="mostrar.php" method=post>'
            + '<input type=hidden name=uid value=' + idU + '>'
            + '<input type=hidden name=tipo value="usuario">'
            + '</form>').submit();
}

function llenarUsuarios(div, usuarios) {
    $('#' + div).html('');
    $.each(usuarios, function (key, user) {
        $('#' + div).append(
                '<div class="row">                                                                                   ' +
                '   <div>                                                                                             ' +
                '     <div class="card">                                                                              ' +
                '       <div class="card-content principal">                                                          ' +
                '         <span class="card-title">' + user.Nickname + '</span>                    ' +
                '         <p>' + user.Nombre + ' ' + user.Apellidos +
                '         <br>Correo: ' + user.Email +
                '         <br>No. Telefónico:  ' + user.Telefono +
                '         <a href=javascript:irUsuario(' + user.idUsuario + ') class=right>Ver perfil</a>' +
                '           </p>                                                                                      ' +
                '           </div>                                                                                    ' +
                '     </div>                                                                                          ' +
                '   </div>                                                                                            ' +
                ' </div>																							  '
                );
    });

}