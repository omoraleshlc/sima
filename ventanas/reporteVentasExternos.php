<?php include('/var/www/html/sima/js/pdf/fpdf_js.php');









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







require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();





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
$pdf->Cell(0,0,'REPORTE DE VENTAS PX EXTERNOS',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetY(8);
$pdf->Cell(0,0,'De la fecha: '.cambia_a_normal($_GET['fechaInicial']).' a la fecha: '.cambia_a_normal($_GET['fechaFinal']),0,0,R);

$pdf->SetY(12);
$pdf->Cell(0,0,'Fecha de Impresion: '.date("d/m/Y"),0,0,R);



$pdf->SetXY(2,15);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1); 

/* 
$pdf->SetXY(2,13);
$pdf->Cell(0,0,'Cajero(a): '.$myrow1a['usuario'],0,0,M);
$pdf->SetX(1); */

//********************************************
/* /* $sSQL1= "Select descripcionCaja From catCajas where keyCatC='".$_GET['codigoCaja']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); */ 


//*****************************************************
/* $pdf->SetXY(2,17);                                  //*  
$pdf->Cell(0,0,$myrow1['descripcionCaja'],0,0,M);   //*
$pdf->SetX(1);     */                                  //*
//*****************************************************

/* $pdf->SetXY(2,20);  
$pdf->Cell(0,0,'Num. Corte: '.$_GET['numCorte'],0,0,M); */

/* $pdf->SetXY(2,24);  
$pdf->Cell(0,0,'Fecha Apertura: '.cambia_a_normal($myrow1a['fechaApertura']).' '.$myrow1a['horaApertura'],0,0,M);

$pdf->SetXY(30,24);  
$pdf->Cell(0,0,'Fecha Cierre: '.cambia_a_normal($myrow1a['fechaCorte']).' '.$myrow1a['horaCorte'],0,0,R); */

//***********************************EFECTIVO SOLAMENTE***********************************



$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'Cta. Contable',0,0,M);

$pdf->SetXY(30,30);
$pdf->Cell(0,0,'Centro de Costo',0,0,M);

//*************TRANSACCIONES***************
$pdf->SetXY(170,30);
$pdf->Cell(0,0,'Ingresos',0,0,M);


/* $pdf->SetXY(190,30);
$pdf->Cell(0,0,'Abonos',0,0,M); */


//****************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);

//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea



 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
gpoProducto!=''
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
gpoProducto!='HONMED'
and
statusCuenta='cerrada'
group by almacenSolicitante

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){








































//*******************SOLO ENTRA AQUI UNA SOLA VEZ
if($myrow['almacenSolicitante']!=$almacen){
$pdf->Ln(5); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(3); //salto de linea







//****************************CARGO A LA CAJA*************************
$sSQL1a= "SELECT * FROM almacenes
WHERE
entidad='".$_GET['entidad']."'
and
almacen='".$myrow['almacenSolicitante']."' 

";
 

$result1a=mysql_db_query($basedatos,$sSQL1a);
while($myrow1a = mysql_fetch_array($result1a)){
$pdf->Ln(3); //salto de linea

$pdf->SetX('30');
$pdf->Cell(0,0,'[ '.$myrow1a['descripcion'].' ]',0,0,M);



//**********************************************
//**********INGRESOS***********

$sSQLg= "Select * From cargosCuentaPaciente where 
entidad='".$_GET['entidad']."' 
and 
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
almacenSolicitante='".$myrow['almacen']."' 
and gpoProducto!=''
and
tipoPaciente='externo' 
and
ventasDirectas!='si'
and
gpoProducto!='HONMED'
and
statusCuenta='cerrada'
group by gpoProducto ";
$resultg=mysql_db_query($basedatos,$sSQLg); 
while($myrowg = mysql_fetch_array($resultg)){























$sSQLdg= "Select * From gpoProductos where entidad='".$_GET['entidad']."' and codigoGP='".$myrowg['gpoProducto']."' ";
$resultdg=mysql_db_query($basedatos,$sSQLdg); 
$myrowdg = mysql_fetch_array($resultdg);

$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,$myrowdg['descripcionGP'],0,0,M);


  $sSQLc="SELECT sum(precioVenta*cantidad)  as cargos,sum(iva*cantidad) as ivaCargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and

almacenSolicitante='".$myrow['almacen']."'
and
gpoProducto='".$myrowg['gpoProducto']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
naturaleza='C'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
statusCuenta='cerrada'
 ";
$resultc=mysql_db_query($basedatos,$sSQLc);
$myrowc = mysql_fetch_array($resultc);

$sSQLd="SELECT sum(precioVenta*cantidad) as devoluciones,sum(iva*cantidad) as devolucionesIVA

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and

almacenSolicitante='".$myrow['almacen']."'

and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
gpoProducto='".$myrowg['gpoProducto']."'
and
naturaleza='A'
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
statusCuenta='cerrada'

";
$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);


$totalCC=$myrowc['cargos']-$myrowd['devoluciones'];
$totalVentas[0]+=$totalCC;
//*************************************************************************
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($totalCC,2),0,0,M);





}
//*********************************IVA*****************************

















//*******************OPERACIONES IVA*******************

$sSQLci="SELECT sum(iva*cantidad)  as ivas

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
almacenSolicitante='".$myrow['almacen']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
naturaleza='C'
and
gpoProducto!=''
and
tipoPaciente='externo'
and
ventasDirectas!='si'
and
statusCuenta='cerrada'

";
$resultci=mysql_db_query($basedatos,$sSQLci);
$myrowci = mysql_fetch_array($resultci);

$sSQLdi="SELECT sum(iva*cantidad) as devolucionIVA

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and

(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
almacenSolicitante='".$myrow['almacen']."'
and
naturaleza='A'
and
gpoProducto!=''
and

tipoPaciente='externo'
and
ventasDirectas!='si'
and
statusCuenta='cerrada'
";
$resultdi=mysql_db_query($basedatos,$sSQLdi);
$myrowdi = mysql_fetch_array($resultdi);






$totalCCI=$myrowci['ivas']-$myrowdi['devolucionIVA'];
$totalIVA[0]+=$totalCCI;
//*************************************************************************
$pdf->Ln(7); //salto de linea

if($totalCCI>0){
$pdf->SetX('30');
$pdf->Cell(0,0,"IVA",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($totalCCI,2),0,0,M);
}
//*****************************************************************



}



$pdf->Ln(3); //salto de linea

}


} //cierra while**************************---------------------------------------------------------------------------------------------------------------





















//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(5); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('70');
$pdf->Cell(0,0,'SubTotal',0,0,M);

$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalVentas[0],2),0,0,M);



$pdf->Ln(4); //salto de linea

$pdf->SetX('70');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalIVA[0],2),0,0,M);


$pdf->Ln(10); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'TOTAL',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalVentas[0]+$totalIVA[0],2),0,0,M);



$pdf->Ln(4); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$ventasExternos=$totalVentas[0]+$totalIVA[0];
//************************************************************************************************************************************************************************************






































































//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
