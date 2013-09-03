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
$pdf->Cell(0,0,'REPORTE DETALLE DE CAJA',0,0,M);
$pdf->SetX(1);


//******************************





$fecha1=date("d/m/Y");
$pdf->SetY(10);
$pdf->Cell(0,0,$fecha1,0,0,R);


//*****************************
$sSQL1a= "Select * From statusCaja where keyCatC='".$_GET['codigoCaja']."' and numCorte='".$_GET['numCorte']."' order by keySTC DESC";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

$pdf->SetXY(2,10);
$pdf->Cell(0,0,"Diario de Caja",0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,13);
$pdf->Cell(0,0,'Cajero(a): '.$myrow1a['usuario'],0,0,M);
$pdf->SetX(1);

//********************************************
$sSQL1= "Select descripcionCaja From catCajas where keyCatC='".$_GET['codigoCaja']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


//*****************************************************
$pdf->SetXY(2,17);                                  //*  
$pdf->Cell(0,0,$myrow1['descripcionCaja'],0,0,M);   //*
$pdf->SetX(1);                                      //*
//*****************************************************

$pdf->SetXY(2,20);  
$pdf->Cell(0,0,'Num. Corte: '.$_GET['numCorte'],0,0,M);

$pdf->SetXY(2,24);  
$pdf->Cell(0,0,'Fecha Apertura: '.cambia_a_normal($myrow1a['fechaApertura']).' '.$myrow1a['horaApertura'],0,0,M);

$pdf->SetXY(30,24);  
$pdf->Cell(0,0,'Fecha Cierre: '.cambia_a_normal($myrow1a['fechaCorte']).' '.$myrow1a['horaCorte'],0,0,R);

//***********************************EFECTIVO SOLAMENTE***********************************


$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);


$pdf->SetXY(2,30);
$pdf->Cell(0,0,'Folio',0,0,M);

$pdf->SetXY(15,30);
$pdf->Cell(0,0,'Recibo',0,0,M);

$pdf->SetXY(30,30);
$pdf->Cell(0,0,'Descripcion',0,0,M);

//*************TRANSACCIONES***************
$pdf->SetXY(170,30);
$pdf->Cell(0,0,'Cargos',0,0,M);


$pdf->SetXY(190,30);
$pdf->Cell(0,0,'Abonos',0,0,M);


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
codigoCaja='".$_GET['codigoCaja']."'
and
numCorte='".$_GET['numCorte']."'
and
folioVenta!=''





group by folioVenta
order by 
numRecibo,almacen ASC ";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){





















//*******************SOLO ENTRA AQUI UNA SOLA VEZ
if($myrow['folioVenta']!=$folioVenta){
$pdf->Ln(5); //salto de linea
$pdf->SetX('2');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);



//****SOLO IMPRIMO EL NUMERO DE RECIBO
//verifico que exista el folio de venta
$sSQL1bc= "
    
    SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'

and
codigoCaja='".$_GET['codigoCaja']."'
and
numCorte='".$_GET['numCorte']."'
group by 
folioVenta
order by folioVenta

";
 

$result1bc=mysql_db_query($basedatos,$sSQL1bc);
$myrow1bc = mysql_fetch_array($result1bc);

$pdf->Ln(3); //salto de linea
$pdf->SetX('2');
if($myrow1bc['folioVenta']!=NULL){
$pdf->Cell(0,0,$myrow['folioVenta'],0,0,M);    
}else{
$pdf->Cell(0,0,'----',0,0,M);
}






//****************************CARGO A LA CAJA*************************
$sSQL1a= "
    SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'

and
codigoCaja='".$_GET['codigoCaja']."'
and
numCorte='".$_GET['numCorte']."'
and
folioVenta='".$myrow['folioVenta']."' ";
 

$result1a=mysql_db_query($basedatos,$sSQL1a);
while($myrow1a = mysql_fetch_array($result1a)){


require('/configuracion/clases/acumuladosCorte.php');




















$sSQL1b= "SELECT * FROM clientesInternos
WHERE
entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow['folioVenta']."' ";
 

$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);


			if($myrow1b['statusDevolucion'] =='si' and $myrow1b['statusCargoDevolucion']!='main' and $myrow1b['tipoPaciente']=='externo'){
			
			$sSQL1bc= "SELECT * FROM clientesInternos
			WHERE
			entidad='".$_GET['entidad']."'
			and
			folioDevolucion='".$myrow1b['folioVenta']."' ";
 

			$result1bc=mysql_db_query($basedatos,$sSQL1bc);
			$myrow1bc = mysql_fetch_array($result1bc);
			
			if($myrow1b['folioVenta']){
			$descripcionDevolucion=', ***Devolucion  Folio: '.$myrow1bc['folioVenta'];
			$signo='-';
			}
			
			}else{
			$descripcionDevolucion=NULL;
			$signo=NULL;
			}











$pdf->Ln(3); //salto de linea
$pdf->SetX('17');
$pdf->Cell(0,0,$myrow1a['numRecibo'],0,0,M);



$pdf->SetX('30');
if($myrow1a['tipoTransaccion']=='candes'){
$pdf->Cell(0,0,'Devolucion de Descuento',0,0,M);    
}else{
$pdf->Cell(0,0,$myrow1a['tipoPago'].$descripcionDevolucion,0,0,M);    
}


$pdf->SetX('170');
$pdf->Cell(0,0,$signo.'$'.number_format($myrow1a['precioVenta']*$myrow1a['cantidad'],2),0,0,M);
$cargos[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
}
//**********************************************************************************************












































//************************CUANTO GENERO ESE ALMACEN***********************

$sSQL1b2= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
codigoCaja='".$_GET['codigoCaja']."'
and
numCorte='".$_GET['numCorte']."'
and
folioVenta='".$myrow['folioVenta']."' ";
 

$result1b2=mysql_db_query($basedatos,$sSQL1b2);
while($myrow1b2 = mysql_fetch_array($result1b2)){



//*********************************ABONO AL DEPARTAMENTO**********************************************
$sSQL1b= "SELECT * FROM clientesInternos
WHERE
entidad='".$_GET['entidad']."'
and
folioVenta='".$myrow['folioVenta']."' ";
 

$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);


			if($myrow1b['statusDevolucion']=='si' and $myrow1b['statusCargoDevolucion']!='main'  and $myrow1b['tipoPaciente']=='externo' ){
			$sSQL1bc= "SELECT * FROM clientesInternos
			WHERE
			entidad='".$_GET['entidad']."'
			and
			folioDevolucion='".$myrow1b['folioVenta']."' ";
 

			$result1bc=mysql_db_query($basedatos,$sSQL1bc);
			$myrow1bc = mysql_fetch_array($result1bc);
			if($myrow1bc['folioVenta']){
			$descripcionDevolucion=', ***Devolucion  Folio: '.$myrow1bc['folioVenta'];
			$signo='-';
			}
			}else{
			$descripcionDevolucion=NULL;
			$signo=NULL;
			}




//**********************************************
$sSQL1b1= "SELECT * FROM almacenes
WHERE
entidad='".$_GET['entidad']."'

and
almacen='".$myrow1b['almacen']."' ";
 

$result1b1=mysql_db_query($basedatos,$sSQL1b1);
$myrow1b1 = mysql_fetch_array($result1b1);
//*****************************************

if($myrow['abonosCxC']=='si'){ 
$aCxC=$myrow['descripcionArticulo'];


$pdf->Ln(3); //salto de linea
$pdf->SetX('17');
$pdf->Cell(0,0,$myrow1b2['numRecibo'],0,0,M);
$pdf->SetX('30');
$pdf->Cell(0,0,'['.$aCxC.']'.$descripcionDevolucion,0,0,M);
$pdf->SetX('190');
$pdf->Cell(0,0,$signo.'$'.number_format($myrow1b2['precioVenta']*$myrow1b2['cantidad'],2),0,0,M);
$abonos[0]+=$myrow1b2['precioVenta']*$myrow1b2['cantidad'];
} else {


$pdf->Ln(3); //salto de linea
$pdf->SetX('17');
$pdf->Cell(0,0,$myrow1b2['numRecibo'],0,0,M);
$pdf->SetX('30');

if($myrow1b1['descripcion']){
$pdf->Cell(0,0,'['.$myrow1b1['descripcion'].']'.$descripcionDevolucion,0,0,M);
}else{
$pdf->Cell(0,0,$myrow['descripcionArticulo'].' '.$descripcionDevolucion,0,0,M);
}


$pdf->SetX('190');
$pdf->Cell(0,0,$signo.'$'.number_format($myrow1b2['precioVenta']*$myrow1b2['cantidad'],2),0,0,M);
$abonos[0]+=$myrow1b2['precioVenta']*$myrow1b2['cantidad'];
}
}

//****************AQUI VAN LOS CARGOS***********************
















} //********************************CIERRO PARA QUE NO SE REPITA EL FOLIO DE VENTA

$pdf->Ln(3); //salto de linea
$folioVenta=$myrow['folioVenta'];
} //cierra while**************************---------------------------------------------------------------------------------------------------------------






//**************************************MUESTRO TOTALES SOLO DE LA PARTIDA DOBLE************************************
$pdf->Ln(10); //salto de linea
$pdf->SetX('160');
$pdf->Cell(0,0,'Totales: '.'$'.number_format($cargos[0],2),0,0,M);
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($abonos[0],2),0,0,M);
$pdf->Ln(20); //salto de linea
//*************************************************************************************************************************













include('/configuracion/clases/desplegarResumenTransacciones.php');










//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>