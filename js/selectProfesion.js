
function getServicios() {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("ServiciosList").innerHTML=xmlhttp3.responseText;
		}
	}
	
	xmlhttp3.open("GET","../includes/getServicios.php",true);
	xmlhttp3.send();
}

function getProfesion(id_servicio) {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("ProfesionesList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","includes/getProfesion.php?id_servicio="+id_servicio,true);
	xmlhttp3.send();
}