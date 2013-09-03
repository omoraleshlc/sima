<?PHP require("menuOperaciones.php"); ?>



<?php 
$ventanaCenter=new windowCenter();
echo $ventanaCenter->mainmenu();
?>

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

<META HTTP-EQUIV="Refresh"
CONTENT="100"> 
<body>




 <form id="form1" name="form1" method="post" action="#">
     <br>
  <h1 align="center">SOLICITUDES A GRANEL</h1>

  
      <p align="center" >
    <span >Escoge la Fecha </span>
      <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
                if(!$_POST['fechaInicial']){
		 echo $fecha1;
                }else{
                    echo $_POST['fechaInicial'];
                }
		 ?>"/>
    </label>
    <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png" />
</p>
  




  
  
   <table width="800" class="table table-striped">
    <tr >
      <th width="37" >Hora</th>
      
      <th width="37" >#</th>
      <th width="114" >Articulo</th>
<th width="114" >Almacen</th>
      <th width="47" >Usuario</th>
        <th width="45" >Print</th>
           
    </tr>
    
    
    
    
<?php	
if(!$_POST['fechaInicial']){$_POST['fechaInicial']=$fecha1;}

$cendis=new whoisCendis();




 $sSQL= "
SELECT *
FROM
contadorEntregaGranel 
where

entidad='".$entidad."'
and
fecha='".$_POST['fechaInicial']."'
and
status='entregado'




order by hora ASC";

if($usuario=='omorales'){
//	echo "SQL: ".$sSQL;
//	echo  '<br>';
}


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$a+=1;

$fV[0]=$myrow['folioVenta'];



?>
	  
	  <tr  >
  
  <td  >
  	
  	<?php echo $myrow['hora'];?>
  	
  </td>      
  
  
  
          
      <td  >
          
 <a href="javascript:wopen('../cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>','popup',900,900);">
     <?php echo $myrow['contador'];?>
 </a>          
      </td>
      
      
      
      
      
              
              
              
      
              
<td >
<?php 
echo $myrow['descripcionArticulo'];


?></td>
              
              
    
              
              
              
              
<td >
<?php 
echo $myrow['descripcionAlmacen']?>
</td>  
              

       
      
                <td >
<?php 
echo $myrow['usuario']?></td>    

       
      
       


      
    
      
       
 
 
 
      <td >
 <a href="javascript:ventanaSecundaria('../ventanas/printEntregaGranel.php?keySol=<?php echo $myrow['keySol'];?>&nOrden=<?php echo $myrow['nOrden'];?>&departamentoSolicitante=<?php echo $myrow['almacenSolicitante'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&usuarioSolicitante=<?php echo $myrow['usuario'];?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $myrow['fechaSolicitud'];?>&horaSolicitud=<?php echo $myrow['horaSolicitud'];?>
&numSolicitud=<?php echo $myrow['numSolicitud'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&almacenDestino=<?php echo $bali;?>','ventana7','800','600','yes');" />
 <img src="/sima/imagenes/btns/printer.png" width="20" height="20" />
 </a>
          
      </td>  
 
 
     
 
 
 
    </tr>
    <?php  }?>
   </table>

<p>&nbsp;</p>

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