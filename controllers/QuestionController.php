<?php
    require_once '../classes/DBManager.php';
    require_once '../models/QuestionModel.php';
    session_start();

    if(isset($_POST)) {
        $service = isset($_POST["service"])? $_POST["service"]:"";
        if($service == "update") {
            $params = $_POST;
            $questionModel = new QuestionModel();
            $questionModel->updateQuestionDescById($params);
        }
        else if($service == "delete") {
            $params = $_POST;
            $questionModel = new QuestionModel();
            $questionModel->deleteQuestionById($params);
            $delete_path = "../uploads/question/$params[user_id]/$params[image_name]";
            if(file_exists($delete_path)) {
                unlink($delete_path);
            }
        }
        else if($service == "ConfirmPost") {
            $params = $_POST;
            $ShareModel = new QuestionModel();
            $ShareModel->ConfirmQuestionById($params);
        }
        else {
            $params = $_POST;
            $params["user_id"] = $_SESSION["user_id"];
            $params["img"] = "";
            //print_r($params);
    
            //save image file to folder
            if(file_exists($_FILES["img"]["tmp_name"]) || is_uploaded_file($_FILES["img"]["tmp_name"]) ) {
                $nameArray = explode(".", $_FILES["img"]["name"]); //re_ic.png => ["re_ic", "png"]
                $name_file = round(microtime(true) * 1000).".".$nameArray[1]; // 1223333png
                $temp_path = $_FILES["img"]["tmp_name"];
                $params["img"] = $name_file;
                $location_path = "../uploads/question/$params[user_id]/";
                if(!file_exists($location_path)) {
                    mkdir($location_path);
                }
                move_uploaded_file($temp_path, $location_path.$name_file);

            }
            //save data to DB
            $questionModel = new QuestionModel();
            $questionModel->insertQuestion($params);
            header("location: /usecasediagram/question.php");
        }
        
        
    }
?>