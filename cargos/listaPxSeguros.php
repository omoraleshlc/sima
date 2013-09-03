<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php

$_POST['codigo']=$_GET['codigo'];

?>



<?php 
if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************


if($_POST['actualizar'] AND $_POST['codigo'] ){ 

$agregar = $_POST["codAlmacen"];
 $nivel1=$_POST['nivel1'];
 $nivel3=$_POST['nivel3'];
$costo=$_POST['costo'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){



$sSQL3= "Select  * From articulosPrecioNivel WHERE codigo = '".$_POST['codigo']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



if($nivel1[$i] and $nivel3[$i] and $myrow3['codigo']){//cierra validacion


$q = "UPDATE articulosPrecioNivel set 
nivel1='".$nivel1[$i]."',
nivel3='".$nivel3[$i]."'
WHERE entidad='".$entidad."' AND
codigo='".$_POST['codigo']."' AND almacen='".$agregar[$i]."'
";
//mysql_db_query($basedatos,$q);
$leyenda = "Se actualizó el usuario: ".$_POST['usuario'];
echo mysql_error();
} else if($nivel1[$i] and $nivel3[$i]){
$agrega = "INSERT INTO articulosPrecioNivel (
codigo,almacen,nivel1,nivel3,usuario,hora,fecha,entidad
) values (
'".$_POST['codigo']."',
'".$agregar[$i]."',
'".$nivel1[$i]."',
'".$nivel3[$i]."',
'".$usuario."',
'".$hora1."',
'".$fecha1."','".$entidad."'


)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}



$sSQL3= "Select * From existencias WHERE entidad='".$entidad."' AND codigo = '".$_POST['codigo']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if(!$myrow3['codigo'] and $nivel1[$i] and $nivel3[$i]){

$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad
) values (
'".$_POST['codigo']."',
'".$agregar[$i]."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."'

)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();



$leyenda = "Se ingresó el almacén para el artículo: ".$_POST['codigo'];
} //cierra validacion
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
























if($_POST['borrar'] AND $_POST['codigo']){
if($quitar = $_POST['quitar']){
for($i=0;$i<=$_POST['pasoBandera'];$i++){
 $borrame = "DELETE FROM existencias WHERE entidad='".$entidad."' AND codigo ='".$_POST['codigo']."' 
AND almacen = '".$quitar[$i]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$borrameNivel = "DELETE FROM articulosPrecioNivel WHERE entidad='".$entidad."' AND codigo='".$_POST['codigo']."' AND almacen='".$quitar[$i]."'";
//mysql_db_query($basedatos,$borrameNivel);

}$leyenda = "Se eliminó del almacén ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de almacén que desee quitar.!";
}






if($_POST['usuario']){
$sSQL1= "Select distinct * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
} 


?>


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
.style15 {color: #0000FF}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label></p>
<form id="form2" name="form2" method="post" action="">
  <h2 align="center">Listado de Seguros Jubilados </h2>
  <table width="566" border="0" align="center">
      <tr>
        <th width="43" bgcolor="#660066" scope="col"><span class="style11">#</span></th>
        <th width="52" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo </span></th>
        <th width="358" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="24" bgcolor="#660066" scope="col"><span class="style11">Part</span></th>
        <th width="33" bgcolor="#660066" scope="col"><span class="style11">Seguro </span></th>
        <th width="30" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
      </tr>
      
	          <?php   
 $sSQL= "Select distinct * From porcentajeJubilados 
 where keyPacientes='".$_GET['keyPacientes']."'";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$alma=$myrow['almacen'];
$code=$myrow['codigo'];
$sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);


   $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

  
  $sSQL61="SELECT *
FROM
  existencias
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  if($myrow61['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else  {
  $color = '#FFFFFF';
  $estilo='style12';
  }
?>
	  <tr>
	  
	  
        <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="<?php echo $estilo?>"><?php echo $bandera;?></span></div></td>

        <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style7"></span><span class="<?php echo $estilo?>"><?php echo $myrow['almacen'];?></span></div>
            <span class="style7">
            <label></label>
            </span>
            <div align="center"></div></td>
        <td bgcolor="<?php echo $color?>" class="<?php echo $estilo?>">
		<span class="style12">
		
		<?php 
		if($myrow['medico']=='si'){
		echo $myrow['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else {
		echo $myrow['descripcion'];
		}
		?>
		</span>
            <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
        <input name="codAlmacen[]" type="hidden" id="codAlmacen[]" value="<?php echo $myrow['almacen']; ?>" /></td>
        <td bgcolor="<?php echo $color?>" class="style12"><label>
          <input name="nivel1[]" type="text" class="style12" id="nivel1[]" size="6" value="<?php echo money_format($myrow6['nivel1'],2); ?>" autocomplete="off" onKeyPress="return checkIt(event)"/>
        </label></td>
        <td bgcolor="<?php echo $color?>" class="style12"><input name="nivel3[]" type="text" class="style12" id="nivel3[]" size="6"  value="<?php echo money_format($myrow6['nivel3'],2); ?>" autocomplete="off" onKeyPress="return checkIt(event)"/></td>
        <td bgcolor="<?php echo $color?>" class="style12"><input name="quitar[]" type="checkbox" class="style12" id="quitar[]" 
		value="<?php 
		
		echo $myrow6['almacen'];
		
		?>" 
		<?php if(!$myrow6['almacen']){
		echo 'disabled="disabled"';
		}
		?>
		/></td>
      </tr>
      <?php }?>
  </table>
    <p align="center">
      <label>
      <input name="actualizar" type="submit" class="style12" id="actualizar" value="Listado de Seguros Px Jubilados" />
      </label>
      <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar/Borrar" />
    </p>
</form>
  <p></p>
  
  
</body>
</html>
