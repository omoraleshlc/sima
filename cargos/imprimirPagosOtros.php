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






$conexion=mysql_connect("localhost","omorales","wolf3333");
$basedatos="sima";


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


//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQLC= "Select * From statusCaja where entidad='".$_GET['entidad']."' and usuario='".$_GET['usuario']."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$q = "UPDATE statusCaja set 
numRecibo= numRecibo+1
where
entidad='".$_GET['entidad']."'
and
keyCatC='".$myrowC['keyCatC']."'
and
status='abierta'
order by keySTC DESC ";

//mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQLC= "Select * From statusCaja where entidad='".$_GET['entidad']."' and usuario='".$_GET['usuario']."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$q0 = "UPDATE clientesInternos,cargosCuentaPaciente set 
clientesInternos.folioVenta='".$myrow311['folioVenta']."',
cargosCuentaPaciente.folioVenta='".$myrow311['folioVenta']."',
clientesInternos.numRecibo= '".$myrowC['numRecibo']."',
cargosCuentaPaciente.numRecibo= '".$myrowC['numRecibo']."'
where
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos
and
clientesInternos.keyClientesInternos='".$_GET['keyClientesInternos']."'
";

//mysql_db_query($basedatos,$q0);
echo mysql_error();
//*************************************************************



$pdf->SetFont('Arial','B',13);

//establece el encabezado de la empresa
$pdf->SetXY(75,9);
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA S.C. ',0,0,M);

$pdf->SetFont('Arial','I',9);
$pdf->SetXY(65,13);
$pdf->Cell(0,0,'Camino al Vapor #209 Col. Zambrano, Montemorelos N.L.',0,0,M);
$pdf->SetXY(84,17);
$pdf->Cell(0,0,'CP 67500, Tel.(826)263.3188',0,0,M);

//establece el nombre del paciente
$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,25);
/* $pdf->Cell(0,0,'Paciente: '.$paciente,0,0,L); */



$sSQL317= "Select nomCliente From clientes WHERE numCliente = '".$myrow311['seguro']."'";
$result317=mysql_db_query($basedatos,$sSQL317);
$myrow317 = mysql_fetch_array($result317);	





//Compañia


$pdf->SetXY(2,33);
$pdf->Cell(0,0,'Cliente: '.$myrow317['nomCliente'],0,0,L);


//departamento
$pdf->SetXY(2,37);
$sSQL12= "Select medico,descripcion From almacenes WHERE entidad='".$myrow311['entidad']."' AND almacen = '".$myrow311['almacenSolicitud']."' ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);


$pdf->Cell(0,0,'Departamento: '.$myrow311['almacen'],0,0,L);



//usuario
$pdf->SetXY(2,41);
$pdf->Cell(0,0,'Usuario: '.$_GET['cajero'],0,0,L);

//REFERENCIA
$pdf->SetXY(2,45);
$pdf->Cell(0,0,'Referencia: '.$myrow311['folioVenta'],0,0,L);




//numero de paciente
$pdf->SetXY(302,25);
$pdf->Cell(0,0,'Folio: '.$myrowC['numRecibo'],0,0,R);

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(40);
$pdf->Cell(0,0,'Fecha: '.$fecha1,0,0,R);
//Imprimo con salto de pagina
$pdf->Ln(25); //salto de linea



$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,37);




//dibujar una linea
$pdf->Line(2, 48, 200, 48);
//linea divisoria
//$pdf->Line(23, 48, 23, 52);


//etiquetas 
$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,50);
$pdf->Cell(0,0,'C',0,0,L);
$pdf->SetXY(7,50);
$pdf->Cell(0,0,'Descripcion',0,0,L);
$pdf->SetXY(183,50);
$pdf->Cell(0,0,'Importe',0,0,L);

$pdf->Line(2, 52, 200, 52);
//*****************

$pdf->Ln(5); //salto de linea 15 lineas
$pdf->SetFont('Arial','',10);





$sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 

keyClientesInternos='".$myrow311['keyClientesInternos']."'


 ";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ //aqui estaba el while
$codigoTT=$myrow['tipoTransaccion'];


$pdf->Ln(2); //salto de linea




$sSQL3171= "Select * From catTTCaja WHERE banderaAbono = 'si'";
$result3171=mysql_db_query($basedatos,$sSQL3171);
$myrow3171 = mysql_fetch_array($result3171);




$codigoTT=$myrow3171['codigoTT'];
$sSQL40= "
SELECT
*
FROM
catTTCaja
WHERE codigoTT='".$codigoTT."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);









//cantidad
$pdf->Ln(2); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,trim($myrow['cantidad']),0,0,L);

if($myrow['naturaleza']=='A'){

$pdf->Cell(0,0,'-$'.number_format($myrow['precioVenta'],2),0,0,R);

}else{

$TOTAL[0]+=$myrow['precioVenta'];
$sumaIVA[0]+=$myrow['iva'];
$pdf->Cell(0,0,'$'.number_format($myrow['precioVenta'],2),0,0,R);
}



if($myrow['tipoPago']=='Tarjeta de Credito'){
$descripcion='T.Trans: '.$myrow['tipoPago'].',Banco: '.$myrow['bancoTC'].', CodAut: '.$myrow['codigoAutorizacion'].', U.Dígitos: '.$myrow['ultimosDigitos'];
}else if($myrow['tipoPago']=='Cheque'){
$descripcion='Transacción: '.$myrow['tipoPago'].',Banco: '.$myrow['bancoCheque'].', #Cheque: '.$myrow['numeroCheque'];
}else if($myrow['tipoPago']=='Transferencia Electronica'){
$descripcion='Transacción: ['.$myrow['tipoPago'].'], Banco: '.$myrow['bancoTransferencia'].', #'.$myrow['numeroTransferencia'];

}else {
$descripcion='Tipo de Pago: '.$myrow['tipoPago'];
}
$pdf->SetX('7');
$pdf->SetFont('Arial','',10);

if($myrow['naturaleza']=='A'){
$pdf->Cell(0,0,$descripcion,0,0,L);
}else{
$pdf->Cell(0,0,$myrow['descripcion'],0,0,L);
}















//************cierra pruebas


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

} //cierra while




$centavos=strstr($TOTAL[0],'.');
$centavos=substr($centavos,'1');
$resultado= numerotexto($TOTAL[0]); 
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
$pdf->Line(2, 115, 200, 115);


$pdf->SetFont('Arial','',10);
$pdf->SetY($Y);




$pdf->Cell(0,0,"Subtotal: "."$".number_format($TOTAL[0],2),0,0,R);




$pdf->SetY($Y+5);
$pdf->Cell(0,0,"Iva: "."$".number_format($sumaIVA[0],2),0,0,R);
$pdf->SetY($Y+10);
$pdf->Cell(0,0,"Total: "."$".number_format($TOTAL[0]+$sumaIVA[0],2),0,0,R);


$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,120);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);
$pdf->SetXY(2,$Y+10);
$pdf->Cell(0,0,'Este documento no es deducible fiscalmente',0,0,L);
//Launch the print dialog
$pdf->AutoPrint(false);
$pdf->Output();

?>
