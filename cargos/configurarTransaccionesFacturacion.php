<?php include("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>

<?php 
if($_POST['asignar'] and $_POST['keyCAP']){

$keyCAP=$_POST['keyCAP'];


//Textos completos  	keyNFac 	numFactura 	gpoProducto 	entidad 	extension 	status

for($i=0;$i<=$_POST['bandera'];$i++){





$sSQL3a= "Select * From facturaTransacciones WHERE numFactura = '".$_GET['numFactura']."' and  keyCAP='".$keyCAP[$i]."' and extension='".$_POST['extension']."'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);



if($keyCAP[$i]){

 $sqld = "INSERT INTO facturaTransacciones 
(entidad, 	numFactura ,	 keyCAP,status,extension)
values
('".$entidad."','".$_GET['numFactura']."','".$keyCAP[$i]."' ,'extensionGrupos','".$_POST['extension']."')";
mysql_db_query($basedatos,$sqld);
echo mysql_error();


}
}



echo '<span class="error"><blink>'.'Se hicieron cambios'.'</blink></span>';
}
?>






<?php
if($_POST['quitar'] and $_POST['remove']){
$keyCAP=$_POST['remove'];


for($i=0;$i<=$_POST['bandera'];$i++){


if($keyCAP[$i]){
$sqld = "DELETE FROM facturaTransacciones 
where
keyCAP='".$keyCAP[$i]."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
}
}

echo '<script>';
echo 'window.alert("Grupos desactivados");';
echo '</script>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />

<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo4 {color: #FFFFFF; font-size: 12px; }
.Estilo5 {font-size: 12px}
-->
</style>
</head>

<body>
<p align="center">

</p>
<form id="form1" name="form1" method="post" action="">
  <p align="center">Agregar Transacciones</p>
  <p align="center">Extensi&oacute;n
    <select name="extension" id="extension" onchange="this.form.submit();">
      <option
      <?php if($_POST['extension']=='0' or $_GET['extension']=='0')print 'selected="selected"';?>
       value="0">0</option>
      <option
      <?php if($_POST['extension']=='1' or $_GET['extension']=='1' )print 'selected="selected"';?>
       value="1">1</option>
      <option
      <?php if($_POST['extension']=='2'  or $_GET['extension']=='2' )print 'selected="selected"';?>
       value="2">2</option>
      <option
      <?php if($_POST['extension']=='3' or $_GET['extension']=='3')print 'selected="selected"';?>
       value="3">3</option>
      <option
      <?php if($_POST['extension']=='4' or $_GET['extension']=='4')print 'selected="selected"';?>
       value="4">4</option>
      <option
      <?php if($_POST['extension']=='5' or $_GET['extension']=='5')print 'selected="selected"';?>
       value="5">5</option>
      <option
      <?php if($_POST['extension']=='6' or $_GET['extension']=='6' )print 'selected="selected"';?>
       value="6">6</option>
      <option
      <?php if($_POST['extension']=='7' or $_GET['extension']=='7')print 'selected="selected"';?>
       value="7">7</option>
    </select>


<?php if($_POST['extension']>0){ ?>

    <a href="javascript:ventanaSecundaria5('ventanaAjustarExtensiones.php?entidad=<?php echo $entidad;?>&amp;extension=<?php echo $_POST['extension'];?>&amp;folioVenta=<?php echo $_GET['folioVenta'];?>');"></a></p>
  <table width="700" border="0" align="center" class="Estilo5">
    <tr>
      <th width="59" height="19" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="Estilo1">
          <div align="left" class="blanco">
            <div align="left">Mov</div>
          </div>
      </div></th>
      <th width="96" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="Estilo1">
        <div align="left" class="blanco">
          <div align="left">Fecha</div>
        </div>
      </div></th>
      <th width="96" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="Estilo1">
        <div align="left" class="blanco">
          <div align="left">FolioVenta</div>
        </div>
      </div></th>
      <th width="358" bgcolor="#660066" class="Estilo4" scope="col"><div align="left">
          <div align="center" class="Estilo1">
            <div align="left" class="blanco">
              <div align="left">Concepto</div>
            </div>
          </div>
      </div></th>
      <th width="62" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="Estilo1">
          <div align="left" class="blanco">
            <div align="left">Importe</div>
          </div>
      </div></th>
      <th width="56" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="blanco Estilo1 Estilo5">
        <div align="left">Agregar</div>
      </div></th>
      <th width="56" bgcolor="#660066" class="Estilo4" scope="col"><div align="center" class="blanco Estilo1 Estilo5">
          <div align="left">Quitar</div>
      </div></th>
    </tr>
    <?php	
/* 	if(!$_GET['numFactura']){
	exit();
	} */
	
	
$sSQL= " 
SELECT *
FROM
cargosCuentaPaciente
WHERE
entidad='".$entidad."' AND
numFactura='".$_GET['numFactura']."'
and
status='transaccion'
and
naturaleza='A'
and
folioVenta!=''
and
cantidadAseguradora>0
group by folioVenta
order by folioVenta ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sSQL3ad1= "Select sum(cantidadAseguradora*cantidad) as io From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."' and status='transaccion' and cantidadAseguradora>0";
$result3ad1=mysql_db_query($basedatos,$sSQL3ad1);
$myrow3ad1 = mysql_fetch_array($result3ad1);

$importe[0]+=$myrow3ad1['io'];
$sSQL3a= "Select * From facturaTransacciones WHERE numFactura = '".$_GET['numFactura']."' and  keyCAP='".$myrow['keyCAP']."' and extension='".$_POST['extension']."'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
?>
    <tr>
      <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
      <td height="21" bgcolor="<?php echo $color;?>" class="normal"><?php echo $myrow['keyCAP']; ?></td>
      <td bgcolor="<?php echo $color;?>" class="abonos"><span class="normal"><?php echo cambia_a_normal($myrow['fecha1']); ?></span></td>
      <td bgcolor="<?php echo $color;?>" class="abonos"><span class="normal"><?php echo $myrow['folioVenta']; ?></span></td>
      <td bgcolor="<?php echo $color;?>" class="abonos"><span class="normal"><?php echo $myrow['descripcionArticulo'];?></span></td>
      <td bgcolor="<?php echo $color;?>" class="abonos"><span class="normal"><?php echo '$'.number_format($myrow3ad1['io'],2); ?></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center">
        <label>
		
		<?php if(!$myrow3a['keyCAP']){ ?>
        <input name="keyCAP[]" type="checkbox" id="keyCAP[]" value="<?php echo $myrow['keyCAP'];?>" />
		<?php }else{ ?>
		---
		<?php } ?>
        </label>
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center">
          <label>
		  
		  		<?php if($myrow3a['keyCAP']){ ?>
          <input name="remove[]" type="checkbox" id="remove[]" value="<?php echo $myrow['keyCAP'];?>" />
		  		<?php }else{ ?>
		---
		<?php } ?>
          </label>
      </div></td>
    </tr>
    <?php }
	
	  ?>
  </table>
  
  
  
  <?php if($bandera>0){ ?>
  Total: <?php echo '$'.number_format($importe[0],2);?>
  <p align="center">
    <input type="submit" name="asignar" id="asignar" value="Asignar a Extension"/>
    <input type="submit" name="quitar" id="quitar" value="Quitar Extension" />
</p>
  <p align="center" class="Estilo5">Se encontraron <?php echo $bandera;?> registros! </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <?php }}?>
</form>
<p>&nbsp;</p>
</body>
</html>
