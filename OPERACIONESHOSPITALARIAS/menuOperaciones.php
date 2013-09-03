<?php require("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php');
$mostrarmenu=new menus();
$mostrarmenu->menuOperacionesF($_GET['warehouse'],$_GET['datawarehouse'],$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,'principal',$rutaimagen,$basedatos);
?>