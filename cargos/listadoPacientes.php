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
	
	//************CASO 1 **********************
$sSQL1t= "Select status,usuario,folioVenta From transacciones WHERE entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."'  ";
$result1t=mysql_db_query($basedatos,$sSQL1t);
$myrow1t = mysql_fetch_array($result1t);
echo mysql_error();
//echo $_GET['folioVenta'];

//echo $myrow1t['status'].' '.$myrow1t['folioVenta'];

if($myrow1t['status']=='standby' ){ 
//echo "Debes terminar de  completar la transaccion: ".$myrow1t['folioVenta'];
$disabled='disabled=""';
?>
<script>
window.alert("Estimado: <?php echo $myrow1t['usuario'];?>, este folio ya tiene movimientos, imposible cancelar! ");
window.close();
</script>
<?php }  else {
//INSERTAR LOS ELIMINADOS
	
$q = "UPDATE clientesInternos set 

	status='cancelado',
	statusCaja='cancelado'
		WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();

                		$q1 = "UPDATE cargosCuentaPaciente set

	status='',statusCuenta='',statusCaja='',fechaCierre='',fechaCargo=''
		WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();

	}
}
}

}
?>

 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>
  

        <script type="text/javascript" src="/sima/js/editp/spec/support/jquery.js"></script>
        <script type="text/javascript" src="/sima/js/editp/spec/support/jquery.ui.js"></script>
        <script type="text/javascript" src="/sima/js/editp/lib/jquery.editinplace.js"></script>
        <link rel="stylesheet" href="/sima/js/editp/demo/css/styles.css" type="text/css" media="screen" title="no title" charset="utf-8" />






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>

</head>

<body>

<br />
<form id="form1" name="form1" method="POST" action="#">

      <div align="center">
	<span >
        <input name="button" type="image"   id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
      </span>
      

          <input name="fechaSolicitud" type="text"  id="campo_fecha"
	  value="<?php 
	  if($_POST['fechaSolicitud'] or $_GET['fechaSol']){
	  if($_POST['fechaSolicitud']){
	  echo $fecha2=$_POST['fechaSolicitud'];
	  }else{
	  echo $fecha2=$_GET['fechaSol'];
	  }
	  } else {
	  echo $fecha2=$fecha1; 
	  } ?>" size="15" readonly="" onChange="javascript:this.form.submit();"/>
      </div>
      
      
  <p align="center">&nbsp;</p>
  <table width="1057"  class="table table-striped">
    <tr >
      <th width="43"   ><div align="center" >Folio</div></th>
      <th   ><div align="center" >Paciente</div></th>
      <th   ><div align="center" >Aseguradora</div></th>
	  <th   ><div align="center" >NV</div></th>
	  <th   ><div align="center" >EC</div></th>
	  <th   ><div align="center" >P/A</div></th>
	  
	  <th   ><div align="center" >C/D</div></th>

	  <th  ><div align="center" >Edit</div></th>
	  <th  ><div align="center" >Usuario</div></th>
	  <th  ><div align="center" >Status</div></th>
    </tr>

<?php	
$sSQL= "SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."' 
and
almacen='".$_GET['almacen']."' 
and
fecha='".$fecha2."'
and
status not like '%cance%'
and
folioVenta!=''
and
tipoPaciente='externo'
and 
statusDevolucion!='si'
order by paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];


$nT=$myrow['keyClientesInternos'];
	  ?>
    
<script type="text/javascript">
/*
 * Another In Place Editor - a jQuery edit in place plugin
 *
 * Copyright (c) 2009 Dave Hauenstein
 *
 * License:
 * This source file is subject to the BSD license bundled with this package.
 * Available online: {@link http://www.opensource.org/licenses/bsd-license.php}
 * If you did not receive a copy of the license, and are unable to obtain it,
 * email davehauenstein@gmail.com,
 * and I will send you a copy.
 *
 * Project home:
 * http://code.google.com/p/jquery-in-place-editor/
 *
 */
$(document).ready(function(){
	

	// Using a callback function to update 2 divs
	$("#<?php echo $myrow['keyClientesInternos']; ?>").editInPlace({
          url: "/sima/cargos/actualizaNombrePx.php"
		//callback: function(element_id,original_element, html, original){
                     
		//	$("#updateDiv1").html("The original html was: " + original);
		//	$("#updateDiv2").html( html);
                //        $("#updateDiv3").html("El ID es el: " + element_id);
		//	return(html);
		//}
	});
	


	
	// If you need to remove an already bound editor you can call

	// > $(selectorForEditors).unbind('.editInPlace')

	// Which will remove all events that this editor has bound. You need to make sure however that the editor is 'closed' when you call this.
	
});
</script>     
    
      <tr  >
      <td height="58"  bgcolor="<?php echo $color?>" ><?php echo $myrow['folioVenta'];
?></td>


      <td width="194" bgcolor="<?php echo $color?>"  id="<?php echo $myrow['keyClientesInternos']; ?>">

  <div align="left" >
 <?php echo $myrow['paciente'];?>    
  </div>
	 

          <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="188" bgcolor="<?php echo $color?>" ><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
entidad='".$entidad."'
and
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "PARTICULAR";
		  }
?></span></td>

      <td width="87" bgcolor="<?php echo $color?>"  align="center"><?php if($myrow['statusCaja']=='pagado'){ ?>
        <a href="javascript:ventanaSecundaria1('/sima/INGRESOS HLC/caja/imprimirEstadoCuenta.php?almacen=<?php echo $_GET['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=externo&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>&entidad=<?php echo $entidad;?>')"> Ver Nota de Venta </a>
        <?php } else { echo '---'; }?></td>
      <td width="103" bgcolor="<?php echo $color?>"  align="center">
	      
      
      <a href="javascript:ventanaSecundaria1('/sima/cargos/despliegaCargos.php?almacen=<?php echo $_GET['almacen']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=externo&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>')"> Ver Estado de Cuenta</a> 
         </td>
      <td width="89" bgcolor="<?php echo $color?>"  align="center"><?php if($myrow['statusCaja']!='pagado'){ ?>
         <a href="#" onClick="javascript:ventanaSecundaria('/sima/cargos/actualizaPagosExternos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $myrow['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')">Cambia Responsable</a>
        <?php } else { echo '---';}?></td>
      
     
      <td width="73" bgcolor="<?php echo $color?>"  align="center">
      <?php if($myrow['statusCaja']!='pagado'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria1('../ventanas/aplicarDeducible.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $_GET['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nT=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">Cargar Coaseguro</a>
        <?php } else { echo '---';}?>        </td>
      
      <td width="74" bgcolor="<?php echo $color?>"  align="center">
	          <?php if($myrow['statusCaja']!='pagado'){ ?>
	  <a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/urgencias/datosAdicionales.php?folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyCAP=<?php echo $keyCAP;?>')">

        Editar Ingreso
		  </a>
        <?php } else { echo '---';}?>
    </td>
      <td width="95" bgcolor="<?php echo $color?>"  align="center">
        <?php
echo $myrow['usuario'];
?>
      </span></td>
      <td width="89" bgcolor="<?php echo $color?>"  align="center">
      <?php if($myrow['statusCaja']!='pagado' and $myrow['folioVenta']!=''){ ?>
     
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



