<?php require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=430,height=700,scrollbars=YES") 
} 
</script> 
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar'] AND $_POST['almacenDestino'] and $_POST['porcentaje'] and $_GET['numeroE']){


$alma=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$coder[$i];






//*********************SECCION DE COSTOS***********************************

 $sSQL31= "Select  * From porcentajeBeneficencias WHERE entidad='".$entidad."' and
numeroE='".$_GET['numeroE']."'
    and
    departamento='".$_POST['almacenDestino']."'
        and
        status='standby'
        and
        fecha='".$fecha1."'
            and
            gpoProducto='".$_POST['gpoProducto']."'
";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);




/*
CREATE TABLE `sima`.`porcentajeBeneficencias` (
`keyPB` INT( 11 ) NOT NULL AUTO_INCREMENT ,
`departamento` VARCHAR( 30 ) NOT NULL ,
`usuario` VARCHAR( 20 ) NOT NULL ,
`fecha` VARCHAR( 20 ) NOT NULL ,
`entidad` CHAR( 2 ) NOT NULL ,
`observaciones` VARCHAR( 254 ) NOT NULL ,
PRIMARY KEY ( `keyPB` ) ,
INDEX ( `keyPB` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
*/

//***compruebo si existe en la DB
if(!$myrow31['status']){

$agregaSaldo = "INSERT INTO porcentajeBeneficencias ( departamento,usuario,fecha,entidad,observaciones,numeroE,status,porcentaje,gpoProducto
) values (
'".$_POST['almacenDestino']."','".$usuario."','".$fecha1."','".$entidad."','".$_POST['observaciones']."',
    '".$_GET['numeroE']."','standby','".$_POST['porcentaje']."','".$_POST['gpoProducto']."'
)";
mysql_db_query($basedatos,$agregaSaldo);
$tipoMensaje='registrosAgregados';
$encabezado='Exito!';
$texto='Porcentaje Agregado';
}
//*****************************CIERRA SECCION DE COSTOS***********************
$descripcionA='Se activo la beneficencia del archivo activar beneficencias, del expediente: '.$_GET['numeroE'];
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcionA."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


echo '<script language="JavaScript" type="text/javascript">
  <!--
   window.opener.document.forms["form1"].submit();
  
  // -->
</script>';
}

?>


<?php 


if($keyPB=$_GET['keyPB']){


$q1 = "delete from  porcentajeBeneficencias WHERE keyPB='".$_GET['keyPB']."' ";
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
    <h1>Activar Beneficencias</h1>
    <h4>
        <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
    </h4>
<form name="form1" method="post" action="">
  <table width="516" class="table-forma">
      <h4>**Si el paciente es interno, el departamento debe ser por donde se va a internar..**</h4>
    <tr>
      <th colspan="2">
      <h1 align="center" >Paciente : 
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
	  
</th>
    </tr>
    <tr>
      <td >Departamento</td>
      <td>
                <?php
         $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No')
and
centroDistribucion!='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="this.form.submit();" />

  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){?>
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

      </td>
    </tr>
      
      
      
          <tr>
      <td >Grupos</td>
      <td>
                <?php
         $aCombos= "Select * From gpoProductos 
order by descripcionGP ASC";
$rCombos=mysql_db_query($basedatos,$aCombos); ?>
        <select name="gpoProducto"  id="almacenDestino"  />

  <option value="*" >TODOS LOS GRUPOS</option>
        <?php while($resCombos = mysql_fetch_array($rCombos)){?>
        <option

		value="<?php echo $resCombos['codigoGP']; ?>"><?php echo $resCombos['descripcionGP']; ?></option>
        <?php } ?>
        </select>

      </td>
    </tr>
      
      
      
      
    <tr>
      <td >Porcentaje</td>
      <td><em >
       
                              <?php
         $aCombo= "Select * From beneficenciaDepartamentos where
entidad='".$entidad."' AND
departamento='".$_POST['almacenDestino']."'
order by porcentaje ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="porcentaje"  id="almacenDestino"  />

  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if($_POST['porcentaje'] ==$resCombo['porcentaje']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['porcentaje']; ?>"><?php echo $resCombo['porcentaje']; ?></option>
        <?php } ?>
        </select>

          </em><span  >Porcentaje que paga el paciente...</span></td>
    </tr>
    <tr>

	
      <td width="90" >Observaciones</td>
      <td width="416"><label>
        <textarea name="observaciones" cols="40"  id="observaciones"><?php //echo $myrow4['observaciones'];?></textarea>
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

  <table width="585" class="table table-striped">
      <tr >
        <th width="1"  scope="col"><div align="left" >
          <div align="center">N</div>
        </div></th>
        <th width="50"  scope="col"><div align="left" >Departamento</div></th>
        <th width="50"  scope="col"><div align="left" >Observaciones</div></th>
        <th width="10"  scope="col"><div align="left" >Fecha</div></th>
        <th width="2"  scope="col"><div align="left" >%</div></th>
        <th width="10"  scope="col"><div align="left" >Stat</div></th>
        <th width="50"  scope="col"><div align="left" >Grupo</div></th>
        <th width="5"  scope="col"><div align="left" >Eliminar</div></th>
    </tr>
      
	          <?php   
 $sSQL= "Select * From porcentajeBeneficencias
 where entidad='".$entidad."' and numeroE='".$_GET['numeroE']."'";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$bandera += 1;
$codigoModulo = $myrow['codModulo'];
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$alma=$myrow['almacen'];
$code=$myrow['codigo'];



   $sSQL5="SELECT descripcion
FROM
almacenes
WHERE entidad='".$entidad."' AND
almacen = '".$myrow['departamento']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

  

  if($myrow61['almacen']){
  $estilo='style13';
  $color='#0000FF';
  } else  {
  $color = '#FFFFFF';
  $estilo='style12';
  }
?>
	  <tr>
	  
	  
        <td bgcolor="<?php echo $color?>" ><div align="center" ><?php echo $bandera;?></div></td>

        <td bgcolor="<?php echo $color?>" ><div align="left" ><?php echo $myrow5['descripcion'];?></div>
<span class="style7">
           
            </span>
            <div align="center"></div></td>
        <td bgcolor="<?php echo $color?>" >
		
		
		<?php 
		
		echo $myrow['observaciones'];

		?>
		</span></td>
        <td bgcolor="<?php echo $color?>" class="precio1" align="center"><?php 
		echo cambia_a_normal($myrow['fecha']);
		

		?></td>
        <td bgcolor="<?php echo $color?>"  align="center"><?php 
		
		echo $myrow['porcentaje'];

		?> </td>
                <td bgcolor="<?php echo $color?>"  align="center"><?php

		echo $myrow['status'];

		?></td>
        
        
                        <td bgcolor="<?php echo $color?>"  align="center"><?php

		echo $myrow['gpoProducto'];

		?></td>
        
        
        
        <td bgcolor="<?php echo $color?>" ><div align="center">
		
		<a href="<?php echo $_SERVER['PHP_SELF'];?>?keyPacientes=<?php echo $_GET['keyPacientes'];?>&numeroE=<?php echo $_GET['numeroE']; ?>&activa=<?php echo "activa"; ?>&usuario=<?php echo $E; ?>&orden=<?php echo $_POST['tipoAlmacen']; ?>&keyPB=<?php echo $myrow['keyPB'];?>"> <img src="../imagenes/btns/stopbtn.png" alt="INACTIVO" width="24" height="24" border="0"  onclick="if(confirm('Estas seguro que deseas eliminar este seguro del paciente?') == false){return false;}" />
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
			return "/sima/cargos/clientesTodosAjax.php?q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
</p>

</body>
</html>