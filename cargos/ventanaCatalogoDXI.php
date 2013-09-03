<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 
<?php


if($_POST['guarda'] AND $_POST['CI'] and $_POST['descripcion'] ){
$sSQL1= "Select * From diagnosticos WHERE entidad='".$entidad."' and CI= '".$_POST['CI']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['CI']){

$agrega = "INSERT INTO diagnosticos (
CI,descripcion,usuario,fecha,entidad

) values ('".$_POST['CI']."','".$_POST['descripcion']."',
'".$usuario."','".$fecha1."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();

echo 'Se agregó el código Internacional';


} else {



$q = "UPDATE diagnosticos set 

descripcion='".$_POST['descripcion']."', 
usuario='".$usuario."',
fecha='".$fecha1."'

WHERE 
entidad='".$entidad."'
and
CI='".$_POST['CI']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se Modificó el CI';

} //cierra validacion de existencia

echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';
}


















$sSQL2= "Select * From diagnosticos WHERE keyDiagnosticos='".$_GET['keyDiagnosticos']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

?>
<script language=javascript> 
function ventanaSecundaria15 (URL){ 
   window.open(URL,"ventana15","width=500,height=500,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style12 {font-size: 10px}
.style15 {color: #FFCCFF}
.Estilo24 {font-size: 10px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.style71 {font-size: 9px}
.Estilo241 {font-size: 10px}
.Estilo241 {font-size: 10px}
.Estilo29 {font-size: 10px}
.Estilo29 {font-size: 10px}
.Estilo30 {font-size: 10px}
.Estilo30 {font-size: 10px}
.style112 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style112 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style111 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style111 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style113 {font-size: 10px}
.style113 {font-size: 10px}
-->
</style>
</head>

<body>
<form id="form2" name="form2" method="post" action="" >
   <p>
     <label></label></p>
   <table width="429" border="0" align="center">
     <tr>
       
       <th width="109" bgcolor="#FFCCFF" class="style12" scope="col">
	   <div align="left">CI</div></th>
       <th width="304" bgcolor="#FFCCFF" class="style12" scope="col">
         <div align="left">
           <input name="CI" type="text" class="style12" id="CI" value="<?php echo $myrow2['CI']?>" 
size="10" <?php if($myrow2['CI']){ echo 'readonly=""';}?>/>
       </div></th></tr>
     <tr>
       <td class="style12">Descripci&oacute;n :</td>
       <td class="style12"><input name="descripcion" type="text" class="style12" id="descripcion" 
	   value ="<?php echo $myrow2['descripcion']?>" size="60"/></td>
     </tr>
  </table>

   <p align="center">
     <label>
     <input name="guarda" type="submit" class="style7" id="guarda" value="Guardar" />
     </label>
  </p>
</form>








      <div align="center">
        <?php


$sSQL= "
SELECT * FROM 
diagnosticos 
where 
fecha='".$fecha1."' and
entidad='".$entidad."'

order by 
descripcion DESC
";



$result=mysql_db_query($basedatos,$sSQL);

?> Ultimos C&oacute;digos Internacionales Agregados HOY
      </div>
      <table width="398" border="0" align="center">
  <tr>
    <th width="49" height="19" bgcolor="#660066" scope="col"><div align="left"><span class="style112">C&oacute;digo</span></div></th>
    <th width="446" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Descripci&oacute;n</span></div></th>
    <th width="35" bgcolor="#660066" scope="col"><div align="left"><span class="style111">Editar</span></div></th>
  </tr>
  <tr>
    <?php 

while($myrow = mysql_fetch_array($result)){ 
$nombrePaciente = $myrow['nombre1']." ".$myrow['nombre2']." ".$myrow['apellido1']." ".
$myrow['apellido2']." ".$myrow['apellido3'];
$bandera+="1";


//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$NUMEROE=$myrow['numCliente']; 
$sSQL31= "Select  * From clientesInternos WHERE numeroE = '".$NUMEROE."' and statusCuenta='abierta'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>
    <td height="24" bgcolor="<?php echo $color;?>" class="Estilo241"><span class="style7"> <a href="#"  onclick="javascript:regresar('<?php echo $myrow['CI'];?>','<?php echo $myrow['descripcion'];?>')">
      <?php 
			echo $myrow['CI'];
		
		  ?>
    </a> </td>
    <td bgcolor="<?php echo $color;?>" class="Estilo241"><span class="Estilo29"><span class="Estilo30">
      <?php 
			echo $myrow['descripcion'];
		
		  ?>
    </span></span></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo241"><span class="style113"> <a href="javascript:ventanaSecundaria15('/sima/cargos/ventanaCatalogoDXI.php?campoDespliega=<?php echo "nomSeguro"; ?>&forma=<?php echo "F"; ?>&keyDiagnosticos=<?php echo $myrow['keyDiagnosticos']; ?>&seguro=<?php echo $_POST['seguro']; ?>')"><img src="/sima/imagenes/Save.png" alt="Modificar Codigo Internacional" width="19" height="19" border="0" /></a></span></td>
  </tr>
  <?php }?>
</table>
</body>
</html>
