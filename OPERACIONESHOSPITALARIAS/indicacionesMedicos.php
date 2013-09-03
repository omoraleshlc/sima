<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php");?>
 <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
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
   window.open(URL,"ventana1","width=600,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la cuenta a caja? la operaci�n es irreversible')) return true;
return false;
}
-->
</script>

<?php  
if(is_numeric($_GET['rand']) AND $_GET['cierre']=='si' ){

if($_GET['tipoCierre']=='revision'){

$q = "UPDATE clientesInternos set 
statusCuenta='revision' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
} else if($_GET['tipoCierre']=='caja'){
$q = "UPDATE clientesInternos set 
statusCuenta='caja' WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}


}
?>

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="../calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>
<META HTTP-EQUIV="Refresh"
CONTENT="20"> 
<body>
<form id="form1" name="form1" method="get" >
  <div align="left">
    <label></label>
    <div align="center">
      <p>&nbsp;      </p>
      <p>
      <?php
		 if($_GET['fechaInicial']){
		 $date= $_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 ?>
      
        <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		value="<?php
		
		 echo $date;
		 
		 ?>"/>
        <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" />
      </p>
    </div>
  </div>
  <h1 >Listado de Pacientes </h1>
  <span ></span>
 
  <table width="628" border="0.2" align="center" cellpadding="4" cellspacing="0">
    <tr>
      <th width="67"   scope="col"><div align="left" >
        <div align="center"># Cuenta  </span></div>
      </div></th>
      <th   scope="col"><div align="left" >Nombre del paciente</span></div></th>
      <th   scope="col"><div align="left" >Seguro</div></th>
      <th   scope="col"><div align="center" >
        <div align="center">Cub&iacute;culo</span></div>
      </div></th>
      
 
      <th   scope="col" align="center">Indicaciones</th>
      <th   scope="col" align="center">Notas</th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and

almacen='".$ALMACEN."'
and
fecha='".$date."'
ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

if($col){
$color = '#FFFFCC';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


	  ?>
	  
<td height="24" bgcolor="<?php echo $color?>" ><div align="left"><?php echo $myrow['keyClientesInternos'];
?></span></div></td>
      <td width="253" bgcolor="<?php echo $color?>" >

	  <?php echo $myrow['paciente'];
	  if($myrow['status']=='ontransfer'){
	  echo '   [Se solicito la transferencia de este paciente]';
	  }
	  ?>
      </span></td>
      <td width="90" bgcolor="<?php echo $color?>" ><?php 
	  if($myrow['seguro']){
	  echo $myrow['seguro'];
	  } else {
	  echo 'particular';
	  }
?></td>
      <td width="58" bgcolor="<?php echo $color?>" ><div align="center"><?php echo $myrow['cuarto']
?></span></div></td>
    
  
	  <td width="67" bgcolor="<?php echo $color?>" ><div align="center"><a href="#" onClick="javascript:ventanaSecundaria2('../ventanas/notasClinicas.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/nuevo.jpg" alt="Aplicar Cargos" width="24" height="24" border="0" /></a></div></td>
	  <td width="67" bgcolor="<?php echo $color?>" ><div align="center"><a href="#" onClick="javascript:ventanaSecundaria2('notasClinicas.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;tipoPaciente=<?php echo "interno"; ?>')"><img src="/sima/imagenes/btns/editbtn.png" alt="Aplicar Cargos" width="24" height="24" border="0" /></a></div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
<span ><span >
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  
    <input name="main" type="hidden" id="nombrePaciente" value="<?php echo $_GET['main']; ?>" />
  <input name="warehouse" type="hidden" id="nombrePaciente2" value="<?php echo $_GET['warehouse']; ?>"/>
  <input name="datawarehouse" type="hidden" id="tipoSeguro" value="<?php echo $_GET['datawarehouse']; ?>"/>
  </span></span>

</form>
</body>
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
</html>