<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>
 



  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  


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
<style type="text/css">
.Estilo1 {
	color: #FF0000;
	font-weight: bold;
	font-size: 9px;
}
<!--
-->
</style>

</head>






 <form id="form1" name="form1" method="post" action="#">
  <h1 align="center"><?php echo $titulo;?></h1>


  <p align="center">
  SURTIR A ALMACENES
  </p>

  
    <p align="center" class="titulo">
    <span class="negromid">Escoge la Fecha </span>
      <input onChange="this.form.submit();" name="fechaInicial" type="text" class="normal" id="campo_fecha" size="10" maxlength="10" readonly=""
		value="<?php
                if(!$_POST['fechaInicial']){
		 echo $fecha1;
                }else{
                    echo $_POST['fechaInicial'];
                }
		 ?>"/>
    </label>
    <input name="button" type="button" class="normal" id="lanzador" value="..." />
</p>
  
  
  <table width="400" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td colspan="6"><img src="/sima/imagenes/bordestablas/borde1.png" width="400" height="21" /></td>
    </tr>
    

    
    <tr bgcolor="#FFFF00">
        
        
        
      <td width="10" class="negromid">#Sol</td>

      <td width="50" class="negromid">Procedencia</td>
      <td width="20" class="negromid">Usuario</td>

        <td width="20" class="negromid">Fecha/Hora</td>
        <td width="20" class="negromid">Cargar</td>
        <td width="20" class="negromid">Status</td>
        <td width="20" class="negromid">Print</td>
    </tr>
<?php

if(!$_POST['fechaInicial']){
    $_POST['fechaInicial']=$fecha1;
}

$sSQL= "
SELECT *
FROM
solicitudesDepartamentos
where

entidad='".$entidad."'
and
fecha='".$_POST['fechaInicial']."'
and
nOrden>0

";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){


$fV[0]=$myrow['folioVenta'];
$sSQL8aa= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
    and

 almacen='".$myrow['almacen']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);


?>

	  <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      <td height="48" class="codigos"><?php echo $myrow['nOrden'];?></td>
      <td class="normalmid">
          <span class="normal">
 
        <?php
if($myrow8aa['descripcion']!=NULL){
		echo $myrow8aa['descripcion'];
}else{
    echo '---';
}
		?>
     </span></td>



      <td class="normal"><?php echo $myrow['usuario'];?></td>
     
      
      <td class="normal"><?php
     echo cambia_a_normal($myrow['fecha']);
     echo '</br>';
     echo $myrow['hora'];
     ?>
     </td>
     
     
     
     
     <td class="normal">
         <?php if( $myrow['status']){?>
         <a href="#"  onclick="javascript:ventanaSecundaria('surtir.php?solicitud=<?php echo $myrow['keySAL'];?>&almacenSolicitante=<?php echo $myrow['almacen'];?>&usuario=<?php echo $myrow['usuario'];?>&nOrden=<?php echo $myrow['nOrden'];?>')">
         Cargar
         </a>
         <?php }else{echo '---';}?>
     </td>
     
     
       <td class="normal"><?php echo $myrow['status'];?></td>     
      
 <td class="normal">
 <a href="javascript:ventanaSecundaria('printTraspasos.php?nOrden=<?php echo $myrow['nOrden'];?>&departamentoSolicitante=<?php echo $myrow8aa['descripcion'];?>&entidad=<?php echo $entidad;?>&random=<?php echo $rand; ?>&usuarioCargo=<?php echo $usuario;?>&usuarioSolicitante=<?php echo $myrow['usuario'];?>&fecha=<?php echo $fecha1;?>&hora=<?php echo $hora1;?>&fechaSolicitud=<?php echo $myrow['fecha'];?>&horaSolicitud=<?php echo $myrow['hora'];?>','ventana7','800','600','yes');" />
 <img src="/sima/ic/pdf.png" width="30" height="30" />
 </a>
 </td>
      
      

 
 
    </tr>
    <?php  }?>
    <tr>
      <td colspan="6"><img src="/sima/imagenes/bordestablas/borde2.png" width="400" height="20" /></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p align="center"><span class="style7">

  </span></p>
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
