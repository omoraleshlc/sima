<?PHP require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");
$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);


$estilo=new muestraEstilosV2();
$estilo->styles();


if($myrowC['status']=='abierta'){ //*******************Comienzo la validaci�n*****************
include("/configuracion/clases/listadoAltaPxInternos.php");
} else {
?>
<script>
window.alert('LA CAJA ESTA CERRADA');
</script>
<?php
}
?>