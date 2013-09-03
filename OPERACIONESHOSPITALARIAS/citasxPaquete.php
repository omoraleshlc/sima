<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php");$ALMACEN=$_GET['datawarehouse'];?>




<?php
$_GET['almacen']=$ALMACEN;
$campo=$_GET['campo'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoFechaNac=$_GET['fechaNac'];
$campoEdad=$_GET['edad'];

?>




<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=630,height=400,scrollbars=YES") 
} 
</script> 

  <script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
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

<body>
<h1 align="center" class="titulos">&nbsp;</h1>
<h1 align="center" class="titulos">Pacientes con Paquetes asignados</h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
    <p>
      <?php


$sSQL= "
SELECT * FROM 
cargosCuentaPaciente
where 
almacenSolicitante='".$_GET['almacen']."'
and
paquete='si'
and
statusCargo='cargadoR'
and
folioVenta!=''
order by folioVenta ASC
";



$result=mysql_db_query($basedatos,$sSQL);

?></p>


    <table class="table table-striped" width="826" >
    <tr>
      <th width="55" height="26"  scope="col"><div align="left" class="none">
        <div align="center">Folio</div>
      </div></th>
      <th width="318"  scope="col" ><div align="left">Medico</span></div></th>
      <th width="217" scope="col"><div align="left" class="none">Paciente</div></th>
      <th width="126" scope="col"><div align="left" class="none">
        <div align="center">Hora/Fecha</div>
      </div></th>
      <th width="28" scope="col"><div align="left" class="none">
        <div align="center">Cita</div>
      </div></th>
      <th width="82"  scope="col"><div align="left" class="none">
        <div align="center">Cargar</div>
      </div></th>
    </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 

$bandera+="1";


//cierro descuento

if($col){
$color = '#FFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL31= "Select  * From clientesInternos WHERE keyClientesInternos='".$myrow['keyClientesInternos']."'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$sSQL39= "SELECT descripcion,almacen
FROM
almacenes
where 

almacen='".$myrow['almacenDestino']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);



?>


        <td height="24" bgcolor="#FFFFFF" class="codigos">



          <div align="center">
            <?php 
			echo $myrow['folioVenta'];
		
		  ?>        
          </div></td>
		  
		  <td bgcolor="#FFFFFF" class="normal"><?php print $myrow39['descripcion']; ?></td>
          <td bgcolor="#FFFFFF" class="normal"> <?php echo $myrow31['paciente'];?> </td>
          <td bgcolor="#FFFFFF" class="negro"><div align="center">
            <?php 
		  if($myrow['horaSolicitud']){
		  echo $myrow['horaSolicitud'].' '.cambia_a_normal($myrow['fechaSolicitud']);
		  } else {
		  
		  echo '---';
		  }
		  ?>
          </div></td>
          <td bgcolor="#FFFFFF" class="Estilo24"><div align="center"><a href="javascript:ventanaSecundaria1('../ventanas/asignarCitasPxPaquetes.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacen=<?php echo $myrow['id_almacen']; ?>&amp;medico=<?php echo $myrow39['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>')"><img src="/sima/imagenes/btns/aprobar.png" alt="Datos Generales del Paciente" width="24" height="24" border="0" /></a></div></td>
        <td bgcolor="#FFFFFF" class="negro">
		
		
	 	  <div align="center">
<?php 
$SQLj2a= "SELECT status
FROM
almacenesPaquetes
where 
keyClientesInternos='".$myrow['keyClientesInternos']."' 
and
id_almacen='".$myrow39['almacen']."'
";
$resultj2a=mysql_db_query($basedatos,$SQLj2a);
$myrowj2a = mysql_fetch_array($resultj2a);

?>
	 	    
	 	    
	 	    <?php 
		  if($myrow31['confirmaCita']=='si'){ ?>
	 	      <a href="javascript:ventanaSecundaria2('../cargos/agregaArticulosPaquetes.php?almacen=<?php echo $myrow['almacenSolicitante']; ?>&numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $myrow45['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $myrow39['almacen']; ?>&almacenSolicitante=<?php echo $myrow['id_almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_GET['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&almacenSolicitud=<?php echo $myrow['id_almacen']; ?>&folioVenta=<?php echo $myrow['folioVenta']; ?>&keyCAP=<?php echo $myrow['keyCAP']; ?>&random=<?php echo rand(5000, 5000000);?>')">
 	          <?php 
		
    	echo 'Cargar';

		?>
            </a>
 	        <?php } else { 
	  echo '---';
	  }
	  ?>
	 	    
 	    </span></div></td>
    </tr>

      <?php }?>
    </table>
  
<p>&nbsp;    </p>
	<p>
	  <input name="nombrePaciente1" type="hidden" class="Estilo24" id="nombrePaciente" size="60" readonly="" 
		value="<?php echo $nombrePaciente;?>"  />
    </p>
  </form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
    <p>&nbsp;</p>
	  <p>&nbsp;</p>
</body>
</html>
