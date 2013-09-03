<?PHP require("/var/www/html/sima/INGRESOS HLC/menuOperaciones.php"); 
$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




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