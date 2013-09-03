<?PHP require("menuOperaciones.php"); ?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=600,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #000; font-size: 13px; font-weight: bold; }
.style12 {font-size: 13px}
body {
	background-image: url(../../imagenes/imagenesModulos/screen_genmantenimiento.jpg);
	background-attachment:fixed;
	background-repeat:no-repeat;
}
.style14 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #000066;
	font-weight: bold;
}
.style15 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style18 {font-size: 12px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style19 {color: #FF0000}
.style20 {font-size: 9px}
-->
</style>
</head>

<body>
 <h1 align="center" class="style14">&nbsp;</h1>
 <h1 align="center" class="style14">Cat&aacute;logo de Clasificaciones de Equipos de Sistemas
   <?php   
$sSQL= "Select * From clasificacionEquiposSistemas where entidad='".$entidad."' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </h1>
 <form id="form1" name="form1" method="post" action="">
   <p align="center">&nbsp;</p>
   <img src="../imagenes/bordestablas/borde1.png" width="400" height="24" />
   <table width="400" border="0" align="center" cellpadding="4" cellspacing="0">
     <tr bgcolor="#FFFF00">
       <th width="64" scope="col"><div align="left" class="style15"><span class="style11">C&oacute;digo </span></div></th>
       <th width="280" scope="col"><div align="left" class="style15"><span class="style11">Descripci&oacute;n </span></div></th>
       <th width="41" scope="col"><div align="left" class="style15">
         <div align="center"><span class="style11">Editar</span></div>
       </div></th>
     </tr>
     <tr class="style18">
       <?php
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['codigo'];
?>
      <td bgcolor="<?php echo $color?>" class="style12"><span class="style18 style20">
         <label>
         <span class="style19"><?php echo $C?>         </span></label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style18 style20"><?php echo $myrow['descripcion'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="style20"><a href="#" class="style15" 
onclick="javascript:ventanaSecundaria1('ventanaCatalogoCEM.php?almacen=<?php echo $_POST['almacenDestino2']; ?>&codigo=<?php echo $C; ?>')"><img src="../imagenes/newicons/modify_icon.jpg" alt="" width="12" height="12" border="0" /></a></div></td>
     </tr>
     <?php }?>
   </table>
   <img src="../imagenes/bordestablas/borde2.png" width="400" height="24" />
   <div align="center">
     <p>
       <input name="nuevo" type="button" class="style15" id="nuevo" value="Nueva Clasificaci&oacute;n"
	  onclick="ventanaSecundaria1('ventanaCatalogoCEM.php?almacen=<?php echo $_POST['almacenDestino2'];?>')" />
     </p>
   </div>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>
