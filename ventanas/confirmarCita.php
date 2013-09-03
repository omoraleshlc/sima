<?php require('/configuracion/ventanasEmergentes.php');?>
<?php  
if($_GET['keyClientesInternos'] AND ($_GET['inactiva'] or $_GET['activa'])){



 $SQLj2= "SELECT statusCaja
FROM
clientesInternos
where 
keyClientesInternos='".$_GET['keyClientesInternos']."' ";
$resultj2=mysql_db_query($basedatos,$SQLj2);
$myrowj2 = mysql_fetch_array($resultj2);


if($myrowj2['statusCaja']!='pagado'){

	if($_GET['inactiva']=="inactiva"){
$q = "DELETE FROM clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		
		$q1 = "DELETE FROM cargosCuentaPaciente
		WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();
		$q2 = "DELETE  FROM citasTemporales
		WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q2);
		echo mysql_error();
	}

}else{ ?>
<script>
window.alert("Imposible cancelar! ya se efectuo el pago en caja");
</script>
<?php 
}

}
?>
<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-system.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 
  <script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=600,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=1000,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventanaSecundaria4","width=660,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=800,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


  <script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventanaSecundaria10","width=550,height=450,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventanaSecundaria9","width=650,height=450,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?><br />

<p align="center" class="titulos">
<?php 
 $SQLj2= "SELECT descripcion
FROM
almacenes
where 
entidad='".$entidad."'
    and
almacen='".$_GET['almacenDestino']."' ";
$resultj2=mysql_db_query($basedatos,$SQLj2);
$myrowj2 = mysql_fetch_array($resultj2);

//	$sSQL455z= "Select * from almacenesTemp where
//fecha='".$fecha1."'
//and
//almacen='".$_GET['almacenDestino']."'
//and
//almacenPrincipal='".$_GET['almacen']."'
//order by keyAT DESC
//
//";
//$result455z=mysql_db_query($basedatos,$sSQL455z);
//$myrow455z = mysql_fetch_array($result455z);

  if($myrow455z['keyAT']){
	  $desc=$myrow455z['descripcion'];
	  }else{
	  $desc=$myrowj2['descripcion'];
	  }
echo $desc;
?>
</p>
<meta http-equiv="refresh" content="90">
<form id="form1" name="form1" method="post" >
		<div align="center"><span class="Estilo25">
        <input name="button" type="image"  id="lanzador" value="fecha"  src="../imagenes/btns/fechadate.png"/>
      </span> 
          <input name="fechaSolicitud" type="text" class="campos" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" onchange="javascript:this.form.submit();"/>
      </div>
  
  
  
  
  
  
  <br /><br />
  
  <table class="table table-striped" width="951" >
 
    <tr>
      <th width="63" class="negromid" align="center">Hora</th>
      <th width="67" align="center" class="negromid">N&deg; Exp</th>
      <th width="94" align="center" class="negromid">Exp.</th>
      <th width="253" class="negromid">Paciente</th>
      <th width="67" class="negromid" align="center">EC</th>
      <th width="67" class="negromid" align="center">P/A</th>
      <th width="67" class="negromid" align="center">C/D</th>
      <th width="67" class="negromid" align="center">Status</th>
      <th width="69" class="negromid" align="center">Editar </th>
      <th width="82" class="negromid" align="center">Cargos </th>
      <th width="55" class="negromid" align="center">Cancelar</th>
    </tr>
    
<?php 




/*
$sSQL11= "SELECT *
FROM
clientesInternos,medicosCitas
WHERE 
clientesInternos.entidad='".$entidad."'
and
(clientesInternos.status='reservar' and
 clientesInternos.fechaSolicitud='".$fecha2."' and clientesInternos.almacenSolicitud='')
or
(clientesInternos.status!='cancelado' 
and
clientesInternos.medico='".$_GET['id_medico']."'
and
clientesInternos.fechaSolicitud='".$fecha2."') 
and
clientesInternos.guiaHora=medicosCitas.guiaHora
group by clientesInternos.guiaHora
order by medicosCitas.guiaHora ASC";
*/

$sSQL11="
SELECT * FROM clientesInternos
where
entidad='".$entidad."'
    and
fechaSolicitud='".$fecha2."'
    and
medico='".$_GET['id_medico']."'    
    and
almacen='".$_GET['almacen']."'
    and
guiaHora>0
order by guiaHora ASC
";


$result11=mysql_db_query($basedatos,$sSQL11);
while($myrow11 = mysql_fetch_array($result11)){ 
$horaSolicitud=$myrow11['codHora'];
$a+=1;

?>
     <tr >  
      <td height="47" align="center" class="precio2">
        <?php 
	  if($myrow11['horaSolicitud']){
	  echo $myrow11['horaSolicitud'];
	  }else{
	  echo '---';
	  }
	  ?>      </td>
      <td class="precio1" align="center">
        <?php 
	  if($myrow11['paquete']=='si'){
	  echo $myrow11['numeroE']; 
	  } else if($myrow11['expediente']=='si'){
	  echo $myrow11['numeroE']; 
	  $firstTime='no';
	  } else if($myrow11['paciente']){
	  echo 'Sin Exp.';
	  $firstTime='yes';
	  }
	 
	  ?>      </td>
      <td class="precio1" align="center"> 
      <?php if($myrow11['expediente']){ ?>
          <a href="javascript:ventanaSecundaria5('modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&expediente=<?php echo 'no'; ?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow11['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>&almacen=<?php echo $_GET['almacen'];?>')"> Crear/Ver Exp. </a>
          <?php } else {
	  echo '---';
	  }
	  ?>      </td>
      <td><span class="normalmid">
        <?php 
	echo $myrow11['paciente'];
	
	  ?>
        <br />
       <span class="normal"> Tlf.: </span><span class="negro"><?php echo $myrow11['telefono'];  ?></span>
	           <br />
			   
		<?php 	   if($myrow11['folioVenta']){ ?>
       <span class="normal"> Folio: </span><span class="normal"><?php echo $myrow11['folioVenta'];  ?></span>
	   <?php } ?>
	   
	   
	   
	   
        <?php if($paciente){ ?>
        <a href="#" onclick="javascript:ventanaSecundaria8('ventanaCambiaTelefono.php?numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $almacen; ?>&fechaSolicitud=<?php echo $fecha2; ?>&almacenSolicitud=<?php echo $_GET['almacenDestino1']; ?>&horaSolicitud=<?php echo $myrow11['codHora']; ?>&tipoCliente=<?php echo 'particular';?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos'];?>')"> Agregar</a>
        <?php } ?>      </td>
		
		

      <td class="normalmid" align="center">
	  		<?php if($myrow11['folioVenta']){ ?>
	  <a href="javascript:ventanaSecundaria9('../cargos/despliegaCargos.php?almacen=<?php echo $_GET['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&amp;tipoPaciente=externo&amp;folioVenta=<?php echo $myrow11['folioVenta']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>&entidad=<?php echo $entidad;?>')">Ver Estado de Cuenta</a>
	  	  <?php }else{ ?>
	  ---	  
	  <?php } ?>

	  </td>
	  
	  
	  
      <td class="normalmid" align="center"><span class="normal">
        <?php if($myrow11['statusCaja']!='pagado'){ ?>
        <a href="#" onclick="javascript:ventanaSecundaria9('../ventanas/actualizaPagos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')">Cambia Responsable</a>
        <?php } else { echo '---';}?>
      </span></td>
      <td class="normalmid" align="center"><span class="normal">
        <?php 
		
		if($myrow11['statusCaja']!='pagado' and $myrow11['seguro']){ ?>
        <a href="#" onclick="javascript:ventanaSecundaria9('../ventanas/aplicarDeducible.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow11['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&amp;folioVenta=<?php echo $myrow11['folioVenta'];?>')">Cargar Coaseguro</a>
        <?php } else { echo '---';}?>
      </span></td>
      <td class="normalmid" align="center">
        
        <?php 
 $SQLj2= "SELECT statusCargo
FROM
cargosCuentaPaciente
where 
keyClientesInternos='".$myrow11['keyClientesInternos']."' order by keyClientesInternos DESC";
$resultj2=mysql_db_query($basedatos,$SQLj2);
$myrowj2 = mysql_fetch_array($resultj2);

?>
          <?php if(($myrowj2['statusCargo']=='cargadoR' or $myrowj2['statusCargo']=='cargadoR')  and $myrow11['status']=='pendiente'){ ?>
          <a href="#" onclick="javascript:ventanaSecundaria9('ventanaCambiaStatus.php?numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $almacen; ?>&fechaSolicitud=<?php echo $fecha2; ?>&almacenSolicitud=<?php echo $_GET['almacenDestino1']; ?>&horaSolicitud=<?php echo $myrow11['codHora']; ?>&tipoCliente=<?php echo 'particular';?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos'];?>')"> <?php echo $myrow11['status'].'???';?> </a>
          
		  <?php } else if($myrow11['status']=='pendiente' and !$myrow11['folioVenta']){ ?>
		  <a href="javascript:ventanaSecundaria9('../cargos/agregaArticulos.php?almacen=<?php echo $_GET['almacen']; ?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&tipoPaciente=externo&folioVenta=<?php echo $myrow['folioVenta']; ?>&numeroE=<?php echo $myrow['numeroE']; ?>&usuario=<?php echo $usuario; ?>&keyCAP=<?php echo $keyCAP;?>&seguro=<?php echo $myrow['seguro'];?>')"> <?php echo 'sin cargos!';?> </a>
		  <?php } else { ?>
          <?php 
		  if($myrow11['status']=='pendiente'){
		  echo '<span class="codigos"><blink>'.$myrow11['status'].'</blink></span>';
		  }else{
		  echo $myrow11['status'];
		  }
		  ?>
          <?php } ?>
  
      <br />
     <span class="normal" align="center"> <?php 
		echo $myrow11['usuario'];
		?>
      </span>      </td>
      <td class="normalmid" align="center"><?php 
		if($myrow11['status']=='reservar' and $myrow11['expediente']=='si'){

		?>
          <a href="#" onclick="javascript:ventanaSecundaria9('ventanaCambiaCitas.php?codigo=<?php echo $code; ?>&seguro=<?php echo $_POST['seguro']; ?>&almacen=<?php echo $_GET['almacen']; ?>&id_medico=<?php echo $_GET['id_medico']; ?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&modificar=si')"><?php echo 'Editar Cita';?></a>
          <?php } else { 
	  echo '---'; 
	  } 
	  ?>
      <br /></td>
            <?php 
if($myrow11['keyClientesInternos']){
$sSQL361= "Select articulosPaquetesPacientes.status From articulosPaquetesPacientes,articulosPaquetes WHERE 

articulosPaquetesPacientes.keyE=articulosPaquetes.keyE
and
articulosPaquetes.almacen='".$_GET['almacenDestino1']."'
and
articulosPaquetesPacientes.keyClientesInternos='".$myrow112 ['keyClientesInternos']."' 
";
$result361=mysql_db_query($basedatos,$sSQL361);
$myrow361 = mysql_fetch_array($result361);
//echo $myrow361['status'];
}
?>
      <td class="normalmid" align="center">
      <?php //echo  $myrow11['status'];
if(($myrow11['almacenSolicitud'] and ($_GET['almacenDestino'] and $myrow11['expediente']=='si' and $myrow11['paquete']=='no')) || $myrow11['status']=='request'){  ?>
          <a href="javascript:ventanaSecundaria2('hacerCargos.php?numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $_GET['almacen']; ?>&fechaSolicitud=<?php echo $fecha2; ?>&almacenSolicitud=<?php echo $_GET['almacenDestino1']; ?>&horaSolicitud=<?php echo $myrow11['codHora']; ?>&tipoCliente=<?php echo 'particular';?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos'];?>&paquete=<?php echo $myrow11['paquete'];?>');window.close();">
          <?php 
		if(($myrow11['status']=='reservar' and $myrow11['expediente']=='si') || $myrow11['status']=='request'){
		
    	echo  'Cargos';
} 
		?>
          </a>
          <?php } else if($myrow11['keyClientesInternos']){ ?>
          <?php 
$SQLj2a= "SELECT status
FROM
almacenesPaquetes
where 

id_almacen='".$_GET['almacenDestino']."'
and
keyClientesInternos='".$myrow11['keyClientesInternos']."' 

";
$resultj2a=mysql_db_query($basedatos,$SQLj2a);
$myrowj2a = mysql_fetch_array($resultj2a);

?>
          <?php if($myrowj2a['status']=='standby'){ ?>
          <a href="javascript:ventanaSecundaria2('../cargos/agregaArticulosPaquetes.php?almacen=<?php echo $_GET['almacenDestino1'];?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $almacen; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $fecha2; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow11['keyClientesInternos'];?>&almacenSolicitud=<?php echo $_GET['almacenDestino1'];?>')">
          <?php 
		
    	//echo 'Cargar';

		?>
          </a>
          <?php } else { 
	  //echo 'Cargado';
	  }
	  ?>
          <?php } else { 
	  echo '---';
	  }
	  ?>      </td>
      
      <td align="center"><?php if($myrow11['paquete']=='no'){ 
	   if($myrow11['statusCaja']!='pagado'){ ?>
        <a href="confirmarCita.php?keyClientesInternos=<?php echo $myrow11['keyClientesInternos']; ?>&seguro=<?php echo $_POST['seguro']; ?>&inactiva=<?php echo'inactiva'; ?>&almacen=<?php echo $_GET['almacen']; ?>&codigo=<?php echo $C; ?>&almacenDestino=<?php echo $_GET['almacenDestino'];?>"><img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="22" height="22" border="0" onclick="if(confirm('&iquest;Est&aacute;s seguro que deseas cancelar la cita?') == false){return false;}" /></a>
      <?php } else {
	  echo '---';
	  }}
	  ?></td> <?php }?>
    </tr>

  </table>
  <p>&nbsp;</p>
<?php if($a<1){ echo '<div align="center" class="error">NO HAY CONSULTAS!</div>';}?>
</form>
<script type="text/javascript"> 
    Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
    ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
    button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script>
<p>&nbsp;</p>
<p>&nbsp;</p>
