<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>
<?php 

if($_GET['almacen']=='HCEX'){
include("/configuracion/clases/cargosPaquetes.php"); 
} else {
include("/configuracion/clases/formasCapturaPaquetes.php"); 
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$credencial=$_GET['credencial'];
$medico=$_GET['medico'];
$almacenSolicitante=$_GET['almacen'];
$nCuenta=$_GET['nCuenta'];
$tipoCargo=$_GET['tipoCargo'];
$almacenDestino=$_POST['almacenDestino'];
$tipoPaciente=$_GET['tipoPaciente'];
$banderaCXC=$_GET['banderaCXC'];
 $fechaSolicitud=$_GET['fechaSolicitud'];
 $horaSolicitud=$_GET['horaSolicitud'];
 
$solicitar=new solicitarPaquetes();
$solicitar->solicitaPaquete($entidad,$almacenSolicitante,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
}
?>