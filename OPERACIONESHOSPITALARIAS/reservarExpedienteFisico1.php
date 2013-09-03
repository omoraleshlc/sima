<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/desplegarListaPacientes.php"); ?>


<?php  $despliegaPx=new desplegar();
$despliegaPx->internarPaciente($TITULO,'/sima/cargos/reservarExpedienteFisico2.php',$ventana2,$keyPacientes,$entidad,$hora,$fecha,$_GET['datawarehouse'],$usuario,$numeroE,$basedatos);
?>
