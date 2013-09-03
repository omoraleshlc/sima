<?PHP require("/configuracion/ventanasEmergentes.php");  require("/configuracion/funciones.php"); ?>


<script language=javascript>
function ventanaSecundaria8 (URL){
   window.open(URL,"ventana8","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>



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




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilos();
$estilo->styles();
?>
</head>



 <?php require("/configuracion/componentes/comboAlmacen.php");  ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Detalles por Pacientes Venta a Granel</h1>
   <h3 align="center"><?php echo $_GET['descripcion'];?></h3>
    <h5 align="center">
        
           <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>  
        
    </h5>
  <div align="center">

      <?php //echo 'Usuario Solicitante: '.$_GET['usuario'];?>

  </div>


  <table width="700" border="0.2" align="center" cellpadding="4" cellspacing="0">
        <tr bgcolor="#FFFF00">
  <th width="5" class="negromid">#</th>            
      <th width="5" class="negromid">Folio</th>

      <th width="171" class="negromid" align="left">Paciente</th>
      <th class="negromid" align="left">Cantidad</th>
      <th  class="negromid" align="left">Fecha</th>
      <th  class="negromid" align="left">Hora</th>
      <th  class="negromid" align="left">Usuario</th>
            <th  class="negromid" align="left">horaRep</th>
               <th  class="negromid" align="left">fechaRep</th>
    </tr>
    <tr>


<?php


$sSQL= "SELECT *
FROM

movSolicitudes
where
entidad='".$entidad."'
and
almacen='".$_GET['almacen']."'
and    
keyPA='".$_GET['keyPA']."'
    and
    tipoVenta='Granel'
and
status='request'
";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;






            $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
 codigo='".$myrow['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);




$sSQL8ad= "
SELECT * 
FROM
cargosCuentaPaciente
WHERE
keyCAP='".$myrow['keyCAP']."'
";
$result8ad=mysql_db_query($basedatos,$sSQL8ad);
$myrow8ad = mysql_fetch_array($result8ad);

 $sSQLf= "
SELECT *
FROM
clientesInternos
WHERE 
entidad='".$entidad."'
    and
folioVenta='".$myrow8ad['folioVenta']."'
";
$resultf=mysql_db_query($basedatos,$sSQLf);
$myrowf = mysql_fetch_array($resultf);


 $sSQL12= "
SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$myrow['almacen']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>




<tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >

<td height="24" bgcolor="<?php echo $color?>" class="normal">
<?php
echo $a;
?>
</td>    
    
<td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow8ad['folioVenta'];?></td>





<td height="24" bgcolor="<?php echo $color?>" class="normal">
<?php
echo $myrowf['paciente'];
?>
</td>
                
                
 <td width="79" bgcolor="<?php echo $color?>" class="normal">                
<?php 
echo $myrow8ad['cantidad'];
$totalCantidad[0]+=$myrow8ad['cantidad'];
?>     
     
</td>             
                
                
                
                
       <td width="79" bgcolor="<?php echo $color?>" class="normal">
<?php 
echo cambia_a_normal($myrow8ad['fechaCargo']);
?>
</td>
	  
          
                  
                  
<td width="70" bgcolor="<?php echo $color?>" class="normal">
<?php 
echo $myrow8ad['horaCargo'];
?>
</td>




<td width="50" bgcolor="<?php echo $color?>" class="normal">
<?php 
echo $myrow8ad['usuarioCargo'];
?>
</td>

          

          
          
          

<td width="52" bgcolor="<?php echo $color?>" class="normal"<td width="50" bgcolor="<?php echo $color?>" class="normal">
<?php 
echo $myrow['hora'];
?>
</td>




<td width="52" bgcolor="<?php echo $color?>" class="normal"<td width="50" bgcolor="<?php echo $color?>" class="normal">
<?php 
echo cambia_a_normal($myrow['fecha']);
?>
</td>

















          



                  
                  
                  
                  
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>

<p>&nbsp;</p>
  <p>&nbsp; </p>

  <label>
      <br><?php //echo $trigger[0];?>
          
         
          
          </br>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
</form>
    
    
  <div align="center">
Total pendiente: <?php echo $totalCantidad[0];?>
  </div>    
    
</body>
</html>