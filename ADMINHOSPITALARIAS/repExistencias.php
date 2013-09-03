<?PHP require("menuOperaciones.php"); ?>


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=800,height=800,scrollbars=YES") 
} 
</script> 



<script type="text/javascript">
    function setfocus(a_field_id) {
        $(a_field_id).focus()
    }
</script>

<script>
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php

$estilos= new muestraEstilos();
$estilos-> styles();

?>

</head>

<h1 align="center" >
    <br />

EVALUACION DEL INVENTARIO<br />






   <label>
   <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>

&nbsp;</h1>
    
    
    <h4><?php echo cambia_a_normal($fecha1);?></h4>    
    
    
<form id="form1" name="form1" method="post" action="">

  <table width="600" class="table-forma">
      
      
      
      
    <tr>
      <td width="114"  scope="col"><div align="left" >
        <div align="right" ><span >Datos Articulo </span></div>
      </div></td>
      <td width="474"  scope="col"><div align="left"><span >
          <input name="porArticulo" type="text"  id="porArticulo" size="60" 
		  value="<?php if($_POST['porArticulo']) echo $_POST['porArticulo']; ?>"
		  />
      </span></div></td>
    </tr>
    
      
      
      
      
      <tr >
      <td  scope="col"><div align="right" >Almac&eacute;n</div></td>
      <td  scope="col"> <div align="left">
      <?php     $aCombo= "Select * From almacenes where entidad='".$entidad."' AND
activo='A' and stock='si' order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino"  id="almacenDestino" onChange="this.form.submit();"/>        
     <option value="*">Todos</option>
  
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
		if($ALMACEN==$resCombo['almacen'] and !$_POST['almacenDestino']){
		
		echo 'selected="selected"';		
		} else if($_POST['almacenDestino'] ==$resCombo['almacen']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
      </div></td>
    </tr>
      

      <tr >
      <td  scope="col"><div align="right" >Anaquel</div></td>
      <td  scope="col"> <div align="left">
          <?php 
$aCombo= "Select * From anaqueles where
entidad='".$entidad."' AND
 almacen='".$_POST['almacenDestino']."' order  by anaquel ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="anaquel"  id="almacenDestino" />        
    
  <option
      <?php  if($_POST['anaquel']=='*'){echo 'selected=""';}?>
      
      value="*" >Todos</option>
        
        
          <option
      <?php  if($_POST['anaquel']=='sa'){echo 'selected=""';}?>
      
      value="sa" >Sin Anaquel</option>
        
        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
		
		
		?>
        <option 
		<?php 
 if($myrow61['anaquel'] ==$resCombo['anaquel'] || $_POST['anaquel']==$resCombo['anaquel']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['anaquel']; ?>"><?php echo $resCombo['anaquel']; ?></option>
        <?php } ?>
        </select>
      </div></td>
    </tr>

    <tr>
        
     
      <td  scope="col" colspan="2">
          <div align="center">
          <label>
          
            <input name="buscar" type="submit" src="../../imagenes/btns/searchbutton.png" id="buscar" value="buscar" />
            
         
        </label>
             <span >                                                                                                                                                                                                                                                                                                                  
       </span>     
       </div>
      </td>
    </tr>
  </table>
  
<p>&nbsp;</p>

  <table width="800" class="table table-striped" >
    <tr>
    
    </tr>
      
      
    <tr >
      <th width="50"  align="left">#</th>
      <th width="200"  align="left">Descripcion</th>
      <th width="50"  align="left">Caja</th>
      <th width="50"  align="left">CostoBase</th>
      <th width="50"  align="left">CostoUnitario</th>
      <th width="50"  align="left">Existencia</th>
    
      <th width="50"  align="left">TotalCosto</th>


    </tr>
<?php	


$articulo=$_POST['porArticulo'];
if( $_POST['buscar'] and ($_POST['porArticulo'] or $_POST['anaquel']!=NULL or $_POST['almacen']=='*')){ 

if($_POST['porArticulo']!='*' and $_POST['almacen']!='*'){

    
    //filtrar por anaquel
if($_POST['anaquel']=='*'){
    
    
    
$sSQL1= "SELECT 
*
FROM 

existencias,articulos
WHERE
(existencias.entidad='".$entidad."' and articulos.entidad='".$entidad."')
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_POST['almacenDestino']."'
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo
order by existencias.descripcion ASC
";

  }   elseif($_POST['anaquel']=='sa'){
 
 $sSQL1= "SELECT 
*
FROM 

articulos,existencias
WHERE
(existencias.entidad='".$entidad."' and articulos.entidad='".$entidad."')
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_POST['almacenDestino']."'
and
existencias.anaquel=''
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

order by existencias.descripcion ASC
";      
      
    
}   else{ 

 $sSQL1= "SELECT 
*
FROM 

articulos,existencias
WHERE
(existencias.entidad='".$entidad."' and articulos.entidad='".$entidad."')
        AND
(articulos.descripcion like '%$articulo%' or articulos.descripcion1 like '%$articulo%' or articulos.sustancia like '%$articulo%')
and
existencias.almacen='".$_POST['almacenDestino']."'
and
existencias.anaquel='".$_POST['anaquel']."'
and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

order by existencias.descripcion ASC
";

}







}elseif($_POST['porArticulo']=='*' and $_POST['almacenDestino']=='*'){
 $sSQL1= "
     select * FROM articulos
     where
     entidad='".$entidad."'
         and
         activo='A'



             order by descripcion ASC
";

} else {

    
    
    //filtrado por anaquel
  if($_POST['anaquel']=='*'){
 
      $sSQL1= "
          SELECT
      *
FROM 

articulos,existencias
WHERE
      (existencias.entidad='".$entidad."' and articulos.entidad='".$entidad."')
         and
         existencias.almacen='".$_POST['almacenDestino']."'
             and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo

             order by existencias.descripcion ASC
";

  }  elseif($_POST['anaquel']=='sa'){      
         $sSQL1= "
          SELECT
      *
FROM 

articulos,existencias
WHERE
      (existencias.entidad='".$entidad."' and articulos.entidad='".$entidad."')
         and
         existencias.almacen='".$_POST['almacenDestino']."'
             and
existencias.descripcion!=''
and
articulos.codigo=existencias.codigo
and
existencias.anaquel=''
             order by existencias.descripcion ASC
";   
  }  else{
 
 
       $sSQL1= "
     select * from existencias,articulos
     where
     (existencias.entidad='".$entidad."' and articulos.entidad='".$entidad."')
         and
         existencias.almacen='".$_POST['almacenDestino']."'
             and
          existencias.anaquel='".$_POST['anaquel']."'   
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











    $sSQL8ac= "
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

    $sSQL8acb= "
SELECT * 
FROM
precioArticulos
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    order by keyC DESC
";
$result8acb=mysql_db_query($basedatos,$sSQL8acb);
$myrow8acb = mysql_fetch_array($result8acb);




if($_POST['porArticulo']=='*' and $_POST['almacenDestino']=='*'){
 //ENtRADAS
     $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and

        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();   
}else{
//ENtRADAS
 $sSQL8ac1e= "
SELECT sum( cantidad) as entrada
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    almacen='".$_POST['almacenDestino']."'
        and
        status='ready'
  
";
$result8ac1e=mysql_db_query($basedatos,$sSQL8ac1e);
$myrow8ac1e = mysql_fetch_array($result8ac1e);
echo mysql_error();
}



//DEPRECATED
//SALIDAS
/*
    $sSQL8ac1s= "
SELECT sum( cantidad) as salida
FROM
articulosExistencias
WHERE
entidad='".$entidad."'
and
codigo='".$myrow1['codigo']."'
    and
    tipoMov='salida'
    and
    almacen='".$_POST['almacenDestino']."'
        
";
$result8ac1s=mysql_db_query($basedatos,$sSQL8ac1s);
$myrow8ac1s = mysql_fetch_array($result8ac1s);
*/


?>
      
      
      
      
<?php if($myrow['cbarra']){ echo ltrim($myrow['cbarra']);} ?>
    <tr >
      
        
        
        <td  ><span >
<?php echo $a; 

   
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
echo '<br>';
echo $myrow1['modoventa'];echo '<br>';
?>
          
          
          
<a  href="javascript:ventanaSecundaria2('/sima/cargos/listaAlmacenesTodos.php?codigo=<?php echo $codigo; ?>&amp;seguro=<?php echo $_GET['seguro']; ?>&amp;medico=<?php echo $_GET['medico']; ?>&amp;usuario=<?php echo $usuario; ?>&amp;keyPA=<?php echo $myrow1['keyPA']; ?>&amp;gpoProducto=<?php echo $myrow8ac['gpoProducto'];?>')" onMouseover="showhint('Presiona aqui para asignar almacenes a este articulo...', this, event, '150px')">
Editar
</a>          
      </td>
        
        
        
        
        
        
        

<td ><span >
      
<?php ##COSTO TOTAL
  if($centroDistribucion!=$_POST['almacenDestino'] ){
      
  
if($myrow8ac['cajaCon']>0){
    echo $myrow8ac['cajaCon'];
}else{
    echo '---';
}
  }else{
     echo '---'; 
  }
		?>
      </span></td>         
        
        
        
        
        
        
        
        
        
        
        
        
         <td ><span >
        
<?php ##COSTO BASE

  echo '$'.number_format($myrow8acb['costo'],2);

		?>
      </span></td> 
              
        
        
        
        
        <td ><span >
        
<?php ##COSTO O GRANEL

//echo $myrow8ac['cajaCon'];
//echo '<br>';
//echo $myrow1['modoventa'];


$cendis=new whoisCendis();
$centroDistribucion=$cendis->cendis($entidad,$basedatos);  

        if($centroDistribucion!=$_POST['almacenDestino'] ){
                
                if($myrow8ac['cajaCon']>0 or $myrow1['modoventa']=='Granel'){
            
            if($myrow1['modoventa']=='Granel' and $myrow8acb['costo']>0 and $myrow1['cantidadSurtir']>0){ 
                echo '$'.number_format($myrow8acb['costo']/$myrow1['cantidadSurtir'],2); 
                $costo=$myrow8acb['costo']/$myrow1['cantidadSurtir'];
            }else{
                if($myrow8acb['costo']>0 and $myrow8ac['cajaCon']>0){ 
                 echo '$'.number_format($myrow8acb['costo']/$myrow8ac['cajaCon'],2);
                 $costo=$myrow8acb['costo']/$myrow8ac['cajaCon'];
                }else{
                    //NO TRAE COSTO
                    $costo=$myrow8acb['costo'];
                }
            }
            
        }else{   
	if($myrow8acb['costo']>0){
	  echo '$'.number_format($myrow8acb['costo'],2);
          $costo=$myrow8acb['costo'];
        }else{
            echo '<span class="notice"><blink>???</blink></span>';
        }
        }}else{
            $costo=$myrow8acb['costo'];
            echo '$'.number_format($myrow8acb['costo'],2);
        }
		?>
      </span></td>
        
        
        

        

        












      <td ><span >
     
<?php 
 echo $myrow8ac1e['entrada'];
	 
		?>
      </span></td>


      <td ><span >
     
<?php 
if($myrow8acb['costo']>0){
        $r[0]+=($myrow8ac1e['entrada']*$costo);
	  echo '$'.number_format($myrow8ac1e['entrada']*$costo,2);
        }else{
            echo '<span class="notice"><blink>???</blink></span>';
        }

	 
		?>
      </span></td>
        
        
        
        

    </tr>
    <?php  }}?>
    <tr>
     
    </tr>
  </table>
<p><?php echo 'TOTAL DE INVERSION: $'.number_format($r[0],2);?></p>
<p align="center">&nbsp;</p>
  <span align="center" ><strong>
    <?php if(!$codigo){ echo "No se encontraron datos..!!"; }?>
	<?php if($_POST['porArticulo'] AND $a>0){
	echo '<div class="success">'. 'Se encontraron '. $a .' registros..!'.'</div>'; 
	}
	?>
	</strong></span>

  <p align="center">
    <label>

    <input name="pasoBandera" type="hidden" id="pasoBandera" value="<?php echo $a; ?>"  />

    

    </label>
    <input name="almacenes" type="hidden" id="almacen" value="<?php echo $ali; ?>" />
    <input name="anaquel1" type="hidden" id="anaquel1" value="<?php echo $_POST['anaquel']; ?>" />
  </p>
</form>



</body>
</html>