<?php
include_once '../config/config.php';
class aplicationController{
    private $components=null;
    private $conect=null;
    public function __construct() {
        $this->components= new Components();
        $this->conect= $this->components->getConnect();
    }
    public function administrarUsuarios(){
        $sql =" Select * from usuarios where idPerfil=2";
        $rs = $this->components->__executeQuery($sql, $this->conect);
        while($row = mysql_fetch_array($rs)):
                
        endwhile;
        return $rs;
    }
    
    
    
}
if(isset($_REQUEST["option"])){
    $controller = new aplicationController();    
    switch($_REQUEST["option"]){
        case 1:
            $rs = $controller->administrarUsuarios();
            
        break;
        
        default:
            echo Dialog::Message("Error", "Existio algun error valide su informacion", true, 0, "Aceptar", true);
            echo '<script>setTimeout(function(){window.location="index.php";},2000);</script>';
        break;
            
        
    }
    
    
    
}
?>
