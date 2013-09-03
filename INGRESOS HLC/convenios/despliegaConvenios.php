<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); 
$numCliente=$_GET['numCliente'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>

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
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar art�culos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 
if($_POST['actualizar'] ){

$costo=$_POST['costo'];
$keyConvenios=$_POST['keyConvenios'];
for($i=0;$i<=$_POST['flag'];$i++){

if($costo[$i]>0){
$sql="Update convenios
set
costo = '".$costo[$i]."', 
usuario='".$usuario."'
where keyConvenios='".$keyConvenios[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}

}
echo 'se modificaron convenios..';
}
?>





<?php 

if(!$_POST['actualizar'] and $_POST['keyConvenios1'] and $_POST['eliminar']){

$keyConvenios1=$_POST['keyConvenios1'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyConvenios1[$i]){
$borrame = "DELETE FROM convenios WHERE keyConvenios='".$keyConvenios1[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}

}
echo "Se eliminaron convenios";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos= new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center" class="titulos">
  <label></label><label>
  </label> 
<?php echo $_POST['almacenDestino'];
$sSQL23= "Select * From clientes WHERE entidad='".$entidad."' and numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'].'</br>';
echo $leyenda;
?> </span><span class="style15"><?php echo $leyenda; ?></span></p>
<form id="form2" name="form2" method="post" action="" >
  <table width="200" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="8"><img src="../../imagenes/bordestablas/borde1.png" width="780" height="25" /></td>
    </tr>
    <tr bgcolor="#FFFF00">
         <td width="10" class="negromid">#</td>
     <td width="50" class="negromid">AlmacenIngreso</td>
      <td width="320" class="negromid">Descripcion</td>
      <td width="47" align="center" class="negromid">Precio</td>
      <td width="70" align="center" class="negromid">F.Inicial</td>
      <td width="68" align="center" class="negromid">F. Final</td>
      <td width="42" align="center" class="negromid">Quitar</td>
    </tr>
<?php	




$sSQL= "SELECT 
* FROM
  convenios
   WHERE 
entidad='".$entidad."'
and
tipoConvenio='cantidad'
and
numCliente='".$_GET['numCliente']."'
order by departamento ASC
 ";

$result=mysql_db_query($basedatos,$sSQL);

if($numCliente){
while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;
$a+=1;


 $checaModuloScript2a= "Select almacenPadre,descripcion,id_medico from almacenes WHERE entidad='".$entidad."' and almacen = '".$myrow['departamento']."' ";
$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
$resulScripModulo2a = mysql_fetch_array($resScript2a);



$d=$resulScripModulo2a['descripcion'];
$id=$resulScripModulo2a['id_medico'];

$sSQLa= "Select especialidad From medicos where
entidad='".$entidad."'
AND
numMedico='".$id."'";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);



if($myrow['costo']<1){
$bg= '#FF0000';
} else {
$bg= '#ffffff';
}
?>    
    
    <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >

<td bgcolor="<?php echo $bg;?>" height="5" bckgr class="normalmid"><?php  echo $a;?></td>




<td bgcolor="<?php echo $bg;?>" height="46"><span class="normalmid">
        <?php
$checaModuloScript2a= "Select descripcion from almacenes WHERE entidad='".$entidad."' and almacen = '".$resulScripModulo2a['almacenPadre']."' ";
$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
$resulScripModulo2a = mysql_fetch_array($resScript2a);




if($resulScripModulo2a['descripcion']){
echo $resulScripModulo2a['descripcion'];
}else{
echo '<span class="error">ERROR: Centro de Costo Eliminado!</span>';
}


?>
        <br />
        <span class="negro">N° Guia: </span><span class="codigos"><?php
					echo $myrow['keyConvenios'];
		?></span>
        <input name="keyConvenios[]" type="hidden"   value="<?php echo $myrow['keyConvenios']; ?>" />
      </span>
      </td>






      <td bgcolor="<?php echo $bg;?>"><span class="normalmid">
<?php



echo '<br />';
$sSQLa2= "Select descripcion From articulos where
entidad='".$entidad."'
AND
codigo='".$myrow['codigo']."'";
$resulta2=mysql_db_query($basedatos,$sSQLa2);
$myrowa2 = mysql_fetch_array($resulta2);
echo $myrowa2['descripcion'];
echo '<br />';









if($id!=NULL){
echo $d;
                echo '<br>';
if($myrowa['especialidad']!=NULL){
$sSQLa= "Select descripcion From especialidades where
entidad='".$entidad."'
AND
codigo='".$myrowa['especialidad']."'";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);
         echo $myrowa['descripcion'];
           echo '<br>';
}
}else{



//$checaModuloScript2a= "Select descripcion from articulos WHERE entidad='".$entidad."' and codigo = '".$myrow['codigo']."' ";
//$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
//$resulScripModulo2a = mysql_fetch_array($resScript2a);
//   if($resulScripModulo2a['descripcion']){
//echo $resulScripModulo2a['descripcion'];
//   }else{
// echo '<span class="error">ERROR: Este articulo/servicio ya no existe, favor de eliminar del convenio!</span>';
//   }
}



?>

      </span></td>






      <td bgcolor="<?php echo $bg;?>" align="center"><span class="normal">
        <input name="costo[]" type="text" class="camposmid" id="costo[]"  value="<?php 
if($myrow['costo']>0){
echo $myrow['costo'];
} else {
echo '0';
}
?>" size="4" maxlength="6"
<?php 
if($myrow['cantidadoPorcentaje']=='no'){
echo 'readonly=""';
}
?>
/>
      </span></td>












      <td bgcolor="<?php echo $bg;?>" class="negro" align="center"><?php
	  echo cambia_a_normal($myrow['fechaInicial']);
	 // echo $myrow2['existencias'];
	 
	  ?></td>








      <td bgcolor="<?php echo $bg;?>" align="center"><span class="negro"><?php echo cambia_a_normal($myrow['fechaFinal'],2);
	  ?></span></td>








  
      <td bgcolor="<?php echo $bg;?>" align="center"><input name="keyConvenios1[]" type="checkbox" id="keyConvenios1[]" value="<?php echo $myrow['keyConvenios']; ?>" /></td>








      
    </tr>
	<?php  
	  $bandera+='1';
	  }  //cierra while?>


      
    <tr>
      <td colspan="8"><img src="../../imagenes/bordestablas/borde2.png" width="780" height="25" /></td>
    </tr>
  </table>
  <br />
  <span class="precio2"><?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></span>
  <label>
    
  </label>
  <div align="center">

  <input name="almacenDestino" type="hidden" id="almacenDestino"  value="<?php echo $_POST['almacenDestino']; ?>" />
	 
	  
	  

	  <input name="almacenDestino1" type="hidden" id="almacenDestino1"  value="<?php echo $_POST['almacenDestino1']; ?>" />

	  

	  <input name="search" type="hidden" id="search"  value="search" />

	  
      <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />
      
      <br />
    <table width="322" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="123" align="center"><input name="actualizar" type="submit" class="Estilo24" id="actualiza" value="Actualizar" /></td>
          <td width="21">&nbsp;</td>
          <td width="23">&nbsp;</td>
          <td width="155" align="center"><input name="eliminar" type="submit" class="Estilo24" id="eliminar" value="Eliminar art&iacute;culos" /></td>
        </tr>
      </table>
    <?php }
	  
	   ?>

    </div>
</form>
  <p></p>
  
  
</body>
</html>
