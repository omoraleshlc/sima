<?PHP require("/configuracion/ventanasEmergentes.php"); 
function noRound($val, $pre = 0) {
    $val = (string) $val;
    if (strpos($val, ".") !== false) {
        $tmp = explode(".", $val);
        $val = $tmp[0] .".". substr($tmp[1], 0, $pre);
    }
    return (float) $val;
} 
?>

<script language=javascript>
function ventanaSecundaria2 (URL){
   window.open(URL,"ventana2","width=800,height=600,scrollbars=YES")
}
</script>



<?php
/*
if( $_POST['tipo']!=NULL){
$tipo=$_POST['tipo'];    
$cliente=$_POST['cliente'];


    for($i=0;$i<=$_POST['flag'];$i++){
        
        
        
        
        
        
        
if($tipo[$i]!=''){   

  
    

if($tipo[$i]=='Delete'){

$agrega2 = "DELETE FROM
            relacionCliente
               
           WHERE
            entidad='".$entidad."'
    and
cliente='".$cliente[$i]."' 

";
mysql_db_query($basedatos,$agrega2);
echo mysql_error();  

  $agrega="UPDATE
           cargosCuentaPaciente
           set
           statusPC=''
           WHERE
           entidad='".$entidad."'
           and
           clientePrincipal='".$cliente[$i]."'
           and
           gpoProducto!=''
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();  



}else{
    
    
    
    
    
    
    
$sSQL1c= "Select * From cargosCuentaPaciente where 
entidad='".$entidad."'
and
clientePrincipal='".$cliente[$i]."' ";
 
 
$result1c=mysql_db_query($basedatos,$sSQL1c); 
$myrow1c = mysql_fetch_array($result1c);   


if($myrow1c['statusPC']!='' AND $myrow1c['statusPC']!=$tipo[$i]){

    $agrega = "UPDATE
           cargosCuentaPaciente
           set
           statusPC='".$tipo[$i]."'
           WHERE
           (
           entidad='".$entidad."'
           and
           clientePrincipal='".$cliente[$i]."'
           and
           gpoProducto!=''
           and
           statusCargo='cargado'
           and
           (tipoPaciente='interno' or tipoPaciente='urgencias'))
           OR
                      (
           entidad='".$entidad."'
           and
           clientePrincipal='".$cliente[$i]."'
           and
           gpoProducto!=''
           and
           statusCargo='cargado'
           and
           tipoPaciente='externo' and fechaCierre!='')
";
//mysql_db_query($basedatos,$agrega);
echo mysql_error();      




    $sSQL1= "Select * From relacionCliente where 
entidad='".$entidad."'
    and
cliente='".$cliente[$i]."' 


";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['tipo']){
 $agrega = "INSERT INTO relacionCliente (
cliente,tipo,entidad,tipoReporte
) values ('".$cliente[$i]."','".$tipo[$i]."','".$entidad."','estadisticasAseguradoras1')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}  else{          
         
  $agrega = "UPDATE
            relacionCliente
               set
               tipo='".$tipo[$i]."'
           WHERE
           entidad='".$entidad."'
             and
               cliente='".$cliente[$i]."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
}   //soloentra si no es igual 
}

*/

















/*    
if($tipo[$i]=='Delete'){
    
$agrega = "DELETE FROM
            relacionCliente
               
           WHERE
            entidad='".$entidad."'
    and
cliente='".$cliente[$i]."' 

";
mysql_db_query($basedatos,$agrega);
echo mysql_error();    
    
    
}   else{ 
    
    
 $sSQL1= "Select * From relacionCliente where 
entidad='".$entidad."'
    and
cliente='".$cliente[$i]."' 


";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);
if(!$myrow1['tipo']){
 $agrega = "INSERT INTO relacionCliente (
cliente,tipo,entidad,tipoReporte
) values ('".$cliente[$i]."','".$tipo[$i]."','".$entidad."','estadisticasAseguradoras1')";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}  else{          
         
  $agrega = "UPDATE
            relacionCliente
               set
               tipo='".$tipo[$i]."'
           WHERE
           entidad='".$entidad."'
             and
               cliente='".$cliente[$i]."'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
        }
}//cierro eliminar      
        
}*/
        
   /*     
     $agrega = "DELETE FROM
            relacionCliente
               
           WHERE
            entidad='".$entidad."'
    and
cliente='".$cliente[$i]."' 
    and
    tipo='".$tipo[$i]."'
        and
        tipoReporte='estadisticasAseguradoras1'
";
mysql_db_query($basedatos,$agrega);
echo mysql_error();
}
    }
    
    

}*/
?>


        <script type="text/javascript" src="/sima/js/editp/spec/support/jquery.js"></script>
        <script type="text/javascript" src="/sima/js/editp/spec/support/jquery.ui.js"></script>
        <script type="text/javascript" src="/sima/js/editp/lib/jquery.editinplace.js"></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />


<?php
$estilos=new muestraEstilos();
$estilos->styles();
?>


</head>

<body>

 <h1 align="center">&nbsp;</h1>

<h1 align="center">Configuracion de Reporte</h1>







 <form id="form2" name="form2" method="post" action="">
 







  
   <table width="800" class="table table-striped">

         <th width="10"  >#</th>
       <th width="600"  ><span >Nombre Aseguradora</span></th>

<th width="400"  >Tipo</th>
     </tr>
        <?php




$sSQL24= "
select * from
clientes
where entidad='".$entidad."'
    and
    subCliente=''
    order by nomCliente ASC

";
$result24=mysql_db_query($basedatos,$sSQL24);
while($myrow24 = mysql_fetch_array($result24)){
$_GET['seguro']=$myrow24['clientePrincipal'];
$a+=1;




?>



<tr   > 
       <td >
<?php

echo $a;


?>
      
       </td>    
    
       <td >
<?php

echo $myrow24['nomCliente'];
?></td>
      
    
    
<?php /*PROYECTO POR GRUPOS
      <td >
<a  href="javascript:ventanaSecundaria2('../ventanas/vconfReporteEstadisticas.php?nombre=<?php echo $myrow24['nomCliente'];?>&numCliente=<?php echo $myrow24['numCliente'];?>&seguro=<?php echo $myrow24['numCliente'];?>&nombreCliente=<?php echo $myrow24['nomCliente']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
Agregar
</a>

      </td>
    <?php 


$(document).ready(function(){
	
	$("#<?php echo $myrow24['numCliente']; ?>").editInPlace({
            url: "./server.php"
		
	});	
});*/
?>
    
    
    
    
    <td id="<?php echo $myrow24['numCliente']; ?>">
    <script type="text/javascript">




	// A select input field so we can limit our options
	$("#<?php echo $myrow24['numCliente']; ?>").editInPlace({
		//callback: function(unused, enteredText) { return enteredText; },
                url: "/sima/cargos/server1.php",
		field_type: "select",
		select_options: "<?php $sSQL= "Select * From relacionClientesTipo
where
entidad='".$entidad."'

order by descripcion ASC";

 

$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){echo $myrow['descripcion'].',';}?>"
	});
</script>   
  <div align="left" >
<?php 

$sSQL1d= "Select tipo From relacionCliente where 
entidad='".$entidad."'
    and
cliente='".$myrow24['numCliente']."' 


";
$result1d=mysql_db_query($basedatos,$sSQL1d); 
$myrow1d = mysql_fetch_array($result1d);


$sSQL1e= "Select descripcion From relacionClientesTipo where 
entidad='".$entidad."'
    and
tipo='".$myrow1d['tipo']."' 


";
$result1e=mysql_db_query($basedatos,$sSQL1e); 
$myrow1e = mysql_fetch_array($result1e);

if($myrow1e['descripcion']!=NULL){
echo $myrow1e['descripcion']; 
}else{
    echo 'Editar';
}
?> 
  </div>    
        
        
<?php /*
$aCombo= "Select * From relacionClientesTipo
where entidad='".$entidad."'

order by descripcion ASC";
$rCombo=mysql_db_query($basedatos,$aCombo); ?>
        <select name="tipo[]"  onChange="this.form.submit();"/>        
     <?php $sSQL1= "Select tipo From relacionCliente where 
entidad='".$entidad."'
    and
cliente='".$myrow24['numCliente']."' 


";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);


if($myrow1['tipo']!=''){
  echo '<option value="Delete" >---</option>';
}else{
    echo '<option value="" >---</option>';
}

?>

        <?php while($resCombo = mysql_fetch_array($rCombo)){ 
	
            $sSQL1= "Select * From relacionCliente where 
        
    entidad='".$entidad."'
    and
    cliente='".$myrow24['numCliente']."' order by keyRC DESC
   
";
$result1=mysql_db_query($basedatos,$sSQL1); 
$myrow1 = mysql_fetch_array($result1);	
		
		?>
        <option 
		<?php 
if($myrow1['tipo'] ==$resCombo['tipo']){ 
		
		echo 'selected="selected"';
		
		
		 } ?>
		value="<?php echo $resCombo['tipo']; ?>"><?php echo $resCombo['descripcion']; ?></option>
        <?php } ?>
        </select>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
         <input name="cliente[]" type="hidden" value="<?php echo $myrow24['numCliente'];?>"></input><?php */?>
	     <?php }?>
        
        
        
        
    </td>
    
    
     </tr>     
   </table>
     <br></br>
     <div  align="center">     
     <input name="flag" type="hidden" value="<?php echo $a;?>"></input>
    
     </div>
 
</form>



 <p align="center">&nbsp;</p>


<script type="text/javascript">
   Calendar.setup({
    inputField     :    "campo_fecha1",     // id del campo de texto
     ifFormat     :    "%Y-%m-%d",      // formato de la fecha que se escriba en el campo de texto
     button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario
});
</script>
</body>
</html>