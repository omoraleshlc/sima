<?PHP include("/configuracion/ingresoshlcmenu/caja/menuCaja.php"); include("/configuracion/funciones.php"); 
$cargosCia=new acumulados();
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
   window.open(URL,"ventana1","width=300,height=200,scrollbars=YES") 
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




<?php //************************ACTUALIZO **********************
//********************Llenado de datos

$sSQL3= "Select * From clientesInternos WHERE keyClientesInternos = '".$_POST['folio']."'  ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
$seguroT=ltrim($myrow3['seguro']);
//***************aplicar pago**********************

if($_POST['actualizar']){



$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];
for($i=0;$i<=$_POST['bandera2'];$i++){

if($aseguradora[$i]){
$status='efectivo';
$keyCAP[]=$aseguradora[$i];
} else {

$status='cxc';
$keyCAP[]=$particular[$i];
}


$agrega = "UPDATE cargosCuentaPaciente set 
statusAlta='".$status."',
usuarioAlta='".$usuario."',
fechaAlta='".$fecha1."',
horaAlta='".$hora1."'

where
keyCAP='".$keyCAP[$i]."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();




} //cierra for
} //cierra actualizar






$cargosParticulares=new  acumulados();
$totalxSurtir=new  acumulados();
$cargosAseguradora= new acumulados();
$otros= new acumulados();


if($_POST['imprimir']){ 



?>
<script>
javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosPA.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&keyClientesInternos=<?php echo $_POST['folio']; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&cajero=<?php echo $usuario;?>');
self.close();
</script>
<?php }
?>
<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script>

function muestra_oculta(id){
if (document.getElementById){ //se obtiene el id
var el = document.getElementById(id); //se define la variable "el" igual a nuestro div
el.style.display = (el.style.display == 'none') ? 'block' : 'none'; //damos un atributo display:none que oculta el div
}
}
window.onload = function(){/*hace que se cargue la función lo que predetermina que div estará oculto hasta llamar a la función nuevamente*/
muestra_oculta('contenido_a_mostrar');/* "contenido_a_mostrar" es el nombre de la etiqueta DIV que deseamos mostrar */
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<title></title>
<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style19 {color: #000000; font-weight: bold; }
-->
</style>


</head>
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style14 {font-size: 10px; color: #FFFFFF; }
.style21 {color: #FF0000}
-->
</style>




<BODY >

<h1 align="center">DEVOLUCIONES</h1>
<form id="form1" name="form1" method="post" action="">
  <table width="642" border="0" align="center" cellpadding="1" cellspacing="1" bordercolor="#990099" class="Estilo24">
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left">N&uacute;mero de FOLIO </div></th>
      <th bgcolor="#660066" class="style14" scope="col"><div align="left"><?php 
		  $nCliente=$myrow3['folioVenta'];
		  ?>
          <input name="numeroE" type="hidden" class="Estilo24" id="numeroE" 
		  value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" readonly=""/>
</label>
<input name="folio" type="text" class="Estilo24" id="folio" 
		  value="<?php echo $_POST['folio'];  ?>" readonly=""/>
      </div>
      </th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <th width="134" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>Paciente: </strong></div></th>
      <th width="408" bgcolor="#FFCCFF" class="Estilo24" scope="col"><div align="left"><strong>
          <label> </label>
      </strong> <?php echo $myrow3['paciente']; ?> </div></th>
    </tr>
    <tr>
      <th width="10" class="Estilo24" scope="col">&nbsp;</th>
      <td class="Estilo24">Compa&ntilde;&iacute;a: </td>
      <td class="Estilo24"><label> <?php echo $traeSeguro=$myrow3['seguro']; ?>
<?php
displaySeguro::despliegaSeguro($traeSeguro,$basedatos);
?>
            <input name="seguro2" type="hidden" id="seguro2" value="<?php echo $traeSeguro; ?>" />
      </label></td>
    </tr>
    <tr>
      <th class="Estilo24" scope="col">&nbsp;</th>
      <td bgcolor="#FFCCFF" class="Estilo24">N&deg; Credencial: </td>
      <td bgcolor="#FFCCFF" class="Estilo24"><?php echo $myrow3['credencial']; ?> </td>
    </tr>
  </table>
  <p align="center"><a href="javascript:ventanaSecundaria1('ventanaAplicarFolio.php?campoDespliega=<?php echo "campoDespliega"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campoSeguro=<?php echo "tipoTransaccion"; ?>&amp;numeroE=<?php echo $numeroE; ?>&amp;usuario=<?php echo $usuario; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;entidad=<?php echo $entidad; ?>&amp;numCorte=<?php echo $myrow1['numCorte']; ?>')" class="style7">Cargar Folio </a></p>
  

  <?php if($_POST['folio']){ ?>
  <table width="675" border="0" align="center">
    <tr>
      <th width="105" height="14" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Fecha/Hora </span></div></th>
      <th width="348" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="21" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Cant</span></div></th>
      <th width="73" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Importe</span></div></th>
      <th width="51" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">IVA</span></div></th>
      <th width="51" bgcolor="#660066" class="style14" scope="col"><div align="left"><span class="style12 ">Convenio</span></div></th>
    </tr>
    <tr>
    
      <?php //traigo agregados
	  

$sSQL81= "
SELECT 
*
FROM
cargosCuentaPaciente 
 WHERE 
keyClientesInternos='".$myrow3['keyClientesInternos']."'

 
 
  order by fecha1,hora1 asc
";






$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 

		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];







?>


  <td height="21" bgcolor="<?php echo $color;?>" class="Estilo24"><span class="<?php echo $estilo;?>">
	  <?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="<?php echo $estilo;?>"><span class="style12"><span class="style7">
      <?php 
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
      </span></span>        <span class="style12">
		
        <?php  if($myrow811['um']=='s' or $myrow811['um']=='S'){
		echo '  ( Servicio )  ';
		} 
		?>

      </span> </span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center"><span class="<?php echo $estilo;?>">
          <?php  
	

		
		echo $cantidad=$myrow81['cantidad'];
			
		

		
		?>
      </span></div></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="<?php echo $estilo;?>"><span class="style12"><span class="style7">
        <?php $importe=new acumulados();
		echo $importe->importe($keyCAP,$basedatos);
		
		?>
      </span></span></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><span class="<?php echo $estilo;?>"><span class="style12"><span class="style7">
        <?php $mostrarIVA=new articulosDetalles();
		echo $mostrarIVA->mostrarIVA($keyCAP,$basedatos);
		?>
      </span></span></span></td>
      <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center"><span class="<?php echo $estilo;?>">
	   
      <span class="style12"><span class="style7">
      <?php 

	  if($myrow81['tipoConvenio'] AND $myrow81['tipoConvenio']!='No'){echo 'C';}else{echo '---';}
		?>
    </span></span> </span></div></td>
	</tr>
 
	
	
    <?php }?>
  </table>
    

  <p>&nbsp;</p>
  <div align="center">
    <table width="558" border="0" align="center" class="style12">
      <tr>
        <td width="113" class="style12">&nbsp;</td>
        <td width="124" class="style12">&nbsp;</td>
        <td width="97" class="style12"><span class="style7">Total Cargos </span>          <?php 
		$totalAcumulado=new acumulados();
		
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta),2);?></td>
        <td width="106" height="23" class="style12"><span class="style7">Total Abonos     
          <?php 		 
		$abonos=new acumulados();
		echo "$".number_format($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta),2); ?>
        </span></td>
        <td width="96" class="style12"><div align="right">
        Saldo Actual 
          <?php 
		  if($abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta)<0){
		  $abono=$abonos->abonos($basedatos,$usuario,$numeroE,$nCuenta);
		  $abono1=$abono*'-1';
		  }
		  $banderaBoton=$totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta)-$abono1;
		echo "$".number_format($totalAcumulado->totalAcumulado($basedatos,$usuario,$numeroE,$nCuenta)-$abono1,2);
		?>
          </div></td>
      </tr>
    </table>


  </div>
  <?php if($myrow3['status']!='devolucion'){ ?>
  <p align="center">
    <label>
    <input name="imprimir" type="submit" class="style7" id="imprimir" value="Imprimir" />
    </label>
    <input name="Submit" type="button" class="style7" value="Aplicar Devoluci&oacute;n"  onclick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?usuario=<?php echo $_GET['usuario'];?>&numeroE=<?php echo $numeroE; ?>
&almacen=<?php echo $_GET['almacenSolicitante']; ?>&almacenFuente=<?php echo $almacen; ?>&seguro=<?php echo $seguroT; ?>&nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&tipoCliente=<?php echo 'particular';?>&tipoVenta=<?php echo $_GET['tipoVenta'];?>')" <?php if(!$banderaBoton){ echo 'disabled=""';}?>/>
    <input name="keyClientesInternos" type="hidden" class="style7" id="keyClientesInternos" value="<?php echo $_GET['nT'];?>" />
  </p>


</form>

<p align="center">&nbsp;</p>

</body>
</html>
<?php } else { 
echo 'Este folio está cancelado, Gracias!';
}
?>
  <?php }?>