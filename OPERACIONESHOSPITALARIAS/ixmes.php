<?php require("menuOperaciones.php");
$ventana1='ventanaCatalogoAlmacen.php';
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />

  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="../calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
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
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=300,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=600,height=400,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria511 (URL){ 
   window.open(URL,"ventanaSecundaria511","width=700,height=600,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria5111 (URL){ 
   window.open(URL,"ventanaSecundaria5111","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundariam (URL){ 
   window.open(URL,"ventanaSecundariam","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventanaSecundaria5","width=700,height=600,scrollbars=YES") 
} 
</script>



<?php 



if($_POST['fv'] and !$_POST['resumen'] ){
if($_POST['fecha']<$fecha1){
 $random=rand(1,900000000);

$q = "insert into contador 
(
usuario,random)
values
('".$usuario."','".$random."')";
mysql_db_query($basedatos,$q);
echo mysql_error();

$sSQL7ab="SELECT * 
FROM
contador
WHERE
usuario='".$usuario."'
and
random='".$random."'
order by keyConta DESC

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);	
?>



<script>
//javascript:ventanaSecundaria5('imprimirHonorariosMedicos.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>');
//javascript:ventanaSecundaria51('imprimirTransaccionesHoja.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>');
javascript:ventanaSecundaria511('../ventanas/ingresosacumuladosxmes.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>&fechaInicial=<?php echo $_POST['fechaInicial'];?>&fechaFinal=<?php echo $_POST['fechaFinal']?>');
//javascript:ventanaSecundaria5111('imprimirMovimientosHoja.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>');
//javascript:ventanaSecundariam('imprimirVentasDirectas.php?fecha=<?php echo $_POST['fecha'];?>&entidad=<?php echo $entidad;?>');
</script>



<?php 
}else{
echo '<script>';
echo 'window.alert("La fecha debe ser menor a hoy..");';
echo '</script>';
}
}
?>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=700,height=600,scrollbars=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundariaA (URL){ 
   window.open(URL,"ventanaSecundariaA","width=700,height=600,scrollbars=YES") 
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
 <h1 align="center" >Ingresos Acumulados x Mes</h1>
 <form id="form2" name="form2" method="post" action="">
   <table width="400" class="table-forma">
 

     
     <tr>
       <td width="228"><div align="center">
         <input name="fechaInicial" type="text"  id="campo_fecha" size="11" maxlength="11" readonly="readonly"
		value="<?php
		 if($_POST['fechaInicial']){
		 echo $_POST['fechaInicial'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
         <br />
       </div>
         </label>
       <label></label></td>
       <td width="228">
             <div align="center">
                 <input name="fechaFinal" type="text"  id="campo_fecha1" size="11" maxlength="11" readonly=""
		value="<?php
		 if($_POST['fechaFinal']){
		 echo $_POST['fechaFinal'];
		 } else {
		 echo $fecha1;
		 }
		 ?>" />
                 <br />
           
             </label>
          <label></label>
         </div></td>
     </tr>
     
     
     
     
     
     <tr>
       <td><div align="center"><input  name="lanzador" type="image" src="../imagenes/btns/fecha.png" id="lanzador" value="Inicio" /></div></td>
       <td><div align="center">
         <input name="button" type="image" src="../imagenes/btns/fecha.png" id="lanzador1" value="Fin" />
       </div></td>
     </tr>
     
     
   </table>
 
<!--

	   <a href="javascript:ventanaSecundaria51('ingresosacumuladosxmes.php?numeroE=<?php echo $numeroE; ?>&amp;nCuenta=<?php echo $nCuenta; ?>&amp;paciente=<?php echo $_POST['paciente']; ?>&amp;numeroConfirmacion=<?php echo $numeroConfirmacion; ?>&amp;hora1=<?php echo $hora1; ?>&amp;keyClientesInternos=<?php echo $myrow3['keyClientesInternos'];?>&amp;random=<?php echo $myrow7ab['random'];?>&amp;fechaInicial=<?php echo $_POST['fechaInicial'];?>&amp;fechaFinal=<?php echo $_POST['fechaFinal'];?>&entidad=<?php echo $entidad;?>')">Grupos</a>
	   -->
	   
	   
   <p align="center">
   
     <input type="submit" name="fv" id="fv" value="Generar Reporte" />
   </p>
</form>
 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del bot�n que lanzar� el calendario 
}); 
     </script>
     
      <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
     </script>
</body>
</html>