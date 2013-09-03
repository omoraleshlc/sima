<?php

        
//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

$nombres = $_GET["q"];
$sql="SELECT * FROM 
proveedores 
where 
entidad='".$_GET['entidad']."'
AND
razonSocial like '%$nombres%'
order by
razonSocial asc
limit 0,10
";

	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["id_proveedor"];
		$name = $row["razonSocial"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	
?>