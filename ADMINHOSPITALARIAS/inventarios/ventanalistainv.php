<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 




<?php





if($_POST['actualizar'] and $_POST['descripcion']){




//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

$sSQL3= "Select * From listas WHERE   keylistas='".$_GET['keylistas']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



if(!$myrow3['descripcion'] ){

$agrega = "INSERT INTO listas (
descripcion,usuario,fecha,entidad,status
) values (
'".$_POST['descripcion']."',
'".$usuario."',
    '".$fecha1."',
'".$entidad."',
    'open'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




 //cierra validacion
//*********************************************

echo '<script>
window.alert( "LISTA AGREGADA");
   window.opener.document.forms["form2"].submit();
    self.close();
</script>';

} else {



$q = "UPDATE listas set 
descripcion='".$_POST['descripcion']."', 
usuario='".$usuario."'
WHERE 
keylistas='".$_GET['keylistas']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script language="JavaScript" type="text/javascript">
  <!--
  window.alert( "LISTA ACTUALIZADA ");
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}


}








//if($_POST['borrar'] AND $_POST['almacen']){
//
//
//
//
//$borrame = "DELETE FROM reportesAutomaticos WHERE keylista='".$_POST['keylista']."' ";
//mysql_db_query($basedatos,$borrame);
//echo mysql_error();
//
//
//echo '<script language="JavaScript" type="text/javascript">
//  <!--
//  window.alert( "REPORTE ACTUALIZADO ");
//   window.opener.document.forms["form2"].submit();
//    self.close();
//  // -->
//</script>';
//}



$sSQL3= "Select * From listas WHERE   keylistas='".$_GET['keylistas']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
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
     <p>Crear Lista Inventarios</p>
     <p>&nbsp;</p>
   </div>

   <table width="442" border="1" align="center">
     <tr>
       <td width="144" bgcolor="#99CCFF" class="negro">Descripcion </td>
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
