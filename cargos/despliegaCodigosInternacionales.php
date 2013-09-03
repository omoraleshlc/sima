<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/clases/internarPaciente.php"); ?><?php include("/configuracion/funciones.php"); ?>


<?php  //class internar{ ?>
<?php //public function internarPaciente($usuario,$numeroE,$basedatos){ ?>
<?php
$campo=$_GET['campo'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];



?>



<?php
$keyClientesInternos=$_GET['keyClientesInternos'];
 $sql2= "
SELECT *
FROM
clientesInternos
WHERE
keyClientesInternos ='".$keyClientesInternos."' 

";
$result2=mysql_db_query($basedatos,$sql2);
$myrow2= mysql_fetch_array($result2);
$numeroE=$myrow2['numeroE'];
$nCuenta=$myrow2['nCuenta'];
$seguro=$myrow2['seguro'];
$medico=$myrow2['medico'];
$paciente=$myrow2['paciente'];


if($_POST['agregar']){
$keyDiagnosticos=$_POST['keyDiagnosticos'];

for($i=0;$i<=$_POST['bandera'];$i++){
if($keyDiagnosticos[$i]){



$sql5= "
SELECT *
FROM
diagnosticos
WHERE
keyDiagnosticos ='".$keyDiagnosticos[$i]."' 

";
//$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
$descripcion=$myrow5['descripcion'];
$codigo1=$myrow5['codigo'];


$agrega = "INSERT INTO dx (
numeroE,nCuenta,CI,descripcion,fecha,hora,usuario,medico,seguro) 
values ('".$numeroE."','".$nCuenta."','".$codigo1."','".$descripcion."',
'".$fecha1."','".$hora1."','".$usuario."','".$medico."','".$seguro."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
} ?>

<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);
    self.close();
  // -->
</script>
<script type="text/javascript">
	

		close();
	
</script>
<?php 
}
?>



<script type="text/javascript">
	function regresar(expediente,paciente){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = expediente;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = paciente;
		close();
	}
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>
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
.Estilo29 {font-size: 10px}
.Estilo29 {font-size: 10px}
.Estilo30 {font-size: 10px}
.Estilo30 {font-size: 10px}
.Estilo31 {font-size: 10px}
.Estilo31 {font-size: 10px}
-->
</style>
</head>

<body>
<h1 align="center"> C&oacute;digo Internacional </h1>

  <?php echo $leyenda; ?>

<form id="form1" name="form1" method="post" action="#" >
    <table width="545" align="center" cellpadding="0" cellspacing="0" class="style71" style="border: 1px solid #000000;">
      <tr valign="middle" bordercolor="#FFFFFF" bgcolor="#DFDFDF" class="catalogo">
        <td colspan="2" bgcolor="#660066"><div align="center" class="style13">Datos del Paciente <?php echo $paciente;?></div></td>
      </tr>
      <tr valign="middle" class="catalogo">
        <td>Nuevo C&oacute;digo </td>
        <td><span class="Estilo26"><span class="style121"><a 
		onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Si no existe el código internacional que busca se puede agregar pulsando éste botón...';?></div>')" onMouseOut="UnTip()"
		href="javascript:ventanaSecundaria1('/sima/cargos/ventanaCatalogoDXI.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&numeroExpediente=<?php echo $myrow['numCliente']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="12" height="12" border="0" /></a></span></span></td>
      </tr>
      <tr valign="middle" bgcolor="#FFCCFF" class="catalogo">
        <td width="140"><div align="left" class="style71">Descripci&oacute;n</div></td>
        <td width="403" bgcolor="#FFCCFF"><label>
          <input name="nombres" type="text" class="Estilo28" id="nombres2" size="60" 
		value="<?php echo $_GET['nombres'];?>" onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Escribe el posible diagnóstico..';?></div>')" onMouseOut="UnTip()" />
          <input name="mostrar" type="submit" class="style71" id="mostrar2" value="&gt;" onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona éste botón para mostrar los posibles resultados de acuerdo a tu búsqueda';?></div>')" onMouseOut="UnTip()" />
          </label>
&nbsp;
      <input name="nombrePaciente12" type="hidden" id="nombrePaciente12" value="<?php echo $_POST['numPaciente'];?>"/>
      <?php
$sSQL311= "Select max(nCuenta) as tope from clientesInternos WHERE numeroE = '".$_POST['numeroE']."'
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
    <p>
      <?php

if($nombres=$_POST['nombres']){
$sSQL= "
SELECT * FROM 
diagnosticos 
where 
descripcion like '%$nombres%'
order by
descripcion asc
";



$result=mysql_db_query($basedatos,$sSQL);

?>
</p>


<table width="544" border="0" align="center">
    <tr>
      <th width="49" height="14" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo</span></div></th>
        <th width="446" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Descripci&oacute;n</span></div></th>
        <th width="35" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Editar</span></div></th>
    </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' and statusCuenta='abierta'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>


        <td height="23" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">

          <div align="left"><a 
		  onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Muestra el código internacional: '.$myrow['descripcion'].' basada en DC9';?></div>')" onMouseOut="UnTip()"
		  href="#"  onClick="javascript:regresar('<?php echo $myrow['CI'];?>','<?php echo $myrow['descripcion'];?>')">
          <?php 
			echo $myrow['CI'];
		
		  ?>        
            </a>
            
          </div></td>
		  
		  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="Estilo29"><span class="Estilo30">
		    <?php 
			echo $myrow['descripcion'];
		
		  ?>
		  </span></span></td>
	    <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12">
		
		

		<a onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar el código internacional: '.$myrow['descripcion'];?></div>')" onMouseOut="UnTip()"
		 href="javascript:ventanaSecundaria1('/sima/cargos/ventanaCatalogoDXI.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&keyDiagnosticos=<?php echo $myrow['keyDiagnosticos']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Modificar Codigo Internacional" width="12" height="12" border="0" /></a></span></td>
    </tr>

      <?php }}?>
  </table>
  <p align="center">&nbsp;</p>
	<p>
	 <input name="bandera" type="hidden" class="Estilo24" id="nombrePaciente" size="60" value="<?php echo $bandera;?>">
     <input name="keyClientesInternos" type="hidden" class="Estilo31" id="bandera" size="60" value="<?php echo $keyClientesInternos;?>" />
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
