<?php include_once '../config/config.php';?>
<link href="../css/side.css" rel="stylesheet">
<form enctype="multipart/form-data" class="login" method="POST" action="uploadForm.php"   style="background-color: #fff;">
                
                <table style="padding: 10px; margin-left: 30px; width: 85%; border: 1px dotted #222222; ">
                    <tr>
                        <td>
                            <span>Cargar Archivos</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Selecione archivo</td>
                    </tr>    
                    <tr>
                        <td >
                            <input type="file" name="file" id="file" style="width: 200px;"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" value="Cargar Archivo">
                        </td>
                    </tr>    
                </table>
             </form>
<?php 
if(isset($_FILES["file"])){
    if($_FILES["file"]["size"]<=8388600)
    {
        move_uploaded_file($_FILES["file"]["tmp_name"],
        "uploads/" . $_FILES["file"]["name"]);
        $sql = "INSERT INTO archivo
                (idUsuario, routeFile, nameFile, smalldatetime, estate, typeFile) 
                VALUES (".$_SESSION["_User"]->idUsuario.", 'uploads/".$_FILES["file"]["name"]."', '".$_FILES["file"]["name"]."', '".Components::getDate()."', 'activo', '".$_FILES["file"]["type"]."');";
        $components = New Components();
        
        $rs = $components->__executeQuery($sql, $components->getConnect());
        $mails = $components->getMailsByAdmin();
        $msg="Se&ntilde;or(a) Administrador,<br/><br/>";
        $msg.="El usuario ".$_SESSION["_User"]->nombreUsuario."-".$_SESSION["_User"]->apellidoUsuario."a cargado un archivo a el sistema<br/><br/>";
        $msg.="Nombre Archivo:".$_FILES["file"]["name"]."<br/>";
        $msg.="Tipo Archivo:".$_FILES["file"]["type"]."<br/><br/>";
        $msg.="Señor usuario favor no responda este correo<br/>Correo generado automaticamente".Components::getDate();
        $sendMail = $components->sendRsForMail($mails, "Archivo Cargado al sistema", $msg);
                if(!$rs || !$sendMail){
                     echo '<div class="error-response">Exisito algun  error intentelo nuevamente</div>';
                 }else{
                     echo '<div class="ok-response" align="center"><img src="'.PATCH.'/images/icons/accept.png" style="margin-top: -10px;" align="middle">'.
                             'Archivo cargado correctamente'.
                          '</div>';
                 }
    }else{
        echo '<div class="error-response">El archivo es demasido grande</div>';
    }
    
}

?>

