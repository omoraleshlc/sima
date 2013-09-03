<?PHP require("menuOperaciones.php"); ?>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=750,height=800,scrollbars=YES") 
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
<title></title>
<style type="text/css">


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

</style>

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>

<body>

<form id="form2" name="form2" method="post" action="">
  <h1 align="center" class="normalmid">Listado de Medicos  </h1>
  <p>
<label>
  <div align="center">
  </label>
<div align="center">
  <p class="normal">
    <input name="nuevo" type="button" class="normal" id="nuevo" value="Nuevo Medico"
	  onclick="ventanaSecundaria1('../ventanas/catmedicos.php')" />
  </p>
  <p class="normal">&nbsp;</p>
</div>
</form>
<form id="form1" name="form1" method="post" action="modificaMedicos1.php">
  <img src="/sima/imagenes/bordestablas/borde1.png" width="672" height="24" />

  <table width="672" border="0" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">
      <th width="18" class="normal" scope="col"><div align="left" class="normal"><span class="normal"># </span></div></th>
        <th width="27" class="normal" scope="col"><div align="left" class="normal"><span class="normal">ID </span></div></th>
      <th class="normal" scope="col"><div align="left" class="normal"><span class="normal">NombreMedico</span></div></th>
      <th class="normal" scope="col">Especialidad</th>
      <th class="normal" scope="col"><div align="left" class="normal">Cedula</div></th>
      <th class="normal" scope="col"><div align="left" class="normal"><span class="normal">DatosMedico</span></div></th>
      <th class="normal" scope="col"><div align="left" class="normal"><span class="normal">Servicios</span></div></th>
      <th class="normal" scope="col"><div align="left" class="normal"><span class="normal">Status</span></div></th>
    </tr>
    <tr>
<?php	

$sSQL= "SELECT *
FROM
medicos 
where
entidad='".$entidad."'
order by 
nombreCompleto
ASC
";
if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$No=$myrow['keyMedico'];
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$nombreCompleto=$myrow['nombreCompleto'];
$N=$myrow['numMedico'];
$a+=1;



	$sSQL6="SELECT *
FROM
especialidades
WHERE
entidad='".$entidad."'
    and
codigo = '".$myrow['especialidad']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
	  ?>
        
        
<td width="18" bgcolor="<?php echo $color;?>" class="normal"><span class="normal">
<?php echo $a;?> 
</span></td>
        
      <td width="27" bgcolor="<?php echo $color;?>" class="normal"><span class="normal">
<?php echo $myrow['numMedico'];?> 
     </span></td>
	
      <td width="185" bgcolor="<?php echo $color;?>" class="normal">
          <span class="normal">         

<?php echo $nombreCompleto;?></span>
<span class="normal">

	  </span></span></td>
      <td width="101" bgcolor="<?php echo $color;?>" class="normal"><?php echo $myrow6['descripcion']; ?></td>
        
        
        
      <td width="73" bgcolor="<?php echo $color;?>" class="normal">&nbsp;</td>
      
      
      
      <td width="131" bgcolor="<?php echo $color;?>" class="normal"><div align="left" class="normal">
              <a href="#"  onclick="javascript:ventanaSecundaria1('../ventanas/catmedicos.php?nombreCompleto=<?php echo $nombreCompleto;?>&numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $N?>')">
              Editar
              </a>
          </div></td>
      
      
      <td width="131" bgcolor="<?php echo $color;?>" class="normal"><div align="left" class="normal">
              <a href="#"  onclick="javascript:ventanaSecundaria1('../ventanas/serviciosMedicos.php?nombreCompleto=<?php echo $nombreCompleto;?>&numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $myrow['numMedico'];?>')">
              Editar
              </a>
          </div></td>
      
      
      
      
      
      <td width="81" bgcolor="<?php echo $color;?>" class="normal"><div align="left" class="normal"> 
        <?php if($myrow['status']=='A'){ ?>
        <a href="listadoMedicos.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;id_proveedor=<?php echo $A; ?>&amp;keyMedico=<?php echo $No; ?>"> <img src="/sima/imagenes/btns/addbtn2.png" alt="Almacén ó Médico Activo" width="25" height="25" border="0" onClick="if(confirm('¿Estás seguro que deseas inactivar este registro?') == false){return false;}" /></a>
        <?php } else { ?>
        <a href="listadoMedicos.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;keyMedico=<?php echo $No?>"> <img src="/sima/imagenes/btns/stopbtn.png" alt="INACTIVO" width="25" height="25" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
        <?php } ?>
      </div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="672" height="24" />
<p align="center" class="normal">&nbsp;</p>
  <p class="normal"><span class="normal">
    <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
    </span>
    </p>
</form>
<p>&nbsp; </p>
</body>
</html>