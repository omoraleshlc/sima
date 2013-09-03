<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>



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
Escoje el Almacen
<?php





$aCombo= "SELECT
almacenSolicitante
FROM
faltantes
WHERE
entidad='".$entidad."'
and
status='request'
and
tipoVenta='Granel'
group by almacenSolicitante
";
$rCombo=mysql_db_query($basedatos,$aCombo);
?>


     <select name="almacenDestino"  id="almacenDestino" onChange="this.form.submit();" />
     <option
	 	<?php
		if( !$_POST['almacenDestino']){

		echo 'selected="selected"';
		}

                ?>
	  value="">Escoje</option>

        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$aCombo1= "Select descripcion From almacenes where entidad='".$entidad."' AND
almacen='".$resCombo['almacenSolicitante']."'
order by descripcion ASC";
$rCombo1=mysql_db_query($basedatos,$aCombo1);
$resCombo1 = mysql_fetch_array($rCombo1);
		?>
        <option
		<?php
if($_POST['almacenDestino'] ==$resCombo['almacenSolicitante']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacenSolicitante']; ?>"><?php echo $resCombo1['descripcion']; ?></option>
        <?php } ?>
        </select>

  
  </p>

  
  <?php if($_POST['almacenDestino']!=NULL){?>
  <table width="527" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="6"><img src="../../imagenes/bordestablas/borde1.png" width="527" height="24" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="51" class="negromid">#</td>

      <td width="243" class="negromid">Articulo</td>
     
<td width="102" class="negromid">Cantidad</td>
<td width="131" class="negromid">Cantidad Resurtir</td>
<td width="13" class="negromid">---</td>
    </tr>
<?php
$sSQL= "
SELECT *
FROM
faltantes
where

entidad='".$entidad."'
and
status='request'
and
almacenSolicitante='".$_POST['almacenDestino']."'
and
tipoVenta='Granel'
group by keyPA

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

$sSQLa= "
SELECT sum(cantidad) as s
FROM
faltantes
WHERE
entidad='".$entidad."'
and
keyPA='".$myrow['keyPA']."'
and
status='request'
and
tipoVenta='Granel'
";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);

 $sSQL8aab= "
SELECT cantidadSurtir
FROM
existencias
WHERE
entidad='".$entidad."'
    and

 almacen='".$_POST['almacenDestino']."'
and
keyPA='".$myrow['keyPA']."'
";
$result8aab=mysql_db_query($basedatos,$sSQL8aab);
$myrow8aab = mysql_fetch_array($result8aab);
?>

	  <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><?php echo $myrow['keyPA'];?></td>
      
      <td class="normalmid">
          <span class="normal">
        <?php
		echo $myrow['descripcion'];                
		?>          
          <?php echo '<br>';
                echo 'Usuario: '. $myrow['usuario'];?>
          </span>
      </td>




     <td class="normal">
     <?php
     echo $myrowa['s'];     
     ?>
     </td>
      
     <td class="normal"><?php
     echo $myrow8aab['cantidadSurtir'];     
     ?>
     </td>
      
      <?php $r=$myrowa['s']-$myrow8aab['cantidadSurtir'];?>
      
<td class="normal">
<?php if($r>=0){?>
<a href="articulosGranel.php?" onMouseover="showhint('Presiona aqui para surtir...', this, event, '150px')">
Surtir
</a>
<?php 
}else{
echo 'Falta Llenar!';    
}?> 
    
</td>
      
      
    </tr>
    <?php  }?>
    <tr>
      <td colspan="6"><img src="../../imagenes/bordestablas/borde2.png" width="527" height="24" /></td>
    </tr>
  </table>
  <?php }?>
  <p>&nbsp;</p>
  <p align="center"><span class="style7">

  </span></p>
</form>
</body>
</html>
