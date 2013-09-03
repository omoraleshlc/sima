<?php include("/configuracion/operacioneshospitalariasmenu/administracion/administracion.php"); ?>
<?php include('/configuracion/funciones.php'); 
$ventana1='ventanaCatalogoAlmacen.php';
?>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaAgregar (URL){ 
   window.open(URL,"ventanaAgregar","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
<?php 
if($_GET['klista'] AND $_GET['elimina']=='si'){

$q = "DELETE FROM catalogoexpedientes where klista='".$_GET['klista']."' ";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		echo '<span class="error"><blink>'.'Se eliminaron la lista de expediente(s)...'.'</blink></span>';

}
?>

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title></title>
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
 
 <h1 align="center" class="titulos">
     Catalogo de Expedientes
 </h1>
    
 <form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
   <p>&nbsp;</p>
   <table width="400" border="0" align="center" class="style7">
     <tr bgcolor="#330099">
       <th width="24" scope="col"><div align="left" class="blanco">
         <div align="left"># </div>
       </div></th>
<th width="197" height="15" scope="col"><div align="left" class="blanco">
  <div align="left">Descripcion </div>
</div></th>
    
       <th width="10" scope="col"><div align="left" class="blanco">
         <div align="left">Usuario </div>
       </div></th>

       <th width="10" scope="col"><div align="left" class="blanco">
         <div align="left">---</div>
       </div></th>
       <th width="10" scope="col"><div align="left" class="blanco">
         <div align="left">---</div>
       </div></th>
     </tr>
     
     
     
     
        	    <?php   
				

$sSQL= "Select * From catalogoexpedientes 
order by descripcion ASC";

 
 
 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;
?> 





     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
       
       <td class="codigos">
       <?php echo $f;?>
       </td> 
       
       <td class="codigos">
           <span class="normal">
	   <?php echo $myrow['descripcion'];?>	 
	   </span>
       </td>
           
           
       <td class="normal"><span class="normal"><?php echo $myrow['usuario'];?></span></td>
       <td class="normal">
	   <span class="normal">
	   	   <a href="#" name="status<?php echo $f;?>" onClick="javascript:ventanaSecundaria1('ventanaEditarCatalogoExpedientes.php?klista=<?php echo $myrow['klista']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&departamento=<?php echo $_POST['departamento'];?>#status<?php echo $f;?>');">
	   Edit	   </a>	   </span>	   </td>

		
       <td class="normal">
	   <div align="center" class="normal">	    <span class="normal">
	   
	   <a name="status<?php echo $f;?>" href="listaPacientes.php?klista=<?php echo $myrow['klista']; ?>&elimina=si" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este catalogo?') == false){return false;}">
               
           Elimina
           </a>
	   
	   
	   </span></div></td>
     </tr>
     <?php }}?>
   </table>
   <p align="center">
     <label>
     <input name="nuevo" type="button" class="normal" id="nuevo" value="Nuevo Reporte"
	  onclick="ventanaSecundaria1('ventanaEditarCatalogoExpedientes.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&departamento=<?php echo $_POST['departamento'];?>')" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>