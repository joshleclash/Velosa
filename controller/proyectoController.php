<?php
include_once '../config/config.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class proyectoController{
    private $components=null;
    private $conect=null;
    public function __construct() {
        $this->components= new Components();
        $this->conect= $this->components->getConnect();
        $this->model= new proyectoModel();
    }
    public function saveProyecto($parametros){
                $response = $this->model->createProyecto($parametros);
                if($response['codeError']==0)
                    {
                        return '<span id="error-response">'.$response['msg'].'</span>';
                    }
                else{
                        return '<span id="ok-response">'.$response['msg'].'</span>';
                    }
    }
}


if(isset($_REQUEST["option"]))
    {
    $proyectoController = new proyectoController();     
            switch($_REQUEST["option"])
            {
            case 0://Save Proyecto.
                 echo  $proyectoController->saveProyecto($_REQUEST);
                break;
            default :
                echo Dialog::Message("Error", "Existio algun error valide su informacion", true, 0, "Aceptar", true);
                echo '<script>setTimeout(function(){window.location="index.php";},2000);</script>';
            break;
            }
    }
    

?>
