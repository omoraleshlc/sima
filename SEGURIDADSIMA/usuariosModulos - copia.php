<? include("/configuracion/conf.php"); ?>
<? 
if($_POST['nuevo']){
$_POST['usuario1']="";
$leyenda = "Ingrese los datos correctamente";
}
//actualizar ******************************************************************************************************
if($_POST['actualizar'] AND $_POST['usuario1'] ){ 
//********abro lista

//********cierro lista
//if($myrow1['usuario'] !=$_POST['usuario']){ //checo que no haya un usuario igual
//******************** INSERTAR Y ACTUALIZAR ************************************
if($agregar = $_POST["codModulo"]){ //paso arreglo de agregar modulos a agregar

foreach($agregar as $i => $agregar_articulo){
$sSQL3= "Select all distinct * From usuariosModulos WHERE usuario = '".$_POST['usuario1']."'
AND modulo = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
if($myrow3['usuario']!= $_POST['usuario1'] AND $agregar[$i] != $myrow3['modulo']){
$agrega = "INSERT INTO usuariosModulos (
usuario,modulo
) values (
'".$_POST['usuario1']."',
'".$agregar[$i]."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$leyenda = "Se ingresó el usuario: ".$_POST['usuario1'];
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

if($_POST['borrar'] AND $_POST['usuario1']){

if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM usuariosModulos WHERE usuario ='".$_POST['usuario1']."' 
AND modulo LIKE '%$quitar[$is]%' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$leyenda = "Se eliminó el modulo ".$quitar[$i];
}}} else if($_POST['borrar'] AND !$_POST['usuario1']){
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

echo $sSQL5= "Select all distinct * From usuarios-modulos WHERE usuario = '".$_POST['usuario']."'";
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
$sSQL1= "Select all distinct * From usuarios WHERE nCliente = '".$nCliente."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
}
*/
if($_POST['usuario1']){
$sSQL1= "Select all distinct * From usuarios WHERE usuario = '".$_POST['usuario1']."'";
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
.style14 {color: #003366}
-->
</style>
</head>

<body>
<p align="center">
  <label></label> 
Permisos Usuario &lt;--&gt; Modulos</p>
<form id="form" name="form" method="post" action="" />
  <label>
  <div align="center">
    <input name="textfield" type="text" class="style12" size="60" value="<? echo $leyenda; ?>"/>
  </div>
  </label>
  <table width="323" border="1" align="center" class="style12">

    <tr>
      <th colspan="2" bgcolor="#000066" scope="col"><strong><span class="style13">Usuario y Password </span></strong></th>
    </tr>
    <tr>
      <th scope="col">Usuario: </th>
      <th width="152" scope="col"><label>
        <? //*********ANAQUELES
	   $sSQL7= "Select all distinct * From usuarios ORDER BY usuario ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
        <select name="usuario1" class="style12" id="usuario1" onChange="javascript:this.form.submit();">
          <? if($_POST['usuario1']){ ?>
          <option value="<? echo $_POST['usuario1']; ?>"><? echo  $_POST['usuario1']; ?></option>
          <? } else {?>
          <option></option>
          <? } ?>
		   <option></option>
          <? 		 
		   while($myrow7 = mysql_fetch_array($result7)){ 
		echo '<option>'.$myrow7['usuario']; 
		} 
		
		?>
        </select>
&nbsp;</label></th>
    </tr>
  </table>
  <p>
 
  </p>
  
  
  <table width="326" border="1" align="center">
    <tr>
      <th width="103" bgcolor="#000066" scope="col"><span class="style11">C&oacute;digo del M&oacute;dulo </span></th>
      <th width="151" bgcolor="#000066" scope="col"><span class="style11">Agregar  M&oacute;dulos</span></th>
      <th width="50" bgcolor="#000066" scope="col"><span class="style11">Agregar</span></th>
    </tr>
    <tr>
      <?   
 $sSQL= "Select all distinct * From modulos order by modulo ASC";
$result=mysql_db_query($basedatos,$sSQL); 
?>
      <?	while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
?>
      <td bgcolor="#FFFFFF" class="style12"><div align="center"><span class="style7"> </span></div>
          <span class="style7">
            <label></label>
          </span>
        <div align="center"><span class="style7"><? echo $myrow['codModulo'];?></span></div></td>
      <td bgcolor="#FFFFFF" class="style12"><span class="style7"><? echo $myrow['modulo'];?></span>
          <input name="pasoBandera" type="hidden" id="pasoBandera" value="<? echo $bandera; ?>" />
          <input name="tope" type="hidden" id="tope" value="<? echo $nCliente; ?>" />
          <input name="modes[]" type="hidden" id="modes[]" value="<? echo $myrow['modulos']; ?>" /></td>
      <td bgcolor="#FFFFFF" class="style12"><label>
          <div align="center">
            <? 
$sSQL3= "Select all distinct * From modulos WHERE codModulo = '".$codigoModulo."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
echo mysql_error();
	   ?>
            <? if($myrow3['codModulo']== $codigoModulo){
	  
		$b = "checked";
		} else {
		
		$b="";
		}
		?>
        
            <input name="codModulo[]" type="checkbox" class="style12" id="codModulo[]" 
		value="<? 
		echo $codigoModulo;
		?>" />
          </div>
        </label></td>
    </tr>
    <? }?>
</table>
  <p align="center">
  
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Agregar M&oacute;dulos" />
    <label></label>
  </p>
  <p>
    <? //*********ANAQUELES
	   $sSQL8= "Select all distinct * From usuariosModulos WHERE usuario ='".$_POST['usuario1']."'";
$result8=mysql_db_query($basedatos,$sSQL8);
echo mysql_error();


	  ?>
  </p>
  <hr />
  <form id="form1" name="form1" method="post" action="">
    <table width="330" border="1" align="center" class="style12">
      <tr>
        <th width="284" bgcolor="#003300" scope="col"><strong><span class="style13">M&oacute;dulos ya agregados </span></strong></th>
        <th width="30" bgcolor="#003300" scope="col"><span class="style11">Quitar</span></th>
      </tr>
      
	  <tr>
	  <? while($myrow8 = mysql_fetch_array($result8)){ ?>
        <th scope="col"><label><span class="style7"><? echo $myrow8['modulo'];?></span></label></th>
        <th scope="col"><input name="quitar[]" type="checkbox" class="style12" id="quitar[]" 
		value="<? 
		echo $myrow8['modulo'];
		?>" /></th>
      </tr>  <? }?>
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