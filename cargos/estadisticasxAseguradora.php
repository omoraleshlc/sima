<?php require("/configuracion/ventanasEmergentes.php"); ?>
<?php require('/configuracion/funciones.php'); ?>
<script language="javascript" type="text/javascript">   

function vacio(q) {   
        for ( i = 0; i < q.length; i++ ) {   
                if ( q.charAt(i) != " " ) {   
                        return true   
                }   
        }   
        return false   
}   
  

function valida(F) {   
      
        if( vacio(F.clientePrincipal.value) == false ) {   
                alert("Por Favor, escoje el clientePrincipal/departamento!")   
                return false   
        } else if( vacio(F.descripcion.value) == false ) {   
                alert("Por Favor, escribe la descripci�n de este clientePrincipal!")   
                return false   
        } else if( vacio(F.ctaContable.value) == false ) {   
                alert("Por Favor, escoje la cuenta mayor!")   
                return false   
        }            
}   

</script> 

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=500,scrollbars=YES") 
} 
</script> 
<script language=javascript> 
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana","width=700,height=600,scrollbars=YES") 
} 
</script>
<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=700,height=600,scrollbars=YES") 
} 
</script>
	<?php 		
$sSQL7ab="SELECT descripcionGP
FROM
gpoProductos
WHERE

codigoGP='".$_GET['gpoProducto']."'

";
$result7ab=mysql_db_query($basedatos,$sSQL7ab);
$myrow7ab = mysql_fetch_array($result7ab);
echo $myrow7ab['descripcionGP'];
?>


 <!-Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="/sima/calendario/calendar-brown.css" title="win2k-cold-1" />
  <!-- librer�a principal del calendario --> 
 <script type="text/javascript" src="/sima/calendario/calendar.js"></script> 
 <!-- librer�a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/sima/calendario/lang/calendar-es.js"></script> 
  <!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 

<script language="javascript" type="text/javascript">

var win = null;
function nueva(mypage,myname,w,h,scroll){

LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings ='height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
if(win.window.focus){win.window.focus();}
}

</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="/sima/js/scripts/autocomplete.js" type="text/javascript"></script>
<link rel="stylesheet" href="/sima/js/stylesheets/autocomplete.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<?php
$estilos= new muestraEstilos();
$estilos->styles();

?>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
}
.Estilo24 {font-size: 10px}
-->
</style>
</head>

<body>
<?php
// The message
$message = "Line 1\nLine 2\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
//mail('hlacarlota@', 'My Subject', $message);
?>
<br />
<br />
<form id="form2" name="form2" method="post"><div align="center">
     <h1 class="titulomedio">
Estadisticas por Seguros</h1>
   <p class="titulomedio">

       Mes  <?php echo $_GET['mes'];?>, del ano: <?php echo $_GET['year'];?>

   </p>
   
   <table width="1000" border="0" cellspacing="0" cellpadding="0" align="center">
     <tr>
       <td colspan="30">&nbsp;</td>
     </tr>
     <tr>
       <td colspan="30"><img src="/sima/imagenes/bordestablas/borde1.png" alt="bo1" width="1000" height="21" /></td>
     </tr>
     <tr bgcolor="#FFFF00">
       <td width="207" bgcolor="#FFFF00" class="negromid"><div align="center">Seguro</div></td>
	   
<?php 

/* function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array()){
    $first_of_month = gmmktime(0,0,0,$month,1,$year);

    #remember that mktime will automatically correct if invalid dates are entered
    # for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
    # this provides a built in "rounding" feature to generate_calendar()

    $day_names = array(); #generate all the day names according to the current locale
    for($n=0,$t=(3+$first_day)*86400; $n<7; $n++,$t+=86400) #January 4, 1970 was a Sunday
        $day_names[$n] = ucfirst(gmstrftime('%A',$t)); #%A means full textual day name

    list($month, $year, $month_name, $weekday) = explode(',',gmstrftime('%m,%Y,%B,%w',$first_of_month));
    $weekday = ($weekday + 7 - $first_day) % 7; #adjust for $first_day
    $title   = htmlentities(ucfirst($month_name)).'&nbsp;'.$year;  #note that some locales don't capitalize month and day names

    #Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
    @list($p, $pl) = each($pn); @list($n, $nl) = each($pn); #previous and next links, if applicable
    if($p) $p = '<span class="calendar-prev">'.($pl ? '<a href="'.htmlspecialchars($pl).'">'.$p.'</a>' : $p).'</span>&nbsp;';
    if($n) $n = '&nbsp;<span class="calendar-next">'.($nl ? '<a href="'.htmlspecialchars($nl).'">'.$n.'</a>' : $n).'</span>';
    $calendar = '<table class="calendar">'."\n".
        '<caption class="calendar-month">'.$p.($month_href ? '<a href="'.htmlspecialchars($month_href).'">'.$title.'</a>' : $title).$n."</caption>\n<tr>";

    if($day_name_length){ #if the day names should be shown ($day_name_length > 0)
        #if day_name_length is >3, the full name of the day will be printed
        foreach($day_names as $d)
            $calendar .= '<th abbr="'.htmlentities($d).'">'.htmlentities($day_name_length < 4 ? substr($d,0,$day_name_length) : $d).'</th>';
        $calendar .= "</tr>\n<tr>";
    }

    if($weekday > 0) $calendar .= '<td colspan="'.$weekday.'">&nbsp;</td>'; #initial 'empty' days
    for($day=1,$days_in_month=gmdate('t',$first_of_month); $day<=$days_in_month; $day++,$weekday++){
        if($weekday == 7){
            $weekday   = 0; #start a new week
            $calendar .= "</tr>\n<tr>";
        }
        if(isset($days[$day]) and is_array($days[$day])){
            @list($link, $classes, $content) = $days[$day];
            if(is_null($content))  $content  = $day;
            $calendar .= '<td'.($classes ? ' class="'.htmlspecialchars($classes).'">' : '>').
                ($link ? '<a href="'.htmlspecialchars($link).'">'.$content.'</a>' : $content).'</td>';
        }
        else $calendar .= "<td>$day</td>";
    }
    if($weekday != 7) $calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>'; #remaining "empty" days

    return $calendar."</tr>\n</table>\n";
}
echo generate_calendar(2010, 12, 16,3,NULL,0,15, $first_of_month, $day_names, $day_names[$n]);
#echo generate_calendar($year, $month, $days,$day_name_length,$month_href,$first_day,$pn); */

//-----------------------------
/* $now = time();
$num = date("w");
if ($num == 0)
{ $sub = 6; }
else { $sub = ($num-1); }
$WeekMon  = mktime(0, 0, 0, date("m", $now)  , date("d", $now)-$sub, date("Y", $now));    //monday week begin calculation
$todayh = getdate($WeekMon); //monday week begin reconvert

$d = $todayh[mday];
$m = $todayh[mon];
$y = $todayh[year];
echo "$d-$m-$y"; //getdate converted day */

  function get_first_day($day_number=1, $month=false, $year=false)
  {
    $month  = ($month === false) ? strftime("%m"): $month;
    $year   = ($year === false) ? strftime("%Y"): $year;
   
    $first_day = 1 + ((7+$day_number - strftime("%w", mktime(0,0,0,$month, 1, $year)))%7);
 
    return mktime(0,0,0,$month, $first_day, $year);
  }




$diaEnglish= strftime("%a", get_first_day($i, $_GET['mes'], $_GET['year'])); 

/*
Monday-Lunes.
Tuesday-Martes.
Wednesday-Mi�rcoles.
Thursday-Jueves.
Friday-Viernes.
Saturday-S�bado.
Sunday-Domingo. 
*/

switch ($diaEnglish) {

   case "Sunday" :
   $dias="Dom";
   break;

   case "Monday" :
   $dias="Lun";
   break;

   case "Tuesday" :
   $dias="Mar";
   break;

   case "Wednesday" :
   $dias="Mie";
   break;   

   case "Thursday" :
   $dias="Jue";
   break;   

   case "Friday" :
   $dias="Vie";
   break;   

   case "Saturday" :
   $dias="Sab";
   break;   

default:
$dias="NONE";
break;

   }



$diasNum = cal_days_in_month(CAL_GREGORIAN, $_GET['mes'], $_GET['year']); // 31

 

function nameDate($fecha='')//formato: 00/00/0000
{ 	$fecha= empty($fecha)?date('d/m/Y'):$fecha;
	$dias = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
	$dd   = explode('/',$fecha);
	$ts   = mktime(0,0,0,$dd[1],$dd[0],$dd[2]);
	return $dias[date('w',$ts)];
}

//************SOLO ENTRAN HONORARIOS MEDICOS*******************
$sSQL2a1= "Select * From modulosGrupos WHERE entidad='".$entidad."' AND clasificacion='HONMED'  ";
$result2a1=mysql_db_query($basedatos,$sSQL2a1);
$myrow2a1 = mysql_fetch_array($result2a1);
$gpoProducto=$myrow2a1['clasificacion'];
$gpoProducto=$_GET['gpoProducto'];
//**************************************************************
?>	   








			

<?php for($i=1;$i<=$diasNum;$i++){ ?>
       <td width="30" bgcolor="#FFFF00" class="normal">
	        <p><?php echo $i;?></p>
			<p>
			<?php
//$diaEnglish= strftime("%a", get_first_day("1", $_GET['mes'], $_GET['year'])); 

$diaEnglish= nameDate($i.'/'.$_GET['mes'].'/'.$_GET['year']);
/*
Monday-Lunes.
Tuesday-Martes.
Wednesday-Mi�rcoles.
Thursday-Jueves.
Friday-Viernes.
Saturday-S�bado.
Sunday-Domingo. 
*/

switch ($diaEnglish) {

   case "Sun" :
   $dias="Dom";
   break;

   case "Mon" :
   $dias="Lun";
   break;

   case "Tue" :
   $dias="Mar";
   break;

   case "Wed" :
   $dias="Mie";
   break;   

   case "Thu" :
   $dias="Jue";
   break;   

   case "Fri" :
   $dias="Vie";
   break;   

   case "Sat" :
   $dias="Sab";
   break;   

default:
$dias="NONE";
break;

   }

			 
		print ' '.$dias.' ';

			?>
			
			</p>
			
			</td>
			<?php } ?>




	    <td width="40"  class="precio1" align="right">
	     
		
			  <p>Total</p>
			</td>



	    <td width="50" bgcolor="#FFFF00" class="normal" align="right">
	      
		
			   <p>1Vez</p>
			</td>


     </tr>
<?php 




  $sSQL2= "Select * From cargosCuentaPaciente
      where
entidad='".$entidad."'
    and
almacenSolicitante='".$_GET['almacen']."'
and
mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
and
seguro!=''
and
clientePrincipal!=''
and
gpoProducto='".$gpoProducto."'
  and
  descripcionClientePrincipal!=''
group by clientePrincipal

order by descripcionClientePrincipal ASC

 ";
$result2=mysql_db_query($basedatos,$sSQL2); 
while($myrow2 = mysql_fetch_array($result2)){
//echo $myrow2['clientePrincipal'];


?>

     <tr bgcolor="#ffffff" onMouseOver="bgColor='#cccccc'" onMouseOut="bgColor='#ffffff'" >
       <td height="48" bgcolor="<?php echo $color;?>" class="normal"><div align="left">
         <?php 
/*  echo $myrow6['numCliente'];
 echo '<br>'; */
         if($myrow2['descripcionClientePrincipal']){
 echo $myrow2['descripcionClientePrincipal'];
         }else{
          echo 'Aseguradora Cambiada o dada de baja'   ;
         }
		  ?>
       </div></td>











<?php for($i=1;$i<=$diasNum;$i++){ ?>
       <td bgcolor="<?php echo $color;?>" class="normal">
	     <p>
<?php 


		   
$sSQL6= "Select sum(cantidad) as c  From cargosCuentaPaciente where
    entidad='".$entidad."'
        and
almacenSolicitante='".$_GET['almacen']."'


and
clientePrincipal='".$myrow2['clientePrincipal']."'
and

diaNumerico='".$i."'
and
mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
    and
    naturaleza='C'
    and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''

";
$result6=mysql_db_query($basedatos,$sSQL6); 
$myrow6 = mysql_fetch_array($result6);


$sSQL6g= "Select sum(cantidad) as dev  From cargosCuentaPaciente where
    entidad='".$entidad."'
        and
almacenSolicitante='".$_GET['almacen']."'
and
clientePrincipal='".$myrow2['clientePrincipal']."'
and

diaNumerico='".$i."'
and
mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
    and
    naturaleza='A'
    and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''

";
$result6g=mysql_db_query($basedatos,$sSQL6g);
$myrow6g = mysql_fetch_array($result6g);

$diaTotal[0]+=$myrow6['c']-$myrow6g['dev'];



if($myrow6['c']>0){

	   echo $myrow6['c']-$myrow6g['dev'];
}else{
echo '-';
}	   
	   
	   
	   
$sSQL6a= "Select sum(cantidad) as c  From cargosCuentaPaciente where
    entidad='".$entidad."'
                and
almacenSolicitante='".$_GET['almacen']."'
and
clientePrincipal='".$myrow2['clientePrincipal']."'
and

mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
and
naturaleza='C'
and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$result6a=mysql_db_query($basedatos,$sSQL6a); 
$myrow6a = mysql_fetch_array($result6a);		 



$sSQL6ad= "Select sum(cantidad) as c  From cargosCuentaPaciente where

entidad='".$entidad."'
            and
almacenSolicitante='".$_GET['almacen']."'
and
clientePrincipal='".$myrow2['clientePrincipal']."'
and

mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
and
naturaleza='A'
and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$result6ad=mysql_db_query($basedatos,$sSQL6ad); 
$myrow6ad = mysql_fetch_array($result6ad);		







//***************************************PRIMERA VEZ***********************************
	 


$fechaInicial=$_GET['year'].'-'.$_GET['mes'].'-'.'01';
$fechaFinal=$_GET['year'].'-'.$_GET['mes'].'-'.'31';




 $sSQLci1= "

Select sum(cantidad) as pV
    From cargosCuentaPaciente
    where
entidad='".$entidad."'

    and
clientePrincipal='".$myrow2['clientePrincipal']."'
    and
    (fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
    almacenSolicitante='".$_GET['almacen']."'
        and
   clientePrincipal!=''
and
        primeraVez='si'
    and
  naturaleza='C'
  and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$resultci1=mysql_db_query($basedatos,$sSQLci1);
$myrowci1 = mysql_fetch_array($resultci1);

  $sSQLci2= "
Select sum(cantidad) as pVDev
    From cargosCuentaPaciente
    where
entidad='".$entidad."'
        and
clientePrincipal='".$myrow2['clientePrincipal']."'
    and
    (fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
         and
   clientePrincipal!=''
    and
    almacenSolicitante='".$_GET['almacen']."'
        and
        primeraVez='si'
    and
  naturaleza='A'
  and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$resultci2=mysql_db_query($basedatos,$sSQLci2);
$myrowci2 = mysql_fetch_array($resultci2);
$tpv=$myrowci1['pV']-$myrowci2['pVDev'];
$tft[0]+=$tpv;
//************************************************************************************


$total[0]=$myrow6a['c']-$myrow6ad['c'];
?>
        </p>
        </td>
		
		
		
		
		
<?php } ?>




       <td bgcolor="<?php echo $color;?>" class="precio1" align="right">
	     <p>
		 <?php echo ' '. $total[0];?>
        </p>
        </td>


       <td bgcolor="<?php echo $color;?>" class="informativo" align="right">
	     <p>

                 <?php



                 echo ' '. $tpv;?>
        </p>
        </td>


      </tr>

     <?php  


	 }//cierra while?>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	      <tr>
		  
		  
<br />
		  
	        <td bgcolor="<?php echo $color;?>" class="normal" align="left">
	     <p>
		 Total
        </p>
        </td>
	 
<?php for($i=1;$i<=$diasNum;$i++){ ?>
       <td bgcolor="<?php echo $color;?>" class="normal">
	     <p>
<?php 
$sSQL6b= "Select sum(cantidad) as c  From cargosCuentaPaciente where
    entidad='".$entidad."'
        and
almacenSolicitante='".$_GET['almacen']."'
    and
diaNumerico='".$i."'
and
mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
and
naturaleza='C'
and
clientePrincipal!=''
and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$result6b=mysql_db_query($basedatos,$sSQL6b); 
$myrow6b = mysql_fetch_array($result6b);		   


$sSQL6bd= "Select sum(cantidad) as c  From cargosCuentaPaciente
    where
    entidad='".$entidad."'
                and
almacenSolicitante='".$_GET['almacen']."'
and


diaNumerico='".$i."'
and
mes='".$_GET['mes']."'
and
year='".$_GET['year']."'
and
naturaleza='A'
and

clientePrincipal!=''
and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$result6bd=mysql_db_query($basedatos,$sSQL6bd); 
$myrow6bd = mysql_fetch_array($result6bd);		

$t1=$myrow6b['c']-$myrow6bd['c'];

	   echo $t1;
	   
	   
	   
	  $td[0]+=$myrow6b[0]-$myrow6bd[0];
?>
	   </p>
	   
	   </td>
<?php } ?>	   
	   
	   






	          <td bgcolor="<?php echo $color;?>" class="precio1" align="right">
	     <p>
		 <?php

		 echo ' '. $td[0];

		 ?>
        </p>
        </td>


	   
	   	          <td bgcolor="<?php echo $color;?>" class="precio1" align="right">
	     <p>
		 <?php
		//***************************************PRIMERA VEZ***********************************



$fechaInicial=$_GET['year'].'-'.$_GET['mes'].'-'.'01';
$fechaFinal=$_GET['year'].'-'.$_GET['mes'].'-'.'31';



$sSQLci1= "

Select sum(cantidad) as pV
    From cargosCuentaPaciente
    where
entidad='".$entidad."'
    and
    (fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
    and
    almacenSolicitante='".$_GET['almacen']."'
        and
   clientePrincipal!=''
and
        primeraVez='si'
    and
  naturaleza='C'
  and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$resultci1=mysql_db_query($basedatos,$sSQLci1);
$myrowci1 = mysql_fetch_array($resultci1);

  $sSQLci2= "
Select sum(cantidad) as pVDev
    From cargosCuentaPaciente
    where
entidad='".$entidad."'
    and
    (fechaCierre>='".$fechaInicial."' and fechaCierre<='".$fechaFinal."')
         and
   clientePrincipal!=''
    and
    almacenSolicitante='".$_GET['almacen']."'
        and
        primeraVez='si'
    and
  naturaleza='A'
  and
gpoProducto='".$gpoProducto."'
and
  descripcionClientePrincipal!=''
";
$resultci2=mysql_db_query($basedatos,$sSQLci2);
$myrowci2 = mysql_fetch_array($resultci2);
echo $tpv=$myrowci1['pV']-$myrowci2['pVDev'];
$tft[0]+=$tpv;


//************************************************************************************


		 ?>
        </p>
        </td>
	   
	   
	   
	   

     </tr>
	 
	 
	 
	 
	 
     <tr>
	 
	 
       <td colspan="30"><img src="/sima/imagenes/bordestablas/borde2.png" width="1000" height="20" /></td>
     </tr>
   </table>
   <p class="titulomedio">&nbsp;</p>
 </div>
</form>

 
</body>
</html>