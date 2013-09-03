/* ---------------------------- */
/* XMLHTTPRequest Enable 		*/
/* ---------------------------- */
function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
	request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
		return request_type;
}

var http = createObject();

/* -------------------------- */
/* SEARCH					 */
/* -------------------------- */
function autosuggest() {



//declarar variables
q = document.getElementById('paciente').value;
fechaSolicitud = document.getElementById('fechaSolicitud').value;
almacen=document.getElementById('almacen').value;
horaSolicitud=document.getElementById('horaSolicitud').value;
tipoCliente=document.getElementById('tipoCliente').value;
almacenSolicitud=document.getElementById('almacenSolicitud').value;
telefono=document.getElementById('telefono').value;

// Set te random number to add to URL request
nocache = Math.random();
http.open('get', '/sima/cargos/search.php?q='+q+'&nocache = '+nocache+'&fechaSolicitud='+fechaSolicitud+'&almacen='+almacen+'&horaSolicitud='+horaSolicitud+'&tipoCliente='+tipoCliente+'&almacenSolicitud='+almacenSolicitud+'&telefono='+telefono);
http.onreadystatechange = autosuggestReply;
http.send(null);
}
function autosuggestReply() {
if(http.readyState == 4){
	var response = http.responseText;
	e = document.getElementById('results');
	if(response!=""){
		e.innerHTML=response;
		e.style.display="block";
	} else {
		e.style.display="none";
	}
}
}
