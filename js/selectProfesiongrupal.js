function getServiciosgrupal() {
	
	$.ajax({
		type: "get",
		url: "../includes/getServiciosgrupal.php",
		success: function(result){
			$("#serviciosListgrupal").empty().html(result);
		} 
	});

}

function getProfesionGrupal(id_servicio) {

	$.ajax({
		type: "get",
		url: "../includes/getProfesionGrupal.php?id_servicio="+id_servicio,
		success: function(result){
			$("#profesionesListgrupal").empty().html(result);
		} 
	});

}
 
function getPersonas(id_profesion) {
	
	$.ajax({
		type: "get",
		url: "../includes/gridPersons.php?id_profesion="+id_profesion,
		success: function(result){
			$("#gridPersonas").empty().html(result);
		} 
	});

}

$(document).ready(function(){


	$("#lala").click(function(){
		alert("jquery salvame");
	});



});

