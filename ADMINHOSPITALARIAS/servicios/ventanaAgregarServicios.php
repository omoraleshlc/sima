<?php require('/configuracion/ventanasEmergentes.php');?>

<?php

if($_POST['sendInvoice'] and $_POST['descripcion'] and $_POST['keyPA'] ){


$sSQL12= "
	SELECT *
FROM
  articulos
WHERE
keyPA='".$_POST['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

if($_POST['almacen']!='HALM'){
    $_GET['departamento']=$_POST['almacenDestino'];
}







$sSQL39e= "
	SELECT
tasaGP,descripcionGP
FROM
gpoProductos
WHERE
entidad='".$entidad."'
and
codigoGP='".$myrow12['gpoProducto']."'";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);

if($myrow39e['tasaGP']>0){
    $iva=$_POST['precioCosto']*($myrow39e['tasaGP']*0.01);
}

$agregaSaldo = "
    INSERT INTO OC ( id_requisicion,id_almacen,usuario,fecha,hora,status,prioridad,id_proveedor,
    entidad,numFactura,keyPA,cantidadParticular,cantidadAseguradora,
    descripcionArticulo,cantidad,cbarra,codigo,precioCosto,iva,notaCredito,preciosugerido,lote,fechacaducidad,descuentoPorcentaje

) values (

'".$_GET['req']."','".$_GET['departamento']."','".$usuario."','".$fecha1."','".$hora1."','request',
'".$_POST['prioridad']."','".$_GET['proveedor']."','".$entidad."','".$_GET['id_factura']."',
    '".$_POST['keyPA']."' ,'0.00','0.00','".$myrow12['descripcion']."' ,
        '".$_POST['cantidad']."','".$myrow12['cbarra']."' ,
        '".$myrow12['codigo']."','".$_POST['precioCosto']."','".$iva."','".$_POST['notaCredito']."',
            '".$_POST['preciosugerido']."','".$_POST['lote']."','".$_POST['fechacaducidad']."','".$_POST['descuento']."')";
mysql_db_query($basedatos,$agregaSaldo);
echo mysql_error(); ?>
<script>

window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php 
}
?>







 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
        <?php
$estilos=new muestraEstilos();
$estilos->styles();

?>
</head>

<body>

	
    <form id="form1" name="form1" method="post" >
      <p align="center">Agregar Servicios</p>
      <div align="center">
	  
	  
	  







          <table width="276" style="border: 1px solid #000000;">
          <tr >


		   <?php

	  $sSQL12= "
	SELECT razonSocial
FROM
proveedores
WHERE
entidad='".$entidad."'
and
id_proveedor='".$_GET['proveedor']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
	  ?>

<td colspan="2" class="normal" scope="col">



    <div align="center">
        Proveedor: <?php echo $myrow12['razonSocial'];?>, # Factura <?php echo $_GET['id_factura'];?>
    </div>
</td>
    </tr>


          <tr>
            <th width="1" class="normal" scope="col">
                <div align="center">

                </div>
            </th>



            <td width="265" class="negromid">
                <div align="center">
                    <span class="normal">
                        Codigo
              <input name="keyPA" type="text" class="camposmid" id="keyPA"  readonly="" value="<?php echo $_POST['keyPA'];?>" />
            </span>
                </div>
            </td>
          </tr>




          <tr>
            <th class="normal" scope="col">
                &nbsp;
            </th>

            <td rowspan="2" class="normal">
                <span class="normal">
              <textarea name="descripcion" cols="60" class="camposmid" <?php if($_POST['send']!=NULL){ echo 'readonly=""';}?>/><?php echo $_POST['descripcion'];?></textarea>
              
              
            </span>
            </td>
          </tr>











    






              
    <?php if(!$_POST['descripcion']){ ?>
            <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
            
              <input name="send" value="Detalles" type="submit" class="camposmid"  />
            </td>
             </th>

          </tr>
            </td>
<?php } ?>


    
              </table>
      </div>


















































      <?php if($_POST['send'] and $_POST['descripcion']) { ?>
      <p align="center">
      
          <table width="276" style="border: 1px solid #000000;">




              







































          <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
           Descuento %
              <input name="descuento" type="text" class="camposmid" size="4" value="<?php echo $_POST['descuento'];?>"  />
            </td>
             </th>

          </tr>
            </td>


          <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
           #Lote
              <input name="lote" type="text" class="camposmid" size="4" value="<?php echo $_POST['lote'];?>"  />
            </td>
             </th>

          </tr>
            </td>
              
              
              
                        <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
          Precio Sugerido
              <input name="preciosugerido" type="text" class="camposmid" size="4" value="<?php echo $_POST['preciosugerido'];?>"  />
            </td>
             </th>

          </tr>
            </td>
              
              
      

            
                        <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
          FechaCaducidad
              <input  name="fechacaducidad" type="text" class="normal" id="campo_fecha" size="10" maxlength="9" readonly=""
		/>
               <input name="button" type="image" src="../../imagenes/calendario.png" class="normal" id="lanzador" value="..." />
            </td>
            
             </th>

          </tr>
            </td>
    
    
    


                        <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
           Nota de Credito
              <input name="notaCredito" type="checkbox" class="camposmid" size="4" value="si" <?php if($_POST['notaCredito']=='si'){echo 'checked="checked"';}?>  />
            </td>
             </th>

          </tr>
            </td>




                        <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
           Departamento defalut(CENDIS)
<?php 
$aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si'
and
(almacen='HALM' or almacen='HFARVP')

order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" class="normal" />


        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if( $resCombo['almacen']=='HALM' and !$_POST['almacenDestino']){

		echo 'selected="selected"';
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
            </td>
             </th>

          </tr>
            </td>



    
            <td>
          <tr>

              <th width="1" class="normal" scope="col">

            <td class="normal">
            
              <input name="sendInvoice" value="Enviar A Factura" type="submit" class="camposmid"  />
            </td>
             </th>

          </tr>
            </td>



    
              </table>
<?php } ?>

      </p>

      



    </form>


    
<p>&nbsp;</p>
<p>&nbsp;</p>


              
    <?php if($_POST['descripcion']){ ?>
    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
<?php } ?>


<script>
		new Autocomplete("descripcion", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("keyPA")[0].value = id;
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
			return "/sima/cargos/articulosx.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>

</body>
</html>
