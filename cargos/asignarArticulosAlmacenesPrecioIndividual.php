<?php
//actualizar ******************************************************************************************************
if(!$_POST['keyPA']){
$_POST['keyPA']=$_GET['keyPA'];
}


$sSQL6="SELECT descripcion,servicio,medico,codigo,gpoProducto
FROM
  articulos
WHERE
(keyPA = '".$_POST['keyPA']."' or keyPA='". $_GET['keyPA']."')
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);

  $grupo=$myrow6['gpoProducto'];



if($_POST['actualizar'] AND $_POST['keyPA'] ){
    $beneficencia=$_POST['beneficencia'];
$agregar = $_POST["codAlmacen"];
 $precioPaquete1=$_POST['precioPaquete1'];
 $precioPaquete3=$_POST['precioPaquete3'];
 $nivel1=$_POST['nivel1'];
 $nivel3=$_POST['nivel3'];
 $id_medico=$_POST['id_medico'];
$costo=$_POST['costo'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){






if($nivel1[$i]=='0'  and $nivel3[$i]=='0'){

 $sSQL3= "Select keyPA From articulosPrecioNivel WHERE keyPA='".$_POST['keyPA']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);

      $q = "insert into historialPrecios
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$_GET['codigo']."','".$nivel1[$i]."','".$nivel3[$i]."',
    '".$_POST['particular']."','".$_POST['aseguradora']."', '".$id_medico[$i]."',
        '".$_GET['keyPA']."','".$agregar[$i]."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
  




if($myrow3['keyPA']){


$q = "UPDATE articulosPrecioNivel set
    beneficencia='".$beneficencia[$i]."',
    codigo='".$myrow6['codigo']."',
precioPaquete1='".$precioPaquete1[$i]."',
precioPaquete3='".$precioPaquete3[$i]."',
nivel1='0.00',
nivel3='0.00',
id_medico='".$id_medico[$i]."',
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."'


WHERE
keyPA='".$_POST['keyPA']."' AND almacen='".$agregar[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda = "SE ACTUALIZARON DATOS ";
}else{
 $q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow6['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."','0.00','0.00', '".$id_medico[$i]."','".$_POST['keyPA']."',
    '".$agregar[$i]."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="SE AGREGARON DATOS";
}










}else if($nivel1[$i]>0 and $nivel3[$i]>0){
$sSQL3= "Select keyPA From articulosPrecioNivel WHERE keyPA='".$_POST['keyPA']."'
AND almacen = '".$agregar[$i]."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


if($myrow3['keyPA']){
 $q = "UPDATE articulosPrecioNivel set
    beneficencia='".$beneficencia[$i]."',
    codigo='".$myrow6['codigo']."',
precioPaquete1='".$precioPaquete1[$i]."',
precioPaquete3='".$precioPaquete3[$i]."',
nivel1='".$nivel1[$i]."',
nivel3='".$nivel3[$i]."',
id_medico='".$id_medico[$i]."',
usuario='".$usuario."',
fecha='".$fecha1."',
hora='".$hora1."'


WHERE
keyPA='".$_POST['keyPA']."' AND almacen='".$agregar[$i]."'
";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda = "SE ACTUALIZARON DATOS ";
}else{
$q = "insert into articulosPrecioNivel
(
codigo,precioPaquete1,
precioPaquete3,
nivel1,
nivel3,
id_medico,
keyPA,almacen,usuario,fecha,hora,entidad)
values
('".$myrow6['codigo']."','".$precioPaquete1[$i]."','".$precioPaquete3[$i]."','".$nivel1[$i]."','".$nivel3[$i]."','".$id_medico[$i]."','".$_POST['keyPA']."','".$agregar[$i]."','".$usuario."','".$fecha1."','".$hora1."','".$entidad."')";
mysql_db_query($basedatos,$q);
echo mysql_error();
$leyenda="SE AGREGARON DATOS";
}



}



//$leyenda = "Se ingreso el almacen para el articulo: ".$_POST['codigo'];
} //cierra validacion
}






//****************************************************************************************************************************



if($_POST['borrar'] AND $_POST['keyPA']){
$quitar = $_POST['quitar'];
for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($quitar[$i]){

 $borrameNivel = "DELETE FROM articulosPrecioNivel WHERE entidad='".$entidad."' and keyPA='".$_POST['keyPA']."' AND almacen='".$quitar[$i]."'";
mysql_db_query($basedatos,$borrameNivel);
}
}$leyenda = "Se elimino del almacen ";
} else if($_POST['borrar'] AND !$_POST['usuario']){
$leyenda = "Por favor, escoja el nombre de almacen que desee desactivar..!";
}




?>


<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
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


<?php  $sSQL33= "Select keyPA From existencias WHERE keyPA='".$_GET['keyPA']."'  ";
$result33=mysql_db_query($basedatos,$sSQL33);
$myrow33 = mysql_fetch_array($result33);?>

<?php if($myrow33['keyPA']!=NULL){ ?>


    <form id="form2" name="form2" method="POST" >
        <p><?php
        
        $sSQL6te="SELECT *
FROM
  gpoProductos
WHERE
codigoGP='".$_GET['gpoProducto']."'           
";
  $result6te=mysql_db_query($basedatos,$sSQL6te);
  $myrow6te = mysql_fetch_array($result6te);

  if(!$myrow6te['precioPorAlmacen']){
  echo '*Los precios son generales y solo se modifican en forma general...  ';
}
?></p>

      <p>
 <span >       <?php
	echo '<div ><blink>'.$leyenda.'</blink></div>';
	echo '</br>';
	$sSQL6d="SELECT descripcion,servicio,medico,cajaCon
FROM
  `articulos`
WHERE
keyPA = '".$_POST['keyPA']."'
  ";
  $result6d=mysql_db_query($basedatos,$sSQL6d);
  $myrow6d = mysql_fetch_array($result6d);
  echo $myrow6d['descripcion'];
  ?></span>

        <input name="keyPA" type="hidden"  id="codigo" readonly="" value="<?php echo $_POST['keyPA']; ?>" />
        </p>
      </p>
  <table width="200" class="table table-striped">

        <tr>
          <th width="39" align="center" >#</th>
          <th width="284" >Descripcion</th>
          
          
            <?php if($_GET['warehouse']=='SERVICIOS'){?>
          <th width="51" align="center" >P. Part</th>
          <th width="51" align="center" >Benef</th>
          <th width="51" align="center" >P. Aseg</th>
          <th width="66" align="center" >Quitar</th>
          
        
          
          <?php 
          }else{
          if($myrow6te['afectaExistencias']=='si'){
          print '<th width="51" align="center" >P.Unit Part</th>
          <th width="51" align="center" >P.Unit Aseg</th>
          <th width="51" align="center" >Part *Caja</th>
          <th width="60" align="center" >Aseg. *Caja</th>
          <th width="66" align="center" >Quitar</th>';
          }else{ 
          print '<th width="51" align="center" >P. Part</th>
          <th width="51" align="center" >P. Aseg</th>
          <th width="66" align="center" >Quitar</th>';
                           
          }
          }
          ?>
          
          
        </tr>
        <?php


$sSQL= "Select * From existencias
 where entidad='".$entidad."' AND codigo='".$_GET['codigo']."'     ";



$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$bandera += 1;
$codigoModulo = $myrow['codModulo'];


$alma=$myrow['almacen'];
$code=$myrow['codigo'];
 $sSQL6="SELECT *
FROM
  articulosPrecioNivel
WHERE (keyPA='".$_POST['keyPA']."' or codigo='".$_GET['codigo']."')  and almacen = '".$alma."'
and
codigo>0
  ";
  $result6=mysql_db_query($basedatos,$sSQL6);
  $myrow6 = mysql_fetch_array($result6);




 $sSQL661="SELECT *
FROM
  almacenes
WHERE entidad='".$entidad."' AND almacen = '".$alma."'
  ";
  $result661=mysql_db_query($basedatos,$sSQL661);
  $myrow661 = mysql_fetch_array($result661);



$sSQL6f="SELECT *
FROM
camposGrupos
WHERE gpoProducto='".$grupo."'  and id_almacen = '".$alma."'
  ";
  $result6f=mysql_db_query($basedatos,$sSQL6f);
  $myrow6f = mysql_fetch_array($result6f);

?>

        <tr  >
          <td height="43" align="center"><span ><?php echo $bandera;?></span></td>
          <td><span >
            <?php
		if($myrow['medico']=='si'){
		echo $myrow661['descripcion'].'<img src="../imagenes/simboloMedico.jpg" alt="ES UN MEDICO" width="12" height="12" />';
		} else{
                  echo $myrow661['descripcion'];  
                }
		?></span>
            <br /><span >Codigo Almacen</span><span >
          <?php echo $myrow['almacen'];?></span></td>
          
          
          
          
          
          
          
           <?php if($myrow6te['afectaExistencias']=='si'){?>
            <td align="center">
            <span >
            <?php 
            if($myrow6d['cajaCon']>0){
            echo '$'.number_format($myrow6['nivel1']/$myrow6d['cajaCon'],2);
            }else{
            echo '$'.number_format($myrow6['nivel1'],2);    
            }
            ?>
          </span> 
          </td>
          
          

          
          
          
            <td align="center">
            <span >
            <?php 
            if($myrow6d['cajaCon']>0){
            echo '$'.number_format($myrow6['nivel3']/$myrow6d['cajaCon'],2);
            }else{
            echo '$'.number_format($myrow6['nivel3'],2);
            }
            ?>
            </span> 
            </td>
            <?php }?>
          
          
          
          
          
          
          
          
          
          
          
          
          <td align="center">

            <input name="nivel1[]" type="text"  id="nivel1[]" size="6" value="<?php
		  if($myrow6['nivel1']>-1 and $myrow6['nivel3']>-1){
		 echo $myrow6['nivel1'];
		  }
		   ?>" autocomplete="off" <?php

		   if($_GET['nuevo']!='si' and !$myrow6f['gpoProducto']){ echo 'readonly="readonly"'; }

		   ?> />        
 
          </td>
          
          
          
          
           <?php 
           if($_GET['warehouse']=='SERVICIOS'){?>
            <?php if($myrow661['tipoBeneficencia']=='si'){?>
            <td align="center">
            <span >
 <input name="beneficencia[]" type="text"  id="nivel3[]" size="6"  value="<?php
		if($myrow6['beneficencia']>-1 and $myrow6['beneficencia']>-1){
		echo $myrow6['beneficencia'];
		}
		 ?>" autocomplete="off" <?php if($_GET['nuevo']!='si' and !$myrow6f['gpoProducto']){ echo 'readonly="readonly"'; } ?>/>
          </span> 
          </td>         
              
            <?php }else{  ?>
                      <td align="center">
           
          </td>  
          <?php }}?>
          
          
          
          
          
          
          
          
          
          <td align="center">            

            <input name="nivel3[]" type="text"  id="nivel3[]" size="6"  value="<?php
		if($myrow6['nivel1']>-1 and $myrow6['nivel3']>-1){
		echo $myrow6['nivel3'];
		}
		 ?>" autocomplete="off" <?php if($_GET['nuevo']!='si' and !$myrow6f['gpoProducto']){ echo 'readonly="readonly"'; } ?>/>
     
          </td>
          
          
          
          
          
          
          
          <td align="center"><span >
            <?php if($myrow6['codigo']){ ?>
            <input name="quitar[]" type="checkbox"  id="quitar"
		value="<?php echo $myrow['almacen'];?>"

		/>
            <?php } else{ echo '---';}?>
          </span></td>
          
          
          
          
          
    </tr>
        <input name="id_medico[]" type="hidden" id="id_medico[]" value="<?php echo $myrow661['id_medico']; ?>" />
      <input name="codAlmacen[]" type="hidden" id="codAlmacen[]" value="<?php echo $myrow['almacen']; ?>" />
      <?php }?>


  </table>
  <p>&nbsp;</p>


<p align="center">
      <label><span >

      <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $bandera; ?>" />
      </span>
     </label>



<?php
//    $sSQLa= "Select * From gpoProductos where
//
//
//codigoGP='".$_GET['gpoProducto']."'";
//$resulta=mysql_db_query($basedatos,$sSQLa);
//$myrowa = mysql_fetch_array($resulta);?>


   <?php if($bandera>0){?> 
    
    
    <?php if($tipoUsuario=='administrador'){?>
          <input name="actualizar" type="submit"  id="actualizar" value="Efectuar Cambios" />
          <input name="borrar" type="submit"  id="borrar" value="Eliminar/Borrar" />
    <?php }else{ ?>
          <div align="center" >
              <blink>Solo Administrador puede hacer cambios...</blink>    
          </div>
              <?php }?>
          
          
          
              <?php 
    }
        ?>



	        <input name="opcion" type="hidden"  id="opcion" value="<?php echo $_POST['opcion'];?>" />
      <input name="keyPA" type="hidden"  id="actualizar" value="<?php echo $_GET['keyPA'];?>" />
    </p>
</form>

  <?php } else{ ?>

 <span class="error">EL ARTICULO NO TIENE ALMACENES DEFINIDOS</span>

  <?php } ?>

  <p></p>

<br>
<br>
</body>
</html>
