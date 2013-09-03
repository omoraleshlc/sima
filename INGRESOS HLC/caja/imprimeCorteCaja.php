<?php echo 'imprime'; ?>
<object width="0" height="0" standby="Imprimiendo... Espere un momento."
    classid="java:mx.edu.um.contabilidad.applets.caja.CajaApplet.class"
    codetype="application/x-java-applet">
        <param name=param1 value="<?php echo 'formato'; ?>">
        <param name=param2 value="<?php strNumRecibo; ?>">
        <param name=param3 value="<?php strRecibimosDe; ?>">
        <param name=param4 value="<?php strDireccion; ?>">
        <param name=param5 value="<?php strRFC; ?>">
        <param name=param6 value="<?php strFechaFormat; ?>">
        <param name=param7 value="<?php strAcreditarA; ?>">
        <param name=param8 value="<?php strFormaPago; ?>">
        <param name=param9 value="<?php strDescripcion; ?>">
        <param name=param10 value="<?php dfFormatonumeros.format(dblSubtotal); ?>">
        <param name=param11 value="<?php strIVA; ?>">
        <param name=param12 value="<?php dfFormatonumeros.format(dblTotal); ?>">
        <param name=param13 value="<?php strCantidadLetras; ?>">
        <param name=param14 value="<?php strDescripcionIVA; ?>">
        <param name="codebase" value="../../applets"/>
        <parm name="code" value="mx.edu.um.contabilidad.applets.caja.CajaApplet"/>        
        <param name="scriptable" value="false"
        Applet que imprime el recibo de caja
    </object>


