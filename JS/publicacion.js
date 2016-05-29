/*$('a').on("click", function (e) {

    $(this).addClass("selected");
});
$('a').on("blur", function (e) {
    $(this).removeClass("selected");
});*/

$("#pubDescButton").click(function (e) {
    deseleccionar();
    $("#pubDescButton").addClass("selected");
    $("#pubDesc").show();
   
});
$("#pubImgButton").click(function (e) {
    deseleccionar();
    $("#pubImgButton").addClass("selected");
    $("#pubImg").show();
  
});
$("#pubVidButton").click(function (e) {
    deseleccionar();
    $("#pubVidButton").addClass("selected");
    $("#pubVid").show();
 
});
$("#pubDocButton").click(function (e) {
    deseleccionar();
    $("#pubDocButton").addClass("selected");
    $("#pubDoc").show();
   
});
$("#pubComButton").click(function (e) {
    deseleccionar();
    $("#pubComButton").addClass("selected");
    $("#pubCom .swiper-slide").css("width","");
    $("#pubCom").show();
    // $("#pubCom").("w");
    //console.log();
    //$("#pubCom").width($("#pubCom").width())
    //$("#pubCom").width(1000);
  
});
$("#pubAudButton").click(function (e) {
    deseleccionar();
    $("#pubAudButton").addClass("selected");
    $("#pubAud").show();
    

});
function deseleccionar(e) {
    
    $("#pubDescButton").removeClass("selected");
    $("#pubImgButton").removeClass("selected");
    $("#pubVidButton").removeClass("selected");
    $("#pubDocButton").removeClass("selected");
    $("#pubComButton").removeClass("selected");
    $("#pubAudButton").removeClass("selected");
    ocultar();

}
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

    //paginar();
});
$(window).on("ready", function (e) {
// paginar();
    //var desc = getSwiper(".s1");
    // var img = getSwiper(".s2");
    /*var vid = getSwiper("#pubVid");
    var aud = getSwiper("#pubAud");
    var doc = getSwiper("#pubDoc");
    var com = getSwiper("#pubCom");
    
    
*/
    $(".swiper-container").each(function (index, element) {
        var $this = $(this);
        $this.addClass("instance-" + index);
        $this.find(".swiper-button-prev").addClass("btn-prev-" + index);
        $this.find(".swiper-button-next").addClass("btn-next-" + index);
        $this.find(".swiper-pagination").addClass("pagination-" + index);
        var swiper = new Swiper(".instance-" + index, {
            // your settings ...
            pagination: '.pagination-' + index
            , paginationClickable: true
            , nextButton: ".btn-next-" + index
            , prevButton: ".btn-prev-" + index
        });
    });
    /*Ocultar swipers*/
    $("#pubImg").hide();
    $("#pubVid").hide();
    $("#pubAud").hide();
    $("#pubDoc").hide();
    $("#pubCom").hide();

    function getSwiper(id) {
        return new Swiper(id, {
            direction: 'horizontal'
            , loop: false,

            // If we need pagination
            pagination: '.swiper-pagination',

            // Navigation arrows
            nextButton: '.swiper-button-next'
            , prevButton: '.swiper-button-prev',

            // And if we need scrollbar
            scrollbar: '.swiper-scrollbar'
        , });
    }
});




$("#mobilePubButton").sideNav();

function ocultar() {
    $("#pubDesc").hide();
    $("#pubImg").hide();
    $("#pubVid").hide();
    $("#pubAud").hide();
    $("#pubDoc").hide();
    $("#pubCom").hide();
}

//initialize swiper when document ready  




/*$(window).resize(function () {
    alert("resize");
});*/