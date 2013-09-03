<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); ?>
<?php
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$almacenSolicitante=$_GET['almacen'];
$nCuenta=$_GET['nCuenta'];
$tipoCargo=$_GET['tipoCargo'];
$almacenDestino=$_GET['almacenDestino'];

?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script> 

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
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el departamento!")   
                return false   
        } else if( vacio(F.tipoUM.value) == false ) {   
                alert("Por Favor, escoje si es un servicio o si son artículos lo que vas a cargar!")   
                return false   
        } else if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escoje el artículo o servicio para solicitar!")   
                return false   
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
<?php 

if($_POST['imprimir']){
$keyCAP=$_POST['coder'];

for($i=0;$i<=$_POST['bandera'];$i++){
if($keyCAP[$i]){
$q = "UPDATE cargosCuentaPaciente set 
banderaImprimirSD='standby'

WHERE keyCAP = '".$keyCAP[$i]."'

";
mysql_db_query($basedatos,$q);
}
}
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
<META HTTP-EQUIV="Refresh"
CONTENT="30"> 
<p align="center">
  <label><em>Verificar Art&iacute;culos Para Imprimir cargados al cuarto: <span class="style15"><?php echo $_GET['cuarto'];?></span></em></label>
  <label>
  </label>
</p>









<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);">
  <div align="center">
      <?php	
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
numeroE='".$numeroPaciente."' and nCuenta='".$nCuenta."' 
and 
(statusCargo='cargado' or status='cargado')
and
almacenDestino='".$almacenSolicitante."'
";



?>
   
      
      
      
      
           
      
</div>
    <table width="665" border="0" align="center">
      <tr>
        <th width="92" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Fecha / Hora Cargo</span></div></th>
        <th width="95" bgcolor="#660066" scope="col"><span class="style11">Fecha / Hora Solicit</span></th>
        <th width="353" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="31" bgcolor="#660066" scope="col"><span class="style11">Estado</span></th>
        <th width="43" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
        <th width="42" bgcolor="#660066" scope="col"><span class="style11">Imprimir</span></th>
      </tr>
      <tr>
        <?php 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$keyCAP=$myrow['keyCAP'];
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codProcedimiento'];
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


//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$sSQL2= "Select distinct * From cargosCuentaPaciente
where
keyCAP='".$keyCAP."'

";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php 
		  if($myrow['fechaCargo'] and $myrow['horaCargo']){
		  echo cambia_a_normal($myrow['fechaCargo'])."  ".$myrow['horaCargo']; 
		  } else {
		  echo "---";
		  }
		  ?>        
          </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <?php 
		  if($myrow['fecha1'] and $myrow['hora1']){
		  echo cambia_a_normal($myrow['fecha1'])."  ".$myrow['hora1']; 
		  } else {
		  echo "---";
		  }
		  ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow12['descripcion']; ?>
            <?php //echo $myrow12['um'].$myrow13['umVentas']; ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24">
		<?php if($myrow2['banderaImprimirSD']=='standby'){ ?>
		<div align="center"><img src="../imagenes/impresora.jpg" alt="STATUS" width="30" height="30" /></div>
		<?php } else if($myrow2['banderaImprimirSD']=='printed'){ ?>
		<div align="center"><img src="../imagenes/solicitado.png" alt="STATUS" width="30" height="30" /></div>
		<?php } else {?>
		<div align="center"><img src="../imagenes/sinSolicitar.png" alt="STATUS" width="30" height="30" /></div>
		<?php } ?>		</td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php
if($myrow['existencia']>0 ){ 
$orden='';
} else {
$orden='readonly="readonly"';
}
?>
<?php  echo $myrow['cantidad']; ?></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><label>
        <input name="coder[]" type="checkbox" id="coder" value="<?php  echo $myrow['keyCAP']; ?>" />
        </label></td>
      </tr>
      <?php }?>
  </table>
  
  
  
    <p>
      <?php 
 
 //*********************************************TERMINA TABLA**************************************************
 
 ?>
      <span class="Estilo24"><span class="style7">
      <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
      <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />
      <input name="codigoGamma[]" type="hidden" id="codigoGamma[]" value="<?php  echo $myrow['keyCAP']; ?>" />
      </span></span> </p>
  <div align="center"></div>
  <div align="center">
    <input name="imprimir" type="submit" class="Estilo24" id="imprimir" value="Vista de Impresi&oacute;n" />
    </label>
          <span class="style12"><span class="Estilo24">
  </span></span></div>
        <p align="center"><a href="javascript:ventanaSecundaria(
		'/sima/ADMINHOSPITALARIAS/inventarios/imprimirSDSeleccion.php?numeroPaciente=<?php echo $numeroPaciente; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;campo=<?php echo "cbarra"; ?>')" class="style7">Imprimir Selecci&oacute;n </a> </p>
  
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
