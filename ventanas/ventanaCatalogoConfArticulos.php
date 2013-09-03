<?php require('/configuracion/ventanasEmergentes.php'); ?>

<?php 
if($_POST['actualizar'] and $_POST['maximos']>0 and $_POST['minimos']>0 and $_POST['reorden']>0){

$sSQL1= "Select * From inv_conf_articulos WHERE entidad='".$entidad."' AND keyPA = '".$_GET['keyPA']."'  ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['keyPA']){
    
    
    

$agrega = "INSERT INTO inv_conf_articulos (
codigo,keyPA,maximos,minimos,reorden,usuario,fecha,hora,entidad
) values ('".$_GET['codigo']."','".$_GET['keyPA']."','".$_POST['maximos']."',
    '".$_POST['minimos']."','".$_POST['reorden']."','".$usuario."','".$fecha1."','".$hora."', 
'".$entidad."'
    
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script ">
window.alert ("Agregado!");
</script>';
echo 'Agregado!';
} else {
$q = "UPDATE inv_conf_articulos set 
maximos='".$_POST['maximos']."',
minimos='".$_POST['minimos']."',reorden='".$_POST['reorden']."'
WHERE entidad='".$entidad."' AND
keyPA='".$_GET['keyPA']."' ";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script ">
window.alert( "Actualizado!");
</script>';
echo 'actualizado!';
}


echo '<script language="JavaScript" type="text/javascript">
//window.opener.document.forms["form1"].submit();
//window.close();
</script>';
}






if($_POST['borrar'] AND $_POST['codigoCuarto']){
$borrame = "DELETE FROM cuartos WHERE entidad='".$entidad."' AND codigoCuarto ='".$_POST['codigoCuarto']."'  and departamento='".$_POST['almacen']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo 'Cuarto Eliminado';
echo '<script type="text/vbscript">
msgbox "EL CUARTO FUE ELIMINADO!"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';

}





$sSQL2= "Select * From inv_conf_articulos WHERE entidad='".$entidad."' AND 

keyPA='".$_GET['keyPA']."'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);


?>




  <SCRIPT language=Javascript>
      <!--
      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
      //-->
   </SCRIPT>





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
    
    <h1>Configuracion de Articulos</h1>    
    
    <br>
        
    </br>
<form name="form2" method="post" >
    <p><?php echo $_GET['descripcion'];?></p>

  <table widtd="383" class="table-forma">
    <tr >
      <td widtd="1"  scope="col">&nbsp;</td>
    <td widtd="190"  scope="col"><div align="left">Minimos</div>
          <label></label></td>
      <td widtd="346"  scope="col"> <div align="left">
          <input name="minimos" type="text"  
		 value="<?php echo $myrow2['minimos']; ?>" size="6" maxlengtd="6" onkeypress="return isNumberKey(event)"/>
      </div></td>
    </tr>

    <tr >
      <td widtd="1"  scope="col">&nbsp;</td>
      <td >Maximos</td>
        <td widtd="346"  scope="col"> <div align="left">
          <input name="maximos" type="text"  
		 value="<?php echo $myrow2['maximos']; ?>" size="6" maxlengtd="6" onkeypress="return isNumberKey(event)"/>
      </div></td>
      
    </tr>
      
        <tr >
      <td widtd="1"  scope="col">&nbsp;</td>
      <td >Punto de Reorden</td>
        <td widtd="346"  scope="col"> <div align="left">
          <input name="reorden" type="text"  
		 value="<?php echo $myrow2['reorden']; ?>" size="6" maxlengtd="6" onkeypress="return isNumberKey(event)"/>
      </div></td>
      
    </tr>  
      
      
      
      
    <tr >
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      
      
    <td align="left" >
          </td>
    </tr>
  </table>

    <br></br>
    <div align="center"    >
<input name="actualizar" type="submit"  id="actualizar" value="Modificar/Agregar" />    
    </div>
    
</form>
<p>&nbsp;</p>
</body>
</html>
