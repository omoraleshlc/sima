<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>

<?php 

$sSQL6= "Select distinct * From existencias WHERE codigo = '".$_POST['codigo']."'
AND almacen = '".$_POST['almacen']."'";
$result6=mysql_db_query($basedatos,$sSQL6);
$myrow6 = mysql_fetch_array($result6);

if($myrow6['codigo'] AND $myrow6['almacen']){

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
if($agregar = $_POST["codAnaquel"]){ //paso arreglo de agregar modulos a agregar
foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select distinct * From existencias WHERE codigo = '".$_POST['codigo']."'
AND anaquel = '".$agregar[$i]."' AND almacen = '".$_POST['almacen']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['codigo']!= $_POST['codigo'] AND $agregar[$i] != $myrow3['anaquel'] AND $myrow3['almacen']!=$_POST['almacen']){
$q = "INSERT INTO existencias 
(almacen,anaquel,codigo) VALUES (
'".$_POST['almacen']."',
'".$agregar[$i]."', 
'".$_POST['codigo']."')
";
/* else if($myrow3['codigo']== $_POST['codigo'] AND $agregar[$i] == $myrow3['anaquel'] AND $myrow3['almacen']==$_POST['almacen']){
$q = "UPDATE existencias set 
anaquel='".$anaquel[$i]."' 
WHERE 
codigo='".$_POST['codigo']."'
AND 
almacen = '".$_POST['almacen']."'
";
} */
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda = "Se ingresó el anaquel para el artículo: ".$_POST['codigo'];
} } 
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
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM existencias WHERE codigo ='".$_POST['codigo']."' 
AND anaquel = '".$quitar[$is]."' AND almacen = '".$_POST['almacen']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
/* echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaUsuarios.php">';
exit;
 */
}$leyenda = "Se eliminó el almacén ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['usuario']){
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
.style16 {font-size: 9px; color: #000000; }
.style17 {color: #000000}
-->
</style>
</head>

<body>
<p align="center">
  <label></label> 
  Relaci&oacute;n Art&iacute;culos
&lt;--&gt; Anaquel</p>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
    <input name="textfield" type="text" class="style12" size="60" value="<?php echo $leyenda; ?>" readonly=""/>
  </div>
  </label>
  <table width="323" border="1" align="center" class="style12">

    <tr>
      <th colspan="2" bgcolor="#000066" scope="col"><strong><span class="style13">Asignar art&iacute;culo -&gt; Anaquel </span></strong></th>
    </tr>
    <tr>
      <th scope="col">C&oacute;digo: </th>
      <th scope="col"><input name="codigo" type="text" class="style12" id="codigo" readonly="" value="<?php echo $_POST['codigo']; ?>" /></th>
    </tr>
    <tr>
      <th scope="col">Almac&eacute;n</th>
      <th width="152" scope="col"><label>
        <input name="almacen" type="text" class="style12" id="almacen" value="<?php echo $_POST['almacen']; ?>" readonly=""/>
      </label></th>
    </tr>
  </table>
  <p>
 
  </p>
  
  
  <table width="523" border="1" align="center">
    <tr>
      <th width="112" bgcolor="#000066" scope="col"><span class="style11"> C&oacute;digo de Anaqueles </span></th>
      <th width="316" bgcolor="#000066" scope="col"><span class="style11">Descripci&oacute;n del Anaquel</span></th>
      <th width="73" bgcolor="#000066" scope="col"><span class="style11">Agregar
          <label></label>
      </span></th>
    </tr>
    <tr>
      
      <?php   
 $sSQL= "Select distinct * From anaqueles 
 WHERE
 almacen = '".$_POST['almacen']."'
 order by anaquel ASC";
$result=mysql_db_query($basedatos,$sSQL); 
?>
      <?php	while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
?>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><?php echo $myrow['anaquel'];?></span>
	  
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
               <input name="modes[]" type="hidden" id="modes[]" value="<?php echo $myrow['almacen']; ?>" /></td>
<?php
$codigoRazon=$myrow['codigoRazon'];
 $sSQL11= "Select distinct * From tipoAnaqueles 
 WHERE
codigoAnaquel = '".$codigoRazon."' AND tipoAnaquel is not null
";
$result11=mysql_db_query($basedatos,$sSQL11); 
$myrow11 = mysql_fetch_array($result11);
echo mysql_error();
?>			   
      <td bgcolor="#FFFFFF" class="style12"><label><span class="style7"><?php 
	  if($myrow11['tipoAnaquel']){
	  echo $myrow11['tipoAnaquel'];
	  } else {
	  echo "SIN DEFINIR";
	  }
	  ?></span></label></td>
      <td bgcolor="#FFFFFF" class="style12"><div align="center">
        <input name="codAnaquel[]" type="checkbox" class="style12" id="codAnaquel[]" 
		value="<?php 
		echo $myrow['anaquel'];
		?>" onclick="CheckCheckAll(document.trackunread);"/>
      </div></td>
    </tr>
    <?php }?>
</table>
  <p align="center">
  
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar Anaqueles donde va el art&iacute;culo" />
    <label></label>
  </p>
  <p>
    <?php //*********ANAQUELES
$sSQL8= "Select distinct * From existencias WHERE codigo ='".$_POST['codigo']."'
AND almacen ='".$_POST['almacen']."' AND anaquel IS NOT NULL ORDER BY anaquel ASC";
$result8=mysql_db_query($basedatos,$sSQL8);
echo mysql_error();

?>
  </p>
  <hr />
  <form id="form1" name="form1" method="post" action="">
    <table width="738" border="1" align="center" class="style12">
      <tr>
        <th width="171" bgcolor="#003300" scope="col"><strong><span class="style13">Art&iacute;culos en Anaqueles ya agregados </span></strong></th>
        <th width="481" bgcolor="#003300" scope="col"><strong><span class="style13">Descripci&oacute;n de Anaquel</span></strong></th>
        <th width="64" bgcolor="#003300" scope="col"><p class="style11">Quitar
        </p>        </th>
      </tr>
  <?php while($myrow8 = mysql_fetch_array($result8) ){ 
$tO=$myrow8['anaquel'];
$sSQL12= "Select distinct * From anaqueles
WHERE
anaquel = '".$tO."' AND almacen='".$_POST['almacen']."' 
";
$result12=mysql_db_query($basedatos,$sSQL12); 
$myrow12 = mysql_fetch_array($result12);
echo mysql_error();
$codeRazon=$myrow12['codigoRazon'];
$sSQL13= "Select distinct * From tipoAnaqueles
WHERE
codigoAnaquel = '".$codeRazon."' 
";
$result13=mysql_db_query($basedatos,$sSQL13); 
$myrow13 = mysql_fetch_array($result13);
echo mysql_error();
?>    
	  <tr>
	    <th scope="col"><span class="style16">
	      <?php 
		if($myrow8['anaquel']){
		echo $myrow8['anaquel'];
		}
		?>
	    </span></th>

        <th scope="col"><span class="style17">
          <label><span class="style7">
          <?php 
		if($myrow13['tipoAnaquel']){
		echo $myrow13['tipoAnaquel'];
		}
		?>
          </span></label>
        </span></th>
        <th scope="col"><input name="quitar[]" type="checkbox" class="style12" id="quitar[]" 
		value="<?php 
		//if($myrow8['anaquel']){
		echo $myrow8['anaquel'];
		//}
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



<?php 
} else {
sin_almacen();
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=articulos-almacen.php">';
exit;

}



?>