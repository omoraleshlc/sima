<?php require("/configuracion/ventanasEmergentes.php");?>












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../js/styleTabs.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="../js/sprinkle.js"></script>
<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>






</head>
<body>

    
    
    
    
    <br></br>
    


    
    
<?php 
//*****************CONEXION  A SIMA***************


?><?php  $date=$_GET['fecha1'];$entidad=$_GET['entidad'];?>





<?php 



if($_POST['generaOrden']!=NULL){
    
    
    

    
if($_POST['entidad']!=NULL and $_POST['almacen']!=NULL and $_POST['keyTS']!=NULL and $_POST['registro']!=NULL and $_POST['nombre']!=NULL and $_POST['observaciones']){    
    
    
$q4 = "

    INSERT INTO sis_contadorOrdenesSOP(contador, usuario)
    SELECT(IFNULL((SELECT count(*)+1 from sis_contadorOrdenesSOP ), 1)), '".$usuario."'

    ";
    mysql_db_query($basedatos,$q4);
    echo mysql_error();

$sSQL= "SELECT max(contador) as topeMaximo from sis_contadorOrdenesSOP where usuario='".$usuario."' order by keyConta DESC";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
$solicitud= $myrow['topeMaximo'];       
    
    

$sSQL1da= "Select * From almacenes WHERE entidad='".$_POST['entidad']."' and almacen = '".$_POST['almacen']."'";
$result1da=mysql_db_query($basedatos,$sSQL1da);
$myrow1da = mysql_fetch_array($result1da); 

$sSQL1de= "Select * From sis_tipoSoporte WHERE keyTS = '".$_POST['keyTS']."'";
$result1de=mysql_db_query($basedatos,$sSQL1de);
$myrow1de = mysql_fetch_array($result1de); 

$agrega = "INSERT INTO sis_ordenesSOP (
solicitud,entidadSolicitud,almacen,keyTS,registro,nombre,usuario,fecha,hora,entidad,descripcionAlmacen,descripcionSoporte,status,observaciones
) values (
'".$solicitud."','".$_POST['entidad']."','".$_POST['almacen']."','".$_POST['keyTS']."',
'".$_POST['registro']."','".$_POST['nombre']."','".$usuario."','".$fecha1."',
'".$hora1."','".$entidad."','".$myrow1da['descripcion']."','".$myrow1de['descripcion']."','request',
    '".$_POST['observaciones']."'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
 echo '<script>
     window.alert("SE GENERO LA ORDEN: '.$solicitud   .'");
     document.location.href="resSoporte.php";     
     
</script>';
 exit();
}else{
    echo '<script>window.alert("Te faltan campos por llenar!");</script>';
}    
}

?>




























    
    
  
    
    
    
    
    
    
<form name="form1" method="post"  >
  <table width="600" class="table-forma">
     <tr  >
      <th colspan="2"><p align="center">Generar # Orden Soporte</p></th>
 
    </tr>
    <tr>
      <td colspan="2" scope="col"><?php echo '<blink>'.$leyenda.'</blink>';?></td>
    </tr>
      
      
      

      
      
      
      
      
      
      
      
      
      
      
      
<tr>
      <td scope="col"><div align="left">Entidad</div></td>
      <td scope="col"><div align="left">



       	            <?php	 		

               

                    $sqlNombre11 = "SELECT * from entidades
WHERE
status='A'
ORDER BY descripcionEntidad ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
	    <select name="entidad"  id="entidad" onChange="this.form.submit();">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["entidad"]==$rNombre11['codigoEntidad']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["codigoEntidad"];?>"><?php echo $rNombre11["descripcionEntidad"];?></option>
            <?php } ?>
            </select>
      </div></td>
</tr>  
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

    <tr>
      <td scope="col"><div align="left">Departamento</div></td>
      <td scope="col">
	            <?php	 		
$sqlNombre11 = "SELECT * from almacenes 
WHERE
entidad='".$_POST['entidad']."'
    and
    activo='A'
    and
    miniAlmacen='No'
order by descripcion ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
                <div align="left">
		  <select name="almacen" onChange="this.form.submit();"/>
                  <option value="">Escoje</option>
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["almacen"]==$rNombre11["almacen"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["almacen"];?>"> <?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
	            </div></td>
    </tr>
      
      
      
      
      
      

      <tr>
      <td scope="col"><div align="left">Tipo Soporte</div></td>
      <td scope="col"><label>
        
        <div align="left">
<?php	
          
$sqlNombre11 = "SELECT * from sis_tipoSoporte 
order by descripcion ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
             
	   <select name="keyTS"/>
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["keyTS"]==$rNombre11["keyTS"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyTS"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
            
            
            
        </div>
      </label></td>
    </tr>

      
      
      
      
      
      
      
      
    <tr>
      <td scope="col"><div align="left">Registro </div></td>
      <td scope="col"><label>
        
        <div align="left">
            <?php	 		
$sqlNombre11 = "SELECT * from sis_inventarioEqComputo 
WHERE
entidad='".$_POST['entidad']."'
    and
    departamento='".$_POST['almacen']."'
order by registro ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
                <div align="left">
		  <select name="registro" />
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["registro"]==$rNombre11["registro"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["registro"];?>"> <?php echo $rNombre11["registro"].'  '.$rNombre11["descripcionUbicacion"];?></option>
            <?php } ?>
            </select>
        </div>
      </label></td>
    </tr>
    
      

      
      <tr>
      <td scope="col"><div align="left">Extension</div></td>
      <td scope="col"><label>
        
        <div align="left">
            <input type="text" name="extension" value="<?php echo $_POST['extension'];?>"></input>
        </div>
      </label></td>
    </tr>
      
      
      
    <tr>
      <td width="152" scope="col"><div align="left">Usuario</div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input name="nombre" type="text" size="40" id="nombre" value="<?php echo $_POST['nombre']; ?>"/>
        </div></td>
    </tr>
    

    
      <tr>
      <td width="152" scope="col"><div align="left">Servicio Solicitado</div></td>
      <td width="451" ><label> </label>
          <div align="left">
            <textarea name="observaciones" cols="50" rows="5"  /><?php echo $_POST['observaciones']; ?></textarea>
        </div></td>
    </tr> 
    
        <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
 
    
    
  </table>
  <p align="center">
   
    <input name="generaOrden" type="submit"  id="actualizar" value="Generar Orden" />
  
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
 
    
        
        

 
</body>
</html>
