<?php require("menuOperaciones.php"); ?>
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
if (confirm('Estas seguro que deseas enviar la cuenta de este paciente a admisiones? ya no podras hacer cargos, y la operaci�n es irreversible')) return true;
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
  <h1 align="center" class="titulos">Recalcular Cuentas</h1>
    <h4 align="center" class="titulos">***La cuenta debe estar en revision..</h4>
  <p align="center" class="titulos">
    <label>Introduce el folio de Venta
    <input name="folioVenta" type="text" id="folioVenta" size="10" />
    </label>
    <label>
    <input type="submit" name="buscar" id="buscar" value="Buscar" />
    </label>
</p>
 <?php

  if($_POST['folioVenta']){   ?>
  <p align="center" class="titulos"><?php print 'Folio: '. $_POST['folioVenta'];?></p>
  <span class="style12"></span>
  <table width="598" border="0.2" align="center" cellpadding="4" cellspacing="0">
    <tr bgcolor="#FFFF00">

              <th class="normal" scope="col"><div align="left" class="normal">
        <div align="left">Fecha Apertura</div>
      </div></th>
      <th class="normal" scope="col"><div align="left" class="normal">
        <div align="left">Nombre del paciente</div>
      </div></th>
      <th class="normal" scope="col"><div align="left" class="normal">
        <div align="left">Seguro</div>
      </div></th>
      <th class="normal" scope="col"><div align="center" class="normal">
        <div align="left">Usuario</div>
      </div></th>
      <th class="normal" scope="col"><div align="center" class="normal">
        <div align="left"></div>
      </div></th>
    </tr>
    <tr>
<?php	
$sSQL= "SELECT *
FROM
clientesInternos 
WHERE 
entidad='".$entidad."'
and
folioVenta='".$_POST['folioVenta']."'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

";

$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result); 





if($myrow['folioVenta']!=NULL){




?>



         <td width="235" bgcolor="<?php echo $color?>" class="normal">

	  <?php echo cambia_a_normal($myrow['fecha']);

	  ?>
      </td>


      <td width="235" bgcolor="<?php echo $color?>" class="normal">
	  <a href="#" 
onclick="javascript:ventanaSecundaria2('../cargos/despliegaCargos.php?numeroE=<?php echo $myrow['numeroE']; ?>&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $ALMACEN; ?>&amp;almacenFuente=<?php echo $ALMACEN; ?>&amp;nT=<?php echo $nT; ?>&amp;tipoCliente=<?php echo $tipoCliente;?>&amp;tipoMovimiento=<?php echo 'cierreCuenta';?>&amp;tipoPaciente=interno&amp;folioVenta=<?php echo $myrow['folioVenta'];?>')">
    <?php echo $myrow['paciente'];
?></a>

      </td>
      <td width="205" bgcolor="<?php echo $color?>" class="normal"><?php 
	  if($myrow31cd['nomCliente']){
	  echo $myrow31cd['nomCliente'];
	  } else {
	  echo 'particular';
	  }
?></td>
      <td width="70" bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow['usuario'];?></td>
      <td width="70" bgcolor="<?php echo $color?>" class="normal"><div align="left">


<?php if($myrow['statusCuenta']=='revision'){ ?>
      <a href="#" onClick="javascript:ventanaSecundaria1('../ventanas/actualizaPagos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&folioVenta=<?php echo $myrow['folioVenta'];?>')">
        <img src="/sima/imagenes/btns/addbtn.png" alt="Pacientes Activos" width="22" height="22" border="0" />        </a>
        <?php } else { 
        
     echo  '<img src="/sima/imagenes/btns/lockbtn.png" alt="Pacientes Activos" width="22" height="22" border="0" />';
		
		}
		?>
		
      </div></td>
    </tr>
    <?php



    }}?>
      
   <?php 
   if($myrow['statusCuenta']!='revision' AND $myrow['folioVenta']!=NULL){
   echo '<div class="success">'.'La Cuenta esta en: '.$myrow['statusCuenta'];
   }
   ?>
      
      
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>
  <span class="style12"><span class="style7">
  <input name="nombrePaciente" type="hidden" id="nombrePaciente" value="<?php echo $nombrePaciente; ?>" />
  <input name="nombrePaciente2" type="hidden" id="nombrePaciente2" value="<?php echo $nombrePaciente; ?>"/>
  <input name="tipoSeguro" type="hidden" id="tipoSeguro" value="<?php echo $myrow['seguro']; ?>"/>
  </span></span>


  <div align="center">
     <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </div>

</form>
</body>
</html>