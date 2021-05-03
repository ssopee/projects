<?php
    require_once '../classes/DBManager.php';
    require_once '../models/UserModel.php'; 
    
    session_start();

    $service = isset($_GET["service"])? $_GET["service"]: "";
    if($service == "logout") {
        session_unset(); //remove all session variable
        session_destroy();
        header("location: /usecasediagram/index.php");
    }
    else if(isset($_POST)) {
        $params = $_POST;
        $userModel = new UserModel();
        $result = $userModel->getUserByEmailPwd($params);
        
        if(sizeof($result) > 0) {
            $_SESSION["user_id"] = $result[0]["user_id"];
            $_SESSION["username"] = $result[0]["username"];
            header("location: /usecasediagram/index.php");
        }
        else {
            header("location: /usecasediagram/login.php?error=1");
        }
    }
?>