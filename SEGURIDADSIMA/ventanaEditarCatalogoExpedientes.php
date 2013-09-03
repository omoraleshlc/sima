<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 




<?php





if($_POST['actualizar'] and $_POST['descripcion']){




//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

$sSQL3= "Select * From catalogoexpedientes WHERE   klista='".$_GET['klista']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



if(!$myrow3['descripcion'] ){

$agrega = "INSERT INTO catalogoexpedientes (
descripcion,usuario
) values (
'".$_POST['descripcion']."',
'".$usuario."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




 //cierra validacion
//*********************************************

echo '<script>
window.alert( "REPORTE AGREGADO ");
   window.opener.document.forms["form2"].submit();
    self.close();
</script>';

} else {



$q = "UPDATE catalogoexpedientes set 
descripcion='".$_POST['descripcion']."',usuario='".$usuario."'

WHERE 
klista='".$_GET['klista']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script language="JavaScript" type="text/javascript">
  <!--
  window.alert( "REPORTE ACTUALIZADO ");
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}


}








if($_POST['borrar'] AND $_POST['almacen']){




$borrame = "DELETE FROM catalogoexpedientes WHERE klista='".$_POST['klista']."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();


echo '<script language="JavaScript" type="text/javascript">
  <!--
  window.alert( "REPORTE ACTUALIZADO ");
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}


if($_GET['klista']!=NULL){
$sSQL3= "Select * From catalogoexpedientes WHERE   klista='".$_GET['klista']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form2" name="form2" method="post" action="" >
   <p>
     <label></label></p>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
   <div align="center">
     <p>La descripcion del reporte</p>
     <p>&nbsp;</p>
   </div>

   <table width="442" border="1" align="center">
     <tr>
       <td width="144" bgcolor="#99CCFF" class="negro">Descripci&oacute;n </td>
       <td width="360" class="style12"><textarea name="descripcion" cols="30" wrap="virtual" class="campos" id="descripcion"><?php echo $myrow3['descripcion']?></textarea></td>
     </tr>
  </table>
   <p>&nbsp;</p>
   <table width="320" align="center">
     <tr>
       <td width="156" align="center"><span class="style12"><span class="Estilo24">
         <input name="actualizar" type="submit" src="../../imagenes/btns/modialma.png"  id="actualizar" value="Agregar/Modificar Reporte" />
       </span></span></td>

     </tr>
   </table>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>
</form>
</body>
</html>
