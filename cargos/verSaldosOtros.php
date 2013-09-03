<?PHP include("/configuracion/ventanasEmergentes.php"); require('/configuracion/funciones.php');?>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES") 
} 
</script> 
<?php


if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}





if($_POST['solicita'] and $_POST['agregar'] and !$_POST['quitar']){
$keyClientesInternos=$_POST['agregar'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL21= "Select pagoFactura From clientesInternos WHERE keyClientesInternos = '".$keyClientesInternos[$i]."' ";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);

if($keyClientesInternos[$i] AND $myrow21['pagoFactura']==''){
 $q = "UPDATE clientesInternos set 
pagoFactura='request'
WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
}
}



if(!$_POST['solicita'] and $_POST['quitare'] and $_POST['quitar']){
$keyClientesInternos=$_POST['quitar'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL21= "Select pagoFactura From clientesInternos WHERE keyClientesInternos = '".$keyClientesInternos[$i]."' ";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);

if($keyClientesInternos[$i] AND $myrow21['pagoFactura']=='request'){
 $q = "UPDATE clientesInternos set 
pagoFactura=''
WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
}
}



if($_POST['aplicarPago']  and $_POST['registrosActivados']){
$keyClientesInternos=$_POST['registrosActivados'];

for($i=0;$i<=$_POST['bandera'];$i++){
$sSQL21= "Select pagoFactura From clientesInternos WHERE keyClientesInternos = '".$keyClientesInternos[$i]."' ";
$result21=mysql_db_query($basedatos,$sSQL21);
$myrow21 = mysql_fetch_array($result21);

if($keyClientesInternos[$i] AND $myrow21['pagoFactura']=='request'){
$q = "UPDATE clientesInternos set 
pagoFactura='pagado'
WHERE keyClientesInternos='".$keyClientesInternos[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}
}
echo '<script language="JavaScript" type="text/javascript">
  <!--
window.opener.document.forms["form1"].submit();
self.close();
  // -->
</script>';
}
?>

<script language="javascript" type="text/javascript">

var win = null;
function nueva1(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>

<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje un médico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje algún tipo de seguro, o también si es particular!")   
                return false   
        }            
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
</head>

<body>

 <h1 align="center">Estado de Cuenta &quot;Otros&quot;  <?php echo $myrow24['nomCliente'];?></h1>
 <p>
   <?php   
$sSQL= "Select * from clientesInternos where entidad='".$entidad."' 
and
folioVenta='".$_GET['folioVenta']."' ";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);
?>
</p>
 <form id="form2" name="form2" method="post" action="">
 <div align="center"><img src="/sima/imagenes/bordestablas/borde1.png" width="510" height="24" />
   <table width="510" border="0.2" align="center" cellpadding="3" cellspacing="0">
     <tr>
      <th width="25" bgcolor="#FFFF00" class="none" scope="col"><div align="center">#</div></th>
      <th width= "50" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Mov.</div></th>
      <th width= "56" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Fecha.</div></th>
      <th width= "31" bgcolor="#FFFF00" class="none" scope="col"><div align="center">C</div></th>
      <th width= "204" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Descripcion</div></th>
      <th width= "33" bgcolor="#FFFF00" class="none" scope="col"><div align="center">N</div></th>
      <th width= "69" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Cargos</div></th>
	  </tr>
    <tr>
	
	<?php	





$sSQL= "SELECT *
FROM
cargosCuentaPaciente
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
gpoProducto=''
and
naturaleza='A'

";
 

 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}




?>
	
      <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php print $a;?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php
	echo $myrow['keyCAP'];
	   ?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php
	echo cambia_a_normal($myrow['fecha1']);
	   ?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php
	echo $myrow['cantidad'];
	   ?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php

	   echo $myrow['descripcionArticulo'];
	 
	
	


	   ?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php
echo $myrow['naturaleza'];

?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php
echo '$'.number_format(($myrow['cantidadParticular']*$myrow['cantidad'])+($myrow['ivaParticular']*$myrow['cantidad']),2);

?></td>
      </tr>
    <tr>



    <?php  }}?>

      <td height="24" bgcolor="<?php echo $color?>" class="codigos">&nbsp;</td>
      <td width="50" bgcolor="<?php echo $color?>" class="normal">&nbsp;</td>
      <td width="56" bgcolor="<?php echo $color?>" class="normal">&nbsp;</td>
      <td width="31" bgcolor="<?php echo $color?>" class="normal"><div align="center"></div></td>
      <td width="204" bgcolor="<?php echo $color?>" class="normal">Total Cargos </td>

      <td width="33" bgcolor="<?php echo $color?>" class="normal"><div align="center"></div></td>
      <td width="69" bgcolor="<?php echo $color?>" class="normal"><div align="center"></div></td>
</tr> 




    <input name="menu" type="hidden" value="<?php echo $menu;?>" />
</table>
   <img src="/sima/imagenes/bordestablas/borde2.png" width="510" height="24" />
   </p>	
	
	
	
	
	
	
	
	
	
	
	
	
	
    <p>&nbsp;</p>
    <img src="/sima/imagenes/bordestablas/borde1.png" width="600" height="24" />
    <table width="600" border="0.2" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <th width="36" bgcolor="#FFFF00" class="none" scope="col"><div align="center">#</div></th>
        <th width= "66" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Mov.</div></th>
        <th width= "66" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Fecha.</div></th>
        <th width= "17" bgcolor="#FFFF00" class="none" scope="col"><div align="center">C</div></th>
        <th width= "389" bgcolor="#FFFF00" class="none" scope="col"><div align="center">Descripcion</div></th>
        <th width= "25" bgcolor="#FFFF00" class="none" scope="col"><div align="center">N</div></th>
        <th bgcolor="#FFFF00" class="none" scope="col"><div align="center">Abonos</div></th>
      </tr>


      <tr>
	          <?php	





$sSQL= "SELECT *
FROM
movimientos
where
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'
and
naturaleza='A'

";
 

 
 

if($result=mysql_db_query($basedatos,$sSQL)){
while($myrow = mysql_fetch_array($result)){ 
$numeroE=$myrow['numeroE'];
$nCuenta=$myrow['nCuenta'];
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$a+=1;
$nT=$myrow['keyClientesInternos'];
if($myrow['naturaleza']=='A'){
$signo='-';
}else{
$signo=NULL;
}




?>
	  
        <td height="24" bgcolor="<?php echo $color?>" class="codigos"><?php print $a;?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php
	echo $myrow['keyCAP'];
	   ?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php
	echo cambia_a_normal($myrow['fecha1']);
	   ?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php
	echo $myrow['cantidad'];
	   ?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php

	   echo $myrow['descripcionArticulo'];
	 
	
	


	   ?></td>
        <td bgcolor="<?php echo $color?>" class="normal"><?php
echo $myrow['naturaleza'];

?></td>
        <td bgcolor="<?php echo $color?>" class="normal">
<?php
echo '$'.number_format($myrow['precioVenta']*$myrow['cantidad'],2);
?></td>
      </tr>
      <tr>

      <?php  }}?>
        <td height="24" bgcolor="<?php echo $color?>" class="codigos">&nbsp;</td>
        <td width="66" bgcolor="<?php echo $color?>" class="normal">&nbsp;</td>
        <td width="66" bgcolor="<?php echo $color?>" class="normal">&nbsp;</td>
        <td width="17" bgcolor="<?php echo $color?>" class="normal"><div align="center"></div></td>
        <td width="389" bgcolor="<?php echo $color?>" class="normal">Total Abonos </td>
        <td width="25" bgcolor="<?php echo $color?>" class="normal"><div align="center"></div></td>
        <td width="105" bgcolor="<?php echo $color?>" class="normal"><div align="center"></div></td>
      </tr>

      <input name="menu2" type="hidden" value="<?php echo $menu;?>" />
    </table>
    <img src="/sima/imagenes/bordestablas/borde2.png" width="600" height="24" />
<p>&nbsp;</p>
 </div>
  
  
  
  
  
  
</form>
 <p align="center">&nbsp;</p>
</body>
</html>