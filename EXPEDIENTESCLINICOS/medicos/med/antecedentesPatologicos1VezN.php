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
	 
$sSQL1= "Select  * From antecedentesInfantiles WHERE entidad='".$entidad."' AND numeroE = '".$_POST['numCliente']."' or numeroE='".$_GET['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
	 
if($myrow1['numeroE']){	 
$agrega = "INSERT INTO antecedentesInfantiles (
nombrePadre,nombreMadre,edadPadre,edadMadre,ocupacionPadre,ocupacionMadre,ahf,
diabetesMelitus,hipertension,obesidad,hematologicos,crisisConvulsivas,
neoplasicos,asmaticos,malformacionesCongenitas,alergicos,
apnG,apnP,apnA,apnC,duracionEmbarazo,complicacionesEmbarazo,
partoNormal,cesarea,razonCesarea,
peso,lloroNacer,
complicacionesPerinatales,
alimentacion,
socioEconomico,
colicoLactante,enuresis,trastornosSueno,
succionPulgar,antecedentesPatologicosPrevios,
padecimientosImportantes
) values (

'".strtoupper($_POST['nombrePadre'])."','".strtoupper($_POST['nombreMadre'])."','".$_POST['edadPadre']."','".$_POST['edadMadre']."','".strtoupper($_POST['ocupacionPadre'])."','".strtoupper($_POST['ocupacionMadre'])."','".strtoupper($_POST['ahf'])."',



'".$_POST['diabetesMelitus']."','".$_POST['hipertension']."','".$_POST['obesidad']."','".$_POST['hematologicos']."',
'".$_POST['crisisConvulsivas']."','".$_POST['neoplasicos']."','".$_POST['asmaticos']."','".$_POST['malformacionesCongenitas']."','".$_POST['alergicos']."',





'".$_POST['apnG']."','".$_POST['apnP']."','".$_POST['apnA']."','".$_POST['apnC']."',
'".$_POST['duracionEmbarazo']."','".strtoupper($_POST['complicacionesPerinatales'])."','".strtoupper($_POST['alimentacion'])."',
'".strtoupper($_POST['socioEconomico'])."','".$_POST['colicoLactante']."','".$_POST['enuresis']."',
'".$_POST['trastornosSueno']."','".strtoupper($_POST['otros'])."',

'".strtoupper($_POST['antecedentesPatologicos'])."',
'".strtoupper($_POST['padecimientosImportantes'])."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
} else {
$q = "UPDATE antecedentesInfantiles set 
nombrePadre='".strtoupper($_POST['nombrePadre'])."', 
nombreMadre='".strtoupper($_POST['nombreMadre'])."',

edadPadre='".$_POST['edadPadre']."',
edadMadre='".$_POST['edadMadre']."',
ocupacionPadre='".strtoupper($_POST['ocupacionPadre'])."',
ocupacionMadre='".strtoupper($_POST['ocupacionMadre'])."',
ahf='".strtoupper($_POST['ahf'])."',


diabetesMelitus='".$_POST['diabetesMelitus']."',
hipertension='".$_POST['hipertension']."',
obesidad='".$_POST['obesidad']."',
hematologicos='".$_POST['hematologicos']."',
crisisConvulsivas='".$_POST['crisisConvulsivas']."',
neoplasicos='".$_POST['neoplasicos']."',
asmaticos='".$_POST['asmaticos']."',
malformacionesCongenitas='".$_POST['malformacionesCongenitas']."',
alergicos='".$_POST['alergicos']."',





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
	 
	 
	 $sSQL1= "SELECT *
FROM
antecedentes
WHERE 
numeroE='".$_GET['numCliente']."' or numeroE='".$_GET['numeroExpediente']."'
 ";
 $result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
	 ?> 
	  
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style12 {font-size: 10px}
.style23 {font-size: 10px; font-weight: bold; }
.style24 {font-size: 10px; font-weight: bold; color: #FFFFFF; }
.style25 {font-size: 10px; color: #FFFFFF; }
-->
</style>
<form name="form1" method="post" action="">
  <p align="center">&nbsp;</p>
  <h2 align="center"><?php
  echo $nombrePaciente;
  
  ?></h2>
  <table width="723" border="0" align="center" bordercolor="#0000FF">
    <tr>
      <th colspan="2" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style25">Datos Familiares </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style12" scope="col">&nbsp;</th>
    </tr>
    <tr>
      <th width="105" bgcolor="#FFCCFF" class="style12" scope="col"> <div align="left">Nombre Padre </div></th>
      <th width="67" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">
        <input name="nombrePadre" type="text" class="style12" id="nombrePadre" value="<?php echo $myrow1['nombrePadre'];?>">
      </div></th>
      <th width="16" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
      <th width="120" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">Edad Padre </div></th>
      <th width="115" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">
        <input name="edadPadre" type="text" class="style12" id="edadPadre" size="3" value="<?php echo $myrow1['edadPadre'];?>">
      </div></th>
      <th width="38" bgcolor="#FFCCFF" class="style12" scope="col">&nbsp;</th>
      <th width="106" bgcolor="#FFCCFF" class="style12" scope="col"><div align="left">Ocupaci&oacute;n Padre </div></th>
      <th width="122" bgcolor="#FFCCFF" class="style12" scope="col"> <div align="left">
        <input name="ocupacionPadre" type="text" class="style12" id="ocupacionPadre" value="<?php echo $myrow1['ocupacionPadre'];?>">
      </div></th>
    </tr>
    <tr>
      <td class="style12">Nombre Madre </td>
      <td class="style12"><input name="nombreMadre" type="text" class="style12" id="nombreMadre" value="<?php echo $myrow1['nombreMadre'];?>"></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Edad Madre </td>
      <td class="style12"><input name="edadMadre" type="text" class="style12" id="edadMadre" size="3" value="<?php echo $myrow1['edadMadre'];?>"></td>
      <td class="style12">&nbsp;</td>
      <td class="style12"><div align="left">Ocupaci&oacute;n Madre </div></td>
      <td class="style12"><input name="ocupacionMadre" type="text" class="style12" id="ocupacionMadre" value="<?php echo $myrow1['ocupacionMadre'];?>"></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">AHF (Padres, Hermanos,etc.) </td>
      <td bgcolor="#FFCCFF" class="style12"><textarea name="ahf" class="style12" id="ahf"><?php echo $myrow1['ahf'];?></textarea></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#660066" class="style25">(Sindrome X) </td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Diabetes Mellitus </td>
      <td bgcolor="#FFCCFF" class="style12"><label>
        <input name="diabetesMelitus" type="checkbox" id="diabetesMelitus" value="si" <?php if($myrow1['diabetesMelitus'])echo 'checked=""';?>>
      </label></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Hipertension</td>
      <td bgcolor="#FFCCFF" class="style12"><input type="checkbox" name="hipertension" value="si" <?php if($myrow1['hipertension'])echo 'checked=""';?>></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">Obesidad</td>
      <td class="style12"><input name="obesidad" type="checkbox" id="obesidad" value="si" <?php if($myrow1['obesidad'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Hematol&oacute;gicos</td>
      <td class="style12"><input name="hematologicos" type="checkbox" id="hematologicos" value="si" <?php if($myrow1['hematologicos'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Crisis Convulsivas </td>
      <td bgcolor="#FFCCFF" class="style12"><input name="crisisConvulsivas" type="checkbox" id="crisisConvulsivas" value="si" <?php if($myrow1['crisisConvulsivas'])echo 'checked=""';?>></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Neopl&aacute;sicos</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="neoplasicos" type="checkbox" id="neoplasicos" value="si" <?php if($myrow1['neoplasicos'])echo 'checked=""';?>></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12"><label></label></td>
    </tr>
    <tr>
      <td class="style12">Asm&aacute;ticos</td>
      <td class="style12"><input name="asmaticos" type="checkbox" id="asmaticos" value="si" <?php if($myrow1['asmaticos'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Malformaciones Cong&eacute;nicas </td>
      <td class="style12"><input name="malformacionesCongenicas" type="checkbox" id="malformacionesCongenicas" value="si" <?php if($myrow1['malformacionesCongenicas'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12"><label></label></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Al&eacute;rgicos</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="alergicos" type="checkbox" id="alergicos" value="si" <?php if($myrow1['alergicos'])echo 'checked=""';?>></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12"><label></label></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#660066" class="style24">APN:</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">G</td>
      <td class="style12"><input name="apnG" type="checkbox" id="apnG" value="si" <?php if($myrow1['apnG'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Duraci&oacute;n Embarazo </td>
      <td class="style12"><label>
        <input name="duracionEmbarazo" type="text" class="style12" id="duracionEmbarazo" value="<?php echo $myrow1['duracionEmbarazo'];?>">
      </label></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">P</td>
      <td bgcolor="#FFCCFF" class="style12">
	  <input name="apnP" type="checkbox" id="apnP" value="si" <?php if($myrow1['apnP'])echo 'checked=""';?>></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style23">Complicaciones</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">A</td>
      <td class="style12"><input name="apnA" type="checkbox" id="apnA" value="si" <?php if($myrow1['apnA'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Parto Normal </td>
      <td class="style12"><input type="checkbox" name="partoNormal" value="si" <?php if($myrow1['partoNormal'])echo 'checked=""';?>></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">C</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="apnC" type="checkbox" id="apnC" value="si" <?php if($myrow1['apnC'])echo 'checked=""';?>></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Ces&aacute;rea</td>
      <td bgcolor="#FFCCFF" class="style12"><input name="cesarea" type="checkbox" id="cesarea" value="si"></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Raz&oacute;n Ces&aacute;rea </td>
      <td bgcolor="#FFCCFF" class="style12"><input name="razonCesarea" type="text" class="style12" id="razonCesarea" value="<?php echo $myrow1['razonCesarea'];?>"></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Peso</td>
      <td class="style12"><input name="peso" type="text" class="style12" id="peso" value="<?php echo $myrow1['peso'];?>" size="3"></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Llor&oacute; al nacer (pegarle) </td>
      <td class="style12"><input type="checkbox" name="lloroNacer" value="si" <?php if($myrow1['lloroNacer'])echo 'checked=""';?>></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Complicaciones Perinatales </td>
      <td bgcolor="#FFCCFF" class="style12"><input name="complicacionesPerinatales" type="text" class="style12" id="complicacionesPerinatales" value="<?php echo $myrow1['complicacionesPerinatales'];?>"></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Alimentaci&oacute;n (ob) </td>
      <td bgcolor="#FFCCFF" class="style12"><input name="alimentacion" type="text" class="style12" id="alimentacion" value="<?php echo $myrow1['alimentacion'];?>"></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Socio Econ&oacute;mico (ob) </td>
      <td bgcolor="#FFCCFF" class="style12"><input name="socioEconomico" type="text" class="style12" id="socioEconomico" value="<?php echo $myrow1['socioEconomico'];?>"></td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#660066" class="style25">H&aacute;bitos y conducta </td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">C&oacute;lico lactante </td>
      <td class="style12"><input name="colicoLactante" type="checkbox" id="colicoLactante" value="si"></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Enuresis</td>
      <td class="style12"><input name="enuresis" type="text" class="style12" id="enuresis" value="<?php echo $myrow1['enuresis'];?>"></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">Trastornos Sue&ntilde;o </td>
      <td class="style12"><input name="trastornosSueno" type="text" class="style12" id="trastornosSueno" value="<?php echo $myrow1['trastornosSueno'];?>"></td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Succi&oacute;n Pulgar </td>
      <td bgcolor="#FFCCFF" class="style12"><input name="succionPulgar" type="checkbox" id="succionPulgar" value="si"></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">Otros</td>
      <td bgcolor="#FFCCFF" class="style12"><textarea name="otros" class="style12" id="otros"><?php echo $myrow1['otros'];?></textarea></td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">Antecedentes patol&oacute;gicos Previos </td>
      <td colspan="3" class="style12"><textarea name="antecedentesPatologicosPrevios" class="style12" id="antecedentesPatologicosPrevios"><?php echo $myrow1['antecedentesPatologicosPrevios'];?></textarea></td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#660066" class="style12"><span class="style24">Pacedimientos Importantes </span></td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
      <td bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style23">&nbsp;</td>
      <td colspan="6" rowspan="6" class="style12"><textarea name="padecimientosImportantes" cols="100" rows="12" class="style12" id="padecimientosImportantes"><?php echo $myrow1['padecimientosImportantes'];?></textarea></td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Alergias a medicamentos </td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">Enfermedades cr&oacute;nicas </td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Hospitalizaciones</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">Traumatismos importantes </td>
      <td class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="#FFCCFF" class="style12">Cirug&iacute;as</td>
      <td bgcolor="#FFCCFF" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
      <td class="style12">&nbsp;</td>
    </tr>
  </table>
  <p align="center">
    <label>
    <input name="actualizar" type="submit" class="style23" id="actualizar" value="Grabar/Modificar">
    </label>
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

