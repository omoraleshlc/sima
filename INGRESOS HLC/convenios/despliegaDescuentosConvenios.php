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
                alert("Por Favor, escoje como quieres agregar artículos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 
if($_POST['actualizar'] and $_POST['costo']){

$costo=$_POST['costo'];
$keyConvenios=$_POST['keyConvenios'];
for($i=0;$i<=$_POST['flag'];$i++){

 $sql="Update convenios
set
costo = '".$costo[$i]."', 
usuario='".$usuario."'
where keyConvenios='".$keyConvenios[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

}
 $leyenda='Se actualizaron Registros...';
}
?>





<?php 

if(!$_POST['actualizar'] and $_POST['keyConvenios'] and $_POST['eliminar']){

$keyConvenios=$_POST['keyConvenios'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyConvenios[$i]){
$borrame = "DELETE FROM convenios WHERE keyConvenios='".$keyConvenios[$i]."'";
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
<style type="text/css">
<!--
.style12 {font-size: 10px}
.style11 {color: #FFFFFF; font-size: 10px; font-weight: bold; }
.style7 {font-size: 9px}
.Estilo24 {font-size: 10px}
.style15 {color: #0000FF}
.style13 {color: #FFFFFF}
.style72 {font-size: 9px}
.style72 {font-size: 9px}
.style72 {font-size: 9px}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
<span class="style15">
<?php echo $_POST['almacenDestino'];
$sSQL23= "Select * From clientes WHERE numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'].'</br>';

?> </span></p>
<form id="form2" name="form2" method="post" action="" >
    <p align="center" class="style15"><?php echo $leyenda; ?>DESCUENTOS x CONVENIO </p>
    <table width="610" border="0" align="center">
      <tr>
        <th width="74" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">C&oacute;digo</span></div></th>
        <th width="105" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Descripci&oacute;n</span></div></th>
        <th width="58" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">gpoProducto</span></div></th>
        <th width="91" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Incluye Referidos</span></div></th>
        <th width="79" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Depto.</span></div></th>
        <th width="13" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">%  </span></div></th>
        <th width="63" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">F. Inicial</span></div></th>
        <th width="54" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">F. Final </span></div></th>
        <th width="35" bgcolor="#660066" class="Estilo24" scope="col"><div align="left"><span class="style11 style13">Elimina</span></div></th>
      </tr>
      <tr>
<?php	




 $sSQL= "SELECT 
 *
FROM
  convenios
   WHERE 
   entidad='".$entidad."'
   and
tipoConvenio='descuentoConvenio'
and

numCliente = '".$_GET['numCliente']."'


 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;




if($myrow['tipoConvenio']=='cantidad'){
$codigo=$myrow['codigo'];
$checaModuloScript2= "Select descripcion from articulos WHERE codigo = '".$codigo."' ";
$checaModuloScript24= "Select descripcion from almacenes WHERE almacen = '".$myrow['departamento']."' ";
$resScript24=mysql_db_query($basedatos,$checaModuloScript24);
$resulScripModulo24 = mysql_fetch_array($resScript24);
$descripcionAlmacen=$resulScripModulo24['descripcion'];

$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
$descripcion=$resulScripModulo2['descripcion'];
$descripcion=$descripcion.' ['.$descripcionAlmacen.']';
echo mysql_error();
} else if($myrow['tipoConvenio']=='grupoProducto') {

$codigo=$myrow['gpoProducto'];
$checaModuloScript2= "Select descripcionGP from gpoProductos WHERE codigoGP = '".$codigo."' ";
$resScript2=mysql_db_query($basedatos,$checaModuloScript2);
$resulScripModulo2 = mysql_fetch_array($resScript2);
$descripcion=$resulScripModulo2['descripcionGP'];
} else {
$descripcion='Convenio Global';
}

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
        <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <label> <span class="style11 style13">
          <?php 
	
		  $C=$myrow['codigo'];?>
       
		  </span>
          <?php echo $C?>          </label>
		  
		  
		  <?php //echo $myrow['keyConvenios']; ?>
          <input name="keyConvenios[]" type="hidden" id="keyConvenios[]"  value="<?php echo $myrow['keyConvenios']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
                <?php 
					echo 'Descuentos x Convenios';
		?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24">
		<span class="style7">
          <?php echo $myrow['gpoProducto'];?>
        </span></td>
        <td bgcolor="<?php echo $color?>"><span class="style11"><?php 
		if($myrow['incluirReferidos']){ 
		echo $myrow['incluirReferidos'];
		} else {
		echo '---';
		}
		?></span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
if($myrow['departamento']=='*'){
echo $myrow['departamento']." [Todos] ";
} else {
echo "---";
}
?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
   
          <input name="costo[]" type="text" class="style12" id="costo[]"  value="<?php 
if($myrow['costo']){
echo $myrow['costo'];
} else {
echo '0';
}
?>" size="3" maxlength="3"
<?php 
if($myrow['cantidadoPorcentaje']=='no'){
echo 'readonly=""';
}
?>
/>
         
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style7">
          <?php 
	  echo cambia_a_normal($myrow['fechaInicial']);
	 // echo $myrow2['existencias'];
	 
	  ?>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><label><span class="style7"><?php echo cambia_a_normal($myrow['fechaFinal'],2);
	  ?>
     
        </span></label></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24">
		
		<input name="keyConvenios[]" type="checkbox" id="keyConvenios[]" value="<?php echo $myrow['keyConvenios']; ?>" /></td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while
	  ?>
  </table>
    <p align="center"><em> 
	
	
	<?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php 
	}else{
	echo "No se encontraron registros..!";
	}
	?></em></p>





    <div align="center">

      <input name="almacenDestino" type="hidden" id="almacenDestino"  value="<?php echo $_POST['almacenDestino']; ?>" />
	 
	  
	  

	  <input name="almacenDestino1" type="hidden" id="almacenDestino1"  value="<?php echo $_POST['almacenDestino1']; ?>" />

	  

	  <input name="search" type="hidden" id="search"  value="search" />

	  
      <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />
      <?php if($bandera>=1){ ?>
      <input name="actualizar" type="submit" class="Estilo24" id="actualiza" value="Actualizar" />
      <input name="eliminar" type="submit" class="Estilo24" id="eliminar" value="Eliminar art&iacute;culos" />
	  <?php } ?>
   
    </div>
</form>
  <p></p>
  
  
</body>
</html>
