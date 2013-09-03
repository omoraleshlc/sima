<?php require('../../js/pdf/fpdf_js.php');









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
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA',0,0,M);
$pdf->SetX(1);


//*****************ech*************





//$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->Cell(0,0,'Solicitud: '.$_GET['numSolicitud'],0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,'SOLICITUD DIRECTA DEL PACIENTE: '.$_GET['paciente'],0,0,M);
$pdf->SetX(1); 


//Usuario
$pdf->SetXY(2,13);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Usuario Cargo: '.$_GET['usuarioCargo'],0,0,L);

$pdf->SetXY(2,16);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Fecha Cargo: '.cambia_a_normal($_GET['fecha']),0,0,L);


$pdf->SetXY(2,19);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Hora Cargo: '.$_GET['hora'],0,0,L);

$pdf->SetXY(2,22);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Departamento: '.$_GET['departamentoSolicitante'],0,0,L);


$pdf->SetXY(50,13);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Usuario Solicita: '.$_GET['usuarioSolicitante'],0,0,M);

$pdf->SetXY(50,16);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Fecha Solicita: '.cambia_a_normal($_GET['fechaSolicitud']),0,0,M);


$pdf->SetXY(50,19);
$pdf->SetFont('Arial','',8);
$pdf->Cell(0,0,'Hora Solicita: '.$_GET['horaSolicitud'],0,0,M);





$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'#',0,0,M);

$pdf->SetXY(15,30);
$pdf->Cell(0,0,'Descripcion',0,0,M);


//$pdf->SetXY(140,30);
//$pdf->Cell(0,0,'Hora',0,0,M);
//
//$pdf->SetXY(160,30);
//$pdf->Cell(0,0,'Fecha',0,0,M);
$pdf->SetXY(140,30);
$pdf->Cell(0,0,'Status',0,0,M); 

$pdf->SetXY(155,30);
$pdf->Cell(0,0,'Costo',0,0,M); 

$pdf->SetXY(180,30);
$pdf->Cell(0,0,'Cantidad',0,0,M); 


//****************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);

//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);







$pdf->SetX(2);
$pdf->Ln(15); //salto de linea
//$pdf->Cell(0,0,"Reposiciones de Venta",0,0,M);
$pdf->SetX(1); 
$pdf->Ln(10); //salto de linea


  $sSQL= "
    

SELECT 
*
FROM
cargosCuentaPaciente
WHERE 
entidad='".$_GET['entidad']."'
    and
    folioVenta='".$_GET['folioVenta']."'
        and
        numSolicitud='".$_GET['numSolicitud']."'
and
almacenDestino='".$_GET['almacenDestino']."'
";

 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;
$vector+=20;

//$sSQL2= "Select descripcion From articulos WHERE entidad='".$_GET['entidad']."' and codigo='".$myrow['codigo']."'";
//$result2=mysql_db_query($basedatos,$sSQL2);
//$myrow2 = mysql_fetch_array($result2);



//*******************SOLO ENTRA AQUI UNA SOLA VEZ

$pdf->Ln(3); //salto de linea



   $sSQL3ac="SELECT *
FROM
precioArticulos
WHERE 
entidad='".$_GET['entidad']."'
and
codigo='".$myrow['codProcedimiento']."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);











//*************************************************************************


$pdf->SetX('2');
$pdf->Cell(0,0,$a,0,0,M);


$pdf->SetX('15');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);



//$pdf->SetX('140');
//$pdf->Cell(0,0,$myrow['hora'],0,0,M);
//
//
//
$pdf->SetX('140');
$pdf->Cell(0,0,$myrow['statusCargo'],0,0,M);




$pdf->SetX('155');
if($myrow3ac['costo']>0){
$pdf->Cell(0,0,'$'.number_format($myrow['costoHospital'],2),0,0,M);
}

$pdf->SetX('180');
$pdf->Cell(0,0,$myrow['cantidad'],0,0,M);



//$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);



//*****************************************************************





























//$pdf->SetX('100');
//$pdf->Cell(0,0,'Firma',0,0,L);
//$pdf->line(2,$a+$vector,203,$a+$vector);











$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------











































$pdf->Ln(15); //salto de linea


















//Launch the print dialog
$pdf->AutoPrint(true);
$pdf->Output();
?>
