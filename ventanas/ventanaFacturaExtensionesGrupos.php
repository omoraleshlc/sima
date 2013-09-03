<?php require("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>


<?php
if(($_POST['previzualizar'] or $_POST['aplicarFactura']) and $_POST['folioFactura']){
$sSQL3d= "Select numFactura From facturasAplicadas WHERE numFactura = '".$_POST['folioFactura']."' ";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);
}
?>






<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=1800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria50 (URL){ 
   window.open(URL,"ventanaSecundaria50","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
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


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script>




<?php //************************ACTUALIZO **********************
//********************Llenado de datos


//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
//***************aplicar pago**********************
?>












<?php //FACTURAR DEFINITIVO
if($_POST['aplicarFactura'] and $_POST['folioFactura'] and $_GET['folioVenta']){


$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

$sqld = "UPDATE facturasAplicadas set 
numFactura='".$_POST['folioFactura']."',
status='facturado'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();



$sqlci = "UPDATE clientesInternos set 
statusFactura='facturado'
where
folioVenta='".$_GET['folioVenta']."'";
mysql_db_query($basedatos,$sqlci);
echo mysql_error();
?>


<?php if($_POST['tipoFactura']=='Agrupada'){  ?>
<script>
javascript:ventanaSecundaria50('../cargos/printDetailsGroupFGxEG.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 
<?php } else{ ?>
javascript:ventanaSecundaria20('../cargos/printDetailsInvoiceFGxEG.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $$myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 
<?php } ?>

</script>






<?php 
echo 'se actualizaron datos';
}
?>



















<?php
if($_POST['previzualizar'] and $_POST['folioFactura'] and $_GET['folioVenta']){

$keyCAP=$_POST['keyCAP'];
for($i=0;$i<=$_POST['bandera'];$i++){ //agregar

if($keyCAP[$i]){
$sql = "UPDATE cargosCuentaPaciente set 
extension='".$_POST['extension']."'
where
keyCAP='".$keyCAP[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}

}


$sql5= "
SELECT *
FROM
facturasAplicadas
WHERE
entidad='".$entidad."' AND
folioVenta =  '".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

$sqld = "UPDATE facturasAplicadas set 
numFactura='".$_POST['folioFactura']."',
status='previzualizar'
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();


?>


<?php if($_POST['tipoFactura']=='Agrupada'){  ?>
<script>
javascript:ventanaSecundaria50('../cargos/printDetailsGroupFGxEG.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 
<?php }else{ ?>
javascript:ventanaSecundaria20('../cargos/printDetailsInvoiceFGxEG.php?keyClientesInternos=<?php echo $_POST['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&entidad=<?php echo $entidad;?>&folioFactura=<?php echo $_POST['folioFactura'];?>&seguro=<?php echo $myrow5['seguro'];?>&paciente=<?php echo $_POST['paciente'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&bandera=<?php echo $_POST['bandera'];?>&entidad=<?php echo $entidad;?>&rfc=<?php print $$myrow5['RFC'];?>&extension=<?php echo $_POST['extension'];?>'); 
<?php }?>

</script>






<?php 
echo 'se actualizaron datos';
}
?>



<?php if(($_POST['asignar'] and $_POST['agregar']) or ($_POST['quitar'] and $_POST['quitars'])){


if($_POST['asignar']){
$keyCAP=$_POST['agregar'];
for($i=0;$i<=$_POST['bandera'];$i++){ //agregar
//***********************VALIDACIONES*****************************
if($keyCAP[$i]){
$sql = "UPDATE cargosCuentaPaciente set 
extension='".$_POST['extension']."'
where
keyCAP='".$keyCAP[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}

} else{ //quitar


$keyCAP=$_POST['quitar'];
for($i=0;$i<=$_POST['bandera'];$i++){ //agregar
//***********************VALIDACIONES*****************************
if($keyCAP[$i]){
$sql = "UPDATE cargosCuentaPaciente set 
extension=''
where
keyCAP='".$keyCAP[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}
}

}//cierra funcion













?>









<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librerÃ­a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librerÃ­a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librerÃ­a que declara la funciÃ³n Calendar.setup, que ayuda a generar un calendario en unas pocas lÃ­neas de cÃ³digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">




<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    
    
    
</head>



<BODY  >
<?php 
$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
<h1 align="center" >Facturaci&oacute;n por Extensiones x Grupos
<?php 


?>
</h1>




<form id="form1" name="form1" method="post" action="">

  <table width="582" class="table-forma" >
    <tr>
      <td   scope="col"><div align="left">Folio de Venta</div></td>
      <td   scope="col"><div align="left">
        <label>
		<a href="#" 
onclick="javascript:ventanaSecundaria11('/sima/cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $_GET['folioVenta'];?>')">
      <?php print $_GET['folioVenta'];?>	  </a>        </label>
        </label>
      </div>      </td>
    </tr>
    
    
    

    <tr>
      <td width="168"   scope="col"><div align="left" ><strong>Paciente</strong></div></td>
      <td width="407"   scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></td>
    </tr>
    <tr>
      <td  >Compa&ntilde;&iacute;a</td>
<td  ><label><?php echo $myrow3['seguro']; ?></label></td>
    </tr>
    <tr>
      <td  >N&deg; Credencial</td>
      <td  ><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <td   scope="col"><div align="left"><strong>M&eacute;dico</strong></div></td>
      <td   scope="col"><div align="left">
          <label></label>
          
          <?php 
$sSQL18= "Select descripcion From almacenes WHERE almacen='".$myrow3['medico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".$rNombre18['descripcion'];?> </div></td>
    </tr>
    <tr>
      <td  >Fecha </td>
      <td  ><label>
        <input name="fechaImpresion" type="text"  id="campo_fecha" size="10" maxlength="10"
		value="<?php
		 if($_POST['fechaImpresion']){
		 echo $_POST['fechaImpresion'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"/>
      </label>
        <input name="button" type="button"  id="lanzador" value="..." /></td>
    </tr>
    <tr>
      <td  >Dx Entrada</td>
      <td  ><?php print $myrow3['dx'];?></td>
    </tr>
    <tr>
      <td  >&nbsp;</td>
      <td  ><label></label></td>
    </tr>
  </table>

<?php 
$sSQL3abc= "Select count(*) as extensiones From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and status='extension'   and status!='facturado' ";
$result3abc=mysql_db_query($basedatos,$sSQL3abc);
$myrow3abc = mysql_fetch_array($result3abc);
$ext=$myrow3abc['extensiones'];
?>
  <p align="center">Extensi&oacute;n
    <select name="extension" id="extension" onChange="this.form.submit();">

<?php for($i=0;$i<=7;$i++){ ?>
      <option
      <?php if($_POST['extension']==$i)print 'selected="selected"';?>
       value="<?php echo $i;?>"><?php echo $i;?></option>
<?php } ?>
    </select>
    
    <?php if($_POST['extension']>0){ ?>
  <a href="javascript:ventanaSecundaria50('../cargos/ventanaAjustarExtensiones.php?entidad=<?php echo $entidad;?>&extension=<?php echo $_POST['extension'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>');"> 
Asignar RFC </a></p>



<p align="center"> # Factura
    <input autocomplete="off" name="folioFactura" type="text" <?php if($_POST['folioFactura']){ echo '';}?> id="folioFactura" value="<?php echo $_POST['folioFactura'];?>"  />
</p>
<p align="center"><span >C&oacute;mo quieres la Factura?
    <label>
    <select name="tipoFactura" id="tipoFactura">
      <option value="Agrupada">Agrupada</option>
      <option value="Detallada">Detallada</option>
    </select>
    </label>
</span></p>

  <p>
  <?php } ?></p>
  
  
  
  
 <?php 
 require('/configuracion/clases/cargosCuentaPaciente.php');
 $cargos=new mostrarCargos ();
$sSQL= "
SELECT * FROM 
facturasAplicadas
where 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'

and
extension='".$_POST['extension']."'
and
(status='extensionGrupos'  or status='previzualizar')

";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$cargos-> cargosCuentaPaciente($myrow['porcentajeFacturacion'],$_GET['folioVenta'],$_POST['extension'],$myrow['gpoProducto'],$entidad,$basedatos);
$importe[0]+=$myrow['importe'];
}
?>



  
  <p align="center">
  <?php echo 'A FACTURAR : '.'$'.number_format($importe[0],2);?>
  </p>

  <p align="center">
    <label></label>
    <?php



$sSQL3ab= "Select seguro,RFC From facturasAplicadas WHERE folioVenta = '".$_GET['folioVenta']."'  and extension='".$_POST['extension']."'";
$result3ab=mysql_db_query($basedatos,$sSQL3ab);
$myrow3ab = mysql_fetch_array($result3ab);

	
	 if($_POST['extension']>0  and ($myrow3ab['RFC'] or $myrow3ab['seguro'])) {?>
</p>
  




  <p align="center">
    <input type="submit" name="previzualizar" id="previzualizar" value="Previzualizar" />
  </p>
  <p align="center">
    <input name="aplicarFactura" type="submit"  id="aplicarFactura" value="Facturar Definitivo" onClick="return comprueba();"/>
  </p>
  <?php } ?>
  <p align="center">&nbsp; </p>
  <p align="center"><input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />
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
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 

</body>
</html>



