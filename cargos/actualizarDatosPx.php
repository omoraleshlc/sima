<?php include("/configuracion/ventanasEmergentes.php"); ?>
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
                alert("Por Favor, escribe el depósito!")   
                return false   
        } else if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje el médico responsable del internamiento!")   
                return false   
        }  else if( vacio(F.cuarto.value) == false ) {   
                alert("Por Favor, escoje el cuarto que desees asignar!")   
                return false   
        }  else if( vacio(F.limiteCredito.value) == false ) {   
                alert("Por Favor, escoje el límite que desees asignar!")   
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
   window.open(URL,"ventana2","width=400,height=350,scrollbars=YES") 
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
        status = "Este campo sólo acepta números."
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
almacen='".$_POST['almacenDestino2']."',
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
dx='".$_POST['dx']."'
WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
?>
<script>
window.opener.document.forms["form1"].submit();
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
<h1>Actualizar Datos del Paciente<?php echo $leyenda; ?>
  </h1>
<form id="form1" name="form1" method="post" action="#" >
<table width="642" class="table-forma">
      <tr valign="middle" >
        <th colspan="2" ><div align="center" >Datos del Paciente </div></th>
      </tr>
      <tr valign="middle"  >
        <td width="137"><div align="left" >Nombre del Paciente</div></td>
        <td width="571"><label>
        <input name="paciente" type="text"  id="nombrePaciente" size="60" 
		value="<?php echo $myrow32['paciente'];?>"/>
        </label>
          &nbsp;
     

          <input name="nCuenta" type="hidden"  id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
        <input name="numeroE" type="hidden"  id="numeroE" value="<?php echo $numeroEs= $NUMEROE; ?>" readonly="" /></td>
      </tr>
	  
	 
      <tr >
        <td >Edad</td>
        <td ><input name="edad" type="text"  size="3" value="<?php echo $myrow32['edad'];?>"/></td>
      </tr>
      <tr >
        <th colspan="2"  ><div align="center" >M&eacute;dico Responsable del Internamiento </span></div></th>
      </tr>
      <tr valign="middle" >
        <td >Departamento</td>
        <td><?php  
		
		$aCombo= "Select * From almacenes where activo='A' and tieneCuartos='si' and medico='no' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino2"  id="almacenDestino2" onChange="javascript:this.form.submit();"/>        
					<option value="">Escoje</option>
					
   
	   
	   
        <?php while($resCombo = mysql_fetch_array($rCombo)){		 ?>
		
        <option 
		<?php 
		if($myrow32['almacen']==$resCombo['almacen'] and !$_POST['almacenDestino2']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino2'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
</td>
      </tr>
      <tr >
        <td ><label></label>
            </label>
            <label>
            
            <div align="left" >M&eacute;dico de Internamiento </div>
          </label></td>
        <td ><span >
          <label>
          <div align="left">
            <input name="medico" type="hidden"  id="medico"  value="<?php echo $_POST['medico'];?>" readonly=""/>
            <a href="javascript:ventanaSecundaria2(
		'/sima/cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>')"></a>
            <input name="despliegaMedico" type="text"  readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaMedico']){ echo $_POST['despliegaMedico'];} else { echo "";}?>"/>
          <a href="javascript:ventanaSecundaria2(
		'/sima/cargos/listaMedicos.php?campoDespliega=<?php echo "despliegaMedico"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "medico"; ?>&amp;almacen=<?php echo $_POST['almacenDestino2'];?>')"><img src="/sima/imagenes/Save.png" alt="M&eacute;dico de Internamiento" width="19" height="19" border="0" /></a></div>
          </label>
          <div align="left"></div>
        </span></td>
      </tr>
      <tr valign="middle" >
        <td >Cuarto</td>
        <td><input name="descripcionCuarto" type="text"  id="descripcionCuarto" 
		value="<?php if($_POST['descripcionCuarto']){ echo $_POST['descripcionCuarto'];} else { echo "";}?>" readonly=""/>
            <a href="javascript:ventanaSecundaria2(
		'agregaCuarto.php?campoDespliega=<?php echo "descripcionCuarto"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoCuarto=<?php echo "cuarto"; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenInternamiento=<?php echo $_POST['almacenDestino2']; ?>')"><img src="/sima/imagenes/Save.png" alt="Cuarto" width="19" height="19" border="0" /></a> <span >
            <input name="cuarto" type="hidden"  id="cuarto"   readonly=""
		value="<?php if($_POST['cuarto']){ echo $_POST['cuarto'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
          </span></td>
      </tr>
      <tr valign="middle" >
        <td colspan="2" ><div align="center" >Responsables </div></td>
      </tr>

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  <?php if($_POST['tipoResponsable']=='Familiar' or $myrow32['tipoResponsable']=='Familiar'){ ?>
      <tr valign="middle" >
        <th colspan="2" ><div align="center" >Persona F&iacute;sica </div></th>
      </tr>
      <tr valign="middle" >
        <td  >Parentesco </td>
        <td ><input name="parentescoResponsable" type="text"  id="parentescoResponsable" size="60" 
		value="<?php echo $myrow32['parentescoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >Nombre</td>
        <td><input name="nombreResponsable" type="text"  id="nombreResponsable" size="60" 
		value="<?php echo $myrow32['nombreResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Apellido Paterno</td>
        <td ><input name="apaternoResponsable" type="text"  id="apaternoResponsable" size="60" 
		value="<?php echo $myrow32['apaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td >Apellido Materno</td>
        <td><input name="amaternoResponsable" type="text"  id="amaternoResponsable" size="60" 
		value="<?php echo $myrow32['amaternoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Direcci&oacute;n</td>
        <td ><textarea name="direccionResponsable" cols="50"   id="direccionResponsable"><?php echo $myrow32['direccionResponsable'];?></textarea></td>
      </tr>
      <tr valign="middle" >
        <td >Tel&eacute;fono</td>
        <td><input name="telefonoResponsable" type="text"  id="telefonoResponsable" size="60" 
		value="<?php echo $myrow32['telefonoResponsable'];?>"/></td>
      </tr>
      <tr valign="middle" >
        <td  >Ocupaci&oacute;n</td>
        <td ><input name="ocupacionResponsable" type="text"  id="ocupacionResponsable" size="60" 
		value="<?php echo $myrow32['ocupacionResponsable'];?>"/></td>
      </tr>
	  <?php } ?>
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
      <tr valign="middle" >
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr valign="middle" >
        <td height="71" colspan="2">         <label>
        <div align="center">
          <input name="acepta" type="submit"  id="acepta" value="Actualizar Datos" />
          <br />
          <?php if($_POST['acepta']){ ?>
          <?php } ?>
          <br />
        </div>
        </label></td>
      </tr>
    </table>
	
<input name="nombrePaciente1" type="hidden"  id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    <input name="nombrePaciente2" type="hidden"  id="nombrePaciente2" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>" />
    <input name="flag" type="hidden"  id="flag" size="60" readonly="" 
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