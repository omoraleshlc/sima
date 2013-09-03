<?php require('../js/pdf/fpdf_js.php');









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

//quien es el centro de distribucion?
    $sSQL29p= "SELECT almacen
FROM
almacenes
where
entidad='".$_GET['entidad']."'
and
centroDistribucion='si'

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);
$cendis=$myrow29p['almacen'];


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
$pdf->Cell(0,0,'CORTE DE INVENTARIOS',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->Cell(0,0,cambia_a_normal($fecha1),0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,15);
$pdf->Cell(0,0,"SOLICITUDES AL CENDIS",0,0,M);
$pdf->SetX(1);







$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'CTA',0,0,M);

$pdf->SetXY(15,30);
$pdf->Cell(0,0,'DESCRIPCION',0,0,M);

//*************TRANSACCIONES***************
$pdf->SetXY(170,30);
$pdf->Cell(0,0,'DEBE',0,0,M);


$pdf->SetXY(190,30);
$pdf->Cell(0,0,'HABER',0,0,M);


//****************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);

//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea











$sSQLa= "SELECT almacenDestino FROM cargosCuentaPaciente,gpoProductos
WHERE
(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
AND
cargosCuentaPaciente.fechaCargo='".$fecha1."'
AND
cargosCuentaPaciente.almacenDestino!='".$cendis."'
AND
(cargosCuentaPaciente.tipoPaciente='interno' or cargosCuentaPaciente.tipoPaciente='urgencias')
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
)
OR
(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
AND
cargosCuentaPaciente.fechaCierre='".$fecha1."'
AND
cargosCuentaPaciente.almacenDestino!='".$cendis."'
AND
cargosCuentaPaciente.tipoPaciente='externo'
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
)
group by cargosCuentaPaciente.almacenDestino
order by cargosCuentaPaciente.descripcionAlmacen ASC

";


$resulta=mysql_db_query($basedatos,$sSQLa);
while($myrowa = mysql_fetch_array($resulta)){
	$pdf->Ln(5); //salto de linea


	$checaModuloScript2a= "Select descripcion from almacenes WHERE entidad='".$_GET['entidad']."' 
	and 
	almacen = '".$myrowa['almacenDestino']."' ";
$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
$resulScripModulo2a = mysql_fetch_array($resScript2a);
$pdf->SetX('15');
$pdf->Cell(0,0,'['.$resulScripModulo2a['descripcion'].']',0,0,M);	
	$pdf->Ln(3); //salto de linea
	
	
	
$sSQL= "SELECT * FROM cargosCuentaPaciente,gpoProductos
WHERE

(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
and
fechaCargo='".$fecha1."'
and
cargosCuentaPaciente.almacenDestino='".$myrowa['almacenDestino']."'
and
(cargosCuentaPaciente.tipoPaciente='interno' or cargosCuentaPaciente.tipoPaciente='urgencias')
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
and
cargosCuentaPaciente.ventasDirectas!='si'
)
OR
(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
and
cargosCuentaPaciente.fechaCierre='".$fecha1."'
and
cargosCuentaPaciente.almacenDestino='".$myrowa['almacenDestino']."'
and
cargosCuentaPaciente.tipoPaciente='externo'
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
and
cargosCuentaPaciente.ventasDirectas!='si'
)
ORDER BY 
cargosCuentaPaciente.descripcionArticulo ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;











//*******************SOLO ENTRA AQUI UNA SOLA VEZ********************







           $sSQL8ac= "
SELECT * 
FROM
kardex
WHERE
entidad='".$_GET['entidad']."'
and
kc='".$myrow['codProcedimiento']."'
and
fecha='".$myrow['fechaCargo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);


$pdf->SetX('2');
$pdf->Cell(0,0,'4.01.100',0,0,M);

$pdf->SetX('15');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);

if($myrow['naturaleza']=='A'){
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrow8ac['costo'],2),0,0,M);
$debe[0]+=$myrow['precioVenta']*$myrow['cantidad'];

}elseif($myrow['naturaleza']=='C'){
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($myrow8ac['costo'],2),0,0,M);
$haber[0]+=$myrow['precioVenta']*$myrow['cantidad'];

}

	$pdf->Ln(3); //salto de linea
}//cierra while anidado













//***************************************************************
$pdf->Ln(5); //salto de linea
$pdf->SetX('15');
$pdf->Cell(0,0,'TOTALES',0,0,M);	

$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($tD[0],2),0,0,M);


$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($itH[0],2),0,0,M);


$pdf->Ln(5); //salto de linea

$pdf->Ln(5); //salto de linea
} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(15); //salto de linea
$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('100');
$pdf->Cell(0,0,'DEBE',0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,'HABER',0,0,M);

$pdf->Ln(4); //salto de linea */
$pdf->SetX('100');
$pdf->Cell(0,0,''.'$'.number_format($debe[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haber[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debe[0]-$haber[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);


//*************************************************************************************************************************








































$pdf->Ln(15); //salto de linea










//*********************************************************************************PACIENTES INTERNOS*************************************************











$pdf->Ln(15); //salto de linea



$pdf->SetX(2);

$pdf->Cell(0,0,"SOLICITUDES DIRECTAS DEL PACIENTE",0,0,M);
$pdf->SetX(1);
$pdf->Ln(5); //salto de linea




$sSQLa= "SELECT almacenDestino FROM cargosCuentaPaciente,gpoProductos
WHERE
(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
AND
cargosCuentaPaciente.fechaCargo='".$fecha1."'
AND
cargosCuentaPaciente.almacenDestino='".$cendis."'
AND
(cargosCuentaPaciente.tipoPaciente='interno' or cargosCuentaPaciente.tipoPaciente='urgencias')
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
)
OR
(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
AND
cargosCuentaPaciente.fechaCierre='".$fecha1."'
AND
cargosCuentaPaciente.almacenDestino='".$cendis."'
AND
cargosCuentaPaciente.tipoPaciente='externo'
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
)
group by cargosCuentaPaciente.almacenDestino
order by cargosCuentaPaciente.descripcionAlmacen ASC

";


$resulta=mysql_db_query($basedatos,$sSQLa);
while($myrowa = mysql_fetch_array($resulta)){
	$pdf->Ln(5); //salto de linea


	$checaModuloScript2a= "Select descripcion from almacenes WHERE entidad='".$_GET['entidad']."' 
	and 
	almacen = '".$myrowa['almacenDestino']."' ";
$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
$resulScripModulo2a = mysql_fetch_array($resScript2a);
$pdf->SetX('15');
$pdf->Cell(0,0,'['.$resulScripModulo2a['descripcion'].']',0,0,M);	
	$pdf->Ln(3); //salto de linea
	
	
	
$sSQL= "SELECT * FROM cargosCuentaPaciente,gpoProductos
WHERE

(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
and
fechaCargo='".$fecha1."'
and
cargosCuentaPaciente.almacenDestino='".$myrowa['almacenDestino']."'
and
(cargosCuentaPaciente.tipoPaciente='interno' or cargosCuentaPaciente.tipoPaciente='urgencias')
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
and
cargosCuentaPaciente.ventasDirectas!='si'
)
OR
(
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
and
cargosCuentaPaciente.fechaCierre='".$fecha1."'
and
cargosCuentaPaciente.almacenDestino='".$myrowa['almacenDestino']."'
and
cargosCuentaPaciente.tipoPaciente='externo'
AND
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
AND
gpoProductos.afectaExistencias='si'
and
cargosCuentaPaciente.ventasDirectas!='si'
)
ORDER BY 
cargosCuentaPaciente.descripcionArticulo ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;











//*******************SOLO ENTRA AQUI UNA SOLA VEZ********************







           $sSQL8ac= "
SELECT * 
FROM
kardex
WHERE
entidad='".$_GET['entidad']."'
and
kc='".$myrow['codProcedimiento']."'
and
fecha='".$myrow['fechaCargo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);


$pdf->SetX('2');
$pdf->Cell(0,0,'4.01.100',0,0,M);

$pdf->SetX('15');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);

if($myrow['naturaleza']=='A'){
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrow8ac['costo'],2),0,0,M);
$debe[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}elseif($myrow['naturaleza']=='C'){
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($myrow8ac['costo'],2),0,0,M);
$haber[0]+=$myrow['precioVenta']*$myrow['cantidad'];
}

	$pdf->Ln(3); //salto de linea
}//cierra while anidado













//***************************************************************
$pdf->SetX('15');
$pdf->Cell(0,0,'IVA',0,0,M);	

$pdf->SetX('190');
//$pdf->Cell(0,0,'$'.number_format($cendis[0],2),0,0,M);
$pdf->Ln(5); //salto de linea

$pdf->Ln(5); //salto de linea
} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(15); //salto de linea
$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('100');
$pdf->Cell(0,0,'DEBE',0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,'HABER',0,0,M);

$pdf->Ln(4); //salto de linea */
$pdf->SetX('100');
$pdf->Cell(0,0,''.'$'.number_format($debe[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haber[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debe[0]-$haber[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);


//*************************************************************************************************************************






















//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>