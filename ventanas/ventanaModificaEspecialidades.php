<?php include('/configuracion/ventanasEmergentes.php');?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
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
                alert("Escribe el n�mero de c�digo para el doctor presionando NUEVO, y a HLC agregale su n�mero!")   
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
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<?php



if($_POST['actualizar'] AND $_POST['codigo'] and $_POST['descripcion']){
$sSQL1= "Select keyEsp From especialidades WHERE  entidad='".$entidad."' and codigo = '".$_POST['codigo']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);



if(!$_POST['subEspecialidad']){
$_POST['subEspecialidad']='no';
}



if(!$myrow1['keyEsp']){
$agrega = "INSERT INTO especialidades (
codigo,descripcion,fecha1,hora1,usuario,entidad,subEspecialidad,especialidadPrincipal
) values (
'".$_POST['codigo']."','".$_POST['descripcion']."','".$fecha1."','".$hora1."','".$usuario."','".$entidad."','".$_POST['subEspecialidad']."','".$_POST['especialidad']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Se agreg� la especialidad '.$_POST['descripcion'];
echo '<script type="text/vbscript">
msgbox "ESPECIALIDAD AGREGADA!"
</script>';

} else {

//**********************************************************
$q = "UPDATE especialidades set 
descripcion='".$_POST['descripcion']."', 
hora1='".$hora1."',
fecha1='".$fecha1."',
usuario = '".$usuario."',
subEspecialidad='".$_POST['subEspecialidad']."',
especialidadPrincipal='".$_POST['especialidad']."'
where
codigo = '".$_POST['codigo']."' and entidad='".$entidad."'";


mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se actualiz� la especialidad '.$_POST['descripcion'];
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO LA ESPECIALIDAD!"
</script>';

}
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>';
}



if($_POST['delete'] AND $_POST['codigo']){
$borrame = "DELETE FROM especialidades WHERE entidad='".$entidad."' AND codigo ='".$_POST['codigo']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ELIMINARON DATOS!"
</script>';
$_POST['numMedico']="";
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>';
}



if(!$_POST['nuevo']){
$sSQL2= "Select * From especialidades where entidad='".$entidad."' and 
(codigo='".$_POST['codigo']."' or codigo='".$_GET['codigo']."')";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<h1 align="center">Especialidades M&eacute;dicos </h1>
<form id="form1" name="form1" method="post" action=""  >
  <table width="451" class="table-forma">
    <tr>
      <td  scope="col"><div align="left">C&oacute;digo Especialidad </div></td>
      <td scope="col"><label>
          <div align="left">
            <label>
            <input name="codigo" type="text"  id="codigo" value="<?php echo $myrow2['codigo'];?>" />
            </label>
          </div>
        </label></td>
    </tr>
    <tr>
      <td width="119"   scope="col"><div align="left">Descripci&oacute;n Especialidad </div></td>
      <td width="209"   scope="col"><label>
        <div align="left">
          <textarea name="descripcion" rows="3"  id="descripcion"><?php echo $myrow2['descripcion']?></textarea>
        </div>
      </label></td>
    </tr>
    <tr>
      <td height="33"><div align="left">Es sub-Especialidad ? </div></td>
      <td height="33"><input name="subEspecialidad" type="checkbox" id="referido" value="si"
		<?php if($myrow2['subEspecialidad']=='si' ){
		echo 'checked="checked"';
		}
		?>/></td>
    </tr>
    <tr>
      <td height="33"><div align="left"> Especialidad Principal (Si es sub) </div></td>
      <td height="33"><?php 
include('/configuracion/componentes/comboEspecialidades.php');
$listaEsp=new especialidades();
$listaEsp->listaEspecialidadesMedicasSS($entidad,'style12',$myrow2['especialidad'],$_POST['especialidad'],$basedatos);
?></td>
    </tr>
    <tr>
  
      <td height="43" colspan="2"><p align="center"><input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
        <label>
        <input name="delete" type="submit"  id="delete" value="Borrar" />
        </label>
        <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar" />
        <label>
        <input type="hidden" name="keyEsp" value="<?php echo $_POST['keyEsp'];?>" />
        </label></p></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>&nbsp;</p>
</body>
</html>
