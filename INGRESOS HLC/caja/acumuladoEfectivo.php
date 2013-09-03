<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/acumuladoEfectivo.php"); ?>

<?php
$acumula=new acumuladoEfectivo();
$acumula->acumuladosEfectivo($fecha2,$fecha1,$hora1,$entidad,$basedatos);
?>