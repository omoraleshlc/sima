<?php include('/var/www/html/sima/js/pdf/fpdf_js.php');









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




//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************		

function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 

//******************************************************************

if($seguro)$paciente=$seguro;



$pdf->SetFont('Arial','',10);
//establece el nombre del paciente

$pdf->SetXY(2,5);
$pdf->Cell(0,0,'REPORTE DE IVA X OTROS',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->Cell(0,0,'Fecha Inicial: '.cambia_a_normal($_GET['fechaInicial']).' a la fecha: '.cambia_a_normal($_GET['fechaFinal']),0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1); 










//**********************************************************************************************************PACIENTES INTERNOS PAGADOS***************************************************************************************************************************
$pdf->Ln(10); //salto de linea
$pdf->SetX(2);
$pdf->Cell(0,0,"FOLIOS PAGADOS X OTROS",0,0,M);
$pdf->SetX(1); 

 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
(fecha1>='".$_GET['fechaInicial']."' and fecha1<='".$_GET['fechaFinal']."')

and
gpoProducto=''
and
descripcionTransaccion='pagosOtros'
and
folioVentaOtros!=''
group by folioVentaOtros
order by folioVentaOtros  ";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){



//*******************OPERACIONES CENTRO DE COSTO*******************


//***********************************************
//PAGO DE OTROS

$sSQLHaberO2= "
SELECT 
sum(precioVenta*cantidad) as haber
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and

folioVentaOtros='".$myrow['folioVentaOtros']."' 
and
descripcionTransaccion='pagosOtros'
and
naturaleza='A'

";
$resultHaberO2=mysql_db_query($basedatos,$sSQLHaberO2);
$myrowHaberO2 = mysql_fetch_array($resultHaberO2);





$sSQLDebeO2= "
SELECT 
sum(precioVenta*cantidad) as debe
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and


folioVentaOtros='".$myrow['folioVentaOtros']."' 
and
descripcionTransaccion='pagosOtros'
and
naturaleza='C'

";
$resultDebeO2=mysql_db_query($basedatos,$sSQLDebeO2);
$myrowDebeO2 = mysql_fetch_array($resultDebeO2);

$abonosOtros=$myrowHaberO2['haber']-$myrowDebeO2['debe'];

//********************************************



//*********************************************
$sSQLTO= "
SELECT 
sum(precioVenta*cantidad) as trasladoOtros
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and


folioVenta='".$myrow['folioVentaOtros']."' 
and
tipoPago='Otros'
and
naturaleza='A'

";
$resultTO=mysql_db_query($basedatos,$sSQLTO);
$myrowTO = mysql_fetch_array($resultTO);
$totalTraslado=$myrowTO['trasladoOtros'];


//*********************************************
$porcentaje= $abonosOtros/$totalTraslado;




//*************TOTAL DE LA CUENTA 100%************
$sSQLTC1= "
SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as cargos
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and


folioVenta='".$myrow['folioVentaOtros']."' 
and
gpoProducto!=''
and
naturaleza='C'

";
$resultTC1=mysql_db_query($basedatos,$sSQLTC1);
$myrowTC1 = mysql_fetch_array($resultTC1);



$sSQLTC2= "
SELECT 
sum((precioVenta*cantidad) +(iva*cantidad)) as devoluciones
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and


folioVenta='".$myrow['folioVentaOtros']."' 
and
gpoProducto!=''
and
naturaleza='A'

";
$resultTC2=mysql_db_query($basedatos,$sSQLTC2);
$myrowTC2 = mysql_fetch_array($resultTC2);



//***********************************************



















//*******************SOLO ENTRA AQUI UNA SOLA VEZ
if($myrow['folioVentaOtros']!=$folioVenta){
$pdf->Ln(5); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(3); //salto de linea





$pdf->SetX('2');
$pdf->Cell(0,0,$myrow['folioVentaOtros'],0,0,M);


//****************************CARGO A LA CAJA*************************
$sSQL1a= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow['folioVentaOtros']."' 
and
gpoProducto!=''
group by gpoProducto
order by gpoProducto ASC
";
 

$result1a=mysql_db_query($basedatos,$sSQL1a);
while($myrow1a = mysql_fetch_array($result1a)){
$pdf->Ln(3); //salto de linea


$sSQL1ac= "SELECT * FROM gpoProductos
WHERE
entidad='".$_GET['entidad']."'
and
codigoGP='".$myrow1a['gpoProducto']."' 

";
 

$result1ac=mysql_db_query($basedatos,$sSQL1ac);
$myrow1ac = mysql_fetch_array($result1ac);

$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,$myrow1ac['descripcionGP'],0,0,M);



$sSQLHaberO= "
SELECT 
sum(precioVenta*cantidad) as haber
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and

folioVenta='".$myrow['folioVentaOtros']."' 
and
gpoProducto='".$myrow1ac['codigoGP']."'
and
naturaleza='C'

";
$resultHaberO=mysql_db_query($basedatos,$sSQLHaberO);
$myrowHaberO = mysql_fetch_array($resultHaberO);





$sSQLDebeO= "
SELECT 
sum(precioVenta*cantidad) as debe
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and


folioVenta='".$myrow['folioVentaOtros']."' 
and
gpoProducto='".$myrow1ac['codigoGP']."'
and
naturaleza='A'

";
$resultDebeO=mysql_db_query($basedatos,$sSQLDebeO);
$myrowDebeO = mysql_fetch_array($resultDebeO);



$pagoEfectivoPorcentaje=($myrowHaberO['haber']-$myrowDebeO['debe'])*$porcentaje;


/* echo $myrowHaberO['haber'].'  '.$myrowDebeO['debe'].'   '.$porcentaje;
echo '<br>';
echo $myrow1ac['codigoGP'];
echo '<br>'; */

$pagoEfectivo= ($myrowHaberO['haber']-$myrowDebeO['debe'])-$pagoEfectivoPorcentaje;
$totalEfectivo[0]+=($myrowHaberO['haber']-$myrowDebeO['debe'])-$pagoEfectivoPorcentaje;
//****************************************************************




//**********************************************************

//*************************************************************************
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($pagoEfectivo,2),0,0,M);


}


}












$sSQLHaberO1= "
SELECT 
sum(iva*cantidad) as haber
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and

folioVenta='".$myrow['folioVentaOtros']."' 
and
naturaleza='C'

";
$resultHaberO1=mysql_db_query($basedatos,$sSQLHaberO1);
$myrowHaberO1 = mysql_fetch_array($resultHaberO1);





$sSQLDebeO1= "
SELECT 
sum(iva*cantidad) as debe
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and


folioVenta='".$myrow['folioVentaOtros']."' 
and
naturaleza='A'

";
$resultDebeO1=mysql_db_query($basedatos,$sSQLDebeO1);
$myrowDebeO1 = mysql_fetch_array($resultDebeO1);
 
 
 
$ivaPorcentaje=($myrowHaberO1['haber']-$myrowDebeO1['debe'])*$porcentaje;
$ivaEfectivo=($myrowHaberO1['haber']-$myrowDebeO1['debe'])-$ivaPorcentaje;
$totalIVAEfectivo[0]+=($myrowHaberO1['haber']-$myrowDebeO1['debe'])-$ivaPorcentaje;


//*************************************************************************
$pdf->Ln(7); //salto de linea


if($ivaEfectivo>0){
$pdf->SetX('30');
$pdf->Cell(0,0,"IVA",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($ivaEfectivo,2),0,0,M);
}
//****************************************CIERRE EFECTIVO**********************************




$folioVenta=$myrow['folioVentaOtros'];
//$pdf->Ln(20); //salto de linea
$pdf->Ln(3); //salto de linea




} //cierra while**************************--------------------------------------------------------------








//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(1); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('70');
$pdf->Cell(0,0,'SubTotal',0,0,M);

$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalEfectivo[0],2),0,0,M);



$pdf->Ln(4); //salto de linea

$pdf->SetX('70');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalIVAEfectivo[0],2),0,0,M);


$pdf->Ln(10); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'TOTAL',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalEfectivo[0]+$totalIVAEfectivo[0],2),0,0,M);



$pdf->Ln(4); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);

//************************************************************************************




















//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
