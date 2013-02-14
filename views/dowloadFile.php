<?php
include_once '../config/config.php';
//include_once '../components/Components.php';
$components = new Components();
if(isset($_REQUEST["id"])){
    $sql     = "Select * from archivo where idArchivo=".$_REQUEST["id"];
    $rs      = $components->__executeQuery($sql,$components->getConnect());
    $row     = mysql_fetch_object($rs);
    //@header("Content-type: application/force-download");
    //@header("Content-Transfer-Encoding: Binary");
    header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header("Content-type:   application/x-msexcel; charset=utf-8");
    
    //@header('Content-type:'. $row->typeFile);
    @header('Content-length:'. $row->size);
    //@header('Content-Disposition: attachment; filename='. $row->nameFile);
    //@header('Content-Description: PHP Generated Data');
    //echo $row->blobFile;
    echo $row->typeFile;
    
}
?>
