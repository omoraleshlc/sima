<?php require('../js/pdf/fpdf_js.php');
$fecha1=$_GET['fecha'];
$entidad=$_GET['entidad'];







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
//$pdf->Cell(0,0,'CORTE DE FORMAS',0,0,M);
$pdf->SetX(1);


//*****************ech*************






$pdf->SetY(10);
$pdf->Cell(0,0,cambia_a_normal($fecha1),0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1);












$pdf->SetXY(2,15);
$pdf->Cell(0,0,"POLIZA DE DIARIO",0,0,M);
$pdf->SetX(1);







$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'CTA',0,0,M);

$pdf->SetXY(30,30);
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

$pdf->Ln(4); //salto de linea





$sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fechaSolicitud='".$fecha1."'
and
statusInventario='si'
order by fecha1 ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){




//*******************SOLO ENTRA AQUI UNA SOLA VEZ






//*************************************************************

$sSQLd= "SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as debe FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioVentaOtros='".$myrow['folioVenta']."'
and
fecha1='".$fecha1."'
and 
tipoTransaccion='abotros'
";
$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);





//*********partida doble****
$sSQLh= "SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as haber FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
folioVentaOtros = '".$myrow['folioVenta']."'
and
fecha1='".$fecha1."'
and 
tipoTransaccion='devtotros'


";
$resulth=mysql_db_query($basedatos,$sSQLh);
$myrowh = mysql_fetch_array($resulth);
//*****************






if($myrow['naturaleza']=='C' || ($myrow['tipoTransaccion']=='totros' or $myrow['tipoTransaccion']=='devtotros')){
$debe[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
$d1+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}else{
$haber[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
$h1+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}




//*************************************************************************


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow['numPoliza'],0,0,M);




$pdf->SetX('30');
if($myrow['tipoTransaccion']=='totros' or $myrow['tipoTransaccion']=='devtotros'){
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);
}else{
	$sSQL311= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVentaOtros']."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
	
$pdf->Cell(0,0,$myrow311['folioVenta'].' -'.$myrow311['paciente'].'-',0,0,M);
}
	








$pdf->SetX('170');
if($myrow['tipoTransaccion']=='totros' or $myrow['tipoTransaccion']=='devtotros' ){
$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
}






$pdf->SetX('190');
if($myrow['tipoTransaccion']=='HLCAJOTR'){
$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
}
//*****************************************************************















$pdf->Ln(5); //salto de linea



}


















//*************************************************************

$sSQLd= "SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as debe FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fechaCierre='".$fecha1."'

and
tipoPaciente='externo'
and
gpoProducto!=''
and
naturaleza='A'
and
ventasDirectas!='si'
and
almacenIngreso='".$myrowa['almacenIngreso']."'
order by numMovimiento,folioVenta";
$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);






$sSQLh= "SELECT sum((precioVenta*cantidad)+(iva*cantidad)) as haber FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fechaCierre='".$fecha1."'

and
tipoPaciente='externo'
and
gpoProducto!=''
and

naturaleza='C'
and
ventasDirectas!='si'
and
almacenIngreso='".$myrowa['almacenIngreso']."'
order by numMovimiento,folioVenta";
$resulth=mysql_db_query($basedatos,$sSQLh);
$myrowh = mysql_fetch_array($resulth);




$pdf->Ln(5); //salto de linea


$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowd['debe'],2),0,0,M);

$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($myrowh['haber'],2),0,0,M);

$pdf->Ln(3); //salto de linea
$pdf->SetX('150');
$pdf->Cell(0,0,'TOTALES_________________________',0,0,M);
$pdf->SetX('180');
$pdf->Cell(0,0,'$'.number_format($myrowd['debe']-$myrowh['haber'],2),0,0,M);

//***************************************************************


$pdf->Ln(8); //salto de linea






























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


















//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>