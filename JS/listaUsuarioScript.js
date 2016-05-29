            function sendCall() {
                 $.ajax({
                    url: "procesos/AlgoritmoBusqueda.php"
                    , method: "POST"
                    , data: {
                        nombre: $("[name='nombre']").val(),
                        area: $("[name='area']").val(),
                        tags: $("[name='tag']").val()
                    }
                    , dataType: "JSON"
                    , success: function (result) {
                        var contGrupo = 0;
                        var contPersona = 0;
                        for (var x = 0; x < result.length; x++) {
                            var contGrupo = 0;
                            if(result[x].Tipo == 1){
                                contGrupo++;
                                var seg = "Miembros";
                                if(result[x].seguidores === '1'){
                                    seg = "Miembro";
                                }
                                $("#tabla").append("<tr onClick='sendGrPe("+result[x].Id+",\"grupo\")'><td style='width:20%;'><img src=../IMG/avatar/"+result[x].Nombre[0].toLowerCase()+".png></img></td><td style='width:80%;'>" + result[x].Nombre+"<br><font size='1'>Red de"
                                +" conocimiento: " + result[x].area + " | "+result[x].seguidores+" "+seg+" </font></td></tr>");
                            }else{
                                contPersona++;
                                var seg = "Seguidores";
                                if(result[x].seguidores === '1'){
                                    seg = "Seguidor";
                                }
                                $("#tablaPersona").append("<tr onClick='sendGrPe("+result[x].Id+",\"usuario\")'><td style='width:20%;'><img src=../IMG/avatar/"+result[x].Nombre[0].toLowerCase()+".png></img></td><td style='width:80%;'>" + result[x].Nombre+" lol<br><font size='1'>"
                                +result[x].seguidores+" "+seg+"</font></td></tr>");
                            }
                        }
                        if(contGrupo == 0){
                                $("#tabla").append("No se encontraron resultados");                               
                            }
                            if(contPersona == 0){
                                $("#tablaPersona").append("No se encontraron resultados");
                            }
                    },
                    error: function(res,res2){
                        alert(res2);
                    }
                });
            }

            function sendGrPe(id, tipo){
                    $.redirect('mostrar.php', {'uid': id, 'tipo': tipo});
            }
sendCall();