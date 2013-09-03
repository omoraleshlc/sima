<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); $ventana1='ventanaCatalogoAlmacen.php';
?>


<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=800,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=900,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
<?php 
if($_GET['tipoAlmacen'] AND $_GET['almacen']){

	if($_GET['inactiva']=="inactiva"){
$q = "UPDATE almacenes set 

		activo='I'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
		 $borrame = "DELETE FROM camposGrupos WHERE entidad='".$entidad."' and id_almacen='".$_GET['almacen']."'";
mysql_db_query($basedatos,$borrame);
echo mysql_error();

	} else {
$q = "UPDATE almacenes set 

		activo='A'
		WHERE entidad='".$entidad."' AND
		almacen='".$_GET['almacen']."'";
		mysql_db_query($basedatos,$q);
		echo mysql_error();
	}

$_POST['tipoAlmacen']=$_GET['tipoAlmacen'];

}
?>
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

<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title></title>
<?php

$estilos= new muestraEstilos();
$estilos->styles();

?>
</head>

<body>
 <h1 align="center" class="titulos">Listado de Articulos</h1>
<form id="form2" name="form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>?main=<?php echo  $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&datawarehouse=<?php echo $_GET['datawarehouse'];?>">
   <table width="440" border="0" align="center">
     
   
     <tr class="style71">
       <th scope="col"><div align="center"><span class="style73"></span><span class="style12">
         <select name="tipoAlmacen" class="style12" id="tipoAlmacen" onChange="javascript:this.form.submit();"/>
         
         <option >Selecciona la Opcion</option>
         <option 
		   <?php if($_POST['tipoAlmacen']=='ap')echo 'selected'; ?>
		    value="ap">Almacen Principal</option>
         <option 
		   <?php if($_POST['tipoAlmacen']=='ma')echo 'selected'; ?>
		   value="ma">Mini Almacenes</option>

		     </select>
       </span></div></th>
       <th scope="col">
         <div align="left">       </div></th>
     </tr>
   </table>
   
   <?php if($_POST['tipoAlmacen']){ ?>
   
   <p align="center"><span class="style12">Centros de Costo
   </span> 
     <?php 
	  $aCombo= "Select * From almacenes where
entidad='".$entidad."' AND
 activo='A' and (miniAlmacen ='' or miniAlmacen='No') order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
     <select name="departamento" class="camposmid" id="departamento"  onchange="this.form.submit();"/>
 <option value="">Escoje</option>
     <option
         <?php if($_POST['departamento']=='*'){echo 'selected=""';} ?>
         value="*" >Todos</option>
     <?php while($resCombo = mysql_fetch_array($rCombo)){ 	?>
     <option 
<?php if($_POST['departamento']==$resCombo['almacen'])echo 'selected=""';?>
		value="<?php echo $resCombo['almacen']; ?>"><?php echo $resCombo['descripcion']; ?></option>
     <?php } ?>
     </select>
   </p>
   

   
   <table width="903" border="0" align="center" cellspacing="0" cellpadding="0">
     <tr>
       <td colspan="13"><img src="/sima/imagenes/bordestablas/borde1.png" width="900" height="24" /></td>
     </tr>
       <tr bgcolor="#ffff00">
       <th width="26" scope="col"><div align="left" class="negromid">
         <div align="left"># </div>
       </div></th>
<th width="76" height="15" scope="col"><div align="left" class="negromid">
  <div align="left">Cto. Costo [CtaMayor] </div>
</div></th>
       <th width="200" scope="col"><div align="left" class="negromid">
         <div align="left">Almacen/Mini-Almacen</div>
       </div></th>
       <th width="51" scope="col"><div align="left" class="negromid">
         <div align="left">Medico</div>
       </div></th>
       <th width="53" scope="col"><div align="left" class="negromid">
         <div align="left">Especialidad</div>
       </div></th>
       <th width="53" scope="col"><div align="left" class="negromid">
         <div align="left">% Precios</div>
       </div></th>
       <th width="47" scope="col"><div align="center" class="negromid">
         <div align="left">Desc Global </div>
       </div></th>
       <th width="47" scope="col"><div align="left" class="negromid">
         <div align="left">Ventas</div>
       </div></th>
       <th width="54" scope="col"><div align="center" class="negromid">
         <div align="left">Desc x Grupo </div>
       </div></th>
       <th width="54" scope="col"><div align="center" class="negromid">
         <div align="left">Grupos</div>
       </div></th>
       <th width="54" scope="col"><div align="center" class="negromid">
         <div align="left">Campos</div>
       </div></th>
       <?php if($_POST['tipoAlmacen']=='ap'){ ?>
       <th width="47" scope="col"><div align="left" class="negromid"> 
         <div align="left">Ventas</div>
       </div></th>
	   <?php } ?>
     
       <th width="42" scope="col"><div align="left" class="negromid">
         <div align="left">Status</div>
       </div></th>
     </tr>
     
     
     
     
        	    <?php   
				
if(!$_POST['departamento']	){$_POST['departamento']=$_GET['departamento'];}			
				
if($_POST['departamento'] =='*'){				
if($_POST['tipoAlmacen']=='ap'){
$sSQL= "Select * From almacenes 
WHERE
entidad='".$entidad."'
AND
(miniAlmacen='' or miniAlmacen='No')
order by descripcion ASC";
} else if($_POST['tipoAlmacen']=='ma'){
$sSQL= "Select * From almacenes where
entidad='".$entidad."'
AND
miniAlmacen='si' and (medico='' or medico='no')
order by descripcion ASC";
} else if($_POST['tipoAlmacen']=='me'){
$sSQL= "Select * From almacenes where
entidad='".$entidad."'
AND
miniAlmacen='si' and medico='si'
order by descripcion ASC";
}
}else{
if($_POST['tipoAlmacen']=='ap'){
$sSQL= "Select * From almacenes 
WHERE
entidad='".$entidad."'
AND
almacenPadre='".$_POST['departamento']."'
AND
(miniAlmacen='' or miniAlmacen='No')
order by descripcion ASC";
} else if($_POST['tipoAlmacen']=='ma'){
$sSQL= "Select * From almacenes where
entidad='".$entidad."'
AND
almacenPadre='".$_POST['departamento']."'
AND
miniAlmacen='si' and (medico='' or medico='no')
order by descripcion ASC";
} else if($_POST['tipoAlmacen']=='me'){
$sSQL= "Select * From almacenes where
entidad='".$entidad."'
AND
almacenPadre='".$_POST['departamento']."'
AND
miniAlmacen='si' and medico='si'
order by descripcion ASC";
}

} 
 
 
 
 if($sSQL){
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){ 
$f+=1;
?> 





     <tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" >


         <td class="codigos"><?php echo $f;?></td>



       <td class="codigos"><span class="codigos">
<?php

$checaModuloScript2a= "Select almacenPadre,descripcion,id_medico from almacenes WHERE entidad='".$entidad."' and almacen = '".$myrow['almacen']."' ";
$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
$resulScripModulo2a = mysql_fetch_array($resScript2a);
$checaModuloScript2a= "Select descripcion from almacenes WHERE entidad='".$entidad."' and almacen = '".$resulScripModulo2a['almacenPadre']."' ";
$resScript2a=mysql_db_query($basedatos,$checaModuloScript2a);
$resulScripModulo2a = mysql_fetch_array($resScript2a);
echo $resulScripModulo2a['descripcion'];
         ?>
       </span></td>



       <td class="normal">
         <?php if($myrow['activo']=='A'){  ?>
             <a href="#editar<?php echo $f;?>" name="editar<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria1('<?php echo $ventana1;?>?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen2=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')"><?php echo $myrow['descripcion'];?></a>
           <?php } else{ echo $myrow['descripcion'] ;} ?>
     </td>



       <td class="style12"><span class="normal"><?php
	   if($myrow['id_medico']){ ?>
<a href="#" onClick="javascript:ventanaSecundaria('/sima/ADMINHOSPITALARIAS/medicos/ventanaModificaMedicos.php?numeroE=<?php echo $myrow['numeroE']; ?>&nCuenta=<?php echo $myrow['nCuenta']; ?>&almacen=<?php echo $bali; ?>&seguro=<?php echo $_POST['seguro']; ?>&numMedico=<?php echo $myrow['id_medico'];?>')">

	   <?php echo $myrow['id_medico']; ?>	   </a><?php    
	   } else { 
	   echo '---';
	   }
	   ?> 
</span></td>






       <td class="style12"><span class="normal">
	   <?php 
$sSQLa= "Select descripcion From especialidades where
entidad='".$entidad."'
AND
codigo='".$myrow['especialidad']."'";
$resulta=mysql_db_query($basedatos,$sSQLa); 
$myrowa = mysql_fetch_array($resulta);
if($myrowa['descripcion']){
	   echo $myrowa['descripcion'];
	   }else{
	   echo '---';
	   }
	   ?>
	   
	   </span></td>





       <td class="style12"><span class="normal">

               <?php if($myrow['stock']=='si'){ ?>
  <a href="#grupos<?php echo $f;?>" name="grupos<?php echo $f;?>" class="style79" id="grupos<?php echo $f;?>" onClick="ventanaSecundaria10('ventanaAsignarPorcentajes.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Asignar porcentajes ';?>&lt;/div&gt;')" onMouseOut="UnTip()">
      <img src="../../imagenes/btns/listbtn.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>, APLICAR PORCENTAJES!" width="20" height="20" border="0" />
  </a>
         <?php } else {
		echo '---';
		}
		?>
           </span></td>





       <td class="style12"><div align="center">
         <?php if($myrow['activo']=='A'){ ?>
         <a href="#grupos<?php echo $f;?>" name="grupos<?php echo $f;?>" class="style79" id="grupos<?php echo $f;?>" onClick="ventanaSecundaria10('ventanaAsignarDescuentosCupon.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Asignar descuento automatico a: '.$myrow['descripcion'];?>&lt;/div&gt;')" onMouseOut="UnTip()"> <img src="../../imagenes/btns/listbtn.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>, APLICAR DESCUENTOS!" width="20" height="20" border="0" /> </a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
       <td class="style12"><span class="normal"><?php echo $myrow['ventas'];?></span></td>
       
       <td class="style12"><div align="center">
         <?php if($myrow['activo']=='A'){ ?>
         <a href="#grupos<?php echo $f;?>" name="grupos<?php echo $f;?>" class="style79" id="grupos<?php echo $f;?>" onClick="ventanaSecundaria10('ventanaAsignarDescuentosAutomaticos.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Asignar descuento automatico a: '.$myrow['descripcion'];?>&lt;/div&gt;')" onMouseOut="UnTip()"> <img src="../../imagenes/btns/listbtn.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>, APLICAR DESCUENTOS!" width="20" height="20" border="0" /> </a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
       <td class="style12"><div align="center">
         <?php if($myrow['activo']=='A'){ ?>
         <a href="#grupos<?php echo $f;?>" name="grupos<?php echo $f;?>" class="style79" onClick="ventanaSecundaria10('ventanaCamposGrupos.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo $myrow['descripcion'];?>&lt;/div&gt;')" onMouseOut="UnTip()"> <img src="../../imagenes/btns/listbtn.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>, ASIGNAR GRUPOS DE PRODUCTO" width="20" height="20" border="0" /> </a>
         <?php } else { 
		echo '---';
		}
		?>
       </div></td>
       
       <td class="style12">
          <div align="center">
            <?php if($myrow['activo']=='A'){ ?>
            <a href="#campos<?php echo $f;?>" name="campos<?php echo $f;?>" class="style79" onClick="ventanaSecundaria10('ventanaCamposAlmacenes.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $myrow['almacen']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()">
            <img src="../../imagenes/btns/listbtn.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>, ASIGNAR CAMPOS SECUNDARIOS" width="20" height="20" border="0" />		</a>
            <?php } else { 
		echo '---';
		}
		?>        		
       </div></td>
		
		
		
		
       <?php if($_POST['tipoAlmacen']=='ap'){ ?>
       <td class="style12"><div align="center"><span class="style75">
         
         <?php if($myrow['ventas']=='si' and $myrow['activo']=='A'){  ?>
         <a href="#ventas<?php echo $f;?>" name="ventas<?php echo $f;?>" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo $myrow['descripcion'];?></div>')" onMouseOut="UnTip()" onClick="ventanaSecundaria10('ventanaAlmacenesAlmacen.php?numMedico=<?php echo $myrow['id_medico']; ?>
		&amp;nCuenta=<?php echo $myrow['nCuenta']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;numCliente=<?php echo $N?>')">
           
          <img src="../../imagenes/btns/sendcash.png" alt="EDITAR A: <?php echo $myrow['descripcion'];?>" width="20" height="20" border="0" /></a>
         <?php } else { 
		echo '---';
		}
		?>
       </span></div></td>
	   <?php } ?>
		
		
      
       <td class="style12">
	   <div align="center" class="style79">	    <span class="Estilo24"><a name="status<?php echo $f;?>" href="catalogoAlmacen.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;inactiva=<?php echo'inactiva'; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&departamento=<?php echo $_POST['departamento'];?>#status<?php echo $f;?>">
	   <?php if($myrow['activo']=='A'){ ?>
       <img src="../../imagenes/btns/checkbtn.png" alt="Almac&eacute;n &oacute; M&eacute;dico Activo" width="18" height="18" border="0" onClick="if(confirm('&iquest;Est&aacute;s seguro que deseas inactivar este registro?') == false){return false;}" /></a>
       <?php } else { ?>
       <a  href="catalogoAlmacen.php?codigo=<?php echo $code; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;activa=<?php echo "activa"; ?>&amp;usuario=<?php echo $E; ?>&amp;tipoAlmacen=<?php echo $_POST['tipoAlmacen']; ?>&amp;almacen=<?php echo $myrow['almacen'];?>&departamento=<?php echo $_POST['departamento'];?>"> <img src="../../imagenes/btns/lockbtn.png" alt="INACTIVO" width="20" height="20" border="0"  onclick="if(confirm('Esta seguro que deseas activar este registro?') == false){return false;}" /></a>
       <?php } ?>
       </span></div></td>
     </tr>
     <?php }}}?>
   </table>
   <img src="/sima/imagenes/bordestablas/borde2.png" width="903" height="24" />
   <p align="center">
     <label>
     <input name="nuevo" type="button" class="style7" id="nuevo" value="Nuevo Almacen"
	  onclick="nueva('<?php echo $ventana1;?>?cargos=cargos&almacen=<?php echo $ALMACEN;?>','ventana7','800','800','yes')" />
     </label>
   </p>
 </form>
 <p align="center">&nbsp;</p>
</body>
</html>