<?php require('../js/pdf/fpdf_js.php');


		
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



//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

$pdf=new PDF_AutoPrint();
$pdf->AddPage();





function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}

//aqui estoy
//$_GET['keyClientesInternos']='22822';

$sSQL311= "Select  * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);

$paciente=$myrow311['paciente'];
$numeroE=$myrow311['numeroE'];
$nCuenta=$myrow311['nCuenta'];
$keyClientesInternos=$myrow311['keyClientesInternos'];



$pdf->SetFont('Arial','B',13);

//establece el encabezado de la empresa
$pdf->SetXY(75,11);
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA S.C. ',0,0,M);

$pdf->SetFont('Arial','I',11);
$pdf->SetXY(54,15);
$pdf->Cell(0,0,'Camino al Vapor #209 Col. Zambrano, Montemorelos N.L.',0,0,M);
$pdf->SetXY(80,19);
$pdf->Cell(0,0,'CP 67500 - Tel. (826)263.3188',0,0,M);
$pdf->SetXY(80,25);
$pdf->Cell(0,0,'NOTA DE CREDITO',0,0,M);


//establece el nombre del paciente
$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,35);
if($_GET['paciente']){
$pdf->Cell(0,0,'Cliente: '.$_GET['paciente'],0,0,L);
}
else {
$pdf->Cell(0,0,'Cliente: '.$_GET['cliente'],0,0,L);
}


/* $pdf->SetFont('Arial','',10);
$pdf->SetXY(2,29);
if($myrow311['seguro']){
$sSQL1= "Select nomCliente From clientes WHERE entidad='".$myrow311['entidad']."' AND numCliente = '".$myrow311['seguro']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$pdf->Cell(0,0,'No. Seguro: '.$myrow1['nomCliente'],0,0,L);
} else {
$pdf->Cell(0,0,'Cliente Particular',0,0,L);
} 


//expedientes
if($myrow311['empleado']){
$pdf->SetXY(2,33);
$pdf->Cell(0,0,'Asegurado: '.$myrow311['empleado'],0,0,L);
} else {
$pdf->SetXY(2,33);
$pdf->Cell(0,0,'Asegurado: -',0,0,L);
}

//departamento
$pdf->SetXY(2,37);
$pdf->Cell(0,0,'Expediente: '.$myrow311['numeroE'],0,0,L);
*/



//**********************************
 $sSQL7= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and
random='".$_GET['random']."'
and
numRecibo='".$_GET['numRecibo']."'
and
numCorte='".$_GET['numCorte']."'
and
naturaleza='A'
 ";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);

//**********************************





//Cajero
$pdf->SetXY(2,41);
if($_GET['cajero']){
$pdf->Cell(0,0,'Cajero: '.$_GET['cajero'],0,0,L);
}
//referencia
/* $pdf->SetXY(2,45);
$pdf->Cell(0,0,'Referencia: '.$myrow7['folioVenta'],0,0,L); */







$pdf->SetXY(2,25);
$pdf->Cell(0,0,'Recibo: '.$_GET['numRecibo'],0,0,R);





//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(30);
$pdf->Cell(0,0,'Fecha: '.$fecha1,0,0,R);


//Citas
$pdf->SetY(34);
$pdf->Cell(0,0,'Hora Cargo: '.$_GET['hora1'],0,0,R);


$pdf->SetY(38);
$sSQL1y= "Select * From catCajas WHERE entidad='".$_GET['entidad']."' AND keyCatC = '".$_GET['codigoCaja']."' ";
$result1y=mysql_db_query($basedatos,$sSQL1y);
$myrow1y = mysql_fetch_array($result1y);
$pdf->Cell(0,0,$myrow1y['descripcionCaja'],0,0,R);





//Status

/* $pdf->SetY(42);
$pdf->Cell(0,0,'Tipo Px: '.$myrow7['tipoPaciente'],0,0,R); */



//CAJA



//Credencial/Nómina 
if($myrow311['credencial']){
$pdf->SetXY(80,45);
$pdf->Cell(0,0,'Credencial/Nomina: '.$myrow7['credencial'],0,0,M);
}





$pdf->SetFont('Arial','',10);
//$pdf->SetXY(2,37);




//dibujar una linea
$pdf->Line(3, 47, 199, 47);
//linea divisoria
//$pdf->Line(23, 48, 23, 52);


//etiquetas 
$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,49);
$pdf->Cell(0,0,'C',0,0,L);
$pdf->SetXY(7,49);
$pdf->Cell(0,0,'Descripcion',0,0,L);
$pdf->SetXY(186,49);
$pdf->Cell(0,0,'Importe',0,0,L);

$pdf->Line(3, 51, 199, 51);
//*****************


$pdf->SetFont('Arial','',10);
$pdf->Ln(2); //salto de linea 15 lineas


$sSQL4= "SELECT descripcion
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
numMovimiento='".$_GET['numMovimiento']."'
and
descripcion!=''


 ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$pdf->Ln(4); //salto de linea
$pdf->SetX(7);
$pdf->Cell(0,0,$myrow4['descripcion'],0,0,L);
$pdf->Ln(4); //salto de linea




$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and
numMovimiento='".$_GET['numMovimiento']."'



 ";
$result=mysql_db_query($basedatos,$sSQL);
$registros = mysql_num_rows($result);
while ($myrow = mysql_fetch_array($result)){
$codigoTT=$myrow['tipoTransaccion'];
$flag+=1;

$pdf->Ln(2); //salto de linea





if($myrow['gpoProducto']!=''){
if($myrow['naturaleza']=='C' ){

$cargos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaCargos[0]+=$myrow['iva']*$myrow['cantidad'];

} else if($myrow['naturaleza']=='A'  and $myrow['statusDevolucion']=='si'  ){

$abonos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaAbonos[0]+=$myrow['iva']*$myrow['cantidad'];

}
}



if($myrow['statusDescuento']=='si'){
$totalDescuento[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$descripcionExento="Descuento";
}else if($myrow['statusCortesia']=='si'){ 
$totalCortesia[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$descripcionExento="Cortesia";
} elseif($myrow['statusBeneficencia']=='si'){
$totalBeneficencia[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$descripcionExento="Beneficencia";
}

$codigoTT=$myrow['tipoTransaccion'];


if($myrow['status']!='transaccion'){
$sSQL39= "
	SELECT 
descripcion,codigo,gpoProducto
FROM
articulos
WHERE
entidad='".$_GET['entidad']."'
and
codigo='".$myrow['codProcedimiento']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
}


$sSQL40= "
        SELECT
*
FROM
catTTCaja
WHERE

codigoTT='".$myrow['tipoTransaccion']."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


$sSQL38= "
SELECT 
impresionEspecial,descripcionImpresion
FROM
gpoProductos
WHERE codigoGP='".$myrow39['gpoProducto']."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);



$sSQL12a= "Select medico,descripcion From almacenes WHERE entidad='".$myrow311['entidad']."' AND almacen = '".$myrow['almacenDestino']."' and medico='si'";
$result12a=mysql_db_query($basedatos,$sSQL12a);
$myrow12a = mysql_fetch_array($result12a);

$cos=$myrow['precioVenta']*$myrow['cantidad'];




$imp="$".number_format($importe,2);






$pdf->Ln(2); //salto de linea
$pdf->SetX('7');


if($myrow['tipoTransaccion']!=''){
   $pdf->Cell(0,0,$myrow40['descripcion'],0,0,L); 
   $pdf->Ln(4); //salto de linea
$pdf->SetX('7');
   $pdf->Cell(0,0,'Mov '.$myrow['keyCAP'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,L);
$pdf->Ln(4); //salto de linea
$pdf->SetX('7');
$pdf->Cell(0,0,'Mov '.$myrow['keyCAP'],0,0,L);
}









//cantidad
$pdf->SetX('2');
$pdf->Cell(0,0,trim(round($myrow['cantidad'],3)),0,0,L);



$pdf->SetX('2');
//esta mal este precioVenta


$pdf->Cell(0,0,$signo.'$ '.number_format($myrow['precioVenta']*$myrow['cantidad'],2),0,0,R);

$t[0]+=$myrow['precioVenta']*$myrow['cantidad'];

//echo '<br>'.$myrow['precioVenta']*$myrow['cantidad'];



//************cierra pruebas


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

} //cierra while


$TOTAL=$t[0];

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


//linea de abajo

if($registros<9){
$pdf->Line(2, 117, 199, 117);


//**********************************************SIGNATURE******
if($myrow311['seguro'] || $myrow311['statusCortesia'] || $myrow311['statusBeneficencia']){

//echo $myrow311['observaciones'];


if($myrow311['observaciones']){
$pdf->SetXY(5,100);
$pdf->Cell(0,0,'Observaciones: ',0,0,L);
$pdf->Ln(3); //salto de linea
$pdf->SetX(5);
$pdf->Cell(0,0,$myrow311['observaciones'],0,0,L);
}



$pdf->SetXY(80,110);
$pdf->Cell(0,0,'FIRMA ',0,0,L);


//$pdf->Ln(3); //salto de linea


$pdf->Line('93', 111, '140',111 ) ;
}
//**************************************************************

//*******************>
$pdf->SetFont('Arial','',10);
$pdf->SetY($Y);




$pdf->Cell(0,0,"Subtotal: "."$ ".number_format($t[0],2),0,0,R);




$pdf->SetY($Y+5);
$pdf->Cell(0,0,"Iva: "."$ ".number_format($ivaCargos[0]-$ivaAbonos[0],2),0,0,R);


$pdf->SetY($Y+10);
$pdf->Cell(0,0,"Total: "."$ ".number_format($t[0],2),0,0,R);



$pdf->SetFont('Arial','',10);

$pdf->SetXY(2,120);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);

$pdf->SetXY(2,$Y+10);
$pdf->Cell(0,0,'Este documento no es deducible fiscalmente',0,0,L);


//Launch the print dialog
$pdf->AutoPrint(false);
$pdf->Output();

} else {
$pdf->Ln(10); //salto de linea
//$pdf->Line(2,5, 199,5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Subtotal: "."$".number_format($t[0],2),0,0,R);
$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,"Iva: "."$".number_format($ivaCargos[0]-$ivaAbonos[0],2),0,0,R);



$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,"Total: "."$".number_format($t[0],2),0,0,R);
$pdf->SetFont('Arial','',10);
$pdf->SetX(2);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);
$pdf->SetX(2);
$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,'Este documento no es deducible fiscalmente',0,0,L);
//**********************************************SIGNATURE******
/*
if($myrow311['seguro']){
$pdf->SetXY(80,$Y+10);
$pdf->Cell(0,0,'FIRMA ',0,0,L);
$pdf->Line('93', $Y+11, '140',$Y+11 ) ;
}*/
//**************************************************************

//Launch the print dialog

$pdf->AutoPrint(false);
$pdf->Output();
}
?>
