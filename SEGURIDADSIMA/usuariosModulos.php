<?php require("/configuracion/seguridadsima/seguridadmenu.php"); require("/configuracion/funciones.php");?>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=630,height=800,scrollbars=YES")
}
</script>



<script>
    var myWindow;

function openCenteredWindow(url) {
    var width = 400;
    var height = 300;
    var left = parseInt((screen.availWidth/2) - (width/2));
    var top = parseInt((screen.availHeight/2) - (height/2));
    var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
    myWindow = window.open(url, "subWind", windowFeatures);
}
</script>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
    
<p align="center" class="normalmid">
    Usuarios Modulos
</p>
    
    
<form id="form1" name="form1" method="post" >
 
    <p>

    <span class="normalmid">
    <?php require("/configuracion/componentes/comboEntidades.php");
	   $entidades=new despliegaEntidades();$entidades->listaEntidades($usuario,$basedatos);
	   ?>
  </span>
  </p>
    
    
  <img src="../imagenes/bordestablas/borde1.png" width="400" height="24" />
  <table width="400" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFF00"  style="border: 0px solid #000000;">
    <tr bgcolor="#FFFF00">
        <td width="5" align="center" class="negromid">Usuario</td>
      <td width="50" align="center" class="negromid">Usuario</td>
      <td width="200" class="negromid">Nombre, Apellido(s)</td>
      <td width="200" class="negromid">Fecha Ingreso</td>
      <td width="200" class="negromid">Fecha Salida</td>
    </tr>
      
      
    <?php

if($_POST['entidades']){
$sSQL81= "
SELECT
 *
FROM
usuarios
where
entidad='".$_POST['entidades']."'
order by aPaterno asc
";
if($result81=mysql_db_query($basedatos,$sSQL81)){
while($myrow81 = mysql_fetch_array($result81)){
$a+=1;
$E=$myrow81['usuario'];
?>
  
      <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
                <td><span class="normal"><?php echo $a;?></span></td>
      <td><span class="normal"><?php echo $E;?></span></td>
      
      <td><span class="normal">
	  
	  <?php echo $myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?>
    </td>
      
      <td><span class="normal">
<?php 

echo cambia_a_normal($myrow81['fechaIngreso']);
?>

          </span></td>
      
      
      <td><span class="normal">
<?php 

echo cambia_a_normal($myrow81['fechaSalida']);
?>
          </span></td>
    
      
            <td><span class="normal">
                    <a href="javascript:ventanaSecundaria('ventanaUsuariosModulos.php?entidades=<?php echo $_POST['entidades'];?>&codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
          </span></td>
      
    </tr><?php }}}?>
  </table>
  <img src="../imagenes/bordestablas/borde2.png" width="400" height="21" />
<p>&nbsp;</p>

  </form>

  <p align="center">
    <input name="nuevo" type="button" class="style7" id="nuevo" value="Nuevo Usuario"  onclick="javascript:ventanaSecundaria('modificaUsuarios.php?nuevo=si&codigo=<?php echo $s; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $sE; ?>')"/>
  </p>    
    

</body>
</html>
