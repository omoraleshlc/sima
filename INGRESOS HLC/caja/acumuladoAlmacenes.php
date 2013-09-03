<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/acumuladoAlmacenes.php"); ?>

<?php
$acumula=new acumuladoAlmacenes();
$acumula->acumuladosAlmacenes($fecha2,$fecha1,$hora1,$entidad,$basedatos);
?>