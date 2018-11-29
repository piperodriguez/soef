function registro(){
	var ruta ="http://localhost/soef/login/registro.php";
	location.href = ruta;
}

function consulta(url, parametros, respuesta){
	//console.log(parametros)
	$.ajax({
		type:'get',
		url: url,
		data: parametros,
		success: respuesta
	});
}

function transaccion(url, parametros, respuesta){
	$.ajax({
		type:'post',
		url: url,
		data: parametros,
		success: respuesta
	});
}

$(document).ready(function(){

	$(document).on('click','.resetPassword', function(){
		consulta("reset-password.php", {}, function(result) {
			$('.contenedor').html(result);
		});
	});


	$(document).on('click','.dataPerson', function(){
		$('.contenedor').load('dataperson.php .contenedor');

	});



});