<?php
include_once '../config/config.php';
$components = new Components();
if(isset($_REQUEST["id"])){
    $sql     = "Select * from archivo where idArchivo=".$_REQUEST["id"];
    $rs      = $components->__executeQuery($sql,$components->getConnect());
    $row     = mysql_fetch_array($rs);
    $name    =  $row["nameFile"];
    $type    = $row["typeFile"];
    $content = $row["blobFile"];
    //header("Content-Disposition: attachment; filename=$name");
    header("Content-type:$type");
    //var_dump($content);
    //echo '**********************-**************';
    echo stripslashes($content);
    exit;
    
}
?>
