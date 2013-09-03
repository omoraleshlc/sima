<?php require('/configuracion/ventanasEmergentes.php');


include("/configuracion/funciones.php"); 
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




<?php //************************ACTUALIZO **********************
//********************Llenado de datos
if(!$_GET['nT']){
$_GET['nT']=$nT;
}
if(!$bali){
$bali=$_GET['almacenFuente'];
}

$sSQL3= "Select * From clientesInternos WHERE folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
$almacenCierreCuenta=$myrow3['almacen'];
$numeroE=$myrow3['numeroE'];
$nCuenta=$myrow3['nCuenta'];
$cuarto=$myrow3['cuarto'];
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














if($_POST['cerrar']){
$particular=$_POST['particular'];
$aseguradora=$_POST['aseguradora'];




//********************CIERRO STATUS CUENTA***********************
$agrega = "UPDATE cargosCuentaPaciente set 
statusCuenta='cerrada'


where
keyClientesInternos='".$_GET['nT']."'

";

mysql_db_query($basedatos,$agrega);
echo mysql_error();
//*********************************************



//cierro cuenta
 $agrega = "UPDATE clientesInternos set 
status='cerrada',
statusCuenta='cerrada',
usuarioCierre='".$usuario."',
fechaCierre='".$fecha1."',
horaCierre='".$hora1."'

where
keyClientesInternos='".$_GET['nT']."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

//cierro cuarto a sucio
$agrega = "UPDATE cuartos set 
status='sucio',
usuarioSalida='".$usuario."',
fechaSalida='".$fecha1."',
horaSalida='".$hora1."'

where
codigoCuarto='".$cuarto."' 
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

$leyenda='Se cerró la cuenta';
?>
<script>

javascript:ventanaSecundaria2('/sima/cargos/imprimirCargosInternosCC.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>');
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->

window.alert("SE CERRO LA CUENTA");
   close();
   </script>
<?php 
}






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















<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<style type="text/css">
<!--
.devolucion {color: #FFFFFF;font-size: 12px}

-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>
</head>



<BODY  >
<?php //ventanasPrototype::links();?>
<h1 align="center" class="titulos">Abonos Otros</h1>
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
  
  
  
  
  
  
  
  
  
  
  <p>
    <?php if($_POST['tipoVista']){ ?>
  </p>



  
  
    <table width="940" border="0" align="center">
    <tr bgcolor="#330099">
      <th width="57" bgcolor="#330099" class="blanco" scope="col"><div align="left">Ref</div></th>
     
      <th width="148" height="14" bgcolor="#330099" class="blanco" scope="col"><div align="left"><span class="blanco ">Hora / Fecha</span></div></th>
      <th width="292" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">Descripci&oacute;n/Concepto</span></div></th>
      <th width="78" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">Status</span></div></th>
      <th width="36" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">Cant</span></div></th>
      <th width="53" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">P.Unit</span></div></th>
      <th width="65" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">CargosP</span></div></th>
      <th width="60" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">CargosA</span></div></th>
      <th width="54" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">IVA</span></div></th>
      <th width="55" bgcolor="#330099"  scope="col"><div align="left"><span class="blancomid ">Natura</span></div></th>
      </tr>
	
      <?php //traigo agregados
	  

$sSQL81= "
SELECT 
*,cargosCuentaPaciente.descripcion as descripcionGeneral
FROM
cargosCuentaPaciente
 WHERE 
cargosCuentaPaciente.folioVenta='".$_GET['folioVenta']."'
and 
cargosCuentaPaciente.status!='cancelado'
and
status='transaccion'
and
tipoPago='Otros'
 order by fecha1,hora1 ASC

";





$result81=mysql_db_query($basedatos,$sSQL81);
while($myrow81 = mysql_fetch_array($result81)){ 



if($myrow81['statusDevolucion']=='si' and $myrow81['naturaleza']=='A'){
$fondo='#FF0000';
$letras='#FFFFFF';
$class='devolucion';
}else{
$fondo='#FFFFFF';
$letras='normal';
$class='normalmid';
}





		 $a+= '1';
$art = $myrow81['codProcedimiento'];
$codigo=$proc=$myrow81['codProcedimiento'];
$keyCAP=$myrow81['keyCAP'];

 if($_POST['tipoVista']=='Agrupado'){
$sSQL14= "
SELECT 
sum(cantidad) as cantidad2
FROM
cargosCuentaPaciente
WHERE 
codProcedimiento = '".$proc."' and  numeroE = '".$numeroE."'
";
$result14=mysql_db_query($basedatos,$sSQL14);
$myrow14 = mysql_fetch_array($result14);
}


$style='normal';



		$sSQL14a= "
SELECT 
descripcion
FROM
articulos
WHERE 
keyPA='".$myrow81['keyPA']."'
";
$result14a=mysql_db_query($basedatos,$sSQL14a);
$myrow14a = mysql_fetch_array($result14a);


?>	
	
	
	<tr bgcolor="" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" > 

      <td bgcolor="#FFFFFF" class="normalmid">
      <div align="left">
	  <?php echo $myrow81['keyCAP'];?>
      </div>
      </td>






      <td height="21" bgcolor="<?php print $fondo;?>" class="<?php print $class;?>">
        <div align="left"><?php echo $myrow81['hora1']." ".cambia_a_normal($myrow81['fecha1']);
	?></span>          
        </div>
      </div></td>
	

	
	
      <td bgcolor="<?php print $fondo;?>">
	  <div align="left" class="<?php print $class;?>">
	 
        <div align="left">
          <?php 
				if($myrow81['descripcionGeneral']){	
					echo $myrow81['descripcionGeneral'];
					}else{
					$descripcion=new articulosDetalles();
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
if($myrow81['status']!='transaccion'){
				$nombreMed=new nombreMedico();
				
				//echo " ".$myrow81['descripcion'].$nombreMed->nombreMed($myrow81['almacen'],$basedatos);
				}
				}
		?>
          
          
          
          <?php  if($myrow81['gpoProducto']){
		echo '['.$myrow81['gpoProducto'].']';
		} 
		
		if($myrow81['folioDevolucion'] and $myrow81['naturaleza']=='A'){
		print '</br>'.'Folio Devolucion: '.$myrow81['folioDevolucion'];
		}
		?>
            </span>	   </div>
	  </div></td>
	   
	   
      <td bgcolor="<?php print $fondo;?>" class="<?php print $class;?>">
        
        <div align="left">
          <?php 
if($myrow81['statusCargo']=='standbyR'){
echo 'Sin enviar';
}else if($myrow81['statusCargo']=='standby'){
echo 'pendiente surtir';
} else if($myrow81['statusCargo']=='cargado'){
echo $myrow81['statusCargo'];
}
	?>
        </div></td>
		
      <td bgcolor="<?php print $fondo;?>" class="<?php print $class;?>">
        
        <div align="left">
          <?php  
	
	
 if($_POST['tipoVista']=='Agrupado'){
 echo $cantidad=$myrow14['cantidad2'];	
 } else {
		
		echo $cantidad=$myrow81['cantidad'];
			
		}

		
		?>
        </div></td>
      <td bgcolor="<?php print $fondo;?>" class="<?php print $class;?>" >
        <div align="left">
          <?php //cargos

	  echo '$'.number_format($myrow81['precioVenta'],2);
	  
	  ?>
        </div></td>
        
        
        <?php 
      if( $myrow81['statusDevolucion']=='si' and $myrow81['naturalezaCxC']=='A'){
      $devoluciones[0]+=($myrow81['precioVenta']*$myrow81['cantidad']); 
	  $devolucionesIVA[0]+=($myrow81['iva']*$myrow81['cantidad']);
	  } else{
	  	if($myrow81['naturalezaCxC']=='C'){
  	  	$sumaCargos[0]+=($myrow81['precioVenta']*$myrow81['cantidad']);
  	  	$sumaCargosIVA[0]+=($myrow81['iva']*$myrow81['cantidad']);
      		}else if($myrow81['naturalezaCxC']=='A'){
   	  	$sumaAbonos[0]+=($myrow81['precioVenta']*$myrow81['cantidad']);
	  	$sumaAbonosIVA[0]+=($myrow81['iva']*$myrow81['cantidad']);
      }
	  }
        ?>
        
      <td bgcolor="<?php print $fondo;?>" class="<?php print $class;?>" >
        <div align="left">
          <?php //cargos
	  if($myrow81['naturalezaCxC']=='C'){
  
	  $tParticular[0]+=(($myrow81['cantidadParticular']*$myrow81['cantidad'])+($myrow81['ivaParticular']*$myrow81['cantidad']));
	  echo '$'.number_format($myrow81['cantidadParticular']*$myrow81['cantidad'],2);
	  } else {
	  echo '*';
	  }
	  ?>
        </div></td>
      <td bgcolor="<?php print $fondo;?>" class="<?php print $class;?>" >
        <div align="left">
          <?php //cargos
	  if($myrow81['naturalezaCxC']=='C'){
	  $tAseguradora[0]+=(($myrow81['cantidadAseguradora']*$myrow81['cantidad'])+($myrow81['ivaAseguradora']*$myrow81['cantidad']));
	  echo '$'.number_format($myrow81['cantidadAseguradora']*$myrow81['cantidad'],2);
	  } else {
	  echo '*';
	  }
	  ?>
        </div></td>
      <td bgcolor="<?php print $fondo;?>" > <div align="right" class="<?php print $class;?>">
        <div align="left">
          <?php 
		  if($myrow81['naturalezaCxC']=='C'){
		  $sumaIVAS[0]+=($myrow81['ivaAseguradora']+$myrow81['ivaParticular'])*$myrow81['cantidad'];
		echo '$'.number_format(($myrow81['ivaAseguradora']+$myrow81['ivaParticular'])*$myrow81['cantidad'],2);
		} else{
		print '*';
		}
		?>
          </span></div>
      </div></td>
      <td bgcolor="<?php print $fondo;?>" class="<?php print $class;?>" >
        
        <div align="left">
          <?php 
	
	  
	  print $myrow81['naturalezaCxC'];
	  
	  ?>
        </div></td>
      </tr>
 
	
	
    <?php }?>
  </table>


    <p align="center">&nbsp;</p>
    <table width="302" border="0" align="center">
      <tr>
        <th colspan="3" scope="col" class="titulos">&nbsp;</th>
      </tr>
      <tr>
        <th width="92" scope="col"><div align="left" class="precio1">Cargos</div></th>
        <th width="98" scope="col"><div align="left"><span class="precio1"></span>
		<?php print '$'.number_format($sumaCargos[0],2);?>
        </div></th>
        <th width="98" scope="col">&nbsp;</th>
      </tr>
      <tr>
        <th scope="col"><div align="left" class="titulomedio">	
        Abono

         </div></th>
        <th scope="col"><div align="left"><span class="negromid"><?php echo '$'.number_format($sumaAbonos[0],2);?></span></div></th>
        <th scope="col">&nbsp;</th>
      </tr>
    </table>
    <p align="center">Totales 
    <?php print '$'.number_format($sumaCargos[0]-$sumaAbonos[0],2);?>
    </p>
    <p>
    <input name="recibo" type="hidden" id="recibo" value="<?php 
		 echo $nCliente=$_POST['numeroE'];
		  ?>" />
    <input name="nCliente" type="hidden" id="nCliente" value="<?php echo $nCliente; ?>" />
    <input name="almacen" type="hidden" id="almacen" value="<?php echo $ALMACEN; ?>" />
  </p>

      <?php } ?>
 

  <p align="center">
    <input name="keyClientesInternos" type="hidden" id="keyClientesInternos" value="<?php echo $myrow3['keyClientesInternos']; ?>" />
  </p>
</form>
<?php if($_POST['banderaFecha']){ ?>
<p align="center">
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
  </script> 
</p>
<script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
  </script>
  <?php } ?>
</body>
</html>


