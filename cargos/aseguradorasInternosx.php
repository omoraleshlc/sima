<?php
	
	
	function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
	} 

//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

	$nombres = $_GET["q"];
	$caracteres= strlen($nombres);
	
	
	if($caracteres>2){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";

$sql="SELECT * FROM 
clientesInternos 
where 
(entidad='".$_GET['entidad']." '
and
tipoPaciente='externo'
and
paciente like '%$nombres%'
and
statusCaja='pagado'
and
folioVenta!=''
)
or
(entidad='".$_GET['entidad']." '
and
paciente like '%$nombres%'
and

(tipoPaciente='interno' or tipoPaciente='urgencias')
and
folioVenta!=''
)

order by
paciente asc
limit 0,100
";

	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
/* 		$emp_no = '<span class="normal">'.$row["folioVenta"].'</span>';
		$name = '<span class="normal">'.$row["paciente"].'</span>'; */
		
		$emp_no = $row["folioVenta"];
		$name = $row["paciente"];
		
		$fecha='<span class="codigos">'.cambia_a_normal($row['fecha']).'</span>';
		if($row['tipoPaciente']=='interno' or $row['tipoPaciente']=='urgencias'){
		$fechaCierre='<span class="normal">'.cambia_a_normal($row['fecha']).'</span>';
		$mensajeCierre='<span class="normal">'.'Fecha Cierre: '.'</span>';
		}
		$mensajeFecha='<span class="normal">'.'Fecha Consulta: '.'</span>';

		
		
 $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$_GET['entidad']."'
and
almacen = '".$row['almacen']."'
";
$result17=mysql_db_query($database,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
	$departamento='<span class="normal">'.'Departamento: '.$myrow17['descripcion'].'</span>';		 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>.$departamento\n\n$fecha\n$mensajeFecha\n$fechaCierre$mensajeCierre\n<hr>";	

		?>
	
		<?php 
	}
	}
?>
