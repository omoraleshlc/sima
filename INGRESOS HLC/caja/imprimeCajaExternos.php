<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/cierraCuenta3.php"); ?>

<?php
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($myrowC['status']=='abierta' ){ //*******************Comienzo la validación*****************

$eCuenta=new eCuentasE();
$eCuenta->eCuentaE($_GET['folioVenta'],$usuario,$entidad,$_GET['almacenSolicitante'],$fecha1,$hora1,$dia,$usuario,$_GET['nT'],$basedatos);
} else {
echo 'La caja está cerrada';
}
?>
