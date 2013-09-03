<?PHP include("/configuracion/ventanasEmergentes.php");  include("/configuracion/funciones.php"); 
if($_GET['numCliente']!=NULL){
    $_POST['seguro']=$_GET['numCliente'];
}
?>
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
                alert("Por Favor, escoje un m�dico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje alg�n tipo de seguro, o tambi�n si es particular!")   
                return false   
        }            
}   
</script> 
 <SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>



<?php


if($_POST['actualizar'] AND $_POST['costo'] ){

if($_POST['almacen']=='*'){
$sql5= "
SELECT *
FROM
convenios
WHERE
entidad='".$entidad."'
    and
numCliente =  '".$_POST['seguro']."'
AND
departamento ='*'
AND
tipoConvenio='descuentoConvenio'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);

}else{


$sql5= "
SELECT *
FROM
convenios
WHERE
entidad='".$entidad."'
    and
numCliente =  '".$_POST['seguro']."'
AND
departamento ='".$_POST['almacenDestino']."'
AND
tipoConvenio='descuentoConvenio'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
}



if(!$myrow5['numCliente']){
$agrega = "INSERT INTO convenios (
numCliente,codigo,fechaInicial,fechaFinal,usuario,departamento,costo,tipoConvenio,gpoProducto,entidad,fechaCreacion,incluirReferidos) 
values ('".$_POST['seguro']."','99999',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$_POST['almacenDestino']."','".$_POST['costo']."','descuentoConvenio',
'".$_POST['gpoProducto']."','".$entidad."','".$fecha1."','".$_POST['incluirReferidos']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo 'Se agrego un descuento por convenio ';
} else {

echo 'Ya existe ese descuento con ese convenio';

}?>
<script>
window.opener.document.forms["form1"].submit();
</script>
  <?php
}



if($_POST['borrar'] AND $_POST['numCliente1']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM conveniosxCantidad WHERE keyConvenios = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}$leyenda = "Se elimin� el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['numCliente']){
$leyenda = "Por favor, escoja el nombre de numCliente que desee eliminar..!";
echo '<script type="text/vbscript">
msgbox "SE ELIMINO ESE DESCUENTO DEL CONVENIO!"
</script>';
}

?>




<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$sSQL1= "Select * From clientes where entidad='".$entidad."'
 AND
numCliente='".$_POST['seguro']."'";



$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

?>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>

  <p align="center" class="titulos">Agregar Descuento x Convenio (GLOBAL) </p>
  <form id="form1" name="form1" method="post" action="">
    <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td colspan="3"><img src="../imagenes/bordestablas/borde1.png" width="500" height="20" /></td>
      </tr>


                           <tr>

   <th width="81" bgcolor="#CCCCCC" scope="col"><div align="right"><span class="normal"> Seguro </span></div></th>

      <td bgcolor="#CCCCCC" class="codigos">
          <input name="seguro" type="hidden" class="normal" id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] ){ echo $_POST['seguro'];} else { echo "0";}?>"
		 />
     </td>


        <td bgcolor="#CCCCCC" colspan="4"><input name="nomSeguro" type="text" class="normal" id="nomSeguro" size="60"
		value="<?php
		if($_POST['nomSeguro']){
		echo $_POST['nomSeguro'];
		}else{
                    echo $myrow1['nomCliente'];
                }
		?>"/>
       </td>

 </tr>




      <tr>
        <td width="23" height="44" bgcolor="#CCCCCC">&nbsp;</td>
        <td width="96" bgcolor="#CCCCCC" class="negromid">Almacen</td>
        <td width="381" bgcolor="#CCCCCC"><div align="left"></div>
          <div align="left">
            <label>

                  <?php
$aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="normal" id="almacenDestino" />

  <option value="*" >Todos los Almacenes</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){

		echo 'selected="selected"';
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
            </label>
          </div></td>
      </tr>
  
      <tr>
        <td height="24" bgcolor="#CCCCCC">&nbsp;</td>
        <td bgcolor="#CCCCCC" class="negromid">Incluir Referidos</td>
        <td bgcolor="#CCCCCC"><input name="incluirReferidos" type="checkbox" id="incluirReferidos" value="si" /></td>
      </tr>
      <tr>
        <td height="28" bgcolor="#CCCCCC">&nbsp;</td>
        <td bgcolor="#CCCCCC" class="negromid">Porcentaje</td>
        <td bgcolor="#CCCCCC"><input name="costo" type="text" class="Estilo24" id="costo" size="4" maxlength="3"
		 value="<?php echo $_POST['costo'];?>"	/><span class="normal">
Qu&eacute; porcentaje deseas agregar?</td>
      </tr>
      <tr>
        <td height="34" bgcolor="#CCCCCC">&nbsp;</td>
        <td bgcolor="#CCCCCC" class="negromid"><span class="negromid">Fechas</td>
        <td bgcolor="#CCCCCC" class="negromid">Desde
          <label>
            <input name="fechaInicial" type="text" class="Estilo24" id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
          </label>
        <input name="button" type="image" src="../imagenes/calendario.png" id="lanzador" value="..." /> 
        Hasta 
        <label>
          <input name="fechaFinal" type="text" class="Estilo24" id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
        </label>
        <input name="button1" type="image" src="../imagenes/calendario.png" id="lanzador1" value="..." /></td>
      </tr>
      <tr>
        <td bgcolor="#CCCCCC">&nbsp;</td>
        <td bgcolor="#CCCCCC">&nbsp;</td>
        <td bgcolor="#CCCCCC">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC" align="center"><input name="actualizar" type="submit" class="Estilo24" id="actualizar" value="Crear Nuevo Precio Especial" />
          <a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
          <input name="numCliente" type="hidden" class="Estilo24" id="numCliente" size="2" maxlength="2"
		 value="<?php echo $_GET['numCliente'];?>" />
        </a><a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')"></a></td>
      </tr>
      <tr>
        <td colspan="3"><img src="../imagenes/bordestablas/borde2.png" width="500" height="20" /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    
</form>
  <p>&nbsp;</p>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script>

              <script>
		new Autocomplete("nomSeguro", function() {
			this.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}

			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");

			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 4 && this.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});
	</script>


</body>
</html>