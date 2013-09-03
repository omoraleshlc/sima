<?php require('/configuracion/ventanasEmergentes.php');
require("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();
?>
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
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language="javascript" type="text/javascript">   
//Validacion de campos de texto no vacios by Mauricio Escobar   
//   
//Iván Nieto Pérez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El Código: www.elcodigo.com   
  
  
//*********************************************************************************   
// Function que valida que un campo contenga un string y no solamente un " "   
// Es tipico que al validar un string se diga   
//    if(campo == "") ? alert(Error)   
// Si el campo contiene " " entonces la validacion anterior no funciona   
//*********************************************************************************   
  
//busca caracteres que no sean espacio en blanco en una cadena   
function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.campo.value) == false ) {   
                alert("Introduzca un cadena de texto.")   
                return false   
        } else {   
                alert("OK")   
                //cambiar la linea siguiente por return true para que ejecute la accion del formulario   
                return true   
        }   
           
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


if(!$_POST['tipoVista']){
$_POST['tipoVista']='Detalle';

}
?>

<?php if($_POST['imprimir']) { ?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternosCC.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>');
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>

<?php } ?>












<?php //************************ACTUALIZO **********************

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$keyClientesInternos=$myrow3['keyClientesInternos'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$entidad=$myrow3['entidad'];

if($myrow3['seguro']){
$tipoCliente='aseguradora';
$seguro=$myrow3['seguro'];
} else {
$tipoCliente='particular';
}

//***************aplicar pago**********************
?>
<?php //transaccion estatica

if($_POST['aplicar'] and is_numeric($_POST['porcentaje']) and $_POST['gpoProducto']){
$keyCAP=$_POST['keyCAP'];
$fechaDescuento=$fecha1.' '.$hora1;



if($_POST['gpoProducto']=='*'){
$sSQL7="SELECT keyCAP
FROM
cargosCuentaPaciente
WHERE folioVenta='".$_GET['folioVenta']."'
and 
naturaleza='C'";
}else{
$sSQL7="SELECT keyCAP
FROM
cargosCuentaPaciente
WHERE folioVenta='".$_GET['folioVenta']."'
and 
gpoProducto='".$_POST['gpoProducto']."'
and
naturaleza='C'";
}

  $result7=mysql_db_query($basedatos,$sSQL7);
while(  $myrow7 = mysql_fetch_array($result7)){







if($myrow3['seguro']){
$agrega = "UPDATE cargosCuentaPaciente set 
fechaDescuento='".$fechaDescuento."',
usuarioDescuento='".$usuario."',
statusDescuento='aplicado',
precioOriginal=precioVenta,
ivaOriginal=iva,
precioVenta=precioVenta-precioVenta*('".$_POST['porcentaje']."'*0.01),
cantidadAseguradora=cantidadAseguradora-cantidadAseguradora*('".$_POST['porcentaje']."'*0.01),
ivaParticular=ivaAseguradora-ivaAseguradora*('".$_POST['porcentaje']."'*0.01),
iva=iva-iva*('".$_POST['porcentaje']."'*0.01)

where
keyCAP='".$myrow7['keyCAP']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}else{

$agrega = "UPDATE cargosCuentaPaciente set 
usuarioDescuento='".$usuario."',
fechaDescuento='".$fechaDescuento."',
statusDescuento='aplicado',
precioOriginal=precioVenta,
ivaOriginal=iva,
precioVenta=precioVenta-precioVenta*('".$_POST['porcentaje']."'*0.01),
cantidadParticular=cantidadParticular-cantidadParticular*('".$_POST['porcentaje']."'*0.01),
ivaParticular=ivaParticular-ivaParticular*('".$_POST['porcentaje']."'*0.01),
iva=iva-iva*('".$_POST['porcentaje']."'*0.01)

where
keyCAP='".$myrow7['keyCAP']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

}
}




$agrega = "UPDATE clientesInternos set 
descuento='si',
porcentajeDescuento='".$_POST['porcentaje']."',
usuarioDescuento='".$usuario."'
where
folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();



$sSQL7= "Select descripcionGP From gpoProductos where codigoGP='".$_POST['gpoProducto']."'";
$result7=mysql_db_query($basedatos,$sSQL7); 
$myrow7 = mysql_fetch_array($result7);
echo mysql_error();
?>
<script>
window.alert("Se le hizo un descuento del <?php echo $_POST['porcentaje'];?>%");
window.opener.document.forms["form10"].submit();
window.close();
</script>
<?php 

}
?>














<?php
if($_POST['actualiza']){

$seguro=$_POST['seguro'];
$keyCAP=$_POST['keyCAP'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($seguro[$i]){
$agrega = "UPDATE cargosCuentaPaciente set 
seguro='".$seguro[$i]."'
where
keyCAP='".$keyCAP[$i]."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();


}
}?>
<script>
window.alert("Se actualizaron registros!");
</script>
<?php 
}
?>



  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
.style7 {font-size: 9px}
-->
</style>
<head>
<style type="text/css">
<!--
.devolucion {color: #FFFFFF;font-size: 10px}

-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

	

</head>



<BODY  >
<?php //ventanasPrototype::links();?>
<h1 align="center" class="titulos">Dividir Cuentas</h1>
<p align="center" class="negro">No v&aacute;lido para fines fiscales</p>
<form id="form1" name="form1" method="post" action="">
  <table width="582" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="normal">
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left">Folio de Venta</div></th>
      <th bgcolor="#330099" class="blanco" scope="col"><div align="left"><?php echo $_GET['folioVenta'];
		  $nCliente=$myrow3['keyClientesInternos'];
		  ?>
          <input name="numeroE" type="hidden" class="normal" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label></div>      </th>
    </tr>
    <tr>
      <th width="168" bgcolor="#330099" class="normal" scope="col"><div align="left" class="blancomid"><strong>Paciente</strong></div></th>
      <th width="407" bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Compa&ntilde;&iacute;a</td>
<td bgcolor="#FFFFFF" class="normalmid"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
            <?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);


?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">N&deg; Credencial</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
    <tr>
      <th bgcolor="#330099" class="blancomid" scope="col"><div align="left"><strong>M&eacute;dico</strong></div></th>
      <th bgcolor="#FFFFFF" class="normalmid" scope="col"><div align="left">
          <label></label>
          
          <?php 
$sSQL18= "Select descripcion From almacenes WHERE almacen='".$myrow3['medico']."'";
$result18=mysql_db_query($basedatos,$sSQL18);
$rNombre18 = mysql_fetch_array($result18); 
?>
          <?php echo $dr="Dr(a): ".$rNombre18['descripcion'];?> </div></th>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Fecha Internamiento</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print cambia_a_normal($myrow3['fecha']);?></td>
    </tr>
    <tr>
      <td bgcolor="#330099" class="blancomid">Dx Entrada</td>
      <td bgcolor="#FFFFFF" class="normalmid"><?php print $myrow3['dx'];?></td>
    </tr>
  </table>
  <p>&nbsp;</p>



  
  
  <table width="494" border="1" align="center" class="style7">
    <tr>
      <th width="91" scope="col"><div align="left"><span class="normal">Grupo de Producto</span></div></th>
      <th width="272" scope="col"><div align="left"><span class="normal">
          <?php //*********gpoProductos

 $sSQL7= "Select * From gpoProductos where entidad='".$myrow3['entidad']."' AND activo ='activo' ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
          <select name="gpoProducto" class="Estilo24" id="gpoProducto">
            <option value="*">TODOS LOS GRUPOS</option>
            <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
            <option 
		   <?php if($myrow7['codigoGP']==$myrow['gpoProducto']){ echo 'selected=""';}?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']; ?></option>
            <?php } 
		
		?>
          </select>
      </span></div></th>
    </tr>
    <tr>
      <td>Seguro<span class="negromid">
        <input name="seguro" type="hidden" class="camposmid" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] and !$_POST['nuevo']){ echo $_POST['seguro'];} else { echo "0";}?>" 
		onchange="javascript:this.form.submit();" />
      </span></td>
      <td><input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="50"
		value="<?php 
		if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/></td>
    </tr>
    <tr>
      <td><div align="left">Porcentaje: </div></td>
      <td><label>
          <div align="left">
            <input name="porcentaje" type="text" class="style7" id="porcentaje" size="3"  value="<?php echo $_POST['porcentaje'];?>"  <?php echo $statusD?> autocomplete="off" />
        </div>
        </label>
          <label></label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="aplicar" type="submit" class="style7" id="aplicar" value="Aplicar" <?php echo $statusD?> /></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  <?php 
$content=new contenidos();
$content-> desplegarContenidos($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$_GET['folioVenta'],$basedatos);
?>
  <p align="center">&nbsp;</p>
  <?php 
$despliegaTotales=new totales();
$despliegaTotales-> tt($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$_GET['folioVenta'],$basedatos);
?>
  <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
</form>
<p align="center">


</p>
  <script>
		new Autocomplete("nomSeguro", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
</html>

