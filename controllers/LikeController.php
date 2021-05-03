<?php
    require_once '../classes/DBManager.php';
    require_once '../models/LikeModel.php';
    session_start();

    if(isset($_POST)) {
        $params = $_POST;
        $service = $params["service"];
        $LikeModel = new LikeModel();
        if($service == 'Like') {
           $LikeModel->insertLike($params);
          
        }
        else if($service == 'Delete') { 
            $LikeModel->DeleteLike($params);
        }
       

    }
?>