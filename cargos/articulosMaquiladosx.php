<?php

	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");

$nombres = $_GET["q"];


if(strlen($nombres)>5){
$sql="SELECT * FROM 
articulos,existencias
where 
articulos.entidad='".$_GET['entidad']."'
AND
articulos.descripcion like '%$nombres%' 
and
articulos.descripcion!=''
and
existencias.keyPA=articulos.keyPA
and
existencias.almacen='".$_GET['almacen']."'



order by articulos.descripcion ASC limit 0,100
";

	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["keyPA"];
		$name = $row["descripcion"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	}
?>