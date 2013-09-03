<?PHP require("menuOperaciones.php"); ?>
<?php require("/configuracion/clases/despliegaExpedientesEnviados.php"); ?>


<?php
$ventana='';

$despliegaExpedientes=new despliegaExpedientesPendientes();
$despliegaExpedientes->despliegaExpedientesEnviados($entidad,$ventana,$fecha1,$hora1,$ALMACEN,$basedatos);
?>
