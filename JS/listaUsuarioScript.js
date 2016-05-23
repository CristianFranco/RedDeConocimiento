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
                    	for (var x = 0; x < result.length; x++) {
                            if(result[x].Tipo === 1){
                                $("#tabla").append("<tr onClick='sendGrPe("+result[x].Id+",1)'><td>" + result[x].Nombre+"<br><font size='1'>Red de"
                                +" conocimiento: programación | 14 Miembros </font></td></tr>");
                            }else{
                                tablaPersona
                                $("#tablaPersona").append("<tr onClick='sendGrPe("+result[x].Id+",2)'><td>" + result[x].Nombre+" lol<br><font size='1'>Red de"
                                +"14 seguidores </font></td></tr>");
                            }
                        }
                    },
                    error: function(res,res2){
                    	alert(res2);
                    }
                });
            }

            function sendGrPe(id, tipo){
                    $.redirect('demo.php', {'uid ': id, 'tipo': tipo});
            }
sendCall();