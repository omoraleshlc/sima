<?php
function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 
	$hostname = "localhost";
	$username = "omorales";
	$password = "wolf3333";
	$database = "sima";

	mysql_connect($hostname, $username, $password);
	mysql_select_db($database);
	mysql_query("SET NAMES UTF8");
        $entidad=$_GET['entidad'];
	$nombres = $_GET["q"];
	$caracteres= strlen($nombres);
	$fecha=date("Y-m-d");
	
	if($caracteres>0){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	if($nombres){
$sql="SELECT * FROM 
medicos
where 
entidad='".$entidad."'
    and
    nombreCompleto like '%$nombres%'



order by
nombreCompleto asc
limit 0,100
";
}else{
$sql="SELECT * FROM 
medicos
where
entidad='".$entidad."'


order by
keyMedico DESC limit 0,100";
}
	//echo $sql;
	
	$results = mysql_query($sql);

	while ($row = mysql_fetch_array($results)) {
		$emp_no = $row["keyMedico"];
		$name = $row["nombreCompleto"]; 
		$observaciones=$row['observacionesSexo'];
		
                if($cedula!=NULL){$cedula='Cedula:'.$row['numCedula'];}else{$cedula='[NO TIENE CEDULA]';}
		if($row['fechaNacimiento']){
		$fechaNacimiento='Fecha Nacimiento: '.cambia_a_normal($row['fechaNacimiento']);
		}else{
		$fechaNacimiento=NULL;
		}
		
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \">\n\t$name\n</li>\n";
	
		// Two columns example
		//echo "<li onselect=\" this.setText('$name').setValue('$emp_no'); \"><span>$emp_no</span>\n\t$name\n</li>\n";

                if($row['ruta']!='images/' AND $row['ruta']){
                $route='/sima/OPERACIONESHOSPITALARIAS/admisiones/medicos/'.$row['ruta'];
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
                $resultsa = mysql_query($sSQLa);
                $rowa = mysql_fetch_array($resultsa);
                if($rowa['fecha']==$fecha){
                    $beneficencia='Beneficencia Activada! '.$rowa['porcentaje'].'%';
                }else{
                    $beneficencia=NULL;
                }


                
                $sSQL4="select *
                FROM
                porcentajeJubilados
                WHERE
                entidad='".$_GET['entidad']."'
                and
                numeroE='".$row['numCliente']."'
                and
                tipoPaciente='Ambulatorios' ";
                $result4=mysql_query($sSQL4);
                $myrow4 = mysql_fetch_array($result4);

                

                if($myrow4['porcentaje']>0){
                $sSQL3="SELECT nomCliente
                FROM
                clientes

                WHERE
                entidad='".$_GET['entidad']."'
                and
                numCliente='".$myrow4['seguro']."'

                  ";
                $result3=mysql_query($sSQL3);
                $myrow3 = mysql_fetch_array($result3);


                

                $porcentajeEspecial='El paciente tiene el porcentaje de ayuda del: '.$myrow4['porcentaje'].'%, ';
                $seguro=$myrow3['nomCliente'];

                }else{
                $porcentajeEspecial=NULL;
                $seguro=NULL;
                }

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
                $cedula
                </span>

                \n\t$name\n</li>


               


  



                

                </div>
                ";
	}
	}
?>