<?php require("menuOperaciones.php");
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
if($_GET['tipoAlmacen'] AND $_GET['almacen']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE almacenes set 

		activo='I'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		 $borrame = "DELETE FROM camposGrupos WHERE entidad='".$entidad."' and id_almacen='".$_GET['almacen']."'";
mysql_db_query($basedatos,$borrame);
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
 <h1 align="center" class="titulos">Listado de Reportes Automaticos </h1>
 <form id="form2" name="form2" method="post" >
  
  <div align="center" class="normalmid">
          <span class="negromid">Descripcion</span>
      
       
      <span >
           <input name="descripcion" type="text" class="camposmid" id="descripcion" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>">
       </span></div>
           <label>
           <div align="center">
             <input name="buscar" type="submit" src="../imagenes/btns/searchbutton.png" id="buscar" class="none" value="buscar" />
             <br />
             <?php
	  if($_POST['buscar'] and $_POST['descripcion']){ ?>
           </div>
         </label>
         
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <table class="table table-striped" width="379" >
     <tr >
       <th width="24" ><div align="left" class="none">
         <div align="left"># </div>
       </div></th>
<th width="197" height="15" ><div align="left" class="none">
  <div align="left">Descripcion </div>
</div></th>
       <th width="82" ><div align="left" class="none">
         <div align="left">usuario</div>
       </div></th>

       <th width="58" ><div align="left" class="none">
         <div align="left"></div>
       </div></th>
     </tr>
     
     
     
     
<?php   
$descripcion=$_POST['descripcion'];				

if($descripcion=='*'){
$sSQL= "Select * From reportesAutomaticos where
entidad='".$entidad."'

order by descripcion ASC";

}else{
$sSQL= "Select * From reportesAutomaticos where
entidad='".$entidad."'
and
descripcion like '%$descripcion%'
order by descripcion ASC";
}
 
 
 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;
?> 





     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
       <td class="codigos"><?php echo $f;?></td> 
       <td class="codigos"><span class="normal">

	   <?php echo $myrow['descripcion'];?>	 
	   </span></td>
       <td class="style12"><span class="normal"><?php echo $myrow['usuario'];?></span></td>
       <td class="style12"><span class="normal"><a href="#" name="status<?php echo $f;?>" id="status<?php echo $f;?>" onClick="javascript:ventanaAgregar('../ventanas/mostrarResumen.php?keyREPA=<?php echo $myrow['keyREPA']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&amp;departamento=<?php echo $_POST['departamento'];?>#status<?php echo $f;?>');"> Ver </a></span></td>
     </tr>
     <?php }}}?>
   </table>
   <p align="center">
     <label></label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>