<?php require("../OPERACIONESHOSPITALARIAS/menuOperaciones.php");$almacen=$ALMACEN=$_GET['datawarehouse']; ?>
<?php require("/configuracion/clases/despliegaExpedientesPendientes.php"); ?>
<?php 
$almacenDestino=$almacen;
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


<p align="center">&nbsp;</p>






  <body>

<form id="form1" name="form1" method="post" action="#">
  <p align="center" >
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





 if($_POST['fechaInicial']){
		 $f= $_POST['fechaInicial'];
		 } else {
		 $f= $fecha1;
		 }
?>
            
  </p>
  <p align="center" ><strong>Expedientes Creados en esta fecha: </strong>
    <label>
    <input name="fechaInicial" type="text"  id="campo_fecha" size="9" maxlength="9" readonly=""
		value="<?php echo $f;?>" onChange="this.form.submit();"/>
    </label>
    <input name="button" type="image"src="/sima/imagenes/btns/fecha.png" />
</p>
  





    <td><label>
      <div align="center">
       
        <table width="618" class="table table-striped">
          <tr  >
           
            <th width="52"  scope="col"><div align="left" >
            <div align="left">#Exp.</span></div>
            </div></th>
            
			<th width="326"  scope="col"><div align="left" >
                <div align="left">Paciente</span></div>
            </div></th>
			
            <th width="79"  scope="col"><div align="left" >
            <div align="left">Usuario</div>
            </div></th>
			
            <th width="128"  scope="col">
			<div align="left" >
			F. Creacion
			</div>
            </span></th>

            <th width="128"  scope="col">
			<div align="left" >
			F. Actualiza
			</div>
            </span></th>
        
        
        
        
          </tr>
        
<?php 
$fechaLimite = date("Ymd", strtotime("-7 day"));



	 
$sSQL= "
Select * From pacientes WHERE entidad='".$entidad."' and fechaCreacion='".$f."'   order by numCliente ASC ";

$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
echo mysql_error();
$bandera+=1;


$fechaSalida= str_replace("-", "", $myrow['fecha']);






$class='normal';


?>
       
	      <tr  >

	        <td class="<?php echo $class;?>"><?php 

	  echo $myrow['numCliente'];
	  ?></td>
	        <td class="<?php echo $class;?>"><div align="left"><?php echo $myrow['nombreCompleto'];?></div></td>
	        <td class="<?php echo $class;?>"><div align="left" class="<?php echo $class;?>">
	          <?php  echo $myrow['usuario'];?>
	          </span></div></td>
	        <td class="<?php echo $class;?>"><?php  echo cambia_a_normal($myrow['fechaCreacion']); ?></td>
                   <td class="<?php echo $class;?>"><?php  
                   if($myrow['fechaActualizacion']!=NULL){
                   echo cambia_a_normal($myrow['fechaActualizacion']); 
                   }else{echo '---';}
                   ?></td>

          <?php }?>
        </table>
      </div>
    </label>
	<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
   
    </form>


<p>&nbsp;</p>

    <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 

</body>
</html><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
