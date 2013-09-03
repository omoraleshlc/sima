<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script> 



<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>

<script>
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
</script>
<?php
$_POST['porArticulo']=$_GET['porArticulo'];
$_POST['anaquel']=$_GET['anaquel'];
$_POST['almacenDestino']=$_GET['almacenDestino'];

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar'] and $_POST['conceptoinventarios']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];
$ct=$_POST['cantidadTotal'];
$ci=$_POST['conceptoinventarios'];
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$cajaCon=$_POST['cajaCon'];


for($i=0;$i<=$_POST['pasoBandera'];$i++){



//print 'ci:'.$ci[$i].' coder:'.$coder[$i].'  ct:'.$ct[$i];
//echo '<br>';

if($ci[$i]!=NULL AND $coder[$i]!=NULL and $ct[$i]>0){

    //VERIFICO SI NO GUARDA LAS EXISTENCIAS DE OTRO LADO
    $sSQL29p= "SELECT *
FROM
almacenes
where
entidad='".$entidad."'
and
almacen='".$_GET['almacenDestino']."' 

";
$result29p=mysql_db_query($basedatos,$sSQL29p);
$myrow29p = mysql_fetch_array($result29p);

if($myrow29p['almacenExistencias']!=NULL){
    
 $_GET['almacenDestino']=$myrow29p['almacenExistencias'];
   
}    










$sSQL8acd= "
SELECT * 
FROM
conceptoinventarios
WHERE
entidad='".$entidad."'
and
codigo='".$ci[$i]."'";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);


if($myrow8acd['naturaleza']=='A'){
    $tipoMov='entrada';
}elseif($myrow8acd['naturaleza']=='C'){
    $tipoMov='salida';
}

//KARDEX
$karticulos=new kardex();
$karticulos-> movimientoskardex($tipoMov,$ct[$i],$myrow8acd['descripcion'],$myrow8acd['tipoMovimiento'],$usuario,$fecha1,$hora1,$_GET['almacenDestino'],$_GET['almacenDestino'],$myrow8ac['keyPA'],$coder[$i],$entidad,$basedatos);
//CIERRO KARDEX

//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$codigo."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);






$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,costo,factura,tipo,status)
values
('".$coder[$i]."','".$keyPA[$i]."','".$gpoProducto[$i]."','".$ct[$i]."','".$myrow['tipoVenta']."','".$entidad."','".$tipoMov."',
    '".$fecha1."','".$hora1."','".$usuario."','".$_GET['almacenDestino']."','".$myrow3ac['costo']."',
    '','Normal','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();




$s='si';
}else{
$s=NULL;    
}
}





if($s=='si'){
echo '<script>
window.alert("Existencias actualizadas");
//window.close();
</script>';
}

//**********conversion a unidades***********
$entrance=new entradas();
$entrance=$entrance->entradaInventarios($_GET['almacenDestino'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);



//**********ACTUALIZA KARDEX**************
$actualizaK=new ActualizaKardex();
$actualizaK=$actualizaK-> updateKardex($usuario,$entidad,$basedatos);
//*******CIERRA ACTUALIZAR KARDEX*********s
//
//
//
//******************************************
}//cierra validacion


?>











<?php 
if($_POST['actualizar2'] || $_POST['actualizar'] || $_POST['delete']){
    if($_POST['actualizar2']){$descripcion='Presiono el boton actualizar articulos';
    }elseif($_POST['actualizar']){$descripcion='Presiono el boton actualizar existencias';
    }elseif($_POST['delete']){$descripcion='Presiono el boton de eliminar';}
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('".$descripcion."','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
?>




<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['delete'] and $_POST['codigo']){
$codigo=$_POST['codigo'];



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($codigo[$i]!=NULL){

  $q = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
          and
codigo='".$codigo[$i]."' 
and
almacen='".$_POST['almacenDestino']."'
 ";

mysql_db_query($basedatos,$q);
echo mysql_error();

   $q = "DELETE FROM articulosPrecioNivel WHERE 
       entidad='".$entidad."'
           and
codigo='".$codigo[$i]."'  
and
almacen='".$_POST['almacenDestino']."'
";

//mysql_db_query($basedatos,$q);
echo mysql_error();


}

}
?>
<script>
window.alert("Se quitaron articulos de este almacen");
</script>
<?php
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se quitaron articulos de este almacen';
}





?>














<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar2']){
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto'];
$descripcion=$_POST['descripcion'];
$cBarra=$_POST['cBarra'];

for($i=0;$i<=$_POST['pasoBandera'];$i++){

if($keyPA[$i]!=NULL){
  $q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',
cbarra='".$cBarra[$i]."',
fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
}
}
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron datos!';
}?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" >
    <br />
CONFIGURACION DE ARTICULOS PARA SU VENTA
<br />

   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
<form id="form1" name="form1" method="post" action="">
 

  <table width="800" class="table table-striped">
   

      
      
    <tr >
      <th width="10"  align="left">#</th>
      <th width="400"  align="left">Descripcion</th>
 
      
            <th width="10"  align="left">Existencias</th>
      <th width="10"  align="right">Costo</th>


      <th width="10"  align="left">Total</th>
    </tr>
<?php	
  
 
    $sSQL1= "
     select * from existencias
     where
    entidad='".$entidad."'
         and
         almacen='".$_GET['almacen2']."'
             and
             descripcion!=''
             group by codigo
          order by descripcion ASC
"; 
 


$result1=mysql_db_query($basedatos,$sSQL1);

while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}








    $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);




?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    
      
      
      
      
      
      <tr  >
      
        
        
        <td  ><span ><?php echo $a; ?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
        
        
      <td >
          <input name="keyPA[]" type="hidden" value="<?php echo $myrow1['keyPA']; ?>" />
          <input name="gpoProducto[]" type="hidden" value="<?php echo $myrow8ac['gpoProducto']; ?>" />
          <input name="cajaCon[]" type="hidden" value="<?php echo $myrow8ac['cajaCon']; ?>" />

    <?php echo ltrim($myrow8ac['descripcion']);	?>  
      </td>
        
        
     
      <td ><span >
 <?php 

 echo $myrowr['existencia'];
 ?>
      </span></td>
        
        
        
        
        
        
        
        
        
        
              <td ><span >
        
<?php $costo=$myrow8acb['costo'];
	if($myrow8acb['costo']>0){
	  echo '$'.number_format($myrow8acb['costo'],2);
        }else{
            echo '<span class="informativo"><blink>???</blink></span>';
        }
	 
		?>
      </span></td>
        
        
        

        
        
      

        
        

















        
        
  
        
        
        


      <td >
          
    <?php 

 echo '$'.number_format($costo*$myrow1['existencia'],2);
 ?>       
          
      </td>
    </tr>
    <?php  }//cierra while?>

 
    
  </table>
 
<p align="center">&nbsp;</p>
  <div align="center" class="precio1"><strong>
    <?php if($a>0){

	echo "Se encontraron $a registros..!"; 
	}
	?>
	</strong></div>
  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>"  />

    
    
    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>


<br></br>


</body>
</html>