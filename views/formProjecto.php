<?php
include_once '../config/config.php';
include_once '../config/validateSession.php';
include_once'../controller/proyectoController.php';
?>
<div class="container-form-proyecto">
    <span class="span">Proyectos</span>
    <div class="form-container">
        <form id="formProyecto" action="<?php echo PATCH?>/controller/proyectoController.php?option=0" id="formLogin" method="POST">
        <table style="padding: 5px;">
            <tr>
                <td>
                    Nombre del proyecto
                </td>
                <td>
                    <input type="text" name="Proyecto">
                </td>
                <td style="margin-left: 10px;">
                    Codigo Interno
                </td>
                <td>
                    <input type="text" name="Codigo">
                </td>
            </tr>
            <tr>
                <td>
                    Nombre auditor
                </td>
                <td colspan="3">
                    <input type="text" name="Auditor">
                </td>
            </tr>
            <tr>
                <td>Correo del auditor</td>
                <td colspan="2">
                    <input type="text" name="e-mail">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="button" value="Almacenar" onclick="submitObjectData('formProyecto','idResponse',$('#formProyecto').serializeArray());">
                </td>
                <td>
                    <input type="button" value="Limpiar" onClick="resetForm('formProyecto');">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div id="idResponse">
                        
                    </div>
                </td>
            </tr>
        </table>
        </form>
        
    </div>
    <div style="margin-top: 10px; width: 95%;">
        <?php 
             $controller = new proyectoController();
             echo $controller->loadProyectos($_SESSION["_User"]->idUsuario);
        ?>
    </div>
</div>
