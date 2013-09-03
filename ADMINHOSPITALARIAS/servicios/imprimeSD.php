<?php include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); 
require("/configuracion/clases/despliegaPacientesInternos.php");
require("/configuracion/funciones.php");
$bali=$ALMACEN;
?>
<?php 
$display=new despliegaPacientesInternos();
$ventana='/sima/cargos/imprimeSD.php';
$display->displayPI($entidad,$bali,$ventana,$basedatos);
?>