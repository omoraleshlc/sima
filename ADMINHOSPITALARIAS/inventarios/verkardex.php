<?PHP require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php");?>
<script language=javascript> 

<?php 
//**************************************************
//$detectarNavegador=new detectaNavegador();
//if($detectarNavegador->detectarNavegador()=='movil'){
$agrega = "INSERT INTO logs (
descripcion,almacenSolicitante,almacenDestino,usuario,hora,fecha,entidad,folioVenta,cuartoIngreso,cuartoTransferido)
values
('Kardex de articulos','".$ALMACEN."','".$_POST['almacenDestino']."',
'".$usuario."','".$hora1."','".$fecha1."','".$entidad."','',
'','')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
?>

function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria11 (URL){ 
   window.open(URL,"ventanaSecundaria11","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>



<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=630,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

 <!-Hoja de estilos del calendario -->
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario -->
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script>
 <!-- librer�a para cargar el lenguaje deseado -->
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script>
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo -->
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<style type="text/css">
<!--
.Estilo24 {font-size: 10px}
-->
</style>
<head>

<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

</head>

<body>



<?php
		 if($_GET['fechaInicial']){
		 $date=$_GET['fechaInicial'];
		 } else {
		 $date= $fecha1;
		 }
		 
?>

<form id="form10" name="form10" method="post" >
  <h1 align="center" class="titulo">Kardex de Articulos</h1>
  
  
  
  
  
  
  
  
  <img src="/sima/imagenes/bordestablas/borde1.png" width="500" height="24" />
  <table width="500" border="0" align="center" cellpadding="4" cellspacing="0" class="normal">






      <tr>






      <td width="250" bgcolor="#CCCCCC">
          <label>
Datos del Producto:

   </label>
  <label>
<span class="titulomed"><?php echo $_GET['descripcion'];?></span>
      </label></td>



    </tr>







          <tr>

      <td width="250" bgcolor="#CCCCCC">
          <label>
             Codigo de Barra
   </label>

          <label>
<?php echo $_GET['cbarra'];?>
      </label></td>




    </tr>






          <tr>

      <td width="250" bgcolor="#CCCCCC">
          <label>
Fecha Inicial:   <?php echo $_GET['fechaInicial'];?></label>

</td>




    </tr>



      



          <tr>

      <td width="250" bgcolor="#CCCCCC">


          <label>
Fecha Final:   <?php echo $_GET['fechaFinal'];?>
      </label>

      </td>



    </tr>



<tr>
<td width="250" bgcolor="#CCCCCC">
<label>
Grupo de Producto:   <?php echo $_GET['gpoProducto'];?>
</label>
</td>
</tr>

<tr>
<td width="250" bgcolor="#CCCCCC">
<label>
Minimos:   <?php echo $_GET['minimos'];?>
</label>
</td>
</tr>

<tr>
<td width="250" bgcolor="#CCCCCC">
<label>
Maximos:   <?php echo $_GET['maximos'];?>
</label>
</td>
</tr>



<tr>
<td width="250" bgcolor="#CCCCCC">
<label>
Usuario Creacion:   <?php echo $_GET['usuarioCreacion'];?>
</label>
</td>
</tr>

<tr>
<td width="250" bgcolor="#CCCCCC">
<label>
Fecha Creacion:   <?php echo $_GET['fechaCreacion'];?>
</label>
</td>
</tr>


<tr>
<td width="250" bgcolor="#CCCCCC">
<label>
Ultima Actualizacion:   <?php echo $_GET['fechaCreacion'];?>
</label>
</td>
</tr>

  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="500" height="24" />
<p align="center" class="titulo">&nbsp;</p>
  <img src="/sima/imagenes/bordestablas/borde1.png" width="500" height="24" />
  <table width="500" border="0.2" align="center" cellpadding="4" cellspacing="0" class="normal">
    <tr bgcolor="#FFFF00">
         <th width="5" class="normal" scope="col"><div align="left">#</div></th>
      <th width="10" class="normal" scope="col"><div align="left">Fecha Salida</div></th>
       <th width="10" class="normal" scope="col"><div align="left">Folio</div></th>
      <th width= "10" class="normal" scope="col"><div align="left">Entrada</div></th>
      <th width= "10" class="normal" scope="col"><div align="left">Salida</div></th>
      <th width= "10" class="normal" scope="col"><div align="left">Existencia</div></th>
      <th width= "10" class="normal" scope="col"><div align="left">Costo</div></th>
      <th width= "10" class="normal" scope="col"><div align="left">Importe Entrada</div></th>
      <th width= "10" class="normal" scope="col"><div align="left">Importe Salida</div></th>
    </tr>
   


<?php	


  $sSQL= "SELECT *
FROM
kardex
where
entidad='".$entidad."'
and
keyPA='".$_GET['keyPA']."'
and
fecha>='".$_GET['fechaInicial']."' and fecha<='".$_GET['fechaFinal']."'


    order by fecha DESC
 ";

 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$a+=1;




 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$myrow['codProcedimiento']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
 ?>


      <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >


      <td width="5"  class="normal">
          <div align="left"><?php echo $a;?>
          </div>
      </td>


      <td width="10" class="normal">
          <div align="left"><?php echo cambia_a_normal($myrow['fecha']);?>
          </div>
      </td>




 <td width="10"  class="normal">



  <div align="left">
    <?php
    echo $myrow['folioVenta'];
    ?>
  </div>

 </td>



 <td width="10"  class="normal">



  <div align="left">
    <?php
    echo $myrow['entrada'];
    ?>
  </div>

 </td>



           <td width="10"  class="normal">



  <div align="left">
    <?php
    echo $myrow['cantidad'];
    ?>
  </div>

 </td>










 <td width="10"  class="normal">
  <div align="left">
    <?php
    echo $myrow['existencias'];
    ?>
  </div>
 </td>





<td width="10"  class="normal">
  <div align="left">
    <?php
    echo '$'.number_format($myrow['costo']);
    ?>
  </div>
</td>










           <td width="10"  class="normal">



  <div align="left">
    <?php
    //echo $myrow['precioVenta']+$myrow['iva'];
    ?>
  </div>

 </td>






 <td width="10"  class="normal">



  <div align="left">
    <?php
    echo '$'.number_format($myrow['precioVenta'],2);
    ?>
  </div>

 </td>

    

    </tr>



      
    <?php  }}?>

  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="500" height="24" />
<p>&nbsp;</p>
</form>


  <p>&nbsp;</p>



<?php

  $sSQL= "SELECT avg(precioVenta) as promedio
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
keyPA='".$_GET['keyPA']."'
and
fechaCargo>='".$_GET['fechaInicial']."' and fechaCargo<='".$_GET['fechaFinal']."'
    and
    folioVenta!=''
    and
    statusCargo='cargado'
  
 ";





$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);

?>
            <div align="center" class="titulo"  style="color: #F17443">
                COSTO PROMEDIO: <?php echo '$'.number_format($myrow['promedio'],2);?>  Y VALORACION
          </div>


</body>

</html>

