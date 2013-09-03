<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>



<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=800,height=900,scrollbars=YES") 
} 
</script> 


<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>
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
<?php

$hoy = date("d/m/Y");
$hora = date("g:i a");




if($_POST['actualizar']){
$alma=$_POST['almacenDestino1']=$_POST['almacenDestino'];
$existencias = $_POST['existencias'];
$razon=$_POST['razon'];
$coder=$_POST['codigoAlfa'];



  $q = "DELETE FROM articulosExistencias WHERE 
      entidad='".$entidad."'
           and
almacen='".$_POST['almacenDestino']."'
 ";

//mysql_db_query($basedatos,$q);
echo mysql_error();



for($i=0;$i<=$_POST['pasoBandera'];$i++){


if($coder[$i]  AND $alma and $existencias[$i]>0){

$sSQL8acd= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$coder[$i]."'
";
$result8acd=mysql_db_query($basedatos,$sSQL8acd);
$myrow8acd = mysql_fetch_array($result8acd);







$karticulos=new kardex();
$karticulos-> movimientoskardex('entrada',$existencia,'AJUSTE A INVENTARIOS','ajusteSuma',$usuario,$fecha1,$hora1,$_POST['almacenDestino1'],$_POST['almacenDestino1'],$myrow8b['keyPA'],$coder[$i],$entidad,$basedatos);



//DETERMINAR EL COSTO				
$sSQL3ac="SELECT costo
FROM
precioArticulos
WHERE 
entidad='".$entidad."'
and
codigo='".$coder[$i]."'
order by keyC DESC
  ";
  $result3ac=mysql_db_query($basedatos,$sSQL3ac);
  $myrow3ac = mysql_fetch_array($result3ac);	
  
$agrega = "INSERT INTO entradaArticulos (
codigo,keyPA,gpoProducto,cantidad,tipoVenta,entidad,tipoMov,fecha,hora,usuario,almacen,costo,factura,tipo,status)
values
('".$coder[$i]."','".$myrow8acd['keyPA']."','".$myrow8acd['gpoProducto']."','".$existencias[$i]."','','".$entidad."','entrada',
    '".$fecha1."','".$hora1."','".$usuario."','".$_POST['almacenDestino1']."','".$myrow3ac['costo']."','','Normal','standby')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}//innsertalo







}












$entrance=new entradas();
$entrance=$entrance->entradaInventarios($_POST['almacenDestino1'],$fecha1,$hora1,$_GET['id_factura'],$usuario,$entidad,$basedatos);



$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron existencias...';
}





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


if($codigo[$i]){

  $q = "DELETE FROM existencias WHERE 
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

mysql_db_query($basedatos,$q);
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


<style>
    
 .encabeza{
   font-size: 0.900em;
}   
    
.letra{
   font-size: 0.70em;
}
</style>

</head>

<h1 align="center" ><br />
Captura Manual de Inventarios<br />


  
</h1>
    
    <?php if($_GET['anaquel']!=NULL){?>
    <h2>
        Anaquel <?php echo $_GET['anaquel'];?>
    </h2>
    <?php }?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
<form id="form1" name="form1" method="post" action="">
  
  
  
   
  
  
  
  
  
  
  
  
  
      
      
      
      
      
      
      
      
    
      
      
      
      
      
      
      
      
      
      
      
      
      
      


  
  
  
<?php if($_GET['almacen']!=NULL){?>




<table width="500" >
     <tr >
       <th width="5" ><div align="left" class="encabeza" >
         <div align="left">#</div>
       </div></th>

       <th width="200" ><div align="left"  class="encabeza">
         <div align="left"  class="encabeza">Descripcion</div>
       </div></th>
         
         
       <th width="30" scope="col">
         <div align="left"  class="encabeza">Cantidad</div>
     </th>
     
     
         
     </tr>
     
     
     
     
<?php   
$c=5;		



 $sSQL= "Select * From existencias where
entidad='".$entidad."'
    and
    anaquel='".$_GET['anaquel']."'
order by descripcion ASC";

 
 
 

$result=mysql_db_query($basedatos,$sSQL);
 if(count($result)>0){
while($myrow = mysql_fetch_array($result)){ 
    $sSQL11= "SELECT 
 *
FROM
  articulos
  WHERE 
  entidad='".$entidad."' 
  AND
  codigo='".$myrow['codigo']."'
  ";
$result11=mysql_db_query($basedatos,$sSQL11);
$myrow11 = mysql_fetch_array($result11);
$f+=1;

if($myrow11['descripcion']!=NULL){
?> 





     <tr>
       <td ><div class="letra"><?php echo $f;?></div></td> 

       
           <td ><div class="letra">
           <?php echo $myrow11['descripcion'];?>
               </div>
               <?php 
               
               if($f==$c){
                    echo '<hr></hr>';
                    $a=$f+$c;
               }
               
               if($a==$f){
                   echo '<hr></hr>';
                   $a=$f+$c;
               }
                
              
               
               
               ?>
               
       </td>
       
                  <td >
                     <div class="letra">
                          <input type="text" class="letra" size="3"></input>
                     </div>
                     
       </td>
       
       
  
       
       
       
       
       
     </tr>
    
 
    
    <input name="codigo[]" type="hidden" value="<?php echo $myrow['codigo'];?>"></input>
     <?php }}}?>
   </table>
<?php }?>



<br></br>



</form>

<br>
<br>

</body>
</html>