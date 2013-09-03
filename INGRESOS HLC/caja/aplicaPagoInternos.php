<?php include("/configuracion/conf.php"); ?>
<?php require("conexion.php");  ?>
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

<?php
$modulo = "listaOrdenes.caja";
$checaModuloScript= "Select * From usuariosModulos WHERE usuario = '".$usuario."' AND modulo = '".$modulo."'";
$resScript=mysql_db_query($basedatos,$checaModuloScript);
$resulScripModulo = mysql_fetch_array($resScript);
echo mysql_error();
$modulo1=$resulScripModulo['modulo'];
if(trim($modulo1)==$modulo){
?>

<?php

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


$sSQLC= "Select * From aperturaCaja ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);

if($myrowC['numeroPoliza']){

$hoy = date("m/d/Y");
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

if($_POST['aplicar'] AND $_POST['numeroE']){
$pagado = 'P';
 $q = "UPDATE cargosAmbulatorios set 
status='".$pagado."',
usuario='".$usuario."'
WHERE numeroE = '".$_POST['numeroE']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
pago_efectuado();
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=listaOrdenes.php">';
exit;
}  



if($_POST['actualizar'] AND $_POST['numeroE']){
$sSQL1= "Select * From clientesAmbulatorios WHERE numeroE = '".$_POST['numeroE']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($_POST['numeroE'] AND 
$_POST['medico']     AND
$_POST['paciente']   AND
$_POST['seguro']     AND 
$_POST['autoriza']   AND
$_POST['credencial']){


if($_POST['numeroE']!=$myrow1['numeroE']){
 $agrega = "INSERT INTO movimientos ( numeroE,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,cita,usuario,servicioMedico,papanicolau,materiales,almacen
) values (
'".$_POST['numeroE']."',
'".$_POST['medico']."',
'".$_POST['paciente']."',
'".$_POST['seguro']."','".$_POST['autoriza']."',
'".$_POST['credencial']."','".$_POST['fecha']."',
'".$_POST['hora']."','".$_POST['cita']."','".$usuario."',
'".$_POST['servicioMedico']."','".$_POST['papanicolau']."',
'".$_POST['materiales']."','".$al."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
paciente_agregado();
} else {
$q = "UPDATE cargosAmbulatorios set 
medico='".$_POST['medico']."',
paciente='".$_POST['paciente']."',
seguro='".$_POST['seguro']."',
autoriza='".$_POST['autoriza']."',
credencial='".$_POST['credencial']."',
fecha='".$_POST['fecha']."',
hora='".$_POST['hora']."',
cita='".$_POST['cita']."',
usuario='".$usuario."',
servicioMedico='".$_POST['servicioMedico']."',
papanicolau='".$_POST['papanicolau']."',
materiales='".$_POST['materiales']."'
WHERE numeroE = '".$_POST['numeroE']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
paciente_actualizado();
}
} else {
campos_vacios();
}
$actualizar="1";
}

if($_POST['borrar'] AND $_POST['numeroE']){
$borrame = "DELETE FROM cargosAmbulatorios WHERE numeroE ='".$_POST['numeroE']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
paciente_eliminado();
}

$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_POST['numeroE']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
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
<form name="form1" method="post" action="">
  <h1 align="center">&nbsp;</h1>
  <table width="554" border="1" align="center" class="style12">
    <tr>
      <th width="12" class="style12" scope="col">+</th>
      <th colspan="2" bgcolor="#660066" class="style14" scope="col">Estado de Cuenta Pacientes Internos </th>
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
      </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <th width="228" class="style12" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="292" class="style12" scope="col"><div align="left"><strong>
          <label> </label>
          </strong>
<?php
$sSQL2= "SELECT *
FROM
pacientes
WHERE 
numCliente = '".$nCliente."'

 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$nombrePaciente = $myrow2['nombre1']." ".$myrow2['nombre2']
	  ." ".$myrow2['apellido1']." ".$myrow2['apellido2']." ".$myrow2['apellido3'];
?>
<input name="paciente" type="text" class="style12" id="paciente" value="<?php echo $nombrePaciente; ?>" size="60" readonly=""/>
      </div></th>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Seguro: </td>
      <td class="style12"><label>
        <input name="seguro" type="text" class="style12" id="seguro" value="<?php echo $traeSeguro=$myrow3['seguro']; ?>" readonly=""/>
        <input name="seguro" type="hidden" id="seguro" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Autoriza:</td>
      <td class="style12"><input name="autoriza" type="text" class="style12" id="autoriza" value="<?php echo $myrow3['autoriza']; ?>" size="60" readonly=""/></td>
    </tr>
    <tr>
      <th width="12" class="style12" scope="col">&nbsp;</th>
      <td class="style12">Fecha: </td>
      <td class="style12"><input name="fecha" type="text" class="style12" id="fecha" value="<?php 
	  echo $myrow3['fecha'];
	 	   ?>" size="9" maxlength="9" readonly=""/>
        formato: 00/00/0000 </td>
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
            <input name="aplicar" type="submit" class="style12" id="aplicar" value="Verificar/Imprimir" />
            <label></label>
          </div>
        </label></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="779" border="1" align="center">
    <tr>
      <th height="16" colspan="7" bgcolor="#660066" scope="col"><div align="center" class="style14">PROCEDIMIENTOS</div></th>
    </tr>
    <tr>
      <th width="96" height="16" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">C&oacute;digo Proc. </span></th>
      <th width="350" bgcolor="#660066" class="style14" scope="col"><span class="style12 ">Descripci&oacute;n</span><span class="style12 ">%</span></th>
      <th width="64" bgcolor="#660066" class="style14" scope="col"><span class="Estilo24">Costo</span></th>
      <th width="59" bgcolor="#660066" scope="col"><span class="style11 style13">%/C</span></th>
      <th width="51" bgcolor="#660066" scope="col"><span class="Estilo24 style13">T-Seguro</span></th>
      <th width="50" bgcolor="#660066" scope="col"><span class="Estilo24 style13">IVA</span></th>
      <th width="63" bgcolor="#660066" scope="col"><span class="Estilo24 style13">T-Cliente</span></th>
    </tr>
    <tr>
      <?php //traigo agregados
$sSQL81= "
SELECT 
  *
FROM
cargosAmbulatoriosP
 WHERE numeroE = '".$nPaciente."'
";
$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a = $a + 1;
$art = $myrow81['codArticulo'];
$proc=$myrow81['codProcedimiento'];
$sSQL91= "
	SELECT 
  *
FROM
 precioArticulos
WHERE codigo = '".$art."'";
$result91=mysql_db_query($basedatos,$sSQL91);
$myrow91 = mysql_fetch_array($result91);
//traigo descuento

$sSQL141= "
	SELECT 
  *
FROM
 procedimientos
WHERE 
codigoProcedimiento = '".$proc."'
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
$result101=mysql_db_query($basedatos,$sSQL101);
$myrow101 = mysql_fetch_array($result101);

?>
      <td height="23" bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <label>
        <?php 
		
		  if($myrow81['codProcedimiento']){
		  echo $myrow81['codProcedimiento'];
		  }
		  ?>
        </label>
        <input type="hidden" name="codigoProcedimiento[]"  value="<?php echo $myrow81['codProcedimiento']; ?>"/>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <?php  if($myrow141['descripcionProcedimiento']){
		echo $myrow141['descripcionProcedimiento'];
		}
		?>
        </span><span class="style7">
        <input name = "paso_bandera" type="hidden" value="<?php echo $a; ?>" />
        <input name="descripcionProcedimiento[]" type="hidden" id="descripcionProcedimiento[]" 
value="<?php echo $myrow141['descripcionProcedimiento']; ?>" />
        <input name="TASAPROCEDIMIENTOS[]" type="hidden" id="TASAPROCEDIMIENTOS" value="<?php echo $myrow141['tasa']; ?>">
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="Estilo24"><span class="style7">
        <?php 
	$costo101=$myrow81['costo'];
	$resSub101=$costo101;
	echo "$ ".number_format($myrow81['costo'],2);
	?>
<input name="costoProcedimiento[]" type="hidden" id="costoProcedimiento[]" value="<?php echo $myrow151['costo']; ?>" />
      </span></span></td>

      <td bgcolor="#006600" class="style12 style13"><span class="style11">
        <?php 
//que porcentaje o cantidad les corresponde
//checo fecha

$fechaInicio = $myrow101['fechaInicial'];
$fechaFinal = $myrow101['fechaFinal'];
$hoy = str_replace('/','',$fecha1);
$fechaInicio1 = str_replace('/','',$fechaInicio);
$fechaFinal1 = str_replace('/','',$fechaFinal);
$descuentoProcedimientos=$myrow101['descuento'];	  
if(trim($fechaInicio1) >=$hoy or $hoy<= trim($fechaFinal1)){

echo $myrow101['signo']."".$descuentoProcedimientos; 	  
} else {
echo "S/seg";
}
//cierro porcentaje o cantidad
	  ?>
      </span></td>
      <td bgcolor="#006600" class="style12 style13"><span class="style13">
        <?php 
//operacion matematica 	
//checo si la fecha coincide
	if($myrow101['signo']){
				$banderaSeguro1="banderaSeguro1";
	}
//seguros	
if($myrow101['descuento']){	//trae descuento ?
if(trim($fechaInicio1) >=$hoy or $hoy<= trim($fechaFinal1)){ //las fechas coinciden? 

				
			
					if($myrow101['cp']=="porcentaje"){ //abre cantidad
						if($myrow101['signo']=="+"){
				
						$reporteSeguro=saca_pormas($costo101,$descuentoProcedimientos);
						}
						if($myrow101['signo']=="-"){
						$reporteSeguro=saca_por($costo101,$descuentoProcedimientos);
	  					}
	  			    } //cierra porcentaje
				
				
				
				
				
				if($myrow101['cp']=="cantidad"){ //abre cantidad
						if($myrow101['signo']=="+"){
						$reporteSeguro=$descuentoProcedimientos;
						}
						if($myrow101['signo']=="-"){
						
						$reporteSeguro=$costo101-$descuentoProcedimientos;
	  					}
				
				} //cierro cantidad


	
} else {
$reporteSeguro=$costo101;

} //cierro validacion de fecha

} else {
$reporteSeguro=$costo101;

}  //cierro validacion si trae o no descuento
echo "$".number_format($reporteSeguro,2);

//cierro seguros

?>
        <span class="style11">
        <input type="hidden" name="banderaSeguro1[]" value="<?php echo $reporteSeguro; ?>" />
      </span></span></td>
      <td class="style12"><span class="Estilo24">
        <?php 
	  //************* APLICO IVA ********************
      
	  if($myrow141['tasa']>0 and $myrow141['tasa']!=null){
	 
        if($descuentoProcedimientos){
	       if(trim($fechaInicio1) >=$hoy or $hoy<= trim($fechaFinal1)){ //trae seguro? si, entonces ->valido fechas
		   
	  			if($myrow101['cp']=="cantidad"){ //abre cantidad
				
					if($myrow101['signo']=="+"){
					$reporteTasa=$costo101-$descuentoProcedimientos;
					$reporteTasa=saca_por($reporteTasa,$myrow141['tasa']);
					}
					if($myrow101['signo']=="-"){
					
					$descuentoProcedimientos=saca_por($descuentoProcedimientos,$myrow141['tasa']);
					$reporteTasa=$descuentoProcedimientos;
					
					//$reporteTasa=saca_por($descuentoProcedimientos,$myrow141['tasa']);
	  				}
	  			} //cierra cantidad 
				
				
				
				if($myrow101['cp']=="porcentaje"){ //abre porcentaje
				
					if($myrow101['signo']=="+"){
					$reporteTasa=saca_por($reporteSeguro,$myrow141['tasa']);
					} 
					if($myrow101['signo']=="-"){
					$reporteTasa=$costo101-$reporteSeguro;
					$reporteTasa=saca_por($reporteTasa,$myrow141['tasa']);
	  				}
	  			} //cierra porcentaje
			
			} else { //validacion de fechas
			$reporteTasa=saca_por($reporteSeguro,$myrow141['tasa']); //trae seguro pero esta vencido
			} //cierro validacion de fechas	
					
			} else {
	  		
			$reporteTasa=saca_por($reporteSeguro,$myrow141['tasa']); //no traigo seguro pero sin iva		  		
  			}
		
		} else { //no traigo iva
	   
	  	$reporteTasa=0;		
		} //cierra iva
	  //***************CIERRO IVA*********************
	  echo "$".number_format($reporteTasa,2);
	  ?>
        <input name="ivaProcedimientos[]" type="hidden" id="ivaProcedimientos[]" value="<?php echo $reporteTasa; ?>" />
      </span></td>
      <td bgcolor="#000066" class="style12 style13"><span class="style13">
        <?php 
//********************** SACO LO QUE PAGA EL CLIENTE ***************************	  
 if($myrow101['descuento']){
	  if(trim($fechaInicio1) >=$hoy or $hoy<= trim($fechaFinal1)){ //valido fechas
	  		if($myrow101['cp']=="cantidad"){	  
	  				if($myrow101['signo']=="+"){
	  				//$reporteCliente=$reporteSeguro+$reporteTasa;
	  				$reporteCliente=($costo101-$reporteSeguro)+$reporteTasa;
					}
					if($myrow101['signo']=="-"){
					
	    			$reporteCliente=$myrow101['descuento']+$reporteTasa;
					}
	    	}
	  
	  
	 
	  		if($myrow101['cp']=="porcentaje"){
	  				if($myrow101['signo']=="+"){
					
					$reporteCliente=$costo101+$reporteTasa;
	  				}
	  				if($myrow101['signo']=="-"){
	  				$reporteCliente=($costo101-$reporteSeguro)+$reporteTasa;
					}
			
			}

} else {
$reporteCliente=$reporteSeguro+$reporteTasa;
} //cierro validacion de fechas
} else {
$reporteCliente=$reporteSeguro+$reporteTasa;
} //cierro validaci&oacute;n de seguros
	  
	  echo "$".number_format($reporteCliente,2);
	  $tReporteCliente[0]+=$reporteCliente;
//************************************ CIERRO VALIDACION DEL CLIENTE ***************************	  
	  ?>
        <input name="reporteCliente[]" type="hidden" id="reporteCliente[]" value="<?php echo $reporteCliente; ?>" />
      </span></td>
    </tr>
    <?php }?>
  </table>
  <p>&nbsp; </p>
  <table width="782" border="1" align="center">
    <tr>
      <th width="49" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Cantidad</span></th>
      <th width="443" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Art&iacute;culos</span></th>
      <th width="63" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">Costo </span></th>
      <th width="64" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">SubTotal </span></th>
      <th width="40" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">%/C</span></th>
      <th width="55" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">T-Seguro</span></th>
      <th width="31" bgcolor="#660066" class="style12 style13" scope="col">IVA</th>
      <th width="40" bgcolor="#660066" class="style12" scope="col"><span class="style11 style13">T-Cliente</span></th>
    </tr>
    <tr>
      <?php 
$sSQL= "SELECT *
  FROM
cargosAmbulatoriosM
WHERE numeroE ='".$_POST['numeroE']."'
 ";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

 $bandera = $bandera+'1';
$codigo = $myrow['codArticulo'];
$proc=$myrow['codProcedimiento'];
$sSQL1= "SELECT *
FROM
  `precioArticulos`

WHERE `codigo` ='".$codigo."'
 ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}


$sql5= "
SELECT *
FROM
  `convenios`  
WHERE
numCliente =  '".$traeSeguro."'
AND articulo ='".$codigo."'

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);


//traigo articulos
 $sSQL2= "SELECT *
FROM
  `articulos`
WHERE `codigo` ='".$codigo."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$grupoPrecios = $myrow2['gpoProducto'];
//traigo por grupo de precios
 
// traigo todos iguales numero de poliza
$sSQL3= "SELECT *
FROM
  `precioArticulos`

WHERE `codigo` ='".$codigo."'
 ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

//ME TRaigo la Tasa 
$sSQL13= "SELECT *
FROM
 gpoProductos,TASA
WHERE gpoProductos.codigoGP ='".$grupoPrecios."'
AND
gpoProductos.tasaGP=TASA.codTasa
 ";
$result13=mysql_db_query($basedatos,$sSQL13);
$myrow13 = mysql_fetch_array($result13);
echo mysql_error();

$sSQL16= "SELECT *
FROM
 procedimientos
WHERE codigoProcedimiento ='".$proc."'
 ";
$result16=mysql_db_query($basedatos,$sSQL16);
$myrow16= mysql_fetch_array($result16);
echo mysql_error();
$sSQL17= "SELECT *
FROM
 medicosPrecios
WHERE 
codMedico='".$medico."' AND
codProcedimiento ='".$proc."'
 ";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17= mysql_fetch_array($result17);
echo mysql_error();

?>
      <td bgcolor="<?php echo $color; ?>" class="style12"><span class="style7">
        <?php 
	  echo $q = $myrow['cantidad'];?>
        <span class="Estilo24">
        <input name="cantidad[]" type="hidden" id="cantidad[]" value="<?php echo $myrow['cantidad']; ?>" />
        </span></span></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><span class="style7">
        <?php 
	  if($myrow2['descripcion']){
	  echo $myrow2['descripcion'];
	  }
	  ?>
        <input name="descripcionArticulos[]" type="hidden" id="descripcionArticulos[]" value="<?php  echo $myrow2['descripcion'];?>" />
        <?php //echo $myrow['codArticulo']; ?>
        <input name="codigoArticulo[]" type="hidden" id="codigoArticulo" value="<?php echo $myrow['codArticulo']; ?>"/>
        <?php //echo "tasaarticulos".$myrow13['tasaGP']; ?>
        <input name="TASAARTICULOS[]" type="hidden" id="TASAARTICULOS[]" value="<?php echo $myrow13['tasaGP']; ?>" />
      </span></td>
      <td bgcolor="<?php echo $color; ?>" class="style12"><span class="style7">
        <?php 
	  if($myrow3['precio']){
	  echo "$".number_format($myrow1['precio'],2);
	  } else if($myrow3['pmax']){
	   echo "$".number_format($myrow3['pmax']);
	  }else if($myrow17['costo']){ 
	   echo "$".number_format($myrow17['costo'],2);
	   } else {
	   echo "0.00";
	   }
	  ?>
        <input name="pUnitario[]" type="hidden" id="pUnitario[]" value="<?php  echo $rtUnitario; ?>" />
      </span></td>
      <td bgcolor="<?php echo $color; ?>" class="style12">
	  <?php 
	  $q*=$myrow3['precio']; 
	  echo "$".number_format($q,2);
	  
	  ?></td>
      <td bgcolor="#006600" class="style11"><?php 
//que porcentaje o cantidad les corresponde
//checo fecha

$fechaInicio2 = $myrow5['fechaInicial'];
$fechaFinal2 = $myrow5['fechaFinal'];
$hoy = str_replace('/','',$fecha1);
$fechaInicio12 = str_replace('/','',$fechaInicio2);
$fechaFinal12 = str_replace('/','',$fechaFinal2);
$descuentoMateriales=$myrow5['descuento'];

if(trim($hoy >=$fechaInicio12) or $hoy<= trim($fechaFinal12)){
echo $myrow5['signo']."".$descuentoMateriales; 	  
} else {
echo "S/seg";
}
//cierro porcentaje o cantidad
	  ?></td>
      <td bgcolor="#006600" class="style11"><span class="style13">
        <?php 
//operacion matematica 	
//checo si la fecha coincide
	if($myrow5['signo']){
				$banderaSeguro1="banderaSeguro1";
	}
//seguros	
if($myrow5['descuento']){	//trae descuento ?


if(trim($hoy >=$fechaInicio12) or $hoy<= trim($fechaFinal12)){

				
			
					if($myrow5['cp']=="porcentaje"){ //abre cantidad
						if($myrow5['signo']=="+"){
				        
						$reporteSeguro1=saca_pormas($q,$descuentoMateriales);
						}
						if($myrow5['signo']=="-"){
						$reporteSeguro1=saca_por($q,$descuentoMateriales);
	  					}
	  			    } //cierra porcentaje
				
				
				
				
				
				if($myrow5['cp']=="cantidad"){ //abre cantidad
						if($myrow5['signo']=="+"){
						$reporteSeguro1=$descuentoMateriales;
						echo "mas";
						}
						if($myrow5['signo']=="-"){
						
						$reporteSeguro1=$q-$descuentoMateriales;
	  					}
				
				} //cierro cantidad


	
} else {
$reporteSeguro1=$q;

} //cierro validacion de fecha

} else {
$reporteSeguro1=$q;

}  //cierro validacion si trae o no descuento
echo "$".number_format($reporteSeguro1,2);

//cierro seguros

?>
      </span></td>
      <td class="style24"><span class="Estilo24">
        <?php 
	  //************* APLICO IVA ********************
      
	  if($myrow13['tasaGP']>0 and $myrow13['tasaGP']!=null){
	 
        if($descuentoMateriales){
	     if(trim($hoy >=$fechaInicio12) or $hoy<= trim($fechaFinal12)){
		   
	  			if($myrow5['cp']=="cantidad"){ //abre cantidad
				
					if($myrow5['signo']=="+"){
					$reporteTasa1=$q-$descuentoMateriales;
					$reporteTasa1=saca_por($reporteTasa1,$myrow13['tasaGP']);
					}
					if($myrow5['signo']=="-"){
					
					$descuentoMateriales=saca_por($descuentoMateriales,$myrow13['tasaGP']);
					$reporteTasa1=$descuentoMateriales;
					
					//$reporteTasa=saca_por($descuentoProcedimientos,$myrow141['tasa']);
	  				}
	  			} //cierra cantidad 
				
				
				
				if($myrow5['cp']=="porcentaje"){ //abre porcentaje
				
					if($myrow5['signo']=="+"){
					$reporteTasa1=saca_por($reporteSeguro1,$myrow13['tasaGP']);
					} 
					if($myrow5['signo']=="-"){
					$reporteTasa1=$q-$reporteSeguro1;
					$reporteTasa1=saca_por($reporteTasa1,$myrow13['tasaGP']);
	  				}
	  			} //cierra porcentaje
			
			} else { //validacion de fechas
			$reporteTasa1=saca_por($reporteSeguro1,$myrow13['tasaGP']); //trae seguro pero esta vencido
			} //cierro validacion de fechas	
					
			} else {
	  		
			$reporteTasa1=saca_por($reporteSeguro1,$myrow13['tasaGP']); //no traigo seguro pero sin iva		  		
  			}
		
		} else { //no traigo iva
	   
	  	$reporteTasa1=0;		
		} //cierra iva
	  //***************CIERRO IVA*********************
	  echo "$".number_format($reporteTasa1,2);
	  ?>
      </span></td>
      <td bgcolor="#000066" class="style12"><span class="style13">
        <?php 
//********************** SACO LO QUE PAGA EL CLIENTE ***************************	  
 if($myrow5['descuento']){
	  if(trim($hoy >=$fechaInicio12) or $hoy<= trim($fechaFinal12)){
	  		if($myrow5['cp']=="cantidad"){	  
	  				if($myrow5['signo']=="+"){
	  				//$reporteCliente=$reporteSeguro+$reporteTasa;
	  				$reporteCliente1=($q-$reporteSeguro1)+$reporteTasa1;
					}
					if($myrow5['signo']=="-"){
					
	    			$reporteCliente1=$myrow5['descuento']+$reporteTasa1;
					}
	    	}
	  
	  
	 
	  		if($myrow5['cp']=="porcentaje"){
	  				if($myrow5['signo']=="+"){
					
					$reporteCliente1=$q+$reporteTasa1;
	  				}
	  				if($myrow5['signo']=="-"){
	  				$reporteCliente1=($q-$reporteSeguro1)+$reporteTasa1;
					}
			
			}

} else {
$reporteCliente1=$reporteSeguro1+$reporteTasa1;
} //cierro validacion de fechas
} else {
$reporteCliente1=$reporteSeguro1+$reporteTasa1;
} //cierro validaci&oacute;n de seguros
	  
	  echo "$".number_format($reporteCliente1,2);
	  $tReporteCliente[0]+=$reporteCliente1;
//************************************ CIERRO VALIDACION DEL CLIENTE ***************************	  
	  ?>
        <input name="importeCliente1" type="hidden" id="importeCliente1" value="<?php echo $cliente; ?>" />
      </span></td>
    </tr>
    <?php 

} //cierro ultimo paso de while
	 
	  ?>
  </table>
  <h1 align="center"><span class="style19">El Cliente debe pagar: <span class="style21">
    <?php $TOTAL= $tReporteCliente[0]+$tReporteCliente1[0];
	
echo "$".number_format($TOTAL,2);
	?>
    </span></span>
      <input name="paso_bandera1" type="hidden" id="paso_bandera1" value="<?php echo $bandera; ?>" />
      <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
      <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>">
      <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" />
  </h1>
</form>
  <?php } else {
caja_sinPoliza();
}
?>
  <p align="center"></p>
</form>
<h1 align="center">&nbsp;</h1>
</body>
</html>
<?php } else {
echo '<META HTTP-EQUIV="Refresh"
      CONTENT="0; URL=/sima/menuPrincipal.php">';
exit;

}
?>