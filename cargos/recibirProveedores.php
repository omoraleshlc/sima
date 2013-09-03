<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php
$_POST['codigo']=$_GET['codigo'];
$cantidadSurtir=$_POST['cantidad'];
$cantidadComprar=$_GET['cantidadComprar'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){
$cantidadSuma[0]+=$cantidadSurtir[$i];
}

?>



<?php 
if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}

	$sSQL17= "Select * From OC WHERE 
codigo= '".$_POST['codigo']."' 
and
status ='solicita'
and
id_requisicion='".$_GET['id_requisicion']."'

";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$solicitantes=$myrow17['cantidad'];


if($_POST['actualizar']  AND $_POST['codigo'] ){ 

$cantidad=$_POST['cantidad'];
$codigoAlfa=$_POST['codigoAlfa'];
$id_requisicion=$_GET['id_requisicion'];
 

for($i=0;$i<=$_POST['pasoBandera'];$i++){




if($cantidad[$i]){
$sSQL18= "
SELECT 
*
FROM
solicitudesProveedores
WHERE 
codigo='".$_POST['codigo']."' and
id_proveedor='".$codigoAlfa[$i]."'
and

status='solicita'

"; 
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18 = mysql_fetch_array($result18);
echo mysql_error();
$cantidadaComprar=$myrow18['cantidad'];



if($solicitantes==$cantidadSuma[0]){
if(!$myrow18['codigo'] ){//existe?= actualizalo

$agregaSaldo = "INSERT INTO solicitudesProveedores ( codigo,cantidad,usuario,fecha,hora,id_proveedor,status,id_requisicion) 
values 
('".$_POST['codigo']."','".$cantidad[$i]."','".$usuario."',
'".$fecha1."','".$hora1."',
'".$codigoAlfa[$i]."','solicita','".$_GET['id_requisicion']."'
)";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error();
} else {
$remover = "update solicitudesProveedores 
set
cantidad='".$cantidad[$i]."'
where id_requisicion='".$_GET['id_requisicion']."' and
codigo='".$_POST['codigo']."' and
id_proveedor='".$codigoAlfa[$i]."'
";
mysql_db_query($basedatos,$remover);
echo mysql_error();
}
} else {

$leyenda="Tu cantidad debe ser igual a la orden de compra";
}




}

} //cierra for
//se hicieron cambios
}







if($_POST['borrar'] AND $_POST['codigo']){
if($quitar = $_POST['quitar']){
for($i=0;$i<=$_POST['pasoBandera'];$i++){


$borrame = "DELETE FROM solicitudesProveedores WHERE keySP ='".$quitar[$i]."' 
 ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda="Debes cuadrar la cantidad requerida por OC con la cantidad que estas escribiendo..";
}
}echo '<script type="text/vbscript">
msgbox "SE ELIMINO REGISTRO!!"
</script>';
}






if($_POST['usuario']){
$sSQL1= "Select distinct * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
} 


?>

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.style15 {color: #0000FF}
-->
</style>
</head>

<body>
<h1 align="center">RECIBIR ARTICULOS/NOTAS DE CREDITO</h1>
<p align="center">
  <label></label><label>
  </label></p>
<form id="form2" name="form2" method="post" action="">
<table width="323" border="1" align="center" class="style12">
      <tr>
        <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Asignar art&iacute;culo -&gt; Proveedor </span></strong></th>
      </tr>
      <tr>
        <th scope="col">C&oacute;digo: </th>
        <th width="152" scope="col"><label>
          <input name="codigo" type="text" class="style12" id="codigo" readonly="" value="<?php echo $_POST['codigo']; ?>" />
        </label></th>
      </tr>
  </table>
    <p align="center">
	<?php 
	$sSQL6="SELECT *
FROM
  `articulos`
WHERE
codigo = '".$_POST['codigo']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  echo $myrow6['descripcion'];
  ?>
	</p>
    <p align="center"><span class="style15"><?php 

	echo "Están solicitando ".$myrow17['cantidad']. " articulos ".'<br>';
	echo $leyenda;?>  </span></p>
    <table width="520" border="1" align="center">
      <tr>
        <th width="46" height="16" bgcolor="#660066" scope="col"><span class="style11">Proveedor </span></th>
        <th width="181" bgcolor="#660066" scope="col"><span class="style11">Raz&oacute;n Social </span></th>
        <th width="54" bgcolor="#660066" scope="col"><span class="style11"> Costo</span></th>
        <th width="61" bgcolor="#660066" scope="col"><span class="style11">Fecha </span></th>
        <th width="58" bgcolor="#660066" scope="col"><span class="style11">Hora </span></th>
        <th width="41" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
        <th width="33" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
      </tr>
      <tr>
        <?php   
 $sSQL= "Select distinct * From proveedores
 where status='A'
 order by razonSocial ASC";
$result=mysql_db_query($basedatos,$sSQL); 
?>
        <?php	while($myrow = mysql_fetch_array($result)){
$P=$myrow['id_proveedor'];
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

	  $alma=$myrow['almacen'];
	    $code=$myrow['codigo'];

  if($myrow6['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else {
  $estilo='style12';
  }
  	 $sSQL7="SELECT *
FROM
solicitudesProveedores
WHERE
codigo = '".$_POST['codigo']."'  and id_proveedor = '".$P."' and status='solicita'

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);
  
?>
        <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
  <label></label>
          </span>
          <div align="center"><span class="<?php echo $estilo?>"><?php echo $P?></span><span class="<?php echo $estilo?>">
            <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $P; ?>" />
          </span></div></td><td bgcolor="<?php echo $color?>" class="<?php echo $estilo?>"><span class="style12"><?php echo $myrow['razonSocial'];?></span></td>
        <td bgcolor="<?php echo $color?>" class="style12"><label><?php echo "$".number_format($myrow7['costo'],2); ?></label></td>
        <td bgcolor="<?php echo $color?>" class="style12"><?php 
		if($myrow7['fecha']){
		echo $myrow7['fecha']; 
		} else {
		echo "---";
		}
		?></td>
        <td bgcolor="<?php echo $color?>" class="style12"><?php 
		if($myrow7['hora']){
		echo $myrow7['hora']; 
		} else {
		echo "---";
		}
		?></td>
        <td bgcolor="<?php echo $color?>" class="style12"><input name="cantidad[]" type="text" class="style7" id="cantidad[]" size="3" maxlength="3" value="<?php echo $myrow7['cantidad'];?>" 
		onKeyPress="return checkIt(event)"/>		</td>
        <td bgcolor="<?php echo $color?>" class="style12"><label>
          <input name="quitar[]" type="checkbox" class="style7" id="quitar[]" value="<?php echo $myrow7['keySP'];?>" 
		  <?php if(!$myrow7['cantidad']){ echo 'readonly="readonly"';}?>
		  />
        </label></td>
      </tr>
      <?php }?>
  </table>
    <p align="center">
      <label><span class="<?php echo $estilo?>">
      <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
      </span>
      <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar Proveedor" />
      </label>
      <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar Proveedor" />
    </p>
</form>
  <p></p>
  <p></p>
</body>
</html>
