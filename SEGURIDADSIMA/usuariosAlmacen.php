<?php include("/configuracion/seguridadsima/seguridadmenu.php"); ?>

<?php 
if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************
if($_POST['actualizar'] AND $_POST['usuario'] ){ 
//********abro lista
//********cierro lista
//if($myrow1['usuario'] !=$_POST['usuario']){ //checo que no haya un usuario igual
//******************** INSERTAR Y ACTUALIZAR ************************************
if($agregar = $_POST["codAlmacen"]){ //paso arreglo de agregar modulos a agregar

foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select * From usuariosAlmacenes WHERE usuario = '".$_POST['usuario']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['usuario']!= $_POST['usuario'] AND $agregar[$i] != $myrow3['modulo']){
$agrega = "INSERT INTO usuariosAlmacenes (
usuario,almacen
) values (
'".$_POST['usuario']."',
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingresó el almacén para el usuario: ".$_POST['usuario'];
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

if($_POST['borrar'] AND $_POST['usuario']){
if($quitar = $_POST['quitarAlmacen']){
foreach($quitar as $is => $quitar_articulo){
 $borrame = "DELETE FROM usuariosAlmacenes WHERE keyUA = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
 */
}$leyenda = "Se eliminó el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de usuario que desee eliminar..!";
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

echo $sSQL5= "Select * From usuarios-modulos WHERE usuario = '".$_POST['usuario']."'";
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
$sSQL1= "Select * From usuarios WHERE nCliente = '".$nCliente."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}
*/
if($_POST['usuario']){
$sSQL1= "Select * From usuarios WHERE usuario = '".$_POST['usuario']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
} 


?>

<script type="text/javascript" src="public_smo_scripts.js"></script>
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
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
<p align="center">
  <label></label>
Permisos Usuario &lt;--&gt; Almac&eacute;n </p>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
    <input name="textfield" type="text" class="style12" size="60" value="<?php echo $leyenda; ?>" readonly=""/>
  </div>
  </label>
  <table width="323" border="0" align="center" class="style12">

    <tr>
      <th colspan="2" bgcolor="#660066" scope="col"><strong><span class="style13">Usuario y Password </span></strong></th>
    </tr>
    <tr>
      <th scope="col">Usuario: </th>
      <th width="152" scope="col"><label>
      <?php //*********seguros
$cmdstr1 = "select * from PEDRO.USUARIO ORDER BY NOMBRE ASC";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 
?>
      <select name="usuario" class="Estilo24" id="tipoUsuario" onChange="javascript:this.form.submit();">

        <option value="">---</option>
        <?php  	 		 
		    for ($i = 0; $i < $nrows1; $i++ ){
		    ?>
        <option
		 <?php if($_POST['usuario']==$results1['LOGIN'][$i]){ ?>
		 selected="selected"
		  <?php } ?>
		 value="<?php echo $results1['LOGIN'][$i]; ?>"><?php echo $results1['NOMBRE'][$i]." ".$results1['AP_PATERNO'][$i]." ".$results1['AP_MATERNO'][$i]; ?></option>
        <?php } 
		
		?>
      </select>
</label></th>
    </tr>
</table>
  <p>&nbsp;</p>
  <table width="422" border="0" align="center">
    <tr>
      <th width="103" bgcolor="#660066" scope="col"><span class="style11">C&oacute;digo del Almac&eacute;n </span></th>
      <th width="151" bgcolor="#660066" scope="col"><span class="style11">Agregar Almacenes </span></th>
      <th width="70" bgcolor="#660066" scope="col"><span class="style11">Agregar
          <label></label>
      </span></th>
      <th width="70" bgcolor="#660066" scope="col"><span class="style11">quitar
        <label></label>
      </span></th>
    </tr>
    <tr>
      <?php   
$sSQL= "Select * From almacenes 
where
(ventas='si' or ventas='Si') and modulo='no'
order by almacen ASC";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$alma=$myrow['almacen'];
$sSQL3= "Select * From usuariosAlmacenes WHERE usuario = '".$_POST['usuario']."' and
almacen='".$alma."'
";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}	  
$bandera += 1;
$codigoModulo = $myrow['codModulo'];


?>
      <td bgcolor="<?php echo $color;?>" class="style12"><div align="center"><span class="style7"> </span></div>
          <span class="style7">
            <label></label>
          </span>
        <div align="center"><span class="style7"><?php echo $myrow['almacen'];?></span></div></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><?php echo $myrow['descripcion'];?></span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
               <input name="modes[]" type="hidden" id="modes[]" value="<?php echo $myrow['almacen']; ?>" /></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><div align="center">
        
		<?php if(!$myrow3['usuario']){ ?>
		<input name="codAlmacen[]" type="checkbox" class="Estilo24" id="codAlmacen[]" 
		value="<?php 
		echo $myrow['almacen'];
		?>" />
		<?php } else { echo "---";}?>
		
      </div></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><div align="center">
	  
        	<?php if($myrow3['usuario']){ ?>
		<input name="quitarAlmacen[]" type="checkbox" class="Estilo24" 
		value="<?php 
		echo $myrow3['keyUA'];
		?>" />
		
		<?php } else { echo "---";}?>
      </div></td>
    </tr>
    <?php }?>
</table>
  <p align="center">
  
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar Almacenes" />
    <input name="borrar" type="submit" class="Estilo24" id="borrar" value="Eliminar/Borrar" />
    <label></label>
  </p>
  <p>
    <?php //*********ANAQUELES
	   $sSQL8= "Select * From usuariosAlmacenes WHERE usuario ='".$_POST['usuario']."' ORDER BY 
	   almacen ASC";
$result8=mysql_db_query($basedatos,$sSQL8);
echo mysql_error();


	  ?>
  </p>
  <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
