<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php

$codModulo=$_GET['codModulo'];
$usuario1=$_GET['usuario1'];




if($_POST['actualizar'] AND $_POST['codSM'] ){ 
$codSM=$_POST['codSM'];


for($i=0;$i<=$_POST['bandera'];$i++){

if($codSM[$i]){
 $sSQL3= "Select * From usuariosSubmodulos WHERE entidad='".$_GET['entidad']."' AND
codSM = '".$codSM[$i]."'
and 
codModulo='".$codModulo."'
and
usuario1='".$usuario1."'
";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

if(!$myrow3['codSM']){
$agrega = "INSERT INTO usuariosSubmodulos (
codSM,codModulo,usuario1,usuario,fecha,hora,entidad
) values (
'".$codSM[$i]."',
'".$codModulo."',
'".$usuario1."','".$usuario."','".$fecha1."','".$hora1."','".$_GET['entidad']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se agregaron registros...';
} else {
$tipoMensaje='error';
$encabezado='Exitoso';
$texto='Ya existe ese modulo...';
}
}
}


}
//****************************************************************************************************************************















if($_POST['borrar'] AND  $_POST['quita']){
$quitar=$_POST['quita'];


for($i=0;$i<=$_POST['bandera'];$i++){
if($quitar[$i]){
$borrame = "DELETE FROM usuariosSubmodulos WHERE keyUSM='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se elimino el modulo...';
}

}

}

?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=630,height=440,scrollbars=NO") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>
<body>
<p align="center">
  <label></label>
  <span class="normal">Usuarios Sub-M&oacute;dulos </span></p>
<p align="center" ><span class="normal">M&oacute;dulo principal:</span> <span class="style26"><?php echo $codModulo;?></span></p>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
      
         <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
      
  </div>
  </label>
  <table width="568" border="0" align="center" style="border: 1px solid #000000;">
    <tr>
      <th width="119"><div align="left"><span class="normal">C&oacute;digo</span></div></th>
      <th width="348"><span class="normal">Descripci&oacute;n del M&oacute;dulo </span></th>
      <th width="47" ><span class="normal">Agregar</span></th>
      <th width="36" ><span class="normal">Quitar</span></th>
    </tr>
    <tr>
      <?php   

/* $sSQL= "Select codModulo From subModulos where
keyMU='".$_GET['keyMU']."' ";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result)){
$codModulo=	  $myrow['codModulo']; */

$sSQL= "Select * From subModulos where
codModulo='".$codModulo."' order by codSM ASC ";
$result=mysql_db_query($basedatos,$sSQL); 

while($myrow = mysql_fetch_array($result)){
$codSM=	  $myrow['codSM'];


$bandera += 1;
$codModulo = $myrow['codModulo'];
$sSQL2= " Select * From usuariosSubmodulos
WHERE
entidad='".$_GET['entidad']."'
and
codSM='".$codSM."'
and
usuario1='".$usuario1."' 
and
codModulo ='".$codModulo."' 
";
$result2=mysql_db_query($basedatos,$sSQL2); 
$myrow2 = mysql_fetch_array($result2);
?>

        <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#CCCCCC'" onMouseOut="bgColor='#ffffff'" >
      <td height="24"  class="normal"><div align="left">
              <span class="normal"><?php echo $myrow['codSM'];?>
              </span>
          </div>
      </td>

      <td  class="normal"><span class="normal"><?php echo $myrow['subModulo'];?></span></td>
      <td class="normal">
        <label>
        <?php if(!$myrow2['codSM']){ ?>
        <input name="codSM[]" type="checkbox" class="normal" id="codSM[]"
		value="<?php 
		echo $myrow['codSM'];
		?>" />
        <?php } else {   echo "--- "; }?>
        </label>
     </td>
      <td  class="normal">
	  
	  
	  <?php if($myrow2['codSM']){ ?>
        <input name="quita[]" type="checkbox" id="quita[]" value="<?php echo $myrow2['keyUSM']?>"/>
        <?php } else {   echo "--- "; }?></td>
    </tr>
    <?php }?>
  </table>
  <p align="center">
      <span class="normal">
    <input name="tope" type="hidden" id="tope" value="<?php echo $nCliente; ?>" />
    <input name="moduloRaiz1[]" type="hidden" id="moduloRaiz1[]" value="<?php echo $myrow['raiz']; ?>" />
    <input name="modes[]" type="hidden" id="modes[]" value="<?php echo $myrow['modulos']; ?>" />
    <input name="bandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
  </span>
    <input name="actualizar" type="submit" class="normal" id="actualizar" value="Agregar M&oacute;dulos" />
    <label></label>
    <input name="borrar" type="submit" class="normal" id="borrar" value="Eliminar/Borrar" />
  </p>
  <p align="center">&nbsp; </p>
</form>


</body>
</html>
