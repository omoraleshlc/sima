<?php
	function fuzzy( $qa, $column, $s ) {
		$result = "";
		$lastLocate = "0";
		for ($i = 0; $i < count($qa); $i++) {		
			$locate = "";
		    for ($j = 0; $j <= $i; $j++)
				$locate = "LOCATE('$qa[$j]', $column, $lastLocate + 1)";
			$lastLocate = $locate;
			$result .= " $locate $s ";
		}
		return substr($result, 0, strlen( $result ) - strlen( $s ) - 1);
	}

//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

	$q = $_GET["q"];
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
    $sql="SELECT paciente,folioVenta FROM clientesInternos WHERE
(	(entidad='".$_GET['entidad']."'
	and
	paciente LIKE '%$q%' and
	statusOtros!='final'
	and
 statusCuenta='cerrada'
        )
	or
	(
	entidad='".$_GET['entidad']."'
	and
	folioVenta='".$q."'
	and
 statusCuenta='cerrada'
))
	order by paciente ASC";
	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
	
	


		$emp_no = $row["folioVenta"];
		//$name = $row["paciente"].' '.'$'.number_format($myrow17a['sumaAcumulados'],2).$sSQL17a;
		$name = $row["paciente"];
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	
?>