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





//require("/configuracion/funciones.php"); 
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
$basedatos='sima';
mysql_connect($servidor,$usuario,$passwd); 		

function cambia_a_normal($fecha){ 
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
    $lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
    return $lafecha; 
} 

//******************************************************************
//clases fuera
$entidad=$_GET['entidad'];
$usuario=$_GET['usuario'];
$sSQL1= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numCorte=$myrow1['numCorte'];




$sSQL17= "
SELECT 
sum(precioVenta*cantidad)+sum(iva*cantidad) as sumaCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
(status='particular' and statusCargo='cargado' )
and naturaleza='C' 
and
tipoCliente='particular'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
//return $myrow17['sumaCargos'];



$sSQL16= "
	SELECT 
  sum(precioVenta) as Tabonos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='A' 
and
tipoCliente='particular'
";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16 = mysql_fetch_array($result16);
 $Tabonos=$myrow16['Tabonos'];



$sSQL2= "
	SELECT 
  sum(precioVenta) as TCargos
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$numeroE1."'
 and
 nCuenta='".$nCuenta1."'
and 
status='transaccion'
and
naturaleza='C' 

";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 $TCargos=$myrow2['TCargos'];


$TOTAL= $myrow17['sumaCargos']-$Tabonos+$TCargos;




 $sSQL13= "
	SELECT 
 descripcionCaja
FROM
catCajas
WHERE keyCatC='".$myrow1['keyCatC']."'

";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);




//*****************************************************



$sSQL1= "SELECT *
FROM
cargosCuentaPaciente
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$sSQL1= "SELECT *
FROM
clientesInternos
WHERE numeroE ='".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$paciente=$myrow1['paciente'];
$seguro=$myrow1['seguro'];
$numeroTransaccion=$myrow1['keyClientesInternos'];
//************devuelve seguro
$sSQL39= "SELECT *
FROM
clientes
where 
numCliente='".$seguro."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$seguro=$myrow39['nomCliente'];
$auxiliar=$myrow39['ID_AUXILIAR'];
$ctaMayor=$myrow39['ID_CTAMAYOR'];
//**********cierra devolver seguro
if($seguro)$paciente=$seguro;



$pdf->SetFont('Arial','',10);
//establece el nombre del paciente

//$pdf->SetXY(2,5);
//$pdf->SetX(1);

$pdf->SetXY(2,5);
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA',0,0,M);

$pdf->SetX(2);
$pdf->SetY(7);
$pdf->Cell(0,0,'Num. Corte: '.$_GET['numCorte'],0,0,R);
//numero de paciente


$pdf->SetXY(2,13);
$pdf->Cell(0,0,"REPORTE POR RECIBO",0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,17);
$pdf->Cell(0,0,'CAJERO(A): '.$usuario,0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,22);
$pdf->Cell(0,0,$myrow13['descripcionCaja'],0,0,M);
$pdf->SetX(1);











//***********************************EFECTIVO SOLAMENTE***********************************
$pdf->SetFont('Arial','',12);
$pdf->SetXY(1,25);
//$pdf->Cell(0,0,'FOLIOS',0,0,M);


$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);

$pdf->SetXY(1,30);
$pdf->Cell(0,0,'Recibo',0,0,M);

$pdf->SetXY(15,30);
$pdf->Cell(0,0,'Departamento',0,0,M);

$pdf->SetXY(190,30);
$pdf->Cell(0,0,'Importe',0,0,M);


//************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetY(10);
$pdf->Cell(0,0,$fecha1,0,0,R);
//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea









$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea



$sSQL= "SELECT *,almacenes.descripcion as descri from cargosCuentaPaciente,clientesInternos,almacenes
where

cargosCuentaPaciente.entidad='".$entidad."'
and
cargosCuentaPaciente.precioVenta!='' 
and

cargosCuentaPaciente.statusCaja='pagado'
and
cargosCuentaPaciente.numCorte='".$_GET['numCorte']."'
and
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos
and
cargosCuentaPaciente.almacenDestino=almacenes.almacen
group by clientesInternos.keyClientesInternos
order by 
cargosCuentaPaciente.numRecibo ASC
 ";
 

 
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){
$y+=7;
$y1=70;
$y1+=1;
$sSQL7="SELECT sum((cargosCuentaPaciente.precioVenta*cargosCuentaPaciente.cantidad)+(cargosCuentaPaciente.iva*cargosCuentaPaciente.cantidad)) as efectivo
FROM
cargosCuentaPaciente,almacenes
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 
and
cargosCuentaPaciente.almacenDestino='".$myrow['almacenDestino']."' 
and
cargosCuentaPaciente.almacenSolicitante=almacenes.almacen
and
cargosCuentaPaciente.numCorte='".$_GET['numCorte']."'
and
cargosCuentaPaciente.statusCargo='cargado'
and
cargosCuentaPaciente.statusCaja='pagado'


  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


$sSQL71="SELECT sum(cargosCuentaPaciente.iva*cargosCuentaPaciente.cantidad) as ivas
FROM
cargosCuentaPaciente,almacenes
WHERE
cargosCuentaPaciente.entidad='".$entidad."' 
and
cargosCuentaPaciente.almacenDestino='".$myrow['almacenDestino']."' 
and
cargosCuentaPaciente.almacenSolicitante=almacenes.almacen
and
cargosCuentaPaciente.numCorte='".$_GET['numCorte']."'
and
cargosCuentaPaciente.statusCargo='cargado'
and
cargosCuentaPaciente.statusCaja='pagado'
and
cargosCuentaPaciente.status='particular'

  ";
  $result71=mysql_db_query($basedatos,$sSQL71);
  $myrow71 = mysql_fetch_array($result71);


$cos="$".number_format($myrow7['efectivo'],2);
$efectivo[0]+=$myrow7['efectivo'];
$iva[0]+=$myrow71['ivas'];
$pdf->Ln(3); //salto de linea
$pdf->SetX('2');

if($myrow['tipoPaciente']=='externo'){
$prefijo=0;
}else{
$prefijo=1;
}
//$pdf->Cell(0,0,$sSQL,0,0,L);
$pdf->Cell(0,0,$prefijo.$myrow['numRecibo'],0,0,L);

$pdf->SetX('15');
$pdf->Cell(0,0,$myrow['descri'],0,0,L);


//$pdf->SetX('60');
//$pdf->Cell(0,0,$myrow['paciente'],0,0,L);

$pdf->SetX('190');
$pdf->Cell(0,0,$cos,0,0,M);



$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

}


/* $pdf->Ln(10); //salto de linea
$pdf->line(2,32,200,32);
$pdf->SetX('155');
$pdf->Cell(0,0,'SubTotal',0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($efectivo[0],2),0,0,M);
$pdf->Ln(4); //salto de linea
$pdf->SetX('155');
$pdf->Cell(0,0,'IVA',0,0,M);
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($iva[0],2),0,0,M);
$pdf->Ln(4); //salto de linea
$pdf->SetX('155');
$pdf->Cell(0,0,'Total',0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($efectivo[0]+$iva[0],2),0,0,M); */




















$pdf->Ln(6); //salto de linea















$pdf->SetX('190');
//$pdf->Cell(0,0,"$".number_format($efectivo[0],2),0,0,M);
$pdf->Ln(2); //salto de linea



//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
