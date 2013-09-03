<?php require('/configuracion/ventanasEmergentes.php'); $date=$_GET['fecha1'];require('/configuracion/funciones.php');?>
  
<p align="center" >
 <p><input type="submit" onclick="refresh()" value="Actualizar Datos"
  name="button1"></p>
</p>
  <p align="center" >
  
    <label>
    Tipo de Orden
    <select name="tipoOrden" onchange="this.form.submit();">
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
    <span  align="center">Para aplicar una Nota de Venta, presiona el nombre del Paciente</span>
  </p>
  <table width="537" class="table table-striped">

    <tr >
      <th width="53" > F Venta</th>
      <th width="272" >Datos Paciente</th>
      <th width="215" >Aseguradora</th>

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
paquete!='si'
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
paquete!='si'
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

AND
(fechaSolicitud='".$date."' or fecha='".$date."')
and
folioVenta!=''
and
paquete!='si'
order by keyClientesInternos DESC
 ";
}



if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];



$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);
	  ?>
    
    
    <tr  > 
      <td >  <?php echo $myrow['folioVenta'];
?></td>
      <td >
      <a href="javascript:nueva('/sima/INGRESOS HLC/caja/estadoCuentaE.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>&nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&almacenSolicitante=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&tipoVenta=<?php echo 'externo';?>&devolucion=<?php echo $myrow['statusDevolucion'];?>&descripcionTransaccion=<?php echo $_GET['descripcionTransaccion'];?>&warehouse=<?php echo $_GET['warehouse'];?>#final','ventana1','1024','1000','yes')">

<?php echo $myrow['paciente'];
		  if($myrow['statusDevolucion']=='si'){
		  echo '</br>';
		  echo '<span >'.' [Solicita Devolucion ], folio Original:  '.$myrow17d['folioVenta'].'</span>';
		  }

                  if($myrow['beneficencia']=='si'){
                        echo '</br>';
		  echo '<span >Paciente de Beneficencia </span>';
                  }
		  ?></a></br>
        <span > Departamento: </span><span > <?php
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
          <span >Enviada por: </span><span ><?php
echo $myrow['usuario'];
?></span>
          
		  
		  
		  <?php if($myrow['statusCortesia']=='si'){ ?>
		  <br />
		<span >[ El Paciente es de cortesia ]</span>
		  <?php } ?>
		  
		  
      </td>
      <td ><?php 
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
?>
      </td>
    </tr><?php  }}}?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />
