<?php

	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");


$entidad=$_GET['entidad'];
$nombres = $_GET["q"];
$palabraOriginal=$_GET['criterio'];

if(strlen($nombres)>5){
$sql="SELECT * FROM 
articulos
where 
entidad='".$entidad."' 
and
(descripcion like '%$palabraOriginal%' 
or 
sustancia  like '%$palabraOriginal%' )

";

	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["keyPA"];
		$name = $row["descripcion"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	}
?>