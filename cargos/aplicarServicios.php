<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php'); ?>

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
 window.open(URL,"ventana","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
 window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
 window.open(URL,"ventanaSecundaria5","width=150,height=100,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

  <script language=javascript> 
function ventanaSecundaria9 (URL){ 
   window.open(URL,"ventana9","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<?php 
if($_POST['apply']){
$keyClientesInternos=$_POST['keyClientesInternos'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyClientesInternos[$i]){
$q1 = "UPDATE clientesInternos set 
statusServicios='recibido',


usuarioRecepcion='".$usuario."'

WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}

}
echo 'Se recibieron servicios';
}
?>
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
CONTENT="60"> 
<body>


<h1 align="center" class="titulos">LISTADO DE SERVICIOS PAGADOS</h1>
<form id="form1" name="form1" method="POST" >
  <h1 align="center"> <?php echo $TITULO; ?></h1>
  
  <table width="548" class="table table-striped">
    <tr >
      <th width="46"  scope="col"><div align="left" > FolioV</div></th>
      <th  scope="col"><div align="left" >Paciente</div></th>
      <th  scope="col"><div align="left" >Aseguradora</div></th>
	  <th  scope="col"><div align="left" >Print</div></th>
	  <th  scope="col"><div align="left" >Depto. Solicita</div></th>
	  <th  scope="col"><div align="left" >User</div></th>
	  <th  scope="col"><div align="left" ></div></th>
    </tr>
    <tr>
      <?php	

$sSQL= "SELECT *,cargosCuentaPaciente.almacenSolicitante as ast
FROM
clientesInternos,cargosCuentaPaciente
WHERE 
clientesInternos.entidad='".$entidad."' 

and
(cargosCuentaPaciente.almacenDestino='".$_GET['almacen']."')
and
clientesInternos.fecha='".$fecha1."'
and
clientesInternos.statusServicios=''
and
clientesInternos.statusCaja='pagado'
and
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos
group by cargosCuentaPaciente.keyClientesInternos
order by clientesInternos.paciente ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$nT=$myrow['keyClientesInternos'];
?>
      <td height="24" bgcolor="<?php echo $color?>" >
	  <?php echo $myrow['folioVenta'];?>
      </span></td>


      <td width="131" bgcolor="<?php echo $color?>" >

	  	  <?php 

$verificaCargos=new acumulados();
$verificaCargos->verificaCargos($basedatos,$usuario,$numeroE,$nCuenta);
if($myrow['paciente']){	  
?>

	  <?php echo $myrow['paciente'];?>
	  <?php }  else {?> 
	  <?php echo $myrow['paciente']." [NO TIENE NINGUN CARGO]";?>
	  
	  <?php }  ?> 
        <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>"/>
        <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
      </span></td>

      <td width="111" bgcolor="<?php echo $color?>" ><?php 
	  	  if($myrow['seguro']){
		   $numCliente= $myrow['seguro'];
		   $sSQL17= "
	SELECT 
*
FROM
clientes
WHERE 
numCliente = '".$numCliente."'
";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
		 echo $myrow17['nomCliente'];
		  } else {
		  echo "Sin Seguro";
		  }
?></span></td>

      <td width="32" bgcolor="<?php echo $color?>" ><div align="center"><a href="javascript:ventanaSecundaria1('imprimirContenidos.php?folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;keyClientesInternos=<?php echo $myrow['keyClientesInternos']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;almacen=<?php echo $myrow['almacenDestino'];?>')"><img src="/sima/imagenes/btns/printer.png" alt="" width="20" height="20" border="0" /></a></div></td>
      <td width="132" bgcolor="<?php echo $color?>" ><span class="style7">
        <?php
	
				    $sSQL17a= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'
";
$result17a=mysql_db_query($basedatos,$sSQL17a);
$myrow17a = mysql_fetch_array($result17a);
echo $myrow17a['descripcion'];
?>
      </span></td>
      <td width="46" bgcolor="<?php echo $color?>" >
  <?php
echo $myrow['usuario'];
?>
</span></td>
<td width="20" bgcolor="<?php echo $color?>" ><label>
  <input type="checkbox" name="keyClientesInternos[]" id="checkbox" value="<?php echo $myrow['keyClientesInternos'];?>" />
</label></td>
    </tr>
    <?php  }}?>
    <input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
    <input name="almacen" type="hidden" value="<?php echo $_GET['almacen'];?>" />
  </table>







  <p align="center">
    <label>
    <?php if($bandera>=1){ ?>
    <input type="submit" name="apply" id="apply" value="Aplicar Servicio" />
    <?php } ?>
    </label>
  </p>
</form>
</body>
</html>


