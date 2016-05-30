$("#cajaBuscar").focus(function (e) {
    console.log("hola");
    $("#busquedaA").attr('style', 'display:block');
    $("#busquedaA").attr('style', 'position:absolute');
});
$("#cajaBuscar").focusout(function (e) {
    console.log("hola");
    $("#busquedaA").attr('style', 'display:none');

});
$('.modal-trigger').leanModal();

// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered



$("#formLogin").on("submit", function (e) {
    e.preventDefault();
    $("#loginMsn").css("visibility","hidden");
    $.ajax({
        url: "procesos/checklogin.php"
        , method: "POST"
        , data: {
            usuario: $("#usuario").val()
            , pass: $("#pass").val()
        }
        , dataType: "JSON"
        , success: function (result) {
            if (result.estado) {
                window.location = "index.php";
            } else {
                $("#loginMsn").text(result.msn);
                $("#loginMsn").css("visibility","visible");
                //window.location = "index.php";
            }
        }
    });
});

$("#loginBoton").on("click", function (e) {
    $("#loginMsn").hide();
});
$("#mobileButton").sideNav();

 $("#buscar").click(function(){
        $.redirect('./resultadosDeBusqueda.php', {'nombre': $("#cajaBuscar").val(),'area': $("#cajaBuscar").val(),'tags': $("#cajaBuscar").val() });
    });

$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });