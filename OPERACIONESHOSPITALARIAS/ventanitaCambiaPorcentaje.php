<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar'] AND $_POST['seguro'] and $_POST['porcentaje']){


$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$coder[$i];






//*********************SECCION DE COSTOS***********************************

$sSQL31= "Select  * From porcentajeJubilados WHERE seguro='".$_POST['seguro']."' and keyPacientes = '".$_POST['keyPacientes']."' ";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);



//*****************CLIENTE PRINCIPAL
 $sSQL3="SELECT *
FROM
clientes

WHERE
entidad='".$entidad."'
and
numCliente='".$_POST['seguro']."'

  ";
  $result3=mysql_db_query($basedatos,$sSQL3);
  $myrow3 = mysql_fetch_array($result3);


//***compruebo si existe en la DB
if($myrow31['keyPacientes']){
 $q = "UPDATE porcentajeJubilados set
clientePrincipal='".$myrow3['clientePrincipal']."',
porcentaje='".$_POST['porcentaje']."',
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."',
observaciones='".$_POST['observaciones']."',
    tipoPaciente='".$myrow3['tipo']."'

WHERE seguro='".$_POST['seguro']."'
and
 keyPacientes = '".$_POST['keyPacientes']."'";

mysql_db_query($basedatos,$q);
echo mysql_error();
echo 'Se actualizo el porcentaje';
} else {
  $agregaSaldo = "INSERT INTO porcentajeJubilados ( numeroE,entidad,porcentaje,usuario,fecha,hora,keyPacientes,seguro,observaciones,
     tipoPaciente
) values ('".$_POST['numeroE']."','".$entidad."','".$_POST['porcentaje']."',
    '".$usuario."','".$fecha1."','".$hora1."','".$_POST['keyPacientes']."',
        '".$_POST['seguro']."',
            '".$_POST['observaciones']."','".$myrow3['tipo']."' )";
mysql_db_query($basedatos,$agregaSaldo);
echo 'Se agrego el porcentaje para ese seguro';
}
//*****************************CIERRA SECCION DE COSTOS***********************



echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form1"].submit();
  
  // -->
</script>';
}

?>


<?php 


if($keyPJ=$_GET['keyPJ']){


$q1 = "delete from  porcentajeJubilados WHERE keyPJ='".$keyPJ."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();

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

<form name="form1" method="post" action="">
  <table width="516" border="0" align="center" class="style7">
    <tr>
      <td colspan="2">
      <h1 align="center" class="titulos">Paciente : 
        <?php 
$sSQL415="select *
FROM
pacientes
WHERE
keyPacientes='".$_GET['keyPacientes']."'";
$result415=mysql_db_query($basedatos,$sSQL415);
$myrow415 = mysql_fetch_array($result415);
echo $myrow415['nombreCompleto'];

$sSQL4="select *
FROM
porcentajeJubilados
WHERE
keyPacientes='".$_GET['keyPacientes']."' order by keyPJ DESC";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);

?>
</h1>
	  
</td>
    </tr>
    <tr>
      <td class="negromid">Seguro</td>
      <td>
      <input name="nomSeguro" type="text" class="camposmid" id="nomSeguro" size="60"
		value="<?php 
		 if($_POST['seguro'] and !$_POST['nuevo']){ 
		echo $_POST['nomSeguro'];
		}
		?>"/>
      <input name="seguro" type="hidden" id="seguro" value="<?php echo $_POST['seguro'];?>" /></td>
    </tr>
    <tr>
      <td class="negromid">Porcentaje</td>
      <td><em class="error">
        <input name="porcentaje" type="text" class="camposmid" id="porcentaje" size="3" value="<?php //echo $myrow4['porcentaje'];?>" />
(La empresa se har&aacute; cargo de este porcentaje)      </em></td>
    </tr>
    <tr>
	<?php 
	$sSQL31= "Select  * From porcentajeJubilados WHERE keyPacientes = '".$_GET['codigo']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);
?>
	
      <td width="90" class="negromid">Observaciones</td>
      <td width="416"><label>
        <textarea name="observaciones" cols="40" class="camposmid" id="observaciones"><?php //echo $myrow4['observaciones'];?></textarea>
      </label></td>
    </tr>
  </table>
  <p align="center">
  

    <label>
    <input name="actualizar" type="submit" src="../../imagenes/btns/refresh.png" id="actualizar" value="Ajustar" class="boton1"></input>
    </label>
	<input type="hidden" name="numeroE" value="<?php echo $myrow415['numCliente'];?>">
	<input type="hidden" name="keyPacientes" value="<?php echo $_GET['keyPacientes'];?>">
	<input type="hidden" name="costo" value="<?php echo $_GET['costo'];?>">
    <input type="hidden" name="codigo" value="<?php echo $_GET['codigo'];?>">
	<input type="hidden" name="almacen" value="<?php echo $_GET['almacen'];?>">
	<input type="hidden" name="almacenPrincipal" value="<?php echo $_GET['almacenPrincipal'];?>">
  </p>
</form>
<form id="form2" name="form2" method="post" action="">
  <table width="585" border="0" align="center" class="Estilo24">
      <tr bgcolor="#6633FF">
        <th width="40" bgcolor="#FFFF00" class="style13" scope="col"><div align="left" class="blanco">
          <div align="center">N</div>
        </div></th>
        <th width="239" bgcolor="#FFFF00" class="style13" scope="col"><div align="left" class="none">Seguro</div></th>
        <th width="124" bgcolor="#FFFF00" class="style13" scope="col"><div align="left" class="none">Observaciones</div></th>
        <th width="52" bgcolor="#FFFF00" class="style13" scope="col"><div align="left" class="none">% Part</div></th>
        <th width="48" bgcolor="#FFFF00" class="style13" scope="col"><div align="left" class="none">% Seg</div></th>
        <th width="56" bgcolor="#FFFF00" class="style13" scope="col"><div align="left" class="none">Eliminar</div></th>
    </tr>
      
	          <?php   
 $sSQL= "Select distinct * From porcentajeJubilados 
 where keyPacientes='".$_GET['keyPacientes']."'";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$alma=$myrow['almacen'];
$code=$myrow['codigo'];
$sSQL6="SELECT *
FROM
  `articulosPrecioNivel`
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);


   $sSQL5="SELECT *
FROM
clientes
WHERE entidad='".$entidad."' AND
numCliente = '".$myrow['seguro']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

  
  $sSQL61="SELECT *
FROM
  existencias
WHERE entidad='".$entidad."' AND
codigo = '".$_POST['codigo']."'  and almacen = '".$alma."'
  ";
  $result61=mysql_db_query($basedatos,$sSQL61);
  $myrow61 = mysql_fetch_array($result61);
  if($myrow61['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else  {
  $color = '#FFFFFF';
  $estilo='style12';
  }
?>
	  <tr>
	  
	  
        <td bgcolor="<?php echo $color?>" class="style12"><div align="center" class="normal"><?php echo $bandera;?></div></td>

        <td bgcolor="<?php echo $color?>" class="style12"><div align="left" class="normal"><?php echo $myrow5['nomCliente'];?></div>
<span class="style7">
            <label></label>
            </span>
            <div align="center"></div></td>
        <td bgcolor="<?php echo $color?>" class="normal">
		
		
		<?php 
		
		echo $myrow['observaciones'];

		?>
		</span></td>
        <td bgcolor="<?php echo $color?>" class="precio1" align="center"><?php 
		echo 100-$myrow['porcentaje'];
		

		?></td>
        <td bgcolor="<?php echo $color?>" class="precio2" align="center"><?php 
		
		echo $myrow['porcentaje'];

		?></td>
        <td bgcolor="<?php echo $color?>" class="style12"><div align="center">
		
		<a href="<?php echo $_SERVER['PHP_SELF'];?>?keyPacientes=<?php echo $_GET['keyPacientes'];?>&seguro=<?php echo $_POST['seguro']; ?>&activa=<?php echo "activa"; ?>&usuario=<?php echo $E; ?>&orden=<?php echo $_POST['tipoAlmacen']; ?>&keyPJ=<?php echo $myrow['keyPJ'];?>"> <img src="../../imagenes/btns/stopbtn.png" alt="INACTIVO" width="24" height="24" border="0"  onclick="if(confirm('Est�s seguro que deseas eliminar �ste seguro del paciente?') == false){return false;}" />
		</a>
		</div></td>
      </tr>
      <?php }?>
  </table>
  <p>&nbsp;</p>
</form>
<p>
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
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "/sima/cargos/clientesAjax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>

</body>
</html>