<?php

	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");

	$nombres = $_GET["q"];
	$caracteres= strlen($nombres);
	

$sql="SELECT * FROM 
articulos 
where 
descripcion like '%$nombres%'
and
procedimiento='si'
order by
descripcion asc";


	
	$results = mysql_query($sql);
	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["codigo"];
		$name = $row["descripcion"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	
?>