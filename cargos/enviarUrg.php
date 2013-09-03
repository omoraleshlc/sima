<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");





if($_POST['actualizar']  and $_POST['escoje']){


if($_POST['escoje']=='abierta'){
$q = "UPDATE clientesInternos set 
statusCuenta='abierta' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
}else if($_POST['escoje']=='revision'){
$q = "UPDATE clientesInternos set 
statusCuenta='revision' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	


}else if($_POST['escoje']=='caja'){
$q = "UPDATE clientesInternos set 
statusCuenta='caja' WHERE folioVenta='".$_GET['folioVenta']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	


}

?>



<script >
window.alert("La cuenta se fue a status: <?php echo $_POST['escoje'];?>");
   window.opener.document.forms["form1"].submit();
  window.close();
</script>
<?php 
}

?>



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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
<?php 
$sSQLe= "SELECT *
FROM
cargosCuentaPaciente 
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' 
    and
statusCargo!='cargado'    
";

$resulte=mysql_db_query($basedatos,$sSQLe);
$myrowe = mysql_fetch_array($resulte);

?>
    
    
    
    
    
<?php if(!$myrowe['folioVenta'])    {?>
    
<?php 
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."' ";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>
<form name="form1" method="post" action="">
  <table width="340" class="table-forma">

    <tr>
      <th colspan="2">
      <p align="center" >Enviar Cuenta del px <?php echo $myrow['paciente'];?> </p>      </th>
    </tr>
    <tr>
      <td width="90" ><label>
        <input name="escoje" type="radio" value="abierta" />
      </label></td>
      <td width="416">Cuenta Activa (Hacer Cargos) </td>
    </tr>

      <?php if($myrow['beneficencia']=='si'){ ?>
      <tr>
      <td ><input name="escoje" type="radio" value="revision" disabled="" /></td>
      <td>--La Cuenta es de Beneficencia--</td>
 
    </tr>

      <?php }else{ ?>
    <tr>
      <td ><input name="escoje" type="radio" value="revision" /></td>
      <td>Cuenta en Revision (Cargar Coaseguro) </td>
    </tr>
      <?php } ?>

    <tr>
      <td ><input name="escoje" type="radio" value="caja" /></td>
      <td>Enviar a Caja </td>
    </tr>
  </table>
  <p align="center">
  

    <label>
    <input name="actualizar" type="submit"  id="actualizar" value="Enviar">
    </label>
  </p>
</form>

      
      
      
      
      
      
      
      
      
      
      
      
      <?php } else {?>
    
     <table width="700" class="table-forma">

    <tr>
      <td colspan="7"  align="center"><span >Paciente: <?php echo $_GET['paciente'];?></span><span > <?php echo $paciente; ?></span></td>
    </tr>
    <tr>
      <td height="24" colspan="7" align="center" >Limite: <?php echo '$'.number_format($myrow31['limiteSeguro'],2); ?></td>
    </tr>
    <tr >
      <td width="72"  align="center">Hora/Fecha</td>
      <td width="244" >Descripcion</td>
          <td width="38" align="center" >Antibiotico</td>
      <td width="29" align="center" >Cant</td>
      <td width="53" align="right" >Part</td>
      <td width="57" align="right" >Aseg</td>
      <td width="198" align="center" >Almacen</td>

  
    </tr>
         
         
         
         
         
         
         
         
        <?php  
$sSQL= "SELECT 
* 
FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."' 
    and
    folioVenta='".$_GET['folioVenta']."'
AND
statusCargo!='cargado'

group by keyPA
order by fecha1,hora1 ASC

";



$result=mysql_db_query($basedatos,$sSQL);
     

while($myrow = mysql_fetch_array($result)){ 
$keyCAP=$myrow['keyCAP'];
$bandera+=1;
$gpoProducto=$myrow['gpoProducto'];
$codigo=$myrow['codProcedimiento'];



//traigo descuento


//cierro descuento


if($col){
$color = '#FFCCFF';
$col='';
} else {
$color = '#FFFFFF';
$col = 1;
}

if($myrow['status']=='cancelado'){
$color='#FF0000';
$col = "";
}



$sSQL14n= "
SELECT 
sum(cantidad) as c
FROM
cargosCuentaPaciente
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
keyPA='".$myrow['keyPA']."'
    and
    statusCargo!='cargado'
";
$result14n=mysql_db_query($basedatos,$sSQL14n);
$myrow14n = mysql_fetch_array($result14n);

?>
    <tr  >
      <td height="55"  align="center">
      <?php 
		  if($myrow['um']='s'  ){ ?>
		  	        <a href="javascript:ventanaSecundaria8('ventanCambiaFecha.php?keyCAP=<?php echo $myrow['keyCAP']; ?>&almacenDestino=<?php echo $myrow['almacenDestino']; ?>&expediente=<?php echo 'no'; ?>&keyClientesInternos=<?php echo $myrow112['keyClientesInternos']; ?>&numeroExpediente=<?php echo $myrow112['numeroE']; ?>&seguro=<?php echo $_POST['seguro']; ?>&firstTime=<?php echo $firstTime;?>')">
					
					
          <?php 
		  if($myrow['horaSolicitud'] and $myrow['fechaSolicitud']){
		  echo $myrow['horaSolicitud']." ".$myrow['fechaSolicitud']; 
		 }else {
		 echo $myrow['hora1']." ".$myrow['fecha1'];
		 }
		  ?>          
		  
		  <?php } else { ?>
		 
		            <?php  echo $myrow['hora1']." ".$myrow['fecha1'];  ?>          
					
					<?php } ?></a>
		  
		  
		  
		  
		  <input name="codigoArt[]" type="hidden" id="codigoArt[]" value="<?php  echo $myrow['codProcedimiento']; ?>" />        
      
      </td>
      <td >
      <?php 
		if($myrow['tipoTransaccion'] and !$myrow11['descripcion']){
		echo "Deposito o Movimiento de Caja" ;
		} else {
			
			
			
			$sSQL31c= "Select modificarPrecios From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow['almacenDestino']."' ";
$result31c=mysql_db_query($basedatos,$sSQL31c);
$myrow31c = mysql_fetch_array($result31c);

if($myrow31c['modificarPrecios']=='si'){ ?>

<a   href="javascript:ventanaSecundaria8('ventanCambiaLaboratorioReferido.php?keyCAP=<?php echo $keyCAP; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $C; ?>&amp;criterio=<?php echo $_GET["criterio"];?>&keyClientesInternos=<?php echo $_GET['keyClientesInternos'];?>')">

<?php

echo $myrow['descripcionArticulo'];

?>
</a>
<?php 
						} else {

					echo $myrow['descripcionArticulo'];
	}	
		
		}
		?>
		<?php if($myrow['status']=='cancelado'){ ?>
		  <span class="Estilo25"><blink><?php echo '(Art�culo Cancelado por '.$myrow['usuarioCancela'].')';?></blink></span>
		<?php } ?>
		
		<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>		
        <?php echo '</br>'.'usuario solicita: ['.$myrow['usuario'].']';?>        
        </br>
        <span >Movto N&deg;: <?php echo $myrow['keyCAP'];?></span>
		<?php if($myrow['statusDescuentoGlobal']=='si'){
		echo '</br><span class="informativo">'.' ['.$myrow['descripcionDescuentoGlobal'].']'.'</span>';
		}
		?></td>




      <?php 
      $sSQL3115= "Select farmacia From almacenes WHERE entidad='".$entidad."' and
farmacia='si'  ";
$result3115=mysql_db_query($basedatos,$sSQL3115);
$myrow3115 = mysql_fetch_array($result3115);



 ?>



    <td  align="left">
<?php if($myrow['antibiotico']=='si'){?>
        <?php
          $sSQL1e= "Select * From antibioticos WHERE entidad='".$entidad."' and keyClientesInternos='".$_GET['keyClientesInternos']."' and keyPA='".$myrow['keyPA']."'";
$result1e=mysql_db_query($basedatos,$sSQL1e);
$myrow1e = mysql_fetch_array($result1e);?>


<?php if($myrow1e['keyClientesInternos']==NULL){ $anti+=1;  }?>
        <a href="javascript:ventanaSecundaria8a('catalogoantibiotico.php?keyCAP=<?php echo $myrow['keyCAP']; ?>
           &almacenDestino=<?php echo $myrow['almacenDestino']; ?>
           &expediente=<?php echo 'no'; ?>
           &keyClientesInternos=<?php echo $_GET['keyClientesInternos']; ?>
           &keyCAP=<?php echo $myrow['keyCAP']; ?>
           &seguro=<?php echo $_POST['seguro']; ?>
           &cantidadpiezas=<?php echo $myrow14n['c'];?>
&descripcion=<?php echo $myrow['descripcionArticulo'];?>
&paciente=<?php echo $paciente;?>
&numeroE=<?php echo $myrow31['numeroE'];?>
&keyPA=<?php echo $myrow['keyPA'];?>
&almacen=<?php echo $_GET['almacen'];?>
')">

     Edit
        </a>
      



<?php }else{
echo '---';
}
    ?>
      </td>














      <td  align="center">
      <?php if($myrow14n['c']>0){
$myrow['cantidad']=$myrow14n['c'];
echo $myrow14n['c'];
} else {
echo "N/A";
}




?>
      
      </td>
      <td  align="right"><?php 
		$totalP[0]+=($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2); ?></td>




        <td  align="right">
      <?php $totalA[0]+=($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']);
		echo "$".number_format(($myrow['cantidadAseguradora']*$myrow['cantidad'])+($myrow['ivaAseguradora']*$myrow['cantidad']),2); ?>
      </td>




        <td  align="center">
      <?php 
		$sSQL31= "SELECT 
descripcion
FROM almacenes
WHERE 
entidad='".$entidad."'
and
almacen ='".$myrow['almacenDestino']."'";

$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

		echo $myrow31['descripcion']; ?>
      </td>















    </tr>
    <?php }?>

  </table>

  <table width="707"  >
	<tr  >
<?php 
$tipoMensaje='error';
$encabezado='Error';
$texto='FAVOR DE ELIMINAR O CARGAR ESTOS ARTICULOS, GRACIAS!...';
?>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>

        </tr>
      
  </table>
    <?php } ?>

</body>
</html>