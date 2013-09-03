<?php require("/configuracion/ventanasEmergentes.php"); ?>
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
           
        if( vacio(F.nombrePaciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.deposito.value) == false ) {   
                alert("Por Favor, escribe el dep�sito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el m�dico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el l�mite que desees asignar!")   
                return false   
        }   
}   
  
  
  
  
</script>

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=260,height=300,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=850,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=650,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=220,height=250,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=270,height=350,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=270,height=350,scrollbars=YES") 
} 
</script> 
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>


<?php
if($_POST['acepta'] and $_POST['paciente'] ){
$q = "UPDATE clientesInternos set 
peso='".$_POST['peso']."',
dx='".$_POST['dx']."',
medico='".$_POST['medico']."',
paciente='".$_POST['paciente']."',

autoriza='".$usuario."',

cuarto='".$_POST['cuarto']."',
tipoResponsable='".$_POST['tipoResponsable']."',
medicoForaneo='".$_POST['medicoForaneo']."',
nombreResponsable='".$_POST['nombreResponsable']."',
apaternoResponsable='".$_POST['apaternoResponsable']."',
amaternoResponsable='".$_POST['amaternoResponsable']."',
direccionResponsable='".$_POST['direccionResponsable']."',
telefonoResponsable='".$_POST['telefonoResponsable']."',
ocupacionResponsable='".$_POST['ocupacionResponsable']."',
edad='".$_POST['edad']."',
parentescoResponsable='".$_POST['parentescoResponsable']."',

tipoAccidente='".$_POST['tipoAccidente']."',
fechaAccidente='".$_POST['fechaAccidente']."',
horaAccidente='".$_POST['horaAccidente']."',
lugarAccidente='".$_POST['lugarAccidente']."',
llegoHospital='".$_POST['llegoHospital']."',
ministerio='".$_POST['ministerio']."',
motivoConsulta='".$_POST['motivoConsulta']."',
alergiaT='".$_POST['alergiaT']."',
alergiaP='".$_POST['alergiaP']."',
alergiaR='".$_POST['alergiaR']."',
alergiaPA='".$_POST['alergiaPA']."',
tiposAlergias='".$_POST['tiposAlergias']."',
peso='".$_POST['peso']."',
dx='".$_POST['dx']."',
notaIngreso='".$_POST['notaIngreso']."'
WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
?>
<script>
alert("PACIENTE ACTUALIZADO");
</script>
<?php 

}


$sSQL32= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['keyClientesInternos']."'";
$result32=mysql_db_query($basedatos,$sSQL32);
$myrow32 = mysql_fetch_array($result32);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<h1 align="center" class="titulos">Actualizar Registro de Emergencia <?php echo $leyenda; ?>
  </h1>
<form id="form1" name="form1" method="post" action="#" >
<img src="../../imagenes/bordestablas/borde1.png" alt="bo1" width="642" height="24" align="center" />
<table width="642" align="center" cellpadding="0" cellspacing="0" class="style7" style="border: 0px solid #000000;">
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td width="137"><div align="left" class="negromid">Nombre del Paciente</div></td>
        <td width="571"><label>
        <input name="paciente" type="text" class="camposmid" id="nombrePaciente" size="60" 
		value="<?php echo $myrow32['paciente'];?>"/>
        </label>
          &nbsp;
     

          <input name="nCuenta" type="hidden" class="camposmid" id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
        <input name="numeroE" type="hidden" class="camposmid" id="numeroE" value="<?php echo $numeroEs= $NUMEROE; ?>" readonly="" /></td>
      </tr>
	  
	 
      <tr bgcolor="#CCCCCC" class="style12">
        <td class="negromid">Edad</td>
        <td class="style12"><input name="edad" type="text" class="camposmid" size="3" value="<?php echo $myrow32['edad'];?>"/></td>
      </tr>
      <tr bgcolor="#CCCCCC" class="style12">
        <td colspan="2" class="style12"><div align="center" class="none">M&eacute;dico Responsable del Internamiento </span></div></td>
      </tr>
      <tr bgcolor="#CCCCCC" class="style12">
        <td class="style7"><label></label>
            </label>
            <label>
            <span class="Estilo24">
            <div align="left" class="negromid">M&eacute;dico de Internamiento </div>
        </label></td>
        <td class="style12">
        <?php 
$sqlNombre11 = "SELECT * from medicos 
WHERE
entidad='".$entidad."' AND
status='A'
ORDER BY apellido1 ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
  <select name="medico" class="camposmid" id="medico" />
<option value="">---</option>

  

  <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
  <option
    <?php   if($medico==$rNombre11["numMedico"] or $myrow32['medico']==$rNombre11["numMedico"])echo 'selected'; ?>
   value="<?php echo $rNombre11["numMedico"];?>"> <?php echo 
	  $rNombre11["apellido1"]." ".$rNombre11["apellido2"]
	  ." ".$rNombre11["apellido3"]." ".$rNombre11["nombre1"]." ".$rNombre11["nombre2"];?></option>
  <?php } ?>

        
          <div align="left"></div>        </td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="style7"><div align="left"><span class="Estilo24">
        </span></div>          <span class="Estilo24"><label></label>
          </label>
          <label> 
          <div align="left" class="negromid">Medico Foraneo </div>
        </label>
        </span></td>
        <td><div align="left">
          <input name="medicoForaneo" type="text" class="camposmid" id="medicoForaneo"
		   value="<?php 
		  if($_POST['medicoForaneo']){
		  echo $_POST['medicoForaneo'];

		  } else if($myrow3['medicoForaneo']){
		  echo $myrow3['medicoForaneo']; 
		  }
		  ?>" size="60" />
        </div></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">Tipo de Accidente</td>
        <td><label>
          <input name="tipoAccidente" type="text" class="camposmid" id="tipoAccidente"
		   value="<?php echo $myrow32['tipoAccidente']; ?>" size="60" />
        </label></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
	  
	 
        <td class="negromid">Fecha Accidente </td>
        <td><label>
          <input name="fechaAccidente" type="text" class="camposmid" id="fechaAccidente" value="<?php 
		  if($_POST['fechaAccidente']){
		  echo $_POST['fechaAccidente'];
		  } else {
		  echo $fecha1;
		  }
		  ?>" />
        </label></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">Hora Accidente </td>
        <td><label>
          <input name="horaAccidente" type="text" class="camposmid" id="horaAccidente" value="<?php echo $myrow32['horaAccidente'];?>" />
        </label></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">Lugar Accidente </td>
        <td><label>
          <textarea name="lugarAccidente" cols="40" wrap="virtual" class="camposmid" id="lugarAccidente"><?php echo $myrow32['lugarAccidente'];?></textarea>
        </label></td>
      </tr>
	
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">&iquest;C&oacute;mo lleg&oacute; al Hospital? </td>
        <td><textarea name="llegoHospital" cols="40" wrap="virtual" class="camposmid" id="llegoHospital"><?php echo ltrim($myrow32['llegoHospital']);?></textarea></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">&iquest;Avis&oacute; al Ministerio? </td>
        <td><label>
          <input name="ministerio" type="checkbox" id="ministerio" value="si" <?php 
		  if($myrow32['ministerio'])echo 'checked=""';
		  ?> />
        </label></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">Alergias (Si Tiene) </td>
        <td><textarea name="tiposAlergias" cols="60" wrap="virtual" class="camposmid" id="tiposAlergias"><?php echo $myrow32['tiposAlergias'];?></textarea></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td><div align="center" class="negromid">T</div></td>
        <td><label>
          <input name="alergiaT" type="checkbox" id="alergiaT" value="si" <?php 
		  if($myrow32['alergiaT'])echo 'checked=""';
		  ?>  />
        </label></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td><div align="center" class="negromid">P</div></td>
        <td><input name="alergiaP" type="checkbox" id="alergiaP" value="si" <?php 
		  if($myrow32['alergiaP'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td><div align="center" class="negromid">R</div></td>
        <td><input name="alergiaR" type="checkbox" id="alergiaR" value="si" <?php 
		  if($myrow32['alergiaR'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td><div align="center" class="negromid">PA</div></td>
        <td><input name="alergiaPA" type="checkbox" id="alergiaPA" value="si" <?php 
		  if($myrow32['alergiaPA'])echo 'checked=""';
		  ?>/></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td class="negromid">Peso</td>
        <td><label>
          <input name="peso" type="text" class="camposmid" id="peso" value="<?php echo $myrow32['peso'];?>"/>
          <br />
        </label></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td colspan="2"><div align="center" class="none">NOTA DE INGRESO </div></td>
      </tr>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td colspan="2"><div align="center"></div></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td height="191" colspan="2"><textarea name="notaIngreso" cols="100" rows="10" wrap="virtual"  class="camposmid" id="notaIngreso"><?php echo trim($myrow32['notaIngreso']);?></textarea></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td colspan="2"><div align="center" class="none">DIAGNOSTICO</div></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td colspan="2"><textarea name="dx" cols="100" rows="10" wrap="virtual"  class="camposmid" id="dx"><?php echo trim($myrow32['dx']);?></textarea></td>
      </tr>
      <tr valign="middle" bgcolor="#CCCCCC" class="catalogo">
        <td height="71" colspan="2"><div align="left"></div>          <label>
        <div align="center">
          <input name="acepta" type="image" src="../../imagenes/btns/refresh.png" id="acepta" value="Actualizar Datos" />
          <br />
          <?php if($_POST['acepta']){ ?>
          <?php } ?>
          <br />
        </div>
        </label></td>
      </tr>
    </table>
	
<img src="../../imagenes/bordestablas/borde2.png" alt="bo1" width="642" height="24" align="center" />
<input name="nombrePaciente1" type="hidden" class="Estilo24" id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    <input name="nombrePaciente2" type="hidden" class="Estilo24" id="nombrePaciente2" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>" />
    <input name="flag" type="hidden" class="Estilo24" id="flag" size="60" readonly="" 
		value="<?php 
		if($_POST['acepta']){
		echo 'enabled';
		} else {
		echo 'disabled';
		}
		?>" />
</form>
</body>
</html>