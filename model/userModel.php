<?php
include_once '../config/config.php';
class userModel{
    private $components=null;
    private $conect=null;
    private $error=null;
    public function __construct() {
        $this->components = new Components();
        $this->conect=$this->components->getConnect();
    }
    public function  userExist(){
    $sql ="select * from usuario t1, perfil t2 where t1.idPerfil = t2.idPerfil and t1.identificacion=".$_REQUEST["identificacion"];
        $rs = $this->components->__executeQuery($sql, $this->components->getConnect());
        $rows = mysql_num_rows($rs);
        return $rows;
    }
    public function createUser(){
        $string = '@#&0987654321ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $temp="";
        for($i=0;$i<=10;$i++):
            $temp .= substr($string,rand(0,62),1);
        endfor;
	    if(!is_numeric($_REQUEST["celular"]))
                            return array("codeError"=>0,"msg"=>'Error en el numero de celular');
        if($this->validateEmail($_REQUEST["mail"])==false)
		return array("codeError"=>0,"msg"=>'Error en le formato de email');
	if(!is_numeric($_REQUEST["identificacion"]))
                return array("codeError"=>0,"msg"=>"Error en el formato de numero de documento");
        if($this->userExist()>=1){
            return array("codeError"=>0,"msg"=>'Este usuario ya esta registrado en el sistema');
        }
        $sql = "INSERT INTO usuario
                (nombreUsuario, apellidoUsuario, celular, mail, clave, identificacion) 
                VALUES ('$_REQUEST[nombres]', '$_REQUEST[apellidos]', '$_REQUEST[celular]', '$_REQUEST[mail]', '".$temp."', $_REQUEST[identificacion]);";
                $rs = $this->components->__executeQuery($sql,$this->components->getConnect()); 
                
                if($rs)
                    {
                        $msg = "<strong>Bienvenido</strong><br/>";
                        $msg .= "<strong>Señor(a)</strong>:<br/>$_REQUEST[nombres]  $_REQUEST[apellidos]";
                        $msg .= "Su usuario fue creado correctamente favor ingrese a nuestro sistema.<br/><br/>";
                        $msg .= "<strong>Identificacion:</strong>$_REQUEST[identificacion]<br/>";
                        $msg .= "<strong>Clave:$temp</strong><br/>";
                        $msg .= "<br/><br/><br/><br/><br/>";
                        $msg .= "Mensaje generado automaticamente favor no responder gracias.<br/>".Components::getDate();
                        $send = $this->components->sendRsForMail(array('joshleclash@gmail.com',$_REQUEST["mail"]), "Red Macro le da la Bienvenida a nuestro sistema", $msg);
                        if($send)
                            return array("codeError"=>1,"msg"=>"Usuario creado correctamente");
                        else
                           return array("codeError"=>0,"msg"=>"Existio algun error en el sistema");
                    }
    }
    public function loginUser($peticion=null){
        $i=0;    
    foreach($peticion as $key => $val):
                   
                 if(empty($val))
                    {
                        $i++;
                    }
                
    endforeach;
    if(!is_numeric($peticion["identificacion"])) {
       return array("codeError"=>0,"msg"=>"El usuario no puede contener caracteres deve ser numerico"); 
    }   
    if(strlen($peticion["password"])<=6){
            return array("codeError"=>0,"msg"=>"La clave es demasiado corta");
        }
        $SQL="select * from usuario us join perfil per on us.idPerfil=per.idPerfil where identificacion=".$peticion["identificacion"];  
        $rs = $this->components->__executeQuery($SQL,$this->conect);
        $row = mysql_fetch_array($rs);
        if(mysql_affected_rows($this->conect)<=0)
            return array("codeError"=>0,"msg"=>"usuario no resgistrado en el sistema"); 
        else if(is_array($row)){
            if($row["idPerfil"]==3){
                return array("codeError"=>1,"msg"=>'Usuario inactivo');  
            }
            if($row["clave"]==$_REQUEST["password"]){
                $objectUser= (object) array();
                foreach($row as $k => $v):
                    if(!is_numeric($k))
                            $objectUser->$k=$v;
                endforeach;
                $_SESSION["_User"]=$objectUser;
                return array("codeError"=>1,"msg"=>'Inicio de session exitoso');  
            }else{
                return array("codeError"=>0,"msg"=>"Error de clave! Valide su informacion");  
            }
        }
    }
    public function forgotPassword($params){
    $i=0;    
    foreach($params as $key => $val):
                if($key!='option')
                {   
                 if(empty($val))
                    {
                        $i++;
                    }
                }
    endforeach;
    if($i!=0){
            return array("codeError"=>0,"msg"=>"Todos los campos deven estar diligenciados");
        }
        if($params["oldPassword"]!=$_SESSION["_User"]->clave){
            return array("codeError"=>0,"msg"=>"Su contraseña dijitada y la almacenada no coinciden");
        }
        if(strlen($params["newPassword"])<=6){
            return array("codeError"=>0,"msg"=>"Su nueva contraseña no es muy segura");
        }
        if($params["newPassword"]!=$params["confirmNewPassword"]){
            return array("codeError"=>0,"msg"=>"Su nueva contraseña y la confirmacion no coinciden");
        }
        $sql ="update usuario set clave='".$params["newPassword"]."' where idUsuario=".$_SESSION["_User"]->idUsuario;
        $rs = $this->components->__executeQuery($sql, $this->conect);
        if($rs){
            return array("codeError"=>1,"msg"=>"Contraseña actualizada correctamente");
        }else{
            return array("codeError"=>1,"msg"=>"Exisito algun error en la actualizacion de la contraseña");
        }
        
    } 
    
    private function  validateEmail($direccion=null)
        {
           $Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
           if(preg_match($Sintaxis,$direccion))
		   {
              return true;
           }
		   else 
		   {
			  return false;
		   }
        }
      public function showUser(){
            $sql = "select * from usuario where idPerfil=2";
            $rs = $this->components->__executeQuery($sql, $this->components->getConnect());
            return $rs;
            
      }  
}
?>
