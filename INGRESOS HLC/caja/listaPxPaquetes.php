  <?php require('/configuracion/ventanasEmergentes.php'); $date=$_GET['fecha1'];require('/configuracion/funciones.php');?>
  

  <p align="center" class="negromid">
  
    <label>
    Tipo de Orden
    <select name="tipoOrden" onChange="this.form.submit();">
	<option value="">Escoje</option>
      <option
	  <?php if($_GET['tipoOrden']=='ordenesPendientes')echo 'selected=""';?>
	   value="ordenesPendientes">Ordenes Pendientes</option>
      <option
	   <?php if($_GET['tipoOrden']=='ordenesPagadas')echo 'selected=""';?>
	   value="ordenesPagadas">Ordenes Pagadas</option>
	   
    </select>
    </label>
    <br />
    <br />
    <span class="codigos" align="center">Para aplicar una Nota de Venta, presiona el nombre del Paciente</span>
  </p>
  <table width="537" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="4"><img src="../../imagenes/bordestablas/borde1.png" width="540" height="21" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="53" class="negromid"> F Venta</td>
      <td width="272" class="negromid">Datos Paciente</td>
      <td width="215" class="negromid">Aseguradora</td>

    </tr>
          <?php	
if($_GET['tipoOrden']){
if($_GET['tipoOrden']=='ordenesPendientes'){
$sSQL= "SELECT *
FROM
clientesInternos
where
(entidad='".$entidad."'
and
status not like '%cancel%'
and
statusCaja!='pagado'
and
tipoPaciente='externo'

and
paquete='si'
AND
(fechaSolicitud='".$date."' or fecha='".$date."')
and
folioVenta!='')
or

(entidad='".$entidad."'
and
status not like '%cancel%'
and
statusCaja!='pagado'
and
paquete='si'
and
tipoPaciente='externo'
AND
statusDevolucion='si'
and
folioVenta!='')

order by keyClientesInternos DESC
 ";
}else{
$sSQL= "SELECT *
FROM
clientesInternos
where
entidad='".$entidad."'
and
status not like '%cancel%' 
and
statusCaja='pagado'
and
tipoPaciente='externo'
and
paquete='si'
AND
(fechaSolicitud='".$date."' or fecha='".$date."')
and
folioVenta!=''

order by keyClientesInternos DESC
 ";
}



if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
    
    
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" > 
      <td height="48" class="codigos">  <?php echo $myrow['folioVenta'];
?></td>
      <td class="normalmid">
      <a href="javascript:nueva('../../INGRESOS HLC/caja/estadoCuentaE.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&amp;nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&amp;almacenSolicitante=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&amp;tipoVenta=<?php echo 'externo';?>&devolucion=<?php echo $myrow['statusDevolucion'];?>&descripcionTransaccion=paquetes','ventana1','800','600','yes')">

<?php echo $myrow['paciente'];
		  if($myrow['statusDevolucion']=='si'){
		  echo '</br>';
		  echo '<span class=codigos>'.' [Solicita Devolucion ]'.'</span>';
		  }
		  
		  ?></a></br>
        <span class="normal"> Departamento: </span><span class="negro"> <?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></span>
          </br>
          <span class="negro">Enviada por: </span><span class="codigos"><?php
echo $myrow['usuario'];
?></span>
          
      </td>
      <td class="normal"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
nomCliente
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "PARTICULAR";
		  }
?></td>
    </tr><?php  }}}?>
    <tr>
      <td colspan="4"><img src="../../imagenes/bordestablas/borde2.png" width="540" height="20" /></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  
  
  <input name="warehouse" value="<?php echo $_GET['warehouse'];?>" type="hidden"></input>