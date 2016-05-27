$(document).ready(function() {
    $("#formId").submit(function(e){
    	e.preventDefault();
         var postData = $(this).serializeArray();
    	$.ajax({
                    url: "procesos/creaGrupoProceso.php"
                    , method: "POST"
                    , data: postData
                    , dataType: "JSON"
                    , success: function (result) {
                    	 for (var x = 0; x < result.length; x++) {
                            if(result[x].success){
                            	 $.redirect('mostrar.php', {'uid': result[x].Id, 'tipo': "grupo"});
                            }else{
                            	Materialize.toast("Error al conectar con el servidor, intente de nuevo", 6000);
                            }
                        }
                    },
                    error: function(res,res2){
                        alert(res2);
                    }
                });

    });
  });