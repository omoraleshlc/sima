<?php require("menuOperaciones.php"); ?>
 <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventana111","width=450,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria7(URL){ 
   window.open(URL,"ventanaSecundaria7","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=750,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que ya revisaste la cuenta? la operaci�n es irreversible')) return true;
return false;
}
-->
</script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />



<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>
<META HTTP-EQUIV="Refresh"
CONTENT="300"> 
<body>
<form id="form1" name="form1" method="post">
  <h1 align="center" >Revisar Cuenta</h1>
  <p align="center" ><div id="dhtmltooltip"></div>

<table width="440" class="table-forma">
     
   
     <tr >
       
	   <td scope="col" >
	   
Departamento <?php 	   $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No') 
and
tieneCuartos='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>        
		
		     <option value="*">Todos</option>

  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	   </td>
		
		
		
       <td scope="col">&nbsp;</td>
     </tr>
     <tr >
       <td scope="col" ><div align="center">Tipo de Cuenta
       <?php 
	   if (!$_POST['status']) {$_POST['status']=$_GET['status']; }?>
         <select name="status" class="style12" id="status" onChange="javascript:this.form.submit();"/>
         
         <option >Selecciona la Opcion</option>
         <option 
		   <?php if($_POST['status']=='Revision')echo 'selected'; ?>
		    value="Revision">Revision</option>
         <option 
		   <?php if($_POST['status']=='Abiertas')echo 'selected'; ?>
		   value="Abiertas">Abiertas</option>

		   
         </select>
       </span></div></td>
       <td scope="col">
         <div align="left">       </div></td>
     </tr>
  </table>
  </p>
 
  <p><span class="error" align="center">(Para ver los Cargos del Paciente, presiona sobre el Folio de Venta...)</span></p>
  <table  align="center" class="table table-striped">

    <tr>
      <th width="57"  align="center" >FolioV</th>
      <th width="263"  >Datos Paciente</th>
      <th width="235" >Seguro</th>
      <th width="97"  align="center">Cambia Status</th>
      <th width="68" align="center">Coaseguro</th>
      <th width="68" align="center">Pendientes</th>
      <th width="68" align="center">---</th>
    </tr>
    <?php	

if($_POST['almacenDestino']){

if($_POST['almacenDestino']=='*'){
if($_POST['status']=='Abiertas'){
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
tipoPaciente='interno'
and
(status='activa' or status='ontransfer' )
and
statusCuenta='abierta'


and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY paciente ASC";
 }elseif($_POST['status']=='Revision'){
  $sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
(status='activa' or status='ontransfer' )
and
(statusCuenta='revision' or statusCuenta='final')


and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY paciente ASC";
 }

}else if($_POST['almacenDestino']!='*'){
if($_POST['status']=='Abiertas'){
 $sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
almacen='".$_POST['almacenDestino']."'
and
(status='activa' or status='ontransfer' )
and
statusCuenta='abierta'


and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY paciente ASC";
 }elseif($_POST['status']=='Revision'){
  $sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
almacen='".$_POST['almacenDestino']."'
and
(status='activa' or status='ontransfer' )
and
(statusCuenta='revision' or statusCuenta='final')


and
(solicitaTransferencia='' or solicitaTransferencia='si')
ORDER BY paciente ASC";
 }
} 
 
 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);


$sSQL31s= "SELECT nomCliente FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente='".$myrow['seguro']."'";
$result31s=mysql_db_query($basedatos,$sSQL31s);
$myrow31s = mysql_fetch_array($result31s);


$sSQL31cdd= "SELECT 
usuario
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."' 
    and
    statusCargo='standbyR'

";
$result31cdd=mysql_db_query($basedatos,$sSQL31cdd);
$myrow31cdd = mysql_fetch_array($result31cdd);
?>
    
    <tr  > 
      <td  align="center">
	  <a href="#" 
onclick="javascript:ventanaSecundaria11('../cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php echo $myrow['folioVenta'];
?></a>
      
	  </td>
      <td >
        <?php if($_POST['status']=='Abiertas'){ ?>
        <a href="#solicitar<?php echo $guia;?>" name="solicitar<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('../cargos/actualizarDatosPx.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $ALMACEN; ?>&seguro=<?php echo $myrow['seguro']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>')"> <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicit� la transferencia de �ste paciente]';
	  }
	  ?> </a>
        <?php }else{ ?>
        <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicito la transferencia de �ste paciente]';
	  }
	  ?>
        <?php } ?>
        <br />
        <span class="normal">Depto:</span><span class="negro"> 
      <?php echo $myrow['almacen']
?></span><br />
        <span class="normal">Fecha Ingreso:</span><span class="negro"> 
      <?php echo cambia_a_normal($myrow['fecha']);
?></span><br />
      <span class="normal">Cuarto: </span> <span class="codigos">
      <?php echo $myrow['cuarto']
?></span></td>
      <td >
      <?php 
	  if($myrow31s['nomCliente']){
	  echo $myrow31s['nomCliente'];
	  } else {
	  echo 'PARTICULAR';
	  }
?><br /> 




      <td align="center" > <?php 
		  $sSQL31ss= "SELECT statusCargo FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$myrow['folioVenta']."' 
and
gpoProducto!=''
and statusCargo='standby'

";
$result31ss=mysql_db_query($basedatos,$sSQL31ss);
$myrow31ss = mysql_fetch_array($result31ss);
		  if($myrow31ss['statusCargo']){ ?>
        <a onMouseOver="ddrivetip('Falta por surtir!','yellow', 300)";
onmouseout="hideddrivetip()"> Falta Surtir </a>
        <?php } else { ?>
        <a href="#" onClick="javascript:ventanaSecundaria111('../cargos/enviarAdm.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;ali=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">Cambiar Status</a>
      <?php } ?> </td>
      
      <td  align="center"><?php if($myrow['statusCuenta']=='final'){ ?>
        <a href="#" onClick="javascript:ventanaSecundaria2('../ventanas/aplicarDeducible.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;ali=<?php echo $ALMACEN; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">Cargar Coaseguro</a>
      <?php } else { echo '---';}?></td>
    
    
    
    
    
    
    
     <td align="center" > 
        
          <?php if($myrow31cdd['usuario']!=''){?>
        <a href="#" onClick="javascript:ventanaSecundaria2('../ventanas/articulosPendientes.php?folioVenta=<?php echo $myrow['folioVenta'];?>')">Ver</a>
          <?php }?>        
      </td>
    
        
      <td align="center" >
          <a href="#revision<?php echo $guia;?>" name="revision<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('../ventanas/datosAdicionales.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['datawarehouse']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&rand=<?php echo rand(4555,423345430000);?>')">
              Editar
          </a>
      </td>
    
    
    
    </tr>
    <?php  }}}?>

  </table>
  
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>

</form>
</body>
</html>