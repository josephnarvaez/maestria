<script type="text/javascript" src="scripts/login.js"></script>
  <?php

function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
, $_SERVER["HTTP_USER_AGENT"]);
}
//if(isMobileDevice()){
   echo ' <form  method="post" id="frmAcceso1" action="registro.php">    
<table width="200" border="0" align="center">
  <tr>
    <td colspan="2" align="center">SISTEMA DE REGISTRO</td>
  </tr>
  <tr>
    <td>Usuario:</td>
    <td><input name="logina" type="text" id="logina"  placeholder="Usuario" /></td>
  </tr>
  <tr>
    <td>Clave:</td>
    <td><input name="clavea" type="password" id="clavea"  placeholder="Password"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="Ingresar"></button></td>
    </tr>
</table>
</form>'; 
//}
//else {
//    echo "No esta accediendo desde un dispositivo celular";
//}

?>
