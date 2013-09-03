<?PHP include("/configuracion/administracionhospitalaria/servicios/inventariosmenu.php");?>
<?php include('/configuracion/clases/validaModulos.php'); ?>


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

<body>
 <h1 align="center" class="titulos">Cat&aacute;logo de Grupo de Productos <?php   
 $sSQL= "Select distinct * From gpoProductos where entidad='".$entidad."' ORDER BY activo='activo' DESC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </h1>
 <form id="form1" name="form1" method="post" >
   <table width="773" border="0" align="center">
     <tr>
       <th width="60" bgcolor="#660066" scope="col"><div align="left" class="blanco">Cod. GP</div></th>
       <th width="281" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripci&oacute;n de Productos </div></th>
       <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Cargos Directos(Stock)</div></th>
       <th width="44" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">%P</div>
       </div></th>
       <th width="44" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">%A</div>
       </div></th>
       <th width="44" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">Prefijo</div>
       </div></th>
       <th width="33" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">Tasa</div>
       </div></th>
       <th width="41" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">Modulos</div>
       </div></th>
       <th width="41" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">Editar</div>
       </div></th>
       <th width="74" bgcolor="#660066" scope="col"><div align="left" class="blanco">
         <div align="center">Status</div>
       </div></th>
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
$C=$myrow['codigoGP'];
?>
       <td bgcolor="<?php echo $color?>" class="normal">
         <label>
         <?php echo $C?>         </label>
       </span></td>
       <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['descripcionGP'];?></td>
       <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['cargosDirectos'];?></td>
       <td bgcolor="<?php echo $color?>" class="normal"><div align="center">
         <?php if($myrow['porcentajeParticular']!='0'){
	   echo $myrow['porcentajeParticular'].'%'; } else {
	   echo "?";
	   }
	   ?>
         </span></div></td>
       <td bgcolor="<?php echo $color?>" class="normal"><?php if($myrow['porcentajeAseguradora']!='0'){
	   echo $myrow['porcentajeAseguradora'].'%'; } else {
	   echo "?";
	   }
	   ?></td>
       <td bgcolor="<?php echo $color?>" class="normal">
         <div align="center">
           <?php if($myrow['prefijo']!='0'){
	   echo $myrow['prefijo']; } else {
	   echo "?";
	   }
	   ?>
       </span></div></td>
       <td bgcolor="<?php echo $color?>" class="normal">
         <div align="center">
           <?php if($myrow['tasaGP']!=null){
	   echo $myrow['tasaGP']; } else {
	   echo "N/A";
	   }
	   ?>
         </div></td>
       <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style71"> <a href="#" onClick="ventanaSecundaria1('ventanaModulos-Grupos.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')">
		 <img src="/sima/imagenes/btns/editbtn.png" alt="EDITAR A: <?php echo $myrow['descripcionGP'];?>" width="16" height="16" border="0" /> </a> </span></div></td>
       <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style71"> 
         
         <a href="#" onClick="ventanaSecundaria1('ventanaCatalogoGrupoProductos.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $A; ?>&amp;codigoGP1=<?php echo $C?>&amp;codigosGP=<?php echo $C?>')"> 
           
       <img src="/sima/imagenes/btns/editbtn.png" alt="EDITAR A: <?php echo $myrow['descripcionGP'];?>" width="16" height="16" border="0" /> </a> </span></div></td>
       <td bgcolor="<?php echo $color?>" class="style12">
         <div align="center"><span class="style71"> 
           
           
           
             </span><span class="Estilo24">
               
             <?php if($myrow['activo']=='activo'){ ?>
             <a href="gpoProductos.php?codigoGP=<?php echo $C; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $A; ?>">
               
             <img src="/sima/imagenes/btns/unlockbtn.png" alt="ACTIVO" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
               <?php } else { ?> 
               <a href="gpoProductos.php?codigoGP=<?php echo $C; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $A?>"> <img src="/sima/imagenes/btns/lockbtn.png" alt="INACTIVO" width="16" height="16" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
               <?php } ?>
       </span></div></td>
     </tr>
     <?php }?>
   </table>
   <p align="center">
     <input name="nuevo" type="image" src="../../imagenes/btns/newproduct.png" id="nuevo" value=",...."
	  onclick="ventanaSecundaria1('ventanaCatalogoGrupoProductos.php')" />
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>