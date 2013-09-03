<?PHP require("menuOperaciones.php"); ?>




<script language="javascript" type="text/javascript">

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





<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventanaSecundaria","width=800,height=600,scrollbars=YES")
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



 <form id="form1" name="form1" method="post" >
  <h1 align="center">SURTIR ARTICULOS  A GRANEL</h1>


  <br></br>

  

  <table width="400" class="table table-striped">

    <tr >
      <th width="5" >#</th>


 <th width="50" >Departamento</th>    

<th width="13" >---</th>
    </tr>
      
      
      
<?php
$cendis=new whoisCendis();

$sSQL= "
SELECT *
FROM
existencias
where

entidad='".$entidad."'
and
ventaGranel='si' and
almacen!=''
and
almacen!='".$cendis->cendis($entidad,$basedatos)."'
and
cantidadSurtir>0
group by almacen
order by keyE ASC
";

$result=mysql_db_query($basedatos,$sSQL);
while($myrow = mysql_fetch_array($result)){
$a+=1;

$fV[0]=$myrow['folioVenta'];
$sSQL8aa= "
SELECT descripcion
FROM
almacenes
WHERE
entidad='".$entidad."'
    and

 almacen='".$myrow['almacen']."'

";
$result8aa=mysql_db_query($basedatos,$sSQL8aa);
$myrow8aa = mysql_fetch_array($result8aa);

$sSQLa= "
SELECT sum(cantidad) as s
FROM
movSolicitudes
WHERE
entidad='".$entidad."'
    and
    almacen='".$myrow['almacen']."'
and
keyPA='".$myrow['keyPA']."'
and
status='request'
and
tipoVenta='Granel'
";
$resulta=mysql_db_query($basedatos,$sSQLa);
$myrowa = mysql_fetch_array($resulta);

 $sSQL8aab= "
SELECT cantidadSurtir
FROM
existencias
WHERE
entidad='".$entidad."'
    and

 almacen='".$myrow['almacen']."'
and
codigo='".$myrow['codigo']."'
";
$result8aab=mysql_db_query($basedatos,$sSQL8aab);
$myrow8aab = mysql_fetch_array($result8aab);
?>

	  <tr >
      <td  ><?php echo $a;?></td>
      





      <td >
          <span >
        <?php
		echo $myrow8aa['descripcion'];                
		?>          
          <?php echo '<br>';
                //echo 'Usuario: '. $myrow['usuario'];?>
          </span>
      </td>


      

      
<td >


        <a href="#"  onclick="nueva('../ventanas/surtirGranel.php?solicita=<?php echo $myrowa['s'];?>&solicitud=<?php echo $myrow['keySAL'];?>&almacen=<?php echo $myrow['almacen'];?>','ventanaSecundaria','900','500','yes')">
         Cargar
         </a>

    
</td>
      
      
    </tr>
    <?php  }?>

  </table>

  <p>&nbsp;</p>
  <p align="center"><span >

  </span></p>
</form>
</body>
</html>
