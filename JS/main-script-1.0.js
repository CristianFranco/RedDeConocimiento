/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function cargarPublicaciones(last_index) {
    $("#contenido").html(
            '<div class="row center">'
            + '   <div class="principal z-depth-2 col s12 m6 offset-m3"><span class="flow-text">Últimas publicaciones</span></div>'
            + ' </div>');
    $("#contenido").append('<div id="cargando"><h3>Cargando...</h3><br><div class="progress principal"><div class="indeterminate secundario"></div></div></div>');

    $.getJSON("procesos/get_publicaciones.php",
            {
                idP: last_index
            },
            function (data) {
                $("#cargando").remove();
                $.each(data.publicaciones, function (index, publicacion) {
                    if (publicacion.idGrupo === null) {
                        $('#contenido').append(index+': No hay grupo<br>');
                    } else {
                        $('#contenido').append(index+': '+publicacion.NombreGrupo+'<br>');
                    }
                });
                $('.tooltipped').tooltip({delay: 50});
                $('.modal-trigger').leanModal();
            });
}


function cargarGrupos(opciones) {
    if (opciones === 'mios') {
        $("#contenido").html(
                '<div class="row center  ">'
                + '   <div class="principal z-depth-2 col s12 m6 offset-m3"><span class="flow-text">Mis grupos</span></div>'
                + ' </div>'

                );
    } else {
        $("#contenido").html(
                '<div class="row center">'
                + '   <div class="principal z-depth-2 col s12 m6 offset-m3"><span class="flow-text">Últimos grupos</span></div>'
                + ' </div>');

    }
    $("#contenido").append('<div id="cargando"><h3>Cargando...</h3><br><div class="progress principal"><div class="indeterminate secundario"></div></div></div>');
    $.getJSON("procesos/getGrupos.php",
            {
                tipo: opciones
            },
            function (data) {
                var i = 0;
                $("#cargando").remove();
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
                                        + '       <p>' + val.Descripcion + '</p>'
                                        + '     </div>'
                                        + '<div class="card-action">'
                                        + 'Área de conocimiento<br>'
                                        + '<a class="tooltipped waves-effect waves-light modal-trigger left" data-position="bottom" data-delay="50" data-tooltip="Click para más info." href="#modal' + i + '">' + val.AreaConocimiento + '</a>'
                                        + '<a class="right tooltipped" data-tooltip="Click para ir al grupo" href=javascript:irGrupo("' + val.idGrupo + '") > Ir al grupo</a>'
                                        + '</div></div></div>'

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