<?php require("menuOperaciones.php"); ?>

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
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
 <h1 align="center">Cat&aacute;logo de Habitaciones/Cuartos <?php   
 $sSQL= "Select * From cuartos where entidad='".$entidad."' AND departamento='".$_POST['almacenDestino2']."' order by descripcionCuarto ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </h1>
 <form id="form1" name="form1" method="post" action="">
   <p align="center">Escoje el Departamento<span >:
<?php require("/configuracion/componentes/comboAlmacen.php");
$comboAlmacen=new comboAlmacen();
$comboAlmacen->almacenesCuartos($entidad,'style7',$myrow2['almacen'],$almacenDestino,$basedatos);
?>
   </span></p>

   <table width="600"  class="table table-striped">
     <tr>
       <th width="51" height="27" scope="col"><div align="left">C&oacute;digo </div></th>
       <th width="230" scope="col"><div align="left">Descripci&oacute;n de la Habitaci&oacute;n/Cuarto </div></th>
       <th width="107" scope="col"><div align="left">Editar</div></th>
     </tr>
     <tr>
       <?php
while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['codigoCuarto'];
?>
       <td height="33" bgcolor="<?php echo $color?>" ><span >
         <label>
         <?php echo $C?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['descripcionCuarto'];?></span></td>
       <td bgcolor="<?php echo $color?>" ><a href="#" 
onclick="javascript:ventanaSecundaria111('ventanaCatalogoCuartos.php?almacen=<?php echo $_POST['almacenDestino2']; ?>&codigo=<?php echo $C; ?>')"><img src="/sima/imagenes/transfer1.jpeg" alt="" width="12" height="12" border="0" /></a></td>
     </tr>
     <?php }?>
   </table>

   <p>&nbsp;</p>
   <div align="center">
   <?php if($_POST['almacenDestino2']){?>
     <input name="almacenDestino" type="hidden" value="<?php echo $_POST['almacenDestino'];?>">
     <input name="nuevo" type="button" id="nuevo" value="Nuevo Cuarto"
	  onclick="ventanaSecundaria1('../ventanas/ventanaCatalogoCuartos.php?almacen=<?php echo $_POST['almacenDestino2'];?>')" />
	  <?php } ?>
	  
</div>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>
