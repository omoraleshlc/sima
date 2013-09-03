<?php require("menuOperaciones.php");
require('/configuracion/clases/traeFV.php');
$tF=new traerFolios();
$tF->foliosDevolucion($entidad,$basedatos);
?>

