<?php require("menuOperaciones.php");
$ventana1='ventanaCatalogoAlmacen.php';
?>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventanaSecundaria4","width=800,height=600,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
<?php 
if($_GET['tipoAlmacen'] AND $_GET['almacen']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE almacenes set 

		activo='I'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE almacenes set 

		activo='A'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}

$_POST['tipoAlmacen']=$_GET['tipoAlmacen'];

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
 <h1 align="center" class="titulos">Listado Departamentos - Descuentos</h1>
 <form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
   <p>&nbsp;

   
   </p>
   

   

   <table width="478" class="table table-striped" >
     <tr >	
       <th width="26"  scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>

       <th width="200"  scope="col"><div align="left" >
         <div align="left">Almac&eacute;n</div>
       </div></th>
       <th width="41"   scope="col"><div align="left" >
         <div align="left">Editar</div>
       </div></th>

   
         
                 <th width="41"   scope="col"><div align="left" >
         <div align="left">xGrupo</div>
        
       </div></th>
         
           <th width="41"   scope="col"><div align="left" >
         <div align="left">xServicio</div>
        
       </div></th>
     </tr>
     
     
     
     
<?php   

$sSQL= "Select * From almacenes where
entidad='".$entidad."'
and
miniAlmacen='No'
and
activo='A'
order by descripcion ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;



$sSQL7a= "Select * From descuentosAutomaticos where entidad='".$entidad."' and 
departamento='".$myrow['almacen']."'";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
$myrow7a = mysql_fetch_array($result7a);
echo mysql_error();
?> 





     <tr   >
       <td ><?php echo $f;?></td> 

       
       
       <td ><span ><?php echo $myrow['descripcion'];?></span></td>
       <td ><div align="center">
         <?php if($myrow7a['departamento']){  ?>
         <a href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" id="editar<?php echo $f;?>" onClick="ventanaSecundaria10('/sima/ventanas/listaDescuentoAuto.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo $myrow['descripcion'];?>&lt;/div&gt;')" onMouseOut="UnTip()"><img src="../imagenes/btns/editbtn.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>" width="20" height="20" border="0" /></a>
         <?php } else{ echo '---';} ?>
       </div></td>
   
		
	       <td >
	   
	   
         <div align="center">
           <?php if($myrow['activo']=='A'){  ?>
             <a href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria4('/sima/ventanas/ventanaDescuentoAuto.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">
               Add
             </a>
           <?php }  ?>	   
       </div></td>
       
       
      
       
             <td >
	   
	   
         <div align="center">
           <?php if($myrow['activo']=='A'){  ?>
             <a href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria4('/sima/ventanas/ventanaDescuentoAutoServicio.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">
               Add
             </a>
           <?php }  ?>	   
       </div></td>
     </tr>
     <?php }}?>
   </table>
   
   <p align="center">
     <label></label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>