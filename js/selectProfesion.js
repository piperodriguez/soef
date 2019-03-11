function getServicios() {
	
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("serviciosList").innerHTML=xmlhttp3.responseText;
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
			document.getElementById("profesionesList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../includes/getProfesion.php?id_servicio="+id_servicio,true);
	xmlhttp3.send();
}


 
function getPersona(id_profesion) {
	
	if (window.XMLHttpRequest) {
		xmlhttp3 = new XMLHttpRequest();
		} else { 
		xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp3.onreadystatechange=function() {
		if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
			document.getElementById("personasList").innerHTML=xmlhttp3.responseText;
		}
	}
	xmlhttp3.open("GET","../includes/getPersona.php?id_profesion="+id_profesion,true);
	xmlhttp3.send();
}