<?php require("/configuracion/ventanasEmergentes.php");
require('/configuracion/funciones.php');?>
<?php
$estilos= new muestraEstilosV2();
$estilos->styles();

?>


<?php
if($_GET['cerrar']!='si' and !$_POST['generarReporte'] and !$_POST['aceptar'] and $_GET['folioVenta']!=null and $_GET['open']=='si'){
 $q = "UPDATE clientesInternos
    set
    status='activa',statusCuenta='revision',
    fechaAbrir='".$fecha1."',usuarioAbrir='".$usuario."',
    cuentaAbierta='si'
    where
    keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
$action='abrir';                
              
                
}


?>









<?php
if($_GET['open']!='si' and !$_POST['generarReporte'] and !$_POST['aceptar'] and $_GET['folioVenta']!=null and $_GET['cerrar']=='si'){
 $q = "UPDATE clientesInternos
    set
    status='cerrada',statusCuenta='cerrada',
    fechaCerrar='".$fecha1."',usuarioCerrar='".$usuario."'
    where
    keyClientesInternos='".$_GET['keyClientesInternos']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
$action='cerrar';                
               
                
}


?>







<?php

if( $_POST['aceptar']!=null){
    $action=null;
   
}
?>






  



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>


</head>

<body>
          
   
    

 
     <header>
    <div class="container">    
        
        
        
        
        
<div class="barra_separadora">
     
     <span >Abrir Cuentas de Internos</span>
     
</div>        
        
<?php 

$menuPrimario=new menus();
$menuPrimario->menuOperacionesBoot('../OPERACIONESHOSPITALARIAS/menuOperaciones.php?main=OPERACIONES&warehouse=administracion&datawarehouse=','Menu Principal ','OPERACIONES','Administracion',$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos);
?> 
        <br>
 
 <form id="form2" name="form2" method="post" class="form-group" action="">

     
     <br>

  
<?php

$encabezadoFecha=new encabezadoFechas();
$encabezadoFecha->headDate($fecha1);
    


?>

         <br>
         
         
         
<?php 

if(!$_POST['generarReporte'] AND ($action=='abrir' or $action=='cerrar'  )){?>   
             
             
<?php
if($action!=''){?>            
<div class="panel panel-success">
  <!-- Default panel contents -->
  <div class="panel-heading"></div>
  <div class="panel-body">
      <h4><?php echo 'Aqui pasoFolio Venta: '.$_GET['folioVenta'];?></h4>
      <p><?php 
      if($_GET['open']=='si'){
      echo utf8_decode('La cuenta del paciente: '.$_GET['paciente'].', se envió a revisión!');
      }elseif($_GET['cerrar']=='si'){
        echo utf8_decode('La cuenta del paciente: '.$_GET['paciente'].', se cerró correctamente!');   
      }
      ?></p>
    <!-- Indicates a dangerous or potentially negative action -->
   <input name="aceptar" type="submit" class="btn btn-success" value="Aceptar"></input>
  </div>
</div>
<?php } ?>
             
             
<?php }else{?>             
             
             
             
<?php if($_POST['generarReporte']!=NULL){?>         
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading"></div>


  <!-- Table -->
<table  class="table table-hover">

      <tr >
          
      <th  scope="col"><small>Folio</small></th>
          
      <th   scope="col"><small>Cierre</small></th>
          
      <th  scope="col"><small>Paciente</small></th>
     
     
      <th  scope="col"><small>Departamento</small></th>
      <th  scope="col"><small>Aseguradora</small></th>
      <th  scope="col"><small>Status</small></th>
      <th  scope="col"></th>

    </tr>
    
    
    
    
    
    
    
<tr>
<?php	





 $sSQL2= "SELECT descripcion
  FROM
medicos
Where descripcion='".$almacenSolicitud."' 

 ";
 
 $sSQL= "SELECT *
  FROM
clientesInternos
Where entidad='".$entidad."' 
and
fechaCierre between '".$_POST['fechaInicial']."' and '".$_POST['fechaFinal']."'
and
(folioVenta!='' and folioVenta!='0')
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
order by keyClientesInternos ASC
 ";

 
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$a+=1;




$sSQL7a="SELECT *
FROM
clientes
WHERE
entidad='".$entidad."'
    and
numCliente='".$myrow['seguro']."'";
  $result7a=mysql_db_query($basedatos,$sSQL7a);
  $myrow7a = mysql_fetch_array($result7a);


$sSQL7="SELECT *
FROM
almacenes
WHERE
entidad='".$entidad."'
    and
almacen='".$myrow['almacen']."'

  ";
  $result7=mysql_db_query($basedatos,$sSQL7);
  $myrow7 = mysql_fetch_array($result7);


?>
<tr  > 
      <td  >
       <small>
        <?php echo $myrow['folioVenta']; ?>
       </small>
      </td>
    
      <td  >
       <small>
        <?php echo cambia_a_normal($myrow['fechaCierre']); ?>
       </small>   
      </td>
    
    
      <td  >
      <small>    
      
<?php print $myrow['paciente'];?>
          <br>

      </small>
      </td>

    
      <td  >
      <small> 
        <?php echo $myrow7['descripcion']; ?>
      </small>    
      </td>
    
      <td  >
      <small> 
        <?php echo $myrow7a['nomCliente']; ?>
      </small>   
      </td>
    
    <td>
        <small>
            <?php print $myrow['statusCuenta'];?>
        </small>    
    </td>
      
      
<td id="solicitar<?php echo $a;?>"  >
    
    
<?php if($myrow['statusCuenta']!='cerrada'){?>
<a href="?folioVenta=<?php echo $myrow['folioVenta'];?>&paciente=<?php echo ltrim($myrow['paciente']);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&cerrar=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>#solicitar<?php echo $a;?>" name="solicitar<?php echo $guia;?>">
<small><span class="label label-warning">Cerrar</span></small>
</a>
<?php }else{ ?>    
<a href="?folioVenta=<?php echo $myrow['folioVenta'];?>&paciente=<?php echo ltrim($myrow['paciente']);?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&open=si&main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>#solicitar<?php echo $a;?>" name="solicitar<?php echo $guia;?>">
<small><span class="label label-success">Abrir</span></small>
</a>
<?php } ?>         

       
      </td>
    
    

    
      
    </tr>
        
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />

  </table>
</div>
<?php  }}//cierra validacion de action?>         
         
         
         
         
         
         
         


</form>
 
            
            
            
    </div>
     </header>
        
    
    

    
    
    
    
        
    
    
    
    
    
    
    
        
        
<p align="center">&nbsp;</p>
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
  <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha2",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario 
}); 
</script> 
</body>
</html>