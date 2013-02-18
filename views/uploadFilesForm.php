<?php 
    if(isset($_REQUEST["idArchivo"])){
        $iframe  ='<iframe src="uploadForm.php?idArchivo='.$_REQUEST["idArchivo"].'" height="300" width="660" style="border:0px solid"></iframe>';
    }else{
        $iframe  ='<iframe src="uploadForm.php" height="300" width="660" style="border:0px solid"></iframe>';
    }
    echo Dialog::Message("Upload", $iframe, true, 0, "Enviar notificacion",false);


?>