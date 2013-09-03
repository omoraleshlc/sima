<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require("/configuracion/funciones.php"); 
$numCliente=$_GET['numCliente'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
?>

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
           
        if( vacio(F.escoje.value) == null ) {   
                alert("Por Favor, escoje como quieres agregar art�culos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 




if($_POST['actualizar']){

$keyConvenios=$_POST['keyConvenios'];

		for($i=0;$i<=$_POST['bandera'];$i++){





if( $keyConvenios[$i]){

$sql="Update convenios
set
fechaFinal='".$_POST['fechaFinal']."',
fechaModificacion='".$fecha1."',

usuario='".$usuario."'
where 
keyConvenios='".$keyConvenios[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();
$leyenda='Registro Actualizado';
}
} ?>
<script>
window.opener.document.forms["form2"].submit();
window.close();
</script>
<?php 
}
?>








 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
<span >
<?php  
$sSQL23= "Select * From clientes WHERE numCliente ='".$numCliente."'";
$result23=mysql_db_query($basedatos,$sSQL23);
$rNombre23 = mysql_fetch_array($result23); 
echo $nombreSeguro=$rNombre23['nomCliente'];

?></span></p>
<p align="center"><span ><?php echo $leyenda; ?></span></p>
<form id="form2" name="form2" method="post" action="" >
<table width="203" class="table-forma" >
  <tr >
    <td scope="col">&nbsp;</td>
    <td width="71"><div align="left" >Fecha Final </div></td>
    <td width="116"><label>
      <input name="fechaFinal" type="text"  id="campo_fecha1" size="10" maxlength="9" readonly=""
		  value="<?php
		 if(!$_POST['fechaFinal']){
		 echo $fecha1;
		 }
		 ?>"/>
    </label>
      <input name="button1" type="button"  id="lanzador1" value="..." /></td>
  </tr>

</table>

<p>&nbsp;</p>

<table width="657" class="table table-striped">
      <tr>
        <th width="206"   scope="col"><div align="left"><span >Deprtamento</span></div></th>
        <th width="259"   scope="col"><div align="left"><span >Servicio</span></div></th>
        <th width="86"   scope="col"><div align="left"><span >Fecha Inicial </span></div></th>
        <th width="82"   scope="col"><span >Fecha Final</span></th>
      </tr>
      <tr>
<?php	
$sSQL= "SELECT 
* from convenios 
where
entidad='".$entidad."'
and
numCliente='".$_GET['numCliente']."'
and
fechaFinal<='".$fecha1."'
and
departamento!=''
order by 
departamento ASC
 ";
$result=mysql_db_query($basedatos,$sSQL);


while($myrow = mysql_fetch_array($result)){ 



if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}

$gpoProducto=$myrow['grupo'];

$sSQL39= "
	SELECT 
prefijo
FROM
gpoProductos
WHERE codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

$sSQL3= "
	SELECT 
codigo,costo,keyConvenios,fechaInicial,fechaFinal
FROM
convenios
WHERE 
numCliente='".$_GET['numCliente']."'
and
departamento='".$_POST['almacenDestino1']."'
and
entidad='".$entidad."'
and
codigo='".$myrow['codigo1']."'";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);


$sSQL34= "
	SELECT 
nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 

entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino1']."'
and
codigo='".$myrow['codigo1']."'";
$result34=mysql_db_query($basedatos,$sSQL34);
$myrow34 = mysql_fetch_array($result34);



$sSQL34a= "
	SELECT 
descripcion,codigo,keyPA
FROM
articulos
WHERE 

entidad='".$entidad."'
and
keyPA='".$myrow['keyPA']."' or codigo='".$myrow['codigo']."'";
$result34a=mysql_db_query($basedatos,$sSQL34a);
$myrow34a = mysql_fetch_array($result34a);



$sSQL34b= "
	SELECT 
descripcion
FROM
almacenes
WHERE 

entidad='".$entidad."'
and
almacen='".$myrow['departamento']."'";
$result34b=mysql_db_query($basedatos,$sSQL34b);
$myrow34b = mysql_fetch_array($result34b);
?>
        <td height="24" bgcolor="<?php echo $color?>" ><span ><?php 
		if($myrow34b['descripcion']){
		echo $myrow34b['descripcion'];
		}else{
		echo 'Ya no existe';
		}
		?>
          <input name="keyConvenios[]" type="hidden" id="keyConvenios[]"  value="<?php echo $myrow['keyConvenios']; ?>" />
        </span></td>
        <td bgcolor="<?php echo $color?>" ><span >
          <?php 
				
					echo $myrow34a['descripcion'];
		?>
        </span></td>
        <td bgcolor="<?php echo $color?>" >
          <?php 
	
		echo cambia_a_normal($myrow['fechaInicial']);
         
		  ?>       </td>
        <td bgcolor="<?php echo $color?>" >
          <?php 
	
		echo cambia_a_normal($myrow['fechaFinal']);
         
		  ?>     </td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while?>
  </table>

  <p align="center"><em> <?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php }
	else {
	echo "No se encontraron registros..!";
	}
	?></em><span >
    <input name="bandera" type="hidden" id="bandera"  value="<?php echo $bandera; ?>" />
  </span></p>
<p align="center">
      <label>
      <?php if($bandera>0){ ?>
      <input name="actualizar" type="submit" id="actualiza" value="Actualizar T" />
      <?php } ?>
      </label>
    </p>


    </form>
  <p></p>
  

</body>
 
 <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha1",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
}); 
    </script> 
	
</html>
