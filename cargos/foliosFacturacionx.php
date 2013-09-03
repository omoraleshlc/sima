<?php

	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");



$nombres = $_GET["q"];
$sql="SELECT folioVenta,paciente FROM 
clientesInternos 
where 
entidad='".$_GET['entidad']."'
AND
statusFactura!='facturado'
and
statusCaja='pagado'
and
(
folioVenta like '%$nombres%' or paciente like '%$nombres%')
order by paciente ASC limit 0,20
";

	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["folioVenta"];
		$name = $row["paciente"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	
?>