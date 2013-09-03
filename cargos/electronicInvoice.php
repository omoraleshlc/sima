<?php require("/configuracion/ventanasEmergentes.php");

$idSucursal=106136;
$propina='0.00';

function noRound($val, $pre = 0) {
    $val = (string) $val;
    if (strpos($val, ".") !== false) {
        $tmp = explode(".", $val);
        $val = $tmp[0] .".". substr($tmp[1], 0, $pre);
    }
    return (float) $val;
} 


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
$myFile = "/tmp/factura.fxt";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = "Bobby Bopper\n";
fwrite($fh, $stringData);
$stringData = "Tracy Tanner\n";
fwrite($fh, $stringData);
fclose($fh);
 */
$sSQL455= "Select * from datosfacturacion where entidad='".$_GET['entidad']."' and numSolicitud='".$_GET['numSolicitud']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);


$sSQL455ho= "Select * From datosFiscalesEntidades where
 entidad='".$_GET['entidad']."' ";
$result455ho=mysql_db_query($basedatos,$sSQL455ho);
$myrow455ho = mysql_fetch_array($result455ho);


if(!$myrow455ho['RFC']){
    echo '<script>';
    echo 'window.alert("ERROR EN DATOS FISCALES!");';
    echo 'window.close();';
    echo '</script>';    
}




$cadena1=
'rfcEmisor|idSucursal|fechaYhora|importe|noTicket|propina|concepto|RFCRecpetor|idTransaccion|cc';

//ACTUALIZACION
 $sSQL7="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$_GET['entidad']."'
and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  naturaleza='C'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
 SUM(importe*cantidad) as acumulado,sum(iva*cantidad) as ivaa
  FROM
facturasAplicadas
  WHERE
entidad='".$_GET['entidad']."'
and
  numSolicitud='".$_GET['numSolicitud']."'
and

  naturaleza='A'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
  
  
//$observaciones='Prueba de Mañana'  ;
//********************************************************************
$importe=  ($myrow7['acumulado']+$myrow7['ivaa'])-($myrow7d['acumulado']-$myrow7d['ivaa']);
 $cadena1=
'TR|rfcEmisor|idSucursal|fechaYHora|importe|noTicket|propina|concepto|RFCRecpetor|idTransaccion|cc|metodoPago| 
digitosTarjeta|idMoneda|tipoCambio|tipoCFDI|observaciones|idComplementos
CN|Cantidad|Unidad|Concepto|PrecioUnitario|Descuento|Importe|ImporteImpuesto
TI|Tipo|Importe|impuesto|Tasa';
 
$r= eregi_replace('-', '', $myrow455['rfc']);



$cadena1=
'TR'.'|'.utf8_encode(trim($myrow455ho['RFC'])).'|'.$idSucursal.'|'.$fecha1.'T'.date("H:m:s").'|'.noRound($importe,2).'|'.utf8_encode($_GET['ticket']).'|'.$propina.'|'.
utf8_encode('Ventas').'||'.utf8_encode($_GET['ticket']).'||'.utf8_encode('Efectivo').'|||||'.utf8_encode($_GET['numFactura']);



$sSQL= "
SELECT * FROM facturasAplicadas
WHERE 
entidad='".$_GET['entidad']."'
and
numSolicitud='".$_GET['numSolicitud']."'
group by gpoProducto";


$result=mysql_db_query($basedatos,$sSQL);
while ($myrow = mysql_fetch_array($result)){
    $totalR+=1;
    $C=$myrow['gpoProducto'];
    $sSQL38= "
SELECT 
tasaGP,descripcionGP,separadoAlmacen,impresionFactura,descripcionImpresion
FROM
gpoProductos
WHERE 
codigoGP='".$C."'";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);
$concepto=$myrow38['descripcionGP'];

//*************************OPERACIONES*****************************

  $sSQL7="SELECT 
 SUM(importe) as acumulado,sum(iva*cantidad) as ivaa,sum(importe*cantidad) as importe
  FROM
facturasAplicadas
  WHERE
entidad='".$_GET['entidad']."'
and
  numSolicitud='".$_GET['numSolicitud']."'
  and
  gpoProducto='".$C."'   
  and
  naturaleza='C'
  ";
 
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);




 $sSQL7d="SELECT 
 SUM(importe) as acumulado,sum(iva*cantidad) as ivaa,sum(importe*cantidad) as importe
  FROM
facturasAplicadas
  WHERE
entidad='".$_GET['entidad']."'
and
  numSolicitud='".$_GET['numSolicitud']."'
and
  gpoProducto='".$C."'   
    and
  naturaleza='A'
  ";
 
  $result7d=mysql_db_query($basedatos,$sSQL7d);
  $myrow7d = mysql_fetch_array($result7d);
//********************************************************************
$importe= (float) ($myrow7['acumulado'])-($myrow7d['acumulado']);

if($myrow7['ivaa']>0){
    $i=(float) $myrow7['ivaa']-$myrow7d['ivaa'];
}else{
    $i=0.00;
}

$precioUnitario=$myrow7['acumulado']-$myrow7d['acumulado'];
$importe=$myrow7['importe']-$myrow7d['importe'];
$c=(float) $myrow7['c']-$myrow7d['c'];
$iva[0]+=(float) $myrow7['ivaa']-$myrow7d['ivaa'];


$descuento=0;



/*
$cadena2[]=
$myrow455e['RFC'].'|'.$_GET['entidad'].'|'.date("d/M/Y H:m:s").'|'.$importe.'|'.$myrow['folioVenta'].'|'.'0'.'|'.$concepto.'|'.$myrow455['rfc'].'|'.$_GET['numFactura'].'|'.$_GET['email'];
*/






//-----------------------EJEMPLOS-----------------------------
/*
TR|rfcEmisor|idSucursal|fechaYHora|importe|noTicket|propina|concepto|RFCRecpetor|idTransaccion|cc|metodoPago| 
digitosTarjeta|idMoneda|tipoCambio|tipoCFDI|observaciones|idComplementos
CN|Cantidad|Unidad|Concepto|PrecioUnitario|Descuento|Importe| ImporteImpuesto
TI|Tipo|Importe|impuesto|Tasa


Método de Pago Efectivo – Tipo Moneda Pesos Mexicanos - CFDI
TR|COAS08031980AM|1489|207/09/2011 14:25:00|500.00|00012875|10.00|Consumo|TOMM08051980AM2|00012875|cliente@hotmail.com|Efectivo|
|1|1|1|CFDI de Prueba||
CN|1|Pieza|Descripción Producto|1.00|0|5.0|0.16
CN|2|KG|Descripción Producto|3.00|0|1.0|0.48
CN|2|Metros|Descripción Producto|8.00|0|6.0|1.28
TI|T|IVA|0.16|16
        
        
Método de Pago Electrónico - Tipo Moneda Dólar - CFDI
TR|COAS08031980AM|1489|207/09/2011 14:25:00|500.00|00012875|10.00|Consumo|TOMM08051980AM2|00012875|cliente@hotmail.com|Tarjeta 
Credito|01235986452|2|14.50|1|CFDI de Prueba||
CN|1|Pieza|Descripción Producto|1.00|0|5.0|0.16
CN|2|KG|Descripción Producto|3.00|0|1.0|0.48
CN|2|Metros|Descripción Producto|8.00|0|6.0|1.28
TI|T|IVA|0.16|16
  
 
Método de Pago Efectivo – Tipo Moneda Pesos Mexicanos – CFDI – Complemento Donatarias
TR|COAS08031980AM|1489|207/09/2011 14:25:00|500.00|00012875|10.00|Consumo|TOMM08051980AM2|00012875|cliente@hotmail.com|Efectivo|
|1|1|1|CFDI de Prueba|1
CN|1|Pieza|Descripción Producto|1.00|0|5.0|0.16
CN|2|KG|Descripción Producto|3.00|0|1.0|0.48
CN|2|Metros|Descripción Producto|8.00|0|6.0|1.28
TI|T|IVA|0.16|16
 * 
 * 
 * 
 * 
*/
//--------------------------------------------------------------

$cadena2[]=
utf8_encode('CN').'|'.'1'.'|'.'su'.'|'.utf8_encode($concepto).'|'. noRound($precioUnitario,2).'|' . noRound($descuento,2).'|'.noRound($precioUnitario+$i,2).'|'.noRound($i,2);
$mT[0]+=(float) $importe;

}







$sSQL38= "
SELECT 
*
FROM
TASA
WHERE
valorTasa>0
";
$result38=mysql_db_query($basedatos,$sSQL38);
$myrow38 = mysql_fetch_array($result38);




if($iva[0]>0){
    $valorTasa=(float) $myrow38['valorTasa']/100;
    $codTasa=(float) $myrow38['valorTasa']; 
    $ir=$iva[0];
} else{ 
    $valorTasa=0;
    $codTasa=0;
    $ir=0.00;
}




//   TI|0|IVA
$cadena3=utf8_encode('TI').'|'.utf8_encode('0').'|'.noRound($ir,2)."\n";



if($totalR>1){
//   IT|20.88|IVA|16
$cadena4=utf8_encode('IT').'|'.noRound($ir,2).'|'.utf8_encode('IVA').'|'.$codTasa;
}
?>





<?php
//GENERAMOS EL ARCHIVO
$myFile = '/temp/entrada/t'.$_GET['numFactura'].'-'.$_GET['ticket'].'.fxt';

//shell_exec($myFile);
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $cadena1;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
fwrite($fh, $stringData);
fputs($fh,"\n");
    
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf));     
for($i=0;$i<$totalR;$i++){
$stringData = $cadena2[$i];
fwrite($fh, $stringData);
fputs($fh,"\n");
}

$stringData = $cadena3;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
fwrite($fh, $stringData);



if($totalR>1){
$stringData = $cadena4;
//fwrite($fh, pack("CCC",0xef,0xbb,0xbf)); 
fwrite($fh, $stringData);
}


fclose($fh);
?>


<?php

if($totalR>0){
 echo '<script>';
 echo 'window.alert("ARCHIVO GENERADO CORRECTAMENTE! TICKET: '.$_GET['ticket'].', RFC: '.$r.', IMPORTE: '.(float) number_format(noRound($mT[0]+$iva[0],2),2).' ");';
echo 'window.close();';
 echo '</script>';
}else{
 echo '<script>';
  echo 'window.alert("HAY UN PROBLEMA!");';
   echo 'window.close();';
    echo '</script>';
}




function writeUTF8File($filename,$content) { 
        $f=fopen($filename,"w"); 
        # Now UTF-8 - Add byte order mark 
        fwrite($f, pack("CCC",0xef,0xbb,0xbf)); 
        fwrite($f,$content); 
        fclose($f); 
}
?>