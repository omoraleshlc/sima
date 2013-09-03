<?PHP include("/configuracion/ingresoshlcmenu/menuingresoshlc.php"); valida('CAJA','LOPI',$usuario,$basedatos);?>
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
//***********************Cierro validaciones de almacén************************

//*********************************CREAR FUNCIONES******************************************
function saca_por($can,$por){
$can=($can/100)*$por;
$tPor=$can+$cant;
return $can;
}
function saca_pormas($can,$por){
$can=($can/100)*$por;
$tPor=$can-$cant;
return $can;
}
function saca_iva($can,$por){
$cant=$can;
$can=($can/100)*$por;
$can+=$cant;
return $can;
}
//****************************Cierro funciones************************************
//********************************VERIFICA EL ULTIMO MOVIMIENTO*******************
//********traigo centro de costos y libro*********
//$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' ";
$cmdstr1 = "select * from MATEO.CONT_FOLIO where LOGIN = '".$usuario."' 
AND ID_EJERCICIO='".$ID_EJERCICIOM."'
AND
ID_LIBRO='".$ID_LIBROM."'
";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 

for ($i = 0; $i < $nrows1; $i++ ){
$ID_LIBRO = $results1['ID_LIBRO'][$i];
$ID_EJERCICIO = $results1['ID_EJERCICIO'][$i];
} 
//***********************************************************************************

//*****************************Verificando caja abierta**************************
$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($poliza=$myrowC['numeroPoliza']){ //*******************Comienzo la validación*****************
//********************Llenado de datos
$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_POST['numeroE']."' and status='activa'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

//***************aplicar pago**********************
if($_POST['aplicarPago']){
$q = "UPDATE clientesInternos set 
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
numPoliza='".$poliza."'
WHERE numeroE = '".$_POST['numeroE']."'";
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
<body>
<h1 align="center">Pacientes Internos <?php 

echo $ALMACEN=$myrow3['almacen'];
 ?></h1>
<form id="form1" name="form1" method="post" action="" />

  <table width="658" border="0" align="center" class="style12">
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th colspan="2" bgcolor="#660066" class="style14" scope="col">Captura a Cuenta Paciente Particular </th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th class="style12" scope="col"><div align="left">N&uacute;mero: </div></th>
      <th class="style12" scope="col"><label>
        <div align="left">
          <input name="numeroE" type="text" class="style12" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
        Cuenta: 
        <input name="nCuenta" type="text" class="Estilo24" id="nCuenta" value="<?php echo $nCuenta=$myrow3['nCuenta']; ?>" size="60" readonly=""/>
        </div>
        </label></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th class="style12" scope="col"><div align="left"><strong>M&eacute;dico: </strong></div></th>
      <th class="style12" scope="col"><div align="left">
        <label>
        <input name="medico" type="text" class="style12" id="medico" value="<?php echo $medico=$myrow3['medico']; ?>" readonly=""/>
        </label>
        <label> </label>
        <span class="Estilo24">
        <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
        <input name="textfield2" type="text" class="Estilo24" size="60" value="<?php echo $dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?>" readonly=""/>
        </span></div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th width="136" class="style12" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="488" class="style12" scope="col"><div align="left"><strong>
        <label>        </label>
      </strong>
          <input name="paciente" type="text" class="style12" id="paciente" value="<?php echo $myrow3['paciente']; ?>" size="60" readonly=""/>
      </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Seguro: </td>
      <td class="style12"><label>
        <input name="seguro" type="text" class="style12" id="seguro" value="<?php echo $traeSeguro=$myrow3['seguro']; ?>" readonly=""/>
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
      <td class="style12">Autoriza:</td>
      <td class="style12"><input name="autoriza" type="text" class="style12" id="autoriza" value="<?php echo $myrow3['autoriza']; ?>" size="60" readonly=""/></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">N&deg; Credencial: </td>
    <td class="style12"><input name="credencial" type="text" class="style12" id="credencial" 
	value="<?php echo $myrow3['credencial']; ?>" size="60" readonly=""/>    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Fecha: </td>
      <td class="style12">      <input name="fecha" type="text" class="style12" id="fecha" value="<?php 
	  echo $myrow3['fecha'];
	 	   ?>" size="9" maxlength="9" readonly=""/>
      formato: A&ntilde;o-Mes-Dia </td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Hora:</td>
      <td class="style12"><input name="hora" type="text" class="style12" id="hora" value="<?php 
	  echo $myrow3['hora'];
	 	   ?>" size="9" maxlength="9" readonly=""/> 
        formato: 00:00 am </td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td colspan="2" bgcolor="#660066" class="style12">&nbsp;</td>
    </tr>
    <tr>
      <td height="33" colspan="3"><label>
        <div align="center">
          <input name="aplicarPago" type="submit" class="style12" id="aplicarPago" value="Aplicar Pago" />
          <label></label>
        </div>
      </label></td>
    </tr>
</table>
  <p>&nbsp;</p>
  <table width="845" border="0" align="center">
    <tr>
      <th width="41" height="16" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Cantidad</span></th>
      <th width="81" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">C&oacute;digo Proc. </span></th>
      <th width="503" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Descripci&oacute;n</span><span class="style12 ">%</span></th>
      <th width="61" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">UM</span></th>
      <th width="58" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Costo</span> U. </th>
      <th width="61" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Costo T. </span></th>
    </tr>
    <tr>
      <?php //traigo agregados
$sSQL81= "
SELECT 
  *
FROM
cargosCuentaPaciente 
 WHERE numeroE = '".$nPaciente."' and nCuenta='".$nCuenta."' group by codProcedimiento
";
$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a = $a + 1;
$art = $myrow81['codProcedimiento'];
$proc=$myrow81['codProcedimiento'];
$sSQL91= "
	SELECT 
count(*) as cantidades
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' and nCuenta='".$nCuenta."' and codProcedimiento='".$art."'";
$result91=mysql_db_query($basedatos,$sSQL91);
$myrow91 = mysql_fetch_array($result91);
//traigo descuento

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
$sSQL101= "
SELECT 
  *
FROM
 convenios
WHERE 
numCliente = '".$traeSeguro."'
AND
articulo = '".$proc."'
";
//$result101=mysql_db_query($basedatos,$sSQL101);
//$myrow101 = mysql_fetch_array($result101);

?>
      <td height="23" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <label></label>
        <span class="Estilo24">
        <?php 
		
		  echo $cantidades=$myrow91['cantidades'];
		
		  ?>
      </span></span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php 
		
		  if($myrow81['codProcedimiento']){
		  echo $myrow81['codProcedimiento'];
		  }
		  ?>
      </span></span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php  if($myrow141['descripcion']){
		echo $myrow141['descripcion'];
		}
		?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php  if($myrow141['um']){
		echo $myrow141['um'];
		}
		?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php 

	echo "$ ".number_format($myrow81['costo'],2);
	
	?>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php 
	$myrow81['costo']*=$cantidades;
	echo "$ ".number_format($myrow81['costo'],2);
	$costoProcedimientos[0]+=$myrow81['costo'];
	?>
      </span></span></td>
    </tr>
    <?php }?>
</table>
  <p>&nbsp;  </p>
  <h1 align="center">
    <input name="paso_bandera1" type="hidden" id="paso_bandera1" value="<?php echo $bandera; ?>" />
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>">
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" /></h1>
  <table width="220" border="1" align="center" cellpadding="1" cellspacing="0" class="Estilo24">
  <tr bgcolor="#990033" align="center">
    <td><b><font color="#FFFFFF">Totales</font></b></td>
  </tr>
  <tr bgcolor="#990033">
    <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr bgcolor="#FFFFFF">
        <td width="41%" class="Estilo24">SubTotal: </td>
        <td width="59%" class="Estilo24"><?php $TOTAL= $costoProcedimientos[0]+$costoMateriales[0];
echo "$".number_format($TOTAL,2);
	?></td>
      </tr>
<?php //****verificando convenio********
$seguro= $myrow3['seguro'];	  

$fechaFinal=$myrow6['fechaFinal'];



$Pcliente1=($myrow19['porcentajeCliente']/100)*$TOTAL;
$Pseguro1=($myrow19['porcentajeSeguro']/100)*$TOTAL;
?>
      <tr bgcolor="#FFFFFF">
        <td class="Estilo24">Descuento: </td>
        <td class="Estilo24"><?php 
$sSQL18= "SELECT *
FROM
 descuentos
WHERE 
numeroE='".$nCliente."' AND
nCuenta ='".$nCuenta."'
 ";
$result18=mysql_db_query($basedatos,$sSQL18);
$myrow18= mysql_fetch_array($result18);
echo mysql_error();
		if($myrow18['signo']=='-'){
		$TOTAL1=($myrow18['descuento']/100)*$TOTAL;
		$TOTAL-=$TOTAL1;
		} else if($myrow18['signo']=='+'){
		$TOTAL1=($myrow18['descuento']/100)*$TOTAL;
		$TOTAL+=$TOTAL1;
		}
		if($myrow18['signo'] or $myrow18['descuento']){
		echo $myrow18['signo']." ".$myrow18['descuento']."%";
		} else {
		echo "Sin Desc";
		}
		?>
          <input name="descuento" type="hidden" id="descuento" /></td>
      </tr>
	  
	  
      <tr bgcolor="#FFFFFF">
        <td class="Estilo24">Seguro: <?php echo $myrow19['porcentajeSeguro']."%";?></td>
        <td class="Estilo24"><?php 
		if($myrow19['porcentajeSeguro']){
		echo "$ ".number_format($tSeguro=$TOTAL-$Pseguro1,2);
		} else {
		echo "N/A";
		}
		?>
          <input name="cargos" type="hidden" id="cargos" value="<?php echo $tSeguro; ?>" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td class="Estilo24">Cliente: <?php echo $myrow19['porcentajeCliente']."%";?></td>
        <td class="Estilo24"><?php
		
		echo "$ ".number_format($tCliente=$TOTAL-$Pcliente1,2);
		?>
          <input name="abonos" type="hidden" id="abonos"  value="<?php echo $tCliente; ?>"/></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td class="Estilo24">IVA:</td>
        <td class="Estilo24"><?php 
		$sSQL91= "
	SELECT 
sum(iva) as totalIva
FROM
cargosCuentaPaciente
WHERE numeroE = '".$nPaciente."' and nCuenta='".$nCuenta."' ";
$result91=mysql_db_query($basedatos,$sSQL91);
$myrow91 = mysql_fetch_array($result91);
		echo "$ ".number_format($myrow91['totalIva'],2);
		
		?>&nbsp;</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td class="Estilo24">Total a Pagar: </td>
        <td class="Estilo24"><?php echo "$".number_format($TOTAL+$myrow91['totalIva'],2);?>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>
  <?php } else {
echo '<script type="text/vbscript">
msgbox "LA CAJA ESTA CERRADA!"
</script>';
}
?>
</p>
  </form>
  
  
<form action="imprimeCaja.php" method="post" name="form2" target="_blank" class="style12" id="form2"  />
  <div align="center">
    <input name="Submit" type="submit" class="Estilo24" value="Imprimir" />
    <input name="numeroE" type="hidden" id="numeroE" value="<?php echo $nCliente; ?>" />
	<input name="nCuenta" type="hidden" id="numeroE" value="<?php echo $nCuenta; ?>" />
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <label>
  </label>
  </form>
<p>&nbsp;</p>
<p align="center">&nbsp;</p>
</body>
</html>
