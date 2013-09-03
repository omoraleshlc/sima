<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

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
folioVenta='".$folioVenta."'

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
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label></p>
  
<form id="form2" name="form2" method="post" action="" onSubmit="return valida(this);">
  <table width="513" border="0" align="center">
    <tr>
      <th colspan="2" scope="col"><div align="center"><img src="/sima/imagenes/bordestablas/borde1.png" width="500" height="32" /></div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left" class="blanco">Folio de Venta</div></th>
      <th scope="col"><div align="left"><span class="normal"><?php echo $myrow['folioVenta']; ?></span></div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left"><span class="blanco">Paciente</span></div></th>
      <th scope="col"><div align="left"><span class="normal"><?php echo $myrow['paciente']; ?></span></div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left"><span class="blanco">Departamento Internamiento</span></div></th>
      <th scope="col"><div align="left" class="normal"><?php $id_almacen=$myrow['almacen']; 
	  $sSQL1= "SELECT almacen,descripcion
FROM
almacenes
WHERE 
almacen='".$id_almacen."'
 ";

$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo $myrow1['almacen']." - ".$myrow1['descripcion'];
	  ?></div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left"><span class="blanco"> Seguro </span></div></th>
      <th scope="col"><div align="left"><span class="normal"><?php 
	  $seguro1=$myrow['seguro'];
	 
$sSQL4= "SELECT nomCliente
	FROM
	clientes 
	where
	numCliente='".$seguro1."'";
	
	$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);
	 
	 echo $myrow4['nomCliente']; ?>
	  </span>
          </label>
      </div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left"><span class="blanco">Credencial</span></div></th>
      <th scope="col"><div align="left"><span class="normal"><?php echo $myrow['credencial']; ?></span></div></th>
    </tr>
    <tr>
      <th width="171" bgcolor="#330099" scope="col"><div align="left"><span class="blanco">Fecha/Hora Internamiento</span></div></th>
      <th width="332" scope="col"><div align="left"><span class="normal"><?php echo $myrow['fecha']." / ".$myrow['hora']; ?></span></div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left" class="blanco">Medico Internamiento</div></th>
      <th scope="col"><div align="left"><span class="normal">
	  
	 <?php 
	 
	 $medico1=$myrow['medico'];
	 
	$sSQL3= "SELECT descripcion
	FROM
	almacenes 
	where
	almacen='".$medico1."'";
	
	$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
	 
	 echo $myrow3['descripcion']; ?>
     
     
     </span></div></th>
    </tr>
    <tr>
      <th bgcolor="#330099" scope="col"><div align="left" class="blanco">Diagn&oacute;stico</div></th>
      <th scope="col"><div align="left"><span class="normal"><?php echo $myrow['dx']; ?></span></div></th>
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




 
  



<?php 

if($sC>0){ ?>
<p>&nbsp;</p>

<p align="center"><blink><span class="Estilo1">FALTAN ARTICULOS POR SURTIR...!</span></blink><br />
</p>
<?php } ?>





<?php 
$despliegaTotales=new totales();
$despliegaTotales-> tt($entidad,$class,$estilo,$fechas1,$fechas2,$keyClientesInternos,$_GET['folioVenta'],$basedatos);
?>



  <p align="center">&nbsp;</p>
  <p>
      <input name="gpoProducto" type="hidden" id="numPaciente2" value="<?php echo $gpoProducto; ?>" />
      <input name="numeroMedico1" type="hidden" id="numeroMedico1" value="<?php echo $numeroMedico; ?>" />
      <input name="nombreDelPaciente2" type="hidden" id="nombreDelPaciente2" value="<?php echo $nombreDelPaciente; ?>" />
      <input name="extension2" type="hidden" id="extension2" value="<?php echo $extension; ?>" />
      <input name="segu1" type="hidden" id="segu1" value="<?php echo $segu; ?>" />
      <input name="bandera" type="hidden" id="numPaciente22" value="<?php echo $bandera; ?>" />
</p>
</form>
  <p></p>
  
  <table width="86%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th width="15%" scope="col"> <table width="94" border="0" align="left">
          <tr bgcolor="#660066">
            <th class="blanco" scope="col"> Particular<a href="#particular" name="particular" id="particular" onClick="javascript:ventanaSecundaria7('/sima/INGRESOS%20HLC/caja/ventanaAplicaPagoInternos.php?numeroE=<?php echo $numeroE; ?>
&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;nCuenta=<?php echo $myrow3['keyClientesInternos'];?>&amp;tipoCliente=<?php echo 'particular';?>')"> </a></th>
          </tr>
          <tr>
            <th width="98" bgcolor="#660066" class="blanco" scope="col"> Total a pagar </th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
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
            </span></div></td>
          </tr>
      </table></th>
      <th width="2%" scope="col">&nbsp;</th>
      <th width="31%" scope="col">&nbsp;</th>
      <th width="2%" scope="col">&nbsp;</th>
      <th width="5%" scope="col">&nbsp;</th>
      <th width="16%" scope="col"><table width="94" border="0">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco">D.Coaseguro </span></th>
          </tr>
          <tr>
            <th width="88" bgcolor="#660066"  scope="col"><span class="blanco">Total a pagar </span></th>
          </tr>
          <tr>
            <td><div align="center"><span class="normal">
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
            </span></div></td>
          </tr>
      </table></th>
      <th width="14%" scope="col"><table width="94" border="0" align="right">
          <tr>
            <th bgcolor="#660066"  scope="col"><span class="blanco"> Compa&ntilde;&iacute;a
              <?php //echo "$".number_format($Tcargos,2);?>
                  <?php //echo "$".number_format( $Tabonos,2);
	  $t1=$TOTAL+$Tiva;?>
                  <?php //echo "$".number_format($deposito[0],2);
	  //echo "Pago por Otros";
	  $t2=$Tabonos;?>
            </span></th>
          </tr>
          <tr>
            <th width="172" bgcolor="#660066" class="blanco" scope="col">Saldo Cia. </th>
          </tr>
          <tr>
            <td><span class="normal">
              <?php 
			  $ttCA=$cargosAseguradoraCC->cargosAseguradoraCC($entidad,$basedatos,$usuario,$keyClientesInternos );
		if($ttCA && !$coaseguro->cargosCoaseguro($entidad,$basedatos,$usuario,$keyClientesInternos)){ ?>
              <?php 
			echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($entidad,$basedatos,$usuario,$keyClientesInternos),2);?>
              <?php } else {
		
		echo "$".number_format($cargosAseguradoraCC->cargosAseguradoraCC($entidad,$basedatos,$usuario,$keyClientesInternos),2);
		}		
		?>
            </span> </td>
          </tr>
      </table></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
  
</body>
</html>