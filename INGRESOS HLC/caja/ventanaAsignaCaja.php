<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<?php 
$estilos=new muestraEstilos();
$estilos->styles();


if($_POST['actualizar'] and $_GET['us'] and $_POST['codigoCaja']){
$sSQL1= "Select * From usuariosCaja where entidad='".$entidad."' and usuario='".$_GET['us']."' and codigoCaja='".$_POST['codigoCaja']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);





if(!$myrow1['usuario'] ){
$agregados = "INSERT INTO usuariosCaja ( usuario,
entidad,codigoCaja
) values (
'".$_GET['us']."','".$entidad."',
'".$_POST['codigoCaja']."'


)";
mysql_db_query($basedatos,$agregados);
echo mysql_error();
echo 'se agregó el usuario';
echo '<script>';
echo 'window.opener.document.forms["form1"].submit();';
echo '</script>';
} else {
echo '<span class="informativo">'.'<blink>'.'Ya tiene la caja '.$myrow1['codigoCaja'].' asgnada...'.'</blink>'.'</span>';
}

if(!$myrow1['usuario'] ){

}
}
?>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.Estilo241 {font-size: 12px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
-->
</style>


</head>
<form name="form1" method="post" action="">
  <p align="center">Asignale la caja al usuario </p>
  <table width="195" border="4" align="center" class="style7">
    <tr>
      <td colspan="2" bgcolor="#660066"><span class="style13">
	  
<?php 
 $sSQL415="select *
FROM
usuarios
WHERE
entidad='".$entidad."'
and
usuario='".$_GET['us']."'";
$result415=mysql_db_query($basedatos,$sSQL415);
$myrow415 = mysql_fetch_array($result415);
echo 'Usuario: '.$myrow415['nombre'].' '.$myrow415['aPaterno'].' '.$myrow415['aMaterno'];


$sSQL31= "Select  * From usuariosCaja WHERE 
entidad='".$entidad."'
and
usuario= '".$_GET['us']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>


</span></td>
    </tr>
    <tr>
      <td width="45">Caja</td>
      <td width="401">
	  <?php 
	  $aCombo= "Select * From catCajas where
entidad='".$entidad."'  order by descripcionCaja ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="codigoCaja" class="style7" id="codigoCaja" />                
<option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
        <option 
		<?php 
		if($myrow31['codigoCaja']==$resCombo['codigoCaja']){
		
		echo 'selected="selected"';		
		}  ?>
		value="<?php echo $resCombo['codigoCaja']; ?>"><?php echo $resCombo['descripcionCaja']; ?></option>
        <?php } ?>
        </select>
	  

	  </td>
    </tr>
  </table>
  <p align="center"><label>
    <input name="actualizar" type="submit" class="style7" id="actualizar" value="Ajustar">
    </label>
	<input type="hidden" name="numeroE" value="<?php echo $myrow415['numCliente'];?>">
	<input type="hidden" name="keyPacientes" value="<?php echo $_GET['keyPacientes'];?>">
	<input type="hidden" name="costo" value="<?php echo $_GET['costo'];?>">
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
  </p>
</form>
<p>&nbsp;</p>
