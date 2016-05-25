var strEstilo;
var estilos = {};
//#1565C0
estilos['Default'] = {
    bcFondo: "white"
    , bcPrincipal: "#1565C0"
    , bcSecundario: "#e3e3e3"
    , tcPrincipal: "white"
    , tcSecundario: "#black"
    , fuente: "arial"
    , tamFuente: "100%"
};
estilos['Negro'] = {
    bcFondo: "gray"
    , bcPrincipal: "black"
    , tcPrincipal: "white"
    , bcSecundario: "white"
    , tcSecundario: "black"
    , fuente: "arial"
    , tamFuente: "100%"
};
crearEstilo();

function crearEstilo() {
    if (idEstilo != 0) {
        estilos['Personalizado'] = {
            bcFondo: localStorage.getItem("fondo")
            , bcPrincipal: localStorage.getItem("bcPrincipal")
            , tcPrincipal: localStorage.getItem("tcPrincipal")
            , bcSecundario: localStorage.getItem("bcSecundario")
            , tcSecundario: localStorage.getItem("tcSecundario")
            , fuente: localStorage.getItem("fuente")
            , tamFuente: localStorage.getItem("tamFuente")
        };
        var estilo = localStorage.getItem(idEstilo);
        if (estilo == "Personalizado") {
            cargarDefault("Personalizado");
        } else {
            if (estilo == "" || estilo == null) {
                cargarDefault("Default");

            } else {
                cargarDefault(estilo);
            }
        }
        //Si es un usuario

    } else { //cargar tema por default
        cargarDefault('Default');
    }
}

function cargarDefault(tipo) {
    strEstilo = '<style type="text/css">' + /************principal************/
        '.principal,nav ul li a div,button,.container pinput[type="submit"].btn' +
        ',.principal .dropdown-content li>a,.container .dropdown-content li>span{' +
        'background-color:' + estilos[tipo].bcPrincipal + '!important;' +
        'color:' + estilos[tipo].tcPrincipal + '!important;' +
        '}' + /******principal hover******/
        'nav.principal ul a:hover,nav.principal ul a.selected{' +
        'background-color:' + estilos[tipo].tcPrincipal + '!important;' +
        'color:' + estilos[tipo].bcPrincipal + '!important;' +
        'opacity:1;' +
        '}' +
        'body{' +
        'background-color:' + estilos[tipo].bcFondo + '!important;' +
        '}' +
        '.secundario{' +
        'background-color:' + estilos[tipo].bcSecundario + '!important;' +
        'color:' + estilos[tipo].tcSecundario + '!important;' +
        '}' +
        'input[type="checkbox"]:checked+label:before' +
        '' +
        '{' +
        'border-right:3px solid ' + estilos[tipo].bcPrincipal + '!important;' +
        'border-bottom:3px solid ' + estilos[tipo].bcPrincipal + '!important;' +
        '}' + /************************/
        '.principal .input-field .prefix.active{' +
        'color:red;' +
        '}' + /************************/
        '.principal .dropdown-content li>a:hover,.secundario nav ul a:hover,.container .dropdown-content li>span:hover{' +
        'opacity:0.8;' +
        '}' +
        '*{' +
        'font-family:' + estilos[tipo].fuente + ';' +
        'font-size:' + estilos[tipo].tamFuente + ';' +
        '}' +

        '</style>';
    $(document.head).prepend($(strEstilo));
}