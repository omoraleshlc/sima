<?php 
class eCuentasE{
public function eCuentaE($usuario,$entidad,$almacen,$fecha1,$hora1,$dia,$usu,$nT,$basedatos){
$bali=$almacen;
include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
}   
  
  
  
  
</script> 

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>




<?php //************************ACTUALIZO **********************
//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_GET['nT']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguroT=ltrim($myrow3['seguro']);
//***************aplicar pago**********************

if($_POST['actualizar']){



$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];
for($i=0;$i<=$_POST['bandera2'];$i++){

if($aseguradora[$i]){
$status='efectivo';
$keyCAP[]=$aseguradora[$i];
} else {

$status='cxc';
$keyCAP[]=$particular[$i];
}


$agrega = "UPDATE cargosCuentaPaciente set 
statusAlta='".$status."',
usuarioAlta='".$usuario."',
fechaAlta='".$fecha1."',
horaAlta='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();




} //cierra for
} //cierra actualizar






$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();


if($_POST['imprimir']){ 

//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$q = "UPDATE statusCaja set 
numRecibo= numRecibo+1
where
entidad='".$entidad."'
and
keyCatC='".$myrowC['keyCatC']."'
and
status='abierta'
order by keySTC DESC ";

mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQLC= "Select * From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

$q0 = "UPDATE clientesInternos,cargosCuentaPaciente set 
clientesInternos.numRecibo= '".$myrowC['numRecibo']."',
cargosCuentaPaciente.numRecibo= '".$myrowC['numRecibo']."'
where

clientesInternos.keyClientesInternos='".$_GET['nT']."'
and
clientesInternos.keyClientesInternos=cargosCuentaPaciente.keyClientesInternos

";

mysql_db_query($basedatos,$q0);
echo mysql_error();
//*************************************************************
?>
<?php if($_GET['paquete']=='si'){ ?>
<script language="javascript">
ventanaSecundaria2('/sima/cargos/imprimirReciboPaquetes.php?numeroE=<?php echo $myrow3['numeroE']; ?>&nCuenta=<?php echo $myrow3['nCuenta']; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>&codigoPaquete=<?php echo $myrow3['codigoPaquete'];?>&numRecibo=<?php echo $myrowC['numRecibo'];?>&paciente=<?php echo $_POST['paciente'];?>&cantidadRecibida=<?php echo $_POST['cantidadRecibida'];?>&folioVenta=<?php echo $myrow3['folioVenta'];?>');
close();
</script>
<?php } else { ?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosPA.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $nT; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>');
close();
</script>
<?php } ?>


<?php }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>






<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<h1 align="center" class="titulos">Nota de Venta </h1>
<form id="form1" name="form1" method="post" action="">
  <table width="642" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="blanco" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Referencia</div></th>
      <th bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco"><?php 
		 echo $nCliente=$myrow3['folioVenta'];
		  ?>
          <input name="numeroE" type="hidden" class="blanco" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="10" class="normal" scope="col">&nbsp;</th>
      <th width="134" bgcolor="#FFCCFF" class="normal" scope="col"><div align="left" class="normal">Paciente: </div></th>
      <th width="408" bgcolor="#FFCCFF"  scope="col"><div align="left" class="normal"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td class="normal">Compa&ntilde;&iacute;a: </td>
      <td class="normal">
        <label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
        </label>
      </td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="normal">N&deg; Credencial: </td>
      <td bgcolor="#FFCCFF" class="normal"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
  </table>
  <p align="center">
  <?php if($_GET['codigoPaquete']){ 
  echo 'Paquete: '.$_GET['codigoPaquete'];
  
  }?>
  </p>
  

  
  <table width="713" border="0" align="center">
    <tr>
      <th width="140" height="14" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Fecha/Hora </div></th>
      <th width="331" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Descripci&oacute;n/Concepto</div></th>
      <th width="34" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Cant</div></th>
      <th width="80" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Importe</div></th>
      <th width="50" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">IVA</div></th>
      <th width="52" bgcolor="#660066" class="blanco" scope="col"><div align="left" class="blanco">Convenio</div></th>
    </tr>
    <tr>
    
      <?php //traigo agregados
	  
if($_GET['paquete']=='si'){
$sSQL81= "
SELECT 
*
FROM
articulosPaquetesPacientes 
 WHERE 
keyClientesInternos='".$_GET['nT']."'
";


} else {
$sSQL81= "
SELECT 
keyCAP,codProcedimiento,um,hora1,fecha1,cantidad,iva,almacenDestino,almacenSolicitante,precioVenta,tipoCliente,tipoConvenio,folioVenta
FROM
cargosCuentaPaciente 
 WHERE 
keyClientesInternos='".$_GET['nT']."'
 
 
 
  order by fecha1,hora1 asc
";
}





$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 
		 $a+= '1';

if($_GET['paquete']=='si'){
$codigo=$proc=$myrow81['codigo'];
$chain=$myrow81['hora']." ".cambia_a_normal($myrow81['fecha']);

$sSQL31= "select * from articulosPaquetes where keyE='".$myrow81['keyE']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
} else {
$chain=$myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];
}






?>


  <td height="21" bgcolor="<?php echo $color;?>" class="normal">
	  <?php echo $chain;
	?></td>
      <td bgcolor="<?php echo $color;?>" class="normal">
      <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
         
		
        <?php  if($myrow811['um']=='s' or $myrow811['um']=='S'){
		echo '  ( Servicio )  ';
		} 
		?>

      </td>
      <td bgcolor="<?php echo $color;?>" ><div align="center" class="normal">
          <?php  
	

		
		echo $cantidad=$myrow81['cantidad'];
			
		

		
		?>
      </div></td>

      <td bgcolor="<?php echo $color;?>" class="normal">
        <?php 
		if($_GET['paquete']=='si'){ 
		echo '$'.number_format($myrow31['precioPaquete1'],2);
		$sumatoria[0]+=$myrow31['precioPaquete1']*$myrow31['cantidad'];
		} else {
		$importe=new acumulados();
		echo $importe->importe($keyCAP,$basedatos);
		}
		?>
   </td>
      <td bgcolor="<?php echo $color;?>" class="normal">
        <?php 
		
		if($_GET['paquete']=='si'){ 
		echo '$'.number_format($myrow31['ivaPrecioPaquete1'],2);
		$sumatoriaIVA[0]+=$myrow31['ivaPrecioPaquete1']*$myrow31['cantidad'];
		} else {
		$mostrarIVA=new articulosDetalles();
		echo $mostrarIVA->mostrarIVA($keyCAP,$basedatos);
		}
		?>
      </td>
      <td bgcolor="<?php echo $color;?>"><div align="center" class="normal">
	   
      
      <?php 

	  if($myrow81['tipoConvenio'] AND $myrow81['tipoConvenio']!='No'){echo 'C';}else{echo '---';}
		?>
   </div></td>
	</tr>
 
	
	
    <?php }?>
  </table>

  <p>&nbsp;</p>
  <div align="center">
    <table width="558" border="0" align="center">
      <tr>
        <td width="113" class="style12">&nbsp;</td>
        <td width="124" class="style12">&nbsp;</td>
        <td width="97" class="normal">Total Cargos 
          <?php 
		  $totalAcumulado=new acumulados();
		  
		  
		  if($_GET['paquete']=='si'){ 
		echo '$'.number_format($sumatoria[0]+$sumatoriaIVA[0],2);
		$cantidadRecibida=$sumatoria[0]+$sumatoriaIVA[0];
		} else {
		
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),2);
		}
		?>
      </td>
        <td width="106" height="23"><div align="left" class="normal">Total Abonos 
            <?php 		 
		$abonos=new acumulados();
		echo "$".number_format($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),2); ?>
        </div></td>
        <td width="96"><div align="left" class="normal"><strong>Saldo Actual</strong><strong>
          <?php 
		  
		  if($_GET['paquete']=='si'){
		  		  $abono=$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta);
		  $abono1=$abono*'-1';
		  echo '$'.number_format(round(($sumatoria[0]+$sumatoriaIVA[0])-$abono1),2);
		  } else {
		  if($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta)<0){
		  $abono=$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta);
		  $abono1=$abono*'-1';
		  }
		  echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta)-$abono1,2);
		  }
		
		?>
        </strong></div></td>
      </tr>
      <tr>
        <td class="style12">&nbsp;</td>
        <td class="style12">&nbsp;</td>
        <td class="style12"><input name="cantidadRecibida" type="hidden" class="style7" id="cantidadRecibida" value="" /></td>
        <td height="23" class="normal"><div align="right"></div></td>
        <td class="normal"><div align="right"></div></td>
      </tr>
      <tr>
        <td class="style12">&nbsp;</td>
        <td class="style12">&nbsp;</td>
        <td class="style12">&nbsp;</td>
        <td height="23" class="style23 Estilo24"><div align="right"></div></td>
        <td class="style12"><div align="right"></div></td>
      </tr>
    </table>


  </div>
  <p align="center">
	<?php 
	if($_GET['paquete']=='si'){
	
	
	//***********************CALCULAR
		if(round(($sumatoria[0]+$sumatoriaIVA[0])-$abono1)==NULL){ 
	?>
    <label>
    <input name="imprimir" type="image" class="style27" id="imprimir" value="Imprimir" src="/sima/imagenes/btns/printbutton.png"/>
    </label>
	<?php } else {?>
    <input name="Submit" type="image" class="style27" value="Aplicar Pagos" src="/sima/imagenes/btns/aplicapay.png"  onclick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $_GET['almacenSolicitante']; ?>&almacenFuente=<?php echo $almacen; ?>&seguro=<?php echo $seguroT; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo $_GET['tipoVenta'];?>&paquete=<?php echo $_GET['paquete'];?>')"/>
    <input name="keyClientesInternos" type="hidden" class="style7" id="keyClientesInternos" value="<?php echo $_GET['nT'];?>" />
	<?php } 
	
	//*********************************
	
	} else { 
	if(round($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta)-$abono1)==NULL){ 
	?>
    <label>
    <input name="imprimir" type="image" class="style27" id="imprimir" value="Imprimir" src="/sima/imagenes/btns/printbutton.png"/>
    </label>
	<?php } else {?>
    <input name="Submit" type="image" class="style27" value="Aplicar Pagos" src="/sima/imagenes/btns/aplicapay.png"  onclick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $_GET['almacenSolicitante']; ?>&almacenFuente=<?php echo $almacen; ?>&seguro=<?php echo $seguroT; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo $_GET['tipoVenta'];?>')"/>
    <input name="keyClientesInternos" type="hidden" class="style7" id="keyClientesInternos" value="<?php echo $_GET['nT'];?>" />
	<?php } 
	}
	?>
  </p>


</form>

<p align="center">&nbsp;</p>

</body>
</html>
<?php 
}

}
?>

