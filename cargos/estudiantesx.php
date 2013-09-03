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
	//$nombres='TAYLOR';
        $caracteres= strlen($nombres);
	$fecha=date("Y-m-d");
	
	if($caracteres>0){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	if($nombres){
$sql="SELECT * FROM 
ALUMNOSINSCRITOS 
where 
(NOMBRE like '%$nombres'
OR
APELLIDOS like '%$nombres%')
OR
MATRICULA='".$nombres."' 

order by
NOMBRE asc
limit 0,100
";

	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
            
            
            
            
            
            
            
		$emp_no = $row["MATRICULA"];
		$name = $row["NOMBRE"].'  '.$row['APELLIDOS']; 
		$observaciones=$row['observacionesSexo'];
		
		if($row['fechaNacimiento']){
		$fechaNacimiento='Fecha Nacimiento: '.cambia_a_normal($row['fechaNacimiento']);
		}else{
		$fechaNacimiento=NULL;
		}
		
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";

                if($row['ruta']!='images/' AND $row['ruta']){
                $route='/sima/OPERACIONESHOSPITALARIAS/admisiones/'.$row['ruta'];
                $ruta='<img src="'.$route.'" width="80" height="80" />';
                }else{

                $ruta=NULL;
                }


                $sSQLa= "Select * From porcentajeBeneficencias
                where entidad='".$_GET['entidad']."' and numeroE='".$row['numCliente']."'
                and
                fecha='".$fecha."' and status='standby'
                and
                departamento='".$_GET['almacen']."'
                ";
                $resultsa = mysql_db_query($basedatos,$sSQLa);
                $rowa = mysql_fetch_array($resultsa);
       


                
                







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


                <div class='normal' style='background-color:#6EBAD7; border: 1px solid #000000;'>
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

                <span class='normal' align='center'>
                $infoantibioticos
                </span>



                </div>
                ";
	
	}
        }
        }
?>
