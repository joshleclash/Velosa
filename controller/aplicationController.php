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
                $table.='<select name="perfil" link="../Controller/aplicationController.php?option=1" onChange="'.'sendValueForOption(this,'.$row["idUsuario"].');'.'" id="option'.$row["idUsuario"].'">';
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
                     id="parametros'.$row["idUsuario"].'" action="'.PATCH.'/Controller/aplicationController.php?option=6" method="POST">';
        $table.='<td>';
        $table.='</tr>';
        $table.='<tr><td colspan="7"><div id="AddFilesResponse'.$row["idUsuario"].'" align="center"></div></td></tr>';
        $i++;
        endwhile;
        return $table;
    }
    public function showFormUpload(){
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
            $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
            $table.='<th>'.$i.'</th>';
            $table.='<td>'.$row["nombreUsuario"]."-".$row["apellidoUsuario"].'</td>';
            $table.='<td>'.$row["smalldatetime"].'</td>';
            $table.='<td>'.$row["mail"].'</td>';
            $table.='<td>'.$row["identificacion"].'</td>';
            $table.='<td>'.$row["typeFile"].'</td>';
            $table.='<td><a href="'.$row["routeFile"].'" target="_blank" title="'.$row["nameFile"].'">Descargar</a><td>';
            $table.='</tr>';
            $i++;
            endwhile;
            return $table;

    }  
    public function adminFiles($idUser=null){
        if($idUser==null){
            $sql = "SELECT *  FROM archivo file join usuario us on us.idUsuario=file.idUsuario and file.estate='activo'";
        }else{
            $sql = "SELECT *  FROM archivo file join usuario us on us.idUsuario=file.idUsuario and file.estate='activo' and us.idUsuario=".$idUser;
        }
        $rs = $this->components->__executeQuery($sql, $this->conect);
        if(mysql_num_rows($rs)<=0){
            return '<span class="error-response">No se encontraron archivos para este usuario</span>';
        }
        $table='<table border="0" CELLSPACING="0" CELLSPACING="0" class="table">';
        $table.='<tr>';
        $table.='<th>Fecha Creacion</th>';
        $table.='<th>Nombre Archivo</th>';
        $table.='<th>Typo Archivo</th>';
        $table.='<th>Ver</th>';
        $table.='</tr>';
            $i=1;
            while($row = mysql_fetch_array($rs)):
            $table.='<tr class="cebra'.($i%2).'" id="cebra'.$row["idUsuario"].'">';
            $table.='<td>'.$row["smalldatetime"].'</td>';
            $table.='<td>'.$row["nameFile"].'</td>';
            $table.='<td>'.$row["typeFile"].'</td>';
            $table.='<td><a href="'.$row["routeFile"].'" target="_blank" title="'.$row["nameFile"].'">Descargar</a><td>';
            $table.='</tr>';
            $i++;
            endwhile;
            return $table;
    }
    public function uploadFiles(){

    }  
    public function showFormPassword(){
        include_once '../views/forgotPasswordForm.php';
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
               echo $controller->showAllFiles($_SESSION["_User"]->idUsuario);
            break;
        case 5:
                echo $controller->showFormUpload();
            break;
        case 6:
                echo $controller->adminFiles($_REQUEST["idUsuario"]);
            break;
        case 7:
                echo $controller->showFormPassword();
            break;
        default:
            echo Dialog::Message("Error", "Existio algun error valide su informacion", true, 0, "Aceptar", true);
            echo '<script>setTimeout(function(){window.location="index.php";},2000);</script>';
        break;
            
        
    }
    
    
    
}
?>
