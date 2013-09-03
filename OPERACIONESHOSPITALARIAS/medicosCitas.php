<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php");$ALMACEN=$_GET['datawarehouse'];
$ventana1='ventanaCatalogoAlmacen.php';
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
  

function valida(F) {   
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
<?php 
if($_GET['status']=='activo' AND $_GET['keySCC']){


 $q1 = "DELETE from  medicosCitasCanceladas WHERE keySCC='".$_GET['keySCC']."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();
$_GET['status']='inactivo';
$status='inactivo';
} else {
$status='activo';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
 <h1 align="center" class="titulos">Ausencia de M&eacute;dicos </h1>
 <form id="form2" name="form2" method="post" action="">

     
   

<p><div align="center">M&eacute;dicos
      
         
           <?php require("/configuracion/componentes/comboAlmacen.php"); 
$medicos=new comboAlmacen();
$medicos->despliegaMiniAlmacenMedicos($entidad,'combos',$ALMACEN,$almacenDestino,$basedatos);
?>
</div></p>
    

   <p>&nbsp;</p>
   
   	    <?php   

$sSQL= "Select * From medicosCitasCanceladas where
entidad='".$entidad."'
AND
almacen='".$_POST['almacenDestino5']."'
order by fecha ASC";

 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 

?> 
   
  
   <table class="table table-striped" width="737" >
     <tr >
<th width="89" height="24" scope="col"><div align="left" class="none">Fecha Cap</div></th>
       <th width="317" scope="col"><div align="left" class="none">Descripcion</div></th>
       <th width="103" scope="col"><div align="left" class="none">Fecha Inicial</div></th>
       <th width="103" scope="col"><div align="left" class="none">FechaFinal</div></th>
       <th width="75" scope="col"><div align="left" class="none">Usuario</div></th>

       <th width="50" scope="col"><div align="left" class="none">Status</div></th>
     </tr>
     <tr>

       <?php	while($myrow = mysql_fetch_array($result)){
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$A=$myrow['keySCC'];
?>
       <td><span class="Estilo24"><span class="style7">
         <?php echo cambia_a_normal($myrow['fecha']);?>
       </span></span></td>
       <td ><span class="Estilo24"><span class="style71"><?php echo $myrow['descripcion'];?></span></span></td>
       <td ><span class="style71"><?php 
	   if($myrow['fechaInicial']){
	  echo cambia_a_normal($myrow['fechaInicial']);
	  }
	   ?></span></td>
       <td ><span class="style71">
	   <?php 
	   if($myrow['fechaFinal']){
	   echo cambia_a_normal($myrow['fechaFinal']); 
	   }
	   ?>	  </span></td>
       <td ><span class="style7"><?php echo $myrow['usuario'];?></span></td>
       <?php if($_POST['tipoAlmacen']=='ap'){ ?>
       <?php } ?>
		
       <td >
	   <div align="center"><span class="style71"> 
	 </span><span class="Estilo24"><a href="<?php echo $_SERVER['PHP_SELF']?>?keySCC=<?php echo $A; ?>&amp;status=<?php echo $status; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $A; ?>&main=<?php echo $_GET['main'];?>&warehose=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">
	 
	 <img src="../imagenes/candado.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="12" height="12" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas eliminar este registro?') == false){return false;}" /></a>
	 

	 </span></div></td>
     </tr>
     <?php }}?>
   </table>
 
   <p align="center">
     <label>
    
     <input name="nuevo"  type="submit" id="nuevo" value="Nueva Cita Cancelada"
	  onclick="ventanaSecundaria1('../ventanas/ventanaMedicosCitas.php?id_medico=<?php echo $_POST['almacenDestino5'];?>&almacen=<?php echo $ALMACEN;?>')" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>