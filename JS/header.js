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
$("#formLogin").on("submit", function (e) {
    e.preventDefault();
    $("#loginMsn").hide();
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
                $("#loginMsn").show();
                //window.location = "index.php";
            }
        }
    });
});
$("#loginBoton").on("click", function (e) {
    $("#loginMsn").hide();
});
$("#mobileButton").sideNav();