<?php require("/configuracion/ventanasEmergentes.php");require("/configuracion/funciones.php");?>  
<script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsaci�n de tecla en Internet Explorer
    */
    var tecla;
    function capturaTecla(e)
    {
        if(document.all)
            tecla=event.keyCode;
        else
        {
            tecla=e.which;
        }
     if(tecla==13)
        {
            document.forms[0].submit();
        }
    }
    document.onkeydown = capturaTecla;
</script>


<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=800,height=600,scrollbars=YES")
}
</script>









  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
 












<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>








  <form  name="form" method="post" >
      <h1 align="center">Cargos con la fecha: <?php echo cambia_a_normal($_GET['fechaInicial']);?></h1>

  
      <p align="center" class="titulo">
<?php





$aCombo= "SELECT *
FROM
movSolicitudes 
where

entidad='".$entidad."'
and
fecha='".$_GET['fechaInicial']."' 
    and
    nOrden>0
group by usuario
order by  usuario ASC
";
$rCombo=mysql_db_query($basedatos,$aCombo);

?>


     <select name="usuario"  id="almacenDestino" onChange="this.form.submit();" />
     <option value="">Escoje</option>

        <?php while($resCombo = mysql_fetch_array($rCombo)){
		$aCombo1= "Select * From usuarios where entidad='".$entidad."' AND
usuario='".$resCombo['usuario']."'";
$rCombo1=mysql_db_query($basedatos,$aCombo1);
$resCombo1 = mysql_fetch_array($rCombo1);
		?>
        <option
		<?php
if($resCombo1['usuario']==$_POST['usuario'] ){

		echo 'selected="selected"';


		 } ?>
		value="<?php echo $resCombo['usuario']; ?>"><?php echo $resCombo1['nombre'].' '.$resCombo1['aPaterno'].' '.$resCombo1['aMaterno']; ?></option>
        <?php } ?>
        </select>
</p>
  




  

   <table width="500" class="table table-striped">
    <tr >
        <th width="5" >#</th>
      <th width="20" >Solicitud</th>
     <th width="20" >Hora</th>
      <th width="114" >Origen</th>

         <th width="20" >Status</th>

             <th width="20" >Print</th>
            
    </tr>
    
    
    
    
<?php	
if($_POST['usuario']!=NULL){

$cendis=new whoisCendis();




$sSQL= "
SELECT *
FROM
movSolicitudes 
where

entidad='".$entidad."'
and
fecha='".$_GET['fechaInicial']."' 
    and

   usuario='".$_POST['usuario']."'     
and
    nOrden>0
group by nOrden
order by  nOrden ASC
";


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
SELECT descripcion,almacenConsumo
FROM
almacenes

WHERE
entidad='".$entidad."'
and
almacen='".$myrow['almacen']."'";
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
	  
	  <tr >
  
   
        <td  >
          
 
     <?php echo $a;?>

      </td>
  
 
  
  
  
          
      <td  >
          
 
     <?php echo $myrow['nOrden'];?>

      </td>
              
              
              
              
              
      
       <td  >
          
 
     <?php echo $myrow['hora'];?>

      </td>   
      
      

      
      
      
      
      
      

 <td ><?php echo $myrow8ab['descripcion'];?></td>
 
 
 
      
      
 
 
 
   
    
      
       
 
 
  <td  >
          
 
     <?php echo $myrow['status'];?>

     </td> 
 
 
 
 
      <td >
 <a href="javascript:ventanaSecundaria('../ventanas/printRepo.php?keyCAP=<?php echo $myrow['keyCAP'];?>&nOrden=<?php echo $myrow['nOrden'];?>&departamentoSolicitante=<?php echo $myrow8ab['descripcion'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&usuarioSolicitante=<?php echo $myrow['usuario'];?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $myrow['fechaSolicitud'];?>&horaSolicitud=<?php echo $myrow['horaSolicitud'];?>
&numSolicitud=<?php echo $myrow['numSolicitud'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>&keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&almacenDestino=<?php echo $bali;?>','ventana7','800','600','yes');" />
 <img src="/sima/ic/pdf.png" width="30" height="30" />
 </a>
          
      </td>  
 
 
  
 
 
 
    </tr>
    <?php  }}?>
   </table>

<p>&nbsp;</p>
  <p align="center"><span >
    
  </span></p>



    </form>

  
  
  
  
</body>
</html>
