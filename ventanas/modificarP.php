<?php require("/configuracion/ventanasEmergentes.php"); include('/configuracion/funciones.php');?>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librera principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librera para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script>
function cerrarVentana(){
close();
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

<!-- set focus to a field with the name "searchcontent" in my form -->
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
        status = "Este campo slo acepta nmeros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<?php
$descripcionA='Consultar el expediente: '.$_GET['numeroExpediente'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


if($_POST['actualizar'] and $_POST['nombre1'] and $_POST['apellido1']){
    
$sSQL1= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);


$sSQL1a= "Select descripcion From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_GET['almacen']."'";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);

$sSQL1b= "Select * From entidades WHERE codigoEntidad='".$entidad."' ";
$result1b=mysql_db_query($basedatos,$sSQL1b);
$myrow1b = mysql_fetch_array($result1b);


if($_POST['jubilado']){
$jubilado=$_POST['jubilado'];
$descripcionA='Consultar el expediente y activa la opcion de jubilado: '.$_GET['numeroExpediente'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
} else {
if($myrow1['jubilado']=='si'){
$q = "DELETE FROM porcentajeJubilados WHERE keyPacientes = '".$myrow1['keyPacientes']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
if(!$_POST['jubilado']){
echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form1"].submit();
close();
  // -->
</script>';
}
}
$jubilado='no';

}



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



if(!$myrow1['numCliente']){
$numeroExp=new generarExpedientes();
$torpe=$numeroExp-> generaExpediente($reservado1,$reservado,$usuario,$entidad,$basedatos);

$nombreCompleto=strtoupper($_POST['nombre1'])." ".strtoupper($_POST['nombre2'])." ".strtoupper($_POST['apellido1'])." ".strtoupper($_POST['apellido2'])." ".strtoupper($_POST['apellido3']);
$agrega = "INSERT INTO pacientes (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,
ciudad,estado,colonia,religion,ecivil,rfc,seguro,poliza,edad,ruta,sexo,nombreCompleto,numero,fechaCreacion,
observacionesSexo,nCuenta,entidad,usuario,jubilado,curp,numEmpleado,numMatricula,beneficencia,almacen,descripcionAlmacen,descripcionEntidad
) values (
'".strtoupper($_POST['nombre1'])."','".strtoupper($_POST['nombre2'])."','".strtoupper($_POST['apellido1'])."',
'".strtoupper($_POST['apellido2'])."','".strtoupper($_POST['apellido3'])."',
'".$torpe."','".strtoupper($_POST['ocupacion'])."','".cambia_a_mysql($_POST['fechaNacimiento'])."',
'".strtoupper($_POST['pais1'])."','".$_POST['telefono']."','".strtoupper($_POST['calle'])."','".$_POST['cp']."',
'".strtoupper($_POST['ciudad'])."',
'".strtoupper($_POST['estado'])."','".strtoupper($_POST['colonia'])."','".strtoupper($_POST['religion'])."',
'".strtoupper($_POST['ecivil'])."','".strtoupper($_POST['rfc'])."','".strtoupper($_POST['seguro'])."',
'".$_POST['poliza']."','".$_POST['edad']."','".$uploadfile."',
'".strtoupper($_POST['sexo'])."','".$nombreCompleto."','".$_POST['numero']."','".$fecha1."',
'".strtoupper($_POST['observacionesSexo'])."','".$nCuenta."','".$entidad."','".$usuario."','".$jubilado."','".$_POST['curp']."',
'".$_POST['numEmpleado']."','".$_POST['numMatricula']."',
'".$_POST['beneficencia']."','".$_POST['almacen']."','".$myrow1a['descripcion']."','".$myrow1b['descripcionEntidad']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error(); 


$descripcionA='CREO EL PACIENTE: '.$nombrecompleto.' con el expediente: '.$torpe.' y la beneficencia: '.$_POST['beneficencia'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


if($_GET['firstTime']=='yes'){

$q = "UPDATE clientesInternos set 
paciente='".$nombreCompleto."',
numeroE='".$torpe."',
nCuenta='1',
expediente='si',
primeraVez='si'

WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script>

   window.opener.document.forms["form1"].submit();


</script>';
}
?>
<script >
window.alert( "SE CREO EL EXPEDIENTE <?php echo $torpe;?>");
window.close();
</script>
<?php 
echo "SE CREO EL EXPEDIENTE ".$torpe;
$sSQL= "Select  * From pacientes WHERE entidad='".$entidad."' and numCliente = '".$_POST['numCliente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

if($_POST['expediente']=='si' and $_POST['keyClientesInternos']){
$q = "UPDATE clientesInternos set 

numeroE='".$torpe."'

WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script>

   window.opener.document.forms["form1"].submit();
window.close();

</script>';
}


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

$agrega = "INSERT INTO pacientesHistoria (
nombre1,nombre2,apellido1,apellido2,apellido3,
numCliente,ocupacion,fechaNacimiento,
pais1,telefono,calle,cp,
ciudad,estado,colonia,religion,ecivil,rfc,seguro,poliza,edad,ruta,sexo,nombreCompleto,numero,fechaCreacion,
observacionesSexo,nCuenta,entidad
) values (

'".strtoupper($_POST['nombre1'])."','".strtoupper($_POST['nombre2'])."','".strtoupper($_POST['apellido1'])."',
'".strtoupper($_POST['apellido2'])."','".strtoupper($_POST['apellido3'])."','".$_POST['numCliente']."',
'".strtoupper($_POST['ocupacion'])."','".$_POST['fechaNacimiento']."',
'".strtoupper($_POST['pais1'])."','".$_POST['telefono']."','".strtoupper($_POST['calle'])."','".$_POST['cp']."',
'".strtoupper($_POST['ciudad'])."',
'".strtoupper($_POST['estado'])."','".strtoupper($_POST['colonia'])."','".strtoupper($_POST['religion'])."',
'".strtoupper($_POST['ecivil'])."','".strtoupper($_POST['rfc'])."','".strtoupper($_POST['seguro'])."','".$_POST['poliza']."','".$_POST['edad']."','".$uploadfile."',
'".strtoupper($_POST['sexo'])."','".$nombreCompleto."','".$_POST['numero']."','".$fecha1."',
'".strtoupper($_POST['observacionesSexo'])."','".$nCuenta."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$q = "UPDATE pacientes set
beneficencia='".$_POST['beneficencia']."',
curp='".strtoupper($_POST['curp'])."', 
nombre1='".strtoupper($_POST['nombre1'])."', 
nombre2='".strtoupper($_POST['nombre2'])."',
apellido1='".strtoupper($_POST['apellido1'])."',
apellido2='".strtoupper($_POST['apellido2'])."',
apellido3='".strtoupper($_POST['apellido3'])."',
ocupacion='".strtoupper($_POST['ocupacion'])."',
fechaNacimiento='".cambia_a_mysql($_POST['fechaNacimiento'])."',
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
numEmpleado='".$_POST['numEmpleado']."',
numMatricula='".$_POST['numMatricula']."',
nombreCompleto='".$nombreCompleto."',
usuario='".$usuario."',fechaModificacion='".$fecha1."',jubilado='".$jubilado."'
WHERE 
numCliente='".$_POST['numCliente']."' and entidad='".$entidad."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
//echo 'El paciente fue actualizado';
echo '<script >
window.alert( "EL PACIENTE FUE ACTUALIZADO");
   window.opener.document.forms["form1"].submit();
window.close();
</script>';

if($jubilado=='si' or $_GET['firstTime']=='yes'){
echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form1"].submit();
close();
  // -->
</script>';
}


$sSQL= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

$_GET['numeroExpediente']="";
} 
 }

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM pacientes WHERE entidad='".$entidad."' and numCliente ='".$_POST['numCliente']."'";
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

if($torpe){
$sSQL= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente='".$torpe."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

}else{
$sSQL= "Select  * From pacientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
}
}

?>





<script language=javascript> 
function ventanaSecundaria13 (URL){ 
   window.open(URL,"ventana13","width=500,height=500,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=450,height=390,scrollbars=YES") 
} 
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>
	<link rel="stylesheet" href="../js/css/lightbox.css" type="text/css" media="screen" />
	<script src="../js/prototype.js" type="text/javascript"></script>
	<script src="../js/scriptaculous.js?load=effects" type="text/javascript"></script>
	<script src="../js/lightboxXL.js" type="text/javascript"></script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>

<body>

<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data" >

<h1 align="center">Datos Personales del Paciente </h1>
<table width="606" class="table-forma">
    <tr >
      <td height="21" colspan="3"  scope="col"><div align="center" >
        
   &nbsp;
      </div></td>
    </tr>
    <tr>
      
	  
	  <td   scope="col"><div align="left" class="normal">Expediente</div></td>
      <td   scope="col"><div align="left"><span class="normal">
	  <?php if($myrow['numCliente']){?>
        <input name="numCliente" type="text" id="numCliente" 
		value="<?php echo $myrow['numCliente'];?>"	 readonly=""  class="normal" />
			  <?php } else{ echo 'No existe';}?>
      </span></div></td>

	  
      <td width="210" rowspan="10" align="center" valign="top" bgcolor="#ffffff"  scope="col"><p align="center">
        <?php if($myrow['ruta']!='images/' AND $myrow['ruta']){ ?>
        <a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>">

<img src="<?php echo $myrow['ruta']; ?>"
 alt="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>" width="136" height="151" border="2" /></a>
 
 <a href="<?php 

echo $myrow['ruta']; 

?>" tag="IMG" title="<?php echo $myrow['nombre1']." ".$myrow['apellido1']; ?>"></a></p>
        <?php } 
		else {?>
			
            <img src='../imagenes/images/universal.gif' width="136" height="151">
            
			<?php } 
		?>		</td>
    </tr>
    <tr>
	
      <td width="128"   scope="col"><div align="left" >Primer Nombre </div></td>
      <td width="262"   scope="col"><label>
        <div align="left">
          <input name="nombre1" type="text" class="camposmid" id="nombre1" value="<?php echo $myrow['nombre1']; ?>" size="30" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td  >Segundo Nombre</td>
      <td  ><input name="nombre2" type="text" class="camposmid" id="nombre2" value="<?php echo $myrow['nombre2']; ?>" size="30" /></td>
    </tr>
    <tr>
      <td  >Apellido Paterno</td>
      <td  ><input name="apellido1" type="text" class="camposmid" id="apellido1" value="<?php echo $myrow['apellido1']; ?>" size="30" /></td>
    </tr>
    <tr>
      <td  >Apellido Materno</td>
      <td  ><input name="apellido2" type="text" class="camposmid" id="apellido2" value="<?php echo $myrow['apellido2']; ?>" size="30" /></td>
    </tr>
    <tr>
      <td  >Fecha de Nacimiento</td>
      <td  class="codigos">
        <input name="fechaNacimiento" type="text" class="camposmid" 
	  value="<?php if($myrow['fechaNacimiento']){

	  echo ltrim(cambia_a_normal($myrow['fechaNacimiento']));
	  } else {
	  echo '00/00/0000'; 
	  } ?>" size="10" />
        <label></label>
        <em><strong>Ejemplo: dd/mm/aaaa</strong></em></td>
    </tr>
    <tr>
      <td  >Estado Civil Actual</td>
      <td  ><select name="ecivil" class="camposmid" id="ecivil">
        <option value="<?php echo $myrow['ecivil']; ?>"><?php echo $myrow['ecivil']; ?></option>
        <option>---</option>
		<option value="menor">Menor</option>
        <option value="soltero">Soltero</option>
        <option value="casado">Casado</option>
        <option value="viudo">Viudo</option>
		 <option value="Union Libre">Union Libre</option>
        <option value="otro">Otro</option>
      </select></td>
    </tr>
    <tr>
      <td  >Sexo</td>
      <td  ><select name="sexo" class="camposmid" id="select">
        <option value="<?php echo $myrow['sexo']; ?>"><?php echo $myrow['sexo']; ?></option>
        <option>---</option>
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
       
      </select></td>
    </tr>

    <tr >
      <td height="21" colspan="3" align="center" ><h1>Informacion de Contacto del Paciente	  </h1>	  </td>
    </tr>
    <tr >
      <td >Calle y Numero</td>
      <td colspan="2" ><input name="calle" type="text" class="camposmid" id="calle" value="<?php echo $myrow['calle']; ?>" size="30" />
      <span >Colonia
      <input name="colonia" type="text" class="camposmid" id="colonia" value="<?php echo $myrow['colonia']; ?>" size="30" />
      </span></td>
    </tr>
    <tr >
      <td >Ciudad</td>
      <td colspan="2" ></span>
        <input name="ciudad" type="text" class="camposmid" id="ciudad" value="<?php echo $myrow['ciudad']; ?>" size="25" />
        <span > Codigo Postal
        <input name="cp" type="text" class="camposmid" id="cp" value="<?php echo $myrow['cp']; ?>" size="6" />
      </span></td>
    </tr>

    <tr >
      <td >Estado</td>
      <td colspan="2" ><select name="estado" class="camposmid" id="estado">
        <option value="<?php echo $myrow['estado']; ?>"><?php echo $myrow['estado'];?></option>
        <option>---</option>
        <option value="Aguascalientes">AGUASCALIENTE</option>
        <option value="Baja California">BAJA CALIFORNIA</option>
        <option value="Baja California Sur">BAJA CALIFORNIA SUR</option>
        <option value="Campeche">CAMPECHE</option>
        <option value="Chiapas">CHIAPAS</option>
        <option value="Chihuahua">CHIHUAHUA</option>
        <option value="Coahuila">COAHUILA</option>
        <option value="Colima">COLIMA</option>
        <option value="Distrito Federal">DISTRITO FEDERAL</option>
        <option value="Durango">DURANGO</option>
        <option value="Estado de Mexico">ESTADO DE MEXICO</option>
        <option value="Guanajuato">GUANAJUATO</option>
        <option value="Guerrero">GUERRERO</option>
        <option value="Hidalgo">HIDALGO</option>
        <option value="Jalisco">JALISCO</option>
        <option value="Michoacan">MICHOACAN</option>
        <option value="Morelos">MORELOS</option>
        <option value="Nayarit">NAYARIT</option>
        <option value="Nuevo Leon">NUEVO LEON</option>
        <option value="Oaxaca">OAXACA</option>
        <option value="Pueblo">PUEBLA</option>
        <option value="Queretaro">QUERETARO</option>
        <option value="Quintana Roo">QUINTANA ROO</option>
        <option value="San Luis Potosi">SAN LUIS POTOSI</option>
        <option value="Sinaloa">SINALOA</option>
        <option value="Sonora">SONORA</option>
        <option value="Tabasco">TABASCO</option>
        <option value="Tamaulipas">TAMAULIPAS</option>
        <option value="Tlaxcala">TLAXCALA</option>
        <option value="Veracruz">VERACRUZ</option>
        <option value="Yucatan">YUCATAN</option>
        <option value="Zacatecas">ZACATECAS</option>
      </select>
      <span >Pa&iacute;s</span>
      <select name="pais1" class="camposmid" id="pais1">
        <option value="<?php echo $myrow['pais1']; ?>"><?php echo $myrow['pais1'];?></option>
        <option>---</option>
        <option value="MEXICO">MEXICO</option>
        <option value="ESTADOS UNIDOS">ESTADOS UNIDOS</option>
        <option value="CANADA">CANADA</option>
      </select></td>
    </tr>
    <tr >
      <td >Tel&eacute;fono</td>
      <td ><input name="telefono" type="text" class="camposmid" id="telefono" value="<?php echo $myrow['telefono']; ?>" size="15" /></td>
      <td >&nbsp;</td>
    </tr>
    <tr >
      <td >Religi&oacute;n</td>
<td colspan="2" ><span class="negro">
  <select name="religion" class="camposmid" id="religion">
     <option value="<?php echo $myrow['religion']; ?>"><?php echo $myrow['religion'];?></option>
     <option>---</option>
     <option value="Adventista">Adventista</option>
     <option value="Catolica">Catolica</option>
     <option value="Protestante">Protestante</option>
   </select>
   <span >Ocupaci&oacute;n</span>
   <input name="ocupacion" type="text" class="camposmid" id="ocupacion" value="<?php echo $myrow['ocupacion']; ?>" size="30" />
</span></td>
    </tr>
    <tr >
      <td height="21" colspan="3" align="center" ><h1>Informacion Adicional del Paciente (OPCIONAL) </h1></td>
    </tr>
    <tr>
      <td  >Matricula</td>
      <td colspan="2"  ><input name="numMatricula" type="text" class="camposmid" id="ocupacion3" value="<?php echo $myrow['numMatricula']; ?>" size="10" />
	  <span class="negro">
        * Obligatorio para los Estudiantes matriculados en la UM		</span>	  </td>
    </tr>
    <tr>
      <td  class="negro">Nomina</td>
      <td colspan="2"  ><input name="numEmpleado" type="text" class="camposmid" id="ocupacion2" value="<?php echo $myrow['numEmpleado']; ?>" size="12" /> 
        	  <span class="negro">
		* Obligatorio para empleados UM - HLC		</span>	  </td>
    </tr>
    <tr>
      <td  class="negro">CURP</td>
      <td colspan="2"  ><input name="curp" type="text" class="camposmid" id="curp" value="<?php echo $myrow['curp']; ?>" size="40" /></td>
    </tr>
    <tr>
      <td  class="negro">Subir Imagen</td>
      <td colspan="2"  ><span class="negro">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000000" />
        <!-- Name of input element determines name in $_FILES array -->
        <input name="userfile" type="file"   value="<?php echo $myrow['ruta']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td  class="negro">Porcentaje Especial ?</td>
      <td colspan="2"  ><span class="negro">
        <input name="jubilado" type="checkbox" id="jubilado" value="si" <?php if($myrow['jubilado']=='si'){ echo 'checked=""';}?>/>
      (Jubilados, dependientes, especiales,etc) </span></td>
    </tr>
        <tr>
      <td  class="negro">Paciente de Beneficencia</td>
      <td colspan="2"  ><span class="negro">
        <input name="beneficencia" type="checkbox" id="beneficencia" value="si" <?php if($myrow['beneficencia']=='si'){ echo 'checked=""';}?>/>
     Activacion</span></td>
    </tr>
    <tr>
      <td  class="negro">&nbsp;</td>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td  class="negro"><span >Observaciones:</span></td>
      <td  ><textarea name="observacionesSexo" cols="30" wrap="virtual" class="camposmid" id="observacionesSexo"><?php echo $myrow['observacionesSexo']; ?></textarea></td>
      <td ><label></label></td>
    </tr>
    <tr>
      <td  class="negro">&nbsp;</td>
      <td colspan="2"  ><label></label></td>
    </tr>
    <tr bgcolor="#9999FF">
      
      <?php   
if($_GET['internar']=='si'){
?>
      <td height="33" colspan="3" bgcolor="#FFFF00"><div align="center" >
        
<a href="#"  onClick="javascript:ventanaSecundaria('../ventanas/ventanaInternarPaciente.php?numeroE=<?php echo $myrow['numCliente']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $_GET['ali']; ?>&seguro=<?php echo $_POST['seguro']; ?>&tipoPaciente=<?php echo "interno"; ?>');javascript:window.close();">INTERNAR PACIENTE		</a> 
        </div></td>
      <?php }?>	  
    </tr>
  </table>

<table width="578" border="0" align="center"  cellspacing="0">
</table>
  <br>
  
  

  <table width="530" border="0" align="center">
    <tr>

      
        <?php if($myrow['numCliente']!=''){?>
      <td width="128" align="center" valign="top"><div align="center">
        <input name="nuevo2" type="submit" src="../imagenes/btns/printermid.png" id="nuevo2" value="Imprimir Hoja de ADMISION"
	  onClick="ventanaSecundaria13('../ventanas/antecedentesPatologicos.php?numCliente=<?php echo $myrow['numCliente'];?>')" />
      </div></td>
      
            <td width="128" align="center" valign="top"><div align="center">
        <input name="nuevo2" type="submit" src="../imagenes/btns/printermid.png" id="nuevo2" value="Imprimir Hoja de Expediente"
	  onClick="ventanaSecundaria13('../ventanas/expedientePdf.php?numCliente=<?php echo $myrow['numCliente'];?>&entidad=<?php echo $entidad;?>&keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>')" />
      </div></td>
        <?php } ?>

    </tr>
      </table>
    
      <table width="300" border="0" align="center">
     <tr>
      <td width="127" align="center" valign="top"><div align="center">
        <input name="nuevo" type="submit" src="../imagenes/btns/newbutton.png"  id="nuevo3" value="Nuevo" />
        <input name="expediente" type="hidden"  id="nuevo" value="no" />
        <input name="keyClientesInternos" type="hidden"  id="nuevo" value="<?php echo $_GET['keyClientesInternos'];?>" />
      </div></td>
      <td width="129" align="center" valign="top"><div align="center">
        <input name="actualizar" type="submit" src="../imagenes/btns/modifybutton.png" id="actualizar" value="Modificar/Grabar" />
        <input name="rutaImagen" type="hidden" id="rutaImagen" value="<?php echo $myrow['ruta']; ?>" />
      </div></td>
      
            <td width="128" align="center" valign="top"><div align="center">
        <input name="close" type="submit" src="../imagenes/btns/close.png"  id="close" value="Cerrar Ventana (x)" onClick="cerrarVentana();">
      </div></td>
     </tr>
  </table>

  <p>&nbsp;</p>
  <p>&nbsp;</p>
</form>

<p>&nbsp;</p>

</body>
 </html>