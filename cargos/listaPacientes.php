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

	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");

	$q = $_GET["q"];
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	$sql="SELECT numCliente,nombreCompleto FROM pacientes WHERE (nombreCompleto LIKE '%$q%' or numCliente='".$q."') limit 0,100";
	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["numCliente"];
		$name = $row["nombreCompleto"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}
	
?>