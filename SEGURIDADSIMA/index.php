<?php require("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php');
$mostrarmenu=new menus();
$mostrarmenu->menuOperaciones($_GET['main'],$_GET['primario'],$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,'principal',$rutaimagen,$basedatos);
?>
<?PHP //require("/configuracion/ingresoshlcmenu/menuingresoshlc.php"); ?>