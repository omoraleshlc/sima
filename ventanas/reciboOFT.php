<?php require('/var/www/html/sima/js/pdf/fpdf_js.php');


		
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
//establece el nombre del paciente
$pdf->SetFont('Arial','',10);
$pdf->SetXY(20,25);
$pdf->Cell(0,0,''.$paciente,0,0,L);
$pdf->SetXY(2,29);
$pdf->Cell(0,0,'Folio Sistema: '.$myrow311['folioVenta'],0,0,L);





$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,33);
if($myrow311['seguro']){
$sSQL1= "Select nomCliente From clientes WHERE entidad='".$myrow311['entidad']."' AND numCliente = '".$myrow311['seguro']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$pdf->Cell(0,0,'No. Seguro: '.$myrow1['nomCliente'],0,0,L);
} else {
$pdf->Cell(0,0,'Cliente Particular',0,0,L);
}

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetXY(155,40);
$pdf->Cell(0,0,''.$fecha1,0,0);












//establece el encabezado de la empresa
/*
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

*/
/*

$pdf->SetFont('Arial','',10);
$pdf->SetXY(2,29);
if($myrow311['seguro']){
$sSQL1= "Select nomCliente From clientes WHERE entidad='".$myrow311['entidad']."' AND numCliente = '".$myrow311['seguro']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$pdf->Cell(0,0,'No. Seguro: '.$myrow1['nomCliente'],0,0,L);
} else {
$pdf->Cell(0,0,'Cliente Particular',0,0,L);
}*/
/*

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

*/





$pdf->SetXY(2,45);
$pdf->Cell(0,0,'Recibo: '.$myrow311['numRecibo'],0,0,R);

/*


//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(30);
$pdf->Cell(0,0,'Fecha: '.$fecha1,0,0,R);

//Citas
$pdf->SetY(34);
$pdf->Cell(0,0,'Hora Cargo: '.$myrow311['hora'],0,0,R);



$pdf->SetY(38);
$sSQL1y= "Select * From catCajas WHERE entidad='".$myrow311['entidad']."' AND keyCatC = '".$myrow311['codigoCaja']."' ";
$result1y=mysql_db_query($basedatos,$sSQL1y);
$myrow1y = mysql_fetch_array($result1y);
$pdf->Cell(0,0,$myrow1y['descripcionCaja'],0,0,R);


//Status

$sSQL1dep= "Select descripcion From almacenes WHERE entidad='".$_GET['entidad']."' and almacen = '".$myrow311['almacen']."' ";
$result1dep=mysql_db_query($basedatos,$sSQL1dep);
$myrow1dep = mysql_fetch_array($result1dep);


$pdf->SetY(42);
$pdf->Cell(0,0,'Depto: '.$myrow1dep['descripcion'],0,0,R);



//Usuario
$pdf->SetY(45);
$pdf->Cell(0,0,'Usuario Autorizo: '.$myrow311['autoriza'],0,0,R);


//Credencial/Nómina 
if($myrow311['credencial']){
$pdf->SetXY(80,45);
$pdf->Cell(0,0,'Credencial/Nomina: '.$myrow311['credencial'],0,0,M);
}
*/




$pdf->SetFont('Arial','',10);
//$pdf->SetXY(2,37);




//dibujar una linea
//$pdf->Line(3, 47, 199, 47);
//linea divisoria
//$pdf->Line(23, 48, 23, 52);


//etiquetas 
$pdf->SetFont('Arial','',10);
$pdf->SetXY(3,49);
//$pdf->Cell(0,0,'C',0,0,L);
$pdf->SetXY(12,49);
//$pdf->Cell(0,0,'Descripcion',0,0,L);
$pdf->SetXY(186,55);
//$pdf->Cell(0,0,'Importe',0,0,L);

//$pdf->Line(3, 51, 199, 51);
//*****************


$pdf->SetFont('Arial','',10);
$pdf->Ln(2); //salto de linea 15 lineas




 $sSQL= "SELECT *
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
and
folioVenta='".$_GET['folioVenta']."'
and
(naturaleza='A' or naturaleza='C')
order by status='transaccion'

 ";
$result=mysql_db_query($basedatos,$sSQL);
$registros = mysql_num_rows($result);
while ($myrow = mysql_fetch_array($result)){
$codigoTT=$myrow['tipoTransaccion'];
$flag+=1;

$pdf->Ln(2); //salto de linea






if($myrow['gpoProducto']!=NULL){

$cargos[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaCargos[0]+=$myrow['iva']*$myrow['cantidad'];

} 



if($myrow['naturaleza']=='A' and $myrow['gpoProducto']!=NULL   ){

$dev[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$ivaDev[0]+=$myrow['iva']*$myrow['cantidad'];

}


if($myrow['gpoProducto']!=''){
    if($myrow['naturaleza']=='C'){
        $signo=NULL;
    }elseif($myrow['naturaleza']=='A'){
        $signo='-';
    }
}else{
        $signo=NULL;
}




if($myrow['statusDescuento']=='si'){
$totalDescuento[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$descripcionExento="Descuento";
}else if($myrow['statusCortesia']=='si'){ 
$totalCortesia[0]+=$myrow['precioVenta']*$myrow['cantidad'];
$descripcionExento="Cortesia";
} elseif($myrow['statusBeneficencia']=='si' and $myrow['gpoProducto']==''){
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

if($myrow['tipoTransaccion']!=NULL){
$sSQL40= "
        SELECT
*
FROM
catTTCaja
WHERE

codigoTT='".$myrow['tipoTransaccion']."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
}

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





if($myrow['tipoTransaccion']!=NULL){
//es una transaccion


if($myrow['tipoPago']=='Tarjeta de Credito'){
$descripcion='T.Trans: '.$myrow['tipoPago'].',Banco: '.$myrow['bancoTC'].', CodAut: '.$myrow['codigoAutorizacion'].', U.Digitos: '.$myrow['ultimosDigitos'];
}else if($myrow['tipoPago']=='Cheque'){
$descripcion='Transaccion: '.$myrow['tipoPago'].',Banco: '.$myrow['bancoCheque'].', #Cheque: '.$myrow['numeroCheque'];
}else{
	
	//************** cambiar *******************************************
$descripcion='Tipo de Pago: '.$myrow40['descripcion'];
}


$pdf->SetX('3');



$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,L);

$pdf->Ln(4); //salto de linea	


if($myrow['statusDescuento']=='si' or $myrow['statusCortesia']=='si' or $myrow['statusBeneficencia']=='si'){
$sSQL1yz= "Select * From usuarios WHERE entidad='".$_GET['entidad']."' AND usuario='".$myrow['usuarioDescuento']."' ";
$result1yz=mysql_db_query($basedatos,$sSQL1yz);
$myrow1yz = mysql_fetch_array($result1yz);
$descripcionDescuento=', por: '.$myrow1yz['nombre'].' '.$myrow1yz['aPaterno'].' '.$myrow1yz['aMaterno'];
}else{
$descripcionDescuento='';
}


$pdf->SetX('12');
$pdf->Cell(0,0,$descripcion.$descripcionDescuento.':  $'. number_format($myrow['precioVenta']*$myrow['cantidad'],2),0,0,L);

} else {

if($myrow38['impresionEspecial']=='si'){
$descripcion=$myrow38['descripcionImpresion'];
//$pdf->SetX('40');
//$pdf->Cell(0,0,trim($descripcion),0,0,L);
$pdf->Ln(2); //salto de linea

//$pdf->Ln(3); //salto de linea
$pdf->SetX('3');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,$descripcion,0,0,L);
$pdf->Ln(4); //salto de linea
$pdf->SetX('3');

if($myrow12a['medico']=='si' and $myrow12a['descripcion']){
$pdf->Cell(0,0,'Dr(a): '.$myrow12a['descripcion'],0,0,L);

}else{
$pdf->Cell(0,0,$myrow39['descripcion'],0,0,L);

}


} else { 
$pdf->Ln(2); //salto de linea
$pdf->SetX('3');



$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,L);



}
}//es una transaccion

if($myrow['descripcionSeguroFacturacion']!=NULL and $myrow['tipoTransaccion']=='totros'){
$pdf->Ln(4); //salto de linea
$pdf->SetX('3');
$pdf->Cell(0,0,trim($myrow['descripcionSeguroFacturacion']),0,0,L);
}    



//cantidad
$pdf->SetFont('Arial','',8);
$pdf->SetX('165');
$pdf->Cell(0,0,trim(round($myrow['cantidad'],3)),0,0,M);





/******************************Importe**************************************/
$pdf->SetX('172');
$pdf->SetFont('Arial','',8);
if($myrow['gpoProducto']!="" ){
$pdf->Cell(0,0,$signo.'$ '.number_format($myrow['precioVenta'],2),0,0,M);
}


$pdf->SetX('192');
$pdf->SetFont('Arial','',8);
if($myrow['gpoProducto']!="" ){
$pdf->Cell(0,0,$signo.'$ '.number_format($myrow['precioVenta']*$myrow['cantidad'],2),0,0,M);
}

//echo '<br>'.$myrow['precioVenta']*$myrow['cantidad'];



//************cierra pruebas


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

} //cierra while


$TOTAL=$cargos[0]+$ivaCargos[0];
$sandra=$TOTAL-$totalDescuento[0]-$totalBeneficencia[0]-$totalCortesia[0];
$centavos=strstr($sandra,'.');
$centavos=substr($centavos,'1');
//**********
$resultado= numerotexto($sandra); 
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


//$pdf->Line(2, 117, 199, 117);

//echo $myrow311['observaciones'];


//**********************************************SIGNATURE******
if($myrow311['seguro'] || $myrow311['statusCortesia'] || $myrow311['statusBeneficencia'] || $myrow311['observaciones']){
$pdf->SetXY(80,113);
$pdf->Cell(0,0,'FIRMA ',0,0,L);
$pdf->Line('93', 114, '140',114 ) ;
}



$pdf->SetFont('Arial','',8);
$pdf->SetXY('192','90');
$pdf->Cell(0,0,"$ ".number_format($cargos[0]-$abonos[0],2),0,0,M);




$pdf->SetXY('192','94');
$pdf->Cell(0,0,"$ ".number_format($ivaCargos[0]-$ivaAbonos[0],2),0,0,M);

if($totalDescuento[0]>0 || $totalCortesia[0]>0 || $totalBeneficencia[0]>0){


if($totalDescuento[0]>0){
$pdf->SetXY('192','96');
$pdf->Cell(0,0,$descripcionExento.": "."-$ ".number_format($totalDescuento[0],2),0,0,M);
}

if($totalCortesia[0]>0){
$pdf->SetXY('192','96');
$pdf->Cell(0,0,$descripcionExento.": "."-$ ".number_format($totalCortesia[0],2),0,0,M);
}

//if($totalBeneficencia[0]>0){
//$pdf->SetXY('173','102');
//$pdf->Cell(0,0,$descripcionExento.": "."-$ ".number_format($totalBeneficencia[0],2),0,0,M);
//}

//****************************************



if(($dev[0]+$ivaDev[0])>0){
$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,"Devoluciones: "."-$".number_format($dev[0]+$ivaDev[0],2),0,0,M);
$pdf->Ln(2); //salto de linea
$pdf->SetFont('Arial','',10);
$pdf->SetX(2);
$TOTAL-=($dev[0]+$ivaDev[0]);
}


$pdf->SetXY('192','98');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,"$ ".number_format($TOTAL-$totalDescuento[0]-$totalBeneficencia[0]-$totalCortesia[0],2),0,0,M);

} else{
if(($dev[0]+$ivaDev[0])>0){
$pdf->Ln(4); //salto de linea
$pdf->Cell(0,0,"Devoluciones: "."-$".number_format($dev[0]+$ivaDev[0],2),0,0,M);
$pdf->SetFont('Arial','',10);
$pdf->SetX(2);
$TOTAL-=($dev[0]+$ivaDev[0]);
}



$pdf->SetXY('192','98');
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,"$ ".number_format($TOTAL,2),0,0,M);
}


$pdf->SetFont('Arial','',10);


//********************************************* cambio  ************
$pdf->SetXY(2,90);
$pdf->Cell(0,0,'*** '.$resultado.' '.$formula.' ***',0,0,L);

/*
if($myrow311['observaciones'] ){
$pdf->Ln(4); //salto de linea
$pdf->SetX(2);
$pdf->Cell(0,0,'Observaciones: '.$myrow311['observaciones'],0,0,L);
$pdf->Ln(4); //salto de linea
}*/

//$pdf->SetXY(2,$Y+12);
//$pdf->Cell(0,0,'Este documento no es deducible fiscalmente',0,0,L);


//Launch the print dialog
$pdf->AutoPrint(false);
$pdf->Output();


?>
