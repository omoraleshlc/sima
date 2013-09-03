<?php include("/configuracion/ventanasEmergentes.php"); ?>
<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

  <script language=javascript> 
function ventanaSecundaria8 (URL){ 
   window.open(URL,"ventana8","width=500,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo sólo acepta números."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<script type="text/javascript">
<!-- por carlitos. cualquier duda o pregunta, visita www.forosdelweb.com

var ancho=100
var alto=100
var fin=300
var x=100
var y=100

function inicio()
{
ventana = window.open("cita.php", "_blank", "height=1,width=1,top=x,left=y,screenx=x,screeny=y");
abre();
}
function abre()
{
if (ancho<=fin) {
ventana.moveto(x,y);
ventana.resizeto(ancho,alto);
x+=5
y+=5
ancho+=15
alto+=15
timer= settimeout("abre()",1)
}
else {
cleartimeout(timer)
}
}
// -->
</script>








<?php
if($_POST['previsualizars']){

?>
 <script language="JavaScript" type="text/javascript">
javascript:ventanaSecundaria5('/sima/cargos/printDetailsGroupGhost.php?folioVenta=<?php echo $_POST['folioVenta'];?>&paciente=<?php echo $_POST['paciente'];?>&descipcion=<?php echo $_POST['descripcion'];?>&cantidad=<?php echo $_POST['cantidad'];?>&iva=<?php echo $_POST['iva'];?>&importe=<?php echo $_POST['importe'];?>&descipcion2=<?php echo $_POST['descripcion2'];?>&cantidad=2<?php echo $_POST['cantidad2'];?>&iva2=<?php echo $_POST['iva2'];?>&importe2=<?php echo $_POST['importe2'];?>&descipcion3=<?php echo $_POST['descripcion3'];?>&cantidad3=<?php echo $_POST['cantidad3'];?>&iva3=<?php echo $_POST['iva3'];?>&importe3=<?php echo $_POST['importe3'];?>&descipcion4=<?php echo $_POST['descripcion4'];?>&cantidad4=<?php echo $_POST['cantidad4'];?>&iva4=<?php echo $_POST['iva4'];?>&importe4=<?php echo $_POST['importe4'];?>&descipcion5=<?php echo $_POST['descripcion5'];?>&cantidad5=<?php echo $_POST['cantidad5'];?>&iva5=<?php echo $_POST['iva5'];?>&importe5=<?php echo $_POST['importe5'];?>&descipcion6=<?php echo $_POST['descripcion6'];?>&cantidad6=<?php echo $_POST['cantidad6'];?>&iva6=<?php echo $_POST['iva6'];?>&importe6=<?php echo $_POST['importe6'];?>'); 


</script> 
<?php 
echo 'se actualizaron datos';
}
?>
































 
  
  
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script> 
  
  
<script language="JavaScript" type="text/javascript">
<!--
function checkform ( form )
{
  // see http://www.thesitewizard.com/archive/validation.shtml
  // for an explanation of this script and how to use it on your
  // own website

  // ** START **
  if (form1.folioFactura.value == "") {
    alert( "Introduce el numero de la factura" );
    form1.folioFactura.focus();
    return false ;
  }
  // ** END **
  return true ;
}
//-->
</script>
<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas facturar definitivo?')) return true;
return false;
}
-->
</script>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">


<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<head>
<script type="text/javascript">
<--
function checkEmpty(button, element) {
  if (element.value == ""){ 
  button.disabled=true;
  if(confirm('Estas seguro que deseas facturar <?php echo "$".number_format($disponible[0],2);?> pesos?') == false){return false;}
  } else {button.disabled=false;
  
  }
  
}

// -->
</script>


<?php
$estilo= new muestraEstilos();
$estilo->styles();
?>



</head>

<body>
<h1 align="center" >Prorrateo, Facturar </h1>
<form id="form1" name="form1" method="post">
  <p align="center">&nbsp;</p>
  <table width="697" class="table-forma">

    <tr>
      <td  scope="col"><div align="left">Fecha Impresi&oacute;n</div></td>
      <td  scope="col"><div align="left">
        <label></label>
        <input type="text" name="fechaImpresion" id="fechaImpresion" value="<?php echo $_POST['fechaImpresion'];?>" />
      </div>      </td>
      <td    scope="col">&nbsp;</td>
      <td  scope="col" ><div align="left"><strong># Siniestro</strong></div></td>
      <td  scope="col"><div align="left">
        <input type="text" name="siniestro" id="siniestro" value="<?php echo $_POST['siniestro'];?>" />
      </div></td>
    </tr>
    <tr>
      <td  scope="col">&nbsp;</td>
      <td  scope="col">&nbsp;</td>
      <td    scope="col">&nbsp;</td>
      <td  scope="col" ><div align="left">Compa&ntilde;&iacute;a</div></td>
      <td  scope="col"><div align="left"><span >
        <?php $traeSeguro=$myrow3['seguro']; ?>
        <?php
$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$sSQL455= "Select * from clientes where entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);
echo $myrow455['nomCliente'];


$sSQL455d= "Select rfc from clientes where numCliente='".$myrow455['clientePrincipal']."'";
$result455d=mysql_db_query($basedatos,$sSQL455d);
$myrow455d = mysql_fetch_array($result455d);

?>
      </span></div></td>
    </tr>

    <tr>
      <td colspan="5"  scope="col">
        <div align="center"># Factura 
          <input autocomplete="off" name="folioFactura" type="text" <?php if($_POST['folioFactura']){ echo '';}?> id="folioFactura" value="<?php echo $_POST['folioFactura'];?>"  />
        </div>
      <div align="left"></div>        <div align="left"></div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  
  
  
  
  <table width="771" class="table-forma">
<?php 
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' and numCliente='".$_GET['numCliente']."'";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>



    <?php 
	if(!$_POST['clientePrincipal'] AND !$myrow2['clientePrincipal']){ ?>
    <tr >
      <td >RFC:</td>
      <td ><span >
        <input name="rfc" type="text"  id="rfc" value ="<?php if($myrow2['rfc']){ echo $myrow2['rfc'];}else{echo $_POST['rfc'];} ?>" size="60"/>
      </span></td>
    </tr>
    <tr  >
      <td  scope="col"><div align="left" >Raz&oacute;n Social</div></td>
      <td  scope="col"><div align="left" >
<textarea name="razonSocial" cols="40" wrap="virtual" id="razonSocial" autocomplete="off"  >
<?php if($myrow2['razonSocial']){echo trim($myrow2['razonSocial']);} else if(!$myrow455['razonSocial']){echo trim($_POST['razonSocial']);}?></textarea>
          </span></div></td>
    </tr>
    <tr  >
      <td  scope="col"><div align="left">Calle</div></td>
      <td  scope="col"><div align="left"><span >
          <input name="calle" type="text"  id="calle" value="<?php 
		if($myrow2['calle']){
echo $myrow2['calle'];
} else if(!$myrow2['calle'] ) {
		echo $_POST['calle'];
		}
		  ?>" size="40" autocomplete="off" <?php if($myrow2['calle']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr  >
      <td  scope="col"><div align="left" >Colonia</div></td>
      <td  scope="col"><div align="left"><span >
          <input name="colonia" type="text"  id="colonia" value="<?php 
		if($myrow2['colonia']){
echo $myrow2['colonia'];
} else if(!$myrow2['colonia'] ) {
		echo $_POST['colonia'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['colonia']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr  >
      <td  scope="col"><div align="left" >Ciudad</div></td>
      <td  scope="col"><div align="left"><span >
          <input name="ciudad" type="text"  id="ciudad" value="<?php 
		if($myrow2['ciudad']){
echo $myrow2['ciudad'];
} else if(!$myrow2['ciudad'] ) {
		echo $_POST['ciudad'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['ciudad']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr  >
      <td  scope="col"><div align="left" >Estado</div></td>
      <td  scope="col"><div align="left"><span >
          <input name="estado" type="text"  id="rfc6" value="<?php 
		if($myrow2['estado']){
echo $myrow2['estado'];
} else if(!$myrow2['estado'] ) {
		echo $_POST['estado'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['estado']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr  >
      <td  scope="col"><div align="left" >CP
      </div></td>
      <td  scope="col"><div align="left"><span >
          <input name="cp" type="text" id="cp" value="<?php 
		if($myrow2['cp']){
echo $myrow2['cp'];
} else if(!$myrow2['cp'] ) {
		echo $_POST['cp'];
		}
		  ?>" size="40" autocomplete="off" <?php if($_POST['cp']){ echo 'class="Estilo1"';}?>  />
      </span></div></td>
    </tr>
    <tr >
      <td >Pa&iacute;s:</td>
      <td ><span >
        <input name="pais" type="text"  id="pais" value="<?php if($_POST['pais']){ echo $_POST['pais'];}else{echo trim($myrow2['pais']);} ?>" />
      </span></td>
    </tr>
    <tr >
      <td >Delegaci&oacute;n:</td>
      <td ><span >
        <input name="delegacion" type="text"  id="delegacion" value="<?php if($_POST['delegacion']){ echo $_POST['delegacion'];}else{echo $myrow2['delegacion']; }?>" size="60"/>
      </span></td>
    </tr>
    <?php } ?>
  </table>
  <p align="center" class="style7">&nbsp;</p>



 

    


  <table width="549" class="table-forma">
    <tr>
      <th width="157"   scope="col"><div align="left">Folio de Venta</div></th>
      <th width="382" height="14"   scope="col"><div align="left">Paciente</div></th>
    </tr>
	

	
	
    <tr>
      <td bgcolor="<?php echo $color;?>" ><span >
        <label>
        <input type="text" name="folioVenta" id="folioVenta" value="<?php echo $_POST['folioVenta'];?>" />
        </label>
      </span></td>
<td height="21" bgcolor="<?php echo $color;?>" ><div align="left">
  <input name="paciente" type="text" id="paciente" size="50" value="<?php echo $_POST['paciente'];?>" />
</div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="656" class="table-forma">
    <tr>
      <th width="365" height="14"   scope="col"><div align="left">Descripci&oacute;n</div></th>
      <th width="91"   scope="col"><div align="left">Cantidad</div></th>
      <th width="91"   scope="col"><div align="left">IVA</div></th>
      <th width="91"   scope="col"><div align="left">Importe</div></th>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" ><textarea name="descripcion" cols="50" wrap="virtual" id="descripcion"><?php echo $_POST['descripcion'];?></textarea></td>
      <td bgcolor="<?php echo $color;?>" ><input name="cantidad" type="text" id="cantidad" size="3" value="<?php echo $_POST['cantidad'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="iva" type="text" id="iva" size="9" value="<?php echo $_POST['iva'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="importe" type="text" id="importe" size="15" value="<?php echo $_POST['importe'];?>" /></td>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" ><textarea name="descripcion2" cols="50" wrap="virtual" id="descripcion2"><?php echo $_POST['descripcion2'];?></textarea></td>
      <td bgcolor="<?php echo $color;?>" ><input name="cantidad2" type="text" id="cantidad2" size="3" value="<?php echo $_POST['cantidad2'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="iva2" type="text" id="iva2" size="9" value="<?php echo $_POST['iva2'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="importe2" type="text" id="importe2" size="15" value="<?php echo $_POST['importe2'];?>" /></td>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" ><textarea name="descripcion3" cols="50" wrap="virtual" id="descripcion3"><?php echo $_POST['descripcion3'];?></textarea></td>
      <td bgcolor="<?php echo $color;?>" ><input name="cantidad3" type="text" id="cantidad3" size="3" value="<?php echo $_POST['cantidad3'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="iva3" type="text" id="iva3" size="9" value="<?php echo $_POST['iva3'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="importe3" type="text" id="importe3" size="15" value="<?php echo $_POST['importe3'];?>" /></td>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" ><textarea name="descripcion4" cols="50" wrap="virtual" id="descripcion4"><?php echo $_POST['descripcion4'];?></textarea></td>
      <td bgcolor="<?php echo $color;?>" ><input name="cantidad4" type="text" id="cantidad4" size="3" value="<?php echo $_POST['cantidad4'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="iva4" type="text" id="iva4" size="9" value="<?php echo $_POST['iva4'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="importe4" type="text" id="importe4" size="15" value="<?php echo $_POST['importe4'];?>" /></td>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" ><textarea name="descripcion5" cols="50" wrap="virtual" id="descripcion5"><?php echo $_POST['descripcion5'];?></textarea></td>
      <td bgcolor="<?php echo $color;?>" ><input name="cantidad5" type="text" id="cantidad5" size="3" value="<?php echo $_POST['cantidad5'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="iva5" type="text" id="iva5" size="9" value="<?php echo $_POST['iva5'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="importe5" type="text" id="importe5" size="15" value="<?php echo $_POST['importe5'];?>" /></td>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" ><textarea name="descripcion6" cols="50" wrap="virtual" id="descripcion6"><?php echo $_POST['descripcion6'];?></textarea></td>
      <td bgcolor="<?php echo $color;?>" ><input name="cantidad6" type="text" id="cantidad6" size="3" value="<?php echo $_POST['cantidad6'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="iva6" type="text" id="iva6" size="9" value="<?php echo $_POST['iva6'];?>" /></td>
      <td bgcolor="<?php echo $color;?>" ><input name="importe6" type="text" id="importe6" size="15" value="<?php echo $_POST['importe6'];?>" /></td>
    </tr>
    <tr>
      <td height="21" bgcolor="<?php echo $color;?>" >&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" >&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" >&nbsp;</td>
      <td bgcolor="<?php echo $color;?>" >&nbsp;</td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>
  <p>&nbsp;</p>
  <label>
    <div align="center">
  </label>
  <label>
  <div align="center">
    <input type="submit" name="previzualizar" id="previzualizar" value="Previzualizar" />
  </div>
  </label>
  
  
  
  
  <p align="center">
    <label>
	
	  <?php if($_POST['previzualizar'] and $_POST['folioFactura']){ ?>
	<?php 
	if($myrow455d or $_POST['rfc']){
 $sSQL331= "Select sum(cantidadFacturada) as cantidadF From cargosFacturados WHERE numFactura='".$_POST['folioFactura']."' and
nT='".$myrow81['keyCAP']."' and status='standby'";
$result331=mysql_db_query($basedatos,$sSQL331);
$myrow331 = mysql_fetch_array($result331);
?>
	<input name="aplicarFactura" type="submit" class="style7" id="aplicarFactura" value="Facturar Definitivo" onClick="return comprueba();"/>

    </label>
  </p>
  <?php } ?>
  
  
 <?php } ?>
 
 
 
 





</form>

</body>
</html>