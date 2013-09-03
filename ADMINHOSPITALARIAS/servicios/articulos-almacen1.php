<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<script type="text/javascript" src="http://www.shawnolson.net/scripts/public_smo_scripts.js"></script>

<?php 
if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************


if($_POST['actualizar'] AND $_POST['codigo'] ){ 
//********abro lista

//********cierro lista
//if($myrow1['usuario'] !=$_POST['usuario']){ //checo que no haya un usuario igual
//******************** INSERTAR Y ACTUALIZAR ************************************
if($agregar = $_POST["codAlmacen"]){ //paso arreglo de agregar modulos a agregar
foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select distinct * From existencias WHERE codigo = '".$_POST['codigo']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['codigo']!= $_POST['codigo'] AND $agregar[$i] != $myrow3['almacen']){
$agrega = "INSERT INTO existencias (
codigo,almacen
) values (
'".$_POST['codigo']."',
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingresó al almacén el artículo: ".$_POST['codigo'];
}}}
//*****************cierro INSERTAR Y ACTUALIZAR **********************************
/* } else {
ya_existe();
$leyenda = "EL  USUARIO QUE ESCOGISTE YA ESTA EN EXISTENCIA..!!!";
}  *///cierro verificacion de existencia de usuario
} else if($_POST['actualizar']){
$leyenda = "Te Faltan Campos por Rellenar..!!!";
}
//****************************************************************************************************************************

if($_POST['borrar'] AND $_POST['quitarAlmacen']){
if($quitar = $_POST['quitarAlmacen']){

foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM existencias WHERE codigo ='".$_POST['codigo']."' 
AND almacen = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
 */
}$leyenda = "Se eliminó del almacén ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de almacén que desee quitar.!";
}





/* $nCliente1= $_POST['nCliente'];
if(!$_POST['actualizar']){
$s = "select max(nCLiente) as maximo from usuarios";
$r1=mysql_db_query($basedatos,$s);
$m = mysql_fetch_array($r1);
$nCliente = $m['maximo'];
$nCliente+=1;
}
if($_POST['actualizar']){
$nCliente = $_POST['tope']+1;
$password = $_POST['pwd1'];
if($_POST['actualizar'] AND $nCliente AND $_POST['nombre']
AND $_POST['usuario'] AND $password
AND $_POST['aPaterno'] AND $_POST['aMaterno']
){

echo $sSQL5= "Select distinct * From usuarios-modulos WHERE usuario = '".$_POST['usuario']."'";
$result5=mysql_db_query($basedatos,$sSQL5);
$myrow5 = mysql_fetch_array($result5);

if($agregar = $_POST["codModulo"]){
foreach($agregar as $i => $agregar_articulo){
if($myrow5['usuario']== $_POST['usuario']){
$q = "UPDATE usuarios-modulos set 
modulo='".$agregar[$i]."'
WHERE 
usuario='".$_POST['usuario']."' AND modulo='".$agregar[$i]."'
";
mysql_db_query($basedatos,$q);
$leyenda = "Se actualizó el usuario: ".$_POST['usuario'];
echo mysql_error();
} else {
$agrega = "INSERT INTO usuarios-modulos (
usuario,modulo
) values (
$nCliente,
'".$_POST['usuario']."'
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
$leyenda = "Se insertó el usuario: ".$_POST['usuario'];
echo mysql_error();
//$nCliente-=1;
//echo '<META HTTP-EQUIV="Refresh"
//      CONTENT="0; URL=listaUsuarios.php">';

}}
}}
} else if($_POST['pwd1'] !=$_POST['pwd2'] ){
no_coinciden();
}


if($_POST['borrar'] AND $_POST['nCliente']){
$borrame = "DELETE FROM usuarios WHERE nCliente ='".$_POST['nCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda = "Se eliminó el usuario: ".$_POST['usuario'];
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
}


if($_POST['borrar'] || $_POST['actualizar']){
$sSQL1= "Select distinct * From usuarios WHERE nCliente = '".$nCliente."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}
*/
if($_POST['usuario']){
$sSQL1= "Select distinct * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
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
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<p align="center">
  <label></label> 
  Relaci&oacute;n Art&iacute;culos
&lt;--&gt; Almac&eacute;n </p>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
<?php echo $leyenda; ?>
  </div>
  </label>
  <table width="323" border="1" align="center" class="style12">

    <tr>
      <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Asignar art&iacute;culo -&gt; Almac&eacute;n </span></strong></th>
    </tr>
    <tr>
      <th scope="col">C&oacute;digo: </th>
      <th width="152" scope="col"><label>
      <input name="codigo" type="text" class="style12" id="codigo" readonly="" value="<?php echo $codigo=$_POST['codigo']; ?>">
      </label></th>
    </tr>
  </table>
  <p align="center">
<?php   
$sSQL13= "
SELECT *
FROM
articulos
WHERE
codigo='".$_POST['codigo']."'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
echo $myrow13['descripcion']."  ".$myrow13['descripcion1'];
?>
 </p>
  
  
  <table width="346" border="1" align="center">
    <tr>
      <th width="82" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo del Almac&eacute;n </span></th>
      <th width="169" bgcolor="#660066" scope="col"><span class="style11">Agregar Almacenes </span></th>
      <th width="37" bgcolor="#660066" scope="col"><span class="style11">Agregar
        <label></label>
      </span></th>
      <th width="30" bgcolor="#660066" scope="col"><span class="style11">Quitar</span></th>
    </tr>
    <tr>
      <?php   
 $sSQL= "Select distinct * From almacenes 
 where (ventas='Si' or ventas='si')
 order by almacen ASC";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$codigoModulo = $myrow['codModulo'];
$alma=$myrow['almacen'];
$sSQL10= "Select distinct * From existencias WHERE almacen = '".$alma."'
and
codigo='".$codigo."'";
$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);

$bandera += 1;

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
 <?php if($myrow10['almacen']){ 
 $color='#0000FF';
 $estilo='style13';
 } else {
 $estilo='style7';
 }
 ?>  
      <td bgcolor="<?php echo $color?>" class="style12"><div align="center"><span class="style7"> </span></div>
          <span class="style7">
            <label></label>
          </span>
        <div align="center"><span class="<?php echo $estilo;?>"><?php echo $myrow['almacen'];?></span></div></td>
      <td bgcolor="<?php echo $color?>" class="<?php echo $estilo;?>"><span class="style7"><?php echo $myrow['descripcion'];?></span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
               <input name="almacen[]" type="hidden" id="almacen[]" value="<?php echo $myrow['almacen']; ?>" />
      </td>
      <td bgcolor="<?php echo $color?>" class="<?php echo $estilo;?>"><label>
          <div align="center">
        <?php if(!$myrow10['almacen']){ ?>           
        <input name="codAlmacen[]" type="checkbox" class="<?php echo $estilo;?>" id="codAlmacen[]" 
		value="<?php 
		echo $myrow['almacen'];
		?>" onClick="CheckCheckAll(document.trackunread);"/>
		<?php } else { echo "---";}?>
		
          </div>
        </label></td>
      <td bgcolor="<?php echo $color?>" class="<?php echo $estilo;?>"><div align="center">
	  <?php if($myrow10['almacen']){ ?>
        <input name="quitarAlmacen[]" type="checkbox" class="<?php echo $estilo;?>" id="codAlmacen[]2" 
		value="<?php 
		echo $myrow['almacen'];
		?>" />
		<?php } else { echo "---";}?>
		
      </div></td>
    </tr>
    <?php }?>
</table>
  <p align="center">
  
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar art&iacute;culo a almac&eacute;n" />
    <label></label>
    <input name="borrar" type="submit" class="style12" id="borrar" value="Eliminar/Borrar" />
  </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
