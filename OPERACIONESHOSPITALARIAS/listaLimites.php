<?PHP require("menuOperaciones.php"); ?>
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
  <p>CONSULTAR SALDOS DE ASEGURADORAS CON LIMITE DE CREDITO </p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="37%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr valign="middle">
      <td width="36%"><div align="center"></div></td>
      <td width="46%"><div align="center">
        <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para consultar saldos ..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo42" type="button" src="/sima/imagenes/btns/new_consulta.png" id="nuevo42" value="Por Persona"
	  onClick="ventanaSecundaria11('/sima/cargos/consultarSaldo.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" /> 
        
        
        
        
         <input onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para consultar saldos ..';?>&lt;/div&gt;')" onmouseout="UnTip()" name="nuevo422" type="button" src="/sima/imagenes/btns/new_consulta.png" id="nuevo422" value="Por Aseguradora"
	  onclick="ventanaSecundaria11('/sima/cargos/consultarSaldoxAseguradora.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>')" />
      </div></td>
      <td width="18%"><div align="center"></div></td>
    </tr>
  </table>
  
  
  <p> 
</div>
