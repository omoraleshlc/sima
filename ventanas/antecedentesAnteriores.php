<?PHP include("/configuracion/ventanasEmergentes.php"); ?><?PHP include("/configuracion/funciones.php"); ?>
<?php

$sSQL2= "SELECT nombreCompleto
FROM
pacientes
WHERE 
numCliente='".$_GET['numCliente']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
$numeroE=$myrow2['numeroE'];
$seguro=$_GET['seguro'];
$medico=$_GET['medico'];
$keyCAP=$_GET['keyCAP'];
?>
<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventanaSecundaria1","width=700,height=700,scrollbars=YES")
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventana2","width=700,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria3 (URL){ 
   window.open(URL,"ventana3","width=700,height=700,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria33 (URL){ 
   window.open(URL,"ventana33","width=700,height=700,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria6 (URL){ 
   window.open(URL,"ventana6","width=600,height=600,scrollbars=YES") 
} 
</script> 




<!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-tas.css" title="win2k-cold-1" /> 

  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 

 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 

  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
  
  
  
  <script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>

  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
	<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />

<?php
$estilo= new muestraEstilos();
$estilo->styles();
?>

</head>

<body>

  <p align="center">
  <?php	
echo 'Px: '.$myrow2['nombreCompleto'];
?>
  </p>



<form id="form2" name="form2" method="post" action="">
    <p align="center"><strong>Escoje el tipo de despliegue de datos</strong></p>
    <p align="center">
      <label>
      <select name="mostrar" id="select" onChange="this.form.submit();"> 
      <option value="">Escojer</option>
        <option
        <?php 
		if($_POST['mostrar']=='CodigosInternacionales'){ 
		print 'selected="selected"';
		}
		?>
         value="CodigosInternacionales">CodigosInternacionales</option>
        <option
                <?php 
		if($_POST['mostrar']=='Diagnosticos'){ 
		print 'selected="selected"';
		}
		?>
         value="Diagnosticos">Diagnosticos</option>
		 
		   <option
                <?php 
		if($_POST['mostrar']=='Consultas'){ 
		print 'selected="selected"';
		}
		?>
         value="Consultas">Consultas</option>
                   
                   
                   	   <option
                <?php 
		if($_POST['mostrar']=='Radiologia'){ 
		print 'selected="selected"';
		}
		?>
         value="Radiologia">Radiologia</option>
		 
      </select>
      </label>
    </p>








 <?php 
		if($_POST['mostrar']=='CodigosInternacionales'){ 
		
		?>

<a   onmouseover="Tip('<div class=&quot;estilo25&quot;><?php echo 'Muestra los c�digos internacionales agregados hasta ahora';?></div>')" onMouseOut="UnTip()">
	
    <table width="481" border="0" align="center" style="border: 1px solid #80FFFF;">
      <tr>
        <th width="98" height="19" bgcolor="#660066" scope="col">
            <div align="left">
                <span class="normal">Fecha - Hora </span>
            </div>
        </th>
        <th width="51" bgcolor="#660066" scope="col">
            <div align="left">
                <span class="normal">
                    CI
                </span>
            </div>
        </th>

        <th width="252" bgcolor="#660066" scope="col">
            <div align="left">
                <span class="normal">
                    Descripcion
                </span>
            </div>
        </th>


        <th width="62" bgcolor="#660066" scope="col">
            <div align="left">
                <span class="normal">
                    Medico
                </span>
            </div>
        </th>
          
      </tr>
	  
	  
	  <?php	
$sSQL= "SELECT  
* 
FROM dx
WHERE
numeroE='".$_GET['numCliente']."'
and
banderaCI='si'
ORDER BY keyDiagnostico DESC
";


$result=mysql_db_query($basedatos,$sSQL);

?>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

$sSQL4= "
SELECT 
  *
FROM
diagnosticos
WHERE CI = '".$myrow['CI']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

?>

          <tr bgcolor="#ffffff" onMouseOver="bgColor='#87CEFF'" onMouseOut="bgColor='#ffffff'" >
        <td height="21" bgcolor="<?php echo $color;?>" class="normal">
            <span class="normal">
          <label>

          </label>
          <?php echo cambia_a_normal($myrow['fecha'])." ".$myrow['hora']; ?></span></td>

              <td bgcolor="<?php echo $color;?>" class="normal">
                  
            <span class="normal">
        <?php echo $myrow['CI']; ?>
            </span>
        </td>

              
        <td bgcolor="<?php echo $color;?>" class="normal"><span class="style12">
                <span class="normal">
                <?php echo $myrow4['descripcion']; ?>
                </span>
            </span>
        </td>

        <td bgcolor="<?php echo $color;?>" class="normal"><span class="style7">
		          <?php $devuelveMedico=new articulosDetalles();
$imagenMedico=new articulosDetalles();



?>
          <a onMouseOver="Tip('&lt;img src=\'<?php $devuelveMedico->imagenMedico($medico,$basedatos);?>\' width=\'160\'&gt;')" onMouseOut="UnTip()"> <?php echo $myrow['medico']; ?>
</a>
</span></td>
      </tr>
      <?php }
	
	  ?>
    </table>
  </a>
<?php } ?>










 <?php 
		if($_POST['mostrar']=='Diagnosticos'){ 
		
		?>	
	
<?php 
$sSQL= "
SELECT 
  *
FROM
dx
WHERE 

numeroE = '".$_GET['numCliente']."'
";
$result=mysql_db_query($basedatos,$sSQL);
$myrow = mysql_fetch_array($result);



$um=$myrow12['um'];
$medico=$myrow['medico'];
if($myrow['numeroE']){
?>
    <p align="center"><label></label>
</p>
    <p align="center"><strong>Diagnosticos</strong></p>
  <table width="333" border="0" align="center" style="border: 1px solid #80FFFF;">
      <tr>
        <th width="154" height="19" bgcolor="#660066" scope="col" style="border: 1px solid #80FFFF;">
            <div align="left">
                <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los codigos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()">
                    <span class="normal">
                        Fecha - Hora
                    </span>
                </a>
            </div>
        </th>


        <th width="108" bgcolor="#660066" scope="col">
            <div align="left">
                <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los codigos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()"><span class="style11">Cuadro</span></a><a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()">
                Fecha-Hora
                </a>
            </div>
        </th>

        <th width="57" bgcolor="#660066" scope="col"><div align="left">
          <div align="left"><span class="style11">Medico</span></div>
          <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los codigos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()"></a></div></th>
      </tr>
      <?php	
$sSQL= "SELECT  
* 
FROM dx
WHERE
numeroE='".$_GET['numCliente']."'
and
CI=''
and
(variablesSubjetivas!='' and variablesObjetivas!='' and analisisVariables!='')
ORDER BY keyDiagnostico DESC
";


$result=mysql_db_query($basedatos,$sSQL);

?>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento

if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}



$sSQL4= "
SELECT 
  *
FROM
diagnosticos
WHERE CI = '".$myrow['CI']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

?>
        <td height="21" bgcolor="<?php echo $color;?>" class="Estilo24">
            <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los codigos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()"><span class="style7">
         
          <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora']; ?></span></a></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24">
            <a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra el cuadro clinico';?>&lt;/div&gt;')" onMouseOut="UnTip()"
		href="#" onClick="ventanaSecundaria1('desplegarCuadroClinico.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;ci=<?php echo $myrow['CI']; ?>&amp;almacen2=<?php echo $A; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><img src="/sima/imagenes/listado.jpg" alt="Listado de Art&iacute;culos" width="12" height="12" border="0" /></a><a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()"></a></td>
        <td bgcolor="<?php echo $color;?>" class="Estilo24">
		
<span class="style7">
          <?php $devuelveMedico=new articulosDetalles();
$imagenMedico=new articulosDetalles();



?>
          <a onMouseOver="Tip('&lt;img src=\'<?php $devuelveMedico->imagenMedico($medico,$basedatos);?>\' width=\'160\'&gt;')" onMouseOut="UnTip()"> <?php echo $myrow['medico']; ?></a>		  </span></td>
      </tr>
      <?php }
	
	  ?>
  </table>
    <p align="center">
      <?php  } else { echo 'SIN DIAGNOSTICOS...';}?>
  </p>
    <p align="center">&nbsp;</p>
    <?php } ?>
  
  
  
  
  
  
  
  <?php if($_POST['mostrar']=='Consultas'){ ?>
  
  <table width="288" border="0" align="center" style="border: 1px solid #80FFFF;">
     
<tr class="normalmid"  align="left" onclick="onMouseClickRow('prs_','','#fdfde7', '#ffffff', '#F7F9FB');" onmouseover="onMouseOverRow('prs_','','#fdfde7', '#f9f9e3');" onmouseout="onMouseOutRow('prs_','','','#fdfde7');">


<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Folio</b>
    </a>
</th>


    <th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalid" href='javascript:void("abrir");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Fecha</b>
    </a>
</t>

<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="x-blue_dg_a_header" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=4&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Descripcion
        </b>
    </a>

      <img src="sample_2_7_demo.php_files/question_mark.gif" class="normalmid" alt="" title="Muestra La Fecha de Nacimiento">
</th>

      <tr>
        
      </tr>
      <?php	
$sSQL= "SELECT  
* 
FROM 
clientesInternos
WHERE
entidad='".$entidad."'
and
numeroE='".$_GET['numCliente']."'
and
folioVenta!=''
and
statusCaja='pagado'
order by fecha1 desc
";


$result=mysql_db_query($basedatos,$sSQL);

?>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento





$sSQL4= "
SELECT 
  *
FROM
diagnosticos
WHERE CI = '".$myrow['CI']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

?>
<tr bgcolor="#ffffff" onMouseOver="bgColor='#87CEFF'" onMouseOut="bgColor='#ffffff'" >

    <td height="21" bgcolor="<?php echo $color;?>" class="normal">
        <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()">
            <span class="normal">
          <label></label>
          <?php echo $myrow['folioVenta']; ?>
                </span>
            </a>
        </td>
        <td bgcolor="<?php echo $color;?>" class="normal"><a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onmouseout="UnTip()"><span class="style7"><?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora']; ?></span></a></td>
        <td bgcolor="<?php echo $color;?>" class="normal"><a
onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra el cuadro cl&iacute;nico';?>&lt;/div&gt;')" onMouseOut="UnTip()"
		href="#" onClick="ventanaSecundaria1('mostrarMedicamentos.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;ci=<?php echo $myrow['CI']; ?>&amp;almacen2=<?php echo $A; ?>&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;numCliente=<?php echo $N?>')">
            Ver
            </a>

            <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()"></a></td>
      </tr>
      <?php }}
	
	  ?>
  </table>
  
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php if($_POST['mostrar']=='Radiologia'){ ?>
  
  <table width="288" border="0" align="center" style="border: 1px solid #80FFFF;">
     
<tr class="normalmid"  align="left" onclick="onMouseClickRow('prs_','','#fdfde7', '#ffffff', '#F7F9FB');" onmouseover="onMouseOverRow('prs_','','#fdfde7', '#f9f9e3');" onmouseout="onMouseOutRow('prs_','','','#fdfde7');">


<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Folio</b>
    </a>
</th>


    <th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalid" href='javascript:void("abrir");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Fecha</b>
    </a>
</t>

<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="x-blue_dg_a_header" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=4&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Descripcion
        </b>
    </a>

      <img src="sample_2_7_demo.php_files/question_mark.gif" class="normalmid" alt="" title="Muestra La Fecha de Nacimiento">
</th>

      <tr>
        
      </tr>
      <?php	
$sSQL= "SELECT  
* 
FROM 
dxIMG
WHERE
entidad='".$entidad."'
and
numeroE='".$_GET['numCliente']."'
group by numeroE
";


$result=mysql_db_query($basedatos,$sSQL);

?>
      <tr>
        <?php 

while($myrow = mysql_fetch_array($result)){ 
$bandera+="1";
$gpoProducto=$myrow['gpoProducto'];
$code1=$myrow['codigo'];
//*************************************CONVENIOS********************************************
$sSQL12= "
	SELECT *
FROM
  articulos
WHERE 
codigo='".$code1."'
";
$result12=mysql_db_query($basedatos,$sSQL12);
$myrow12 = mysql_fetch_array($result12);
$gpoProducto=$myrow12['gpoProducto'];
$ctaMayor=$myrow12['ctaContable'];

//*/****************************************Cierro validacion de convenios************************

//cierro descuento





$sSQL4= "
SELECT 
  *
FROM
diagnosticos
WHERE CI = '".$myrow['CI']."'
";
$result4=mysql_db_query($basedatos,$sSQL4);
$myrow4 = mysql_fetch_array($result4);



$um=$myrow12['um'];
$medico=$myrow['medico'];

?>
<tr bgcolor="#ffffff" onMouseOver="bgColor='#87CEFF'" onMouseOut="bgColor='#ffffff'" >

    <td height="21" bgcolor="<?php echo $color;?>" class="normal">
        <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()">
            <span class="normal">
          <label></label>
          <?php echo $myrow['folioVenta']; ?>
                </span>
            </a>
        </td>
        <td bgcolor="<?php echo $color;?>" class="normal"><a onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onmouseout="UnTip()"><span class="style7">
        <?php echo cambia_a_normal($myrow['fecha']).' '.$myrow['hora']; ?>
                </span></a></td>
        <td bgcolor="<?php echo $color;?>" class="normal"><a
onmouseover="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra el cuadro cl&iacute;nico';?>&lt;/div&gt;')" onMouseOut="UnTip()"
		href="#" onClick="ventanaSecundaria1('mostrarIMG.php?keyClientesInternos=<?php echo $myrow['keyClientesInternos'];?>&amp;ci=<?php echo $myrow['CI']; ?>&amp;almacen2=<?php echo $A; ?>&amp;folioVenta=<?php echo $myrow['folioVenta']; ?>&amp;numCliente=<?php echo $N?>')">
            Ver
            </a>

            <a onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Muestra los c&oacute;digos internacionales agregados hasta ahora';?>&lt;/div&gt;')" onMouseOut="UnTip()"></a></td>
      </tr>
      <?php }}
	
	  ?>
  </table>
    
    
    
    
    
    
    
    
</form>
  <p align="center">&nbsp;</p>
  <p>&nbsp;</p>

</body>
</html>