<?php 
//*****************CONEXION  A SIMA***************
require('/configuracion/baseDatos.php');
$base=new MYSQL();
$basedatos=$base->basedatos();
$conexionManual=new MYSQL();
$conexionManual->conecta();
//**************************************************
$bali=$_GET['bali'];




if($_GET['fechaInicial']!=''){
    $fechaSolicitud=$_GET['fechaInicial'];
    }else{
        $fechaSolicitud=date("Y-m-d");
         }
         

         
    $entidad=$_GET['entidad'];

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
//$estilo= new muestraEstilos();
//$estilo->styles();
?>

</head>


<body>




 <form id="form1" name="form1" method="POST">
  <h1 align="center"><?php echo $titulo;?></h1>

  
      <p align="center" >
    <span >Escoge la Fecha </span>
      <input onChange="this.form.submit();" name="fechaInicial" type="text"  id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
                echo $fechaSolicitud;
		 ?>"/>
    </label>
    <input name="button" type="image"  id="lanzador" value="cargar"  src="../imagenes/btns/fechadate.png" />
</p>
  




  
  
   <table width="700" class="table table-striped">
    <tr >
      <th width="17" >Hora</th>
      
      <th width="37" >Folio</th>
      <th width="114" >Nombre Paciente </th>
      <th width="78" >Procedencia</th>
      <th width="47" >Usuario</th>
      <th width="54" >Cubiculo</th>
      <th width="54" >---</th>
      <th width="54" >Status</th>

             <th width="45" >Print</th>
             <th width="17" >Solicitud</th>
    </tr>
    
    
    
    
<?php	









$sSQL= "
SELECT *
FROM
cargosCuentaPaciente 
where
(
entidad='".$entidad."'
and
fechaSolicitud='".$fechaSolicitud."'
and
(almacenDestino='".$bali."' or almacen='".$bali."' )
and
(statusCargo='standby' or statusCargo='cargado')
and
(folioVenta!='' and folioVenta!='0')

and
(keyClientesInternos!='' and keyClientesInternos!='0')
and
naturaleza='C'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
numSolicitud!=''
    and
statusDevolucion!='si'
)
or
(
entidad='".$entidad."'
and

fechaSolicitud='".$fechaSolicitud."'
    and
statusDevolucion='si'
and
(statusCargo='standby' or statusCargo='cargado')
and
(almacenDestino='".$bali."' or almacen='".$bali."' )
and
(folioVenta!='' and folioVenta!='0')

and
(keyClientesInternos!='' and keyClientesInternos!='0')
and
naturaleza='A'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')
and
numSolicitud!=''
)


group by numSolicitud
order by horaSolicitud DESC";

if($usuario=='omorales'){
//	echo "SQL: ".$sSQL;
//	echo  '<br>';
}


$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 
$a+=1;

$fV[0]=$myrow['folioVenta'];

$sSQL8a= "
SELECT paciente,cuarto,almacen
FROM
clientesInternos
WHERE
entidad='".$entidad."'
    and
folioVenta='".$fV[0]."'";
$result8a=mysql_db_query($basedatos,$sSQL8a);
$myrow8a = mysql_fetch_array($result8a);


$sSQL8ab= "
SELECT descripcion
FROM
almacenes

WHERE
entidad='".$entidad."'
and
almacen='".$myrow8a['almacen']."'";
$result8ab=mysql_db_query($basedatos,$sSQL8ab);
$myrow8ab = mysql_fetch_array($result8ab);



   $sSQL8abc= "
SELECT *
FROM
traspasosEspeciales

WHERE
keyCAP='".$myrow['keyCAP']."'
";
$result8abc=mysql_db_query($basedatos,$sSQL8abc);
$myrow8abc = mysql_fetch_array($result8abc);



$sSQLd= "SELECT 
statusCargo
FROM cargosCuentaPaciente
WHERE
entidad='".$entidad."'
and
numSolicitud='".$myrow['numSolicitud']."'
and
statusCargo='standby' 
and
(almacenDestino='".$bali."' or almacen='".$bali."')
    
";


$resultd=mysql_db_query($basedatos,$sSQLd);
$myrowd = mysql_fetch_array($resultd);

if($myrowd['statusCargo']!=''){
    $status='Pendiente';
}else{
    $status='Surtido';
}

?>
	  
	  <tr  >
  
  <td  >
  	
  	<?php echo $myrow['horaSolicitud'];?>
  	
  </td>      
  
  
  
          
      <td  >
          
 <a href="javascript:wopen('../cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&folioVenta=<?php echo $myrow['folioVenta'];?>','popup',900,900);">
     <?php echo $myrow['folioVenta'];?>
 </a>          
      </td>
      
      
      
      
      <td >
          <?php
        
          if($myrow8abc['keyPA']!=NULL ){
              if($myrow8abc['status']!='done'){ 
               echo  '<span >';
                  echo $myrow8a['paciente'];
                  echo '</br>';
                  echo '</span>';
                     echo  '<span class="informativo">';
                  echo '<blink>'.'Sin Existencias en almacen, Favor de Surtir en Farmacia! '.'</blink>';
                  echo '</span>';
              }else{ ?>

                        <span >
        <?php 		echo $myrow8a['paciente'];?>      
                  </span>



          <?php }
          }else{
              ?>
          


          <span >


             
        <?php 		echo $myrow8a['paciente'];	?>

    
                  </span>



              <?php }?>

      



              <span >
      <?php 
	  if($myrow['statusDevolucion']=='si'){
	  echo '</br>';
	  echo '   [Se solicito devolucion]';
	  }
	  ?>
      </span> </span></td>
      <td ><?php 
echo $myrow8ab['descripcion'];
?></td>
      <td ><?php echo $myrow['usuario'];?></td>
      <td ><?php echo $myrow8a['cuarto'];?></td>
       
      
      

       
      
       

     <td >
         
         
<?php if($myrowd['statusCargo']!=''){ ?>
          <a href="#" onclick="javascript:ventanaSecundaria('/sima/cargos/despliegaSolicitudesDirectas.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $bali; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;almacenDestino=<?php echo $bali; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>&paciente=<?php echo $myrow8a['paciente'];?>&usuario=<?php echo $myrow['usuario'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>')">
         Cargar
         </a>         
<?php }else{
         echo '---';
         }?>
     </td>   
      
      

      
 <td ><?php echo $status;?></td>     
      
       
 
 
 
      <td >
 <a href="javascript:ventanaSecundaria('/sima/ADMINHOSPITALARIAS/inventarios/printTraspasosSD.php?keyCAP=<?php echo $myrow['keyCAP'];?>&nOrden=<?php echo $myrow['nOrden'];?>&departamentoSolicitante=<?php echo $myrow['almacenSolicitante'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&usuarioSolicitante=<?php echo $myrow['usuario'];?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $myrow['fechaSolicitud'];?>&horaSolicitud=<?php echo $myrow['horaSolicitud'];?>&numSolicitud=<?php echo $myrow['numSolicitud'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&almacenDestino=<?php echo $bali;?>','ventana7','800','600','yes');" />
 <img src="/sima/imagenes/btns/printer.png" width="30" height="30" />
 </a>
          
      </td>  
 
 
  <td ><?php echo $myrow['numSolicitud'];?></td>     
 
 
 
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