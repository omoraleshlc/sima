<?php include("/configuracion/ventanasEmergentes.php"); ?>
<?php include("/configuracion/funciones.php"); 
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
                alert("Por Favor, escoje como quieres agregar artículos!")   
                return false   
        }            
}   
  
  
  
  
</script> 

<?php 
if($_POST['actualizar'] and $_POST['costo']){

$costo=$_POST['costo'];
$keyConvenios=$_POST['keyConvenios'];
for($i=0;$i<=$_POST['flag'];$i++){

 $sql="Update convenios
set
costo = '".$costo[$i]."', 
usuario='".$usuario."'
where keyConvenios='".$keyConvenios[$i]."'
";
mysql_db_query($basedatos,$sql);
echo mysql_error();

}
 $leyenda='Se actualizaron Registros...';
}
?>





<?php 

if(!$_POST['actualizar'] and $_POST['keyConvenios'] and $_POST['eliminar']){

$keyConvenios=$_POST['keyConvenios'];


for($i=0;$i<$_POST['flag'];$i++){

if($keyConvenios[$i]){
$borrame = "DELETE FROM convenios WHERE keyConvenios='".$keyConvenios[$i]."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();
}

}
echo "Se eliminaron convenios";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<style type="text/css">
<!--
.style14 {color: #000; font-size: 14px; font-weight: normal; }
.Estilo24 {font-size: 14px}
.style15 {color: #0000FF}
.style13 {color: #000}
.style73 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style75 {font-size: 14px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style76 {
	color: #000066;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center">
  <label></label><label>
  </label> 
<span class="style76">
Desplegar Cajas </span></p>
<form id="form2" name="form2" method="post" action="" >
    <p class="style15"><?php echo $leyenda; ?></p>
    <img src="../../imagenes/bordestablas/borde1.png" width="258" height="24" />
    <table width="258" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr bgcolor="#FFFF00">
        <th width="115" class="Estilo24" scope="col"><div align="left" class="style73"><span class="style11 style13">Usuario</span></div></th>
        <th width="133" class="Estilo24" scope="col"><div align="left" class="style73"><span class="style11 style13">Caja</span></div></th>
      </tr>
      <tr>
<?php	




 $sSQL= "SELECT 
 *
FROM
  usuariosCaja,catCajas
   WHERE 
   usuariosCaja.entidad='".$entidad."'
   and


usuariosCaja.usuario = '".$_GET['usuario']."'
and
usuariosCaja.codigoCaja=catCajas.codigoCaja

 ";
$result=mysql_db_query($basedatos,$sSQL);

while($myrow = mysql_fetch_array($result)){ 
$bandera+=1;






if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
?>
      <td height="24" bgcolor="<?php echo $color?>" class="Estilo24"><span class="style75">
          <label> 
          <?php 
	
		  echo $myrow['codigoCaja'];?>
		  </label>
        </span></td>
        <td bgcolor="<?php echo $color?>" class="Estilo24"><span class="style75">
                <?php 
					echo $myrow['descripcionCaja'];
		?>
        </span></td>
      </tr>
      <?php  
	  $bandera+='1';
	  }  //cierra while
	  ?>
  </table>
    <img src="../../imagenes/bordestablas/borde2.png" width="258" height="24" />
<p align="center"><em> 
	
	
	<?php if($bandera){ ?>Se encontraron <?php echo $bandera; ?> Registros <?php 
	}else{
	echo "No se encontraron registros..!";
	}
	?></em></p>





</form>
  <p></p>
  
  
</body>
</html>
