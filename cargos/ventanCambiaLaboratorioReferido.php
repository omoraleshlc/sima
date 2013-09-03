<?php require('/configuracion/ventanasEmergentes.php');require('/configuracion/funciones.php');?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=420,height=350,scrollbars=YES") 
} 
</script> 



<?php 




if($_POST['actualizar'] and $_POST['precioVenta']>1){ 
//************DECLARAMOS CLASES*********
$sSQL1= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();



$iva=new articulosDetalles();
$ivaParticular=new ivaCierre();
$ivaAseguradora=new ivaCierre();
$formaVenta=new ivaCierre();
$precioVenta=new articulosDetalles();
$convenios=      new validaConvenios();
$global=         new validaConvenios();
$tipoConvenioS=  new validaConvenios();
$traeConvenio=   new validaConvenios();
$vConvenio=      new validaConvenios();
$verificaSaldos1=new verificaSeguro1();
$traeSeguro=new verificaSeguro1();
$verificaSaldosInternos=new verificaSeguro1();
$validaJubilados=new validaConvenios();
$porcentajeJubilados=new validaConvenios();
$ivaAseguradora=new ivaCierre();
$ivaParticular=new ivaCierre();
$seguro=$myrow1['seguro'];
$pagoEfectivo=new ivaCierre();
//**************************************


//*************************ACTUALIZA GRUPO DE PRODUCTO**********************

$sSQL31= "Select tipoPaciente,numeroE From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
$_GET['numeroE']=$myrow31['numeroE'];
//trae todos los movimientos
$ivaD=new articulosDetalles();
$iva=$ivaD->ivaDirecto($entidad,$_POST['gpoProducto'],$_POST['precioVenta'],$basedatos); 
//********************************************





$sSQL1= "Select * From cargosCuentaPaciente WHERE 
keyCAP='".$_GET['keyCAP']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

//******LISTADO DE BANDERAS******************
$keyPA=      $myrow1['keyPA'];            //*  
$codigo=     $myrow1['codProcedimiento']; //*
$gpoProducto=$myrow1['gpoProducto'];       //*
$almacen=    $myrow1['almacen'];          //*
$cantidad=   $myrow1['cantidad'];         //*
//*******************************************



//***********actualiza******************
//$priceLevel=new articulosDetalles();
//$priceLevel=$priceLevel->precioVentaDirecto($seguro,$paquete,$_POST['generico'],$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos);
$priceLevel=$_POST['precioVenta'];

$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);



// son jubilados y trae seguro?
if($seguro){ 




if($validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){

$percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos);
$percent*=0.01;
$porcentajeParticular= (100-($percent*100))*0.01;


$ivaParticulart=$iva*$porcentajeParticular;
$ivaAseguradorat=$iva*$percent;





$cantidadAseguradora=$priceLevel*$percent;
$cantidadParticular=$priceLevel-$cantidadAseguradora;
//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

} else { 

if($tipoConvenio=='cantidad'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora;
$priceLevel=$acumulado;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradoraGP($entidad,$cantidad,$gpoProducto,$priceLevel,$basedatos); 
} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$cantidadAseguradora-$priceLevel;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradoraGP($entidad,$cantidad,$gpoProducto,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticularGP($entidad,$cantidad,$gpoProducto,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='global'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$priceLevel-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradoraGP($entidad,$cantidad,$gpoProducto,$cantidadAseguradora,$basedatos);
 $ivaParticulart=$ivaParticular->ivaParticularGP($entidad,$cantidad,$gpoProducto,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='precioEspecial'){

if($pagoEfectivo->pagoEfectivo($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos)=='si'){



$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$cantidadAseguradora=NULL;

$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);

$ivaAseguradorat=$iva;



} else{



$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);

$cantidadParticular=NULL;

$ivaParticular=NULL;



}    
    
    
    
    
} else { 
$cantidadParticular=NULL;
$ivaParticulart=NULL;
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$ivaD->ivaDirecto($entidad,$_POST['gpoProducto'],$_POST['precioVenta'],$basedatos); 


}

}
} else {//solamente abre cuando trae seguro
$cantidadParticular=$priceLevel;
$ivaParticulart=$iva;
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
}




if($acumuladoGlobal>$priceLevel){
$acumulado=$priceLevel;
} else {
$acumulado=$priceLevel;
}


$formaVenta->formaVenta($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos);
$PV=$cantidadAseguradora+$cantidadParticular;
$IVA=$ivaAseguradorat+$ivaParticulart;


if($seguro){

$q = "UPDATE cargosCuentaPaciente set 
descripcion='".$_POST['descripcion']."',descripcionArticulo='".$_POST['descripcion']."',
precioVenta='".$PV."',
iva='".$ivaD->ivaDirecto($entidad,$_POST['gpoProducto'],$_POST['precioVenta'],$basedatos)."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
cargoModificable='si',
statusAutorizacion='".$usuario."'
WHERE 
keyCAP='".$_GET['keyCAP']."'";

} else {

$q = "UPDATE cargosCuentaPaciente set 
precioVenta='".$priceLevel."',
descripcion='".$_POST['descripcion']."',descripcionArticulo='".$_POST['descripcion']."',
iva='".$ivaD->ivaDirecto($entidad,$_POST['gpoProducto'],$_POST['precioVenta'],$basedatos)."',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
ivaParticular='".$ivaD->ivaDirecto($entidad,$_POST['gpoProducto'],$_POST['precioVenta'],$basedatos)."',
cargoModificable='si'
WHERE 
keyCAP='".$_GET['keyCAP']."'";

}


//***********ACTUALIZA SCRIPT CCP*************
mysql_db_query($basedatos,$q);
echo mysql_error();
//********************************************


}//cierra while?>

<script>
window.alert("Se actualizaron datos...");
window.opener.document.forms["form1"].submit();
window.close();
</script>

<?php 
}
?>



<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php 
$sSQL3= "SELECT 
laboratorioReferido
FROM cargosCuentaPaciente
WHERE keyCAP ='".$_GET['keyCAP']."'";

$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



$sSQL31= "SELECT 
*
FROM cargosCuentaPaciente
WHERE keyCAP ='".$_GET['keyCAP']."'";

$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>

<body >
<form name="form1" method="post">
  <p align="center" ><strong> Referir Estudio </strong></p>
  <table width="364" border="3" align="center" cellpadding="1" cellspacing="1" class="style71">
    <tr>
      <td width="105" scope="col"><div align="left" >Descripci&oacute;n</div></td>
      <td width="249" scope="col"><div align="left">
<textarea name="descripcion" cols="40"  id="descripcion"><?php echo $myrow31['descripcionArticulo'];?></textarea>
          </div>
      </label></td>
    </tr>
    <tr>
      <td scope="col">Procedimientos</td>
      <td scope="col">
<textarea name="descripcion2" cols="40"  id="descripcion2"></textarea></td>
    </tr>
    <tr>
      <td scope="col"><div align="left" >Precio de Venta </span></div></td>
      <td scope="col"><div align="left">
        <label>
        <input name="precioVenta" type="text"  id="precioVenta" value="<?php echo $myrow31['precioVenta'];?>">
        </label>
      </div></td>
    </tr>
  </table>
  <p align="center"><label>
    <input name="actualizar" type="submit" class="boton1" id="actualizar" value="Aplicar Cambios">
    </label>
    <span >
    <input name="codigo" type="hidden"  id="codigo"    />
	 <input name="gpoProducto" type="hidden"  id="codigo"    value="<?php echo $myrow31['gpoProducto'];?>">
    </span></p>
</form>
<p>&nbsp;</p>

  <script>
		new Autocomplete("descripcion2", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("codigo")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/procedimientosx.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</body>
 