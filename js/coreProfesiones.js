$(document).ready(function(){
	
	listadoProfesiones();

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

$(document).on("click", ".crudInsertProfesion", function(){

	var id_servicio = $("#id_servicio").val();
	var nombre = $("#nombre").val();


	$.ajax({

		type: "post",
		url: "func/crudInsert.php",
		data: {
			id_servicio: id_servicio,
			nombre: nombre,
			
		},
		success: function() {
			$(".formularios").empty();
			listadoProfesiones();
		}
	});

});

$(document).on("click", ".updateprofesion", function() {

	var idProfesion = $(this).attr("id");

	$.ajax({

		type: "get",
		url: "func/htmlUpdate.php",
		data: {
			idProfesion: idProfesion
		},
		success: function(result){
			$(".formularios").empty().html(result);
		}
	

	});

});

$(document).on("click", ".crudUpdateProfesion", function(){

	var idProfesion = $(this).attr("id");
	var nombre = $("#nombre").val();
	var servicio = $("#servicio").val();


	$.ajax({

		type: "post",
		url: "func/crudUpdate.php",
		data: {
			idProfesion: idProfesion,
			nombre: nombre,
			servicio: servicio

		},
		success: function(){
			$(".formularios").empty();
			listadoProfesiones();
		}
	});

});

function listadoProfesiones(){

	$.ajax({
		type: "get",
		url: "func/listaProfesiones.php",
		success: function(result){
			$(".contenido").empty().html(result);
		} 
	});
}

