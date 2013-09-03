<?php require('/var/www/html/sima/js/pdf/fpdf_js.php');


		
    function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
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

$sSQL311= "Select  * From pacientes WHERE entidad='".$_GET['entidad']."' and numCliente='".$_GET['numCliente']."' ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);

$sSQL1a= "Select * From clientesInternos WHERE keyClientesInternos ='".$_GET['keyClientesInternos']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);


$pdf->SetFont('Arial','',10);

//establece fecha y hora
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetXY(12,30);
$pdf->Cell(0,0,''.$myrow311['fechaCreacion'],0,0,L);
$pdf->SetXY(55,30);
$pdf->Cell(0,0,'Hora: '.$myrow311['hora1'],0,0,L);
//num. expediente
$pdf->SetXY(160,30);
$pdf->Cell(0,0,''.$myrow311['numCliente'],0,0,L);

//establece el nombre del paciente
if($myrow1a['seguro']){
$sSQL1= "Select nomCliente From clientes WHERE entidad='".$myrow311['entidad']."' AND numCliente = '".$myrow1a['seguro']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$pdf->SetXY(18,49);
$pdf->Cell(0,0,''.$myrow1['nomCliente'],0,0,L);
} else {
$pdf->SetXY(18,49);
$pdf->Cell(0,0,'Cliente Particular',0,0,L);
}


$pdf->SetXY(140,49);
$pdf->Cell(0,0,'Cliente Particular',0,0,L);






//establece el nombre del paciente
$pdf->SetXY(19,58);
$pdf->Cell(0,0,''.$myrow311['apellido1'],0,0,L);


//establece el nombre del paciente
$pdf->SetXY(60,58);
$pdf->Cell(0,0,''.$myrow311['apellido2'],0,0,L);


//establece el nombre del paciente
$pdf->SetXY(110,58);
$pdf->Cell(0,0,'...'.$myrow311['apellido3'],0,0,L);


//establece el nombre del paciente
$pdf->SetXY(165,58);
$pdf->Cell(0,0,''.$myrow311['nombre1'],0,0,L);

//establece el nombre del paciente
$pdf->SetXY(15,70);
$pdf->Cell(0,0,''.$myrow311['edad'],0,0,L);


//establece el nombre del paciente

if($myrow311['sexo']!='FEMENINO'){
$pdf->SetXY(40,70);
$pdf->Cell(0,0,'X',0,0,L);

}else{
//establece el nombre del paciente
$pdf->SetXY(50,70);
$pdf->Cell(0,0,'X',0,0,L);
}

//establece el nombre del paciente
$pdf->SetXY(80,70);
$pdf->Cell(0,0,''.$myrow311['ecivil'],0,0,L);


//establece el nombre del paciente
$pdf->SetXY(120,70);
$pdf->Cell(0,0,''.$myrow311['ocupacion'],0,0,L);


//establece el nombre del paciente
$pdf->SetXY(180,70);
$pdf->Cell(0,0,''.$myrow311['fechaNacimiento'],0,0,L);

//establece el nombre del paciente
$pdf->SetXY(30,78);
$pdf->Cell(0,0,''.$myrow311['calle'].' / '.$myrow311['colonia'],0,0,L);

//establece el nombre del paciente
$pdf->SetXY(145,78);
$pdf->Cell(0,0,''.$myrow311['telefono'],0,0,L);

//establece el nombre del paciente
$pdf->SetXY(30,88);
$pdf->Cell(0,0,''.$myrow311['ciudad'].' '.$myrow311['estado'],0,0,L);

//establece el nombre del paciente
$pdf->SetXY(145,88);
$pdf->Cell(0,0,''.$myrow311['telTrabajo'],0,0,L);

////establece el encabezado de la empresa
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
$pdf->SetXY(186,49);
//$pdf->Cell(0,0,'Importe',0,0,L);

//$pdf->Line(3, 51, 199, 51);
//*****************


$pdf->SetFont('Arial','',10);
$pdf->Ln(2); //salto de linea 15 lineas




$pdf->AutoPrint(false);
$pdf->Output();

?>
