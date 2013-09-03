<?php require("menuOperaciones.php"); 
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="../calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="../calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="../calendario/calendar-setup.js"></script>

<script language="javascript" type="text/javascript">

function vacio(q) {
        for ( i = 0; i < q.lengtd; i++ ) {
                if ( q.charAt(i) != " " ) {
                        return true
                }
        }
        return false
}


function valida(F) {

        if( vacio(F.almacen.value) == false ) {
                alert("Por Favor, escoje el almacen/departamento!")
                return false
        } else if( vacio(F.descripcion.value) == false ) {
                alert("Por Favor, escribe la descripci�n de este almacen!")
                return false
        } else if( vacio(F.ctaContable.value) == false ) {
                alert("Por Favor, escoje la cuenta mayor!")
                return false
        }
}

</script>


<script language=javascript>
function ventanaSecundaria6 (URL){
   window.open(URL,"ventana6","widtd=600,height=300,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria1 (URL){
   window.open(URL,"ventana1","widtd=600,height=400,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria5 (URL){
   window.open(URL,"ventana5","widtd=700,height=600,scrollbars=YES")
}
</script>
<script language=javascript>
function ventanaSecundaria51 (URL){
   window.open(URL,"ventanaSecundaria51","widtd=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundaria511 (URL){
   window.open(URL,"ventanaSecundaria511","widtd=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA (URL){
   window.open(URL,"ventanaSecundariaA","widtd=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA2 (URL){
   window.open(URL,"ventanaSecundariaA2","widtd=800,height=600,scrollbars=YES")
}
</script>

<script language=javascript>
function ventanaSecundariaA1 (URL){
   window.open(URL,"ventanaSecundariaA1","widtd=800,height=600,scrollbars=YES")
}
</script>


<script language=javascript>
function ventanaSecundaria5111(URL){
   window.open(URL,"ventanaSecundaria5111","widtd=800,height=600,scrollbars=YES")
}
</script>



<?php



if($_POST['fv'] and !$_POST['resumen'] ){
 $random=rand(1,900000000);

$q = "insert into contador
(
usuario,random)
values
('".$usuario."','".$random."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQL7ab="SELECT *
FROM
contador
WHERE
usuario='".$usuario."'
and
random='".$random."'
order by keyConta DESC

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
?>
<script>
//javascript:ventanaSecundaria511('despliegaxFV.php?numeroE=<?php echo $numeroE; ?>&nCuenta=<?php echo $nCuenta; ?>&paciente=<?php echo $_POST['paciente']; ?>&numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&hora1=<?php echo $hora1; ?>&keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&random=<?php echo $myrow7ab['random'];?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>');
//window.alert("Se genero el numero de reporte: <?php print $myrow7ab['random'];?>");

</script>
<?php
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
	<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>

 <h1 align="center" class="titulos">
Ventas x Volumen
 </h1>

 <form id="form2" name="form2" metdod="post" >
   <div align="center"></div>
   <p align="center">
     <label></label>
     Escojer Fechas</p>




   <table widtd="335" class="table-forma">



       <tr>
       <td scope="col"><div align="left">
         <input name="fechaInicial" type="text"  id="campo_fecha1" size="11" maxlengtd="11" readonly=""
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
       </div></td>
       <td scope="col"><div align="center">
         <input name="fechaFinal" type="text"  id="campo_fecha2" size="11" maxlengtd="11" readonly="readonly"
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>"  />
       </div></td>
     </tr>
     <tr>
       <td height="66"><div align="left">
         <input name="button" type="image" src="../imagenes/btns/fecha.png" id="lanzador1" value="..." />
       </div></td>
       <td><div align="center">
         <input name="button1" type="image" src="../imagenes/btns/fecha.png" id="lanzador2" value="..." />
       </div></td>
     </tr>
   </table>
   <p>&nbsp;</p>
   
   <table widtd="683" class="table-forma">

   <tr>
     <td widtd="87"  scope="col"><div align="right"><span > Grupo </span></div></td>
     <td  ><?php

 $sSQL1= "Select * From gpoProductos where entidad='".$entidad."' AND activo='activo'
ORDER BY descripcionGP ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);


	  ?>
       <select name="gpoProducto"  id="gpoProducto" />
       
       <option value="">Todos los Grupos</option>
       <?php
		   while($myrow1 = mysql_fetch_array($result1)){ ?>
       <option
                <?php if($_POST['gpoProducto']==$myrow1['codigoGP']){echo 'selected=""';} ?>
                value="<?php echo $myrow1['codigoGP']; ?>"> <?php echo $myrow1['descripcionGP']; ?></option>
       <?php }

		?></td>
   </tr>
   <tr>
     <td widtd="87"  scope="col"><div align="right"><span > Seguro </span></div></td>
     <td  ><input name="seguro" type="hidden"  id="seguro"   readonly=""
		value="<?php if($_POST['seguro'] ){ echo $_POST['seguro'];} else { echo "0";}?>"
		 />
       <input name="nomSeguro" type="text"  id="nomSeguro" size="60"
		value="<?php
		if($_POST['nomSeguro']){
		echo $_POST['nomSeguro'];
		}else{
                    echo 'Particular';
                }
		?>"/></td>
   </tr>
   <tr>
     <td widtd="87"  scope="col"><div align="left" >
       <div align="right" ><span >Almacen</span></div>
     </div></td>
     <td widtd="360"  scope="col"><div align="left"><span >
       <?php
                 $aCombo= "Select * From almacenes where entidad='".$entidad."' and ventas='si' and

 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
       <select name="almacenDestino"  />
       
       <option value="" >---</option>
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
     </span></div></td>
   </tr>
   <tr>
     <td height="41"  scope="col"><span >Factor Referencia:
       <input name="factorReferencia" value="<?php echo $_POST['factorReferencia'];?>" size="5" type="text" />
     </span></td>
     <td  scope="col"><label><span >Tipo Paciente:
       <select name="tipopaciente">
         <option
            <?php if($_POST['tipopaciente']=='Ambos'){ echo 'selected="selected"';}?>
            value="Ambos">Ambos</option>
         <option
            <?php if($_POST['tipopaciente']=='Externos'){ echo 'selected="selected"';}?>
            value="Externos">Externos</option>
         <option
            <?php if($_POST['tipopaciente']=='Internos'){ echo 'selected="selected"';}?>
            value="Internos">Internos</option>
       </select>
     </span></label></td>
   </tr>
   </table>
 
   <p>
     <input name="buscar" type="submit" src="../imagenes/btns/searchbutton.png"  id="buscar" value="buscar" />
   </p>


 <p>&nbsp;</p>
     <?php
	  if($_POST['buscar'] and $_POST['almacenDestino'] and $_POST['factorReferencia']>0){ ?>
   <p align="center">&nbsp;</p>
   <p align="center">
<a href="javascript:ventanaSecundaria5111('../ventanas/imprimirVentasxVolumen.php?almacenIngreso=<?php echo $_POST['almacenDestino'];?>
   &entidad=<?php echo $entidad;?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal'];?>
   &factorReferencia=<?php echo $_POST['factorReferencia'];?>&seguro=<?php echo $_POST['seguro'];?>&nomSeguro=<?php  echo $_POST['nomSeguro'];?>
   &tipopaciente=<?php echo $_POST['tipopaciente'];?>&gpoProducto=<?php echo $_POST['gpoProducto'];?>')" >
Ver
</a>   </p>
  <?php }?>

 </form>

<p align="center">&nbsp;</p>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
  <script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha2",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario
});
</script>

          <script>
		new Autocomplete("nomSeguro", function() {
			tdis.setValue = function( id ) {
				document.getElementsByName("seguro")[0].value = id;
			}

			// If tde user modified tde text but doesn't select any new item, tden clean tde hidden value.
			if ( tdis.isModified )
				tdis.setValue("");

			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if tdis request is not fired by search icon click
			if ( tdis.value.lengtd < 4 && tdis.isNotClick )
				return ;

			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesPrincipalesx.php?entidad=<?php echo $entidad;?>&q=" + tdis.value;
			// return "completeEmpName.php?q=" + tdis.value;
		});
	</script>

</body>
</html>