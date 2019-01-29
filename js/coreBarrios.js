$(document).ready(function(){

	listadoBarrios();

	$(".insertBarrio").on("click", function() {

		alert("papa");
		
		$.ajax({

			type: "get",
			url: "func/htmlInsert.php",
			success: function(result) {
				$(".formularios").empty().html(result);
			}

		});

	});
});

function listadoBarrios(){

	$.ajax({
		type: "get",
		url: "func/listaBarrios.php",
		success: function(result){
			$(".contenido").empty().html(result);
		} 
	});
}