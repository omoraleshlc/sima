<?PHP include("/configuracion/ventanasEmergentes.php"); include("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
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
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<?php

echo displaySeguro::despliegaSeguro($_GET['numCliente'],$basedatos);
$_POST['seguro']=$_GET['numCliente'];
if($_POST['actualizar'] AND $_POST['costo']){

 $sql5= "
SELECT *
FROM
convenios
WHERE
entidad='".$entidad."' AND
numCliente =  '".$_POST['seguro']."'
AND 
codigo ='".$_POST['codigo']."' 
AND
tipoConvenio='cantidad'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

if($_POST['almacen']){
$_POST['almacenDestino']='*';
}


if(!$myrow5['numCliente']){
$agrega = "INSERT INTO convenios (
numCliente,codigo,fechaInicial,fechaFinal,usuario,departamento,costo,tipoConvenio,entidad) 
values ('".$_POST['seguro']."','".$_POST['codigo']."',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$_POST['almacenDestino']."','".$_POST['costo']."','cantidad','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/vbscript">
msgbox "SE AGREGÓ EL CONVENIO"
</script>';
} else {
echo '<script type="text/vbscript">
msgbox "YA EXISTE ESE CONVENIO"
</script>';

}
}



if($_POST['borrar'] AND $_POST['numCliente1']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM conveniosxCantidad WHERE keyConvenios = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}$leyenda = "Se eliminó el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['numCliente']){
$leyenda = "Por favor, escoja el nombre de numCliente que desee eliminar..!";
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL CONVENIO!"
</script>';
}

?>

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

  <p align="center">&nbsp;</p>
  <form id="form1" name="form1" method="post" action="">
    <table width="482" border="0" align="center" class="Estilo24">
      <tr>
        <th height="37" scope="col">&nbsp;</th>
        <th width="75" bgcolor="#660066" scope="col"><div align="left"><span class="style13"> Almac&eacute;n: </span></div></th>
        <th width="392" scope="col"><div align="left">
          </div>
          <div align="left">
            <label>          
            <?php require("/configuracion/componentes/comboAlmacen.php"); 
$comboAlmacen=new comboAlmacen();
$comboAlmacen->despliegaAlmacenSS($entidad,'Estilo24',$almacenSolicitante,$almacenDestino,$basedatos);
?>
            <input name="almacen" type="checkbox" id="almacen" value="*" />
  Todos los almacenes </label>
          </div></th>
      </tr>
      <tr>
        <?php if(!$_POST['gpoProducto']){ ?>
		<th width="1" scope="col">&nbsp;</th>
        <th bgcolor="#660066" scope="col"><div align="left"><span class="style13">C&oacute;digo </span></div></th>
        <th scope="col"><div align="left" id="mostrar"><strong> </strong>
          <label>
          <input name="codigo" type="text" class="Estilo24" id="medico"  value="<?php echo $_POST['codigo'];?>" readonly=""/>
          </label>
          <input name="M" type="button" class="Estilo24" id="M"  onclick="javascript:ventanaSecundaria6(
		'/sima/cargos/ventanaListaArticulos.php?campoDespliega=<?php echo "despliegaArticulo"; ?>&amp;forma=<?php echo "form1"; ?>&amp;campo=<?php echo "codigo"; ?>')" value="M" />
          <input name="despliegaArticulo" type="text" class="Estilo24"  size="40" readonly=""  id="despliegaMedico"
		value="<?php if($_POST['despliegaMedico']){ echo $_POST['despliegaMedico'];} else { echo "";}?>"/>          
          <!-- div que mostrara la lista de coincidencias -->
        </div></th>
		<?php } ?>
      </tr>
      <tr>
        <th width="1" scope="col">&nbsp;</th>
        <td bgcolor="#660066"><div align="left" class="style13">Cantidad:</div></td>
        <td><label>
          <input name="costo" type="text" class="Estilo24" id="costo" value=""/>
          <div align="left"></div></td>
      </tr>
      <tr>
        <th width="1" scope="col">&nbsp;</th>
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
        <th width="1" scope="col">&nbsp;</th>
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
        <th width="1" height="33" scope="col">&nbsp;</th>
        <td>&nbsp;</td>
        <td><input name="Submit2" type="submit" class="Estilo24" value="Nuevo" />          <input name="actualizar" type="submit" class="Estilo24" id="actualizar" value="Crear Nuevo Convenio" />
          <a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="numCliente" type="hidden" class="Estilo24" id="numCliente" size="2" maxlength="2"
		 value="<?php echo $_GET['numCliente'];?>">
          </a></td>
      </tr>
    </table>
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
</form>
  </body>
</html>