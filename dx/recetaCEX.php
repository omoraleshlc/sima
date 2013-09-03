<?PHP include("/configuracion/ventanasEmergentes.php"); ?><?PHP include("/configuracion/funciones.php"); ?>
<?php
$numeroE=$_GET['numeroExpediente'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$keyCAP=$_GET['keyCAP'];
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=400,height=200,scrollbars=YES") 
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




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
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

  <p>  
    <?php	

$sSQL= "SELECT receta
FROM dx
WHERE
keyCAP='".$keyCAP."' 
and
numeroE='".$numeroE."'
ORDER BY keyDiagnostico DESC
";


$result=mysql_db_query($basedatos,$sSQL);

?>
    <span class="style121"><span class="style7">
    <input name="numeroE" type="hidden" id="numeroE" value="<?php  echo $numeroE; ?>" />
    </span></span> </p>
  <form id="form2" name="form2" method="get" action="">
    <table width="238" border="0" align="center">
      <tr>
        <th width="232" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style11">Recetas</span></div></th>
      </tr>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";


if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



?>
        <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="style12"><span class="style7">
		
		<?php echo $myrow['receta']; ?>

		</span></span></td>
      </tr>
      <?php }?>
    </table>
    <p align="center">&nbsp;    </p>
</form>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>

</body>
</html>