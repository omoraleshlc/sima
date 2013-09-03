<?php require('../js/pdf/fpdf_js.php');
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






$sSQL455= "Select * from datosfacturacion where entidad='".$_GET['entidad']."' and numSolicitud='".$_GET['numSolicitud']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$entidad=$myrow455['entidad'];

$razonSocial1=$myrow455['razonSocial1'];
$razonSocial=$myrow455['razonSocial'];
$nombreCliente=$myrow455['nomCliente'];


$pdf->SetXY(28,27);



$pdf->Cell(0,0,$razonSocial,0,0,L);
$pdf->Ln(3); //salto de linea
$pdf->SetXY(22,30);
$pdf->Cell(0,0,$razonSocial1,0,0,L);
$pdf->Cell(0,0,$nombreCliente,0,L);

//expediente
$pdf->SetXY(22,34);

$pdf->Cell(0,0,$myrow455['calle'],0,0,L);



//departamento
$pdf->SetXY(110,34);
$pdf->Cell(0,0,$myrow455['colonia'],0,0,L);



//usuario
$pdf->SetXY(22,38);
$pdf->Cell(0,0,$myrow455['ciudad'],0,0,L);


$pdf->SetXY(60,41);
$pdf->Cell(0,0,$myrow455['delegacion'],0,0,L);




$pdf->SetXY(22,41);
$pdf->Cell(0,0,$myrow455['cp'],0,0,L);




$pdf->SetXY(22,44);
$pdf->Cell(0,0,$myrow455['estado'],0,0,L);



$pdf->SetXY(60,44);
$pdf->Cell(0,0,$myrow455['pais'],0,0,L);



$pdf->SetXY(22,48);
$pdf->Cell(0,0,$myrow455['rfc'],0,0,L);




$pdf->SetXY(29,61);
if($_GET['paciente']){
$pdf->Cell(0,0,$_GET['paciente'],0,0,L);
}else{
//$pdf->Cell(0,0,$myrow311['paciente'],0,0,L);
}




if($_GET['siniestro']){
$pdf->SetXY(100,61);
$pdf->Cell(0,0,$_GET['siniestro'],0,0,L);
}

if($_GET['credencial']){
$pdf->SetXY(29,64);
$pdf->Cell(0,0,$_GET['credencial'],0,0,L);
}


//$pdf->SetXY(100,50);
//$pdf->Cell(0,0,"N� Folio: ".$myrow311['folioVenta'],0,0,L);

//numero de paciente
$pdf->SetXY(50,43);
//$pdf->Cell(0,0,$_GET['folioFactura'],0,0,R);
$pdf->SetY(43);
$pdf->Cell(0,0,"Fact N: ".$_GET['numFactura'],0,0,R);

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
if($_GET['fechaImpresion']){
$fecha1=$_GET['fechaImpresion'];
}else{
$fecha1=date("d    m    Y");
}
$pdf->SetXY(50,47);
$pdf->Cell(0,0,$fecha1,0,0,R);



//**********PAGO EN UNA SOLA EXHIBICION*****

    $pdf->SetFont('Arial','',8);

if($myrow455['tipopago']!=NULL){

    $pdf->SetXY(71,65);
$pdf->Cell(0,0,$myrow455['tipopago'],0,0,R);
}else{    
        $pdf->SetXY(71,65);

$pdf->Cell(0,0,'PAGO EN UNA SOLA EXHIBICION',0,0,R);
}
//*****************************************





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
SELECT * FROM facturasAplicadas
WHERE 
entidad='".$_GET['entidad']."'
and
numSolicitud='".$_GET['numSolicitud']."'
group by gpoProducto

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
WHERE 
codigoGP='".$C."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);


//*************************OPERACIONES*****************************

  $sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$_GET['entidad']."'
and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  gpoProducto='".$C."'   
  and
  naturaleza='C'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$_GET['entidad']."'
and
  numSolicitud='".$_GET['numSolicitud']."'
and
  gpoProducto='".$C."'   
    and
  naturaleza='A'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
//********************************************************************
$diferencia=  $myrow7['acumulado']-$myrow7d['acumulado'];


if($diferencia>0){ 

  $pdf->SetX('22');
  
  
  if($myrow38['descripcionImpresion']){ 
  $pdf->Cell(0,0,$myrow38['descripcionImpresion'],0,0,L);
  $pdf->Ln(3); //salto de linea

  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  

  
  
if($myrow['codPaquete']!=NULL){  
  $sSQLu= "SELECT 
*
FROM
articulosPaquetes

WHERE entidad='".$entidad."' AND codigoPaquete = '".$myrow['codPaquete']."'

 ";
$resultu=mysql_db_query($basedatos,$sSQLu);

while($myrowu = mysql_fetch_array($resultu)){  
    //*************ALMACENES************
 $sSQLalm="SELECT
descripcion,medico,almacen
  FROM
almacenes
  WHERE
entidad='".$_GET['entidad']."'
and
almacen='".$myrowu['almacen']."'
  ";
 
  $resultalm=mysql_db_query($basedatos,$sSQLalm);
  $myrowalm = mysql_fetch_array($resultalm);
//************************************
	 $pdf->SetX(32);
     $pdf->Cell(0,0,'- '.$myrowalm['descripcion'],0,0,L);
  $pdf->Ln(3); //salto de linea
}
  
  
  
}else{  
$sSQL7fd="SELECT almacenDestino
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow['folioVenta']."'
and
gpoProducto='".$C."'  
group by almacenDestino
";
 

  $result7fd=mysql_db_query($basedatos,$sSQL7fd);
  $cantidadDesplegar = mysql_num_rows($result7fd);
  while($myrow7fd = mysql_fetch_array($result7fd)){
$posicionInicial=22;
$posiciones= strlen($myrowalm['descripcion']);

 
 




//*************ALMACENES************
 $sSQLalm="SELECT
descripcion,medico,almacen
  FROM
almacenes
  WHERE
entidad='".$_GET['entidad']."'
and
almacen='".$myrow7fd['almacenDestino']."'
  ";
 
  $resultalm=mysql_db_query($basedatos,$sSQLalm);
  $myrowalm = mysql_fetch_array($resultalm);
//************************************





if($myrowalm['medico']=='si'){

    //********************MEDICOS********************


    //*************imPRIMIR MEDICOS************
  //$pdf->Ln(6); //salto de linea
    
    
//SI ES IGUALA DEBE DESPLEGAR TODOS LOS MEDICOS DEL PAQUETE    
$sSQL7fd="SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow['folioVenta']."'
and
almacenDestino='".$myrow7fd['almacenDestino']."'
group by descripcionMedico
";


  $result7fd=mysql_db_query($basedatos,$sSQL7fd);
   while($myrow7fd = mysql_fetch_array($result7fd)){

	 $pdf->SetX(32);
     $pdf->Cell(0,0,'- '.$myrow7fd['descripcionMedico'],0,0,L);
  $pdf->Ln(3); //salto de linea
  }
//***************************************
$pdf->Ln(6); //salto de linea

    //***********************************************


}else{
	 $pdf->SetX(22);
     $pdf->Cell(0,0,'['.$myrowalm['descripcion'].']',0,0,L);
  $pdf->Ln(3); //salto de linea
}
	
	  $pdf->SetX('22');
	    // $pdf->Cell(0,0,'['.$myrow['descripcionGrupo'].']',0,0,L);
  $pdf->Ln(3); //salto de linea
	
	
   

  }
  }//validacion de la igualas
    
  
  }else{
      
        $pdf->SetX('22');
  $pdf->Cell(0,0,$myrow38['descripcionGP'],0,0,L);
    $pdf->Ln(3); //salto de linea
  }

  
  
  
  
  $pdf->SetX('185');
  $pdf->Cell(0,0,'$'.number_format($myrow7['acumulado']-$myrow7d['acumulado'],2),0,0,R);


$subTotal=$myrow7['acumulado']-$myrow7d['acumulado'];
$subTotales[0]+=($myrow7['acumulado']-$myrow7d['acumulado']);  

$iva[0]+=$myrow7['ivaa']-$myrow7d['ivaa'];





//********************************************************


$sSQL38a= "
SELECT codTASA FROM TASA WHERE codTASA>0";
$result38a=mysql_db_query($basedatos,$sSQL38a);
$myrow38a = mysql_fetch_array($result38a);

if($myrow38['tasaGP']=='0'){
$tasaCero[0]+=$subTotal;
} else if($myrow38['tasaGP']>0){
$gravado=$myrow38['tasaGP'];
$tasaIVA[0]+=$subTotal;
$sumaIVA[0]+=$myrow7['ivaa']-$myrow7d['ivaa'];
} else if($myrow38['tasaGP']=='E'){
$tasaExento[0]+=$subTotal;
}
//*********************************************************  



  
  






}
//*******************************************************  
} //cierra while
  


































/*
//******IMPRIMIR FOLIOS DE VENTA***********
$sSQL311= "Select  * From facturasAplicadas WHERE entidad='".$entidad."' and numFactura='".$_GET['folioFactura']."'";
$result311=mysql_db_query($basedatos,$sSQL311);

$arr[1]=2;
$arr[2]=14;
        $arr[3]=26;
        $arr[4]=38;
        $arr[5]=50;
        $arr[6]=62;
        $arr[7]=74;
        $arr[8]=86;
        $arr[9]=98;
        $arr[10]=110;
        $arr[11]=122;
        $arr[12]=134;
        $arr[13]=146;


 $pdf->Ln(3); //salto de linea
while($myrow311 = mysql_fetch_array($result311)){
    $p+=1;
 $pdf->SetFont('Arial','',8);
 //$pdf->SetXY($arr[$p],64);
 //$pdf->SetX(22);
 //$pdf->Cell(0,0,$myrow311['folioVenta'],0,0,L);
 //$pdf->Ln(3); //salto de linea
}*/
//*****************************************











//********************************************************************








//$pdf->Ln(4); //salto de linea
























//*******************************DESCUENTOS**************************
$sSQL7fac="SELECT folioVenta,seguro
FROM
facturasAplicadas
WHERE
entidad='".$_GET['entidad']."'
    and
    numSolicitud='".$_GET['numSolicitud']."'
group by folioVenta
";
 
  $result7fac=mysql_db_query($basedatos,$sSQL7fac);
  while($myrow7fac = mysql_fetch_array($result7fac)){
 


if($myrow7fac['folioVenta']!=NULL){	
if($myrow7fac['seguro']==NULL){	
$sSQL7f1="


SELECT
*
FROM
cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
gpoProducto=''
and

(naturaleza='A' or naturaleza='C')
and
cantidadParticular>0
 ";
 
  	$result7f1=mysql_db_query($basedatos,$sSQL7f1);
  	while($myrow7f1 = mysql_fetch_array($result7f1)){
	$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$myrow7f1['tipoTransaccion']."'";
	$result341=mysql_db_query($basedatos,$sSQL341);
	$myrow341 = mysql_fetch_array($result341);
    
  if($myrow341['noFacturable']=='si' ){
  $noFacturable[0]+=$myrow7f1['cantidadParticular']*$myrow7f1['cantidad'];
  }	
  }
	
	
	
	
}else{
			
		
	
$sSQL7f1="


SELECT
*
FROM
cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow7fac['folioVenta']."'
and
gpoProducto=''
and
(naturaleza='A' or naturaleza='C')
and
cantidadAseguradora>0
    
 ";


 
  $result7f1=mysql_db_query($basedatos,$sSQL7f1);
  while($myrow7f1 = mysql_fetch_array($result7f1)){
$sSQL341= "Select * From catTTCaja WHERE codigoTT = '".$myrow7f1['tipoTransaccion']."'";
$result341=mysql_db_query($basedatos,$sSQL341);
$myrow341 = mysql_fetch_array($result341);
    
	if($myrow341['noFacturable']=='si' ){
  	$noFacturable[0]+=$myrow7f1['precioVenta']*$myrow7f1['cantidad'];
  	}
  }
}
}//cierra el while que busca



$totalD=$tasaCero[0]+$tasaIVA[0]+$tasaExento[0]+$sumaIVAS[0];
$totalDescuento= $totalF1*($gravado*'0.01');
//***********************************************


//$pdf->Ln(10); //salto de linea
$sumaDescuento[0]+=$noFacturable[0];
$descuento[0]+=$noFacturable[0];



//Si el cliente pide mostrar coaseguro
//$coaseguro[0]=NULL;
if($descuento[0]>0 and $subTotales[0]>0 and $iva[0]>0){
 $sacarD= $descuento[0]/($subTotales[0]+$iva[0]);
}

$descuentoGlobal=$descuento[0]+$ivades;
$ivades=($iva[0]*$sacarD);
//$tC=$tasaCero[0]*$sacarD;
//$tI=$tasaIVA[0]*$sacarD;
//$tE=$tasaExento[0]*$sacarD;



if($descuento[0]>0){
	$pdf->Ln(15); //salto de linea
$pdf->SetX(22);
$pdf->Cell(0,0,'('.'Descuento'.')',0,0,L);
$pdf->SetX('185');
$pdf->Cell(0,0, '-$'.number_format($descuento[0]-$ivades,2),0,0,R);
$pdf->Ln(3); //salto de linea

if($descuento[0]>0 and $tasaIVA[0]>0){
$pdf->Ln(3); //salto de linea
$pdf->SetX(22);

$pdf->Cell(0,0,"(IVA Descuento"."  $".number_format($ivades,2).' )',0,0,M);
}
$pdf->Ln(4); //salto de linea
}
//*******************************************************************
}//validacion del DESCUENTO

























//********************************************************************







//VERIFICAR SI EXISTEN COSAEGUROS/DEDUCIBLES
$pdf->Ln(4); //salto de linea
$sSQL7fab="SELECT folioVenta,seguro
FROM
facturasAplicadas
WHERE
entidad='".$_GET['entidad']."'
    and
    numSolicitud='".$_GET['numSolicitud']."'
group by folioVenta
";
 
  $result7fab=mysql_db_query($basedatos,$sSQL7fab);
  while($myrow7fab = mysql_fetch_array($result7fab)){
$r+=1;
//*******************************COASEGUROS**************************
$sSQL7f="SELECT folioVenta
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow7fab['folioVenta']."'
and
 (tipoTransaccion='pcoa1' or tipoTransaccion='pcoa2' or tipoTransaccion='pdedu1' or tipoTransaccion='pdedu2')
and
naturaleza='A'
group by folioVenta
";
 
  $result7f=mysql_db_query($basedatos,$sSQL7f);
  $myrow7f = mysql_fetch_array($result7f);
  $foliosVenta[$r]=$myrow7f['folioVenta'];
  if($myrow7fab['seguro']!=NULL){
  $seg[0]+=1;
  }
  }


//print_r($foliosVenta[$r]);

if($seg[0]>0 && $foliosVenta[$r]!=NULL){
		
foreach ($foliosVenta as &$folios) {	
 $sSQL7f1="


SELECT
sum((precioVenta*cantidad)+(iva*cantidad)) as coaseguro
FROM
cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
folioVenta='".$folios."'
and
 (tipoTransaccion='pcoa1' or tipoTransaccion='pcoa2' or tipoTransaccion='pdedu1' or tipoTransaccion='pdedu2')
 and
 numRecibo>0
  ";
 
  $result7f1=mysql_db_query($basedatos,$sSQL7f1);
  $myrow7f1 = mysql_fetch_array($result7f1);
  $sumaCoaseguro[0]+=$myrow7f1['coaseguro'];
$coaseguro[0]+=$myrow7f1['coaseguro'];
}



//AQUI AFECTA
//$totalF=$tasaCero[0]+$tasaIVA[0]+$tasaExento[0]+$sumaIVAS[0];



$totalCoaseguro= $totalF1*($gravado*0.01);
//***********************************************


$pdf->Ln(10); //salto de linea

}








//echo $coaseguro[0].' -> '.$subTotales[0].' -> '.$iva[0];
//Si el cliente pide mostrar coaseguro
//$coaseguro[0]=NULL;
//echo $coaseguro[0].''.$subTotales[0].'*'.$iva[0];
$sacarP= $coaseguro[0]/($subTotales[0]+$iva[0]);
$ivaCOA=($iva[0]*$sacarP);





if($coaseguro[0]>0){
$pdf->SetX(22);
$pdf->Cell(0,0,'('.'Coaseguro'.')',0,0,L);
$pdf->SetX('185');
$pdf->Cell(0,0, '-$'.number_format($coaseguro[0]-$ivaCOA,2),0,0,R);
$pdf->Ln(3); //salto de linea

if($coaseguro[0]>0 and $tasaIVA[0]>0){
$pdf->Ln(3); //salto de linea
$pdf->SetX(22);

$pdf->Cell(0,0,"(IVA Coaseguro"."  $".number_format($ivaCOA,2).' )',0,0,M);
}
$pdf->Ln(4); //salto de linea
}
//*******************************************************************





//linea de abajo
//$pdf->Line(23, 115, 200, 115);
//***************************************FOOTER*************************************
//*tasa

if( $sacarD>0 or $sacarP>0){
	if($sacarD>0){
		 $tasaCero[0]-=($tasaCero[0]*$sacarD);
		 $tasaIVA[0]-=($tasaIVA[0]*$sacarD);
		 $tasaExento[0]-=($tasaExento[0]*$sacarD);
		 $iva[0]-=$iva[0]*$sacarD;
	}elseif($sacarP>0){
		  $tasaCero[0]-=($tasaCero[0]*$sacarP);
		  $tasaIVA[0]-=($tasaIVA[0]*$sacarP);
		  $tasaExento[0]-=($tasaExento[0]*$sacarP);
		  $iva[0]-=$iva[0]*$sacarP;
	}
}




$pdf->SetFont('Arial','',10);
$pdf->SetXY(22,218);
$pdf->Cell(0,0,'Tasa al 0% '."$".number_format($tasaCero[0],2),0,0,M);
$pdf->SetXY(22,222);
$pdf->Cell(0,0,'Tasa al '.$myrow38a['codTASA'].'% '."$".number_format($tasaIVA[0],2),0,0,M);
$pdf->SetXY(22,226);
$pdf->Cell(0,0,'Tasa Exento '."$".number_format($tasaExento[0],2),0,0,M);
//*****************************************************************
//COASEGURO




//*****************************************************************************************
//$sumatoria=($tasaCero[0]+$tasaIVA[0]+$tasaExento[0])-($descuento[0]+$ivades);
$sumatoria=($tasaCero[0]+$tasaIVA[0]+$tasaExento[0]);




//echo $subTotales[0].' '.$myrow7f1['coaseguro'].' '.$ivaCOA;

//****************************************TERMINACIONES****************************
//echo $subTotales[0];
$pdf->SetFont('Arial','',10);
$pdf->SetXY(1,224);
$pdf->Cell(0,0,"$".number_format($sumatoria,2),0,0,R);

$pdf->SetXY(1,233);
$pdf->Cell(0,0,"$".number_format($iva[0],2),0,0,R);

$pdf->SetXY(1,242);

$TOTAL=($sumatoria+$iva[0]);
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

?>
