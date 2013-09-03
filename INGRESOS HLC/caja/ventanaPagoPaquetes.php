<?PHP include("/configuracion/ventanasEmergentes.php");  ?>






<?php 

//*****************************Verificando caja abierta**************************
 $sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($myrowC['status']=='abierta'){ //*******************Comienzo la validación*****************
include("/configuracion/clases/variosPagos.php"); 
$TITULO='';
$pagosDiversos=new variosPagos();
$pagosDiversos->pagosDiversos($usuario,$fecha1,$hora1,$TITULO,$entidad,$ALMACEN,$basedatos);
} else {
echo 'Estimado(a) '.$usuario.': No puedes hacer ninguna transaccion si la caja está cerrada, Gracias!';

}
?>