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
require('/configuracion/funciones.php');
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************  
        
        
        $q = $_GET["q"];
        
        
        
	
	

	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	    $sql="SELECT facturasAplicadas.fecha,facturasAplicadas.numFactura,clientes.nomCliente FROM facturasAplicadas,clientes WHERE
            facturasAplicadas.entidad='".$_GET['entidad']."'
            and
            clientes.numCliente=facturasAplicadas.seguro
            and
            facturasAplicadas.numFactura LIKE '%$q%' 
                and
                facturasAplicadas.status='facturado'
            group by facturasAplicadas.numFactura                
            order by clientes.nomCliente ASC";
	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["numFactura"];
		$nombres = $row["nomCliente"].'</br>'.$row['numFactura']; 
		$name = $row["nomCliente"]; 
		//$name=substr($row["nomCliente"],0,60);
		
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span></span>\n\t$nombres\n</li>\n";	
		
		?>
	
		<?php 

        
        }

?>