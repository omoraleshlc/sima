<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php");  ?>
<script language="JavaScript" type="text/javascript">
    /**
    * funcion demo del evento onclick en la tabla
    */
    function envia()
    {
      document.forms[0].submit();
    }
    /**
    * funcion de captura de pulsacion de tecla en Internet Explorer
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
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 


<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la cuenta de este paciente a admisiones? ya no podras hacer cargos, y la operacion es irreversible')) return true;
return false;
}
-->
</script>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>

</head>

<body>
<form id="form1" name="form1" method="post" >
  <h1 align="center" class="normalmid">
      Ordenes Enviadas</h1>
  <p align="center" class="normalmid">

    <label>Introduce el numero de Orden
    <input name="nOrden" type="text" id="folioVenta" size="10" />
    </label>


    <label>
    <input type="submit" name="buscar" id="buscar" value="Buscar" />
    </label>
</p>
 <?php

  if($_POST['nOrden']){   ?>
  <p align="center" class="normalmid"><?php print 'Orden: '. $_POST['nOrden'];?></p>
  <span class="normal"></span>


  <h1>
<?php
$sSQLa= "SELECT *
FROM
faltantesSub
WHERE
entidad='".$entidad."'
and
nOrden='".$_POST['nOrden']."'
";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa= mysql_fetch_array($resulta);
if($myrowa['nOrden']){
?>
      <div align="center"><span class="titulos">
<a href="#" onClick="javascript:ventanaSecundaria1('/sima/ADMINHOSPITALARIAS/inventarios/surtir.php?solicitud=<?php echo $_POST['nOrden']; ?>&usuario=<?php echo $myrowa['usuario'];?>&random=<?php echo $myrowa['random'];?>')">
Surtir faltantes
</a>
</span>
      </div>
  </h1>
  <?php } ?>

  <img src="/sima/imagenes/bordestablas/borde1.png" width="400" height="24" />
  <table width="400" border="0.2" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#330099">

              <th bgcolor="#FFFF00"  width="14" class="none" scope="col"><div align="left" class="none">
        <div align="left">#</div>
      </div></th>


      <th bgcolor="#FFFF00" width="20" class="none" scope="col"><div align="left" class="none">
        <div align="left">Usuario</div>
      </div></th>


 
      <th bgcolor="#FFFF00" width="200" class="none" scope="col"><div align="center" class="none">
        <div align="left">Hora</div>
      </div></th>


<th bgcolor="#FFFF00" class="none" scope="col"><div width="20" align="center" class="none">
        <div align="left">Fecha</div>
      </div></th>





              <th bgcolor="#FFFF00" class="none" scope="col"><div width="20" align="center" class="none">
        <div align="left">-----</div>
      </div></th>


    </tr>
    <tr>
<?php	
$sSQL= "SELECT *
FROM
faltantesSub
WHERE 
entidad='".$entidad."'
and

nOrden='".$_POST['nOrden']."'
group by random
";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$a+=1;



?>



 <td width="14" bgcolor="<?php echo $color?>"><span class="normal">

	  <?php echo $a  ?>
      </span></td>
        

      <td width="235" bgcolor="<?php echo $color?>" ><span class="normal">

	  <?php echo $myrow['usuario'];
	  
	  ?>
      </span></td>



              <td width="200" bgcolor="<?php echo $color?>" ><span class="normal">

	  <?php echo $myrow['hora1'];

	  ?>
      </span></td>


              <td width="235" bgcolor="<?php echo $color?>" ><span class="normal">

	  <?php echo cambia_a_normal($myrow['fecha1']);

	  ?>
      </span></td>






<td width="70" bgcolor="<?php echo $color?>" class="normal">
<div align="left">
<a href="#" onClick="javascript:ventanaSecundaria1('/sima/ADMINHOSPITALARIAS/inventarios/imprimirTraspaso.php?orden=<?php echo $_POST['nOrden']; ?>&usuario=<?php echo $myrow['usuario'];?>&random=<?php echo $myrow['random'];?>')">
Print
</a>
</div>
</td>

        


    </tr>
    <?php  }}}?>

  </table>
  <img src="/sima/imagenes/bordestablas/borde2.png" width="400" height="24" />
</form>
</body>
</html>
