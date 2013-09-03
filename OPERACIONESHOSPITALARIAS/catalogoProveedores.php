<?php require("menuOperaciones.php"); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   

//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.id_proveedor.value) == false ) {   
                alert("Por Favor, escoje el id_proveedor/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripcion de este id_proveedor!")
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php
$ventana1='ventanaCatalogoProveedores.php';

?>

<?php 
if($_GET['id_proveedor']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE proveedores set 

		status='I'
		WHERE entidad='".$entidad."' AND
		id_proveedor='".$_GET['id_proveedor']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE proveedores set 

		status='A'
		WHERE entidad='".$entidad."' AND
		id_proveedor='".$_GET['id_proveedor']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>


 
 <h2 align="center">
   LISTADO DE PROVEEDORES <?php   
 $sSQL= "Select * From proveedores where entidad='".$entidad."' order by id_proveedor ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?> 
 </h2>
 <form id="form2" name="form2" method="post" action="">
   <img src="../imagenes/bordestablas/borde1.png" width="560" height="24" />
   <table width="560" align="center" cellpadding="4" cellspacing="0" style="border: 0px solid #000000;">
     <tr>
       <th width="73" bgcolor="#FFFF00" ><div align="left"><span class="normal">C&oacute;digo </span></div></th>
       <th width="386" bgcolor="#FFFF00" ><div align="left"><span class="normal">Raz&oacute;n Social / Nombre </span></div></th>
       <th width="39" bgcolor="#FFFF00" ><div align="left"><span class="normal">Editar</span></div></th>
       <th width="44" bgcolor="#FFFF00" ><div align="left"><span class="normal">Status</span></div></th>
     </tr>

       <?php	while($myrow = mysql_fetch_array($result)){
	   $a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['id_proveedor'];
?>

       
               <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
       <td  class="normal">
         <?php echo $A?>
      </td>
       <td  class="normal"><span class="style7"><?php echo $myrow['razonSocial'];?>
	 
	   </span></td>
       <td  class="normal"><div align="left"><span class="style7"> <a href="#" onClick="ventanaSecundaria1('<?php echo $ventana1;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;id_proveedor2=<?php echo $A?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"> <img src="../imagenes/edit.jpg" alt="Editar a: <?php echo $myrow['razonSocial'];?>" width="12" height="12" border="0" /> </a> 
		
		</span></div></td>
       <td  class="normal"><span class="normal">


	   <?php if($myrow['status']=='A'){ ?>

<a href="catalogoProveedores.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;id_proveedor=<?php echo $A; ?>&amp;almacen=<?php echo $A; ?>">
         
         <img src="../imagenes/surtido.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
         <?php } else { ?>
         <a href="catalogoProveedores.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;id_proveedor=<?php echo $A?>"> <img src="../imagenes/candado.png" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
         <?php } ?>
       </span></div></td>
     </tr>
     <?php }?>
   </table>
   <img src="../imagenes/bordestablas/borde2.png" width="560" height="24" />
   <p align="center">
     <label>
     <input name="Submit" type="button" class="normal" value="Agregar Nuevo Proveedor" onClick="ventanaSecundaria1('<?php echo $ventana1;?>?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" />
     </label>
   </p>
 </form>
 <?php if($a>0){ ?>
 <p align="center" class="normal"><em>Se encontraron  <?php echo $a;?>  registros... </em></p>
 <?php } ?>
</body>
</html>