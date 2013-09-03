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




$sSQL311= "Select  * From clientesInternos WHERE folioVenta='".$_GET['folioVenta']."'";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$paciente=$myrow311['paciente'];
$numeroE=$myrow311['numeroE'];
$nCuenta=$myrow311['nCuenta'];
$keyClientesInternos=$_GET['keyClientesInternos'];



$pdf->SetFont('Arial','B',13);

//establece el encabezado de la empresa
$pdf->SetXY(75,11);
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA S.C. ',0,0,M);

$pdf->SetFont('Arial','I',11);
$pdf->SetXY(54,15);
$pdf->Cell(0,0,'Camino al Vapor #209 Col. Zambrano, Montemorelos N.L.',0,0,M);
$pdf->SetXY(80,19);
$pdf->Cell(0,0,'CP 67500 - Tel. (826)263.3188',0,0,M);

//establece el nombre del paciente
$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,25);
$pdf->Cell(0,0,'Paciente: '.$paciente,0,0,L);




$pdf->SetFont('Arial','',10);
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


//Cajero
$pdf->SetXY(2,41);
if($_GET['cajero']){
$pdf->Cell(0,0,'Cajero: '.$_GET['cajero'],0,0,L);
}
//referencia
$pdf->SetXY(2,45);
$pdf->Cell(0,0,'Referencia: '.$myrow311['folioVenta'],0,0,L);







$pdf->SetXY(2,25);
$pdf->Cell(0,0,'Recibo: '.$myrow311['numRecibo'],0,0,R);





//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(30);
$pdf->Cell(0,0,'Fecha: '.$fecha1,0,0,R);

//Citas
$pdf->SetY(34);
$pdf->Cell(0,0,'Hora Cargo: '.$_GET['fechaSolicitud'],0,0,R);

//Status
if($myrow311['statusPaciente']){
$pdf->SetY(38);
$pdf->Cell(0,0,'Tipo Px: '.$myrow311['statusPaciente'],0,0,R);
}


//Usuario
$pdf->SetY(42);
$pdf->Cell(0,0,'Usuario Autorizo: '.$myrow311['autoriza'],0,0,R);


//Credencial/N�mina 
if($myrow311['credencial']){
$pdf->SetY(45);
$pdf->Cell(0,0,'Credencial/Nomina: '.$myrow311['credencial'],0,0,R);
}





$pdf->SetFont('Arial','',10);
//$pdf->SetXY(2,37);





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





$sSQL3171= "Select * From catTTCaja WHERE banderaPaquete = 'si'";
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


$sSQL40c= "
        SELECT
SUM(precioVenta*cantidad) as suma,SUM(iva*cantidad) as sumaIVA
FROM
cargosCuentaPaciente
WHERE
folioVenta='".$_GET['folioVenta']."'
and
naturaleza='C'
";
$result40c=mysql_db_query($basedatos,$sSQL40c);
$myrow40c = mysql_fetch_array($result40c);


$pdf->SetX('2');
$pdf->Cell(0,0,'1',0,0,L);
$pdf->SetX('7');
$pdf->Cell(0,0,$_GET['codigoPaquete'],0,0,L);
$pdf->Cell(0,0,'$'.number_format($myrow40c['suma'],2),0,0,R);
$pdf->Ln(5); //salto de linea 15 lineas
$pdf->SetX('2');
$pdf->Cell(0,0,'1',0,0,L);






$sSQL= "
        SELECT
*
FROM
cargosCuentaPaciente
WHERE
folioVenta='".$_GET['folioVenta']."'
and
naturaleza='A'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

if($myrow['tipoPago']=='Tarjeta de Credito'){
$descripcion='T.Trans: '.$myrow['tipoPago'].',Banco: '.$myrow['bancoTC'].', CodAut: '.$myrow['codigoAutorizacion'].', U.D�gitos: '.$myrow['ultimosDigitos'];
}else if($myrow['tipoPago']=='Cheque'){
$descripcion='Transacci�n: '.$myrow['tipoPago'].',Banco: '.$myrow['bancoCheque'].', #Cheque: '.$myrow['numeroCheque'];
}else{
$descripcion='Tipo de Pago: '.$myrow['tipoPago'];
}
$pdf->SetX('7');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,$descripcion,0,0,L);
$pdf->Cell(0,0,'-$'.number_format($myrow40c['suma'],2),0,0,R);







//cantidad
$pdf->Ln(2); //salto de linea
$pdf->SetX('2');




$TOTAL[0]=$myrow40c['suma'];
$sumaIVA[0]=$myrow40c['sumaIVA'];








//************cierra pruebas
$pdf->Ln(6); //salto de linea

$pdf->SetX('7');
$pdf->Cell(0,0,"Favor de pasar a �stos Departamentos/M�dicos: ",0,0,L);
$pdf->Ln(5); //salto de linea

 $sSQL= "SELECT almacenDestino
FROM
cargosCuentaPaciente
WHERE 
folioVenta='".$_GET['folioVenta']."'
and
status!='transaccion'
group by almacenDestino order by almacenDestino ASC


 ";
$result=mysql_db_query($basedatos,$sSQL);
while ($myrow = mysql_fetch_array($result)){

$sSQL40= "
        SELECT
descripcion
FROM
almacenes
WHERE
almacen='".$myrow['almacenDestino']."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


$sSQL40a= "
        SELECT
descripcion
FROM
almacenes
WHERE
almacen='".$myrow['almacenDestino']."'

";
$result40a=mysql_db_query($basedatos,$sSQL40a);
$myrow40a = mysql_fetch_array($result40a);


$pdf->SetX('7');
$pdf->Cell(0,0,$myrow40['descripcion'],0,0,L);
$pdf->Ln(5); //salto de linea





}


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea






$centavos=strstr($TOTAL[0],'.');
$centavos=substr($centavos,'1');
$resultado= numerotexto($TOTAL[0]+$sumaIVA[0]); 
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
