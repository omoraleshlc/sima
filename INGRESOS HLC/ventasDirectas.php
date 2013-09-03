<?PHP require("menuOperaciones.php"); 

$sSQLC= "Select status From statusCaja where entidad='".$entidad."' and usuario='".$usuario."' order by keySTC DESC ";
$resultC=mysql_db_query($basedatos,$sSQLC);
$myrowC = mysql_fetch_array($resultC);




if($myrowC['status']=='abierta'){ //*******************Comienzo la validación*****************
?>




<script language=javascript> 
function ventanaSecundaria10 (URL){ 
   window.open(URL,"ventana10","width=500,height=500,scrollbars=YES") 
} 
</script>

<script language=javascript> 
function ventanaSecundaria1 (URL){ 
   window.open(URL,"ventana1","width=500,height=600,scrollbars=YES") 
} 
</script> 





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




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php
$link=new ventanasPrototype();
$link->links();

$estilo=new muestraEstilos();
$estilo->styles();
?>
	
  
<style type="text/css">
<!--
body {
	background-image: url(../../imagenes/imagenesModulos/screen_ventasdirectas.jpg);

}
-->
</style></head>

<body>

<script>
var ovidio;
document.getElementById('w3s').focus();
document.forms[0].txt.select();
window.alert("af"+ovidio);
</script>

<form id="form1" name="form1" method="post" action="">

    <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
    <p align="center">&nbsp;</p>
    <p>&nbsp;</p>
    <p align="center">
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para hacer notas de cargo directas..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo2" type="button"  id="nuevo2" src="../imagenes/btns/generarventa.png"
	  onclick="abrirVentaDirecta();" value="Hacer una venta directa" />
	  
	 
	  
      <input onMouseOver="Tip('&lt;div class=&quot;estilo25&quot;&gt;<?php echo 'Presiona aqu&iacute; para ver las notas de cargo y su estado actual..';?>&lt;/div&gt;')" onMouseOut="UnTip()" name="nuevo22" type="button"  id="nuevo22" src="../../imagenes/btns/listaventas.png"
	  onclick="nueva('/sima/cargos/listadoVentasPacientes.php?paquetes=paquetes&amp;almacen=<?php echo $ALMACEN;?>','ventanaSecundaria10','500','500','yes')" value="Mostrar Lista" />
      <label></label>
    </p>
</form>
<h1 align="center">&nbsp;</h1>
</body>
<script type="text/javascript"> 

	// Windows with an URL as content

function abrirVentaDirecta(html){
ventanaVD = new Window('dialog3', {className: "alphacube", title: "Ventas Directas", 
								  top:15, right:500, width:600, height:600, 
								  url: "ventanasVentasDirectas.php?cargos=cargos&amp;almacen=<?php echo $ALMACEN;?>", showEffectOptions: {duration:1}})
	ventanaVD.showCenter();
ventanaVD.setDestroyOnClose();

}
 
  function openDialog1(html) {
    var effect = new PopupEffect(html, {className: "popup_effect2", duration: 2, fromOpacity: 0.2, toOpacity: 0.4});
    var win = new Window({className:"alphacube", width: 200, height:null, showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
    win.getContent().update("<h1>Hello</h1>Word");     
    
    win.showCenter();
  }        

  function openDialog2(html) {
    var effect = new PopupEffect(html, {className: "popup_effect1"});
    var win = new Window({className:"alphacube", width: 200, height:null, showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
    win.getContent().update("<h1>Hello</h1>Word");     
    
    win.show();
  }       
   
  function openDialog3(html) {
    var effect = new PopupEffect(html, {className: "popup_effect1"});
    Dialog.confirm("Do you like this effect?",{className:"alphacube", width: 400, height:null, showEffect:effect.show.bind(effect), hideEffect:effect.hide.bind(effect)})
  }       
        
		
		
		function openConfirmDialog() {
		Dialog.confirm("Test of confirm panel, check out debug window after closing it<br>Test select for IE <SELECT NAME='partnumber'><OPTION VALUE='1'> One<OPTION VALUE='2'> Two<OPTION VALUE='3'> Three<OPTION VALUE='5'> Five<OPTION VALUE='4'> Oooopppppppps I forgot four</SELECT>", 
				        {windowParameters: {width:300, height:100}, okLabel: "close", 
						    cancel:function(win) {debug("cancel confirm panel")},
						    ok:function(win) {debug("validate confirm panel"); return true}
						    });
	}
	
	function openAlertDialog() {
		Dialog.alert("Test of alert panel, check out debug window after closing it", 
				        {windowParameters: {width:300, height:100}, okLabel: "close", 
						    ok:function(win) {debug("validate alert panel"); return true}
						    });
	}

  var timeout;
	function openInfoDialog() {
		Dialog.info("Test of info panel, it will close <br>in 3s ...",
				        {windowParameters: {className: "alert_lite",width:250, height:100}, showProgress: true});
    // timeout=3;
    // setTimeout("infoTimeout()", 1000)
    Dialog.closeInfo()
    
	}
	
	function infoTimeout() {
	  timeout--;
	  if (timeout >0) {
	    Dialog.setInfoMessage("Test of info panel, it will close <br>in " + timeout + "s ...")
  		setTimeout("infoTimeout()", 1000)
    }
	  else
	    Dialog.closeInfo()
	}
	
	function openModalDialog() {
	  debug($('modal_window_content'))
		var win = new Window('modal_window', {className: "dialog", title: "Ruby on Rails",top:100, left:100,  width:300, height:200, zIndex:150, opacity:1, resizable: true})
		//win.getContent().innerHTML = "Hi"
		win.setContent("select")
		win.setDestroyOnClose();
		win.show(true);	
	}
		
	function openContentWindow() {
		if (contentWin != null) {
			Dialog.alert("Close the window 'Test' before opening it again!", {windowParameters:{ width:200, height:130}}); 
		}
		else {
			contentWin = new Window('content_win', {className: "darkX", resizable: false, hideEffect:Element.hide, showEffect:Element.show})
			contentWin.setContent('test_content', true, true)
			contentWin.toFront();
			contentWin.setDestroyOnClose();
			contentWin.show();	
		}		
	}
		
	// Sample code to see how to implement a closeCallback
	function canClose(win) {
			debug("You cannot close " + win.getId());
			// return false, the window cannot be closed
			return false;
	}

	// Set up a deleagte for win2 (the one with rubyonrails.org in it)
	win2.setCloseCallback(canClose);
	date=new Date();
  date.setMonth(date.getMonth()+3);
	win2.setCookie("test", date);
	
	// Set up a windows observer, check ou debug window to get messages
	var myObserver = {
		onStartMove: function(eventName, win) {
			debug(eventName + " on " + win.getId())
		},
		onEndMove: function(eventName, win) {
			debug(eventName + " on " + win.getId())
		},
		onStartResize: function(eventName, win) {
			debug(eventName + " on " + win.getId())
		},
		onEndResize: function(eventName, win) {
			debug(eventName + " on " + win.getId())
		},
		onClose: function(eventName, win) {
			debug(eventName + " on " + win.getId())
		},
		onDestroy: function(eventName, win) {
			if (win == contentWin) {
				$('container').appendChild($('test_content'));
				contentWin = null;
			}
			
			debug(eventName + " on " + win.getId())
		}
	}
	Windows.addObserver(myObserver);      
</script>
</html>
<?php
} else { 
$link=new ventanasPrototype();
$link->links();

$mensaje=new ventanasPrototype();
$mensaje->despliegaMensaje('LA CAJA ESTA CERRADA');
}
?>