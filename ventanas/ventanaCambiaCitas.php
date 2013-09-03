<?php require("/configuracion/ventanasEmergentes.php"); ?>

<?php 
$_POST['numeroE']=$_POST['numeroEx'];
//***************ELIMINAR RASTRO
$agrega = "DELETE FROM citasCandado where entidad='".$entidad."' and  usuario='".$usuario."'";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
//**************************









if($_POST['almacenDestino1']=='espera' or !$_POST['numeroE']){
$status='reservar';
$expediente='no';
}else{
$expediente='si';
$status='pendiente';
}







//********************
if($_GET['modificar']=='si' AND ($_POST['paciente'] and $_POST['actualizarCita'] )){
$q1 = "UPDATE clientesInternos set 
medico='".$_GET['id_medico']."',
horaSolicitud = '".$_POST['codHora']."',
fechaSolicitud='".$_POST['fechaSolicitud']."',
almacenSolicitud='".$_POST['almacenDestino1']."'
WHERE 
keyClientesInternos='".$_POST['keyClientesInternos']."'
";
mysql_db_query($basedatos,$q1);
echo mysql_error();
echo '<script>
window.alert( "SE MODIFICO LA CITA PARA ESTE PACIENTE");
window.opener.document.forms["form1"].submit();
window.close();
</script>';
}

//*******************









if($_GET['modificar']!='si' AND ($_POST['paciente'] and $_POST['actualizarCita']) ){









//**************************
//verificar que no existe
 $sSQLd= "SELECT *
 FROM
 clientesInternos
 WHERE 
 entidad='".$entidad."' and
 medico='".$_GET['id_medico']."'
 and
 guiaHora='".$_POST['guiaHora']."'
 and
 fechaSolicitud='".$_POST['fechaSolicitud']."'
and
almacen='".$_GET['almacen']."'
";

 $resultd=mysql_db_query($basedatos,$sSQLd);
 $myrowd = mysql_fetch_array($resultd);
//********************************************


if($myrowd['paciente']!=NULL){



echo '<script>
alert("Ya existe esta cita!");
</script>';

    
    
    
}else{    
//BENEFICENCIAS

                $sSQLa= "Select * From porcentajeBeneficencias
                where entidad='".$entidad."' and numeroE='".$_POST['numeroE']."'
                and
                fecha='".$fecha1."' and status='standby'
                and
                departamento='".$_GET['almacen']."'
                ";
                $resultsa = mysql_query($sSQLa);
                $rowa = mysql_fetch_array($resultsa);
                
                
                
                
                if($rowa['numeroE']!=NULL AND $rowa['fecha']==$fecha1 ){
                  $beneficencia=NULL;$statusBeneficencia=NULL;
                    $porcentaje=$rowa['porcentaje'];

                }elseif($_POST['beneficencia']=='si'){
                    $statusBeneficencia='si';
                    $porcentaje=100;

                }else{
                    $beneficencia=NULL;$statusBeneficencia=NULL;

                }    
    
    
$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,almacenSolicitud,horaSolicitud,fechaSolicitud,telefono,expediente,paquete,guiaHora,activaBeneficencia,
porcentaje
) values (
'".$_POST['numeroE']."','".$nCuenta."',
'".$_GET['id_medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_GET['seguro']."',
'".$_GET['autoriza']."',
'".$_GET['credencial']."',
'".$fecha1."',
'".$hora1."',
'reservar',
'".$_GET['cita']."',
'".$_GET['almacen']."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_GET['medicoForaneo']."','".strtoupper($_GET['observaciones'])."','".$_GET['edad']."','externo',
'".$nOrden."','reservar','".$_GET['dependencia']."','".$entidad."','".$_POST['almacenDestino1']."','".$_POST['codHora']."','".$_POST['fechaSolicitud']."',
    '".$_POST['telefono']."','".$expediente."','no','".$_POST['guiaHora']."',
        '".$statusBeneficencia."','".$porcentaje."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo   '<script>
alert("El paciente: '.$_POST['paciente'].' fue agregado");
window.opener.document.forms["form1"].submit();
window.close();
</script>';
}
?>







<?php 
/*
  $sSQLd2= "SELECT keyClientesInternos
 FROM
 citasTemporales
 WHERE 
 keyClientesInternos='".$_GET['keyClientesInternos']."'
 ";

 $resultd2=mysql_db_query($basedatos,$sSQLd2);
 $myrowd2 = mysql_fetch_array($resultd2);

if($myrowd2['keyClientesInternos']){
$agrega = "UPDATE citasTemporales 
set
almacenSolicitud='".$_POST['almacenDestino1']."',
horaSolicitud='".$_POST['codHora']."',
fechaSolicitud='".$_POST['fechaSolicitud']."'
where
entidad='".$entidad."'
and
almacenSolicitud='".$_POST['almacenDestino1']."'
and
horaSolicitud='".$_POST['codHora']."'
and
fechaSolicitud='".$_POST['fechaSolicitud']."'";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


<?php 
} else{ //ya esta tomado
?>
<script >
window.alert( "Esta cita esta ya reservada ");
//window.close();
</script>
<?php 
}
 * 
 */
}//cerrar la opcion modificar





/* 
echo '<script language="JavaScript" type="text/javascript">
  <!--
   //window.opener.document.forms["form1"].submit();
  //close();
  // -->
</script>';
}
*/



?>




    <?php 
	  if($_POST['fechaSolicitud']){
	   $fecha2=$_POST['fechaSolicitud'];
	  } else {
	   $fecha2=$fecha1; 
	  } ?>


  <script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=650,height=700,scrollbars=YES") 
} 
</script> 
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=800,scrollbars=YES") 
} 
</script> 
  <script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=600,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=660,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<?php 

if($_GET['keyClientesInternos']){
$sSQL10= "SELECT *
FROM
clientesInternos
WHERE (keyClientesInternos='".$_GET['keyClientesInternos']."' or keyClientesInternos='".$_POST['keyClientesInternos']."')
order by keyClientesInternos desc
";

$result10=mysql_db_query($basedatos,$sSQL10);
$myrow10 = mysql_fetch_array($result10);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>


<?php 
$estilo= new muestraEstilos();
$estilo->styles();

?>


<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<body>


<form id="form1" name="form1" method="post" >
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="440" border="0" align="center" cellspacing="0" cellpadding="0">


    <tr >
      <td width="10"  scope="col">&nbsp;</td>
      <td width="98" scope="col"><div align="left"><span class="negromid">M&eacute;dico</span></div></td>
      <td width="318"  scope="col"><label>
        <div align="left">
		
<?php
$aCombo= "Select almacen,descripcion,id_medico From almacenes where 
entidad='".$entidad."' 
    AND
activo='A' 
    and
    almacenPadre='".$_GET['almacen']."'
and
medico='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
<select name="almacenDestino1" class="style12" id="almacenDestino1" onChange="javascript:this.form.submit();"/>        


       
	       
        <?php while($resCombo = mysql_fetch_array($rCombo)){?>
		
        <option 
		<?php if($resCombo['id_medico']==$_GET['id_medico'])echo 'selected=""'; ?>
		
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php  }?>
        </select>
        </div>
      </label></td>
    </tr>

    <tr >
      <td >&nbsp;</td>
      <td >Hora/Fecha</td>
      <td>
      
            <input name="codHora" type="text" id="codHora" size="7" readonly="readonly" value="<?php 
	  if($myrow10['horaSolicitud']){
	  echo $myrow10['horaSolicitud'];
	  }
	  ?>" />
      
         
          <span class="negromid">
          <input name="fechaSolicitud" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  if($myrow10['fechaSolicitud']){
	  echo $myrow10['fechaSolicitud'];
	  }else{
	  echo $fecha2;
	  }
	  ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
          </span>
          
          
          <label>
          <a href="javascript:ventanaSecundaria('listaCitasMedicos.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;id_medico=<?php echo $_GET['id_medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow['keyPA']; ?>&almacenSolicitud=<?php echo $_POST['almacenDestino1'];?>&entidad=<?php echo $entidad;?>&fechaSolicitud=<?php echo $fecha2;?>&forma=citas&campoPrincipal=codHora&campoDespliegue=fechaSolicitud&almacen=<?php echo $_GET['almacen'];?>')">
          <img src="/sima/imagenes/calendario.png" alt="Almacenes" width="24" height="24" border="0" />          </a>           </label>          <input type="hidden" name="guiaHora" id="guiaHora" /></td>
    </tr>
    <tr >
      <td >&nbsp;</td>
      <td >Expediente </td>
      <td><input name="numeroEx" type="text" class="Estilo24" id="numeroEx" 
		  value="<?php 
		  
		  echo $myrow10['numeroE'];
	
		  ?>" readonly=""/></td>
    </tr>
    <tr >
	
	
	
      <td >&nbsp;</td>
      <td >Paciente </td>
      <td><input name="paciente" type="text" class="Estilo24" id="paciente" value="<?php 
		
		  echo $myrow10['paciente'];
		
		  ?>" size="60" />
		  <?php echo '</br>';?>
		  <a href="javascript:ventanaSecundaria10('/sima/cargos/busquedaAvanzada.php')" class="style1 style1">Busqueda Avanzada </a>		  </td>
    </tr>
    
    
    

    <tr >
      <td >&nbsp;</td>
      <td >Tel&eacute;fonos</td>
      <td><input name="telefono" type="text" class="Estilo24" id="telefono" 
		  value="<?php 
		
		  echo $myrow10['telefono'];
	
		  ?>" /></td>
    </tr>

    <tr >
      <td height="16" colspan="3"><label>
              </br>

        <div align="center">
          <input name="actualizarCita" type="submit" class="boton1" id="actualizarCita" value="Agregar/Modificar Cita " />
 <input name="keyClientesInternos" type="hidden" class="Estilo24" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
        </div>
      </label></td>
    </tr>
  </table>
</form>

<p>
  <script>
		new Autocomplete("paciente", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("numeroEx")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/pacientesx.php?almacen=<?php echo $_GET['almacen'];?>&entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script></p>
</body>

</html>
