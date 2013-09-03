<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>


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
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];


for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]  AND $alma and $existencias[$i]>0){

 $sSQL52="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$coder[$i]."' and almacen='".$_POST['almacenDestino1']."'
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);

if($myrow52['codigo']){
$leyenda= 'Se actualizó el registro';
  $q = "UPDATE existencias set 

fechaA='".$hoy."', 
hora='".$hora."', 
existencia='".$existencias[$i]."',
razon='".$razon[$i]."'
WHERE 
entidad='".$entidad."' AND
codigo='".$coder[$i]."' 
AND 
almacen = '".$_POST['almacenDestino1']."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="Se actualizaron existencias";
} else {//insertar
//echo 'Se insertó en existencias un nuevo registro';
 $agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,almacenPrincipal
) values (
'".$coder[$i]."' ,
'".$alma."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['almacenDestino1']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



}//innsertalo



}

}

}





?>

















<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['delete'] and $_POST['codigo']){
$codigo=$_POST['codigo'];



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($codigo[$i]){

  $q = "DELETE FROM existencias WHERE 
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();

   $q = "DELETE FROM articulosPrecioNivel WHERE 
codigo='".$codigo[$i]."'  
and
almacen='".$_POST['almacenDestino']."'
";

mysql_db_query($basedatos,$q);
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














<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar2']){
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$descripcion=$_POST['descripcion'];
$cBarra=$_POST['cBarra'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($keyPA[$i]!=NULL){
  $q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',
cbarra='".$cBarra[$i]."',
fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}
echo '<blink>'.'Se actualizaron datos'.'</blink>';
}?>



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
Ajuste a existencias <br />
<?php echo $leyenda; ?>&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="683" border="0" align="center">
    <tr>
      <th width="146" bgcolor="#FFFF00" scope="col"><div align="left" class="normalmid">
        <div align="right" ><span class="negromid">Datos Articulo </span></div>
      </div></th>
      <th width="373" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style12">
          <input name="porArticulo" type="text" class="camposmid" id="porArticulo" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>"
		  />
      </span></div></th>
    </tr>
    <tr class="style7">
      <th scope="col"><div align="right" class="normalmid">Almac&eacute;n</div></th>
      <th scope="col"> <div align="left">
          <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenStock($entidad,'style7',$almacenSolicitante,$almacenDestino,$basedatos);
?>
      </div></th>
    </tr>
    <tr>
      <th height="41" scope="col">&nbsp;</th>
      <th scope="col"><label>
          <div align="left">
            <input name="buscar" type="image" src="../../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
            <?php
	  if($_POST['porArticulo']=='*'){ echo "Este proceso puede demorar varios minutos..";}?>
          </div>
        </label></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="718" border="0" cellspacing="0" cellpadding="0" align="center" class="normalmid">
    <tr>
      <td colspan="7"><img src="../../imagenes/bordestablas/borde1.png" width="900" height="21" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="53" class="negromid">Clave</td>
      <td width="272" class="negromid">Descripcion</td>
      <td width="215" class="negromid">CBarra</td>
      <td width="215" class="negromid">Grupo Prod </td>
      <td width="215" class="negromid">Existencias</td>
      <td width="215" class="negromid">Editar</td>
    </tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['porArticulo']){

if($_POST['porArticulo']!='*'){

$sSQL1= "SELECT 
articulos.keyPA,articulos.codigo,articulos.gpoProducto,existencias.almacen,articulos.descripcion,articulos.cbarra,existencias.existencia
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
order by articulos.descripcion ASC
";
} else {
 $sSQL1= "SELECT 
articulos.keyPA,articulos.codigo,articulos.gpoProducto,existencias.almacen,articulos.descripcion,articulos.cbarra,existencias.existencia
FROM

`articulos`,existencias
WHERE
articulos.entidad='".$entidad."' AND
articulos.codigo=existencias.codigo
and 
existencias.almacen='".$_POST['almacenDestino']."'

group by existencias.codigo
order by articulos.descripcion ASC
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
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><span class="codigosmid"><?php echo $myrow1['keyPA']; ?>
          <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td class="normalmid"><input name="keyPA[]" type="hidden" id="keyPA[]" value="<?php echo $myrow1['keyPA']; ?>" />
      <textarea name="descripcion[]" cols="40" rows="1" wrap="physical" class="normalmid" id="descripcion[]"><?php 

		echo ltrim($myrow1['descripcion']);

		?>
        </textarea></td>
      <td class="normal"><span class="style12">
        <input name="cBarra[]" type="text" class="normalmid" id="cBarra[]" 
      value="<?php if($myrow1['cbarra']){ echo ltrim($myrow1['cbarra']);} ?>" size="15" />
      </span></td>
      <td class="normal"><?php //*********gpoProductos
	 
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="gpoProducto[]" class="normalmid" id="gpoProducto[]">
          <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
          <option 
		   <?php if($myrow7['codigoGP']==$myrow1['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
          <?php } 
		
		?>
        </select></td>
      <td class="normal"><span class="normalmid">
        <input name="existencias[]" type="text" class="camposmid" id="existencias[]" value="
<?php 
	  if($myrow1['existencia']){
	  echo $myrow1['existencia'];
	  } else {
	  echo "0";
	  }
	 
		?>" size="10" onKeyPress="return checkIt(event)"/>
      </span></td>
      <td class="normal"><input name="codigo[]" type="checkbox" id="codigo[]" value="<?php echo $myrow1['codigo'];?>" /></td>
    </tr>
    <?php  }}?>
    <tr>
      <td colspan="7"><img src="../../imagenes/bordestablas/borde2.png" width="900" height="20" /></td>
    </tr>
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
    <input class="normalmid" name="actualizar2" type="submit" src="/sima/imagenes/btns/refresh.png"  id="actualizar2" value="Actualizar Articulos" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?>  />
    
    <input class="normalmid" name="actualizar" type="submit" src="../../imagenes/btns/refresh.png" id="actualizar" 
    value="Ajustar Existencias" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    <input class="normalmid" name="delete" type="submit" id="delete" value="Quitar de este almacen" <?php if($a<1){	echo 'disabled="disabled"';
	}
	?> />
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>
</body>
</html>