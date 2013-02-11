<div style="width: 700px;  height: 395px; padding-top: 50px;" align="center">
<form style="width: 500px;" class="login" action="<?php echo PATCH?>/Controller/UserController.php?option=4" id="formLogin" method="POST" style="background-color: #fff;">
                <span>Registrar Nuevo Usuario</span>
                <table style="padding: 10px; margin-left: 30px; width: 85%">
                    <tr>
                        <td>Digite su contrase&ntilde;a anterior</td>
                        <td ><input type="password" name="oldPassword"/></td>
                    </tr>
                        
                    <tr>
                        <td>Dijite su nueva contraseña</td>
                        <td ><input type="password" name="newPassword"/></td>
                    </tr>
                    
                    <tr>
                        <td>Dijite Nuevamente su contrase&ntilde;a</td>
                        <td ><input type="password" name="confirmNewPassword"/></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" value="Actualizar" onclick="submitObjectData('formLogin','idResponse',$('#formLogin').serializeArray());"/>  
                        </td>
                        
                    </tr>
                </table>
                <div id="idResponse"></div>
             </form> 
</div>                
