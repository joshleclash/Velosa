<?php
include_once '../config/config.php';
class aplicationController{
    private $components=null;
    private $conect=null;
    public function __construct() {
        $this->components= new Components();
        $this->conect= $this->components->getConnect();
    }
    public function showUsers(){
        $sql =" Select * from usuario t1 join perfil t2 on t1.idPerfil = t2.idPerfil";
        $rs = $this->components->__executeQuery($sql, $this->conect);
        $table='<table border="0" CELLSPACING="0" CELLSPACING="0">';
        $table.='<tr>';
        $table.='<th>No</th>';
        $table.='<th>Nombres</th>';
        $table.='<th>Apellidos</th>';
        $table.='<th>Celular</th>';
        $table.='<th>Mail</td>';
        $table.='<th>Identificacion</td>';
        $table.='<th>Perfil</th>';
        $table.='</tr>';
        $i=1;
        while($row = mysql_fetch_array($rs)):
        $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
        $table.='<th>'.$i.'</th>';
        $table.='<td>'.$row["nombreUsuario"].'</td>';
        $table.='<td>'.$row["apellidoUsuario"].'</td>';
        $table.='<td>'.$row["celular"].'</td>';
        $table.='<td>'.$row["mail"].'</td>';
        $table.='<td>'.$row["identificacion"].'</td>';
        $table.='<td>';
                $table.='<select name="perfil" link="../controller/aplicationController.php?option=1" onChange="'.'sendValueForOption(this,'.$row["idUsuario"].');'.'" id="option'.$row["idUsuario"].'">';
                    $table.=$this->showProfilesOptionSelect($row["idPerfil"]);
                    $table.=$this->showProfilesOptionSelect();
                $table.='</select>';
        $table.='<td>';
        
        $table.='</tr>';
        $i++;
        endwhile;
        return $table;
    }
    public function chageUserStatus($idUsuario=null,$idProfile=null){
            $sql = "update usuario set idPerfil=".$idProfile." where idUsuario = ".$idUsuario;
            $rs = $this->components->__executeQuery($sql, $this->conect);
            if($rs){
                return Dialog::Message("Confirmacion", "Usuario Modificado correctamente", true, 0,'Aceptar');
            }else{
                return Dialog::Message("Error", "Error al intertar modificar el usuario por favor intenetelo  nuevamente", true, 0,'Aceptar');
            }
            
        
    }
    public function showProfilesOptionSelect($idPerfil=null){
        if($idPerfil==null)
            {
                $sql = "select * from perfil";
            }
         else
            {
                $sql = "select * from perfil where idPerfil=$idPerfil";
            }
        $rs = $this->components->__executeQuery($sql, $this->conect);
        $option='';
        while($row=  mysql_fetch_array($rs)):
            $option.='<option value="'.$row["idPerfil"].'">'.$row["nombrePerfil"].'</option>';
        endwhile;
        return $option;
    }
    public function showFormRegistro(){
        include_once '../views/formRegistro.php';
    }
    public function addFilesToUser(){
        $sql =" Select * from usuario t1 join perfil t2 on t1.idPerfil = t2.idPerfil";
        $rs = $this->components->__executeQuery($sql, $this->conect);
        $table='<table border="0" CELLSPACING="0" CELLSPACING="0">';
        $table.='<tr>';
        $table.='<th>No</th>';
        $table.='<th>Nombres</th>';
        $table.='<th>Apellidos</th>';
        $table.='<th>Celular</th>';
        $table.='<th>Mail</td>';
        $table.='<th>Identificacion</td>';
        $table.='<th>Perfil</th>';
        $table.='</tr>';
        $i=1;
        while($row = mysql_fetch_array($rs)):
        $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
        $table.='<th>'.$i.'</th>';
        $table.='<td>'.$row["nombreUsuario"].'</td>';
        $table.='<td>'.$row["apellidoUsuario"].'</td>';
        $table.='<td>'.$row["celular"].'</td>';
        $table.='<td>'.$row["mail"].'</td>';
        $table.='<td>'.$row["identificacion"].'</td>';
        $table.='<td>';
                $table.='<img src="../images/icons/add.png" title="Agregar archivos a usuario" 
                        onClick='."submitObjectData('parametros$row[idUsuario]','AddFilesResponse$row[idUsuario]',{idUsuario:$row[idUsuario]});".'
                     id="parametros'.$row["idUsuario"].'" action="'.PATCH.'/controller/aplicationController.php?option=6" method="POST">';
        $table.='<td>';
        $table.='</tr>';
        $table.='<tr><td colspan="7"><div id="AddFilesResponse'.$row["idUsuario"].'" align="center"></div></td></tr>';
        $i++;
        endwhile;
        return $table;
    }
    public function showFormUpload($idArchivo=0){
        include_once '../views/uploadFilesForm.php';
    }
    public function showAllFiles($idUser=null){
        if($idUser==null){
            $sql = "SELECT *  FROM archivo file join usuario us on us.idUsuario=file.idUsuario and file.estate='activo'";
        }else{
            $sql = "SELECT *  FROM archivo file join usuario us on us.idUsuario=file.idUsuario and file.estate='activo' and us.idUsuario=".$idUser;
        }
        $rs = $this->components->__executeQuery($sql, $this->conect);
        $table='';
        $table.='<table border="0" CELLSPACING="0" CELLSPACING="0">';
            $table.='<tr>';
            $table.='<th>No</th>';
            $table.='<th>Agregado por</th>';
            $table.='<th>Fecha de cargue</th>';
            $table.='<th>Mail</td>';
            $table.='<th>Identificacion</td>';
            $table.='<th>Tipo Archivo</th>';
            $table.='<th>Descargar</th>';
            $table.='</tr>';
            $i=1;
            while($row = mysql_fetch_array($rs)):
			if($row["typeFile"]=='application/msword')
			{
				$img='<img src="'.PATCH.'/images/icons/word_icon.png">';
			}else if($row["typeFile"]=='application/vnd.ms-excel' || $row["typeFile"]=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
				$img='<img src="'.PATCH.'/images/icons/excel_icon.png">';
			}else if($row["typeFile"]=='application/vnd.ms-powerpoint'){
				$img='<img src="'.PATCH.'/images/icons/powerpoint_icon.png">';
			}else{
				$img='Descargar';
			}
			
            $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
            $table.='<th>'.$i.'</th>';
            $table.='<td>'.$row["nombreUsuario"]."-".$row["apellidoUsuario"].'</td>';
            $table.='<td>'.$row["smalldatetime"].'</td>';
            $table.='<td>'.$row["mail"].'</td>';
            $table.='<td>'.$row["identificacion"].'</td>';
            $table.='<td>'.$row["typeFile"].'</td>';
            $table.='<td align="center"><a href="'.$row["routeFile"].'" target="_blank" title="'.$row["nameFile"].'">'.$img.'</a><td>';
            $table.='</tr>';
            $i++;
            endwhile;
            return $table;

    }  
    public function adminFiles($idUser=null){
        $modelUser = new userModel();
        if($idUser==null){
            $sql = "SELECT *  FROM archivo file join usuario us on us.idUsuario=file.idUsuario and file.estate='activo'";
        }else{
            $sql = "SELECT *  FROM archivo file join usuario us on us.idUsuario=file.idUsuario and file.estate='activo' and us.idUsuario=".$idUser;
        }
        $rs = $this->components->__executeQuery($sql, $this->conect);
        if(mysql_num_rows($rs)<=0){
            return '<span class="error-response">No se encontraron archivos para este usuario</span>';
        }
        $j=0;
        $table='<table border="0" CELLSPACING="0" CELLSPACING="0" class="table">';
        $table.='<tr>';
        $table.='<th>Fecha Creacion</th>';
        $table.='<th>Nombre Archivo</th>';
        $table.='<th>Typo Archivo</th>';
        if($_SESSION["_User"]->nombrePerfil=="Administrador")
            {
            $table.='<th>Nombre Usuario</th>';
            $table.='<th>Asignar usuario</th>';
            }
        $table.='<th>Descargar</th>';
        $table.='<th>Modificar</th>';
        
        $table.='</tr>';
            $i=1;
            while($row = mysql_fetch_array($rs)):
			if($row["typeFile"]=='application/msword')
			{
				$img='<img src="'.PATCH.'/images/icons/word_icon.png">';
                                $file="Word";
			}else if($row["typeFile"]=='application/vnd.ms-excel'|| $row["typeFile"]=='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
				$img='<img src="'.PATCH.'/images/icons/excel_icon.png">';
                                $file="Excel";
			}else if($row["typeFile"]=='application/vnd.ms-powerpoint'){
				$img='<img src="'.PATCH.'/images/icons/powerpoint_icon.png">';
                                $file="Power Point";
			}else{
                                $file="Otro";
				$img='Descargar';
			}
            $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
            $table.='<td align="center">'.$row["smalldatetime"].'</td>';
            $table.='<td align="center">'.$row["nameFile"].'</td>';
            $table.='<td align="center">'.$file.'</td>';
            if($_SESSION["_User"]->nombrePerfil=="Administrador")
            {
            $rsUser = $modelUser->showUser();    
            $table.='<td align="center">'.$row["nombreUsuario"].'-'.$row["apellidoUsuario"].'</td>';
            $table.='<td align="center">';
            $cont=0;
            while($rowUser = mysql_fetch_object($rsUser)):
                if($cont==0)
                    {
                        $option = '<select id="option'.$row["idArchivo"].'" name="usuarioName" style="max-width:150px;" method="POST" 
                                    action="'.PATCH.'/controller/aplicationController.php?option=9" 
                                        onChange='."submitObjectData('option$row[idArchivo]','reponse-update$j',{'idUsuario':$rowUser->idUsuario,'idArchivo':$row[idArchivo],'email':'$row[mail]'});".'>';
                        //."".
                        $option.='<option>--</opion>';
                        
                    }
                    $option.='<option value="'.$rowUser->idUsuario.'" >'.$rowUser->nombreUsuario.'-'.$rowUser->apellidoUsuario.'</opion>';
                    $cont++;
                endwhile;
                $option .= '</select>';   
            $table.=$option;
                        
            $table.='</td>';
            }
            $table.='<td align="center"><a href="'.$row["routeFile"].'" target="_blank" title="'.$row["nameFile"].'">'.$img.'</a></td>';
            $table.='<td align="center">
                            <img src="../images/icons/application_form_edit.png" title="'.$row["nameFile"].'" id="updateFile'.$row["idUsuario"].'"
                                method="POST" action="'.PATCH.'/controller/aplicationController.php?option=5"
                                onClick='."submitObjectData('updateFile$row[idUsuario]','reponse-update$j',{idArchivo:$row[idArchivo]});".'>
                    </td>';
            $table.='</tr>';
            $table.='<tr colspan="5">';
            $table.='<td><div id="reponse-update'.$j.'"></div></td>';
            $table.='</tr>';
            $i++;
            $j++;
            endwhile;
            return $table;
    }
    public function uploadFiles(){

    }  
    public function showFormPassword(){
        include_once '../views/forgotPasswordForm.php';
    }
    public function updateFileDialog(){
        echo Dialog::Message($title, $message, $autoOpen, $caseButons, $textButton, false);
    }
    public function updateAdminFile($idUsuario=null,$idArchivo=null,$mail=null){
        $sqlUp = "update archivo set idUsuario=$idUsuario where idArchivo=$idArchivo";
        $rsUp = $this->components->__executeQuery($sqlUp, $this->components->getConnect());
        if($rsUp){
            $sql = "Select * from archivo file join usuario user on user.idUsuario=file.idUsuario where idArchivo=$idArchivo";
            $rs = $this->components->__executeQuery($sql, $this->components);
            $row = mysql_fetch_object($rs);
                    if(!is_null($mail)){
                        $msg = "Señor Usuario<br/><br/><strong>$row->nombreUsuario - $row->apellidoUsuario</strong>";
                        $msg .= "El administrador de el sistema le agrego un nuevo archivo a su pefil<br/><br/>";
                        $msg .= "Por favor ingrese al sistema si desea modificar o ver el documento<br/>";
                        $msg .= "Nombre Documento:$row->nameFile<br/>";
                        $msg .= "<strong>Observaciones:</strong><br/><br/>$row->description]<br/><br/>";
                        $msg .= "Mensaje generado automaticamente por favor no responder<br/>";
                        $msg .= $this->components->getDate();
                        $mails = $this->components->sendRsForMail(array($mail,$_SESSION["_User"]->mail), "El administrador le asigno un nuevo archivo", $msg);
                        if($mails){
                            return Dialog::Message("Confirmacion", "Se envio una notificacion a el usuario al cual le  fue asignado el archvivo", true, 
                                                0, "Aceptar");
                        }else{
                            return Dialog::Message("Error", "Existio algun error al notificar al usuario intentelo nuevamente", true, 
                                                0, "Aceptar");
                        }
                        
                    }
        }
    }
}
if(isset($_REQUEST["option"])){
    $controller = new aplicationController();    
    switch($_REQUEST["option"]){
        case 0:
                echo $controller->showUsers();
        break;
        case 1:
                echo $controller->chageUserStatus($_REQUEST["idUsuario"],$_REQUEST["optionValue"]);
            breaK;
        case 2:
               echo $controller->showFormRegistro();
            break;
        case 3:
               echo $controller->addFilesToUser();
            break;
        case 4:
               echo $controller->adminFiles($_SESSION["_User"]->idUsuario);
            break;
        case 5:
            
                echo $controller->showFormUpload(@$_REQUEST["idArchivo"]);
            break;
        case 6:
                echo $controller->adminFiles($_REQUEST["idUsuario"]);
            break;
        case 7:
                echo $controller->showFormPassword();
            break;
        case 8:
             echo $controller->adminFiles();
            break;
        case 9:
                     
                echo $controller->updateAdminFile($_POST['idUsuario'],$_POST['idArchivo'],$_POST["email"]);
            break;
        default:
            echo Dialog::Message("Error", "Existio algun error valide su informacion", true, 0, "Aceptar", true);
            echo '<script>setTimeout(function(){window.location="index.php";},2000);</script>';
        break;
            
        
    }
    
    
    
}
?>
