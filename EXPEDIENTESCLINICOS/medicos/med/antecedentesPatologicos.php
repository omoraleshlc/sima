<?PHP include("/configuracion/expedientesclinicos/medicos/medicosmenu.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.Estilo3 {font-size: 16px; font-family: "Times New Roman", Times, serif; color: #FFFFFF; font-weight: bold; }
.catalogo {font-family: Verdana, Arial, Helvetica, sans-serif;  
    font-size: 9px;  
    color: #333333;  
}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
.style20 {
	color: #FFFFFF;
	font-weight: bold;
}
.style13 {color: #FFFFFF}
-->
</style>
</head>

<body class="style12">
<p align="center"><strong>	ANTECEDENTES - PATOLOGICOS - HEREDITARIOS</strong></p>
<form id="form1" name="form1" method="post" action="">
  <table width="282" border="0" align="left">
    <tr>
      <td colspan="5" class="style4"><strong>HISTORIA FAMILIAR </strong>- Tiene familiares con algunas de las siguientes enfermedades</td>
    </tr>
    <tr>
      <td colspan="5" class="style4"><strong>Marque si o no - Si tiene, que parentesco guardan con usted </strong></td>
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
      <td class="style4">Enfermedad</td>
      <td class="style2"><div align="center"><strong>si</strong></div></td>
      <td class="style2"><div align="center"><strong>no</strong></div></td>
      <td class="style4">Parentesco</td>
    </tr>
    <tr>
      <td width="20" class="style2">&nbsp;</td>
      <td width="87" class="style2">Anemia</td>
      <td width="21" class="style1"><span class="style2">
        <label>
          <input name="anemia" type="radio" value="si" />
      </label></span></td>
      <td width="22" class="style1"><span class="style2">
        <label>
        <input name="anemia" type="radio" value="no" />
        </label>
      </span></td>
      <td width="110" class="style1"><span class="style2">
        <label>
        <input name="parentescoAnemia" type="text" class="style12" id="parentescoAnemia" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Sangrado F&aacute;cil </td>
      <td class="style1"><div align="center">
        <input name="sangradoFacil" type="radio" value="si" />
      </div></td>
      <td class="style1"><div align="center">
        <input name="sangradoFacil" type="radio" value="no" />
      </div></td>
      <td class="style1"><input name="parentescoSangradoFacil" type="text" class="style12" id="parentescoSangradoFacil" /></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Leucemia</td>
      <td class="style2"><div align="center">
        <input name="leucemia" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="leucemia" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoLeucemia" type="text" class="style12" id="parentescoLeucemia" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Infecciones de Repetici&oacute;n </td>
      <td class="style2"><div align="center">
        <input name="infeccionesRepeticion" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="infeccionesRepeticion" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoInfeccionesRepeticion" type="text" class="style12" id="parentescoInfeccionesRepeticion" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Artitris Deformante </td>
      <td class="style2"><div align="center">
        <input name="artitrisDeformante" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="artitrisDeformante" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoArtritisDef" type="text" class="style12" id="parentescoArtritisDef" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Enfermedad del Coraz&oacute;n</td>
      <td class="style2"><div align="center">
        <input name="enfermedadCorazon" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="enfermedadCorazon" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoEnfermedadCorazon" type="text" class="style12" id="parentescoEnfermedadCorazon" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Enfermedad Cr&oacute;nica del Pulm&oacute;n </td>
      <td class="style2"><div align="center">
        <input name="enfermedadCronicaPulmon" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="enfermedadCronicaPulmon" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoEnfermedadCronicaPulmon" type="text" class="style12" id="parentescoEnfermedadCronicaPulmon" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Tuberculosis</td>
      <td class="style2"><div align="center">
        <input name="tuberculosis" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="tuberculosis" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoTuberculosis" type="text" class="style12" id="parentescoTuberculosis" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Presi&oacute;n Alta </td>
      <td class="style2"><div align="center">
        <input name="presionAlta" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="presionAlta" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoPresionAlta" type="text" class="style12" id="parentescoPresionAlta" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Enfermedad del Ri&ntilde;&oacute;n </td>
      <td class="style2"><div align="center">
        <input name="enfermedadRi&ntilde;on" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="enfermedadRi&ntilde;on" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoEnfermedadRi&ntilde;on" type="text" class="style12" id="parentescoEnfermedadRi&ntilde;on" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Asma</td>
      <td class="style2"><div align="center">
        <input name="asma" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="asma" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoAsma" type="text" class="style12" id="parentescoAsma" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Alergia</td>
      <td class="style2"><div align="center">
        <input name="alergia" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="alergia" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoAlergia" type="text" class="style12" id="parentescoAlergia" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Enfermedad Mental </td>
      <td class="style2"><div align="center">
        <input name="enfermedadMental" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="enfermedadMental" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoEnfermedadMental" type="text" class="style12" id="parentescoEnfermedadMental" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Convulsiones - Ataques </td>
      <td class="style2"><div align="center">
        <input name="convulsionesAtaques" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="convulsionesAtaques" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoConvulsiones" type="text" class="style12" id="parentescoConvulsiones" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Jaqueca - Dolores de Cabeza </td>
      <td class="style2"><div align="center">
        <input name="jaqueca" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="jaqueca" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoJaqueca" type="text" class="style12" id="parentescoJaqueca" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Diabetes</td>
      <td class="style2"><div align="center">
        <input name="diabetes" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="diabetes" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoDiabetes" type="text" class="style12" id="parentescoDiabetes" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Gota</td>
      <td class="style2"><div align="center">
        <input name="gota" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="gota" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoGota" type="text" class="style12" id="parentescoGota" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Obesidad</td>
      <td class="style2"><div align="center">
        <input name="obesidad" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="obesidad" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoObesidad" type="text" class="style12" id="parentescoObesidad" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Enfermedad de Tiroides </td>
      <td class="style2"><div align="center">
        <input name="enfermedadTiroides" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="enfermedadTiroides" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoEnfermedadTiroides" type="text" class="style12" id="parentescoEnfermedadTiroides" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Ulcera: Est&oacute;mago - Duodeno </td>
      <td class="style2"><div align="center">
        <input name="ulceraEstomago" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="ulceraEstomago" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoUlcera" type="text" class="style12" id="parentescoUlcera" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">Diarrea Cr&oacute;nica </td>
      <td class="style2"><div align="center">
        <input name="diarreaCronica" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="diarreaCronica" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoDiarreaCronica" type="text" class="style12" id="parentescoDiarreaCronica" />
      </span></td>
    </tr>
    <tr>
      <td class="style2">&nbsp;</td>
      <td class="style2">C&aacute;ncer</td>
      <td class="style2"><div align="center">
        <input name="cancer" type="radio" value="si" />
      </div></td>
      <td class="style2"><div align="center">
        <input name="cancer" type="radio" value="no" />
      </div></td>
      <td class="style2"><span class="style1">
        <input name="parentescoCancer" type="text" class="style12" id="parentescoCancer" />
      </span></td>
    </tr>
  </table>
  <table width="346" border="0">
    <tr>
      <td colspan="4"><div align="center">        
        <p class="style2">HOSPITAL &quot;LA CARLOTA&quot;</p>
        <p class="style2"><strong>UNIVERSIDAD DE MONTEMORELOS</strong></p>
        <p class="style2">HISTORIA CLINICA</p>
      </div></td>
      <td width="247"><span class="style2"></span><span class="style2"></span><span class="style2"></span></td>
    </tr>
    
    <tr>
      <td width="60"><p align="left" class="style2">&nbsp;</p></td>
      <td width="154"><span class="style2">NOMBRE</span></td>
      <td width="99"><span class="style2">EDAD ACTUAL O AL FALLECER </span></td>
      <td colspan="2"><span class="style2">VIVO SANO ENFERMO CAUSA DE MUERTE </span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style2">Padre</span></div></td>
      <td><input name="historiaClinicaPadre" type="text" class="style12" id="historiaClinicaPadre" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadPadre" type="text" class="style12" id="historiaEdadPadre" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><input name="historiaPadreVivo" type="text" class="style12" id="historiaPadreVivo" /></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style2">Madre</span></div></td>
      <td><input name="historiaClinicaMadre" type="text" class="style12" id="historiaClinicaMadre" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadMadre" type="text" class="style12" id="historiaEdadMadre" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaMadreVivo" type="text" class="style12" id="historiaMadreVivo" />
      </span></td>
    </tr>
    <tr>
      <td><div align="left"><span class="style2">Hermanos</span></div></td>
      <td>&nbsp;</td>
      <td><div align="center"></div></td>
      <td colspan="2"><span class="style2"></span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">1</span></div></td>
      <td><input name="historiaClinicaHermanos1" type="text" class="style12" id="historiaClinicaHermanos1" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHermanos1" type="text" class="style12" id="historiaEdadHermanos1" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHermanosVivo1" type="text" class="style12" id="historiaHermanosVivo1" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">2</span></div></td>
      <td><input name="historiaClinicaHermanos2" type="text" class="style12" id="historiaClinicaHermanos2" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHermanos2" type="text" class="style12" id="historiaEdadHermanos2" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHermanosVivo2" type="text" class="style12" id="historiaHermanosVivo2" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">3</span></div></td>
      <td><input name="historiaClinicaHermanos3" type="text" class="style12" id="historiaClinicaHermanos3" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHermanos3" type="text" class="style12" id="historiaEdadHermanos3" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHermanosVivo3" type="text" class="style12" id="historiaHermanosVivo3" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">4</span></div></td>
      <td><input name="historiaClinicaHermanos4" type="text" class="style12" id="historiaClinicaHermanos4" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHermanos3" type="text" class="style12" id="historiaEdadHermanos3" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHermanosVivo4" type="text" class="style12" id="historiaHermanosVivo4" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">5</span></div></td>
      <td><input name="historiaClinicaHermanos5" type="text" class="style12" id="historiaClinicaHermanos5" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHermanos5" type="text" class="style12" id="historiaEdadHermanos5" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHermanosVivo5" type="text" class="style12" id="historiaHermanosVivo5" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">6</span></div></td>
      <td><input name="historiaClinicaHermanos6" type="text" class="style12" id="historiaClinicaHermanos6" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHermanos6" type="text" class="style12" id="historiaEdadHermanos6" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHermanosVivo6" type="text" class="style12" id="historiaHermanosVivo6" />
      </span></td>
    </tr>
    <tr>
      <td><div align="left">Hijos</div></td>
      <td>&nbsp;</td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2"></span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">1</span></div></td>
      <td><input name="historiaClinicaHijos1" type="text" class="style12" id="historiaClinicaHijos1" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHijos1" type="text" class="style12" id="historiaEdadHijos1" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHijosVivo1" type="text" class="style12" id="historiaHijosVivo1" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">2</span></div></td>
      <td><input name="historiaClinicaHijos2" type="text" class="style12" id="historiaClinicaHijos2" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHijos2" type="text" class="style12" id="historiaEdadHijos2" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHijosVivo2" type="text" class="style12" id="historiaHijosVivo2" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">3</span></div></td>
      <td><input name="hisotriaClinicaHijos3" type="text" class="style12" id="hisotriaClinicaHijos3" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHijos3" type="text" class="style12" id="historiaEdadHijos3" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHijosVivo3" type="text" class="style12" id="historiaHijosVivo3" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">4</span></div></td>
      <td><input name="historiaClinicaHijos4" type="text" class="style12" id="historiaClinicaHijos4" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHijos4" type="text" class="style12" id="historiaEdadHijos4" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHijosVivo4" type="text" class="style12" id="historiaHijosVivo4" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">5</span></div></td>
      <td><input name="historiaClinicaHijos5" type="text" class="style12" id="historiaClinicaHijos5" /></td>
      <td><div align="center"><span class="style2">
        <input name="historiaEdadHijos5" type="text" class="style12" id="historiaEdadHijos5" size="3" maxlength="3" />
      </span></div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHijosVivo5" type="text" class="style12" id="historiaHijosVivo5" />
      </span></td>
    </tr>
    <tr>
      <td><div align="right"><span class="style2">6</span></div></td>
      <td><input name="historiaClinicaHijos6" type="text" class="style12" id="historiaClinicaHijos6" /></td>
      <td><div align="center">
        <input name="historiaEdadHijos6" type="text" class="style12" id="historiaEdadHijos6" size="3" maxlength="3" />
      </div></td>
      <td colspan="2"><span class="style2"></span><span class="style2">
        <input name="historiaHijosVivo6" type="text" class="style12" id="historiaHijosVivo6" />
      </span></td>
    </tr>
  </table>
  <label></label>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="619" border="0">
    <tr>
      <td colspan="6"><span class="style4">ENFERMEDADES PADECIDAS - Marque Si o No</span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><span class="style4">DATOS PERSONALES </span></td>
      <td><div align="right" class="style2">Edad </div> </td>
      <td><input name="edadDatosPersonales" type="text" class="style12" id="edadDatosPersonales" size="3" maxlength="3" /></td>
    </tr>
    <tr>
      <td width="15">&nbsp;</td>
      <td width="124"><span class="style2">Tuvo alguna Vez o tiene: </span></td>
      <td width="20"><div align="center" class="style2">si</div></td>
      <td width="20"><div align="center" class="style2">no</div></td>
      <td width="29"><div align="center" class="style2">
          <div align="center">A&ntilde;os </div>
      </div></td>
      <td width="100"><span class="style2">OPERACIONES:</span></td>
      <td width="20"><div align="center" class="style2">si</div></td>
      <td width="20"><div align="center" class="style2">no</div></td>
      <td width="29"><div align="center" class="style2">
          <div align="center">A&ntilde;os</div>
      </div></td>
      <td width="80">&nbsp;</td>
      <td width="85"><span class="style2">Nacionalidad</span></td>
      <td width="151"><input name="nacionalidad" type="text" class="style12" id="nacionalidad" /></td>
      <td width="106"><div align="center" class="style2">
        <div align="left">Fecha de Nacimiento</div>
      </div></td>
      <td width="453"><input name="fechaNacimiento" type="text" class="style12" id="fechaNacimiento" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td height="24"><span class="style2">Rubeola</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="rubeola" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="rubeola" type="radio" value="no" />
      </div></td>
      <td><label> </label>
          <div align="center">
            <input name="a&ntilde;osRubeola" type="text" class="style12" id="a&ntilde;osRubeola" size="2" maxlength="2" />
        </div></td>
      <td><span class="style2">Am&iacute;gdalas</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="amigdalas" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="amigdalas" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAmigdalas" type="text" class="style12" id="a&ntilde;osAmigdalas" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">Estado Civil </span></td>
      <td><input name="estadoCivil" type="text" class="style12" id="estadoCivil" /></td>
      <td><div align="right" class="style2">
        <div align="left">Religion</div>
      </div></td>
      <td><input name="religion" type="text" class="style12" id="religion" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Sarampi&oacute;n</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sarampion" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sarampion" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osSarampion" type="text" class="style12" id="a&ntilde;osSarampion" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Ap&eacute;ndice</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="apendice" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="apendice" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osApendice" type="text" class="style12" id="a&ntilde;osApendice" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">Profesion</span></td>
      <td><input name="profesion" type="text" class="style12" id="profesion" /></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Paperas</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="paperas" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="paperas" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPaperas" type="text" class="style12" id="a&ntilde;osPaperas" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Ves&iacute;cula</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="vesicula" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="vesicula" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osVesicula" type="text" class="style12" id="a&ntilde;osVesicula" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">Domicilio</span></td>
      <td><input name="domicilio" type="text" class="style12" id="domicilio" /></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Tosferina</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="tosferina" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="tosferina" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTosferina" type="text" class="style12" id="a&ntilde;osTosferina" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Est&oacute;mago</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="estomago" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="estomago" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osEstomago" type="text" class="style12" id="a&ntilde;osEstomago" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">Ciudad</span></td>
      <td><input name="ciudad" type="text" class="style12" id="ciudad" /></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Polio</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="polio" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="polio" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPolio" type="text" class="style12" id="a&ntilde;osPolio" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Mamas - pechos </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="mamas" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="mamas" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osMamas" type="text" class="style12" id="a&ntilde;osMamas" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Escarlatina</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="escarlatina" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="escarlatina" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osEscarlatina" type="text" class="style12" id="a&ntilde;osEscarlatina" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Matriz - Ovario </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="matriz" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="matriz" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osMatriz" type="text" class="style12" id="a&ntilde;osMatriz" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Difteria</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="difteria" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="difteria" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osDifteria" type="text" class="style12" id="a&ntilde;osDifteria" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Pr&oacute;stata</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="prostata" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="prostata" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osProstata" type="text" class="style12" id="a&ntilde;osProstata" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Meningitis</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="meningitis" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="meningitis" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osMeningitis" type="text" class="style12" id="a&ntilde;osMeningitis" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Hernia</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hernia" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hernia" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osHernia" type="text" class="style12" id="a&ntilde;osHernia" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td colspan="2"><span class="style2">Nombre Paciente: 
        <input name="paciente" type="text" class="style12" id="paciente" />
      </span></td>
      <td><span class="style2">Datos Obtenidos por: </span></td>
      <td><span class="style2">
        <input name="datosPor" type="text" class="style12" id="datosPor" />
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Mononucleosis</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="mononucleosis" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="mononucleosis" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osMononucleosis" type="text" class="style12" id="a&ntilde;osMononucleosis" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Tiroides</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="tiroides" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="tiroides" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTiroides" type="text" class="style12" id="a&ntilde;osTiroides" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">No. Expediente </span></td>
      <td><span class="style2">
        <input name="noExpediente" type="text" class="style12" id="noExpediente" />
      </span></td>
      <td><span class="style2">Doctor</span></td>
      <td><span class="style2">
        <input name="doctor" type="text" class="style12" id="doctor" />
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Tuberculosis (TBC) </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="tuberculosisTbc" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="tuberculosisTbc" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTuberculosisTbc" type="text" class="style12" id="a&ntilde;osTuberculosisTbc" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">V&aacute;rices</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="varices" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="varices" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osVarices" type="text" class="style12" id="a&ntilde;osVarices" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">Sexo</span></td>
      <td><span class="style2">
        <input name="sexo" type="text" class="style12" id="sexo" />
      </span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Contacto con TBC </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="contactoTbc" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="contactoTbc" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osContactoTbc" type="text" class="style12" id="a&ntilde;osContactoTbc" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Hemorroides</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hemorroides2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hemorroides2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osHemorroides2" type="text" class="style12" id="a&ntilde;osHemorroides2" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2">Fecha</span></td>
      <td><span class="style2">
        <input name="fecha" type="text" class="style12" id="fecha" />
      </span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Paludismo</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="paludismo" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="paludismo" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPaludismo" type="text" class="style12" id="a&ntilde;osPaludismo" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Coraz&oacute;n</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="corazon" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="corazon" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osCorazon" type="text" class="style12" id="a&ntilde;osCorazon" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Bronquitis</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="bronquitis" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="bronquitis" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osBronquitis" type="text" class="style12" id="a&ntilde;osBronquitis" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Otros</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="operacionesOtro" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="operacionesOtro" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osOperacionesOtro" type="text" class="style12" id="a&ntilde;osOperacionesOtro" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Neumon&iacute;a</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="neumonia" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="neumonia" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osNeumonia" type="text" class="style12" id="a&ntilde;osNeumonia" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2"></span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Pleures&iacute;a</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="pleuresia" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="pleuresia" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPleuresia" type="text" class="style12" id="a&ntilde;osPleuresia" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">TRAUMATISMOS</span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Hepatitis</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hepatitis" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hepatitis" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osHepatitis" type="text" class="style12" id="a&ntilde;osHepatitis" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Cabeza</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="cabeza" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="cabeza" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osCabeza" type="text" class="style12" id="a&ntilde;osCabeza" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Infecci&oacute;n en la Orina </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="infeccionOrina" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="infeccionOrina" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osInfeccionOrina" type="text" class="style12" id="a&ntilde;osInfeccionOrina" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">T&oacute;rax (pecho) </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="torax" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="torax" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTorax" type="text" class="style12" id="a&ntilde;osTorax" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Fiebre Raum&aacute;tica </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="fiebreRaumatica" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="fiebreRaumatica" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osFiebreRaumatica" type="text" class="style12" id="a&ntilde;osFiebreRaumatica" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Abd. (vientre) </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="abd" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="abd" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAbd" type="text" class="style12" id="a&ntilde;osAbd" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Enfermedad de Ri&ntilde;&oacute;n </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="enfermedadRi&ntilde;on2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="enfermedadRi&ntilde;on2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osEnfermedadRi&ntilde;on" type="text" class="style12" id="a&ntilde;osEnfermedadRi&ntilde;on" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Fracturas</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="fracturas" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="fracturas" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osFracturas" type="text" class="style12" id="a&ntilde;osFracturas" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Urticaria</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="urticaria" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="urticaria" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osUrticaria" type="text" class="style12" id="a&ntilde;osUrticaria" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Espalda</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="espalda" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="espalda" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osEspalda" type="text" class="style12" id="a&ntilde;osEspalda" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Catarros Frecuentes </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="catarros" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="catarros" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;oscatarros" type="text" class="style12" id="a&ntilde;oscatarros" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Otras</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="traumatismosOtras" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="traumatismosOtras" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTraumatismoOtro" type="text" class="style12" id="a&ntilde;osTraumatismoOtro" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Sinusitis</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sinusitis" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sinusitis" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osSinusitis" type="text" class="style12" id="a&ntilde;osSinusitis" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2"></span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Asma</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="asma2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="asma2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAsma" type="text" class="style12" id="a&ntilde;osAsma" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">ALERGIA</span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Enfisema</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="enfisema" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="enfisema" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osEnfisema" type="text" class="style12" id="a&ntilde;osEnfisema" size="2" maxlength="2" />
      </div></td>
      <td>Es alergico a: </td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Reumatismo</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="reumatismo" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="reumatismo" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osReumatismo" type="text" class="style12" id="a&ntilde;osReumatismo" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Antitox. Tet. </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="antitox" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="antitox" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAntitox" type="text" class="style12" id="a&ntilde;osAntitox" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Presi&oacute;n Alta </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="presionAlta2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="presionAlta2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPresionAlta" type="text" class="style12" id="a&ntilde;osPresionAlta" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Penicilina</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="penicilina" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="penicilina" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPenicilina" type="text" class="style12" id="a&ntilde;osPenicilina" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Enfermedad Cardiaca </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="enfermedadCardiaca" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="enfermedadCardiaca" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osEnfermedadCardiaca" type="text" class="style12" id="a&ntilde;osEnfermedadCardiaca" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Sulfas</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sulfas" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sulfas" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osSulfas" type="text" class="style12" id="a&ntilde;osSulfas" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Anemia</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="anemia2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="anemia2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAnemia" type="text" class="style12" id="a&ntilde;osAnemia" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Otros</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="alergiaOtro" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="alergiaOtro" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAlergiaOtro" type="text" class="style12" id="a&ntilde;osAlergiaOtro" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Sangrado F&aacute;cil </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sangradoFacil2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sangradoFacil2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osSangradoFacil" type="text" class="style12" id="a&ntilde;osSangradoFacil" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2"></span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Sangrado Nasal </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sangradoNasal" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sangradoNasal" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osSangradoNasal" type="text" class="style12" id="a&ntilde;osSangradoNasal" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Alimentos</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="alimentos" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="alimentos" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAlimentos" type="text" class="style12" id="a&ntilde;osAlimentos" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Ulcera</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="ulcera" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="ulcera" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osUlcera" type="text" class="style12" id="a&ntilde;osUlcera" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Cosm&eacute;ticos</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="cosmeticos" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="cosmeticos" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osCosmeticos" type="text" class="style12" id="a&ntilde;osCosmeticos" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">C&aacute;ncer</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="cancer2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="cancer2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osCancer" type="text" class="style12" id="a&ntilde;osCancer" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Otros</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="alergiaOtro2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="alergiaOtro2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osAlergiaOtro2" type="text" class="style12" id="a&ntilde;osAlergiaOtro2" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Hemorroides</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hemorroides" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="hemorroides" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osHemorroides" type="text" class="style12" id="a&ntilde;osHemorroides" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2"></span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Transf. de Sangre </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="transSangre" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="transSangre" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTransSangre" type="text" class="style12" id="a&ntilde;osTransSangre" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">VACUNACI&Oacute;N</span></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td><div align="center"><span class="style2"></span></div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Gota</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="gota2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="gota2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osGota" type="text" class="style12" id="a&ntilde;osGota" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Viruela</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="viruela" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="viruela" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osViruela" type="text" class="style12" id="a&ntilde;osViruela" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Diabetes</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="diabetes2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="diabetes2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osDiabetes" type="text" class="style12" id="a&ntilde;osDiabetes" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Triple</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="triple" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="triple" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osTriple" type="text" class="style12" id="a&ntilde;osTriple" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Dolor de Cabeza </span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="dolorCabeza" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="dolorCabeza" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osDolorCabeza" type="text" class="style12" id="a&ntilde;osDolorCabeza" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Polio</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="polio2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="polio2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osPolio2" type="text" class="style12" id="a&ntilde;osPolio2" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Mareos</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="mareos" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="mareos" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osMareos" type="text" class="style12" id="a&ntilde;osMareos" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Sarampi&oacute;n</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sarampion2" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="sarampion2" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osSarampion" type="text" class="style12" id="a&ntilde;osSarampion" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="style2">Nerviosismo</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="nerviosismo" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="nerviosismo" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osNerviosismo" type="text" class="style12" id="a&ntilde;osNerviosismo" size="2" maxlength="2" />
      </div></td>
      <td><span class="style2">Otras</span></td>
      <td><div align="center"><span class="style2"></span>
              <input name="vacunacionOtro" type="radio" value="si" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="vacunacionOtro" type="radio" value="no" />
      </div></td>
      <td><div align="center"><span class="style2"></span>
              <input name="a&ntilde;osVacunacionOtro" type="text" class="style12" id="a&ntilde;osVacunacionOtro" size="2" maxlength="2" />
      </div></td>
      <td>&nbsp;</td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
      <td><span class="style2"></span></td>
    </tr>
  </table>
  </form>
<p align="left">&nbsp;</p>
<p>&nbsp; </p>
<p>&nbsp;</p>
</body>
</html>
