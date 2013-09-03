<?php require("/configuracion/ventanasEmergentes.php"); 
require('/configuracion/funciones.php'); ?>













<script language=javascript> 
function ventanaSecundaria4 (URL){ 
   window.open(URL,"ventana4","width=800,height=300,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=630,height=500,scrollbars=YES,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=530,height=300,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria5 (URL){ 
   window.open(URL,"ventana5","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>


<script language=javascript> 
function ventanaSecundaria51 (URL){ 
   window.open(URL,"ventanaSecundaria51","width=500,height=500,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=500,height=400,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria7 (URL){ 
   window.open(URL,"ventana7","width=500,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>



<?php
$_POST['extension']=1;

if(!$_POST['gpoProducto']){
    $_POST['gpoProducto']=$_GET['gpoProducto'];
    }

    if(!$_POST['extension']){
    $_POST['extension']=$_GET['extension'];
    }

?>











<?php
if($_POST['quitars'] and $_POST['extension']>0){
 $sqld = "DELETE FROM facturasAplicadas 
where
folioVenta='".$_GET['folioVenta']."'
and
extension='".$_POST['extension']."'
    and
    keyMov='".$_GET['keyMOV']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
echo '<script>';
echo 'window.alert("Extension eliminada");';
echo '</script>';
}
?>









<?php  
if($_POST['asignar'] and $_POST['porcentaje']>0 and $_POST['extension']>0){
$importe=$_POST['importe'];
$gpoProducto=$_POST['gpoProducto'];
$cantidadOriginal=$_POST['cantidadOriginal'];
$reservado=$_POST['reservado'];
$percent=$_POST['porcentaje']*0.01;



for($i=0;$i<=$_POST['bandera'];$i++){







if($gpoProducto[$i]!=''){

     $sql5= "
SELECT *
FROM
facturaGrupos
WHERE
entidad='".$entidad."'
    and
    folioVenta='".$_GET['folioVenta']."'
        and
        keyCAPMOV='".$_GET['keyMOV']."'
    and
    gpoProducto='".$gpoProducto[$i]."'
   
 ";
$result5=mysql_db_query($basedatos,$sql5);
while($myrow5= mysql_fetch_array($result5)){


 if($_POST['porcentaje']>=100){
 $importe=$myrow5['importe'];
 $iva=$myrow5['iva'];
 }else{ 
  $importe=($myrow5['importe']*$percent);
 $iva=($myrow5['iva']*$percent);
 }



   $sqld = "UPDATE facturaGrupos set
extension='".$_POST['extension']."',
importe='".$importe."',
    iva='".$iva."',
porcentaje='".$_POST['porcentaje']."'
where
keyCAP='".$myrow5['keyCAP']."'
    and
    keyCAPMov='".$_GET['keyMOV']."'
";
mysql_db_query($basedatos,$sqld);
echo mysql_error();




$leyenda= 'Se actualizo la extension';

$sqldd = "UPDATE clientesInternos set 

statusFactura='extension'
where
folioVenta='".$_GET['folioVenta']."'


";
//mysql_db_query($basedatos,$sqldd);
echo mysql_error();
$to[0]+=$importe+$iva;
}//cierra while
}
}


$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se actualizaron registros..';

}
?>





<?php  
if($_GET['off']=='si'){

     $sqld = "DELETE
         from
         facturaGrupos
where
entidad='".$entidad."'
    and
    folioVenta='".$_GET['folioVenta']."'
        and
gpoProducto='".$_GET['gpoProducto']."'
    and
   random='".$_GET['random']."'

";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se desactivo el grupo ..';
}
?>



<?php
if($_GET['add']=='si'){

    $sqld = "UPDATE facturaGrupos set

status='request'
where
entidad='".$entidad."'
    and
    folioVenta='".$_GET['folioVenta']."'
        and
gpoProducto='".$_GET['gpoProducto']."'
    and
    random='".$_GET['random']."'
    

";
mysql_db_query($basedatos,$sqld);
echo mysql_error();
$tipoMensaje='registrosAgregados';
$encabezado='Exitoso';
$texto='Se activo el grupo..';
}
?>



<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  


  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF;
          background:#000066;

}
 
-->
</style>
<?php 
$showStyles=new muestraEstilos();
$showStyles->styles();
?>


    
    
    
</head>



<BODY  >
<?php 
$sSQL3= "Select * From clientesInternos WHERE entidad='".$entidad."' and folioVenta = '".$_GET['folioVenta']."' ";
$result3=mysql_db_query($basedatos,$sSQL3);
$myrow3 = mysql_fetch_array($result3);
?>
<h1 align="center" class="titulos">Facturacion por Extensiones por Grupos </h1>
<form method="post">

    <p align="center" class="titulomedio">
  <label>
      <?php
    if($texto!=NULL){
    $mostrarMensajes=new informacion();
    $mostrarMensajes->mostrarMensajes($encabezado,$tipoMensaje,$id,$texto,$basedatos);
    }
    ?>
  </label>
</p>

<h2>

    Porcentaje %     <input type="text" maxlength="" size="" name="porcentaje"  value="<?php 
    if($_POST['porcentaje']!=NULL){
    echo $_POST['porcentaje'];
    }else{
        echo $_GET['porcentaje'];
    }
    ?>"/>
</h2>




  <a href="javascript:ventanaSecundaria5('ventanaAjustarExtensiones.php?entidad=<?php echo $entidad;?>&extension=<?php echo $_POST['extension'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>');"></a></p>




    <table width="716" border="0" align="center">
      <tr>
        <th width="60" bgcolor="#660066" scope="col"><div align="left" class="blanco">Cod. GP</div></th>
        <th width="281" bgcolor="#660066" scope="col"><div align="left" class="blanco">Descripcion de Productos </div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Importe</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">iva</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">ImporteExt</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">ivaExt</div></th>
        <th width="69" bgcolor="#660066" scope="col" class="blanco"><div align="left">Status</div></th>
      </tr>
      <tr>
	  
	  <?php   
   $sSQL= "Select * From facturaGrupos where
      entidad='".$entidad."' and folioVenta='".$_GET['folioVenta']."' and keyCAPMov='".$_GET['keyMOV']."'
          group by gpoProducto ";
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){
$sSQL3e= "Select * From gpoProductos WHERE entidad='".$entidad."' and codigoGP = '".$myrow['gpoProducto']."' ";
$result3e=mysql_db_query($basedatos,$sSQL3e);
$myrow3e = mysql_fetch_array($result3e);

$bandera+=1;	
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['gpoProducto'];


if($_POST['extension']>0 or $_GET['extension']>0){
 $sSQL3ad1= "Select sum(importe) as i,sum(iva) as iv

    From
    facturaGrupos WHERE entidad='".$entidad."' 
        and
            folioVenta = '".$_GET['folioVenta']."'
                and gpoProducto='".$myrow['gpoProducto']."'
                    and
                    keyCAPMov='".$_GET['keyMOV']."'
                    and
                        status='request'
                        and
                        naturaleza='C'
                       
";
$result3ad1=mysql_db_query($basedatos,$sSQL3ad1);
$myrow3ad1 = mysql_fetch_array($result3ad1);


$sSQL3ad1d= "Select sum(importe) as i,sum(iva) as iv

    From
    facturaGrupos WHERE entidad='".$entidad."'
        and
            folioVenta = '".$_GET['folioVenta']."'
                and
                    keyCAPMov='".$_GET['keyMOV']."'
                and gpoProducto='".$myrow['gpoProducto']."'
                    and
                        status='request'
                        and
                        naturaleza='A'
                     
";
$result3ad1d=mysql_db_query($basedatos,$sSQL3ad1d);
$myrow3ad1d = mysql_fetch_array($result3ad1d);





 $sSQL3ad1E= "Select sum(importe) as i,sum(iva) as iv

    From
    facturaGrupos WHERE entidad='".$entidad."'
        and
            folioVenta = '".$_GET['folioVenta']."'
                and gpoProducto='".$myrow['gpoProducto']."'
                    and
                    keyCAPMov='".$_GET['keyMOV']."'
                    and
                        status='request'
                        and
                        naturaleza='C'
                        and
                        extension='".$_POST['extension']."'
";
$result3ad1E=mysql_db_query($basedatos,$sSQL3ad1E);
$myrow3ad1E = mysql_fetch_array($result3ad1E);


$sSQL3ad1dE= "Select sum(importe) as i,sum(iva) as iv

    From
    facturaGrupos WHERE entidad='".$entidad."'
        and
            folioVenta = '".$_GET['folioVenta']."'
                and gpoProducto='".$myrow['gpoProducto']."'
                    and
                    keyCAPMov='".$_GET['keyMOV']."'
                    and
                        status='request'
                        and
                        naturaleza='A'
                        and
                        extension='".$_POST['extension']."'
";
$result3ad1dE=mysql_db_query($basedatos,$sSQL3ad1dE);
$myrow3ad1dE = mysql_fetch_array($result3ad1dE);
$flagExtension=$myrow3ad1E['i']-$myrow3ad1dE['i'];
}

//$importe[0]+=$myrow3ad1['i']+$myrow3ad1['iv'];
$id[0]+=$myrow3ad1['i']-$myrow3ad1d['i'];
$iv[0]+=$myrow3ad1['iv']-$myrow3ad1d['iv'];
?>
        <td bgcolor="<?php echo $color?>" class="normal">
            <label>
        <?php echo $C?>
            </label>
            
        <input type="hidden" name="gpoProducto[]"  value="<?php echo $C?>"/></td>

        <td bgcolor="<?php echo $color?>" class="normal"><?php echo $myrow3e['descripcionGP'];?></td>

        <td bgcolor="<?php echo $color?>" class="normal">
<?php echo '$'.number_format( $myrow3ad1['i']-$myrow3ad1d['i'],2);?>
        </td>
            

        <td bgcolor="<?php echo $color?>" class="normal">
<?php echo '$'.number_format($myrow3ad1['iv']-$myrow3ad1d['iv'],2);?>
        </td>


        <td bgcolor="<?php echo $color?>" class="normal">
<?php echo '$'.number_format( $myrow3ad1E['i']-$myrow3ad1dE['i'],2);?>
        </td>


        <td bgcolor="<?php echo $color?>" class="normal">
<?php echo '$'.number_format($myrow3ad1E['iv']-$myrow3ad1dE['iv'],2);?>
        </td>


         
        <td bgcolor="<?php echo $color?>" class="normal">
            <?php 
            if( $flagExtension>0){ ?>
            
<a href="editExtensiones.php?gpoProducto=<?php echo $myrow['gpoProducto'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&extension=<?php echo $_POST['extension'];?>&porcentaje=<?php echo $_POST['porcentaje'];?>&off=si&keyMOV=<?php echo $_GET['keyMOV'];?>">
Quitar Grupo
</a>
                <?php }else { ?>
                    <a href="editExtensiones.php?gpoProducto=<?php echo $myrow['gpoProducto'];?>&folioVenta=<?php echo $_GET['folioVenta'];?>&extension=<?php echo $_POST['extension'];?>&porcentaje=<?php echo $_POST['porcentaje'];?>&add=si&keyMOV=<?php echo $_GET['keyMOV'];?>">
add Grupo
</a>
<?php 
                }

                ?>
                

        </td>
      </tr>
      <?php }?>
    </table>
  <p align="center">&nbsp;</p>
<p align="center">
    <label>

    </label>
  <?php echo '$'.number_format($id[0]+$iv[0],2);?>   </p>
  <p align="center">
    <label></label>
    <input type="submit" name="asignar" id="asignar" value="Actualizar"/>
<input type="hidden" name="total" id="asignar" value="<?php echo $id[0]+$iv[0];?>"/>
  </p>
  




  <p align="center">
      <input name="bandera" type="hidden" id="bandera" value="<?php echo $bandera; ?>" />

  </p>
</form>



</body>
</html>




