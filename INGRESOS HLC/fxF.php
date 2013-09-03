<?PHP require("menuOperaciones.php"); ?>
<?php
if(($_POST['previzualizar'] or $_POST['aplicarFactura']) and $_POST['folioFactura']){
$sSQL3d= "Select numFactura From facturasAplicadas WHERE numFactura = '".$_POST['folioFactura']."' ";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);
}
?>














<?php 
$ventanaCenter=new windowCenter();
echo $ventanaCenter->mainmenu();
?>





<?php if($_POST['load'] ){

$sSQL8aa3= "
SELECT max(contador)+1 as n
FROM
contadorFacturas
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO contadorFacturas (
usuario,contador,entidad
) values (
'".$usuario."','".$n."','".$entidad."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>

<script>
javascript:wopen('../ventanas/divideParticular.php?numSolicitud=<?php echo $n;?>', 'popup', 800, 600);
window.opener.document.forms["form1"].submit();
//window.location = 'dividirCuentas.php'
self.close();
</script>
<?php 
}

?>









<!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" />

  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>

 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>


	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
    <?php
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

</head>



<BODY  >

<h1 align="center" >Facturacion Particular</h1>
<p align="center" >&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
  <table width="582" >
    <tr>

      <td width="407"  scope="col"><div align="center">
         <span >

        <input type="submit" name="load" id="button" value="Cargar Folio(s)" />
        </span>

          </div>      </td>
    </tr>


  </table>
  </form>

<p align="center">



</body>
</html>