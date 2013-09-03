<?php require("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>




<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>





<?php //************************ACTUALIZO **********************

$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$keyClientesInternos=$myrow3['keyClientesInternos'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$entidad=$myrow3['entidad'];

if($myrow3['seguro']){
$tipoCliente='aseguradora';
$seguro=$myrow3['seguro'];
} else {
$tipoCliente='particular';
}

//***************aplicar pago**********************
?>
<?php //transaccion estatica

if($_POST['aplicar'] and  $_POST['gpoProducto']){
$keyCAP=$_POST['keyCAP'];
$fechaDescuento=$fecha1.' '.$hora1;
$gpoProducto=$_POST['gpoProducto'];
$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];
$descripcion=$_POST['descripcion'];
$ivaGPO=new articulosDetalles();
$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


for($i=0;$i<=$_POST['bandera'];$i++){



if($particular[$i]){

$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,
statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,descripcion,
descripcionArticulo,tipoCuenta,statusDescuento,gpoDescuento,ivaParticular,iva) 
values 
('0','0','descuento',
'".$usuario."','".$fecha1."','".$dia."','1','','operacion',
'".$hora1."','A','".$ID_EJERCICIOM."','pagado','".$ALMACEN."',
'".$usuario."',
'".$seguro."',
'',
'".$myrow3['tipoCliente']."','".$myrow3['tipoPaciente']."' ,
'".$particular[$i]."','".$cantidadAseguradora."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby',
'".$_GET['tipoPago']."','".$ALMACEN."','".$myrow3['keyClientesInternos']."','standby','cargado','standby','".$RECIBO."','".$_GET['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."',
'".$myrow3['clientePrincipal']."','".$particular[$i]."' ,'".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."',
'".$_GET['bancoTC']."','".$descripcion[$i]."','".$descripcion[$i]."','D','si','".trim($gpoProducto[$i])."' ,'".$ivaGPO-> ivaGPO($entidad,$cantidad,$gpoProducto[$i],$precioVenta,$basedatos)."',
'".$ivaGPO-> ivaGPO($entidad,$cantidad,$gpoProducto[$i],$precioVenta,$basedatos)."'   )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}elseif($aseguradora[$i]){
$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,almacen,usuarioTraslado,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,almacenDestino,keyClientesInternos,statusFactura,statusCargo,
statusImpresion,numRecibo,folioVenta,codigoCaja,statusCaja,telefono,clientePrincipal,precioVenta,bancoCheque,numeroCheque,random,codigoAutorizacion,ultimosDigitos,bancoTC,descripcion,
descripcionArticulo,tipoCuenta,statusDescuento,gpoDescuento,ivaAseguradora,iva) 
values 
('0','0','descuento',
'".$usuario."','".$fecha1."','".$dia."','1','','operacion',
'".$hora1."','A','".$ID_EJERCICIOM."','pagado','".$ALMACEN."',
'".$usuario."',
'".$seguro."',
'',
'".$myrow3['tipoCliente']."','".$myrow3['tipoPaciente']."' ,
'','".$aseguradora[$i]."','".$numCorte."','".$entidad."','".$_GET['tipoPago']."','standby',
'".$_GET['tipoPago']."','".$ALMACEN."','".$myrow3['keyClientesInternos']."','standby','cargado','standby','".$RECIBO."','".$_GET['folioVenta']."','".$myrowC['keyCatC']."','pagado','".$_GET['telefono']."',
'".$myrow3['clientePrincipal']."','".$aseguradora[$i]."' ,'".$_GET['bancoCheque']."','".$_GET['numeroCheque']."','".$_GET['random']."','".$_GET['codigoAutTC']."','".$_GET['ultimosDigitos']."',
'".$_GET['bancoTC']."','".$descripcion[$i]."','".$descripcion[$i]."','D','si','".trim($gpoProducto[$i])."' ,'".$ivaGPO-> ivaGPO($entidad,$cantidad,$gpoProducto[$i],$precioVenta,$basedatos)."',
'".$ivaGPO-> ivaGPO($entidad,$cantidad,$gpoProducto[$i],$precioVenta,$basedatos)."'   )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}




}//cierra for








$agrega = "UPDATE clientesInternos set 
descuento='si',

usuarioDescuento='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();





?>
<script>
window.alert("Se aplicaron descuentos");
window.opener.document.forms["form1"].submit();
//window.close();
</script>
<?php 

}
?>









<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  


  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<style type="text/css">
<!--
.style7 {font-size: 9px}
-->
</style>
<head>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
    
    
</head>



<BODY  >

<h1 align="center" class="titulos">Aplicar Descuento por Importe </h1>
<p align="center" class="negro">Escoje el porcentaje por cada grupo <?php echo '<blink>'.$leyenda.'</blink>';?></p>
<form id="form1" name="form1" method="post" action="">






<table width="497" border="0" align="center">
      <tr>
        <th width="60" bgcolor="#660066" scope="col"><div align="left" class="blanco">Cod. GP</div></th>
        <th width="281" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripci&oacute;n de Productos </div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="center">Aseguradora</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="center">Particular</div></th>
      </tr>
      <tr>
	  
	  <?php   
 $sSQL= "Select  * From cargosCuentaPaciente  where entidad='".$entidad."' 
 and
 folioVenta='".$_GET['folioVenta']."'
 and
 gpoProducto!=''
 and
 status!='transaccion'
 group by gpoProducto
 ";
$result=mysql_db_query($basedatos,$sSQL); 




while($myrow = mysql_fetch_array($result)){
$bandera+=1;	
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['gpoProducto'];




$sSQL3= "Select * From gpoProductos WHERE entidad='".$entidad."' and codigoGP = '".trim($myrow['gpoProducto'])."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


?>
        <td bgcolor="<?php echo $color?>" class="normal"><label> <?php echo $C?> </label>
            </span>
        <input type="hidden" name="gpoProducto[]"  value="<?php echo $C?>"/></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow3['descripcionGP'];?>
        <input name="descripcion[]" type="hidden" id="descripcion[]"  value="<?php echo $myrow3['descripcionGP'];?>"/></td>
        <td bgcolor="<?php echo $color?>" class="normal"><input name="particular[]" type="text" id="particular[]" value="<?php echo $myrow7ada['porcentaje'];?>" size="8" maxlength="7"></td>
        <td bgcolor="<?php echo $color?>" class="normal"><input name="aseguradora[]" type="text" id="aseguradora[]" value="<?php echo $myrow7ada['porcentaje'];?>" size="8" maxlength="7"></td>
      </tr>
      <?php }?>
  </table>
  <p align="center">
    <label></label>
    <input type="submit" name="aplicar" id="aplicar" value="Efectuar Cambios"/><input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />

  </p>
</form>

<p align="center">
  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
      <script>
		new Autocomplete("razonSocial", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("rfc")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/rfcx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>



