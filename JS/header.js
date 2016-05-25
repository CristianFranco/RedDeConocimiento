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
    
    $('#dropdown-button-normal').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'left' // Displays dropdown with edge aligned to the left of button
    });

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


    
    $("#buscar").click(function(){
        $.redirect('./resultadosDeBusqueda.php', {'nombre': $("#cajaBuscar").val(),'area': $("#cajaBuscar").val(),'tags': $("#cajaBuscar").val() });
});
