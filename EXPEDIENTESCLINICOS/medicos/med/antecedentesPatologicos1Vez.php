<?php include('/configuracion/ventanasEmergentes.php');?>
<?php 
$sSQL= "SELECT *
FROM
pacientes
WHERE 
numCliente='".$_GET['numCliente']."' or numCliente='".$_GET['numeroExpediente']."'
 ";
 $result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']
	  ." ".$myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3'];
	  $N=$myrow['numCliente'];
	  ?>
	  
	  
	 <?php
if($_POST['actualizar']){
	 
$sSQL1= "Select  * From antecedentes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' or numCliente='".$_GET['numCliente']."' order by keyPacientes DESC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
	 
if($myrow1['numeroE']){	 
$agrega = "INSERT INTO antecedentes (
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
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
} else {
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
nombreCompleto='".$nombreCompleto."',
usuario='".$usuario."',fechaModificacion='".$fecha1."',jubilado='".$jubilado."'
WHERE 
numCliente='".$_POST['numCliente']."' and entidad='".$entidad."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
}	 
	 
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
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.catalogo {font-family: Verdana, Arial, Helvetica, sans-serif;  
    font-size: 9px;  
    color: #333333;  
}
.Estilo24 {font-size: 10px}
.style21 {color: #000000}
-->
</style>
</head>

<body class="style12 style21">
<p align="center"><strong>	<span class="style12">ANTECEDENTES - PATOLOGICOS - HEREDITARIOS</span></strong></p>
<form id="form1" name="form1" method="post" action="">
  <table width="346" border="0" align="left">
    <tr>
      <td colspan="5" bgcolor="#660066"><div align="center">
          <p class="Estilo3">HOSPITAL &quot;LA CARLOTA&quot;</p>
        <p class="Estilo3"><strong>UNIVERSIDAD DE MONTEMORELOS</strong></p>
        <p class="Estilo3">HISTORIA CLINICA</p>
      </div></td>
    </tr>
    <tr>
      <td width="60"><p align="left" class="style2">&nbsp;</p></td>
      <td width="154" class="Estilo24">NOMBRE</td>
      <td width="99" class="Estilo24">EDAD ACTUAL O AL FALLECER </td>
      <td colspan="2" class="Estilo24">VIVO SANO ENFERMO CAUSA DE MUERTE </td>
    </tr>
    <tr>
      <td><div align="left" class="Estilo24">Padre</div></td>
      <td class="Estilo24"><input name="historiaClinicaPadre" type="text" class="Estilo24" id="historiaClinicaPadre" value="<?php echo $myrow1['historiaClinicaPadre'];?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadPadre" type="text" class="Estilo24" id="historiaEdadPadre" size="3" maxlength="3"  value="<?php echo $myrow1['historiaEdadPadre']; ?>"/>
      </span></div></td>
      <td colspan="2" class="Estilo24"><input name="" type="text" class="Estilo24" id="historiaPadreVivo"  value="<?php echo $myrow1['historiaPadreVivo']; ?>"/>      </td>
    </tr>
    <tr>
      <td><div align="left" class="Estilo24">Madre</div></td>
      <td class="Estilo24"><input name="historiaClinicaMadre" type="text" class="Estilo24" id="historiaClinicaMadre" value="<?php echo $myrow1['historiaClinicaMadre'];?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="" type="text" class="Estilo24" id="historiaEdadMadre" size="3" maxlength="3"  value="<?php echo $myrow1['historiaEdadMadre']; ?>"/>
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaMadreVivo" type="text" class="Estilo24" id="historiaMadreVivo"  value="<?php echo $myrow1['historiaMadreVivo']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td><div align="left" class="Estilo24">Hermanos</div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">1</div></td>
      <td class="Estilo24"><input name="historiaClinicaHermanos1" type="text" class="Estilo24" id="historiaClinicaHermanos1" value="<?php echo $myrow1['historiaClinicaHermanos1']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHermanos1" type="text" class="Estilo24" id="historiaEdadHermanos1" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos1']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHermanosVivo1" type="text" class="Estilo24" id="historiaHermanosVivo1" value="<?php echo $myrow1['historiaHermanosVivo1']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">2</div></td>
      <td class="Estilo24"><input name="historiaClinicaHermanos2" type="text" class="Estilo24" id="historiaClinicaHermanos2" value="<?php echo $myrow1['historiaClinicaHermanos2']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHermanos2" type="text" class="Estilo24" id="historiaEdadHermanos2" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos2']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHermanosVivo2" type="text" class="Estilo24" id="historiaHermanosVivo2" value"<?php echo $myrow1['historiaHermanosVivo2']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">3</div></td>
      <td class="Estilo24"><input name="historiaClinicaHermanos3" type="text" class="Estilo24" id="historiaClinicaHermanos3" value="<?php echo $myrow1['historiaClinicaHermanos3']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHermanos3" type="text" class="Estilo24" id="historiaEdadHermanos3" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos3']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHermanosVivo3" type="text" class="Estilo24" id="historiaHermanosVivo3" value="<?php echo $myrow1['historiaHermanosVivo1']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">4</div></td>
      <td class="Estilo24"><input name="historiaClinicaHermanos4" type="text" class="Estilo24" id="historiaClinicaHermanos4" value="<?php echo $myrow1['historiaClinicaHermanos4']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHermanos3" type="text" class="Estilo24" id="historiaEdadHermanos3" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos3']; ?>"/>
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHermanosVivo4" type="text" class="Estilo24" id="historiaHermanosVivo4" value="<?php echo $myrow1['historiaHermanosVivo4']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">5</div></td>
      <td class="Estilo24"><input name="historiaClinicaHermanos5" type="text" class="Estilo24" id="historiaClinicaHermanos5" value="<?php echo $myrow1['historiaClinicaHermanos5']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHermanos5" type="text" class="Estilo24" id="historiaEdadHermanos5" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos5']; ?>"/>
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHermanosVivo5" type="text" class="Estilo24" id="historiaHermanosVivo5" value="<?php echo $myrow1['historiaHermanosVivo5']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">6</div></td>
      <td class="Estilo24"><input name="historiaClinicaHermanos6" type="text" class="Estilo24" id="historiaClinicaHermanos6" value="<?php echo $myrow1['historiaClinicaHermanos6']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHermanos6" type="text" class="Estilo24" id="historiaEdadHermanos6" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos6']; ?>"/>
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHermanosVivo6" type="text" class="Estilo24" id="historiaHermanosVivo6" value="<?php echo $myrow1['historiaHermanosVivo6']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td><div align="left" class="Estilo24">Hijos</div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">1</div></td>
      <td class="Estilo24"><input name="historiaClinicaHijos1" type="text" class="Estilo24" id="historiaClinicaHijos1" value="<?php echo $myrow1['historiaClinicaHijos1']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHijos1" type="text" class="Estilo24" id="historiaEdadHijos1" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHermanos1']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHijosVivo1" type="text" class="Estilo24" id="historiaHijosVivo1" value="<?php echo $myrow1['historiaHijosVivo1']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">2</div></td>
      <td class="Estilo24"><input name="historiaClinicaHijos2" type="text" class="Estilo24" id="historiaClinicaHijos2" value="<?php echo $myrow1['historiaClinicaHijos2']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHijos2" type="text" class="Estilo24" id="historiaEdadHijos2" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHijos2']; ?>"/>
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHijosVivo2" type="text" class="Estilo24" id="historiaHijosVivo2" value="<?php echo $myrow1['historiaHijosVivo2']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">3</div></td>
      <td class="Estilo24"><input name="historiaClinicaHijos3" type="text" class="Estilo24" id="historiaClinicaHijos3" value="<?php echo $myrow1['historiaClinicaHijos3']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHijos3" type="text" class="Estilo24" id="historiaEdadHijos3" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHijos3']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHijosVivo3" type="text" class="Estilo24" id="historiaHijosVivo3" value="<?php echo $myrow1['historiaHijosVivo3']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">4</div></td>
      <td class="Estilo24"><input name="historiaClinicaHijos4" type="text" class="Estilo24" id="historiaClinicaHijos4" value="<?php echo $myrow1['historiaClinicaHijos4']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHijos4" type="text" class="Estilo24" id="historiaEdadHijos4" size="3" maxlength="3"  value="<?php echo $myrow1['historiaEdadHijos4']; ?>"/>
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHijosVivo4" type="text" class="Estilo24" id="historiaHijosVivo4" value="<?php echo $myrow1['historiaHijosVivo4']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">5</div></td>
      <td class="Estilo24"><input name="historiaClinicaHijos5" type="text" class="Estilo24" id="historiaClinicaHijos5" value="<?php echo $myrow1['historiaClinicaHijos5']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHijos5" type="text" class="Estilo24" id="historiaEdadHijos5" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHijos5']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHijosVivo5" type="text" class="Estilo24" id="historiaHijosVivo5" value="<?php echo $myrow1['historiaHijosVivo5']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right" class="Estilo24">6</div></td>
      <td class="Estilo24"><input name="historiaClinicaHijos6" type="text" class="Estilo24" id="historiaClinicaHijos6" value="<?php echo $myrow1['historiaClinicaHijos6']; ?>" />      </td>
      <td><div align="center"> <span class="Estilo24">
          <input name="historiaEdadHijos6" type="text" class="Estilo24" id="historiaEdadHijos6" size="3" maxlength="3" value="<?php echo $myrow1['historiaEdadHijos6']; ?>" />
      </span></div></td>
      <td colspan="2"><span class="Estilo24">
        <input name="historiaHijosVivo6" type="text" class="Estilo24" id="historiaHijosVivo6" value="<?php echo $myrow1['historiaHijosVivo6']; ?>" />
      </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="282" border="0" align="center">
    <tr>
      <td colspan="5" class="Estilo24"><strong>HISTORIA FAMILIAR </strong>- Tiene familiares con algunas de las siguientes enfermedades</td>
    </tr>
    <tr>
      <td colspan="5" class="Estilo24"><strong>Marque si o no - Si tiene, que parentesco guardan con usted </strong></td>
    </tr>
    <tr>
      <td class="style4">&nbsp;</td>
      <td class="style4">&nbsp;</td>
      <td class="style2">&nbsp;</td>
      <td class="style2">&nbsp;</td>
      <td class="style4">&nbsp;</td>
    </tr>
    <tr>
      <td class="style4">&nbsp;</td>
      <td class="Estilo24">Enfermedad</td>
      <td class="style2"><div align="center" class="Estilo24"></div></td>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Parentesco</td>
    </tr>
    <tr>
      <td width="20" class="style2">&nbsp;</td>
      <td width="87" class="Estilo24">Anemia</td>
      <td width="21" class="style1"><span class="Estilo24">
        <label>
        <input name="anemia" type="checkbox" value="si" <?php if $myrow1['anemia']echo 'checked=""'; ?> />
        </label>
      </span></td>
      <td width="22" class="style1">&nbsp;</td>
      <td width="110" class="style1"><span class="Estilo24">
        <label>
        <input name="parentescoAnemia" type="text" class="Estilo24" id="parentescoAnemia" value="<?php echo $myrow1['parentescoAnemia']; ?>" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Sangrado F&aacute;cil </td>
      <td class="style1"><div align="center"> <span class="Estilo24">
          <input name="sangradoFacil" type="checkbox" value="si" <?php if $myrow1['sangradoFacil']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style1">&nbsp;</td>
      <td class="Estilo24"><input name="parentescoSangradoFacil" type="text" class="Estilo24" id="parentescoSangradoFacil" value="<?php echo $myrow1['parentescoSangradoFacil']; ?>" />
      </td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Leucemia</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="leucemia" type="checkbox" value="si" <?php if $myrow1['leucemia']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoLeucemia" type="text" class="Estilo24" id="parentescoLeucemia" value="<?php echo $myrow1['parentescoLeucemia']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Infecciones de Repetici&oacute;n </td>
      <td class="style2"><div align="center"> <span class="Estilo24"> 
          <input name="infeccionesRepeticion" type="checkbox" value="si" <?php if $myrow1['infeccionesRepeticion']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoInfeccionesRepeticion" type="text" class="Estilo24" id="parentescoInfeccionesRepeticion" value="<?php echo $myrow1['parentescoInfeccionesRepeticion']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Artitris Deformante </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="artitrisDeformante" type="checkbox" value="si"  <?php if $myrow1['artritisDeformante']echo 'checked=""'; ?>/>
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoArtritisDef" type="text" class="Estilo24" id="parentescoArtritisDef" value="<?php echo $myrow1['parentescoArtritisDef']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Enfermedad del Coraz&oacute;n</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="enfermedadCorazon" type="checkbox" value="si" <?php if $myrow1['enfermedadCorazon']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoEnfermedadCorazon" type="text" class="Estilo24" id="parentescoEnfermedadCorazon" value="<?php echo $myrow1['parentescoEnfermedadCorazon']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Enfermedad Cr&oacute;nica del Pulm&oacute;n </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="enfermedadCronicaPulmon" type="checkbox" value="si" <?php if $myrow1['enfermedadCronicaPulmon']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoEnfermedadCronicaPulmon" type="text" class="Estilo24" id="parentescoEnfermedadCronicaPulmon" value="<?php echo $myrow1['parentescoEnfermedadCronicaPulmon']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Tuberculosis</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="tuberculosis" type="checkbox" value="si" <?php if $myrow1['tuberculosis']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoTuberculosis" type="text" class="Estilo24" id="parentescoTuberculosis" value="<?php echo $myrow1['parentescoTuberculosis']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Presi&oacute;n Alta </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="presionAlta" type="checkbox" value="si"  <?php if $myrow1['presionAlta']echo 'checked=""'; ?>/>
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoPresionAlta" type="text" class="Estilo24" id="parentescoPresionAlta" value="<?php echo $myrow1['parentescoPresionAlta']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Enfermedad del Ri&ntilde;&oacute;n </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="enfermedadRinon" type="checkbox" value="si" <?php if $myrow1['enfermedadRinon']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoEnfermedadRinon" type="text" class="Estilo24" id="parentescoEnfermedadRinon" value="<?php echo $myrow1['parentescoEnfermedadRinon']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Asma</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="asma" type="checkbox" value="si" <?php if $myrow1['asma']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoAsma" type="text" class="Estilo24" id="parentescoAsma" value="<?php echo $myrow1['parentescoAsma']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Alergia</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="alergia" type="checkbox" value="si" <?php if $myrow1['alergia']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoAlergia" type="text" class="Estilo24" id="parentescoAlergia" value="<?php echo $myrow1['parentescoAlergia']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Enfermedad Mental </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="enfermedadMental" type="checkbox" value="si" <?php if $myrow1['enfermedadMental']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoEnfermedadMental" type="text" class="Estilo24" id="parentescoEnfermedadMental" value="<?php echo $myrow1['parentescoEnfermedadMental']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Convulsiones - Ataques </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="convulsionesAtaques" type="checkbox" value="si" <?php if $myrow1['convulsionesAtaques']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoConvulsiones" type="text" class="Estilo24" id="parentescoConvulsiones" value="<?php echo $myrow1['parentescoConvulsiones']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Jaqueca - Dolores de Cabeza </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="jaqueca" type="checkbox" value="si" <?php if $myrow1['jaqueca']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoJaqueca" type="text" class="Estilo24" id="parentescoJaqueca" value="<?php echo $myrow1['parentescoJaqueca']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Diabetes</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="diabetes" type="checkbox" value="si" <?php if $myrow1['Diabetes']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoDiabetes" type="text" class="Estilo24" id="parentescoDiabetes" value="<?php echo $myrow1['parentescoDiabetes']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Gota</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="gota" type="checkbox" value="si" <?php if $myrow1['gota']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoGota" type="text" class="Estilo24" id="parentescoGota" value="<?php echo $myrow1['parentescoGota']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Obesidad</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="obesidad" type="checkbox" value="si" <?php if $myrow1['obesidad']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoObesidad" type="text" class="Estilo24" id="parentescoObesidad"  value="<?php echo $myrow1['parentescoObesidad']; ?>"/>
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Enfermedad de Tiroides </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="enfermedadTiroides" type="checkbox" value="si" <?php if $myrow1['enfermedadTiroides']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoEnfermedadTiroides" type="text" class="Estilo24" id="parentescoEnfermedadTiroides" value="<?php echo $myrow1['parentescoEnfermedadTiroides']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Ulcera: Est&oacute;mago - Duodeno </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="ulceraEstomago" type="checkbox" value="si" <?php if $myrow1['ulceraEstomago']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoUlcera" type="text" class="Estilo24" id="parentescoUlcera" value="<?php echo $myrow1['parentescoUlcera']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">Diarrea Cr&oacute;nica </td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="diarreaCronica" type="checkbox" value="si" <?php if $myrow1['diarreaCronica']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoDiarreaCronica" type="text" class="Estilo24" id="parentescoDiarreaCronica" value="<?php echo $myrow1['parentescoDiarreaCronica']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="Estilo24">C&aacute;ncer</td>
      <td class="style2"><div align="center"> <span class="Estilo24">
          <input name="cancer" type="checkbox" value="si" <?php if $myrow1['cancer']echo 'checked=""'; ?> />
      </span></div></td>
      <td class="style2">&nbsp;</td>
      <td class="style2"><span class="Estilo24">
        <input name="parentescoCancer" type="text" class="Estilo24" id="parentescoCancer" value="<?php echo $myrow1['parentescoCancer']; ?>" />
      </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p><span class="style12">
    <label></label>
  </span></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <table width="619" border="0" class="style12">
    <tr>
      <td colspan="6" class="style12">ENFERMEDADES PADECIDAS - Marque Si o No</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2" class="style12">DATOS PERSONALES </td>
      <td><div align="right" class="style12">Edad </div> </td>
      <td class="style12"><?php echo $myrow['edad'];?></td>
    </tr>
    <tr>
      <td width="2">&nbsp;</td>
      <td width="65" class="style12">Tuvo alguna Vez o tiene: </td>
      <td width="20"><div align="center" class="style12">si</div></td>
      <td width="20">&nbsp;</td>
      <td width="24"><div align="center" class="style2">
          <div align="center" class="style12">A&ntilde;os </div>
      </div></td>
      <td width="83" class="style12">OPERACIONES:</td>
      <td width="20"><div align="center" class="style12">si</div></td>
      <td width="20">&nbsp;</td>
      <td width="21"><div align="center" class="style2">
          <div align="center" class="style12">A&ntilde;os</div>
      </div></td>
      <td width="6">&nbsp;</td>
      <td width="54" class="style12">Nacionalidad</td>
      <td width="48" class="style12"><?php echo $myrow['pais1'];?></td>
      <td width="67"><div align="center" class="style2">
        <div align="left" class="style12">Fecha de Nacimiento</div>
      </div></td>
      <td width="111" class="style12"><?php echo $myrow['fechaNacimiento'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="24" class="style12">Rubeola</td>
      <td><div align="center">
              <span class="style12">
              <input name="rubeola" type="checkbox" value="si" <?php if $myrow1['rubeola']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><span class="style12">
        <label> </label>
          </span>
        <div align="center">
          <span class="style12">
          <input name="anosRubeola" type="text" class="style12" id="anosRubeola" size="2" maxlength="2" value="<?php echo $myrow1['anosRubeola']; ?>" />
          </span></div></td>
      <td class="style12">Am&iacute;gdalas</td>
      <td><div align="center">
              <span class="style12">
              <input name="amigdalas" type="checkbox" value="si" <?php if $myrow1['amigdalas']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAmigdalas" type="text" class="style12" id="anosAmigdalas" size="2" maxlength="2" value="<?php echo $myrow1['anosAmigdalas']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">Estado Civil </td>
      <td class="style12"><?php echo $myrow['ecivil'];?></td>
      <td><div align="right" class="style2">
        <div align="left" class="style12">Religion</div>
      </div></td>
      <td class="style12"><?php echo $myrow['religion'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Sarampi&oacute;n</td>
      <td><div align="center">
              <span class="style12">
              <input name="sarampion" type="checkbox" value="si" <?php if $myrow1['sarampion']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosSarampion" type="text" class="style12" id="anosSarampion" size="2" maxlength="2" value="<?php echo $myrow1['anosSarampion']; ?>" />
              </span></div></td>
      <td class="style12">Ap&eacute;ndice</td>
      <td><div align="center">
              <span class="style12">
              <input name="apendice" type="checkbox" value="si" <?php if $myrow1['apendice']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosApendice" type="text" class="style12" id="anosApendice" size="2" maxlength="2" value="<?php echo $myrow1['anosApendice']; ?>"  />
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">Profesion</td>
      <td class="style12"><?php echo $myrow['ocupacion'];?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Paperas</td>
      <td><div align="center">
              <span class="style12">
              <input name="paperas" type="checkbox" value="si" <?php if $myrow1['paperas']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPaperas" type="text" class="style12" id="anosPaperas" size="2" maxlength="2" value="<?php echo $myrow1['anosPaperas']; ?>" />
              </span></div></td>
      <td class="style12">Ves&iacute;cula</td>
      <td><div align="center">
              <span class="style12">
              <input name="vesicula" type="checkbox" value="si" <?php if $myrow1['vesicula']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosVesicula" type="text" class="style12" id="anosVesicula" size="2" maxlength="2" value="<?php echo $myrow1['anosVesicula']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">Domicilio</td>
      <td class="style12"><?php echo $myrow['calle']." ".$myrow['colonia']." ".$myrow['calle']." ".$myrow['cp'];?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Tosferina</td>
      <td><div align="center">
              <span class="style12">
              <input name="tosferina" type="checkbox" value="si" <?php if $myrow1['tosferina']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTosferina" type="text" class="style12" id="anosTosferina" size="2" maxlength="2" value="<?php echo $myrow1['anosTosferina']; ?>" />
              </span></div></td>
      <td class="style12">Est&oacute;mago</td>
      <td><div align="center">
              <span class="style12">
              <input name="estomago" type="checkbox" value="si" <?php if $myrow1['estomago']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosEstomago" type="text" class="style12" id="anosEstomago" size="2" maxlength="2" value="<?php echo $myrow1['anosEstomago']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">Ciudad</td>
      <td class="style12"><?php echo $myrow['ciudad'];?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Polio</td>
      <td><div align="center">
              <span class="style12">
              <input name="polio" type="checkbox" value="si"  <?php if $myrow1['polio']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPolio" type="text" class="style12" id="anosPolio" size="2" maxlength="2" value="<?php echo $myrow1['anosPolio']; ?>" />
              </span></div></td>
      <td class="style12">Mamas - pechos </td>
      <td><div align="center">
              <span class="style12">
              <input name="mamas" type="checkbox" value="si" <?php if $myrow1['mamas']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosMamas" type="text" class="style12" id="anosMamas" size="2" maxlength="2" value="<?php echo $myrow1['anosMamas']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Escarlatina</td>
      <td><div align="center">
              <span class="style12">
              <input name="escarlatina" type="checkbox" value="si" <?php if $myrow1['escarlatina']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosEscarlatina" type="text" class="style12" id="anosEscarlatina" size="2" maxlength="2" value="<?php echo $myrow1['anosEscarlatina']; ?>" />
              </span></div></td>
      <td class="style12">Matriz - Ovario </td>
      <td><div align="center">
              <span class="style12">
              <input name="matriz" type="checkbox" value="si" <?php if $myrow1['matriz']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosMatriz" type="text" class="style12" id="anosMatriz" size="2" maxlength="2" value="<?php echo $myrow1['anosMatriz']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Difteria</td>
      <td><div align="center">
              <span class="style12">
              <input name="difteria" type="checkbox" value="si" <?php if $myrow1['difteria']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosDifteria" type="text" class="style12" id="anosDifteria" size="2" maxlength="2" value="<?php echo $myrow1['anosDifteria']; ?>" />
              </span></div></td>
      <td class="style12">Pr&oacute;stata</td>
      <td><div align="center">
              <span class="style12">
              <input name="prostata" type="checkbox" value="si" <?php if $myrow1['prostata']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosProstata" type="text" class="style12" id="anosProstata" size="2" maxlength="2" value="<?php echo $myrow1['anosProstata']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Meningitis</td>
      <td><div align="center">
              <span class="style12">
              <input name="meningitis" type="checkbox" value="si" <?php if $myrow1['meningitis']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosMeningitis" type="text" class="style12" id="anosMeningitis" size="2" maxlength="2" value="<?php echo $myrow1['anosMeningitis']; ?>" />
              </span></div></td>
      <td class="style12">Hernia</td>
      <td><div align="center">
              <span class="style12">
              <input name="hernia" type="checkbox" value="si" <?php if $myrow1['hernia']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosHernia" type="text" class="style12" id="anosHernia" size="2" maxlength="2" value="<?php echo $myrow1['anosHernia']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td colspan="2" class="style12">Nombre Paciente: 
        <?php echo $nombrePaciente; ?>      </td>
      <td class="style12">Datos Obtenidos por: </td>
      <td><span class="Estilo24">
        <input name="datosX" type="text" class="Estilo24" id="datosX" />
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Mononucleosis</td>
      <td><div align="center">
              <span class="style12">
              <input name="mononucleosis" type="checkbox" value="si" <?php if $myrow1['mononucleosis']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosMononucleosis" type="text" class="style12" id="anosMononucleosis" size="2" maxlength="2" value="<?php echo $myrow1['anosMononucleosis']; ?>" />
              </span></div></td>
      <td class="style12">Tiroides</td>
      <td><div align="center">
              <span class="style12">
              <input name="tiroides" type="checkbox" value="si" <?php if $myrow1['tiroides']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTiroides" type="text" class="style12" id="anosTiroides" size="2" maxlength="2" value="<?php echo $myrow1['anosTiroides']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">No. Expediente </td>
      <td class="style12"><?php echo $myrow['numCliente'];?>&nbsp;</td>
      <td class="style12">Doctor</td>
      <td>        <span class="style12">
        <input name="doctor" type="text" class="style12" id="doctor" />      
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Tuberculosis (TBC) </td>
      <td><div align="center">
              <span class="style12">
              <input name="tuberculosisTbc" type="checkbox" value="si" <?php if $myrow1['tuberculosisTbc']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTuberculosisTbc" type="text" class="style12" id="anosTuberculosisTbc" size="2" maxlength="2" value="<?php echo $myrow1['anosTuberculosisTbc']; ?>" />
              </span></div></td>
      <td class="style12">V&aacute;rices</td>
      <td><div align="center">
              <span class="style12">
              <input name="varices" type="checkbox" value="si" <?php if $myrow1['varices']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosVarices" type="text" class="style12" id="anosVarices" size="2" maxlength="2" value="<?php echo $myrow1['anosVarices']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">Sexo</td>
      <td><span class="Estilo24"><?php echo $myrow['sexo'];?></span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Contacto con TBC </td>
      <td><div align="center">
              <span class="style12">
              <input name="contactoTbc" type="checkbox" value="si" <?php if $myrow1['contactoTbc']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosContactoTbc" type="text" class="style12" id="anosContactoTbc" size="2" maxlength="2" value="<?php echo $myrow1['anosContactoTbc']; ?>" />
              </span></div></td>
      <td class="style12">Hemorroides</td>
      <td><div align="center">
              <span class="style12">
              <input name="hemorroides2" type="checkbox" value="si" <?php if $myrow1['hemorroides']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosHemorroides2" type="text" class="style12" id="anosHemorroides2" size="2" maxlength="2"  value="<?php echo $myrow1['anosHemorroides2']; ?>"/>
              </span></div></td>
      <td>&nbsp;</td>
      <td class="style12">Fecha</td>
      <td class="style12"><?php echo $fecha1;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Paludismo</td>
      <td><div align="center">
              <span class="style12">
              <input name="paludismo" type="checkbox" value="si" <?php if $myrow1['paludismo']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPaludismo" type="text" class="style12" id="anosPaludismo" size="2" maxlength="2"  value="<?php echo $myrow1['anosPaludismo']; ?>"/>
              </span></div></td>
      <td class="style12">Coraz&oacute;n</td>
      <td><div align="center">
              <span class="style12">
              <input name="corazon" type="checkbox" value="si" <?php if $myrow1['corazon']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosCorazon" type="text" class="style12" id="anosCorazon" size="2" maxlength="2" value="<?php echo $myrow1['anosCorazon']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Bronquitis</td>
      <td><div align="center">
              <span class="style12">
              <input name="bronquitis" type="checkbox" value="si" <?php if $myrow1['bronquitis']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosBronquitis" type="text" class="style12" id="anosBronquitis" size="2" maxlength="2" value="<?php echo $myrow1['anosBronquitis']; ?>" />
              </span></div></td>
      <td class="style12">Otros</td>
      <td><div align="center">
              <span class="style12">
              <input name="operacionesOtro" type="checkbox" value="si" <?php if $myrow1['operacionesOtro']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosOperacionesOtro" type="text" class="style12" id="anosOperacionesOtro" size="2" maxlength="2" value="<?php echo $myrow1['anosOperacionesOtro']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Neumon&iacute;a</td>
      <td><div align="center">
              <span class="style12">
              <input name="neumonia" type="checkbox" value="si" <?php if $myrow1['neumonia']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosNeumonia" type="text" class="style12" id="anosNeumonia" size="2" maxlength="2" value="<?php echo $myrow1['anosNeumonia']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td><div align="center"></div></td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Pleures&iacute;a</td>
      <td><div align="center">
              <span class="style12">
              <input name="pleuresia" type="checkbox" value="si" <?php if $myrow1['pleuresia']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPleuresia" type="text" class="style12" id="anosPleuresia" size="2" maxlength="2" <?php echo $myrow1['anosPleuresia']; ?> />
              </span></div></td>
      <td class="style12">TRAUMATISMOS</td>
      <td><div align="center"></div></td>
      <td><div align="center"></div></td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Hepatitis</td>
      <td><div align="center">
              <span class="style12">
              <input name="hepatitis" type="checkbox" value="si" <?php if $myrow1['hepatitis']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosHepatitis" type="text" class="style12" id="anosHepatitis" size="2" maxlength="2" value="<?php echo $myrow1['anosHepatitis']; ?>" />
              </span></div></td>
      <td class="style12">Cabeza</td>
      <td><div align="center">
              <span class="style12">
              <input name="cabeza" type="checkbox" value="si" <?php if $myrow1['cabeza']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosCabeza" type="text" class="style12" id="anosCabeza" size="2" maxlength="2" value="<?php echo $myrow1['anosCabeza']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Infecci&oacute;n en la Orina </td>
      <td><div align="center">
              <span class="style12">
              <input name="infeccionOrina" type="checkbox" value="si" <?php if $myrow1['infeccionOrina']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosInfeccionOrina" type="text" class="style12" id="anosInfeccionOrina" size="2" maxlength="2" value="<?php echo $myrow1['anosInfeccionOrina']; ?>" />
              </span></div></td>
      <td class="style12">T&oacute;rax (pecho) </td>
      <td><div align="center">
              <span class="style12">
              <input name="torax" type="checkbox" value="si" <?php if $myrow1['torax']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTorax" type="text" class="style12" id="anosTorax" size="2" maxlength="2" value="<?php echo $myrow1['anosTorax']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Fiebre Raum&aacute;tica </td>
      <td><div align="center">
              <span class="style12">
              <input name="fiebreRaumatica" type="checkbox" value="si" <?php if $myrow1['fiebreReumatica']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosFiebreRaumatica" type="text" class="style12" id="anosFiebreRaumatica" size="2" maxlength="2" value="<?php echo $myrow1['anosFiebreReumatica']; ?>" />
              </span></div></td>
      <td class="style12">Abd. (vientre) </td>
      <td><div align="center">
              <span class="style12">
              <input name="abd" type="checkbox" value="si" <?php if $myrow1['abd']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAbd" type="text" class="style12" id="anosAbd" size="2" maxlength="2" value="<?php echo $myrow1['anosAbd']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Enfermedad de Ri&ntilde;&oacute;n </td>
      <td><div align="center">
              <span class="style12">
              <input name="enfermedadRinon2" type="checkbox" value="si" <?php if $myrow1['enfermedadRinon2']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosEnfermedadRinon" type="text" class="style12" id="anosEnfermedadRinon" size="2" maxlength="2" value="<?php echo $myrow1['anosEnfermedadRinon']; ?>" />
              </span></div></td>
      <td class="style12">Fracturas</td>
      <td><div align="center">
              <span class="style12">
              <input name="fracturas" type="checkbox" value="si" <?php if $myrow1['fracturas']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosFracturas" type="text" class="style12" id="anosFracturas" size="2" maxlength="2" value="<?php echo $myrow1['anosFracturas']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Urticaria</td>
      <td><div align="center">
              <span class="style12">
              <input name="urticaria" type="checkbox" value="si" <?php if $myrow1['urticaria']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosUrticaria" type="text" class="style12" id="anosUrticaria" size="2" maxlength="2" value="<?php echo $myrow1['anosUrticaria']; ?>" />
              </span></div></td>
      <td class="style12">Espalda</td>
      <td><div align="center">
              <span class="style12">
              <input name="espalda" type="checkbox" value="si" <?php if $myrow1['espalda']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosEspalda" type="text" class="style12" id="anosEspalda" size="2" maxlength="2" value="<?php echo $myrow1['anosEspalda']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Catarros Frecuentes </td>
      <td><div align="center">
              <span class="style12">
              <input name="catarros" type="checkbox" value="si" <?php if $myrow1['catarros']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anoscatarros" type="text" class="style12" id="anoscatarros" size="2" maxlength="2" value="<?php echo $myrow1['anoscatarros']; ?>" />
              </span></div></td>
      <td class="style12">Otras</td>
      <td><div align="center">
              <span class="style12">
              <input name="traumatismosOtras" type="checkbox" value="si" <?php if $myrow1['traumatismoOtras']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTraumatismoOtro" type="text" class="style12" id="anosTraumatismoOtro" size="2" maxlength="2" value="<?php echo $myrow1['anosTraumatismoOtro']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Sinusitis</td>
      <td><div align="center">
              <span class="style12">
              <input name="sinusitis" type="checkbox" value="si" <?php if $myrow1['sinusitis']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosSinusitis" type="text" class="style12" id="anosSinusitis" size="2" maxlength="2" value="<?php echo $myrow1['anosSinusitis']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Asma</td>
      <td><div align="center">
              <span class="style12">
              <input name="asma2" type="checkbox" value="si" <?php if $myrow1['asma2']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAsma" type="text" class="style12" id="anosAsma" size="2" maxlength="2" value="<?php echo $myrow1['anosAsma']; ?>" />
              </span></div></td>
      <td class="style12">ALERGIA</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Enfisema</td>
      <td><div align="center">
              <span class="style12">
              <input name="enfisema" type="checkbox" value="si" <?php if $myrow1['enfisema']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosEnfisema" type="text" class="style12" id="anosEnfisema" size="2" maxlength="2" value="<?php echo $myrow1['anosEnfisema']; ?>" />
              </span></div></td>
      <td class="style12">Es alergico a: </td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Reumatismo</td>
      <td><div align="center">
              <span class="style12">
              <input name="reumatismo" type="checkbox" value="si"<?php if $myrow1['reumatismo']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosReumatismo" type="text" class="style12" id="anosReumatismo" size="2" maxlength="2" value="anosReumatismo" />
              </span></div></td>
      <td class="style12">Antitox. Tet. </td>
      <td><div align="center">
              <span class="style12">
              <input name="antitox" type="checkbox" value="si" <?php if $myrow1['antitox']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAntitox" type="text" class="style12" id="anosAntitox" size="2" maxlength="2" value="<?php echo $myrow1['anosAntitox']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Presi&oacute;n Alta </td>
      <td><div align="center">
              <span class="style12">
              <input name="presionAlta2" type="checkbox" value="si" <?php if $myrow1['presionAlta2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPresionAlta" type="text" class="style12" id="anosPresionAlta" size="2" maxlength="2" value="<?php echo $myrow1['anosPresionAlta']; ?>" />
              </span></div></td>
      <td class="style12">Penicilina</td>
      <td><div align="center">
              <span class="style12">
              <input name="penicilina" type="checkbox" value="si" <?php if $myrow1['penicilina']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPenicilina" type="text" class="style12" id="anosPenicilina" size="2" maxlength="2" value="<?php echo $myrow1['anosPenicilina']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Enfermedad Cardiaca </td>
      <td><div align="center">
              <span class="style12">
              <input name="enfermedadCardiaca" type="checkbox" value="si" <?php if $myrow1['enfermedadCardiaca']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosEnfermedadCardiaca" type="text" class="style12" id="anosEnfermedadCardiaca" size="2" maxlength="2" value="<?php echo $myrow1['anosEnfermedadCardiaca']; ?>" />
              </span></div></td>
      <td class="style12">Sulfas</td>
      <td><div align="center">
              <span class="style12">
              <input name="sulfas" type="checkbox" value="si" <?php if $myrow1['sulfas']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosSulfas" type="text" class="style12" id="anosSulfas" size="2" maxlength="2" value="<?php echo $myrow1['anosSulfas']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Anemia</td>
      <td><div align="center">
              <span class="style12">
              <input name="anemia2" type="checkbox" value="si"  <?php if $myrow1['anemia2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAnemia" type="text" class="style12" id="anosAnemia" size="2" maxlength="2" value="<?php echo $myrow1['anosAnemia']; ?>" />
              </span></div></td>
      <td class="style12">Otros</td>
      <td><div align="center">
              <span class="style12">
              <input name="alergiaOtro" type="checkbox" value="si"<?php if $myrow1['alergiaOtro']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAlergiaOtro" type="text" class="style12" id="anosAlergiaOtro" size="2" maxlength="2" value="<?php echo $myrow1['anos']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Sangrado F&aacute;cil </td>
      <td><div align="center">
              <span class="style12">
              <input name="sangradoFacil2" type="checkbox" value="si" <?php if $myrow1['sangradoFacil2']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosSangradoFacil" type="text" class="style12" id="anosSangradoFacil" size="2" maxlength="2" value="<?php echo $myrow1['anosSangradoFacil']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Sangrado Nasal </td>
      <td><div align="center">
              <span class="style12">
              <input name="sangradoNasal" type="checkbox" value="si" <?php if $myrow1['sangradoNasal']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosSangradoNasal" type="text" class="style12" id="anosSangradoNasal" size="2" maxlength="2" value="<?php echo $myrow1['anosSangradoNasal']; ?>" />
              </span></div></td>
      <td class="style12">Alimentos</td>
      <td><div align="center">
              <span class="style12">
              <input name="alimentos" type="checkbox" value="si" <?php if $myrow1['alimentos']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAlimentos" type="text" class="style12" id="anosAlimentos" size="2" maxlength="2" value="<?php echo $myrow1['anosAlimentos']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Ulcera</td>
      <td><div align="center">
              <span class="style12">
              <input name="ulcera" type="checkbox" value="si"  <?php if $myrow1['ulcera']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosUlcera" type="text" class="style12" id="anosUlcera" size="2" maxlength="2" value="<?php echo $myrow1['anosUlcera']; ?>" />
              </span></div></td>
      <td class="style12">Cosm&eacute;ticos</td>
      <td><div align="center">
              <span class="style12">
              <input name="cosmeticos" type="checkbox" value="si"  <?php if $myrow1['cosmeticos']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosCosmeticos" type="text" class="style12" id="anosCosmeticos" size="2" maxlength="2" value="<?php echo $myrow1['anosCosmeticos']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">C&aacute;ncer</td>
      <td><div align="center">
              <span class="style12">
              <input name="cancer2" type="checkbox" value="si" <?php if $myrow1['cencer2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosCancer" type="text" class="style12" id="anosCancer" size="2" maxlength="2" value="<?php echo $myrow1['anosCancer']; ?>" />
              </span></div></td>
      <td class="style12">Otros</td>
      <td><div align="center">
              <span class="style12">
              <input name="alergiaOtro2" type="checkbox" value="si" <?php if $myrow1['alergiaOtro2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosAlergiaOtro2" type="text" class="style12" id="anosAlergiaOtro2" size="2" maxlength="2" value="<?php echo $myrow1['anosAlergiaOtro2']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Hemorroides</td>
      <td><div align="center">
              <span class="style12">
              <input name="hemorroides" type="checkbox" value="si"  <?php if $myrow1['hemorroides']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosHemorroides" type="text" class="style12" id="anosHemorroides" size="2" maxlength="2" value="<?php echo $myrow1['anosHemorroides']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Transf. de Sangre </td>
      <td><div align="center">
              <span class="style12">
              <input name="transSangre" type="checkbox" value="si" <?php if $myrow1['transSangre']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTransSangre" type="text" class="style12" id="anosTransSangre" size="2" maxlength="2" value="<?php echo $myrow1['anosTransSangre']; ?>" />
              </span></div></td>
      <td class="style12">VACUNACI&Oacute;N</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Gota</td>
      <td><div align="center">
              <span class="style12">
              <input name="gota2" type="checkbox" value="si" <?php if $myrow1['gota2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosGota" type="text" class="style12" id="anosGota" size="2" maxlength="2" value="<?php echo $myrow1['anosGota']; ?>" />
              </span></div></td>
      <td class="style12">Viruela</td>
      <td><div align="center">
              <span class="style12">
              <input name="viruela" type="checkbox" value="si" <?php if $myrow1['viruela']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosViruela" type="text" class="style12" id="anosViruela" size="2" maxlength="2" value="<?php echo $myrow1['anosViruela']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Diabetes</td>
      <td><div align="center">
              <span class="style12">
              <input name="diabetes2" type="checkbox" value="si" <?php if $myrow1['diabetes2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosDiabetes" type="text" class="style12" id="anosDiabetes" size="2" maxlength="2" value="<?php echo $myrow1['anosDiabetes']; ?>" />
              </span></div></td>
      <td class="style12">Triple</td>
      <td><div align="center">
              <span class="style12">
              <input name="triple" type="checkbox" value="si" <?php if $myrow1['triple']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosTriple" type="text" class="style12" id="anosTriple" size="2" maxlength="2" value="<?php echo $myrow1['anosTriple']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Dolor de Cabeza </td>
      <td><div align="center">
              <span class="style12">
              <input name="dolorCabeza" type="checkbox" value="si" <?php if $myrow1['dolorCabeza']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosDolorCabeza" type="text" class="style12" id="anosDolorCabeza" size="2" maxlength="2" value="<?php echo $myrow1['anosDolorCabeza']; ?>" />
              </span></div></td>
      <td class="style12">Polio</td>
      <td><div align="center">
              <span class="style12">
              <input name="polio2" type="checkbox" value="si" <?php if $myrow1['polio2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosPolio2" type="text" class="style12" id="anosPolio2" size="2" maxlength="2" value="<?php echo $myrow1['anosPolio2']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Mareos</td>
      <td><div align="center">
              <span class="style12">
              <input name="mareos" type="checkbox" value="si" <?php if $myrow1['mareos']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosMareos" type="text" class="style12" id="anosMareos" size="2" maxlength="2" value="<?php echo $myrow1['anosMareos']; ?>"/>
              </span></div></td>
      <td class="style12">Sarampi&oacute;n</td>
      <td><div align="center">
              <span class="style12">
              <input name="sarampion2" type="checkbox" value="si" <?php if $myrow1['sarampion2']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosSarampion" type="text" class="style12" id="anosSarampion" size="2" maxlength="2" value="<?php echo $myrow1['anosSarampion']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td class="style12">Nerviosismo</td>
      <td><div align="center">
              <span class="style12">
              <input name="nerviosismo" type="checkbox" value="si" <?php if $myrow1['nerviosismo']echo 'checked=""'; ?> />
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosNerviosismo" type="text" class="style12" id="anosNerviosismo" size="2" maxlength="2" value="<?php echo $myrow1['anosNerviosismo']; ?>" />
              </span></div></td>
      <td class="style12">Otras</td>
      <td><div align="center">
              <span class="style12">
              <input name="vacunacionOtro" type="checkbox" value="si"  <?php if $myrow1['vacunacionOtro']echo 'checked=""'; ?>/>
              </span></div></td>
      <td>&nbsp;</td>
      <td><div align="center">
              <span class="style12">
              <input name="anosVacunacionOtro" type="text" class="style12" id="anosVacunacionOtro" size="2" maxlength="2" value="<?php echo $myrow1['anosVacunacionOtro']; ?>" />
              </span></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="submit" class="style12" id="actualizar" value="Modificar/Grabar" />
    </label>
  </p>
</form>
<p align="left">&nbsp;</p>
<p>&nbsp; </p>
<p>&nbsp;</p>
</body>
</html>
