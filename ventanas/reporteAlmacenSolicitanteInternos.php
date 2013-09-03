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
$pdf->Cell(0,0,'REPORTE DE VENTAS PX INTERNOS',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->Cell(0,0,'De la fecha: '.cambia_a_normal($_GET['fechaInicial']).' a la fecha: '.cambia_a_normal($_GET['fechaFinal']),0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1); 



$pdf->SetXY(2,13);
$pdf->Cell(0,0,"VENTAS ",0,0,M);
$pdf->SetX(1); 

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
statusCargo='cargado'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
almacenIngreso!=''

group by almacenIngreso
order by almacenIngreso

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){



$pdf->Ln(5); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(3); //salto de linea


$pdf->Ln(3); //salto de linea


$sSQLal= "Select * From almacenes where entidad='".$_GET['entidad']."' and almacen='".$myrow['almacenIngreso']."' ";
$resultal=mysql_db_query($basedatos,$sSQLal);
$myrowal = mysql_fetch_array($resultal);

$pdf->SetX('30');
$pdf->Cell(0,0,'[ '.$myrowal['descripcion'].' ]',0,0,M);

$sSQLdg= "Select * From gpoProductos where entidad='".$_GET['entidad']."'  order by descripcionGP ASC ";
$resultdg=mysql_db_query($basedatos,$sSQLdg); 
while($myrowdg = mysql_fetch_array($resultdg)){





$pdf->Ln(3); //salto de linea
$pdf->SetX('30');
$pdf->Cell(0,0,$myrowdg['descripcionGP'],0,0,M);





//EL TIPO DE PACIENTE ES INTERNOS
$sSQLcE="SELECT sum(precioVenta*cantidad)  as cargos,sum(iva*cantidad) as ivaCargos
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCargo='cargado'
and
gpoProducto='".$myrowdg['codigoGP']."'


and
naturaleza='C'




   ";
$resultcE=mysql_db_query($basedatos,$sSQLcE);
$myrowcE = mysql_fetch_array($resultcE);


$sSQLdE="SELECT sum(precioVenta*cantidad) as devoluciones,sum(iva*cantidad) as devolucionesIVA
FROM
cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fechaCierre>='".$_GET['fechaInicial']."' and fechaCierre<='".$_GET['fechaFinal']."'
and
almacenIngreso='".$myrow['almacenIngreso']."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
statusCargo='cargado'
and
gpoProducto='".$myrowdg['codigoGP']."'


and
naturaleza='A'

";
$resultdE=mysql_db_query($basedatos,$sSQLdE);
$myrowdE = mysql_fetch_array($resultdE); 

//***********CIERRA EXTERNOS**********





$ventasInternos[0]+=($myrowcE['cargos']-$myrowdE['devoluciones']);
$ivaInternos[0]+=($myrowcE['ivaCargos']-$myrowdE['devolucionesIVA']);



$ventas=$myrowcE['cargos']-$myrowdE['devoluciones'];
$ventasSuma[0]+=$myrowcE['cargos']-$myrowdE['devoluciones'];
$ivaVentas=$myrowcE['ivaCargos']-$myrowdE['devolucionesIVA'];
$ivaSuma[0]+=$myrowcE['ivaCargos']-$myrowdE['devolucionesIVA'];
//imprimir



if($ventas>0){
$pdf->SetX('150');
$pdf->Cell(0,0,'$'.number_format($ventas,2),0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($ivaVentas,2),0,0,M);
}//cierra >0 ventas










}//while grupo de producto




















$pdf->Ln(6); //salto de linea






} //cierra while**************************---------------------------------------------------------------------------------------------------------------











//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(5); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * ',0,0,L);
$pdf->Ln(4); //salto de linea



$pdf->SetX('70');
$pdf->Cell(0,0,'SubTotal',0,0,M);

$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($ventasSuma[0],2),0,0,M);



$pdf->Ln(4); //salto de linea

$pdf->SetX('70');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($ivaSuma[0],2),0,0,M);


$pdf->Ln(4); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,'TOTAL',0,0,M);
$pdf->SetX('90');
$pdf->Cell(0,0,'$'.number_format($ventasSuma[0]+$ivaSuma[0],2),0,0,M);
$pdf->Ln(4); //salto de linea























//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
