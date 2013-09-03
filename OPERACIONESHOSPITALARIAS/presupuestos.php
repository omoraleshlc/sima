<?php require("/var/www/html/sima/OPERACIONESHOSPITALARIAS/menuOperaciones.php"); 

$articulo = $_GET['nomArticulo']; ?>

<?php  
if($_GET['codigo'] AND ($_GET['inactiva'] or $_GET['activa'])){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE articulos set 

		activo='I'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	} else if($_GET['activa']=="activa"){
 $q = "UPDATE articulos set 

		activo='A'
		WHERE keyPA='".$_GET['keyPA']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}



}
?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=350,height=189,scrollbars=YES") 
} 
</script>
 
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=660,height=800,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=450,height=170,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=450,height=170,scrollbars=YES") 
} 
</script> 
<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['actualizar']){
$keyPA=$_POST['keyPA'];
$gpoProducto=$_POST['gpoProducto1'];
$aseguradora=$_POST['aseguradora'];
$particular=$_POST['particular'];
$descripcion=$_POST['descripcion'];
$almacen=$_POST['almacen'];


for($i=0;$i<=$_POST['bandera'];$i++){
if($keyPA[$i]!=NULL){
$q1 = "UPDATE articulos set 
descripcion='".$descripcion[$i]."',
gpoProducto='".$gpoProducto[$i]."',

fechaActualizacion='".$fecha1."',

hora='".$hora1."'


WHERE keyPA='".$keyPA[$i]."'";
mysql_db_query($basedatos,$q1);
echo mysql_error();

 $q2 = "UPDATE articulosPrecioNivel set 

nivel1='".$particular[$i]."',
nivel3='".$aseguradora[$i]."',
almacen='".$almacen[$i]."'

WHERE entidad='".$entidad."' and  keyPA='".$keyPA[$i]."' 
and
almacen='".$_POST['almacenDestino1']."'
";
mysql_db_query($basedatos,$q2);
echo mysql_error();

 $q3 = "UPDATE existencias set 

descripcion='".$descripcion[$i]."',
almacen='".$almacen[$i]."'


WHERE 

entidad='".$entidad."' and  keyPA='".$keyPA[$i]."' 
and
almacen='".$_POST['almacenDestino1']."'
";
mysql_db_query($basedatos,$q3);
echo mysql_error();
}
}
echo 'Se hicieron cambios en el sistema...';

}
?>










<?php 
$fecha1=date("Y-m-d");
$hora1= date("H:i a");

if($_POST['delete']){
$keyPA=$_POST['keyPA1'];

for($i=0;$i<=$_POST['bandera'];$i++){
if($keyPA[$i]){


 $q3 = "DELETE FROM existencias where entidad='".$entidad."' and almacen='".$_POST['almacenDestino1']."' and keyPA='".$keyPA[$i]."' ";
mysql_db_query($basedatos,$q3);
echo mysql_error();

$q4 = "DELETE FROM articulosPrecioNivel where entidad='".$entidad."' and almacen='".$_POST['almacenDestino1']."' and keyPA='".$keyPA[$i]."' ";
mysql_db_query($basedatos,$q4);
echo mysql_error();


}
}
echo 'Se eliminaron cambios en el sistema...';

}
?>






<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilos= new muestraEstilos();
$estilos-> styles();

?>
</head>

<body>
<h1 align="center" class="titulos">Listado por GPO </h1>





<form id="form1" name="form1" method="post" action="">
<div id="contener2">
  <div  >Almac&eacute;n Principal
        <?php 
	  $aCombo= "Select * From almacenes where ventas='si' and entidad='".$entidad."' AND
activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="almacenDestino"  id="almacenDestino" onChange="javascript:this.form.submit();"/>
  
          <option value="">---</option>
          <option value="">TODOS</option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
          <option 
		<?php 
		if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
          <?php } ?>
          </select>
      </div>	
	<br />
	
    <div >Mini Almac&eacute;n 
          <?php 
  $aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
activo='A' and almacenPadre='".$_POST['almacenDestino']."' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
          <select name="almacenDestino1"  id="almacenDestino1" onChange="javascript:this.form.submit();"/>
         
          <?php  
					
$sSQL1= "Select * From almacenes WHERE entidad='".$entidad."' AND almacen = '".$_POST['almacenDestino']."' order by descripcion ASC ";
$result1=mysql_db_query($basedatos,$sSQL1);
$myrow1 = mysql_fetch_array($result1); ?>
          <option value="<?php echo $_POST['almacenDestino'];?>"><?php echo $myrow1['descripcion'];?></option>
          <?php while($resCombo = mysql_fetch_array($rCombo)){ ?>
          <option 

		
		<?php 
		 if($_POST['almacenDestino1'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
          <?php } ?>
          </select>
      </div>
	
	
	
	<br />
	
    <div > Grupo de Producto </span>
          
            <label>
            <?php //*********gpoProductos

	  
 $sSQL7= "Select distinct * From gpoProductos where entidad='".$entidad."' AND activo ='activo' 
 
 ORDER BY descripcionGP ASC ";
$result7=mysql_db_query($basedatos,$sSQL7); 
echo mysql_error();
	  ?>
            <select name="gpoProducto"  id="select" >
              <option value="*">Todos</option>
              <?php  	 		 
		   while($myrow7 = mysql_fetch_array($result7)){ ?>
              <option 
		    <?php 		if($_POST['gpoProducto']==$myrow7['codigoGP'])echo 'selected'; ?>
		   value="<?php echo $myrow7['codigoGP']; ?>"><?php echo $myrow7['descripcionGP']." - ".$myrow7['codigoGP']; ?></option>
              <?php } 
		
		?>
            </select>
            </label>
            </span>
			
        </div>
        <br />
        <div align="center"><span >
          <input name="buscar" type="submit" src="/sima/imagenes/btns/searcharticles.png" id="buscar" value="buscar" />
      </span></div>
  
  
 </div> 
  

<p>&nbsp;</p>

  
  
  
  
  
  <table class="table table-striped" >
    <tr >
  
        
        <th width="4" scope="col"><div align="left" >#</div></th>
      <th width="324" scope="col"><div align="left" >Descripcion</div></th>


      <th width="61" scope="col"><div align="left" >P Part</div></th>
      <th width="63" scope="col"><div align="left" >P Aseg</div></th>


    </tr>


<?php		
if($_POST['buscar'] || $_POST['actualizar'] || $_POST['delete']){
//codigo
    
    
    if($_POST['gpoProducto']=='*'){
        
     $sSQL= "
SELECT  existencias.keyE,articulos.keyPA,articulos.descripcion ,articulos.gpoProducto  from existencias,articulos
where
articulos.entidad='".$entidad."'
and
existencias.almacen='".$_POST['almacenDestino1']."' 
and
existencias.keyPA=articulos.keyPA
and
articulos.descripcion!=''

order by 
articulos.descripcion ASC
"
;       
        
    }else{
    $sSQL= "
SELECT  existencias.keyE,articulos.keyPA,articulos.descripcion ,articulos.gpoProducto  from existencias,articulos
where
articulos.entidad='".$entidad."'
and
existencias.almacen='".$_POST['almacenDestino1']."' 
and
existencias.keyPA=articulos.keyPA
and
articulos.descripcion!=''
and
articulos.gpoProducto='".$_POST['gpoProducto']."'
order by 
articulos.descripcion ASC
"
;
    }

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){

$totalRegistros+=1;

$codigo=$code = $myrow['codigo'];
$sSQL52="SELECT count(*) as totalRegedit
FROM
existencias
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result52=mysql_db_query($basedatos,$sSQL52);
  $myrow52 = mysql_fetch_array($result52);
  
$i=$myrow52['totalRegedit'];
 $sSQL5="SELECT *
FROM
  `precioArticulos`
WHERE entidad='".$entidad."' AND
codigo = '".$code."'  
  ";
  $result5=mysql_db_query($basedatos,$sSQL5);
  $myrow5 = mysql_fetch_array($result5);

$sSQL51="SELECT *
FROM
existencias
WHERE entidad='".$entidad."' AND
keyPA = '".$myrow['keyPA']."' 
and
almacen='".$_POST['almacenDestino1']."'
  ";
  $result51=mysql_db_query($basedatos,$sSQL51);
  $myrow51 = mysql_fetch_array($result51);
$bali=$myrow51['almacen'];

  

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
} 
$C=$myrow['codigo'];


 $sSQL78="SELECT nivel1,nivel3
FROM
articulosPrecioNivel
WHERE 
entidad='".$entidad."'
and
keyPA = '".$myrow['keyPA']."' 
and
almacen='".$_POST['almacenDestino1']."'
  ";
  $result78=mysql_db_query($basedatos,$sSQL78);
  $myrow78 = mysql_fetch_array($result78);




$gpoProducto=$myrow['gpoProducto'];
$sSQL39= "
	SELECT 
prefijo,rutaModifica
FROM
gpoProductos
WHERE 
entidad='".$entidad."'
and
codigoGP='".$gpoProducto."'";
$result39=mysql_db_query($basedatos,$sSQL39);
$myrow39 = mysql_fetch_array($result39);

$bandera=+1;
?>

      
      
            <tr  >
                
                      <td  >
                          <span >
                           <?php echo $bandera;?>
	  </span></td>
                
                
      <td ><span >
        <input name="keyPA[]" type="hidden" id="normal" value="<?php echo $myrow['keyPA'];?>" />
      </span>
        <?php 
	  
	  if($bali){ ?>
	  	  <label>

	  
	<?php echo $myrow['descripcion']; ?>
	  </label>
      
      <?php 
        } else {
	  
	   $imagen='<img src="/sima/imagenes/stop.png" width="13" height="13" border="0" />';
	   echo $myrow['descripcion'].'<blink>'.$imagen.'</blink>'.'< Sin Almacen..>';
	   }
	  ?>
	  
	  	<?php if($myrow['generico']=='si'){?>
					<blink>
		<img src="/sima/imagenes/g.jpg" alt="MEDICAMENTO GENERICO..." width="12" height="12" border="0" />		</blink>
		<?php } else { echo '';}?>
	  </span></td>
      




      <td  >
	  
	  

	  <label>
	  <?php echo '$'.number_format($myrow78['nivel1'],2);?>
	  </label>
	  </a></td>
      <td   >

	<?php echo '$'.number_format($myrow78['nivel3'],2);?></td>
      
      
      

    </tr>
    <?php }}?>
  </table>

  <p align="center">
    <label></label>
    <input name="bandera" type="hidden" id="bandera" value="<?php echo $totalRegistros; ?>" />


  </p>
</form>

<?php if($totalRegistros){ ?>
<p align="center" ><strong><em>Se encontraron  <?php echo $totalRegistros?> registros</em></strong></p></a>
<?php } ?>
<p>&nbsp;</p>
</body>
</html>