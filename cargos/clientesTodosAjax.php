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
	
	if(strlen($q)>3){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	$sql="SELECT numCliente,nomCliente FROM clientes WHERE 
            entidad='".$entidad."'
                and
            nomCliente LIKE '%$q%' and (tipo='Ambulatorios' or tipo='Ambos' or tipo='Internos') and subCliente='si' order by nomCliente ASC";
	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["numCliente"];
		$name = $row["nomCliente"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}}

?>