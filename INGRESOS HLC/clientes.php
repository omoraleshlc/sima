<?PHP require("menuOperaciones.php"); ?>
<?php 
$ventana='ventanaModificaClientes.php';
$ventana1='despliegaSubClientes.php';

?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=550,height=400,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=700,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>  



<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventanaSecundaria20","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>  


<?php 
$ventanaCentro=new ventanasCentro();
$ventanaCentro->despliegaVentanaCentro('blue','0.5','800','600','800','400','800','500');
?>



<?php 
if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($_POST['numCliente']!=$myrow1['numCliente']){
$agrega = "INSERT INTO clientes (
numCliente,nomCliente,usuario,fecha,nivel,entidad
) values ('".$_POST['numCliente']."','".$_POST['nomCliente']."',
'".$usuario."','".$fecha1."','".$_POST['nivel']."','".$_POST['ID_AUXILIAR']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE DIO DE ALTA AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);

  // -->
</script>';
} else {
 $q = "UPDATE clientes set 
nomCliente='".$_POST['nomCliente']."',
nivel='".$_POST['nivel']."',
ID_AUXILIAR='".$_POST['ID_AUXILIAR']."',
usuario='".$usuario."',
fecha='".$fecha1."'
WHERE entidad='".$entidad."' AND
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);

  // -->
</script>';
}}

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM clientes WHERE entidad='".$entidad."' AND numCliente ='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "CLIENTE ELIMINADO");
</script>';

}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['numCliente'] = "";
}


if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>


 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo= new muestraEstilos();
$estilo->styles();

?>

</head>

<body onLoad="inicio();">
 <h1 align="center" >Editar Clientes</h1>

  <form id="form2" name="form2" method="post" action="">
   <p align="center">Tipo 
     <label>
     <select name="tipoCliente" onChange="this.form.submit();">
	 
	 <option value="">Escoje</option>
	 
       <option
	   <?php if($_POST['tipoCliente']=='principal')echo 'selected=""';?>
	    value="principal">principal</option>
       <option
	   	   <?php if($_POST['tipoCliente']=='subcliente')echo 'selected=""';?>
	    value="subcliente">subcliente</option>
     </select>
     </label>
   </p>

   <table width="666" class="table table-striped" >
     <tr >
       <th width="72"  scope="col"><div align="left" >
         <div align="center">Codigo </div>
       </div></th>
       <th width="349"  scope="col"><div align="left" >
         <div align="center">Nombre del Cliente </div>
       </div></th>
	   
	   <?php if($_POST['tipoCliente']=='principal'){ ?>
       <th width="73"   scope="col"><div align="center">Factura a </div></th>
	   <?php } ?>
	   
	     <?php if($_POST['tipoCliente']=='subcliente'){?>
   <th width="75"   scope="col"><div align="center">Limites(opcional)</div></th>
	   	   <?php } ?>
	   
       <th width="75"   scope="col"><div align="center">Editar</div></th>
     </tr>
	 <?php if($_POST['tipoCliente']){ ?>
     <div align="center">
       <?php   

if($_POST['tipoCliente']=='subcliente'){
 $sSQL= "Select * From clientes where entidad='".$entidad."' 
 AND
 subCliente='si'
 AND
 tipoCliente='Compania'

 order by nomCliente ASC";
}else {
 $sSQL= "Select * From clientes where entidad='".$entidad."' 
 AND
 subCliente=''
AND
clientePrincipal=''
 AND
 tipoCliente='Compania'

 order by nomCliente ASC";
}
 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
?>
     </div>
     <tr  > 
       <td height="20" ><div align="left">       <?php echo $myrow['numCliente'];?></div>
         <label></label>
       <div align="left"></div></td>
       <td ><div align="left">
         
         <?php echo $myrow['nomCliente'];?>	  
       </div></td>
       
	   
	   
	   <?php if($_POST['tipoCliente']=='principal'){ ?>
	   <td ><div align="center" >
	   
         <div align="center"><a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Editar al cliente: '.$myrow['nomCliente'];?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria20('../ventanas/clientesGrupos.php?keyClientes=<?php echo $myrow['keyClientes']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $myrow['numCliente'];?>')"> <img src="../imagenes/btns/editexpediente.png" alt="EDITAR CLIENTE <?php echo $myrow['nomCliente'];?>" width="22" height="22" border="0" /> </a> </div>
		
       </div>	   </td>
	     <?php } ?>
	   
	   
	   
	   <?php if($_POST['tipoCliente']=='subcliente'){ ?>
	   <td ><div align="center" >
         <div align="center"><a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Editar al cliente: '.$myrow['nomCliente'];?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('../ventanas/seguroLimites.php?keyClientes=<?php echo $myrow['keyClientes']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $myrow['numCliente'];?>')"> <img src="../imagenes/btns/editexpediente.png" alt="EDITAR CLIENTE <?php echo $myrow['nomCliente'];?>" width="22" height="22" border="0" /> </a> </div>
       </div></td>
	   <?php } ?>
	   
	   
       <td ><div align="center" >
    
	

	
	
         <div align="center"><a href="#" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar al cliente: '.$myrow['nomCliente'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('<?php echo $ventana;?>?keyClientes=<?php echo $myrow['keyClientes']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">
           <img src="../imagenes/btns/editexpediente.png" alt="EDITAR CLIENTE <?php echo $myrow['nomCliente'];?>" width="22" height="22" border="0" />		</a> </div>
       </div></td>
     </tr>
     <?php }}?>
   </table>

   <p align="center">
     <input name="nuevo" type="button"  id="nuevo" value="Nuevo Cliente"
	  onclick="ventanaSecundaria1('../ventanas/modificaClientes.php')" />
   </p>
</form>
 <br>
</body>
</html>