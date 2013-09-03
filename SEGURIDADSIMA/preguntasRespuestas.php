<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>
<?php



if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************


if($_POST['actualizar'] AND $_POST['listaPreguntas'] ){ 
//********abro lista

//********cierro lista
//if($myrow1['usuario'] !=$_POST['usuario']){ //checo que no haya un usuario igual
//******************** INSERTAR Y ACTUALIZAR ************************************
if($agregar = $_POST["codigoLR"]){ //paso arreglo de agregar modulos a agregar

foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select * From preguntasRespuestas WHERE codigoLP = '".$_POST['listaPreguntas']."'
AND codigoLR = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['listaPreguntas']!= $_POST['listaPreguntas'] AND $agregar[$i] != $myrow3['codigoLR']){
$agrega = "INSERT INTO preguntasRespuestas (
codigoLP,codigoLR,usuario,fecha
) values (
'".$_POST['listaPreguntas']."',
'".$agregar[$i]."',
'".$usuario."','".$fecha1."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se agregó el Módulo..!";
} else {
$leyenda = "Ya existe ese modulo....";
}
}
}
//*****************cierro INSERTAR Y ACTUALIZAR **********************************
/* } else {
ya_existe();
$leyenda = "EL  USUARIO QUE ESCOGISTE YA ESTA EN EXISTENCIA..!!!";
}  *///cierro verificacion de existencia de usuario
} else if($_POST['actualizar']){
$leyenda = "Te Faltan Campos por Rellenar..!!!";
}
//****************************************************************************************************************************

if($_POST['borrar'] AND $_POST['listaPreguntas']){

if($quitar = $_POST['quita']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM preguntasRespuestas WHERE codigoLP ='".$_POST['listaPreguntas']."' 
AND codigoLR = '".$quitar[$is]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda = "Se eliminó el modulo";
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
 */
}}} else if($_POST['borrar'] AND !$_POST['cuarto']){
$leyenda = "Escoje por favor el procedimiento que desees quitar..!";
}





?>

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
.Estilo24 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style7 {font-size: 9px}
-->
</style>
</head>
<body>
<p align="center">
  <label></label>
</p>
<h1 align="center"> Preguntas &lt;-&gt; Respuestas </h1>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <div align="center"> <?php echo $leyenda; ?> </div>
  </label>
  <table width="610" height="59" border="1" align="center" class="Estilo24">
    <tr>
      <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Preguntas</span></strong></th>
    </tr>
    <tr>
      <th width="158" height="35" scope="col"><div align="center">Preguntas:</div></th>
      <th width="436" scope="col"><label>
          <div align="center">
            <label><strong>
            <?php	 		
$sqlNombre11 = "SELECT * from listaPreguntas

ORDER BY descripcionLP ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
            <select name="listaPreguntas" class="Estilo24" id="pregunta" onchange="javascript:this.form.submit();"/>            
          
            <option value="<?php echo $_POST['listaPreguntas']; ?>"><?php echo $_POST['listaPreguntas']; ?></option>
            <option value="">---</option>
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option value="<?php echo $rNombre11["codigoLP"];?>"> <?php echo 
	$rNombre11['descripcionLP']." || ".$rNombre11["codigoLP"];?></option>
            <?php } ?>
            </select>
            </strong>
            <input name="almacenImporte2" type="hidden" id="almacenImporte2" value="<?php echo $ali; ?>" />
            </label>
            <label></label>
          </div>
        </label></th>
    </tr>
  </table>
</form>
<p align="center">&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
  <p>&nbsp;</p>
  <table width="647" border="1" align="center">
    <tr>
      <th colspan="4" bgcolor="#660066" scope="col">&nbsp;</th>
    </tr>
    <tr>
      <th width="112" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo </span></th>
      <th width="390" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n de la Respuesta </span></th>
      <th width="58" bgcolor="#660066" scope="col"><span class="style11">Agregar</span></th>
      <th width="59" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
    </tr>
    <tr>
      <?php   


//$sSQL= "Select * From articulos where um='s' order by descripcion ASC limit ".$empieza.",".$termina;
$sSQL= "Select * From listaRespuestas order by codigoLR ASC ";
$result=mysql_db_query($basedatos,$sSQL); 

while($myrow = mysql_fetch_array($result)){
$codig=	  $myrow['codigo'];
//echo $myrow['total'];
	  if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$bandera += 1;
$codigoLR = $myrow['codigoLR'];
$sSQL2= " Select * From preguntasRespuestas WHERE codigoLP ='".$_POST['listaPreguntas']."' and
codigoLR='".$codigoLR."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2); 
$myrow2 = mysql_fetch_array($result2);
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center"><span class="style7"> </span><span class="style7"><?php echo $myrow['codigoLR'];?></span></div>
          <span class="style7">
          <label></label>
          </span>
          <div align="center"></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcionLR'];?></span>
          <input name="bandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
          <input name="tope" type="hidden" id="tope" value="<?php echo $nCliente; ?>" />
          <input name="modes[]" type="hidden" id="modes[]" value="<?php echo $myrow['modulos']; ?>" /></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
        <?php if(!$myrow2['codigoLP']){ ?>
        <input name="codigoLR[]" type="checkbox" class="Estilo24" id="codigoLR[]" 
		value="<?php 
		echo $myrow['codigoLR'];
		?>" />
        <?php } else {   echo "--- "; }?>
        </label>
      </td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php if($myrow2['codigoLP']){ ?>
          <input name="quita[]" type="checkbox" class="Estilo24" id="quita[]" value="<?php echo $codigoLR?>"/>
          <?php } else {   echo "--- "; }?>
      </td>
    </tr>
    <?php }?>
  </table>
  <p>
  <label>
    <div align="center">
      <div align="center">
        <input name="actualizar" type="submit" class="Estilo24" id="actualizar" value="Agregarle Procedimientos" />
        <input name="borrar" type="submit" class="Estilo24" id="borrar" value="Eliminar/Borrar" />
      </div>
  </label>
    <p align="center">
      <input name="listaPreguntas" type="hidden" id="listaPreguntas" value="<?php echo $_POST['listaPreguntas']; ?>" />
</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p> </p>
  <p align="center">
    <label></label>
</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</body>
</html>
