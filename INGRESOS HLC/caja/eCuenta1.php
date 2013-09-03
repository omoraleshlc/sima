<?PHP include("/configuracion/ingresoshlcmenu/menuingresoshlc.php"); ?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
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




<?php //************************ACTUALIZO PRECIOS**********************
$ID_LIBROM='20';
//***********************************************************************



//***********************************Bajar variables
$hoy = date("Y-m-d");
$hora = date("H:i a");
 $nPaciente=$_POST['numeroE'];

if($_POST['almacen']){
$al = $_POST['almacen'];
} else if($_POST['almacen1']){
$al = $_POST['almacen1'];
} else if($_POST['almacen2']){
 $al = $_POST['almacen2'];
} else if($_POST['almacen3']){
$al = $_POST['almacen3'];
} 



//*****************************Verificando caja abierta**************************
//********************Llenado de datos
$sSQL3= "Select * From clientesAmbulatorios WHERE numeroE = '".$_POST['numeroE']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

//***************aplicar pago**********************
if($_POST['aplicarPago']){
$q = "UPDATE clientesAmbulatorios set 
status='pagado',
abonos='".$_POST['abonos']."',
cargos='".$_POST['cargos']."',
poliza='".$poliza."',
ID_EJERCICIO='".$ID_EJERCICIOM."',
ID_LIBRO='".$ID_LIBROM."'

WHERE numeroE = '".$_POST['numeroE']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();

$q1 = "UPDATE cargosCuentaPaciente set 
status='pagado',
numPoliza='".$poliza."'
WHERE numeroE = '".$_POST['numeroE']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$q1 = "UPDATE descuentos set 
status='usado'
WHERE numeroE = '".$_POST['numeroE']."' and status='activo'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//*************SACO EL NUMERO DE MOVIMIENTO y lo actualizo*************************
$sSQL2= "Select max(consecutivo) as tope From aperturaCaja ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$numMovto=$myrow2['tope']+'1';
$q = "UPDATE aperturaCaja set 
consecutivo = '".$numMovto."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE EFECTUO EL PAGO SATISFACTORIAMENTE!"
</script>';
}
//*************************************************
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
-->
</style>


</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style21 {color: #FF0000}
-->
</style>
<BODY >

<h1 align="center">Departamento 
<?php 

echo $ALMACEN=$myrow3['almacen'];
 ?></h1>
<form id="form1" name="form1" method="post" action="" />

  <table width="388" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="style12">
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th colspan="2" bgcolor="#660066" class="style14" scope="col">Captura a Cuenta Paciente Particular </th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th class="style12" scope="col"><div align="left">N&uacute;mero de Transacci&oacute;n: </div></th>
      <th class="style12" scope="col"><label>
        <div align="left"><?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>
          <input name="numeroE" type="hidden" class="style12" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
        </div>
      </label></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th class="style12" scope="col"><div align="left"><strong>M&eacute;dico: </strong></div></th>
      <th class="style12" scope="col"><div align="left">
        <label>
       <?php echo $medico=$myrow3['medico']; ?>        </label>
        <label> </label>
        <span class="Estilo24">
        <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
      <?php echo $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?>        </span></div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th width="136" class="style12" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="488" class="style12" scope="col"><div align="left"><strong>
        <label>        </label>
      </strong>
   <?php echo $myrow3['paciente']; ?>
      </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Seguro: </td>
      <td class="style12"><label>
     <?php echo $traeSeguro=$myrow3['seguro']; ?>
        <?php
$sSQL212= "SELECT *
FROM
clientes
WHERE 
numCliente='".$traeSeguro."'
 ";
 $result212=mysql_db_query($basedatos,$sSQL212);
$myrow212 = mysql_fetch_array($result212);


?>
        <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">N&deg; Credencial: </td>
    <td class="style12"><?php echo $myrow3['credencial']; ?>    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td height="2" colspan="3"><label></label></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <table width="739" border="0" align="center">
    <tr>
      <th width="41" height="16" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Cantidad</span></th>
      <th width="542" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Descripci&oacute;n</span></th>
      <th width="46" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">UM</span></th>
      <th width="42" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Costo U. </span></th>
      <th width="46" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Total</span></th>
    </tr>
    <tr>
      <?php //traigo agregados
 $sSQL81= "
SELECT 
  *
FROM
cargosCuentaPaciente 
 WHERE numeroE = '".$nCliente."'
 
 and status='pendiente'
 group by codProcedimiento 
 
";

if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a = $a + 1;
$art = $myrow81['codProcedimiento'];
$proc=$myrow81['codProcedimiento'];



$sSQL141= "
	SELECT 
  *
FROM
articulos
WHERE 
codigo = '".$proc."'
";
$result141=mysql_db_query($basedatos,$sSQL141);
$myrow141 = mysql_fetch_array($result141);
$sSQL151= "
	SELECT 
  *
FROM
 medicosPrecios
WHERE 
codMedico = '".$medico."' AND codProcedimiento = '".$proc."'
";
$result151=mysql_db_query($basedatos,$sSQL151);
$myrow151 = mysql_fetch_array($result151);
echo mysql_error();
//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sSQL14= "
SELECT 
sum(cantidad) as cantidad2
FROM
cargosCuentaPaciente
WHERE 
codProcedimiento = '".$proc."' and  numeroE = '".$nCliente."'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
?>
      <td height="23" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php  if($myrow14['cantidad2']=='1'){
		echo $cantidad=$myrow81['cantidad'];
		} else {
		echo $cantidad=$myrow14['cantidad2'];		
		}
		?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php  if($myrow141['descripcion']){
		echo $myrow141['descripcion'];
		}
		?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php  if($myrow141['um']){
		echo $myrow141['um'];
		}
		?>
      </span></span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php 
	
     echo "$ ".number_format($myrow81['costo'],2);
	 //$costoProcedimientos[0]+=$myrow81['costo'];
	$costoProcedimientos[0]=$cantidad*$myrow81['costo'];

	?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php 
	
	echo "$".number_format($costoProcedimientos[0],2);
	$TOTAL+=$costoProcedimientos[0];
	?>
      </span></span></td>
    </tr>
    <?php }}?>
</table>
  <p>&nbsp;  </p>
  <h1 align="center">
    <input name="paso_bandera1" type="hidden" id="paso_bandera1" value="<?php echo $bandera; ?>" />
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>">
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" /></h1>
	
	
	
	
	
	
	
	
	
	
<?php 
//echo "$".number_format($TOTAL,2);
	?>
	  <?php 
//descuentos pacientes internos
$sSQL18= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$nCliente."' AND nCuenta ='".$nCuenta."' and nCuenta <>null
and 
status='activo' and
fechaFinal <= '".$fecha1."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18= mysql_fetch_array($result18);
echo mysql_error();
//descuentos pacientes ambulatorios
$sSQL19= "SELECT *
FROM
descuentos
WHERE 
numeroE='".$nCliente."' 
and status='activo' and
fechaFinal <= '".$fecha1."'
 ";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19= mysql_fetch_array($result19);
//******************
if($myrow19['cantidad']){

$descuento=$myrow19['cantidad'];
} else if($myrow19['descuento']){

		$TOTAL1=($myrow19['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}
		
		
if($myrow18['cantidad']){
$descuento=$myrow18['cantidad'];
} else if($myrow18['descuento']) { 
		$TOTAL1=($myrow18['descuento']/100)*$TOTAL;
		$descuento=$TOTAL1-$descuento;
		}	
		
	$TOTAL-=$descuento;
		?>
      	<?php 
		if($descuento){ ?>
	
		
	<?php
//	echo "$".number_format($descuento,2); 
		 
		?>		
	  <?php } ?>
  
          <?php 
		  $sSQL13= "
	SELECT 
  sum(iva) as sumaiva
FROM
cargosCuentaPaciente
WHERE 
numeroE = '".$nCliente."'
 
 and status='pendiente'
";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
		  $iva=$myrow13['sumaiva'];
		//echo "$".number_format($iva,2);
?>
















<p align="center">

  <?php if($_POST['aplicarPago']){
echo "Se aplicó el pago satisfactoriamente";
}
?>
</p>
<div align="center">
  <p><span class="Estilo24"><a href="javascript:ventanaSecundaria2(
		'ventanaAplicaPago.php?campoDespliega=<?php echo "nomSeguro"; ?>&amp;forma=<?php echo "F"; ?>&amp;campoSeguro=<?php echo "seguro"; ?>&amp;numeroE=<?php echo $nCliente; ?>&amp;TOTAL=<?php echo $TOTAL; ?>&amp;iva=<?php echo $iva; ?>&amp;descuento=<?php echo $descuento; ?>')">Vista de Pago </a>  </span></p>
  <p><a href="javascript:ventanaSecundaria4(
		'imprimeCaja1.php?descripcion=<?php echo $descripcion; ?>&amp;forma=<?php echo "form1"; ?>&amp;numeroE=<?php echo $nCliente; ?>')" class="Estilo24">Vista de Impresi&oacute;n </a></p>
</div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <label>
  </label>

<p>&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
