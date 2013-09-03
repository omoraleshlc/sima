 <?php require("/configuracion/ventanasEmergentes.php"); require("/configuracion/funciones.php"); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.clientePrincipal.value) == false ) {   
                alert("Por Favor, escoje el clientePrincipal/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este clientePrincipal!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 








<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>

<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>
<script src="../js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="../js/stylesheets/autocomplete.css" type="text/css" />
</head>

<body>
 <h1 align="center" >
 <div align="center"></div>
<form id="form2" name="form2" method="POST">
 <div align="center">
   
   <h1>REPORTE BENEFICENCIA</h1>

   <h3>almacen: <?php echo $_GET['almacen'];?>, anaquel: <?php echo $_GET['anaquel'];?>, <?php echo $_GET['porArticulo'];?>, <?php echo $_GET['buscar'];?></h3>
   
   
   
   
   
   
   <p ><label for="enviar"></label>
 </p>
   <p >&nbsp;</p>

  <table width="950" class="table table-striped" >

    <tr >
      <th width="180"  align="left">Clave</th>
      <th width="550"  align="left">Descripcion</th>
      <th width="50"  align="left">Costo</th>
    <th width="50"  align="left">Caja</th>
 <th width="50"  align="left">ModoVenta</th>
      <th width="50"  align="left">Entero</th>
            <th width="50"  align="left">Cantidad</th>
      <th width="100"  align="left">Tot. Piezas</th>
      


    </tr>
<?php	


$articulo=$_GET['porArticulo'];
if( $_GET['buscar'] and ($_GET['porArticulo'] or $_GET['anaquel']!=NULL)){

if($_GET['porArticulo']!='*'){

    
    //filtrar por anaquel
if($_GET['anaquel']=='*'){
    
    
    
echo $sSQL1= "SELECT 
*
FROM 

existencias,articulos
WHERE
existencias.entidad='".$entidad."' 
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_GET['almacenDestino']."'
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo
order by existencias.descripcion ASC
";

    
    
}   else{ 

echo $sSQL1= "SELECT 
*
FROM 

articulos,existencias
WHERE
existencias.entidad='".$entidad."' 
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_GET['almacenDestino']."'
and
existencias.anaquel='".$_GET['anaquel']."'
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

order by existencias.descripcion ASC
";

}










} else {
    
    
    
    //filtrado por anaquel
  if($_GET['anaquel']=='*'){
 
   echo   $sSQL1= "
     select * from existencias,articulos
     where
     existencias.entidad='".$entidad."'
         and
         existencias.almacen='".$_GET['almacenDestino']."'
             and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

             order by existencias.descripcion ASC
";

  }  else{
 
 
    echo   $sSQL1= "
     select * from existencias,articulos
     where
     existencias.entidad='".$entidad."'
         and
         existencias.almacen='".$_GET['almacenDestino']."'
             and
          existencias.anaquel='".$_GET['anaquel']."'   
and
articulos.descripcion!=''
and
articulos.codigo=existencias.codigo
             order by existencias.descripcion ASC
"; 
 
  }
}

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){

$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}











 echo   $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);

 echo   $sSQL8acb= "
SELECT * 
FROM
precioArticulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
";
$result8acb=mysql_db_query($basedatos,$sSQL8acb);
$myrow8acb = mysql_fetch_array($result8acb);


echo $sSQL2= "
SELECT * 
FROM
existencias
WHERE
entidad='".$entidad."'
and

codigo='".$myrow1['codigo']."'
    and
almacen='".$_GET['almacenDestino']."'
";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr >
      
        
        
        <td height="10" ><span >
<?php echo $myrow1['keyPA']; 
echo ' / ';
    echo $myrow8ac['codigo'];
?>
          <input name="codigoAlfa[]" type="hidden"  value="<?php echo $codigo=$myrow1['codigo']; ?>" />
      </span></td>
      <td ><input name="keyPA[]" type="hidden"  value="<?php echo $myrow1['keyPA']; ?>" />
    <?php 

		echo ltrim($myrow1['descripcion']);
echo ' / ';
echo '<span class="precio1">'.$myrow8ac['gpoProducto'].'</span>';

if($myrow1['anaquel']!=NULL){
echo '<br>';
echo '<span >Anaquel: '.$myrow1['anaquel'].'</span>';
}
		

if($myrow8ac['antibiotico']=='si'){
echo '/';
echo '<span >Antibiotico</span>';
echo '/';
}


if($myrow8ac['cbarra']!=NULL){
    echo '<br>';
    echo $myrow8ac['cbarra'];

}
?>
          
          
          
<a  href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $codigo; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow1['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow8ac['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')">
Editar
</a>          
      </td>
        
        
        
        
              <td ><span >
        
<?php 
	if($myrow8acb['costo']>0){
	  echo '$'.number_format($myrow8acb['costo'],2);
        }else{
            echo '<span class="notice"><blink>???</blink></span>';
        }
	 
		?>
      </span></td>
        
        
        

        
        
      <td ><span >
        
<?php 
	if($myrow8ac['cajaCon']>0){
	  echo $myrow8ac['cajaCon'];
        }else{
            echo 1;
        }
	 
		?>
      </span></td>

        
        





      <td ><span >
        
<?php 
	
	  echo $myrow1['modoventa'];
	
	 
		?>
      </span></td>








      <td ><span >
     
<?php 
	  if($myrow1['existencia']>0){
	  echo $myrow1['existencia'];
	  } else {
	  echo "0.000";
	  }
	 
		?>
      </span></td>



      <td ><span >
<?php echo $myrow1['existencia'];?>
      </span></td>
        
        
        
        
      <td ><span >
 <?php echo $myrow1['cantidadTotal'];?>
      </span></td>
       
        
        
        
        
        
        

    </tr>
    <?php  }}?>
    <tr>
     
    </tr>
  </table>

       
       </div>
    
  
       
       
      <br />

   
   <br />
 </div>
</form>

 
 <script>
 window.print();
 </script> 
 
 
<div align="center">
  <script>
		new Autocomplete("nomMedico", function() { 
			this.setValue = function( id ) {
				document.getElementsByName("medico")[0].value = id;
			}
			
			// If the user modified the text but doesn't select any new item, then clean the hidden value.
			if ( this.isModified )
				this.setValue("");
			
			// return ; will abort current request, mainly used for validation.
			// For example: require at least 1 char if this request is not fired by search icon click
			if ( this.value.length < 1 && this.isNotClick ) 
				return ;
			
			// Replace .html to .php to get dynamic results.
			// .html is just a sample for you
			return "../cargos/medicosCedulax.php?entidad=<?php echo $entidad;?>&q=" + this.value;
			// return "completeEmpName.php?q=" + this.value;
		});	
	</script>
	<?php 
	if($totalRegistros2>0){ 
	echo 'Se atendieron '.$totalRegistros2.' pacientes!';
	}
	?>

</div>
 <br></br><br></br>
</body>
</html>