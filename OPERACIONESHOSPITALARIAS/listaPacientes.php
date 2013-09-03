<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>
<?php require("/configuracion/clases/historialPx.php"); ?>

<?php
$TITULO='Consultar Historial Paciente';
$historial=new historialPacientesC();
$historial->historialPacientes($entidad,$TITULO,$basedatos);

?>  