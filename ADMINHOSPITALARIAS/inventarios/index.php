<?PHP require("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>

<?PHP
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('ACCESANDO A INVENTARIOS','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
 ?>
<style type="text/css">
<!--
body {
	background-image: url(/sima/imagenes/imagenesModulos/inventario1.png);
}
-->
</style>