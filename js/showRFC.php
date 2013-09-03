<?php

	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "clinica";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");

	$q = $_GET["q"];
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	$sql="SELECT RFC,nombre FROM RFC WHERE RFC LIKE '%$q%'";
	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = pg_fetch_array($results)) {
		$emp_no = $row["nombre"];
		$name = $row["RFC"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	
?>