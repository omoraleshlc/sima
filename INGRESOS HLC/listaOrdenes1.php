<?php 
//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');require('/configuracion/funciones.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************

?><?php  $date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>

  <p align="center" class="negromid">
  
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

  </p>
  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
 
    <tr bgcolor="#FFFF00">
        <td width="10" class="negromid">#</td>
        <td width="80" class="negromid">Fecha/Hora</td>
      <td width="53" class="negromid"> F Venta</td>
      <td width="272" class="negromid">Datos Paciente</td>
      <td width="215" class="negromid">Aseguradora</td>

    </tr>
<?php	



if($_GET['tipoOrden']!=NULL){
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

order by keyClientesInternos desc
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
order by keyClientesInternos desc
 ";
}



if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$r+=1;

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
    
    
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" > 
  <td height="48" class="codigos"><?php echo $r;?></td>    
   <td height="48" class="codigos">
       <?php 
        if($myrow['statusDevolucion']=='si'){
		 
		  echo cambia_a_normal($myrow17d['fecha']);
                   echo '</br>';
		  }
       echo $myrow['hora'];
       ?>
   </td>     
      <td height="48" class="codigos">  <?php echo $myrow['folioVenta'];
?></td>
      <td class="normalmid">
      <a href="javascript:nueva('estadoCuentaE.php?numeroE=<?php echo $myrow['keyClientesInternos']; ?>
&amp;nCuenta=<?php echo $myrow['keyClientesInternos']; ?>&amp;almacenSolicitante=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;folioVenta=<?php echo $myrow['folioVenta'];?>&amp;tipoVenta=<?php echo 'externo';?>
&devolucion=<?php echo $myrow['statusDevolucion'];?>&descripcionTransaccion=<?php echo $_GET['descripcionTransaccion'];?>&warehouse=<?php echo $_GET['warehouse'];?>#final','ventana1','1024','1000','yes')">

<?php echo $myrow['paciente'];
		  if($myrow['statusDevolucion']=='si'){
		  echo '</br>';
		  echo '<span class=codigos>'.' [Solicita Devolucion ], folio Original:  '.$myrow17d['folioVenta'].'</span>';
		  }

                  if($myrow['beneficencia']=='si'){
                        echo '</br>';
		  echo '<span class=codigos>Paciente de Beneficencia </span>';
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
          
		  
		  
		  <?php if($myrow['statusCortesia']=='si'){ ?>
		  <br />
		<span class="normal">[ El Paciente es de cortesia ]</span>
		  <?php } ?>
		  
		  
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
?>
      </td>
    </tr><?php  }}}?>

  </table>
  <p align="center">&nbsp;</p>
  
      <input name="warehouse" type="hidden" value="<?php echo $_GET['warehouse'];?>" />