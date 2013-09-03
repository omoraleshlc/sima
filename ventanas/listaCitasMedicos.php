<?PHP require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php'); 
$ventana1='ventanaCatalogoAlmacen.php';




////***************LAS CITAS MENORES BORRAN******************
//$agrega = "DELETE FROM citasTemporales where fechaSolicitud<'".$fecha1."'";
//mysql_db_query($basedatos,$agrega);
//echo mysql_error();
////***************************************
?>




    <?php 
	  if($_POST['fechaSolicitud']){
	   $fecha2=$_POST['fechaSolicitud'];
	  } else {
	   
	   $fecha2=$fecha1;
	  } ?>


<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.almacen.value) == false ) {   
                alert("Por Favor, escoje el almacen/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este almacen!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
	<?php 		
$sSQL7ab="SELECT medicos 
FROM
gpoProductos
WHERE
codigoGP='".$_GET['gpoProducto']."'

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>






<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-blue.css" title="win2k-cold-1" /> 
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 


<script type="text/javascript">
	function regresar(hora,fecha,guiaHora){
			self.opener.document.form1.codHora.value = hora;
				self.opener.document.form1.fechaSolicitud.value = fecha;
								self.opener.document.form1.guiaHora.value = guiaHora;
		close();
	}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
 <h1 align="center" class="titulomedio">
 <div align="center"></div>
<form id="form2" name="form2" method="post" >
  <p align="center"><span class="Estilo25">Escoje la Fecha
      <input name="fechaSolicitud" type="text" class="Estilo24" id="campo_fecha"
	  value="<?php 
	  echo $fecha2;
	  ?>" size="10" readonly="" onChange="javascript:this.form.submit();"/>
    <input name="button" type="image" src="/sima/imagenes/calendario.png" id="lanzador" value="..." />
      <input name="almacenSolicitud" type="hidden"   value="<?php echo $_GET['medico'];?>" />
      
      
      
  </span></p><br />
  <p align="center">
<?php 
$sSQLd= "SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."' and
almacen='".$_GET['medico']."'";

 $resultd=mysql_db_query($basedatos,$sSQLd);
 $myrowd = mysql_fetch_array($resultd);
 echo $myrowd['descripcion'];
 ?>
  </p><br/>
  <table width="269" border="0" align="center" class="table table-striped">
<tr>
  <th width="51" bgcolor="#ffff00"  scope="col"><div align="left"><span class="negromid">Hora</span></div></th>
  <th width="208" bgcolor="#ffff00"  scope="col"><div align="left" class="negromid"> Paciente</div></th>
      </tr>
          
            
           
   
<?php
if($_POST['fechaSolicitud']){ 

$f1=explode("/", $_POST['fechaSolicitud']);
//haces una cadena en formato mes/dia/a�o
$f2=$f1[1].$f1[0].$f1[2];
$fech=date("w",strtotime($f2));
//$fech tendra un numero del 0 al 6 ke son los dias de la semana donde
//0=Domingo y 6=Sabado
if($fech==0){
$dia='Sunday';
}elseif($fech==1){
$dia='Monday';
}elseif($fech==2){
$dia='Tuesday';
}elseif($fech==3){
$dia='Wednesday';
}elseif($fech==4){
$dia='Thursday';
}elseif($fech==5){
$dia='Friday';
}elseif($fech==6){
$dia='Saturday';
}
}





//***********************




$sSQL= "SELECT *
FROM
medicosCitas
WHERE 
entidad='".$entidad."'
    and
id_medico='".trim($_GET['id_medico'])."'
and
almacen='".$_GET['almacen']."'
and
dia='".$dia."'
order by guiaHora
";



if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){
$a+=1;
$codigo=$code = $myrow['codigo'];
//echo $myrow['folioVenta'];

/*
if($tipo=='personalizado'){

$h=substr($myrow['codHora'],0,4);
$sSQL101= "SELECT *
FROM
citasTemporales
WHERE 
almacenSolicitud='".$myrow101['miniAlmacen']."'
and
 fechaSolicitud='".$fecha2."'
 and
 horaSolicitud like '$h%'
 order by horaSolicitud
 ";
  
}else{
if($_POST['fechaSolicitud']){
$sSQL101= "SELECT *
FROM
citasTemporales
WHERE 
entidad='".$entidad."'
    and
almacenSolicitud='".$myrow101['miniAlmacen']."'
and
 fechaSolicitud='".$fecha2."'
 and
 horaSolicitud='".$myrow['codHora']."'";
}elseif($_GET['fechaSolicitud']){
$sSQL101= "SELECT *
FROM
citasTemporales
WHERE 
entidad='".$entidad."'
    and
almacenSolicitud='".$myrow101['miniAlmacen']."'
and
 fechaSolicitud='".$fecha2."'
 and
 horaSolicitud='".$myrow['codHora']."'";
 }
}
$result101=mysql_db_query($basedatos,$sSQL101);
$myrow101= mysql_fetch_array($result101);
 * 
 * 
 * 
 *  entidad='".$entidad."' and
 almacenSolicitud='".$_POST['almacenDestino1']."'
 and
 guiaHora='".$_POST['guiaHora']."'
 and
 fechaSolicitud='".$_POST['fechaSolicitud']."'
*/  
  
  
  
  
$sSQL101a= "SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
    and
medico='".$_GET['id_medico']."'
    and
almacen='".$_GET['almacen']."'
and
 fechaSolicitud='".$fecha2."'
 and
 guiaHora='".$myrow['guiaHora']."'";

$result101a=mysql_db_query($basedatos,$sSQL101a);
$myrow101a= mysql_fetch_array($result101a);


?>



<tr valign="top" >
<td valign="middle" >


<?php 
  if($myrow101a['paciente']){

print $myrow['codHora'];
}else{ ?>

 <a href="javascript:regresar('<?php echo $myrow['codHora']; ?>','<?php   echo $fecha2;   ?>','<?php echo $myrow['guiaHora']; ?>');">
<?php print $myrow['codHora']; ?>
</a>



<?php 
}
?>
</td>


 <td height="31" valign="middle" ><label>
        <?php 
		    if($myrow101a['paciente']){
			print '<div class="precio1">'.$myrow101a['paciente'].'</div>';
                        if($myrow101a['folioVenta']!=NULL){
                          print '<div class="success">'.$myrow101a['folioVenta'].'</div>';
                        }
			}else{
			print 'Disponible';
			}
			
			
			?>
            
        </label>            </td>
          </tr>
          <?php 
	 $al=$myrow['almacenSolicitante'];
	 }}?>
        </table>
 </form>
       
       
<?php if($a<1){ echo '<div align="center" class="error">NO TIENE DEFINIDO HORARIO EN ESTE DIA!</div>';}?>
       
       
       <hr />
       <p>&nbsp;       </p>
       

        <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
         </script>      
       
       

</body>
</html>