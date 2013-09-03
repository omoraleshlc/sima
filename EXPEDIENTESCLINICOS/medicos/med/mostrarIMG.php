<?php require('/configuracion/ventanasEmergentes.php');?>
<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>

<hr>

<table width="647" height="53"  align="center" style="border: 1px solid #80FFFF;">
    <tr bgcolor="#330099">

        <tr class="normalmid"  align="left" onclick="onMouseClickRow('prs_','','#fdfde7', '#ffffff', '#F7F9FB');" onmouseover="onMouseOverRow('prs_','','#fdfde7', '#f9f9e3');" onmouseout="onMouseOutRow('prs_','','','#fdfde7');">


<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalmid" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Ref</b>
    </a>
</th>


    <th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="normalid" href='javascript:void("abrir");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=2&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>Descripcion</b>
    </a>
</t>

<th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="x-blue_dg_a_header" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=4&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Medico/Departamento
        </b>
    </a>


    <th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="x-blue_dg_a_header" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=4&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            Cant
        </b>
    </a>

        <th class="normalmid" style="background-color: rgb(252, 250, 246);" onmouseover="bgColor='#e4ecf7';" onmouseout="bgColor='#fcfaf6';" bgcolor="#fcfaf6">

    <a class="x-blue_dg_a_header" href='javascript:void("sort");' onclick='javascript:prs__doPostBack("sort","","&amp;prs_page_size=10&amp;prs_p=1&amp;prs_sort_field=4&amp;prs_sort_field_by=&amp;prs_sort_field_type=&amp;prs_sort_type=asc");' title="Sort">
        <b>
            N
        </b>
    </a>

      <img src="sample_2_7_demo.php_files/question_mark.gif" class="normalmid" alt="" title="Muestra La Fecha de Nacimiento">
</th>

      
    
	
	

	  
	  
      
    </tr>

<tr>



<?php 

$sSQL= "SELECT 
* 
FROM dxIMG
WHERE
entidad='".$entidad."'
and
folioVenta='".$_GET['folioVenta']."'




";		




$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){ 

$bandera+=1;




?>
  </tr>
    
      
	  


	  
	   
      
    <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
      <td bgcolor="<?php echo $color;?>" class="codigos"><div align="left"><span class="normalmid"><?php echo $myrow['keyCAP']; ?></span></div></td>
      

      
      <td bgcolor="<?php echo $color;?>" class="normal"><div align="left"><span class="normalmid">
        <?php 
		$sSQL12as= "
SELECT descripcion
FROM
articulos
WHERE 

codigo='".$myrow['codProcedimiento']."'
";
$result12as=mysql_db_query($basedatos,$sSQL12as);
$myrow12as = mysql_fetch_array($result12as);


		echo $myrow12as['descripcion'];

		?>
        </span>
            <?php 
		
		if($myrow['statusFactura']=='facturado'){
		//echo '<span class="codigos">'.'Registro Facturado'.'</span>'; 
		}
		?>
      </div></td>
      <td height="24" bgcolor="<?php echo $color;?>" class="normal"><div align="left"><span class="normalmid">
        <?php 
		$sSQL12as1= "
SELECT descripcion
FROM
almacenes
WHERE 
entidad='".$entidad."'
and
almacen='".$myrow['almacenDestino']."'
";
$result12as1=mysql_db_query($basedatos,$sSQL12as1);
$myrow12as1 = mysql_fetch_array($result12as1);


		echo $myrow12as1['descripcion'];

		?>

      </span>



      </div></td>
      
      

      <td bgcolor="<?php echo $color;?>" class="normalmid"><div align="left"><?php echo $myrow['cantidad']?></div></td>
   
	  
	  

	  
      <td bgcolor="<?php echo $color;?>" class="negromid">
        <div align="left"></span>
		<?php echo $myrow['naturaleza'];?>		</div></td>
    </tr>
    
    
    

      
      
      
    <?php }?>
</table>
  <p>

  </p>
