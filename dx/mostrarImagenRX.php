<?PHP include("/configuracion/ventanasEmergentes.php"); ?><?PHP include("/configuracion/funciones.php"); ?>
<?PHP include("/configuracion/clases/sql.php");include("/configuracion/clases/mostrarImagenRX.php");?>
<?php
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$keyCAP=$_GET['keyCAP'];
$ruta='/sima/dx/mostrarDiagnosticos.php';
$DXRX=new DXRX();
$DXRX->diagnosticosRX($_GET['numeroE'],$_GET['nCuenta'],$ruta,$seguro,$numeroPaciente,$keyCAP,$usuario,$hora1,$fecha1,$basedatos);
?>
