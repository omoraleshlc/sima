<?PHP require("/configuracion/ventanasEmergentes.php");  require("/configuracion/funciones.php"); ?>


<script language=javascript>
function ventanaSecundaria8 (URL){
   window.open(URL,"ventanaSecundaria8","width=1024,height=800,scrollbars=YES,resizable=YES, maximizable=YES")
}
</script>



<script>

var win = null;
function nueva(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

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



 <?php require("/configuracion/componentes/comboAlmacen.php");  ?>
<form id="form1" name="form1" method="post" action="#">
  <h1 align="center">Reporte de Solicitudes a Granel</h1>
    <h5 align="center">
        
 
        
    </h5>
  <div align="center">
Escoje el Almacen      
<?php 

$aCombo= "Select * From almacenes where 
entidad='".$entidad."' AND
almacenPadre='".$_GET['almacen']."' 
and
stock ='si'
and
almacenConsumo!='si'
order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="almacenDestino" class="" id="almacenDestino" onChange="this.form.submit();" />        
     
  <option value="" >---</option>
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

  </div>
  <br>
      
<?php if($_POST['almacenDestino']!=NULL){ ?>      
      
 
  <table width="600" class="table table-striped">
        <tr >
      <th width="5" >#</th>

      <th width="171"  align="left">Descripcion</th>
      <th   align="left">Disponible [CenDis]</th>
      <th   align="left">Cargado a Px</th>
      <th   align="left">Cant. p/ Surtir</th>
            <th   align="left">Faltante</th>
               <th   align="left">---</th>
                      <th   align="left">---</th>
    </tr>
   


<?php




 $sSQL= "SELECT *
FROM

existencias
where
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino']."'
    and
    ventaGranel='si'
";
$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$bandera+=1;


$sSQLv= "SELECT sum(cantidad) as c
FROM

movSolicitudes
where
entidad='".$entidad."'
and

keyPA='".$myrow['keyPA']."'
    and
almacen='".$_POST['almacenDestino']."'
    and
tipoVenta='Granel'
and
status='request'
";
$resultv=mysql_db_query($basedatos,$sSQLv);
$myrowv = mysql_fetch_array($resultv);

$sSQLv1= "SELECT sum(cantidad) as c
FROM

articulosExistencias
where
entidad='".$entidad."'
and
keyPA='".$myrow['keyPA']."'
    and
almacen='".$_POST['almacenDestino']."'
        and
        status='ready'
";
$resultv1=mysql_db_query($basedatos,$sSQLv1);
$myrowv1 = mysql_fetch_array($resultv1);


$sSQLve= "SELECT *
FROM

existencias
where
entidad='".$entidad."'
and
almacen='".$_POST['almacenDestino']."'
and
codigo='".$myrow['codigo']."'
";
$resultve=mysql_db_query($basedatos,$sSQLve);
$myrowve = mysql_fetch_array($resultve);


$sSQLa= "
SELECT sum(cantidad) as s
FROM
movSolicitudes
WHERE
entidad='".$entidad."'
    and
almacen='".$_POST['almacenDestino']."'
and
keyPA='".$myrow['keyPA']."'
and
status='request'
and
tipoVenta='Granel'
";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);




            $sSQL8ac= "
SELECT * 
FROM
articulos
WHERE
entidad='".$entidad."'
and
 codigo='".$myrow['codigo']."'
";
$result8ac=mysql_db_query($basedatos,$sSQL8ac);
$myrow8ac = mysql_fetch_array($result8ac);



 $sSQL12= "
SELECT *
FROM
almacenes
WHERE 
entidad='".$entidad."'
    and
almacen='".$_POST['almacenDestino']."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
?>




<tr  >
	        <td bgcolor="<?php echo $color?>" ><?php echo $bandera;?></td>





<td height="24" bgcolor="<?php echo $color?>" >
<?php
$total=$myrowv['c']-$myrowv1['c'];
echo $myrow['descripcion'];


echo '<br>';
echo 'Code: '.$myrow['codigo'];
echo '<br>';
echo '<span class="negro">'.'[ '.$myrow8ac['gpoProducto'].' ]'.'</span>';

if( $total==0){
echo '<span class="codigos">'.'Transferido '.'</span>';

}else{
if($myrow['informacion']){
echo '<br>';
echo '<span class="error"><blink>'. $myrow['informacion'].'</blink></span>';
}
}





?>

</td>
                
                
                
<td width="79" bgcolor="<?php echo $color?>" >
<?php 
$informacionExistencias=new existencias();$cendis=new whoisCendis();
echo $informacionExistencias->informacionExistencias($myrow3115s['tipoPaciente'],$entidad,$myrow['codigo'],$cendis->cendis($entidad,$basedatos),$usuario,$fecha,$basedatos);
?>
</td>
	  
          <input name="almacenSolicitante[]" type="hidden" value="<?php echo $myrow['almacenSolicitante'];?>" />
	  
	  <input name="keyPA[]" type="hidden" value="<?php echo $myrow['keyPA'];?>" />
                  
                  
      <td width="54" bgcolor="<?php echo $color?>" >
<?php
if($myrowa['s']>0){
echo $myrowa['s'];
}else{
    echo 0;
}
?>
      </td>




<td width="57" bgcolor="<?php echo $color?>" >
<input name="cantidadSurtir[]" type="hidden" value="<?php echo $myrowve['cantidadSurtir'];?>" />
<label>
<?php 
//surtido
echo $myrowve['cantidadSurtir'];
$cAjuste=$myrowve['cantidadSurtir']-$myrowa['s'];
?></label>
</td>

          

          
          
          

<td width="52" bgcolor="<?php echo $color?>" >      
<label>

<?php 
if($myrowve['cantidadSurtir']>0){
if( $myrowa['s']<$myrowve['cantidadSurtir']){ ?>
    
    
    <?php if($myrowa['s']==0){?>
    0
    <?php }else{?>
    Incompleto!
    <?php }?>
    
    
    
    <?php }else{?>
    
    
    <?php if($myrowa['s']>$myrowve['cantidadSurtir']){?>
    <span class="informativo">Error!</span>
    
    <?php }else{?>

    Surtir
    

       <?php }?>
    <?php }
}else{
    echo '<span class="informativo"><blink>Error!</blink></span>';
}
    
    
    ?>
    
</label>
</td>






















          
<td width="57" bgcolor="<?php echo $color?>" >
<input name="cantidadSurtir[]" type="hidden" value="<?php echo $myrowve['cantidadSurtir'];?>" />
<?php 
   echo '---';
?>
    
</td>


  <td width="57" bgcolor="<?php echo $color?>" >
      
<?php
if($myrowa['s']>0){?>      
<a  href="javascript:ventanaSecundaria8('ventanasVentaGranel.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&descripcion=<?php echo trim($myrow['descripcion']);?>&almacen=<?php echo $_POST['almacenDestino']; ?>&amp;codigo=<?php echo $myrow['codigo']; ?>&keyPA=<?php echo $myrow['keyPA']; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&cAjuste=<?php echo $cAjuste;?>&amp;keyPA=<?php echo $myrow['keyPA'];?>&cantidad=<?php echo $myrowve['cantidadSurtir'];?>,600,800');"> 
Detalles
</a>    
<?php }else{echo  '---';} ?>
</td>                
                  
                  
                  
    </tr>
    <?php  }?>
    <input name="nombres" type="hidden" value="<?php echo $nombrePaciente; ?>" />
  </table>

<p>&nbsp;</p>
  <p>&nbsp; </p>
  <div align="center">

  </div>
  <label>
      <br><?php //echo $trigger[0];?>
          
         
          
          </br>
  </label>
<input name="bandera" type="hidden" value="<?php echo $bandera;?>" />
<?php } ?>
</form>
</body>
</html>