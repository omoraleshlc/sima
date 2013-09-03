<?PHP require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php"); ?>


<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>







<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['delete'] and $_POST['codigo']){
$codigo=$_POST['codigo'];



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($codigo[$i]){

  $q = "DELETE FROM existencias WHERE 
entidad='".$entidad."'
and
codigo='".$codigo[$i]."' 

 ";

mysql_db_query($basedatos,$q);
echo mysql_error();

   $q1 = "DELETE FROM articulosPrecioNivel WHERE 
   entidad='".$entidad."'
and
codigo='".$codigo[$i]."'  

";

mysql_db_query($basedatos,$q1);
echo mysql_error();


   $q3 = "DELETE FROM existencias WHERE 
   entidad='".$entidad."'
and
codigo='".$codigo[$i]."'  

";

mysql_db_query($basedatos,$q3);
echo mysql_error();


   $q4 = "DELETE FROM convenios WHERE 
   entidad='".$entidad."'
and
codigo='".$codigo[$i]."'  

";

mysql_db_query($basedatos,$q4);
echo mysql_error();


}

}
?>
<script>
window.alert("Se quitaron articulos de este almacen");
</script>
<?php
}





?>

















<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" class="titulos"><br /> 
Eliminar Articulos
<br />
<?php echo '<span class="informativo">'.'Esto es para desaparecer de todo el sistema ese articulo/procedimiento'.'</span>';?>

<?php echo $leyenda; ?>&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="583" class="table-forma">
    <tr>
      <td width="146"  scope="col"><div align="left" >
        <div align="right" ><span >Datos Articulo </span></div>
      </div></td>
      <td width="373"  scope="col"><div align="left"><span >
          <input name="porArticulo" type="text"  id="porArticulo" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>"
		  />
      </span></div></td>
    </tr>
    <tr >
      <td scope="col"><div align="right" >Almac&eacute;n</div></td>
      <td scope="col"> <div align="left">
          <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacen($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
      </div></td>
    </tr>
    <tr>
      <td height="41" scope="col">&nbsp;</td>
      <td scope="col"><label>
          <div align="left">
            <input name="buscar" type="submit"  id="buscar" value="buscar" />
            <?php
	  if($_POST['porArticulo']=='*'){ echo "Este proceso puede demorar varios minutos..";}?>
          </div>
        </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="718" class="table table-striped">

    <tr >
      <th width="42" >Clave</th>
      <th width="396" >Descripcion</th>
      <th width="157" >CBarra</th>
      <th width="155" >Grupo Prod </th>
      <th width="87" >Status</th>
      <th width="87" >Existencias</th>
      <th width="64" >Eliminar</th>
    </tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['porArticulo']){

if($_POST['porArticulo']!='*'){

$sSQL1= "SELECT 
articulos.keyPA,articulos.codigo,articulos.gpoProducto,existencias.almacen,articulos.descripcion,articulos.cbarra,existencias.existencia,articulos.activo
FROM 

`articulos`,existencias
WHERE
articulos.entidad='".$entidad."' AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%')
and
articulos.codigo=existencias.codigo
and

existencias.almacen='".$_POST['almacenDestino']."'

group by existencias.codigo
order by articulos.descripcion,articulos.activo ASC
";
} else {
 $sSQL1= "SELECT 
articulos.keyPA,articulos.codigo,articulos.gpoProducto,existencias.almacen,articulos.descripcion,articulos.cbarra,existencias.existencia,articulos.activo
FROM

`articulos`,existencias
WHERE
articulos.entidad='".$entidad."' AND
articulos.codigo=existencias.codigo
and 
existencias.almacen='".$_POST['almacenDestino']."'

group by existencias.codigo
order by articulos.descripcion,articulos.activo ASC
";

}

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr >
      <td height="48" ><span ><?php echo $myrow1['keyPA']; ?>
          <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td ><input name="keyPA[]" type="hidden" id="keyPA[]" value="<?php echo $myrow1['keyPA']; ?>" />
    <?php 

		echo ltrim($myrow1['descripcion']);

		?></td>
      <td ><span >
        <?php if($myrow1['cbarra']){ echo ltrim($myrow1['cbarra']);} ?>
      </span></td>
      <td ><?php //*********gpoProductos
	 
 $sSQL7= "Select  * From gpoProductos where entidad='".$entidad."' AND codigoGP='".$myrow1['gpoProducto']."' ";
$result7=mysql_db_query($basedatos,$sSQL7); 
$myrow7 = mysql_fetch_array($result7);
echo mysql_error();
	  ?>
<?php echo $myrow7['descripcionGP']; ?>    </td>
	
	
	
      <td ><?php 
	
	  echo $myrow1['activo'];

	 
		?></td>
      <td ><span >
        
<?php 
	
	  echo $myrow1['existencia'];

	 
		?>
		
      </span></td>
      <td ><input name="codigo[]" type="checkbox" id="codigo[]" value="<?php echo $myrow1['codigo'];?>"  <?php if($myrow1['activo']=='I'){ echo 'checked=""'; } ?>/></td>
    </tr>
    <?php  }}?>

  </table>
  <p align="center">&nbsp;</p>
  <div align="center" class="informativo"><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>"  />
    <input  name="delete" type="submit" id="delete" value="Eliminar" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>
</body>
</html>