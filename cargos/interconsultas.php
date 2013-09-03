<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<?php
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];


?>

<script language="javascript" type="text/javascript">   

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
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar artículos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 
		  	$sqlNombre16= "SELECT * From sesionesAlmacen
			WHERE 
			usuario = '".$usuario."'
			ORDER BY almacen ASC";
			$resultaNombre16=mysql_db_query($basedatos,$sqlNombre16);
			$rNombre16=mysql_fetch_array($resultaNombre16);
			$ali = $rNombre16['almacen'];
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


if($_POST['nuevo']){
$_POST['usuario']="";
$leyenda = "Ingrese los datos correctamente";
}

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
if($_POST['insertarArticulos'] ){ //*************************PRESIONO INSERTAR ARTICULOS******************



$q = "UPDATE clientesAmbulatorios set 
status='pendiente'
WHERE numeroE = '".$numeroPaciente."'";
mysql_db_query($basedatos,$q);


 $sSQL12= "
SELECT *
FROM
almacenes
WHERE 
almacen='".$almacen."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$ctaMayor=$myrow12['ctaContable']; 
$ID_CCOSTO=$myrow12['ID_CCOSTO'];
$cmdstr1 = "

select DISTINCT * 
from mateo.cont_RELACION 
where 
ID_EJERCICIO='".$ID_EJERCICIOM."' AND 
ID_CCOSTO ='".$ID_CCOSTO."' AND

STATUS='A' AND
TIPO_CUENTA='R'


";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1); 
 for ($ir = 0; $ir < $nrows1; $ir++ ){
 
$id_auxiliar= $results1['ID_AUXILIAR'][$ir];

} 

//*******************************************CIERRO AUXILIAR*********************************************
//**********************Cierro Insertar precios con nivel afectado******************************
if($aux){
$aux=$id_auxiliar;
} else {
$aux='0000000';
}
//************************************************************************************

//**************************************************SACO CENTRO DE COSTO***********************************

$sSQL19= "SELECT *
FROM
almacenes
WHERE almacen ='".$almacen."'";
$result19=mysql_db_query($basedatos,$sSQL19);
$myrow19 = mysql_fetch_array($result19);
$ID_CCOSTO=$myrow19['ID_CCOSTO'];
//************************************************Cierro CCOSTO


if($_POST['cargo']){
$status="cxc";
} else {
$status="pendiente";
} 
$codigo=$_POST['codigoArt'];
$cantidad=$_POST['cantidad'];
$agregarA=$_POST['agregarA'];
for($i=0; $i<=$_POST['bandera'];$i++){ //********************FOR
$Cost=$myrow23['costo'];

//*********************saco centro de costo************

//*************************************CONVENIOS********************************************
$codigo[$i]=$agregarA[$i];
$costoHospital=costoHospital($codigo[$i],$basedatos);
$gpoProducto=gpoProducto($code=$codigo[$i],$basedatos);
$descripcion=descripcion($code=$codigo[$i],$basedatos);
$ctaContable=centroCosto($medico,$basedatos);
$priceLevel=validacionConvenios($precioLevel,$code,$almacen,$gpoProducto,$seguro,$basedatos);
$iva=iva($gpoProducto,$priceLevel,$basedatos);
$porcentajeCXC=porcentajeCXC($porcentajeCXC,$code,$almacen,$gpoProducto,$seguro,$basedatos);
$ivaCXC=ivaCXC($gpoProducto,$porcentajeCXC,$basedatos);

//*/****************************************Cierro validacion de convenios************************



//****************CIERRO PRECIOS****************/


if($codigo[$i] and $cantidad[$i] and $agregarA[$i]){
$leyenda = "Se ingresaron cargos a la cuenta paciente";
$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,
codProcedimiento,
cantidad,
usuario,
fecha1,
ip,
status,
almacen,
costo,

ctaMayor,
ctoCosto,
auxiliar,

ejercicio,
seguro,
dia,
iva,costoHospital
) values (
'".$numeroPaciente."',
'".$agregarA[$i]."',
'".$cantidad[$i]."',
'".$usuario."',
'".$fecha1."',
'".$ip."',
'".$status."',
'".$ali."',
'".$priceLevel."',

'".$ctaMayor."',
'".$ID_CCOSTO."',
'".$aux."',

'".$ID_EJERCICIOM."',
'".$seguro."',
'".$dia."','".$iva."','".$costoHospital."'
)";
mysql_db_query($basedatos,$agrega1);
echo mysql_error();
if($porcentajeCXC AND !$_POST['cargo']){
$agrega1 = "INSERT INTO cargosCuentaPaciente (
numeroE,codProcedimiento,usuario,fecha1,ip,status,almacen,costo,iva,ctaMayor,ctoCosto,auxiliar,medico,ejercicio,dia,seguro,hora1,
costoHospital
) values ('".$_POST["numeroE"]."','".$agregarlos[$i]."','".$usuario."',
'".$fecha1."','".$ip."','cxc','".$ali."','".$porcentajeCXC."',
'".$ivaCXC."','".$ctaContable."','".$ctaContable."','".$aux."','".$_POST["medico"]."','".$ID_EJERCICIOM."','".$dia."',
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



$sSQL29= "SELECT *
FROM
existencias
where
codigo='".$agregarA[$i]."' and almacen='".$almacen."'
";
$result29=mysql_db_query($basedatos,$sSQL29);
$myrow29 = mysql_fetch_array($result29);
$existenciasActuales=$myrow29['existencia'];

$agrega = "UPDATE existencias set 
existencia='".$existenciasActuales."'-'".$cantidad[$i]."'
where
codigo='".$agregarA[$i]."' and almacen='".$almacen."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
}}
//*****************************************************CIERRO ALMA**************************************************



}
} else {//cierre de cumplir requisitos
echo '<script type="text/vbscript">
msgbox "YA SE SUPERO SU LIMITE DE CREDITO, NO PODEMOS AGREGAR CARGOS!"
</script>';
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style15 {color: #0000FF}
-->
</style>
</head>

<body>
<p align="center"><label></label><label>
  </label>
</p>
<form id="form1" name="form1" method="post" action="">
  <table width="420" border="1" align="center">
    <tr>
      <th width="29" scope="col">&nbsp;</th>
      <th width="174" scope="col">DEPARTAMENTO:</th>
      <th width="195" scope="col"><div align="left"><span class="Estilo24">
          <?php


$sqlNombre17= "SELECT * From almacenes
			WHERE 
			(ventas='Si' or ventas='si') 
		AND 
		activo='A'
			ORDER BY almacen ASC";
$resultaNombre17=mysql_db_query($basedatos,$sqlNombre17);


?>
          <select name="almacen" class="Estilo24" id="almacen"  onchange="javascript:this.form.submit();" />
   
          <option value="<?php echo $_POST['almacen'];?>"><?php echo $_POST['almacen'];?></option>
          <option value="">---</option>
          <?php
		  
            while ($rNombre17=mysql_fetch_array($resultaNombre17)){ 
		  			
  ?>
          <?php if($rNombre17['descripcion']){ ?>
          <option value="<?php echo $rNombre17['almacen'];?>"><?php echo $rNombre17['descripcion'];?></option>
          <?php } ?>
          <?php } ?>
          </select>
          </span>
              <label></label>
      </div></th>
    </tr>
  </table>
</form>
<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);">
  <p align="center"><span class="Estilo24"><span class="style7">
  <input name="almacenCargo" type="hidden" id="almacenCargo" value="<?php echo $_POST['almacen']; ?>" />
  </span></span>
    <input name="nombrePaciente3" type="hidden" id="nombrePaciente3" value="<?php 
echo $nombrePaciente1;
	 ?>" />
    <input name="medico1" type="hidden" id="medico1" value="<?php echo $medico1; ?>" />
    <input name="tipoSeguro1" type="hidden" id="tipoSeguro1" value="<?php echo $seguro; ?>" />
    <input name="almacenP1" type="hidden" id="almacenP1" value="<?php echo $almacenPrincipal; ?>" />
    <input name="numPoliza1" type="hidden" id="numPoliza1" value="<?php echo $numPoliza; ?>" />
    <input name="nCuenta1" type="hidden" id="nCuenta1" value="<?php echo $nCuenta; ?>" />
    <span class="style15"><?php echo $leyenda; ?></span>  </p>
    <?php	
	  $articulo=$_POST['nomArticulo'];
if($_POST['almacen']){

$sSQL= "SELECT 
* 
FROM articulos,existencias
WHERE
articulos.activo='A' and
articulos.codigo=existencias.codigo and
existencias.almacen='".$_POST['almacen']."'
AND 
articulos.descripcion   like '%dr.%' and
articulos.um='s'
ORDER BY articulos.descripcion ASC
";


if($ali){
if($result=mysql_db_query($basedatos,$sSQL)){

?>
    <table width="512" border="1" align="center">
      <tr>
        <th width="37" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">C&oacute;digo  </span></div></th>
        <th width="357" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="56" bgcolor="#660066" scope="col"><span class="style11">Precio</span></th>
        <th width="34" bgcolor="#660066" scope="col"><span class="style11">Agregar</span></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];
$priceLevel=validacionConvenios($precioLevel,$code=$code1,$almacen,$gpoProducto,$seguro,$basedatos);
//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$sSQL4= "
SELECT 
  *
FROM
existencias
WHERE codigo = '".$code1."'
and 
almacen='".$almacen."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
$um=$myrow12['um'];
?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php echo $co=$myrow['codigo']; ?>
          <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codigo']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow['descripcion']; ?></span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php 
	if($priceLevel){
	  echo number_format($priceLevel,2);
	}  else {
	echo "0.00";
	}
	
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>

		<input name="agregarA[]" type="checkbox" id="agregarA[]" value="<?php echo $myrow['codigo']; ?>" 
	
		/>
		

        </label></td>
      </tr>
      <?php }}}?>
  </table>
    <div align="center">
      <?php 
  if($co){
 
  } else {
 echo "No se encontraron Procedimientos...";} ?>
    </div>
    <p align="center">
      <?php 
	
	if($co){
	echo "Se encontraron $bandera procedimientos..";
	}
	?>
    </p>
    <p align="center">
      <label>
      <input name="insertarArticulos" type="submit" class="Estilo24" id="insertarArticulos" value="Agregar Art&iacute;culos" />
      </label>
    </p>
    <?php } ?>
    <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
    <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
    <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
    <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
    <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
    <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
</form>
  <p></p>
  
  
</body>
</html>
