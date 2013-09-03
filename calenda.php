<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-Hoja de estilos del calendario --> 
<script src="/sima/js/jquery.js" type="text/javascript"></script>
<script src="/sima/js/prototype.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" media="all" href="/calendar/blue.css" title="win2k-cold-1" />
  <!-- librería principal del calendario --> 
 <script type="text/javascript" src="/calendar/calendar_dale_select.js"></script> 

 <!-- librería para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="/calendar/format_american.js"></script> 

  <!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
  <script type="text/javascript" src="/sima/calendario/calendar-setup.js"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<th width="49" class="negro" scope="col"><span class="Estilo25">
        <input name="button" type="image"  id="lanzador" value="fecha"  src="/sima/imagenes/btns/fechadate.png"/>
        
        
         <script type="text/javascript"> 
   Calendar.setup({ 
    inputField     :    "campo_fecha",     // id del campo de texto 
     ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
     button     :    "lanzador"     // el id del botón que lanzará el calendario 
}); 
</script>
</body>
</html>
