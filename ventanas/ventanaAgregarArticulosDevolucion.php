<?php require('/configuracion/ventanasEmergentes.php');?>

<?php

if($_POST['sendInvoice'] and $_POST['descripcion'] and $_POST['codigo']!=NULL){


$sSQL12= "
	SELECT *
FROM
  articulos
WHERE
(entidad='".$entidad."'
    and
codigo='".$_POST['codigo']."')
    or
(entidad='".$entidad."'
    and
cbarra='".$_POST['codigo']."')

    
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];
$_POST['keyPA']=$myrow12['keyPA'];
if($_POST['almacen']!='HALM'){
    $_GET['departamento']=$_POST['almacenDestino'];
}



if($_GET['numSolicitud']>0){
    $statusDevolucion='si';
}else{
    $statusDevolucion=NULL;
}



$sSQL39e= "
	SELECT
tasaGP,descripcionGP
FROM
gpoProductos
WHERE
codigoGP='".$myrow12['gpoProducto']."'";
$result39e=mysql_db_query($basedatos,$sSQL39e);
$myrow39e = mysql_fetch_array($result39e);

if($myrow39e['tasaGP']>0){
    $iva=$_POST['precioCosto']*($myrow39e['tasaGP']*0.01);
}

$agregaSaldo = "
    INSERT INTO OC ( id_requisicion,id_almacen,usuario,fecha,hora,status,prioridad,id_proveedor,
    entidad,numFactura,keyPA,cantidadParticular,cantidadAseguradora,
    descripcionArticulo,cantidad,cbarra,codigo,precioCosto,iva,notaCredito,preciosugerido,lote,fechacaducidad,descuentoPorcentaje,
    numSolicitud,statusDevolucion

) values (

'".$_GET['req']."','".$_GET['departamento']."','".$usuario."','".$fecha1."','".$hora1."','request',
'".$_POST['prioridad']."','".$_GET['proveedor']."','".$entidad."','".$_GET['id_factura']."',
    '".$_POST['keyPA']."' ,'0.00','0.00','".$myrow12['descripcion']."' ,
        '".$_POST['cantidad']."','".$myrow12['cbarra']."' ,
        '".$myrow12['codigo']."','".$_POST['precioCosto']."','".$iva."','".$_POST['notaCredito']."',
            '".$_POST['preciosugerido']."','".$_POST['lote']."','".$_POST['fechacaducidad']."','".$_POST['descuento']."',
'".$_GET['numSolicitud']."','".$statusDevolucion."'                
)";
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

    
    
    
    
    
    
    
    
    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />    

<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>


	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>

	
    <form id="form1" name="form1" method="post" >
      <p align="center">Agregar Articulos</p>
      <div align="center">
	  
	  
	  







          <table width="276" class="table-forma">
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

<th colspan="2"  scope="col">



    <div align="center">
        Proveedor: <?php echo $_GET['descripcionProveedor'];?>, # Factura <?php echo $_GET['id_factura'];?>
    </div>
</th>
    </tr>


          <tr>
            <td width="1"  scope="col">
                <div align="center">

                </div>
            </td>



            <td width="265" >
                <div align="center">
                    <span >
                        Codigo
              <input name="codigo" type="text"  id="codigo"  value="<?php echo $_POST['codigo'];?>" />
            </span>
                </div>
            </td>
          </tr>




          <tr>
            <td  scope="col">&nbsp;
                
            </td>

            <td rowspan="2" >
                <span >
 <?php
 
 if($_POST['codigo']!=NULL){
  $sSQL12= "
	SELECT *
FROM
  articulos
WHERE
(entidad='".$entidad."'
    and
codigo='".$_POST['codigo']."')
    or
(entidad='".$entidad."'
    and
cbarra='".$_POST['codigo']."')

    
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
if(!$_POST['descripcion'] and $_POST['codigo']!=NULL){
   $_POST['descripcion'] =$myrow12['descripcion'];
}
}
?>
                    
                    
                    
                    
<textarea name="descripcion" cols="60"  <?php if($_POST['send']!=NULL){ echo 'readonly=""';}?>/><?php echo trim($_POST['descripcion']);?></textarea>
              
              
            </span>
            </td>
          </tr>

              
    <?php if(!$_POST['descripcion'] or is_numeric($_POST['codigo'])){ ?>
            <td>
          <tr>

              <td width="1"  scope="col">

            <td >
            <input name="sendInvoice" value="Enviar" type="submit"   />
             
            </td>
             </td>

          </tr>
            </td>
<?php } ?>


    
              </table>
      </div>


<!--p align="center">
      <?php if(($_POST['send'] and $_POST['descripcion']) or is_numeric($_POST['codigo'])){ ?>
       <input name="sendInvoice" value="Enviar" type="submit"   />
      
          <!--table width="276" style="border: 1px solid #000000;"-->


         
          <!--tr>

              

            <td >
           #Lote
              <input name="lote" type="text"  size="4" value="<?php echo $_POST['lote'];?>"  />
            </td>
            

          </tr-->
          
              
              
    
              
              
      

            
                     
          <!--tr>

             

            <td >
          FechaCaducidad
              <input  name="fechacaducidad" type="text"  id="campo_fecha" size="10" maxlength="9" readonly=""
		/>
               <input name="button" type="image" src="../../imagenes/calendario.png"  id="lanzador" value="..." />
            </td>
            
          

          </tr-->
            

            
          <!--tr>

              

            <td >
            
              <input name="sendInvoice" value="Enviar" type="submit"   />
            </td>
            

          </tr-->
          



    
              <!--/table>
<?php } ?>

    </p-->

      



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
			return "/sima/cargos/articulosCodigox.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>

</body>
</html>
