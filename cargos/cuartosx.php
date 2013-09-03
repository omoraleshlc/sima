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

	if(strlen($q)>3){
	
	
$sSQL11= "Select distinct * From cuartos
where entidad='01' AND 
status='libre' and departamento='".$q."'
and
departamento!=''
order by codigoCuarto ASC";



$result11=mysql_db_query($basedatos,$sSQL11);
while($myrow11 = mysql_fetch_array($result11)){ 

		$emp_no = $myrow11["codigoCuarto"];
		$name = $myrow11["descripcionCuarto"]; 

		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";	
		
		?>
	
		<?php 
	}}

?>