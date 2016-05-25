/*$(".bgPrincipal").css({
    "background-color": "blue"
});*/




function mostrarPreferencias() {
    var estiloSel = localStorage.getItem(idEstilo);
    if (estiloSel != "") {
        $("#selectEstilo").val(estiloSel);
    } else {
        $("#selectEstilo").val("Default");
    }
    if ($("#selectEstilo").val() == "Personalizado") {
        $("#tablaEstilos").show();
    } else {
        $("#tablaEstilos").hide();
    }
    $("#colorFondo").val(localStorage.getItem("fondo"));
    $("#colorPrincipal").val(localStorage.getItem("bcPrincipal"));
    $("#colorSecundario").val(localStorage.getItem("bcSecundario"));
    $("#textoPrincipal").val(localStorage.getItem("tcPrincipal"));
    $("#textoSecundario").val(localStorage.getItem("tcSecundario"));
    $("#fuente").val(localStorage.getItem("fuente"));
    $("#tamañoFuente").val(localStorage.getItem("tamFuente"));
}
mostrarPreferencias();

/*Guardando estilo*/
$("#guardarEstilo").click(function (e) {
    localStorage.setItem(idEstilo, $("#selectEstilo").val());
    localStorage.setItem("fondo", $("#colorFondo").val());
    localStorage.setItem("bcPrincipal", $("#colorPrincipal").val());
    localStorage.setItem("bcSecundario", $("#colorSecundario").val());
    localStorage.setItem("tcPrincipal", $("#textoPrincipal").val());
    localStorage.setItem("tcSecundario", $("#textoSecundario").val());
    localStorage.setItem("fuente", $("#fuente").val());
    localStorage.setItem("tamFuente", $("#tamañoFuente").val());
    window.location = "personalizar.php";
});

$("#selectEstilo").change(function () {
    if ($("#selectEstilo").val() == "Personalizado") {
        $("#tablaEstilos").show();
    } else {
        $("#tablaEstilos").hide();
    }
});