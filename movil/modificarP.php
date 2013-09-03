<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php


if($_POST['actualizar'] AND $_POST['numCliente'] and $_POST['nombre1'] and $_POST['apellido1']){
$sSQL1= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' order by keyPacientes DESC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$nCuenta=$myrow1['nCuenta']+1;
if(!$myrow1['numCliente']){

//***************inserto imagenes********************
$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
//    echo "Possible file upload attack!\n";
}
//**********************************************************



if($_POST['numCliente']!=$myrow1['numCliente']){
$sSQL2= "Select max(numCliente) as tope From pacientes";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$torpe = $myrow2['tope'];
$torpe+="1";
$nombreCompleto=strtoupper($_POST['nombre1'])." ".strtoupper($_POST['nombre2'])." ".strtoupper($_POST['apellido1'])." ".strtoupper($_POST['apellido2'])." ".strtoupper($_POST['apellido3']);
$agrega = "INSERT INTO pacientes (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,
ciudad,estado,colonia,religion,ecivil,rfc,seguro,poliza,edad,ruta,sexo,nombreCompleto,numero,fechaCreacion,
observacionesSexo,nCuenta
) values (
'".strtoupper($_POST['nombre1'])."','".strtoupper($_POST['nombre2'])."','".strtoupper($_POST['apellido1'])."',
'".strtoupper($_POST['apellido2'])."','".strtoupper($_POST['apellido3'])."',
'".$torpe."','".strtoupper($_POST['ocupacion'])."','".$_POST['fechaNacimiento']."',
'".strtoupper($_POST['pais1'])."','".$_POST['telefono']."','".strtoupper($_POST['calle'])."','".$_POST['cp']."',
'".strtoupper($_POST['ciudad'])."',
'".strtoupper($_POST['estado'])."','".strtoupper($_POST['colonia'])."','".strtoupper($_POST['religion'])."',
'".strtoupper($_POST['ecivil'])."','".strtoupper($_POST['rfc'])."','".strtoupper($_POST['seguro'])."','".$_POST['poliza']."','".$_POST['edad']."','".$uploadfile."',
'".strtoupper($_POST['sexo'])."','".$nombreCompleto."','".$_POST['numero']."','".$fecha1."',
'".strtoupper($_POST['observacionesSexo'])."','".$nCuenta."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "EL PACIENTE FUE AGREGADO A LA BASE DE DATOS"
</script>';
$sSQL= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$_GET['numeroExpediente']="";

}} else {
//***************inserto imagenes********************
$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
//    echo "Possible file upload attack!\n";
}
//**********************************************************
if($uploadfile=='images/'){
$uploadfile=$_POST['rutaImagen'];
}
$nombreCompleto=strtoupper($_POST['nombre1'])." ".strtoupper($_POST['nombre2'])." ".strtoupper($_POST['apellido1'])." ".strtoupper($_POST['apellido2'])." ".strtoupper($_POST['apellido3']);

$agrega = "INSERT INTO pacientes (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,
ciudad,estado,colonia,religion,ecivil,rfc,seguro,poliza,edad,ruta,sexo,nombreCompleto,numero,fechaCreacion,
observacionesSexo,nCuenta
) values (

'".strtoupper($_POST['nombre1'])."','".strtoupper($_POST['nombre2'])."','".strtoupper($_POST['apellido1'])."',
'".strtoupper($_POST['apellido2'])."','".strtoupper($_POST['apellido3'])."','".$_POST['numCliente']."',
'".strtoupper($_POST['ocupacion'])."','".$_POST['fechaNacimiento']."',
'".strtoupper($_POST['pais1'])."','".$_POST['telefono']."','".strtoupper($_POST['calle'])."','".$_POST['cp']."',
'".strtoupper($_POST['ciudad'])."',
'".strtoupper($_POST['estado'])."','".strtoupper($_POST['colonia'])."','".strtoupper($_POST['religion'])."',
'".strtoupper($_POST['ecivil'])."','".strtoupper($_POST['rfc'])."','".strtoupper($_POST['seguro'])."','".$_POST['poliza']."','".$_POST['edad']."','".$uploadfile."',
'".strtoupper($_POST['sexo'])."','".$nombreCompleto."','".$_POST['numero']."','".$fecha1."',
'".strtoupper($_POST['observacionesSexo'])."','".$nCuenta."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();

$q = "UPDATE pacientes set 
nombre1='".strtoupper($_POST['nombre1'])."', 
nombre2='".strtoupper($_POST['nombre2'])."',
apellido1='".strtoupper($_POST['apellido1'])."',
apellido2='".strtoupper($_POST['apellido2'])."',
apellido3='".strtoupper($_POST['apellido3'])."',
ocupacion='".strtoupper($_POST['ocupacion'])."',
fechaNacimiento='".strtoupper($_POST['fechaNacimiento'])."',
pais1='".strtoupper($_POST['pais1'])."',
telefono='".$_POST['telefono']."',
calle='".strtoupper($_POST['calle'])."',
cp='".$_POST['cp']."',
ciudad='".strtoupper($_POST['ciudad'])."',
estado='".strtoupper($_POST['estado'])."',
colonia='".strtoupper($_POST['colonia'])."',
religion='".strtoupper($_POST['religion'])."',
ecivil='".strtoupper($_POST['ecivil'])."',
rfc='".strtoupper($_POST['rfc'])."',
seguro='".$_POST['seguro']."',
poliza='".$_POST['poliza']."',
edad='".$_POST['edad']."',
ruta='".$uploadfile."',
numero='".$_POST['numero']."',
sexo='".strtoupper($_POST['sexo'])."',
observacionesSexo='".strtoupper($_POST['observacionesSexo'])."',
nombreCompleto='".$nombreCompleto."'
WHERE 
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "EL PACIENTE FUE ACTUALIZADO"
</script>';


$sSQL= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' order by keyPacientes DESC ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$_GET['numeroExpediente']="";
}
}

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM pacientes WHERE numCliente ='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "EL PACIENTE FUE ELIMINADO"
</script>';
}


if(($_POST['numCliente'] or $_GET['numeroExpediente']) AND !$_POST['nuevo']){
if($_GET['numeroExpediente']){
$_POST['numCliente']=$_GET['numeroExpediente'];
}

$sSQL= "Select  * From pacientes WHERE numCliente = '".$_POST['numCliente']."' order by keyPacientes DESC  ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}

?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 


<script language="javascript" type="text/javascript">   

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
           
        if( vacio(F.nombre1.value) == false ) {   
                alert("Por Favor, escoje el nombre del paciente!")   
                return false   
        } else if( vacio(F.apellido1.value) == false ) {   
                alert("Por Favor, escribe el apellido paterno del paciente!")   
                return false   
        } else if( vacio(F.apellido2.value) == false ) {   
                alert("Por Favor, escribe el apellido materno del paciente!")   
                return false   
        }            
}   
  
  
  
  
</script>


<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
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
<style type="text/css">
<!--
.style15 {color: #FFFFFF}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style14 {
	color: #0000FF;
	font-weight: bold;
}
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
-->
</style>
</head>
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="js/lightboxXL.js" type="text/javascript"></script>


<style type="text/css">
<!--
.style12 {font-size: 10px}
-->
</style>
<body>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
<p align="center"><a href="/sima/movil/principal.php"><span class="style7">Regresar a Men&uacute;</span></a>
  <?php if($myrow['ruta']!='images/' AND $myrow['ruta']){ ?>
</p>
<p align="center">  <a href="<?php 

echo $myrow['ruta']; 

?>" rel="lightbox" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>">
  

  <img src="<?php echo $myrow['ruta']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="150" height="113" border="0" />
 </a></p>
<?php } ?>
  <table width="546" border="0" align="center" class="style7">
    <tr>
      <th class="style12" scope="col"><div align="left" class="style7">Exp</div></th>
      <th class="style12" scope="col">        <div align="left">
          <input name="numCliente" type="text" class="style12" id="numCliente4" 
		value="<?php 
if($myrow['numCliente'] and !$_POST['nuevo']){ 
echo $myrow['numCliente']; 
} else  if($_POST['nuevo'] or !$myrow['numCliente']){
		echo $myrow2['tope']; 
}
?>"	size=" size="20"" readonly=""60 />
          <?php 
	$sSQL2= "Select max(numCliente)+1 as tope From pacientes";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$torpe = $myrow2['tope'];
	
	?>
      </div></th>
    </tr>
    <tr>
      <th width="60" class="style12" scope="col"><div align="left">1er. Nombre </div></th>
      <th width="230" class="style12" scope="col"><label>
        <div align="left">
          <input name="nombre1" type="text" class="style12" id="nombre1" value="<?php echo $myrow['nombre1']; ?>" size="20" />
        </div>
      </label></th>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">2&deg; Nombre :</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="nombre2" type="text" class="style12" id="nombre2" value="<?php echo $myrow['nombre2']; ?>" size="20" /></td>
    </tr>
    <tr>
      <td class="style12">Paterno:</td>
      <td class="style12"><input name="apellido1" type="text" class="style12" id="apellido1" value="<?php echo $myrow['apellido1']; ?>" size="20" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Materno:</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="apellido2" type="text" class="style12" id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="20" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Nacimiento: </span></td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="fechaNacimiento" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php if($myrow['fechaNacimiento']){
	  echo $myrow['fechaNacimiento'];
	  } else {
	   
	  } ?>" size="20" />
        <label>
        <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
formato: a&ntilde;o</label>-mes-dia
      </span></td>
    </tr>
    <tr>
      <td class="style12">Edad</td>
      <td class="style12"><span class="Estilo24">
        <input name="edad" type="text" class="Estilo24" id="edad" value="<?php echo $myrow['edad']; ?>" size="2" maxlength="2" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Estado Civil </span></td>
      <td bgcolor="#FFCCFF" class="style12"><select name="ecivil" class="style12" id="ecivil">
        <option value="<?php echo $myrow['ecivil']; ?>"><?php echo $myrow['ecivil']; ?></option>
        <option>---</option>
        <option value="soltero">Soltero</option>
        <option value="casado">Casado</option>
        <option value="viudo">Viudo</option>
		 <option value="Union Libre">Union Libre</option>
        <option value="otro">Otro</option>
      </select></td>
    </tr>
    <tr>
      <td class="style12">Sexo: </td>
      <td class="style12"><select name="sexo" class="style12" id="select">
        <option value="<?php echo $myrow['sexo']; ?>"><?php echo $myrow['sexo']; ?></option>
        <option>---</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
        <option value="Homosexual Hombre">Homosexual Hombre</option>
        <option value="Homosexual Mujer">Homosexual Mujer</option>
      </select></td>
    </tr>
    <tr>
      <td class="style12">Observaciones:</td>
      <td class="style12"><label>
        <textarea name="observacionesSexo" cols="20" class="style12" id="observacionesSexo"><?php echo $myrow['observacionesSexo']; ?></textarea>
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12"><span class="Estilo24">Calle:</span></td>
      <td class="style12"><textarea name="calle" cols="20" rows="3" class="style12" id="calle"><?php echo $myrow['calle']; ?></textarea></td>
    </tr>
    <tr>
      <td class="style12">N&uacute;mero</td>
      <td class="style12"><input name="numero" type="text" class="style12" id="numero" value="<?php echo $myrow['numero']; ?>" size="6" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Colonia:</span></td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <textarea name="colonia" cols="20" rows="3" class="Estilo24" id="colonia"><?php echo $myrow['colonia']; ?></textarea>
      </span></td>
    </tr>
    <tr>
      <td class="style12"><span class="Estilo24">CP:</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="cp" type="text" class="Estilo24" id="cp" value="<?php echo $myrow['cp']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Ciudad:</span></td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="ciudad" type="text" class="Estilo24" id="ciudad" value="<?php echo $myrow['ciudad']; ?>" size="20" />
      </span></td>
    </tr>
    <tr>
      <td class="style12"><span class="Estilo24">Estado:</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="estado" type="text" class="Estilo24" id="estado" value="<?php echo $myrow['estado']; ?>" size="20" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Pa&iacute;s:</span></td>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
        <input name="pais" type="text" class="style12" id="pais" value="<?php 
		if(!$myrow['pais']){
		echo "mex";
		} else {
		echo $myrow['pais']; }?>" size="20" />
      </span></td>
    </tr>
    <tr>
      <td class="style12"><span class="Estilo24">Tel&eacute;fono:</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="telefono" type="text" class="Estilo24" id="telefono" value="<?php echo $myrow['telefono']; ?>" size="20" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Religi&oacute;n:</span></td>
      <td bgcolor="#FFCCFF" class="style12"><input name="religion" type="text" class="style12" id="religion" value="<?php echo $myrow['religion']; ?>" size="20" /></td>
    </tr>
    <tr>
      <td class="style12"><span class="Estilo24">Ocupaci&oacute;n</span></td>
      <td class="style12"><span class="Estilo24">
        <input name="ocupacion" type="text" class="Estilo24" id="ocupacion" value="<?php echo $myrow['ocupacion']; ?>" size="20" />
      </span></td>
    </tr>
    <tr>
      <td bgcolor="#660066" class="style15">Subir im&aacute;gen: </td>
      <td bgcolor="#660066" class="style12"><input type="hidden" name="MAX_FILE_SIZE" value="300000000000" />
        <!-- Name of input element determines name in $_FILES array -->
        <input name="userfile" type="file" class="style12"  value="<?php echo $myrow['ruta']; ?>" /></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12"><input name="nuevo" type="submit" class="style12" id="nuevo2" value="Nuevo"  />
        <input name="actualizar" type="submit" class="style12" id="actualizar2" value="Modificar/Grabar"  />
        <input name="rutaImagen" type="hidden" id="rutaImagen2" value="<?php echo $myrow['ruta']; ?>"  />
	   <!-- MAX_FILE_SIZE must precede the file input field -->    </td>
    </tr>
  </table>
</form>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
<p>&nbsp;</p>
</body>
 </html>
