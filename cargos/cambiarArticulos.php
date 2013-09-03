<?php require("/configuracion/ventanasEmergentes.php");?>
<?php require("/configuracion/funciones.php");?>


<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","widtd=600,height=600,scrollbars=YES") 
} 
</script> 



<?php
if($_POST['cambiar']  and $_GET['keyCAP'] ){


if( $_POST['keyPA'] and $_POST['descripcion']){

$sSQL1= "Select * From clientesInternos WHERE keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();


//***********PRIMERAS BANDERAS*********
$numeroE=       $myrow1['numeroE'];
$_GET['numeroE']=$myrow1['numeroE'];
$nCuenta=		$myrow1['nCuenta'];
//*************************************



//***********CLAVE PRINCIPAL

$seguro=		$myrow1['seguro'];

//**************************

//************DECLARAMOS CLASES*********
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
//**************************************



//trae todos los movimientos


$sSQL1="select * from cargosCuentaPaciente where keyCAP=' "  .$_GET['keyCAP']." '";

//$sSQL1= "Select * From cargosCuentaPaciente WHERE keyCAP='103586'";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

//******LISTADO DE BANDERAS*****************
 $sSQL40= "
SELECT *
FROM
articulos
where 
keyPA='".$_POST['keyPA']."'";
$result40=mysql_db_query($basedatos,$sSQL40);
$myrow40 = mysql_fetch_array($result40);

$cLlave=new articulosDetalles();          //*
$keyPA=$_POST['keyPA'];  //*  
$codigo=     $myrow40['codigo']; //*
$almacen=    $myrow1['almacen'];          //*
//*******************************************


if(!$_POST['cantidad']){
$cantidad=   $myrow1['cantidad'];   
}else{
$cantidad=$_POST['cantidad'];
}

$gpoProducto=$myrow40['gpoProducto'];

//***********actualiza******************
$priceLevel=new articulosDetalles();
$priceLevel=$priceLevel->precioVenta($paquete,$_POST['generico'],$cantidad[$i],$numeroE,$_GET['keyClientesInternos'],$codigo,$almacen,$basedatos);



if($myrow1['cargoModificable']=='si'){

$priceLevel=$myrow1['precioVenta'];
}




$acumuladoGlobal=$global->precioGlobal($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cargos=$convenios->validacionConveniosNivel($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);

$tipoConvenio=$tipoConvenioS->tipoConvenio($entidad,$precioLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);



// son jubilados y trae seguro?
if($seguro){ 
if($validaJubilados->validacionJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos)=='si'){

 $percent=$porcentajeJubilados->porcentajeJubilados($_GET['numeroE'],$seguro,$entidad,$basedatos);
$percent*=0.01;

if($percent){
$cantidadAseguradora=$priceLevel*$percent;
$cantidadParticular=$priceLevel-$cantidadAseguradora;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($cantidad,$keyPA,$cantidadParticular,$basedatos);
}else{
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);

}
//$cantidadParticular=(($priceLevel*$cantidad[$i])+($iva*$cantidad[$i]))-$cantidadAseguradora;

} else {

if($tipoConvenio=='cantidad'){  
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
//aqui ninguna aseguradora absorbe nada, solo paga porque es fijo
$acumulado=$cantidadAseguradora;
$priceLevel=$acumulado;
 $ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$priceLevel,$basedatos); 
} else if($tipoConvenio=='grupoProducto'){

$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$cantidadAseguradora-$priceLevel;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='global'){ 
$cantidadAseguradora=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadParticular=$priceLevel-$cantidadAseguradora;

$ivaAseguradorat=$ivaAseguradora->ivaAseguradora($entidad,$cantidad,$keyPA,$cantidadAseguradora,$basedatos);
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else if($tipoConvenio=='precioEspecial'){


$acumulado=$cantidadParticular=$convenios->validacionConvenios($entidad,$cantidad,$iva,$priceLevel,$codigo,$almacen,$gpoProducto,$seguro,$basedatos);
$cantidadAseguradora=NULL;
$ivaParticulart=$ivaParticular->ivaParticular($entidad,$cantidad,$keyPA,$cantidadParticular,$basedatos);
} else { 
$cantidadParticular=NULL;
$ivaParticulart=NULL;
$cantidadAseguradora=$priceLevel;
$ivaAseguradorat=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos);  //iva total
}

}
} else {//solamente abre cuando trae seguro
$cantidadParticular=$priceLevel;
$ivaParticulart=$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos);  //iva total
$cantidadAseguradora=NULL;
$ivaAseguradorat=NULL;
}




if($acumuladoGlobal>$priceLevel){
$acumulado=$priceLevel;
} else {
$acumulado=$priceLevel;
}


$sSQL455= "Select clientePrincipal from clientes where entidad='".$entidad."' and numCliente='".$seguro."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);


$formaVenta->formaVenta($entidad,$seguro,$cantidad,$keyPA,$almacen,$basedatos);
if($myrow1['cargoModificable']!='si'){ 
if($seguro){
$q = "UPDATE cargosCuentaPaciente set 
cantidad='".$cantidad."',
descripcionArticulo='".$_POST['descripcion']."',
keyPA='".$keyPA."',
codProcedimiento='".$codigo."',
statusCargo='standby',
gpoProducto='".$gpoProducto."',
tipoCliente='aseguradora',
precioVenta='".$cantidadAseguradora."'+'".$cantidadParticular."',
seguro='".$seguro."',
iva='".$ivaAseguradorat."'+'".$ivaParticulart."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
clientePrincipal='".trim($myrow455['clientePrincipal'])."'
WHERE 
keyCAP='".$_GET['keyCAP']."'


";

} else {
$q = "UPDATE cargosCuentaPaciente set 
cantidad='".$cantidad."',
keyPA='".$keyPA."',
codProcedimiento='".$codigo."',
descripcionArticulo='".$_POST['descripcion']."',
statusCargo='standby',
gpoProducto='".$gpoProducto."',
precioVenta='".$priceLevel."',
seguro='".$seguro."',
iva='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."',
tipoCliente='particular',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
clientePrincipal=NULL,
ivaParticular='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."'
WHERE 
keyCAP='".$_GET['keyCAP']."'

";
//echo '<br>'.$q;

}
} else{//----------comparo el precio modificable
if($seguro){
$q = "UPDATE cargosCuentaPaciente set 
cantidad='".$cantidad."',
keyPA='".$keyPA."',
codProcedimiento='".$codigo."',
descripcionArticulo='".$_POST['descripcion']."',
statusCargo='standby',
gpoProducto='".$gpoProducto."',
tipoCliente='aseguradora',
precioVenta='".$cantidadAseguradora."'+'".$cantidadParticular."',
seguro='".$seguro."',
iva='".$ivaAseguradorat."'+'".$ivaParticulart."',
cantidadParticular='".$cantidadParticular."',
cantidadAseguradora='".$cantidadAseguradora."',
ivaParticular='".$ivaParticulart."',
ivaAseguradora='".$ivaAseguradorat."',
clientePrincipal='".$myrow455['clientePrincipal']."'
WHERE 
keyCAP='".$_GET['keyCAP']."'


";

} else {
$q = "UPDATE cargosCuentaPaciente set 
cantidad='".$cantidad."',
keyPA='".$keyPA."',
codProcedimiento='".$codigo."',
descripcionArticulo='".$_POST['descripcion']."',
statusCargo='standby',
gpoProducto='".$gpoProducto."',
precioVenta='".$priceLevel."',
seguro='".$seguro."',
iva='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."',
tipoCliente='particular',
cantidadParticular='".$priceLevel."',
cantidadAseguradora=NULL,
ivaAseguradora=NULL,
clientePrincipal=NULL,
ivaParticular='".$iva->iva($entidad,$cantidad,$codigo,$priceLevel,$basedatos)."'
WHERE 
keyCAP='".$_GET['keyCAP']."'

";

}

}
//***********ACTUALIZA SCRIPT CCP*************
mysql_db_query($basedatos,$q);
echo mysql_error();
//********************************************


}//cierra while

?>
<script>
window.opener.document.forms["form2"].submit();
window.alert("SE ACTUALIZO EL ARTICULO ");
window.close();
</script>

<?php
}else{ ?>
<script>

window.alert("Escoje bien el articulo de la lista..!");

</script>


<?php 
}


 }//*******Cierra actualizar*******?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<?php   
$sSQL2= "Select * From clientesInternos where keyClientesInternos='".$_GET['keyClientesInternos']."'";
$result2=mysql_db_query($basedatos,$sSQL2); 
$myrow2 = mysql_fetch_array($result2);
$paciente=$myrow2['paciente'];
?>
<form id="form1" name="form1" metdod="post" action="">

<h1 >Paciente: <?php echo $paciente;?></h1><br />
  <table widtd="473" class="table-forma">

     <tr>
       <td widtd="5"   scope="col">&nbsp;</td>
       <td colspan="2"  ><div align="left" >Escoje el articulo que desees cambiar </div></td>
     </tr>
     <tr>
       <td   scope="col">&nbsp;</td>
       <td widtd="54"   scope="col"><label></label></td>
       <td widtd="400"   scope="col"><div align="left" ><span >
         <input name="keyPA" type="text"  id="keyPA"   readonly=""
	/>
       </span></span></div>       </td>
    </tr>
     
	 
	 
	 <tr>
	 
       <td   scope="col">&nbsp;</td>
       <td   scope="col"><label>

       </label></td>
       <td valign="top"   scope="col"><div align="left" id="mostrar"><strong> </strong>
	  
               <label></label>
               <p>
                 <input name="descripcion" type="text" class="camposmid" id="descripcion" size="60"/>
        </p>
               <p>
                 <!-- div que mostrara la lista de coincidencias --><br />
          </p>
       </div></td>
     </tr>

	 
	 
     <tr>
       <td   scope="col">&nbsp;</td>
       <td  >&nbsp;</td>
       <td  ><label>Cantidad 
           <input name="cantidad" type="text" id="cantidad" size="3" />

	   </label></td>
     </tr>

  </table>

  <p>
    <input name="cambiar" type="submit" src="../../imagenes/btns/refresh.png" id="cambiar" value="Cambiar" onClick="if(confirm('Estas seguro que deseas Cambiar el articulo del paciente: <?php echo $paciente;?>?') == false){return false;}"/>
  </p>
</form>
  <script>
		new Autocomplete("descripcion", function() { 
			tdis.setValue = function( id ) {
				document.getElementsByName("keyPA")[0].value = id;
			}
			
			// If tde user modified tde text but doesn't select any new item, tden clean tde hidden value.
			if ( tdis.isModified )
				tdis.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if tdis request is not fired by search icon click
			if ( tdis.value.lengtd < 1 && tdis.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/articulosx.php?entidad=<?php echo $entidad;?>&q=" + tdis.value;
			// return "completeEmpName.php?q=" + tdis.value;
		});	
	</script>
</body>
</html>
