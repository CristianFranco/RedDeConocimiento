            function sendCall() {
            	                 	alert("hola");

                 $.ajax({
                    url: "procesos/AlgoritmoBusqueda.php"
                    , method: "POST"
                    , data: {
                        nombre: "Programeros",
                        area: "programacion",
                        tags: "android"
                    }
                    , dataType: "JSON"
                    , success: function (result) {
                    	for (var x = 0; x < result.length; x++) {
                            $("#Nombre").append("<tr>" + result[x].Name+"</tr>");
                        }
                        alert("simon");
                    },
                    error: function(res,res2){
                    	alert(res2);
                    }
                });
            }

sendCall();