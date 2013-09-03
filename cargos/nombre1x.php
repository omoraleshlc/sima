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
	
	
	if($caracteres>5){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	if($nombres){
$sql="SELECT * FROM 
pacientes 
where 
entidad='01'
AND

ltrim(CONCAT(nombre1)) like '%$nombres%'

order by
nombre1 asc";
}else{
$sql="SELECT * FROM 
pacientes 
where 
entidad='01'


order by
keyPacientes DESC limit 0,20";
}
	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["nombre1"];
		$name = $row["nombre1"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	}
?>