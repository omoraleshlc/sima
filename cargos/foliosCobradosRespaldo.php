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





//require("/configuracion/funciones.php"); 
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
$basedatos='sima';
mysql_connect($servidor,$usuario,$passwd); 		

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
$pdf->Cell(0,0,'REPORTE DETALLE DE CAJA',0,0,M);
$pdf->SetX(1);


//******************************





$fecha1=date("d/m/Y");
$pdf->SetY(10);
$pdf->Cell(0,0,$fecha1,0,0,R);


//*****************************
$sSQL1a= "Select * From statusCaja where keyCatC='".$_GET['codigoCaja']."' and numCorte='".$_GET['numCorte']."' order by keySTC DESC";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

$pdf->SetXY(2,10);
$pdf->Cell(0,0,"Diario de Caja",0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,13);
$pdf->Cell(0,0,'Cajero(a): '.$myrow1a['usuario'],0,0,M);
$pdf->SetX(1);

//********************************************
$sSQL1= "Select descripcionCaja From catCajas where keyCatC='".$_GET['codigoCaja']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


//*****************************************************
$pdf->SetXY(2,17);                                  //*  
$pdf->Cell(0,0,$myrow1['descripcionCaja'],0,0,M);   //*
$pdf->SetX(1);                                      //*
//*****************************************************

$pdf->SetXY(2,20);  
$pdf->Cell(0,0,'Num. Corte: '.$_GET['numCorte'],0,0,M);

$pdf->SetXY(2,24);  
$pdf->Cell(0,0,'Fecha Apertura: '.cambia_a_normal($myrow1a['fechaApertura']).' '.$myrow1a['horaApertura'],0,0,M);

$pdf->SetXY(30,24);  
$pdf->Cell(0,0,'Fecha Cierre: '.cambia_a_normal($myrow1a['fechaCorte']).' '.$myrow1a['horaCorte'],0,0,R);

//***********************************EFECTIVO SOLAMENTE***********************************


$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);


$pdf->SetXY(2,30);
$pdf->Cell(0,0,'Folio',0,0,M);

$pdf->SetXY(15,30);
$pdf->Cell(0,0,'Recibo',0,0,M);

$pdf->SetXY(30,30);
$pdf->Cell(0,0,'Descripción',0,0,M);

//*************TRANSACCIONES***************
$pdf->SetXY(170,30);
$pdf->Cell(0,0,'Cargos',0,0,M);


$pdf->SetXY(190,30);
$pdf->Cell(0,0,'Abonos',0,0,M);


//****************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);

//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea



 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
codigoCaja='".$_GET['codigoCaja']."'
and
numCorte='".$_GET['numCorte']."'


order by 
numRecibo ASC
 ";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
if($myrow['folioVenta']!=$folioVenta){
$pdf->Ln(5); //salto de linea

$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
}


$y+=7;
$y1=70;
$y1+=1;






if($myrow['codProcedimiento']){
if($myrow['naturaleza']=='A'){ 
$sSQL7="SELECT sum(precioVenta) as efectivo
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$myrow['keyCAP']."'

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);

} else {
$sSQL7="SELECT sum((cargosCuentaPaciente.precioVenta*cargosCuentaPaciente.cantidad+cargosCuentaPaciente.iva*cargosCuentaPaciente.cantidad)) as efectivo
FROM
cargosCuentaPaciente
WHERE
cargosCuentaPaciente.keyCAP='".$myrow['keyCAP']."'
and
status!='cancelado'
  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
}






$cos="$".number_format($myrow7['efectivo'],2);

$iva[0]+=$myrow71['ivas'];
$pdf->Ln(3); //salto de linea

$pdf->SetX('2');
$pdf->Cell(0,0,$myrow['folioVenta'],0,0,L);

$pdf->SetX('17');
$pdf->Cell(0,0,$myrow['numRecibo'],0,0,L);
//*******************************TRANSACCION****************************

if($myrow['status']=='transaccion'){
$sSQLs= "Select descripcion From catTTCaja where 
codigoTT='".$myrow['tipoTransaccion']."'";
$results=mysql_db_query($basedatos,$sSQLs); 
$myrow99 = mysql_fetch_array($results);
} else {
$sSQL99= "
SELECT descripcion
FROM
articulos
WHERE entidad='".$_GET['entidad']."' AND

codigo='".$myrow['codProcedimiento']."'
";
$result99=mysql_db_query($basedatos,$sSQL99);
$myrow99 = mysql_fetch_array($result99); 
$desc=$myrow99['descripcion'];
}


if($myrow['descripcion']){
$desc=$myrow['descripcion'];
}

//************************

if($myrow['folioDevolucion']){
$folioDevolucion=' [folio cancelado: '.$myrow['folioDevolucion'].' ]';
}else{
$folioDevolucion=NULL;
}

if($myrow['naturaleza']=='A'){
$tipoPago=' ('.$myrow['tipoPago'].') ';
}else{
$tipoPago=NULL;
}



$pdf->SetX('30');
$pdf->Cell(0,0,$desc.$tipoPago.$folioDevolucion,0,0,L);


//$pdf->SetX('60');
//$pdf->Cell(0,0,$myrow['paciente'],0,0,L);
if($myrow['naturaleza']=='A'){
$pdf->SetX('170');
$pdf->Cell(0,0,$cos,0,0,M);
$cargo=$myrow7['efectivo'];
$cargos[0]+=$cargo;
} else {
$pdf->SetX('190');
$pdf->Cell(0,0,$cos,0,0,M);
$abonos[0]+=$myrow7['efectivo'];
}


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea
} else {
$pdf->Cell(0,0,'No hay registros!!',0,0,L);
}



$folioVenta=$myrow['folioVenta'];

//totales



//****************************PAQUETES*******************************
$sSQL7a="SELECT paquete
FROM
clientesInternos
WHERE
keyClientesInternos='".$myrow['keyClientesInternos']."'
  ";
  $result7a=mysql_db_query($basedatos,$sSQL7a);
  $myrow7a = mysql_fetch_array($result7a);


if($myrow7a['paquete']=='si'){
 $sSQL7a="SELECT articulos.descripcion,articulosPaquetesPacientes.keyE
FROM
articulosPaquetesPacientes,articulos
WHERE
articulosPaquetesPacientes.keyClientesInternos='".$myrow['keyClientesInternos']."'
and
articulosPaquetesPacientes.codigo=articulos.codigo
  ";
  $result7a=mysql_db_query($basedatos,$sSQL7a);
  $pdf->Ln(3); //salto de linea
while($myrow7a = mysql_fetch_array($result7a)){

//********************CARGA IMPORTE************************
$sSQL7b="SELECT precioPaquete1,ivaPrecioPaquete1,cantidad
FROM
articulosPaquetes
WHERE
keyE='".$myrow7a['keyE']."'
  ";
  $result7b=mysql_db_query($basedatos,$sSQL7b);
  $myrow7b = mysql_fetch_array($result7b);
//*********************CIERRA IMPORTE*********************

$pdf->SetX('15');
$pdf->Cell(0,0,'['.$myrow7b['cantidad'].'] '.$myrow7a['descripcion'],0,0,L);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrow7b['precioPaquete1']*$myrow7b['cantidad'],2),0,0,M);
$pdf->Ln(3); //salto de linea
}
}
//**********************************CIERRA PAQUETES****************************


} //cierra while


$pdf->Ln(10); //salto de linea
$pdf->SetX('160');
$pdf->Cell(0,0,'Totales: '.'$'.number_format($cargos[0],2),0,0,M);
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($abonos[0],2),0,0,M);



$pdf->Ln(20); //salto de linea
//**********************************************************************************************************






















$pdf->SetFont('Arial','',8);


$pdf->Ln(17); //salto de linea

















//**************************************************DEVOLUCIONES SOLAMENTE**************************************
$sSQLe="SELECT sum(precioVenta) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'  
and
tipoPago='Efectivo'
and
statusDevolucion='si'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and 
naturaleza='A'


  ";
  $resulte=mysql_db_query($basedatos,$sSQLe);
  $myrowe = mysql_fetch_array($resulte);


  
  $sSQLe1="SELECT sum(precioVenta) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'  
and
tipoPago='Tarjeta de Credito'
and
statusDevolucion='si'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and 
naturaleza='A'


  ";
  $resulte1=mysql_db_query($basedatos,$sSQLe1);
  $myrowe1 = mysql_fetch_array($resulte1);
  
    $sSQLe2="SELECT sum(precioVenta) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'  
and
tipoPago='Cheque'
and
statusDevolucion='si'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and 
naturaleza='A'


  ";
  $resulte2=mysql_db_query($basedatos,$sSQLe2);
  $myrowe2 = mysql_fetch_array($resulte2);
$devoluciones=  $myrowe['devoluciones']+$myrowe1['devoluciones']+$myrowe2['devoluciones'];
//**********************************CIERRA DEVOLUCIONES***************************************




















//************************************
$sSQLa="SELECT sum(precioVenta) as efectivo
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."' 
and

tipoPago='Efectivo'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."' and
naturaleza='A'




  ";
  $resulta=mysql_db_query($basedatos,$sSQLa);
  $myrowa = mysql_fetch_array($resulta);

$pdf->Cell(0,0,'Efectivo',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($myrowa['efectivo'],2),0,0,M);
//*******************************************************





$pdf->Ln(4); //salto de linea

//************************************
$sSQLb="SELECT sum(precioVenta) as TC
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."' 
and
tipoPago='Tarjeta de Credito'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and
naturaleza='A'


  ";
  $resultb=mysql_db_query($basedatos,$sSQLb);
  $myrowb = mysql_fetch_array($resultb);
  $pdf->Cell(0,0,'Tarjeta de Crédito',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($myrowb['TC'],2),0,0,M);
  //******************************************
  
  
  
  
  

  
$pdf->Ln(4); //salto de linea

//************************************
$sSQLc="SELECT sum(precioVenta) as Cheques 
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."' 
and

tipoPago='Cheque'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and
naturaleza='A'


  ";
  $resultc=mysql_db_query($basedatos,$sSQLc);
  $myrowc = mysql_fetch_array($resultc);
$pdf->Cell(0,0,'Cheques',0,0,M);
$pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($myrowc['Cheques'],2),0,0,M);
//************************************

$pdf->Ln(4); //salto de lineas





//************************************
$sSQLd="SELECT sum(precioVenta) as Transferencia 
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."' 
and

tipoPago='Transferencia Electronica'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and
naturaleza='A'


  ";
  $resultd=mysql_db_query($basedatos,$sSQLd);
  $myrowd = mysql_fetch_array($resultd);
/* $pdf->Cell(0,0,'Transferencia Electrónica',0,0,M);
$pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($myrowd['Transferencia'],2),0,0,M); */
//************************************


$pdf->Ln(6); //saltso de linea
$pdf->Cell(0,0,'SubTotal: ',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($myrowa['efectivo']+$myrowb['TC']+$myrowc['Cheques'],2),0,0,M);
$pdf->Ln(6); //salto de linea




//************************************

$pdf->Cell(0,0,'Devoluciones Efectivo',0,0,M);
$pdf->SetX(90);

if($myrowe['devoluciones']){
$pdf->Cell(0,0,'-$'.number_format($myrowe['devoluciones'],2),0,0,M);
} else {
$pdf->SetX(93);
$pdf->Cell(0,0,'*',0,0,M);
}


$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Tarjeta Crédito',0,0,M);
$pdf->SetX(90);

if($myrowe1['devoluciones']){
$pdf->Cell(0,0,$s2.'-$'.number_format($myrowe1['devoluciones'],2),0,0,M);
} else {
$pdf->SetX(93);
$pdf->Cell(0,0,$s2.'*',0,0,M);
}

$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Cheques',0,0,M);
$pdf->SetX(90);

if($myrowe2['devoluciones']){
$pdf->Cell(0,0,$s3.'-$'.number_format($myrowe2['devoluciones'],2),0,0,M);
}else{
$pdf->SetX(93);
$pdf->Cell(0,0,$s3.'*',0,0,M);
}
//************************************



$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'TOTAL DEPOSITO AL BANCO: ',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format(($myrowa['efectivo']+$myrowb['TC']+$myrowc['Cheques'])-$devoluciones,2),0,0,M);
$pdf->Ln(10); //salto de linea

















































$pdf->Ln(5); //salto de linea
$pdf->Cell(0,0,'RESUMEN DE TRANSACCIONES',0,0,M); //ENCABEZADO


//$pdf->Ln(5); //salto de linea
//$pdf->Cell(0,0,'Total de Pagos: ',0,0,M);
//$pdf->SetX(110);
//$pdf->Cell(0,0,'$'.number_format(($myrowa['efectivo']+$myrowe['devoluciones'])+$myrowb['TC']+$myrowc['Cheques']+$myrowd['Transferencia'],2),0,0,M);
$TOTAL1= $myrowa['efectivo']+$myrowe['devoluciones']+$myrowb['TC']+$myrowc['Cheques']+$myrowd['Transferencia'];



$pdf->Ln(5); //salto de linea
//************************************
$sSQLd="SELECT sum(precioVenta) as TE 
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."' 
and

codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'
and
tipoPago='Transferencia Electronica'
and
naturaleza='A'


  ";
  $resultd=mysql_db_query($basedatos,$sSQLd);
  $myrowd = mysql_fetch_array($resultd);
$pdf->Cell(0,0,'Transferencia Electrónica',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($myrowd['TE'],2),0,0,M);
//************************************


$pdf->Ln(5); //salto de linea


//************************************
$sSQLh="SELECT sum(cantidadAseguradora) as CxC 
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."' 
and
naturaleza='A'
and
tipoPago='Cuentas por Cobrar'
and
codigoCaja='".$_GET['codigoCaja']."' 
and
numCorte='".$_GET['numCorte']."'



  ";
  $resulth=mysql_db_query($basedatos,$sSQLh);
  $myrowh = mysql_fetch_array($resulth);
  $pdf->Cell(0,0,'Traspaso Cuentas por Cobrar',0,0,M);
  $pdf->SetX(110);
  $pdf->Cell(0,0,'$'.number_format($myrowh['CxC'],2),0,0,M);
//**********************************************************


$pdf->Ln(5); //salto de linea
//************************************

/* $pdf->Cell(0,0,'Devoluciones Efectivo',0,0,M);
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($myrowe['devoluciones'],2),0,0,M); */

$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Tarjeta Crédito',0,0,M);
$pdf->SetX(90);
$pdf->Cell(0,0,'-$'.number_format($myrowe['devolucionesE'],2),0,0,M);

$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Devoluciones Cheques',0,0,M);
$pdf->SetX(90);
$pdf->Cell(0,0,'-$'.number_format($myrowe['devolucionesC'],2),0,0,M);
//************************************

$TOTAL=$myrowd['TE']+$myrowh['CxC'];

$pdf->Ln(5); //salto de linea
$pdf->Cell(0,0,'TOTAL DE TRANSACCIONES',0,0,M); //ENCABEZADO
$pdf->SetX(110);
$pdf->Cell(0,0,'$'.number_format($TOTAL,2),0,0,M);
$pdf->Ln(10); //salto de linea


//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
