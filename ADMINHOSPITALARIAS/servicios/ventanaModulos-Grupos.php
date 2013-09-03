<?php require('/configuracion/ventanasEmergentes.php');?>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>


<?php



if($_POST['actualizar'] AND $_POST['clasificacion'] and $_GET['codigosGP']){



 $sSQL1= "Select * From gpoProductos WHERE codigoGP = '".$_POST['codigoGP']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if($myrow1['codigoGP'] and $myrow1['entidad']!=$entidad){ ?>
<script>
window.alert("El codigo de grupo que estas cargando: <?php echo $_POST['codigoGP'];?> ya existe en la entidad: <?php echo $myrow1['entidad'];?>, escoje otro codigo, gracias!");
//window.close();
</script>
<?php 
}





 $sSQL1= "Select * From modulosGrupos WHERE entidad='".$entidad."' and gpoProducto = '".$_GET['codigosGP']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['gpoProducto']){
 $agrega = "INSERT INTO modulosGrupos (
gpoProducto,clasificacion,entidad
) values ('".$_GET['codigosGP']."','".$_POST['clasificacion']."', '".$entidad."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

?>
<script >
  <!--
window.opener.document.forms["form1"].submit();
window.alert( "SE AGREGO EL GRUPO DE PRODUCTO!");
//    window.close();
  // -->
</script>

<?php 
} else {
  $q = "UPDATE modulosGrupos set 
clasificacion='".$_POST['clasificacion']."'

WHERE 
entidad='".$entidad."'
and
gpoProducto='".$_GET['codigosGP']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();

?>
<script>
  <!--
window.opener.document.forms["form1"].submit();
window.alert( "SE ACTUALIZO EL GRUPO DE PRODUCTO!");
//window.close();
  // -->
</script>
<?php 
}
}









if($_POST['borrar']){

  $q = "DELETE FROM modulosGrupos 
WHERE 
entidad='".$entidad."'
and
gpoProducto='".$_GET['codigosGP']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
?>
<script>
window.alert("Se elimino el grupo: <?php echo $_GET['codigosGP'];?> con la relacion de el modulo");
</script>

<?php }




?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.style12 {font-size: 10px}
-->
</style>
</head>

<body>
<h2 align="center">CATALOGO DE MODULOS GRUPOS </h2>
<form id="form1" name="form1" method="post" action="">
  <table width="512" border="0" align="center">
    <tr>
      <th colspan="2" class="style12" scope="col"><div align="center">C&oacute;digo GP : <?php echo $_GET['codigosGP'];?></div>
        <label></label> 
        <div align="left"></div></th>
    </tr>
    <tr>
      <td width="103" class="style12">Patentes</td>
      <td width="231" class="style12"><label>


 <?php 
$sSQL2a= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'PAT' ";
$result2a=mysql_db_query($basedatos,$sSQL2a);
$myrow2a = mysql_fetch_array($result2a);

	  if($myrow2a['clasificacion']){ ?>
	  --- <?php echo $myrow2a['clasificacion'];?>
	  <?php }else{ ?>
        <input name="clasificacion" type="radio" value="PAT"  />
<?php } ?>
      </label></td>
    </tr>
    <tr>
      <td class="style12">Genericos</td>
      <td class="style12">
	  
	  <?php 
$sSQL2b= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'GEN' ";
$result2b=mysql_db_query($basedatos,$sSQL2b);
$myrow2b = mysql_fetch_array($result2b);

	  if($myrow2b['clasificacion']){ ?>
	  --- <?php echo $myrow2b['clasificacion'];?>
	  <?php }else{ ?>
          <input name="clasificacion" type="radio" value="GEN" >
		  <?php } ?> </td>
    </tr>
    <tr>
      <td class="style12">Materiales</td>
      <td class="style12">
	  
	  	  <?php 
		  $sSQL2c= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'MAT' ";
$result2c=mysql_db_query($basedatos,$sSQL2c);
$myrow2c = mysql_fetch_array($result2c);

		  if($myrow2c['clasificacion']){ ?>
	  --- <?php echo $myrow2c['clasificacion'];?>
	  <?php }else{ ?>
          <input name="clasificacion" type="radio" value="MAT" />
     <?php } ?></td>
    </tr>
    <tr>
      <td class="style12">Honorarios Medicos </td>
      <td class="style12">
	  
	  
	  	  	  <?php
			  $sSQL2d= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'HONMED' ";
$result2d=mysql_db_query($basedatos,$sSQL2d);
$myrow2d = mysql_fetch_array($result2d);

			   if($myrow2d['clasificacion']){ ?>
	  --- <?php echo $myrow2d['clasificacion'];?>
	  <?php }else{ ?>
          <input name="clasificacion" type="radio" value="HONMED"  />
		  <?php } ?>            </td>
    </tr>
    <tr>
      <td class="style12">Interpretacion Honorarios Medicos </td>
      <td class="style12">
	  
	  
	  	  	  <?php
			  
			  $sSQL2e= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'sIVA' ";
$result2e=mysql_db_query($basedatos,$sSQL2e);
$myrow2e = mysql_fetch_array($result2e);

			   if($myrow2e['clasificacion']){ ?>
	  --- <?php echo $myrow2e['clasificacion'];?>
	  <?php }else{ ?>
          <input name="clasificacion" type="radio" value="sIVA" />
		  <?php } ?>   </td>
    </tr>
    <tr>
      <td class="style12">Servicios c/IVA </td>
      <td class="style12">
	  
	  
	  	  	  <?php
			  
			  $sSQL2f= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'cIVA' ";
$result2f=mysql_db_query($basedatos,$sSQL2f);
$myrow2f = mysql_fetch_array($result2f);

			   if($myrow2f['clasificacion']){ ?>
	  --- <?php echo $myrow2f['clasificacion'];?>
	  <?php }else{ ?>
          <input name="clasificacion" type="radio" value="cIVA" />
		  <?php } ?>      </td>
    </tr>
    <tr>
      <td class="style12">Medicamentos Controlados </td>
      <td class="style12">
          
		  	  	  <?php 
				  
				  $sSQL2g= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion = 'MEDC' ";
$result2g=mysql_db_query($basedatos,$sSQL2g);
$myrow2g = mysql_fetch_array($result2g);

				  if($myrow2g['clasificacion']){ ?>
	  --- <?php echo $myrow2g['clasificacion'];?>
	  <?php }else{ ?>
		  <input name="clasificacion" type="radio" value="MEDC"  />
		  <?php } ?>              </td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
	
	
	

    <tr>
      <td class="style12"><label></label></td>
    </tr>

    <tr>
      <td colspan="2" class="style12"><div align="left" class="style12">
        <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" /> 
        <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar " /> 
        <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar" />
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
