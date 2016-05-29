var indice = 0;
var box=0;
var opt=4;
$(document).ready(function () {
    indice = 0;
    $('.tooltipped').tooltip({delay: 50});
    $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
    var cookie = document.cookie;
    var mensajes = cookie.split(";")[0];
    var json = mensajes.split("=")[1];
    var string = decodeURIComponent(json);
    var obj = JSON.parse(string);
    var longitud = obj.length;
    if (longitud < 8) {
        $('#next').addClass('disabled');
    } else {
        $('#next').on('click', nextIndex);
    }
    $('#bandeja').on('click', mostrarEnviados)
    $('#marcar').on('click',marcarLeido);
    $('#vaciar').on('click',borrarTodo);
});

function eliminar(idMensaje) {
    $('#elimina').openModal();
    var button=document.getElementById('elimAc');
    var idMsj=idMensaje;
    opt=5;
    button.onclick=function(){
        indice = 0;
        $('#prev').addClass("disabled");
        $('#prev').off('click');
        $.ajax({
            url: '../Source/procesos/loadSearch.php?opt=5&msjIndex='+idMsj,
            dataType: 'json',
            async: false,
            success: function (data) {
                json = JSON.stringify(data);
                document.cookie = "Mensajes=" + json;
                $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
            }

        });
        var cookie = document.cookie;
        var mensajes = cookie.split(";")[0];
        var json = mensajes.split("=")[1];
        var string = decodeURIComponent(json);
        var obj = JSON.parse(string);
        var longitud = obj.length;
        if (longitud < 8) {
            $('#next').off('click');
            $('#next').addClass('disabled');
        } else {
            $('#next').on('click', nextIndex);
            $('#next').removeClass('disabled');
        }
        $('#elimina').closeModal();
    }
}

function reportar(idMensaje) {
    $('#reporta').openModal();
    var button=document.getElementById('reporAc');
    var idMsj=idMensaje;
    opt=5;
    button.onclick=function(){
        indice = 0;
        $('#prev').addClass("disabled");
        $('#prev').off('click');
        $.ajax({
            url: '../Source/procesos/loadSearch.php?opt=5&msjIndex='+idMsj,
            dataType: 'json',
            async: false,
            success: function (data) {
                json = JSON.stringify(data);
                document.cookie = "Mensajes=" + json;
                $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
            }

        });
        var cookie = document.cookie;
        var mensajes = cookie.split(";")[0];
        var json = mensajes.split("=")[1];
        var string = decodeURIComponent(json);
        var obj = JSON.parse(string);
        var longitud = obj.length;
        if (longitud < 8) {
            $('#next').off('click');
            $('#next').addClass('disabled');
        } else {
            $('#next').on('click', nextIndex);
            $('#next').removeClass('disabled');
        }
        $('#reporta').closeModal();
    }
}

function mostrar(idMensaje) {
    $.ajax({
        url: '../Source/procesos/getMsg.php?idMensaje='+idMensaje+"&box="+box,
        dataType: 'html',
        async: false,
        success: function (data) {
            $('#mensaje').html(data);
            $('#mensaje').openModal({
                complete: function(){
                    
                   $.ajax({
                        url: '../Source/procesos/loadSearch.php?opt='+opt,
                        dataType: 'json',
                        async: false,
                        success: function (data) {
                            json = JSON.stringify(data);
                            document.cookie = "Mensajes=" + json;
                            $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert(opt);
                          }

                    });
               } 
            });
            var button=document.getElementById('resp');
            button.onclick=function(){
                var asunto=document.getElementById('asnt').value;
                var idEnviar=document.getElementById('idEnviar').value;
                window.location.href='../Source/mensaje.php?asunto='+asunto+'&idDest='+idEnviar;
            }
        }

    });
}

function nextIndex() {
    if ($('#prev').hasClass("disabled")) {
        $('#prev').removeClass("disabled");
        $('#prev').on('click', prevIndex);
    }
    indice++;
    var cookie = document.cookie;
    var mensajes = cookie.split(";")[0];
    var json = mensajes.split("=")[1];
    var string = decodeURIComponent(json);
    var obj = JSON.parse(string);
    var longitud = obj.length;
    if (indice == Math.floor(longitud / 8)) {
        $('#next').addClass("disabled");
        $('#next').off('click');
    }
    $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
}

function prevIndex() {
    if ($('#next').hasClass("disabled")) {
        $('#next').removeClass("disabled");
        $('#next').on('click', nextIndex);
    }
    indice--;
    if (indice == 0) {
        $('#prev').addClass("disabled");
        $('#prev').off('click');
    }
    $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
}

function reloadPage() {
    location.reload();
}

function marcarLeido() {
    indice = 0;
    opt=1;
    $('#prev').addClass("disabled");
    $('#prev').off('click');
    $.ajax({
        url: '../Source/procesos/loadSearch.php?opt=1',
        dataType: 'json',
        async: false,
        success: function (data) {
            json = JSON.stringify(data);
            document.cookie = "Mensajes=" + json;
            $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
        }

    });
    var cookie = document.cookie;
    var mensajes = cookie.split(";")[0];
    var json = mensajes.split("=")[1];
    var string = decodeURIComponent(json);
    var obj = JSON.parse(string);
    var longitud = obj.length;
    if (longitud < 8) {
        $('#next').off('click');
        $('#next').addClass('disabled');
    } else {
        $('#next').on('click', nextIndex);
        $('#next').removeClass('disabled');
    }
}

function borrarTodo() {
    indice = 0;
    opt=2;
    $('#prev').addClass("disabled");
    $('#prev').off('click');
    $.ajax({
        url: '../Source/procesos/loadSearch.php?opt=2',
        dataType: 'json',
        async: false,
        success: function (data) {
            json = JSON.stringify(data);
            document.cookie = "Mensajes=" + json;
            $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
        }
    });
    var cookie = document.cookie;
    var mensajes = cookie.split(";")[0];
    var json = mensajes.split("=")[1];
    var string = decodeURIComponent(json);
    var obj = JSON.parse(string);
    var longitud = obj.length;
    if (longitud < 8) {
        $('#next').off('click');
        $('#next').addClass('disabled');
    } else {
        $('#next').on('click', nextIndex);
        $('#next').removeClass('disabled');
    }
}

function mostrarEnviados() {
    indice = 0;
    box=1;
    opt=3;
    $('#prev').addClass("disabled");
    $('#prev').off('click');
    var but = document.getElementById('bandeja');
    but.firstChild.data = "Bandeja de Entrada";
    $('#bandeja').off('click');
    $('#bandeja').on('click', mostrarRecibidos);
    $('#marcar').off('click');
    $('#vaciar').off('click');
    $('#marcar').addClass("disabled");
    $('#vaciar').addClass("disabled");
    $.ajax({
        url: '../Source/procesos/loadSearch.php?opt=3',
        dataType: 'json',
        async: false,
        success: function (data) {
            json = JSON.stringify(data);
            document.cookie = "Mensajes=" + json;
            $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
        }

    });
    var cookie = document.cookie;
    var mensajes = cookie.split(";")[0];
    var json = mensajes.split("=")[1];
    var string = decodeURIComponent(json);
    var obj = JSON.parse(string);
    var longitud = obj.length;
    if (longitud < 8) {
        $('#next').off('click');
        $('#next').addClass('disabled');
    } else {
        $('#next').on('click', nextIndex);
        $('#next').removeClass('disabled');
    }
}

function mostrarRecibidos() {
    indice = 0;
    box=0;
    opt=4;
    $('#prev').addClass("disabled");
    $('#prev').off('click');
    var but = document.getElementById('bandeja');
    but.firstChild.data = "Mensajes Enviados";
    $('#marcar').on('click',marcarLeido);
    $('#vaciar').on('click',borrarTodo);
    $('#marcar').removeClass("disabled");
    $('#vaciar').removeClass("disabled");
    $('#bandeja').off('click');
    $('#bandeja').on('click', mostrarEnviados)
    $.ajax({
        url: '../Source/procesos/loadSearch.php?opt=4',
        dataType: 'json',
        async: false,
        success: function (data) {
            json = JSON.stringify(data);
            document.cookie = "Mensajes=" + json;
            $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
        }

    });
    var cookie = document.cookie;
    var mensajes = cookie.split(";")[0];
    var json = mensajes.split("=")[1];
    var string = decodeURIComponent(json);
    var obj = JSON.parse(string);
    var longitud = obj.length;
    if (longitud < 8) {
        $('#next').off('click');
        $('#next').addClass('disabled');
    } else {
        $('#next').on('click', nextIndex);
        $('#next').removeClass('disabled');
    }
}

function enter(element, ev) {
    indice = 0;
    opt=0;
    $('#prev').addClass("disabled");
    $('#prev').off('click');
    if (ev.keyCode == 13) {
        var criteria = element.value;
        $.ajax({
            url: '../Source/procesos/loadSearch.php?opt=0&criteria=' + criteria+"&box="+box,
            dataType: 'json',
            async: false,
            success: function (data) {
                json = JSON.stringify(data);
                document.cookie = "Mensajes=" + json;
                $('#tabla').load('../Source/procesos/loadInbox.php?index=' + indice+"&box="+box);
            }

        });
        var cookie = document.cookie;
        var mensajes = cookie.split(";")[0];
        var json = mensajes.split("=")[1];
        var string = decodeURIComponent(json);
        var obj = JSON.parse(string);
        var longitud = obj.length;
        if (longitud < 8) {
            $('#next').off('click');
            $('#next').addClass('disabled');
        } else {
            $('#next').on('click', nextIndex);
            $('#next').removeClass('disabled');
        }
    }
}

function redactar(){
    window.location.href='../Source/mensaje.php?asunto=&idDest=0';
}
function responder(){
    
}