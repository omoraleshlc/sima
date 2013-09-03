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


<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>

<body>


  <h1 align="center" >Listado de Medicos  </h1>
  <p>
<label>
  <div align="center">
  </label>
<div align="center">
  <p >
    <input name="nuevo" type="button"  id="nuevo" value="Nuevo Medico"
	  onclick="ventanaSecundaria1('../ventanas/catmedicos.php')" />
  </p>
  <p >&nbsp;</p>
</div>


      
<form id="form1" name="form1" method="post" action="modificaMedicos1.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=">


  <table width="672" class="table table-striped">
    <tr >
      <th width="18"  scope="col"><span ># </span></th>
        <th width="27"  scope="col"><span >Cedula P</span></th>
        <th width="27"  scope="col"><span >Cedula E</span></th>
      <th  scope="col"><span >NombreMedico</span></th>
      <th  scope="col">Especialidad</th>
      
      <th  scope="col" ><span >Status</span></th>
      <th  scope="col" colspan="2"><span >Servicios</span></th>

    </tr>
    <tr>
<?php	

$sSQL= "SELECT *
FROM
medicos 
where
entidad='".$entidad."'
order by 
apellido1
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
$nombreCompleto=$myrow['apellido1'].' '.$myrow['apellido2'].' '.$myrow['nombre1'].' '.$myrow['nombre2'];
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
        
        
<td width="18" bgcolor="<?php echo $color;?>" ><span >
<?php echo $a;?> 
</span></td>
        
      <td width="27" bgcolor="<?php echo $color;?>" ><span >
<?php echo $myrow['cedula'];?> 
     </span></td>
        
              <td width="27" bgcolor="<?php echo $color;?>" ><span >
<?php echo $myrow['cedulaE'];?> 
     </span></td>
        
	
      <td width="185" bgcolor="<?php echo $color;?>" >
          <span >         

<?php echo $nombreCompleto;?></span>
<span >

	  </span></span></td>
      <td width="101" bgcolor="<?php echo $color;?>" ><?php echo $myrow6['descripcion']; ?></td>
        
        
        
    
      
      
      
      <td width="131" bgcolor="<?php echo $color;?>" ><div align="left" >
              <a href="#"  onclick="javascript:ventanaSecundaria1('../ventanas/catmedicos.php?nombreCompleto=<?php echo $nombreCompleto;?>&numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $N?>')">
              Editar
              </a>
          </div></td>
      
      
      <td width="131" bgcolor="<?php echo $color;?>" ><div align="left" >
              <a href="#"  onclick="javascript:ventanaSecundaria1('../ventanas/serviciosMedicos.php?nombreCompleto=<?php echo $nombreCompleto;?>&numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $myrow['numMedico'];?>')">
              Editar
              </a>
          </div></td>
      
      
      
      
      
      <td width="81" bgcolor="<?php echo $color;?>" ><div align="left" > 
        <?php if($myrow['status']=='A'){ ?>
        <a href="modificaMedicos1.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;id_proveedor=<?php echo $A; ?>&amp;keyMedico=<?php echo $No; ?>"> <img src="/sima/imagenes/btns/addbtn2.png" alt="Almacén ó Médico Activo" width="25" height="25" border="0" onClick="if(confirm('¿Estás seguro que deseas inactivar este registro?') == false){return false;}" /></a>
        <?php } else { ?>
        <a href="modificaMedicos1.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;keyMedico=<?php echo $No?>"> <img src="/sima/imagenes/btns/stopbtn.png" alt="INACTIVO" width="25" height="25" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
        <?php } ?>
      </div></td>
    </tr>
    <?php  }}?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>

<p align="center" >&nbsp;</p>
  <p ><span >
    <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
    </span>
    </p>
</form>
<p>&nbsp; </p>
</body>
</html>