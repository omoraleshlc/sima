 <?php  require("/configuracion/ventanasEmergentes.php");?>

 <form id="form2" name="form2" method="post" >

     
 <table width="644" class="table-forma">

     <tr >
       <td  scope="col">&nbsp;</td>
       <td >Modulo</td>
       <td ><label><strong>
         <?php	 	
if(!$_POST['keyc'])         {$_POST['keyc']=$_GET['keyc'];}
         
$sqlNombre11 = "SELECT * from primarymodules
where
entidad='".$_POST['entidades']."'
    and
    submenu='si'
ORDER BY menuname ASC";
$resultaNombre11=mysql_db_query($basedatos,$sqlNombre11);


?>
         <select name="keyc"   onchange="javascript:this.form.submit();"/>         
        
         
         <option value="">---</option>
         <?php
  while ($rNombre11=mysql_fetch_array($resultaNombre11)){ $a+=1;
  echo mysql_error();?>
         <option 
		 <?php if($_POST['keyc']== $rNombre11["keyc"]){?>
		 selected="selected"
		  <?php } ?>
		  value="<?php echo $rNombre11["keyc"];?>"> <?php echo $rNombre11["menuname"];?></option>
         <?php } ?>
         </select>
       </strong></label>
         </td>
       
       
     </tr>
       
       
       
            <tr >
       <td width="1"  scope="col">&nbsp;</td>
       <td ><strong>Nombre SubModulo</strong></td>
       <td ><span >
         <input name="name" type="text"  id="subModulo" value="<?php echo $myrow2['name'] ?>" size="55" />
       </span></td>
       
       
       
     </tr>
       

       
       
       
       
     <tr >

       <td  colspan="3"><p align="center"><input name="nuevo" type="submit"  id="nuevo" value="Nuevo" />
         <input name="borrar" type="submit"  id="borrar" value="Eliminar SubM&oacute;dulo" />
         <input name="actualizar" type="submit"  id="actualizar" value="Modificar/Grabar Sub M&oacute;dulo" />
     
         <input name="keySM" type="hidden" id="keySM" value="<?php echo $myrow2['keySM'] ?>" />
         </p></td>
     </tr>
   </table>     
     
     
     
     
     
     
     
     
     
     
     
   <table width="519" class="table table-striped">
      
      <tr >
          <th width="5" align="left" >#</th>
      <th width="50" align="left" >Descripcion</th>
      <th width="10" align="left" >---</th>
      <th width="10" align="left" >---</th>
    </tr>
     
       <?php	while($myrow = mysql_fetch_array($result)){$b+=1;
if($col){
$color = '#FFFF99';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}
$C=$myrow['keySM'];
?>
       <tr>

             <td bgcolor="<?php echo $color;?>" ><span >
         <label>
       <?php echo $b;?>
         </label>
       </span></td>
           
           
   
       

       <td bgcolor="<?php echo $color;?>" >
           <span >
       <?php echo $myrow['name'];?>         
       </span>
       </td>
       
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="modulosSecundarios.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&keyc=<?php echo $_POST['keyc']; ?>&amp;usuario=<?php echo $E; ?>"  onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Editar
                    </a>
        
       </span>
       </td>
           
           
              <td bgcolor="<?php echo $color;?>" >
           <span >
                    <a href="javascript:ventanaSecundaria('extensionmodules.php?main=<?php echo $_GET['main'];?>&warehouse=<?php echo $_GET['warehouse'];?>&entidades=<?php echo $_POST['entidades'];?>&keySM=<?php echo $myrow['keySM']; ?>&amp;seguro=<?php echo $_POST['seguro']; ?>&amp;usuario=<?php echo $E; ?>')" class="style18" onMouseOver="Tip('<div class=&quot;estilo25&quot;><?php echo 'Editar datos de: '.$myrow81['aPaterno']." ".$myrow81['aMaterno']." ".$myrow81['nombre'];?></div>')" onMouseOut="UnTip()">
                    Add
                    </a>
        
       </span>
       </td>           
           
        
     </tr>
     <?php }?>
   </table>
   
   
   
   
   

</form>
      <?php }?>
