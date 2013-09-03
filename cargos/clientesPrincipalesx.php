<?php

//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

	$q = $_GET["q"];
	$entidad=$_GET['entidad'];
	if(strlen($q)>3){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	$sql="SELECT numCliente,nomCliente FROM clientes WHERE 
	entidad='".$entidad."'
	and
	nomCliente LIKE '%$q%'  and clientePrincipal='' order by nomCliente ASC";
	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["numCliente"];
		$name = $row["nomCliente"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}}

?>