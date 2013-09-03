<?php require('/var/www/html/sima/js/pdf/fpdf_js.php');


define('FPDF_FONTPATH','font/');
class PDF_AutoPrint extends PDF_Javascript
{
function AutoPrint($dialog=false)
{
    //Launch the print dialog or start printing immediately on the standard printer
    $param=($dialog ? 'true' : 'false');
    $script="print($param);";
    $this->IncludeJS($script);
}



function AutoPrintToPrinter($server, $printer, $dialog=false)
{
    //Print on a shared printer (requires at least Acrobat 6)
    $script = "var pp = getPrintParams();";
    if($dialog)
        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    else
        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    $script .= "print(pp);";
    $this->IncludeJS($script);
}
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




//$pdf=new FPDF();
$pdf=new PDF_AutoPrint();
$pdf->AddPage();





//require("/configuracion/funciones.php"); 
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
$basedatos='sima';
mysql_connect($servidor,$usuario,$passwd); 		


//******************************************************************
//clases fuera




$sSQL17= "
SELECT 
sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(status='particular' and statusCargo='cargado' )
and naturaleza='C' 
and
tipoCliente='particular'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
//return $myrow17['sumaCargos'];



$sSQL16= "
	SELECT 
  sum(precioVenta) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='A' 
and
tipoCliente='particular'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
 $Tabonos=$myrow16['Tabonos'];



$sSQL2= "
	SELECT 
  sum(precioVenta) as TCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='C' 

";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 $TCargos=$myrow2['TCargos'];


$TOTAL= $myrow17['sumaCargos']-$Tabonos+$TCargos;




 $sSQL13= "
	SELECT 
  sum(iva*cantidad) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$_GET['numeroE']."'
 and
 nCuenta='".$_GET['nCuenta']."'
and
statusCargo='cargado'

";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva= $myrow13['sumaiva'];



//*****************************************************



$sSQL1= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$sSQL1= "SELECT *
FROM
clientesInternos
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$paciente=$myrow1['paciente'];
$seguro=$myrow1['seguro'];
$numeroTransaccion=$myrow1['keyClientesInternos'];
//************devuelve seguro
$sSQL39= "SELECT *
FROM
clientes
where 
numCliente='".$seguro."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$seguro=$myrow39['nomCliente'];
$auxiliar=$myrow39['ID_AUXILIAR'];
$ctaMayor=$myrow39['ID_CTAMAYOR'];
//**********cierra devolver seguro
if($seguro)$paciente=$seguro;



$pdf->SetFont('Arial','',8);
//establece el nombre del paciente

$pdf->SetXY(50,10);
$pdf->Cell(0,0,$auxiliar,0,0,L);
$pdf->SetX(1);

$pdf->SetXY(50,15);
$pdf->Cell(0,0,$ctaMayor,0,0,L);
$pdf->SetX(1);


$pdf->SetY(5);
$pdf->Cell(0,0,$numeroTransaccion,0,0,R);
//numero de paciente

$pdf->SetXY(50,5);
$pdf->Cell(0,0,$paciente,0,0,L);
$pdf->SetX(1);


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




$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."' 
and
status!='transaccion'
order by keyCAP ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){
$codProcedimiento=$myrow['codProcedimiento'];
$SUBTOTAL[0]+=$myrow['precioVenta']*$myrow['cantidad'];

$sSQL3= "SELECT *
FROM
articulos
WHERE codigo ='".$codProcedimiento."' 
 ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$um=$myrow3['um'];

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

if($um=='s' or $um=='S')$myrow3['descripcion']='[Honorarios Médicos por Interpretación de Resultados] '.$myrow3['descripcion'];


$cos="$".number_format($myrow['precioVenta'],2);


$pdf->Ln(1); //salto de linea
$pdf->SetX('22');
$pdf->Cell(0,0,trim($myrow3['descripcion']),0,0,L);

$pdf->SetX('170');
$pdf->Cell(0,0,$myrow['cantidad'],0,0,M);

$pdf->SetX('140');
$pdf->Cell(0,0,$cos,0,0,R);


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

}

//function Header() { 
$image=new fpdf();
$image->Image('/var/www/html/sima/imagenes/logohlc.jpg'); 
//} 

//function Footer() { 
//$this->Image('/sima/imagenes/logohlc.jpg'); 
//}


$TOTAL=number_format($SUBTOTAL[0]+$iva,2);

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
$pdf->Cell(0,0,"$".number_format($SUBTOTAL[0],2),0,0,R);
$pdf->SetY($Y+5);
$pdf->Cell(0,0,"$".number_format($iva,2),0,0,R);
$pdf->SetY($Y+10);
$pdf->Cell(0,0,"$".number_format($SUBTOTAL[0]+$iva,2),0,0,R);
$pdf->SetXY(22,$Y+10);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);
$pdf->SetXY(22,$Y+13);
$pdf->Cell(0,0,'(Este no es un documento fiscal válido)',0,0,L);
//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
