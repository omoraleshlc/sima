<?PHP include("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php"); ?>
<?php include('/configuracion/clases/validaModulos.php'); ?>
<?php
















if($_POST['actualizar'] and $_POST['descripcion'] and $_POST['codigoCB'] ){


$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
   


$sSQL1= "Select  * From CB WHERE codigoCB = '".$_POST['codigoCB']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['keyCB']){

//***************inserto imagenes********************


//**********************************************************


$agrega = "INSERT INTO CB (codigoCB,
descripcion,ruta,entidad) values ('".$_POST['codigoCB']."',
'".$_POST['descripcion']."','".$uploadfile."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO EL CODIGO DE BARRA"
</script>';


} else {




$q = "UPDATE CB set 
descripcion='".$_POST['descripcion']."',
ruta='".$uploadfile."'
WHERE 
codigoCB='".$_POST['codigoCB']."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "YA EXISTE ESE CODIGO DE BARRA, ASIGNA OTRO CODIGO PARA ESOS MATERIALES"
</script>';
}
} else {
echo '<script type="text/vbscript">
msgbox "VERIFICA TU IMAGEN, NO SE PUDO ANEXAR ESTE CODIGO DE BARRAS!"
</script>';

}
}














?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=570,height=600,scrollbars=YES") 
} 
</script> 
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
<p>&nbsp;</p>
<div align="center" class="style14"><strong>Asignar C&oacute;digo de Barra al Inventario </strong></div>
<?php
$checaModuloScript= "Select * From CB WHERE entidad='".$entidad."' AND codigoCB='".$_POST['codigoCB']."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$myrow = mysql_fetch_array($resScript);
?>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
  <p align="center">
<a href="<?php 
if($myrow['ruta']){
echo $myrow['ruta']; 
}
?>" rel="lightbox" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>">
<?php if($myrow['ruta']){?>
<img src="<?php echo $myrow['ruta']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="150" height="113" border="0" />
 <?php } ?>
 </a></p>
  <table width="536" border="0" align="center" class="style12">
    <tr>
      <th class="style12" scope="col">&nbsp;</th>
      <th class="style12" scope="col"><div align="left">C&oacute;digo CB </div></th>
      <th class="style12" scope="col"><div align="left">
        <input name="codigoCB" type="text" class="Estilo24" id="codigoCB" value="<?php echo $_POST['codigoCB']; ?>" size="60" />
      </div></th>
    </tr>
    <tr>
      <th width="12" bgcolor="#FFCCFF" class="style12" scope="col">+</th>
      <th width="160" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">Descripci&oacute;n :</div></th>
      <th width="350" bgcolor="#FFCCFF" class="style12" scope="col"><label>
        <div align="left">
          <textarea name="descripcion" cols="60" class="style12" id="descripcion"><?php echo $_POST['descripcion']; ?></textarea>
        </div>
      </label></th>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">Subir im&aacute;gen: </td>
      <td class="style12">
	   <!-- MAX_FILE_SIZE must precede the file input field -->
	
    <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
    <!-- Name of input element determines name in $_FILES array -->
    <input name="userfile" type="file" class="style12"  value="<?php echo $myrow['ruta']; ?>"/></td>
    </tr>
    <tr>
      <td height="33" colspan="3" bgcolor="#FFCCFF"><label>
        <input name="nuevo" type="submit" class="style12" id="nuevo" value="Nuevo" />
        <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar" />
        <span class="Estilo24">
        <input name="consultas" type="submit" class="Estilo24" id="consultas"  onclick="javascript:ventanaSecundaria('despliegaCB.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="Consultar" />
        <input name="consultas2" type="submit" class="Estilo24" id="consultas2"  onclick="javascript:ventanaSecundaria2('/sima/ADMINHOSPITALARIAS/inventarios/barcode/index.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="Generar C&oacute;digo de Barra" />
        </span>
        <input name="rutaImagen" type="hidden" id="rutaImagen" value="<?php echo $myrow['ruta']; ?>" />
      </label></td>
    </tr>
  </table>
</form>

<p>&nbsp;</p>
</body>
</html>
