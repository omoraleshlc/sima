<?PHP include("/configuracion/expedientesclinicos/medicos/medicosmenu.php"); ?>
<?php include("/configuracion/clases/listaCitasMedicos.php"); 
$listadoCitas=new listaCitas();
$listadoCitas->listadoCitas($retorno,$fecha1,$MEDICO,$basedatos);
?>