<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../config/config.php';
include_once '../config/validateSession.php';
class proyectoModel{
    private $components=null;
    private $conect=null;
    private $error=null;
    private $response;
    private $model=null;
    public function __construct() {
        $this->components = new Components();
        $this->conect=$this->components->getConnect();
        
    }
    public function createProyecto($paramsForm=null){
        $userModel = new userModel();
        if(!$userModel->validateEmail($paramsForm["e-mail"])){
            return $respuesta=array("codeError"=>0,"msg"=>"Formato de e-mail no valido");
        }
        if(empty($paramsForm["Proyecto"])){
            $respuesta=array("codeError"=>0,"msg"=>"La informacion deve estar completamente diligenciada");
            return $respuesta;
        }
        $sql="INSERT INTO proyecto
                (nombreProyecto, codigoProyecto, nombreAuditor, idUsuario, mail) 
                VALUES ('".$paramsForm["Proyecto"]."', '".$paramsForm["Codigo"]."',
                '".$paramsForm["Auditor"]."', ".$_SESSION["_User"]->idUsuario.", '".$paramsForm["e-mail"]."');";
        $rs = $this->components->__executeQuery($sql,$this->conect);
            if($rs){
                $respuesta=array("codeError"=>1,"msg"=>"Proyecto creado correctamente");
                return  $respuesta;
                
            }else{
                $respuesta=array("codeError"=>0,"msg"=>"Existio algun error con el almacenamiento del proyecto");
                return $respuesta;
            }
    }
    
    
    
}
?>
