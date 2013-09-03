<?PHP require("menuOperaciones.php"); ?>



<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 


<?php 
if($_GET['keyMedico']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE medicos set 

		status='I'
		WHERE keyMedico='".$_GET['keyMedico']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else {
$q = "UPDATE medicos set 

		status='A'
		WHERE keyMedico='".$_GET['keyMedico']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" version="-//W3C//DTD XHTML 1.1//EN" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
<title></title>
<style type="text/css">
<!--
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
.style13 {color: #FFFFFF}
.enlace {cursor:default;}
-->

a.Ntooltip {
position: relative;
text-decoration: none !important;
color:#0080C0 !important;
font-weight:bold !important;
}

a.Ntooltip:hover {
z-index:999;
background-color:#000000;
}

a.Ntooltip span {
display: none;
}

a.Ntooltip:hover span {
display: block;
position: absolute;
top:2em; left:2em;
width:50px;
padding:5px;
background-color: #0080C0;
color: #FFFFFF;
}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.Estilo24 {font-size: 10px}
</style>
</head>

<body>
<?php ventanasPrototype::links();?>
<form id="form2" name="form2" method="post" action="">
  <h1 align="center"><strong>LISTADO DE MEDICOS </strong></h1>
  <p>
<label>
  <div align="center">
  </label>
</form>
<form id="form1" name="form1" method="post" action="modificaMedicos.php">
  <table width="637" border="0" align="center">
    <tr bgcolor="#FFFF00">
      <th width="53" class="style12" scope="col"><div align="left"><span class="none">Código </span></div></th>
      <th class="style12" scope="col"><div align="left"><span class="none">Nombre del M&eacute;dico:</span></div></th>
      <th class="style12" scope="col"><div align="left"><span class="none">Tipo M&eacute;dico </span></div></th>
      <th class="style12" scope="col"><div align="left"><span class="none">Editar S. </span></div></th>
      <th class="style12" scope="col"><div align="left"><span class="none">Editar Med.</span></div></th>
      <th class="style12" scope="col"><div align="left"><span class="none">Status</span></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *
FROM
medicos 
where
entidad='".$entidad."'
order by 
numMedico
ASC
";
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$No=$myrow['keyMedico'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$nombrePaciente =
	  $myrow['apellido1']." ".$myrow['apellido2']." ".$myrow['apellido3']." ". $myrow['nombre1']." ".$myrow['nombre2'];
	  $N=$myrow['numMedico'];
	  ?>
      <td height="24" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">



 

<?php echo $N?>
 
     </span></td>
	
      <td width="354" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">


<?php if($myrow['ruta']!=NULL){?>
<span class="tooltip html_tooltip_content2" ><?php echo $nombrePaciente;?></span>
<a class=Ntooltip href="listadoMedicos.php"><img src="/sima/imagenes/camera2.jpg" width="10" height="10" border="0"><span> 
<img src="/sima/ADMINHOSPITALARIAS/medicos/<?php echo $myrow['ruta'];?>" width="50" height="50" border="0"></span></a>
<?php } else {?>

<span class="tooltip html_tooltip_content2" >

<?php echo $nombrePaciente;?></span>
<?php } ?>


	 <div id="tooltip_content2" style="display:none">

	  <?php echo "\n".
	  '<h4>'."DATOS PERSONALES".'</h4>'."\n".
	  "fechaNac: ".$myrow['fechaNacimiento']."\n".
	  "País: ".$myrow['pais']."\n".
	  "Núm. Teléfono: ".$myrow['telefono']."\n".
	  "Dirección: ".$myrow['direccion']."\n".
	  "CP: ".$myrow['cp']."\n".
	  "Ciudad: ".$myrow['ciudad']."\n".
	  "Estado: ".$myrow['estado']."\n".
 	  "Num. Cédula: ".$myrow['cedula']."\n".
	  "fecha Titulación: ".$myrow['fechaTitulacion']."\n".
	  "RFC: ".$myrow['rfc']."\n"
	  ;
	  ?></div>

<script>
  TooltipManager.init("tooltip", {options: {method: 'get'}});
</script>
	  



	  </span></td>
      <td width="55" bgcolor="<?php echo $color;?>" class="style12"><?php echo $myrow['tipoMedico']; ?></td>
      <td width="54" bgcolor="<?php echo $color;?>" class="style12"><div align="left"><span class="style71"> 
        
             <a href="#" onClick="javascript:ventanaSecundaria('mostrarServiciosMedicos.php?numeroE=<?php echo $myrow['numeroE']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numMedico=<?php echo $N?>')">
      <img src="/sima/imagenes/edit.jpg" alt="EDITAR" width="12" height="12" border="0" />	  </a> </span></div></td>
      <td width="56" bgcolor="<?php echo $color;?>" class="style12"><div align="left"><span class="style71"><a href="#"  onclick="javascript:ventanaSecundaria('ventanaModificaMedicos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $N?>')"><img src="/sima/imagenes/edit.jpg" alt="EDITAR" width="12" height="12" border="0" /></a></span></div></td>
      <td width="39" bgcolor="<?php echo $color;?>" class="style12"><div align="left"><span class="style71"> </span><span class="Estilo24">
        <?php if($myrow['status']=='A'){ ?>
        <a href="listadoMedicos.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;id_proveedor=<?php echo $A; ?>&amp;keyMedico=<?php echo $No; ?>"> <img src="/sima/imagenes/surtido.png" alt="Almacén ó Médico Activo" width="12" height="12" border="0" onClick="if(confirm('¿Estás seguro que deseas inactivar este registro?') == false){return false;}" /></a>
        <?php } else { ?>
        <a href="listadoMedicos.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;keyMedico=<?php echo $No?>"> <img src="/sima/imagenes/candado.png" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
        <?php } ?>
      </span></div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  </span></span>
</form>
<p>&nbsp; </p>
</body>
</html>