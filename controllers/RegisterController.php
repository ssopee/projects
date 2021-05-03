<?php
    require_once '../classes/DBManager.php';
    require_once '../models/UserModel.php';

    if(isset($_POST)) {
        $params = $_POST;
        $userModel = new UserModel();
        if($params["pwd"] != $params["confirm-pwd"]){
            header("location: /usecasediagram/register.php?error=1");
        }
        else{
            $userModel->insertUser($params);
            header("location: /usecasediagram/login.php");
        }

      
    }
    
?>