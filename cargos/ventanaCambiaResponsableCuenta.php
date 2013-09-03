<?php require("/configuracion/ventanasEmergentes.php");?>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");

if($_GET['almacen']){
$almacen=$_GET['almacen'];
} else {
$almacen=$_POST['almacen'];
}


if($_POST['actualizar'] and $_POST['responsableCuenta'] and $_GET['keyCAP']){


$actualiza3 = "UPDATE cargosCuentaPaciente
set
responsableCuenta='".$_POST['responsableCuenta']."',
descripcionSeguroFacturacion='".$_POST['nomSeguro']."',
seguroFacturacion='".$_POST['seguro']."',
fechaVencimiento='".$_POST['fechaVencimiento']."'
WHERE 
keyCAP='".$_GET['keyCAP']."'

";
mysql_db_query($basedatos,$actualiza3);
echo mysql_error();




?>
<script language="JavaScript" type="text/javascript">
  <!--

window.alert("Se actualizaron datos!");
window.opener.document.forms["form1"].submit();
window.close();
  // -->
</script>



<?php
}





?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />


	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<?php 
$estilo=new muestraEstilos();
$estilo->styles();
?>


</head>

<?php 
$sSQLCaR= "Select * From cargosCuentaPaciente where   keyCAP='".$_GET['keyCAP']."'  ";
$resultCaR=mysql_db_query($basedatos,$sSQLCaR);
$myrowCaR = mysql_fetch_array($resultCaR);

?>
<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="432" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="3"><img src="../imagenes/bordestablas/borde1.png" width="520" height="25" /></td>
    </tr>



    <tr>
      <td width="149" align="right" bgcolor="#CCCCCC" class="negromid">Se factura a:  (opcional) </td>
      <td width="16" bgcolor="#CCCCCC"><span class="negromid">
        <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php echo $myrowCaR['seguroFacturacion'];?>" 
		/>
      </span></td>
      <td width="267" bgcolor="#CCCCCC"><input name="nomSeguro" type="text" class="camposmid" id="nomSeguro"
		value="<?php echo ltrim($myrowCaR['descripcionSeguroFacturacion']);?>" size="60"/></td>
    </tr>


    <tr>
    
      <td bgcolor="#CCCCCC" class="negromid" align="right">Titular (Responsable)</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><input name="responsableCuenta" type="text" class="negromid" id="responsableCuenta" size="35"  value="<?php echo $myrowCaR['responsableCuenta'];?>"/></td>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC" class="negromid" align="right">Fecha de Vencimiento</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC"><span class="titulo">
        <label>
        <input name="fechaVencimiento" type="text" class="negromid" id="campo_fecha" size="10" maxlength="10" readonly="readonly"
		value="<?php echo $myrowCaR['fechaVencimiento'];?>"/>
        </label>
        <input name="button" type="button" class="style12" id="lanzador" value="..." />
      </span></td>



      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot&oacute;n que lanzar&aacute; el calendario 
}); 
    </script>
    </tr>
    <tr>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
      <td bgcolor="#CCCCCC">&nbsp;</td>
    </tr>

    <tr>
      <td colspan="3"><img src="../imagenes/bordestablas/borde2.png" width="520" height="25" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center"><label>
    <input name="actualizar" type="submit" class="style7" id="actualizar" value="Actualizar Cambios">
    </label>
  </p>
</form>
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
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipales.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>
