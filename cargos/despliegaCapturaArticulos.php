<?php //include('/configuracion/ventanasEmergentes.php');?>

<table width="560" border="0" align="center">
  <tr>
    <th width="344" bgcolor="#660066" scope="col" class="blanco"><div align="left">Descripci&oacute;n</div></th>
    <th width="59" bgcolor="#660066" scope="col" class="blanco"><div align="left">Precio S/IVA</div></th>
    <th width="41" bgcolor="#660066" scope="col" class="blanco">Cantidad</th>
    <th width="27" bgcolor="#660066" scope="col" class="blanco">Status</th>
  </tr>
  <tr>
    <?php	$_POST['almacenDestino']=$_GET['almacenDestino'];
$_POST['almacenDestino1']=$_GET['almacenDestino1'];


if($_POST['almacenDestino1']){
$almacen=	  $_POST['almacenDestino1'];
} else {
$almacen=$_POST['almacenDestino'];
}



//*********************NUCLEO***********************



if($_POST['todo']=='todo'){

 $sSQL= "SELECT 
articulos.codigo,articulos.gpoProducto,articulos.laboratorioReferido
FROM articulos,existencias
WHERE
articulos.entidad='".$entidad."' AND 
articulos.activo='A'
and
articulos.codigo=existencias.codigo and
existencias.almacen='".$almacen."'
and
articulos.paquete='no'
order by articulos.descripcion ASC
";
$_POST['nomArticulo']='todo';
} else if(($_POST['buscar']) OR ($_POST['nomArticulo'] OR $_POST['cbarra'])){
$articulo=$_POST['nomArticulo'];



$sSQL= "SELECT 
articulos.codigo,articulos.gpoProducto,articulos.laboratorioReferido
FROM articulos,existencias
WHERE
articulos.entidad='".$entidad."' AND 
articulos.activo='A' and
articulos.descripcion like '%$articulo%'

and
articulos.codigo=existencias.codigo and
existencias.almacen='".$almacen."'
and
articulos.paquete='no'
";

}
//****************CIERRA NUCLEO****************



if($_POST['nomArticulo'] ){

if($result=mysql_db_query($basedatos,$sSQL)){



while($myrow = mysql_fetch_array($result)){ 
//*********************************INSTANCIAS
$unidadMedida=new articulosDetalles();
$statusExistencias=new articulosDetalles();
$convenios= new validaConvenios();
$global= new validaConvenios();
$tipoConvenioS=new validaConvenios();
$traeConvenio=new validaConvenios();
$vConvenio=new validaConvenios();
$um=new articulosDetalles();
$traeSeguro=new verificaSeguro1();
$priceLevel=new articulosDetalles();
$verificaSaldosInternos=new verificaSeguro1();
$iva=new articulosDetalles();
$descripcion=new articulosDetalles();

//*******************************CIERRA INSTANCIAS
$bandera+="1";
$i+=1;
$code1=$myrow['codigo'];
$codigo=$myrow['codigo'];
//*************************************CONVENIOS********************************************



//cierro descuento

if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

//*******************************CONVENIOS*******************************
$numeroE=$numeroPaciente=$myrow311['numeroE'];
$nCuenta=$myrow311['nCuenta'];



$um=$um->um($codigo,$basedatos);  
$cantidad=1;

$seguro=$traeSeguro->traeSeguro($numeroPaciente,$nCuenta,$basedatos);
//$priceLevel=$convenios->validacionConvenios($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);

$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],$cantidad,$numeroE,$nCuenta,$codigo,$almacen,$basedatos);




$acumuladoGlobal=$global->precioGlobal($precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//$traeConvenio=$traeConvenio->traeConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);
$tipoConvenio=$tipoConvenioS->tipoConvenio($precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//$vConvenio=$vConvenio->vConvenio($precioLevel,$codigo[$i],$almacen,$gpoProducto,$seguro,$basedatos);


if($tipoConvenio=='cantidad'){
$cantidadAseguradora=$convenios->validacionConvenios($cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo

$acumulado=$cantidadAseguradora*$cantidad;
 $priceLevel=$acumulado;

} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$priceLevel=$cantidadParticular=$cantidadAseguradora-(($priceLevel*$cantidad)+($iva*$cantidad));
} else if($tipoConvenio=='global'){

$cantidadAseguradora=$convenios->validacionConvenios($cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//***************checo si trae algun valor
if($priceLevel){
$priceLevel=$cantidadParticular=(($priceLevel*$cantidad)+($iva*$cantidad))-$cantidadAseguradora;
}
//************************************************
} else {
$cantidadParticular=NULL;
$cantidadAseguradora=NULL;
}



$iva=$iva->iva($cantidad,$codigo,$priceLevel,$basedatos);  
//**********************************************************************************************************


$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);



?>
    <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codigo']; ?>" />
    <input name="codigoBeta[]" type="hidden" id="codigoBeta[]" value="<?php  echo $myrow['codigo']; ?>" />
    <td></td>
    <td bgcolor="<?php echo $color;?>" class="normal"><?php 
					
					$descripcion->descripcion($keyCAP,$numeroE,$nCuenta,$codigo,$basedatos);
		
		?>
        <?php 
		if($myrow['paquete']=='si'){
		echo '<img src="/sima/imagenes/p.jpeg" width="12" height="12" alt="ES UN PAQUETE" />';

		}
		
		if($myrow['gpoProducto']){
		echo '['.$myrow['gpoProducto'].']';
		}
		?>
        <?php if( $myrow['generico']=='si'){?>
        <blink> <img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" /> </blink>
        <?php } else { echo '';}?>
        <?php 
		if( $myrow['laboratorioReferido']=='si'){
		echo '<span class="style1">'.'<blink>'.'Estudio Referido'.'</blink>'.'</span>';
		}
		
		?>
        </span> </td>
    <td bgcolor="<?php echo $color;?>" class="cargos" align="right"><?php 

echo "$".number_format($priceLevel,2);
?>
    </td>
    <td bgcolor="<?php echo $color;?>" align="center"><?php 

?>
        <input name="cantidad[]" type="text" class="campos" id="cantidad" 
onkeypress="return checkIt(event)" size="2" maxlength="2"
autocomplete="off" <?php 
if(!$priceLevel){
echo 'readonly=""';
} else {
echo $statusExistencias->statusExistencias($unidadMedida->unidadMedida($codigo,$basedatos),$almacen,$codigo,$basedatos);
}
?>/></td>
    <td bgcolor="<?php echo $color;?>" class="Estilo24"><div align="center">
      <?php if( $myrow['gpoProducto']){ $errores1='No tiene grupo de producto';}
if($statusExistencias->statusExistencias($myrow['servicio'],$almacen,$myrow['codigo'],$basedatos)=='readonly' 
and $myrow['gpoProducto']) { 
		$errores='No hay existencias en el almacen: '.$almacen; ?>
      <?php if(!$priceLevel){ ?>
      <a href="javascript:ventanaSecundaria20('/sima/cargos/ventanaErrores.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;error=<?php echo $errores; ?>&amp;error1=<?php echo $errores1; ?>')"> <img src="/sima/imagenes/btns/checkbtn.png" width="24" height="24" border="0" alt="ERRORES" /></a>
      <?php } else { ?>
      <img src="/sima/imagenes/btns/stopbtn.png" width="22" height="22" alt="OK" />
      <?php } ?>
      <?php 
		} else {
		echo '<img src="/sima/imagenes/btns/checkbtn.png" width="22" height="22" alt="OK" />';
		}
		?>
      &nbsp;</div></td>
  </tr>
  <?php }}?>
</table>

