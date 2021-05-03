<?php
    require_once '../classes/DBManager.php';
    require_once '../models/ShareModel.php';
    session_start();

    if(isset($_POST)) {
        $service = isset($_POST["service"])? $_POST["service"]:"";
        if($service == "update") {
            $params = $_POST;
            $ShareModel = new ShareModel();
            $ShareModel->updateShareDescById($params);
        }
        else if($service == "delete") {
            $params = $_POST;
            $ShareModel = new ShareModel();
            $ShareModel->deleteShareById($params);
            $delete_path = "../uploads/share/$params[user_id]/$params[image_name]";
            if(file_exists($delete_path)) {
                unlink($delete_path);
            }
        }
        else if($service == "ConfirmPost") {
            $params = $_POST;
            $ShareModel = new ShareModel();
            $ShareModel->ConfirmPostShareById($params);
        }
        else {
            $params = $_POST;
            $params["user_id"] = $_SESSION["user_id"];
            $params["img"] = "";
            //print_r($params);
    
            //save image file to folder
            if(isset($_FILES["img"])) {
                $nameArray = explode(".", $_FILES["img"]["name"]); //re_ic.png => ["re_ic", "png"]
                $name_file = round(microtime(true) * 1000).".".$nameArray[1]; // 1223333png
                $temp_path = $_FILES["img"]["tmp_name"];
                $params["img"] = $name_file;
                $location_path = "../uploads/share/$params[user_id]/";
                if(!file_exists($location_path)) {
                    mkdir($location_path);
                }
                move_uploaded_file($temp_path, $location_path.$name_file);
            }
            //save data to DB
            $shareModel = new ShareModel();
            $shareModel->insertShare($params);
            header("location: /usecasediagram/share.php");
        }

    }
?>