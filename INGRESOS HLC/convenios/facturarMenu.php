<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=900,height=800,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria511a (URL){ 
   window.open(URL,"ventanaSecundaria511a","width=800,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria511b(URL){ 
   window.open(URL,"ventanaSecundaria511b","width=800,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=300,scrollbars=YES") 
   
} 
</script>
<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventana11","width=900,height=600,scrollbars=YES") 
} 
</script>



<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>
<style type="text/css">
<!--
.style7 {font-size: 9px}
.style8 { background-color:#990033;font-size: 9px; color:#FFFFFF; border-bottom-color:#0000FF; display:block}
-->
</style>
<div align="center">

  <p>
  <?php //echo $ALMACEN;?>
  &nbsp;</p>
  <p>&nbsp;</p>
  <table width="200" border="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td><input onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aquí para hacer notas de cargo..';?></div>')" onmouseout="UnTip()" name="nuevo" type="image"  id="nuevo" value="Cargos a Pacientes" src="/sima/imagenes/btns/new_cargos.png"
	  onclick="ventanaSecundaria1('<?php echo $ventana1;?>?cargos=cargos&almacen=<?php echo $ALMACEN;?>')" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input onmouseover="Tip('<blink><div class=&quot;estilo25&quot;><?php echo 'Este botón es para agregar cargos a pacientes que tienen un paquete..';?></div></blink>')" onmouseout="UnTip()" name="nuevo2" type="image"  id="nuevo2" src="/sima/imagenes/btns/new_paq.png" value="Pacientes por Paquetes"
	  onclick="ventanaSecundaria10('<?php echo $ventana1;?>?paquetes=paquetes&almacen=<?php echo $ALMACEN;?>')" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para ver las notas de cargo y su estado actual..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo3" type="image" src="/sima/imagenes/btns/new_lista.png" id="nuevo3"  onclick="ventanaSecundaria11('<?php echo $ventana11;?>?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Presiona aquí para ver los servicios recibidos..';?></div>')" onmouseout="UnTip()" name="nuevo22" type="image" src="/sima/imagenes/btns/new_service.png" id="nuevo22" value="Listado de Pacientes"
	  onclick="ventanaSecundaria11('/sima/cargos/aplicarServicios.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para consultar saldos ..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo42" type="image" src="/sima/imagenes/btns/new_consulta.png" id="nuevo42" value="Consultar Saldos "
	  onclick="ventanaSecundaria11('/sima/cargos/consultarSaldo.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para ver los paquetes ..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo4" type="image" src="/sima/imagenes/btns/new_venta.png" id="nuevo4" value="Venta de Paquetes"
	  onclick="ventanaSecundaria11('/sima/cargos/ventaPaquetes.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" /></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="37%" border="0" cellspacing="0" cellpadding="0">
    <tr valign="middle">
      <td width="34%"><div align="center"></div></td>
      <td width="36%"><div align="center"></div></td>
      <td width="30%"><div align="center"></div></td>
      <td width="30%">&nbsp;</td>
     
     
     
      <td width="30%">&nbsp;</td>
      <td width="30%"><div align="center"></div></td>
    </tr>
  </table>
  
  
<?php   
  $sSQLu= "Select puntoVenta From almacenes where almacen='".$ALMACEN."'";
$resultu=mysql_db_query($basedatos,$sSQLu); 
$myrowu = mysql_fetch_array($resultu);
if($myrowu['puntoVenta']=='si') { ?>

  <p>
    <label>
   
    <input type="submit" name="button" id="button" value="Apertura de Caja" onclick="ventanaSecundaria511('aperturaCajaModulos.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>')" />
    </label>
   
   
    <input type="submit" name="button2" id="button2" value="Corte de Caja" onclick="ventanaSecundaria511a('corteCajaModulo.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>')" />
    
    
    <input type="submit" name="button3" id="button3" value="Lista de Ordenes Pendientes" onclick="ventanaSecundaria511b('listadoOrdenesCaja.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&almacen=<?php echo $ALMACEN;?>')" />
  </p>
  <?php } ?>
  
  
  <p> 
</div>
