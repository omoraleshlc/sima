<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>

<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php 



if($_POST['surtir'] and $_POST['cantidadSurtida']){
$cantidadSurtida=$_POST['cantidadSurtida'];
$keyPA=$_POST['keyPA'];
$almacenSolicitante=$_POST['almacenSolicitante'];

$cantidadVendida=$_POST['cantidadVendida'];




for($i=0;$i<=$_POST['bandera'];$i++){
if($keyPA[$i]){
$sSQL52a="SELECT sum(cantidadSurtida) as cs
FROM
articulosSurtidos
WHERE
entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."' 
AND 
almacenSolicitante = '".$almacenSolicitante[$i]."' ";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);	
  
  
  
$sSQL52="SELECT existencia
FROM
existencias
WHERE 
entidad='".$entidad."'
and
keyPA = '".$keyPA[$i]."' and almacen='".$almacenSolicitante[$i]."'  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
//***********************************************
$cantidadEnStock=$myrow52['existencia'];



if($cantidadSurtida[$i]){ 

$tota=$cantidadVendida[$i]-$myrow52a['cs'];

if($tota>1 and $cantidadSurtida[$i]<=$cantidadVendida[$i]){


  $q = "UPDATE existencias set 

fechaA='".$fecha1."', 
hora='".$hora1."', 
existencia=existencia+'".$cantidadSurtida[$i]."'

WHERE 
entidad='".$entidad."' AND
keyPA='".$keyPA[$i]."' 
AND 
almacen = '".$almacenSolicitante[$i]."'
";

mysql_db_query($basedatos,$q);
echo mysql_error();



$agrega1 = "INSERT INTO articulosSurtidos (

keyPA,
cantidadSurtida,
almacenSolicitante,
usuario,
fecha,
hora,
entidad
) values (

'".$keyPA[$i]."',
'".$cantidadSurtida[$i]."',
'".$almacenSolicitante[$i]."',
'".$usuario."',
'".$fecha1."',
'".$hora1."',
'".$entidad."' )";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();




}


//*****************************************************************


if($tota<1){
$q1 = "DELETE FROM faltantes 
WHERE 
entidad='".$entidad."'
and
keyPA='".$keyPA[$i]."'
and
almacenSolicitante='".$almacenSolicitante[$i]."'
and
status='request'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}

//*****************************************************************


}
}
}//cierra validacion
?>
<script>
window.alert("Se surtieron articulos");
</script>
<?php 
}


?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}
.style14 {font-size: 9px}
.style14 {font-size: 9px}
.style14 {font-size: 9px}
.Estilo24 {font-size: 10px}
-->
</style>
</head>



 <?php require("/configuracion/componentes/comboAlmacen.php"); include("/configuracion/funciones.php"); ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Solicitudes a Almacen Principal </h1>
  <p align="center">
<?php 
  $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and medico ='no' and miniAlmacen='Si'  and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="<?php echo $estilos;?>" id="almacenDestino" onChange="this.form.submit();" />        
     
  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
	     
  </p>
  <table width="454" border="0.2" align="center">
    <tr>
      <th width="53" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">keyPA</span></div></th>
      <th width="265" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Descripcion</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Solicita</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cargar</span></div></th>
    </tr>
    <tr>


	<?php	


$sSQL= "SELECT * ,sum(cantidad) as c
FROM

faltantes
where
entidad='".$entidad."'
and
almacenSolicitante='".$_POST['almacenDestino']."'
and
status='request' 
and
keyPA!=''
group by keyPA
order by descripcion ASC
";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


	  ?>
	  
	  

	  
	  
	        <td bgcolor="<?php echo $color?>" class="style12"><?php echo $myrow['keyPA'];?></td>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php 
			$sSQL52a="SELECT descripcion
FROM
articulos
WHERE entidad='".$entidad."' AND
keyPA='".$myrow['keyPA']."'
";
  $result52a=mysql_db_query($basedatos,$sSQL52a);
  $myrow52a = mysql_fetch_array($result52a);		
  
  if($myrow52['descripcion']){
  echo $myrow52['descripcion'];
  }else{
  echo $myrow52a['descripcion'];
  }
?>
	  <?php echo $myrow['descripcion'];?>	
	  </span></td>
	  <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	   <input name="cantidadVendida[]" type="hidden" value="<?php echo $myrow['c'];?>" />
	  	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />
      <td width="59" bgcolor="<?php echo $color?>" class="style12"><?php 
	  
	  			$sSQL52="SELECT sum(cantidadSurtida) as cs
FROM
articulosSurtidos
WHERE entidad='".$entidad."' 
AND
keyPA='".$myrow['keyPA']."'
and
almacenSolicitante='".$myrow['almacenSolicitante']."'  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);		
	  echo $myrow['c']-$myrow52['cs'];
	  

	  ?></td>
      <td width="59" bgcolor="<?php echo $color?>" class="style12"><span class="style14">
	  
	  
	 <a   href="javascript:ventanaSecundaria8('resurtirInventarios.php?nOrden=<?php echo $myrow['nOrden']; ?>')"></a>
	 <label>
	 <input name="cantidadSurtida[]" type="text" id="cantidadSurtida[]" size="5" maxlength="5" />
	 </label>
      </span></td>
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <div align="center">
    <label>
	<?php if($bandera>1){ ?>
    <input name="surtir" type="submit" id="surtir" value="cargar" />
	<?php } ?>
    </label>
  </div>
  <label>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
</body>
</html>