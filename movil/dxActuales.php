<?PHP include("/configuracion/ventanasEmergentes.php"); ?>
<?php
$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
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
           
        if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripción del diagnóstico!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje algún tipo de seguro, o también si es particular!")   
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

$keyClientesInternos=$_GET['keyClientesInternos'];
$sql2= "
SELECT *
FROM
clientesInternos
WHERE
keyClientesInternos ='".$keyClientesInternos."' 

";
$result2=mysql_db_query($basedatos,$sql2);
$myrow2= mysql_fetch_array($result2);
$numeroE=$myrow2['numeroE'];
$nCuenta=$myrow2['nCuenta'];
$seguro=$myrow2['seguro'];
$medico=$myrow2['medico'];
$paciente=$myrow2['paciente'];

if($_POST['actualizar'] AND $numeroE and $nCuenta){


$agrega = "INSERT INTO dx (
numeroE,nCuenta,CI,descripcion,fecha,hora,usuario,medico,seguro) 
values ('".$numeroE."','".$nCuenta."','".$codigo1."','".strtoupper($_POST['descripcion'])."',
'".$fecha1."','".$hora1."','".$usuario."','".$medico."','".$seguro."')";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo $myrow11['descripcion'];	
echo '<script type="text/vbscript">';
echo 'msgbox "SE AGREGÓ EL DIAGNOSTICO "'.$myrow5['descripcion']; 
echo '</script>';
}

if($_POST['borrar'] AND $numeroPaciente){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM dx WHERE keyDiagnostico = '".$quitar[$is]."' ";
//mysql_db_query($basedatos,$borrame);
echo mysql_error();

}$leyenda = "Se eliminó el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['numCliente']){
$leyenda = "Por favor, escoja el nombre de numCliente que desee eliminar..!";
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL CONVENIO!"
</script>';
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
-->
</style>
<head>
<script type="text/javascript" src="/sima/js/ajax.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
.style12 {font-size: 10px}
.style14 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>
</head>

<body>

  <p align="center"><a href="/sima/movil/principal.php"><span class="style71">Regresar a Men&uacute;</span></a></p>
  <p>&nbsp;</p>
  <form id="form2" name="form2" method="post" action="">
    <?php	

$sSQL= "SELECT 
* 
FROM dx
WHERE
numeroE='".$numeroPaciente."'
ORDER BY fecha DESC
";


$result=mysql_db_query($basedatos,$sSQL);

?>
    <span class="Estilo24"><span class="style7">
    <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codigo']; ?>" />
    </span></span>
    <table width="758" border="0" align="center" class="style7">
      <tr class="style11">
        <th width="142" height="19" bgcolor="#660066" scope="col"><div align="center"><span class="style14">Fecha</span></div></th>
        <th width="106" bgcolor="#660066" scope="col"><div align="center"><span class="style14">C.I. </span></div></th>
        <th width="436" bgcolor="#660066" scope="col"><div align="center"><span class="style14">Descripci&oacute;n/Observaciones</span></div></th>
        <th width="56" bgcolor="#660066" scope="col"><div align="center"><span class="style14">M&eacute;dico</span></div></th>
      </tr>
      <tr class="style7">
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

        <td height="24" bgcolor="<?php echo $color;?>" >
		  <div align="center"><span class="style14">
            <?php echo $myrow['hora']." ".$myrow['fecha']; ?>
		    </span>		  
	      </div></td>
		  
        <td bgcolor="<?php echo $color;?>">
		  <div align="center"><span class="style14">
	      <?php echo $myrow['CI']; ?>
		    </span> </div></td>
		
        <td bgcolor="<?php echo $color;?>">
		  <div align="center"><span class="style14">
	      <?php echo $myrow['descripcion']; ?>
		    </span> </div></td>
		
        <td bgcolor="<?php echo $color;?>">
		  <div align="center"><span class="style14">
	      <?php echo $myrow['medico']; ?>
		    </span> </div></td>
	  </tr>
		
 
      <?php }?>
    </table>
    <p align="center">&nbsp;    </p>
  </form>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>

</body>
</html>