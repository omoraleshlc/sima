<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 




<?php





if($_POST['actualizar'] and $_POST['porcentaje'] and $_POST['almacenDestino']){




//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

$sSQL3= "Select * From catalogoBD WHERE
    entidad='".$entidad."' and departamento='".$_POST['almacenDestino']."' and gpoProducto='".$_POST['gpoProducto']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



if(!$myrow3['departamento'] ){
$sSQL3d= "Select * From almacenes WHERE   entidad='".$entidad."' and almacen='".$_POST['almacenDestino']."' ";
$result3d=mysql_db_query($basedatos,$sSQL3d);
$myrow3d = mysql_fetch_array($result3d);


$agrega = "INSERT INTO catalogoBD (
departamento,usuario,porcentaje,fecha,entidad,gpoProducto,descripcionDepartamento,almacenPrincipal
) values (
'".$_POST['almacenDestino']."',
'".$usuario."',
    '".$_POST['porcentaje']."',
        '".$fecha1."',
'".$entidad."','".$_POST['gpoProducto']."','".$myrow3d['descripcion']."','".$myrow3d['almacenPadre']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




 //cierra validacion
//*********************************************

echo '<script>
window.alert( "REGISTRO AGREGADO ");
   window.opener.document.forms["form2"].submit();
    self.close();
</script>';
$tipoMensaje='agregarRegistros';
$encabezado='Exitoso!';
$texto='Se insertaron Registros...';

} else {



 $q = "UPDATE catalogoBD set
    gpoProducto='".$_POST['gpoProducto']."',
porcentaje='".$_POST['porcentaje']."',
usuario='".$usuario."',fecha='".$fecha1."'
WHERE 
entidad='".$entidad."'
    and
departamento='".$_POST['almacenDestino']."'
    and
    gpoProducto='".$_POST['gpoProducto']."'

";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script language="JavaScript" type="text/javascript">
  <!--
  window.alert( "YA EXISTE ESE GRUPO, SE ACTUALIZARON DATOS");
   window.opener.document.forms["form2"].submit();
    self.close();
  // -->
</script>';

$tipoMensaje='agregarRegistros';
$encabezado='Exitoso!';
$texto='Se actualizaron Registros...';
}


}








if($_GET['elimina'] AND $_GET['keyBD']){




$borrame = "DELETE FROM catalogoBD WHERE keyBD='".$_GET['keyBD']."' ";
mysql_db_query($basedatos,$borrame);
echo mysql_error();


echo '<script language="JavaScript" type="text/javascript">
  <!--
  //window.alert( "REGISTRO ELIMINADO ");
   window.opener.document.forms["form2"].submit();
    //self.close();
  // -->
</script>';
$tipoMensaje='error';
$encabezado='Exito!';
$texto='Se desactivaron folios de venta';
}



$sSQL3= "Select * From catalogoBD WHERE   keyBD='".$_GET['keyBD']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos=new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form2" name="form2" method="post" action="" >
   <p>
     <label></label></p>
   <p>      <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?></p>
   <p>&nbsp;</p>
   <div align="center">
     <p>Catalogo de Departamentos para Expedientes</p>
     <p>Porcentaje que paga el paciente</p>
   </div>

   <table width="504" class="table-forma">
       

    <tr>
           <td width="144"  >Departamento Principal

     </td>


   <td width="360" >
                <?php
         $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A'
and
beneficencia='si'
and
miniAlmacen='No'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino1"  id="almacenDestino" onChange="this.form.submit();"/>

  <option value="" >---</option>
        <?php while($resCombo = mysql_fetch_array($rCombo)){


		?>
        <option
		<?php
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino1']){

		echo 'selected="selected"';
		} else if($_POST['almacenDestino1'] ==$resCombo['almacen']){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
   </td>
</tr>


























<tr>

<?php if($_POST['almacenDestino1']!=NULL){?>

           <td width="144"  >C.Costo/Medico

     </td>
	
   <td width="360" >
                <?php
         $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
almacenPadre='".$_POST['almacenDestino1']."'


order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" />

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
        </select>
          <?php }?>
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
         
         <td width="144"  >Porcentaje</td>
       <td width="360" >
           <input name="porcentaje" type="text"  value="" size="5"></input>
       </td>
  </tr>
  </table>
   <p>&nbsp;</p>

         <input name="actualizar" type="submit" src="../../imagenes/btns/modialma.png"  id="actualizar" value="Agregar/Modificar Porcentaje" />
      
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>
</form>

   


</body>
</html>
