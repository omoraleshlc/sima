<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>
<?php
$_POST['medico']=$medico=$_GET['medico'];
$_POST['seguro']=$seguro=$_GET['seguro'];
$almacen=$_POST['almacen']=$ali=$_GET['almacen'];
$_POST['numeroE']=$numeroE=$_GET['numeroE'];
$codigoBeta=$_POST['codigoBeta'];
$priceLevel=$_POST["priceLevel"];
$ctaMayores=$_POST["ctaContable"];
$agregarlos = $_POST["agregarP"];
$banderita=$_POST['flag'];
$Cost=$_POST['Cost'];
$agregarlos[$i]=trim($agregarlos[$i]);
?>

<?php

$hoy = date("d/m/Y");
$hora = date("H:i a");
$medico=$_POST['medico']; 
$ali = $_POST['ali'];
//***********************CAMBIAR ALMACEN****************************
if($_POST['almacen']){

$sSQL17= "Select * From sesionesAlmacen WHERE usuario = '".$usuario."'";
$result17=mysql_db_query($basedatos,$sSQL17);
$myrow17 = mysql_fetch_array($result17);
$ali=$myrow17['almacen'];
if(!$myrow17['usuario']){

$agrega = "INSERT INTO sesionesAlmacen ( usuario,almacen
) values (
'".$usuario."',
'".$_POST['almacen']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

} else {

$q1 = "UPDATE sesionesAlmacen set 
almacen='".$_POST['almacen']."'
WHERE usuario = '".$usuario."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
//paciente_actualizado();
}
}
//**********************CIERRO CAMBIAR ALMACEN******************************



//**************************ANTES DE HACER UN CARGO VERIFICAR SI TIENE CREDITO***************************
//*************************Cierro comparacion de precio contra credito********************
$sSQL39= "SELECT *
FROM
segurosLimites
where 
seguro='".$_POST['seguro']."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);
$creditoTope=$myrow39['cantidad'];
$fechaInicial=$myrow39['fechaInicial'];
$fechaFinal=$myrow39['fechaFinal'];
$secureLoader=$myrow39['seguro'];
if($secureLoader==$_POST['seguro'] AND $_POST['credencial']){
//and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'
$sSQL40= "SELECT sum(costo) as totalCredito
FROM
cargosCuentaPaciente
where 
credencial='".$_POST['credencial']."' and
seguro='".$secureLoader."' and fecha1 between  '".$fechaInicial."' and '".$fechaFinal."'

";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);
$totalCredito=$myrow40['totalCredito'];
$totalCredito+=$Cost;

if($totalCredito<$creditoTope){
echo '<br>';
echo "El Paciente tiene un crédito disponible de: "."$".number_format($creditoTope-$totalCredito,2)." y un acumulado de "."$".number_format($totalCredito,2).", de un crédito de "."$".number_format($creditoTope,2);
$cumpleRequisitos="si";
} else {
$cumpleRequisitos="no";
}
} else {///si coinciden los seguros entondces es un estudiante
$cumpleRequisitos="si";
}
//*********************************************************




//************************* AGREGAR PACIENTE AMBULATORIO **************************
if($cumpleRequisitos=="si"){
if($_POST['insertar']  AND $_POST['numeroE'] ){

$sSQL26= "Select * From clientesAmbulatorios WHERE 
fecha ='".$_POST['fecha']."'
and
cita='".$_POST['cita']."'
AND
medico='".$_POST['medico']."'
";
$result26=mysql_db_query($basedatos,$sSQL26);
$myrow26 = mysql_fetch_array($result26);
$paciente=$myrow26['paciente'];


if(!$myrow26['medico'] ){

if($_POST['agregarP']){

$sSQL1= "Select * From clientesAmbulatorios WHERE 
fecha ='".$_POST['fecha']."'
and
hora ='".$_POST['hora']."'
AND
numeroE='".$_POST['numeroE']."'
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
$numeritoE=$_POST['numeroE'];
if($_POST['numeroE']){

//******************** INSERTAR CLIENTES AMBULATORIOS
if($_POST['numeroE']!=$myrow1['numeroE']){



if($_POST['cargo']){
$status="cxc";
} else {
$status="pendiente";
}

$confirmaCita='sinconfirmar';
if($_POST['numeroExpediente']){
$entregaExpediente='sinentregar';
} else {
$entregaExpediente='sinexpediente';
}

//******************ACTUALIZO CITAS *****************************
$q = "UPDATE MedicosCitas set 
status = '".$statusCitas."',numeroE='".$_POST['numeroE']."'
WHERE codMedico = '".$_POST['medico']."' AND codHora = '".$_POST['cita']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$sSQL4= "Select max(keyClientesAmbulatorios) as final From clientesAmbulatorios";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$numPaciente = $myrow4['final']+1; 

//*******************CIERRO ACTUALIZAR CITAS *********************
$agrega = "INSERT INTO clientesAmbulatorios ( 
numeroE,
medico,paciente,
seguro,autoriza,credencial,
fecha,hora,status,cita,almacen,usuario,ip,fecha1,tipoConsulta,
numeroExpediente,numeroNomina,telefono,confirmaCita,entregaExpediente,ID_CCOSTO,dia,tipoCobro

) values (
'".$_POST['numeroE']."',
'".$_POST['medico']."',
'".$_POST['paciente']."',
'".$_POST['seguro']."',
'".$_POST['autoriza']."',
'".$_POST['credencial']."',
'".$_POST['fecha']."',
'".$hora."',
'".$status."',
'".$_POST['cita']."',
'".$ali."',
'".$usuario."',
'".$ip."',
'".$fecha1."',
'".$_POST['tipoConsulta']."',
'".$_POST['numeroExpediente']."',
'".$_POST['numeroNomina']."',
'".$_POST['telefono']."',
'".$confirmaCita."',
'".$entregaExpediente."',
'".$ID_CCOSTO."',
'".$dia."',
'".$_POST['tipoCobro']."'
)";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGO EL CARGO AL PACIENTE"
</script>';


//foreach($agregar as $i => $agregar_articulo){

$cCosto=$_POST['ccosto'];
$codigoAlpha=$_POST['codigoAlpha'];
//********************************sacar cta contable************************************


//==============================================================================================

//*******************************************SACO AUXILIAR**********************************************
$cmdstr1 = "

select DISTINCT * 
from mateo.cont_RELACION 
where 
ID_CTAMAYOR ='".$ctaMayor."' AND
ID_EJERCICIO='".$ID_EJERCICIOM."' AND 
ID_CCOSTO ='".$ID_CCOSTO."' AND

STATUS='A' AND
TIPO_CUENTA='R'


";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 

for ($i = 0; $i < $nrows1; $i++ ){
 
$id_auxiliar= $results1['ID_AUXILIAR'][$i];

} 

//*******************************************CIERRO AUXILIAR*********************************************
//**********************Cierro Insertar precios con nivel afectado******************************
if($aux){
$aux=$id_auxiliar;
} else {
$aux='0000000';
}

//*****estoy aqui
for($i=0;$i<$banderita;$i++){

if($agregarlos[$i]){
//*************************************CONVENIOS********************************************


$costoHospital=costoHospital($agregarlos[$i],$basedatos);
$gpoProducto=gpoProducto($code=$agregarlos[$i],$basedatos);
$descripcion=descripcion($code=$agregarlos[$i],$basedatos);
$iva=descripcion($gpoProducto,$basedatos);
$ctaContable=centroCosto($medico,$basedatos);
$precioLevel=validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);
$porcentajeCXC=porcentajeCXC($porcentajeCXC,$code,$almacen,$gpoProducto,$seguro,$basedatos);
//*****************************************Cierro validacion de convenios************************

$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,codProcedimiento,usuario,fecha1,ip,status,almacen,costo,iva,ctaMayor,ctoCosto,auxiliar,medico,ejercicio,dia,seguro,hora1,
costoHospital
) values ('".$_POST["numeroE"]."','".$agregarlos[$i]."','".$usuario."',
'".$fecha1."','".$ip."','".$status."','".$ali."','".$precioLevel."',
'".$iva."','".$ctaContable."','".$ctaContable."','".$aux."','".$_POST["medico"]."','".$ID_EJERCICIOM."','".$dia."',
'".$seguro."','".$hora1."','".$costoHospital."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();

if($porcentajeCXC AND !$_POST['cargo']){
$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,codProcedimiento,usuario,fecha1,ip,status,almacen,costo,iva,ctaMayor,ctoCosto,auxiliar,medico,ejercicio,dia,seguro,hora1,
costoHospital
) values ('".$_POST["numeroE"]."','".$agregarlos[$i]."','".$usuario."',
'".$fecha1."','".$ip."','cxc','".$ali."','".$porcentajeCXC."',
'".$iva."','".$ctaContable."','".$ctaContable."','".$aux."','".$_POST["medico"]."','".$ID_EJERCICIOM."','".$dia."',
'".$seguro."','".$hora1."','".$costoHospital."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
$q = "UPDATE clientesAmbulatorios set 
cargosCXC='cxc'

WHERE numeroE = '".$_POST['numeroE']."'";
mysql_db_query($basedatos,$q);
$q = "UPDATE cargosCuentaPaciente set 
statusFactura='sinfacturar'

WHERE numeroE = '".$_POST['numeroE']."'
and
status='cxc'
";
mysql_db_query($basedatos,$q);

}

//}//cierro validacion de priceLevel
}//cierro validacion del codigo
}//cierro for



} else {

$q = "UPDATE clientesAmbulatorios set 
medico='".$_POST['medico']."',
paciente='".$_POST['paciente']."',
seguro='".$_POST['seguro']."',
autoriza='".$_POST['autoriza']."',
credencial='".$_POST['credencial']."',
fecha='".$_POST['fecha']."',
hora='".$_POST['hora']."',
cita='".$_POST['cita']."',
usuario='".$usuario."',
almacen='".$ali."',
ip='".$ip."',
fecha1='".$fecha1."',
tipoConsulta='".$_POST['tipoConsulta']."',
confirmaCita='".$confirmaCita."',
entregaExpediente='".$entregaExpediente."'
WHERE numeroE = '".$_POST['numeroE']."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();

/* echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO EL CARGO AL PACIENTE..!!"
</script>';
 */
if($agregar = $_POST["agregarP"]){
for($i=0;$i<=$_POST['flag'];$i++){
//*********CARGO PROCEDIMIENTOS******
$sSQL21= "Select * From cargosCuentaPaciente 
WHERE numeroE = '".$_POST['numeroE']."' AND codProcedimiento = '".$agregar[$i]."'";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);
echo mysql_error();
//*************** EXISTEN *********************************
if($agregar AND $myrow21['codProcedimiento']=='".$agregar[$i]."'){

$q = "UPDATE cargosCuentaPaciente set 
codProcedimiento = '".$agregar[$i]."',
usuario = '".$usuario."',fecha1='".$fecha1."',ip = '".$ip."',
costo='".$nivelPrecio."'
WHERE numeroE = '".$nPaciente."' AND codProcedimiento = '".$agregar[$i]."'";
//mysql_db_query($basedatos,$q);
echo mysql_error();
} else {


$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,codProcedimiento,usuario,fecha1,ip,status,almacen,costo,ctoCosto,auxiliar,medico,ejercicio
) values ('".$_POST['numeroE']."','".$agregar[$i]."','".$usuario."',
'".$fecha1."','".$ip."','".$status."','".$ali."','".$nivelPrecio."','".$ctaMayor."','".$id_auxiliar."','".$_POST['medico']."',
'".$ID_EJERCICIO."'
)";


//mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}}}}

} else {
echo '<script type="text/vbscript">
msgbox "YA ESTA ASIGNADA LA CITA A UN PACIENTE, ESCOJE OTRA CITA DISPONIBLE, GRACIAS!"
</script>';

}
//***************************************CIERRO COMPARAR CITAS
} 
} else { 
echo '<script type="text/vbscript">
msgbox "YA ESTA ASIGNADA LA CITA , ESCOJE OTRA CITA DISPONIBLE, GRACIAS!"
</script>';

}
}
} else {//cierre de cumplir requisitos
echo '<script type="text/vbscript">
msgbox "YA SE SUPERO SU LIMITE DE CREDITO, NO PODEMOS AGREGAR CARGOS!"
</script>';
}



if($_POST['borrar'] AND $_POST['numeroE']){
$borrame = "DELETE FROM cargosAmbulatorios WHERE numeroE ='".$_POST['numeroE']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
paciente_eliminado();
}

if($_POST['nuevo']){
$_POST['medico']="";
$_POST['paciente']="";
$_POST['seguro']=NULL;
$_POST['autoriza']="";
$_POST['credencial']="";
$_POST['cita']="";
}





$seguro=$_POST['seguro'];




?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
</head>
	  <?php 
$sSQL18= "Select * From medicos WHERE numMedico ='".$medico."' and status='A'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
$centroCosto=$rNombre18['ctaContable'];
$tipoMedico=$rNombre18['tipoMedico'];

$sSQL24= "Select * From  tipoMedico WHERE tipoMedicos='".$tipoMedico."'";
$result24=mysql_db_query($basedatos,$sSQL24);
$rNombre24 = mysql_fetch_array($result24); 
$dr="Dr(a): ".
	  $rNombre18["apellido1"]." ".$rNombre18["apellido2"]
	  ." ".$rNombre18["apellido3"]." ".$rNombre18["nombre1"]." ".$rNombre18["nombre2"];?>
<body>
<p align="center">&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="606" border="1" align="center">
    <tr>
      <th width="50" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo Art&iacute;culo </span></div></th>
      <th width="338" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
      <th width="27" bgcolor="#660066" scope="col"><span class="style11">P </span></th>
      <th width="43" bgcolor="#660066" scope="col"><span class="style11">CM. </span></th>
      <th width="74" bgcolor="#660066" scope="col"><span class="style11">
        <?php 
	  
	echo "Precio";
	  ?>
      </span></th>
      <th width="34" bgcolor="#660066" scope="col"><span class="style11">Agregar</span></th>
    </tr>
    <tr>
      <?php 
$sSQL11= "
	SELECT *
FROM
  MedicosProcedimientos

WHERE codMedico = '".$medico."' and almacen='".$ali."'
";

$result11=mysql_db_query($basedatos,$sSQL11);
	

while($myrow11 = mysql_fetch_array($result11)){ 
$code= $myrow11['codProcedimiento'];
$gpoPro=$myrow11['gpoProducto'];
$bandera+="1";
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$cProced=$myrow11['codigo'];

echo mysql_error();


$gpoProducto=gpoProducto($code,$basedatos);
$descripcion=descripcion($code,$basedatos);
$iva=descripcion($gpoProducto,$basedatos);
$ctaContable=centroCosto($medico,$basedatos);
$precioLevel=validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);
$porcentajeCXC=porcentajeCXC($porcentajeCXC,$code,$almacen,$gpoProducto,$seguro,$basedatos);

//***********traigo cuenta contable


//****************************Terminan las validaciones
?>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <label></label>
        <?php echo $code; ?>
        <input name="codigoAlpha[]" type="hidden" id="codigoAlpha[]" value="<?php echo $code;?>" />
        <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php echo $code;?>" />
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $descripcion; ?>
            <input name="descripcionProcedimientos[]" type="hidden" id="descripcionProcedimientos[]" 
	value="<?php echo $myrow11['descripcion']; ?>" />
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $gpoProducto; ?></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
        <?php 
	  if($ctaContable){
	  echo $ctaContable; 
	  } else {
	  echo "N/A";
	  }
	  ?>
        <input name="ctaContable[]" type="hidden" id="ctaContable[]" value="<?php echo $ctaContable; ?>" />
        <input name="ccosto[]" type="hidden" id="ccosto[]" value="<?php echo $centroCosto; ?>" />
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><label><span class="style7"> </span>
            <?php 
	  if($precioLevel){ ?>
            <?php  if($precioLevel==1){  ?>
            <input name="priceLevel[]" type="text" class="style12" id="priceLevel[]" size="8" maxlength="8" 
		  value="<?php 
		echo $precioLevel; 
		?>"  readonly=""/>
            <?php } else {?>
            <input name="priceLevel[]" type="text" class="style12" id="priceLevel[]" size="8" maxlength="8" 
		  value="<?php 
		echo number_format($precioLevel,2); 
		?>"  readonly=""/>
            <?php } ?>
            <?php } else {
		echo $noPrice="Sin Precio";
		} ?>
            <span class="style7"> </span></label></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24">
	      <?php if($ctaContable AND $precioLevel){ ?>
		  
          <input name="agregarP[]" type="checkbox" value="<?php echo $code; ?>"/>
		  
          <?php } else { ?>
          <input name="agregarP[]" type="checkbox" value=""  disabled="disabled"/>
          <?php }
?></td>
   <input name="ali" type="hidden" id="ali" value="<?php echo $ali; ?>" />
    <input name="flag" type="hidden" id="flag" value="<?php echo $bandera; ?>"/>
		      <input name="ctaContable[]" type="hidden" id="ctaContable[]" value="<?php echo $myrow8['ctaContable']; ?>" />
          <input name="ccosto[]" type="hidden" id="ccosto[]" value="<?php echo $centroCosto; ?>" />
    </tr>
    <?php }?>
  </table>
  <p align="center">
 
    <?php //} //cierro medico 
 
 
 
 //}
 ?>
    <input name="insertar" type="submit" class="Estilo24" id="insertar" value="Agregar Cargos"
		    <?php /* if(!$cita){ echo 'disabled="disabled"'; } */?> />
  </p>
</form>
<p>&nbsp; </p>
</body>
</html>
