<?php 
//actualizar ******************************************************************************************************
 if(!$_POST['keyPA']){
$_POST['keyPA']=$_GET['keyPA'];
}
	




if($_POST['actualizar'] AND $_POST['keyE'] ){

$cantidadSurtir=$_POST['cantidadSurtir'];
$almacen=$_POST['almacen'];
$existencia=$_POST['existencia'];
$keyE=$_POST['keyE'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){




if($keyE[$i]!=NULL){
$q = "UPDATE existencias set
existencia='".$existencia[$i]."',
                cantidadSurtir='".$cantidadSurtir[$i]."'
  
            


WHERE
keyE='".$keyE[$i]."'
";
//mysql_db_query($basedatos,$q);
echo mysql_error();
}





$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='SE ACTUALIZARON DATOS...';

}
$_GET['keyE']='';
}//cierra validacion






//****************************************************************************************************************************








?>






<?php  
if($_GET['keyE'] AND ($_GET['inactiva']=='si' or $_GET['activar']=='si')){

if($_GET['inactiva']=="si"){
$borrameNivel = "UPDATE existencias
set
existencia='',
tipoVenta='',
ventaGranel='',
cantidadSurtir=''
WHERE
keyE='".$_GET['keyE']."'";
mysql_db_query($basedatos,$borrameNivel);
echo mysql_error();


$tipoMensaje='error';
$encabezado='Exitoso';
$texto='PRODUCTO A GRANEL DESACTIVADO!';
	} elseif($_GET['activar']=='si'){
        $borrameNivel = "UPDATE existencias
set      

    
    
modoventa='Granel',
tipoVenta='Granel',
ventaGranel='si'

WHERE
keyE='".$_GET['keyE']."'";
mysql_db_query($basedatos,$borrameNivel);
echo mysql_error();


$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='PRODUCTO A GRANEL ACTIVADO!';    
        }



}
?>

<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo solo acepta numeros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>


<?php  $sSQL33= "Select keyPA From existencias WHERE entidad='".$entidad."' and  keyPA='".$_GET['keyPA']."'  ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);?>

<?php if($myrow33['keyPA']){ ?>


<form id="form2" name="form2" method="POST" >

      <p>
 <span >
    
	   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>


<?php 
	echo '</br>';
	$sSQL6="SELECT descripcion,servicio,medico
FROM
  `articulos`
WHERE
keyPA = '".$_POST['keyPA']."'  
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);
  echo $myrow6['descripcion'];
  ?></span>
        
        <input name="keyPA" type="hidden"  id="codigo" readonly="" value="<?php echo $_POST['keyPA']; ?>" />
        </p>
      </p>

  <table width="500" class="table table-striped">
        <tr>
          <th width="33" align="left"  >#</th>
          <th width="136" align="left"  >Descripcion</th>



         
          <th width="67" align="center"  >Status</th>
         <th width="67" align="center"  >Accion</th>
       
        </tr>
<?php  require("/configuracion/funciones.php");
$cendis=new whoisCendis();
$aP=$centroDistribucion=$cendis->cendis($entidad,$basedatos);  
  
$sSQL= "Select * From existencias
where entidad='".$entidad."' AND keyPA='".$_GET['keyPA']."' 
and
almacen!='".$aP."'

";

 
 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){

$bandera += 1;
$codigoModulo = $myrow['codModulo'];


$alma=$myrow['almacen'];
$code=$myrow['codigo'];
 $sSQL6="SELECT codigo,nivel1,nivel3,almacen
FROM
  articulosPrecioNivel
WHERE (keyPA='".$_POST['keyPA']."' or codigo='".$_GET['codigo']."')  and almacen = '".$alma."'
and
codigo>0
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);

 
  
  
    $sSQL661="SELECT id_medico,descripcion,stock
FROM
  almacenes
WHERE entidad='".$entidad."' AND almacen = '".$alma."'
  ";
  $result661=mysql_db_query($basedatos,$sSQL661);
  $myrow661 = mysql_fetch_array($result661);
  
 
  
$sSQL6f="SELECT *
FROM
camposGrupos
WHERE entidad='".$entidad."' and gpoProducto='".$grupo."'  and id_almacen = '".$alma."'
  ";
  $result6f=mysql_db_query($basedatos,$sSQL6f);
  $myrow6f = mysql_fetch_array($result6f);
 
?>
   
        <tr  >
          <td  align="center"><span ><?php echo $bandera;?></span></td>
          <td><span >
            <?php 
		if($myrow['medico']=='si'){
		echo $myrow661['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else {
		echo $myrow661['descripcion'];
		}
		?></span>
            <br /><span class="negro">Codigo Almacen</span><span class="codigos">
            <?php echo $myrow['almacen'];?>
            <input name="id_medico[]" type="hidden"  value="<?php echo $myrow661['id_medico']; ?>" />
            <input name="almacen[]" type="hidden"  value="<?php echo $myrow['almacen']; ?>" />
            </span></td>

          
          
          
          
                    

    
   
          
 
          
          
          
          
          
          

          
          

          
          
                    
          
          
          
          

          
          
          
          <td align="center" >
              <input name="cantidadSurtir[]" type="hidden"   />
              <input name="existencia[]" type="hidden"   />
<?php if($myrow['ventaGranel']=='si'){?>             


    <span class="success">Activo</span>

<?php }else{?>
    <span class="notice">Inactivo</span>
         <?php } ?>
         </td>
          
          
          
          
          
          

         <td align="center" >
<?php if($myrow['ventaGranel']=='si'){?>             
<a   href="listaAlmacenesTodos.php?inactiva=si&keyE=<?php echo $myrow['keyE'];?>&tipoVenta=activado&keyPA=<?php echo $_GET['keyPA'];?>&codigo=<?php echo $_GET['codigo'];?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>">               

    <span class="error">Desactivar</span>
</a>
<?php }else{?>
<a   href="listaAlmacenesTodos.php?activar=si&keyE=<?php echo $myrow['keyE'];?>&tipoVenta=activado&keyPA=<?php echo $_GET['keyPA'];?>&codigo=<?php echo $_GET['codigo'];?>&gpoProducto=<?php echo $_GET['gpoProducto'];?>">               

    <span class="success">Activar</span>
</a>    

             <?php }?>
         </td>





<input name="keyE[]" type="hidden"  id="actualizar" value="<?php echo $myrow['keyE'];?>" /> 


    </tr>

      <?php }?>
  </table>

<p>&nbsp;</p>
      
	        
<p align="center">
    

    
      <label><span >

      <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
      </span>
          
          
          
<?php if($tipoUsuario=='administrador'){?>          
      <input name="actualizar" type="submit"  id="actualizar" value="Efectuar Cambios" />
      <br>
         
      </br>
          <?php }else{ ?>
         
              <blink>Solo Administrador puede hacer cambios...</blink>    
          
              <?php }?>
      
      
      
      
      </label>

	
     <input name="opcion" type="hidden"  id="opcion" value="<?php echo $_POST['opcion'];?>" />
      <input name="keyPA" type="hidden"  id="actualizar" value="<?php echo $_GET['keyPA'];?>" />
      
    </p>
</form>

  <?php } else{ ?>
  
 <span class="error" >EL ARTICULO NO TIENE ALMACENES DEFINIDOS</span>
  
  <?php } ?>


  
  
</body>
</html>
