<?php 
function hacer_encabezado()
{
return '<div class="error">
Tu Cuenta esta bloqueada... favor de comunicarse a sistemas o desbloquear manualmente, gracias!!

</div>';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es" dir="ltr" xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIMA</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<link href="./jquery/jquery-ui-1.8.custom.css" type="text/css" rel="stylesheet">
<meta content="noindex,nofollow" name="robots">



<script type="text/javascript">
//funcion para crear divs...

function ver(fil) { 

  obj=fil.form; 
  
  tab = document.createElement('div');
  tab.id = 'error';
  tab.class = 'error';
  alert(tab.id)
  alert(tab.class)   
  tab.style.padding = "1px";
  tab.style.border = "1px solid red";
  
  obj.appendChild(tab); 
  
} 


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
           
        if( vacio(F.username.value) == false ) {   
                alert("Por Favor, introduce el nombre de usuario!")   
                return false   
        } else if( vacio(F.password.value) == false ) {   
                alert("Por Favor, escribe tu contraseña!")   
                return false   
        } 
           
}   
  
  

// <![CDATA[
// Updates the title of the frameset if possible (ns4 does not allow this)
if (typeof(parent.document) != 'undefined' && typeof(parent.document) != 'unknown'
    && typeof(parent.document.title) == 'string') {
    parent.document.title = 'SIMA';
}

// ]]>
</script>
<script type="text/javascript">
//<![CDATA[
// show login form in top frame
if (top != self) {
    window.top.location.href=location;
}
//]]>
</script>

</head>
    <br></br> <br></br> <br></br>
<body class="loginform">

<div class="container">

<a class="logo" target="_blank" href="./url.php?url=http%3A%2F%2Fwww.phpmyadmin.net%2F&token=72603d4643928e7ffb16523ff44d47b0">
<img id="imLogo" border="0"  name="imLogo" src="images/simav2.jpg">
</a>
<h1>


</h1>
<!--form target="_parent" action="login.php" method="post">
<input type="hidden" value="" name="db">
<input type="hidden" value="" name="table">
<input type="hidden" value="2f496c7c171afd2ea4935ee284af0e25" name="token">
<fieldset>
<legend dir="ltr" xml:lang="en">
Idioma -
<em>Language</em>
</legend>
<select dir="ltr" xml:lang="en" onchange="this.form.submit();" name="lang">
<option value="ar">العربية - Arabic</option>
<option value="be">Белару�?ка�? - Belarusian</option>
<option value="be@latin">Biełaruskaja - Belarusian latin</option>
<option value="bg">Българ�?ки - Bulgarian</option>
<option value="bn">বাংলা - Bangla</option>
<option value="ca">Català - Catalan</option>
<option value="cs">Česky - Czech</option>
<option value="da">Dansk - Danish</option>
<option value="de">Deutsch - German</option>
<option value="el">Ελληνικά - Greek</option>
<option value="en">English</option>
<option value="en_GB">English (United Kingdom)</option>
<option selected="selected" value="es">Español - Spanish</option>
<option value="et">Eesti - Estonian</option>
<option value="fi">Suomi - Finnish</option>
<option value="fr">Français - French</option>
<option value="gl">Galego - Galician</option>
<option value="hi">हिन�?दी - Hindi</option>
<option value="hr">Hrvatski - Croatian</option>
<option value="hu">Magyar - Hungarian</option>
<option value="id">Bahasa Indonesia - Indonesian</option>
<option value="it">Italiano - Italian</option>
<option value="ja">日本語 - Japanese</option>
<option value="ka">ქ�?რთული - Georgian</option>
<option value="lt">Lietuvių - Lithuanian</option>
<option value="mn">Монгол - Mongolian</option>
<option value="nb">Norsk - Norwegian</option>
<option value="nl">Nederlands - Dutch</option>
<option value="pl">Polski - Polish</option>
<option value="pt_BR">Português - Brazilian portuguese</option>
<option value="ro">Română - Romanian</option>
<option value="ru">Ру�?�?кий - Russian</option>
<option value="si">සිංහල - Sinhala</option>
<option value="sk">Sloven�?ina - Slovak</option>
<option value="sl">Slovenš�?ina - Slovenian</option>
<option value="sr">Срп�?ки - Serbian</option>
<option value="sr@latin">Srpski - Serbian latin</option>
<option value="sv">Svenska - Swedish</option>
<option value="tr">Türkçe - Turkish</option>
<option value="uz">Ўзбекча - Uzbek-cyrillic</option>
<option value="uz@latin">O'zbekcha - Uzbek-latin</option>
<option value="zh_CN">中文 - Chinese simplified</option>
<option value="zh_TW">中文 - Chinese traditional</option>
</select>
</fieldset>
<noscript> &lt;fieldset class="tblFooters"&gt; &lt;input type="submit" value="Go" /&gt; &lt;/fieldset&gt; </noscript>
</form-->
<form class="login" id="form1" name="form1" method="post" action="MenuIndex.php" onSubmit="return valida(this);">
<!--form class="login" id="form" name="form" method="post"-->
<!--form class="login" target="_top" autocomplete="off" name="login_form" action="login.php" method="post"-->
<fieldset>
<legend>
Iniciar sesión
<a href="#">
<img class="icon" width="11" height="11" src="images/b_help.png"/>
</a>
</legend>
<div class="item">
<label for="username">Usuario:</label>
<input id="username" class="textfield" type="text" size="24" value="" name="username">
</div>
<div class="item">
<label for="password">Password:</label>
<input id="password" class="textfield" type="password" size="24" value="" name="password">
</div>
<input type="hidden" value="1" name="server">

</fieldset>
<fieldset class="tblFooters">
<input title="login Now"  type="submit" value="Acceder" name="ingresar" id="login" />
<!--input title="login Now"  type="image" src="login/images/btn_log1.png" name="ingresar" id="login" /-->

<!--input type="hidden" value="b75d51f9ba41b46fabbda4ea979c9838" name="token"-->

</fieldset>

</form>
<?php 

if($_POST['continuar'] and (!$_POST['username'] or !$_POST['password'])){
echo '<div class="error">
Por favor introduce el nombre de usuario y password correctamente!

</div>';
} 
?>




</div>

</body>
</html>