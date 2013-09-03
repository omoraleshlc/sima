  <?php require('/configuracion/ventanasEmergentes.php'); $date=$_GET['fecha1'];require('/configuracion/funciones.php');?>
  

  <p align="center" >
  
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
    
    
    <tr  > 
      <td  >  <?php echo $myrow['folioVenta'];
?></td>
      <td >
      <a href="javascript:nueva('estadoCuentaE.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&amp;nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&amp;almacenSolicitante=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&amp;tipoVenta=<?php echo 'externo';?>&devolucion=<?php echo $myrow['statusDevolucion'];?>&descripcionTransaccion=paquetes','ventana1','800','600','yes')">

<?php echo $myrow['paciente'];
		  if($myrow['statusDevolucion']=='si'){
		  echo '</br>';
		  echo '<span class=codigos>'.' [Solicita Devolucion ]'.'</span>';
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
?></td>
    </tr><?php  }}}?>

  </table>
  <p align="center">&nbsp;</p>
  
  
  <input name="warehouse" value="<?php echo $_GET['warehouse'];?>" type="hidden"></input>