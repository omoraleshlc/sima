<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/internarPaciente.php"); ?><?php include("/configuracion/funciones.php"); ?>


<?php  //class internar{ ?>
<?php //public function internarPaciente($usuario,$numeroE,$basedatos){ ?>
<?php
$campo=$_GET['campo'];
$forma=$_GET['forma'];
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
<h1 align="center">Buscar Art&iacute;culos/Servicios </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
    <table width="545" align="center" cellpadding="0" cellspacing="0" class="style71" style="border: 1px solid #000000;">
      <tr valign="middle" bordercolor="#FFFFFF" bgcolor="#DFDFDF" class="catalogo">
        <td colspan="2" bgcolor="#660066"><div align="center" class="style13">Datos del Paciente </div></td>
      </tr>
      <tr valign="middle" class="catalogo">
        <td>Nuevo Art&iacute;culo</td>
        <td><span class="Estilo26"><span class="style121"><a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" /></a></span></span></td>
      </tr>
      <tr valign="middle" bgcolor="#FFCCFF" class="catalogo">
        <td width="140"><div align="left" class="style71">Busca por Descripci&oacute;n </div></td>
        <td width="403" bgcolor="#FFCCFF"><label>
          <input name="nombres" type="text" class="Estilo28" id="nombres2" size="60" 
		value="<?php echo $_GET['nombres'];?>" />
          <input name="mostrar" type="submit" class="style71" id="mostrar2" value="&gt;" />
          </label>
&nbsp;
      <input name="nombrePaciente12" type="hidden" id="nombrePaciente12" value="<?php echo $_POST['numPaciente'];?>"/>
      <?php
$sSQL311= "Select max(nCuenta) as tope from clientesInternos WHERE entidad='".$entidad."' and numeroE = '".$_POST['numeroE']."'
 ";
$result311=mysql_db_query($basedatos,$sSQL311);
$myrow311 = mysql_fetch_array($result311);
$nCuenta=$myrow31['tope'];
$nCuenta+=1;
?>
      <input name="nCuenta" type="hidden" class="Estilo28" id="nCuenta" onKeyPress="return checkIt(event)" value="<?php echo $nCuenta; ?>" readonly=""/>
      <input name="numeroE" type="hidden" class="Estilo28" id="numeroE" value="<?php echo $numeroEs= $_POST['numeroE']; ?>" readonly="" /></td>
      </tr>
    </table>
    <p>&nbsp;</p>


<?php

if($nombres=$_POST['nombres']){
$sSQL= "
SELECT * FROM 
articulos
where 
entidad='".$entidad."' AND
descripcion like '%$nombres%' 
and
activo='A'
order by
descripcion asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
<table width="338" border="0" align="center">
    <tr>
        <th width="49" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo</span></div></th>
        <th width="240" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Descripcion</span></div></th>
        <th width="35" bgcolor="#660066" scope="col"><span class="style111">Editar</span></th>
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

<a href="#" rel="htmltooltip" onClick="javascript:regresar('<?php echo $myrow['codigo'];?>','<?php echo $myrow['descripcion'];?>')">
        <?php 
			echo $myrow['codigo'];
		
		  ?>        
		  </a>
		 
	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
		
		<?php echo $myrow['descripcion']; ?>
		
		
		 
		<span class="style12"></span> </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12">
		
		
		<a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
		<img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" />
		</a>
		
		</span></td>
    </tr>

      <?php }}?>
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
