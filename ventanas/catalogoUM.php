<?PHP require("/configuracion/ventanasEmergentes.php");  ?>

<?php

if($_POST['borrar'] AND $_POST['keyUM1']){
$borrame = "DELETE FROM unidadesMedida WHERE keyUM='".$_GET['keyUM']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO LA UNIDAD DE MEDIDA..");
</script>';
}
if($_POST['nuevo']){
$_POST['anaquel'] = "";
$_POST['codigoRazon'] ="";
}










if($_POST['actualizar'] AND $_POST['descripcionUM'] and $_POST['codigoUM']){
$sSQL1= "Select * From unidadMedida WHERE entidad='".$entidad."' and  codigoUM = '".$_POST['codigoUM']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);





if(!$myrow1['descripcionUM']){

$agrega = "INSERT INTO unidadMedida (
codigoUM,descripcionUM,entidad
) values ('".$_POST['codigoUM']."','".$_POST['descripcionUM']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script >
window.alert( "SE AGREGO EL ANAQUEL..");
</script>';


} else {
 $q = "UPDATE unidadMedida set 
     codigoUM='".$_POST['codigoUM']."',
descripcionUM= '".$_POST['descripcionUM']."'

WHERE 
entidad='".$entidad."'
    and
codigoUM= '".$_POST['codigoUM']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script >
window.alert( "SE ACTUALIZO LA UNIDAD DE MEDIDA..");
</script>';
}
}
?>






<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>

</head>

<body>
	
	<?php 
if(!$_POST['nuevo'] and $_GET['edit']=='si' and $_GET['keyUM']!=NULL){
	$sSQL= "SELECT 
*
FROM
  `unidadMedida`
  
 WHERE keyUM='".$_GET['keyUM']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$_GET['edit']=NULL;
}
	
	

	?>
<h1 align="center" >&nbsp;</h1>
<form id="form1" name="form1" method="post" >

  <table width="648"  class="table-forma">

               <tr>
        <th align="center" ><p align="center">Unidades de Medida</p></th>
    </tr>
    <tr>
      <input name="keyUM1" type="hidden"  id="buscar" value="<?php echo $_GET['keyUM'];?>" />
    </tr>
    <tr>
        
        
              <td  ><span >Codigo UM</span></td>
      <td colspan="2" ><input name="codigoUM" size="10" type="text"  id="anaquel" value="<?php 
	  if(!$_POST['borrar'] and !$_POST['nuevo']){
	  if($myrow['codigoUM']){
	  echo $myrow['codigoUM']; 
	  } else {
	  echo $_POST['codigoUM'];
	  }}else{
	  echo "";
	  }
	  ?>" />        <a href="catalogoUM.php"></a></td>
    </tr>

      
      <tr>
      <td  ><span >Descripcion</span></td>
      <td colspan="2" ><input name="descripcionUM" size="60" type="text"  id="anaquel" value="<?php 
	  if(!$_POST['borrar'] and !$_POST['nuevo']){
	  if($myrow['descripcionUM']){
	  echo $myrow['descripcionUM']; 
	  } else {
	  echo $_POST['descripcionUM'];
	  }}else{
	  echo "";
	  }
	  ?>" />        <a href="catalogoUM.php"></a></td>
    </tr>
    
    <tr>
      <td height="14" colspan="3" ><div align="left">
        <p>&nbsp;          </p>
          <p align="center">
            <input name="actualizar" type="submit"  id="actualizar" value="Grabar/Actualizar" />
            <input name="buscar" type="submit"  id="buscar" value="Buscar" />
            <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
            <input name="borrar" type="submit"  id="borrar" value="Eliminar" />
            </p>
      </div></td>
    </tr>
    <tr >
      <td height="14" colspan="4">&nbsp;</td>
    </tr>
  </table>

<p>&nbsp;</p>
</form>








<form id="form2" name="form2" method="post" >
  <input name="almacen" type="hidden" id="almacen" value="<?php echo $_POST['almacen']; ?>" />

  <table width="360" class="table table-striped">
    <tr>
      <th width="4" ><span >#</span></th>
      <th width="100" ><span >Descripcion</span></th>
      <th width="42" ><span >CodigoUM</span></th>
    </tr>
    <tr>
      <?php	
if(!$_POST['almacenDestino']){
    $_POST['almacenDestino']=$_GET['almacen'];
}	  


//	codigoUMdescripcionUMpiezasusuariofechahoraentidadservicio

$sSQL1= "Select * From unidadMedida WHERE entidad='".$entidad."' order by descripcionUM ASC";
$result1=mysql_db_query($basedatos,$sSQL1); 
echo mysql_error();
 

while($myrow1 = mysql_fetch_array($result1)){ $a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow1['anaquel'];
$tipoAnaquel=$myrow1['tipoAnaquel'];
$sSQL12= "SELECT 
 *
FROM
  tipoAnaqueles
  WHERE 
  codigoAnaquel='".$tipoAnaquel."'
  ";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>
      <td ><span >
        <label>
        <?php 
	  
	  echo $a;
	  
	  ?>
        </label>
      </span></td>
      <td  ><span >
      
      <a href="catalogoUM.php?keyUM=<?php echo $myrow1['keyUM'];?>&edit=si&almacen=<?php echo $_POST['almacenDestino'];?>&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">
      <?php 
	  if($myrow1['descripcionUM']){
	  echo $myrow1['descripcionUM'];
	  } else {
	  echo "---";
	  }
	  ?>
      </a>
          </span></td>
      <td  ><span >
        <label></label>
      <?php 
	  
	  echo $myrow1['codigoUM'];
	  
	  ?>
          </span></td>
    </tr>
    <?php }?>
  </table>

</form>
<p align="center">&nbsp;</p>
</body>
</html>