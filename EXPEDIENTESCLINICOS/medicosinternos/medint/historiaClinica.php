<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<?php
if($_GET['almacen2']){
$alma=$_GET['almacen2'];
} else {
$alma=$_POST['almacen'];
}

if($_POST['medico']){
$medico='si';
} else {
$medico='no';
}


if($_POST['transacciones']){
$transacciones='si';
} else {
$transacciones='no';
}


if($_POST['cargosDirectos']){
$cargosDirectos='si';
} else {
$cargosDirectos='no';
}

if($_POST['id_medico']=='---'){
$_POST['id_medico']=NULL;
}

if(!$_POST['ventas']){
$_POST['ventas']='no';
}

if(!$_POST['altaPaciente']){
$_POST['altaPaciente']='no';
}

if(!$_POST['altaEspecial']){
$_POST['altaEspecial']='no';
}

if($_POST['actualizar'] AND $_POST['almacen'] ){
$sSQL1= "Select * From almacenes WHERE almacen = '".$_POST['almacen']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['almacen']){
if($_POST['almacen']!=$myrow1['almacen']){




$agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,medico,ventas,
altaPaciente,altaEspecial,cargosDirectos,numConsultorio,transacciones
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','".$medico."','".$_POST['ventas']."','".$_POST['altaPaciente']."','".$_POST['altaEspecial']."','".$cargosDirectos."','".$_POST['numConsultorio']."','".$_POST['transacciones']."'

)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega = "INSERT INTO almacenesHistoria (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,tipoTransaccion
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','insertar'

)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script type="text/vbscript">
msgbox "ALMACEN AGREGADO EXITOSAMENTE "
</script>';
echo 'Almacén o mini-Almacén agregado..'; 
}} else {

$agrega = "INSERT INTO almacenesHistoria (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,tipoTransaccion
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','actualizar'

)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();



$q = "UPDATE almacenes set 
descripcion='".$_POST['descripcion']."', 
tieneCuartos='".$_POST['tieneCuartos']."',
ctaContable='".$_POST['ctaContable']."',
usuario='".$usuario."',
fecha1='".$fecha1."',
ID_CCOSTO='".$_POST['ctaContable']."',
modulo='".$_POST['modulo']."',
activo='".$_POST['activo']."',
ventas='".$_POST['ventas']."',
altaPaciente='".$_POST['altaPaciente']."',altaEspecial='".$_POST['altaEspecial']."',
miniAlmacen='".$_POST['miniAlmacen']."',almacenPadre='".$_POST['almacenDestino']."',
stock='".$_POST['stock']."',
transacciones='".$_POST['transacciones']."',
cargosDirectos='".$cargosDirectos."',
id_medico='".$_POST['medico']."',medico='".$medico."',numConsultorio='".$_POST['numConsultorio']."'

WHERE 
almacen='".$_POST['almacen']."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se Modificó el almacén';

} 

echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}








if($_POST['borrar'] AND $_POST['almacen']){

$agrega = "INSERT INTO almacenesHistoria (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,tipoTransaccion
) values ('".$_POST['almacen']."','".$_POST['descripcion']."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','".$_POST['miniAlmacen']."','".$_POST['almacenDestino']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_POST['medico']."','eliminar'

)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();


$borrame = "DELETE FROM almacenes WHERE almacen ='".$_POST['almacen']."' and entidad='".$entidad."'";
mysql_db_query($basedatos,$borrame);

echo mysql_error();
echo 'Almacén Modificado';
echo '<script type="text/vbscript">
msgbox "ALMACEN ELIMINADO "
</script>';
?>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>

<?php }









if($_POST['agregar']){
/** checo si existe**/
$_POST['almacen'] = "";
}


if($_GET['almacen2'] AND !$_POST['nuevo']){
$sSQL2= "Select * From almacenes WHERE almacen = '".$_GET['almacen2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
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
.Estilo24 {font-size: 10px}
.style13 {font-size: 10px; font-weight: bold; }
.style15 {color: #FFFFFF}
-->
</style>
</head>

<body>
<form id="form2" name="form2" method="post" action="" >
   <p>
     <label></label></p>
   <div align="center"><strong>HISTORIA CLINICA </strong></div>
   <table width="709" border="0" align="center">
     <tr>
       
       <th colspan="2" bgcolor="#CC0000" class="style12" scope="col">
	   <div align="center" class="style15">Antecedentes Personales no Patol&oacute;gicos </div>
 <div align="left">
           <label></label>
       </div></th>
       </tr>
     <tr>
       <td width="131" class="style12">Antecedentes Heredo Familiares </td>
       <td width="568" class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style12">Padre</td>
       <td class="style12"><input name="textarea8" type="text" class="Estilo24" value="   a&ntilde;os, aparentemente sano" size="80" /></td>
     </tr>
     <tr>
       <td class="style12">Madre</td>
       <td class="style12"><span class="Estilo24">
         <input name="textarea82" type="text" class="Estilo24" value="  a&ntilde;os, aparentemente sano" size="80" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Hermanos</td>
       <td class="style12"><span class="Estilo24">
         <input name="textarea822" type="text" class="Estilo24" value="  , aparentemente sano" size="80" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Hijos</td>
       <td class="style12"><span class="Estilo24">
         <input name="textarea8222" type="text" class="Estilo24" value="N/A" size="80" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#CC0000" class="style12"><div align="center" class="style15">Antecedentes Personales no Patol&oacute;gicos </div></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Vivienda</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textarea82222" type="text" class="Estilo24" value="Material con todos los servicios" size="80" />
       </span></td>
     </tr>
     <tr>
       <td class="Estilo24">H&aacute;bitos de Higiene </td>
       <td class="style12"><label><span class="Estilo24">
         <textarea name="textarea822222" cols="80" class="Estilo24">Adecuados</textarea>
       </span></label></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Tabaquismo</td>
       <td bgcolor="#FFCCFF" class="style12">Positivo 
         <label>
         <input name="radiobutton" type="radio" value="radiobutton" />
       || Negativo 
       <input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
       </label></td>
     </tr>
     <tr>
       <td class="style12">Alcoholismo</td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Toxicoman&iacute;as</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Grupo -RH </td>
       <td class="style12"><span class="Estilo24">
         <input name="textarea82223" type="text" class="Estilo24" value="N/A" size="10" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Dieta</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Omnivora
         <label>
           <input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
|| Vegetariana
<input name="radiobutton" type="radio" value="radiobutton" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Viajes Recientes </td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Horas de Sue&ntilde;o </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textarea82224" type="text" class="Estilo24" value="7/Noche" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Diuresis</td>
       <td class="style12"><span class="Estilo24">
         <input name="textarea822242" type="text" class="Estilo24" value="10/dia" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Evacuaciones</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Actividad F&iacute;sica </td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Mascotas</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Inmunizaciones</td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield23" type="text" class="Estilo24" value="Completas" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#CC0000" class="style12"><div align="center" class="style15">Antecedentes Patol&oacute;gicos Personales</div></td>
     </tr>
     <tr>
       <td class="style12">Infancia</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea" cols="80" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Quir&uacute;rgicos</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea9" cols="80" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Traumatismos</td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Alergias</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Enfermedades durante Embarazo </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea10" cols="80" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Medicamento</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea11" cols="80" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Hospitalizaciones</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea12" cols="80" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Transfusiones</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea13" cols="80" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#CC0000" class="style12"><div align="center"><span class="style15">Antecedentes Gineco-Obstreticos </span></div></td>
     </tr>
     <tr>
       <td class="style12">Menarca</td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield24" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Ritmo</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield25" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Gestaci&oacute;n</td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield26" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Fecha &Uacute;ltima Menstruaci&oacute;n </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield27" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Inicio de Vida Sexual Activa </td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield28" type="text" class="Estilo24" value="    a&ntilde;os" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">M&eacute;todo Planificaci&oacute;n Familiar </td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield210" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Fecha Probable de Parto </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield213" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Papanicolau</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield211" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Ces&aacute;rea</td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield212" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Partos</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield29" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Mamo</td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Abortos</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield2132" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Observaciones</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea14" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style12">Motivo Consulta </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea15" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Padecimiento Actual </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea16" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#CC0000" class="style12"><div align="center"><span class="style15">Interrogatorio por aparatos y sistemas </span></div></td>
     </tr>
     <tr>
       <td class="style12">Piel y Tegumentos </td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       Si es Afirmativo Especifique 
       <input name="textfield21322" type="text" class="Estilo24" size="60" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Sistema Cardiovascular </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       Si es Afirmativo Especifique 
       <input name="textfield213222" type="text" class="Estilo24" size="60" />
</span></td>
     </tr>
     <tr>
       <td class="style12">Sistema Respiratorio </td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       Si es Afirmativo Especifique 
       <input name="textfield213223" type="text" class="Estilo24" size="60" />
</span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Sistema TractoGastrolintestinal </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       Si es Afirmativo Especifique 
       <input name="textfield213224" type="text" class="Estilo24" size="60" />
</span></td>
     </tr>
     <tr>
       <td class="style12">Sistema Genito-Urinario </td>
       <td class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       Si es Afirmativo Especifique 
       <input name="textfield213225" type="text" class="Estilo24" size="60" />
</span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Sistema M&uacute;sculo Esquel&eacute;tico </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">Positivo
           <label>
           <input name="radiobutton" type="radio" value="radiobutton" />
|| Negativo
<input name="radiobutton" type="radio" value="radiobutton" checked="checked" />
           </label>
       Si es Afirmativo Especifique 
       <input name="textfield213226" type="text" class="Estilo24" size="60" />
</span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#CC0000" class="style12"><div align="center"><span class="style15">Signos Vitales</span></div></td>
     </tr>
     <tr>
       <td class="style12">Presi&oacute;n Arterial</td>
       <td class="style12"><input name="textfield22" type="text" class="Estilo24" value="110/60" /></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Frecuencia Card&iacute;aca</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="textfield222" type="text" class="Estilo24" value="100" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Frecuencia Respiratoria</td>
       <td class="style12"><span class="Estilo24">
         <input name="textfield223" type="text" class="Estilo24" />
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Temperatura</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <input name="temperatura" type="text" class="Estilo24" id="temperatura" />
       </span></td>
     </tr>
     <tr>
       <td class="style12">Peso</td>
       <td class="style12"><span class="Estilo24">
         <input name="peso" type="text" class="Estilo24" id="peso" size="4" />
         Kgs.</span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style13">&nbsp;</td>
       <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
     </tr>
     <tr>
       <td class="Estilo24">Impresi&oacute;n Diagn&oacute;stica </td>
       <td class="style12"><span class="Estilo24">
         <textarea name="IDX" cols="80" wrap="virtual" class="Estilo24" id="IDX"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="Estilo24">Servicio</td>
       <td bgcolor="#FFCCFF" class="style12"><label>
         <textarea name="servicio" cols="80" wrap="virtual" class="style12" id="servicio"></textarea>
       </label></td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#CC0000" class="style12"><div align="center"><span class="style15">Exploraci&oacute;n F&iacute;sica</span></div></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">H&aacute;bitos Externos </td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea17" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Cabeza</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea18" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Cuello</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea19" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Torax</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea20" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td bgcolor="#FFCCFF" class="style12">Abdomen</td>
       <td bgcolor="#FFCCFF" class="style12"><span class="Estilo24">
         <textarea name="textarea21" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">Extremidades</td>
       <td class="style12"><span class="Estilo24">
         <textarea name="textarea22" cols="80" wrap="virtual" class="Estilo24"></textarea>
       </span></td>
     </tr>
     <tr>
       <td class="style12">&nbsp;</td>
       <td class="style12">&nbsp;</td>
     </tr>
  </table>
   <p align="center">
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
     <label>
     <input name="Submit" type="submit" class="style12" value="Guardar Datos" />
     </label>
   </p>
</form>
</body>
</html>
