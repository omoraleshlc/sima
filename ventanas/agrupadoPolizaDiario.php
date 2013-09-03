<?php require('/var/www/html/sima/js/pdf/fpdf_js.php');









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

$pdf->SetXY(75,5);
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Fecha Impresion: '.date("d/m/Y"),0,0,R);





$pdf->SetXY(80,10);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,"POLIZA DE DIARIO",0,0,M);
$pdf->SetX(1); 


$fecha1=$_GET['fecha'];
$pdf->SetXY(80,13);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Dia: '.cambia_a_normal($fecha1),0,0,M);





$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'CGP.',0,0,M);

$pdf->SetXY(15,30);
$pdf->Cell(0,0,'Departamento',0,0,M);

//*************TRANSACCIONES***************



$pdf->SetXY(170,30);
$pdf->Cell(0,0,'Debe',0,0,M); 


$pdf->SetXY(190,30);
$pdf->Cell(0,0,'Haber',0,0,M); 



$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea


$sSQL40= "SELECT almacen
FROM
almacenes
where 
entidad='".$_GET['entidad']."'
and
centroDistribucion='si'  ";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$cendis=$myrow40['almacen'];


$sSQL= "SELECT * FROM cargosCuentaPaciente,gpoProductos
WHERE
cargosCuentaPaciente.entidad='".$_GET['entidad']."'
and
cargosCuentaPaciente.fechaCargo='".$fecha1."'
and
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
and
gpoProductos.afectaExistencias='si'
group by cargosCuentaPaciente.almacenSolicitante
order by cargosCuentaPaciente.almacenSolicitante
";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){














//*******************
//ALMACEN 
$pdf->Ln(3); //salto de linea
 $sSQL1b1= "SELECT * FROM almacenes
WHERE
entidad='".$_GET['entidad']."'
    and
almacen='".$myrow['almacenSolicitante']."'  ";
 

$result1b1=mysql_db_query($basedatos,$sSQL1b1);
$myrow1b1 = mysql_fetch_array($result1b1);


$sSQL40= "SELECT descripcion,almacen
FROM
almacenes
where 
entidad='".$_GET['entidad']."'
and
almacen='".$myrow1b1['almacenPadre']."'  ";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);


//******************************************************************************


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow40['almacen'],0,0,M);


$pdf->SetX('15');
$pdf->Cell(0,0,'[ '.$myrow40['descripcion'].']',0,0,M);
$pdf->Ln(3); //salto de linea



 $sSQLg= "Select * From cargosCuentaPaciente,gpoProductos where cargosCuentaPaciente.entidad='".$_GET['entidad']."' and

cargosCuentaPaciente.fechaCargo='".$fecha1."'
    and
    cargosCuentaPaciente.almacenSolicitante='".$myrow['almacenSolicitante']."'
        and
    
gpoProductos.codigoGP=cargosCuentaPaciente.gpoProducto
   and
   gpoProductos.afectaExistencias='si'
group by 
cargosCuentaPaciente.gpoProducto
";
$resultg=mysql_db_query($basedatos,$sSQLg); 
while($myrowg = mysql_fetch_array($resultg)){



//ALMACEN 
 $sSQL1b= "SELECT * FROM gpoProductos
WHERE

codigoGP='".$myrowg['gpoProducto']."' ";
 

$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);
//********************



$pdf->SetX('15');

$pdf->Cell(0,0,trim($myrow1b['descripcionGP']).$p,0,0,M);










$sSQLd= "SELECT sum(costoHospital*cantidad) as cargos 
FROM cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
fechaCargo='".$fecha1."'
and
almacenSolicitante='".$myrow['almacenSolicitante']."'
and
   gpoProducto='".$myrowg['gpoProducto']."'
and
naturaleza='C'

";

$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);









$sSQLdev= "SELECT sum(costoHospital*cantidad) as dev 
FROM cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
fechaCargo='".$fecha1."'
and
almacenSolicitante='".$myrow['almacenSolicitante']."'
and
   gpoProducto='".$myrowg['gpoProducto']."'
and
naturaleza='A'

";

$resultdev=mysql_db_query($basedatos,$sSQLdev);
$myrowdev = mysql_fetch_array($resultdev);








$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrowd['cargos']-$myrowdev['dev'],2),0,0,M);
$debe[0]+=$myrowd['cargos']-$myrowdev['dev'];





//$pdf->SetX('190');
//$pdf->Cell(0,0,'$'.number_format($myrowh['haber'],2),0,0,M);
//$haber[0]+=$myrowh['haber'];


$pdf->Ln(3); //salto de linea

}








$sSQLhs= "SELECT sum(costoHospital*cantidad) as cendis 
FROM cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
fechaCargo='".$fecha1."'
and
almacenSolicitante='".$myrow['almacenSolicitante']."'

and
naturaleza='C'


";
$resulths=mysql_db_query($basedatos,$sSQLhs);
$myrowhs = mysql_fetch_array($resulths);



$sSQLhsd= "SELECT sum(costoHospital*cantidad) as dev 
FROM cargosCuentaPaciente
WHERE

entidad='".$_GET['entidad']."'
and
fechaCargo='".$fecha1."'
and
almacenSolicitante='".$myrow['almacenSolicitante']."'

and
naturaleza='A'


";
$resulthsd=mysql_db_query($basedatos,$sSQLhsd);
$myrowhsd = mysql_fetch_array($resulthsd);
$haber[0]+=$myrowhs['cendis']-$myrowhsd['dev'];


$pdf->SetX('15');
$pdf->Cell(0,0,'CENDIS'.$p,0,0,M);
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($myrowhs['cendis']-$myrowhsd['dev'],2),0,0,M); 


//*****************************************************************






































$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























//**************************************TOTAL DE INGRESOS************************************
$pdf->Ln(15); //salto de linea
$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(4); //salto de linea


 
$pdf->SetX('100');
$pdf->Cell(0,0,'Debe',0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,'Haber',0,0,M);

$pdf->Ln(4); //salto de linea *
$pdf->SetX('100');
$pdf->Cell(0,0,''.'$'.number_format($debe[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haber[0],2),0,0,M); 

$pdf->Ln(4); //salto de linea */

$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);
$pdf->Ln(7); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'TOTAL '.'$'.round(number_format($debe[0]-$haber[0],2),2),0,0,M);

//*************************************************************************************************************************












//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
