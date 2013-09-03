<?php include('/var/www/html/sima/js/pdf/fpdf_js.php');
		$entidad='01';
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
$usuario=$myrow311['usuario'];
$keyClientesInternos=$myrow311['keyClientesInternos'];



$pdf->SetFont('Arial','',8);

//establece el encabezado de la empresa
$pdf->SetXY(80,13);
//$pdf->Cell(0,0,$sSQL311,0,0,M);

$pdf->SetFont('Arial','',8);
$pdf->SetXY(65,17);
//$pdf->Cell(0,0,'Camino al Vapor #201 Col. Zambrano, CP 67500, Montemorelos N.L.',0,0,M);
$pdf->SetXY(90,20);
//$pdf->Cell(0,0,'Tel. (826)263-3188',0,0,M);

//establece el nombre del paciente
$pdf->SetFont('Arial','',8);








$sSQL455= "Select * from clientes where entidad='".$_GET['entidad']."' and numCliente='".$_GET['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);



$sSQL455= "Select * from clientes where entidad='".$_GET['entidad']."' and numCliente='".$myrow455['clientePrincipal']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$razonSocial=$myrow455['razonSocial'];
$nombreCliente=$myrow455['nomCliente'];


$pdf->SetXY(22,31);
if($_GET['razonSocial']){ 
$pdf->Cell(0,0,$_GET['razonSocial'],0,0,L);
}else{
if($razonSocial){
$pdf->Cell(0,0,$razonSocial,0,0,L);
} else {
$pdf->Cell(0,0,$nombreCliente,0,L);
}
}

//expediente
$pdf->SetXY(22,36);
if($_GET['calle']){ 
$pdf->Cell(0,0,$_GET['calle'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['calle'],0,0,L);
}

//departamento
$pdf->SetXY(90,36);
if($_GET['colonia']){ 
$pdf->Cell(0,0,$_GET['colonia'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['colonia'],0,0,L);
}


//usuario
$pdf->SetXY(22,40);
if($_GET['ciudad']){ 
$pdf->Cell(0,0,$_GET['ciudad'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['ciudad'],0,0,L);
}

$pdf->SetXY(60,43);
if($_GET['delegacion']){ 
$pdf->Cell(0,0,$_GET['delegacion'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['delegacion'],0,0,L);
}



$pdf->SetXY(22,43);
if($_GET['cp']){ 
$pdf->Cell(0,0,$_GET['cp'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['cp'],0,0,L);
}



$pdf->SetXY(22,46);
if($_GET['estado']){ 
$pdf->Cell(0,0,$_GET['estado'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['estado'],0,0,L);
}


$pdf->SetXY(60,46);
if($_GET['pais']){
$pdf->Cell(0,0,$_GET['pais'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['pais'],0,0,L);
}


$pdf->SetXY(22,49);
if($_GET['rfc']){
$pdf->Cell(0,0,$_GET['rfc'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['rfc'],0,0,L);
}



$pdf->SetXY(29,62);
if($_GET['paciente']){
$pdf->Cell(0,0,$_GET['paciente'],0,0,L);
}else{
//$pdf->Cell(0,0,$myrow311['paciente'],0,0,L);
}






if($_GET['siniestro']){
$pdf->SetXY(100,65);
$pdf->Cell(0,0,$_GET['siniestro'],0,0,L);
}

if($_GET['credencial']){
$pdf->SetXY(29,65);
$pdf->Cell(0,0,$_GET['credencial'],0,0,L);
}


//$pdf->SetXY(100,50);
//$pdf->Cell(0,0,"N° Folio: ".$myrow311['folioVenta'],0,0,L);

//numero de paciente
$pdf->SetXY(50,44);
//$pdf->Cell(0,0,$_GET['folioFactura'],0,0,R);
$pdf->SetY(45);
$pdf->Cell(0,0,"Fact N°: ".$_GET['folioFactura'],0,0,R);

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
if($_GET['fechaImpresion']){
$fecha1=$_GET['fechaImpresion'];
}else{
$fecha1=date("d    m    Y");
}
$pdf->SetXY(50,50);
$pdf->Cell(0,0,$fecha1,0,0,R);
//Imprimo con salto de pagina
$pdf->Ln(25); //salto de linea



$pdf->SetFont('Arial','',10);
$pdf->SetXY(30,37);




//dibujar una linea
//$pdf->Line(23, 48, 200, 48);
//linea divisoria
//$pdf->Line(23, 48, 23, 52);


//etiquetas 


$pdf->SetXY(50,87);

$pdf->SetFont('Arial','',8);


//********************SON FACTURAS GLOBALES?********************
$sSQL1p= "Select * From facturacionGlobal WHERE entidad='".$_GET['entidad']."' AND clientePrincipal = '".$_GET['seguro']."' ";
$result1p=mysql_db_query($basedatos,$sSQL1p);
$myrow1p = mysql_fetch_array($result1p);
$cantidad=$myrow1p['cantidad'];



$sSQL7k="SELECT SUM(precioVenta*cantidad)+sum(iva*cantidad) as totalFG 
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioFactura='".$_GET['folioFactura']."'";
 
  $result7k=mysql_db_query($basedatos,$sSQL7k);
  $myrow7k = mysql_fetch_array($result7k);
$FG=$myrow7k['totalFG'];

if($cantidad>$FG){
$porcentaje=($cantidad/$FG);
}else{
$porcentaje=$FG;
}
//*******************CIERRO FACTURAS GLOBALES******************



$sSQL= "
SELECT * FROM cargosCuentaPaciente
WHERE 
folioFactura='".$_GET['folioFactura']."'
and
naturaleza='C'
and
tipoCliente='aseguradora'
and
statusDevolucion!='si'
group by gpoProducto
order by gpoProducto
 ";
$result=mysql_db_query($basedatos,$sSQL);
while ($myrow = mysql_fetch_array($result)){
$codigoTT=$myrow['tipoTransaccion'];

$C=$myrow['gpoProducto'];
$pdf->Ln(3); //salto de linea



$sSQL38= "
SELECT 
tasaGP,descripcionGP,separadoAlmacen,impresionFactura,descripcionImpresion
FROM
gpoProductos
WHERE codigoGP='".$C."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);

//*******************MOVIMIENTOS
if($C){
  $sSQL7="SELECT SUM(cantidadAseguradora*cantidad) as acumulado,SUM(ivaAseguradora*cantidad) as sumaIVA
  FROM
  cargosCuentaPaciente
  WHERE

  folioFactura='".$_GET['folioFactura']."'
  and
  gpoProducto='".$C."'
  and
  tipoCliente='aseguradora'
  and 
  naturaleza='C'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
  $sSQL38d= "
  SELECT 
  porcentajeFacturacion
  FROM
  facturasAplicadas
  WHERE folioVenta='".$das."'";
  $result38d=mysql_db_query($basedatos,$sSQL38d);
  $myrow38d = mysql_fetch_array($result38d);
  
  $importe2[0]+=($myrow7['acumulado']*$porcentaje);
  $sumaIVAS[0]+=($myrow7['sumaIVA']*$porcentaje);
  
  




if($myrow38['impresionFactura']!='si'){
  $pdf->SetX('22');
  $pdf->Cell(0,0,$myrow38['descripcionGP'],0,0,L);
}


//*********************************************************** especial
if($myrow38['impresionFactura']=='si'){
//$pdf->Ln(4); //salto de linea
$sSQLy= "
SELECT almacenDestino from cargosCuentaPaciente
where
folioVenta='".$myrow['folioVenta']."'
and
gpoProducto='".$myrow['gpoProducto']."'
group by almacenDestino
";
$resulty=mysql_db_query($basedatos,$sSQLy);
$r=34;
$pdf->SetX(22);
//$pdf->Cell(0,0,'Departamentos: ',0,0,L);

while($myrowy = mysql_fetch_array($resulty)){
$s+=10;
$sSQL7j="SELECT SUM(cantidadAseguradora*cantidad) as acumulado
FROM
cargosCuentaPaciente
WHERE
folioVenta='".$myrow['folioVenta']."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
almacenDestino='".$myrowy['almacenDestino']."'
and 
folioFactura='".$_GET['folioFactura']."'
"; 
  $result7j=mysql_db_query($basedatos,$sSQL7j);
  $myrow7j = mysql_fetch_array($result7j);
  
if($myrowy['almacenDestino']){
$sSQL38e1= "
SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$_GET['entidad']."'
and
almacen='".$myrowy['almacenDestino']."'";
$result38e1=mysql_db_query($basedatos,$sSQL38e1);
$myrow38e1 = mysql_fetch_array($result38e1);

$pdf->SetX($r+$s);
//$pdf->Ln(3); //salto de linea
$pdf->SetX(22);
$pdf->Cell(0,0,$myrow38['descripcionImpresion'],0,0,L);
$pdf->Ln(3); //salto de linea
$pdf->SetX(22);
$pdf->Cell(0,0,$myrow38e1['descripcion'],0,0,L);
$pdf->SetX('185');
$pdf->Cell(0,0,'$'.number_format($myrow7j['acumulado']*$porcentaje,2),0,0,R);
$pdf->Ln(3); //salto de linea
}
}
}
//*********************************************************





$pdf->SetX('185');
if($myrow7['acumulado'] and $myrow38['impresionFactura']!='si'){

$pdf->Cell(0,0,'$'.number_format($myrow7['acumulado']*$porcentaje,2),0,0,R);
} else {
$pdf->Cell(0,0,' ',0,0,R);
}



//********************************************************
$myrow7['acumulado']*=$porcentaje;

$sSQL38a= "
SELECT codTASA FROM TASA WHERE codTASA>0";
$result38a=mysql_db_query($basedatos,$sSQL38a);
$myrow38a = mysql_fetch_array($result38a);

if($myrow38['tasaGP']=='0'){
$tasaCero[0]+=($myrow7['acumulado']);
} else if($myrow38['tasaGP']>0){
$gravado=$myrow38['tasaGP'];
$tasaIVA[0]+=($myrow7['acumulado']);
$sumaIVA[0]+=($myrow['sumaIVA']);
} else if($myrow38['tasaGP']=='E'){
$tasaExento[0]+=($myrow7['acumulado']);
}
//*********************************************************






$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea
}




//checo si trae coasesguro


} //cierra while









//***********************************************************
$sSQL7f="SELECT keyCAP
FROM
cargosCuentaPaciente
WHERE
folioFactura='".$_GET['folioFactura']."'
and
naturaleza='A'
and
tipoCliente='coaseguro'
  ";
 
  $result7f=mysql_db_query($basedatos,$sSQL7f);
  $myrow7f = mysql_fetch_array($result7f);
 
 if($myrow7f['keyCAP']){ 
$pdf->Ln(4); //salto de linea
$sSQL8= "
SELECT *
FROM
cargosCuentaPaciente
WHERE
folioFactura='".$_GET['folioFactura']."'
and
naturaleza='A'
and
tipoCliente='coaseguro'
";
$result8=mysql_db_query($basedatos,$sSQL8);

//$pdf->SetX(22);
//$pdf->Cell(0,0,'COASEGURO ',0,0,L);

while($myrow8 = mysql_fetch_array($result8)){


$sSQL7f1="SELECT sum(precioVenta*cantidad) as coaseguro
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$myrow8['keyCAP']."'
  ";
 
  $result7f1=mysql_db_query($basedatos,$sSQL7f1);
  $myrow7f1 = mysql_fetch_array($result7f1);

  //**************TIPO ACCION***************//
$sSQL40d= "
        SELECT
tipoAccion
FROM
catTTCaja
WHERE codigoTT='".$myrow8['tipoTransaccion']."'";
$result40d=mysql_db_query($basedatos,$sSQL40d);
$myrow40d = mysql_fetch_array($result40d);
$tipoAccion[0]=$myrow40d['tipoAccion'];
//*****************************************//
//$pdf->Ln(3); //salto de linea
$sumaCoaseguro[0]+=$myrow7f1['coaseguro'];
$pdf->SetX(22);
$pdf->Cell(0,0,'('.$tipoAccion[0].')',0,0,L);
$pdf->SetX('185');
$pdf->Cell(0,0, '-$'.number_format($myrow7f1['coaseguro'],2),0,0,R);
$pdf->Ln(2); //salto de linea
$coaseguro[0]+=$myrow7f1['coaseguro'];
}
}


/*if($tipoAccion[0]){
$pdf->SetX(22);
$pdf->Cell(0,0,'('.$tipoAccion[0].')',0,0,L);
$pdf->SetX('185');
$pdf->Cell(0,0,'-$'.number_format($sumaCoaseguro[0],2),0,0,L);
}*/
//****importe 2 - coaseguro

$importe2[0]=$importe2[0]-$coaseguro[0];
//*****************************************************



$pdf->Ln(4); //salto de linea
$sSQL= "
SELECT folioVenta
FROM
facturasAplicadas
WHERE
numFactura='".$_GET['folioFactura']."'

 ";
$result=mysql_db_query($basedatos,$sSQL);
$r=34;
$pdf->SetX(22);
$pdf->Cell(0,0,'Folios de Venta: ',0,0,L);

while($myrow = mysql_fetch_array($result)){
$s+=10;

if($FV!=$myrow['folioVenta'] and $s>1){
$sSQL38e= "
SELECT 
paciente
FROM
clientesInternos
WHERE folioVenta='".$myrow['folioVenta']."'";
$result38e=mysql_db_query($basedatos,$sSQL38e);
$myrow38e = mysql_fetch_array($result38e);

$pdf->SetX($r+$s);
$pdf->Ln(3); //salto de linea
$pdf->SetX(22);
$pdf->Cell(0,0,$myrow['folioVenta'].', '.$myrow38e['paciente'],0,0,L);
$pdf->Ln(2); //salto de linea
$FV=$myrow['folioVenta'];
}
}









$pdf->Ln(2); //salto de linea

$sSQL= "
SELECT folioVenta
FROM
facturasAplicadas
WHERE
numFactura='".$_GET['folioFactura']."'

 ";
$result=mysql_db_query($basedatos,$sSQL);
$r=34;
$pdf->SetX(22);
//$pdf->Cell(0,0,'Folios de Venta: ',0,0,L);
while($myrow = mysql_fetch_array($result)){
$s+=10;

if($FV!=$myrow['folioVenta']){
$sSQL38e= "
SELECT 
paciente
FROM
clientesInternos
WHERE folioVenta='".$myrow['folioVenta']."'";
$result38e=mysql_db_query($basedatos,$sSQL38e);
$myrow38e = mysql_fetch_array($result38e);

$pdf->SetX($r+$s);
$pdf->Ln(3); //salto de linea
$pdf->SetX(22);
$pdf->Cell(0,0,$myrow['folioVenta'].', '.$myrow38e['paciente'],0,0,L);
$pdf->Ln(2); //salto de linea
$FV=$myrow['folioVenta'];
}
}








//linea de abajo
//$pdf->Line(23, 115, 200, 115);
//***************************************FOOTER*************************************
//*tasa
$pdf->SetFont('Arial','',10);
$pdf->SetXY(10,225);
$pdf->Cell(0,0,'Tasa al 0% '."$".number_format($tasaCero[0],2),0,0,M);
$pdf->SetXY(10,229);
$pdf->Cell(0,0,'Tasa al '.$myrow38a['codTASA'].'% '."$".number_format($tasaIVA[0],2),0,0,M);
$pdf->SetXY(10,233);
$pdf->Cell(0,0,'Tasa Exento '."$".number_format($tasaExento[0],2),0,0,M);



//*****************************************************************


//**************************************
$sSQL38a= "
SELECT valorTasa FROM TASA WHERE codTASA>0";
$result38a=mysql_db_query($basedatos,$sSQL38a);
$myrow38a = mysql_fetch_array($result38a);
$sumaIVAS[0]=$tasaIVA[0]*($myrow38a['valorTasa']*0.01);

//**************************************




//echo $coaseguro[0];*******************

$sSQL7u="SELECT SUM(cantidadAseguradora*cantidad) as acumulado,SUM(ivaAseguradora*cantidad) as sumaIVA
FROM
cargosCuentaPaciente
WHERE

folioFactura='".$_GET['folioFactura']."'
and
tipoCliente='aseguradora'
and 
naturaleza='C'
";
 
  $result7u=mysql_db_query($basedatos,$sSQL7u);
  $myrow7u = mysql_fetch_array($result7u);
  $sumaIVAS1[0]=$sumaIVAS[0];
  $sumaIVAS[0]=$myrow7u['sumaIVA'];



$totalF=$tasaCero[0]+$tasaIVA[0]+$tasaExento[0]+$sumaIVAS[0];

$totalF1=($tasaIVA[0]*$coaseguro[0])/$totalF;

$totalCoaseguro= $totalF1*($gravado*'0.01');





if($totalCoaseguro){
$pdf->SetXY(10,237);
$pdf->Cell(0,0,"(IVA ".$tipoAccion[0]."  $".number_format($totalCoaseguro,2).' )',0,0,M);
}
//*******************************************************************

$pdf->SetFont('Arial','',10);
$pdf->SetXY(1,224);
$pdf->Cell(0,0,"$".number_format($importe2[0],2),0,0,R);

$pdf->SetXY(1,233);
$pdf->Cell(0,0,"$".number_format($sumaIVAS1[0],2),0,0,R);

$pdf->SetXY(1,242);
$sumaTotales=$importe2[0]+$sumaIVAS1[0];
$TOTAL=round($importe2[0]+$sumaIVAS1[0],2);
$pdf->Cell(0,0,"$".number_format($TOTAL,2),0,0,R);

//********************************DESPLEGADO NUMEROS*****************************

$centavos=strstr(number_format($TOTAL,2),'.');
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

//*******************************************************************************

$pdf->SetXY(22,242);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);
//$pdf->SetXY(35,245);
//$pdf->Cell(0,0,'Este documento no es deducible fiscalmente',0,0,L);





//Launch the print dialog
$pdf->AutoPrint(false);
$pdf->Output();

?><!--MMDW 1 -->
<!-- MMDW:success -->