var strEstilo;
var estilos = {};
//#1565C0
estilos['default'] = {
    bcFondo: "white"
    , bcPrincipal: "#1565C0"
    , bcSecundario: "#e3e3e3"
    , tcPrincipal: "white"
    , tcSecundario: "#black"
    , fuente: "arial"
    , tamFuente: ""
};
estilos['negro'] = {
    bcFondo: "gray"
    , bcPrincipal: "black"
    , tcPrincipal: "white"
    , bcSecundario: "white"
    , tcSecundario: "black"
    , fuente: "arial"
    , tamFuente: ""
};
crearEstilo();

function crearEstilo() {
    if (estado) {
        cargarDefault('negro');
        //Si es un usuario

    } else { //cargar tema por default
        cargarDefault('negro');
    }
}

function cargarDefault(tipo) {
    strEstilo = '<style type="text/css">' + /************************/
        '.principal,nav ul li a div,button,.container pinput[type="submit"].btn,a.btn,a.btn:hover' +
        ',.principal .dropdown-content li>a,.container .dropdown-content li>span{' +
        'background-color:' + estilos[tipo].bcPrincipal + ';' +
        'color:' + estilos[tipo].tcPrincipal + ';' +
        '}' +
        'nav.principal ul a:hover,nav.principal ul a.selected{' +
        'background-color:' + estilos[tipo].tcPrincipal + ';' +
        'color:' + estilos[tipo].bcPrincipal + ';' +
        'opacity:1;' +
        '}' +
        'body{' +
        'background-color:' + estilos[tipo].bcFondo + ';' +
        '}' +
        '.secundario{' +
        'background-color:' + estilos[tipo].bcSecundario + ';' +
        'color:' + estilos[tipo].tcSecundario + ';' +
        '}' +
        'input[type="checkbox"]:checked+label:before' +
        '' +
        '{' +
        'border-right:3px solid ' + estilos[tipo].bcPrincipal + ';' +
        'border-bottom:3px solid ' + estilos[tipo].bcPrincipal + ';' +
        '}' + /************************/
        '.principal .input-field .prefix.active{' +
        'color:red;' +
        '}' + /************************/
        '.principal .dropdown-content li>a:hover,.secundario nav ul a:hover,.container .dropdown-content li>span:hover{' +
        'opacity:0.8;' +
        '}' +
        '</style>';
    $(document.head).prepend($(strEstilo));
}