<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); ?>
<?php require("/configuracion/clases/formas.php"); ?>
<?php require("/configuracion/clases/formasInternos.php"); ?>
<?php require("/configuracion/clases/formasCapturaPaquetes.php"); ?>
<?php require("/configuracion/clases/articulosReferidos.php"); ?>
<?php
$numeroPaciente=		$_GET['numeroE'];
$seguro=				    $_GET['seguro'];
$medico=					$_GET['medico'];
$almacenSolicitante= $_GET['almacen'];
$nCuenta=				$_GET['nCuenta'];
$tipoCargo=				$_GET['tipoCargo'];
$almacenDestino=		$_POST['almacenDestino'];
$tipoPaciente=			$_GET['tipoPaciente'];
?>

<script>
function cerrarVentana(){
close();
}
</script> 

<form name="form5" id="form5" method="GET" action="">
  <div align="center">

<input name="numeroE" type="hidden" value="<?php echo $_GET['numeroE']?>" />
	<input name="seguro" type="hidden" value="<?php echo $_GET['seguro']?>" />
		<input name="medico" type="hidden" value="<?php echo $_GET['medico']?>" />
			<input name="almacen" type="hidden" value="<?php echo $_GET['almacen']?>" />
				<input name="nCuenta" type="hidden" value="<?php echo $_GET['nCuenta']?>" />
					<input name="tipoCargo" type="hidden" value="<?php echo $_GET['tipoCargo']?>" />
						<input name="almacenDestino" type="hidden" value="<?php echo $_GET['almacenDestino']?>" />
							<input name="tipoPaciente" type="hidden" value="<?php echo $_GET['tipoPaciente']?>" />
     						    <input name="keyClientesInternos" type="hidden" value="<?php echo $_GET['keyClientesInternos']?>" />

    <table width="487" >
      			<tr>
				
        <td width="161" align="center">
								<input name="cargar" type="submit"  id="cargar" value="Cargar Articulos" /></td>
        <td width="198" align="center">
								<input name="desplegar" type="submit"   id="desplegar" value="Revisar Art&iacute;culos" /></td>
        <td width="128" align="center">
								<input name="close" type="submit"  id="close" value="Cerrar Ventana (x)" onclick="cerrarVentana()" /></td>
      			</tr>
    </table>
<hr />
  </div>
</form>
<?php 
$solicitaArticulos=new solicitar();
$desplegar=new displayArticulos();
$solicitaPaquete=new solicitarPaquetes();
$articulosReferidos=new referirArticulos();

if($_GET['cargar'] or (!$_GET['articulosReferidos'] and !$_GET['desplegar'])){

$solicitaArticulos->solicitaArticulos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
} else if($_GET['desplegar']){
$desplegar->despliegaArticulos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
} else if($_GET['cargarPaquete']){
$solicitaPaquete->solicitaPaquete($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
} else if($_GET['articulosReferidos']){

$articulosReferidos->articulosReferidos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
}
?>