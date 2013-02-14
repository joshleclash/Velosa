<?php
//include_once '../config/config.php';
include_once '../components/Components.php';
$components = new Components();
if(isset($_REQUEST["id"])){
    $sql     = "Select * from archivo where idArchivo=".$_REQUEST["id"];
    $rs      = $components->__executeQuery($sql,$components->getConnect());
    var_dump($rs);
    $row     = mysql_fetch_object($rs);
    
    header('Content-type:'. $row->typeFile);
    header('Content-length:'. $row->size);
    header('Content-Disposition: attachment; filename='. $row->nameFile);
    header('Content-Description: PHP Generated Data');
    echo $row->blobFile;
    
}
?>
