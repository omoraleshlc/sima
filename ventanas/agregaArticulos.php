<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); ?>
<?php require("/configuracion/clases/formas.php"); ?>
<?php require("/configuracion/clases/articulosReferidos.php"); ?>
<?php require('/var/www/html/sima/cargos/muestraECuentas.php');?>
<?php



//************CASO 1 **********************

$sSQL1s= "Select folioVenta From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result1s=mysql_db_query($basedatos,$sSQL1s);
$myrow1s = mysql_fetch_array($result1s);

$sSQL1t= "Select status,usuario,folioVenta From transacciones WHERE entidad='".$entidad."' and folioVenta='".$myrow1s['folioVenta']."' ";
$result1t=mysql_db_query($basedatos,$sSQL1t);
$myrow1t = mysql_fetch_array($result1t);
echo mysql_error();
//echo $_GET['folioVenta'];

//echo $myrow1t['status'].' '.$myrow1t['folioVenta'];

if($myrow1t['status']=='standby' ){ 
//echo "Debes terminar de  completar la transaccion: ".$myrow1t['folioVenta'];
$disabled='disabled=""';
?>
<script>
window.alert("Estimado: <?php echo $myrow1t['usuario'];?>, imposible modificar datos, ya tiene movimientos!");
window.close();
</script>
<?php }  


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
 $keyClientesInternos=$_GET['keyClientesInternos'];
 $show=new muestra();
?>
<script>
function cerrarVentana(){
close();
}
</script>

<form name="form5" id="form5" method="get" action="">
  <div align="center">
    <p>
<input name="numeroE" type="hidden" value="<?php echo $_GET['numeroE']?>" />
	<input name="seguro" type="hidden" value="<?php echo $_GET['seguro']?>" />
		<input name="medico" type="hidden" value="<?php echo $_GET['medico']?>" />
			<input name="almacen" type="hidden" value="<?php echo $_GET['almacen']?>" />
				<input name="nCuenta" type="hidden" value="<?php echo $_GET['nCuenta']?>" />
					<input name="tipoCargo" type="hidden" value="<?php echo $_GET['tipoCargo']?>" />
						<input name="almacenDestino" type="hidden" value="<?php echo $_GET['almacenDestino']?>" />
							 <input name="tipoPaciente" type="hidden" value="<?php echo $_GET['tipoPaciente']?>" />
							 	<input name="credencial" type="hidden" value="<?php echo $_GET['credencial']?>" />
							 		<input name="keyClientesInternos" type="hidden" value="<?php echo $_GET['keyClientesInternos']?>" />
                                                                                <input name="folioVenta" type="hidden" value="<?php echo $_GET['folioVenta']?>" />
    </p>
    <table width="428" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="106" align="center"><input name="cargar" type="submit"  id="cargar"  class="boton1" value="Cargar" /></td>
        <td width="52">&nbsp;</td>
        <td width="112" align="center"><input name="muestraDatosAcumulados"  type="submit" class="boton1"  id="muestraDatosAcumulados" value="Revisar Articulos" /></td>
        <td width="40">&nbsp;</td>
        <td width="118" align="center"><input name="close" type="submit"  id="close"  onclick="cerrarVentana()" class="boton2" /></td>
      </tr>
    </table>
    <p>&nbsp; 
    </p>
    <hr />
  </div>
</form>
<?php 

$sSQL7ll= "Select * from clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'  ";
$result7ll=mysql_db_query($basedatos,$sSQL7ll);
$myrow7ll = mysql_fetch_array($result7ll);




//**************EN CASO QUE REQUIERE MATRICULA****************
$sSQL455f= "Select requiereMatricula from clientes where entidad='".$entidad."' and numCliente='".$myrow7ll['clientePrincipal']."'";
$result455f=mysql_db_query($basedatos,$sSQL455f);
$myrow455f = mysql_fetch_array($result455f);




if($myrow455f['requiereMatricula']=='si'){
 $sSQL7cd= "Select * from ALUMNOSINSCRITOS where ENTIDAD='".$entidad."'  and  MATRICULA='".$myrow7ll['credencial']."'  and MODALIDAD='Presencial'   ";
$result7cd=mysql_db_query($basedatos,$sSQL7cd);
$myrow7cd = mysql_fetch_array($result7cd);


if(!$myrow7cd['MATRICULA']){  ?>
 <script>
window.alert("IMPOSIBLE CONTINUAR! ALUMNO NO INSCRITO, favor de reportarlo a archivo para verificar su credencial en el expediente, gracias!");
window.close();
</script>
 <?php }
 }//requiere matricula
  ?>
 
 <?php 
 //******************************************************










 if( $myrow7ll['despliegaEC']=='si'){
 



$show->mostrarDatos($_GET['keyClientesInternos'],$myrow7ll['seguro'],$myrow7ll['clientePrincipal'],$myrow7ll['paciente'],$fecha1,$entidad,$basedatos,$_GET['numeroE']);



 $q = "UPDATE clientesInternos set 
despliegaEC=NULL,
estudiante='si'
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error(); 
}



//$show->mostrarDatos($_GET['keyClientesInternos'],$myrow7ll['seguro'],$myrow7ll['clientePrincipal'],$myrow7ll['paciente'],$fecha1,$entidad,$basedatos,$_GET['numeroE']);




 

 
if($myrow7ll['despliegaEC']!='si'){
$cargar=new loadArticulos();
$articulosReferidos=new referirArticulos();
$desplegar=new displayArticulos();


if($_GET['cargar'] or (!$_GET['articulosReferidos'] and !$_GET['muestraDatosAcumulados'])){

$cargar->cargarArticulos($fechaSolicitud,$horaSolicitud,$entidad,$banderaCXC,$almacenSolicitante,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
} else if($_GET['muestraDatosAcumulados']){

$desplegar->despliegaArticulos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);
} else if($_GET['articulosReferidos']){

$articulosReferidos->articulosReferidos($entidad,$almacen,$ID_EJERCICIOM,$dia,$fecha1,$hora1,$usuario,$numeroPaciente,$seguro,$credencial,$medico,$almacenSolicitante,$nCuenta,$tipoCargo,$almacenDestino,$tipoPaciente,$basedatos);

}
}

?>