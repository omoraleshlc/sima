<?php //require('/configuracion/ventanasEmergentes.php');?>
<table width="864" border="0.2" align="center">
  <tr>
    <th width="74" bgcolor="#660066" class="blanco" scope="col"><div align="left">Referencia</div></th>
    <th width= "214" bgcolor="#660066" class="blanco" scope="col"><div align="left">Nombre del paciente:</div></th>
    <th width= "270" bgcolor="#660066" class="blanco" scope="col"><div align="left">Aseguradora</div></th>
    <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Departamento</div></th>
    <th bgcolor="#660066" class="blanco" scope="col"><div align="left">Usuario</div></th>
    <th bgcolor="#660066" class="blanco" scope="col">Aplicar</th>
  </tr>
  <tr>

    <?php	
$ALMACEN=$_GET['almacen'];
$fecha1=$_GET['fecha1'];
$sSQL= "SELECT *
FROM
clientesInternos,cargosCuentaPaciente
WHERE 
clientesInternos.entidad='".$_GET['entidad']."' AND
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos
AND
cargosCuentaPaciente.statusCargo='cargado'
AND
clientesInternos.status='pendiente' 
and 
clientesInternos.tipoPaciente='externo'
AND
((clientesInternos.almacenSolicitud!='' and clientesInternos.fechaSolicitud='".$fecha1."' ) 
or
(clientesInternos.fecha1='".$fecha1."' )) 
group by clientesInternos.keyClientesInternos
ORDER BY clientesInternos.keyClientesInternos DESC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];
	  ?>
    <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php echo $myrow['folioVenta'];
?></td>
    <td width="214" bgcolor="<?php echo $color?>" class="normal"><?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($myrow['paciente']){	  
?>
        <?php echo $myrow['paciente'];?>
        <?php }  else {?>
        <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
        <?php }  ?>
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
        </span></td>
    <td width="270" bgcolor="<?php echo $color?>" class="normal"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "Sin Seguro";
		  }
?>
        </span></td>
    <td width="184" bgcolor="<?php echo $color?>" class="normal"><?php
$al=$myrow['almacen'];
		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
almacen = '".$al."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
 echo $myrow17['descripcion'];
?></td>
    <td width="71" bgcolor="<?php echo $color?>" class="codigos"><?php
echo $myrow['usuario'];
?></td>
    <td width="25" bgcolor="<?php echo $color?>" class="normal" align="center"><label> <a href="javascript:nueva('<?php echo $ventana;?>?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&almacenSolicitante=<?php echo $ALMACEN; ?>&nT=<?php echo $nT; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&tipoVenta=<?php echo 'externo';?>','ventana1','800','600','yes')"><img src="/sima/imagenes/btns/aplybtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="30" height="24" border="0"/> </a> </label></td>
  </tr>
  <?php  }}?>
  <input name="menu" type="hidden" value="<?php echo $menu;?>" />
</table>
