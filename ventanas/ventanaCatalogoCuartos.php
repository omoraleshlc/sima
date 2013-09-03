<?php require('/configuracion/ventanasEmergentes.php'); ?>

<?php 
if($_POST['actualizar'] AND $_POST['codigoCuarto']){

$sSQL1= "Select * From cuartos WHERE entidad='".$entidad."' AND codigoCuarto = '".$_POST['codigoCuarto']."' and departamento='".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['codigoCuarto']){
if($_POST['codigoCuarto']!=$myrow1['codigoCuarto']){
$agrega = "INSERT INTO cuartos (
codigoCuarto,descripcionCuarto,status,departamento,entidad
) values ('".$_POST['codigoCuarto']."','".$_POST['descripcionCuarto']."','libre','".$_POST['almacen']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "EL CUARTO FUE AGREGADO!"
</script>';
echo 'Cuarto Agregado';
}} else {
$q = "UPDATE cuartos set 
descripcionCuarto='".$_POST['descripcionCuarto']."',
departamento='".$_POST['almacen']."'
WHERE entidad='".$entidad."' AND
codigoCuarto='".$_POST['codigoCuarto']."'  and departamento='".$_POST['almacen']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Cuarto Actualizado';
echo '<script type="text/vbscript">
msgbox "EL CUARTO FUE ACTUALIZADO!"
</script>';

}
echo '<script language="JavaScript" type="text/javascript">
window.opener.document.forms["form1"].submit();
self.close();
</script>';
}






if($_POST['borrar'] AND $_POST['codigoCuarto']){
$borrame = "DELETE FROM cuartos WHERE entidad='".$entidad."' AND codigoCuarto ='".$_POST['codigoCuarto']."'  and departamento='".$_POST['almacen']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo 'Cuarto Eliminado';
echo '<script type="text/vbscript">
msgbox "EL CUARTO FUE ELIMINADO!"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';

}





$sSQL2= "Select * From cuartos WHERE entidad='".$entidad."' AND 
(departamento = '".$_POST['almacen']."' or departamento='".$_GET['almacen']."') 
and 
(codigoCuarto='".$_POST['codigoCuarto']."' or codigoCuarto='".$_GET['codigoCuarto']."')
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<form id="form2" name="form2" metdod="post" action="#">
  <p>&nbsp;</p>

  <table widtd="383" class="table-forma">
    <tr >
      <td widtd="1"  scope="col">&nbsp;</td>
    <td widtd="190"  scope="col"><div align="left">C&oacute;digo </div>
          <label></label></td>
      <td widtd="346"  scope="col"> <div align="left">
          <input name="codigoCuarto" type="text"  id="codigoCuarto" 
		 value="<?php echo $myrow2['codigoCuarto']; ?>" size="10" maxlengtd="6"/>
      </div></td>
    </tr>

    <tr >
      <td widtd="1"  scope="col">&nbsp;</td>
      <td >Descripci&oacute;n:</td>
      <td ><input name="descripcionCuarto" type="text"  id="descripcionCuarto" value ="<?php echo $myrow2['descripcionCuarto']; ?>" size="60"/></td>
    </tr>
    <tr >
      <td widtd="1"  scope="col">&nbsp;</td>
      <td >&nbsp;</td>
    <td ><input name="borrar" type="submit"  id="borrar" value="Eliminar Habitaci&oacute;n" />
          <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar Habitaci&oacute;n" /></td>
    </tr>
  </table>

<input name="codigoCuartos" type="hidden" id="codigoCuarto" value="<?php echo $_GET['codigo'];?>" />
  <input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
