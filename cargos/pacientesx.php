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
	$fecha=date("Y-m-d");
	
	if($caracteres>0){
	
	//$sql = "SELECT * FROM employees WHERE $where ORDER BY $order_by, name LIMIT $page_size";
	if($nombres){
$sql="SELECT * FROM 
pacientes 
where 
entidad='".$_GET['entidad']."'
AND
((ltrim(nombreCompleto) like '%$nombres'
or
(
ltrim(CONCAT(nombre1)) like '%$nombres%'
or
ltrim(CONCAT(apellido1,' ',apellido2)) like '%$nombres%'
or
ltrim((CONCAT(apellido1,' ',apellido2)) like '%$nombres%')
or
ltrim(CONCAT(apellido3)) like '%$nombres%'
or
ltrim(CONCAT(nombre1)) like '%$nombres%'
)))
or
(
entidad='".$_GET['entidad']."'
AND
            (ltrim(numCliente)='".$nombres."' or ltrim(numEmpleado)='".$nombres."' or ltrim(numMatricula)='".$nombres."' ))

order by
nombre1 asc
limit 0,100
";
}else{
$sql="SELECT * FROM 
pacientes 



order by
keyPacientes DESC limit 0,100";
}
	//echo $sql;
	
	$results = mysql_db_query($basedatos,$sql);
	while ($row = mysql_fetch_array($results)) {
            
            
            
            
            
            
            
		$emp_no = $row["numCliente"];
		$name = $row["nombreCompleto"]; 
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
                $result4=mysql_db_query($basedatos,$sSQL4);
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
                $result3=mysql_db_query($basedatos,$sSQL3);
                $myrow3 = mysql_fetch_array($result3);




                $porcentajeEspecial='El paciente tiene el porcentaje de ayuda del: '.$myrow4['porcentaje'].'%, ';
                $seguro=$myrow3['nomCliente'];

                }else{
                $porcentajeEspecial=NULL;
                $seguro=NULL;
                }






                //ANTIBIOTICOS
                $sSQL1f= "Select * From antibioticos WHERE
                    entidad='".$_GET['entidad']."' and numeroE='".$row['numCliente']."'
                and
                status='pagado'
                and
                fechafinal<='".$fecha."'
                    and
                    tratamientocontinuo='Incompleto'
                ";
                $result1f=mysql_db_query($basedatos,$sSQL1f);
                $myrow1f = mysql_fetch_array($result1f);
                if($myrow1f['numeroE']){
                    $infoantibioticos='<span class="precio1"><blink>El Paciente tiene tratamiento Continuo</blink></span>';
                }else{
                       $infoantibioticos=NULL;
                }
                //**************************










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
?>
