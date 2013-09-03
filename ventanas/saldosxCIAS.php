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
$pdf->Cell(0,0,'HOSPITAL LA CARLOTA',0,0,M);
$pdf->SetX(1);


//*****************ech*************



$entidad=$_GET['entidad'];
$date=date("d/m/Y");
$fe=$_GET['fechaCorte'];
$fecha1=date("Y-m-d");
$pdf->SetY(10);
$pdf->Cell(0,0,'Fecha de Impresion '.$date,0,0,R);



$pdf->SetXY(2,10);
$pdf->Cell(0,0,utf8_decode("SALDOS POR COMPAÑIAS"),0,0,M);
$pdf->SetX(1);


$pdf->SetXY(2,13);
$pdf->Cell(0,0,"",0,0,M);
$pdf->SetX(1);

$pdf->SetXY(2,16);
$pdf->Cell(0,0,"Fecha de Corte ".cambia_a_normal($_GET['fechaCorte']),0,0,M);




$pdf->SetFont('Arial','',10);
$pdf->line(2,32,203,32);




$pdf->SetXY(2,30);
$pdf->Cell(0,0,'#',0,0,M);

$pdf->SetXY(10,30);
$pdf->Cell(0,0,'COMPANIA',0,0,M);

//*************TRANSACCIONES***************



$pdf->SetXY(170,30);
$pdf->Cell(0,0,'Importe',0,0,M);


//****************************************

//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);

//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea






$sSQL2= "Select * From entidades WHERE keyEntidades = '".$entidad."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


$pdf->SetFont('Arial','',8);
$pdf->SetXY(2,7);
$pdf->Ln(25); //salto de linea

$sSQLp= "Select fechaApertura from entidades
WHERE
codigoEntidad='".$entidad."'


";


$resultp=mysql_db_query($basedatos,$sSQLp);
$myrowp = mysql_fetch_array($resultp);

 $sSQL= "
select * from
clientes
where entidad='".$entidad."'
    and
    subCliente=''
    order by nomCliente ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;



$pdf->SetX('2');
$pdf->Ln(4); //salto de linea


$sSQLcp="SELECT saldoInicial
FROM
clientes
WHERE
entidad='".$entidad."'
and

numCliente='".$myrow['numCliente']."'
 ";
$resultcp=mysql_db_query($basedatos,$sSQLcp);
$myrowcp = mysql_fetch_array($resultcp);


if($fecha1>$myrow2['fechaApertura'] and $myrow2['fechaApertura']>0){
$sSQL1c="SELECT sum(precioVenta*cantidad) as cargos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
clientePrincipal='".$myrow['numCliente']."'
and
(tipoTransaccion='taseg' or tipoTransaccion='tnom' or tipoTransaccion='DEVABOASEG')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<='".$fe."'
";
$result1c=mysql_db_query($basedatos,$sSQL1c);
$myrow1c = mysql_fetch_array($result1c);

$sSQL1a="SELECT sum(precioVenta*cantidad)  as abonos

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow['numCliente']."'
and
(tipoTransaccion='devxaseg' or tipoTransaccion='abaseg' )
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<='".$fe."'

";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);


$sSQLnc="SELECT sum(precioVenta*cantidad)  as nc

FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
gpoProducto=''
and
clientePrincipal='".$myrow['numCliente']."'
and
(notaCredito='si' and naturaleza='A')
and
fecha1>'".$myrow2['fechaApertura']."' and fecha1<='".$fe."'

";
$resultnc=mysql_db_query($basedatos,$sSQLnc);
$myrownc = mysql_fetch_array($resultnc);




$c=($myrow1c['cargos']-($myrow1a['abonos']+$myrownc['nc']))+$myrowcp['saldoInicial'];
}else{
$c=$myrowcp['saldoInicial'];
}







$saldosIniciales=$c;
//echo '$'.number_format( $c,2);
$totales[0]+=$c;


$pdf->SetX('1');
$pdf->Cell(0,0,$a,0,0,M);
$pdf->SetX('10');
$pdf->Cell(0,0,$myrow['nomCliente'],0,0,M);
$pdf->SetX('170');
$pdf->Cell(0,0,'$'.number_format($c,2),0,0,M);



















} //cierra while**************************---------------------------------------------------------------------------------------------------------------
























































































//*************TOTALES
$pdf->Ln(10); //salto de linea
$pdf->SetX('70');
$pdf->Cell(0,0,"TOTALES $".number_format($totales[0],2),0,0,M);




















//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>