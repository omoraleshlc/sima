<?php require("menuOperaciones.php"); ?>
<?php 
$imagen='ordencompra.jpg';
$ventana1='../ventanas/ventanaOCSF.php';
$ventana11='../ventanas/despliegaOrdenes.php';
//include("/configuracion/formas/ordenCompra.php"); 
?>


<?php  
if($_GET['keyCO']!=NULL AND $_GET['del']!=NULL){

	if($_GET['del']=="yes" and $_GET['keyCO']>0){
$q = "UPDATE compras 
set
usuarioRecepcion='".$usuario."',
    fechaRecepcion='".$fecha1."',
        horaRecepcion='".$hora1."',
            statusFactura='recibido'
		
		WHERE keyCO='".$_GET['keyCO']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
              $tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Factura recibida...!';  

	} 


}else{
    $texto=NULL;
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



<link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
 


<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES") 
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



<?php

                    if(!$_POST['fechaInicial']){
                        if($_GET['dates']){    
                    $dates= $_GET['dates'];
                    }else{
		    $dates= $fecha1;
                    }
                    }else{
                    
                        $dates= $_POST['fechaInicial'];
                 
                    }
?>


 <form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Recepcion de Devoluciones</h1>
  <h4 align="center">
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>    
  </h4>
  
  
  
  
<p align="center" >
    <span >Escoge la Fecha </span>
      <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php echo $dates; ?>"/>
    </label>

</p>

   <table width="700" class="table table-striped">
    <tr >
      <th width="17" >#</th>
      <th width="17" >Hora</th>
      <th width="37" >Factura</th>
      <th width="114" >Proveedor</th>
            <th width="54" >Usuario</th> 
      <th width="45" >Status</th>  
         
             <th width="54" >P.Manual</th>
               <th width="54" >---</th>           
                 <th width="54" >UsuarioRec</th> 
                     <th width="54" >FechaRec</th> 
             
             
             
    </tr>
<?php	



 $sSQL= "
SELECT 
*
FROM
compras
where
entidad='".$entidad."'
    and
fecha='".$dates."'
and
notaCredito!=''
ORDER BY factura DESC";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$a+=1;

$fV[0]=$myrow['folioVenta'];

$sSQL8a= "
SELECT *
FROM
proveedores
WHERE
entidad='".$entidad."'
    and
id_proveedor='".$myrow['id_proveedor']."'";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);


//$sSQL8ab= "
//SELECT descripcion
//FROM
//almacenes
//
//WHERE
//entidad='".$entidad."'
//and
//almacen='".$myrow8a['almacen']."'";
//$result8ab=mysql_db_query($basedatos,$sSQL8ab);
//$myrow8ab = mysql_fetch_array($result8ab);



//   $sSQL8abc= "
//SELECT *
//FROM
//traspasosEspeciales
//
//WHERE
//keyCAP='".$myrow['keyCAP']."'
//";
//$result8abc=mysql_db_query($basedatos,$sSQL8abc);
//$myrow8abc = mysql_fetch_array($result8abc);



//$sSQLd= "SELECT 
//statusCargo
//FROM cargosCuentaPaciente
//WHERE
//entidad='".$entidad."'
//and
//numSolicitud='".$myrow['numSolicitud']."'
//and
//statusCargo='standby' ";
//
//
//$resultd=mysql_db_query($basedatos,$sSQLd);
//$myrowd = mysql_fetch_array($resultd);



?>
	  
<tr >
<td  ><?php echo $a;?></td>              
  <td  ><?php echo $myrow['hora'];?></td>              
      <td  ><?php echo $myrow['factura'];?></td>
      <td ><?php echo $myrow['descripcionProveedor'];	?></td>
      <!--td ><?php 		echo '$'.number_format($myrow['importe'],2);	?></td>
      
      
      
      
      <td >
        <?php echo '$'.number_format($oferta[0],2);?>
      <?php 		echo '$'.number_format($myrow['iva'],2);	?>
   
      </td-->

      
      

       
      
      

       
      
       


      
      


     
     
     
         <td >
         
        <?php echo $myrow['usuario'];	?>

     </td>   
      
 
       
      <!--td >

      <?php 		echo '$'.number_format($myrow['iva'],2);	?>
          
      </td-->

 
 
  
 
 <td ><?php if( $myrow['status']=='sent'){
     echo 'Cargada';
     
 }else{
     echo 'Standby';
 }
?></td> 
      
       
 
 
 
       
 
 
 
 
      <td >

 
 
 <a onclick="javascript:ventanaSecundaria('../ventanas/verFacturas.php?proveedor=<?php echo $myrow['proveedor'];?>&id_factura=<?php echo $myrow['factura'];?>&descripcionProveedor=<?php echo $myrow['descripcionProveedor'];?>')"> 
 
 Print
 </a>
          
      </td>  
 


  
 <td >
          
<?php if( $myrow['statusFactura']=='recibido'){ ?>         
 Recibido
<?php }elseif($myrow['status']=='sent' ){?>          
 <a href="recibeFacturas.php?del=yes&keyCO=<?php echo $myrow['keyCO'];?>&dates=<?php echo $dates;?>&main=<?php echo $_GET['main'];?>&warehouse=<?php  echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">
 Recibir 
 </a>
<?php }?>          
      </td>  
 
      
      <td >
          
<?php if($myrow['statusFactura']=='recibido'){ 
    echo $myrow['usuarioRecepcion'];
}else{

}
?>         
         
      </td>        
      
            <td >
          
<?php if($myrow['statusFactura']=='recibido'){ 
    echo cambia_a_normal($myrow['fechaRecepcion']);
}else{
   
}
?>         
         
      </td> 
     <!--td>&nbsp;</td> 
     <td>&nbsp;</td-->
      
      <!--td >
          
      <?php 		echo '$'.number_format($myrow['importe']+$myrow['iva'],2);	?>          
          
      </td>     
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     
      
 <td >
          
<?php if( $myrow['statusFactura']=='recibido'){ ?>         
 Recibido
<?php }elseif($myrow['status']=='sent' ){?>          
 <a href="recibeFacturas.php?del=yes&keyCO=<?php echo $myrow['keyCO'];?>&dates=<?php echo $dates;?>&main=<?php echo $_GET['main'];?>&warehouse=<?php  echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">
 Recibir 
 </a>
<?php }?>          
      </td-->       
 
    </tr>
    <?php  }?>
   </table>
  


</form>


    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script>     
    
</body>
</html>