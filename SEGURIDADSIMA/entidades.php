<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php"); 




if($_POST['actualizar'] AND ( $_POST['codigoEntidad']!=NULL or $_GET['codigoEntidad']!=NULL) ){
$sSQL1= "Select * From entidades WHERE (codigoEntidad = '".$_POST['codigoEntidad']."' or codigoEntidad='".$_GET['codigoEntidad']."') ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);

if(!$myrow1['codigoEntidad']){
if($_POST['codigoEntidad']!=$myrow1['codigoEntidad']){

//keyEntidades	codigoEntidad	descripcionEntidad	status	fechaApertura	prefijoEfectivo	prefijoCxC	digitosFactura    
    
$agrega = "INSERT INTO entidades (
codigoEntidad,descripcionEntidad,fechaApertura,prefijoEfectivo,prefijoCxC,digitosFactura,rutaRecibo,rutaReciboPaquete,statusExistencias
) values ('".$_POST['codigoEntidad']."','".$_POST['descripcionEntidad']."','".$_POST['fechaApertura']."',
    '".$_POST['prefijoEfectivo']."','".$_POST['prefijoCxC']."',
        '".$_POST['digitosFactura']."','".$_POST['rutaRecibo']."','".$_POST['rutaReciboPaquete']."','".$_POST['statusExistencias']."')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
echo '<script>
window.alert( "SE AGREGO UNA ENTIDAD");
</script>'; 
}} else {
$q = "UPDATE entidades set 
    statusExistencias='".$_POST['statusExistencias']."',
    rutaReciboPaquete='".$_POST['rutaReciboPaquete']."',    
    rutaRecibo='".$_POST['rutaRecibo']."',
prefijoEfectivo='".$_POST['prefijoEfectivo']."',
    prefijoCxC='".$_POST['prefijoCxC']."',
        digitosFactura='".$_POST['digitosFactura']."',
descripcionEntidad='".$_POST['descripcionEntidad']."',
    fechaApertura='".$_POST['fechaApertura']."'

WHERE 
codigoEntidad='".$_POST['codigoEntidad']."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
echo '<script >
window.alert( "SE MODIFICO ENTIDAD");
</script>'; 
}
}

if($_POST['borrar'] AND $_GET['codigoEntidad']){
$borrame = "DELETE FROM entidades WHERE codigoEntidad ='".$_POST['codigoEntidad']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
echo '<script >
window.alert( "SE ELIMINO EL MODULO RAIZ");
</script>'; 
}


if($_POST['nuevo']!=NULL){
   $_GET['keyEntidades']=NULL; 
}

if($_GET['keyEntidades']){
$sSQL2= "Select * From entidades WHERE keyEntidades = '".$_GET['keyEntidades']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=650,height=750,scrollbars=YES")
} 
</script> 

 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>


<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=630,height=800,scrollbars=YES")
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>

</head>

<body>
 <h1 align="center">Catalogo de Entidades</h1>
 <br></br>
    <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
 
 <form id="form1" name="form1" method="post" action="">
     
     
<p>
</p>
     
     

     
   <p>
     <label></label>
   </p>

   <table width="644" class="table-forma">

     <tr >
       <td  scope="col">&nbsp;</td>
       <td >Codigo/ID Entidad</td>
       <td ><label>
             <input name="codigoEntidad" type="text"  id="subModulo" value="<?php echo $myrow2['codigoEntidad'] ?>" size="2" />    
           </label>
         <label></label></td>
       
       
     </tr>
       
       
       
            <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td >Descripcion</td>
       <td ><span >
         <input name="descripcionEntidad" type="text"  id="subModulo" value="<?php echo $myrow2['descripcionEntidad'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       
       
                   <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td >Fecha de Apertura</td>
       <td ><span >
          <label>
            <input name="fechaApertura" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
		 if($myrow2['fechaApertura']){
		 echo $myrow2['fechaApertura'];
		 }
		 ?>"/>
          </label>
        <input name="button" type="image" src="../imagenes/btns/fecha.png" id="lanzador" value="..." /> 
       </span></td>
       
       
            <tr >
       <td ></td>
       <td >Prefijo Efectivo</td>
       <td ><span >
         <input name="prefijoEfectivo" type="text"  id="subModulo" value="<?php echo $myrow2['prefijoEfectivo'] ?>" size="5" />
       </span></td>
       
       
       
     </tr>       
    
       
     
     
     <tr >
       <td ></td>
       <td >Prefijo CxC</td>
       <td ><span >
         <input name="prefijoCxC" type="text"  id="subModulo" value="<?php echo $myrow2['prefijoCxC'] ?>" size="5" />
       </span></td>
       </tr>        
       
       	
       
     <tr >
       <td ></td>
       <td >Digitos Factura</td>
       <td ><span >
         <input name="digitosFactura" type="text"  id="subModulo" value="<?php echo $myrow2['digitosFactura'] ?>" size="5" />
       </span></td>
       </tr>       
       
       
            <tr >
       <td ></td>
       <td >Ruta Recibo de Caja</td>
       <td >
               <div class="normal">  <input name="rutaRecibo" type="text" size="50" id="subModulo" value="<?php echo $myrow2['rutaRecibo'] ?>" size="5" /></div>
     </td>
       </tr>  
       
       

            <tr >
       <td ></td>
       <td >Ruta Recibo de Paquete</td>
       <td >
               <div class="normal">  <input name="rutaReciboPaquete" type="text" size="50" id="subModulo" value="<?php echo $myrow2['rutaReciboPaquete'] ?>" size="5" /></div>
     </td>
       </tr>        
                 
       
       
       
       <tr >
       <td ></td>
       <td >Existencias Auto</td>
       <td >
               <div class="normal">  
                   <input name="statusExistencias" type="checkbox" <?php if($myrow2['statusExistencias']=='A'){echo 'checked=""';} ?>" value="A" /></div>
           (Si se activa, las existencias seran infinitas!)
     </td>
       </tr>     
       
            <tr >
       <td ></td>
       <td ></td>
       <td ><span >
        
       </span></td>
       </tr>  

       
     <tr >
       <td colspan="3" ><p align="center">
           <input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
         <input name="borrar" type="submit"  id="borrar" value="Eliminar Entidad" disabled="" />
         <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar Entidad" />
         <input name="keySM" type="hidden" id="keySM" value="<?php echo $myrow2['keySM'] ?>" />
         </p></td>
     </tr>
   </table>
  
<p>&nbsp;</p>
 </form>
 <p>
   <?php   
 $sSQL= "Select * From entidades 
 
 order by codigoEntidad ASC";
$result=mysql_db_query($basedatos,$sSQL); 

?>
 </p>
 <form id="form2" name="form2" method="post" action="">

   <table width="600" class="table table-striped">
      
      <tr >
          <th width="5" align="left" >ID</th>
      <th width="50" align="left" >Descripcion</th>
      <th width="50" align="left" >FechaApertura</th>
      <th width="50" align="left" >Datos</th>
      <th width="50" align="left" >PEfectivo</th>
      <th width="50" align="left" >PCxC</th>
      <th width="50" align="left" >DFactura</th>
      <th width="10" align="left" >---</th>
     
    </tr>
     
       <?php	while($myrow = mysql_fetch_array($result)){$b+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['keySM'];
?>
       <tr>

             <td bgcolor="<?php echo $color;?>" ><span >
         <label>
<?php echo $myrow['codigoEntidad'];?>         
         </label>
       </span></td>
           
           
   
       

       <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php echo $myrow['descripcionEntidad'];?>         
       </span>
       </td>
       
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php 
       if($myrow['fechaApertura']!=NULL){
       echo cambia_a_normal($myrow['fechaApertura']);
       }else{
       print '---';    
       }
       ?>         
       </span>
       </td>
       
       
                     <td bgcolor="<?php echo $color;?>" >
           <span >
                    
                <a href="#" onClick="ventanaSecundaria1('../ventanas/datosEntidades.php?entity=<?php echo $myrow['descripcionEntidad'];?>&keyEntidades=<?php echo $myrow['keyEntidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&keyc=<?php echo $_POST['keyc']; ?>&usuario=<?php echo $E; ?>&entidad=<?php echo $myrow['codigoEntidad'];?>')">
               Editar Datos
            </a>
        
       </span>
       </td>
       
       
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php 
      
       print $myrow['prefijoEfectivo'];    
      
       ?>         
       </span>
       </td>       
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php 
      
       print $myrow['prefijoCxC'];    
      
       ?>         
       </span>
       </td>          
       
       
       
       
        <td bgcolor="<?php echo $color;?>" >
        <span >
       <?php 
      
       print $myrow['digitosFactura'];    
      
       ?>         
       </span>
       </td>          
       
       
       
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="entidades.php?keyEntidades=<?php echo $myrow['keyEntidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&keyc=<?php echo $_POST['keyc']; ?>&usuario=<?php echo $E; ?>&main=<?php echo $_GET['main'];?>&warehouse=<?php  echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>"  onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
          
           
        
     </tr>
      <?php }?>
   </table>


</form>

 <p align="center">&nbsp;</p>
 
 
 
   <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
</body>
</html>

