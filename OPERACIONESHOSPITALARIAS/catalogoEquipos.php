<?php include("/configuracion/operacioneshospitalariasmenu/sistemas/menuSistemas.php"); 
require('/configuracion/funciones.php');?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=600,height=200,scrollbars=YES") 
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
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style13 {font-size: 10px; color: #FFFFFF; }
body {
	background-image: url(../../imagenes/imagenesModulos/screengenadmisiones.jpg);
}
-->
</style>
</head>

<body>
 <h1 align="center">Cat&aacute;logo de Equipos M&eacute;dicos
<?php   
 $sSQL= "Select * From clasificacionEquipos where entidad='".$entidad."' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </h1>
 <form id="form1" name="form1" method="post" action="">
   <p align="center">&nbsp;</p>
   <table width="391" border="0" align="center">
     <tr>
       <th width="51" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo </span></div></th>
       <th width="209" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripci&oacute;n </span></div></th>
       <th width="67" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Fecha Creaci&oacute;n </span></div></th>
       <th width="46" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Editar</span></div></th>
     </tr>
     <tr>
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
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7">
         <label>
         <?php echo $C?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['descripcion'];?></span></td>
       <td bgcolor="<?php echo $color?>" class="style12">&nbsp;</td>
       <td bgcolor="<?php echo $color?>" class="style12"><a href="#" 
onclick="javascript:ventanaSecundaria1('ventanaCatalogoCEM.php?almacen=<?php echo $_POST['almacenDestino2']; ?>&codigo=<?php echo $C; ?>')"><img src="/sima/imagenes/transfer1.jpeg" alt="" width="12" height="12" border="0" /></a></td>
     </tr>
     <?php }?>
   </table>
   <div align="center">
     <input name="nuevo" type="button" class="style7" id="nuevo" value="Nuevo Equipo M&eacute;dico"
	  onclick="ventanaSecundaria1('ventanaCatalogoCEM.php?almacen=<?php echo $_POST['almacenDestino2'];?>')" />
   </div>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>
