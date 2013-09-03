<?PHP require("menuOperaciones.php"); ?>
<?php 
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
$ventanaCentro=new ventanasCentro();
$ventanaCentro->despliegaVentanaCentro('blue','0.5','800','600','800','400','800','500');
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


 
<script type="text/javascript" src="/sima/js/wz_tooltip.js"></script>  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
$estilo= new muestraEstilos();
$estilo->styles();

?>

</head>

<body onLoad="inicio();">
 <h1 align="center" class="titulos">Editar Saldo Inicial</h1>

  <form id="form2" name="form2" method="post" action="">


   <table width="666" class="table table-striped">
     <tr >
       <th width="72"  scope="col"><div align="left" >
         <div align="center">Codigo </div>
       </div></th>
       <th width="349"  scope="col"><div align="left" >
         <div align="center">Nombre del Cliente </div>
       </div></th>
	   

	   
       <th width="75"   scope="col"><div align="center">SaldoInicial</div></th>
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
?>
     </div>
     <tr  > 
       <td height="20" ><div align="left">       <?php echo $myrow['numCliente'];?></div>
         <label></label>
       <div align="left"></div></td>
       <td ><div align="left">
         
         <?php echo $myrow['nomCliente'];?>	  
       </div></td>
       
	   
	   

	   
	   
       <td ><div align="center" >  	
         <div align="center">
             <input type="text" name="saldoInicial[]" size="20" value="<?php echo $myrow['saldoInicial'];?>"></input>
                    <input type="hidden" name="contador" size="20" value="<?php echo $contador;?>"></input>
                        <input type="hidden" name="keyClientes[]" size="20" value="<?php echo $myrow['keyClientes'];?>"></input>
             </div>
       </div></td>

     </tr>
     <?php }?>
   </table>

   <p align="center">
     <input name="actualizar" type="Submit"  id="nuevo" value="Actualizar Saldos"
	  />
   </p>
</form>

</body>
</html>

