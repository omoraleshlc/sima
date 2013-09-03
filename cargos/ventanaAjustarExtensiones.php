<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>


<?php if(($_POST['rfc'] and  $_POST['tipoFactura']) || ($_POST['seguro'] and $_POST['tipoFactura'])){


  

  $sql = "UPDATE facturasAplicadas set 

usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."',

seguro='".$_POST['seguro']."',
RFC='".$_POST['rfc']."'
where
entidad='".$_GET['entidad']."'
and
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_GET['extension']."'
";

mysql_db_query($basedatos,$sql);
echo mysql_error();

  echo '<script>';
  echo 'window.alert("Se agrego una razón social");';
  echo '</script>';


  echo '<script>';
  echo 'window.opener.document.forms["form1"].submit();';
  echo '</script>';
  

}
?>


  <script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventanaSecundaria111","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<h1 align="center">Agregar RFC a Extensi&oacute;n: <?php echo $_GET['extension'];?></h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
<table width="257" class="table-forma">
  <tr>
    <td width="125" scope="col"><div align="left">Tipo Factura</div></td>
    <td width="116" scope="col"><div align="left">
      <select name="tipoFactura" id="tipoFactura" onChange="this.form.submit();">
        <option value="">Escoje</option>
        <option
      <?php if($_POST['tipoFactura']=='particular')print 'selected="selected"';?>
       value="particular">particular</option>
        <option
      <?php if($_POST['tipoFactura']=='aseguradora')print 'selected="selected"';?>
       value="aseguradora">aseguradora</option>
      </select>
    </div></td>
  </tr>
</table>
<p>
  <?php if($_POST['tipoFactura']=='particular'){ ?>
</p>
<table width="455" class="table-forma">
  <?php 

 $sSQL2= "Select * From clientes WHERE entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
  <tr >
    <td width="85" >RFC</td>
    <td width="360" ><input name="rfc" type="text"  id="rfc" readonly="readonly"
		value="<?php 
		 if($myrow2['rfc']){
		 echo $myrow2['rfc'];
		 }elseif($_POST['rfc'] and !$_POST['nuevo']){ 
		echo $_POST['rfc'];
		}
		?>"/></td>
  </tr>
  <tr >
    <td >Razon Social:</td>
    <td ><span >
      <span ><span >
      <input name="razonSocial" type="text"  id="razonSocial" value="<?php 
		if($myrow2['razonSocial']){
		 echo $myrow2['razonSocial'];
		 }elseif($_POST['razonSocial']){ 
		echo trim($_POST['razonSocial']);
		}
		?>" size="60" />
      </span></span>
      <label> <a href="#" onClick="ventanaSecundaria111('/sima/INGRESOS HLC/cxc/ventanaModificaRFC.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')"> <img src="/sima/imagenes/btns/editbtn.png" alt="EDITAR A: <?php echo $myrow['descripcionGP'];?>" width="16" height="16" border="0" /> </a></label>
    </span></td>
    Si el RFC no aparece, darlo de alta. </tr>
</table>
<?php } ?>





<?php  if($_POST['tipoFactura']=='aseguradora'){ ?>
<table width="455" class="table-forma">
  <?php 

 $sSQL2= "Select * From clientes WHERE entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
  <tr >
    <td >Seguro<span >
      <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
    </span></td>
    <td ><span >
      <label>
        <input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php 
		if($myrow){
		
		}else if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
        </label>
    </span></td>
  </tr>
</table>
<?php } ?>

<?php if($_POST['tipoFactura']){ ?>

<p align="center">&nbsp;</p>
<label></label>
<p align="center">
  <label>
  <input type="submit" name="button" id="button" value="Ajustar" />
  </label>
  <?php } ?>
</p>
	<p>&nbsp;</p>
</form>
  <p>&nbsp;</p>
	
      
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
