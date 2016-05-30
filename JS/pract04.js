 archivos1 = []; //arreglo de archivos a subir  
 longitud = 0;
 imagenes = [];
 archivoserroneos = '';
 documentos = '';
 tags = '';
 conetiquetas = 1;
 indicestag = [];
 etiquetas = [];
 iddesc = [];

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
     etiquetas = []
     for (i = 0; i < conetiquetas; i++) {
         //alert(etiqueta + conetiquetas);
         etiquetas.push(document.getElementById(etiqueta + i).value);
     }
     document.getElementById('tags').innerHTML +=
         '<div class="input-field col s4 offset-s3">' +
         '<input id=' + etiqueta + conetiquetas + ' type="text">' +
         '<label for="icon-prefix">' + 'Tag' + '</label>' + '</div>' +
         '</div>';
     conetiquetas++;
     for (i = 0; i < etiquetas.length; i++)
         document.getElementById(etiqueta + i).value = etiquetas[i];

 }


 function enviar() {

     if (validarformulario()) {

         // alert('entre a enviar');

         var desc = 'descripcion';
         var datos = new FormData();
         //datos.append('titulo',' hola');
         var archivo = new File([""], "filename.txt");
         datos.append('archivo', archivo);
         datos.append('titulo', document.getElementById('titulo').value);
         datos.append('descripcion', document.getElementById('comment').value);
         datos.append('numero', 777);
         var url = "procesos/subir.php";
         var solicitud = new XMLHttpRequest();
         solicitud.open("POST", url, true);
         solicitud.send(datos);
         console.log('elementos enviados');
         console.log('archivos: ' + archivos1.length);
         //alert(archivos1.length);

         documentos = ' ';
         console.log('archivos: ' + archivos1.length);

         //alert(iddesc.length);
         for (i = 0; i < archivos1.length; i++) {
             // alert('archivos.length: ' + archivos1.length);
             if (encontrareliminados()) {
                 console.log(archivos1.length);
                 //console.log(archivos1[0].name);
                 //alert('entre a form data');
                 // alert('archivos[i]: ' + archivos1[i].name);
                 var archivo = archivos1[i];

                 var datos = new FormData();

                 datos.append('archivo', archivo);
                 // alert('archivo: ' + archivo.name);

                 if (document.getElementById(des + i).value != '' || document.getElementById(des + i) != undefined) {
                     datos.append('descripcion', document.getElementById(des + i).value);
                 } else {
                     var etiquetasn = document.getElementsByName(desc + archivo.name);

                     for (var k = 0; k < etiquetasn.length; k++) {
                         alert(etiquetasn[k].value);
                         datos.append('descripcion', etiquetasn[k].value);
                         break;
                     }
                 }


                 // datos.append('descripcion', document.getElementById(desc + i).value);

                 documentos += archivo.name + '<br>';
                 datos.append('numero', i);
                 datos.append('tipo', tiposarchivos[i]);
                 var url = "procesos/subir.php";
                 var solicitud = new XMLHttpRequest();
                 solicitud.open("POST", url, true);
                 solicitud.send(datos);
                 // alert('archivos.length1: ' + archivos1.length);

             }
             // alert(archivo.name);
         }
         enviaretiquetas();
         var texto = 'Titulo: ' + document.getElementById('titulo').value + '<br>' +
             'Descripcion: ' + document.getElementById('comment').value + '<br>' + 'Archivos: <br>' + documentos + '<br>' + 'Tags: ' + tags;

         document.getElementById('textopublicacion').innerHTML = texto;
         $('#modal2').openModal();
     } else {
         //alert('entre a validar formulario enviar');
         var texto1 = 'Para realizar una publicacion al menos debe tener: Titulo y Descripcion';
         console.log(texto1);
         document.getElementById('textomodal').innerHTML = texto1;
         $('#modal1').openModal();
         alert(texto1);
     }

     //alert(publicacion.titulo);
 }

 function recargar() {
     location.reload();

 }

 function validarformulario() {
     if (document.getElementById('titulo').value == '' || document.getElementById('comment').value == '' || document.getElementById('titulo').value == null || document.getElementById('comment').value == null) {

         return false;
     }
     return true;
 }

 function enviaretiquetas() {
     tags = '';
     for (i = 0; i < conetiquetas; i++) {
         var etiqueta = 'etiqueta';
         //alert(document.getElementById(etiqueta + i).value);
         console.log(archivos1.length);
         var archivo = new File([""], "filename.txt");
         var datos = new FormData();
         datos.append('archivo', archivo);
         datos.append('etiqueta', document.getElementById(etiqueta + i).value);
         tags += document.getElementById(etiqueta + i).value + '<br>';

         var url = "procesos/subir.php";
         var solicitud = new XMLHttpRequest();
         solicitud.open("POST", url, true);
         if (document.getElementById(etiqueta + i).value != '' || document.getElementById(etiqueta + i).value != null)
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
     console.log(archivo.name);
     console.log(archivo.type);

     if (archivo.name.search('ppt') != -1) {
         imagenes.push('ppt');
         return;

     }
     if (archivo.name.search('docx') != -1) {
         imagenes.push('word');
         return;

     }
     if (archivo.type.search('plain') != -1) {
         imagenes.push('plain');
         return;
     }
     if (archivo.name.search('pdf') != -1) {
         imagenes.push('pdf');
         return;
     }
     if (archivo.name.search('.rar') != -1) {
         imagenes.push('rar');
         return;
     }
     if (archivo.name.search('.sql') != -1) {
         imagenes.push('sql');
         return;
     }
     if (archivo.type.search('.zip') != -1) {
         imagenes.push('zip');
         return;
     } else {
         imagenes.push('expediente');
         return;
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

         if (archivoserroneos != '') {
             // alert(archivoserroneos + archivosvalidos)

             document.getElementById('textomodal').innerHTML = 'Los siguientes archivos no concuerdan con el tipo seleccionado' + '<br>' + archivoserroneos + '<br>' + archivosvalidos;
             $('#modal1').openModal();
         }
         console.log('longitud archivos: ' + archivos1.length + " longitud: " + longitud);
         administrararchivos();
         longitud = archivos1.length;
         mostrararchivos();
     } else {
         document.getElementById('textomodal').innerHTML = 'debe selecionar el tipo de archivos a subir' + '<br>' + 'Archivos' + '<br>' + 'Imagenes' + '<br>' + 'Videos' + '<br>' + 'Audio';
         $('#modal1').openModal();
         //alert('debe selecionar el tipo de archivo a subir');
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
                 '<textarea class="materialize-textarea" id="' + des + i + '" name="' + des + archivos1[i].name + '">' + '</textarea>' +
                 '<label for="textarea1">' + 'Descripcion del archivo' + '</label>' +
                 '</div>' + '</div>';
             iddesc.push(des + archivos1[i].name);

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
                 '<div class="col s2">' + '<img src=../IMG/iconos/' + imagenes[i] + '.png width=80 heigth=100>' + '</div>' + '<div class= "col s8">' +
                 archivos1[i].name + '</div>' +
                 '<div class ="col s2">' +
                 '<button type="button" class="waves-effect waves-light btn red darken-4" name=' + archivos1[i].name + ' id=' + i + '  onclick="eliminararchivos(this)">' + '<span class="glyphicon glyphicon-remove">' + '</span>' +
                 '</button>' + '</span>' + '</div>' +
                 '</div>';

             var etiq = document.getElementById(des + i);
             // alert(des + archivos1[i].name);
             // console.log(des + archivos1[i].name);
             alert(etiq.length);


             if (etiq.value != '' || etiq.value != undefined) {
                 marchivos.innerHTML += '<div class="row">' + '<div class="input-field col s12">' +
                     '<textarea class="materialize-textarea" name="' + des + archivos1[i].name + '">' + etiq.value + '</textarea>' +
                     '<label for="textarea1">' + 'Descripcion del archivo' + '</label>' +
                     '</div>' + '</div>';
             } else {
                 marchivos.innerHTML += '<div class="row">' + '<div class="input-field col s12">' +
                     '<textarea class="materialize-textarea" name="' + des + archivos1[i].name + '">' + '</textarea>' +
                     '<label for="textarea1">' + 'Descripcion del archivo' + '</label>' +
                     '</div>' + '</div>';
             }
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
         document.getElementById('textomodal').innerHTML = 'debe selecionar el tipo de archivos a subir' + '<br>' + 'Archivos' + '<br>' + 'Imagenes' + '<br>' + 'Videos' + '<br>' + 'Audio';
         $('#modal1').openModal();

     }

 }


 window.addEventListener('load', iniciar, false);