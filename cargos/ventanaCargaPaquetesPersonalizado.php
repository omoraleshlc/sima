<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php
$campo=$_GET['campo'];
$forma=$_GET['forma'];
$almacen=$_GET['almacen'];
$campoDespliega=$_GET['campoDespliega'];



?>



<script type="text/javascript">
	function regresar(expediente,paciente){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = expediente;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = paciente;
		close();
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
<h1 align="center">Buscar Art&iacute;culos/Servicios <?php echo $leyenda; ?>
  </h1>
<form id="form1" name="form1" method="post" action="#" >
    <?php


$sSQL= "
SELECT paquetesPacientes.codigoPaquete,paquetes.descripcionPaquete FROM 
paquetes,paquetesPacientes
where 
paquetes.entidad='".$entidad."' 
and
paquetes.codigoPaquete=paquetesPacientes.codigoPaquete
and
paquetesPacientes.numeroE='".$_GET['numeroE']."'
and
paquetesPacientes.status='activo'
order by
paquetes.descripcionPaquete asc

";



$result=mysql_db_query($basedatos,$sSQL);

?>
<table width="480" border="0" align="center">
    <tr>
      <th width="105" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo</span></div></th>
      <th width="287" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripcion</span></div></th>
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

?>


        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">

<a href="#"  onClick="javascript:regresar('<?php echo $myrow['codigoPaquete'];?>','<?php echo $myrow['descripcionPaquete'];?>')">
        <?php 
			echo $myrow['codigoPaquete'];
		
		  ?>        
		  </a>	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
		
		<?php echo $myrow['descripcionPaquete']; ?>
		
		
		 
		<span class="style12"></span> </span></td>
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
