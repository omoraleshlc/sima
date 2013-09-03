Escoje el Paciente...
<?php require('/configuracion/ventanasEmergentes.php');
/*
	This is the back-end PHP file for the AJAX Suggest Tutorial
	
	You may use this code in your own projects as long as this 
	copyright is left	in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	
	For the rest of the code visit http://www.DynamicAJAX.com
	
	Copyright 2006 Ryan Smith / 345 Technical / 345 Group.	
*/

//Send some headers to keep the user's browser from caching the response.
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-Type: text/xml; charset=utf-8");

//Get our database abstraction file


///Make sure that a value was sent.
if (isset($_GET['search']) && $_GET['search'] != '') {
	//Add slashes to any quotes to avoid SQL problems.
	$search = addslashes($_GET['search']);
	
	echo '</br>';

	
	//Get every page title for the site.
	$sSQL = "SELECT * FROM pacientes WHERE entidad='".$entidad."' AND nombreCompleto like '%$search%' or numCliente='".$search."'
	
	
	order by apellido1 limit 0,20 ";
	$result=mysql_db_query($basedatos,$sSQL);
	
while($suggest = mysql_fetch_array($result)){
		//Return each page title seperated by a newline.
echo $suggest['nombre1']." ".$suggest['nombre2']." ".$suggest['apellido1']." ".$suggest['apellido2']. "\n";
	}
}
?>