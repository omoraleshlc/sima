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
    
    
if(is_numeric($nombres)){
$sql="SELECT * FROM 
articulos,gpoProductos
where 
  
articulos.entidad='".$_GET['entidad']."'       
and
articulos.cbarra ='".$nombres."'
and
articulos.activo='A'    
group by articulos.cbarra
order by articulos.descripcion ASC limit 0,100
";    
}   else{ 
$sql="SELECT * FROM 
articulos,gpoProductos
where 
articulos.entidad='".$_GET['entidad']."'
AND
articulos.descripcion like '%$nombres%'
and
articulos.descripcion!=''
and
gpoProductos.codigoGP=articulos.gpoProducto
and
gpoProductos.afectaExistencias='si'
and
articulos.activo='A'        



order by articulos.descripcion ASC limit 0,100
";
}
	//echo $sql;
	
$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
            
            
		$emp_no = $row["codigo"];
		$name = trim($row["descripcion"]); 
$sSQLw= "SELECT *
FROM
gpoProductos 
where

codigoGP='".$row["gpoProducto"]."'

";
$resultw=mysql_query($sSQLw);
$myroww = mysql_fetch_array($resultw); 
$grupo=$myroww['descripcionGP'];
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
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