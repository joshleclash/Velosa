<?php
include_once '../model/userModel.php';
include_once '../config/validateSession.php';
class userController{
    private $userModel = null;
    public function __construct(){
       $this->userModel = new userModel(); 
    }
    public function createUserController($peticion){
        return $this->userModel->createUser($peticion);
    }
    public function loginUserController($peticion){
        return $this->userModel->loginUser($peticion);
    }
    public function forgotPass($peticion){
        return $this->userModel->forgotPassword($peticion);
    }
}
if(isset($_REQUEST['option'])){
    $userController = new userController();
    if($_REQUEST["option"]==0)
      {
         $response = $userController->createUserController($_POST);
         if($response["codeError"]==0){
             echo '<div class="error-response">'.$response["msg"].'</div>';
         }else{
             echo '<div class="ok-response" align="center"><img src="'.PATCH.'/images/icons/accept.png" style="margin-top: -10px;" align="middle">'.$response["msg"].
                     '<script>setTimeout(function(){window.location="index.php";},2000)</script>'.
                  '</div>';
         }
      }else if($_REQUEST["option"]==1){
        $response = $userController->loginUserController($_REQUEST);
         if($response["codeError"]==0){
             echo '<div class="error-response">'.$response["msg"].'</div>';
         }else{
             echo '<div class="ok-response" align="center"><img src="'.PATCH.'/images/icons/accept.png" style="margin-top: -10px;" align="middle">'.$response["msg"].
                        '<script>setTimeout(function(){window.location="aplicationWelcome.php";},2000)</script>'.
                  '</div>';
         }
      }else if($_REQUEST["option"]==3)
      {
         $response = $userController->createUserController($_POST);
         if($response["codeError"]==0){
             echo Dialog::Message("Error", $response["msg"], true, 0, "Aceptar");
         }else{
             echo Dialog::Message("Confirmacion", $response["msg"], true, 0, "Aceptar");
         }
      }else if($_REQUEST["option"]==4)
      {
         $response =  $userController->forgotPass($_REQUEST);
         if($response["codeError"]==0){
             echo '<div class="error-response">'.$response["msg"].'</div>';
         }else{
             echo '<div class="ok-response" align="center"><img src="'.PATCH.'/images/icons/accept.png" style="margin-top: -10px;" align="middle">'.$response["msg"].
                  '</div>';
         }
      }  
}
?>
