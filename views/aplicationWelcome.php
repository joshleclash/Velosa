<?php 
include_once '../config/config.php';
if(!isset($_SESSION["_User"]))
    {
    header("Location:index.php");     
    }
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
    <body onLoad="submitObjectData('showFiles','container-data',{'csc':1});">
        <div class="container-header-login">
            Bienvenido Carga Red Macro!
            
            <?php echo $_SESSION["_User"]->nombreUsuario . " " . $_SESSION["_User"]->apellidoUsuario; ?>
            <div style="float: right;"><?php echo Components::getDate();?>
                <br/>
                <?php echo $_SESSION["_User"]->nombrePerfil?>    
            </div>
        </div>
        
        <div class="container-login">
            <div class="menu-left">
                <?php if($_SESSION["_User"]->idPerfil==1){
                echo '<ul>
                    <li>
                        <a>Administracion</a>
                            <ul>
                                    <li><a method="POST" href="#" id="Usuarios" action="'.PATCH.'/controller/aplicationController.php?option=0" onClick='."submitObjectData('Usuarios','container-data',{'csc':1})".'>Modificar Permisos Usuarios</a></li>
                                    <li><a method="POST" href="#" id="AddFilesToUser" action="'.PATCH.'/controller/aplicationController.php?option=3" onClick='."submitObjectData('AddFilesToUser','container-data',{'csc':1})".'>Ver Archivos por usuario</a></li>
                                        <li><a method="POST" href="#" id="AddFiles" action="'.PATCH.'/controller/aplicationController.php?option=8" onClick='."submitObjectData('AddFiles','container-data',{'csc':1})".'>Agregar archivos a usuarios</a></li>
                                    <li><a method="POST" href="#" id="NewUsuarios" action="'.PATCH.'/controller/aplicationController.php?option=2" onClick='."submitObjectData('NewUsuarios','container-data',{'csc':1})".'>Crear Usuarios</a></li>
                                    
                            </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a>Archivos</a>
                            <ul>
                                <li><a method="POST" href="#" id="showFiles" action="'.PATCH.'/controller/aplicationController.php?option=4" onClick='."submitObjectData('showFiles','container-data',{'csc':1})".'>Mis Archivos</a></li>
                                <li><a method="POST" href="#" id="uploadFiles" action="'.PATCH.'/controller/aplicationController.php?option=5" onClick='."submitObjectData('uploadFiles','container-data',{'csc':1})".'>Cargar Nuevo Archivo</a></li>
                                
                            </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a>Mi perfil</a>
                            <ul>
                                <li><a method="POST" href="#" id="forgotPassword" action="'.PATCH.'/controller/aplicationController.php?option=7" onClick='."submitObjectData('forgotPassword','container-data',{'csc':1})".'>Cambiar clave</a></li>
                                <li><a href="index.php?destroySession=true">Salir</a></li>
                            </ul>
                    </li>
                </ul>
                ';
                }else if($_SESSION["_User"]->idPerfil==2){
                    echo '<ul>
                    <li>
                        <a>Archivos</a>
                            <ul>
                                <li><a method="POST" href="#" id="showFiles" action="'.PATCH.'/controller/aplicationController.php?option=4" onClick='."submitObjectData('showFiles','container-data',{'csc':1})".'>Mis Archivos</a></li>
                                <li><a method="POST" href="#" id="uploadFiles" action="'.PATCH.'/controller/aplicationController.php?option=5" onClick='."submitObjectData('uploadFiles','container-data',{'csc':1})".'>Cargar archivos</a></li>
                                
                            </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a>Mi perfil</a>
                            <ul>
                                <li><a method="POST" href="#" id="forgotPassword" action="'.PATCH.'/controller/aplicationController.php?option=7" onClick='."submitObjectData('forgotPassword','container-data',{'csc':1})".'>Cambiar clave</a></li>
                                <li><a href="index.php?destroySession=true">Salir</a></li>
                            </ul>
                    </li>
                </ul>';
                }else{    
                    echo '<ul>
                            <li>
                            <a>Mi perfil</a>
                                <ul>
                                    <li><a href="index.php?destroySession=true">Salir</a></li>
                                </ul>
                            </li>
                        </ul>';
                }
                ?>
                
                
            </div>
            <div class="container-data" id="container-data">
                
            </div>
        </div>
    </body>
</html>

