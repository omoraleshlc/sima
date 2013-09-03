<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php
if($_POST['cambiar'] and $_POST['status'] and $_GET['keyR'] ){

$q1 = "UPDATE OC set 
status='".$_POST['status']."'
WHERE keyR = '".$_GET['keyR']."'
";
mysql_db_query($basedatos,$q1);

?>
<script>
  <!--
    window.opener.document.forms["form1"].submit();
    window.close();
  // -->
</script>


<?php 
print 'Se hizo un movimiento...';
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
  <table width="175" border="0" align="center">
    <tr>
      <th width="169" height="19" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
    </tr>
    <tr>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center">
        <select name="status" id="status">
         
          <option value="standby">standby</option>
          <option value="cancelado">cancelado</option>
        </select>
      </div></td>
    </tr>
    <tr>
<?php 
$sSQL11= "Select distinct * From cuartos
where entidad='".$entidad."' and departamento='".$_GET['almacen']."'
order by codigoCuarto ASC";



$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$b+=1;
$codCuarto=$myrow11['codigoCuarto'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



 $sSQL15="SELECT *
FROM
  `articulos`
WHERE
id_cuarto = '".$codCuarto."'  
  ";
  $result15=mysql_db_query($basedatos,$sSQL15);
  $myrow15 = mysql_fetch_array($result15);




//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><label>
        <div align="center">Observaciones
        </div>
        <div align="center">
          <textarea name="observaciones" wrap="physical" id="observaciones" ></textarea>
        </div>
      </label></td>
    </tr>

  </table>
  <p align="center"><label>
  <input name="bandera" type="hidden" class="style7" value="<?php echo $b;?>" />
    <input name="cambiar" type="submit" class="style7" id="cambiar" value="Cambiar" />
  </label>
    <label></label>
  </p>
  <tr>
    <td>
    
</form>
<p>&nbsp; </p>
</body>
</html>
