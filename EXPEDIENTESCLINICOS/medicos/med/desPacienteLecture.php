<?php include("/configuracion/ventanasEmergentes.php"); ?>

<?php
$sSQL= "SELECT *
  FROM
pacientes
WHERE numCliente ='".$_GET['numPaciente']."'
";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['numCliente']){
if(isset($_POST['numCliente'])!=$myrow1['numCliente']){

$agrega = "INSERT INTO pacientes (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,numPoliza,
ciudad,estado,colonia,religion,ecivil,rfc
) values (
'".$_POST['nombre1']."','".$_POST['nombre2']."','".$_POST['apellido1']."',
'".$_POST['apellido2']."','".$_POST['apellido3']."',
'".$_POST['numCliente']."','".$_POST['ocupacion']."','".$_POST['fechaNacimiento']."',
'".$_POST['pais1']."','".$_POST['telefono']."','".$_POST['calle']."',
'".$_POST['cp']."','".$_POST['numPoliza']."','".$_POST['ciudad']."',
'".$_POST['estado']."','".$_POST['colonia']."','".$_POST['religion']."',
'".$_POST['ecivil']."','".$_POST['rfc']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
paciente_insertado();
$sSQL= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}} else {
$q = "UPDATE pacientes set 
nombre1='".$_POST['nombre1']."', 
nombre2='".$_POST['nombre2']."',
apellido1='".$_POST['apellido1']."',
apellido2='".$_POST['apellido2']."',
apellido3='".$_POST['apellido3']."',
ocupacion='".$_POST['ocupacion']."',
fechaNacimiento='".$_POST['fechaNacimiento']."',
pais1='".$_POST['pais1']."',
telefono='".$_POST['telefono']."',
calle='".$_POST['calle']."',
cp='".$_POST['cp']."',
numPoliza='".$_POST['numPoliza']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
colonia='".$_POST['colonia']."',
religion='".$_POST['religion']."',
ecivil='".$_POST['ecivil']."',
rfc='".$_POST['rfc']."'


WHERE 
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
paciente_actualizado();
$sSQL= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}
}

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM pacientes WHERE numCliente ='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
paciente_borrado();
}

if($_POST['nuevo']){
/** checo si existe**/
$sSQL2= "Select max(numCliente) as tope From pacientes";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 $torpe = $myrow2['tope'];
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style14 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
-->
</style>
<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="502" border="1" align="center" class="style12">
    <tr>
      <th colspan="2" class="style12 style14" scope="col"><div align="left">N&uacute;mero de Paciente: </div></th>
      <th class="style12" scope="col"><div align="left">
	<?php  if($_POST['nuevo']){ ?>
        <input name="numCliente" type="text" class="style12" id="numCliente" value="<?php echo $tope=$myrow2['tope'] +1; ?>" 
		size="60" readonly="" />
      <?php } else  { ?>
	  <input name="numCliente" type="text" class="style12" id="numCliente" value="<?php echo $myrow['numCliente']; ?>" size="60" 
	  readonly=""/>
	  <?php } ?>
	  </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th width="228" class="style12" scope="col"><div align="left">Nombre1 :</div></th>
      <th width="240" class="style12" scope="col"><label>
        <div align="left">
          <input name="nombre1" type="text" class="style12" id="nombre1" value="<?php echo $myrow['nombre1']; ?>" size="60"  readonly=""/>
        </div>
      </label></th>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Nombre2:</td>
      <td class="style12"><input name="nombre2" type="text" class="style12" id="nombre2" value="<?php echo $myrow['nombre2']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido1:</td>
      <td class="style12"><input name="apellido1" type="text" class="style12" id="apellido1" value="<?php echo $myrow['apellido1']; ?>" size="60" readonly="" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido2:</td>
      <td class="style12"><input name="apellido2" type="text" class="style12" id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido3:</td>
      <td class="style12"><input name="apellido3" type="text" class="style12" id="apellido3" value="<?php echo $myrow['apellido3']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Ocupaci&oacute;n</td>
      <td class="style12"><input name="ocupacion" type="text" class="style12" id="ocupacion" value="<?php echo $myrow['ocupacion']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Fecha de Nacimiento: </td>
      <td class="style12"><input name="fechaNacimiento" type="text" class="style12" id="fechaNacimiento" value="<?php echo $myrow['fechaNacimiento']; ?>" size="12"  readonly=""/> 
      formato: A&ntilde;o-Mes-Dia </td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Pa&iacute;s:</td>
      <td class="style12"><label>
      
		<SELECT id="pais1" name="pais1" width=227 STYLE="width: 230px; font-family: tahoma, arial; font-size: 11px" disabled="disabled">
		  <option value="<?php if($myrow['pais1']){echo $myrow['pais1'];} ?>"><?php if($myrow['pais1']){echo $myrow['pais1']."-->".$myrow['pais2'];} ?></option>
		  <option value="MEX">Mexico</option>
		  <option value="EU">EU</option>
		  <option value="VZ">Venezuela</option>
		</SELECT>
     
      </label></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Tel&eacute;fono:</td>
      <td class="style12"><input name="telefono" type="text" class="style12" id="telefono" value="<?php echo $myrow['telefono']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Calle:</td>
      <td class="style12"><input name="calle" type="text" class="style12" id="calle" value="<?php echo $myrow['calle']; ?>" size="60" readonly="" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">CP:</td>
      <td class="style12"><input name="cp" type="text" class="style12" id="cp" value="<?php echo $myrow['cp']; ?>"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">N&uacute;mero de P&oacute;liza: </td>
      <td class="style12"><input name="numPoliza" type="text" class="style12" id="numPoliza" value="<?php echo $myrow['numPoliza']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Ciudad:</td>
      <td class="style12"><input name="ciudad" type="text" class="style12" id="ciudad" value="<?php echo $myrow['ciudad']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Estado:</td>
      <td class="style12"><input name="estado" type="text" class="style12" id="estado" value="<?php echo $myrow['estado']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Colonia:</td>
      <td class="style12"><input name="colonia" type="text" class="style12" id="colonia" value="<?php echo $myrow['colonia']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Religi&oacute;n:</td>
      <td class="style12"><input name="religion" type="text" class="style12" id="religion" value="<?php echo $myrow['religion']; ?>" size="60"  readonly=""/></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Estado Civil: </td>
      <td class="style12"><label>
        <select name="ecivil" class="style12" id="ecivil" disabled="disabled"/>
          <option value="<?php echo $myrow['ecivil']; ?>"><?php echo $myrow['ecivil']; ?></option>
		  <option value="soltero">Soltero</option>
          <option value="casado">Casado</option>
          <option value="viudo">Viudo</option>
          <option value="otro">Otro</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">RFC:</td>
      <td class="style12"><input name="rfc" type="text" class="style12" id="rfc" value="<?php echo $myrow['rfc']; ?>" size="60"  readonly=""/></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
