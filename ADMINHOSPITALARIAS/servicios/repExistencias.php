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
echo 'Se actualizó el registro';
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
echo 'Se insertó en existencias un nuevo registro';
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
Reporte de existencias <br />
<?php echo $leyenda; ?>&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="529" border="0" align="center">
    <tr>
      <th width="146" bgcolor="#FFCCFF" scope="col"><div align="left" class="normalmid">
        <div align="right" >B&uacute;squeda Normal</span></div>
      </div></th>
      <th width="373" bgcolor="#FFCCFF" scope="col"><div align="left"><span class="style12">
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
  <table width="563" border="0" align="center">
    <tr>
      <th width="54" bgcolor="#660066" scope="col"><div align="left" class="blancomid">keyPA</div></th>
      <th width="344" bgcolor="#660066" scope="col"><div align="left" class="blancomid">Descripci&oacute;n</div></th>
      <th width="81" bgcolor="#660066" scope="col"><div align="left" class="blancomid">Existencias</div></th>
      <th width="66" bgcolor="#660066" scope="col"><div align="left" class="blancomid">Anaquel</div></th>
    </tr>
    <tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['porArticulo']){

if($_POST['porArticulo']!='*'){

$sSQL1= "SELECT 
* 
FROM 

`articulos`,existencias
WHERE
articulos.entidad='".$entidad."' AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%')
and
articulos.codigo=existencias.codigo
and articulos.activo='A'
and
(articulos.um<>'s' or articulos.um<>'S')
and
existencias.almacen='".$_POST['almacenDestino1']."'
group by existencias.codigo
";
} else {
 $sSQL1= "SELECT 
* 
FROM

`articulos`,existencias
WHERE
articulos.entidad='".$entidad."' AND
articulos.codigo=existencias.codigo
and articulos.activo='A'
and
(articulos.um<>'s' or articulos.um<>'S')
and
existencias.almacen='".$_POST['almacenDestino']."'
group by existencias.codigo
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
      <td bgcolor="<?php echo $color?>" class="codigosmid">
        <label><?php echo $myrow1['keyPA']; ?>
        <input name="codigoAlfa[]" type="hidden" id="codigoAlfa[]" value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </label></td>
      <td bgcolor="<?php echo $color?>" class="normalmid"><?php echo $myrow1['descripcion']; ?></td>
      <td bgcolor="<?php echo $color?>" class="style12">
 
      
<?php 
	  if($myrow1['existencia']){
	  echo $myrow1['existencia'];
	  } else {
	  echo "0";
	  }
	 
		?>
      </span></td>
      <td bgcolor="<?php echo $color?>" class="normal" align="center"><?php
	   if($myrow1['anaquel']){
	   echo $myrow1['anaquel']; 
	   } else {
	   echo "Sin Anaquel";
	   }
	   ?></span></td>
    </tr>
    <?php  }} //cierra while ?>
  </table>
  <div align="center" class="informativo"><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>" />
    
 
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>
</body>
</html>