<?php require('/configuracion/ventanasEmergentes.php');?>

<?php
if(!$_POST['opcion']){
    $_POST['opcion']=$_GET['opcion'];
}


if($_POST['sendInvoice']  and $_POST['keyPA'] ){


$sSQL12= "
	SELECT *
FROM
  articulos
WHERE
keyPA='".$_POST['keyPA']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);

$_GET['departamento'];
$descripcion=$_GET['nombreCompleto'].' ('.$_POST['departamento'].')';

$sSQLw= "SELECT *
FROM
medicos 
where
entidad='".$entidad."'
and
numMedico='".$_GET['medico']."'

";
$resultw=mysql_db_query($basedatos,$sSQLw);
$myroww = mysql_fetch_array($resultw); 


 $sSQL3a1= "Select * From existencias WHERE entidad='".$entidad."' and almacen='".$_POST['departamento']."' 
    and keyPA='".$myrow12['keyPA']."' and id_medico='".$_GET['medico']."'  ";
$result3a1=mysql_db_query($basedatos,$sSQL3a1);
$myrow3a1 = mysql_fetch_array($result3a1);

if(!$myrow3a1['id_medico']){

//verifico que no exista el centro de costo en ese almacen padre
$sSQL3a12= "Select * From almacenes WHERE entidad='".$entidad."' and almacenPadre='".$_POST['departamento']."' 
and id_medico='".$_GET['medico']."' ";
$result3a12=mysql_db_query($basedatos,$sSQL3a12);
$myrow3a12 = mysql_fetch_array($result3a12);


if($myrow3a12['almacen']){


    $myrow333a['CVI']=$myrow3a12['almacen'];
}else{    

$myrow333a['CVI']=    
        $sSQL333a= "SELECT
MAX(keyconta)+1 as CVI
FROM contadoralmacenes
WHERE entidad='".$entidad."'   ";

$result333a=mysql_db_query($basedatos,$sSQL333a);
$myrow333a = mysql_fetch_array($result333a);

if(!$myrow333a['CVI']){
$myrow333a['CVI']=1;
}



//Full texts 	keyconta 	usuario 	random 	entidad
$rand=rand(0,10000000);
  $agregad = "INSERT INTO contadoralmacenes (
usuario,random,entidad
) values (
'".$usuario."',
'".$rand."',
    '".$entidad."'

)";
mysql_db_query($basedatos,$agregad);
echo mysql_error();


$agrega = "INSERT INTO almacenes (
almacen,descripcion,ctaContable,usuario,fecha1,stock,miniAlmacen,almacenPadre,activo,tieneCuartos,entidad,id_medico,medico,ventas,
altaPaciente,altaEspecial,cargosDirectos,numConsultorio,transacciones,contieneEmpleados,compras,ventasDirectas,modificarPrecios,cierreCuenta,
registroUrgencias,credenciales,medicamentosSueltos,
permiteDevoluciones,almacenCargo,reporteSurtir,statusCitas,cambiarDescripcion,puntoVenta,actualizaPrecios,especialidad,manejaexpedientes,beneficencia
) values ('".$myrow333a['CVI']."','".$descripcion."',
'".$_POST['ctaContable']."',
'".$usuario."','".$fecha1."',
'".$_POST['stock']."','si','".$_POST['departamento']."','A','".$_POST['tieneCuartos']."','".$entidad."',
'".$_GET['medico']."','si','".$_POST['ventas']."','".$_POST['altaPaciente']."',
    '".$_POST['altaEspecial']."','si','".$_POST['numConsultorio']."',
        '".$_POST['transacciones']."','".$_POST['contieneEmpleados']."','".$_POST['compras']."',
            '".$_POST['ventasDirectas']."','".$_POST['modificarPrecios']."','".$_POST['cierreCuenta']."',
                '".$_POST['registroUrgencias']."','".$_POST['credenciales']."','".$_POST['medicamentosSueltos']."',
                    '".$_POST['permiteDevoluciones']."','".$_POST['departamento']."','".$_POST['reporteSurtir']."',
                        'A','".$_POST['cambiarDescripcion']."','".$_POST['puntoVenta']."',
                            '".$_POST['actualizaPrecios']."','".$myroww['especialidad']."','".$_POST['manejaexpedientes']."',
                                '".$_POST['beneficencia']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



}







$agrega = "INSERT INTO existencias (
codigo,almacen,usuario,hora,fechaA,ID_EJERCICIO,entidad,keyPA,descripcion,
tipoVenta,existencia,cantidadTotal,anaquel,cantidadSurtir,cantidadIndividual,id_medico
) values (
'".$myrow12['codigo']."',
'".$myrow333a['CVI']."',
'".$usuario."',
'".$hora1."',
'".$fecha1."',
'".$ID_EJERCICIOM."','".$entidad."','".$_POST['keyPA']."','".$myrow12['descripcion']."',
    '0.00','0.00','0.00','".$anaquel[$i]."','0.00','0.00','".$_GET['medico']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


$sSQL3a= "Select * From almacenes WHERE entidad='".$entidad."' and almacen='".$_POST['departamento']."'  ";
$result3a=mysql_db_query($basedatos,$sSQL3a);
$myrow3a = mysql_fetch_array($result3a);


  
    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow12['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$nivel1."','".$nivel3."', '".$_GET['medico']."','".$_GET['keyPA']."',
        '".$myrow333a['CVI']."','".$usuario."','".$fecha1."','".$hora1."',
            '".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
  

  

 $q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad,almacenPrincipal)
values
('".$myrow12['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '0.00','0.00', '".$_GET['medico']."','".$_POST['keyPA']."',
        '".$myrow333a['CVI']."','".$usuario."','".$fecha."','".$hora."',
            '".$entidad."','".$_POST['departamento']."')";
mysql_db_query($basedatos,$q);
echo mysql_error();



 $sSQL1= "Select * From camposGrupos where gpoProducto='".$myrow12['gpoProducto']."'
and id_almacen='".$_GET['almacen']."' 
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['gpoProducto']){
$sSQL455= "Select almacenPadre from almacenes 
    where entidad='".$entidad."' and almacen='".$_POST['departamento']."'";
$result455=mysql_db_query($basedatos,$sSQL455);
$myrow455 = mysql_fetch_array($result455);

$agrega = "INSERT INTO camposGrupos (
id_almacen,gpoProducto,entidad,almacenPrincipal
) values ('".$myrow333a['CVI']."','".$myrow12['gpoProducto']."',
    '".$entidad."','".$myrow455['almacenPadre']."'  )";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
?>
<script>
window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php 
}else{
echo '<script>';
echo 'window.alert("YA EXISTE ESE SERVICIO EN ESE ALMACEN...");';
echo '</script>';
}
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
        Medico: <?php echo $_GET['nombreCompleto'];?>
    </div>
</th>
    </tr>


          <tr>
            <td width="1"  scope="col">
                <div align="center">
     <?php 
     

     
	  $aCombo= "Select * From almacenes where
entidad='".$entidad."' 
    and
    stock!='si'
    and
    medico!='si'
    
and
miniAlmacen!='si'
    order by descripcion ASC

";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
     <select name="departamento"  id="departamento"  onchange="this.form.submit();"/>
 <option value="">Escoje el departamento</option>

     <?php while($resCombo = mysql_fetch_array($rCombo)){ 	
         ?>
     <option 
<?php if($_POST['departamento']==$resCombo['almacen'])echo 'selected=""';?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
     <?php } ?>
     </select>
                </div>
            </td>

            
            
            
            <td width="265" >&nbsp;</td>
          </tr>
            
            
            
            

<tr>
            <td width="265" >
                <div align="center">
                    <span >
                        Codigo
              <input name="keyPA" type="text"  id="keyPA"  readonly="" value="<?php echo $_POST['keyPA'];?>" />
            </span>
                </div>
            </td>
          </tr>




          <tr>
            <td  scope="col"><textarea name="descripcion" cols="60"  <?php if(!$_POST['departamento']){ echo 'readonly=""';}?>/></textarea>
                
            </td>

            <td rowspan="2" >&nbsp;</td>
          </tr>


    
              


          <tr>
            <td  scope="col">
                <input name="sendInvoice" value="Enviar" type="submit"  <?php if(!$_POST['departamento']){ echo 'disabled=""';}?> />
            </td>

            <td rowspan="2" >&nbsp;</td>
          </tr>





    
              </table>
      </div>
















































      



    </form>


    
<p>&nbsp;</p>
<p>&nbsp;</p>


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
			return "/sima/cargos/articulosAlmacenesx.php?almacen=<?php echo $_POST['departamento'];?>&entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>



</body>
</html>
