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
q = document.getElementById('nomSeguro').value;


// Set te random number to add to URL request
nocache = Math.random();
http.open('get', '/sima/cargos/listaSeguros.php?q='+q);
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
