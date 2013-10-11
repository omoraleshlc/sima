<?php require("/configuracion/ventanasEmergentes.php");
$link = pg_Connect("host=192.168.1.13 dbname=carlota user=postgres password=postgres port=5432");
require('/configuracion/funciones.php');

$ventana='ventanaModificaClientes.php';
$ventana1='despliegaSubClientes.php';

?>

<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=550,height=400,scrollbars=YES") 
} 
</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=700,height=700,scrollbars=YES") 
} 
</script> 


<script language=javascript> 
function ventanaSecundaria2 (URL){ 
   window.open(URL,"ventanaSecundaria2","width=900,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>  



<script language=javascript> 
function ventanaSecundaria20 (URL){ 
   window.open(URL,"ventanaSecundaria20","width=800,height=600,scrollbars=YES,resizable=YES, maximizable=YES") 
} 
</script>  


<?php 
//ventanaCentro=new ventanasCentro();
//$ventanaCentro->despliegaVentanaCentro('blue','0.5','800','600','800','400','800','500');
?>



<?php 
if($_POST['actualizar'] ){
$saldoInicial=$_POST['saldoInicial'];
$keyClientes=$_POST['keyClientes'];

    for($i=0;$i<=$_POST['contador'];$i++){


    if($saldoInicial>-1){
 $q = "UPDATE clientes set 
saldoInicial='".$saldoInicial[$i]."'
WHERE 
keyClientes='".$keyClientes[$i]."'";
mysql_db_query($basedatos,$q);
echo mysql_error();
}}}






if($_POST['numCliente2']){
$sSQL2= "Select * From clientes WHERE entidad='".$entidad."' AND numCliente = '".$_POST['numCliente2']."' ";
$result2=mysql_db_query($basedatos,$sSQL2);
$myrow2 = mysql_fetch_array($result2);
}
?>








   
   
   
   
   





  



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?php
$estilo=new muestraEstilosV2();
$estilo->styles();

?>

</head>

<body>
    

    
    
    
<?php
###PARAMETROS GENERALES
$numPoliza=$_POST['numPoliza'];
$concepto_id=14;
$idLibro=$_POST['id_libro'];
$id_ejercicio=$_POST['id_ejercicio'];
$id_ccosto=$_POST['id_ccosto'];


?>
    
    
    
    
    
    
    
    
    

    
    
  <header >
  <div class="container">   
<div class="barra_separadora">
     
     <span >Cuentas por Cobrar</span>
     
</div>    
    

<h3>Reporte de saldos iniciales</h3>
    

<?php if($id_ejercicio!=null){?>
<h5>Ejercicio: <?php print $id_ejercicio;?></h5>
<?php }?>



<?php 
$menuPrimario=new menus();
$menuPrimario->menuOperacionesBoot('../INGRESOS HLC/menuOperaciones.php?main=INGRESOS&warehouse=CXC&datawarehouse=','Menu Principal ','INGRESOS','CxC',$rutasalir,$rutapasswd,$usuario,$entidad,$rutamenuprincipal,$tipomodulo,$rutaimagen,$basedatos);
?>
     
      

  <form id="form2" name="form2" method="post" action="">


<div class="well" align="center">
        <fieldset>    

            
             
            
            
            
      <div class="input-medium"  >
       <span >
   <select name="id_ejercicio" class="form-control" onChange="this.form.submit();" />
<option value="">Ejercicio</option>

  <?php 
$sqlNombre11a = "SELECT * from mateo.cont_ejercicio order by id_ejercicio ASC";
$result1=pg_query($link,$sqlNombre11a); 


?>

  <?php
  while ($rNombre11a=pg_fetch_array($result1)){ 
  echo mysql_error();?>
  <option
    <?php   if($_POST['id_ejercicio']==$rNombre11a["id_ejercicio"] and $_POST['id_ejercicio']!='')echo 'selected'; ?>
   value="<?php echo $rNombre11a["id_ejercicio"];?>"> <?php echo $rNombre11a["nombre"];?></option>
  <?php } ?>
</select>
  </span>
    
    </div>      
            
            

      
            
    
     <div class="input-medium"  >
       <span >
   <select name="id_ccosto" class="form-control" />
<option value="">Centro de Costo</option>



<?php
 $sSQL1= "
SELECT * from mateo.cont_ccosto
WHERE
id_ejercicio='".$id_ejercicio."'
    and
CHAR_LENGTH(id_ccosto)=4       
order by nombre    
   
";
 
 
$result1=pg_query($link,$sSQL1); 
while ($myrow1 = pg_fetch_array($result1)){ 
  echo mysql_error();?>
  <option
    <?php   if($_POST['id_ccosto']==$myrow1["id_ccosto"] and $_POST['id_ccosto']!='')echo 'selected'; ?>
   value="<?php echo $myrow1["id_ccosto"];?>"> <?php echo $myrow1["nombre"];?></option>
  <?php } ?>
</select>
  </span>
    
    </div>
            
         
       
            
            
            
            
            
            
            
            
<div class="input-medium"  >
       <span >
   <select name="id_libro" class="form-control" />
<option value="">Libro</option>



<?php
 $sSQL1= "
SELECT * from mateo.cont_libro
WHERE 
id_ejercicio='".$id_ejercicio."'
 order by nombre ASC  
";
 
 
$result1=pg_query($link,$sSQL1); 
?>

  <?php
  while ($myrow1a = pg_fetch_array($result1)){ 
  echo mysql_error();?>
  <option
    <?php   if($_POST['id_libro']==$myrow1a["id_libro"] and $_POST['id_libro']!='')echo 'selected'; ?>
   value="<?php echo $myrow1a["id_libro"];?>"> <?php echo $myrow1a["nombre"];?></option>
  <?php } ?>
</select>
  </span>
    
    </div>             
            
            
        
    <div >  
   
    <input name="numPoliza" type="text" class="form-control" placeholder="Numero de Poliza" value="<?php echo $_POST['numPoliza'];?>">

  
    </div>       
    
    
            <div class="input btn-small">         
    <button type="submit" name="search" class="btn btn-primary" data-loading-text="Cargando...">Buscar</button>    
            </div>
    
    </fieldset> 
    </div>       
      
      
      
      

   <table class="table table-hover">
     <tr >
         
       <th >
     
     <div align="left" >
         # 
       </div></th>         
         
       <th>

         <div align="left">Auxiliar </div>
     </th>
       
       <th ><div align="left" >
     Nombre del Cliente 
       </div></th>
	   

	   
       <th width="75"   scope="col"><div align="left">SaldoSima</div></th>
   <th width="75"   scope="col"><div align="left">SaldoVirtual</div></th>
   <th width="75"   scope="col"><div align="left">Diferencia</div></th>
   
   
   
   
     </tr>
     <div align="center">
<?php   




$sSQL= "Select * From clientes where entidad='".$entidad."' 
 AND
 subCliente=''
AND
clientePrincipal=''
 AND
 tipoCliente='Compania'

 order by nomCliente ASC";

 
$result=mysql_db_query($basedatos,$sSQL); 
while($myrow = mysql_fetch_array($result)){

$contador+=1;

 $sSQL1= "

SELECT 
sum(importe) as t
FROM 
  mateo.cont_movimiento
  WHERE
  id_auxiliarm='".$myrow['ID_AUXILIAR']."'
      and
  folio='".$numPoliza."'
and
id_ejercicio='".$id_ejercicio."'
and
id_libro='".$idLibro."'
and
id_ccosto='".$id_ccosto."'
   
";
 
 
$result1=pg_query($link,$sSQL1); 
$myrow1 = pg_fetch_array($result1);
?>
     </div>
     <tr  > 
         
       <td height="20" ><div align="left">       
           <?php echo $contador;?></div>
       
       <div align="left"></div></td>  
         
       <td height="20" ><div align="left">       
           <?php echo $myrow['ID_AUXILIAR'];?></div>
       
       <div align="left"></div></td>
       <td ><div align="left">
         
         <?php echo $myrow['nomCliente'];?>	  
       </div></td>
       
	   
	   

	<?php
        $diff=$myrow['saldoInicial']-$myrow1['t'];
        
        if($diff==0){
        $class=null;    
        }else{
        $class= 'label label-danger';
        }
        ?>
         
         
	
       <td ><div align="center" >  	
         <div align="center">
    
             <?php 
             $saldoSIMA[0]+=$myrow['saldoInicial'];
             echo '$'.number_format($myrow['saldoInicial'],2);?>
          
         </div>
       </div></td>

       
   <td ><div align="center" >  	
         <div align="center">
       
             <?php
             $saldoVirtual[0]+=$myrow1['t'];
             echo '$'.number_format($myrow1['t'],2);?>
           
         </div>
       </div></td>  
         
         
         

<td ><div align="center" >  	
         <div align="center">
             <span class="<?php echo $class;?>">
             <?php
             $diferencia[0]+=($myrow['saldoInicial']-$myrow1['t']);
             echo '$'.number_format($myrow['saldoInicial']-$myrow1['t'],2);?>
             </span>
             

         </div>
       </div></td>           
         
         
       </div> 
       
     </tr>
     <?php }?>
       
       
       
       <tr>
<td></td>
<td></td>
<td>Totales</td>
<td><?php echo '$'.number_format($saldoSIMA[0],2);?></td>
<td><?php echo '$'.number_format($saldoVirtual[0],2);?></td>
<td></td>           
       </tr>  
       
       <tr>
<td></td>
<td></td>
<td>Diferencia</td>
<td><?php //echo '$'.number_format($saldoSIMA[0],2);?></td>
<td><?php //echo '$'.number_format($saldoSIMA[0],2);?></td>
<td><?php echo '$'.number_format($diferencia[0],2);?></td>
           
       </tr>        
       
   </table>

   
</form>
  </div>
  </header>
</body>
</html>
