<script>
<!--

/*
Configure menu styles below
NOTE: To edit the link colors, go to the STYLE tags and edit the ssm2Items colors
*/
YOffset=150; // no quotes!!
XOffset=0;
staticYOffset=30; // no quotes!!
slideSpeed=20 // no quotes!!
waitTime=100; // no quotes!! this sets the time the menu stays out for after the mouse goes off it.
menuBGColor="66a8ce";
menuIsStatic="yes"; //this sets whether menu should stay static on the screen
menuWidth=150; // Must be a multiple of 10! no quotes!!
menuCols=2;
hdrFontFamily="verdana";
hdrFontSize="1";
hdrFontColor="white";
hdrBGColor="#65acce";
hdrAlign="left";
hdrVAlign="center";
hdrHeight="15";
linkFontFamily="Verdana";
linkFontSize="2";
linkBGColor="white";
linkOverBGColor="#FFFFFF";
linkTarget="_top";
linkAlign="Left";
barBGColor="#e97559";
barFontFamily="Verdana";
barFontSize="1";
barFontColor="white";
barVAlign="center";
barWidth=20; // no quotes!!
barText="UTILERIAS"; // <IMG> tag supported. Put exact html for an image to show.

///////////////////////////

// ssmItems[...]=[name, link, target, colspan, endrow?] - leave 'link' and 'target' blank to make a header
ssmItems[0]=["<?php echo 'Conectado  '.$usuario;?>"] //create header
ssmItems[1]=["Cambiar Password", "/sima/SEGURIDADSIMA/cambiarPassword.php", "_target"]

buildMenu();

//-->
</script>
