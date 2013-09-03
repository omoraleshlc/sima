<?php require("/configuracion/ventanasEmergentes.php");?>


<script language=javascript> 
function ventanaSecundaria111 (URL){ 
   window.open(URL,"ventanaSecundaria111","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventanaSecundaria7","width=850,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

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
function ventanaSecundaria (URL){ 
   window.open(URL,"ventanaSecundaria","width=800,height=800,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=1024,height=1000,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 



<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventanaSecundaria20","width=500,height=240,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>



<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro de enviar a caja?')) return true;
return false;
}
-->
</script>


<script type="text/javascript">
<!--
function comprueba1()
{
if (confirm('Estas seguro(a) de empezar con la revision de la cuenta? ya no podras hacer cargos..')) return true;
return false;
}
-->
</script>

<!--script language=javascript>
var wid = "800";
var hei = "900";
if (document.all) {
var wid = document.body.clientWidth;
var hei = document.body.clientHeight;
}
else if (document.layers) {
var wid = window.innerWidth;
var hei = window.innerHeight;
}
alert(wid);
alert(hei);
var popwid = "400";
var pophei = "450";
var leftPos = (wid-popwid)/2;
var topPos = (hei-pophei)/2;

window.open('popup','width=' + popwid + ',height='+pophei+',top='+topPos+',left='+leftPos);
</script-->

<?php $bali='HURG';?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">

<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
        

        
    </head>

 


<form id="form1" name="form1" method="post" action="#">

  
  
  
    <h1 align="center" >
      <a href="javascript:ventanaSecundaria20('../ventanas/pacientesActivos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&usuario=<?php echo $usuario; ?>#trans<?php echo $guia;?>')" name="trans<?php echo $guia;?>"  onClick="if(confirm('Estas seguro que deseas transferir la cuenta?') == false){return false;}">
      Lista de Pacientes Activos
      </a>      
  </h1>
    <h5 align="center" >*Utilice el teclado para desplazarse hacia abajo...</h5>
  <table width="500" class="table table-striped">

	
    <tr>
      <th width="20"  align="center">Exp</th>
      <th width="20"  align="center">Folio</th>
      <th width="194" >Paciente</th>
      <th width="156" >Departamento</th>
      <th width="30" >status</th>
      <th width="30" >Transfer</th>
    </tr>
	
	<?php	

$sSQL= "SELECT *
FROM
clientesInternos 
WHERE entidad='".$entidad."' 
and
status='activa'
and
(tipoPaciente='interno' or tipoPaciente='urgencias')

ORDER BY keyClientesInternos ASC
 ";

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$guia+=1;
$sSQL31= "SELECT status FROM
clientesInternos
WHERE 
keyClientesInternos='".$myrow['keyClientesInternos']."'";
$result31=mysql_db_query($basedatos,$sSQL31);
$myrow31 = mysql_fetch_array($result31);

$sSQL31s= "SELECT nomCliente FROM
clientes
WHERE 
entidad='".$entidad."'
    and
numCliente='".$myrow['seguro']."'";
$result31s=mysql_db_query($basedatos,$sSQL31s);
$myrow31s = mysql_fetch_array($result31s);


$sSQL1s= "SELECT * FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$myrow['almacen']."'";
$result1s=mysql_db_query($basedatos,$sSQL1s);
$myrow1s = mysql_fetch_array($result1s);
?>
    
    

    
    <tr valign="top"  >
      <td height="44" align="center">
	    <p >
	      <?php 
if($myrow['expediente']=='si'){
echo $myrow['numeroE'];
}else{
echo  'Sin Exp';
 
}
?>
	      <br />
<span  title="Impresion de la hoja de admision">
<a href="javascript:ventanaSecundaria7('../ventanas/impresionInternamiento.php?campoDespliega=<?php echo "campoDespliega"; ?>&forma=<?php echo "form1"; ?>&campoCuarto=<?php echo "cuarto"; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&entidad=<?php print $entidad;?>')">
    H de Adm
</a>
</span>
            </p>
      </td>
      
      
      
      
<td  align="center" title="Estado de cuenta el paciente">
<a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php 

echo $myrow['folioVenta'];

?></a>
</td>



    <td  align="center" >
<a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php 

echo $myrow['paciente'];

?></a>
</td>     
        

<td  align="center" title="Estado de cuenta el paciente">
<a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php 

echo $myrow1s['descripcion'];

?></a>
</td>




<td  align="center" >
<a href="#lista<?php echo $guia;?>" name="lista<?php echo $guia;?>" onClick="javascript:ventanaSecundaria2('/sima/cargos/estadoCuenta.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&nT=<?php echo $myrow['keyClientesInternos']; ?>&tipoPaciente=<?php echo "interno"; ?>&folioVenta=<?php echo $myrow['folioVenta'];?>')"><?php 

echo $myrow['statusCuenta'];

?></a>
</td>

      
      <td align="center" >
	  <?php 
if($myrow['expediente']=='si' and $myrow['numeroE']){ ?>

<?php if($myrow['statusCuenta']=='abierta'){ ?> 
 <a href="javascript:ventanaSecundaria20('../ventanas/departamentoTransferencia.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&usuario=<?php echo $usuario; ?>#trans<?php echo $guia;?>')" name="trans<?php echo $guia;?>"  onClick="if(confirm('Estas seguro que deseas transferir la cuenta?') == false){return false;}">

Transferir
</a>
<?php 
}
}else{
echo '---';

}
?>



	  </td >
          
          
          
          

              
          

              
              
<?php  }}?>
	 

    </tr> 
  </table>



</form>
</body>
</html>