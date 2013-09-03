<?php include('/var/www/html/sima/js/pdf/fpdf_js.php');
		
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




$sSQL311= "Select  * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$paciente=$myrow311['paciente'];
$numeroE=$myrow311['numeroE'];
$nCuenta=$myrow311['nCuenta'];
$keyClientesInternos=$myrow311['keyClientesInternos'];



$pdf->SetFont('Arial','',12);

//establece el encabezado de la empresa
$pdf->SetXY(80,13);
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA S.C. ',0,0,M);

$pdf->SetFont('Arial','',8);
$pdf->SetXY(65,17);
$pdf->Cell(0,0,'Camino al Vapor #201 Col. Zambrano, CP 67500, Montemorelos N.L.',0,0,M);
$pdf->SetXY(90,20);
$pdf->Cell(0,0,'Tel. (826)263-3188',0,0,M);

//establece el nombre del paciente
$pdf->SetFont('Arial','',10);
$pdf->SetXY(22,25);
$pdf->Cell(0,0,'Paciente: '.$paciente,0,0,L);


$pdf->SetXY(22,29);
if($myrow311['seguro']){
$sSQL1= "Select nomCliente From clientes WHERE entidad='".$myrow311['entidad']."' AND numCliente = '".$myrow311['seguro']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$pdf->Cell(0,0,'No. Seguro: '.$myrow1['nomCliente'],0,0,L);
} else {
$pdf->Cell(0,0,'Particular',0,0,L);
}


//expediente
$pdf->SetXY(22,33);
$pdf->Cell(0,0,'Expediente: '.$myrow311['numeroE'],0,0,L);


//departamento
$pdf->SetXY(22,37);
$sSQL12= "Select medico,descripcion From almacenes WHERE entidad='".$myrow311['entidad']."' AND almacen = '".$myrow311['almacenSolicitud']."' ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

if($myrow12['medico']=='si'){

$pdf->Cell(0,0,'Medico: '.$myrow12['descripcion'],0,0,L);
} else {

$pdf->Cell(0,0,'Departamento: '.$myrow311['almacen'],0,0,L);
}


//usuario
$pdf->SetXY(22,41);
$pdf->Cell(0,0,'Cajero: '.$_GET['usuario'],0,0,L);





//numero de paciente
$pdf->SetXY(300,25);
$pdf->Cell(0,0,'Folio: '.$myrow311['folioVenta'],0,0,R);

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(29);
$pdf->Cell(0,0,'Fecha: '.$fecha1,0,0,R);
//Imprimo con salto de pagina
$pdf->Ln(25); //salto de linea



$pdf->SetFont('Arial','',10);
$pdf->SetXY(30,37);




//dibujar una linea
$pdf->Line(23, 48, 200, 48);
//linea divisoria
//$pdf->Line(23, 48, 23, 52);


//etiquetas 
$pdf->SetFont('Arial','',8);
$pdf->SetXY(23,50);
$pdf->Cell(0,0,'Cantidad',0,0,L);
$pdf->SetXY(40,50);
$pdf->Cell(0,0,'Descripcion',0,0,L);
$pdf->SetXY(186,50);
$pdf->Cell(0,0,'Importe',0,0,L);

$pdf->Line(23, 52, 200, 52);
//*****************

$pdf->Ln(5); //salto de linea 15 lineas
$pdf->SetFont('Arial','',10);





$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 

keyClientesInternos='".$_GET['keyClientesInternos']."'
and
random='".$_GET['random']."'


 ";
$result=mysql_db_query($basedatos,$sSQL);
while ($myrow = mysql_fetch_array($result)){
$codigoTT=$myrow['tipoTransaccion'];
$keyCAP=$myrow['keyCAP'];
	$q = "UPDATE cargosCuentaPaciente set 
statusImpresion='impreso'

WHERE keyCAP='".$keyCAP."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$a+=1;

$pdf->Ln(3); //salto de linea

$sumaIVA[0]+=$myrow['iva']*$myrow['cantidad'];




if($myrow['status']=='transaccion'){
if($myrow['naturaleza']!='-'){
$importe2[0]+=$myrow['precioVenta']*$myrow['cantidad'];
} 
}


$codigoTT=$myrow['tipoTransaccion'];

$sSQL39= "
	SELECT 
descripcion,codigo,gpoProducto
FROM
articulos
WHERE codigo='".$myrow['codProcedimiento']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);



$sSQL40= "
        SELECT
*
FROM
catTTCaja
WHERE codigoTT='".$codigoTT."'";
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





$cos="$".number_format(($myrow['precioVenta']*$myrow['cantidad'])+$sumaIVA[0],2);




$imp="$".number_format($importe,2);





if($codigoTT and $myrow['status']=='transaccion'){
//es una transaccion
$descripcion=$myrow40['descripcion'];
$pdf->SetX('40');
$pdf->Cell(0,0,trim($descripcion),0,0,L);

} else {

if($myrow38['impresionEspecial']=='si'){
$descripcion=$myrow38['descripcionImpresion'];
$pdf->SetX('40');
$pdf->Cell(0,0,trim($descripcion),0,0,L);
$pdf->Ln(2); //salto de linea

$pdf->Ln(3); //salto de linea
$pdf->SetX('40');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,$myrow39['descripcion'],0,0,L);
} else { 
$pdf->SetX('40');
$pdf->Cell(0,0,$myrow39['descripcion'],0,0,L);

}
}//es una transaccion





//cantidad
$pdf->SetX('27');
$pdf->Cell(0,0,trim($myrow['cantidad']),0,0,L);



$pdf->SetX('140');
//esta mal este precioVenta

if($myrow['naturaleza']=='A'){
$signo='-';
} else {
$signo='';
}



$pdf->Cell(0,0,$signo.$cos,0,0,R);

//************cierra pruebas


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

} //cierra while

//echo $TOTAL=$importe2[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$TOTAL=$importe2[0];
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
$pdf->Line(23, 115, 200, 115);


$pdf->SetFont('Arial','',10);
$pdf->SetY($Y);






$pdf->Cell(0,0,"Subtotal: "."$".number_format($importe2[0],2),0,0,R);




$pdf->SetY($Y+5);
$pdf->Cell(0,0,"Iva: "."$".number_format($sumaIVA[0],2),0,0,R);
$pdf->SetY($Y+10);
$pdf->Cell(0,0,"Total: "."$".number_format($importe2[0]+$sumaIVA[0],2),0,0,R);



$pdf->SetXY(22,120);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);
$pdf->SetXY(35,$Y+10);
$pdf->Cell(0,0,'Este documento no es deducible fiscalmente',0,0,L);
//Launch the print dialog
$pdf->AutoPrint(false);
$pdf->Output();

?>
