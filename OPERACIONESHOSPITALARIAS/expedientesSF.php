<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");?>
<?php require("/configuracion/clases/despliegaExpedientesPendientes.php"); 

$almacenDestino=$_GET['datawarehouse'];
$forma=$_GET['forma'];
$campoDespliega=$_GET['campoDespliega'];
$campoDespliegaFecha=$_GET['campoDespliegaFecha'];
require("/configuracion/componentes/comboAlmacen.php"); 
?>

<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-win2k-2.css" title="win2k-cold-1" /> 
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=300,height=200,scrollbars=YES") 
} 
</script> 

<?php

if($_POST['entregar']){ 
$keyES=$_POST['keyES'];
for($i=0;$i<=$_POST['bandera'];$i++){

if($keyES[$i]){
 $sql="update expedientesSolicitados
set
status='recibido',
usuarioRecepcion='".$usuario."'
where
keyES='".$keyES[$i]."'";
mysql_db_query($basedatos,$sql);
echo mysql_error();
}
}

$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se recibieron expedientes...';
}
?>

  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>


</head>


<p align="center">
    
   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>       
    
</p>






  <body>

<form id="form1" name="form1" method="post" action="#">
  <p align="center" class="titulos">
  <?php 
  
function compara_fechas($fecha1,$fecha2)
            

{
            

      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha1))
            

              list($dia1,$mes1,$a�o1)=split("/",$fecha1);
            

      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha1))
            

              list($dia1,$mes1,$a�o1)=split("-",$fecha1);
        if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha2))
            

              list($dia2,$mes2,$a�o2)=split("/",$fecha2);
            

      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha2))
            

              list($dia2,$mes2,$a�o2)=split("-",$fecha2);
        $dif = mktime(0,0,0,$mes1,$dia1,$a�o1) - mktime(0,0,0, $mes2,$dia2,$a�o2);
        return ($dif);                         
            

}

?>
            
  </p>
  <p ><strong>Expedientes Fuera (no tienen folio de venta) </strong></p>
 
  <table width="857" class="table table-striped">
    <tr  >
      <th width="77"   scope="col"><div align="center" >
        <div align="left">Hora</span></div>
      </div></th>
      <th width="53"  scope="col"><div align="center" >
        <div align="left">#Exp.</span></div>
      </div></th>
      <th width="200"  scope="col"><div align="center" >
        <div align="left">Paciente</span></div>
      </div></th>
      <th width="154"  scope="col"><div align="center" >
        <div align="left">M&eacute;dico</span></div>
      </div></th>
      <th width="120"  scope="col"><div align="center" >Motivo</div></span></th>
      <th width="120"  scope="col"><div align="center" >
        <div align="left">Departamento</span></div>
      </div></th>
      <th width="51"  scope="col"><div align="center" >
        <div align="left">Status</span></div>
      </div></th>
      <th width="48"  scope="col"><div align="center" >
        <div align="left">Recibir</span></div>
      </div></th>
    </tr>
    <tr  >
<?php 
$fechaLimite = date("Ymd", strtotime("-7 day"));



	 
$sSQL11= "
Select * From expedientesSolicitados WHERE entidad='".$entidad."' and status='solicitar' order by numeroEx,fecha ASC";

$result11=mysql_db_query($basedatos,$sSQL11);

while($myrow = mysql_fetch_array($result11)){ 
echo mysql_error();
$bandera+=1;


$fechaSalida= str_replace("-", "", $myrow['fecha']);





if($fechaSalida<$fechaLimite){
$class='codigos';
}else{
$class='normal';
}

?>

<tr   > 
      <td  class="<?php echo $class;?>">
      <div align="center" class="<?php echo $class;?>">
	        
          <?php 
 echo $myrow['hora']." ".cambia_a_normal($myrow['fecha']);


?>
              </span>
        </span> </div></td>
		

      <td class="<?php echo $class;?>"><?php 

	  echo $myrow['numeroEx'];
	  ?></td>
      <td class="<?php echo $class;?>">
                    <?php 
	 $sSQL711a="SELECT *
FROM
pacientes
WHERE
entidad='".$entidad."' 

and
numCliente='".$myrow['numeroEx']."'
";
  $result711a=mysql_db_query($basedatos,$sSQL711a);
  $myrow711a = mysql_fetch_array($result711a);

	
	 ?>
	  <?php 
	  
	echo $myrow711a['nombreCompleto'];
	 
	  ?>&nbsp;
      <div align="left"></div></td>
      <td class="<?php echo $class;?>"><div align="left" class="<?php echo $class;?>"><?php  echo $myrow['medico'];?></span></div></td>
      <td class="<?php echo $class;?>"><?php  echo $myrow['motivo']; ?></td>
      
	  
	  
	  <td class="<?php echo $class;?>">     
	  <?php  	  
	  	 $sSQL711ab="SELECT *
FROM
almacenes
WHERE
entidad='".$entidad."' 

and
almacen='".$myrow['almacen']."'
";
  $result711ab=mysql_db_query($basedatos,$sSQL711ab);
  $myrow711ab = mysql_fetch_array($result711ab);
	  echo $myrow711ab['descripcion']; ?>
	  </td>
	  
	  
	  
	  
	  
      <td class="<?php echo $class;?>"><div align="center"><span class="<?php echo $class;?>">

        <?php if($paciente){//
	  echo $leyenda;
	  } 
	  else { echo '---';} ?>
      </span></div></td>
      <td class="<?php echo $class;?>">
	  <div align="left">
        <label>

	        <input type="checkbox" name="keyES[]" value="<?php echo $myrow['keyES'];?>"  />
        </label>
      </div></td>
    </tr>
    <?php }?>
  </table>

<label>
      <div align="center"><br />
	  <?php if($bandera>0) {?>
        <input name="entregar" type="submit" src="../imagenes/btns/aplyexitbtn.png" id="entregar" value="Aplicar Salida" />
		<?php } ?>
  </div>
    </label>
	<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>


<p>&nbsp;</p>


</body>
</html>