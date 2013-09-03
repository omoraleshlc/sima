<?php include("/configuracion/ventanasEmergentes.php"); ?><?php include("/configuracion/funciones.php"); ?>
<script type="text/javascript">
	function regresar(folio){
		self.opener.document.<?php echo 'form1';?>.<?php echo 'folio';?>.value = folio;
		close();
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
.Estilo24 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
</head>

<body>
<p align="center">&nbsp;</p>
<?php 
$sSQL3= "Select * From clientesInternos WHERE numeroE = '".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$statusAlta= $myrow3['statusAlta'];



$sSQL34= "Select * From cargosCuentaPaciente WHERE entidad='".$entidad."' and numeroE = '".$_GET['numeroE']."' and nCuenta='".$_GET['nCuenta']."'";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);
?>

<?php if($_GET['Submit'] and $_GET['folio']){ ?>
<script>
  <!--
regresar('<?php echo $_GET['folio'];?>');
window.opener.document.forms["form1"].submit();

  // -->
</script>
<?php } ?>
<?php echo $_POST['folio'];?>
<form id="form1" name="form1" method="GET" action="">
  <table width="222" border="0" align="center">
    <tr>
      <th width="216" height="19" bgcolor="#660066" scope="col"><span class="style11"># FOLIO </span></th>
    </tr>
    <tr>
      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24">&nbsp;</td>
    </tr>
    <tr>
  

      <td height="24" bgcolor="<?php echo $color;?>" class="Estilo24"><label>
        <div align="center">
          <input name="folio" type="text" class="Estilo24" id="folio"  onKeyPress="return checkIt(event)"/>
          </div>
      </label></td>
    </tr>
  </table>
  <tr>
    <td>
    
      <div align="center">
        <label>
<input name="Submit" type="submit" class="Estilo24" value="Cargar" >
        </label>
      </div>
  </form>
<p>&nbsp; </p>
</body>
</html>
