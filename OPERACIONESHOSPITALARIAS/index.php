<?php require("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php');
$mostrarmenu=new menus();
$mostrarmenu->menuOperaciones($_GET['main'],$reservado2,$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,'principal',$rutaimagen,$basedatos);
?>