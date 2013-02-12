<?php 
include_once '../config/config.php';
if(isset($_REQUEST["destroySession"]))
    if($_REQUEST["destroySession"]==true)
        session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="<?php echo PATCH;?>/css/side.css"> 
    <link href="<?php echo PATCH;?>/css/custom-theme/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <script src="<?php echo PATCH;?>/js/jquery-1.9.0.js"></script>
    <script src="<?php echo PATCH;?>/js/jquery-ui-1.10.0.custom.js"></script>
    <script src="<?php echo PATCH?>/js/functionsJs.js"></script>
    </head>
    <body>
        <div class="container-header">
            <div style="float: left; width: auto; padding: 5px;">
                <img src="../images/logo.png" style="height: 90px;">
            </div>Carga Red Macro!
            <img src="../images/logo.png" style="height:50px;"/>Carga Red Macro!
        </div>
        
        <div class="container-login">
            
            <div class="title">Sistema basado en conocimientos para Entrenamiento Inteligente orientado a la Evaluación</div>
            <div style="height: 20px;"></div>
            <span>
                Sistema de informacion en el cual podra documentar avances en los diferentes actividades dejadas por el docento
                <br/>
                <br/>
                <br/><br/>
                <br/><br/>
                <br/>
                <br/>
                <br/><br/><br/><br/><br/><br/>
            </span>
            <form class="login" action="<?php echo PATCH?>/controller/userController.php?option=1" id="formLogin" method="POST">
                <span>Iniciar Sesion</span>
                <table style="padding: 10px; margin-left: 30px; width: 85%">
                    <tr>
                        <td>Identificacion</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="text" name="identificacion" id="identificacion"/></td>
                    </tr>    
                    <tr>
                        <td>Clave</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="password" name="password" id="password"/></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" value="Iniciar sesion" onclick="submitObjectData('formLogin','response',$('#formLogin').serializeArray());"/>  
                        </td>
                        <td><input type="button" value="Registar Usuario" onClick='window.location="registroUsuario.php"'/>  </td>
                    </tr>
                </table>
                <br/>
                <div id="response"></div>
                <div class="footer-login">
                        <a href=""></a>
                </div>
                
                
                
                
            </form> 
        </div>
    </body>
</html>
