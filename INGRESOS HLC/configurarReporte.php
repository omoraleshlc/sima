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

<h1 align="center">Saldo de Aseguradoras</h1>
<p>
   Fecha de Apertura: <?php 
   $sSQLp= "Select fechaApertura from entidades
WHERE
codigoEntidad='".$entidad."'


";


$resultp=mysql_db_query($basedatos,$sSQLp);
$myrowp = mysql_fetch_array($resultp);
echo cambia_a_normal($myrowp['fechaApertura']);


$_POST['fechaInicial']=$myrowp['fechaApertura'];

   ?>
</p>






 <form id="form2" name="form2" method="post" action="">
 







  
   <table width="500" class="table table-striped">

         <th width="10"  >#</th>
       <th width="100"  ><span >Nombre Aseguradora</span></th>
       <th width="30"  >Detalles</th>

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



<tr  onMouseOver="bgColor='#ffff99'" onMouseOut="bgColor='#ffffff'" > 
       <td >
<?php

echo $a;
?></td>    
    
       <td >
<?php

echo $myrow24['nomCliente'];
?></td>
      
    
    

      <td >
<a  href="javascript:ventanaSecundaria2('../cargos/detallesClientes.php?nombre=<?php echo $myrow24['nomCliente'];?>&numCliente=<?php echo $myrow24['numCliente'];?>&seguro=<?php echo $myrow24['numCliente'];?>&nombreCliente=<?php echo $myrow24['nomCliente']; ?>&usuario=<?php echo $usuario; ?>&keyPA=<?php echo $myrow['keyPA']; ?>')">
Ver
</a>

      </td>
     </tr>     <?php } ?>
   </table>

   <p align="center"><label></label>
 </p>
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