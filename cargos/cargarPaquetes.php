<?php include("/configuracion/operacioneshospitalariasmenu/laboratorio/menulab.php"); ?>
<?php include("/configuracion/funciones.php"); ?>


<?php  //class internar{ ?>
<?php //public function internarPaciente($usuario,$numeroE,$basedatos){ ?>
<?php
$campo=$_GET['campo'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoFechaNac=$_GET['fechaNac'];
$campoEdad=$_GET['edad'];

?>



<script type="text/javascript">
	function regresar(keyClientesInternos,paciente){
		self.opener.document.<?php echo $forma;?>.keyClientesInternos.value = keyClientesInternos;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = paciente;

		close();
	}
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventana20","width=800,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.catalogo {    font-family: Verdana, Arial, Helvetica, sans-serif;  
    font-size: 9px;  
    color: #333333;  
}
.style13 {
	color: #FFFFFF;
	font-weight: bold;
}
.enlace {cursor:default;}
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
-->
</style>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style111 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style111 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.Estilo26 {font-size: 10px}
.Estilo26 {font-size: 10px}
.style121 {font-size: 10px}
.style121 {font-size: 10px}
.Estilo27 {font-size: 10px}
.Estilo27 {font-size: 10px}
.Estilo28 {font-size: 10px}
.Estilo28 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
</head>

<body>
<h1 align="center">Pacientes con Paquetes asignados </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
    <p>
      <?php


$sSQL= "
SELECT * FROM 
almacenesPaquetes
where 
id_almacen='".$ALMACEN."'
and
status='standby'
";



$result=mysql_db_query($basedatos,$sSQL);

?></p>


    <table width="545" border="0" align="center">
    <tr>
      <th width="62" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11"># Movto </span></div></th>
      <th width="315" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Paciente</span></div></th>
      <th width="97" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Fecha de Venta </span></div></th>
      <th width="53" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Cargar</span></div></th>
    </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 

$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL31= "Select  * From clientesInternos WHERE keyClientesInternos='".$myrow['keyClientesInternos']."'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);





?>


        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">

          <div align="left">

	
          <?php 
			echo $myrow['keyClientesInternos'];
		
		  ?>        
          </div></td>
		  
		  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
		
		<?php echo $myrow31['paciente'];?>
		
		
		 
		<span class="style12"></span> </span></td>
          <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php echo $myrow31['hora'].' '.cambia_a_normal($myrow31['fecha']);?></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12">
		
		
		<a href="#" onClick="ventanaSecundaria20('/sima/cargos/agregaArticulosPaquetes.php?almacen=<?php echo $ALMACEN; ?>&numeroE=<?php echo $_POST['numeroEx']; ?>&nCuenta=<?php echo $myrow1['nCuenta']; ?>&credencial=<?php echo $_POST['credencial']; ?>&seguro=<?php echo $_POST['seguro']; ?>&medico=<?php echo $_POST['medico']; ?>&usuario=<?php echo $usuario; ?>&almacenDestino=<?php echo $_GET['almacen']; ?>&almacenSolicitante=<?php echo $_GET['almacen']; ?>&banderaCXC=<?php echo $_POST['banderaCXC']; ?>&cargoTotal=<?php echo $_POST['cargoTotal']; ?>&fechaSolicitud=<?php echo $_POST['fechaSolicitud']; ?>&horaSolicitud=<?php echo $_POST['horaSolicitud']; ?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&almacenSolicitud=<?php echo $ALMACEN;?>&folioVenta=<?php echo $_POST['folioVenta']; ?>');">
		<img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" />		</a>
		
		</span></td>
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
