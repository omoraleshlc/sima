<?php require('/configuracion/ventanasEmergentes.php'); require('/configuracion/funciones.php');?>

<?php 
$folioVenta=$_GET['folioVenta'];
$cargosCia=new acumulados();
$cargosParticularesCC=new  cierraCuenta();
$cargosAseguradoraCC=new cierraCuenta();

$numeroPaciente=$_GET['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$almacen=$_GET['almacen'];
$nCuenta=$_GET['nCuenta'];
$tipoCargo=$_GET['tipoCargo'];
?>

<script language="javascript" type="text/javascript">   

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
           
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el departamento!")   
                return false   
        } else if( vacio(F.tipoUM.value) == false ) {   
                alert("Por Favor, escoje si es un servicio o si son artículos lo que vas a cargar!")   
                return false   
        } else if( vacio(F.nomArticulo.value) == false ) {   
                alert("Por Favor, escoje el artículo o servicio para solicitar!")   
                return false   
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
<?php 


$sSQL= "SELECT *
FROM
clientesInternos 
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'

 ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$entidad=$myrow['entidad'];
$keyClientesInternos=$myrow['keyClientesInternos'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

<style type="text/css">
<!--
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	size:116px;
}
#form2 p {
	text-align: center;
}
#form2 table tr td {
	text-align: left;
}
#form2 table tr td {
	text-align: left;
}
#form2 table tr td {
	text-align: center;
}
#form2 table {
	text-align: left;
}
#form2 table tr td .normal {
	text-align: center;
}
#form2 table tr td .negromid {
	text-align: center;
}
-->
</style>
</head>

<body>
<label></label><label>
  </label>
</p>
<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);">
  <p>&nbsp;</p>
  <table width="993" border="0" align="center">
    <tr>
      <td colspan="3" align="left" class="titulos">ESTADO DE CUENTA</td>
    </tr>
    <tr bgcolor="#FFFF00">
      <td width="124" align="left" class="titulomedio">FOLIO N&deg;</td>
      <td width="655" align="center" class="negromid"> PACIENTE: <span class="titulomedio"><?php echo $myrow['paciente']; ?></span></td>
      <td width="200" align="left" class="titulomedio">DEPTO - CUARTO</td>
    </tr>
    <tr>
      <td style="text-align: center"><span class="negromid"><?php echo $myrow['folioVenta']; ?></span></td>
      <td class="negromid"><span class="negromid" style="text-align: left">Seguro: <span class="normalmid">
      <?php 
		
	$segur= $myrow['seguro'];
	
	if ($segur!='') {
	$sSQL4= "Select nomCliente From clientes WHERE entidad='".$entidad."' and numCliente='".$segur."';
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	echo $myrow4['nomCliente'];
} else {
echo particular;
}
?>
- <?php echo $myrow['credencial']; ?></span></span></td>
      <td><span class="negromid">
        <?php $id_almacen=$myrow['almacen']; 
	  $sSQL1= "SELECT almacen,descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$id_almacen."'
 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['descripcion'];
	  ?>
      - <?php echo $myrow['cuarto']; ?></span></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" class="negromid">Fecha/Hora de Inter.: <span class="normalmid"><?php echo $myrow['fecha']." / ".$myrow['hora']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" class="negromid">M&eacute;dico de Inter.: <span class="normalmid">
        <?php 
	 	 
	if ($myrow['medico']) {
	 $medico1=$myrow['medico'];
	$sSQL3= "SELECT nombre1,apellido1,apellido2
	FROM
	medicos 
	where
	entidad='".$entidad."'
	and
	numMedico='".$medico1."'";
	
	$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	 
	 echo $myrow3['nombre1']." ".$myrow3['apellido1']." ".$myrow3['apellido2']; 
     }
     else{
		 echo $myrow['medicoForaneo'];    
	 }
?>      
      </span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" class="negromid">Diagn&oacute;stico: <span class="normalmid"><?php echo $myrow['dx']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2" style="text-align: left" class="negromid">Fecha/Hora de Alta: <span class="normalmid"><?php echo $myrow['fechaCierre']." / ".$myrow['horaCierre']; ?></span></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center" class="titulos">Listado de Cargos</p>

<?php if($myrow['statusFactura']=='facturado'){ ?>
  <p align="center" class="titulos Estilo1"><blink>Facturado</blink></p>
<?php } ?>

  <div align="center">

      
   
<?php 
$content=new contenidos();
$content-> desplegarContenidos($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$_GET['folioVenta'],$basedatos);
?>
      
      
      
           
      
</div>
  <p><blink></blink></p>
  <table width="1000" border="0" cellspacing="0">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td bgcolor="#FFFF00" class="negromid">Particular</td>
      <td bgcolor="#FFFF00" class="negromid">Coaseguro</td>
      <td bgcolor="#FFFF00" class="negromid">Compa&ntilde;ia<span class="negromid">
        <?php //echo "$".number_format($Tcargos,2);?>
        <?php //echo "$".number_format( $Tabonos,2);
	  $t1=$TOTAL+$Tiva;?>
        <?php //echo "$".number_format($deposito[0],2);
	  //echo "Pago por Otros";
	  $t2=$Tabonos;?>
      </span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><span class="titulomedio">
        <?php  

			
		
		$ttP=$cargosParticularesCC->cargosParticularesCC($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos']);
		// $T=round($T,$ase);
		if($ttP){ 
		
		if($cargosParticularesCC->cargosParticularesCC($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos'])<0){
				$dev='si';
		$cantidadDevolucion=$cargosParticularesCC->cargosParticularesCC($entidad,$basedatos,$usuario,$myrow3['keyClientesInternos']);
		}else{
		$dev='';
		}
		
		?>
        <?php 	
        
		echo "$".number_format($cargosParticularesCC->cargosParticularesCC($entidad,$basedatos,$usuario,$keyClientesInternos),2);
		?>
        <?php 
		} else  { ?>
        <?php 
        print 'Agregar Abono';
		} 
		
		
		?>
      </span></td>
      <td><span class="titulomedio">
        <?php 
		$coaseguro=new acumulados();
		$ttCO=$coaseguro->cargosCoaseguro($entidad,$basedatos,$usuario,$keyClientesInternos);
		if($ttCO){    ?>
        <?php 
		echo "$".number_format($coaseguro->cargosCoaseguro($entidad,$basedatos,$usuario,$keyClientesInternos),2);?>
        <?php } else {
		
		echo "$".number_format($coaseguro->cargosCoaseguro($entidad,$basedatos,$usuario,$keyClientesInternos),2);
		}
		?>
      </span></td>
      <td><span class="titulomedio">
        <?php 
			  $ttCA=$cargosAseguradoraCC->cargosAseguradoraCC($entidad,$basedatos,$usuario,$keyClientesInternos );
		if($ttCA && !$coaseguro->cargosCoaseguro($entidad,$basedatos,$usuario,$keyClientesInternos)){ ?>
        <?php 
			echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($entidad,$basedatos,$usuario,$keyClientesInternos),2);?>
        <?php } else {
		
		echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($entidad,$basedatos,$usuario,$keyClientesInternos),2);
		}		
		?>
      </span></td>
    </tr>
    <tr>
      <td width="366"><?php 

if($sC>0){ ?></td>
      <td width="286"><blink></blink></td>
      <td width="123">&nbsp;</td>
      <td width="111">&nbsp;</td>
      <td width="104">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><span class="Estilo1">FALTAN ARTICULOS POR SURTIR...!</span></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><?php } ?>
      <?php 
$despliegaTotales=new totales();
$despliegaTotales-> tt($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$_GET['folioVenta'],$basedatos);
?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
        <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
        <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
        <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
        <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
      <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>

  <p align="center">&nbsp;</p>
</form>
</body>
</html>
