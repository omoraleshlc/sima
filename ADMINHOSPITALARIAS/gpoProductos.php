<?PHP require("menuOperaciones.php"); ?>



<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=550,height=350,scrollbars=YES") 
} 
</script> 


<?php 
if($_GET['codigoGP'] ){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE gpoProductos set 

		activo='inactivo'
		WHERE 
		entidad='".$entidad."' AND
		codigoGP='".$_GET['codigoGP']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE gpoProductos set 

		activo='activo'
		WHERE 
		entidad='".$entidad."' AND
		codigoGP='".$_GET['codigoGP']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>
<br>
<br>
<body>
 <h1 align="center" >Cat&aacute;logo de Grupo de Productos <?php   
 $sSQL= "Select distinct * From gpoProductos  ORDER BY activo='activo' DESC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </h1>
 <form id="form1" name="form1" method="post" >
   <table width="500" class="table table-striped">

     <tr>
       <th width="256"  >Descripcion</th>
       <th width="79"   align="center">Cargos (Stock)</th>
   

       <th width="40"   align="center">Prefijo</th>
       <th width="37"   align="center">Tasa</th>
       <th width="54"   align="center">Modulos</th>
       <th width="94"   align="center">Status</th>
     </tr>
     <?php	
	   while($myrow = mysql_fetch_array($result)){
	

$C=$myrow['codigoGP'];
?>
    <tr  >
       <td height="43"><span ><a href="#" onClick="ventanaSecundaria1('ventanaCatalogoGrupoProductos.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')"> 
		<?php echo $myrow['descripcionGP'];?></a></span><br /><span >Codigo del Grupo: </span><span class="negro">
<label><?php echo $C?></label></span>
       </span></td>
       <td align="center"><span ><?php echo $myrow['cargosDirectos'];?></span></td>






       <td  align="center"><?php if($myrow['prefijo']!='0'){
	   echo $myrow['prefijo']; } else {
	   echo "?";
	   }
	   ?></td>
       <td  align="center"><?php if($myrow['tasaGP']!=null){
	   echo $myrow['tasaGP']; } else {
	   echo "N/A";
	   }
	   ?></td>
       <td align="center"><span ><a href="#" onClick="ventanaSecundaria1('ventanaModulos-Grupos.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')"><img src="../imagenes/btns/editbtn.png" alt="EDITAR A: <?php echo $myrow['descripcionGP'];?>" width="16" height="16" border="0" /></a></span></td>
       <td align="center"><span class="Estilo24">
         <?php if($myrow['activo']=='activo'){ ?>
         <a href="gpoProductos.php?codigoGP=<?php echo $C; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $A; ?>"> <img src="../imagenes/btns/checkbtn.png" alt="ACTIVO" width="20" height="20" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
         <?php } else { ?>
         <a href="gpoProductos.php?codigoGP=<?php echo $C; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $A?>"> <img src="../imagenes/btns/lockbtn.png" alt="INACTIVO" width="16" height="16" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
         <?php } ?>
       </span></td>
     </tr>
     <?php }?>

   </table>
   <p align="center">
    
   </p>
   
</form>

 <p align="center">&nbsp;</p>
</body>
</html>