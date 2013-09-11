<?php require('pdf/fpdf_js.php');









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
$pdf->Cell(0,0,'REPORTE DE IVA PX. EXTERNOS',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetXY(2,15);
$pdf->Cell(0,0,'Fecha Inicial: '.cambia_a_normal($_GET['fechaInicial']).' a la fecha: '.cambia_a_normal($_GET['fechaFinal']),0,0,M);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1); 










//**********************************************************************************************************PACIENTES INTERNOS PAGADOS***************************************************************************************************************************
$pdf->Ln(10); //salto de linea
$pdf->SetX(2);
$pdf->Cell(0,0,"EFECTIVO EXTERNOS",0,0,M);
$pdf->SetX(1); 

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
gpoProducto!='HONMED'
and
statusCuenta='cerrada'


and
ventasDirectas!='si'
group by gpoProducto
order by gpoProducto
";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){







//*******************SOLO ENTRA AQUI UNA SOLA VEZ
if($myrow['gpoProducto']!=$gpoProducto){
$pdf->Ln(4); //salto de linea
//$pdf->SetX('2');
//$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
//$pdf->Ln(3); //salto de linea







//****************************CARGO A LA CAJA*************************
$sSQL1a= "SELECT * FROM gpoProductos
WHERE
entidad='".$_GET['entidad']."'
and
codigoGP='".$myrow['gpoProducto']."' 

";
 

$result1a=mysql_db_query($basedatos,$sSQL1a);
while($myrow1a = mysql_fetch_array($result1a)){

$pdf->SetX('30');
$pdf->Cell(0,0,$myrow1a['descripcionGP'],0,0,M);

//*******************OPERACIONES CENTRO DE COSTO*******************








//*********************************************************************************
$sSQLefectivo="SELECT sum(cantidadParticular*cantidad)  as cargosParticular

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
gpoProducto='".$myrow['gpoProducto']."'
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
$resultefectivo=mysql_db_query($basedatos,$sSQLefectivo);
$myrowefectivo = mysql_fetch_array($resultefectivo);

$sSQLefectivod="SELECT sum(cantidadParticular*cantidad) as devolucionesParticular

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and

gpoProducto='".$myrow['gpoProducto']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
naturaleza='A'
and
tipoPaciente='externo' 
and
ventasDirectas!='si'
and
statusCuenta='cerrada'

";
$resultefectivod=mysql_db_query($basedatos,$sSQLefectivod);
$myrowefectivod = mysql_fetch_array($resultefectivod); 


$pagoEfectivo=$myrowefectivo['cargosParticular']-$myrowefectivod['devolucionesParticular'];
$totalEfectivo[0]+=$myrowefectivo['cargosParticular']-$myrowefectivod['devolucionesParticular'];
//****************************************************************




//**********************************************************

//*************************************************************************
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($pagoEfectivo,2),0,0,M);





}









$sSQLivaE="SELECT sum(ivaParticular*cantidad)  as ivaEfectivo

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and

gpoProducto='".$myrow['gpoProducto']."'
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
$resultivaE=mysql_db_query($basedatos,$sSQLivaE);
$myrowivaE = mysql_fetch_array($resultivaE);

$sSQLdiE="SELECT sum(ivaParticular*cantidad) as devolucionIVAEfectivo

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
gpoProducto='".$myrow['gpoProducto']."'
and

(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
naturaleza='A'
and

tipoPaciente='externo' 
and
ventasDirectas!='si'
and
statusCuenta='cerrada'
";
$resultdiE=mysql_db_query($basedatos,$sSQLdiE);
$myrowdiE = mysql_fetch_array($resultdiE);
 
$ivaEfectivo=$myrowivaE['ivaEfectivo']-$myrowdiE['devolucionIVAEfectivo'];
$totalIVAEfectivo[0]+=$myrowivaE['ivaEfectivo']-$myrowdiE['devolucionIVAEfectivo'];


//*************************************************************************
$pdf->Ln(3); //salto de linea


if($ivaEfectivo>0){
$pdf->SetX('30');
$pdf->Cell(0,0,"IVA",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($ivaEfectivo,2),0,0,M);
}
//****************************************CIERRE EFECTIVO**********************************




$gpoProducto=$myrow['gpoProducto'];
//$pdf->Ln(20); //salto de linea
//$pdf->Ln(3); //salto de linea

}


} //cierra while**************************--------------------------------------------------------------








//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(1); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('70');
$pdf->Cell(0,0,'SubTotal',0,0,M);

$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalEfectivo[0],2),0,0,M);



$pdf->Ln(4); //salto de linea

$pdf->SetX('70');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalIVAEfectivo[0],2),0,0,M);


$pdf->Ln(10); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'TOTAL',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalEfectivo[0]+$totalIVAEfectivo[0],2),0,0,M);



$pdf->Ln(4); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);

//************************************************************************************























//***************************************************************************************

//**********************************************************************************************************PACIENTES INTERNOS PAGADOS***************************************************************************************************************************
$pdf->Ln(5); //salto de linea
$pdf->SetX(2);
$pdf->Cell(0,0,"CXC EXTERNOS",0,0,M);
$pdf->SetX(1); 

 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
(gpoProducto!='' and gpoProducto!='HONMED')
and
tipoPaciente='externo' 

and
ventasDirectas!='si'
and
statusCuenta='cerrada'
group by gpoProducto
order by gpoProducto
";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){








//*******************SOLO ENTRA AQUI UNA SOLA VEZ
if($myrow['gpoProducto']!=$gpoProducto){
//$pdf->Ln(5); //salto de linea
//$pdf->SetX('2');
//$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
//$pdf->Ln(3); //salto de linea







//****************************CARGO A LA CAJA*************************
$sSQL1a= "SELECT * FROM gpoProductos
WHERE
entidad='".$_GET['entidad']."'
and
codigoGP='".$myrow['gpoProducto']."' 

";
 

$result1a=mysql_db_query($basedatos,$sSQL1a);
while($myrow1a = mysql_fetch_array($result1a)){
$pdf->Ln(3); //salto de linea
//$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,$myrow1a['descripcionGP'],0,0,M);

//*******************OPERACIONES CENTRO DE COSTO*******************






//*********************************************************************************
$sSQLcxc="SELECT sum(cantidadAseguradora*cantidad)  as cxcCargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
gpoProducto='".$myrow['gpoProducto']."'
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
$resultcxc=mysql_db_query($basedatos,$sSQLcxc);
$myrowcxc = mysql_fetch_array($resultcxc);

$sSQLcxcd="SELECT sum(cantidadAseguradora*cantidad) as devolucionesCxC

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
gpoProducto='".$myrow['gpoProducto']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
naturaleza='A'
and
tipoPaciente='externo' 
and
ventasDirectas!='si'
and
statusCuenta='cerrada'
";
$resultcxcd=mysql_db_query($basedatos,$sSQLcxcd);
$myrowcxcd = mysql_fetch_array($resultcxcd); 
//****************************************************************
$pagoCxC=$myrowcxc['cxcCargos']-$myrowcxcd['devolucionesCxC'];
$totalCxC[0]+=$myrowcxc['cxcCargos']-$myrowcxcd['devolucionesCxC'];
//******************************************************************

//*************************************************************************
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($pagoCxC,2),0,0,M);
}










$sSQLivaCxC="SELECT sum(ivaAseguradora*cantidad)  as ivaCxC

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
gpoProducto='".$myrow['gpoProducto']."'
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
$resultivaCxC=mysql_db_query($basedatos,$sSQLivaCxC);
$myrowivaCxC = mysql_fetch_array($resultivaCxC);

$sSQLdicxc="SELECT sum(ivaAseguradora*cantidad) as devolucionIVACxC

FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and

gpoProducto='".$myrow['gpoProducto']."'
and
(fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."')
and
naturaleza='A'
and

tipoPaciente='externo' 
and
ventasDirectas!='si'
and
statusCuenta='cerrada'

";
$resultdicxc=mysql_db_query($basedatos,$sSQLdicxc);
$myrowdicxc = mysql_fetch_array($resultdicxc);


$ivaCxC=$myrowivaCxC['ivaCxC']-$myrowdicxc['devolucionIVACxC'];
$totalIVACxC[0]+=$myrowivaCxC['ivaCxC']-$myrowdicxc['devolucionIVACxC']; 

//*************************************************



if($ivaCxC>0){
$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,"IVA",0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($ivaCxC,2),0,0,M);
}

$gpoProducto=$myrow['gpoProducto'];
//$pdf->Ln(20); //salto de linea
$pdf->Ln(3); //salto de linea

}


} //cierra while**************************--------------------------------------------------------------








//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(1); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('70');
$pdf->Cell(0,0,'SubTotal',0,0,M);

$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalCxC[0],2),0,0,M);



$pdf->Ln(4); //salto de linea

$pdf->SetX('70');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalIVACxC[0],2),0,0,M);


$pdf->Ln(10); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'TOTAL',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($totalCxC[0]+$totalIVACxC[0],2),0,0,M);



$pdf->Ln(4); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);

//************************************************************************************



//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
