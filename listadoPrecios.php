<?PHP include("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <link rel="stylesheet" type="text/css" href="template/css/style.css" />
<style type="text/css">
<!--
.style1 {color: #000000}
.titulos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
}
#form1 table {
	font-family: Arial, Helvetica, sans-serif;
}
#form1 table {
	font-size: 12px;
}
-->
</style>
</head>

<h1 align="center" class="titulos">Listado de Materiales</h1>
<h1 align="center" class="titulos">Almacen: BOTQX</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="716" border="0" align="center">
    <tr>
     
      <th width="507" bgcolor="#FFFFFF" scope="col"><div align="left" class="blancomid style1">Descripci&oacute;n</div></th>
      
      <th width="108" bgcolor="#FFFFFF" scope="col"><div align="center">Precio Part. </div></th>
      <th width="108" bgcolor="#FFFFFF" scope="col"><div align="center">Precio Aseg. </div></th>
    </tr>
    <tr>
<?php	
$ivaGrupo=new articulosDetalles();


$sSQL1= "SELECT 
* 
FROM 
existencias, articulos
where
articulos.keyPA=existencias.keyPA
and
articulos.codigo=existencias.codigo
and
articulos.descripcion!=''
and
articulos.gpoProducto='MAT'
and
(existencias.almacen='HBOTQX')
order by existencias.almacen,articulos.descripcion ASC

";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$codigo+=1;
$a+=1;


 $sSQL3a="SELECT *
FROM
articulosPrecioNivel
WHERE keyPA='".$myrow1['keyPA']."'

  ";
  $result3a=mysql_db_query($basedatos,$sSQL3a);
  $myrow3a = mysql_fetch_array($result3a);

 $sSQL3ab="SELECT *
FROM
almacenes
WHERE almacen='".$myrow1['almacen']."'

  ";
  $result3ab=mysql_db_query($basedatos,$sSQL3ab);
  $myrow3ab = mysql_fetch_array($result3ab);
  
   $sSQL3ac="SELECT *
FROM
gpoProductos
WHERE codigoGP='".$myrow1['gpoProducto']."'

  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);
  
  
  $ivaP=$ivaGrupo-> ivaGPO($entidad,"1",$myrow1['gpoProducto'],$myrow3a['nivel1'],$basedatos);
    $ivaA=$ivaGrupo-> ivaGPO($entidad,"1",$myrow1['gpoProducto'],$myrow3a['nivel3'],$basedatos);
?>
            <td height="26" bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow1['descripcion']; ?></td>
      
      
     <td bgcolor="<?php echo $color?>" class="normalmid" align="right"><?php echo '$'.number_format( $myrow3a['nivel1']+$ivaP,2); ?></td>       
      <td bgcolor="<?php echo $color?>" class="normalmid" align="right"><?php echo '$'.number_format( $myrow3a['nivel3']+$ivaP,2); ?></td>
    
    </tr>
    <?php  } //cierra while ?>
  </table>
  <div align="center" class="informativo"><strong>
   
	<?php if($codigo>0){
	echo "Se encontraron $codigo registros..!"; 
	}
	?>
	</strong></div>

</form>
</body>
</html>