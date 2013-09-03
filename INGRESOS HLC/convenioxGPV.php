<?PHP include("/configuracion/ventanasEmergentes.php");include("/configuracion/funciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=700,scrollbars=YES") 
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

if($_GET['numCliente']!=NULL){
    $_POST['seguro']=$_GET['numCliente'];
}









if($_POST['actualizar'] AND $_POST['costo']){


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
tipoConvenio='grupoProducto'
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
tipoConvenio='grupoProducto'
";
$result5=mysql_db_query($basedatos,$sql5);
$myrow5= mysql_fetch_array($result5);
}



if(!$myrow5['numCliente']){
$agrega = "INSERT INTO convenios (
numCliente,codigo,fechaInicial,fechaFinal,usuario,departamento,costo,tipoConvenio,gpoProducto,entidad) 
values ('".$_POST['seguro']."','99999',
'".$_POST['fechaInicial']."','".$_POST['fechaFinal']."','".$usuario."','".$_POST['almacenDestino']."','".$_POST['costo']."','grupoProducto',
'".$_POST['gpoProducto']."','".$entidad."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script type="text/javascript">
alert("Se agrego el convenio")
window.parent.cierraVentana();
</script>';
} else {
echo '<script type="text/javascript">
alert("Ya existe ese convenio")
window.parent.cierraVentana();
</script>';

}?>

  <script>
window.opener.document.forms["form1"].submit();
  </script>
<?php }



if($_POST['borrar'] AND $_POST['seguro']){
if($quitar = $_POST['quitar']){
foreach($quitar as $is => $quitar_articulo){
$borrame = "DELETE FROM conveniosxCantidad WHERE keyConvenios = '".$quitar[$is]."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

}$leyenda = "Se elimin� el modulo ".$quitar[$i];}} else if($_POST['borrar'] AND !$_POST['numCliente']){
$leyenda = "Por favor, escoja el nombre de numCliente que desee eliminar..!";
echo '<script type="text/vbscript">
msgbox "SE ELIMINO EL CONVENIO!"
</script>';
}

?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

$sSQL1= "Select * From clientes where entidad='".$entidad."'
 AND
numCliente='".$_POST['seguro']."'";



$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<?php
$estilo= new muestraEstilos();
$estilo->styles();

?>

	<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

</head>

<body>

  <h4 align="center">Cliente <?php echo $myrow1['nomCliente'];?></h4>
  <form  name="form1" method="post" >





    <table width="521" height="211" class="table-forma">






   <tr>

   <td width="81"   scope="col"><div align="left"> Seguro </div></td>

      <td  >
          <input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] ){ echo $_POST['seguro'];} else { echo "0";}?>"
		 />
     </td>


        <td ><input name="nomSeguro" type="text"  id="nomSeguro" size="60"
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



        <td height="34"  scope="col">&nbsp;</td>

       

        <td width="81"   scope="col"><div align="left"><span > Almacen </span></div></td>
        <td width="425"  scope="col">
   <div align="left" >
                   <?php
$aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" />

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
          </div></td>
      </tr>
      <tr>
        <td height="27"  scope="col"><div align="left"></div></td>
        <td   scope="col"><div align="left"><span >GrupoProducto </span></div></td>
      <td  scope="col"> <div align="left">
            <?php 
	 
 $sSQL1= "Select * From gpoProductos where entidad='".$entidad."' AND activo='activo'
ORDER BY descripcionGP ASC ";
$result1=mysql_db_query($basedatos,$sSQL1); 


	  ?>
          <select name="gpoProducto"  id="gpoProducto" />
 			<?php if($_POST['gpoProducto']){  ?>
			<option value="<?php echo $_POST['gpoProducto']; ?>"><?php echo $_POST['gpoProducto']; ?></option>
			<?php }  ?>
            <option value="">Sin grupo de producto...</option>
            <?php  	 		 
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
            <option value="<?php echo $myrow1['codigoGP']; ?>">
			<?php echo $myrow1['descripcionGP']." || ".$myrow1['codigoGP']; ?>			</option>
            <?php } 
		
		?>
            </select>
        </div></td>
      </tr>
      <tr>
        <td width="1" height="29"  scope="col">&nbsp;</td>
        <td  ><div align="left" class="v">Porcentaje + :</div></td>
        <td ><label>
		
		  <input name="costo" type="text"  id="costo" size="2" maxlength="2"
		 value=""	/>
			<div align="left"></div></td>
      </tr>
      <tr>
        <td width="1" height="29"  scope="col">&nbsp;</td>
        <td  ><div align="left" >Fecha Inicial :</div></td>
      <td ><div align="left">
            <label>
            <input name="fechaInicial" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 }
		 ?>"/>
            </label>
            <input name="button" type="button"  id="lanzador" value="..." />
        </div></td>
      </tr>
      <tr>
        <td width="1" height="31"  scope="col">&nbsp;</td>
        <td  ><div align="left" >Fecha Final </div></td>
      <td ><div align="left">
            <label></label>
            <label></label>
            <label>
            <input name="fechaFinal" type="text"  id="campo_fecha1" size="9" maxlength="9" readonly=""
		  value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 }
		 ?>"/>
            </label>
            <input name="button1" type="button"  id="lanzador1" value="..." />
        </div></td>
      </tr>
      <tr>
        <td width="1" height="33"  scope="col">&nbsp;</td>
        <td  >&nbsp;</td>
        <td ><input name="actualizar" type="submit"  id="actualizar" value="Crear Nuevo Convenio" />
        <a href="javascript:ventanaSecundaria('despliegaGP.php?numCliente=<?php echo $_POST['seguro']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;medico=<?php echo $_POST['medico']; ?>&amp;usuario=<?php echo $usuario; ?>')">
        <input name="numCliente" type="hidden"  id="numCliente" size="2" maxlength="2"
		 value="<?php echo $_GET['numCliente'];?>"	/>
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