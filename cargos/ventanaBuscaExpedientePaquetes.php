<?php require("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/clases/internarPaciente.php"); ?><?php include("/configuracion/funciones.php"); ?>


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
	function regresar(expediente,paciente,fechaNac,edad){
		self.opener.document.<?php echo $forma;?>.<?php echo $campo;?>.value = expediente;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoDespliega;?>.value = paciente;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoFechaNac;?>.value = fechaNac;
				self.opener.document.<?php echo $forma;?>.<?php echo $campoEdad;?>.value = edad;
		close();
	}
</script>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=630,height=700,scrollbars=YES") 
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
paquetesPacientes
where 
entidad='".$entidad."'
AND
status='activo'
order by paciente ASC
";



$result=mysql_db_query($basedatos,$sSQL);

?></p>


    <table width="338" border="0" align="center">
    <tr>
        <th width="49" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Expediente</span></div></th>
        <th width="240" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Paciente</span></div></th>
        <th width="35" bgcolor="#660066" scope="col"><span class="style111">Editar</span></th>
    </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['paciente'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numeroE']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' and statusCuenta='abierta'
and
tipoPaciente='interno'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
 if($myrow31['numeroE']){
 $interno=' [Paciente Interno]';
 } else {
 $interno='';
 }
 
$size=strlen($myrow['fechaNacimiento']);

if($size>8){
$fNac= substr($myrow['fechaNacimiento'],6,8);
$aActual=date("Y");
$edad=$aActual-$fNac;
} else {
$fNac= substr($myrow['fechaNacimiento'],6,6);
$aActual=date("Y");
$edad=$aActual-$fNac;
$edad=substr($edad,2,4);
}
?>


        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">

<a href="#" rel="htmltooltip" 
onClick="javascript:regresar('<?php echo $myrow['numeroE'];?>','<?php echo $nombrePaciente;?>','<?php echo $myrow['fechaNacimiento'];?>','<?php echo 'paquete';?>')">
        <?php 
			echo $myrow['numeroE'];
		
		  ?>        
		  </a>
		 
	    </td>
		  
		  <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
		
		<?php echo $myrow['paciente']." ".$interno;?>
		
		
		 
		<span class="style12"></span> </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12">
		
		
		<a href="javascript:ventanaSecundaria1('/sima/OPERACIONESHOSPITALARIAS/admisiones/modificarP.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;numeroExpediente=<?php echo $myrow['numCliente']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>')">
		<img src="/sima/imagenes/Save.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" />
		</a>
		
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
