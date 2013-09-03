<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 



<?php 




if($_POST['actualizar'] and $_POST['precioVenta']>0){ 


$sSQL1= "Select * From cargosCuentaPaciente WHERE 
keyCAP='".$_GET['keyCAP']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


if($myrow1['keyCAP']!=NULL){

	     $q = "UPDATE cargosCuentaPaciente set 
		precioVenta='".$_POST['precioVenta']."'
		WHERE 
		keyCAP='".$_GET['keyCAP']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();

//***********ACTUALIZA SCRIPT CCP*************

        ?>
<script>
window.alert("Se actualizaron datos...");
window.opener.document.forms["form1"].submit();
//window.close();
</script>

<?php 
}
}
?>









<?php 

if($_POST['delete'] ){ 
$sSQL1= "Select * From cargosCuentaPaciente WHERE 
keyCAP='".$_GET['keyCAP']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$sSQL1a= "Select * From cargosCuentaPaciente WHERE keyCAP='".$_GET['keyCAP']."'  ";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

if($myrow1a['keyCAP']){

$q = "DELETE FROM cargosCuentaPaciente WHERE keyCAP='".$_GET['keyCAP']."'";
//***********ACTUALIZA SCRIPT CCP*************
mysql_db_query($basedatos,$q);
echo mysql_error();
//******************************************
?>
<script>
window.alert("Registro Eliminado...");
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php 
}


}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

</head>


<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php 



$sSQL31= "SELECT 
*
FROM cargosCuentaPaciente
WHERE keyCAP ='".$_GET['keyCAP']."'";

$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>
<body >
<form name="form1" method="post">
  <p align="center" class="titulos"><strong>Editar Movimiento </strong></p>
  <table width="364" border="3" align="center" cellpadding="1" cellspacing="1" class="style71">
    <tr>
      <th width="153" scope="col"><div align="left" class="negromid">Importe</span></div></th>
      <th width="194" scope="col"><div align="left">
        <label>
        <input name="precioVenta" type="text" class="camposmid" id="precioVenta" value="<?php echo $myrow31['precioVenta'];?>">
        </label>
      </div></th>
    </tr>
    
  </table>
  <p align="center"><label>
    <input name="actualizar" type="submit" src="../imagenes/btns/refresh.png" id="actualizar" value="Aplicar Cambios">
    </label>
    <span class="negromid">
    <input name="codigo" type="hidden" class="camposmid" id="codigo"    />
	 <input name="gpoProducto" type="hidden" class="camposmid" id="codigo"    value="<?php echo $myrow31['gpoProducto'];?>">
    </span>
    <label>
    <input name="delete" type="submit" id="delete" value="Eliminar" />
    </label>
  </p>
</form>
<p>&nbsp;</p>


</body>
 