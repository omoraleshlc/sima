<?php require('/var/www/html/sima/js/pdf/fpdf.php'); 
 class acumulados {
  public function acumulado1($basedatos,$usuario,$numeroE1,$nCuenta1){
 $sSQL171= "
	SELECT 
  sum((costo*cantidad)+iva+cantidadRecibida) as CantidadRecibida
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(status!='standby' and statusCargo!='standby' and statusAlta!='cxc')
and
naturaleza='Cargo'
";
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);
$sSQL17= "
	SELECT 
  sum((costo*cantidad)+iva) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(status!='standby' and statusCargo!='standby' and statusAlta!='cxc')

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
return $Tcargos=($myrow17['sumaCargos']+$myrow171['CantidadRecibida']);
}
 
 
 public function acumulado($basedatos,$usuario,$numeroE1,$nCuenta1){
$sSQL171= "
	SELECT 
  sum((costo*cantidad)+iva+cantidadRecibida) as CantidadRecibida
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(status!='standby' and statusCargo!='standby' and statusAlta!='cxc')
and
naturaleza='Cargo'
";
$result171=mysql_db_query($basedatos,$sSQL171);
$myrow171 = mysql_fetch_array($result171);
$sSQL17= "
	SELECT 
  sum((costo*cantidad)+iva) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(status!='standby' and statusCargo!='standby' and statusAlta!='cxc')

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);

		//echo "$".number_format($iva,2);
		
		
		 $sSQL16= "
	SELECT 
  sum(cantidadRecibida) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='pagado'
and
naturaleza='Abono'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
		  $Tabonos=$myrow16['Tabonos'];
return $Tcargos=($myrow17['sumaCargos']+$myrow171['CantidadRecibida'])-$Tabonos;

		}
		}
		
		
		function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 

		
function numerotexto ($numero) {  
    // Primero tomamos el numero y le quitamos los caracteres especiales y extras  
    // Dejando solamente el punto "." que separa los decimales  
    // Si encuentra mas de un punto, devuelve error.  
    // NOTA: Para los paises en que el punto y la coma se usan de forma  
    // inversa, solo hay que cambiar la coma por punto en el array de "extras"  
    // y el punto por coma en el explode de $partes  
      
    $extras= array("/[\$]/","/ /","/,/","/-/");  
    $limpio=preg_replace($extras,"",$numero);  
    $partes=explode(".",$limpio);  
    if (count($partes)>2) {  
        return "Error, el n&uacute;mero no es correcto";  
        exit();  
    }  
      
    // Ahora explotamos la parte del numero en elementos de un array que  
    // llamaremos $digitos, y contamos los grupos de tres digitos  
    // resultantes  
      
    $digitos_piezas=chunk_split ($partes[0],1,"#");  
    $digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1);  
    $digitos=explode("#",$digitos_piezas);  
    $todos=count($digitos);  
    $grupos=ceil (count($digitos)/3);  
      
    // comenzamos a dar formato a cada grupo  
      
    $unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve');  
    $decenas = array ('diez','once','doce', 'trece','catorce','quince');  
    $decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa');  
    $centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos');  
    $resto=$todos;  
      
    for ($i=1; $i<=$grupos; $i++) {  
          
        // Hacemos el grupo  
        if ($resto>=3) {  
            $corte=3; } else {  
            $corte=$resto;  
        }  
            $offset=(($i*3)-3)+$corte;  
            $offset=$offset*(-1);  
          
        // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB  
          
        $num=implode("",array_slice ($digitos,$offset,$corte));  
        $resultado[$i] = "";  
        $cen = (int) ($num / 100);              //Cifra de las centenas  
        $doble = $num - ($cen*100);             //Cifras de las decenas y unidades  
        $dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas  
        $uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades  
        if ($cen > 0) {  
           if ($num == 100) $resultado[$i] = "cien";  
           else $resultado[$i] = $centena[$cen-1].' ';  
        }//end if  
        if ($doble>0) {  
           if ($doble == 20) {  
              $resultado[$i] .= " veinte";  
           }elseif (($doble < 16) and ($doble>9)) {  
              $resultado[$i] .= $decenas[$doble-10];  
           }else {  
              $resultado[$i] .=' '. $decena[$dec-1];  
           }//end if  
           if ($dec>2 and $uni<>0) $resultado[$i] .=' y ';  
           if (($uni>0) and ($doble>15) or ($dec==0)) {  
              if ($i==1 && $uni == 1) $resultado[$i].="uno";  
              elseif ($i==2 && $num == 1) $resultado[$i].="";  
              else $resultado[$i].=$unidad[$uni-1];  
           }  
        }  

        // Le agregamos la terminacion del grupo  
        switch ($i) {  
            case 2:  
            $resultado[$i].= ($resultado[$i]=="") ? "" : " mil ";  
            break;  
            case 3:  
            $resultado[$i].= ($num==1) ? " millon " : " millones ";  
            break;  
        }  
        $resto-=$corte;  
    }  
      
    // Sacamos el resultado (primero invertimos el array)  
    $resultado_inv= array_reverse($resultado, TRUE);  
    $final="";  
    foreach ($resultado_inv as $parte){  
        $final.=$parte;  
    }  
    return $final;  
}  




$conexion=mysql_connect("localhost","omorales","wolf3333");
$basedatos="sima";
$pdf=new FPDF();
$pdf->AddPage();
function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}

$_GET['numeroE']=$_GET['numeroE'];


$sSQL1= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if($myro21['tipoPaciente']=="interno"){
$sSQL1= "SELECT *
FROM
clientesInternos
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$paciente=$myrow1['nombre1']." ".$myrow1['nombre2']." ".$myrow1['apellido1']." ".$myrow1['apellido2']." ".$myrow1['apellido3'];
$sSQL2= "
SELECT 
sum(iva) as totalIva
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' and nCuenta='".$_GET['nCuenta']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$tiva=$myrow2['totalIva'];
} else {
$sSQL1= "SELECT *
FROM
clientesInternos
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$paciente=$myrow1['paciente'];
$sSQL2= "
SELECT 
sum(iva) as totalIva
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' and nCuenta='".$_GET['nCuenta']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$tiva=$myrow2['totalIva'];
}

$pdf->SetFont('Arial','',8);

//establece el nombre del paciente
$pdf->SetXY(30,5);
$pdf->Cell(0,0,$paciente,0,0,L);
$pdf->SetX(1);
//numero de paciente
$pdf->Cell(0,0,$_GET['numeroE'],0,0,R);

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(10);
$pdf->Cell(0,0,$fecha1,0,0,R);
//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea



$pdf->SetFont('Arial','',8);
$pdf->SetXY(30,7);

$pdf->Ln(15); //salto de linea




	  $sSQL13= "
	SELECT 
  sum(iva) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$_GET['numeroE']."'  and nCuenta='".$_GET['nCuenta']."'
 
 and status='pendiente'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva=$myrow13['sumaiva'];


$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
group by codProcedimiento ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){
$codProcedimiento=$myrow['codProcedimiento'];

$pdf->Ln(1); //salto de linea
$sSQL61= "
	SELECT 
sum(cantidad) as cant
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_GET['numeroE']."' and '".$_GET['nCuenta']."'  and codProcedimiento='".$codProcedimiento."'";
$result61=mysql_db_query($basedatos,$sSQL61);
$myrow61 = mysql_fetch_array($result61);


$sSQL3= "SELECT *
FROM
articulos
WHERE codigo ='".$codProcedimiento."' 
 ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$codigoTT=$myrow['tipoTransaccion'];
$sSQL39= "
	SELECT 
*
FROM
catTTCaja
WHERE codigoTT='".$codigoTT."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

if(!$myrow3['descripcion']){
$myrow3['descripcion']=$myrow39['descripcion'];
} 

$cant=$myrow61['cant'];
$importe2[0]+=$myrow['costo'];

//$pdf->SetXY(1,60);


$importe=$cant*$myrow['costo'];

if(!$myrow['costo']){
$myrow['costo']="-".$myrow['cantidadRecibida'];
}

$cos="$".number_format($myrow['costo'],2);
$imp="$".number_format($importe,2);
//$cadena=$cant.'  '.$cos.'  '.$imp;
$importes[0]+=$importe;
$pdf->SetX('22');
$pdf->Cell(0,0,trim($myrow3['descripcion']),0,0,L);
//$pdf->Cell(0,0,$cadena,0,0,R);

//**********pruebas
$pdf->SetX('170');
$pdf->Cell(0,0,$cant,0,0,M);

$pdf->SetX('140');
$pdf->Cell(0,0,$cos,0,0,R);

//************cierra pruebas


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

}

$despliegaTotal=new  acumulados();
$despliegaTotal1=new acumulados();
$TOTAL=$despliegaTotal->acumulado($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']);

$centavos=strstr($TOTAL,'.');
$centavos=substr($centavos,'1');
$resultado= numerotexto($TOTAL); 
$totalCaracteres=strlen($centavos);
if($totalCaracteres=='1'){
$centavos=$centavos.'0';
}
if(!$centavos){
$centavos='00';
}

$formula= 'pesos '.$centavos.'/100 M.N.';
$formula=trim($formula);

$Y=120;

$pdf->SetFont('Arial','',8);
$pdf->SetY($Y);
$pdf->Cell(0,0,"$".number_format($despliegaTotal1->acumulado1($basedatos,$usuario,$_GET['numeroE'],$_GET['nCuenta']),2),0,0,R);
$pdf->SetY($Y+5);
$pdf->Cell(0,0,"$".number_format($iva,2),0,0,R);
$pdf->SetY($Y+10);
$pdf->Cell(0,0,"$".number_format($TOTAL,2),0,0,R);
$pdf->SetXY(22,$Y+10);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);
$pdf->Output();
?>
