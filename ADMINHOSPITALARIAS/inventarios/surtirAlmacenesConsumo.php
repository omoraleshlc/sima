<?PHP require("/configuracion/administracionhospitalaria/inventarios/inventariosmenu.php");require("/configuracion/funciones.php");?>

  <script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
    */
    var tecla;
    function capturaTecla(e)
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which;
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }
    document.onkeydown = capturaTecla;
</script>


<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES")
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>
<style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
-->
</style>
</head>



<META HTTP-EQUIV="Refresh"
CONTENT="100">
<body>



 <form id="form1" name="form1" method="post" action="#">
  <h1 align="center"><?php echo $titulo;?></h1>


  <p align="center">
  SURTIR A ALMACENES
  </p>

  <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="6"><img src="../../imagenes/bordestablas/borde1.png" width="400" height="21" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="10" class="negromid">#Sol</td>

      <td width="50" class="negromid">Procedencia</td>
      <td width="20" class="negromid">Usuario</td>
<td width="20" class="negromid">Fecha</td>
    </tr>
<?php
$sSQL= "
SELECT *
FROM
faltantes
where

entidad='".$entidad."'
and
almacenConsumo='si'
and
status='request'
";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){


$fV[0]=$myrow['folioVenta'];
$sSQL8aa= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
    and

 almacen='".$myrow['almacen']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);
?>

	  <tr bgcolor="#ffffff" onmouseover="bgColor='#cccccc'" onmouseout="bgColor='#ffffff'" >
      <td height="48" class="codigos"><?php echo $myrow['keyF'];?></td>
      <td class="normalmid"><span class="normal">
 <a href="#"  onclick="javascript:ventanaSecundaria('surtir.php?solicitud=<?php echo $myrow['keyF'];?>&almacenSolicitante=<?php echo $myrow['almacen'];?>&usuario=<?php echo $myrow['usuario'];?>')">
        <?php

		echo $myrow8aa['descripcion'];
		?>
      </a> </span></td>



      <td class="normal"><?php echo $myrow['usuario'];?></td>
     <td class="normal"><?php
     echo cambia_a_normal($myrow['fecha1']);
     echo '</br>';
     echo $myrow['hora1'];
     ?>
     </td>
    </tr>
    <?php  }?>
    <tr>
      <td colspan="6"><img src="../../imagenes/bordestablas/borde2.png" width="400" height="20" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center"><span class="style7">

  </span></p>
</form>
</body>
</html>

