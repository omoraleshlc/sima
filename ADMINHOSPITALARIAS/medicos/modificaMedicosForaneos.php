<?PHP include("/configuracion/administracionhospitalaria/medicos/medicosmenu.php"); ?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.numMedico.value) == false ) {   
                alert("Escribe el número de código para el doctor presionando NUEVO, y a HLC agregale su número!")   
                return false   
        } else if( vacio(F.nombre1.value) == false ) {   
                alert("Escribe el Nombre del Doctor!")   
                return false   
        } else if( vacio(F.apellido1.value) == false ) {   
                alert("Escribe el Apellido Paterno del Doctor!")   
                return false   
        } else if( vacio(F.apellido2.value) == false ) {   
                alert("Escribe el Apellido Materno del Doctor!")   
                return false   
        } 
           
}   
  
  
  
  
</script>  
<?php
$modulo = 'modificaMedicos.med';
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>


<?php

$sSQL= "SELECT *
  FROM
medicosForaneos
WHERE numMedico ='".$_POST['numMedico']."'
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($_POST['actualizar'] AND $_POST['numMedico']){
$sSQL1= "Select * From medicosForaneos WHERE numMedico = '".$_POST['numMedico']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['numMedico']){
if($_POST['numMedico']!=$myrow1['numMedico']){

$agrega = "INSERT INTO medicosForaneos (
nombre1,apellido1,apellido2,
numMedico,fechaNacimiento,
pais,telefono,cp,direccion,
ciudad,estado,medicoInterno,cedula,ctaContable,usuario
) values (
'".$_POST['nombre1']."','".$_POST['apellido1']."',
'".$_POST['apellido2']."',
'".$_POST['numMedico']."','".$_POST['fechaNacimiento']."',
'".$_POST['pais']."','".$_POST['telefono']."',
'".$_POST['cp']."','".$_POST['direccion']."','".$_POST['ciudad']."',
'".$_POST['estado']."','".$_POST['medicoInterno']."','".$_POST['cedula']."','".$_POST['ctaContable']."','".$usuario."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "MEDICO AGREGADO!"
</script>';
$sSQL= "Select * From medicosForaneos WHERE numMedico = '".$_POST['numMedico']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}} else {
$q = "UPDATE medicosForaneos set 
nombre1='".$_POST['nombre1']."', 
apellido1='".$_POST['apellido1']."',
apellido2='".$_POST['apellido2']."',
fechaNacimiento='".$_POST['fechaNacimiento']."',
pais='".$_POST['pais']."',
telefono='".$_POST['telefono']."',
cp='".$_POST['cp']."',
direccion='".$_POST['direccion']."',
ciudad='".$_POST['ciudad']."',
estado='".$_POST['estado']."',
medicoInterno = '".$_POST['medicoInterno']."',
cedula = '".$_POST['cedula']."',
ctaContable = '".$_POST['ctaContable']."',usuario = '".$usuario."'
WHERE 
numMedico='".$_POST['numMedico']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZARON DATOS!"
</script>';

$sSQL= "Select * From medicosForaneos WHERE numMedico = '".$_POST['numMedico']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}
}

if($_POST['borrar'] AND $_POST['numMedico']){
$borrame = "DELETE FROM medicosForaneos WHERE numMedico ='".$_POST['numMedico']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINARON DATOS!"
</script>';
$_POST['numMedico']="";
}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['numMedico']="";

$sSQL2= "Select max(numMedico) as tope From medicosForaneos";
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
.Estilo24 {font-size: 10px}
-->
</style>
</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
-->
</style>
<body>
<h1 align="center">Captura de M&eacute;dicos For&aacute;neos </h1>
<form id="form1" name="form1" method="post" action="" />
  <table width="502" border="1" align="center" class="style12">
    <tr>
      <th colspan="2" class="style12 style14" scope="col"><div align="left">N&uacute;mero de M&eacute;dico: </div></th>
      <th class="style12" scope="col"><div align="left">
	<?php  if($_POST['nuevo']){ ?>
      <input name="numMedico" type="text" class="style12" id="numMedico" value="<?php 
	  echo $torpe; ?>" 
	  size="60" />
      <?php } else  { ?>
	  <input name="numMedico" type="text" class="style12" id="numMedico" value="<?php echo $myrow['numMedico']; ?>" size="60" 
	  readonly=""/>
	  <?php } ?>
	  </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th width="228" class="style12" scope="col"><div align="left">Nombre1 :</div></th>
      <th width="240" class="style12" scope="col"><label>
        <div align="left">
          <input name="nombre1" type="text" class="style12" id="nombre1" value="<?php echo $myrow['nombre1']; ?>" size="60" />
        </div>
      </label></th>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido1:</td>
      <td class="style12"><input name="apellido1" type="text" class="style12" id="apellido1" value="<?php echo $myrow['apellido1']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Apellido2:</td>
      <td class="style12"><input name="apellido2" type="text" class="style12" id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Medico Especialista: </td>
      <td class="style12"><?php $interno= $myrow['medicoInterno']; ?>
        <label>
		<?php if($interno){ ?>
        <input name="medicoInterno" type="checkbox" class="style12" id="medicoInterno" value="yes" checked="checked" />
		<?php }else {?>
		<input name="medicoInterno" type="checkbox" class="style12" id="medicoInterno" value="no"/><?php
		 } 
		  ?>
		</label>    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Fecha de Nacimiento: </td>
      <td class="style12"><input name="fechaNacimiento" type="text" class="style12" id="fechaNacimiento" 
	  value="<?php echo $myrow['fechaNacimiento']?>" size="12" /> 
      formato: 00/00/0000 </td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Pa&iacute;s:</td>
      <td class="style12"><label>
      
		<SELECT id="pais" name="pais" width=227 STYLE="width: 230px; font-family: tahoma, arial; font-size: 11px">
		  <option value="<?php if($myrow['pais']){echo $myrow['pais'];} ?>"><?php if($myrow['pais']){echo $myrow['pais']."-->".$myrow['pais2'];} ?></option>
		  <option value="MEX">Mexico</option>
		  <option value="EU">EU</option>
		  <option value="VZ">Venezuela</option>
		</SELECT>
     
      </label></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Tel&eacute;fono:</td>
      <td class="style12"><input name="telefono" type="text" class="style12" id="telefono" value="<?php echo $myrow['telefono']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Direcci&oacute;n:</td>
      <td class="style12"><input name="direccion" type="text" class="style12" id="direccion" value="<?php echo $myrow['direccion']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">CP:</td>
      <td class="style12"><input name="cp" type="text" class="style12" id="cp" value="<?php echo $myrow['cp']; ?>" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Ciudad:</td>
      <td class="style12"><input name="ciudad" type="text" class="style12" id="ciudad" value="<?php echo $myrow['ciudad']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Estado:</td>
      <td class="style12"><input name="estado" type="text" class="style12" id="estado" value="<?php echo $myrow['estado']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">C&eacute;dula:</td>
      <td class="style12"><input name="cedula" type="text" class="style12" id="cedula" value="<?php echo $myrow['cedula']; ?>" size="60" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Centro de Costo: </td>
      <td class="style12"><label><span class="Estilo24">
      <?php //*********
$cmdstr1 = "select distinct ID_CCOSTO,NOMBRE from MATEO.CONT_CCOSTO WHERE DETALLE ='S' 
AND
ID_EJERCICIO='".$ID_EJERCICIOM."' AND
ID_CCOSTO LIKE '$ID_CCOSTOM%'
ORDER BY NOMBRE ASC";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 
?>
      </span>
        <select name="ctaContable" class="Estilo24" id="ID_CCOSTO"/>
    
        <?php if($myrow['ctaContable']){ ?>
        <option value="<?php echo $myrow['ctaContable']; ?>"><?php echo  $myrow['ctaContable']; ?></option>
        <?php } else {?>
        <option></option>
        <?php } ?>
        <option value="">---</option>
        <?php  	 		 
		    for ($i = 0; $i < $nrows1; $i++ ){
		    ?>
        <option value="<?php echo $results1['ID_CCOSTO'][$i]; ?>"><?php echo $results1['NOMBRE'][$i]." ".
" || ".$results1['ID_CCOSTO'][$i]; ?></option>
        <?php } 
		
		?>
        </select>
      </label></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td height="33" colspan="3"><label>
        <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" />
        <input name="borrar" type="submit" class="style12" id="borrar" value="Borrar" />
        <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar" />
      </label></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>