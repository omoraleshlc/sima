<?php require('../js/pdf/fpdf_js.php');



//fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."'





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
$pdf->Cell(0,0,'HOJA DE AUDITORIA (POLIZA DE INGRESOS)',0,0,M);
$pdf->SetX(1);


//*****************ech*************




$date=date("d/m/Y");
$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->Cell(0,0,cambia_a_normal($fecha1),0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,13);
$pdf->Cell(0,0,"RESUMEN EXTERNOS",0,0,M);
$pdf->SetX(1);

$pdf->SetXY(2,16);
$pdf->Cell(0,0,"Fecha Impresion: ".$date,0,0,M);




$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'Cta. Contable',0,0,M);

$pdf->SetXY(30,30);
$pdf->Cell(0,0,'Centro de Costo',0,0,M);

//*************TRANSACCIONES***************
$pdf->SetXY(150,30);
$pdf->Cell(0,0,'Debe',0,0,M);


$pdf->SetXY(170,30);
$pdf->Cell(0,0,'Haber',0,0,M);


//****************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);

//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea



 $sSQL= "
    SELECT almacenIngreso,descripcionAlmacen
    FROM
    cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fechaCierre='".$fecha1."'
and
statusCuenta='cerrada'
and
gpoProducto!=''
and
tipoPaciente='externo'
and
almacenIngreso!=''
and
ventasDirectas!='si'

group by almacenIngreso";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){



$pdf->Ln(5); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(3); //salto de linea


$pdf->Ln(3); //salto de linea





$pdf->SetX('30');
$pdf->Cell(0,0,'[ '.$myrow['descripcionAlmacen'].' ]',0,0,M);

$sSQLdg= "Select * From cargosCuentaPaciente where entidad='".$_GET['entidad']."' and almacenIngreso='".$myrow['almacenIngreso']."'

and
fechaCierre='".$fecha1."'
and
gpoProducto!=''
and
ventasDirectas!='si'
and
tipoPaciente='externo'

group by gpoProducto
";
$resultdg=mysql_db_query($basedatos,$sSQLdg);
while($myrowdg = mysql_fetch_array($resultdg)){




$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,$myrowdg['descripcionGrupoProducto'],0,0,M);










//EL TIPO DE PACIENTE ES EXTERNO BYPASS
$sSQLc="SELECT sum(precioVenta*cantidad)  as cargos,sum(iva*cantidad) as ivaCargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
gpoProducto='".$myrowdg['gpoProducto']."'
and
fechaCierre='".$fecha1."'
and
naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'

";
$resultc=mysql_db_query($basedatos,$sSQLc);
$myrowc = mysql_fetch_array($resultc);


$sSQLd="SELECT sum(precioVenta*cantidad)  as devoluciones,sum(iva*cantidad) as devolucionesIVA
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
gpoProducto='".$myrowdg['gpoProducto']."'
and
fechaCierre='".$fecha1."'
and
naturaleza='A'

and
tipoPaciente='externo'
and
ventasDirectas!='si'

";
$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);
//***********************************************************************





$ventasExternos[0]+=($myrowc['cargos']-$myrowd['devoluciones']);
$ivaExternos[0]+=($myrowc['ivaCargos']-$myrowd['devolucionesIVA']);





$haber=($myrowc['cargos']);
$debe=($myrowd['devoluciones']);
$haberSuma[0]+=($myrowc['cargos']);
$debeSuma[0]+=($myrowd['devoluciones']);


$totalExternos[0]+=($myrowc['cargos']-$myrowd['devoluciones']);







$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($debe,2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($haber,2),0,0,M);
//cierra >0 ventas










}//while grupo de producto






















$pdf->Ln(6); //salto de linea







//EL TIPO DE PACIENTE ES EXTERNO BYPASS
$sSQLciva="SELECT sum(iva*cantidad) as ivaCargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and

fechaCierre='".$fecha1."'
and
naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'

";
$resultciva=mysql_db_query($basedatos,$sSQLciva);
$myrowciva = mysql_fetch_array($resultciva);


$sSQLdiva="SELECT sum(iva*cantidad) as devolucionesIVA
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and

fechaCierre='".$fecha1."'
and
naturaleza='A'

and
tipoPaciente='externo'
and
ventasDirectas!='si'

";
$resultdiva=mysql_db_query($basedatos,$sSQLdiva);
$myrowdiva = mysql_fetch_array($resultdiva);
//***********************************************************************

$ivaExternosDebe[0]+=$myrowdiva['devolucionesIVA'];
$ivaExternosHaber[0]+=$myrowciva['ivaCargos'];

//***********************************************
if($myrowdiva['devolucionesIVA']>0 or $myrowciva['ivaCargos']>0){
$pdf->SetX('30');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($myrowdiva['devolucionesIVA'],2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowciva['ivaCargos'],2),0,0,M);
$totalIVAExternos[0]+=$myrowciva['ivaCargos']-$myrowdiva['devolucionesIVA'];
}
//*************************************************
//cierra >0 ventas



} //cierra while**************************---------------------------------------------------------------------------------------------------------------









$pdf->Ln(4); //salto de linea
















































































$pdf->Ln(10); //salto de linea
$pdf->SetX(2);
$pdf->Cell(0,0,"RESUMEN INTERNOS",0,0,M);
$pdf->SetX(1);
$pdf->SetFont('Arial','',8);
$pdf->SetX(2);




$sSQL= "Select * From cargosCuentaPaciente where
    entidad='".$_GET['entidad']."'

and
fechaCargo='".$fecha1."'
and
gpoProducto!=''
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
almacenIngreso!=''
group by almacenIngreso


";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){



$pdf->Ln(5); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(3); //salto de linea


$pdf->Ln(3); //salto de linea


$sSQL3ae= "
	SELECT 
descripcion
FROM
almacenes
where
entidad='".$entidad."'
    and
    almacen='".$myrow['almacenIngreso']."'  ";
$result3ae=mysql_db_query($basedatos,$sSQL3ae);
$myrow3ae = mysql_fetch_array($result3ae);


if($myrow['descripcionAlmacen']!=''){
$pdf->SetX('30');
$pdf->Cell(0,0,'[ '.$myrow['almacenIngreso']. '-' .$myrow['descripcionAlmacen'].' ]',0,0,M);
}else{
   $pdf->SetX('30');
$pdf->Cell(0,0,'[ '.$myrow['almacenIngreso']. '-' .$myrow3ae['descripcion'].' ]',0,0,M); 
}

$sSQLdg= "Select * From cargosCuentaPaciente where entidad='".$_GET['entidad']."' and almacenIngreso='".$myrow['almacenIngreso']."'

and
fechaCargo='".$fecha1."'
and
gpoProducto!=''
and

(tipoPaciente='interno' or tipoPaciente='urgencias')
group by gpoProducto
";
$resultdg=mysql_db_query($basedatos,$sSQLdg);
while($myrowdg = mysql_fetch_array($resultdg)){




$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,$myrowdg['descripcionGrupoProducto'],0,0,M);






//**********ABRE EXTERNOS*************

//EL TIPO DE PACIENTE ES INTERNO
$sSQLcEI="SELECT sum(precioVenta*cantidad)  as cargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
gpoProducto='".$myrowdg['gpoProducto']."'
and
fechaCargo='".$fecha1."'
and
naturaleza='C'
and

(tipoPaciente='interno' or tipoPaciente='urgencias')

   ";
$resultcEI=mysql_db_query($basedatos,$sSQLcEI);
$myrowcEI = mysql_fetch_array($resultcEI);


$sSQLdEI="SELECT sum(precioVenta*cantidad) as devoluciones
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
gpoProducto='".$myrowdg['gpoProducto']."'
and
fechaCargo='".$fecha1."'
and
naturaleza='A'

and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";
$resultdEI=mysql_db_query($basedatos,$sSQLdEI);
$myrowdEI = mysql_fetch_array($resultdEI);

//***********CIERRA EXTERNOS**********




 $ventasInternos[0]+=($myrowcEI['cargos']-$myrowdEI['devoluciones']);
 $ivaInternos[0]+=($myrowcEI['ivaCargos']-$myrowdEI['devolucionesIVA']);



//$ventas=($myrowc['cargos']+$myrowcE['cargos'])-($myrowd['devoluciones']+$myrowdE['devoluciones']);
//$ventasSuma[0]+=($myrowc['cargos']+$myrowcE['cargos'])-($myrowd['devoluciones']+$myrowdE['devoluciones']);
//$ivaVentas=($myrowc['ivaCargos']+$myrowcE['ivaCargos'])-($myrowd['devolucionesIVA']+$myrowdE['devolucionesIVA']);
//$ivaSuma[0]+=($myrowc['ivaCargos']+$myrowcE['ivaCargos'])-($myrowd['devolucionesIVA']+$myrowdE['devolucionesIVA']);

$haberInternos=$myrowcEI['cargos']+$myrowcEI['ivaCargos'];
$debeInternos=$myrowdEI['devoluciones']+$myrowdEI['devolucionesIVA'];
$haberSumaInternos[0]+=$myrowcEI['cargos'];

$debeSumaInternos[0]+=$myrowdEI['devoluciones'];

//imprimir




$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($debeInternos,2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($haberInternos,2),0,0,M);
//cierra >0 ventas










}//while grupo de producto




















$pdf->Ln(6); //salto de linea





//EL TIPO DE PACIENTE ES INTERNO BYPASS
$sSQLcivaInternos="SELECT sum(iva*cantidad) as ivaCargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and

fechaCargo='".$fecha1."'
and
naturaleza='C'
and
gpoProducto!=''
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
";
$resultcivaInternos=mysql_db_query($basedatos,$sSQLcivaInternos);
$myrowcivaInternos = mysql_fetch_array($resultcivaInternos);


$sSQLdivaInternos="SELECT sum(iva*cantidad) as devolucionesIVA
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
fechaCargo='".$fecha1."'
and
naturaleza='A'
and
gpoProducto!=''
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
";
$resultdivaInternos=mysql_db_query($basedatos,$sSQLdivaInternos);
$myrowdivaInternos = mysql_fetch_array($resultdivaInternos);
//***********************************************************************

$debeInternosIVA[0]+=$myrowdivaInternos['devolucionesIVA'];
$haberInternosIVA[0]+=$myrowcivaInternos['ivaCargos'];

//***********************************************
if($myrowdivaInternos['devolucionesIVA']>0 or $myrowcivaInternos['ivaCargos']>0){
$pdf->SetX('30');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($myrowdivaInternos['devolucionesIVA'],2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowcivaInternos['ivaCargos'],2),0,0,M);
$totalIVAInternos[0]+=$myrowcivaInternos['ivaCargos']-$myrowdivaInternos['devolucionesIVA'];
}
//*************************************************


($debeSuma[0]+$ivaExternosDebe[0])+($debeSumaInternos[0]+$debeInternosIVA[0]);

} //cierra while**************************---------------------------------------------------------------------------------------------------------------



















































$pdf->Ln(10); //salto de linea
$pdf->SetX(2);
$pdf->Cell(0,0,"VENTAS VARIAS",0,0,M);
$pdf->SetX(1);
$pdf->SetFont('Arial','',8);
$pdf->SetX(2);
$pdf->Ln(4); //salto de linea


//***************************************************************************************************
//SIN IVA
$pdf->SetX('30');
$pdf->Cell(0,0,"Ventas Varias s/IVA",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************

$sSQLabonosVDE="SELECT sum(precioVenta*cantidad) as abonoVentasDirectas

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto!=''
and
naturaleza='C'
and

ventasDirectas='si'
and
iva=0
";
$resultabonoVDE=mysql_db_query($basedatos,$sSQLabonosVDE);
$myrowabonosVDE = mysql_fetch_array($resultabonoVDE);

$sSQLabonosdEVDE="SELECT sum(precioVenta*cantidad) as devolucionVentasDirectas

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto!=''
and
naturaleza='A'
and

ventasDirectas='si'
and
iva=0
";
$resultabonosdEVDE=mysql_db_query($basedatos,$sSQLabonosdEVDE);
$myrowabonosdEVDE = mysql_fetch_array($resultabonosdEVDE);



$abonosVDE=$myrowabonosVDE['abonoVentasDirectas']-$myrowabonosdEVDE['devolucionVentasDirectas'];


$debeSI[0]+=$myrowabonosdEVDE['devolucionVentasDirectas'];
$haberSI[0]+=$myrowabonosVDE['abonoVentasDirectas'];
//**********************************************************
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($myrowabonosdEVDE['devolucionVentasDirectas'],2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowabonosVDE['abonoVentasDirectas'],2),0,0,M);
$pdf->Ln(4); //salto de linea
//***************************************************************************************************




//***************************************************************************************************

$pdf->SetX('30');
$pdf->Cell(0,0,"Ventas Varias c/IVA",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************

$sSQLabonosVD="SELECT sum(precioVenta*cantidad) as abonoVentasDirectas

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto!=''
and
naturaleza='C'
and

ventasDirectas='si'
and
iva>0
";
$resultabonoVD=mysql_db_query($basedatos,$sSQLabonosVD);
$myrowabonosVD = mysql_fetch_array($resultabonoVD);

$sSQLabonosdEVD="SELECT sum(precioVenta*cantidad) as devolucionVentasDirectas

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto!=''
and
naturaleza='A'
and

ventasDirectas='si'
and
iva>0
";
$resultabonosdEVD=mysql_db_query($basedatos,$sSQLabonosdEVD);
$myrowabonosdEVD = mysql_fetch_array($resultabonosdEVD);



$abonosVD=$myrowabonosVD['abonoVentasDirectas']-$myrowabonosdEVD['devolucionVentasDirectas'];
//**********************************************************
$debeCI[0]+=$myrowabonosdEVD['devolucionVentasDirectas'];
$haberCI[0]+=$myrowabonosVD['abonoVentasDirectas'];
//**********************************************************
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($myrowabonosdEVD['devolucionVentasDirectas'],2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowabonosVD['abonoVentasDirectas'],2),0,0,M);
$pdf->Ln(4); //salto de linea
//***************************************************************************************************


$pdf->Ln(4); //salto de linea

//***********************************************

//*********iVA DESGLOSADO DE VENTAS DIRECTAS************************


$sSQLabonosVDIva="SELECT sum(iva*cantidad) as ivaVD

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto!=''
and
naturaleza='C'
and

ventasDirectas='si'

";
$resultabonoVDIva=mysql_db_query($basedatos,$sSQLabonosVDIva);
$myrowabonosVDIva = mysql_fetch_array($resultabonoVDIva);

$sSQLabonosdEVDIva="SELECT sum(iva*cantidad) as ivaDevolucion

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto!=''
and
naturaleza='A'
and

ventasDirectas='si'

";
$resultabonosdEVDIva=mysql_db_query($basedatos,$sSQLabonosdEVDIva);
$myrowabonosdEVDIva = mysql_fetch_array($resultabonosdEVDIva);

$debeCII[0]+=$myrowabonosdEVDIva['ivaDevolucion'];
$haberCII[0]+=$myrowabonosVDIva['ivaVD'];

if($myrowabonosdEVDIva['ivaDevolucion']>0 or $myrowabonosVDIva['ivaVD']>0){
$pdf->SetX('30');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($myrowabonosdEVDIva['ivaDevolucion'],2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowabonosVDIva['ivaVD'],2),0,0,M);
$totalIVAVD[0]+=$myrowabonosVDIva['ivaVD']-$myrowabonosdEVDIva['ivaDevolucion'];
}

$pdf->Ln(4); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,'______________________________________________________________________________________________________',0,0,M);


















$pdf->Ln(4); //salto de linea

//****************************CARGO A LA CAJA*************************
$sSQL1a= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto=''

and
numRecibo!=''


";




$result1a=mysql_db_query($basedatos,$sSQL1a);
while($myrow1a = mysql_fetch_array($result1a)){
require('/configuracion/clases/acumuladosCorte1.php');
}






$pdf->Ln(10); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,"Efectivo",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($e,2),0,0,M);
$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"CxC",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($cxc[0],2),0,0,M);
$pdf->Ln(4); //salto de linea


$pdf->SetX('30');
$pdf->Cell(0,0,"Otros",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($otros[0],2),0,0,M);
$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"Nomina",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($nomina[0],2),0,0,M);
$pdf->Ln(4); //salto de linea










$pdf->SetX('30');
$pdf->Cell(0,0,"Descuentos",0,0,M);

//$descuentos=$descuentoAseguradora[0];
//*********************************

$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($descuentos,2),0,0,M);
$pdf->Ln(4); //salto de linea
//*********************************************************


$pdf->SetX('30');
$pdf->Cell(0,0,"Cortesias",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($cortesias[0],2),0,0,M);
$pdf->Ln(4); //salto de linea



$pdf->SetX('30');
$pdf->Cell(0,0,"Beneficencias",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($beneficencia[0],2),0,0,M);
$pdf->Ln(4); //salto de linea














































//DEVOLUCIONES, HABER

$pdf->SetX('30');
$pdf->Cell(0,0,"Dev Beneficencias",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devolucionBeneficencia[0],2),0,0,M);
$pdf->Ln(4); //salto de linea



$pdf->SetX('30');
$pdf->Cell(0,0,"Dev Descuentos",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devolucionDescuento[0],2),0,0,M);
$pdf->Ln(4); //salto de linea


$pdf->SetX('30');
$pdf->Cell(0,0,"Dev Efectivo",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devoluciones,2),0,0,M);
$pdf->Ln(4); //salto de linea




$pdf->SetX('30');
$pdf->Cell(0,0,"Dev CxC",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devCxC,2),0,0,M);
$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"Dev T Otros",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devtotros[0],2),0,0,M);



$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"Dev Cortesias",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devolucionCortesia[0],2),0,0,M);






$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"Dev Nomina",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($devolucionNomina[0],2),0,0,M);

$pdf->Ln(4); //salto de linea



$pdf->SetX('30');
$pdf->Cell(0,0,"Dev Abonos Aseguradora",0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($devolucionAbonoAseguradoras[0],2),0,0,M);

$pdf->Ln(4); //salto de linea




$pdf->SetX('30');
$pdf->Cell(0,0,"Regreso Efectivo",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($regresoefectivo[0],2),0,0,M);




$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"Regreso Aseguradoras",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($regresoAseguradora[0],2),0,0,M);




$pdf->Ln(4); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,"Pagos de Aseguradoras",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************

$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($taas,2),0,0,M);
$pdf->Ln(5); //salto de linea
//***************************************************************************************************





















$pdf->SetX('30');
$pdf->Cell(0,0,"Pago de Otros",0,0,M);


//**********************************************************
//PAGO Y DEVOLUCION OTROS
if($devotros[0]>0){
    $pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($devotros[0],2),0,0,M);
}

$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($tOtros,2),0,0,M);
$pdf->Ln(5); //salto de linea
//***************************************************************************************************













$pdf->SetX('30');
$pdf->Cell(0,0,"Abonos de Px Internos ",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************
$sSQLabonos="SELECT sum(precioVenta*cantidad) as abonoInternos

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
gpoProducto=''
";
$resultabonos=mysql_db_query($basedatos,$sSQLabonos);
$myrowabonos = mysql_fetch_array($resultabonos);

$sSQLabonosd="SELECT sum(precioVenta*cantidad) as devolucionInternos

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
gpoProducto=''

";
$resultabonosd=mysql_db_query($basedatos,$sSQLabonosd);
$myrowabonosd = mysql_fetch_array($resultabonosd);


//SOLO SIRVE COMO REFERENCIA
$aInternosT=($myrowabonos['abonoInternos']-$myrowabonosd['devolucionInternos']);


//**********************************************************
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($aInternosT,2),0,0,M);
$pdf->Ln(5); //salto de linea
//*****************************************************************************







$pdf->SetX('30');
$pdf->Cell(0,0,"Cargos de Px Internos ",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************


//$cInternos=$myrowcpi['abonoInternos']-$myrowcpid['devolucionInternos'];
$cInternos=($ventasInternos[0]+$totalIVAInternos[0]);
//**********************************************************
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($cInternos,2),0,0,M);
$pdf->Ln(5); //salto de linea
//*****************************************************************************






$pdf->SetX('30');
$pdf->Cell(0,0,"Nota de Credito",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************


$sSQLncD="SELECT sum(precioVenta*cantidad)+sum(iva*cantidad) as ncD

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
naturaleza='C'
and
notaCredito='si'
and
statusCuenta='notaCredito'";
$resultncD=mysql_db_query($basedatos,$sSQLncD);
$myrowncD = mysql_fetch_array($resultncD);

$sSQLncH="SELECT sum(precioVenta*cantidad) as ncH

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
naturaleza='A'
and
notaCredito='si'
and
statusCuenta='notaCredito'";
$resultncH=mysql_db_query($basedatos,$sSQLncH);
$myrowncH = mysql_fetch_array($resultncH);
$nCreditoD=$myrowncD['ncD'];
$nCreditoH=$myrowncH['ncH'];
//**********************************************************
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($nCreditoD,2),0,0,M);
$pdf->Ln(5); //salto de linea
//*****************************************************************************


//**********************************************************
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($nCreditoH,2),0,0,M);
$pdf->Ln(5); //salto de linea
//*****************************************************************************







/*
//EFECTIVO
$e=
        $cash[0]+$gastosparticulares[0]+
        $coa1[0]+$coa2[0]+$deducible1[0]+$deducible2[0]+
        $pagocash[0]+$pagocheque[0]+$pagotransfer[0]+
        $pagotc[0];
    


//TRASLADOS
$cxc[0]=$trasladocxc[0];
$otros[0]=$trasladootros[0];
$nomina[0]=$nomina[0];


//DESCUENTOS
$descuentos=$descuentoparticulares[0]+$descuentoaseguradoras[0];
        
//CORTESIAS
$cortesias[0]=$trasladocortesia[0];


//BENEFICENCIAS
$beneficencia[0]=$trasladobeneficencia[0];



//**************DEVOLUCIONES***************
//BENEFICENCIA
$devolucionBeneficencia[0]=$devbeneficencia[0];


//CANCELACION DE DESCUENTO/DEVOLUCION
$devolucionDescuento[0]=$cancelardescuento[0];

//EFECTIVO
$devoluciones=+$devoluciontc[0]+$devcheques[0]+$devte[0];


//TRASLADO ASEGURADORA
$devCxC=$devtrasladoaseg[0];


//CORTESIA
$devolucionCortesia[0]=$devcortesia[0];

//NOMINA
$devolucionNomina[0]=$devnomina[0];

//ABONO ASEGURADORAS
$devolucionAbonoAseguradoras[0]=$devolucionAbonoAseguradoras[0];




//REGRESO EFECTIVO
$regresoefectivo[0]=$regefectivo[0];

//REGRESO ASEGURADORA
$regresoAseguradora[0]=$regresoaseguradora[0];


//PAGOS DE ASEGURADORAS
$taas=$abonoaseguradora[0];


//PAGO Y DEVOLUCION OTRoS
//PAGO
$tOtros=$myrowotros['abonoOtros'];
//DEVOLUCION
$devO=$devotros[0];


//ABONOS INTERNOS
$aInternos=$abonos[0]
*/





$debC=
($debeSuma[0]+$ivaExternosDebe[0]+$debeSumaInternos[0]+$debeInternosIVA[0]+$debeSI[0]
+$debeCI[0]+$debeCII[0]);



$debT=
($e+$cxc[0]+$otros[0]+$nomina[0]+
            $descuentos+$cortesias[0]+
                        $beneficencia[0]+
                                    $cInternos+
                                        $devolucionAbonoAseguradoras[0]+$nCreditoD);

$deb=$debC+$debT;
//esta como una devolucion en efectivo







//$hab=
//($devoluciones+$devCxC+$taas+$tOtros)
//+
//($haberSI[0]+$haberCI[0]+$haberCII[0])
//+
//($haberSuma[0]+$ivaExternosHaber[0])
//+
//($haberSumaInternos[0]+$haberInternosIVA[0])
//+
//($regresoefectivo[0]+$regresoAseguradora[0])
//+
//$devolucionCortesia[0]
//+
//$devolucionNomina[0]
//
//
//+
//$devolucionDescuento[0]
//+
////pagos de aseguradora,pagosotros,AbonosCI,cargosPI
//$aInternos
//+
//$tOtros
//+
//$taas
//+
//$devtotros[0] //dev traslado a otros
//
//;














$hab=
($haberSI[0]+$haberCI[0]+$haberCII[0])
+
($haberSuma[0]+$ivaExternosHaber[0])
+
($haberSumaInternos[0]+$haberInternosIVA[0])
+
$devolucionBeneficencia[0]+$devolucionDescuento[0]
+$devoluciones+$devCxC+
$devolucionCortesia[0]+
$devolucionNomina[0]+

$regresoefectivo[0]+
$regresoAseguradora[0]+
$taas+
$tOtros+
$aInternosT+
$devtotros[0]+//dev traslado a otros
$nCreditoH
;




$pdf->Ln(4); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,'TOTAL',0,0,M);
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($deb,2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($hab,2),0,0,M);
//cierra >0 ventas














//*************DEBES
$pdf->Ln(30); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,"Px Externos",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************


$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalExternos[0],2),0,0,M);
$pdf->SetX('110');
$pdf->Cell(0,0,'$'.number_format($totalIVAExternos[0],2),0,0,M);
$pdf->SetX('130');
$pdf->Cell(0,0,'$'.number_format($totalExternos[0]+$totalIVAExternos[0],2),0,0,M);

$pdf->Ln(4); //salto de linea
//***************************************************************************************************


$pdf->SetX('70');
$pdf->Cell(0,0,"Px Internos ",0,0,M);
//*******************OPERACIONES CENTRO DE COSTO*******************



$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($ventasInternos[0],2),0,0,M);
$pdf->SetX('110');
$pdf->Cell(0,0,'$'.number_format($totalIVAInternos[0],2),0,0,M);
$pdf->SetX('130');
$pdf->Cell(0,0,'$'.number_format($ventasInternos[0]+$totalIVAInternos[0],2),0,0,M);




//**************************************************************

$pdf->Ln(4); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * ',0,0,L);

//************************************************************************************************************************************************************************************























//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>