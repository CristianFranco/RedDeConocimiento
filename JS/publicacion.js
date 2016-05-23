$('a').on("click", function (e) {

    $(this).addClass("selected");
});
$('a').on("blur", function (e) {
    $(this).removeClass("selected");
});
var actual = 1;
var paginas = 0;
var acp = 0;

function paginar(e) {
    $ancho = $(window).width();
    if ($ancho >= 1200) {
        acp = 850;
    } else {
        if ($ancho >= 992 && $ancho < 1200) {
            acp = 650;
        } else {
            if ($ancho >= 768 && $ancho < 992) {
                acp = 450;
            } else {
                if ($ancho >= 480 && $ancho < 768) {
                    acp = 250;
                } else { //menor a 480
                    acp = 250;
                }
            }
        }

    }
    $texto = $("#pubDesc p");
    $texto.text("");
    for (var x = 0; x < palabras.length && x < acp; x++) {
        $texto.append(palabras[x] + " ");
    }
    paginas = Math.ceil(palabras.length / acp);
    console.log("paginas:" + paginas);

}

function cargar(e) {
    $texto = $("#pubDesc p");
    $texto.text("");
    if (actual > paginas) {
        actual = 1;
    }
    if (actual < 1) {
        actual = paginas;
    }
    for (var x = (actual - 1) * acp; x < palabras.length && x < (actual * acp); x++) {
        $texto.append(palabras[x] + " ");
    }
}
$(window).resize(function () {

    paginar();
});
$(window).on("load", function (e) {
    paginar();
});

$("#pubDesc p").on("swiperight", function (e) {
    actual--;
    cargar();
});
$("#pubDesc p").on("swipeleft", function (e) {
    actual++;
    cargar();
});

$.mobile.loading("hide");
// (or presumably as submitted by @Pnct)
$.mobile.loading().hide();
$("#mobilePubButton").sideNav();

function ocultar() {
    $("#pubDesc").hide();
    $("#pubImg").hide();
    $("#pubVid").hide();
    $("#pubAud").hide();
    $("#pubDoc").hide();
    $("#pubCom").hide();
}
$("#pubDescButton").click(function (e) {
    ocultar();
    $("#pubDesc").show();
});
$("#pubImgButton").click(function (e) {
    ocultar();
    $("#pubImg").show();
});
$("#pubVidButton").click(function (e) {
    ocultar();
    $("#pubVid").show();
});
$("#pubAudButton").click(function (e) {
    ocultar();
    $("#pubAud").show();
});
$("#pubDocButton").click(function (e) {
    ocultar();
    $("#pubDoc").show();
});
$("#pubComButton").click(function (e) {
    ocultar();
    $("#pubCom").show();
});




/*$(window).resize(function () {
    alert("resize");
});*/