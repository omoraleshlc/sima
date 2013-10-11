<?php require("/configuracion/ventanasEmergentes.php");
require('/configuracion/funciones.php');

//$mostrarmenu=new menus();
//$mostrarmenu->menuTemplate($_GET['warehouse'],$_GET['datawarehouse'],$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,'principal',$rutaimagen,$basedatos);
$estilos=new muestraEstilosV2();
$estilos->styles();

?>

        
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
$in="success";

 //echo '<a class="close" data-dismiss="success" href="#" aria-hidden="true">Solicitud recibida</a>';

}else{
$in="warning";
}    
}  else {
$in=null;    
}


?>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    
    



    <div class="container">    

<div class="barra_separadora">
     
     <span >Ordenes de soporte</span>
     
</div>


        
<?php 

$menuPrimario=new menus();
$menuPrimario->menuOperacionesBoot('../OPERACIONESHOSPITALARIAS/menuOperaciones.php?main=OPREACIONES&warehouse=sistemas&datawarehouse=','Menu Principal ','OPERACIONES','Sistemas',$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos);
?>           
   
<br>


<?php if(isset($info)!=NULL){
  //echo $info;  
}
?>


<div class="tabbable"> <!-- Only required for left/right tabs -->
    
    <ul class="nav nav-tabs">
        
     
        
    <li class="active">
        <a href="#tab1" data-toggle="tab">
           Nueva  <span class="glyphicon glyphicon-plus"></span>

        </a>
    </li>
    
    <li>
        <a href="#tab2" data-toggle="tab" >
            Pendientes
        </a>
    </li>
        
        
    <li>
        <a href="#tab3" data-toggle="tab">
            En Proceso
        </a>
    </li>  
        
     <li>
        <a href="#tab4" data-toggle="tab">
            Terminadas
        </a>
    </li>     
        
        
        
    </ul>
        


<?php
//stat
//actie
if ($_GET['tab'] == 2) {
    $i=2;
} elseif ($_GET['tab'] == 3) {
    $i=3;
} elseif ($_GET['tab'] == 4) {
    $i=4;
}

switch ($i) {
    case 0:
        //echo "i equals 0";
        break;
    case 1:
        $stat1="active";
        break;
    case 2:
        $stat2="active";
        break;
    case 3:
        $stat3="active";
        break;    
    

}
?>


    
    
    
    <div class="tab-content">
    <div class="tab-pane <?php echo $stat1;?>" id="tab1">

        
        
<div class="panel panel-default">
    <div class="panel-heading small" >
        <?php 
    ?>Generar Orden, Fecha <?php echo cambia_a_normal($fecha1).'  '.$hora1;?></div>
  
  
<div class="panel-body">
        
        
    
    
    
    
    
    
    
   

   
        <form class="form" method="post"  >
    
<?php if($in=='success'){?>   

  <div class="panel-default">
<div class="alert alert-success">Orden generada correctamente!
  
</div>
          <br>
<input type="Submit" name="aceptar" value="Aceptar" class="btn btn-primary btn-small"></input>  
  </div>


<?php }else{ ?>
    
            
<?php if($in=='warning'){ ?>

<div class="alert alert-warning">
    Te faltan campos por llenar!!

    </div>
<?php }?>           
            
            
            

  <table width="600" class="table-striped">
 
 
      
      
      
      
      
      
      
      
      
      
<tr>
      <td scope="col"><div align="left"><small>Entidad</small></div></td>
      <td scope="col"><div align="left">



       	            <?php	 		

               

                    $sqlNombre11 = "SELECT * from entidades
WHERE
status='A'
ORDER BY descripcionEntidad ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>          <small>
	    <select name="entidad"  class="form-controlsmall" onChange="this.form.submit();">

          <option value="">---</option>
		  		              <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                  <?php   if($_POST["entidad"]==$rNombre11['codigoEntidad']){echo 'selected=""';}?>
                value="<?php echo $rNombre11["codigoEntidad"];?>"><?php echo utf8_decode($rNombre11["descripcionEntidad"]);?></option>
            <?php } ?>
            </select>
</small>
      </div></td>
</tr>  
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      

    <tr>
      <td ><div align="left"><small>Departamento</small></div></td>
      <td >
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
                  <small>  
		  <select name="almacen" class="form-controlsmall" onChange="this.form.submit();"/>
                  <option value="">Escoje</option>
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["almacen"]==$rNombre11["almacen"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["almacen"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
                    </small>
	            </div></td>
    </tr>
      
      
      
      
      
      

      <tr>
      <td ><div  align="left"><small>Tipo Soporte</small></div></td>
      <td >
        <div align="left">
<?php	
          
$sqlNombre11 = "SELECT * from sis_tipoSoporte 
order by descripcion ASC
";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
            <small>  
	   <select name="keyTS" class="form-controlsmall"/>
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["keyTS"]==$rNombre11["keyTS"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["keyTS"];?>"><?php echo $rNombre11["descripcion"];?></option>
            <?php } ?>
            </select>
            </small>
        </div>
     </td>
    </tr>

      
      
      
      
      
      
      
      
    <tr>
      <td scope="col"><div align="left"><small>Registro</small></div></td>
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
                    <small>
		  <select name="registro" class="form-controlsmall" />
		    
		
         
            <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ 
  echo mysql_error();?>
            <option
                   <?php   if($_POST["registro"]==$rNombre11["registro"]){ echo 'selected=""';}?>
                value="<?php echo $rNombre11["registro"];?>"> <?php echo $rNombre11["registro"].'  '.$rNombre11["descripcionUbicacion"];?></option>
            <?php } ?>
            </select>
                    </small>     
        </div>
      </label></td>
    </tr>
    
      

      <tr>
          
      <td scope="col"><div align="left"><small>Extension</small></div></td>
      <td scope="col">
        
        <small>
        
        <input class="form-control" placeholder="Extensión telefónica" id="focusedInput" type="text" name="extension" value="<?php echo $_POST['extension'];?>"></input>

        </small>
        
      </label></td>
    </tr>
      
      
      
    <tr>
      <td width="152" scope="col"><div align="left"><small>Usuario</small></div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input class="form-control" placeholder="Usuario Solicitante" id="focusedInput" type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>"/>
        </div></td>
    </tr>
    
      
    <tr>
      <td width="152" scope="col"><div align="left"><small>Usuario Ejecutor</small></div></td>
      <td width="451" scope="col"><label> </label>
          <div align="left">
            <input class="form-control" placeholder="Usuario quien hará el trabajo" id="focusedInput" type="text" name="usuarioAplicacion" value="<?php echo $_POST['nombre']; ?>"/>
        </div></td>
    </tr>      
      

    
      <tr>
      <td width="152" scope="col"><div align="left"><small>Observaciones</small></div></td>
      <td width="451" >
          <div align="left">
            <textarea class="form-control" placeholder="Es el servicio que se ofrecerá a éste usuario" name="observaciones" cols="50" rows="5"  /><?php echo $_POST['observaciones']; ?></textarea>
        </div></td>
    </tr> 
    
        <tr>
      <td  >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
 
       <tr>
      <td  >&nbsp;</td>
      <td ><input class="btn btn-primary btn-xs" name="generaOrden" type="submit"  id="actualizar" value="Generar Orden" /></td>
    </tr>    
    
  </table>

   
    
  

</form>
<?php }?>    
    
    
    
    
    
    
  
</div>
              </div>
    
    
    </div><!--cierra nueva orden-->
   
    
        
        
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
        
        
        
        
     
        
            <br>
 <div class="tab-pane <?php echo $stat2;?>" id="tab2">
        
<div class="panel panel-default">
    <div class="panel-heading">
     Ordenes pendientes
    </div>
  
  
    
     <!--pendientes-->    
<div class="panel-body">     
     

  <table width="800"  class="table-hover" >
 
    
        <th ><small>#</small></th>
        <th ><small>Fecha/Hora <span class="glyphicon glyphicon-time"></span>
</small></th>
      <th ><small>TipoSoporte <span class="glyphicon glyphicon-wrench"></span>
</small></th>
      <th ><small>Departamento <span class="glyphicon glyphicon-home"></span>
</small></th>
      <th ><small>Usuario <span class="glyphicon glyphicon-user"></span>
</small></th>
      <th><small>#Orden <span class="glyphicon glyphicon-dashboard"></span>
</small></th>
        
<th ></th>        
        
<th ></th>
   
      
      
      
      
      
      
<?php	


$sSQL= "SELECT *
FROM
sis_ordenesSOP
where

status='request'

order by keySOP ASC
 ";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$a2+=1;

$nT=$myrow['keyClientesInternos'];


/*
$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);*/
	  ?>
    
    
      <tr>
  <td  ><small><?php echo $a2;?></small></td>    
   <td  ><small>
       <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];
             //echo '</br>';
	
       //echo $myrow['hora'];
       ?></small>
       
       
   </td>  
   
   
   
   
   
      <td ><small><?php echo $myrow['descripcionSoporte'];
      
?></small>
      </td>
   
      
      
      
      
      <td >
<small> 
<?php


 echo $myrow['descripcionAlmacen'];
?>
</small>
          	 
		  
		  
      </td>
     
      
            <td >
<small> 
<?php


 echo $myrow['nombre'];
?>
</small>
          	 
		  
		  
      </td>
      
      
      
      <td >
          <small>
          <?php 
	  	 
	
		echo $myrow['keySOP'];;
	?></small>
      </td>
      
      
  <td>
      
      

  <?php 
       //echo '<br>';
       
       $fActual=str_replace('-',' ',$fecha1);
       $fActual=str_replace(' ','',$fActual);
       $fActual=(int) ($fActual);
       
       $fReg=str_replace('-',' ',$myrow['fecha']);
       $fReg=str_replace(' ','',$fReg);
       
       $fReg=(int) ($fReg);
       $diff=$fActual-$fReg;
       if($diff>=3){
       echo '<a href="#" data-toggle="tooltip" title="Ya pasaron mas de 2 dias!"><img src="../bt/img/warning.jpeg" height="14" width="14"></img></a>';    
       }
       ?>    
  </td>
      
      
      
      <td id="tabdos<?php echo $a2;?>">
          
          
          
      <small>    
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=2#tabdos<?php echo $a2;?>"> 
  
    <span class="glyphicon glyphicon-hand-right" data-toggle="tooltip" title="Enviar a En Proceso!"></span>

</a>      
      </small>
      </td>
  
  
        <td id="tabdos<?php echo $a2;?>">
          
          
          
      <small>    
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=2#tabdos<?php echo $a2;?>"> 
 
    <span class="glyphicon glyphicon-remove"></span>

</a>      
      </small>
      </td>
  
  
      
      </tr> 
<?php }?>

  </table>
    
 </div>
</div>
 </div>  
        

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        
        
        
<div class="tab-pane <?php echo $stat3;?>" id="tab3">
        
<div class="panel panel-default">
    <div class="panel-heading">
     Ordenes pendientes
    </div>
  
  
    
     <!--pendientes-->    
<div class="panel-body">     
     

  <table width="800"  class="table-hover" >
 
    
        <th ><small>#</small></th>
        <th ><small>Fecha/Hora <span class="glyphicon glyphicon-time"></span>
</small></th>
      <th ><small>TipoSoporte <span class="glyphicon glyphicon-wrench"></span>
</small></th>
      <th ><small>Departamento <span class="glyphicon glyphicon-home"></span>
</small></th>
      <th ><small>Usuario <span class="glyphicon glyphicon-user"></span>
</small></th>
      <th><small>#Orden <span class="glyphicon glyphicon-dashboard"></span>
</small></th>
        
<th ></th>        
        
<th ><small>
</small></th>
   
      
      
      
      
      
      
<?php	


$sSQL= "SELECT *
FROM
sis_ordenesSOP
where

status='ontransit'

order by keySOP ASC
 ";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$a3+=1;

$nT=$myrow['keyClientesInternos'];


/*
$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);*/
	  ?>
    
    
      <tr>
  <td  ><small><?php echo $a3;?></small></td>    
   <td  ><small>
       <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];
             //echo '</br>';
	
       //echo $myrow['hora'];
       ?></small>
       
       
   </td>  
   
   
   
   
   
      <td ><small><?php echo $myrow['descripcionSoporte'];
      
?></small>
      </td>
   
      
      
      
      
      <td >
<small> 
<?php


 echo $myrow['descripcionAlmacen'];
?>
</small>
          	 
		  
		  
      </td>
     
      
            <td >
<small> 
<?php


 echo $myrow['nombre'];
?>
</small>
          	 
		  
		  
      </td>
      
      
      
      <td >
          <small>
          <?php 
	  	 
	
		echo $myrow['keySOP'];;
	?></small>
      </td>
      
      
  <td>
      
      

  <?php 
       //echo '<br>';
       
       $fActual=str_replace('-',' ',$fecha1);
       $fActual=str_replace(' ','',$fActual);
       $fActual=(int) ($fActual);
       
       $fReg=str_replace('-',' ',$myrow['fecha']);
       $fReg=str_replace(' ','',$fReg);
       
       $fReg=(int) ($fReg);
       $diff=$fActual-$fReg;
       if($diff>=3){
       echo '<a href="#" data-toggle="tooltip" title="Ya pasaron mas de 2 dias!"><img src="../bt/img/warning.jpeg" height="14" width="14"></img></a>';    
       }
       ?>    
  </td>
      
      
      
      <td id="tab3<?php echo $a3;?>">
          
          
          
<small>   
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=3#tab3"> 
<span class="glyphicon glyphicon-hand-right" data-toggle="tooltip" title="Terminar orden.."></span>
</a>      
</small>
      </td>          
          
          
          
  
<td>  
<small>          
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=3#tab3"> 
<span class="glyphicon glyphicon-plus" data-toggle="tooltip" title="Agregar observaciones.."></span>
</a>      
</small>
      </td>
  
  
        <td >
          
          
          

      </td>
  
  
      
      </tr> 
<?php }?>

  </table>
    
 </div>
</div>
    
 </div><!--cerrar tab3-->     
        
        
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
        
 <div class="tab-pane" id="tab4">
        
<div class="panel panel-default">
    <div class="panel-heading">
     Ordenes Terminadas
    </div>
  
  
    
     <!--pendientes-->    
<div class="panel-body">     
     

  <table width="1000"  class="table-hover" >
 
    
        <th ><small>#</small></th>
        <th ><small>Fecha/Hora <span class="glyphicon glyphicon-time"></span>
</small></th>
      <th ><small>TipoSoporte <span class="glyphicon glyphicon-wrench"></span>
</small></th>
      <th ><small>Departamento <span class="glyphicon glyphicon-home"></span>
</small></th>
      <th ><small>Usuario <span class="glyphicon glyphicon-user"></span>
</small></th>
      <th><small>#Orden <span class="glyphicon glyphicon-dashboard"></span>
</small></th>
        
<th ></th>        
        
<th ><small>
</small></th>
   
      
      
      
      
      
      
<?php	


$sSQL= "SELECT *
FROM
sis_ordenesSOP
where

status='done'


 ";




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
$a4+=1;

$nT=$myrow['keyClientesInternos'];


/*
$sSQL17d= "
SELECT 
*
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
and
folioDevolucion = '".$myrow['folioVenta']."'
";
$result17d=mysql_db_query($basedatos,$sSQL17d);
$myrow17d = mysql_fetch_array($result17d);*/
	  ?>
    
    
      <tr>
  <td  ><small><?php echo $a4;?></small></td>    
   <td  ><small>
       <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora'];
             //echo '</br>';
	
       //echo $myrow['hora'];
       ?></small>
       
       
   </td>  
   
   
   
   
   
      <td ><small><?php echo $myrow['descripcionSoporte'];
      
?></small>
      </td>
   
      
      
      
      
      <td >
<small> 
<?php


 echo $myrow['descripcionAlmacen'];
?>
</small>
          	 
		  
		  
      </td>
     
      
            <td >
<small> 
<?php


 echo $myrow['nombre'];
?>
</small>
          	 
		  
		  
      </td>
      
      
      
      <td >
          <small>
          <?php 
	  	 
	
		echo $myrow['keySOP'];;
	?></small>
      </td>
      
      
  <td>
      
      

  <?php 
       //echo '<br>';
       
       $fActual=str_replace('-',' ',$fecha1);
       $fActual=str_replace(' ','',$fActual);
       $fActual=(int) ($fActual);
       
       $fReg=str_replace('-',' ',$myrow['fecha']);
       $fReg=str_replace(' ','',$fReg);
       
       $fReg=(int) ($fReg);
       $diff=$fActual-$fReg;
       if($diff>=3){
       echo '<a href="#" data-toggle="tooltip" title="Ya pasaron mas de 2 dias!"><img src="../bt/img/warning.jpeg" height="14" width="14"></img></a>';    
       }
       ?>    
  </td>
      
      
  
  
      <td >
          
          
          
<small>   
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=4"> 
<span class="glyphicon glyphicon-hand-left" data-toggle="tooltip" title="Regresar a orden pendiente.."></span>
</a>      
</small>
      </td>  
  
  
  
  
      
      <td >
          
          
          
<small>   
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=4"> 
<span class="glyphicon glyphicon-hand-right" data-toggle="tooltip" title="Terminar orden.."></span>
</a>      
</small>
      </td>          
          
          
          
  
<td>  
<small>          
<a href="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&keySOP=<?php echo $myrow['keySOP'];?>&inactiva=si&status=request&tab=4"> 
<span class="glyphicon glyphicon-list" data-toggle="tooltip" title="Agregar observaciones.."></span>
</a>      
</small>
      </td>
  
  
        <td >
          
          
          

      </td>
  
  
      
      </tr> 
<?php }?>

  </table>
    
 </div>
</div>
    
 </div>        
        
        
        
        
    </div><!--obligatoria- tabcontent-->
</div><!--obligatoria-tabable-->
    
    
    
</div>    


    
    
    </body>
</html>
