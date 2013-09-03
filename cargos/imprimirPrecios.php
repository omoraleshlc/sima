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



    





//require("/configuracion/funciones.php"); 
$usuario="omorales";
$passwd='wolf3333';
$servidor='localhost';
$basedatos='sima';
mysql_connect($servidor,$usuario,$passwd); 		


//******************************************************************
//clases fuera









if(!$_GET['particular'] and !$_GET['aseguradora']){
$_GET['particular']='si';
$_GET['aseguradora']='si';
}


$pdf->SetFont('Arial','',7);
//establece el nombre del paciente



$pdf->SetXY(18,18);
$pdf->Cell(0,0,'Código            Descripción',0,0,L);


$pdf->SetXY(50,18);
$pdf->Cell(0,0,$ctaMayor,0,0,L);

if($_GET['particular']=='si'){
$pdf->SetXY(170,18);
$pdf->Cell(0,0,'Part.',0,0,L);
}

if($_GET['aseguradora']=='si'){
$pdf->SetXY(182,18);
$pdf->Cell(0,0,'Aseg.',0,0,L);
}


$pdf->SetY(5);
$pdf->Cell(0,0,$numeroTransaccion,0,0,R);
//numero de paciente

$pdf->SetXY(18,10);
$pdf->Cell(0,0,'LISTADO DE PRECIOS '.$_GET['almacen'],0,0,L);
$pdf->SetX(1);


//cambiar fecha
//$myrow1['fecha1']=cambia_a_normal($myrow1['fecha1']);
$fecha1=date("d/m/Y");
$pdf->SetXY(170,10);
$pdf->Cell(0,0,$fecha1,0,0,L);
//Imprimo con salto de pagina
$pdf->Ln(15); //salto de linea



$pdf->SetFont('Arial','',5);
$pdf->SetXY(30,7);

$pdf->Ln(15); //salto de linea



if($_GET['referido']=='si'){
$sSQL= "SELECT *
FROM
articulos,existencias

WHERE
existencias.codigo=articulos.codigo
and
existencias.almacen='".$_GET['almacen']."'
and
articulos.gpoProducto='".$_GET['gpoProducto']."'
and
articulos.referido='si'
order by 
articulos.descripcion ASC";


} else {
$sSQL= "SELECT *
FROM
articulos,existencias

WHERE
existencias.codigo=articulos.codigo
and
existencias.almacen='".$_GET['almacen']."'
and
articulos.gpoProducto='".$_GET['gpoProducto']."'
order by 
articulos.descripcion ASC
 ";
}
 
 
 
 
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){
$codigo=$myrow['codigo'];
$gpoProducto=$myrow['gpoProducto'];
$SUBTOTAL[0]+=$myrow['precioVenta']*$myrow['cantidad'];

$sSQL3= "SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE codigo ='".$codigo."' 
 ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$um=$myrow3['um'];

$codigoTT=$myrow['tipoTransaccion'];
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);


$code=$myrow39['prefijo'].$myrow['codigo'];

$pdf->Ln(1); //salto de linea
$pdf->SetX('18');

$pdf->Cell(0,0,trim($code."     ".$myrow['descripcion']),0,0,L);




if($_GET['particular']=='si'){
$pdf->SetX('170');
$pdf->Cell(0,0,"$".number_format($myrow3['nivel1'],2),0,0,M);
}

if($_GET['aseguradora']=='si'){
$pdf->SetX('182');
$pdf->Cell(0,0,"$".number_format($myrow3['nivel3'],2),0,0,M);
}


$pdf->Ln(2); //salto de linea
//$pdf->Ln(1); //salto de linea

}

//function Header() { 

//} 

//function Footer() { 
//$this->Image('/sima/imagenes/logohlc.jpg'); 
//}











//Launch the print dialog
//$pdf->AutoPrint(true);
$pdf->Output();
?>
