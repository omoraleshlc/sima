<?php require("/configuracion/ventanasEmergentes.php");?>
   <?php if($_POST['almacen']){
   $al=$_POST['almacen'];
   } else {
   $al=$_GET['almacen'];
   }

   ?>







<?php


if($_POST['agrega'] and $_GET['seguro']!=NULL AND $_POST['tipo']!=NULL){
$agregar=$_POST['agregar'];
$tipo=$_POST['tipo'];


for($i=0;$i<=$_POST['bandera'];$i++){


if($tipo[$i]!=NULL){

/*	 1	keyRC	int(2)			No	None	AUTO_INCREMENT	  Change	  Drop	 More
	 2	cliente	varchar(20)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
	 3	tipo	int(11)			No	None		  Change	  Drop	 More
	 4	entidad	char(2)	utf8_spanish2_ci		No	None		  Change	  Drop	 More
  */  
    
    

$sSQL1= "Select * From relacionCliente where 
entidad='".$entidad."'
    and
cliente='".$_GET['seguro']."' 
    and
    tipo='".$tipo[$i]."'
        and
        tipoReporte='estadisticasAseguradoras1'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['tipo']){
$agrega = "INSERT INTO relacionCliente (
cliente,tipo,entidad,tipoReporte
) values ('".$_GET['seguro']."','".$tipo[$i]."','".$entidad."','estadisticasAseguradoras1')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}



}

$leyenda='Se Agregaron Registros';
}



if($_POST['borrar'] AND $_POST['keyRC']){
$keyRC=$_POST['keyRC'];

for($i=0;$i<=$_POST['bandera'];$i++){

if($keyRC[$i]!=NULL ){
$borrame = "DELETE FROM relacionCliente WHERE keyRC ='".$keyRC[$i]."'";
mysql_db_query($basedatos,$borrame);

echo mysql_error();
}

}
echo '<div class="success">Se quito la relacion...</div>';
}
?>










<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES") 
} 
</script> 
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
<form id="form1" name="form1" method="post" action="" >

   <p align="center">   Relacionar Tipo de Empresa</p>
   <div align="center">
<?php echo $_GET['nombre'];?>
   </div>

   <table width="416" class="table table-striped">
     <tr>
       <th width="51" height="15"  scope="col"><div align="left"><span >C&oacute;digo </span></div></th>
       <th width="272"  scope="col"><div align="left"><span >Descripcion</span></div></th>
       <th width="39"   scope="col"><div align="left"></div></th>
       <th width="36"  scope="col">&nbsp;</th>
     </tr>
     <tr>
       <?php   

$sSQL= "Select * From relacionClientesTipo
where
entidad='".$entidad."'

order by descripcion ASC";

 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$a+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$keyAlmacenes=$myrow['keyAlmacenes'];
$A=$myrow['keyC'];

 $sSQL1= "Select * From relacionCliente where
entidad='".$entidad."'
    and
    cliente='".$_GET['seguro']."'
and
tipo='".$myrow['tipo']."'
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1); 

?>
       <td bgcolor="<?php echo $color?>" ><span > <?php echo $a?> </span></td>
       
       <td bgcolor="<?php echo $color?>" ><span ><?php echo $myrow['descripcion']?></span></td>
       
       
       <td bgcolor="<?php echo $color;?>" ><label>
               
               
         <?php if($myrow1['tipo']==NULL){?>       
         <input type="checkbox" name="tipo[]" value="<?php   echo $myrow['tipo'];?>"
	   <?php 
	   if($myrow['tipo']){
	   echo $myrow['tipo'];
	   }
	   ?> />
         <?php }else{ 
             
             echo '---';
             
         }
?>
         
         
         
       </label></td>
       
       
       
       <td bgcolor="<?php echo $color?>" >
	     <label></label>
       </a>
       <label>
           <?php if($myrow1['tipo']!=''){?>   
       <input type="checkbox" name="keyRC[]" value="<?php echo $myrow1['keyRC'];?>"/>
                <?php }else{ 
             
             echo '---';
             
         }
?>
       
       
       </label></td>
       
       
       
       
     </tr>
     <?php }}?>
   </table>
 
   <table width="200" >
     <tr>
       <td><input name="agrega" type="submit"  id="agrega" value="Agregar" /></td>
       <td><input name="almacen" type="hidden" id="almacen" value="<?php echo $_GET['almacen'];?>" />
         <input name="bandera" type="hidden" id="bandera" value="<?php echo $a;?>" /></td>
       <td><input name="borrar" type="submit"  id="borrar" value="Quitar" /></td>
     </tr>
   </table>
  
   
   
   
   
   
   
</form>
</body>
</html>
