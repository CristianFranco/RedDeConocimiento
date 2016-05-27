 archivos1 = []; //arreglo de archivos a subir  
 longitud = 0;
 imagenes = [];
 archivoserroneos = '';
 conetiquetas = 1;

 function iniciar() {

     var archivosaux;
     var nombre = '';
     indices = [];
     tiposarchivos = [];
     band = false;
     tipoarchivo = '';
     archivosvalidos = '';
     cajadatos = document.getElementById('cajadatos');
     publicar = document.getElementById('publicar');
     var archivos = document.getElementById('archivos');
     archivos.addEventListener('dragenter', dragenter, false);
     archivos.addEventListener('dragexit', dragExit, false);
     archivos.addEventListener('dragover', dragover, false);
     archivos.addEventListener('drop', subir, false);
     publicar.addEventListener('click', enviar, false);
     var archivostarget = document.getElementById('archivos1');
     archivostarget.addEventListener('change', subirtarget, false);


 }

 function dragExit(evt) {
     evt.stopPropagation();
     evt.preventDefault();
     //alert('entre a dragexit');
 }

 function dragenter(e) {
     e.stopPropagation();
     e.preventDefault();
     // alert('entre a dragenter');
 }

 function dragover(e) {
     e.stopPropagation();
     e.preventDefault();
     //alert('entre a dragover');
 }

 function agregartag() {
     var etiqueta = 'etiqueta';
     var etiquetas = []
     for (i = 0; i < conetiquetas; i++) {
         //alert(etiqueta + conetiquetas);
         etiquetas.push(document.getElementById(etiqueta + i).value);
     }
     document.getElementById('tags').innerHTML +=
         '<div class="input-field col s4 offset-s3">' +
         '<input id=' + etiqueta + conetiquetas + ' type="text">' +
         '<label for="icon-prefix">' + 'Tag' + '</label>' + '</div>' +
         '<div class="col s4">' +
         '<button type="button" class="waves-effect waves-light btn red darken-4" id=' + conetiquetas + '  onclick="eliminartags(this)">' + '<span class="glyphicon glyphicon-remove">' + '</span>' +
         '</button>' + '</span>' +
         '</div>';
     conetiquetas++;
     for (i = 0; i < etiquetas.length; i++)
         document.getElementById(etiqueta + i).value = etiquetas[i];

 }

 function enviar() {

     var desc = 'descripcion';

     var datos = new FormData();
     //datos.append('titulo',' hola');
     var archivo = new File([""], "filename.txt");
     datos.append('archivo', archivo);
     datos.append('titulo', document.getElementById('titulo').value);
     datos.append('descripcion', document.getElementById('comment').value);
     datos.append('numero', 777);
     var url = "subir.php";
     var solicitud = new XMLHttpRequest();
     solicitud.open("POST", url, true);
     solicitud.send(datos);
     console.log('elementos enviados');

     for (i = 0; i < archivos1.length; i++) {
         if (encontrareliminados()) {
             console.log(archivos1.length);
             var archivo = archivos1[i];
             var datos = new FormData();
             datos.append('archivo', archivo);
             datos.append('descripcion', document.getElementById(desc + i).value);

             datos.append('numero', i);
             datos.append('tipo', tiposarchivos[i]);
             var url = "subir.php";
             var solicitud = new XMLHttpRequest();
             solicitud.open("POST", url, true);
             solicitud.send(datos);
             // alert(archivo.name);
         }
     }
     enviaretiquetas();

     //alert(publicacion.titulo);
 }

 function enviaretiquetas() {
     for (i = 0; i < conetiquetas; i++) {

         var etiqueta = 'etiqueta';
         alert(document.getElementById(etiqueta + i).value);
         console.log(archivos1.length);
         var archivo = new File([""], "filename.txt");
         var datos = new FormData();
         datos.append('archivo', archivo);
         datos.append('etiqueta', document.getElementById(etiqueta + i).value);

         var url = "subir.php";
         var solicitud = new XMLHttpRequest();
         solicitud.open("POST", url, true);
         solicitud.send(datos);
         // alert(archivo.name);
     }

 }

 function cambiarcolorbotones(botoncambiar, boton1, boton2, boton3) {
     document.getElementById(botoncambiar).className = "waves-effect waves-light btn  light-blue darken-1";
     document.getElementById(boton1).className = "waves-effect waves-light btn";
     document.getElementById(boton2).className = "waves-effect waves-light btn";
     document.getElementById(boton3).className = "waves-effect waves-light btn";
 }

 function cambiararchivo() {
     //alert('entre a archivo');
     tipoarchivo = 'archivo';
     archivosvalidos = 'solo se admiten archivos con extension de office, txt, pdf, rar, sql, zip';
     // document.getElementById('barchivos').className = "waves-effect waves-light btn blue accent-3";
     cambiarcolorbotones('barchivos', 'bimagenes', 'bvideo', 'baudio');
     mostrararchivos1();
 }

 function cambiarimagen() {
     //alert('entre a imagen');
     tipoarchivo = 'imagen';
     archivosvalidos = 'solo se admiten archivos de jpg, png, gif';
     cambiarcolorbotones('bimagenes', 'barchivos', 'bvideo', 'baudio');
     mostrararchivos1();
 }

 function cambiarvideo() {
     tipoarchivo = 'video';
     archivosvalidos = 'solo se admiten archivos de mp4, wmv, mkv,avi';
     cambiarcolorbotones('bvideo', 'bimagenes', 'barchivos', 'baudio');
     mostrararchivos1();
 }

 function cambiaraudio() {
     tipoarchivo = 'audio';
     archivosvalidos = 'solo se admiten archivos audio';
     cambiarcolorbotones('baudio', 'bimagenes', 'bvideo', 'barchivos');
     mostrararchivos1();
 }

 function validartipo(archivo) {
     //alert(archivo.type + "," + tipoarchivo);
     //alert(archivo.name);
     //imagenarchivo(archivo);
     if (tipoarchivo == 'archivo') {
         if (archivo.type.search('officedocument') != -1 || archivo.type.search('powerpoint') != -1 || archivo.type.search('plain') != -1 || archivo.type.search('pdf') != -1 || archivo.name.search('.rar') != -1 || archivo.name.search('.sql') != -1 || archivo.type.search('.zip') != -1) {
             //alert('entre a si archivos ' + archivos1[i].type + archivos1[i].name);
             imagenarchivo(archivo);
             return true;
         } else
             return false;
     }
     if (tipoarchivo == 'imagen') { //imagenes
         //alert('entre a validarimagenes');
         if (archivo.type == 'image/jpeg' || archivo.type == 'image/png' || archivo.type == 'image/gif') {
             imagen = archivo.type.split('/');
             imagenes.push(imagen[1]);
             return true;
         } else {
             return false;
         }
     }

     if (tipoarchivo == 'video') {
         //alert('entre a validarvideos');
         if (archivo.type == 'video/mp4' || archivo.type == 'video/wmv' || archivo.type == 'video/avi' || archivo.type == 'video/matroska') {
             imagen = archivo.type.split('/');
             imagenes.push(imagen[1]);
             return true; //videos

         } else
             return false;
     }
     if (tipoarchivo == 'audio') {
         //alert('entre a validarvideos');
         if (archivo.type == 'audio/mp3') {
             imagen = archivo.type.split('/');
             imagenes.push(imagen[1]);
             return true; //videos

         } else
             return false;
     }
 }


 function imagenarchivo(archivo) {

     if (archivo.type.search('powerpoint') != -1) {
         imagenes.push('ppt');

     }
     if (archivo.type.search('word') != -1) {
         imagenes.push('word');

     }
     if (archivo.type.search('plain') != -1) {
         imagenes.push('plain');
     }
     if (archivo.type.search('pdf') != -1) {
         imagenes.push('pdf');
     }
     if (archivo.name.search('.rar') != -1) {
         imagenes.push('rar');
     }
     if (archivo.name.search('.sql') != -1) {
         imagenes.push('sql');
     }
     if (archivo.type.search('.zip') != -1) {
         imagenes.push('zip');
     }
 }

 function subir(e) {
     if (tipoarchivo != '') {
         e.stopPropagation();
         e.preventDefault();
         archivosaux = e.dataTransfer.files;
         archivoserroneos = '';
         for (i = 0; i < archivosaux.length; i++)
             if (validartipo(archivosaux[i]))
                 archivos1[i + longitud] = archivosaux[i];
             else {
                 //alert(archivosvalidos);
                 archivoserroneos += archivosaux[i].name + '\n';
             }

         if (archivoserroneos != '')
             alert(archivoserroneos + archivosvalidos)
         console.log('longitud archivos: ' + archivos1.length + " longitud: " + longitud);
         administrararchivos();
         longitud = archivos1.length;
         mostrararchivos();
     } else {
         alert('debe selecionar el tipo de archivo a subir');
     }


 }

 function administrararchivos() {
     for (i = 0; i < archivos1.length - longitud; i++) {
         //console.log('entre a adimistrar archivos');
         tiposarchivos.push(tipoarchivo);

     }
     for (i = 0; i < tiposarchivos.length; i++)
         console.log('tipoarchivo: ' + tiposarchivos[i]);
     console.log('longitud tipo de archivos: ' + tiposarchivos.length);
 }

 function encontrareliminados() {
     if (indices.length <= 0)
         return true;
     /*for (var j = 0; j < indices.length; j++) {
         if (i == indices[j]) {
             return false;
         }
     }*/
     for (var j = 0; j < indices.length; j++) {
         if (archivos1[i].name == indices[j]) {
             return false;
         }
     }
     return true;
 }

 function mostrararchivos() {
     //alert(archivos1.length);
     band = true;
     document.getElementById('divmarchivos').style.display = 'block';
     marchivos = document.getElementById('marchivos');
     marchivos.innerHTML = '<div class="col s10 offset-s2 teal accent-2" id="marchivos">' +
         '</div>';
     marchivos.innerHTML +=
         '<div class="row">' + '<div class="col 12">'

     for (i = 0; i < archivos1.length; i++) {
         console.log(i + ' nombre del archivo: ' + archivos1[i].name);
         var des = 'descripcion';
         if (encontrareliminados() && tiposarchivos[i] == tipoarchivo) {
             marchivos.innerHTML += '<div class="row">' +
                 '<div class="col s2">' + '<img src=../IMG/iconos/' + imagenes[i] + '.png width=80 heigth=100>' + '</div>' + '<div class= "col s8">' +
                 archivos1[i].name + '</div>' +
                 '<div class ="col s2">' +
                 '<button type="button" class="waves-effect waves-light btn red darken-4" name=' + archivos1[i].name + ' id=' + i + '  onclick="eliminararchivos(this)">' + '<span class="glyphicon glyphicon-remove">' + '</span>' +
                 '</button>' + '</span>' + '</div>' +
                 '</div>';
             marchivos.innerHTML += '<div class="row">' + '<div class="input-field col s12">' +
                 '<textarea id="' +
                 des + i + '"  class="materialize-textarea">' + '</textarea>' +
                 '<label for="textarea1">' + 'Descripcion del archivo' + '</label>' +
                 '</div>' + '</div>';

         }
     }
     marchivos.innerHTML += "</div>" + '</div>';

 }

 function mostrararchivos1() {

     document.getElementById('divmarchivos').style.display = 'block';
     marchivos = document.getElementById('marchivos');
     marchivos.innerHTML = '<div class="col s10 offset-s2 teal accent-2" id="marchivos">' +
         '</div>';
     marchivos.innerHTML +=
         '<div class="row">' + '<div class="col 12">'

     for (i = 0; i < archivos1.length; i++) {
         console.log(i + ' nombre del archivo: ' + archivos1[i].name);
         var des = 'descripcion';
         if (encontrareliminados() && tiposarchivos[i] == tipoarchivo) {
             marchivos.innerHTML += '<div class="row">' +
                 '<div class="col s2">' + '<img src=iconos/iconojpg.svg width=80 heigth=100>' + '</div>' + '<div class= "col s8">' +
                 archivos1[i].name + '</div>' +
                 '<div class ="col s2">' +
                 '<button type="button" class="waves-effect waves-light btn red darken-4" name=' + archivos1[i].name + ' id=' + i + '  onclick="eliminararchivos(this)">' + '<span class="glyphicon glyphicon-remove">' + '</span>' +
                 '</button>' + '</span>' + '</div>' +
                 '</div>';
             marchivos.innerHTML += '<div class="row">' + '<div class="input-field col s12">' +
                 '<textarea id=' +
                 des + i + '  class="materialize-textarea">' + '</textarea>' +
                 '<label for="textarea1">' + 'Descripcion del archivo' + '</label>' +
                 '</div>' + '</div>';
         }

     }
     marchivos.innerHTML += "</div>" + '</div>';



 }

 function eliminararchivos(elemento) {
     //archivosaux = document.getElementsByName('archivosel');
     // alert(elemento.id);
     //indices.push(elemento.id);
     indices.push(elemento.name);
     //alert(indices.length);
     marchivos.innerHTML = '<div class="col s8 offset-s2 teal accent-2" id="marchivos">' +
         '</div>';
     mostrararchivos1();

 }

 function subirtarget(e) {
     //archivos1 = e.target.files;
     if (tipoarchivo != '') {
         archivosaux = e.target.files;
         for (i = 0; i < archivosaux.length; i++)
             if (validartipo(archivosaux[i]))
                 archivos1[i + longitud] = archivosaux[i];
             else
                 alert(archivosvalidos);

         console.log('longitud archivos: ' + archivos1.length + " longitud: " + longitud);
         administrararchivos();
         longitud = archivos1.length;
         mostrararchivos();
     } else {
         alert('debe selecionar el tipo de archivo a subir');

     }

 }


 window.addEventListener('load', iniciar, false);