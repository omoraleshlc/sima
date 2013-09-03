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
q = document.getElementById('rfc').value;
nT = document.getElementById('nT').value;
folioFactura = document.getElementById('folioFactura').value;
ID_EJERCICIO = document.getElementById('ID_EJERCICIO').value;
// Set te random number to add to URL request
nocache = Math.random();
http.open('get', '/clinica/Ingresos/buscarRFC.php?q='+q+'&nocache = '+nocache+'&nT='+nT+'&folioFactura='+folioFactura+'&ID_EJERCICIO='+ID_EJERCICIO);
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
