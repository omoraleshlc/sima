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
articulos
where 
entidad='".$_GET['entidad']."'
        
AND
descripcion like '%$nombres%'
and
(gpoProducto='HONMED' or gpoProducto='sIVA' or gpoProducto='cIVA')

and
        activo='A'

order by descripcion ASC limit 0,100
";

	//echo $sql;
	
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