<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/estadoCuentaE.class.abonos.php"); include("/configuracion/funciones.php"); ?>
<?php //include("/configuracion/clases/respaldoCuentaE.class.php"); include("/configuracion/funciones.php"); ?>
<?php
$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta' ){ //*******************Comienzo la validaci�n*****************

$eCuenta=new eCuentasE();
$eCuenta->eCuentaE(FALSE,$usuario,$entidad,$_GET['almacenSolicitante'],$fecha1,$hora1,$dia,$usuario,$_GET['nT'],$basedatos);
} else {
echo 'La caja esta cerrada';
}
?>
