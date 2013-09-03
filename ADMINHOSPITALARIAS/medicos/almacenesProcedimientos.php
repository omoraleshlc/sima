<?PHP include("/configuracion/administracionhospitalaria/medicos/medicosmenu.php"); ?>
<script type="text/javascript" src="public_smo_scripts.js"></script>
<?php 
if($_POST['nuevo']){
$_POST['almacen']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************
if($_POST['actualizar'] AND $_POST['almacen'] ){ 
//********abro lista
//********cierro lista
//if($myrow1['almacen'] !=$_POST['almacen']){ //checo que no haya un almacen igual
//******************** INSERTAR Y ACTUALIZAR ************************************
 //paso arreglo de agregar modulos a agregar
for($i=0;$i<$_POST['bandera'];$i++){
if($agregar = $_POST["codigo"]){
$sSQL3= "Select * From almacenesProcedimientos WHERE codAlmacen = '".$_POST['almacen']."'
AND codProcedimiento = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['codAlmacen']!= $_POST['almacen'] AND $agregar[$i] != $myrow3['codProcedimiento']){
 $agrega = "INSERT INTO almacenesProcedimientos (
codAlmacen,codProcedimiento,usuario,fecha,hora
) values (
'".$_POST['almacen']."',
'".$agregar[$i]."',
'".$usuario."',
'".$fecha1."',
'".$hora1."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingresó el almacen: ".$_POST['almacen'];
}}}
//*****************cierro INSERTAR Y ACTUALIZAR **********************************
/* } else {
ya_existe();
$leyenda = "EL  almacen QUE ESCOGISTE YA ESTA EN EXISTENCIA..!!!";
}  *///cierro verificacion de existencia de almacen
} else if($_POST['actualizar']){
$leyenda = "Te Faltan Campos por Rellenar..!!!";
}
//****************************************************************************************************************************

if($_POST['borrar'] AND $_POST['quitar']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM almacenesProcedimientos WHERE keyAP ='".$quitar[$is]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}
$leyenda = "Se eliminó el modulo ".$quitar[$i];
}
} else if($_POST['borrar'] AND !$_POST['almacen']){
$leyenda = "Por favor, escoja el nombre de almacen que desee eliminar..!";
}



if($_POST['codAlmacen']){
$sSQL1= "Select * From almacenesProcedimientos WHERE codAlmacen= '".$_POST['codAlmacen']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
} 


?>
<script type="text/javascript" src="public_smo_scripts.js"></script>
<script type="text/javascript" src="public_smo_scripts1.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.style14 {color: #003366}
-->
</style>
</head>

<body>
<p align="center">
  <label></label>
</p>
<h3 align="center"> Que servicios venden los almacenes </h3>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
    <input name="textfield" type="text" class="style12" size="60" value="<?php echo $leyenda; ?>" readonly=""/>
  </div>
  </label>
  <table width="323" border="1" align="center" class="style12">
    <tr>
      <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Escoje el M&eacute;dico</span></strong></th>
    </tr>
    <tr>
      <th scope="col">Almacen: </th>
      <th width="152" scope="col"><?php //*********ANAQUELES
	   $sSQL7= "Select * From almacenes ORDER BY almacen";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="almacen" class="style12" id="usuario" onChange="javascript:this.form.submit();">
          <?php if($_POST['almacen']){ ?>
          <option value="<?php echo $_POST['almacen']; ?>"><?php echo  $_POST['almacen']; ?></option>
          <?php } else {?>
          <option></option>
          <?php } ?>
          <option></option>
          <?php 		 
		   while($myrow7 = mysql_fetch_array($result7)){  ?>
<option value="<?php echo $myrow7['almacen']; ?>"> <?php echo $myrow7['descripcion']." || ".$myrow7['almacen']; ?></option>
          <?php } 
		
		?>
        </select></th>
    </tr>
    <tr>
      <th colspan="2" scope="col"><label>&nbsp;
        <?php 
		if($_POST['almacen']){
$sSQL18= "Select * From almacenes WHERE almacen ='".$_POST['almacen']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
       <?php echo "Almacen: ".$rNombre18["descripcion"];?>
	   
	   <?php } ?>
</label></th>
    </tr>
  </table>
  <p>
 
  </p>
  
  
  <table width="647" border="1" align="center">
    <tr>
      <th width="46" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo </span></th>
      <th width="541" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n del Servicio </span></th>
      <th width="38" bgcolor="#660066" scope="col"><span class="style11">Agregar</span></th>
    </tr>
    <tr>
      <?php   
 $sSQL= "Select * From articulos where um='s' order by descripcion ASC";
$result=mysql_db_query($basedatos,$sSQL); 
?>
      <?php	while($myrow = mysql_fetch_array($result)){
	  if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$bandera += 1;
$codigoModulo = $myrow['codigo'];
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="style12"><div align="center"><span class="style7"> </span><span class="style7"><?php echo $myrow['codigo'];?></span></div>
          <span class="style7">
          <label></label>
          </span>
          <div align="center"></div></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcion'];?></span>
          <input name="bandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
          <input name="codigo[]" type="hidden" id="codigo[]" value="<?php echo $myrow['codigo']; ?>" /></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><label>
        <input name="codProcedimiento[]" type="checkbox" class="style12" id="codProcedimiento[]" 
		value="<?php 
		echo $codigoModulo;
		?>" />
      </label></td>
    </tr>
    <?php }?>
  </table>
  <p align="center">
  
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar Procedimientos a Almacenes" />
    <label></label>
  </p>
  <p>
    <?php //*********ANAQUELES
	   $sSQL8= "Select * From almacenesProcedimientos where codAlmacen='".$_POST['almacen']."'ORDER BY 
	   codAlmacen ASC";
$result8=mysql_db_query($basedatos,$sSQL8);
echo mysql_error();


	  ?>
  </p>
  <hr />
  <form id="form1" name="form1" method="post" action="">
    <table width="406" border="1" align="center" class="style12">
      <tr>
        <th width="326" bgcolor="#660066" scope="col"><strong><span class="style13">Procedimientos Relacionados al Almacen </span></strong></th>
        <th width="64" bgcolor="#660066" scope="col"><p class="style11">Quitar
            
        </p>
        </th>
      </tr>
      
	  <tr>
	  <?php while($myrow8 = mysql_fetch_array($result8)){ 
$s=$myrow8['codAlmacen'];
$sSQL= "Select * From almacenesProcedimientos 
WHERE
codAlmacen = '".$_POST['almacen']."'
order by codProcedimiento ASC";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
	  	  if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
	  ?>
        <th scope="col"><label><span class="style7"><?php echo $myrow8['codAlmacen']." || ".$myrow8['codProcedimiento']; ?></span></label></th>
        <th scope="col"><input name="quitar[]" type="checkbox" class="style12" id="quitar[]" 
		value="<?php 
		echo $myrow8['keyAP'];
		?>" /></th>
      </tr>  <?php }?>
    </table>
    <div align="center">
    
      <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar/Borrar" />
    </div>
   
<p align="center">&nbsp;</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>