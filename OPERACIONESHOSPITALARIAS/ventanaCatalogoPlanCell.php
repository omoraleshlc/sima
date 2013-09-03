<?php require("/configuracion/ventanasEmergentes.php"); ?>


<?php  
if($_GET['keyOS']>0){


$q = "DELETE FROM catTipoPlanCell
		
		WHERE keycatTipoPlanCell='".$_GET['keycatTipoPlanCell']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}
?>


<?php 









if($_POST['actualizar'] AND $_POST['descripcion']!=NULL ){ 




$agrega = "INSERT INTO catTipoPlanCell (
descripcion
) values (
'".$_POST['descripcion']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

  echo '<script>

window.alert("Alta existosa!");
window.close();
  </script>';  



 }












?>











<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>

<body>
<p align="center">
  <label>&nbsp;</label>
</p>

<form name="form1" method="post" >
  <table width="400" class="table-forma">
     <tr  >
      <th colspan="2"><p align="center">Catalogo de Software</p></th>
 
    </tr>
    <tr>
      <td colspan="2" scope="col"><?php echo '<blink>'.$leyenda.'</blink>';?></td>
    </tr>
      
      
      

      
      
    <tr>
      <td width="152" scope="col"><div align="left">Descripcion</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="descripcion" type="text" size="60" id="nombre" value="<?php echo $myrow1['descripcion']; ?>"/>
        </div></td>
    </tr>
    

    
   
    
        <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    
    
    
  </table>
  <p align="center">
   
    <input name="actualizar" type="submit"  id="actualizar" value="Guardar/Modificar" />
    <label>
    <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />
    </label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>


<table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
 
    <tr bgcolor="#FFFF00">
        <td width="10" class="negromid">#</td>
        <td width="80" class="negromid">Descripcion</td>
      
<td width="10" class="negromid"></td>
    </tr>
<?php	



$sSQL= "SELECT *
FROM
catTipoPlanCell

order by descripcion ASC
 ";




if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$r+=1;


	  ?>
    
    
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" > 
  <td  class="codigos"><?php echo $r;?></td>    
   <td  class="codigos">
       <?php 
            echo $myrow['descripcion'];
       ?>
   </td>     
      <td><a href="ventanaCatalogoSoftware.php?keycatTipoPlanCell=<?php echo $myrow['keycatTipoPlanCell'];?>&warehouse=<?php echo $_GET['warehouse'];?>&gpoProductos=<?php echo $_GET['gpoProductos'];?>&codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;keyPA=<?php echo $myrow['keyPA'];?>"> 
          X
          </a></td>
      
      
      
      
      
      
    </tr><?php  }}?>

  </table>



</body>
</html>
