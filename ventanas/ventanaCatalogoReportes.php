<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 




<?php





if($_POST['actualizar'] and $_POST['porcentaje']){




//**************************************SI NO EXISTE EN EXISTENCIAS DALOS DE ALTA********************

$sSQL3= "Select * From beneficenciaDepartamentos WHERE
    entidad='".$entidad."' and departamento='".$_POST['almacenDestino']."' and porcentaje='".$_POST['porcentaje']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);



if(!$myrow3['departamento'] ){

$agrega = "INSERT INTO beneficenciaDepartamentos (
departamento,usuario,porcentaje,fecha,entidad
) values (
'".$_POST['almacenDestino']."',
'".$usuario."',
    '".$_POST['porcentaje']."',
        '".$fecha1."',
'".$entidad."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




 //cierra validacion
//*********************************************

echo '<script>
//window.alert( "REGISTRO AGREGADO ");
   window.opener.document.forms["form2"].submit();
    //self.close();
</script>';
$tipoMensaje='agregarRegistros';
$encabezado='Exitoso!';
$texto='Se insertaron Registros...';
} else {



$q = "UPDATE beneficenciaDepartamentos set
porcentaje='".$_POST['porcentaje']."',
usuario='".$usuario."',fecha='".$fecha1."'
WHERE 
keyBD='".$_GET['keyBD']."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();

echo '<script language="JavaScript" type="text/javascript">
  <!--
  //window.alert( "REGISTRO ACTUALIZADO ");
   window.opener.document.forms["form2"].submit();
    //self.close();
  // -->
</script>';
$tipoMensaje='agregarRegistros';
$encabezado='Exitoso!';
$texto='Se actualizaron Registros...';
}


}








if($_GET['elimina'] AND $_GET['keyBD']){




$borrame = "DELETE FROM beneficenciaDepartamentos WHERE keyBD='".$_GET['keyBD']."' ";
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



$sSQL3= "Select * From beneficenciaDepartamentos WHERE   keyBD='".$_GET['keyBD']."' ";
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

   <table width="442" class="table-forma"
     <tr>
           <td width="144" >Departamento

     </td>



   <td width="360" >
                <?php
         $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No')
and
centroDistribucion!='si'
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
   </td>
       <td width="144" >Porcentaje</td>
       <td width="360" >
           <input name="porcentaje" type="text"  value="" size="5"></input>
       </td>
  
  </table>
 <p>&nbsp;</p>
<span ><span >
         <input name="actualizar" type="submit" src="../imagenes/btns/modialma.png"  id="actualizar" value="Agregar/Modificar Porcentaje" />
       </span></span>
   <p>&nbsp;</p>
   <p>&nbsp;</p>
<p>
     <input name="almacen2" type="hidden" id="almacen2" value="<?php echo $_GET['almacen2'];?>" />
	 
  </p>
</form>

    <form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
   <p>&nbsp;</p>

   <table width="605" class="table table-striped">
     <tr >
       <th width="24" scope="col"><div align="left" >
         <div align="left"># </div>
       </div></th>
<th width="197"  scope="col"><div align="left" >
  <div align="left">Descripcion </div>
</div></th>
       <th width="59" scope="col"><div align="left" >
         <div align="left">Usuario</div>
       </div></th>

       <th width="81" scope="col"><div align="left" >
         <div align="left">Porcentajes</div>
       </div></th>

       <th width="59" scope="col"><div align="left" >
         <div align="left">Elimina</div>
       </div></th>
     </tr>




        	    <?php

if($_GET['departamento']!=NULL and !$_POST['actualizar']){
    $sSQL= "Select * From beneficenciaDepartamentos where
entidad='".$entidad."'
and
departamento='".$_GET['departamento']."'
";
}else{
$sSQL= "Select * From beneficenciaDepartamentos where
entidad='".$entidad."'
    
order by departamento,porcentaje ASC";
}



 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$f+=1;

$sSQL3= "Select * From almacenes WHERE entidad='".$entidad."' and almacen='".$myrow['departamento']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>





     <tr >
       <td ><?php echo $f;?></td>
       <td ><span >

	   <?php echo $myrow3['descripcion'];?>
	   </span></td>
       <td ><span ><?php echo $myrow['usuario'];?></span></td>
       <td ><span >
               <?php echo $myrow['porcentaje']; ?>
           </span></td>


       <td >
	   <div align="center" >	    <span >

	   <a name="status<?php echo $f;?>" href="ventanaCatalogoReportes.php?keyBD=<?php echo $myrow['keyBD']; ?>&elimina=si"><img src="../imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este reporte?') == false){return false;}" /></a>


	   </span></div></td>
     </tr>
     <?php }}?>
   </table>

 </form>


</body>
</html>
