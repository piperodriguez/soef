$(document).ready(function(){
	/*$(".insertAuto").click(function(){
		alert("si llego al arachivo");
	});*/
	listadoServicios();
	$(".insertServicio").on("click", function() {
		
		$.ajax({

			type: "get",
			url: "func/htmlInsert.php",
			success: function(result) {
				$(".formularios").empty().html(result);
			}

		});

	});
});
$(document).on("click", ".crudInsertServicio", function(){

	var nombre = $("#nombre").val();


	$.ajax({

		type: "post",
		url: "func/crudInsert.php",
		data: {
			nombre: nombre,
			
		},
		success: function() {
			$(".formularios").empty();
			listadoServicios();
		}
	});

});
$(document).on("click", ".updateServicio", function() {

	var idServicio = $(this).attr("id");

	$.ajax({

		type: "get",
		url: "func/htmlUpdate.php",
		data: {
			idServicio: idServicio
		},
		success: function(result){
			$(".formularios").empty().html(result);
		}
	

	});
});
$(document).on("click", ".crudUpdatServicio", function(){

	var idServicio = $(this).attr("id");
	var nombre = $("#nombre").val();


	$.ajax({

		type: "post",
		url: "func/crudUpdate.php",
		data: {
			idServicio: idServicio,
			nombre: nombre,

		},
		success: function(){
			$(".formularios").empty();
			listadoServicios();
		}
	});

});
function listadoServicios(){

	$.ajax({
		type: "get",
		url: "func/listaServicios.php",
		success: function(result){
			$(".contenido").empty().html(result);
		} 
	});
}