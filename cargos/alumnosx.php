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
        //$nombres='juan';
	$caracteres= strlen($nombres);
	$fecha=date("Y-m-d");
	
	if($caracteres>0){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	if($nombres){
$sql="SELECT * FROM
ALUMNOSINSCRITOS
where 

entidad='".$_GET['entidad']."'
AND
NOMBRE like '%$nombres%'
or
APATERNO like '%$nombres%'
or
AMATERNO like '%$nombres%'


or
MATRICULA like '%$nombres%'

order by
NOMBRE asc
limit 0,100
";
}else{
$sql="SELECT * FROM 
ALUMNOSINSCRITOS



order by
MATRICULA DESC limit 0,100";
}
	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["MATRICULA"];
		$name = $row["NOMBRE"].' '.$row["APATERNO"].' '.$row["AMATERNO"];
	
                //<img src='.$ruta.' width='80' height='80' alt='.$ruta.' />

		// Two columns example
/*                echo "


                <li onselect=\" this.setText('$name').setValue('$emp_no'); \">


                <div class='normal' style='background-color:yellow; border: 1px solid #000000;'>
                <span class='normal' align='center'>
                $emp_no
                </span>

                \n\t$name\n</li>


                <span class='normal' align='center'>
                $observaciones\n
                </span>


                <span class='normal' align='center'>
                $ruta
                </span>


                <span class='normal' align='center'>
                $porcentajeEspecial
                </span>

                <span class='normal' align='center'>
                $seguro
                </span>


                <span class='normal' align='center'>
                $fechaNacimiento
                </span>


                <span class='normal' align='center'>
                $brinco
                \n
                </span>



                </div>
                ";*/



                echo "


                <li onselect=\" this.setText('$name').setValue('$emp_no'); \">


                <div class='normal' style='background-color:yellow; border: 1px solid #000000;'>
                <span class='normal' align='center'>
                $emp_no
                </span>

                \n\t$name\n</li>


                <span class='normal' align='center'>
                $observaciones\n
                </span>


               


                <span class='normal' align='center'>
                $fechaNacimiento
                </span>



                <span class='normal' align='center'>
                $beneficencia
                </span>


                </div>
                ";
	}
	}
?>