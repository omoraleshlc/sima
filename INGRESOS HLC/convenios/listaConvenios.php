<?PHP include("/configuracion/ingresoshlcmenu/menuingresoshlc.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=700,scrollbars=YES") 
} 
</script> 
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
           
        if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje un médico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje algún tipo de seguro, o también si es particular!")   
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
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="calendar-setup.js"></script> 
<?php
$fechaInicio = $_POST['fechaInicial'];
$fechaFinal = $_POST['fechaFinal'];
$fechaInicio1 = str_replace('/','',$fechaInicio);
$fechaFinal1 = str_replace('/','',$fechaFinal);
//echo $fechaInicio1=trim($fechaInicio1);
//echo "\n";
//echo $fechaFinal1=trim($fechaFinal1);
if($_POST['actualizar']){
if($fechaInicio < $fechaFinal){

$sql5= "
SELECT *
FROM
conveniosGenerales
WHERE
numCliente =  '".$_POST['seguro']."'
AND 
(codigooGP ='".$_POST['codigooGP']."' or codigooGP='".$_POST['gpoProducto']."')

";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

if($_POST['gpoProducto']){
$_POST['codigooGP']=$_POST['gpoProducto'];
}

if(($myrow5['numCliente']!=$_POST['seguro']) and (codigooGP !=$_POST['codigooGP']  )){
$agrega = "INSERT INTO conveniosGenerales (
numCliente,codigooGP,niveloCantidad,cantidadoPorcentaje,fechaInicial,fechaFinal,usuario,fecha1,ip,almacen) 
values ('".$_POST['seguro']."','".$_POST['codigooGP']."','".$_POST['niveloCantidad']."',
'".$_POST['cantidadoPorcentaje']."',
'".$fechaInicio."','".$fechaFinal."','".$usuario."','".$fecha1."','".$ip."','".$_POST['almacen']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGÓ EL CONVENIO"
</script>';
} else {
echo '<script type="text/vbscript">
msgbox "ESE CONVENIO YA EXISTE!"
</script>';
}
} else {
echo '<script type="text/vbscript">
msgbox "REVISA BIEN TU FECHA FINAL, ES MENOR A LA FECHA INICIAL!"
</script>';
}
}



if($_POST['borrar'] AND $_POST['numCliente1']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM conveniosGenerales WHERE keyConvenios = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}$leyenda = "Se eliminó el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['numCliente']){
$leyenda = "Por favor, escoja el nombre de numCliente que desee eliminar..!";
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL CONVENIO!"
</script>';
}

if($_POST['numCliente']){
$numCliente=$_POST['numCliente'];
} else if($_POST['numCliente1']){
$numCliente=$_POST['numCliente1'];
$_POST['numCliente']=$numCliente;
}
?>
<script type="text/javascript" src="ajax.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
<!--
.style13 {color: #FFFFFF}
.style18 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>

  <p>&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
    <table width="700" border="1" align="center" class="Estilo24">
      <tr>
        <th width="2" scope="col">&nbsp;</th>
        <th width="156" bgcolor="#660066" scope="col"><div align="left"><span class="style13">N.Cliente</span></div></th>
        <th width="514" scope="col"><label>
            <div align="left">
              <div align="left">
                <?php 
	 
$sSQL1= "Select distinct * From clientes ORDER BY nomCliente ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
                <select name="seguro" class="Estilo24" id="seguro" onChange="javascript:this.form.submit();"/>
              
                <?php 		if($_POST['seguro']!=null){ ?>
                <option value="<?php echo $_POST['seguro']; ?>"><?php echo $_POST['seguro']; ?></option>
                <?php } ?>
                <option value="0">ESCOJE LA ASEGURADORA O SEGURO..</option>
                <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
                <option value="<?php echo $myrow1['numCliente']; ?>"><?php echo $myrow1['nomCliente']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
          </label></th>
      </tr>
      <tr>
        <th scope="col">&nbsp;</th>
        <th colspan="2" bgcolor="#660066" scope="col"><span class="style18">
          <?php 
$sSQL23= "Select * From clientes WHERE numCliente ='".$_POST['seguro']."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'];
?>
        </span></th>
      </tr>
      <tr>
        <th scope="col">&nbsp;</th>
        <th bgcolor="#660066" scope="col"><div align="left"><span class="style13"> Almac&eacute;n: </span></div></th>
        <th scope="col"><div align="left">
          <?php

$sqlNombre17= "SELECT * From almacenes
			WHERE 
			(ventas='Si' or ventas='si') 
			
			ORDER BY almacen ASC";
$resultaNombre17=mysql_db_query($basedatos,$sqlNombre17);
$rNombre17=mysql_fetch_array($resultaNombre17);

?>
          <select name="almacen" class="Estilo24" id="almacen" />
<option value="*">Todos</option>
          <?php
	
            while ($rNombre17=mysql_fetch_array($resultaNombre17)){   ?>

          <option value="<?php echo $rNombre17['almacen'];?>"><?php echo $rNombre17['descripcion'];?></option>
          
          <?php } ?>
          </select>
        </div>
        <label></label></th>
      </tr>
      <tr>
        <th scope="col"><div align="left"></div></th>
        <th bgcolor="#660066" scope="col"><div align="left"><span class="style13">Grupo de Producto: </span></div></th>
        <th scope="col"> <div align="left">
            <?php 
	 
$sSQL1= "Select distinct * From gpoProductos
ORDER BY descripcionGP ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 

echo mysql_error();
	  ?>
            <select name="gpoProducto" class="Estilo24" id="codigooGP" onChange="javascript:this.form.submit();"/>            
 			<?php if($_POST['gpoProducto']){  ?>
			<option value="<?php echo $_POST['gpoProducto']; ?>"><?php echo $_POST['gpoProducto']; ?></option>
			<?php }  ?>
            <option value="">Sin grupo de producto...</option>
            <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
            <option value="<?php echo $myrow1['codigoGP']; ?>"><?php echo $myrow1['descripcionGP']." || ".$myrow1['codigoGP']; ?></option>
            <?php } 
		
		?>
            </select>
        </div></th>
      </tr>
      <tr>
        <?php if(!$_POST['gpoProducto']){ ?>
		<th width="2" scope="col">&nbsp;</th>
        <th bgcolor="#660066" scope="col"><div align="left"><span class="style13">C&oacute;digo del Servicio </span></div></th>
        <th scope="col"><div align="left" id="mostrar"><strong> </strong>
                <input name="codigooGP" type="text" class="Estilo24" id="input" onKeyUp="javascript:autocompletar('lista',this.value);" 
			value="" size="70" />
                <span id="reloj"><img src='image.gif' alt="BUSCA POR NOMBRES" width="16" height="15" border="0" /></span>
                <!-- div que mostrara la lista de coincidencias -->
        </div></th>
		<?php } ?>
      </tr>
      <tr>
        <th height="163" colspan="3" scope="col"><div class="Estilo24" id="lista" >
            <div align="left"> No Existe el Art&iacute;culo... </div>
        </div></th>
      </tr>
      <tr>
        <th width="2" scope="col">&nbsp;</th>
        <td bgcolor="#660066"><div align="left" class="style13">Descuento:</div></td>
        <td><label>
		
            <?php if($_POST['gpoProducto']){ ?>
			<select name="cantidadoPorcentaje" class="Estilo24" id="cantidadoPorcentaje" disabled="disabled">
              <option value="no">Porcentaje</option>
              </select>
            <?php } else {?>
			<select name="cantidadoPorcentaje" class="Estilo24" id="cantidadoPorcentaje" disabled="disabled">
              <option value="yes">Cantidad</option>
              </select>
			  	<?php } ?>
			<input name="niveloCantidad" type="text" class="Estilo24" id="niveloCantidad"
			value="<?php if($_POST['gpoProducto']){ echo "0.15"; }?>"
			/>
		
            <em> <?php if($_POST['gpoProducto']){ ?>Si es porcentaje escribirlo asi, ej.: 0.15<?php } ?></em>
            <div align="left"></div></td>
      </tr>
      <tr>
        <th width="2" scope="col">&nbsp;</th>
        <td bgcolor="#660066"><div align="left" class="style13">Fecha Inicial :</div></td>
        <td><div align="left">
            <label>
            <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
            </label>
            <input name="button" type="button" class="Estilo24" id="lanzador" value="..." />
        </div></td>
      </tr>
      <tr>
        <th width="2" scope="col">&nbsp;</th>
        <td bgcolor="#660066"><div align="left" class="style13">Fecha Final </div></td>
        <td><div align="left">
            <label></label>
            <label></label>
            <label>
            <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
            </label>
            <input name="button1" type="button" class="Estilo24" id="lanzador1" value="..." />
        </div></td>
      </tr>
      <tr>
        <th width="2" height="33" scope="col">&nbsp;</th>
        <td bgcolor="#660066">&nbsp;</td>
        <td><input name="actualizar" type="submit" class="Estilo24" id="actualizar" value="Crear Nuevo Convenio" />
          <a href="javascript:ventanaSecundaria('despliegaArticulos.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"><?php if($_POST['seguro']){ ?>
 <img src="book_128.gif" alt="LISTA DE CONVENIOS" width="35" height="25" border="0" />
<?php } ?>
</a></td>
      </tr>
    </table>
</form>
  <p>&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del botón que lanzará el calendario 
}); 
</script> 
</body>
</html>