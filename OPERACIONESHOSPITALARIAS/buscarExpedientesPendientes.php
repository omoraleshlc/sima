<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");?>
<?php require("/configuracion/clases/buscarExpedientesPendientes.php"); ?>


<?php
$ventana='';

$despliegaExpedientes=new despliegaExpedientesPendientes();
$despliegaExpedientes->despliegaExpedientes($entidad,$ventana,$fecha1,$hora1,$_GET['datawarehouse'],$basedatos);
?>
