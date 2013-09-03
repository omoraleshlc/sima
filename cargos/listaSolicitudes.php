<?php require('/configuracion/ventanasEmergentes.php'); 
require('/configuracion/funciones.php'); ?>

  <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsación de tecla en Internet Explorer
    */ 
    var tecla;
    function capturaTecla(e) 
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which; 
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }  
    document.onkeydown = capturaTecla;
</script>


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
 window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<?php  
if($_GET['keyClientesInternos'] AND ($_GET['inactiva'] or $_GET['activa'])){

$sSQL= "SELECT statusCaja
FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);


if($myrow['statusCaja']!='pagado'){
	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE clientesInternos set 

	status='cancelado'
		WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}
}


}
?>




<!-Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-system.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">

.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}


div.htmltooltip{
position: absolute; /*leave this and next 3 values alone*/
z-index: 1000;
left: -1000px;
top: -1000px;
background: #272727;
border: 10px solid black;
color: white;
padding: 3px;
width: 250px; /*width of tooltip*/
}

</style>
</head>

<body>


<form id="form1" name="form1" method="POST" action="#">


  <table width="342" border="0" align="center" class="style7">
    <tr valign="middle" class="style71">
      <th width="135" class="negro" scope="col"><span class="Estilo25">
        <input name="button" type="image" class="style7"  id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
      </span></th>
      <th width="197" scope="col"><div align="left">
          <input name="fechaSolicitud" type="text" class="campos" id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud'] or $_GET['fechaSolicitud']){
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  }else{
	  echo $fecha2=$_GET['fechaSol'];
	  }
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" onChange="javascript:this.form.submit();"/>
      </div></th>
    </tr>
  </table>
  
  
  <?php 
  
  		   $sSQL17= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
almacen = '".$_GET['almacenDestino1']."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
  
  
  ?>
  
  <p align="center">Dr(a). <?php print $myrow17['descripcion'];?></p>
  <table width="602" border="0.2" align="center">
    <tr>
      <th width="41" bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13"># Folio </span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Nombre del paciente:</span></div></th>
      <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Aseguradora</span></div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"><span class="style11 style13">P-&gt;A</span></div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">E/C</span></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"><span class="style11 style13">Cargos</span></div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"><span class="style11 style13">C/D</span></div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left" class="blanco"><span class="style11 style13">N/V</span></div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Usuario</span></div></th>
	  <th bgcolor="#660066" class="style12" scope="col"><div align="left"><span class="style11 style13">Cancelar</span></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."' 
and
almacenSolicitud='".$_GET['almacenDestino1']."' 
and
fechaSolicitud='".$fecha2."'
and
status!='cancelado'
and
folioVenta!=''
and
tipoPaciente='externo'
order by paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];
	  ?>
      <td height="24" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php echo $myrow['folioVenta'];
?></span></td>


      <td width="131" bgcolor="<?php echo $color?>" class="style12"><span class="style7">

	  	  <?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?> 
          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="183" bgcolor="<?php echo $color?>" class="style12"><span class="style7"><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "PARTICULAR";
		  }
?></span></td>

      <td width="26" bgcolor="<?php echo $color?>" class="style12"><?php if($myrow['statusCaja']!='pagado'){ ?>
         <a href="#" onClick="javascript:ventanaSecundaria('/sima/OPERACIONESHOSPITALARIAS/urgencias/actualizaPagos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/changebtn.png" alt="Aplicar Cargos" width="24" height="22" border="0" /></a>
        <?php } else { echo '---';}?></td>
      <td width="20" bgcolor="<?php echo $color?>" class="style12">
      
      <?php if($myrow['statusCaja']!='pagado'){ ?>
      <a href="javascript:ventanaSecundaria1('/sima/cargos/verCargos.php?almacen=<?php echo $_GET['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=externo&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>')"><img src="/sima/imagenes/printer.jpg" alt="" width="20" height="18" border="0" /></a> 
       <?php } else { echo '---'; }?>      </td>
      <td width="30" bgcolor="<?php echo $color?>" class="style12">
        <p>
          <?php if($myrow['statusCaja']!='pagado'){ ?>
          <a href="javascript:ventanaSecundaria1('/sima/cargos/agregaArticulos.php?almacen=<?php echo $_GET['almacen']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=externo&folioVenta=<?php echo $myrow['folioVenta']; ?>&numeroE=<?php echo $myrow['numeroE']; ?>&usuario=<?php echo $usuario; ?>&keyCAP=<?php echo $keyCAP;?>&seguro=<?php echo $myrow['seguro'];?>')"><img src="/sima/imagenes/listado.jpg" alt="" width="20" height="18" border="0" /></a>
          
           <?php } else { echo '---'; ?>
                    
           <?php } ?>
          </p>        </td>
      <td width="20" bgcolor="<?php echo $color?>" class="style12">
      <?php if($myrow['statusCaja']!='pagado'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/aplicarCoaseguro.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Aplicar Cargos" width="20" height="18" border="0" /></a>
        <?php } else { echo '---';}?>        </td>
      <td width="20" bgcolor="<?php echo $color?>" class="style12">
      
      <?php if($myrow['statusCaja']=='pagado'){ ?>
      <a href="javascript:ventanaSecundaria1('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&folioFactura=<?php echo $_POST['folioFactura']; ?>&paciente=<?php echo $_POST['paciente']; ?>&usuario=<?php echo $usuario; ?>&hora1=<?php echo $hora1; ?>&fechaImpresion=<?php echo $_POST['fechaImpresion'];?>&credencial=<?php echo $_POST['credencial'];?>&siniestro=<?php echo $_POST['siniestro'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">
      <img src="/sima/imagenes/printer.jpg" alt="" width="20" height="18" border="0" /></a>
      <?php } else { echo '---';}?>      </td>
      <td width="43" bgcolor="<?php echo $color?>" class="style12"><span class="style7">
        <?php
echo $myrow['usuario'];
?>
      </span></td>
      <td width="46" bgcolor="<?php echo $color?>" class="style12">
      <?php if($myrow['statusCaja']!='pagado'){ ?>
      <a href="listadoPacientes.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;fechaSol=<?php echo $fecha2; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;almacen=<?php echo $_GET['almacen'];?>"><img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="20" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas cancelarle la cuenta a <?php echo $myrow['paciente'];?>?') == false){return false;}" /></a>
      <?php } else { ?>
	  <img src="/sima/imagenes/btns/checkbtn.png" alt="" width="20" height="18" border="0" />
	  
	 <?php  }
	  ?>      </td>
</tr>
    <?php  }}?>
    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
  </table>






</form>
</body>
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</html>


