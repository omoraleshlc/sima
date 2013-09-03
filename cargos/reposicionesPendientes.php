<?php require("/configuracion/ventanasEmergentes.php");?>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=630,height=300,scrollbars=YES")
}
</script>
<SCRIPT LANGUAGE="JavaScript">
function checkIt(evt) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        status = "Este campo s�lo acepta n�meros."
        return false
    }
    status = ""
    return true
}
</SCRIPT>

<script language=javascript>
function ventanaSecundaria10 (URL){
   window.open(URL,"ventanaSecundaria10","width=600,height=900,scrollbars=YES")
}
</script>






<?php



if($_POST['solicitar'] ){ 

$keyPA=$_POST['keyPA'];
//GENERAR SOLICITUD




$sSQL8aa3= "
SELECT max(nOrden)+1 as n
FROM
solicitudesDepartamentos
WHERE
entidad='".$entidad."'
  ";
$result8aa3=mysql_db_query($basedatos,$sSQL8aa3);
$myrow8aa3 = mysql_fetch_array($result8aa3);
$n= $myrow8aa3['n']; 
if(!$n){
    $n=1;
}



$agrega = "INSERT INTO solicitudesDepartamentos (
usuario,almacen,entidad,fecha,hora,nOrden,status
) values (
'".$usuario."','".$_POST['almacenDestino']."','".$entidad."','".$fecha1."','".$hora1."'
    ,'".$n."','request'
)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();



$sSQL8aa= "
SELECT
*
FROM
articulosSolicitudes
WHERE
entidad='".$entidad."'
and
almacenDestino='".$_POST['almacenDestino']."'
and
usuario='".$_GET['usuario']."'
and
status='venta' 
";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
while($myrow8aa = mysql_fetch_array($result8aa)){
						
					
				
			
		
	


$sSQL= "Select * From 
existencias
where entidad='".$entidad."' AND codigo='".$myrow8aa['codigo']."' ";
$result=mysql_db_query($basedatos,$sSQL); 
$myrow = mysql_fetch_array($result);
    
if($myrow['ventaGranel']=='si')    {
    $tipoV='Granel';
}else{
    $tipoV='Normal';
}
    


$sSQLd= "Select * From 
almacenes
where entidad='".$entidad."' AND almacen='".$_POST['almacenDestino']."' ";
$resultd=mysql_db_query($basedatos,$sSQLd); 
$myrowd = mysql_fetch_array($resultd);


    
$agrega = "INSERT INTO movSolicitudes (
codigo,keyPA,gpoProducto,fecha,hora,usuario,entidad,cantidad,descripcion,tipoMov,
keyCAP,nOrden,almacen,tipoVenta,status,almacenPrincipal
)
values
(
'".$myrow8aa['codigo']."','".$myrow8aa['keyPA']."','".$myrow8aa['gpoProducto']."',
    '".$fecha1."','".$hora1."','".$usuario."',
        
'".$entidad."','".$myrow8aa['cantidad']."','".$myrow8aa['descripcion']."',
    'salida','".$myrow8aa['keyCAP']."','".$n."' ,'".$_POST['almacenDestino']."',
        '".$tipoV."','request','".$myrowd['almacenPadre']."'

)";
mysql_db_query($basedatos,$agrega);
echo mysql_error();


}


//$q1a = "UPDATE movSolicitudes set 
//nOrden='".$n."'
//
//
//WHERE 
//entidad='".$entidad."'
//and
//almacen='".$_POST['almacenDestino']."'
//and
//usuario='".$_GET['usuario']."'
//and
//status='request' 
//
//";
//mysql_db_query($basedatos,$q1a);
//echo mysql_error();




//NECESITO ACTUALIZAR A REQUEST ESTA TABLA PARA QUE YA NO SE PUEDA SOLICITAR
 $q1 = "UPDATE articulosSolicitudes set 
nOrden='".$n."',status='request'


WHERE 
entidad='".$entidad."'
and
almacenDestino='".$_POST['almacenDestino']."'
and
usuario='".$_GET['usuario']."'

";
mysql_db_query($basedatos,$q1);
echo mysql_error();




?>
<script>
window.alert("Se genero el numero de orden: <?php echo $n;?>");
//window.opener.document.forms["form1"].submit();
window.close();
</script>
<?php
//} validacion
}
?>









<script type="text/javascript">
<!--
function comprueba()
{
if (confirm('Estas seguro que deseas enviar la orden ?')) return true;
return false;
}
-->
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

<h1 align="center">Reposicion por Venta </h1>


<form id="form1" name="form1" method="post" action="">
  <p align="center">&nbsp;

  <table width="632" class="table table-striped">
        <tr >
      <th width="44" >#</th>
      <th width="43" >KeyPA</th>
      <th width="45"  >Cantidad</th>
      <th width="321" >Descripcion</th>
      <th width="105"  >gpoProducto</th>
      <th width="48"  >Usuario</th>
      <th width="48"  >Fecha</th>
       <th width="48"  >Hora</th>
    </tr>
    <tr>
<?php



$sSQL18= "
SELECT
*
FROM
articulosSolicitudes
WHERE
entidad='".$entidad."'
and
almacenDestino='".$_GET['almacen']."'
    and
status='venta' 

order by descripcion ASC";
$result18=mysql_db_query($basedatos,$sSQL18);
while($myrow18 = mysql_fetch_array($result18)){


$b+=1;
$a+=1;

//*********************************************************************************************************



?>


    <tr bgcolor="#ffffff" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >
      <td height="24" bgcolor="<?php echo $color?>" class="normal"><?php echo $a;?></td>
      <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow18['keyPA'];?></td>
      
      
            <td bgcolor="<?php echo $color?>" class="normal">
        <?php
echo $myrow18['cantidad'];

	 
		?>
       </td>
      
      
      <td bgcolor="<?php echo $color?>" class="normal">
        <?php
					echo $myrow18['descripcion'];
                                        
		?>

      </td>
      
      
      
      <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow18['descripcionGrupoProducto'];?></td>

      <td bgcolor="<?php echo $color?>" class="normal">
        <label>
       
             <?php echo $myrow18['keyCAP'];?>
        </label>
          
    </td>

    
          <td bgcolor="<?php echo $color?>" class="normal">
        <label>
       
             <?php echo $myrow18['usuario'];?>
        </label>
          
    </td>
    
              <td bgcolor="<?php echo $color?>" class="normal">
        <label>
       
             <?php echo cambia_a_normal($myrow18['fecha']);?>
        </label>
          
    </td>
    
    
    
    
    
              <td bgcolor="<?php echo $color?>" class="normal">
        <label>
       
             <?php echo $myrow18['hora'];?>
        </label>
          
    </td>
       
    </tr>
    
    
    
    
    <?php  } //cierra while ?>
  </table>
  
  
  
  
  
  <div align="center" class="normal"><strong>
<?php if($a){
	echo "Vendiste $a articulos..!!";
	}else {
	echo "No hay Registros..!!";
	}
	?></strong></div>


    <?php if($_POST['almacenDestino']!=NULL){ ?>
  <p align="center">
    <label>
    <input name="solicitar" type="submit"  id="solicitar"     <?php
    if($_GET['usuario']!=$usuario){
	  echo 'disabled="disabled"';
          $valor='Solo el usuario: '.$_GET['usuario'].' puede enviar reposicion!';
          $clase='error';
	  }else{
              $valor='Enviar/Solicitar';$clase='normal';
          }

          ?> value="<?php echo $valor;?>" class="<?php echo $clase;?>" />
    </label>
    <label></label>
    <span class="style7">
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $a; ?>" />
  </span></p>
    <?php } ?>



  <p align="center">
    <label></label>
  </p>

</form>
<br>
<br>

</body>
</html>