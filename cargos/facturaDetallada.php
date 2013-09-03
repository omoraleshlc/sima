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




$sSQL311= "Select  * From clientesInternos WHERE folioVenta='".$_GET['folioVenta']."'";
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



if($_GET['rfc']){
$sSQL455= "Select * from RFC where rfc='".$_GET['rfc']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
}else{
$sSQL455= "Select * from clientes where entidad='".$_GET['entidad']."' and numCliente='".$_GET['seguro']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
}

$razonSocial1=$myrow455['razonSocial1'];
$razonSocial=$myrow455['razonSocial'];
$nombreCliente=$myrow455['nomCliente'];


$pdf->SetXY(28,27);
if($_GET['razonSocial']){ 
$pdf->Cell(0,0,$_GET['razonSocial'],0,0,L);
}else{
if($razonSocial){

if($razonSocial1){
$pdf->Cell(0,0,$razonSocial,0,0,L);
$pdf->Ln(3); //salto de linea
$pdf->SetXY(28,30);
$pdf->Cell(0,0,$razonSocial1,0,0,L);
}else{
$pdf->Cell(0,0,$razonSocial,0,0,L);
}


} else {
$pdf->Cell(0,0,$nombreCliente,0,L);
}
}

//expediente
$pdf->SetXY(22,34);
if($_GET['calle']){ 
$pdf->Cell(0,0,$_GET['calle'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['calle'],0,0,L);
}

//departamento
$pdf->SetXY(90,34);
if($_GET['colonia']){ 
$pdf->Cell(0,0,$_GET['colonia'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['colonia'],0,0,L);
}


//usuario
$pdf->SetXY(22,38);
if($_GET['ciudad']){ 
$pdf->Cell(0,0,$_GET['ciudad'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['ciudad'],0,0,L);
}

$pdf->SetXY(60,41);
if($_GET['delegacion']){ 
$pdf->Cell(0,0,$_GET['delegacion'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['delegacion'],0,0,L);
}



$pdf->SetXY(22,41);
if($_GET['cp']){ 
$pdf->Cell(0,0,$_GET['cp'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['cp'],0,0,L);
}



$pdf->SetXY(22,44);
if($_GET['estado']){ 
$pdf->Cell(0,0,$_GET['estado'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['estado'],0,0,L);
}


$pdf->SetXY(60,44);
if($_GET['pais']){
$pdf->Cell(0,0,$_GET['pais'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow455['pais'],0,0,L);
}


$pdf->SetXY(22,48);
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
$pdf->SetXY(50,43);
//$pdf->Cell(0,0,$_GET['folioFactura'],0,0,R);
$pdf->SetY(43);
$pdf->Cell(0,0,"Fact N°: ".$_GET['folioFactura'],0,0,R);

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
if($_GET['fechaImpresion']){
$fecha1=$_GET['fechaImpresion'];
}else{
$fecha1=date("d    m    Y");
}
$pdf->SetXY(50,47);
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





$sSQL= "
SELECT *
from cargosCuentaPaciente
where
numFactura='".$_GET['folioFactura']."'
and
gpoProducto!=''
order by folioVenta ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);
while ($myrow = mysql_fetch_array($result)){
$registros+=1;
$codigoTT=$myrow['tipoTransaccion'];
$puntero+=1;
$C=$myrow['codigoGP'];
$pdf->Ln(3); //salto de linea
$myrow['precioVenta']=$myrow['precioVenta'];
$myrow['iva']=$myrow['iva'];


//************************************
$sSQL38= "
SELECT 
impresionEspecial,descripcionImpresion,tasaGP
FROM
gpoProductos
WHERE codigoGP='".$myrow['gpoProducto']."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);

$sSQL38a= "
SELECT codTASA FROM TASA WHERE codTASA>0";
$result38a=mysql_db_query($basedatos,$sSQL38a);
$myrow38a = mysql_fetch_array($result38a);
if($myrow38['tasaGP']=='0'){
$tasaCero[0]+=($myrow['precioVenta']*$myrow['cantidad']);
} else if($myrow38['tasaGP']>0){
$gravado=$myrow38['tasaGP'];
$tasaIVA[0]+=($myrow['precioVenta']*$myrow['cantidad']);
} else if($myrow38['tasaGP']=='E'){
$tasaExento[0]+=($myrow['precioVenta']*$myrow['cantidad']);
}



//**************************
//DIFERENCIAS
if($myrow['naturaleza']=='C'){
$cargo[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$cargoIva[0]+=$myrow['iva']*$myrow['cantidad'];
$signo='';
}else{
$abono[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$abonoIva[0]+=$myrow['iva']*$myrow['cantidad'];
$signo='-';
}
//*************************












  if($myrow7[0]){
  $cos=$myrow341['cantidadF'];
  } else {
  $cos=$myrow7['acumulado'];
  
  }
  
  
  
  $importe2[0]+=$cos;

  
  
//***************************************************

$sSQL71="SELECT descripcion
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow['codProcedimiento']."'
  ";
 
  $result71=mysql_db_query($basedatos,$sSQL71);
  $myrow71 = mysql_fetch_array($result71);








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


$sSQL39a= "
	SELECT 
descripcion,medico
FROM
almacenes
WHERE almacen='".$myrow['almacenDestino']."'";
$result39a=mysql_db_query($basedatos,$sSQL39a);
$myrow39a = mysql_fetch_array($result39a);







//*********************************

if($folioVenta1!=$myrow['folioVenta']){
$sSQL38e= "
SELECT 
paciente
FROM
clientesInternos
WHERE folioVenta='".$myrow['folioVenta']."'";
$result38e=mysql_db_query($basedatos,$sSQL38e);
$myrow38e = mysql_fetch_array($result38e);




//
//ENCABEZADO DEL FOLIO DE VENTA
$pdf->SetFont('Arial','B',8);
$pdf->SetX('22');
$pdf->Cell(0,0,$myrow['folioVenta'].' '.$myrow38e['paciente'],0,0,L);
$pdf->Ln(4); //salto de linea
$folioVenta1=$myrow['folioVenta'];
}

//****************************************
//echo $myrow['keyCAP'].'</br>';
$pdf->SetFont('Arial','',8);
if($myrow38['impresionEspecial']=='si'){ 
$pdf->SetX('22');
$pdf->Cell(0,0,$myrow38['descripcionImpresion'],0,0,L);
$pdf->Ln(4); //salto de linea
$pdf->SetX('22');

if($myrow39a['medico']=='si'){ 
$pdf->Cell(0,0,'Dr(a): '.$myrow39a['descripcion'],0,0,L);
}else{ 


if($myrow['descripcion']){
$pdf->Cell(0,0,$myrow['descripcion'],0,0,L);
}else{
$pdf->Cell(0,0,$myrow71['descripcion'],0,0,L);
}


}



} else {
$pdf->SetX('22');
$pdf->Cell(0,0,$myrow38['descripcionImpresion'],0,0,L);
$pdf->SetX('22');
$pdf->Cell(0,0,'',0,0,L);
$pdf->SetX('22');

if($myrow39['descripcion']){

$pdf->Cell(0,0,$myrow39['descripcion'],0,0,L);
}else{

$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,L);
}
}





$pdf->SetX('150');
$pdf->Cell(0,0,$signo.$myrow['cantidad'],0,0,L);

$pdf->SetX('165');

$pdf->Cell(0,0,$signo.'$'.number_format( $myrow['precioVenta'],2),0,0,L);

$pdf->SetX('185');
$pdf->Cell(0,0,$signo.'$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2),0,0,R);





$pdf->SetX('140');
//esta mal este precioVenta


if($cos){
$cantidadRegistros+=1;

$slices=$myrow71['sumaAbonos']/$cantidadRegistros;

$importe3[0]=$importe2[0]-$slices;
$cos="$".number_format($importe3[0] ,2);
} else {
$cos="$0.00";
}



//$pdf->Cell(0,0,$cos,0,0,R);

//************cierra pruebas


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

//echo '</br>'.$registros;
//****************************************************

//*********************************************************
$a+=1;
} //cierra while



$TOTAL=($cargo[0]+$cargoIva[0])-($abono[0]+$abonoIva[0]);
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
//**********************************************************************





//*****************************************************************


$pdf->SetFont('Arial','',10);
$pdf->SetXY(22,218);
$pdf->Cell(0,0,'Tasa al 0% '."$".number_format($tasaCero[0],2),0,0,M);
$pdf->SetXY(22,222);
$pdf->Cell(0,0,'Tasa al '.$myrow38a['codTASA'].'% '."$".number_format($tasaIVA[0],2),0,0,M);
$pdf->SetXY(22,226);
$pdf->Cell(0,0,'Tasa Exento '."$".number_format($tasaExento[0],2),0,0,M);  



$pdf->Ln(4); //salto de linea
if($totalCoaseguro){
$pdf->Cell(0,0,"(IVA coaseguro $".number_format($totalCoaseguro,2).' )',0,0,M);
}



//$ss[0]-=$coaseguro[0];
$pdf->SetFont('Arial','',10);

$pdf->Ln(4); //salto de linea



$pdf->SetXY(1,218);
$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,"$".number_format($cargo[0]-$abono[0],2),0,0,R);
$pdf->Ln(4); //salto de linea
$pdf->SetXY(1,227);
$pdf->Cell(0,0,"$".number_format($cargoIva[0]-$abonoIva[0],2),0,0,R);
$pdf->Ln(4); //salto de linea
$pdf->SetXY(1,236);
$pdf->Cell(0,0,"$".number_format(($cargo[0]+$cargoIva[0])-($abono[0]+$abonoIva[0]),2),0,0,R);
$pdf->Ln(4); //salto de linea
//*******impresion de cantidad con letra
//$pdf->SetXY(22,236);


$pdf->SetXY(22,236);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);


//*********************************TERMINAN VALIDACIONES********************






//Launch the print dialog
$pdf->AutoPrint(false);
$pdf->Output();

?>

