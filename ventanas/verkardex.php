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
//mysql_db_query($basedatos,$agrega);
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
    <br>
    <br>
  <h4 align="center" >Kardex de Articulos</h4>
  
  
  
  
  
  
  
  

  <table width="500" class="table-forma">






      <tr>






      <td width="250" >
          <label>
Datos del Producto:

   </label>
  <label>
<span> <?php 

$sSQLf= "SELECT *
FROM
articulos
where

keyPA='".$_GET['keyPA']."'
";

 
 
 

$resultf=mysql_db_query($basedatos,$sSQLf);
$myrowf = mysql_fetch_array($resultf);
echo $myrowf['descripcion'];?></span>
      </label></td>



    </tr>







          <tr>

      <td width="250" >
          <label>
             Codigo de Barra
   </label>

          <label>
<?php echo $_GET['cbarra'];?>
      </label></td>




    </tr>






          <tr>

      <td width="250" >
          <label>
Fecha Inicial:   <?php echo cambia_a_normal($_GET['fechaInicial']);?></label>

</td>




    </tr>



      



          <tr>

      <td width="250" >


          <label>
Fecha Final:   <?php echo cambia_a_normal($_GET['fechaFinal']);?>
      </label>

      </td>



    </tr>



<tr>
<td width="250" >
<label>
Grupo de Producto:   <?php echo $myrowf['gpoProducto'];?>
</label>
</td>
</tr>

<tr>
<td width="250" >
<label>
Minimos:   <?php echo $_GET['minimos'];?>
</label>
</td>
</tr>

<tr>
<td width="250" >
<label>
Maximos:   <?php echo $_GET['maximos'];?>
</label>
</td>
</tr>



<tr>
<td width="250" >
<label>
Usuario Creacion:   <?php echo $myrowf['usuario'];?>
</label>
</td>
</tr>

<tr>
<td width="250" >
<label>
Fecha Creacion:   <?php echo cambia_a_normal($_GET['fechaCreacion']);?>
</label>
</td>
</tr>


<tr>
<td width="250" >
<label>
Ultima Actualizacion:   <?php echo cambia_a_normal($myrowf['fecha']);?>
</label>
</td>
</tr>

  </table>

<p align="center" >&nbsp;</p>

  <table width="700" 	class="table table-striped">
      

      
      
      
    <tr >
         <th width="5"  ><div align="left">#</div></th>
      <th width="10"  ><div align="left">Fecha</div></th>
  <th width= "50"  ><div align="left">Movimiento</div></th>

      <th width= "50"  ><div align="left">Entrada</div></th>
      <th width= "50"  ><div align="left">Salida</div></th>
          <th width= "10"  ><div align="left">Existencia</div></th>
      <th width= "50"  ><div align="left">CostoUnit</div></th>
          <th width= "10"  ><div align="left">CostoMov</div></th>

  
  
  

  
    </tr>
   

 
               <tr >
          <td colspan="3">SALDO INICIAL</td>
                 
                   
          <td></td>          
          <td></td>          
          <td></td>          
          <td></td>    
                 
          <td><div align="left">
              <?php 
$sSQLy= "
SELECT sum(cantidad) as entradas 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowf['codigo']."'
    and
status='sold'
and
fecha<'".$_GET['fechaInicial']."'
";


$resulty=mysql_db_query($basedatos,$sSQLy);
$myrowy = mysql_fetch_array($resulty);
    
//DEPRECATED
/*
$sSQLys= "
SELECT sum(cantidad) as salidas 
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowf['codigo']."'
    and
tipoMov='salida'  
and
fecha<'".$_GET['fechaInicial']."'
";


$resultys=mysql_db_query($basedatos,$sSQLys);
$myrowys = mysql_fetch_array($resultys);
 */
$existenciaInicial=$myrowy['entradas']-$myrowys['salidas'];

              echo $myrowy['entradas']-$myrowys['salidas'];?>
              </div></td>  
               </tr>
             <tr >  
<?php	


$sSQL= "SELECT *
FROM
kardex
where
entidad='".$entidad."'
and
kc='".$myrowf['codigo']."'
and
fecha>='".$_GET['fechaInicial']."' and fecha<='".$_GET['fechaFinal']."'
group by
numSolicitud
    order by kk ASC
 ";

 
 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 

$a+=1;







$sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$myrowf['codigo']."' 
    and
fecha='".$myrow['fecha']."'
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);
  
 

  
  
    $sSQL5c="SELECT *
FROM
  `OC`
WHERE entidad='".$entidad."' AND
codigo = '".$myrowf['codigo']."' 
    and
fecha='".$myrow['fecha']."'

  ";
  $result5c=mysql_db_query($basedatos,$sSQL5c);
  $myrow5c = mysql_fetch_array($result5c);
  
  
//******************CUANTO HABIA EN EXISTENCIAS***********
     $sSQL1= "
SELECT sum( cantidad) as entrada
FROM
kardex
WHERE
entidad='".$entidad."'
and
numSolicitud='".$myrow['numSolicitud']."'
and
IO='ENTRADA'
  
";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1);
echo mysql_error();


     $sSQL1a= "
SELECT sum( cantidad) as salida
FROM
kardex
WHERE
entidad='".$entidad."'
and
numSolicitud='".$myrow['numSolicitud']."'
and
(IO='SALIDA' or IO='salida')
  
";
$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);
echo mysql_error();

    $sSQL2= "
SELECT sum( costo) as costo2
FROM
kardex
WHERE
entidad='".$entidad."'
and
numSolicitud='".$myrow['numSolicitud']."'
      
  
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
echo mysql_error();

 ?>





      <td   >
          <div align="left"><?php 
          echo $a;
          ?>
          </div>
      </td>


      <td  >
          <div align="left"><?php echo cambia_a_normal($myrow['fecha']);?>
          </div>
      </td>


      
      
      
      
      


 <td  >
  <div align="left">
    <?php
    
    
    //echo $myrow['io'];
    //echo '<br>';
    echo $myrow['descripcionevento'];
    echo '<br>';
    
    


    ?>
  </div>

 </td>
      
      
      
      
      




 <td   >



  <div align="left">
    <?php //entrada
   
    if($myrow1['entrada']>0){
    $entrada=$myrow1['entrada'];
    echo (int) $entrada;
    
    }else{
        $entrada=NULL;
    }
    
    $in[0]+=$myrow1['entrada'];
    ?>
  </div>

 </td>



           <td  >



  <div align="left">
    <?php //salida
   
    if($myrow1a['salida']>0){
    $salida=$myrow1a['salida'];
    echo (int) $salida;
    }else{
         $salida=NULL;
         }
    $out[0]+=$myrow1a['salida'];
    ?>
  </div>

 </td>





<td  >
  <div align="left">
    <?php
    /*
    //existencias    
    if($myrow['naturaleza']=='A'){
    $totales[0]+=$myrow['existencia']+$exis;    
    }elseif($myrow['naturaleza']=='C'){
    $totales[0]-=$myrow['existencia']+$exis;    
    }
    echo $totales[0];*/
    
      //$ei=$existenciaInicial-($out[0]-$in[0]);
      //$ei=$existenciaInicial-($in[0]-$out[0]);
      

        echo $existenciaInicial-( $out[0]-$in[0]);
       
    
    
    //echo $myrow['existencia'];
    ?>
         
  </div>
</td>






<td>

<?php
 if($myrow1['entrada']>0 and $myrow['evento']!='03'){
    if($myrow['costo']>0){
    echo '$'.number_format($myrow['costo'],2);   
    }
     $costo=$myrow['costo'];
 }else{
     echo '---';
 }
  $cos[0]+=$myrow['costo'];
    
    ?>
    
</td>


<td>

<?php  
    


//SACO LA EVALUACION
//echo $myrow['numSolicitud'];
 /*
$sSQL8ac1s= "
SELECT sum( cantidad*costo) as venta
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrowf['codigo']."'
    and
status='sold'
    and
   
        numSolicitud='".$myrow['numSolicitud']."'
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
  * 
  */


    print '$'.number_format($myrow2['costo2'],2);
  
    
     
    ?>
  
</td>















    </tr>



      
    <?php  }}?>

  </table>
 
<p>&nbsp;</p>
</form>


  <p>&nbsp;</p>



<?php
/*
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
*/


$sSQLex="
SELECT sum( costo) as costoActual
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
keyPA='".$_GET['keyPA']."'
    and
    status='ready'
";
$resultex=mysql_db_query($basedatos,$sSQLex);
$myrowex = mysql_fetch_array($resultex);
?>
  
  
    <div align="center"   style="color: #F17443">
                VALOR EXISTENCIAS <?php echo '$'.number_format($myrowex['costoActual'],2);?>
          </div>
  
  
            <div align="center"   style="color: #F17443">
                COSTO PROMEDIO <?php echo '$'.number_format($myrow['promedio'],2);?>
          </div>
  <br>
  <br>

</body>

</html>

