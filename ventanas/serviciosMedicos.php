<?php require('/configuracion/ventanasEmergentes.php');?>
<?php require('/configuracion/funciones.php');?>







<?php 
if($_POST['update'] ){

$code=$_POST['code'];   $aseguradora=$_POST['aseguradora'];
$aly=$_POST['aly'];     $particular=$_POST['particular'];
$beneficencia=$_POST['beneficencia'];





for($i=0;$i<=$_POST['bandera'];$i++){

if($particular[$i]>-1 and $aseguradora[$i]>-1){

    
    $sSQL6td="SELECT *
FROM
  articulosPrecioNivel
WHERE
entidad='".$entidad."'
    and
    almacen='".$aly[$i]."'
        and
        codigo='".$code[$i]."'
     
    
  ";
  $result6td=mysql_db_query($basedatos,$sSQL6td);
  $myrow6td = mysql_fetch_array($result6td);

    $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$code[$i]."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."',
    '".$particular[$i]."','".$aseguradora[$i]."', '".$_GET['medico']."',
        '".$_GET['keyPA']."','".$aly[$i]."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

    
   $q = "UPDATE articulosPrecioNivel set 
       beneficencia='".$beneficencia[$i]."',
      nivel1='".$particular[$i]."',
      nivel3='".$aseguradora[$i]."'
    
		WHERE 
entidad='".$entidad."'
    and
    almacen='".$aly[$i]."'
        and
        codigo='".$code[$i]."'
            
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	
}
}
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron los precios...';
}
?>













<?php  
if(!$_POST['update'] AND (($_GET['almacen'] and $_GET['codigo']) and $_GET['boton']=='delete' )){

    
   
    
    
  $q0 = "DELETE FROM almacenes  

	
		WHERE
entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
       
        
        ";
		//mysql_db_query($basedatos,$q0);
		echo mysql_error();    
    
    

$q1 = "DELETE FROM existencias  

	
		WHERE
entidad='".$entidad."'
    and
    id_medico='".$_GET['medico']."'
        and
        codigo='".$_GET['codigo']."'";
		mysql_db_query($basedatos,$q1);
		echo mysql_error();
                
                
                
	$q2 = "DELETE FROM articulosPrecioNivel	
		WHERE
entidad='".$entidad."'
    and
    almacen='".$_GET['almacen']."'
        and
        codigo='".$_GET['codigo']."'";
		mysql_db_query($basedatos,$q2);
		echo mysql_error();
                
                
                
	$q2 = "DELETE FROM camposGrupos	
		WHERE
entidad='".$entidad."'
    and
    id_almacen='".$_GET['almacen']."'
       
";
		mysql_db_query($basedatos,$q2);
		echo mysql_error();                
                
                

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se eliminaron registros...';
}
?>








<?php
if(!$_POST['opcion']){
    $_POST['opcion']=$_GET['opcion'];
}
?>






<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>











<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria17 (URL){ 
   window.open(URL,"ventanaSecundaria17","width=800,height=700,scrollbars=YES") 
} 
</script>

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
<h1 align="center" ><br />

    <?php echo 'MEDICO: '.$_GET['nombreCompleto'];?>

</h1>
<p align="center" ><a href="javascript:ventanaSecundaria17('ventanaAgregarServicios.php?medico=<?php echo $_GET['medico'];?>&nombreCompleto=<?php echo $_GET['nombreCompleto'];?>&departamento=<?php echo $_GET['departamento'];?>&req=<?php echo $_GET['req'];?>')">
        CARGAR HONORARIOS 
    </a>
</p>




   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>





  <form id="form1" name="form1" method="post" >

    	
	
	
    <table width="640" class="table table-striped">
   <tr >
        
          
         <th width="21" height="19"  scope="col">#</th>
          
          
          <th width="57" height="19"  scope="col">Codigo</th>
          
        
        <th width="261"  scope="col">Descripcion del Servicio</th>

       
       
           <th width="99"  scope="col">Almacen</th>
       

       
    <th width="99"  scope="col">Beneficencia</th>       
       
        

    <th width="99"  scope="col">Particular</th>

        
        
                
        
    
        
        
        <th width="83"  scope="col">
           Aseguradora</th>
        
    <th width="71"  scope="col">Eliminar</th>
        
      </tr>
<?php	
 $sSQL= "SELECT  
* 
FROM existencias
WHERE
entidad='".$entidad."'
and

id_medico='".$_GET['medico']."'
    
    order by 
descripcion ASC
";


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
    

    
    
    $a+=1;
$bandera+=1;
$bandera1+=1;
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
entidad='".$entidad."'
    and
codigo='".$myrow['codigo']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL4= "
SELECT 
razonSocial
FROM
proveedores
WHERE
entidad='".$entidad."'
and

 id_proveedor = '".$myrow['id_proveedor']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

 $sSQL39d= "
	SELECT 
*
FROM
articulosPrecioNivel
WHERE 
entidad='".$entidad."'
    and
    almacen='".$myrow['almacen']."'
and 
codigo='".$myrow['codigo']."'
";
$result39d=mysql_db_query($basedatos,$sSQL39d);
$myrow39d = mysql_fetch_array($result39d);

$sSQL39e1= "
	SELECT 
almacenPadre
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$myrow['almacen']."'";
$result39e1=mysql_db_query($basedatos,$sSQL39e1);
$myrow39e1= mysql_fetch_array($result39e1);
 $sSQL39e2= "
	SELECT 
descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$myrow39e1['almacenPadre']."'";
$result39e2=mysql_db_query($basedatos,$sSQL39e2);
$myrow39e2= mysql_fetch_array($result39e2);







?>

  
      <tr >

<td height="5" ><?php echo $a;?></td>


        

        <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera;?>" />
        
        
        <td height="21" >
        
        <?php 
        echo cambia_a_normal($myrow['fechaA']);
        echo '<br>';
        echo $myrow['codigo'];?>
        
        </td>
        
        
        <td >
		<?php 
		echo $myrow12['descripcion']; 
		
		
		?>
		  <input type="hidden" name="keyR[]"  value="<?php echo $myrow['keyR'];?>" />
          <input type="hidden" name="keyPA[]" value="<?php echo $myrow['keyPA'];?>" />
         <input type="hidden" name="code[]" value="<?php echo $myrow['codigo'];?>" />
        <input type="hidden" name="aly[]" value="<?php echo $myrow['almacen'];?>" />
        </td>
        
        
        
        
        
        
          
       

       
        <td >
			<?php 

		echo $myrow39e2['descripcion'];
		
		?>
        </td>        
        
    
        <td >
	<input  name="beneficencia[]" type="text" size="6" value="<?php echo $myrow39d['beneficencia']; ?>"  autocomplete="off" <?php  if($myrow['status']=='notaCredito')echo 'readonly=""';?>/>		
        </td>        
        
        
        <td >
	<input  name="particular[]" type="text" size="6" value="<?php echo $myrow39d['nivel1']; ?>"  autocomplete="off" <?php  if($myrow['status']=='notaCredito')echo 'readonly=""';?>/>		
        </td>
        
        <td >
        <label>
        <input  name="aseguradora[]" type="text"  size="6" value="<?php echo $myrow39d['nivel3']; ?>" autocomplete="off"  <?php  if($myrow['status']=='notaCredito')echo 'readonly=""';?>/>
	</label>
        </td>
        



                
                

        
        
      
        
        
   
        
 
        
        
  <td ><div align="center">
                <a href="<?php echo $_SERVER['PHP_SELF'];?>?nombreCompleto=<?php echo $_GET['nombreCompleto']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;boton=delete&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;codigo=<?php echo $myrow['codigo']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&opcion=<?php  echo $_POST['opcion'];?>&medico=<?php echo $_GET['medico'];?>"> 
                    <img src="/sima/imagenes/btns/cancelabtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="16" height="16" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este registro?') == false){return false;}" /></a></div>
        </td>
        
      </tr>
      <?php } //cierra while
	
	  ?>
    </table>
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

      <input name="update" type="submit" id="update" value="Actualizar Datos" />
      
      
    <label>
        <input type="hidden" name="opcion" value="<?php echo $_POST['opcion'];?>" />
    </label>
</p>
  </form>
  <p>&nbsp;    </p>
<br />

</body>
</html>