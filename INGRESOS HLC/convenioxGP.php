<?PHP require("menuOperaciones.php"); 
require("/configuracion/clases/listaClientes.php"); ?>
<?php $lista=new listadoClientes();
$TITULO='Convenios x Grupo de Producto';
$ventana='convenioxGPV.php';
$ventana1='despliegaGP.php';
$lista->listaClientes('grupoProducto',$entidad,$ventana,$ventana1,$TITULO,$basedatos);
?>
