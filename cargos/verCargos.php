<?php require('/configuracion/ventanasEmergentes.php'); 
require('/configuracion/funciones.php'); ?>
<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=200,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
<?php 
//aqui estoy

if($_POST['borrar'] and $_POST['quitar']){
//*****************************************************
$quitar=$_POST['quitar'];


for($i=0;$i<=$_POST['bandera'];$i++){

if($quitar[$i]){
$sSQL= "SELECT 
codProcedimiento,keyCAP,almacen,numeroE,nCuenta
FROM cargosCuentaPaciente
WHERE keyCAP ='".$quitar[$i]."'";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$codigo=$myrow['codProcedimiento'];
$departamento=$myrow['almacen'];
$numeroPaciente=$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
//********************************************
$agrega = "INSERT INTO articulosCancelados (
codigo,fecha,hora,usuario,entidad,departamento,numeroE,nCuenta,keyCAP
) values (
'".$_GET['codigo3']."','".$fecha1."','".$hora1."',
'".$usuario."','".$entidad."','".$departamento."','".$numeroE."','".$nCuenta."','".$quitar[$i]."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}
}
}







//*********************ENVIAR********************
if($_POST['send']){ 
$keyCAP=$_POST['keyCAP'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL= "SELECT 
statusCargo,keyClientesInternos,almacenDestino
FROM cargosCuentaPaciente
WHERE keyCAP ='".$keyCAP[$i]."'";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


 $sSQL3115= "Select cargosDirectos From almacenes WHERE almacen='".$myrow['almacenDestino']."'";
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);

if($myrow3115['cargosDirectos']=='si' or $myrow['statusCargo']=='cargadoR'){
$statusCargo='cargado';
}else {
$statusCargo='standby';
}

$actualiza = "update cargosCuentaPaciente 
set
statusCargo='".$statusCargo."'
WHERE keyCAP ='".$keyCAP[$i]."'";
mysql_db_query($basedatos,$actualiza);
echo mysql_error();

$actualizad = "update clientesInternos 
set
statusCargo='cargado'
WHERE keyClientesInternos ='".$myrow['keyClientesInternos']."'";
mysql_db_query($basedatos,$actualizad);
echo mysql_error();
}


}
?>


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar solicitud?')) return true;
return false;
}
-->
</script>


<?php
$convenioParticular=new acumulados(); $convenioAseguradora=new acumulados(); 
$cargosParticulares=new  acumulados();	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
  <span class="style15"><?php echo $leyenda; ?></span></p>
<form id="form1" name="form1" method="post" action="#" >


<?php	
 $sSQL31= "Select  tipoPaciente From clientesInternos WHERE numeroE = '".$_GET['keyClientesInternos']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
keyClientesInternos='".$_GET['keyClientesInternos']."'
and
naturaleza='C'
order by fecha1,hora1 ASC

";

if($result=mysql_db_query($basedatos,$sSQL)){

?>
    <span class="Estilo24"><span class="style7">
    <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
    </span></span>
    <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />

    <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
    <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
    <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
    <span class="style15"><?php echo $leyenda; ?></span>
	  <?php 

$sSQL31= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";



$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$paciente=$myrow31['paciente'];
$_GET['numeroE']=$myrow31['numeroE'];$_GET['nCuenta']=$myrow31['nCuenta'];
?>
    <table width="581" border="0" align="center" >
	<tr bgcolor="#FFFFFF" class="negro">
      <th scope="col"><div align="left">Paciente </div></th>
      <th scope="col"><div align="left" class=""><?php echo $paciente; ?></div></th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
	  <th scope="col">&nbsp;</th>
	  </tr>
      <tr>
<th width="95" height="19" bgcolor="#660066" scope="col"><div align="left" class="blanco">Hora/Fecha</div></th>
        <th width="334" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripci&oacute;n</div></th>
      

        <th width="35" bgcolor="#660066" scope="col"><div align="left"><span class="blanco">Part</span></div></th>
        <th width="35" bgcolor="#660066" scope="col"><div align="left" class="blanco">Aseg</div></th>
        <th width="35" bgcolor="#660066" scope="col"><div align="left" class="blanco">Almacen</div></th>
        <th width="21" bgcolor="#660066" scope="col"><div align="center" class="blanco">Cant</div></th>
      </tr>
	  
	  
	  
	  
	  
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}





?>
        <td height="24" bgcolor="<?php echo $color;?>" class="codigos">
          <label></label>
		  <?php 
		  if($myrow['um']=='s'  ){ ?>
		  	        <a href="javascript:ventanaSecundaria8('ventanCambiaFecha.php?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $myrow['almacenDestino']; ?>&expediente=<?php echo 'no'; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow112['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>')">
					
					
          <?php 
		  if($myrow['horaSolicitud'] and $myrow['fechaSolicitud']){
		  echo $myrow['horaSolicitud']." ".$myrow['fechaSolicitud']; 
		 }else {
		 echo $myrow['hora1']." ".$myrow['fecha1'];
		 }
		  ?>          
		  </a>
		  <?php } else { ?>
		 
		            <?php  echo $myrow['hora1']." ".$myrow['fecha1'];  ?>          
					
					<?php } ?>
		  
		  
		  
		  
		  <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />        </td>
        <td bgcolor="<?php echo $color;?>" class="normal"><?php 
		if($myrow['tipoTransaccion'] and !$myrow11['descripcion']){
		echo "Depósito ó Movimiento de Caja" ;
		} else {
			$descripcion=new articulosDetalles();
			
			
			$sSQL31c= "Select modificarPrecios From almacenes WHERE almacen='".$myrow['almacenDestino']."' ";
$result31c=mysql_db_query($basedatos,$sSQL31c);
$myrow31c = mysql_fetch_array($result31c);

if($myrow31c['modificarPrecios']=='si'){ ?>

<a   href="javascript:ventanaSecundaria8('ventanCambiaLaboratorioReferido.php?keyCAP=<?php echo $keyCAP; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>')">

<?php
if($myrow['descripcion']){
echo $myrow['descripcion'];
} else {
$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
}
?>
</a>
<?php 
						} else {

					$descripcion->descripcion($entidad,$keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
	}	
		
		}
		?>
		<?php if($myrow['status']=='cancelado'){ ?>
		  <span class="Estilo25"><blink><?php echo '(Artículo Cancelado por '.$myrow['usuarioCancela'].')';?></blink></span>
		<?php } ?>
		
			<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>		</td>
		
     

        <td bgcolor="<?php echo $color;?>" class="cargos"><?php 
		$totalP[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2); ?></td>
        <td bgcolor="<?php echo $color;?>" class="cargos"><?php $totalA[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2); ?></td>
        <td bgcolor="<?php echo $color;?>" class="normal" align="center"><?php echo $myrow['almacenDestino']; ?></td>
	
        <td bgcolor="<?php echo $color;?>" class="normal" align="center"><label><span class="Estilo24">
        <input name="keyCAP[]" type="hidden" value="<?php echo $myrow['keyCAP'];?>" />
        </span>
        <?php if($myrow['cantidad']){
echo $myrow['cantidad'];
} else {
echo "N/A";
}?></label></td>
      </tr>
      <?php }?>
  </table>

 
<p><?php 

 ?>
    </p>
    <table width="581" border="0" align="center" >
      <tr bgcolor="#FFFFFF" class="negro">
        <th width="341" scope="col"><div align="left"></div></th>
        <th width="53" scope="col"><div align="left" class="">TOTAL</div></th>
        <th width="36" scope="col"><?php echo '$'.number_format($totalP[0],2);?></th>
        <th width="33" scope="col"><?php echo '$'.number_format($totalA[0],2);?></th>
        <th width="63" scope="col">&nbsp;</th>
        <th width="29" scope="col">&nbsp;</th>
      </tr>
      <?php }?>
    </table>
  <p>
      
      <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
      <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
      <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
      <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
      <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
      <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />

  </p>
      
      
      

    </p>
<div align="center">
      <p>
        <label></label>
  </p>
</div>
</form>
  <p></p>
  
  
</body>
</html>