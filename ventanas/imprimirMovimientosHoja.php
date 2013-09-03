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
$pdf->Cell(0,0,'MOVIMIENTOS DE CAJA',0,0,M);
$pdf->SetX(1);


//*****************ech*************





$fecha1=$_GET['fecha'];
$pdf->SetY(10);
$pdf->Cell(0,0,cambia_a_normal($fecha1),0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,"HOSPITAL LA CARLOTA",0,0,M);
$pdf->SetX(1); 


$pdf->SetXY(2,15);
$pdf->Cell(0,0,"PACIENTES EXTERNOS",0,0,M);
$pdf->SetX(1); 

$pdf->SetXY(2,20);
$pdf->Cell(0,0,"Fecha Impresion: ".date("d/M/Y"),0,0,M);


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
$pdf->Cell(0,0,'RECIBO',0,0,M);

$pdf->SetXY(18,30);
$pdf->Cell(0,0,'CONCEPTO',0,0,M);

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



 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'

and
tipoPaciente='externo'
and
gpoProducto=''
and
naturaleza!='-'
and
ventasDirectas!='si'
order by numRecibo

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$mov+=1;






//*******************SOLO ENTRA AQUI UNA SOLA VEZ

$pdf->Ln(3); //salto de linea






















//*************************************************************************

$sSQL455e= "Select numRecibo from cargosCuentaPaciente where keyClientesInternos='".$myrow['keyClientesInternos']."' and numRecibo!='' order by keyCAP DESC ";
$result455e=mysql_db_query($basedatos,$sSQL455e);
$myrow455e = mysql_fetch_array($result455e);


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow455e['numRecibo'],0,0,M);


$pdf->SetX('15');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);





//DEBEN ESTAR TODAS LAS TRANSACCIONES, LA NATURALEZA NO DEBE SER -
//LA TABLA ES CATTCAJA
switch($myrow['tipoTransaccion']){
    
    
    
    
    //PAGOS EN EFECTIVO, TC , CHEQUE , TRANSFERENCIA
    case "Pxge"://PAGO EN EFECTIVO, TARJETA DE CREDITO, CHEQUE   A-efectivo
        $cash[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    case "pgxp"://PAGO DE GASTOS PARTICULARES 	A
       $gastosparticulares[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    case "pxab"://ABONOS A CUENTA 	A
       $abonos[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
     case "pcoa1"://PAGO DE COASEGURO 1 	A
        $coa1[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
         break;
    
    case "pcoa2"://PAGO DE COASEGURO 2 	A
       $coa2[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    case "pdedu1"://PAGO DE DEDUCIBLE 1 	A
       $deducible1[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    case "pdedu2"://PAGO DE DEDUCIBLE 2 	A
        $deducible2[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    case "pefectivo"://PAGO EN EFECTIVO 	A
        $pagocash[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
	break;
    
        case "pcheq"://PAGO CON CHEQUE 	A
        $pagocheque[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
        case "PTELECTRO"://PAGO TRANSACCION ELECTRONICA 	A
        $pagotransfer[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
        case  "ptarjeta"://PAGO CON TARJETA DE CREDITO 	A
        $pagotc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    
        case "abaseg"://ABONOS DE ASEGURADORAS 	A
        $abonoaseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;

	case "abotros"://ABONOS OTROS 	A
        $abonosotros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
	$naturaleza='A';
        break;
    
    //*****************CIErRA BANCOS*******************
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
//TRASLADOS    
    case "taseg"://TRASLADO A ASEGURADORA 	A
        $trasladocxc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;   
       
    case "tnom"://	TRASLADO A NOMINA 	A
        $nomina[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    
     case "totros"://TRASLADO A OTROS 	A
       $trasladootros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
       $naturaleza='A';
        break;
    
        case "APLCORT"://CORTESIA 	A
        $trasladocortesia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
        case "txbene"://TRASLADO A BENEFICENCIA 	A
        $trasladobeneficencia+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
            break;
    //CIERRO TRASLADOS
    
    
    
    
    
    
    
    
    
    //VENTAS DIRECTAS
    case "vdirC"://ABONO POR UNA VENTA DIRECTA 	A
        $vdirectaa[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
        break;
    
    case "vdira"://VENTA DIRECTA 	A
        $vdirectac[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
	break;
    //*********************
    
    
    
    
    
    
    
    
    
    //REGRESOS*******
    case "devAseg"://REGRESO ASEGURADORA 	C
        $regresoaseguradora[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
	break;
    
    case "devEfe"://REGRESO DE EFECTIVO 	C
       $regresoefectivo[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad']; 
        $naturaleza='C';
	break;
    //***CIERRO REGRESOS
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
 	
	//*********DEVOLUCIONES**************
	case "devxef"://DEVOLUCION EFECTIVO 	C
        $devcash[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
            $naturaleza='C';
	break;

	case "devxaseg"://DEV.  TRASLADO ASEGURADORA 	C
        $devtrasladoaseg[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
            $naturaleza='C';
	break;
        //************************************
    	
  
  
    
    
    
    
    
    
    
    
    
        //*****DESCUENTOS**************
        case "desc"://DESCUENTO PARTICULARES 	A
        $descuentoparticulares[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
            $naturaleza='A';
        break;
    
        case "DESCAS"://DESCUENTO A ASEGURADORAS 	A
        $descuentoaseguradoras[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
            $naturaleza='A';
        break;
        //***********************************
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
    

    //*************DEVOLUCIONES******************
    case "devxtc"://DEVOLUCION TARJETA DE CREDITO 	C
       $devoluciontc[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
        break;
    
    case "devxch"://DEVOLUCION CHEQUES 	C
       $devcheques[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
        break;
    
    case "devxtel"://DEVOLUCION TRANSFERENCIA ELECTRONICA 	C
       $devte[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
        break;
    
    case "devxnom"://DEVOLUCION NOMINA 	C
        $devnomina[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
        break;
    
    case "DEVXB"://	DEVOLUCION BENEFICENCIA 	C
        $devbeneficencia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
        break;
    

    
    case "devotr"://DEVOLUCION A OTROS 	C
        $devotros[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
	break;
    
    
    
    case "DEVxVD"://DEVOLUCION POR UNA VENTA DIRECTA 	C
        $devventadirecta[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='C';
	break;

 	case "devxco"://DEVOLUCION DE UNA CORTESIA 	C
        $devcortesia[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
            $naturaleza='C';
	break;

	case "DEVABOASEG"://DEVOLUCION ABONOS ASEGURADORA 	C
        $devolucionAbonoAseguradoras[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
            $naturaleza='C';
	break;
    //****************************************************
    
    
    
    
    
    //*********CANCELACIONES
    case "candes"://CANCELACION DESCUENTO 	C debe ser A
        $cancelardescuento[0]+=$myrow1a['precioVenta']*$myrow1a['cantidad'];
        $naturaleza='A';
	break;
    
    
    
    
    
    
    
}








if($naturaleza=='C' ){
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2),0,0,M);
$debe[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}




if($naturaleza=='A'  ){
$pdf->SetX('190');
$pdf->Cell(0,0, '$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
$haber[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
} 










































$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------





























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
$pdf->Cell(0,0,'$'.number_format($debe[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,'$'.number_format($haber[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debe[0]-$haber[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);


//*************************************************************************************************************************






































//*********************************************************************************PACIENTES INTERNOS*************************************************











$pdf->Ln(15); //salto de linea
$pdf->SetX(2);

$pdf->Cell(0,0,"PACIENTES INTERNOS",0,0,M);
$pdf->SetX(1); 
$pdf->Ln(5); //salto de linea


 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
gpoProducto=''
and
(naturaleza='A' or naturaleza='C')
and
ventasDirectas!='si'


order by numRecibo

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$mov+=1;






//*******************SOLO ENTRA AQUI UNA SOLA VEZ

$pdf->Ln(3); //salto de linea











if($myrow['naturaleza']=='C' ){
$debeI[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
$debI=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}else if($myrow['naturaleza']=='A' ){ 
$haberI[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
$habI=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}




//*************************************************************************


$sSQL455e= "Select numRecibo from cargosCuentaPaciente where keyClientesInternos='".$myrow['keyClientesInternos']."' and numRecibo!='' order by keyCAP DESC ";
$result455e=mysql_db_query($basedatos,$sSQL455e);
$myrow455e = mysql_fetch_array($result455e);


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow455e['numRecibo'],0,0,M);



$pdf->SetX('18');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);






if($myrow['naturaleza']=='C' ){
$pdf->SetX('170');
$pdf->Cell(0,0, '$'.number_format($debI,2),0,0,M);
}else if($myrow['naturaleza']=='A' ){
$pdf->SetX('190');
$pdf->Cell(0,0,'$'.number_format($habI,2),0,0,M);
}


//*****************************************************************







































$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























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
$pdf->Cell(0,0,''.'$'.number_format($debeI[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haberI[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debeI[0]-$haberI[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);


//*************************************************************************************************************************


































//*********************************************************************************VENTAS DIRECTAS*************************************************











$pdf->Ln(15); //salto de linea
$pdf->SetX(2);

$pdf->Cell(0,0,"VENTAS DIRECTAS",0,0,M);
$pdf->SetX(1); 
$pdf->Ln(5); //salto de linea


 $sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'

and
gpoProducto=''
and
(naturaleza='A' or naturaleza='C')
and
ventasDirectas='si'


order by numRecibo

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$mov+=1;






//*******************SOLO ENTRA AQUI UNA SOLA VEZ

$pdf->Ln(3); //salto de linea











if($myrow['naturaleza']=='C' ){

$debeVD[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
$debVD=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);

}else if($myrow['naturaleza']=='A' ){ 

$haberVD[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
$habI=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);

}




//*************************************************************************


$sSQL455e= "Select numRecibo from cargosCuentaPaciente where keyClientesInternos='".$myrow['keyClientesInternos']."' and numRecibo!='' order by keyCAP DESC ";
$result455e=mysql_db_query($basedatos,$sSQL455e);
$myrow455e = mysql_fetch_array($result455e);


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow455e['numRecibo'],0,0,M);



$pdf->SetX('18');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);







$pdf->SetX('170');
$pdf->Cell(0,0,    '$'.number_format($debVD,2),0,0,M);

$pdf->SetX('190');
$pdf->Cell(0,0,    '$'.number_format($habI,2),0,0,M);



//*****************************************************************







































$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























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
$pdf->Cell(0,0,''.'$'.number_format($debeVD[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haberVD[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debeVD[0]-$haberVD[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);





















$pdf->Ln(15); //salto de linea



$pdf->SetX(2);

$pdf->Cell(0,0,"ABONOS ASEGURADORAS",0,0,M);
$pdf->SetX(1); 
$pdf->Ln(5); //salto de linea


$sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
gpoProducto=''
and
(tipoTransaccion='abaseg' or tipoTransaccion='DEVABOASEG')
and
ventasDirectas!='si'

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$mov+=1;






//*******************SOLO ENTRA AQUI UNA SOLA VEZ

$pdf->Ln(3); //salto de linea











if($myrow['naturaleza']=='C' ){
$debeI2[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}else if($myrow['naturaleza']=='A' ){
$haberI2[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}




//*************************************************************************
$sSQL455e= "Select numRecibo from cargosCuentaPaciente where keyClientesInternos='".$myrow['keyClientesInternos']."' and numRecibo!='' order by keyCAP DESC ";
$result455e=mysql_db_query($basedatos,$sSQL455e);
$myrow455e = mysql_fetch_array($result455e);


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow455e['numRecibo'],0,0,M);



$pdf->SetX('18');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);








$pdf->SetX('170');
if($myrow['naturaleza']=='C'){
$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
}

$pdf->SetX('190');
if($myrow['naturaleza']=='A'){
$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
}
//*****************************************************************







































$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























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
$pdf->Cell(0,0,''.'$'.number_format($debeI2[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haberI2[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debeI2[0]-$haberI2[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);


//*************************************************************************************************************************






















//*********************************************************************************PACIENTES INTERNOS*************************************************











$pdf->Ln(15); //salto de linea



$pdf->SetX(2);

$pdf->Cell(0,0,"ABONOS OTROS",0,0,M);
$pdf->SetX(1); 
$pdf->Ln(5); //salto de linea


$sSQL= "SELECT * FROM cargosCuentaPaciente
WHERE
entidad='".$_GET['entidad']."'
and
fecha1='".$fecha1."'
and
status='transaccion'
and
descripcionTransaccion='pagosOtros'
and
ventasDirectas!='si'

";
 

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$mov+=1;






//*******************SOLO ENTRA AQUI UNA SOLA VEZ

$pdf->Ln(3); //salto de linea










if($myrow['naturaleza']=='C'  ){ 
$debeI3[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}else if($myrow['naturaleza']=='A'  ){
$haberI3[0]+=($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']);
}



$sSQL455e= "Select numRecibo from cargosCuentaPaciente where keyClientesInternos='".$myrow['keyClientesInternos']."' and numRecibo!='' order by keyCAP DESC ";
$result455e=mysql_db_query($basedatos,$sSQL455e);
$myrow455e = mysql_fetch_array($result455e);


$pdf->SetX('2');
$pdf->Cell(0,0,$myrow455e['numRecibo'],0,0,M);



$pdf->SetX('18');
$pdf->Cell(0,0,$myrow['descripcionArticulo'],0,0,M);



$pdf->SetX('170');
if($myrow['naturaleza']=='C'){
$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
}

$pdf->SetX('190');
if($myrow['naturaleza']=='A'){
$pdf->Cell(0,0,'$'.number_format(($myrow['precioVenta']*$myrow['cantidad'])+($myrow['iva']*$myrow['cantidad']),2),0,0,M);
}







//*****************************************************************







































$pdf->Ln(3); //salto de linea

} //cierra while**************************---------------------------------------------------------------------------------------------------------------




























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
$pdf->Cell(0,0,''.'$'.number_format($debeI3[0],2),0,0,M);

$pdf->SetX('130');
$pdf->Cell(0,0,' '.'$'.number_format($haberI3[0],2),0,0,M);










$pdf->Ln(4); //salto de linea */
$pdf->SetX('110');
$pdf->Cell(0,0,'Totales '.'$'.number_format($debeI3[0]-$haberI3[0],2),0,0,M);
$pdf->Ln(4); //salto de linea */


$pdf->SetX('100');
$pdf->Cell(0,0,'* * * * * * * * * * * * * * * * * * * * * * * *',0,0,L);










$pdf->Ln(15); //salto de linea


















//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
