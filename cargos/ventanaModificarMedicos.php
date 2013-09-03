<?php require("/configuracion/ventanasEmergentes.php");?>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Ivan Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Codigo: www.elcodigo.com   
  
  
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
                alert("Escribe el numero de codigo para el doctor presionando NUEVO, y a HLC agregale su numero!")   
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
function ventanaSecundaria31 (URL){ 
   window.open(URL,"ventana31","width=500,height=500,scrollbars=YES") 
} 
</script> 
<?php


$sSQL= "SELECT *
  FROM
medicosantibioticos
WHERE 
keyMedico='".$_GET['keyMedico']."' 
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);





if($_POST['actualizar']  and  $_POST['cedula']){
  $sSQL1= "Select * From medicosantibioticos WHERE keyMedico='".$_GET['keyMedico']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


//***************inserto imagenes********************
$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
//    echo "Possible file upload attack!\n";
}
//**********************************************************

$nombreCompleto=$_POST['nombre1'].' '.$_POST['apellido1'].' '.$_POST['apellido2'];




if(!$myrow1['keyMedico']){




$agrega = "INSERT INTO medicosantibioticos (
nombre1,apellido1,apellido2,
fechaNacimiento,
pais,telefono,cp,direccion,
ciudad,estado,medicoInterno,cedula,ctaContable,usuario,tipoMedico,status,ruta,entidad,especialidad,nombreCompleto,universidad
) values (
'".$_POST['nombre1']."','".$_POST['apellido1']."',
'".$_POST['apellido2']."',
'".$_POST['fechaNacimiento']."',
'".$_POST['pais']."','".$_POST['telefono']."',
'".$_POST['cp']."','".$_POST['direccion']."','".$_POST['ciudad']."',
'".$_POST['estado']."','".$_POST['medicoInterno']."','".$_POST['cedula']."','".$_POST['ctaContable']."','".$usuario."',
'".$_POST['tipoMedico']."','".$_POST['status']."','".$uploadfile."','".$entidad."','".$_POST['especialidad']."','".$nombreCompleto."','".$_POST['universidad']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script>
window.alert( "SE AGREGO EL MEDICO!");
window.opener.document.forms["form1"].submit();
window.close();
</script>';





$sSQL= "Select * From medicosantibioticos WHERE entidad='".$entidad."' AND cedula = ' ".$myrow333['conta']." ' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
} else {
//***************inserto imagenes********************
$uploaddir = 'images/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    //echo "File is valid, and was successfully uploaded.\n";
} else {
    //echo "Possible file upload attack!\n";
}
if($uploadfile=='images/'){
$uploadfile=$_POST['rutaImagen'];
}
//**********************************************************
$q = "UPDATE medicosantibioticos set

    nombreCompleto='".$nombreCompleto."',
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
especialidad = '".$_POST['especialidad']."',
cedula = '".$_POST['cedula']."',
ctaContable = '".$_POST['ctaContable']."',usuario = '".$usuario."',
tipoMedico='".$_POST['tipoMedico']."',
status='".$_POST['status']."',
ruta='".$uploadfile."',
 universidad='".$_POST['universidad']."'
WHERE 
keyMedico='".$_GET['keyMedico']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script>
window.alert( "SE ACTUALIZARON DATOS!");
window.opener.document.forms["form1"].submit();
window.close();
</script>';

$sSQL= "Select * From medicosantibioticos WHERE entidad='".$entidad."' AND cedula = '".$_POST['cedula']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}
}














if($_POST['borrar'] AND $_GET['keyMedico']){
$borrame = "DELETE FROM medicosantibioticos WHERE keyMedico='".$_GET['keyMedico']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script>
window.alert( "SE ELIMINARON DATOS!");
</script>';

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="image/gif; charset=iso-8859-1" />
<title></title>

<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>

<body onLoad="MM_preloadImages('/sima/imagenes/bordestablas/btns/newbtn.png')">
<h1 align="center" class="titulos"> Alta de Medicos<br />
<br />
</h1><form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >
<table width="348" >
<tr>
         
       
        
    <td width="115" align="right"><div align="center">
      <input name="nuevo" type="Submit" src='/sima/imagenes/bordestablas/btns/newbtn.png' id="nuevo" value="Nuevo" />
     </td>
    <td width="118" align="right"><div align="center"><input name="actualizar" type="Submit" src='/sima/imagenes/bordestablas/btns/refreshbtn.png' class="Estilo24" id="actualizar" value="Modificar/Grabar" />
    </div></td>
    <td width="115" align="right"><div align="center"> <input name="borrar" type="Submit" src='/sima/imagenes/bordestablas/btns/deletebtn.png' id="borrar" value="Borrar"  disabled="disabled"/></div></td>
  </tr>

</table>
    <br></br>


<table width="618" class="table-forma" >

        <tr valign="top" >
          <td    scope="col">&nbsp;</td>
          <td   scope="col"><div align="center">
                   <blink>CEDULA PROFESIONAL </blink>
                      
                      <?php echo $myrow['cedula'];?>
                      <input name="cedula" value="<?php echo $myrow['cedula'];?>" type="text" ></input>
           
              </div>
              
          </td>
   <td   >&nbsp;</td>
    </tr>
    <tr >
      <th colspan="3"  scope="col"><div align="left" class="">
        <div align="center" class="negromid">Datos Generales</div>
      </div>        </th>
    </tr>
    <tr >
      <td   >&nbsp;</td>
<td   >&nbsp;</td>
      <td width="162" rowspan="7" align="center" valign="middle" scope="col"><?php 

if($myrow['ruta'] and $route='/sima/ADMINHOSPITALARIAS/medicos/'.$myrow['ruta']){

?>
        <a href="javascript:ventanaSecundaria31('ventanaImagenMedicos.php?route=<?php echo $route;?>')" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" class="style15" rel="lightbox" tag="IMG"> <img src="<?php echo $myrow['ruta']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="162" height="169" border="0" /> </a>
        <?php } ?></td>
    </tr>
    <tr >
      <td width="149"  scope="col"><div align="left">Nombres</div></td>
    <td width="270"  scope="col"><label>
<div align="left">
            <input name="nombre1" type="text"  id="nombre1" value="<?php echo $myrow['nombre1']; ?>" size="25" />
        </div>
      </label></td>
 
    </tr>
    <tr >
      <td >Primer Apellido</td>
      <td ><input name="apellido1" type="text"  id="apellido1" value="<?php echo $myrow['apellido1']; ?>" size="20" /></td>
     
    </tr>
    <tr >
      <td >Segundo Apellido</td>
      <td ><input name="apellido2" type="text" id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="20" /></td>
 
    </tr>
    <tr >
      <td >Medico Especialista </td>
      <td ><?php $interno= $myrow['medicoInterno']; ?>
        <label>
        <?php if($interno){ ?>
        <input name="medicoInterno" type="checkbox"  id="medicoInterno" value="yes" checked="checked" />
        <?php }else {?>
        <input name="medicoInterno" type="checkbox"  id="medicoInterno" value="no"/>
        <?php
		 } 
		  ?>
        </label></td>
  
    </tr>
    <tr>
      <td >Especialidad</td>
      <td >
      	  <?php 
$aCombo= "Select * From especialidades where 
entidad='".$entidad."'  
and
subEspecialidad='no'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); 

?>


		 <select name="especialidad" class="<?php echo $estilo;?>" id="especialidad"  />        
     
  <option value="" >Escoje</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		?>
        <option 
		<?php 
if($myrow['especialidad']==$resCombo['codigo']){
		
		echo 'selected="selected"';		
		}  ?>
		value="<?php echo $resCombo['codigo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>      </td>
    </tr>
        <tr>
      <td >Universidad</td>
      <td ><input name="universidad" type="text"  id="fechaNacimiento" 
	  value="<?php echo $myrow['universidad']?>" size="30" />
      </td>
    </tr>
    
    <tr>
      <td >Fecha de Nacimiento </td>
      <td ><input name="fechaNacimiento" type="text"  id="fechaNacimiento" 
	  value="<?php echo $myrow['fechaNacimiento']?>" size="12" />
      formato: 2009-01-01 </td>
    </tr>
    <tr>
      <th height="20" colspan="3" ><div align="center">Informaci&oacute;n Adicional</div></th>
    </tr>
    
    <tr>
      <td >Tel&eacute;fono</td>
      <td ><input name="telefono" type="text"  id="telefono" value="<?php echo $myrow['telefono']; ?>" size="15" /></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Direcci&oacute;n</td>
      <td ><input name="direccion" type="text"  id="direccion" value="<?php echo $myrow['direccion']; ?>" size="45" /></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >C&oacute;digo Postal</td>
      <td ><input name="cp" type="text"  id="cp" value="<?php echo $myrow['cp']; ?>" /></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Ciudad</td>
      <td ><input name="ciudad" type="text"  id="ciudad" value="<?php echo $myrow['ciudad']; ?>" size="25" /></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Estado</td>
      <td ><input name="estado" type="text"  id="estado" value="<?php echo $myrow['estado']; ?>" size="15" /></td>
      <td >&nbsp;</td>
    </tr>

    
    <tr>
      <td >Centro de Costo</td>
      <td ><label>
      <input name="ctaContable" type="text"  id="ctaContable" 
	   value ="<?php echo $myrow['ctaContable']?>" readonly=""/>
      <input name="ID_CCOSTO" type="submit"  id="ID_CCOSTO"  onclick="javascript:ventanaSecundaria1('/sima/cargos/ctoCosto.php?numeroE=<?php echo $numPaciente; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;campoSeguro=<?php echo "ctaContable"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')" value="C" />
</select>
      </label></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Subir im&aacute;gen </td>
      <td ><!-- Name of input element determines name in $_FILES array -->
      <input name="userfile" type="file"   value="<?php echo $myrow['ruta']; ?>"/></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Status</td>
      <td ><label>
        <select name="status" >
		 <?php if($myrow['status']){ ?>
		 <option value="<?php echo $myrow['status']; ?>"><?php echo $myrow['status']; ?></option>
		 <option value="">---</option>
		 <?php } ?>
          <option value="A">Activo</option>
          <option value="I">Inactivo</option>
        </select>
      </label></td>
      <td >&nbsp;</td>
    </tr>

  </table>
  

  
</form>
</body>
</html>
