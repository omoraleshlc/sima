<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');


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
//Iv�n Nieto P�rez   
//Este script y otros muchos pueden   
//descarse on-line de forma gratuita   
//en El C�digo: www.elcodigo.com   
  
  
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
        status = "Este campo s�lo acepta n�meros."
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

$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
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


if($_POST['aplicar'] and $_POST['porcentaje'] and $_POST['tipoPago']){


if($_POST['porcentaje']<101 and $_POST['porcentaje']>0){



$keyCAP=$_POST['keyCAP'];
$fechaDescuento=$fecha1.' '.$hora1;


if($_POST['tipoPago']=='Particular'){
$sSQL3a= "Select sum((cantidadParticular*cantidad)+(ivaParticular*cantidad)) as totales From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
}else{
$sSQL3a= "Select sum((cantidadAseguradora*cantidad)+(ivaAseguradora*cantidad)) as totales From cargosCuentaPaciente WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);
}



$porcentaje=($_POST['porcentaje']*0.01)*$myrow3a['totales'];

/* 
$sSQL7="SELECT keyCAP
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto!=''

";


  $result7=mysql_db_query($basedatos,$sSQL7);
while(  $myrow7 = mysql_fetch_array($result7)){








$agrega = "UPDATE cargosCuentaPaciente set 
fechaDescuento='".$fechaDescuento."',
usuarioDescuento='".$usuario."',
statusDescuento='aplicado',
precioOriginal=precioVenta,
ivaOriginal=iva,
precioVenta=precioVenta-precioVenta*('".$_POST['porcentaje']."'*0.01),
cantidadAseguradora=cantidadAseguradora-cantidadAseguradora*('".$_POST['porcentaje']."'*0.01),
ivaAseguradora=ivaAseguradora-ivaAseguradora*('".$_POST['porcentaje']."'*0.01),
cantidadParticular=cantidadParticular-cantidadParticular*('".$_POST['porcentaje']."'*0.01),
ivaParticular=ivaParticular-ivaParticular*('".$_POST['porcentaje']."'*0.01),
iva=iva-iva*('".$_POST['porcentaje']."'*0.01)


where
keyCAP='".$myrow7['keyCAP']."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
 */


//*******************************************

if($_POST['tipoPago']=='Particular'){
$s= "Select * From catTTCaja WHERE aplicarDescuentoParticulares='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);
$cantidadAseguradora='0.00';
$cantidadParticular=$porcentaje;
}else{
$s= "Select * From catTTCaja WHERE aplicarDescuentoAseguradoras='si'  ";
$rs=mysql_db_query($basedatos,$s);
$my = mysql_fetch_array($rs);


$cantidadParticular='0.00';
$cantidadAseguradora=$porcentaje;

}

$codigoTT=$my['codigoTT'];
$descripcionArticulo=$my['descripcion'];

//*************************************




$agrega = "INSERT INTO cargosCuentaPaciente (
numeroE,nCuenta,status,usuario,fecha1,dia,cantidad,tipoTransaccion,codProcedimiento,hora1,
naturaleza,ejercicio,statusDeposito,numeroConfirmacion,almacen,usuarioTraslado,precioVenta,seguro,
statusTraslado,tipoCliente,tipoPaciente,cantidadParticular,cantidadAseguradora,numCorte,entidad,tipoCobro,statusAuditoria,tipoPago,statusCargo,porcentajeVariable,cargosHospitalarios,almacenDestino,keyClientesInternos,folioVenta,descripcionArticulo) 
values 
('".$numeroE."','".$nCuenta."','transaccion',
'".$usuario."','".$fecha1."','".$dia."','1','".$codigoTT."','".$hora1."',
'".$hora1."','".$my['naturaleza']."','".$ID_EJERCICIOM."','','".$numeroConfirmacion."','".$ALMACEN."','".$usuario."',
'".$porcentaje."','".$seguro."','standby','coaseguro','".$myrow3['tipoPaciente']."',
'".$cantidadParticular."','".$cantidadAseguradora."', '".$numCorte."','".$entidad."','".$tp."','standby'
,'".$_GET['tipoPago']."','cargado','".$_POST['porcentaje']."','".$_POST['cargosHospitalarios']."','".$ALMACEN."','".$myrow3['keyClientesInternos']."','".$_GET['folioVenta']."','".$descripcionArticulo."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$agrega = "UPDATE clientesInternos set 
descuento='si',

usuarioDescuento='".$usuario."'
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();





}




?>
<script>
window.alert("Se le hizo un descuento del <?php echo $_POST['porcentaje'];?>%");
window.opener.document.forms["form1"].submit();
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


<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>


<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librer�a principal del calendario --> 
<script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>

<body >
<p align="center">Aplicar Descuento por Porcentaje</p>
<form id="form1" name="form1" method="post" action="">
  <table width="379" class="table-forma">
    <tr>
      <td><div align="left">Descuento a: </div></td>
      <td><select name="tipoPago"  id="tipoPago">
        <option value="">Escoje</option>
		<?php 
		if($_GET['triggerParticular']>0){
        echo '<option value="Particular">Particular</option>';
		}
		 if($_GET['triggerAseguradora']>0){ 
        echo '<option value="Aseguradora">Aseguradora</option>';
		}
		?>
      </select></td>
    </tr>
    <tr>
      <td width="91"><div align="left">Porcentaje % </div></td>
      <td width="272"><label>
          <div align="left">
<?php 


		//echo "$".number_format($cargos,2);
		
?>
            <input name="porcentaje" type="text"  id="porcentaje"  value="<?php echo $_POST['porcentaje'];?>" size="10" maxlength="10"  <?php echo $statusD?> autocomplete="off" />
          </div>
        </label>
          <label></label></td>
    </tr>

  </table>
  <br />
<input name="aplicar" type="submit"  id="aplicar" value="Aplicar" <?php echo $statusD?> />
      <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $myrow3['keyClientesInternos']; ?>" />
      
        
</form>
<p align="center">&nbsp;</p>
</form>

</body>
</html>