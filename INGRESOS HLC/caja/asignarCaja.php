<?php include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=400,height=190,scrollbars=YES") 
} 
</script> 

<?php  
if($_GET['usuario'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
 $q = "DELETE from  usuariosCaja 
		WHERE entidad='".$entidad."' AND
		usuario='".$_GET['usuario']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		echo 'Registro eliminado';
	} 


}
?>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=300,height=200,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style12 {font-size: 14px}
.estilo25 {font-size:20px}
.style11 {color: #000; font-size: 14px; font-weight: normal; }
.style7 {font-size: 14px}
.Estilo24 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
.style71 {font-size: 14px}
-->
</style>
</head>

<body>
<h3 align="center"><strong>Asignar a un usuario Caja </strong></h3>
<form id="form1" name="form1" method="post" action="">
<?php	
/* $cmdstr1 = "select * from PEDRO.TIPO_USUARIO,PEDRO.USUARIO WHERE 
PEDRO.USUARIO.ID_TIPO=PEDRO.TIPO_USUARIO.ID_TIPO 
order by PEDRO.USUARIO.NOMBRE ASC";
$parsed1 = ociparse($db_conn, $cmdstr1);
ociexecute($parsed1);	 
$nrows1 = ocifetchstatement($parsed1, $results1);  */
?>
  <img src="../../imagenes/bordestablas/borde1.png" width="665" height="24" />
  <table width="665" border="0" align="center" cellpadding="5" cellspacing="0">
    <tr>
      <th width="152" height="0" bgcolor="#FFFF00" scope="col"><span class="style11">ID Usuario/Username</span></th>
      <th width="258" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">Nombre, Apellido(s) </span></div></th>
      <th width="52" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">Caja</span></div></th>
      <th width="45" bgcolor="#FFFF00" scope="col"><div align="left"><span class="style11">Lista</span></div></th>
      <th width="67" bgcolor="#FFFF00" scope="col"><span class="style11">Modifica</span></th>
      <th width="65" bgcolor="#FFFF00" scope="col"><span class="style11">Status</span></th>
    </tr>
    <tr>
	<?php 
$sSQL81= "
SELECT 
 *
FROM
usuarios
where 
entidad='".$entidad."'
order by aPaterno asc
";
if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){ 
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$E=$myrow81['usuario'];

$sSQL1= "Select codigoCaja From usuariosCaja where entidad='".$entidad."' and usuario='".$E."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
?>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7">
        <label><span class="<?php echo $estilo;?>">
		<?php echo $E;?></span> </label>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="style7"><span class="<?php echo $estilo;?>">
	  <?php echo $myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];
	?></span>
      </span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><span class="<?php echo $estilo;?>"><?php 
	  if($myrow1['codigoCaja']){
	  echo 'Activa';
	  } else {
	  echo '---';
	  }
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><a href="#"  onclick="ventanaSecundaria2('despliegaUsuariosCajas.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E?>')"><img src="/sima/imagenes/listado.jpg"  width="12" height="12" border="0" /></a></td>
      <td bgcolor="<?php echo $color;?>" class="style12">
	  <a onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Estás modificando al usuario: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()" href="javascript:ventanaSecundaria('ventanaAsignaCaja.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;us=<?php echo $E; ?>')"><img src="/sima/imagenes/expandir.gif" alt="Ajustar " width="12" height="12" border="0" /></a></td>
      <td bgcolor="<?php echo $color;?>" class="style12"><div align="center"><span class="style71">
     
        <a
			   href="<?php echo $_SERVER['PHP_SELF'];?>?codigo5=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo "inactiva"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C?>&amp;criterio=<?php echo $_GET["criterio"];?>&amp;gpoProducto=<?php echo $_POST['gpoProducto1'];?>&amp;almacenDestino=<?php echo $_POST['almacenDestino'];?>&amp;almacenDestino1=<?php echo $_POST['almacenDestino1'];?>&amp;gpoProducto1=<?php echo $_POST['gpoProducto1'];?>"> <img src="/sima/imagenes/candado.png" alt="INACTIVO" width="12" height="12" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
      
      </span></div></td>
    </tr>
    <?php }}?>
  </table>
  <img src="../../imagenes/bordestablas/borde2.png" width="665" height="24" />
</form>
<p>&nbsp;</p>
</body>
</html>
