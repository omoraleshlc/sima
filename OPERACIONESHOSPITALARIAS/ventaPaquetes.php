
<?php require("menuOperaciones.php"); ?>
<?php require("/configuracion/clases/mostrarPacientesPaquetes.php"); ?>



<?php

$ventana1='/sima/ventanas/modificarP.php';
$ventana='/sima/ventanas/ventanaAsignarPaquete.php';
$TITULO='Asignar un paquete a un paciente';
$mostrarPacientes=new listaPX();
$mostrarPacientes->mostrarPacientes($ventana1,$ventana,$entidad,$TITULO,$_GET['datawarehouse'],$usuario,$numeroE,$basedatos);
?>