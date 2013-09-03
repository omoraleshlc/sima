<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar']  and $_POST['escoje']){


if($_POST['escoje']=='abierta'){

//******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$descripcion='Regresar a Cuenta Abierta';
$as=$_GET['almacen'];
$ad=$myrow7['almacen'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************
$q = "UPDATE clientesInternos set 
statusCuenta='abierta' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
}else if($_POST['escoje']=='revision'){

    //******************LOGS DEL PACIENTE*********************
$sSQL7= "Select almacen,folioVenta,cuarto From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."'";
$result7=mysql_db_query($basedatos,$sSQL7);
$myrow7 = mysql_fetch_array($result7);
$descripcion='Enviar a Revision o para cargar Coaseguro.';
$as=$_GET['almacen'];
$ad=$myrow7['almacen'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$as."','".$ad."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','".$myrow7['folioVenta']."',
'".$myrow7['cuarto']."','".$_POST['cuarto']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
//***************************************

$q = "UPDATE clientesInternos set 
statusCuenta='revision' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	


}

?>



<script >
window.alert("La cuenta se fue a status: <?php echo $_POST['escoje'];?>");
   window.opener.document.forms["form1"].submit();
  window.close();
</script>
<?php 
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>
<?php 
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>
<form name="form1" method="post" action="">
  <table width="294" class="table-forma">
    <tr>
      <th colspan="2">
      <h1 align="center" >Enviar Cuenta del px <?php echo $myrow['paciente'];?> </h1>      </th>
    </tr>
    <tr>
      <td width="90" ><label>
        <input name="escoje" type="radio" value="abierta" />
      </label></td>
      <td width="416">Cuenta Activa (Hacer Cargos) </td>
    </tr>
    <tr>
      <td ><input name="escoje" type="radio" value="revision" /></td>
      <td>Cuenta en Revision (Cargar Coaseguro) </td>
    </tr>
  </table>
  <p align="center">
  

    <label>
    <input name="actualizar" type="submit"  id="actualizar" value="Enviar">
    </label>
  </p>
</form>
<p>
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
			return "/sima/cargos/clientesTodosAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>

</body>
</html>