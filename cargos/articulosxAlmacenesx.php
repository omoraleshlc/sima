<?php

//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

        

$nombres = $_GET["q"];
$al=$_GET['almacen'];

if(strlen($nombres)>2){
 $sql="SELECT * FROM 
articulos,existencias
where 
articulos.entidad='".$_GET['entidad']."'
and
articulos.descripcion like '%$nombres%'
and
articulos.codigo=existencias.codigo
and
articulos.activo='A'
and
existencias.almacen='".$al."'


";

	//group by articulos.codigo
//order by articulos.descripcion ASC limit 0,100
	
$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
            
		$emp_no = $row["keyPA"];
		$name = utf8_decode($row["descripcion"]); 
$sSQLw= "SELECT *
FROM
gpoProductos 
where

codigoGP='".$row["gpoProducto"]."'

";
$resultw=mysql_db_query($basedatos,$sSQLw);
$myroww = mysql_fetch_array($resultw); 
$grupo=  utf8_decode($myroww['descripcionGP']);
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">
		<span>
		$emp_no
		</span>
		
		<span >
		
		</span>
		
		\n\t$name\n
		</li>\n";	
		
		echo "

		<span >
		$grupo
		</span>
		
		";
		
				echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">

		
		\n\t\n
		</li>\n";
		?>
	
		<?php 
	}
	}
?>