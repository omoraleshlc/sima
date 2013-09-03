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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos-> styles();
?>

</head>

<body>
<h1 align="center" class="titulos">Pacientes con Paquetes asignados </h1>
<?php echo $leyenda; ?>
  <form id="form1" name="form1" method="post" action="#" >
    <p>
      <?php


$sSQL= "
SELECT * FROM 
cargosCuentaPaciente,clientesInternos
where 
cargosCuentaPaciente.entidad='".$entidad."'
and
cargosCuentaPaciente.paquete='si'
and
cargosCuentaPaciente.statusCargo='cargadoR'
and
cargosCuentaPaciente.statusCuenta='cerrada'
and
cargosCuentaPaciente.almacen='".$_GET['almacen']."'
    and
    clientesInternos.folioVenta=cargosCuentaPaciente.folioVenta
    and
    clientesInternos.statusDevolucion!='si'
group by cargosCuentaPaciente.folioVenta
";



$result=mysql_db_query($basedatos,$sSQL);

?></p>


    <table class="table table-striped" width="500" border="0" align="center">
    <tr>
      <th width="80" height="19" bgcolor="#660066" scope="col"><div align="left" class="blanco">Folio Venta </div></th>
      <th width="208" bgcolor="#660066" scope="col"><div align="left" class="blanco">Paciente</div></th>
      <th width="70" bgcolor="#660066" scope="col"><div align="left" class="blanco">Cargar</div></th>
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

$sSQL31= "Select  * From clientesInternos WHERE entidad='".$entidad."' and folioVenta='".$myrow['folioVenta']."'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);





?>


        <td height="24" bgcolor="<?php echo $color;?>" class="normal">

          <div align="left">

		  
          <?php 
			echo $myrow31['folioVenta'];
		
		  ?>        
          

          </div></td>
		  
		  <td bgcolor="<?php echo $color;?>" class="normal">
		
		<?php echo $myrow31['paciente'];?>
		
		
	    </td>
        <td bgcolor="<?php echo $color;?>" class="normal">
		
		
		<a href="#" 
onClick="javascript:regresar('<?php echo $myrow31['folioVenta'];?>','<?php echo $myrow31['paciente'];?>')">
		<img src="/sima/imagenes/btns/addbtn.png" alt="Datos Generales del Paciente" width="19" height="19" border="0" />
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
