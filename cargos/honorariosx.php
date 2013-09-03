<?php


//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

$nombres = $_GET["q"];


if(strlen($nombres)>5){
$sql="SELECT * FROM 
articulos,gpoProductos
where 
articulos.entidad='".$_GET['entidad']."'
AND
(articulos.descripcion like '%$nombres%'
and
articulos.descripcion!=''
and
gpoProductos.codigoGP=articulos.gpoProducto
and
gpoProductos.afectaExistencias='si'
or
articulos.cbarra ='".$nombres."')
group by articulos.cbarra


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