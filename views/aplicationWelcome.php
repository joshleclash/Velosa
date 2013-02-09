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
    <body>
        <div class="container-header-login">
            Bienvenido Carga Red Macro!
            
            <?php echo $_SESSION["_User"]->nombreUsuario . " " . $_SESSION["_User"]->apellidoUsuario; ?>
            <div style="float: right;"><?php echo Components::getDate();?></div>
        </div>
        
        <div class="container-login">
            <div class="menu-left">
                <?php if($_SESSION["_User"]->idPerfil==1){
                echo '<ul>
                    <li>
                        <a>Administracion</a>
                            <ul>
                                <li><a method="POST" href="#" id="Usuarios" action="'.PATCH.'/Controller/aplicationController.php?option=0 "onClick='."submitObjectData('Usuarios','container-data',{'csc':1})".'>Usuarios</a></li>
                                <li><a href="#">Archivos</a></li>
                                
                            </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a>Archivos</a>
                            <ul>
                                <li><a href="#">Agregar archivos a usuarios</a></li>
                                <li><a href="#">Ver todos los archivos</a></li>
                                <li><a href="#">Cargar archivos</a></li>
                                
                            </ul>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a>Mi perfil</a>
                            <ul>
                                <li><a href="#">Cambiar la contraseña</a></li>
                                <li><a href="index.php?destroySession=true">Salir</a></li>
                            </ul>
                    </li>
                </ul>
                ';
                }else{
                    echo '<ul>
                            <li>
                            <a>Mi perfil</a>
                                <ul>
                                    <li><a href="#">Cambiar la contraseña</a></li>
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

