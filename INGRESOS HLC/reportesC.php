<?PHP require("menuOperaciones.php"); 
require("/configuracion/clases/listaClientes.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=550,height=400,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>  


<?php 
$ventanaCentro=new ventanasCentro();
$ventanaCentro->despliegaVentanaCentro('blue','0.5','800','600','800','400','800','500');
?>



<?php 
if($_POST['actualizar'] AND $_POST['numCliente']){
$sSQL1= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente']."' ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
if($_POST['numCliente']!=$myrow1['numCliente']){
$agrega = "INSERT INTO clientes (
numCliente,nomCliente,usuario,fecha,nivel,entidad
) values ('".$_POST['numCliente']."','".$_POST['nomCliente']."',
'".$usuario."','".$fecha1."','".$_POST['nivel']."','".$_POST['ID_AUXILIAR']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE DIO DE ALTA AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);

  // -->
</script>';
} else {
echo $q = "UPDATE clientes set 
nomCliente='".$_POST['nomCliente']."',
nivel='".$_POST['nivel']."',
ID_AUXILIAR='".$_POST['ID_AUXILIAR']."',
usuario='".$usuario."',
fecha='".$fecha1."'
WHERE entidad='".$entidad."' AND
numCliente='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE ACTUALIZO AL CLIENTE"
</script>';
echo '<script language="JavaScript" type="text/javascript">
  <!--
    opener.location.reload(true);

  // -->
</script>';
}}

if($_POST['borrar'] AND $_POST['numCliente']){
$borrame = "DELETE FROM clientes WHERE entidad='".$entidad."' AND numCliente ='".$_POST['numCliente']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "CLIENTE ELIMINADO"
</script>';

}

if($_POST['nuevo']){
/** checo si existe**/
$_POST['numCliente'] = "";
}


if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>


 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php 
$estilo= new muestraEstilos();
$estilo->styles();
?>
</head>

<body onLoad="inicio();">
 <p align="center" class="titulos">Lista de Convenios  </p>
 <form id="form2" name="form2" method="post" action="">
    <table width="775" class="table table-striped" >

      <tr>
        <th width="57" height="25" >#</th>
        <th width="316" >Nombre del Cliente</th>
        <th width="53" align="center" >Grupo</th>
        <th width="64" align="center" >Art&iacute;culos</th>
        <th width="61" align="center" >Globales</th>
        <th width="75" align="center" >Especiales </th>
        <th width="60" align="center" >Vencidos</th>
        <th width="89" align="center" >DConvenios</th>
      </tr>
      <?php   


 $sSQL= "Select * From 
 convenios,clientes where (clientes.entidad='".$entidad."' and convenios.entidad='".$entidad."')
 AND
 clientes.numCliente=convenios.numCliente
 and 
 convenios.costo!=''
 group by clientes.numCliente

 order by clientes.nomCliente ASC";
 

$result=mysql_db_query($basedatos,$sSQL); 
?>
     <tr >
       <?php	while($myrow = mysql_fetch_array($result)){

$N=$myrow['numCliente'];
?>
      
      <tr  >
        <td height="25" ><?php echo $a[0]+=1;?></span></td>
        <td ><?php echo $myrow['nomCliente'];?></td>
        <td align="center">
          <?php
$sSQL2= "Select tipoConvenio From convenios WHERE entidad='".$entidad."' AND numCliente = '".$myrow['numCliente']."' and tipoConvenio='grupoProducto'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);

	   if( $myrow2['tipoConvenio']){?>
          <a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Lista de convenios de: '.$myrow['nomCliente'].' por GRUPO DE PRODUCTOS...';?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('despliegaGP.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><img src="../imagenes/btns/checkbtn.png"  width="20" height="20" border="0" /></a>
          <?php } else { 
	   echo '---';
	   }
	   ?>
        </span></td>
        <td align="center">
          <?php 
		$sSQL2= "Select tipoConvenio From convenios WHERE entidad='".$entidad."' AND numCliente = '".$myrow['numCliente']."' and tipoConvenio='cantidad'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
		if( $myrow2['tipoConvenio']){?>
          <a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Lista de convenios de: '.$myrow['nomCliente'].' por ARTICULOS...';?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('despliegaConvenios.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><img src="../imagenes/btns/checkbtn.png"   width="20" height="20" border="0" /></a>
          <?php } else { 
	   echo '---';
	   }
	   ?>
        </span></td>
        <td align="center">
          <?php 
$sSQL2= "Select tipoConvenio From convenios WHERE entidad='".$entidad."' AND numCliente = '".$myrow['numCliente']."' and tipoConvenio='global'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
		if( $myrow2['tipoConvenio']){?>
          <a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Lista de convenios de: '.$myrow['nomCliente'].' por GLOBAL...';?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('despliegaConveniosGlobales.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><img src="../imagenes/btns/checkbtn.png"   width="20" height="20" border="0" /></a>
          <?php } else { 
	   echo '---';
	   }
	   ?>
        </span></td>
        <td align="center">
          <?php 
$sSQL2= "Select tipoConvenio From convenios WHERE entidad='".$entidad."' AND numCliente = '".$myrow['numCliente']."' and tipoConvenio='precioEspecial'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
	   if( $myrow2['tipoConvenio']){?>
          <a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Lista de convenios de: '.$myrow['nomCliente'].' por CONVENIOS ESPECIALES...';?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('despliegaPreciosEspeciales.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><img src="../imagenes/btns/checkbtn.png"   width="20" height="20" border="0" /></a>
          <?php } else { 
	   echo '---';
	   }
	   ?>
        </span></td>
<td align="center">
<?php        
$sSQLa= "SELECT 
convenios.numCliente from convenios,articulos
where
(convenios.entidad='".$entidad."'
and
convenios.numCliente='".$myrow['numCliente']."'
and
convenios.fechaFinal<='".$fecha1."'
and
convenios.departamento!='')
AND
(
articulos.entidad='".$entidad."'
    and
    convenios.codigo=articulos.codigo
    and
    articulos.activo='A'
)

order by 
convenios.departamento ASC
 ";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);

if($myrowa['numCliente']){
?>
          <a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Lista de convenios de: '.$myrow['nomCliente'].' por CONVENIOS VENCIDOS...';?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('conveniosVencidos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"> <img src="../imagenes/btns/cancelabtn.png"   width="20" height="20" border="0" /></a>
        <?php } else { 
	   echo '---';
	   }
	   ?></td>
        <td align="center">
          <?php if( $myrow['tipoConvenio']=='descuentoConvenio'){?>
          <a href="#" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Lista de convenios de: '.$myrow['nomCliente'];?>&lt;/div&gt;')" onMouseOut="UnTip()" onClick="ventanaSecundaria2('despliegaDescuentosConvenios.php?numeroE=<?php echo $myrow['numeroE'].' por DESCUENTOS...'; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><img src="../imagenes/btns/checkbtn.png"  width="20" height="20" border="0" /></a>
          <?php } else { 
	   echo '---';
	   }
	   ?>
        </span></td>
      </tr>
	  <?php }?>

    </table>
    <p>&nbsp;</p>

</form>

</body>
</html>