<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 




<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=700,scrollbars=YES") 
} 
</script> 







<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=600,height=600,scrollbars=YES") 
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
           
        if( vacio(F.despliega.value) == false ) {   
                alert("Por Favor, escribe el Código Internacional!")   
                return false   
        }         
}   
</script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>


<?php
$random=rand(3, 15);

$sql2= "
SELECT *
FROM
clientesInternos
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 

";
$result2=mysql_db_query($basedatos,$sql2);
$myrow2= mysql_fetch_array($result2);


$numeroE=$myrow2['numeroE'];
$nCuenta=$myrow2['nCuenta'];
$seguro=$myrow2['seguro'];

$paciente=$myrow2['paciente'];

if($_GET['actualizar'] and $_GET['keyClientesInternos'] and $_GET['ci']){
$uploaddir = 'images/';
$uploadfile = $uploaddir.$random.basename($_FILES['userfile']['name']);
move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
//**********************************************************


//****************comprueba si ya existe****************/
$sql25= "
SELECT numeroE
FROM
dx
WHERE
keyClientesInternos ='".$_GET['keyClientesInternos']."' 
and
ci='".$_GET['ci']."'
";
$result25=mysql_db_query($basedatos,$sql25);
$myrow25= mysql_fetch_array($result25);

//actualiza
if(!$myrow25['numeroE']){

$agrega = "insert into dx 
(ci,observaciones,entidad,keyClientesInternos,fecha,hora,usuario,medico,numeroE,nCuenta,numeroExpediente,seguro,banderaCI) values('".$_GET['ci']."','".nl2br($_GET['observaciones'])."','".$entidad."','".$_GET['keyClientesInternos']."','".$fecha1."','".$hora1."','".$usuario."','".$MEDICO."','".$numeroE."','".$nCuenta."','".$numeroE."','".$seguro."','si')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>
<script>
window.opener.location.reload(true);
//self.close();
</script>
<?php 
} else {
echo '<blink>'.'Ya existe éste Código Internacional'.'</blink>';
}


}else{
$inactiva='';
}



?>



<?php  //ELIMINA CODIGO INTERNACIONAL
if($_GET['ci'] AND $_GET['inactiva']){

 $q = "delete from dx WHERE keyClientesInternos='".$_GET['keyClientesInternos']."' AND
		ci='".$_GET['ci']."'";
	mysql_db_query($basedatos,$q);
		echo mysql_error();
$inactiva='';
} else {
$inactiva='si';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo241 {font-size: 10px}
.Estilo241 {font-size: 10px}
.style19 {font-size: 10px}
.style19 {font-size: 10px}
.style1 {color: #0000FF}
-->
</style>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
.style12 {font-size: 10px}
.style12 {font-size: 10px}
.style121 {font-size: 10px}
-->
</style>
</head>

<body>

  <p align="center">
  
  <?php 
  
  $sSQL2= "SELECT paciente
FROM
clientesInternos
WHERE 
keyClientesInternos='".$_GET['keyClientesInternos']."'
 ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
 $px=$myrow2['paciente'];


  
 $sSQL24= "SELECT *
FROM
medicos
WHERE 
numMedico='".$MEDICO."'
 ";
$result24=mysql_db_query($basedatos,$sSQL24);
$myrow24 = mysql_fetch_array($result24);
$nombreMedico= $myrow24['nombre1'].' '.$myrow24['apellido1'];
?>
  
  &nbsp;</p>
  <p align="center">&nbsp;</p>
  <form id="form1" name="form1" method="GET" action="">
    <p>&nbsp;</p>
    <table width="532" border="1" align="center" class="style7">
      <tr>
        <td height="22" colspan="2" bgcolor="#660066" class="style11"><div align="center"><?php echo $px;?></div></td>
      </tr>
      <tr>
        <td width="156" height="40" bgcolor="#660066"><span class="style13">DX Codigo Internacional</span></td>
        <td width="514"><span class="style12">
          <input name="M2" type="button" class="style7" id="M2"  onclick="javascript:ventanaSecundaria(
		'/sima/cargos/despliegaCodigosInternacionales.php?campoDespliega=<?php echo "despliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "ci"; ?>&amp;keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>')" value="CI" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Mostrar la lista de Códigos Internacionales';?></div>')" onMouseOut="UnTip()"/>
          <input name="despliega" type="text" class="style7" size="80"  readonly="" value="<?php echo $_GET['despliega'];?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Agregar Códigos Internacionales';?></div>')" onMouseOut="UnTip()"/>
          <span class="style13">
          <input name="ci" type="hidden" class="style7" size="10"  readonly=""/>
        </span></span></td>
      </tr>
      <tr>
        <td height="33">&nbsp;</td>
        <td><span class="style12">
          <input name="actualizar" type="submit" class="style7" id="actualizar" value="Aplicar Codigo Internacional" onClick="if(confirm('Esta seguro que deseas aplicar este diagn&oacute;stico?') == false){return false;}" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Aplicar Código Internacionales';?></div>')" onMouseOut="UnTip()"  />
        </span>
          <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $_GET['keyClientesInternos'];?>" />
            <input name="button" type="button" class="style7"
onclick="window.close();" value="Cerrar (x)" /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="558" border="0" align="center">
      <tr>
        <th bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Fecha</span></div></th>
        <th height="14" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">C&oacute;digo I </span></div></th>
        <th bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Descripci&oacute;n</span></div></th>
        <th bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Elimina </span></div></th>
      </tr>
      <tr>
   
        <?php	
$sSQL= "SELECT  
* 
FROM dx
WHERE
numeroExpediente='".$numeroE."' 
and
banderaCI='si'
and
ci!=''
ORDER BY keyDiagnostico DESC
";


$result=mysql_db_query($basedatos,$sSQL);

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$tipoPaciente=$myrow['tipoPaciente'];
$a+=1;
$cita=$myrow['cita'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$numeroE=$myrow['numeroE'];$nCuenta=$myrow['nCuenta'];



 
$sSQL4= "SELECT descripcion
FROM
diagnosticos
WHERE 
CI= '".$myrow['CI']."'

 ";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	  ?>
	  
	       <td width="97" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
		   
		   <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];?>
		   </span></td>
        <td width="85" height="20" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"> <?php echo $myrow['CI']?> </span></td>
        <td width="320" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7"><?php echo $myrow4['descripcion'];


?></span></td>
        <td width="38" bgcolor="<?php echo $color?>" class="Estilo24">
		

		
		<a href="<?php echo $_SERVER['PHP_SELF'];?>?ci=<?php echo $myrow['CI']; ?>&keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>&inactiva=<?php echo $inactiva;?>"> <img src="../../../imagenes/iconosSima/delete_icon.jpg" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar &eacute;ste C&oacute;digo Internacional?') == false){return false;}" /></a></td>
      </tr>
      <?php  }}
	
	if(!$a){
	$a='0';
	}
	?>
      <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
    </table>
</form>
  </body>
</html>
