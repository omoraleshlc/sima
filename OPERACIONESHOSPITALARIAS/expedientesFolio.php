<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");$almacen=$ALMACEN=$_GET['datawarehouse']; ?>
<?php require("/configuracion/clases/expedientessFV.php"); ?>



<?php  

$buscarExpediente=new expedientes();
$buscarExpediente->expedientesDuplicados($ALMACEN,$fecha1,$hora1,$entidad,$usuario,$numeroE,$basedatos); ?>