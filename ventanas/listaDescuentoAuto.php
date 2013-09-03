<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); 
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
if($_POST['actualizar'] and $_POST['porcentaje']){

$porcentaje=$_POST['porcentaje'];
$keyDA=$_POST['llave'];
for($i=0;$i<=$_POST['flag'];$i++){

if($porcentaje[$i]){
$sql="Update descuentosAutomaticos
set
porcentaje = '".$porcentaje[$i]."', 
usuario='".$usuario."'
where keyDA='".$keyDA[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}
 $leyenda='Se actualizaron Registros...';
}
?>





<?php 

if(!$_POST['actualizar'] and $_POST['keyDA'] and $_POST['eliminar']){

$keyDA=$_POST['keyDA'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyDA[$i]){
$borrame = "DELETE FROM descuentosAutomaticos WHERE keyDA='".$keyDA[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}

}
echo '<script>';
echo 'window.opener.document.forms["form1"].submit();';
echo '</script>';
echo "Se eliminaron descuentos";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
 
<span >
<?php echo $_POST['almacenDestino'];
$sSQL23= "Select * From almacenes WHERE entidad='".$entidad."' and almacen='".$_GET['almacen2']."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $rNombre23['descripcion'].'</br>';

?> </span></p>
<form id="form2" name="form2" method="post" action="" >
    <p align="center" >DESCUENTOS AUTOMATICOS</p>

  <table width="631" class="table table-striped">
      <tr >
        <th width="35"  scope="col"><div align="left"><span >C&oacute;digo</span></div></th>
        <th width="162"  scope="col"><div align="left"><span >Descripci&oacute;n</span></div></th>
        <th width="121"  scope="col"><div align="left"><span >gpoProducto</span></div></th>
        <th width="19"  scope="col"><div align="left"><span >%  </span></div></th>
         <th width="51"  scope="col"><div align="left"><span >FechaInicial</span></div></th>
          <th width="51"  scope="col"><div align="left"><span >FechaFinal</span></div></th>
        <th width="51"  scope="col"><div align="left"><span >Tipo</span></div></th>
        <th width="51"  scope="col"><div align="left"><span >Elimina</span></div></th>
      </tr>
      
<?php	




 $sSQL= "SELECT 
 *
FROM
  descuentosAutomaticos
   WHERE 
   entidad='".$entidad."'
   and

departamento = '".$_GET['almacen2']."'
order by keyDA ASC

 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;



if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
        
          
<tr>          
          <td  >
          <label> 
          <?php 
	
		  echo $myrow['keyDA'];
?>
              
              
              
		</label></td>
          
          
          
          
          
        <td ><span >
                <?php 
					echo 'Descuentos x Convenios';
                                        echo '<br>';
                                        echo 'TipoDescuento: '.$myrow['tipoDescuento'];
		?>
                <input name="keyDAS" type="hidden" id="keyDAS"  value="<?php echo $myrow['keyDA']; ?>" />
        </span></td>
    
    
    
    
    
        <td  >
		<span >
        <?php echo $myrow['gpoProducto'];?>        </span></td>
        <td  ><span >
   
          <input name="porcentaje[]" type="text"  id="porcentaje[]"  value="<?php 
echo $myrow['porcentaje'];
?>" size="3" maxlength="3"

/>
         
        </span></td>
        <td  ><span >
          <?php 
          
          if($myrow['fechaInicial']!=''){
	  echo cambia_a_normal($myrow['fechaInicial']);
          }else{
              echo '---';
          }
	 // echo $myrow2['existencias'];
	 
	  ?>
        </span></td>
        <td  ><label><span ><?php 
        if($myrow['fechaFinal']!=''){
        echo cambia_a_normal($myrow['fechaFinal'],2);
        }else{
            echo '---';
        }
	  ?>
     
        </span></label></td>
        <td  ><span ><?php echo $myrow['tipoPaciente'];?></span></td>
        <td  >
<input name="llave[]" type="hidden"  value="<?php echo $myrow['keyDA']; ?>" />		
		<input name="keyDA[]" type="checkbox" id="keyDA[]" value="<?php echo $myrow['keyDA']; ?>" /></td>
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
      <input name="flag" type="hidden"  value="<?php echo $bandera; ?>" />
      <?php if($bandera>0){ ?>
      <input name="actualizar" type="submit"  id="actualiza" value="Actualizar" />
      <input name="eliminar" type="submit"  id="eliminar" value="Eliminar art&iacute;culos" />
	  <?php } ?>
   
    </div>
</form>
  <p></p>
  
  
</body>
</html>
