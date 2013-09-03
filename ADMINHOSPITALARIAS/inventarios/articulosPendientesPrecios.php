<?PHP require("/var/www/html/sima/ADMINHOSPITALARIAS/menuOperaciones.php"); ?>
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=700,height=600,scrollbars=YES") 
} 
</script> 
<?php
$numeroE=$_GET['numeroE'];
$nCuenta=$_GET['nCuenta'];
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


<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  
//valida que el campo no este vacio y no tenga solo espacios en blanco   
function valida(F) {   
           
        if( vacio(F.medico.value) == false ) {   
                alert("Por Favor, escoje un m�dico que va a atender a este paciente!")   
                return false   
        } else if( vacio(F.paciente.value) == false ) {   
                alert("Por Favor, escribe el nombre del paciente!")   
                return false   
        } else if( vacio(F.seguro.value) == false ) {   
                alert("Por Favor, escoje alg�n tipo de seguro, o tambi�n si es particular!")   
                return false   
        }            
}   
  
  
  
  
</script> 


  
  
  
  
  
<?php 
if($_GET['elimina']=='si' AND $_GET['keyC']!=NULL){

	
$q = "UPDATE  precioArticulos 
    set
    fechaCargo='".$fecha1."',horaCargo='".$hora1."',usuario='".$usuario."'


		WHERE 
keyC='".$_GET['keyC']."'
";
		mysql_db_query($basedatos,$q);
		echo mysql_error();


echo '<blink>'.'Precio Actualizado'.'</blink>';


$sSQL1= "SELECT
* 
FROM 
politicasPrecios
where 
entidad='".$entidad."'    
";

$result1=mysql_db_query($basedatos,$sSQL1);
while($myrow1 = mysql_fetch_array($result1)){
$codigo+=1;
$a+=1;
if($col){
$color = '#FFCCFF';
$col = "";
} else {
$color = '#FFFFFF';
$col = 1;
}




//$sSQL1a= "SELECT
//* 
//FROM 
//articulos
//where
//entidad='".$entidad."'
//    and
//codigo='".$myrow1['codigo']."'
//";
//
//$result1a=mysql_db_query($basedatos,$sSQL1a);
//$myrow1a = mysql_fetch_array($result1a);




    
    
    
$sSQL7a= "Select * From articulosPrecioNivel where entidad='".$entidad."' and 
almacen='".$myrow1['almacen']."' and codigo='".$_GET['codigo']."'";
$result7a=mysql_db_query($basedatos,$sSQL7a); 
while($myrow7a = mysql_fetch_array($result7a)){
    
    
  $sSQL1a= "SELECT
* 
FROM 
precioArticulos
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
    and
    status='request'
order by keyC DESC
";

$result1a=mysql_db_query($basedatos,$sSQL1a);
$myrow1a = mysql_fetch_array($result1a);



if($myrow1['porcentaje']>0 and $myrow1a['costo']>0){

$porcentajePS=1-round(($myrow7a['nivel1']/$myrow7a['nivel3']),2);
$nivel1=($myrow1a['costo']+($myrow1a['costo']*$myrow1['porcentaje'])/100);
$nivel3=$nivel1+($nivel1*$porcentajePS);


$agrega = "UPDATE precioArticulos set
status='final'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."'
and
status='request'
order by  keyC DESC
";

mysql_db_query($basedatos,$agrega);
echo mysql_error();

$agrega1 = "UPDATE articulosPrecioNivel set
nivel1='".$nivel1."',
    nivel3='".$nivel3."'
where
entidad='".$entidad."'
    and
codigo='".$myrow7a['codigo']."' 
and
almacen='".$myrow7a['almacen']."'
";

mysql_db_query($basedatos,$agrega1);
echo mysql_error();
}


}
}
}
?>  
  
  
  
  
  
  
  
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<?php
$estilo= new muestraEstilos();
$estilo-> styles();
?>
</head>

<body>
 <h1 align="center" class="titulos">Articulos Capturados por OC sin actualizar</h1>
 <form id="form2" name="form2" method="post" >

 <img src="/sima/imagenes/bordestablas/borde1.png" width="500" height="15" />
 <table width="500" border="0" align="center" cellpadding="3" cellspacing="0" class="style12">
     <tr bgcolor="#330099">
       <th width="2" bgcolor="#FFFF00"  scope="col">#</th>
       
       

	   

       <th width="180" bgcolor="#FFFF00"  scope="col"><div align="left" class="normal">
         <div align="center">Descripcion</div>
       </div></th>

       <th width="10" bgcolor="#FFFF00"  scope="col"><div align="left" class="normal">
         <div align="center">usuario</div>
       </div></th>

       
       <th width="10" bgcolor="#FFFF00"  scope="col"><div align="left" class="normal">
         <div align="center">fecha</div>
       </div></th>
       <th width="40" bgcolor="#FFFF00"  scope="col"><div align="left" class="normal">
         <div align="center">hora</div>
       </div></th>
       
              <th width="30" bgcolor="#FFFF00"  scope="col"><div align="left" class="normal">
         <div align="center">Costo</div>
       </div></th>
       
         <th width="30" bgcolor="#FFFF00"  scope="col"><div align="center" class="normal">
         <div align="center">---</div>
       </div></th>
       

       
   </tr>
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   

<?php   
$sSQL= "Select * From precioArticulos where entidad='".$entidad."'
and
status='request'
and
descripcionArticulo!=''
order by descripcionArticulo ASC

;
";
$result=mysql_db_query($basedatos,$sSQL); 

	

while($myrow = mysql_fetch_array($result)){
$a+=1;








?>
<tr bgcolor="#FFFFFF" onMouseOver="bgColor='#ffff33'" onMouseOut="bgColor='#ffffff'" >
 <td bgcolor="<?php echo $color;?>" class="normal"><?php echo $a; ?></td> 


 

 

       <td bgcolor="<?php echo $color;?>" class="normal"><div align="left"><?php 
	   echo $myrow['descripcionArticulo'];
	   
	   ?></div></td>
       <td bgcolor="<?php echo $color;?>" class="normal">
         <div align="center">
           <?php 
	 
	   echo $myrow['usuario'];
	 
	   ?>
       </span></span></div></td>



       
       
       

       <td  class="normal"><div align="right">
<?php echo $myrow['fecha'];?>
         </span></span></div></td>
         
         
         
       <td  class="normal"><div align="right">
<?php echo $myrow['hora'];?>
       </span></span></div></td>
       
       
              <td  class="normal"><div align="right">
<?php echo '$'.number_format($myrow['costo'],2);?>
       </span></span></div></td>
       
       
       
                     <td  class="normal"><div align="right">
             <a href="articulosPendientesPrecios?elimina=si&keyC=<?php echo $myrow['keyC'];?>&codigo=<?php echo $myrow['codigo'];?>&almacen=<?php echo $_GET['almacen'];?>">
            Actualizar

              
             </a>
       </span></span></div></td>
       
       
       
    </tr>
	
	<?php } ?>
   </table>
 <img src="/sima/imagenes/bordestablas/borde2.png" width="500" height="15" />
<p>&nbsp;</p>
<div class="normalmid">

</div></p>
 </form>


</body>
</html>