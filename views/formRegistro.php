<div style="width: 700px;  height: 395px; padding-top: 50px;" align="center">
<form class="login" action="<?php echo PATCH?>/Controller/UserController.php?option=3" id="formLogin" method="POST" style="background-color: #fff;">
                <span>Registrar Nuevo Usuario</span>
                <table style="padding: 10px; margin-left: 30px; width: 85%">
                    <tr>
                        <td>Nombres</td>
                        <td ><input type="text" name="nombres"/></td>
                    </tr>
                        
                    <tr>
                        <td>Apellidos</td>
                        <td ><input type="text" name="apellidos"/></td>
                    </tr>
                    
                    <tr>
                        <td>Celular</td>
                        <td ><input type="text" name="celular"/></td>
                    </tr>
                     
                    <tr>
                        <td>Mail</td>
                        <td ><input type="text" name="mail"/></td>
                    </tr>
                     
                    <tr>
                        <td>Identificacion</td>
                        <td colspan="2"><input type="text" name="identificacion"/></td>
                    </tr>
                     <tr>
                        
                    </tr>
                    <tr>
                        <td>
                            <input type="button" value="Registrar" onclick="submitObjectData('formLogin','idResponse',$('#formLogin').serializeArray());"/>  
                        </td>
                        <td><input type="button" value="Volver" onClick='window.location="index.php"'/>  </td>
                    </tr>
                </table>
                <div id="idResponse"></div>
             </form> 
</div>                