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
<p align="center">
  <label></label>
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
numeroE='".$_GET['numeroPaciente']."' and nCuenta='".$_GET['nCuenta']."' 
and 
banderaImprimirSD='standby'
";



?>
   
      
      
      
      
           
      
</div>
    <table width="477" border="0" align="center">
      <tr>
        <th width="97" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Fecha / Hora </span></div></th>
        <th width="324" bgcolor="#660066" scope="col"><span class="style11">Descripci&oacute;n</span></th>
        <th width="42" bgcolor="#660066" scope="col"><span class="style11">Cantidad</span></th>
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

$q = "UPDATE cargosCuentaPaciente set 
banderaImprimirSD='printed'

WHERE keyCAP = '".$keyCAP."'

";
mysql_db_query($basedatos,$q);
echo mysql_error();
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
and
banderaImprimirSD='standby'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7">
          <label></label>
          <?php 
		  if($myrow['fechaCargo']){
		  echo cambia_a_normal($myrow['fechaCargo'])."  ".$myrow['horaCargo']; 
		  } else {
		  echo "---";
		  }
		  ?>
</span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style7"><?php echo $myrow12['descripcion']; ?>
            <?php //echo $myrow12['um'].$myrow13['umVentas']; ?>
        </span></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24"><?php
if($myrow['existencia']>0 ){ 
$orden='';
} else {
$orden='readonly="readonly"';
}
?>
<?php  echo $myrow['cantidad']; ?></td>
      </tr>
      <?php }?>
  </table>
  
  
  
    <p>&nbsp;    </p>
</form>
  <p></p>
  
  
</body>
</html>
