<?php require('/configuracion/ventanasEmergentes.php');?>
<?php 


if($_POST['almacen']){
$ALMACEN=$_POST['almacen'];
}

?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=150,height=200,scrollbars=YES") 
} 
</script> 
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-green.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 



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
           
        if( vacio(F.numeroEx.value) == false ) {   
                alert("Por Favor, ingresa el expediente!")   
                return false   
        }            
}   
  
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=600,height=600,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 





<?php include("/configuracion/funciones.php"); ?>
<?php 

if($_POST['edad']=='paquete'){
$paquete='si';
} else {
$paquete='no';
}


if($_POST['sinE']){
$expediente='no';
} else {
$expediente='si';
}


$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenio=new validaConvenios();
$verificaSaldos=new verificaSeguro();

$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();

$seguro=$traeSeguro->traeSeguro($numeroPaciente,$nCuenta,$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);

if($_POST['cargos']){
if(verificaSeguro1::verificaSaldos1($cantidad,$iva,$priceLevel,$dia,$fecha1,$hora1,$_POST['seguro'],$_POST['credencial'],$leyenda,$basedatos)==TRUE){
//$verificaSaldos->verificaSaldos($dia,$fecha1,$hora1,$_POST['seguro'],$_POST['credencial'],$basedatos);

$sSQL1= "Select * From clientesInternos WHERE entidad='".$entidad."' AND numeroE = '".$_POST['PACIENTE']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroPaciente'];
if($_POST['nuevo']){
$_POST['paciente']="";
}

if($_POST['numeroEx']){
$sSQL4= "Select * from clientesInternos where entidad='".$entidad."' AND numeroE='".$_POST['numeroEx']."' order by keyClientesInternos DESC";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$nCuenta = $myrow4['nCuenta']+1; 
} else {
$nCuenta = 1; 
}




if($_POST['seguro']){
$status='cxc';
}else{
$status='pendiente';
}

//*************genero orden aleatoria*********
$nOrden=rand(1000000,10000000);
if($nOrden1){
$nOrdenT=$nOrden1;
} else {
$nOrdenT=$nOrden;
}
 
$sSQL33= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'  order by keyClientesInternos DESC";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33); 

if(!$_POST['numeroEx']){
$_POST['numeroEx']=$nOrdenT;
$nCuenta='99999';
}


//*****************cierro orden*****************

if($_POST['cargos'] AND $_POST['numeroEx'] AND $_POST['paciente']){
$agrega = "INSERT INTO clientesInternos ( 
numeroE,nCuenta,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,medicoForaneo,observaciones,edad,tipoPaciente,nOrden,
statusExpediente,dependencia,entidad,almacenSolicitud,horaSolicitud,fechaSolicitud,telefono,expediente,paquete
) values (
'".$_POST['numeroEx']."','".$nCuenta."',
'".$_POST['medico']."',
'".strtoupper($_POST['paciente'])."',
'".$_POST['seguro']."',
'".$_POST['autoriza']."',
'".$_POST['credencial']."',
'".$fecha1."',
'".$hora1."',
'cortesia',
'".$_POST['cita']."',
'".$ALMACEN."',
'".$usuario."',
'".$ip."',
'".$fecha1."','".$tipoConsulta."','".$_POST['medicoForaneo']."','".strtoupper($_POST['observaciones'])."','".$_POST['edad']."','externo',
'".$nOrden."','request','".$_POST['dependencia']."','".$entidad."','".$_POST['almacenSolicitud']."','".$_POST['horaSolicitud']."','".$fecha1."','".$_POST['telefono']."','si','".$paquete."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

$sSQL1= "SELECT 
* 
FROM clientesInternos
WHERE entidad='".$entidad."' AND
usuario='".$usuario."'
order by keyClientesInternos Desc
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); 
$keyClientesI=$myrow1['keyClientesInternos'];
$leyenda='SE GENERO UNA CITA #'.$myrow1['keyClientesInternos'];
?>


<script type="text/vbscript">
msgbox "SE HIZO UNA SOLICITUD DE CITA <?php echo $myrow1['keyClientesInternos']; ?>!"
</script>
<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
self.close();
  // -->
</script>



<?php 
} else {
//echo "YA DISTE DE ALTA ESA NOTA DE CARGO, ESCOJE EL EXPEDIENTE NUEVO";
}


//**********************CIERRO CLIENTES AMBULATORIOS A FARMACIA*********************

}
}
?>




























<?php 

if($_POST['quitar']){
$codigo=$_POST['codigo'];

for($i=0;$i<$_POST['bandera'];$i++){
$borrame = "DELETE FROM cargosCuentaPaciente WHERE keyCAP ='".$codigo[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}

}
$nOrden1=$nOrdenT;
?>


<?php	

$sSQL33= "SELECT 
* 
FROM pacientes
WHERE keyPacientes='".$_GET['keyPacientes']."'
";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);
echo mysql_error();

 
 ?>





<title></title>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

<head>
	





<body>
<?php 


$sSQL39= "SELECT *
FROM
almacenes
where 
entidad='".$entidad."' AND
almacen='".$ALMACEN."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
?>
<h1>Reservar Expediente F&iacute;sico </h1>
<form id="form1" name="form1" method="post" action="<?php echo $pagina; ?>">
    <table width="443" style="border: 1px solid #CCC;" >
      <?php  ?>
      <tr>
        <td width="6"  scope="col">&nbsp;</td>
        <td width="137"  scope="col"><div align="left"><strong>Paciente: </strong><span >
		
	
          <input name="numeroEx" type="hidden"  id="numeroEx" value="<?php echo $myrow33['numCliente'];?>" readonly="" />
		
		  
          <?php echo '[ '.$myrow39['descripcion'].' ]'; ?></span></div></td>
        <td  scope="col"><div align="left"><strong>
            <label> </label>
            </strong>
			

            <input name="paciente" type="text"  id="paciente" value="<?php 
		 echo $myrow33['nombre1']." ".$myrow33['nombre2']." ".$myrow33['apellido1']." ".$myrow33['apellido2']." ".$myrow33['apellido3'];
		  ?>" size="60" readonly=""  />                
		  	
		  
          <span >
        
		<?php if(!$_POST['sinE']){  ?><?php } ?>
		
		
          <span ><span ><a href="javascript:ventanaSecundaria2('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $E; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"></a></span></span> </span>
          <input name="fechaNac" type="hidden"  id="fechaNac" size="10"  readonly="" value="<?php 
		  if($_POST['fechaNac'] and !$_POST['fechaNac']){
		  echo $_POST['fechaNac'];
		  } 
		  ?>"/>
          <input name="edad" type="hidden"  id="edad" value="<?php 
		  if($_POST['edad'] and !$_POST['nuevo']){
		  echo $_POST['edad'];
		  } else if($myrow33['edad'] and !$_POST['nuevo']){
		  echo $myrow33['edad']; 
		  }
		  ?>" size="2" maxlength="2" onKeyPress="return checkIt(event)"/>
        </div></td>
      </tr>

   
	  
	  
	  
      <tr>
        <td height="36" colspan="4"  scope="col"><label>
          <?php 
			
$sSQL1= "Select * From clientesInternos WHERE usuario = '".$usuario."' order by keyClientesInternos DESC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
			
			
			
			?>
	<input name="fechaSolicitud" type="hidden"  id="nuevo" value="<?php echo $_GET['fechaSolicitud'];?>" />
	<input name="horaSolicitud" type="hidden"  id="nuevo" value="<?php echo $_GET['horaSolicitud'];?>" />
	<input name="cargos" type="submit"  id="cargos" value="Reservar Exp" />
	</label>
          <strong>
          <input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen']; ?>"/>
          </strong>
          <input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>"/>
          <input name="pacientes" type="hidden" id="pacientes" value="<?php echo $_POST['paciente']; ?>" />
          <input name="PACIENTED" type="hidden" id="PACIENTED" value="<?php echo $_POST['paciente']; ?>" />
          <input name="FOLIOD" type="hidden" id="PACIENTED" value="<?php echo $Folio[0]; ?>" />
          <input name="keyClientesI" type="hidden" id="FOLIOD" value="<?php echo $keyClientesI; ?>" />
          <input name="pagina" type="hidden" id="keyClientesI" value="<?php echo $pagina; ?>" />
          <input name="nOrden" type="hidden" id="pagina" value="<?php echo $nOrden; ?>" />
          <input name="almacenSolicitud" type="hidden" id="nOrden" value="<?php echo $_GET['almacenSolicitud']; ?>" />
          <input name="horaSolicitud" type="hidden" id="almacenSolicitud" value="<?php echo $_GET['horaSolicitud']; ?>" />
          <input name="fechaSolicitud" type="hidden" id="horaSolicitud" value="<?php echo $_GET['fechaSolicitud']; ?>" />
        </td>
      </tr>

  </table>
</form>
  
  
 </body>
</html>