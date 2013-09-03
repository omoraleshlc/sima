<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=300,height=100,scrollbars=NO") 
} 
</script> 




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
-->
</style>
</head>
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<body>

<h1 align="center" class="style12">Listado de sesiones activas</h1>
<form id="form1" name="form1" method="post" action="modificaUsuarios.php">

  <table width="654" border="0" align="center">
    <tr>
      <th width="96" height="0" bgcolor="#660066" scope="col"><span class="style11">ID Usuario/Username</span></th>
      <th width="254" bgcolor="#660066" scope="col"><span class="style11">Nombre, Apellido(s) </span></th>
      <th width="116" bgcolor="#660066" scope="col"><span class="style11">Hora de Inicio de Sesi&oacute;n </span></th>
      <th width="114" bgcolor="#660066" scope="col"><span class="style11">Fecha de Inicio de Sesi&oacute;n </span></th>
      <th width="40" bgcolor="#660066" scope="col"><span class="style11">Sessiones</span></th>
    </tr>
    <tr>
<?php
 $sSQL1= "Select * From usuarios WHERE llave!='' order by aPaterno ASC";
$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){
$E=$myrow1['usuario'];

?>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <label>
        <?php echo $E?>        </label>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><?php echo $myrow1['nombre']." ".$myrow1['aPaterno']." ".$myrow1['aMaterno'];?></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><div align="center"><?php echo $myrow1['horaIngreso'];?></div></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><div align="center"><?php echo $myrow1['fechaIngreso'];?></div>
      <div align="center"></div></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><?php 

?>
        <?php if($myrow1['usuario']!=$usuario){ ?>
        <?php if($myrow1['usuario']){ ?>
        <a href="javascript:ventanaSecundaria('sesionFuera.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $E; ?>')"> <img src="sinCandado.png" width="23" height="23" border="0" onClick="if(confirm('Esta seguro que deseas cerrarle la sesión?') == false){return false;}" /></a>
        <?php }else { ?>
        <a href="javascript:ventanaSecundaria('activarCuenta.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"> <img src="candado.png" width="23" height="23" border="0"  onclick="if(confirm('Esta seguro que deseas activar la cuenta?') == false){return false;}" /></a>
        <?php } ?>
        <?php } else { ?>
        <img src="stop.png" alt="NO PUEDES QUITAR TU PROPIA SESION" width="23" height="23" />
        <?php } ?></td>
    </tr>
    <?php } ?>
  </table>
  <p align="center">&nbsp;

  </p>
</form>
<p>&nbsp;</p>
</body>
</html>
