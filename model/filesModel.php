<?php
include_once '../config/config.php';
class filesModel{
    private $components=null;
    private $conect=null;
    private $error=null;
    public function __construct() {
        $this->components = new Components();
        $this->conect=$this->components->getConnect();
    }
    public function uploadFiles($idUser=''){
        
    }
}
?>
